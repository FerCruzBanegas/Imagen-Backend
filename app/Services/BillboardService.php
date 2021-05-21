<?php

namespace App\Services;

use App\Billboard;
use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\BillboardsExport;
use App\Transformers\BillboardTransformer;

class BillboardService
{
    protected $transformer;

    public function __construct(BillboardTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function manyPdfDownload(Request $request) 
    {
        if (empty($request->billboard)) {
            $billboards = $this->transformer->collection(Billboard::desc()->get());
        } else {
            $billboards = $this->transformer->collection(Billboard::in($request->billboard)->get());
        }

        $export = new PdfExport('pdf.billboard-list', $billboards);
        return $export->options()->letter()->landscape()->download();
    }

    public function detailPdfDownload(Request $request) 
    {
        $billboards = $this->transformer->collection(Billboard::in($request->billboard)->get());

        $export = new PdfExport('pdf.billboard-photo', $billboards);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelDownload(Request $request) 
    {
        if (empty($request->billboard)) {
            $billboards = $this->transformer->collection(Billboard::desc()->get());
        } else {
            $billboards = $this->transformer->collection(Billboard::in($request->billboard)->get());
        }

        return (new BillboardsExport($billboards))->download('billboards.xlsx');
    }
}
