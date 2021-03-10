<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'opening_date' => 'required|date_format:Y-m-d',
            'estimated_date' => 'required|date_format:Y-m-d',
            'closing_date' => 'nullable|date_format:Y-m-d',
            'type_work' => 'required|max:64',
            'note' => 'nullable|min:5|max:120',
            'quotation_id' => 'required|integer',
            'employees' => 'required|array',
            'employees.*' => 'integer',
        ];
        
        if($this->input('installation')) {
            $rules['city_id'] = 'required|integer';
            $rules['name_staff'] = 'nullable|max:64';
            $rules['address_work'] = 'nullable|max:64';  
        }

        return $rules;
    }
}
