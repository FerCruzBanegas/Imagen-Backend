<?php

namespace App\Http\Resources\License;

use Illuminate\Http\Resources\Json\JsonResource;

class LicenseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nit' => $this->nit,
            'authorization' => $this->authorization,
            'starting_number' => $this->starting_number,
            'activity' => $this->activity,
            'office' => [
                'name' => $this->office->description,
                'city' => $this->office->city->name,
                'address' => explode(',', $this->office->detail),
            ]
        ];
    }
}
