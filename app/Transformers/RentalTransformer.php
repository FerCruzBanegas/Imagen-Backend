<?php

namespace App\Transformers;

use Carbon\Carbon;

class RentalTransformer extends Transformer
{
    protected $resourceName = 'rentals';

    public function transform($data)
    {
        switch ($data['condition_id']) {
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

        $user = auth()->user();

        return [
            'id' => $data['id'],
            'date_start' => Carbon::parse($data['date_start'])->format('d/m/Y'),
            'date_end' => Carbon::parse($data['date_end'])->format('d/m/Y'),
            'observation' => $data['observation'],
            'illumination' => $data['illumination'],
            'print' => $data['print'],
            'amount_monthly' => number_format($data['amount_monthly'], 2, '.', ','),
            'amount_total' => number_format($data['amount_total'], 2, '.', ','),
            'condition' => $condition,
            'customer_name' =>  $data['customer']['business_name'],
            'billboard_code' => $data['billboard']['code'],
            'billboard_location' => $data['billboard']['location'],
        ];
    }
}