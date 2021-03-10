<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MinimalPrice;
use App\Http\Requests\Traits\UsesCustomErrorMessage;

class QuotationRequest extends FormRequest
{
    use UsesCustomErrorMessage;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'quotation.attends' => 'required|min:5|max:64',
            'quotation.attends_phone' => 'required|min:8|max:16',
            'quotation.installment' => 'required|min:5|max:64',
            'quotation.date' => 'required|date_format:Y-m-d',
            'quotation.amount' => 'required|max:13|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'quotation.discount' => 'nullable|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'quotation.iva' => 'nullable|integer',
            'quotation.term' => 'nullable|date_format:Y-m-d',
            'quotation.payment' => 'nullable|min:5|max:64',
            'quotation.validity' => 'nullable|min:5|max:64',
            'quotation.note' => 'nullable|min:2|max:150',
            'quotation.customer_id' => 'required',
            'quotation.user_id' => 'required|integer',
            'products.*.quantity' => 'required|integer',
            'products.*.dimension' => 'required|min:5|max:16',
            'products.*.description' => 'nullable|min:5|max:512',
            'products.*.price' =>  'required|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'products.*.subtotal' => 'required|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'products.*.filters' =>  [new MinimalPrice()],
        ];

        // if($this->method() == 'PATCH' || $this->method() == 'PUT') {
        //     $rules['name'] .= ',' . $this->id;
        // }

        return $rules;
    }

    public function attributes()
    {
        return [
            'quotation.attends' => 'contacto',
            'quotation.attends_phone' => 'teléfono contacto',
            'quotation.installment' => 'instalación',
            'quotation.date' => 'fecha',
            'quotation.amount' => 'monto',
            'quotation.discount' => 'descuento',
            'quotation.term' => 'plazo de entrega',
            'quotation.payment' => 'forma de pago',
            'quotation.validity' => 'validez',
            'quotation.note' => 'nota',
            'quotation.customer_id' => 'cliente',
            'quotation.user_id' => 'usuario',
        ];
    }

    public function messages()
    {
        $messages = [];
        foreach ($this->products as $key => $value){
            $item = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT) + 1;
            $messages['products.'. $key .'.dimension.min'] = 'El campo dimensión del item '. $item .' debe tener al menos 5 caracteres.';
            $messages['products.'. $key .'.dimension.max'] = 'El campo dimensión del item '. $item .' no debe ser mayor a 16 caracteres.';
            $messages['products.'. $key .'.description.min'] = 'El campo descripión del item '. $item .' debe tener al menos 5 caracteres.';
            $messages['products.'. $key .'.description.max'] = 'El campo descripión del item '. $item .' no debe ser mayor a 150 caracteres.';
        }
        return $messages;
    }
}
