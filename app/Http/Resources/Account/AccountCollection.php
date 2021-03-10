<?php

namespace App\Http\Resources\Account;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Payment\PaymentCollection;

class AccountCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($account){
                $amount_pay = $account->payments->sum('amount');
                return [
                    'id' => $account->id,
                    'cite' => $account->quotation->cite,
                    'number' => str_pad($account->number, 8, '0', STR_PAD_LEFT),
                    'type' => $account->type,
                    'amount' => number_format($account->total, 2, '.', ','),
                    'closing_date' => $account->closing_date,
                    // 'condition' => $account->condition,
                    // 'state' => ['title' => $account->state->title],
                    'customer' => ['business_name' => $account->customer->business_name],
                    'customer_data' => new CustomerResource($account->customer),
                    'user' => ['name' => $account->user->name],
                    'payments' => new PaymentCollection($account->payments),
                    // 'voucher' => $account->condition,
                    'amount_paid' => number_format($amount_pay, 2, '.', ','),
                    'balance' => number_format($account->total - $amount_pay, 2, '.', ','),
                    'quotation_data' => [
                        'office' => $account->quotation->office->city->name,
                        'discount' => $account->quotation->discount,
                        'created' => $account->quotation->created_at,
                        'updated' => $account->quotation->updated_at,
                        'products' => collect($account->quotation->products)->transform(function($product){
                            return [
                                'id' => $product->id,
                                'item_id' => $product->pivot->id,
                                'uuid' => $product->pivot->uuid,
                                'name' => $product->name,
                                'quantity' => $product->pivot->quantity,
                                'dimension' => $product->pivot->dimension,
                                'description' => $product->pivot->description,
                                'material' => is_null($product->pivot->material) ? $product->material : $product->pivot->material,
                                'quality' => is_null($product->pivot->quality) ? $product->quality : $product->pivot->quality,
                                'finish' => is_null($product->pivot->finish) ? $product->finish : $product->pivot->finish,
                                'materialCheck' => $product->pivot->materialCheck === 1 ? true : false,
                                'qualityCheck' => $product->pivot->qualityCheck === 1 ? true : false,
                                'finishCheck' => $product->pivot->finishCheck === 1 ? true : false,
                                'price' => number_format((float)$product->pivot->price, 2, '.', ''),
                                'subtotal' => number_format((float)$product->pivot->subtotal, 2, '.', ''),
                            ];
                        })->sortBy('item_id')->values()->all(),
                    ]
                ];
            })->values()->toArray(),
        ];
    }
}
