<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FarmProfileRequest extends FormRequest
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
            'tenurial_status'=>[
                'required',
                'string',
                'max:50',
            ],
            'rice_farm_address'=>[
                'required',
                'string',
                'max:50',
            ],
            'no_of_years_as_farmers'=>[
                'required',
                'string',
                'max:50',
               
            ],
            'gps_longitude'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
               
            ],
            'gps_latitude'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
               
            ],
            'total_physical_area_has'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'rice_area_cultivated_has'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
             
            ], 
            'land_title_no'=>[
                'required',
                'string',
                'max:50',
            ],
            'lot_no'=>[
                'required',
                'string',
                'max:50',
            ],
            'area_prone_to'=>[
                'required',
                'string',
                'max:50',
            ],
            'ecosystem'=>[
                'required',
                'string',
                'max:50',
            ],
            'type_rice_variety'=>[
                'required',
                'string',
                'max:50',
            ],
            'prefered_variety'=>[
                'required',
                'string',
                'max:50',
            ],
            'plant_schedule_wetseason'=>[
                'required',
                'string',
                'max:50',
            ],

            'plant_schedule_dryseason'=>[
                'required',
                'string',
                'max:50',
            ],
            'no_of_cropping_yr'=>[
                'required',
                'string',
                'max:50',
                
            ],
            'yield_kg_ha'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
               
            ],
            'rsba_register'=>[
                'required',
                'string',
                'max:50',
            ],
            'pcic_insured'=>[
                'required',
                'string',
                'max:50',
            ],
            'government_assisted'=>[
                'required',
                'string',
                'max:50',
            ],
            'source_of_capital'=>[
                'required',
                'string',
                'max:100',
            ],
            'remarks_recommendation'=>[
                'required',
                'string',
                'max:50',
            ],
            'oca_district_office'=>[
                'required',
                'string',
                'max:50',
            ],
            'name_technicians'=>[
                'required',
                'string',
                'max:50',
            ],
            'date_interview'=>[
                'required',
                'string',
                'max:50',
            ],
        ];
        return $rule;
    }
    public function messages(){
       return [
            'tenurial_status.required'=>'Please input your tenurial status',
            'rice_farm_address.required'=>'Please input your rice farm address',
            'no_of_years_as_farmers.numeric'=>'Please input your no of years as farmers',
            'gps_longitude.required'=>'Please input your GPS longitude',
            'gps_latitude.numeric'=>'Please input your GPS latitude',
            'total_physical_area_has.numeric'=>'Please input your total physical area has',
            'rice_area_cultivated_has.numeric'=>'Please input your rice area cultivated has',
            'land_title_no.required'=> 'Please input your land title no',
            'lot_no.required'=> 'Please input your lot no',
            'area_prone_to.required'=>'Please input your area prone to',
            'ecosystem.required'=> 'Please input your ecosystem',
            'type_rice_variety.required'=>'Please input your type rice variety planted',
            'prefered_variety.required'=> 'Please input your prefered variety',
            'plant_schedule_wetseason.required'=> 'Please input your plant schedule wetseason',
            'plant_schedule_dryseason.required'=> 'Please input your plant schedule dryseason',
            'no_of_cropping_yr.required'=> 'Please choose no of cropping per year',
            'yield_kg_ha.numeric'=> 'Please input your yield(kg/ha)',
            'rsba_register.required'=> 'Please choose yes or no if applicable',
            'pcic_insured.required'=> 'Please choose yes or no if applicable',
            'government_assisted'=> 'Please choose yes or no if applicable',
            'source_of_capital.required'=> 'Please choose your source of capital',
            'remarks_recommendation.required'=> 'Please input your remarks/recommendation',
            'oca_district_office.required'=> 'Please input your OCA district office',
            'name_technicians.required'=> 'Please input the name of technicians',
            'date_interview.required'=> 'Please input the date of interview',
       ];
    }
}
