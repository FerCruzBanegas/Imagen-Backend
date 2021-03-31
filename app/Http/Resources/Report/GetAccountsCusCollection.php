<?php

namespace App\Http\Resources\Report;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GetAccountsCusCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($item){
                return [
                    'id' => $item->id,
                    'date' => $item->date,
                    'type' => $item->type,
                    'number' => $item->number,
                    'summary' => $item->summary,
                    'total' => $item->total,
                    'payments' => $item->payments,
                ];
            }),
        ];
    }
}
