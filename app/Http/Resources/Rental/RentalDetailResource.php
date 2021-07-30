<?php

namespace App\Http\Resources\Rental;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Billboard\BillboardDetailResource;
use App\Http\Resources\Customer\CustomerResource;
use App\Transformers\RentalTransformer;

class RentalDetailResource extends JsonResource
{
    public function toArray($request)
    {
        $transformer = new RentalTransformer();

        switch ($this->condition_id) {
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

        return [
            'id' => $this->id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'observation' => $this->observation,
            'illumination' => $this->illumination,
            'print' => $this->print,
            'amount_monthly' => $this->amount_monthly,
            'amount_total' => $this->amount_total,
            'condition' => ['title' => $condition],
            'state' => $this->state,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
            'user' => $this->user->name,
            'customer' => new CustomerResource($this->customer),
            'billboard' => new BillboardDetailResource($this->billboard),
            // 'renewal' => $transformer->collection($this->children),
            'renewal_count' => $this->children->count(),
        ];
    }
}
