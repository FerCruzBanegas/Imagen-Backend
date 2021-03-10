<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'description' => 'required|min:3|max:60|unique:profiles,description',
            'action_list' => 'required|array|min:1',
        ];

        if($this->method() == 'PATCH' || $this->method() == 'PUT') {
            $rules['description'] .= ',' . $this->id;
        }

        return $rules;
    }
}
