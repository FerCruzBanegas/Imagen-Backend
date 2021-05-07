<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillboardRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'zone' => 'required|min:5|max:64',
            'location' => 'required|min:8|max:16',
            'dimension' => 'required|min:5|max:64',
            'price' => 'required|date_format:Y-m-d',
            'illumination' => 'required|max:13|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'city_id' => 'required',
            'billboard_type_id' => 'required|integer',
        ];

        return $rules;
    }
}
