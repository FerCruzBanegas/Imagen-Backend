<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Http\Requests\Traits\UsesCustomErrorMessage;

class PaymentRequest extends FormRequest
{
    use UsesCustomErrorMessage;
    
    protected $payments = ['Tarjeta', 'Efectivo', 'Cheque', 'Deposito', 'Transferencia'];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'date' => 'required|date_format:Y-m-d',
            'type' => ['required', Rule::in($this->payments)],
            'op' => 'nullable|max:32',
            'number' => 'nullable|max:32',
            'path.url' => 'required',
            'amount' => 'required|max:15|regex:/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'date' => 'fecha',
            'type' => 'tipo de pago',
            'number' => 'número',
            'path.url' => 'imagen',
            'amount' => 'monto',
        ];
    }

    public function message()
    {
        return 'Por favor verifique los errores a continuación.';
    }
}
