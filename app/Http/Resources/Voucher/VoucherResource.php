<?php

namespace App\Http\Resources\Voucher;

use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'starting_number' => $this->starting_number,
            'office' => [
                'name' => $this->office->city->name,
                'address' => explode(',', $this->office->detail),
            ]
        ];
    }
}
