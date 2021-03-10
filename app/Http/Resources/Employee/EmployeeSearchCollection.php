<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeSearchCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($employee){
                return [
                    'id' => $employee->id,
                    'name' => $employee->name,
                ];
            }),
        ];
    }
}
