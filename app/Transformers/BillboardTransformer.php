<?php

namespace App\Transformers;

class BillboardTransformer extends Transformer
{
    protected $resourceName = 'billboard';

    public function transform($data)
    {
        switch ($data['state_id']) {
            case 0:
              $state = "No Disponible";
              break;
            case 1:
              $state = "Disponible";
              break;
            case 2:
              $state = "Ocupado";
              break;
            default:
              $state = "No Disponible";
        };

        $user = auth()->user();

        return [
            'code' => $data['code'],
            'zone' => $data['zone'],
            'location' => $data['location'],
            'dimension'    => $data['dimension'],
            'price' => $data['price'],
            'illumination' => ($data['illumination']) ? 'SI' : 'NO',
            'state' => $state,
            'city' => $data['city']['name'],
            'type' => $data['billboard_type']['description'],
            'user' => [
                'forename' => $user->forename,
                'surname' => $user->surname,
                'email' => $user->email,
                'phone' => $user->phone,
            ],
            'office' => [
                'address' => $user->office->address,
                'detail' => explode(',', $user->office->detail),
                'phone_one' => $user->office->phone_one,
                'phone_two' => $user->office->phone_two,
                'city' => $user->office->city->name,
            ],
        ];
    }
}