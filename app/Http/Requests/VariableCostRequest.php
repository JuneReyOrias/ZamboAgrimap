<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariableCostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        $rule= [
            // 'name_of_fertilizer'=>[
            //     'required',
            //     'string',
            //     'max:50',
            // ],
            // 'type_of_fertilizer'=>[
            //     'required',
            //     'string',
            //     'max:50',
            // ],
            'total_machinery_fuel_cost'=>[
             'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'total_variable_cost'=>[
             'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            // 'total_labor_cost'=>[
            //     'required',
            //     'string',
            //     'max:50',
            // ],
           
        ];
        return $rule;
    }
    public function messages(){
       return [
            // 'name_of_fertilizer.required'=>'Please input name of fertilizer',
            // 'type of fertilizer.required'=>'Please input type of fertilizer',
            'total_machinery_fuel_cost.numeric'=>'Please input total machinery fuel cost, field must be a number',
            'total_variable_cost.numeric'=>'Please input total variable cost, field must be a number',
            // 'total_labor_cost.required'=>'Please input total labor cost',
       ];
    }
}
