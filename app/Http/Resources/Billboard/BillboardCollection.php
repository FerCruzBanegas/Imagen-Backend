<?php

namespace App\Http\Resources\Billboard;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Billboard\BillboardResource;

class BillboardCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($billboard){
                return new BillboardResource($billboard);
            }),
        ];
    }
}
