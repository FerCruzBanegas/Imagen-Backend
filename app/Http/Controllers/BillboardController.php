<?php

namespace App\Http\Controllers;

use App\Billboard;
use Illuminate\Http\Request;
use App\Http\Requests\BillboardRequest;
use App\Filters\BillboardSearch\BillboardSearch;
use App\Http\Resources\Billboard\BillboardCollection;
use App\Services\BillboardService;

class BillboardController extends Controller
{
    private $billboard;
 
    private $service;

    public function __construct(Billboard $billboard, BillboardService $service)
    {
        $this->billboard = $billboard;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new BillboardCollection(BillboardSearch::apply($request, $this->billboard));
        }

        $billboards = BillboardSearch::checkSortFilter($request, $this->billboard->newQuery());

        return new BillboardCollection($billboards->paginate($request->take)); 
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Billboard $billboard)
    {
        //
    }

    public function update(Request $request, Billboard $billboard)
    {
        //
    }

    public function destroy(Billboard $billboard)
    {
        //
    }

    public function listPdf(Request $request)
    {
        return $this->service->manyPdfDownload($request);
    }

    public function detailPdf(Request $request)
    {
        return $this->service->detailPdfDownload($request);
    }
    
    public function listExcel(Request $request) 
    {
        return $this->service->manyExcelDownload($request);
    }
}
