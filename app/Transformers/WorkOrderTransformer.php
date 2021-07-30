<?php

namespace App\Transformers;
use Carbon\Carbon;

class WorkOrderTransformer extends Transformer
{
    protected $resourceName = 'workOrder';

    public function transform($data)
    {
        $list = [
            'number' => str_pad($data['number'], 6, '0', STR_PAD_LEFT),
            'cite' => $data['quotation']['cite'], 
            'opening_date' => Carbon::parse($data['opening_date'])->format('d/m/Y'),
            'estimated_date' => Carbon::parse($data['estimated_date'])->format('d/m/Y'),
            'closing_date' => is_null($data['closing_date']) ? 'PENDIENTE' : Carbon::parse($data['closing_date'])->format('d/m/Y'),
            'type_work' => $data['type_work'],
            'employees' => $data['employees'],
        ];

        return $list;
    }

    public function listTransform($data)
    {
        $list = [
            'number' => str_pad($data['number'], 6, '0', STR_PAD_LEFT),
            'cite' => $data['quotation']['cite'],
            'opening_date' => Carbon::parse($data['opening_date'])->format('d/m/Y'),
            'estimated_date' => Carbon::parse($data['estimated_date'])->format('d/m/Y'),
            'closing_date' => is_null($data['closing_date']) ? 'PENDIENTE' : Carbon::parse($data['closing_date'])->format('d/m/Y'),
            'type_work' => $data['type_work'],
            'employees' => collect($data['employees'])->implode('name', ', '),
        ];

        return $list;
    }
}