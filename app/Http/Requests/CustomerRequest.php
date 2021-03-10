<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'business_name' => 'required|max:64|unique:customers,business_name',
            'address' => 'nullable|min:3|max:120',
            'nit' => 'required|max:32|unique:customers,nit',
            'phone' => 'required|max:32',
            'email' => 'nullable|max:64|email',
            'city_id' => 'required|integer'
        ];

        if($this->method() == 'PATCH' || $this->method() == 'PUT') {
            $rules['business_name'] .= ',' . $this->id;
            $rules['nit'] .= ',' . $this->id;
        }

        return $rules;
    }
}
