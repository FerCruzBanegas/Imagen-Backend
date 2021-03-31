<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'note.summary' => 'nullable|min:3|max:500',
            'products.*.quantity' => 'required|integer',
            'products.*.description' => 'required|min:3|max:500',
            'products.*.price' =>  'required|max:15|regex:/^\d*(\.\d{2})?$/',
            'products.*.subtotal' => 'required|max:15|regex:/^\d*(\.\d{2})?$/',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'note.summary' => 'resumen',
        ];
    }

    public function messages()
    {
        $messages = [];
        foreach ($this->products as $key => $value){
            $item = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT) + 1;
            $messages['products.'. $key .'.description.required'] = 'El campo concepto del item '. $item .' es requerido.';
            $messages['products.'. $key .'.description.min'] = 'El campo concepto del item '. $item .' debe tener al menos 3 caracteres.';
            $messages['products.'. $key .'.description.max'] = 'El campo concepto del item '. $item .' no debe ser mayor a 500 caracteres.';

            $messages['products.'. $key .'.price.max'] = 'El campo precio del item '. $item .' no debe ser mayor a 15 caracteres.';
            $messages['products.'. $key .'.price.regex'] = 'El campo precio del item '. $item .' es inválido';

            $messages['products.'. $key .'.subtotal.max'] = 'El campo subtotal del item '. $item .' no debe ser mayor a 15 caracteres.';
            $messages['products.'. $key .'.subtotal.regex'] = 'El campo subtotal del item '. $item .' es inválido';
        }
        return $messages;
    }
}
