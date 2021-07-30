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
            'location' => 'required|min:5|max:128',
            'dimension' => 'required|min:5|max:32',
            'price' => 'required|max:15|regex:/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/',
            'illumination' => 'required|integer',
            'city_id' => 'required|integer',
            'billboard_type_id' => 'required|integer',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'zone' => 'zona',
            'billboard_type_id' => 'tipo',
            'illumination' => 'illuminación',
        ];
    }
}
