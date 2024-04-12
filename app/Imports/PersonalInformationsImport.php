<?php

namespace App\Imports;

use App\Models\PersonalInformations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonalInformationsImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Generate a unique ID for the record
        $id = $this->generateUniqueId();

        // Create a new PersonalInformations instance with the data from the row
        $personalInformation = new PersonalInformations([
            'id' => $id,
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
        ]);

        return $personalInformation;
    }

    /**
     * Generate a unique ID for the record.
     *
     * @return int
     */
    private function generateUniqueId(): int
    {
        // Generate a unique ID using your preferred method
        // For example, you can use auto-incrementing IDs or UUIDs
        return rand(10000, 99999); // Replace this with your unique ID generation logic
    }

    /**
     * Configure batch insertion of models.
     *
     * @return int
     */
    public function batchSize(): int
    {
        return 1000; // Adjust the batch size as needed
    }
}
