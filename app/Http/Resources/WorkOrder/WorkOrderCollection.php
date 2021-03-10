<?php

namespace App\Http\Resources\WorkOrder;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Task\TaskCollection;

class WorkOrderCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($workOrder){
                return [
                    'id' => $workOrder->id,
                    'number' => str_pad($workOrder->number, 6, '0', STR_PAD_LEFT),
                    'opening_date' => $workOrder->opening_date,
                    'quotation' => ['id' => $workOrder->quotation->id, 'cite' => $workOrder->quotation->cite],
                    'state' => $workOrder->closing_date ? 'TERMINADO' : 'EN CURSO',
                    'tasks' => $workOrder->tasks->count(),
                    'tasks_items' => new TaskCollection($workOrder->tasks),
                    // 'employee' => ['name' => $workOrder->employee->name],
                ];
            }),
        ];
    }
}
