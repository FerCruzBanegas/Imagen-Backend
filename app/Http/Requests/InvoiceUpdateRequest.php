<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'nullable|max:120',
            'footer' => 'nullable|max:120',
            'products.*.description' => 'required|min:3|max:500',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        foreach ($this->products as $key => $value){
            $item = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT) + 1;
            $messages['products.'. $key .'.description.required'] = 'El campo concepto del item '. $item .' es requerido.';
            $messages['products.'. $key .'.description.min'] = 'El campo concepto del item '. $item .' debe tener al menos 3 caracteres.';
            $messages['products.'. $key .'.description.max'] = 'El campo concepto del item '. $item .' no debe ser mayor a 500 caracteres.';

            $messages['title.max'] = 'El campo título no puede superar los 120 caracteres.';

            $messages['footer.max'] = 'El campo pie de página no puede superar los 120 caracteres.';
        }
        return $messages;
    }
}
