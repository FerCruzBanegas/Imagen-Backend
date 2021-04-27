<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class InvoiceResource extends JsonResource
{
    public function makeQrCode($nitEmisor, $nroFactura, $nroAutorizacion, $fecha, $importeTotal, $importeBaseCf, $codigoControl, $nitCliente, $importeIceIehdTasas=0, $importeVentasNoGravadas=0, $importeNoSujetoCf=0, $descuentosBonosRebajas=0)
    {
        $qr = $nitEmisor . '|' . $nroFactura . '|' . $nroAutorizacion . '|' . $fecha . '|' . $importeTotal . '|' . $importeBaseCf . '|' . $codigoControl . '|' . $nitCliente . '|' . $importeIceIehdTasas . '|' . $importeVentasNoGravadas . '|' . $importeNoSujetoCf . '|' . $descuentosBonosRebajas;
        
        return $qr;
    }

    public function toArray($request)
    {
        $qrCode = $this->makeQrCode($this->license->nit, $this->number, $this->license->authorization, date('d/m/Y', strtotime($this->date)), $this->total, $this->total, $this->control_code, $this->nit,0,0,0,0);

        return [
            'id' => $this->id,
            'number' => str_pad($this->number, 8, '0', STR_PAD_LEFT),
            'date' => $this->date,
            'control_code' => $this->control_code,
            'total' => $this->total,
            'title' => $this->title,
            'footer' => $this->footer,
            'nit_name' => $this->nit_name ? $this->nit_name : $this->customer->business_name,
            // 'oc' => $this->oc,
            // 'hea' => $this->hea,
            'details' => is_null($this->details) ? [] : array_map(function($iter) { return array('description' => $iter); }, explode('|', $this->details)),
            'summary' => $this->summary,
            'state' => ['title' => $this->state_id === 1 ? 'VÁLIDO' : 'ANULADO'],
            'state_data' => ['title' => $this->state_id === 1 ? 'VÁLIDO' : 'ANULADO'],
            'qr' => $qrCode,
            'customer' => ['name' => $this->customer->business_name],
            'customer_data' => [
                'id' => $this->customer->id,
                'business_name' => $this->nit_name ? $this->nit_name : $this->customer->business_name,
                'nit' => $this->nit,
            ],
            'license' => [
                'nit' => $this->license->nit,
                'authorization' => $this->license->authorization,
                'deadline' => Carbon::parse($this->license->deadline)->format('d/m/Y'),
                'activity' => $this->license->activity,
                'legend' => $this->license->legend,
                'office' => [
                    'id' => $this->license->office->id,//cambio aqui
                    'name' => $this->license->office->description,//cambio aqui
                    'city' => $this->license->office->city->name,
                    'address' => explode(',', $this->license->office->detail)
                ],
            ],
            'products' => collect($this->products)->transform(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $product->pivot->quantity,
                    'description' => $product->pivot->description,
                    'price' => number_format($product->pivot->price, 2, '.', ','),
                    'subtotal' => $product->pivot->subtotal,
                ];
            }),
            'user' => $this->user->id,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
