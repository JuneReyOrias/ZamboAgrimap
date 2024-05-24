<?php

namespace App\Imports;

use App\Models\LastProductionDatas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportLastProductionDatas implements ToModel,WithHeadingRow
{
    // /**
    // * @param array $row
    // *
    // * @return \Illuminate\Database\Eloquent\Model|null
    // */
    // public function model(array $row)
    // {
    //     return new LastProductionDatas([
    //         'seeds_typed_used'=>$row ['seeds_typed_used'],
    //         'seeds_used_in_kg'=>$row ['seeds_used_in_kg'],
    //         'seed_source'=>$row ['seed_source'],
    //         'no_of_fertilizer_used_in_bags'=>$row ['no_of_fertilizer_used_in_bags'],
    //         'no_of_pesticides_used_in_l_per_kg'=>$row ['no_of_pesticides_used_in_l_per_kg'],
    //         'no_of_insecticides_used_in_l'=>$row ['no_of_insecticides_used_in_l'],
    //         'area_planted'=>$row ['area_planted'],
    //         'date_planted'=>$row ['date_planted'],
    //         'date_harvested'=>$row ['date_harvested'],
    //         'yield_tons_per_kg'=>$row ['yield_tons_per_kg'],
    //         'unit_price_palay_per_kg'=>$row ['unit_price_palay_per_kg'],
    //         'unit_price_rice_per_kg'=>$row ['unit_price_rice_per_kg'],
    //         'type_of_product'=>$row ['type_of_product'],
    //         'sold_to'=>$row ['sold_to'],
    //         'if_palay_milled_where'=>$row ['if_palay_milled_where'],
    //         'gross_income_palay'=>$row ['gross_income_palay'],
    //         'gross_income_rice'=>$row ['gross_income_rice'],
    //     ]);
    // }

    
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
        $requiredKeys = ['seeds_typed_used', 'seeds_used_in_kg','seed_source','no_of_fertilizer_used_in_bags','no_of_pesticides_used_in_l_per_kg',
        'no_of_insecticides_used_in_l','area_planted','date_planted','date_harvested','yield_tons_per_kg','unit_price_palay_per_kg', 
        'unit_price_rice_per_kg', 'type_of_product','sold_to','if_palay_milled_where','gross_income_palay','gross_income_rice'];
        foreach ($requiredKeys as $key) {
            if (!isset($row[$key])) {
                Log::error("Undefined array key '$key'. Row: " . json_encode($row));
                return null; // Skip this row
            }
        }

        // Debug to check the state of data before creating FixedCost instance
        // dd([
        //     'users_id' => $userId,
        //     'agri_districts_id' => $user->agri_districts_id,
        //     // 'personalInformationId' => $this->personalInformationId,
        //     'farmProfileId' => $this->farmProfileId,
        //     'row' => $row
        // ]);

        // Create or update FixedCost instance
        return LastProductionDatas::firstOrCreate([
            'personal_informations_id' => $this->personalInformationId,
            'users_id' => $userId,
            'agri_districts_id' => $user->agri_districts_id,
         
        ], [
                    'seeds_typed_used'=>$row ['seeds_typed_used'],
                    'seeds_used_in_kg'=>$row ['seeds_used_in_kg'],
                    'seed_source'=>$row ['seed_source'],
                    'no_of_fertilizer_used_in_bags'=>$row ['no_of_fertilizer_used_in_bags'],
                    'no_of_pesticides_used_in_l_per_kg'=>$row ['no_of_pesticides_used_in_l_per_kg'],
                    'no_of_insecticides_used_in_l'=>$row ['no_of_insecticides_used_in_l'],
                    'area_planted'=>$row ['area_planted'],
                    'date_planted'=>$row ['date_planted'],
                    'date_harvested'=>$row ['date_harvested'],
                    'yield_tons_per_kg'=>$row ['yield_tons_per_kg'],
                    'unit_price_palay_per_kg'=>$row ['unit_price_palay_per_kg'],
                    'unit_price_rice_per_kg'=>$row ['unit_price_rice_per_kg'],
                    'type_of_product'=>$row ['type_of_product'],
                    'sold_to'=>$row ['sold_to'],
                    'if_palay_milled_where'=>$row ['if_palay_milled_where'],
                    'gross_income_palay'=>$row ['gross_income_palay'],
                    'gross_income_rice'=>$row ['gross_income_rice'],
                
                    'farm_profiles_id' => $this->farmProfileId,
        ]);
    }
}
