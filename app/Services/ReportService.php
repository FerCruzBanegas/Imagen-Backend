<?php

namespace App\Services;

// use App\Product;
use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\ReportsExport;
// use App\Transformers\ProductTransformer;

class ReportService
{
    // protected $transformer;

    // public function __construct(ProductTransformer $transformer)
    // {
    //     $this->transformer = $transformer;
    // }

    public function manyPdfDownload(Request $request) 
    {
        // if (empty($request->product)) {
        //     $products = $this->transformer->collection(Product::desc()->get());
        // } else {
        //     $products = $this->transformer->collection(Product::in($request->product)->get());
        // }

        $data = [
            'title' => $request->title,
            'items' => $request->data,
            'columns' => array_keys($request->data[0])
        ];

        $export = new PdfExport('pdf.report-list', $data);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelDownload(Request $request) 
    {
        // if (empty($request->product)) {
        //     $products = $this->transformer->collection(Product::desc()->get());
        // } else {
        //     $products = $this->transformer->collection(Product::in($request->product)->get());
        // }

        return (new ReportsExport($request->data))->download('reporte.xlsx');
    }
}
