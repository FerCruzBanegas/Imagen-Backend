<?php

namespace App\Http\Resources\Billboard;

use Illuminate\Http\Resources\Json\JsonResource;

class BillboardDetailResource extends JsonResource
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
            'zone' => $this->zone,
            'location' => $this->location,
            'dimension' => $this->dimension,
            'price' => $this->price,
            'illumination' => $this->illumination ? 'SI' : 'NO',
            'state' => ['title' => $state],
            'imgs' => [
                'img_customer' => [
                    'name' => $this->img_customer,
                    'src' => is_null($this->img_customer) ? url('img/') .'/no-image.jpg' : url('img/billboards') .'/'. $this->img_customer
                ],
                'img_user' => [
                    'name' => $this->img_user,
                    'src' => is_null($this->img_user) ? url('img/') .'/no-image.jpg' : url('img/billboards') .'/'. $this->img_user
                ],
            ],
            'city' => ['name' => $this->city->name],
            'billboard_type' => ['description' => $this->billboard_type->description],
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
