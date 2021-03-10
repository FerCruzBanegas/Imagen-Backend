<?php

namespace App\Services;

use App\Invoice;
use App\Note;
use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\AccountsExport;
use App\Transformers\AccountTransformer;

class AccountService
{
    protected $transformer;

    public function __construct(AccountTransformer $transformer) 
    {
        $this->transformer = $transformer;
    }

    public function manyPdfReceivableDownload(Request $request) 
    {
        if (empty($request->accounts)) {
            $invoices = Invoice::where('cancelled', 0)->get();
            $notes = Note::where('cancelled', 0)->get();
            $data = collect($invoices)->merge($notes);

            $accounts = $this->transformer->collection($data);
        } else {
            $invoices = Invoice::whereIn('id', $request->accounts)->get();
            $notes = Note::whereIn('id', $request->accounts)->get();
            $data = collect($invoices)->merge($notes);

            $accounts = $this->transformer->collection($data);
        }

        $export = new PdfExport('pdf.account-receivable-list', $accounts);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyPdfCancelledDownload(Request $request) 
    {
        if (empty($request->accounts)) {
            $invoices = Invoice::where('cancelled', 1)->get();
            $notes = Note::where('cancelled', 1)->get();
            $data = collect($invoices)->merge($notes);

            $accounts = $this->transformer->collection($data);
        } else {
            $invoices = Invoice::whereIn('id', $request->accounts)->get();
            $notes = Note::whereIn('id', $request->accounts)->get();
            $data = collect($invoices)->merge($notes);

            $accounts = $this->transformer->collection($data);
        }

        $export = new PdfExport('pdf.account-cancelled-list', $accounts);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelReceivableDownload(Request $request) 
    {
        if (empty($request->accounts)) {
            $invoices = Invoice::where('cancelled', 0)->get();
            $notes = Note::where('cancelled', 0)->get();
            $data = collect($invoices)->merge($notes);

            $accounts = $this->transformer->collection($data);
        } else {
            $invoices = Invoice::whereIn('id', $request->accounts)->get();
            $notes = Note::whereIn('id', $request->accounts)->get();
            $data = collect($invoices)->merge($notes);

            $accounts = $this->transformer->collection($data);
        }

        return (new AccountsExport($accounts))->download('accounts.xlsx');
    }

    public function manyExcelCancelledDownload(Request $request) 
    {
        if (empty($request->accounts)) {
            $invoices = Invoice::where('cancelled', 1)->get();
            $notes = Note::where('cancelled', 1)->get();
            $data = collect($invoices)->merge($notes);

            $accounts = $this->transformer->collection($data);
        } else {
            $invoices = Invoice::whereIn('id', $request->accounts)->get();
            $notes = Note::whereIn('id', $request->accounts)->get();
            $data = collect($invoices)->merge($notes);

            $accounts = $this->transformer->collection($data);
        }

        return (new AccountsExport($accounts))->download('accounts.xlsx');
    }
}
