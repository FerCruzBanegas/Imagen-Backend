<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
    protected $documents = ['CI', 'LC', 'LM'];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|max:64',
            'document' => ['nullable', Rule::in($this->documents)],
            'num_document' => 'nullable|max:16|unique:employees,num_document',
            'address' => 'nullable|max:64',
            'phone' => 'required|max:32',
            'email' => 'nullable|max:64|email|unique:employees,email',
            'office_id' => 'required|integer'
        ];

        if($this->method() == 'PATCH' || $this->method() == 'PUT') {
            $rules['num_document'] .= ',' . $this->id;
            $rules['email'] .= ',' . $this->id;
        }

        return $rules;
    }
}
