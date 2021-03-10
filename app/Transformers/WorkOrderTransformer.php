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
            'opening_date' => $data['opening_date'],
            'estimated_date' => $data['estimated_date'],
            'closing_date' => $data['closing_date'],
            'type_work' => $data['type_work'],
            'employee' => $data['employee']['name'],
        ];

        // if($data['city_id']) {
        //     $list['city'] = $data['city']['name'];
        //     $list['name_staff'] = $data['name_staff'];
        //     $list['address_work'] = $data['address_work'];
        // }

        return $list;
    }
}