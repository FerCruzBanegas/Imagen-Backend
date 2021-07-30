<?php

namespace App\Http\Controllers;

use App\WorkOrder;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\WorkOrderRequest;
use App\Http\Resources\WorkOrder\WorkOrderResource;
use App\Services\WorkOrderService;
use App\Filters\WorkOrderSearch\WorkOrderSearch;
use App\Http\Resources\WorkOrder\WorkOrderCollection;
use App\Http\Resources\WorkOrder\WorkOrderPendingCollection;
use Illuminate\Support\Facades\DB;

class WorkOrderController extends ApiController
{
    private $workOrder;
    protected $service;

    public function __construct(WorkOrder $workOrder, WorkOrderService $service)
    {
        $this->workOrder = $workOrder;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new WorkOrderCollection(WorkOrderSearch::apply($request, $this->workOrder));
        }

        $workOrders = WorkOrderSearch::checkSortFilter($request, $this->workOrder->newQuery());

        return new WorkOrderCollection($workOrders->paginate($request->take));
    }

    public function pending(Request $request)
    {
        $office = auth()->user()->office->id;

        $employees = Employee::where('office_id', $office)->pluck('id');

        $workOrders = DB::table('work_orders AS w')
        ->select('w.*')
        ->join('quotations AS q', 'w.quotation_id', '=', 'q.id')
        ->leftjoin('tasks AS t', function($join) {
            $join->on('w.id', 't.work_order_id')
            ->whereNull('w.closing_date');
        })
        ->whereNull('w.closing_date')
        ->where('q.office_id', $office)
        ->orWhereIn('t.employee_id', $employees)
        ->groupBy('w.id')
        ->orderBy('created_at', $request->sort)
        ->get();

        $data = collect(WorkOrder::hydrate($workOrders->toArray()))->paginate($request->per_page);

        return new WorkOrderPendingCollection($data, $office);
    }

    public function store(WorkOrderRequest $request)
    {
        try {
            $workOrder = $this->workOrder->create($request->all());
            $workOrder->employees()->attach($request->employees);
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondCreated(new WorkOrderResource($workOrder->refresh()));
    }

    public function update(WorkOrderRequest $request, WorkOrder $workOrder)
    {
        try {
            $workOrder->update($request->all());
            $workOrder->employees()->sync($request->employees);
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated(new WorkOrderResource($workOrder));
    }

    public function workOrderPdf(Request $request)
    {
        return $this->service->singlePdfDownload($request);
    }

    public function listPdf(Request $request)
    {
        return $this->service->manyPdfDownload($request);
    }

    public function listPendingPdf(Request $request)
    {
        return $this->service->manyPendingPdfDownload($request);
    }
    
    public function listExcel(Request $request) 
    {
        return $this->service->manyExcelDownload($request);
    }

    public function listPendingExcel(Request $request) 
    {
        return $this->service->manyPendingExcelDownload($request);
    }

    public function finishWorkOrder(WorkOrder $workOrder) 
    {
        try {
            $tasks = collect($workOrder->tasks)->filter(function ($value, $key) {
                return $value->completed === 0;
            });

            if($tasks->count()) {
                return $this->respond(message('MSG016'), 406);
            } else {
                $workOrder->update(['closing_date' => date("Y-m-d")]);
                $workOrder->quotation->update(['state_id' => 3]);
            }
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated(new WorkOrderResource($workOrder));
    }
}

