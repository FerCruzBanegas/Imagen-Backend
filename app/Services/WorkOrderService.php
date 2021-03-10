<?php

namespace App\Services;

use App\WorkOrder;
use Illuminate\Http\Request;
use App\Exports\PdfExport;
use App\Exports\Excel\WorkOrdersExport;
use App\Transformers\WorkOrderTransformer;

class WorkOrderService
{
	protected $transformer;

    public function __construct(WorkOrderTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function singlePdfDownload(Request $request) 
    {
        $export = new PdfExport('pdf.workorder', ['workorder' => $request->workOrder]);
        return $export->options()->letter()->download();
    }

    public function manyPdfDownload(Request $request) 
    {
        if (empty($request->workOrder)) {
            $workOrders = $this->transformer->collection(WorkOrder::desc()->checklist()->get());
        } else {
            $workOrders = $this->transformer->collection(WorkOrder::in($request->workOrder)->checklist()->get());
        }

        $export = new PdfExport('pdf.workorder-list', $workOrders);
        return $export->options()->letter()->landscape()->download();
    }

    public function manyExcelDownload(Request $request) 
    {
        if (empty($request->workOrder)) {
            $workOrders = $this->transformer->collection(WorkOrder::desc()->checklist()->get());
        } else {
            $workOrders = $this->transformer->collection(WorkOrder::in($request->workOrder)->checklist()->get());
        }

        return (new WorkOrdersExport($workOrders))->download('workorders.xlsx');
    }
}
