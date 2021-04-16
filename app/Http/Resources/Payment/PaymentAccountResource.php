<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentAccountResource extends JsonResource
{
    public function toArray($request)
    {
        $bool = (!is_null($this->op) && !is_null($this->number)) ? ' - ' : ' ';
        return [
            'id' => $this->id,
            'date' => $this->date,
            'type' => $this->type,
            'code' => $this->op .$bool. $this->number,
            'op' => $this->op,
            'number' => $this->number,
            'summary' => 'Pagado en '. $this->type . ' F-' . $this->paymentable->number,
            'amount' => $this->amount,
        ];
    }
}
