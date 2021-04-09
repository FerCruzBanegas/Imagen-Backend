<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesignRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'design.filename' => 'required|min:5|max:64',
            // 'design.machine' => 'required|max:64',
            'design.quality' => 'nullable|max:128',
            'design.material' => 'nullable|max:512',
            'design.cutting_dimension' => 'nullable|max:32',
            'design.print_dimension' => 'nullable|max:32',
            'design.finished' => 'nullable|max:512',
            'design.test_print' => 'nullable|max:32',
            'design.quote_approved_date' => 'required|date_format:Y-m-d',
            // 'design.design_approved_date' => 'required|date_format:Y-m-d',
            'design.reference' => 'nullable|max:32',
            'design.path.url' => 'required',
            'design.note' => 'nullable|min:5|max:512',
            'design.product_quotation_id' => 'required|integer',
            'design.machines' => 'required|array',
            'design.machines.*' => 'integer',
        ];

        if($this->design['set_image_support']) {
            $rules['design.support_path.url'] = 'required';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'design.filename' => 'archivo',
            'design.machines' => 'máquina',
            'design.quality' => 'calidad',
            'design.cutting_dimension' => 'dimensión corte',
            'design.print_dimension' => 'dimensión impresión',
            'design.finished' => 'acabado',
            'design.test_print' => 'prueba impresión',
            'design.quote_approved_date' => 'fecha aprobada',
            'design.reference' => 'referencia',
            'design.path.url' => 'imagen',
            'design.support_path.url' => 'imagen apoyo',
            'design.note' => 'nota',
        ];
    }
}
