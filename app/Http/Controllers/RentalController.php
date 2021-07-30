<?php

namespace App\Http\Controllers;

use App\Rental;
use App\Printing;
use App\Campaign;
use Illuminate\Http\Request;
use App\Http\Requests\RentalRequest;
use App\Filters\RentalSearch\RentalSearch;
use App\Http\Resources\Rental\RentalResource;
use App\Http\Resources\Rental\RentalDetailResource;
use App\Http\Resources\Rental\RentalCollection;
use App\Http\Resources\Rental\RentalRenovationsCollection;
use App\Services\RentalService;
use Illuminate\Support\Facades\DB;

class RentalController extends ApiController
{
    private $rental;

    private $service;

    public function __construct(Rental $rental, RentalService $service)
    {
        $this->rental = $rental;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new RentalCollection(RentalSearch::apply($request, $this->rental));
        }

        $rentals = RentalSearch::checkSortFilter($request, $this->rental->newQuery());

        return new RentalCollection($rentals->paginate($request->take)); 
    }

    public function store(RentalRequest $request)
    {
        DB::beginTransaction();
        try {
            $rental = $this->rental->create([
                'date_start' => $request->rental['date_start'],
                'date_end' => $request->rental['date_end'],
                'observation' => $request->rental['observation'],
                'illumination' => $request->rental['illumination'],
                'print' => $request->rental['print'],
                'amount_monthly' => $request->rental['amount_monthly'],
                'amount_total' => $request->rental['amount_total'],
                'customer_id' => $request->rental['customer_id'],
                'billboard_id' => $request->rental['billboard_id'],
                'user_id' => $request->rental['user_id'],
                // 'rental_id' => $request->rental['rental_id'],
                // 'quotation_id' => $request->rental['quotation_id'],
            ]);

            if ($request->rental['print'] == 'SI') {
                $printing = Printing::create([
                    'meter_price' => $request->print['meter_price'],
                    'amount' => $request->print['amount'],
                    'rental_id' => $rental->id,
                ]);

                if ($request->campaign['is_campaign']) {
                    $campaign = Campaign::create([
                        'name' => $request->campaign['name'],
                        'date_start' => $rental->date_start,
                        'date_end' => $rental->date_end,
                        'note' => $request->campaign['note'],
                        'rental_id' => $rental->id,
                    ]);

                    $printing->campaign_id = $campaign->id;
                    $printing->save();
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }
        return $this->respondCreated($rental);
    }

    public function show(Rental $rental)
    {
        return new RentalResource($rental); 
    }

    public function detail(Rental $rental)
    {
        return new RentalDetailResource($rental); 
    }

    public function update(Request $request, Rental $rental)
    {
        //
    }

    public function destroy(Rental $rental)
    {
        //
    }

    public function getRenovations(Request $request)
    {
        $rentals = $this->rental->renovations($request->id, $request->sort)->paginate($request->per_page);
        return new RentalRenovationsCollection($rentals);
    }

    public function getLastRental()
    {
        $rental = $this->rental->where('condition_id', 1)->orderBy('id', 'desc')->first();
        if ($rental) { 
            return new RentalDetailResource($rental); 
        } else {
            return $this->respondNoContent();
        }
    }

    public function listPdf(Request $request)
    {
        return $this->service->manyPdfDownload($request);
    }

    public function pdfListRenovations(Request $request)
    {
        return $this->service->pdfListRenovations($request);
    }

    public function detailPdf(Request $request)
    {
        return $this->service->detailPdfDownload($request);
    }
    
    public function listExcel(Request $request) 
    {
        return $this->service->manyExcelDownload($request);
    }

    public function excelListRenovations(Request $request) 
    {
        return $this->service->excelListRenovations($request);
    }
}
