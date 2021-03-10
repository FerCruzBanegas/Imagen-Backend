<?php

namespace App\Http\Resources\WorkOrder;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Task\TaskCollection;

class WorkOrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'opening_date' => $this->opening_date,
            'estimated_date' => $this->estimated_date,
            'closing_date' => $this->closing_date,
            'type_work' => $this->type_work,
            'note' => $this->note,
            'name_staff' => $this->name_staff,
            'address_work' => $this->address_work,
            'quotation_id' => $this->quotation_id,
            'employees' => $this->employees,
            'city_id' => $this->city,
            'tasks' => new TaskCollection($this->tasks),
        ];
    }
}
