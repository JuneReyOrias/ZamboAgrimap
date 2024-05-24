<?php

namespace App\Imports;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import the Log facade
use App\Models\PersonalInformations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonalinfoImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


              // Get the ID of the currently authenticated user
                $userId = Auth::id();

            // Find the user based on the retrieved ID
                $user = auth()->user();
                $agri_districts_id = $user->agri_districts_id;
                $agri_district = $user->agri_district;
               

                // Debug to check the state of data before creating FarmProfile instance
    // dd([
    //     'users_id' => $userId,
    //     'agri_districts_id' => $user->agri_districts_id,
    //     'agri_district' => $user->agri_district,
    //     'row' => $row
    // ]);


      PersonalInformations::firstOrCreate(
            [
            
                'users_id' => $userId,
                'agri_districts_id' => $user->agri_districts_id,
                'agri_district' => $user->agri_district,
            ],
            
            
            [
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'extension_name' => $row['extension_name'],
            'home_address' => $row['home_address'],
            'sex' => $row['sex'],
            'religion' => $row['religion'],
            'date_of_birth' => $row['date_of_birth'],
            'place_of_birth' => $row['place_of_birth'],
            'contact_no' => $row['contact_no'],
            'civil_status' => $row['civil_status'],
            'name_legal_spouse' => $row['name_legal_spouse'],
            'no_of_children' => $row['no_of_children'],
            'mothers_maiden_name' => $row['mothers_maiden_name'],
            'highest_formal_education' => $row['highest_formal_education'],
            'person_with_disability' => $row['person_with_disability'],
            'pwd_id_no' => $row['pwd_id_no'],
            'government_issued_id' => $row['government_issued_id'],
            'id_type' => $row['id_type'],
            'gov_id_no' => $row['gov_id_no'],
            'member_ofany_farmers_ass_org_coop' => $row['member_ofany_farmers_ass_org_coop'],
            'nameof_farmers_ass_org_coop' => $row['nameof_farmers_ass_org_coop'],
            'name_contact_person' => $row['name_contact_person'],
            'cp_tel_no' => $row['cp_tel_no'],
        ]
    
    );
    }
}
