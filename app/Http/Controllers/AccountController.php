<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Note;
use Illuminate\Http\Request;
use App\Filters\InvoiceSearch\InvoiceAccountSearch;
use App\Filters\NoteSearch\NoteAccountSearch;
use App\Filters\InvoiceSearch\InvoiceAccountCancelledSearch;
use App\Filters\NoteSearch\NoteAccountCancelledSearch;
use App\Http\Resources\Account\AccountCollection;
use App\Services\AccountService;

class AccountController extends ApiController
{
    protected $invoice;
    protected $note;
    protected $service;

    protected $types = [
        'FACTURA' => Invoice::class,
        'N.REMISION' => Note::class,
    ];

    public function __construct(Invoice $invoice, Note $note, AccountService $service)
    {
        setlocale(LC_ALL, "es_ES");
        date_default_timezone_set('America/Caracas');

        $this->invoice = $invoice;
        $this->note = $note;
        $this->service = $service;
    }

    public function receivable(Request $request)
    {
        if ($request->filled('filter.filters')) {
            $invoices = InvoiceAccountSearch::apply($request, $this->invoice);
            $notes = NoteAccountSearch::apply($request, $this->note);
            return new AccountCollection(collect($invoices)->merge($notes)->paginate($request->take));
        }
        
        $invoices = InvoiceAccountSearch::checkSortFilter($request, $this->invoice->newQuery())->get();
        $notes = NoteAccountSearch::checkSortFilter($request, $this->note->newQuery())->get();
        $data = collect($invoices)->merge($notes);

        return new AccountCollection($data->paginate($request->take));
    }

    public function cancelled(Request $request)
    {
        if ($request->filled('filter.filters')) {
            $invoices = InvoiceAccountCancelledSearch::apply($request, $this->invoice);
            $notes = NoteAccountCancelledSearch::apply($request, $this->note);
            return new AccountCollection(collect($invoices)->merge($notes)->paginate($request->take));
        }
        
        $invoices = InvoiceAccountCancelledSearch::checkSortFilter($request, $this->invoice->newQuery())->get();
        $notes = NoteAccountCancelledSearch::checkSortFilter($request, $this->note->newQuery())->get();
        $data = collect($invoices)->merge($notes);

        return new AccountCollection($data->paginate($request->take));
    }

    public function closeAccount(Request $request)
    {
        try {
            $model = $this->types[$request->model]::find($request->type_id);
            $model->update([
                'cancelled' => 1,
                'closing_date' => date('Y-m-d')
            ]);
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }

    public function listReceivablePdf(Request $request)
    {
        return $this->service->manyPdfReceivableDownload($request);
    }

    public function listReceivableExcel(Request $request)
    {
        return $this->service->manyExcelReceivableDownload($request);
    }

    public function listCancelledPdf(Request $request)
    {
        return $this->service->manyPdfCancelledDownload($request);
    }

    public function listCancelledExcel(Request $request)
    {
        return $this->service->manyExcelCancelledDownload($request);
    }
}
