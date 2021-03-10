<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CurrentPassword;

class UserPasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'password_current'=>['required', new CurrentPassword()],
            'password' => 'required|min:5',
            'password_confirmation' => 'required|min:5|same:password',
        ];

        return $rules;
    }
}