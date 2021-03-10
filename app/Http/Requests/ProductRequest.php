<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'code' => 'required|max:16|unique:products,code',
            'name' => 'required|min:3|max:120',
            'description' => 'nullable|max:100',
            'material' => 'nullable|max:512',
            'quality' => 'nullable|max:128',
            'finish' => 'nullable|max:512',
            'dimension' => 'required|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'category_id' => 'required|integer'
        ];

        if($this->method() == 'PATCH' || $this->method() == 'PUT') {
            $rules['code'] .= ',' . $this->id;
        }

        return $rules;
    }
}
