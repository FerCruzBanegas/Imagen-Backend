<?php

namespace App\Http\Resources\Billboard;

use Illuminate\Http\Resources\Json\JsonResource;

class BillboardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'zone' => $this->zone,
            'location' => $this->location,
            'dimension' => $this->dimension,
            'price' => $this->price,
            'illumination' => $this->illumination,
            'city_id' => $this->city_id,
            'billboard_type_id' => $this->billboard_type_id,
        ];
    }
}
