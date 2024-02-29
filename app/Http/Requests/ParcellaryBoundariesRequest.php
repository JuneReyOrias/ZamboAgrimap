<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParcellaryBoundariesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   
    public function rules()
    {
        $rule= [
            'parone_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parone_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'partwo_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'partwo_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parthree_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parthree_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ], 
            'parfour_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parfour_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parfive_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parfive_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parsix_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parsix_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parseven_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parseven_longitude'=>[
                'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'pareight_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
           
            'pareight_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parnine_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
           
            'parnine_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'parten_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
           
            'parten_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'pareleven_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
           
            'pareleven_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            'partwelve_latitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
           
            'partwelve_longitude'=>[
               'numeric',
                'regex:/^\d+(\.\d+)?$/',
                'max:180',
            ],
            
           
            'parcel_name'=>[
               'required',
               'string',
               'max:50',
           ],
           'lot_no'=>[
               'required',
               'string',
               'max:50',
           ],
           'tct_no'=>[
               'required',
               'string',
               'max:50',
           ],
           'brgy_name'=>[
               'required',
               'string',
               'max:50',
           ],
           'arpowner_na'=>[
               'required',
               'string',
               'max:50',
           ],
           'pkind_desc'=>[
               'required',
               'string',
               'max:50',
           ],
           'puse_desc'=>[
               'required',
               'string',
               'max:50',
           ],
           'actual_used'=>[
               'required',
               'string',
               'max:50',
           ],
           'parcolor'=>[
            'required',
            'string',
            'max:50',
        ],
            'area'=>[
                'numeric',
                 'regex:/^\d+(\.\d+)?$/',
                 
             ],
           
        ];
        return $rule;
    }
    public function messages()
    {
        return [
            'parone_latitude.numeric' => 'The Point 1 Latitude field must be a number.',
           
            'parone_longitude.numeric' => 'The Point 1 Longitude field must be a number.',
            
            'partwo_latitude.numeric' => 'The Point 2 Latitude field must be a number.',
          
            'partwo_longitude.numeric' => 'The Point 2 Longitude field must be a number.',
           
            'parthree_latitude.numeric' => 'The Point 3 Latitude field must be a number.',
            
            'parthree_longitude.numeric' => 'The Point 3 Longitude field must be a number.',

            'parfour_latitude.numeric' => 'The Point 4 Latitude field must be a number.',
            'parfour_longitude.numeric' => 'The Point 4 Longitude field must be a number.',
            'parfive_latitude.numeric' => 'The Point 5 Latitude field must be a number.',
            'parfive_longitude.numeric' => 'The Point 5 Longitude field must be a number.',
            'parsix_latitude.numeric' => 'The Point 6 Latitude field must be a number.',
            'parsix_longitude.numeric' => 'The Point 6 Longitude field must be a number.',
            'parseven_latitude.numeric' => 'The Point 7 Latitude field must be a number.',
            'parseven_longitude.numeric' => 'The Point 7 Longitude field must be a number.',
            'pareight_latitude.numeric' => 'The Point 8 Latitude field must be a number.',
            'pareight_longitude' => 'The Point 8 Longitude field must be a number.',
            'parnine_latitude.numeric' => 'The Point 9 Latitude field must be a number.',
            'parnine_longitude' => 'The Point 9 Longitude field must be a number.',
            'parten_latitude.numeric' => 'The Point 10 Latitude field must be a number.',
            'parten_longitude' => 'The Point 10 Longitude field must be a number.',
            'pareleven_latitude.numeric' => 'The Point 11 Latitude field must be a number.',
            'pareleven_longitude' => 'The Point 11 Longitude field must be a number.',
            'partwelve_latitude.numeric' => 'The Point 12 Latitude field must be a number.',
            'partwelve_longitude' => 'The Point 12 Longitude field must be a number.',
      
            'area.numeric' => 'The area field must be a number.',
            
            'parcel_name.required' => 'The parcel name field is required.',
           
            'lot_no.required' => 'The lot number field is required.',
            
            'tct_no.required' => 'The TCT number field is required.',
          
            
            'brgy_name.required' => 'The barangay name field is required.',
         
            'arpowner_na.required' => 'The ARP owner name field is required.',
           
            
            'pkind_desc.required' => 'The parcel kind description field is required.',
          
            'puse_desc.required' => 'The parcel use description field is required.',
           
            
            'actual_used.required' => 'The actual used field is required.',
           
            
            'parcolor.required' => 'The parcel color field is required.',
           
    
            
        ];
    }

}
