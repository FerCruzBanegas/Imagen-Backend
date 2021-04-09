<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MachineRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'description' => 'required|min:3|max:64|unique:machines,description',
        ];

        if($this->method() == 'PATCH' || $this->method() == 'PUT') {
            $rules['description'] .= ',' . $this->id;
        }

        return $rules;
    }
}
