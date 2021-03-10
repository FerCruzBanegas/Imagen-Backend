<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'cost.tool' => 'required|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'cost.admin_expense' => 'required|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'cost.utility' => 'required|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'cost.tax' => 'required|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'cost.total_amount' => 'required|max:13|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'cost.price_without_tax' => 'required|max:11|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'cost.price_with_tax' => 'required|max:11|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'cost.normal_price' => 'required|max:11|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'cost.volume_price' => 'required|max:11|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'cost.product_id' => 'required|integer',
            'cost.office_id' => 'required|integer',
        ];

        return $rules;
    }

    public function attributes()
    {
        //aumentar nombres de validacion
        return [
            'cost.office_id' => 'sucursal',
        ];
    }
}
