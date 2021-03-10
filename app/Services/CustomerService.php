<?php

namespace App\Services;

use App\Customer;
use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\CustomersExport;
use App\Transformers\CustomerTransformer;

class CustomerService
{
    protected $transformer;

    public function __construct(CustomerTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function manyPdfDownload(Request $request) 
    {
        if (empty($request->customer)) {
            $customers = $this->transformer->collection(Customer::desc()->get());
        } else {
            $customers = $this->transformer->collection(Customer::in($request->customer)->get());
        }

        $export = new PdfExport('pdf.customer-list', $customers);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelDownload(Request $request) 
    {
        if (empty($request->customer)) {
            $customers = $this->transformer->collection(Customer::desc()->get());
        } else {
            $customers = $this->transformer->collection(Customer::in($request->customer)->get());
        }

        return (new CustomersExport($customers))->download('customers.xlsx');
    }
}
