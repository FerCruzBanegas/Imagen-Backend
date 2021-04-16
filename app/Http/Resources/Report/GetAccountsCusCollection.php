<?php

namespace App\Http\Resources\Report;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Payment\PaymentAccountCollection;

class GetAccountsCusCollection extends ResourceCollection
{
    public static $wrap = null;
    
    public function toArray($request)
    {
        return $this->collection->transform(function($item){
            return [
                'id' => $item->id,
                'date' => $item->date,
                'type' => $item->type,
                'number' => $item->number,
                'summary' => $item->summary,
                'total' => $item->total,
                'payments' => new PaymentAccountCollection($item->payments),
            ];
        });
    }
}
