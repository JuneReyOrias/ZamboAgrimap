<?php

namespace App\Imports;

use App\Models\VariableCost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportVariableCost implements ToModel,WithHeadingRow
{
    // /**
    // * @param array $row
    // *
    // * @return \Illuminate\Database\Eloquent\Model|null
    // */
    // public function model(array $row)
    // {
    //     return new VariableCost([
    //         'total_machinery_fuel_cost'=>$row ['total_machinery_fuel_cost'],
    //         'total_variable_cost'=>$row ['total_variable_cost'],
    //     ]);
    // }

    protected $personalInformationId;
    protected $farmProfileId;
    protected $seedsIds;
    protected $laborsIds;
    protected $fertilizerIds;
    protected $pesticidesIds;
    protected $transportIds;
    public function __construct($personalInformationId, $farmProfileId,$seedsIds,$laborsIds,$fertilizerIds,$pesticidesIds,$transportIds)
    {
        $this->personalInformationId = $personalInformationId;
        $this->farmProfileId = $farmProfileId;
        $this->seedsIds = $seedsIds;
        $this->laborsIds= $laborsIds;
        $this->fertilizerIds =$fertilizerIds;
        $this->pesticidesIds =$pesticidesIds;
        $this->transportIds=$transportIds;
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
        $requiredKeys = ['total_seed_cost','total_labor_cost','total_cost_fertilizers','total_cost_pesticides', 'total_transport_per_deliverycost', 'total_machinery_fuel_cost', 'total_variable_cost'];
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
        //     'seeds_id' => $this->seedsIds,
        //     'labors_id'=>$this->laborsIds,
        //     'fertilizers_id'=> $this->fertilizerIds,
        //     'pesticides_id'=>$this->pesticidesIds,
        //     'transports_id'=>$this->transportIds,
        //     'row' => $row
        // ]);

        // Create or update FixedCost instance
        return VariableCost::firstOrCreate([
            'personal_informations_id' => $this->personalInformationId,
            'users_id' => $userId,
        
         
        ], [

                    'total_seed_cost'=>$row ['total_seed_cost'],
                    'total_labor_cost'=>$row ['total_labor_cost'],
                    'total_cost_fertilizers'=>$row ['total_cost_fertilizers'],
                    'total_cost_pesticides'=>$row ['total_cost_pesticides'],
                    'total_transport_per_deliverycost'=>$row ['total_transport_per_deliverycost'],
                    'total_machinery_fuel_cost'=>$row ['total_machinery_fuel_cost'],
                    'total_variable_cost'=>$row ['total_variable_cost'],
                
                    'farm_profiles_id' => $this->farmProfileId,
                    'seeds_id' => $this->seedsIds,
                    'labors_id'=>$this->laborsIds,
                    'fertilizers_id'=> $this->fertilizerIds,
                    'pesticides_id'=>$this->pesticidesIds,
                    'transports_id'=>$this->transportIds,
                    
        ]);
    }
}
