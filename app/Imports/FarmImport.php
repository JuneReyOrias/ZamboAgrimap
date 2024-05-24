<?php

namespace App\Imports;

use App\Models\FarmProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\PersonalInformations;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log; // Import the Log facade
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FarmImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $personalInformationId;
    private $farmModel;



    public function __construct($personalInformationId)
    {
        $this->personalInformationId = $personalInformationId;
     
    }


 public function model(array $row)
{
    // Get the ID of the currently authenticated user
    $userId = Auth::id();
           // Find the user based on the retrieved ID
           $user = auth()->user();
           $agri_districts_id = $user->agri_districts_id;
           $agri_district = $user->agri_district;
   // Check if the 'tenurial_status' column exists
   if (!isset($row['tenurial_status'])) {
    Log::warning("Column 'tenurial_status' is missing in the Excel file.");
    return null; // Skip this row
}

// Check if personalInformationId is set
if (!$this->personalInformationId) {
    Log::error("Personal Information ID is null.");
    return null; // Skip this row
}

// Debug to check the state of data before creating FarmProfile instance
// dd([
//    'users_id'=> $userId,
//    'agri_districts_id' => $user->agri_districts_id,
//    'agri_districts' => $user->agri_district,
//     'personalInformationId' => $this->personalInformationId,
//     'row' => $row

// ]);
// 
    // Create or update a FarmProfile instance
    $this->farmModel = FarmProfile::firstOrCreate(
        [
            'personal_informations_id' => $this->personalInformationId,
            'users_id' => $userId,
            'agri_districts_id' => $user->agri_districts_id,
            'agri_districts' => $user->agri_district,
        ],
        [
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
        ]
    );
    $this->farmModel->save();
    return $this->farmModel;
}

public function getFarmModel()
{
    return $this->farmModel;
}
       
    }
