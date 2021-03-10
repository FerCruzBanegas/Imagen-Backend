<?php

namespace App\Http\Resources\Product;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    public function toArray($request)
    {
        $costs = collect($this->costs)->transform(function($cost){
            return [
                'id'=> $cost->id ,
                'tool'=> number_format((float)$cost->tool, 2, '.', ','),
                'admin_expense'=> $cost->admin_expense,
                'utility'=> $cost->utility,
                'tax'=> $cost->tax,
                // 'total_amount'=> $cost->total_amount,
                'price_without_tax'=> $cost->price_without_tax,
                'price_with_tax'=> $cost->price_with_tax,
                'normal_price'=> number_format((float)$cost->normal_price, 2, '.', ','),
                'volume_price'=> number_format((float)$cost->volume_price, 2, '.', ','),
                'office'=> strtoupper($cost->office->city->name),
                'office_id'=> $cost->office_id,
                'active'=> $cost->active,
                'created' => Carbon::parse($cost->created_at)->format('d/m/Y'),
                'materials' => collect($cost->materials)->transform(function($material){
                    return [
                        'id'=> $material->id,
                        'name'=> $material->name,
                        'unity'=> $material->unity,
                        'quantity' => $material->pivot->quantity,
                        'price' => $material->pivot->price,
                        'total' => $material->pivot->total,
                    ];
                }),
                'workers' => $cost->workers->transform(function($worker){
                    return [
                        'id'=> $worker->id,
                        'description'=> $worker->description,
                        'quantity'=> $worker->quantity,
                        'price' => $worker->price,
                        'total' => $worker->total,
                    ];
                }),
            ];
        });

        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'material' => $this->material,
            'quality' => $this->quality,
            'finish' => $this->finish,
            'dimension' => $this->dimension,
            'category' => $this->category->name,
            'costs' => $costs->sortByDesc('id')->groupBy('office'),
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
