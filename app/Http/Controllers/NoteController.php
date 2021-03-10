<?php

namespace App\Http\Controllers;

use App\Note;
use App\Voucher;
use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;
use App\Services\NoteService;
use App\Filters\NoteSearch\NoteSearch;
use App\Http\Resources\Note\NoteCollection;
use Illuminate\Support\Facades\DB;

class NoteController extends ApiController
{
    private $note;
    protected $service;

    public function __construct(Note $note, NoteService $service)
    {
        setlocale(LC_ALL, "es_ES");
        date_default_timezone_set('America/Caracas');

        $this->note = $note;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new NoteCollection(NoteSearch::apply($request, $this->note));
        }

        $notes = NoteSearch::checkSortFilter($request, $this->note->newQuery());

        return new NoteCollection($notes->paginate($request->take)); 
    }

    public function store(NoteRequest $request)
    {
        
            $date = \DateTime::createFromFormat('Y-m-d', $request->note['date']);
            $voucher = Voucher::number($request->note['office_id']);

            $note = $this->note->create([
                'date' => $date->format('Y-m-d H:i:s'),
                'number' => $voucher->starting_number,
                'total' => $request->note['total'],
                'discount' => floatval(str_replace(',', '.', str_replace(',', '', $request->note['discount']))),
                'nit' => $request->note['nit'],
                'voucher_id' => $voucher->id,
                'customer_id' => $request->note['customer_id']['id'],
                'user_id' => $request->note['user_id'],
                'quotation_id' => $request->note['quotation_id'],
            ]);

            foreach ($request->products as $key => $value) {
                $note->products()->attach($value['id'], [
                    'quantity' => $value['quantity'], 
                    'description' => $value['description'], 
                    'price' => $value['price'], 
                    'subtotal' => $value['subtotal'],
                ]);
            }

        return $this->respondCreated($note);
    }

    public function notePdf(Note $note, Request $request)
    {
        return $this->service->singlePdfDownload($note, $request);
    }

    public function listPdf(Request $request)
    {
        return $this->service->manyPdfDownload($request);
    }
    
    public function listExcel(Request $request) 
    {
        return $this->service->manyExcelDownload($request);
    }
}
