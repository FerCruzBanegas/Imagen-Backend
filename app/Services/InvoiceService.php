<?php

namespace App\Services;

use App\Invoice;
use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\InvoicesExport;
use App\Transformers\InvoiceTransformer;
use NumerosEnLetras;

class InvoiceService
{
    // Inicializamos variables
    var $codcontrol_autorizacion = "";
    var $codcontrol_factura = "";
    var $codcontrol_nitci = "";
    var $codcontrol_fecha = "";
    var $codcontrol_monto = "";
    var $codcontrol_llave = "";

    public $d = null;
    public $inv = null;
    public $p = null;

    protected $transformer;

    public function __construct(InvoiceTransformer $transformer) 
    {
        $this->d = json_decode('[[0,1,2,3,4,5,6,7,8,9],[1,2,3,4,0,6,7,8,9,5],[2,3,4,0,1,7,8,9,5,6],[3,4,0,1,2,8,9,5,6,7],[4,0,1,2,3,9,5,6,7,8],[5,9,8,7,6,0,4,3,2,1],[6,5,9,8,7,1,0,4,3,2],[7,6,5,9,8,2,1,0,4,3],[8,7,6,5,9,3,2,1,0,4],[9,8,7,6,5,4,3,2,1,0]]');
        $this->inv = json_decode('[0,4,3,2,1,5,6,7,8,9]');
        $this->p = json_decode('[[0,1,2,3,4,5,6,7,8,9],[1,5,7,6,2,8,3,0,9,4],[5,8,0,3,7,9,6,1,4,2],[8,9,1,6,0,4,3,5,2,7],[9,4,5,3,1,2,6,8,7,0],[4,2,8,6,5,7,3,9,0,1],[2,7,9,3,8,0,6,4,1,5],[7,0,4,6,9,1,3,2,5,8]]');

        $this->transformer = $transformer;
    }

    private function CalcVerhoeff($number, $iterations = 1) 
    {
        $result = 0;
        $number = str_split(strrev($number), 1);
        foreach ($number as $key => $value) {
            $result = $this->d[$result][$this->p[($key + 1) % 8][$value]];
        }
        $result = strrev(implode('', $number)) . $this->inv[$result];
        if ($iterations > 1) {
            return $this->CalcVerhoeff($result, --$iterations);
        }
        return $result;
    }

    private function Check($number, $iterations = 1) 
    {
        $result = 0;
        $number = str_split(strrev($number), 1);
        foreach ($number as $key => $value) {
            $result = $this->d[$result][$this->p[$key % 8][$value]];
        }
        if ($result == 0) {
            unset($number[0]);
            $result = strrev(implode('', $number));
            if ($iterations > 1) {
                return $this->Check($result, --$iterations);
            }
            return $result;
        }
        return false;
    }
    /* *** Encriptación AllegedRC4
       Fuente: https://gist.github.com/farhadi/2185197
    */
    /*
     * RC4 symmetric cipher encryption/decryption
     *
     * @license Public Domain
     * @param string key - secret key for encryption/decryption
     * @param string str - string to be encrypted/decrypted
     * @return string
     */
    private function AllegedRC4_encode($msg, $key, $mode='hex') 
    {
        $state = array();
        for ($i=0; $i<256; $i++) $state[] = $i;
        $x = $y = $i1 = $i2 = 0;
        $key_length = strlen($key);
        for ($i=0; $i<256; $i++) {
            $i2 = (ord($key[$i1])+$state[$i]+$i2) % 256;
            self::swap($state[$i], $state[$i2]);
            $i1 = ($i1+1) % $key_length;
        }
        $msg_length = strlen($msg);
        $msg_hex = '';
        for ($i=0; $i<$msg_length; $i++) {
            $x = ($x + 1) % 256;
            $y = ($state[$x] + $y) % 256;
            self::swap($state[$x], $state[$y]);
            $xi = ($state[$x] + $state[$y]) % 256;
            $r = ord($msg[$i]) ^ $state[$xi];
            $msg[$i] = chr($r);
            $msg_hex .= sprintf("%02X",$r);
        }
        return ($mode=='hex'?$msg_hex:$msg);
    }

    private static function swap(&$x, &$y) 
    {
        $z = $x; $x = $y; $y = $z;
    }
    /* Base64
    */
    private function base64($n) 
    {
        $d = array(
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 
            'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 
            'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 
            'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 
            'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 
            'y', 'z', '+', '/' 
        );
        $c = 1; $r = '';
        while ($c > 0) {
            $c = (int)($n / 64);
            $r = $d[$n%64] . $r;
            $n = $c;
        }
        return $r;
    }

    public function makeControlCode($codcontrol_autorizacion=0, $codcontrol_nrofactura=0, $codcontrol_nitci=0, $codcontrol_fecha="00000000", $codcontrol_monto=0, $codcontrol_llave="") 
    {
        $codcontrol_codigo = "ERROR";
        if ($codcontrol_nitci == "") { 
            $codcontrol_nitci == 0; 
        }

        if ($codcontrol_autorizacion == "" || $codcontrol_nrofactura == "" || $codcontrol_fecha == "" || $codcontrol_monto == "" || $codcontrol_llave == "") {
            $codcontrol_codigo = "ERROR_SinDatos";
        } else {
            // Reemplazos para cumplir con el formato de los datos
            $codcontrol_fecha = str_replace("/", "", $codcontrol_fecha);
            $codcontrol_monto = round(str_replace(",", ".", $codcontrol_monto),0);
            // Paso 1
            // En los otros pasos no usamos las variables originales pero si las nuevas
            // En ese sentido re usamos las variables originales para modificarlas
            $codcontrol_nrofactura = $this->CalcVerhoeff($codcontrol_nrofactura,2);
            $codcontrol_nitci = $this->CalcVerhoeff($codcontrol_nitci,2);
            $codcontrol_fecha = $this->CalcVerhoeff($codcontrol_fecha,2);
            $codcontrol_monto = $this->CalcVerhoeff($codcontrol_monto,2);
            $suma_verhoeff = $this->CalcVerhoeff(bcadd(bcadd(bcadd($codcontrol_nrofactura, $codcontrol_nitci), $codcontrol_fecha), $codcontrol_monto),5);
            $paso1 = substr($suma_verhoeff,strlen($suma_verhoeff)-5,strlen($suma_verhoeff));
            // Paso 2
            $contadigitos = array();
            $aadicionar = array();
            $indicestr = 0;
            foreach (str_split($paso1) as $d) {
                $contadigitos[] = $d + 1;
                $aadicionar[] = substr($codcontrol_llave, $indicestr, $d + 1);
                $indicestr += $d + 1;
            }
            $codcontrol_autorizacion .= $aadicionar[0];
            $codcontrol_nrofactura .= $aadicionar[1];
            $codcontrol_nitci .= $aadicionar[2];
            $codcontrol_fecha .= $aadicionar[3];
            $codcontrol_monto .= $aadicionar[4];
            // Paso 3 
            $paso3_str = $codcontrol_autorizacion.$codcontrol_nrofactura.$codcontrol_nitci.$codcontrol_fecha.$codcontrol_monto;
            $paso3_key = $codcontrol_llave.$paso1;
            $paso3 = $this->AllegedRC4_encode($paso3_str, $paso3_key);
            // Paso 4
            $paso4 = 0;
            $sumparcial = array(0,0,0,0,0);
            $codif_length = strlen($paso3);
            for ($i=0; $i<$codif_length; $i++) {
              $paso4 += ord($paso3[$i]);
              $sumparcial[$i%5] += ord($paso3[$i]);
            } 
            // Paso 5
            $paso5 = 0;
            for ($i=0; $i<5; $i++) {
                $paso5 += (int)(($paso4 * $sumparcial[$i]) / (1 + $paso1[$i]));
            }
            $paso5 = $this->base64($paso5);
            // Paso 6
            $paso6 = $this->AllegedRC4_encode($paso5, $codcontrol_llave.$paso1);
            $codcontrol_codigo = implode("-", str_split($paso6,2));
        }    
        return $codcontrol_codigo;
    }

    public function makeQrCode($nitEmisor, $nroFactura, $nroAutorizacion, $fecha, $importeTotal, $importeBaseCf, $codigoControl, $nitCliente, $importeIceIehdTasas=0, $importeVentasNoGravadas=0, $importeNoSujetoCf=0, $descuentosBonosRebajas=0)
    {
        $qr = $nitEmisor . '|' . $nroFactura . '|' . $nroAutorizacion . '|' . $fecha . '|' . $importeTotal . '|' . $importeBaseCf . '|' . $codigoControl . '|' . $nitCliente . '|' . $importeIceIehdTasas . '|' . $importeVentasNoGravadas . '|' . $importeNoSujetoCf . '|' . $descuentosBonosRebajas;
        
        return $qr;
    }

    public function setSpanishDate($date)
    {
        $ano = date('Y', strtotime($date));
        $mes = date('n', strtotime($date));
        $dia = date('d', strtotime($date));
        $diasemana = date('w', strtotime($date));
        $diassemanaN= array("Domingo","Lunes","Martes","Miércoles",
                          "Jueves","Viernes","Sábado");
        $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                     "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return "$dia ". $mesesN[$mes] ." de $ano";
    }

    public function singlePdfDownload(Invoice $invoice, Request $request) 
    {
        $inv = $this->transformer->item($invoice);
        $qrCode = $this->makeQrCode($inv['invoice']['license']['nit'], $inv['invoice']['number'], $inv['invoice']['license']['authorization'], date('d/m/Y', strtotime($inv['invoice']['date'])), $inv['invoice']['total'], $inv['invoice']['total'], $inv['invoice']['control_code'], $inv['invoice']['customer']['nit'],0,0,0,0);

        $data = [
            'invoice' => $inv['invoice'],
            'type' => $request->type,
            'spanish_date' => $this->setSpanishDate($invoice->date),
            'literal_amount' => NumerosEnLetras::convertir($invoice->total,'Bolivianos',true),
            'qr' => $qrCode
        ];

        $export = new PdfExport('pdf.invoice', ['data' => $data]);
        return $export->options()->letter()->download();
    }

    public function manyPdfDownload(Request $request) 
    {
        if (empty($request->invoice)) {
            $invoices = $this->transformer->collection2(Invoice::desc()->checklist()->get());
        } else {
            $invoices = $this->transformer->collection2(Invoice::in($request->invoice)->checklist()->get());
        }

        $export = new PdfExport('pdf.invoice-list', $invoices);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelDownload(Request $request) 
    {
        if (empty($request->invoice)) {
            $invoices = $this->transformer->collection2(Invoice::desc()->checklist()->get());
        } else {
            $invoices = $this->transformer->collection2(Invoice::in($request->invoice)->checklist()->get());
        }

        return (new InvoicesExport($invoices))->download('invoices.xlsx');
    }
}
