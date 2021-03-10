<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'note.date' => 'required|date_format:Y-m-d',
            'note.nit' => 'nullable|min:5|max:16',
            'note.customer_id.id' => 'required|integer',
            'note.user_id' => 'required|integer',
            'note.quotation_id' => 'required|integer',
            'products.*.quantity' => 'required|integer',
            'products.*.description' => 'required|min:3|max:500',
            'products.*.price' =>  'required|max:15|regex:/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/',
            'products.*.subtotal' => 'required|max:15|regex:/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'note.date' => 'fecha',
            'note.total' => 'total',
            'note.nit' => 'nit/ci',
            'note.customer_id.id' => 'cliente',
            'note.user_id' => 'usuario',
            'note.quotation_id' => 'cotización',
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
