<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\License;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Services\InvoiceService;
use App\Filters\InvoiceSearch\InvoiceSearch;
use App\Http\Resources\Invoice\InvoiceCollection;
use Illuminate\Support\Facades\DB;

class InvoiceController extends ApiController
{
    private $invoice;
    protected $service;

    public function __construct(Invoice $invoice, InvoiceService $service)
    {
        setlocale(LC_ALL, "es_ES");
        date_default_timezone_set('America/Caracas');

        $this->invoice = $invoice;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new InvoiceCollection(InvoiceSearch::apply($request, $this->invoice));
        }

        $invoices = InvoiceSearch::checkSortFilter($request, $this->invoice->newQuery());

        return new InvoiceCollection($invoices->paginate($request->take)); 
    }

    public function store(InvoiceRequest $request)
    {
        DB::beginTransaction();
        try {
            $date = \DateTime::createFromFormat('Y-m-d', $request->invoice['date']);
            $license = License::dosage($request->invoice['office_id']);
            $date_now = new \DateTime('now');
            if($license->status_date === 0 && $date_now->format('Y-m-d H:i:s') > $license->deadline){
                return $this->respond(message('MSG014'), 406);
            }

            $controlCode = $this->service->makeControlCode($license->authorization, $license->starting_number, $request->invoice['nit'], date('Y/m/d', strtotime($request->invoice['date'])), round($request->invoice['total']), $license->key);

            $invoice = $this->invoice->create([
                'date' => $date->format('Y-m-d H:i:s'),
                'number' => $license->starting_number,
                'control_code' => $controlCode,
                'total' => $request->invoice['total'],
                'nit_name' => $request->invoice['nit_name'],
                'nit' => $request->invoice['nit'],
                'title' => rtrim($request->invoice['title'], ':'),
                'footer' => $request->invoice['footer'],
                // 'oc' => $request->invoice['oc'],
                // 'hea' => $request->invoice['hea'],
                'details' => $request->invoice['details'],
                'license_id' => $license->id,
                'customer_id' => $request->invoice['customer_id']['id'],
                'user_id' => $request->invoice['user_id'],
                'quotation_id' => $request->invoice['quotation_id'],
            ]);

            foreach ($request->products as $key => $value) {
                $invoice->products()->attach($value['id'], [
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
        return $this->respondCreated($invoice);
    }

    public function update(Invoice $invoice, InvoiceUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $invoice->update([
                'title' => rtrim($request->title, ':'),
                'footer' => $request->footer,
                'details' => $request->details,
            ]);
            
            $products = array();
            foreach ($request->products as $key => $value) {
                $products[$value['id']] = ['description' => $value['description']];
            }
            $invoice->products()->sync($products);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }

    public function invoicePdf(Invoice $invoice, Request $request)
    {
        return $this->service->singlePdfDownload($invoice, $request);
    }

    public function cancelInvoice(Invoice $invoice) 
    {
        try {
            if($invoice->state_id === 0)
            {
                return $this->respondAnuled();
            } else {
                $invoice->update(['state_id' => 0]);
            }
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
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
