<?php

namespace App\Imports;

use App\Models\PersonalInformations;
use App\Models\FarmProfile;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use app\import\WithChunkReading;

class PersonalInformationsImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       

        // Create a new PersonalInformations instance with the data from the row
        $personalInformation = new PersonalInformations([
           
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
// FarmProfiles Import Class
class FarmProfilesImport implements ToModel
{
    private $personalInformationId;

    public function __construct($personalInformationId)
    {
        $this->personalInformationId = $personalInformationId;
    }

    public function model(array $row)
    {
        // Create a new FarmProfiles instance with the data from the row
        return new FarmProfile([
            'personal_information_id' => $this->personalInformationId,
            'tenurial_status' => $row['tenurial_status'],
            'rice_farm_address' => $row['rice_farm_address'],
            'no_of_years_as_farmers' => $row['no_of_years_as_farmers'],
            'gps_longitude' => $row['gps_longitude'],
            'gps_latitude' => $row['gps_latitude'],
            'total_physical_area_has' => $row['total_physical_area_has'],
            'rice_area_cultivated_has' => $row['rice_area_cultivated_has'],
            'land_title_no' => $row['land_title_no'],
            'lot_no' => $row['lot_no'],
            'area_prone_to' => $row['area_prone_to'],
            'ecosystem' => $row['ecosystem'],
            'type_rice_variety' => $row['type_rice_variety'],
            'prefered_variety' => $row['prefered_variety'],
            'plant_schedule_wetseason' => $row['plant_schedule_wetseason'],
            'plant_schedule_dryseason' => $row['plant_schedule_dryseason'],
            'no_of_cropping_yr' => $row['no_of_cropping_yr'],
            'yield_kg_ha' => $row['yield_kg_ha'],
            'rsba_register' => $row['rsba_register'],
            'pcic_insured' => $row['pcic_insured'],
            'source_of_capital' => $row['source_of_capital'],
            'remarks_recommendation' => $row['remarks_recommendation'],
            'oca_district_office' => $row['oca_district_office'],
            'name_technicians' => $row['name_technicians'],
            'date_interview' => $row['date_interview'],
        ]);
    }
}