<?php

namespace App\Http\Resources\Rental;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Rental\RentalDetailResource;

class RentalCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($rental){
                return new RentalDetailResource($rental);
            }),
        ];
    }
}
