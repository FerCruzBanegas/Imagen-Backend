<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($employee){
                return [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'document' => $employee->document,
                    'num_document' => $employee->num_document,
                    'address' => $employee->address,
                    'phone' => $employee->phone,
                    'email' => $employee->email,
                    'office' => ['description' => $employee->office->description],
                    'created' => $employee->created_at,
                    'updated' => $employee->updated_at,
                    'work_orders' => collect($employee->work_orders)->transform(function($workOrder){
                        return [
                            'number' => $workOrder->number,
                            'opening_date' => $workOrder->opening_date,
                            'estimated_date' => $workOrder->estimated_date,
                            'cite' => $workOrder->quotation->cite,
                            'type_work' => $workOrder->type_work,
                        ];
                    }),
                ];
            }),
        ];
    }
}
