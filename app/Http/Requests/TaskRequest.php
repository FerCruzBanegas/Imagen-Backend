<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Http\Requests\Traits\UsesCustomErrorMessage;

class TaskRequest extends FormRequest
{
    use UsesCustomErrorMessage;

    protected $priorits = ['Baja','Media','Alta'];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'tasks.*.description' => 'required|max:256',
            'tasks.*.priority' => ['required', Rule::in($this->priorits)],
            'tasks.*.date_init' => 'required|date_format:Y-m-d H:i:s',
            // 'tasks.*.work_order_id' => 'required|integer',
            'tasks.*.employee_id'  => 'required|integer',

        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'priority' => 'prioridad',
            'date_init' => 'fecha inicio',
            'work_order_id' => 'orden de trabajo',
            'employee_id'  => 'empleado',
        ];
    }

    public function messages()
    {
        $messages = [];
        foreach ($this->tasks as $key => $value){
            $item = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT) + 1;
            $messages['tasks.'. $key .'.description.required'] = 'El campo descripción del item '. $item .' es requerido.';
            $messages['tasks.'. $key .'.description.max'] = 'El campo descripción del item '. $item .' no debe ser mayor a 256 caracteres.';
            $messages['tasks.'. $key .'.priority.required'] = 'El campo prioridad del item '. $item .' es requerido.';
            $messages['tasks.'. $key .'.employee_id.required'] = 'El campo ecargado del item '. $item .' es requerido.';
            $messages['tasks.'. $key .'.date_init.required'] = 'El campo fecha inicio del item '. $item .' es requerido.';
            $messages['tasks.'. $key .'.date_init.date_format'] = 'El campo fecha inicio del item '. $item .' no tiene un formato de fecha correcto.';
        }
        return $messages;
    }
}
