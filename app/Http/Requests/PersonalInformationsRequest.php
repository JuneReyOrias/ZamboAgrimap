<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInformationsRequest extends FormRequest
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
            'last_name'=>[
                'required',
                'string',
                'max:50',
            ],
            'first_name'=>[
                'required',
                'string',
                'max:50',
            ],
            'middle_name'=>[
                'required',
                'string',
                'max:50',
            ],
            'extension_name'=>[
                'required',
                'string',
                'max:50',
            ],
            'home_address'=>[
                'required',
                'string',
                'max:50',
            ],
            'sex'=>[
                'required',
                'string',
                'max:50',
            ],
            'religion'=>[
                'required',
                'string',
                'max:50',
            ], 
            'date_of_birth'=>[
                'required',
                'string',
                'max:50',
            ],
            'place_of_birth'=>[
                'required',
                'string',
                'max:50',
            ],
            'contact_no'=>[
                'required',
                'string',
                'max:11',
            ],
            'civil_status'=>[
                'required',
                'string',
                'max:50',
            ],
            'name_legal_spouse'=>[
                'required',
                'string',
                'max:50',
            ],
            'no_of_children'=>[
                'required',
                'string',
                'max:50',
            ],
            'mothers_maiden_name'=>[
                'required',
                'string',
                'max:50',
            ],
            'highest_formal_education'=>[
                'required',
                'string',
                'max:50',
            ],
            'person_with_disability'=>[
                'required',
                'string',
                'max:50',
            ],
            'pwd_id_no'=>[
                'required',
                'string',
                'max:50',
            ],
            'government_issued_id'=>[
                'required',
                'string',
                'max:50',
            ],
            'id_type'=>[
                'required',
                'string',
                'max:50',
            ],
            'gov_id_no'=>[
                'required',
                'string',
                'max:50',
            ],
            'member_ofany_farmers_ass_org_coop'=>[
                'required',
                'string',
                'max:50',
            ],
            'nameof_farmers_ass_org_coop'=>[
                'required',
                'string',
                'max:50',
            ],
            'name_contact_person'=>[
                'required',
                'string',
                'max:50',
            ],
            'cp_tel_no'=>[
                'required',
                'digits:11',
            ],
        ];
        return $rule;
    }
    public function messages(){
       return [
            'last_name.required'=>'Please input your last name',
            'first_name.required'=>'Please input your first name',
            'middle_name.required'=>'Please input your middle name',
            'extension_name.required'=>'Please input your extension name',
            'home_address.required'=>'Please input your home address',
            'sex.required'=>'Please input your sex',
            'religion.required'=>'Please input your religion',
            'date_of_birth.required'=> 'Please input your date of birth',
            'place_of_birth.required'=> 'Please input your place of birth',
            'contact_no.required'=>'Please input yor contact no.',
            'civil_status.required'=> 'Please input your civil status',
            'name_legal_spouse.required'=>'Please input your name of legal spouse',
            'no_of_children.required'=> 'Please input your number of children',
            'mothers_maiden_name.required'=> 'Please input your mothers maiden name',
            'highest_formal_education.required'=> 'Please input your highest formal education',
            'person_with_disability.required'=> 'Please choose yes or no',
            'pwd_id_no.required'=> 'Please input your pwd id no. if you chose yes, if no write n/a',
            'government_issued_id.required'=> 'Please choose yes or no if applicable government_issued_id',
            'id_type.required'=> 'Please choose applicable Id Type',
            'gov_id_no.required'=> 'Please input your gov id no. if you chose yes, if no write n/a',
            'member_ofany_farmers_ass_org_coop.required'=> 'Please choose yes or no if member_ofany_farmers_ass_org_coop applicable',
            'nameof_farmers_ass_org_coop.required'=> 'Please input your name of farmers ass/org/coop. if you chose yes, if no write n/a',
            'name_contact_person.required'=> 'Please input your name contact person',
            'cp_tel_no.required'=> 'Please input your cp tel/no',
       ];
    }
}
