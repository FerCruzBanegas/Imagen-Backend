<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
         $rules = [
            'name' => 'required|min:3|max:64|unique:users,name',
            'forename' => 'required|min:3|max:128',
            'surname' => 'required|min:3|max:128',
            'email' => 'required|email|max:64|unique:users,email',
            'phone' => 'required|max:32',
            // 'state' => 'required|integer',
            // 'office_id' => 'required|integer',
            // 'profile_id' => 'required|integer',
        ];

        if($this->method() == 'POST') {
            $rules['password'] = 'required|min:5';
            $rules['password_confirmation'] = 'required|min:5|same:password';
            $rules['state'] = 'required|integer';
            $rules['office_id'] = 'required|integer';
            $rules['profile_id'] = 'required|integer';
        }

        if($this->method() == 'PATCH' || $this->method() == 'PUT') {
            $rules['name'] .= ',' . $this->id;
            $rules['email'] .= ',' . $this->id;
            // if ($this->filled('state')) {
            //     $rules['state'] = 'required|integer';
            //     $rules['office_id'] = 'required|integer';
            //     $rules['profile_id'] = 'required|integer';
            // }
        }

        return $rules;
    }
}
