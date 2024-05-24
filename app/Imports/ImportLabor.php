<?php

namespace App\Imports;

use App\Models\Labor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportLabor implements ToModel,WithHeadingRow
{
    // /**
    // * @param array $row
    // *
    // * @return \Illuminate\Database\Eloquent\Model|null
    // */
    // public function model(array $row)
    // {
    //     return new Labor([
    //         'no_of_person'=>$row ['no_of_person'],
    //         'rate_per_person'=>$row ['rate_per_person'],
    //         'total_labor_cost'=>$row ['total_labor_cost'],
    //     ]);
    // }
    protected $personalInformationId;
    protected $farmProfileId;
        private $laborModel;
    public function __construct($personalInformationId, $farmProfileId)
    {
        $this->personalInformationId = $personalInformationId;
        $this->farmProfileId = $farmProfileId;
    }


    public function model(array $row)
    {
        // Get the ID of the currently authenticated user
        $userId = Auth::id();
        // Find the user based on the retrieved ID
        $user = auth()->user();
        $agri_districts_id = $user->agri_districts_id;
        $agri_district = $user->agri_district;

        // Check if all required keys exist in the row
        $requiredKeys = ['no_of_person', 'rate_per_person', 'total_labor_cost'];
        foreach ($requiredKeys as $key) {
            if (!isset($row[$key])) {
                Log::error("Undefined array key '$key'. Row: " . json_encode($row));
                return null; // Skip this row
            }
        }

        // Debug to check the state of data before creating FixedCost instance
        // dd([
        //     'users_id' => $userId,
            
        //     // 'personalInformationId' => $this->personalInformationId,
        //     'farmProfileId' => $this->farmProfileId,
        //     'row' => $row
        // ]);

        // Create or update FixedCost instance
       $this->laborModel= Labor::firstOrCreate([
            'personal_informations_id' => $this->personalInformationId,
            'users_id' => $userId,
        
         
        ], [
                     'no_of_person'=>$row ['no_of_person'],
                    'rate_per_person'=>$row ['rate_per_person'],
                    'total_labor_cost'=>$row ['total_labor_cost'],
                    
                    'farm_profiles_id' => $this->farmProfileId,
        ]);
        $this->laborModel->save();
    }
    public function getlaborsId(){
        return $this->laborModel->id;
    }
}
