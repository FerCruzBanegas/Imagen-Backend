<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'material' => $this->material,
            'quality' => $this->quality,
            'finish' => $this->finish,
            'dimension' => $this->dimension,
            'category_id' => $this->category_id
        ];
    }
}
