<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransportRequest extends FormRequest
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
            'total_transport_per_deliverycost'=>[
                'required',
                'string',
                'max:50',
            ],
            // 'harrowing_cost'=>[
            //     'required',
            //     'string',
            //     'max:50',
            // ],
            // 'harvesting_cost'=>[
            //     'required',
            //     'string',
            //     'max:50',
            // ],
            // 'post_harvest_cost'=>[
            //     'required',
            //     'string',
            //     'max:50',
            // ],
            // 'total_cost_for_machineries'=>[
            //     'required',
            //     'string',
            //     'max:50',
            // ],
           
        ];
        return $rule;
    }
    public function messages(){
       return [
            'total_transport_per_deliverycost.required'=>'Please input the Total Transport per delivery cost',
            // 'harrowing_cost.required'=>'Please input harrowing cost',
            // 'harvesting_cost.required'=>'Please input harvesting cost',
            // 'post_harvest_cost.required'=>'Please input post harvest cost',
            // 'total_cost_for_machineries.required'=>'Please input total_cost for machineries',
       ];
    }
}
