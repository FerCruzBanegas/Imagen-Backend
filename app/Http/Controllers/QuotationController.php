<?php

namespace App\Http\Controllers;

use App\Quotation;
use Illuminate\Http\Request;
use App\Http\Requests\QuotationRequest;
use App\Filters\QuotationSearch\Searches\QuotationsFilter;
use App\Filters\QuotationSearch\QuotationSearch;
use App\Filters\QuotationSearch\PendingSearch;
use App\Filters\QuotationSearch\ApprovedSearch;
use App\Filters\QuotationSearch\ExecutedSearch;
use App\Filters\QuotationSearch\ReceivableSearch;
use App\Filters\QuotationSearch\CanceledSearch;
use App\Http\Resources\Quotation\QuotationResource;
use App\Http\Resources\Quotation\QuotationProductResource;
use App\Http\Resources\Quotation\QuotationCollection;
use App\Http\Resources\Quotation\QuotationReceivableCollection;
use App\Services\QuotationService;
use Illuminate\Support\Facades\DB;

class QuotationController extends ApiController
{
    protected $quotation;
    protected $service;

    public function __construct(Quotation $quotation, QuotationService $service)
    {
        $this->quotation = $quotation;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new QuotationCollection(QuotationSearch::apply($request, $this->quotation));
        }

        $quotations = QuotationSearch::checkSortFilter($request, $this->quotation->newQuery());

        return new QuotationCollection($quotations->paginate($request->take)); 
    }

    public function pending(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new QuotationCollection(PendingSearch::apply($request, $this->quotation));
        }

        $quotations = PendingSearch::checkSortFilter($request, $this->quotation->newQuery());

        return new QuotationCollection($quotations->paginate($request->take));
    }

    public function approved(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new QuotationCollection(ApprovedSearch::apply($request, $this->quotation));
        }

        $quotations = ApprovedSearch::checkSortFilter($request, $this->quotation->newQuery());

        return new QuotationCollection($quotations->paginate($request->take));
    }

    public function executed(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new QuotationCollection(ExecutedSearch::apply($request, $this->quotation));
        }

        $quotations = ExecutedSearch::checkSortFilter($request, $this->quotation->newQuery());

        return new QuotationCollection($quotations->paginate($request->take));
    }

    public function receivable(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new QuotationReceivableCollection(ReceivableSearch::apply($request, $this->quotation));
        }

        $quotations = ReceivableSearch::checkSortFilter($request, $this->quotation->newQuery());

        return new QuotationReceivableCollection($quotations->paginate($request->take));
    }

    public function canceled(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new QuotationReceivableCollection(CanceledSearch::apply($request, $this->quotation));
        }

        $quotations = CanceledSearch::checkSortFilter($request, $this->quotation->newQuery());

        return new QuotationReceivableCollection($quotations->paginate($request->take));
    }

    public function store(QuotationRequest $request)
    {
        DB::beginTransaction();
        try {
            $quotation = $this->quotation->create([
                'cite' => '',
                'attends' => $request->quotation['attends'],
                'attends_phone' => $request->quotation['attends_phone'],
                'installment' => $request->quotation['installment'],
                'date' => $request->quotation['date'],
                'amount' => $request->quotation['amount'],
                'discount' => $request->quotation['discount'],
                'term' => $request->quotation['term'],
                'payment' => $request->quotation['payment'],
                'validity' => $request->quotation['validity'],
                'note' => $request->quotation['note'],
                'customer_id' => $request->quotation['customer_id']['id'],
                'user_id' => $request->quotation['user_id'],
                'office_id' => $request->quotation['office_id'],
            ]);

            foreach ($request->products as $key => $value) {
                $quotation->products()->attach($value['id'], [
                    'uuid' => $value['uuid'], 
                    'quantity' => $value['quantity'], 
                    'dimension' => $value['dimension'], 
                    'description' => $value['description'], 
                    //agreado nuevo
                    'material' => $value['materialCheck'] ? $value['material'] : NULL,
                    'quality' => $value['qualityCheck'] ? $value['quality'] : NULL,
                    'finish' => $value['finishCheck'] ? $value['finish'] : NULL,
                    'materialCheck' => $value['materialCheck'],
                    'qualityCheck' => $value['qualityCheck'],
                    'finishCheck' => $value['finishCheck'],
                    //aqui
                    'price' => $value['price'], 
                    'subtotal' => $value['subtotal'],
                    'price_type' => $value['price_type'],
                    'type' => $value['type'],
                    'unit' => $value['unit'],
                    'cooldown' => $value['cooldown'],
                ]);
            }

            $this->service->syncImagesQuotation($quotation, $request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }

        return $this->respondCreated($quotation->refresh());
        // return $request->products;
    }

    public function update(Quotation $quotation, QuotationRequest $request)
    {
        DB::beginTransaction();
        try {
            $quotation->update([
                'attends' => $request->quotation['attends'],
                'attends_phone' => $request->quotation['attends_phone'],
                'installment' => $request->quotation['installment'],
                'date' => $request->quotation['date'],
                'amount' => $request->quotation['amount'],
                'discount' => $request->quotation['discount'],
                'term' => $request->quotation['term'],
                'payment' => $request->quotation['payment'],
                'validity' => $request->quotation['validity'],
                'note' => $request->quotation['note'],
                'customer_id' => $request->quotation['customer_id']['id'],
                'office_id' => $request->quotation['office_id'],
            ]);

            if (!$this->service->checkDataChange($quotation, $request)) {
                $quotation->products()->detach();
                foreach ($request->products as $key => $value) {
                    $quotation->products()->attach($value['id'], [
                        'uuid' => $value['uuid'], 
                        'quantity' => $value['quantity'], 
                        'dimension' => $value['dimension'], 
                        'description' => $value['description'],
                        //agreado nuevo
                        'material' => $value['materialCheck'] ? $value['material'] : NULL,
                        'quality' => $value['qualityCheck'] ? $value['quality'] : NULL,
                        'finish' => $value['finishCheck'] ? $value['finish'] : NULL,
                        'materialCheck' => $value['materialCheck'],
                        'qualityCheck' => $value['qualityCheck'],
                        'finishCheck' => $value['finishCheck'],
                        //aqui 
                        'price' => $value['price'], 
                        'subtotal' => $value['subtotal'],
                        'price_type' => $value['price_type'],
                        'type' => $value['type'],
                        'unit' => $value['unit'],
                        'cooldown' => $value['cooldown'],
                    ]);
                }

                $this->service->syncImagesQuotation($quotation->refresh(), $request);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->respondInternalError();
        }
        // devolver nuevas imagenes para no activar actualizacion
        return $this->respondUpdated($quotation->refresh());
        // return $request->products;
    }

    public function show(Quotation $quotation)
    {
        return new QuotationResource($quotation);
    }

    public function getProductsQuotation(Quotation $quotation)
    {
        return new QuotationProductResource($quotation);
    }

    public function destroy(Request $request)
    {
        try {
            $data = [];
            $quotations = $this->quotation->find($request->quotations);
            foreach ($quotations as $quotation) {
                if ($quotation->state_id === 1) {
                    $quotation->forceDelete();
                    $this->service->deleteImagesProduct();
                } else {
                    $data[] = $quotation;
                }
            }
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondDeleted($data);
    }

    public function quotationPdf(Quotation $quotation)
    {
        return $this->service->singlePdfDownload($quotation);
    }

    public function listPdf(Request $request)
    {
        return $this->service->manyPdfDownload($request);
    }
    
    public function listExcel(Request $request) 
    {
        return $this->service->manyExcelDownload($request);
    }

    public function approvedQuotation(Quotation $quotation) 
    {
        try {
            $quotation->update(['state_id' => 2]);
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated();
    }

    public function search(QuotationsFilter $filters)
    {
        $quotations = $this->quotation->filter($filters)->orderBy('id', 'DESC')->take(10)->get();
        return $this->respond($quotations);
    }
}
