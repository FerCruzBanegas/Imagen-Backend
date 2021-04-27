<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($user){
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'forename' => $user->forename,
                    'surname' => $user->surname,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'state' => ($user->state === 1) ? 'Activo' : 'Inactivo',
                    'office' => ['description' => $user->office->description],
                    'profile' => ['description' => $user->profile->description],
                    'created' => $user->created_at,
                    'updated' => $user->updated_at,
                    'quotations' => collect($user->quotations)->transform(function($quotation){
                        return [
                            'cite' => $quotation->cite,
                            'date' => $quotation->date,
                            'amount' => $quotation->amount,
                            'customer' => $quotation->customer->business_name,
                        ];
                    }),
                ];
            }),
        ];
    }
}
