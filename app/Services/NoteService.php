<?php

namespace App\Services;

use App\Note;
use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\NotesExport;
use App\Transformers\NoteTransformer;
use NumerosEnLetras;

class NoteService
{
    protected $transformer;

    public function __construct(NoteTransformer $transformer) 
    {
        $this->transformer = $transformer;
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

    public function singlePdfDownload(Note $note, Request $request) 
    {
        $not = $this->transformer->item($note);

        $data = [
            'note' => $not['note'],
            'spanish_date' => $this->setSpanishDate($note->date),
            'literal_amount' => NumerosEnLetras::convertir($note->total,'Bolivianos',true),
        ];

        $export = new PdfExport('pdf.note', ['data' => $data]);
        return $export->options()->letter()->download();
    }

    public function manyPdfDownload(Request $request) 
    {
        if (empty($request->note)) {
            $notes = $this->transformer->collection2(Note::desc()->checklist()->get());
        } else {
            $notes = $this->transformer->collection2(Note::in($request->note)->checklist()->get());
        }

        $export = new PdfExport('pdf.note-list', $notes);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelDownload(Request $request) 
    {
        if (empty($request->note)) {
            $notes = $this->transformer->collection2(Note::desc()->checklist()->get());
        } else {
            $notes = $this->transformer->collection2(Note::in($request->note)->checklist()->get());
        }

        return (new NotesExport($notes))->download('notes.xlsx');
    }
}
