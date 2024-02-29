<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LastProductionDatasRequest extends FormRequest
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
            'seeds_typed_used'=>[
                'required',
                'string',
                'max:50',
            ],
            'seeds_used_in_kg'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'seed_source'=>[
                'required',
                'string',
                'max:50',
            ],
            'no_of_fertilizer_used_in_bags'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'no_of_pesticides_used_in_l_per_kg'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'no_of_insecticides_used_in_l'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'area_planted'=>[
                'required',
                'string',
                'max:50',
            ], 
            'date_planted'=>[
                'required',
                'string',
                'max:50',
            ],
            'date_harvested'=>[
                'required',
                'string',
                'max:50',
            ],
            'yield_tons_per_kg'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'unit_price_palay_per_kg'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'unit_price_rice_per_kg'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'type_of_product'=>[
                'required',
                'string',
                'max:50',
            ],
            'sold_to'=>[
                'required',
                'string',
                'max:50',
            ],

            'if_palay_milled_where'=>[
                'required',
                'string',
                'max:50',
            ],
            'gross_income_palay'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
                
            ],
            'gross_income_rice'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            
        ];
        return $rule;
    }
    public function messages(){
       return [
            'seeds_typed_used.required'=>'Please input your seeds typed useds',
            'seeds_used_in_kg.numeric'=>'Please input your seeds used in kg , field must be a number',
            'seed_source.required'=>'Please input your seed source',
            'no_of_fertilizer_used_in_bags.numeric'=>'Please input your no of fertilizer used in bags , field must be a number',
            'no_of_pesticides_used_in_l_per_kg.numeric'=>'Please input your no of pesticides used in l per kg, field must be a number',
            'no_of_insecticides_used_in_l.numeric'=>'Please input your no of insecticides used in l, field must be a number',
            'area_planted.required'=>'Please input your area planted',
            'date_planted.required'=> 'Please input your date planted',
            'yield_tons_per_kg.numeric'=> 'Please input your yield tons per kg, field must be a number',
            'unit_price_palay_per_kg.numeric'=>'Please input your unit price palay per kg, field must be a number',
            'unit_price_rice_per_kg.numeric'=> 'Please input your unit price rice per kg, field must be a number',
            'type_of_product.required'=>'Please input your type of product',
            'sold_to.required'=> 'Please input your sold to',
            'if_palay_milled_where.required'=> 'Please input your if_palay_milled_where',
            'gross_income_palay.numeric'=> 'Please input your gross income (palay), field must be a number',
            'gross_income_rice.numeric'=> 'Please input your gross income (rice), field must be a number',
            
       ];
    }
}
