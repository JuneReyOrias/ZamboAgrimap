<?php

namespace App\Imports;

use App\Models\PersonalInformations;
use App\Models\FarmProfile;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportFarmProfile implements ToModel,WithHeadingRow
{
    protected $personalInformations;

    public function __construct(PersonalInformations $personalInformations)
    {
        $this->personalInformations = $personalInformations;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        $personalInformationId = $this->personalInformations->id;

        return new FarmProfile([
            'personal_information_id' => $personalInformationId,
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
