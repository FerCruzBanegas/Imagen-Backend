<?php

namespace App\Http\Controllers;

use App\Billboard;
use App\Rental;
use Illuminate\Http\Request;
use App\Http\Requests\BillboardRequest;
use App\Filters\BillboardSearch\BillboardSearch;
use App\Http\Resources\Billboard\BillboardResource;
use App\Http\Resources\Billboard\BillboardDetailResource;
use App\Http\Resources\Billboard\BillboardRecordCollection;
use App\Http\Resources\Billboard\BillboardCollection;
use App\Services\BillboardService;
use Illuminate\Support\Facades\DB;

class BillboardController extends ApiController
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

    public function store(BillboardRequest $request)
    {
        DB::beginTransaction();

        try {
            $query = $this->billboard->orderBy('id', 'desc')->where('city_id', $request->city_id)->first();
            $ex = explode("-", $query->code);
            $num = (int)$ex[0] + 1;
            $code = $num.'-'.$ex[1];

            $billboard = $this->billboard->create([
                'code' => $code,
                'zone' => $request->zone,
                'location' => $request->location,
                'dimension' => $request->dimension,
                'price' => $request->price,
                'illumination' => $request->illumination,
                'city_id' => $request->city_id,
                'billboard_type_id' => $request->billboard_type_id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }

        return $this->respondCreated($billboard);
    }

    public function show(Billboard $billboard)
    {
        return new BillboardResource($billboard); 
    }

    public function detail(Billboard $billboard)
    {
        return new BillboardDetailResource($billboard); 
    }

    public function update(BillboardRequest $request, Billboard $billboard)
    {
        DB::beginTransaction();

        try {
            $billboard->update([
                'zone' => $request->zone,
                'location' => $request->location,
                'dimension' => $request->dimension,
                'price' => $request->price,
                'illumination' => $request->illumination,
                'city_id' => $request->city_id,
                'billboard_type_id' => $request->billboard_type_id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }

        return $this->respondUpdated($billboard);
    }

    public function destroy(Billboard $billboard)
    {
        try {
            $billboard->update([
                'state_id' => 0,
            ]);
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated(new BillboardDetailResource($billboard));
    }

    public function saveCustomerImage(Request $request, Billboard $billboard) 
    {
        DB::beginTransaction();
        try {
            if (is_null($billboard->img_customer)) {
                $image_name = $this->service->getNameFile($request->path);
                if ($this->service->saveFile($request->path, $image_name)) {
                    $billboard->fill(['img_customer' => $image_name])->save();
                }
            } else {
                if ($this->service->deleteFile($billboard->img_customer)) {
                    $image_name = $this->service->getNameFile($request->path);
                    if ($this->service->saveFile($request->path, $image_name)) {
                        $billboard->fill(['img_customer' => $image_name])->save();
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }
        return $this->respond(['path' => url('img/billboards') .'/'. $image_name]);
    }

    public function saveUserImage(Request $request, Billboard $billboard) 
    {
        DB::beginTransaction();
        
        try {
            if (is_null($billboard->img_user)) {
                $image_name = $this->service->getNameFile($request->path);
                if ($this->service->saveFile($request->path, $image_name)) {
                    $billboard->fill(['img_user' => $image_name])->save();
                }
            } else {
                if ($this->service->deleteFile($billboard->img_user)) {
                    $image_name = $this->service->getNameFile($request->path);
                    if ($this->service->saveFile($request->path, $image_name)) {
                        $billboard->fill(['img_user' => $image_name])->save();
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }
        return $this->respond(['path' => url('img/billboards') .'/'. $image_name]);
    }

    public function getRecordBillboard(Request $request)
    {
        $rentals = Rental::where(function ($query) use ($request){
            $query->where('billboard_id', $request->id);
            $query->whereNull('rental_id');
        })->orderBy('created_at', $request->sort)->paginate($request->per_page);
        return new BillboardRecordCollection($rentals);
    }

    public function getLastBillboard()
    {
        $billboard = $this->billboard->orderBy('id', 'desc')->first();
        if ($billboard) { 
            return new BillboardDetailResource($billboard); 
        } else {
            return $this->respondNoContent();
        }
    }

    public function presentationPdf(Request $request)
    {
        return $this->service->presentationPdfDownload($request);
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

    public function rentalsPdf(Request $request) 
    {
        return $this->service->manyRentalsPdfDownload($request);
    }

    public function rentalsExcel(Request $request) 
    {
        return $this->service->manyRentalsExcelDownload($request);
    }

    public function listing()
    {
        $billboards = $this->billboard->listBillboards()->where('state_id', 1)->get();
        return $this->respond($billboards);
    }
}
