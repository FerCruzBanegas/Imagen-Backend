<?php

namespace App\Http\Resources\Billboard;

use Illuminate\Http\Resources\Json\JsonResource;

class BillboardResource extends JsonResource
{
    public function toArray($request)
    {
        switch ($this->state_id) {
            case 0:
              $state = "No Disponible";
              break;
            case 1:
              $state = "Disponible";
              break;
            case 2:
              $state = "Ocupado";
              break;
            default:
              $state = "No Disponible";
        };

        return [
            'id' => $this->id,
            'code' => $this->code,
            'location' => $this->location,
            'state' => ['title' => $state],
            'city' => ['name' => $this->city->name],
            'billboard_type' => ['description' => $this->billboard_type->description],
        ];
    }
}
