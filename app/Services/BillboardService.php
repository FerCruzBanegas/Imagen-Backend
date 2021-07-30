<?php

namespace App\Services;

use App\Billboard;
use Illuminate\Http\Request;
use App\Services\ImageBillboardService;
use App\Exports\PdfExport;
use App\Exports\Excel\BillboardsExport;
use App\Transformers\BillboardTransformer;
use Illuminate\Support\Facades\DB;

class BillboardService extends ImageBillboardService
{
    protected $transformer;

    public function __construct(BillboardTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function presentationPdfDownload(Request $request) 
    {
        $query = Billboard::query();

        // $query->join('cities AS c', 'c.id', '=', 'billboards.city_id');
        // $query->join('billboard_types AS bt', 'bt.id', '=', 'billboards.billboard_type_id');

        $query->when($request->city != 0, function ($q) use ($request) {
            $q->where('city_id', $request->city);
        });
        
        $query->when($request->type == 2, function ($q) {
            return $q->where('state_id', 2);
        });

        $query->when($request->type == 3, function ($q) {
            return $q->where('state_id', 1);
        });

        $query->when($request->type == 4, function ($q) {
            return $q->where('state_id', 0);
        });

        $query->when($request->category == 'customers', function ($q) {
            return $q->select('billboards.*', DB::raw('img_customer AS customers'));
        });

        $query->when($request->category == 'users', function ($q) {
            return $q->select('billboards.*', DB::raw('img_user AS users'));
        });

        $billboards = $this->transformer->collection($query->get());
        
        $export = new PdfExport('pdf.billboard-photo', $billboards);
        return $export->options()->letter()->landscape()->download();
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

    public function manyRentalsPdfDownload(Request $request) 
    {   
        $billboard = Billboard::find($request->billboard);
        $export = new PdfExport('pdf.billboard-rentals', ['rentals' => $request->rentals, 'billboard' => $billboard]);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyRentalsExcelDownload(Request $request) 
    {
        if (empty($request->rental)) {
            $rentals = $this->transformer->collection(Rental::desc()->get());
        } else {
            $rentals = $this->transformer->collection(Rental::in($request->rental)->get());
        }

        return (new RentalsExport($rentals))->download('rentals.xlsx');
    }
}
