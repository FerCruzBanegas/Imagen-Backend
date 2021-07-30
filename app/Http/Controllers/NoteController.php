<?php

namespace App\Http\Controllers;

use App\Note;
use App\Voucher;
use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;
use App\Http\Requests\NoteUpdateRequest;
use App\Services\NoteService;
use App\Filters\NoteSearch\NoteSearch;
use App\Http\Resources\Note\NoteProductResource;
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
        DB::beginTransaction();
        try {
            $date = \DateTime::createFromFormat('Y-m-d', $request->note['date']);
            $voucher = Voucher::number($request->note['office_id']);

            $note = $this->note->create([
                'date' => $date->format('Y-m-d H:i:s'),
                'number' => $voucher->starting_number,
                'total' => $request->note['total'],
                'discount' => floatval(str_replace(',', '.', str_replace(',', '', $request->note['discount']))),
                'nit' => $request->note['nit'],
                'summary' => $request->note['summary'],
                'accounts' => $request->note['accounts'],
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

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }

        return $this->respondCreated($note);
    }

    public function update(Note $note, NoteUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            if($note->cancelled) {
                return $this->respond(message('MSG017'), 406);
            }

            $note->update([
                'total' => $request->note['total'],
                'discount' => $request->note['discount'],
                'summary' => $request->note['summary'],
                'accounts' => $request->note['accounts'],
            ]);

            if (!$this->service->checkDataChange($note, $request)) {
                $note->products()->detach();
                foreach ($request->products as $key => $value) {
                    $note->products()->attach($value['id'], [
                        'quantity' => $value['quantity'], 
                        'description' => $value['description'],
                        'price' => $value['price'], 
                        'subtotal' => $value['subtotal'],
                    ]);
                }
                $note->touch();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }

        return $this->respondUpdated();
    }

    public function destroy(Note $note)
    {
        try {
            if($note->cancelled) {
                return $this->respond(message('MSG018'), 406);
            }

            if($note->payments()->count() > 0) {
                return $this->respond(message('MSG021'), 406);
            }
            $note->delete();
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondDeleted($note);
    }

    public function getProductsNote(Note $note)
    {
        return new NoteProductResource($note);
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
