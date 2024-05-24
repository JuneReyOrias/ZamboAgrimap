<?php

namespace App\Imports;

use App\Models\FixedCost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FixedsImport implements ToModel, WithHeadingRow
{
    protected $personalInformationId;
    protected $farmProfileId;

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
        $requiredKeys = ['no_of_ha', 'cost_per_ha', 'total_amount'];
        foreach ($requiredKeys as $key) {
            if (!isset($row[$key])) {
                Log::error("Undefined array key '$key'. Row: " . json_encode($row));
                return null; // Skip this row
            }
        }

        // Debug to check the state of data before creating FixedCost instance
        // dd([
        //     'users_id' => $userId,
            
        //     'personalInformationId' => $this->personalInformationId,
        //     'farmProfileId' => $this->farmProfileId,
        //     'row' => $row
        // ]);

        // Create or update FixedCost instance
        return FixedCost::firstOrCreate([
            'personal_informations_id' => $this->personalInformationId,
            'users_id' => $userId,
        
         
        ], [
            'no_of_ha' => $row['no_of_ha'],
            'cost_per_ha' => $row['cost_per_ha'],
            'total_amount' => $row['total_amount'],
            'farm_profiles_id' => $this->farmProfileId,
        ]);
    }
}
