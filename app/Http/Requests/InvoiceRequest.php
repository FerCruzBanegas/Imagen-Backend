<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'invoice.date' => 'required|date_format:Y-m-d',
            // 'invoice.total' => 'required|max:15|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            // 'invoice.nit_name' => 'required_if:showNitName,1|min:3|max:128',
            'invoice.nit' => 'required|min:3|max:16',
            'invoice.title' => 'nullable|max:128',
            'invoice.footer' => 'nullable|max:128',
            'invoice.oc' => 'nullable|max:16',
            'invoice.hea' => 'nullable|max:16',
            'invoice.customer_id.id' => 'required|integer',
            'invoice.user_id' => 'required|integer',
            'invoice.quotation_id' => 'required|integer',
            'products.*.quantity' => 'required|integer',
            'products.*.description' => 'required|min:3|max:500',
            'products.*.price' =>  'required|max:15|regex:/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/',
            'products.*.subtotal' => 'required|max:15|regex:/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/',
        ];

        if($this->showNitName) {
            $rules['invoice.nit_name'] = 'required|min:3|max:128';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'invoice.date' => 'fecha',
            'invoice.total' => 'total',
            'invoice.nit_name' => 'nombre factura',
            'invoice.nit' => 'nit/ci',
            'invoice.customer_id.id' => 'cliente',
            'invoice.user_id' => 'usuario',
            'invoice.quotation_id' => 'cotización',
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
