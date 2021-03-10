<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'document' => $this->document,
            'num_document' => $this->num_document,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'office' => ['id' => $this->office->id, 'description' => $this->office->description]
        ];
    }
}
