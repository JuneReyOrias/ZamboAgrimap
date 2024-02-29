<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MachineriesUsedtRequest extends FormRequest
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
            'plowing_cost'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'harrowing_cost'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'harvesting_cost'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'post_harvest_cost'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'total_cost_for_machineries'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
           
        ];
        return $rule;
    }
    public function messages(){
       return [
            'plowing_cost.numeric'=>'Please input plowing cost, field must be a number',
            'harrowing_cost.numeric'=>'Please input harrowing cost, field must be a number',
            'harvesting_cost.numeric'=>'Please input harvesting cost, field must be a number',
            'post_harvest_cost.numeric'=>'Please input post harvest cost, field must be a number',
            'total_cost_for_machineries.numeric'=>'Please input total_cost for machineries, field must be a number',
       ];
    
    }
}
