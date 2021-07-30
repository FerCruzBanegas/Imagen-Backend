<?php

namespace App\Http\Resources\WorkOrder;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Task\TaskCollection;

class WorkOrderPendingCollection extends ResourceCollection
{
    private $params;

    public function __construct($collection, $params)
    {
        parent::__construct($collection);
        $this->collection = $collection;
        $this->params = $params;
    }

    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($workOrder){
                $end = Carbon::parse($workOrder->opening_date);
                return [
                    'id' => $workOrder->id,
                    'number' => str_pad($workOrder->number, 6, '0', STR_PAD_LEFT),
                    'state' => $workOrder->closing_date ? 'TERMINADO' : 'EN CURSO',
                    'opening_date' => $workOrder->opening_date,
                    'estimated_date' => $workOrder->estimated_date,
                    'closing_date' => $workOrder->closing_date,
                    'type_work' => $workOrder->type_work,
                    'note' => $workOrder->note,
                    'name_staff' => $workOrder->name_staff,
                    'address_work' => $workOrder->address_work,
                    'city_id' => $workOrder->city,
                    'office' => $workOrder->quotation->office->id == $this->params ? '#f2f4f8' : '#fff3f2',
                    'quotation' => [
                        'id' => $workOrder->quotation->id, 
                        'cite' => $workOrder->quotation->cite,
                        'attends' => $workOrder->quotation->attends,
                        'attends_phone' => $workOrder->quotation->attends_phone,
                        'installment' => $workOrder->quotation->installment,
                    ],
                    'employees' => $workOrder->employees->transform(function($employee){
                        return [
                            'id' => $employee->id,
                            'name' => $employee->name
                        ];
                    }),
                    'days' => $end->diffInDays(Carbon::now()),
                    'total_tasks' => $workOrder->tasks->count(),
                    'tasks_items' => new TaskCollection($workOrder->tasks),
                    'products' => $workOrder->quotation->products->transform(function($product){
                        return [
                            'id' => $product->id,
                            'item_id' => $product->pivot->id,
                            'name' => $product->name,
                            'quantity' => $product->pivot->quantity,
                            'dimension' => $product->pivot->dimension,
                            'state' => $product->pivot->state,
                            'design' => [
                                'id' => $product->pivot->design['id'],
                                'filename' => $product->pivot->design['filename'],
                                'quality' => is_null($product->pivot->design['quality']) ? $product->pivot->quality : $product->pivot->design['quality'],
                                'material' => is_null($product->pivot->design['material']) ? $product->pivot->material : $product->pivot->design['material'],
                                'cutting_dimension' => $product->pivot->design['cutting_dimension'],
                                'print_dimension' => $product->pivot->design['print_dimension'],
                                'finished' => is_null($product->pivot->design['finished']) ? $product->pivot->finish : $product->pivot->design['finished'],
                                'test_print' => $product->pivot->design['test_print'],
                                'quote_approved_date' => $product->pivot->design['quote_approved_date'],
                                'design_approved_date' => $product->pivot->design['design_approved_date'],
                                'reference' => $product->pivot->design['reference'],
                                'path' => url('img/designs').'/'.$product->pivot->design['path'],
                                'support_path' => is_null($product->pivot->design['support_path']) ? NULL : url('img/designs').'/'.$product->pivot->design['support_path'],
                                'machines' => is_null($product->pivot->design) ? NULL : $product->pivot->design->machines->map(function ($item) {
                                    return $item->description;
                                }),
                                'created' => $product->pivot->design['created_at'],
                                'updated' => $product->pivot->design['updated_at'],
                            ]
                        ];
                    }),   
                ];
            }),
        ];
    }
}
