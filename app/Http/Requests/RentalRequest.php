<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'rental.date_start' => 'required|date_format:Y-m-d',
            'rental.date_end' => 'required|date_format:Y-m-d',
            'rental.observation' => 'nullable|min:3|max:128',
            'rental.illumination' => 'required|min:2|max:2',
            'rental.print' => 'required|min:2|max:2',
            'rental.amount_monthly' => 'required|max:15|regex:/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/',
            'rental.amount_total' => 'required|max:15|regex:/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/',
            'rental.customer_id' => 'required|integer',
            'rental.billboard_id' => 'required|integer',
            'rental.user_id' => 'required|integer',
            'rental.rental_id' => 'nullable',
            'rental.quotation_id' => 'nullable',
        ];

        // if($this->method() == 'PATCH' || $this->method() == 'PUT') {
        //     $rules['name'] .= ',' . $this->id;
        // }

        if ($this->campaign['is_campaign']) {
            $rules['campaign.name'] = 'required|min:3|max:128';
            $rules['campaign.note'] = 'nullable|min:3|max:128';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'rental.date_start' => 'fecha inicio',
            'rental.date_end' => 'fecha fin',
            'rental.observation' => 'observación',
            'rental.illumination' => 'iluminación',
            'rental.print' => 'impresión',
            'rental.amount_monthly' => 'monto mensual',
            'rental.amount_total' => 'monto total',
            'rental.customer_id' => 'cliente',
            'rental.billboard_id' => 'espacio',
            'rental.user_id' => 'usuario',
            'campaign.name' => 'nombre campaña',
            'campaign.note' => 'nota',
        ];
    }
}
