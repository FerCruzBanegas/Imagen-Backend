<?php

namespace App\Http\Resources\Rental;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RentalRenovationsCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return collect($this->collection)->transform(function($rental) {
            return [
                'id' => $rental->id,
                'date_start' => $rental->date_start,
                'date_end' => $rental->date_end,
                'amount_monthly' => $rental->amount_monthly,
                'amount_total' => $rental->amount_total,
                'customer' => $rental->customer->business_name,
                'condition' => $this->getCondition($rental->condition_id),
            ];
        });
    }

    public function getCondition($condition)
    {
        switch ($condition) {
            case 0:
              $condition = "Terminado";
              break;
            case 1:
              $condition = "Activo";
              break;
            case 2:
              $condition = "Renovado";
              break;
            default:
              $condition = "Terminado";
        };

        return $condition;
    }
}
