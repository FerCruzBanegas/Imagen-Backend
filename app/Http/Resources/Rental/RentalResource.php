<?php

namespace App\Http\Resources\Rental;

use Illuminate\Http\Resources\Json\JsonResource;

class RentalResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'observation' => $this->observation,
            'illumination' => $this->illumination,
            'print' => $this->print,
            'amount_monthly' => $this->amount_monthly,
            'amount_total' => $this->amount_total,
            'customer_id' => $this->customer_id,
            'billboard_id' => $this->billboard_id,
            'user_id' => $this->user_id,
            'rental_id' => $this->rental_id,
            'quotation_id' => $this->quotation_id
        ];
    }
}
