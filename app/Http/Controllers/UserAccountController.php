<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParcellaryBoundariesRequest;
use App\Http\Requests\RegisterRequest;

use App\Models\FarmProfile;
use App\Models\Fertilizer;
use App\Models\FixedCost;
use App\Models\Labor;
use App\Models\LastProductionDatas;
use App\Models\MachineriesUseds;
use App\Models\ParcellaryBoundaries;
use App\Models\Pesticide;
use App\Models\Seed;
use App\Models\VariableCost;
use App\Http\Requests\FarmProfileRequest;
use App\Http\Requests\FixedCostRequest;
use App\Http\Requests\MachineriesUsedtRequest;
use App\Http\Requests\UpdateMachineriesUsedRequest;
use App\Http\Requests\LastProductionDatasRequest;
use App\Http\Requests\UpdateLastProductiondatasRequest;
use App\Http\Requests\SeedRequest;
use App\Http\Requests\LaborRequest;
use App\Http\Requests\FertilizerRequest;
use App\Http\Requests\PesticidesRequest;
use App\Http\Requests\TransportRequest;
use App\Http\Requests\VariableCostRequest;
use App\Models\PersonalInformations;
use App\Http\Requests\PersonalInformationsRequest;
use App\Http\Controllers\Backend\PersonalInformationsController;
use App\Models\Transport;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class UserAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function UserDashboard(){
    //     $totalfarms= FarmProfile::count();
    //     $totalAreaPlanted = FarmProfile::sum('total_physical_area_has');
    //     $totalAreaYield = FarmProfile::sum('yield_kg_ha');
    //     $totalCost= VariableCost::sum('total_variable_cost');
    
    //     $yieldPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalAreaYield / $totalAreaPlanted : 0;
    //     $averageCostPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalCost / $totalAreaPlanted : 0;
    //     $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        
    //     // Return the view with the data
    //     return view('user.user_dash', compact('totalfarms', 'totalAreaPlanted', 'totalAreaYield', 'totalCost', 'yieldPerAreaPlanted', 'averageCostPerAreaPlanted', 'totalRiceProduction'));
    // }
    public function UserDashboard(){
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $agent = User::find($userId);
    
            if ($agent) {
                // Assuming $user represents the currently logged-in user
                $user = auth()->user();
    
                // Check if user is authenticated before proceeding
                if (!$user) {
                    // Handle unauthenticated user, for example, redirect them to login
                    return redirect()->route('login');
                }
    
                // Find the user's personal information by their ID
                $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
    
                // Fetch the farm ID associated with the user
                $farmId = $user->id;
    
                // Find the farm profile using the fetched farm ID
                $farmprofile = FarmProfile::where('id', $farmId)->latest()->first();

                $totalfarms= FarmProfile::count();
                    $totalAreaPlanted = FarmProfile::sum('total_physical_area_has');
                    $totalAreaYield = FarmProfile::sum('yield_kg_ha');
                    $totalCost= VariableCost::sum('total_variable_cost');
                
                    $yieldPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalAreaYield / $totalAreaPlanted : 0;
                    $averageCostPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalCost / $totalAreaPlanted : 0;


                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');



                // Return the view with the fetched data
                return view('user.user_dash', compact('totalfarms', 'totalAreaPlanted', 'totalAreaYield', 'totalCost', 'yieldPerAreaPlanted', 'averageCostPerAreaPlanted','agent', 'profile','totalRiceProduction', 'farmprofile'));
            } else {
                // Handle the case where the user is not found
                // You can redirect the user or display an error message
                return redirect()->route('login')->with('error', 'User not found.');
            }
        } else {
            // Handle the case where the user is not authenticated
            // Redirect the user to the login page
            return redirect()->route('login');
        }
    }




    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // rice farmers per agriDistrict

    // ayala district view by users




    
public function AyalaUserView()
{
    // Check if the user is authenticated
    if (Auth::check()) {
        // User is authenticated, proceed with retrieving the user's ID
        $userId = Auth::id();

        // Find the user based on the retrieved ID
        $agent = User::find($userId);

        if ($agent) {
            // Assuming $user represents the currently logged-in user
            $user = auth()->user();

            // Check if user is authenticated before proceeding
            if (!$user) {
                // Handle unauthenticated user, for example, redirect them to login
                return redirect()->route('login');
            }

            // Find the user's personal information by their ID
            $profile = PersonalInformations::where('users_id', $userId)->latest()->first();

            // Fetch the farm ID associated with the user
            $farmId = $user->farm_id;

            // Find the farm profile using the fetched farm ID
            $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

      

            // Fetch ayala farmers fetching  data
            $FarmersData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
            ->select(
                'personal_informations.*',
                'farm_profiles.*',
                'fixed_costs.*',
                'machineries_useds.*',
                'variable_costs.*',
                'last_production_datas.*'
            )
            ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
            ->get();
            // Specify the agri district you want to filter by
                // Calculate the age for each farmer
                foreach ($FarmersData as $farmer) {
                    // Calculate the age for each farmer
                    $dateOfBirth = $farmer->date_of_birth;
                    $age = Carbon::parse($dateOfBirth)->age;

                    // Add the age to the farmer object
                    $farmer->age = $age;
                }
            // Count the number of farmers in the "ayala" district
            $totalfarms = DB::table('personal_informations')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->where('farm_profiles.agri_districts', 'ayala')
            ->distinct()
            ->count('personal_informations.id');

              // Calculate the total area planted in the "ayala" district
            $totalAreaPlantedAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'ayala')
            ->sum('total_physical_area_has');
            $totalAreaYieldAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'ayala')
            ->sum('yield_kg_ha');
         
             // Calculate the total fixed cost in the "ayala" district
            $totalFixedCostAyala = DB::table('fixed_costs')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
            ->where('farm_profiles.agri_districts', 'ayala')
            ->sum('fixed_costs.total_amount');
            
                  // Calculate the total machineries cost in the "ayala" district
                  $totalMachineriesUsedAyala= DB::table('machineries_useds')
                  ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                  ->where('farm_profiles.agri_districts', 'ayala')
                  ->sum('machineries_useds.total_cost_for_machineries');

                // Calculate the total variable cost in the "ayala" district
                $totalVariableCostAyala = DB::table('variable_costs')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                ->where('farm_profiles.agri_districts', 'ayala')
                ->sum('variable_costs.total_variable_cost');

                    // Calculate the total rice production in the Ayala district
                    $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                    ->where('farm_profiles.agri_districtS', 'Ayala')
                    ->sum('last_production_datas.yield_tons_per_kg');


                              // Count owner tenants
                            $countOwnerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'ayala')
                            ->where('farm_profiles.tenurial_status', 'owner')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenant tenants
                            $countTillerTenantTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'ayala')
                            ->where('farm_profiles.tenurial_status', 'tiller tenant')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenants
                            $countTillerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'ayala')
                            ->where('farm_profiles.tenurial_status', 'tiller')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count lease tenants
                            $countLeaseTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'ayala')
                            ->where('farm_profiles.tenurial_status', 'lease')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');
                        // Count owner tenants
                    $countOwner = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'ayala')
                    ->where('farm_profiles.tenurial_status', 'owner')
                    ->distinct()
                    ->count('farm_profiles.tenurial_status');

                    // total farmers organizattion
                    $countorg = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'ayala')
                    ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                    ->count('personal_informations.nameof_farmers_ass_org_coop');


                // Calculate rice productivity in the Ayala district
                $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;

                 // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
     
            $totalAreaPlanted = FarmProfile::sum('total_physical_area_has');
            $totalAreaYield = FarmProfile::sum('yield_kg_ha');
            $totalCost= VariableCost::sum('total_variable_cost');
                
            $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
            $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');

            // Return the view with the fetched data
            return view('user.agriFarmers.ayala_farmers', compact('agent', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
            'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
            'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
            'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
            'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
        } else {
            // Handle the case where the user is not found
            // You can redirect the user or display an error message
            return redirect()->route('login')->with('error', 'User not found.');
        }
    } else {
        // Handle the case where the user is not authenticated
        // Redirect the user to the login page
        return redirect()->route('login');
    }
}
    // tumaga farmers view by users

   

    public function TumagaUserView()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $agent = User::find($userId);
    
            if ($agent) {
                // Assuming $user represents the currently logged-in user
                $user = auth()->user();
    
                // Check if user is authenticated before proceeding
                if (!$user) {
                    // Handle unauthenticated user, for example, redirect them to login
                    return redirect()->route('login');
                }
    
                // Find the user's personal information by their ID
                $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
    
                // Fetch the farm ID associated with the user
                $farmId = $user->farm_id;
    
                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
    
          
    
                // Fetch ayala farmers fetching  data
                $FarmersData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.*',
                    'farm_profiles.*',
                    'fixed_costs.*',
                    'machineries_useds.*',
                    'variable_costs.*',
                    'last_production_datas.*'
                )
                ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
                ->get();
                // Specify the agri district you want to filter by
                    // Calculate the age for each farmer
                    foreach ($FarmersData as $farmer) {
                        // Calculate the age for each farmer
                        $dateOfBirth = $farmer->date_of_birth;
                        $age = Carbon::parse($dateOfBirth)->age;
    
                        // Add the age to the farmer object
                        $farmer->age = $age;
                    }
                // Count the number of farmers in the "ayala" district
                $totalfarms = DB::table('personal_informations')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->where('farm_profiles.agri_districts', 'tumaga')
                ->distinct()
                ->count('personal_informations.id');
    
                  // Calculate the total area planted in the "tumaga" district
                $totalAreaPlantedAyala = DB::table('farm_profiles')
                ->where('agri_districts', 'tumaga')
                ->sum('total_physical_area_has');
                $totalAreaYieldAyala = DB::table('farm_profiles')
                ->where('agri_districts', 'tumaga')
                ->sum('yield_kg_ha');
             
                 // Calculate the total fixed cost in the "tumaga" district
                $totalFixedCostAyala = DB::table('fixed_costs')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
                ->where('farm_profiles.agri_districts', 'tumaga')
                ->sum('fixed_costs.total_amount');
                
                      // Calculate the total machineries cost in the "tumaga" district
                      $totalMachineriesUsedAyala= DB::table('machineries_useds')
                      ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                      ->where('farm_profiles.agri_districts', 'tumaga')
                      ->sum('machineries_useds.total_cost_for_machineries');
    
                    // Calculate the total variable cost in the "tumaga" district
                    $totalVariableCostAyala = DB::table('variable_costs')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                    ->where('farm_profiles.agri_districts', 'tumaga')
                    ->sum('variable_costs.total_variable_cost');
    
                        // Calculate the total rice production in the Ayala district
                        $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                        ->where('farm_profiles.agri_districtS', 'tumaga')
                        ->sum('last_production_datas.yield_tons_per_kg');
    
    
                                  // Count owner tenants
                                $countOwnerTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'tumaga')
                                ->where('farm_profiles.tenurial_status', 'owner')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count tiller tenant tenants
                                $countTillerTenantTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'tumaga')
                                ->where('farm_profiles.tenurial_status', 'tiller tenant')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count tiller tenants
                                $countTillerTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'tumaga')
                                ->where('farm_profiles.tenurial_status', 'tiller')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count lease tenants
                                $countLeaseTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'tumaga')
                                ->where('farm_profiles.tenurial_status', 'lease')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
                            // Count owner tenants
                        $countOwner = DB::table('personal_informations')
                        ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                        ->where('farm_profiles.agri_districts', 'tumaga')
                        ->where('farm_profiles.tenurial_status', 'owner')
                        ->distinct()
                        ->count('farm_profiles.tenurial_status');
    
                        // total farmers organizattion
                        $countorg = DB::table('personal_informations')
                        ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                        ->where('farm_profiles.agri_districts', 'tumaga')
                        ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                        ->count('personal_informations.nameof_farmers_ass_org_coop');
    
    
                    // Calculate rice productivity in the Ayala district
                    $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;
    
                     // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
         
                $totalAreaPlanted = FarmProfile::sum('total_physical_area_has');
                $totalAreaYield = FarmProfile::sum('yield_kg_ha');
                $totalCost= VariableCost::sum('total_variable_cost');
                    
                $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
                $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    
                // Return the view with the fetched data
                return view('user.agriFarmers.tumaga_farmers', compact('agent', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
                'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
                'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
                'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
                'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
            } else {
                // Handle the case where the user is not found
                // You can redirect the user or display an error message
                return redirect()->route('login')->with('error', 'User not found.');
            }
        } else {
            // Handle the case where the user is not authenticated
            // Redirect the user to the login page
            return redirect()->route('login');
        }
    }




    // culianan farmers view by users
   


    public function CuliananUserView()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $agent = User::find($userId);
    
            if ($agent) {
                // Assuming $user represents the currently logged-in user
                $user = auth()->user();
    
                // Check if user is authenticated before proceeding
                if (!$user) {
                    // Handle unauthenticated user, for example, redirect them to login
                    return redirect()->route('login');
                }
    
                // Find the user's personal information by their ID
                $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
    
                // Fetch the farm ID associated with the user
                $farmId = $user->farm_id;
    
                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
    
          
    
                // Fetch ayala farmers fetching  data
                $FarmersData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.*',
                    'farm_profiles.*',
                    'fixed_costs.*',
                    'machineries_useds.*',
                    'variable_costs.*',
                    'last_production_datas.*'
                )
                ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
                ->get();
                // Specify the agri district you want to filter by
                    // Calculate the age for each farmer
                    foreach ($FarmersData as $farmer) {
                        // Calculate the age for each farmer
                        $dateOfBirth = $farmer->date_of_birth;
                        $age = Carbon::parse($dateOfBirth)->age;
    
                        // Add the age to the farmer object
                        $farmer->age = $age;
                    }
                // Count the number of farmers in the "ayala" district
                $totalfarms = DB::table('personal_informations')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->where('farm_profiles.agri_districts', 'culianan')
                ->distinct()
                ->count('personal_informations.id');
    
                  // Calculate the total area planted in the "culianan" district
                $totalAreaPlantedAyala = DB::table('farm_profiles')
                ->where('agri_districts', 'culianan')
                ->sum('total_physical_area_has');
                $totalAreaYieldAyala = DB::table('farm_profiles')
                ->where('agri_districts', 'culianan')
                ->sum('yield_kg_ha');
             
                 // Calculate the total fixed cost in the "culianan" district
                $totalFixedCostAyala = DB::table('fixed_costs')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
                ->where('farm_profiles.agri_districts', 'culianan')
                ->sum('fixed_costs.total_amount');
                
                      // Calculate the total machineries cost in the "culianan" district
                      $totalMachineriesUsedAyala= DB::table('machineries_useds')
                      ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                      ->where('farm_profiles.agri_districts', 'culianan')
                      ->sum('machineries_useds.total_cost_for_machineries');
    
                    // Calculate the total variable cost in the "culianan" district
                    $totalVariableCostAyala = DB::table('variable_costs')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                    ->where('farm_profiles.agri_districts', 'culianan')
                    ->sum('variable_costs.total_variable_cost');
    
                        // Calculate the total rice production in the Ayala district
                        $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                        ->where('farm_profiles.agri_districtS', 'culianan')
                        ->sum('last_production_datas.yield_tons_per_kg');
    
    
                                  // Count owner tenants
                                $countOwnerTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'culianan')
                                ->where('farm_profiles.tenurial_status', 'owner')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count tiller tenant tenants
                                $countTillerTenantTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'culianan')
                                ->where('farm_profiles.tenurial_status', 'tiller tenant')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count tiller tenants
                                $countTillerTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'culianan')
                                ->where('farm_profiles.tenurial_status', 'tiller')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count lease tenants
                                $countLeaseTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'culianan')
                                ->where('farm_profiles.tenurial_status', 'lease')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
                            // Count owner tenants
                        $countOwner = DB::table('personal_informations')
                        ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                        ->where('farm_profiles.agri_districts', 'culianan')
                        ->where('farm_profiles.tenurial_status', 'owner')
                        ->distinct()
                        ->count('farm_profiles.tenurial_status');
    
                        // total farmers organizattion
                        $countorg = DB::table('personal_informations')
                        ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                        ->where('farm_profiles.agri_districts', 'culianan')
                        ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                        ->count('personal_informations.nameof_farmers_ass_org_coop');
    
    
                    // Calculate rice productivity in the Ayala district
                    $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;
    
                     // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
         
                $totalAreaPlanted = FarmProfile::sum('total_physical_area_has');
                $totalAreaYield = FarmProfile::sum('yield_kg_ha');
                $totalCost= VariableCost::sum('total_variable_cost');
                    
                $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
                $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    
                // Return the view with the fetched data
                return view('user.agriFarmers.culianan_farmers', compact('agent', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
                'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
                'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
                'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
                'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
            } else {
                // Handle the case where the user is not found
                // You can redirect the user or display an error message
                return redirect()->route('login')->with('error', 'User not found.');
            }
        } else {
            // Handle the case where the user is not authenticated
            // Redirect the user to the login page
            return redirect()->route('login');
        }
    }




    // manicahan farmers view by users
    
    
public function ManicahanUsersView()
{
    // Check if the user is authenticated
    if (Auth::check()) {
        // User is authenticated, proceed with retrieving the user's ID
        $userId = Auth::id();

        // Find the user based on the retrieved ID
        $agent = User::find($userId);

        if ($agent) {
            // Assuming $user represents the currently logged-in user
            $user = auth()->user();

            // Check if user is authenticated before proceeding
            if (!$user) {
                // Handle unauthenticated user, for example, redirect them to login
                return redirect()->route('login');
            }

            // Find the user's personal information by their ID
            $profile = PersonalInformations::where('users_id', $userId)->latest()->first();

            // Fetch the farm ID associated with the user
            $farmId = $user->farm_id;

            // Find the farm profile using the fetched farm ID
            $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

      

            // Fetch ayala farmers fetching  data
            $FarmersData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
            ->select(
                'personal_informations.*',
                'farm_profiles.*',
                'fixed_costs.*',
                'machineries_useds.*',
                'variable_costs.*',
                'last_production_datas.*'
            )
            ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
            ->get();
            // Specify the agri district you want to filter by
                // Calculate the age for each farmer
                foreach ($FarmersData as $farmer) {
                    // Calculate the age for each farmer
                    $dateOfBirth = $farmer->date_of_birth;
                    $age = Carbon::parse($dateOfBirth)->age;

                    // Add the age to the farmer object
                    $farmer->age = $age;
                }
            // Count the number of farmers in the "ayala" district
            $totalfarms = DB::table('personal_informations')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->where('farm_profiles.agri_districts', 'manicahan')
            ->distinct()
            ->count('personal_informations.id');

              // Calculate the total area planted in the "manicahan" district
            $totalAreaPlantedAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'manicahan')
            ->sum('total_physical_area_has');
            $totalAreaYieldAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'manicahan')
            ->sum('yield_kg_ha');
         
             // Calculate the total fixed cost in the "manicahan" district
            $totalFixedCostAyala = DB::table('fixed_costs')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
            ->where('farm_profiles.agri_districts', 'manicahan')
            ->sum('fixed_costs.total_amount');
            
                  // Calculate the total machineries cost in the "manicahan" district
                  $totalMachineriesUsedAyala= DB::table('machineries_useds')
                  ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                  ->where('farm_profiles.agri_districts', 'manicahan')
                  ->sum('machineries_useds.total_cost_for_machineries');

                // Calculate the total variable cost in the "manicahan" district
                $totalVariableCostAyala = DB::table('variable_costs')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                ->where('farm_profiles.agri_districts', 'manicahan')
                ->sum('variable_costs.total_variable_cost');

                    // Calculate the total rice production in the Ayala district
                    $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                    ->where('farm_profiles.agri_districtS', 'culianan')
                    ->sum('last_production_datas.yield_tons_per_kg');


                              // Count owner tenants
                            $countOwnerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'manicahan')
                            ->where('farm_profiles.tenurial_status', 'owner')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenant tenants
                            $countTillerTenantTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'manicahan')
                            ->where('farm_profiles.tenurial_status', 'tiller tenant')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenants
                            $countTillerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'manicahan')
                            ->where('farm_profiles.tenurial_status', 'tiller')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count lease tenants
                            $countLeaseTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'manicahan')
                            ->where('farm_profiles.tenurial_status', 'lease')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');
                        // Count owner tenants
                    $countOwner = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'manicahan')
                    ->where('farm_profiles.tenurial_status', 'owner')
                    ->distinct()
                    ->count('farm_profiles.tenurial_status');

                    // total farmers organizattion
                    $countorg = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'manicahan')
                    ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                    ->count('personal_informations.nameof_farmers_ass_org_coop');


                // Calculate rice productivity in the Ayala district
                $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;

                 // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
     
            $totalAreaPlanted = FarmProfile::sum('total_physical_area_has');
            $totalAreaYield = FarmProfile::sum('yield_kg_ha');
            $totalCost= VariableCost::sum('total_variable_cost');
                
            $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
            $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');

            // Return the view with the fetched data
            return view('user.agriFarmers.manicahan_farmers', compact('agent', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
            'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
            'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
            'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
            'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
        } else {
            // Handle the case where the user is not found
            // You can redirect the user or display an error message
            return redirect()->route('login')->with('error', 'User not found.');
        }
    } else {
        // Handle the case where the user is not authenticated
        // Redirect the user to the login page
        return redirect()->route('login');
    }
}
    // curuan farmers view by users

  


    public function CuruanUsersView()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $agent = User::find($userId);
    
            if ($agent) {
                // Assuming $user represents the currently logged-in user
                $user = auth()->user();
    
                // Check if user is authenticated before proceeding
                if (!$user) {
                    // Handle unauthenticated user, for example, redirect them to login
                    return redirect()->route('login');
                }
    
                // Find the user's personal information by their ID
                $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
    
                // Fetch the farm ID associated with the user
                $farmId = $user->farm_id;
    
                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
    
          
    
                // Fetch ayala farmers fetching  data
                $FarmersData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.*',
                    'farm_profiles.*',
                    'fixed_costs.*',
                    'machineries_useds.*',
                    'variable_costs.*',
                    'last_production_datas.*'
                )
                ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
                ->get();
                // Specify the agri district you want to filter by
                    // Calculate the age for each farmer
                    foreach ($FarmersData as $farmer) {
                        // Calculate the age for each farmer
                        $dateOfBirth = $farmer->date_of_birth;
                        $age = Carbon::parse($dateOfBirth)->age;
    
                        // Add the age to the farmer object
                        $farmer->age = $age;
                    }
                // Count the number of farmers in the "ayala" district
                $totalfarms = DB::table('personal_informations')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->where('farm_profiles.agri_districts', 'curuan')
                ->distinct()
                ->count('personal_informations.id');
    
                  // Calculate the total area planted in the "curuan" district
                $totalAreaPlantedAyala = DB::table('farm_profiles')
                ->where('agri_districts', 'curuan')
                ->sum('total_physical_area_has');
                $totalAreaYieldAyala = DB::table('farm_profiles')
                ->where('agri_districts', 'curuan')
                ->sum('yield_kg_ha');
             
                 // Calculate the total fixed cost in the "curuan" district
                $totalFixedCostAyala = DB::table('fixed_costs')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
                ->where('farm_profiles.agri_districts', 'curuan')
                ->sum('fixed_costs.total_amount');
                
                      // Calculate the total machineries cost in the "curuan" district
                      $totalMachineriesUsedAyala= DB::table('machineries_useds')
                      ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                      ->where('farm_profiles.agri_districts', 'curuan')
                      ->sum('machineries_useds.total_cost_for_machineries');
    
                    // Calculate the total variable cost in the "curuan" district
                    $totalVariableCostAyala = DB::table('variable_costs')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                    ->where('farm_profiles.agri_districts', 'curuan')
                    ->sum('variable_costs.total_variable_cost');
    
                        // Calculate the total rice production in the Ayala district
                        $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                        ->where('farm_profiles.agri_districtS', 'curuan')
                        ->sum('last_production_datas.yield_tons_per_kg');
    
    
                                  // Count owner tenants
                                $countOwnerTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'curuan')
                                ->where('farm_profiles.tenurial_status', 'owner')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count tiller tenant tenants
                                $countTillerTenantTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'curuan')
                                ->where('farm_profiles.tenurial_status', 'tiller tenant')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count tiller tenants
                                $countTillerTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'curuan')
                                ->where('farm_profiles.tenurial_status', 'tiller')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count lease tenants
                                $countLeaseTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'curuan')
                                ->where('farm_profiles.tenurial_status', 'lease')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
                            // Count owner tenants
                        $countOwner = DB::table('personal_informations')
                        ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                        ->where('farm_profiles.agri_districts', 'curuan')
                        ->where('farm_profiles.tenurial_status', 'owner')
                        ->distinct()
                        ->count('farm_profiles.tenurial_status');
    
                        // total farmers organizattion
                        $countorg = DB::table('personal_informations')
                        ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                        ->where('farm_profiles.agri_districts', 'curuan')
                        ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                        ->count('personal_informations.nameof_farmers_ass_org_coop');
    
    
                    // Calculate rice productivity in the Ayala district
                    $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;
    
                     // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
         
                $totalAreaPlanted = FarmProfile::sum('total_physical_area_has');
                $totalAreaYield = FarmProfile::sum('yield_kg_ha');
                $totalCost= VariableCost::sum('total_variable_cost');
                    
                $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
                $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    
                // Return the view with the fetched data
                return view('user.agriFarmers.curuan_farmers', compact('agent', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
                'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
                'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
                'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
                'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
            } else {
                // Handle the case where the user is not found
                // You can redirect the user or display an error message
                return redirect()->route('login')->with('error', 'User not found.');
            }
        } else {
            // Handle the case where the user is not authenticated
            // Redirect the user to the login page
            return redirect()->route('login');
        }
    }
    


    // vitali farmers view by users


    public function VitaliuserView()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $agent = User::find($userId);
    
            if ($agent) {
                // Assuming $user represents the currently logged-in user
                $user = auth()->user();
    
                // Check if user is authenticated before proceeding
                if (!$user) {
                    // Handle unauthenticated user, for example, redirect them to login
                    return redirect()->route('login');
                }
    
                // Find the user's personal information by their ID
                $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
    
                // Fetch the farm ID associated with the user
                $farmId = $user->farm_id;
    
                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
    
          
    
                // Fetch ayala farmers fetching  data
                $FarmersData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.*',
                    'farm_profiles.*',
                    'fixed_costs.*',
                    'machineries_useds.*',
                    'variable_costs.*',
                    'last_production_datas.*'
                )
                ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
                ->get();
                // Specify the agri district you want to filter by
                    // Calculate the age for each farmer
                    foreach ($FarmersData as $farmer) {
                        // Calculate the age for each farmer
                        $dateOfBirth = $farmer->date_of_birth;
                        $age = Carbon::parse($dateOfBirth)->age;
    
                        // Add the age to the farmer object
                        $farmer->age = $age;
                    }
                // Count the number of farmers in the "ayala" district
                $totalfarms = DB::table('personal_informations')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->where('farm_profiles.agri_districts', 'vitali')
                ->distinct()
                ->count('personal_informations.id');
    
                  // Calculate the total area planted in the "vitali" district
                $totalAreaPlantedAyala = DB::table('farm_profiles')
                ->where('agri_districts', 'vitali')
                ->sum('total_physical_area_has');
                $totalAreaYieldAyala = DB::table('farm_profiles')
                ->where('agri_districts', 'vitali')
                ->sum('yield_kg_ha');
             
                 // Calculate the total fixed cost in the "vitali" district
                $totalFixedCostAyala = DB::table('fixed_costs')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
                ->where('farm_profiles.agri_districts', 'vitali')
                ->sum('fixed_costs.total_amount');
                
                      // Calculate the total machineries cost in the "vitali" district
                      $totalMachineriesUsedAyala= DB::table('machineries_useds')
                      ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                      ->where('farm_profiles.agri_districts', 'vitali')
                      ->sum('machineries_useds.total_cost_for_machineries');
    
                    // Calculate the total variable cost in the "vitali" district
                    $totalVariableCostAyala = DB::table('variable_costs')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                    ->where('farm_profiles.agri_districts', 'vitali')
                    ->sum('variable_costs.total_variable_cost');
    
                        // Calculate the total rice production in the Ayala district
                        $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                        ->where('farm_profiles.agri_districtS', 'vitali')
                        ->sum('last_production_datas.yield_tons_per_kg');
    
    
                                  // Count owner tenants
                                $countOwnerTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'vitali')
                                ->where('farm_profiles.tenurial_status', 'owner')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count tiller tenant tenants
                                $countTillerTenantTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'vitali')
                                ->where('farm_profiles.tenurial_status', 'tiller tenant')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count tiller tenants
                                $countTillerTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'vitali')
                                ->where('farm_profiles.tenurial_status', 'tiller')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
    
                                // Count lease tenants
                                $countLeaseTenants = DB::table('personal_informations')
                                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                ->where('farm_profiles.agri_districts', 'vitali')
                                ->where('farm_profiles.tenurial_status', 'lease')
                                ->distinct()
                                ->count('farm_profiles.tenurial_status');
                            // Count owner tenants
                        $countOwner = DB::table('personal_informations')
                        ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                        ->where('farm_profiles.agri_districts', 'vitali')
                        ->where('farm_profiles.tenurial_status', 'owner')
                        ->distinct()
                        ->count('farm_profiles.tenurial_status');
    
                        // total farmers organizattion
                        $countorg = DB::table('personal_informations')
                        ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                        ->where('farm_profiles.agri_districts', 'vitali')
                        ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                        ->count('personal_informations.nameof_farmers_ass_org_coop');
    
    
                    // Calculate rice productivity in the Ayala district
                    $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;
    
                     // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
         
                $totalAreaPlanted = FarmProfile::sum('total_physical_area_has');
                $totalAreaYield = FarmProfile::sum('yield_kg_ha');
                $totalCost= VariableCost::sum('total_variable_cost');
                    
                $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
                $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    
                // Return the view with the fetched data
                return view('user.agriFarmers.vitali_farmers', compact('agent', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
                'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
                'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
                'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
                'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
            } else {
                // Handle the case where the user is not found
                // You can redirect the user or display an error message
                return redirect()->route('login')->with('error', 'User not found.');
            }
        } else {
            // Handle the case where the user is not authenticated
            // Redirect the user to the login page
            return redirect()->route('login');
        }
    }


    // rice Schedule per district

    // Planting schedule of farmers view by users
    public function RicePlantingSched(){
        try {
            $farmersData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.agri_district',
                    'last_production_datas.date_planted',
                    'farm_profiles.*',
                    'personal_informations.last_name',
                    'personal_informations.first_name',
                    'farm_profiles.type_rice_variety',
                    'farm_profiles.prefered_variety',
                )
                ->orderBy('personal_informations.agri_district')
                ->get();
    
            // Group the data by district
            $plantingSchedule = [];
            foreach ($farmersData as $data) {
                $plantingSchedule[$data->agri_district][] = [
                    'last_name' => $data->last_name,
                    'first_name' => $data->first_name,
                    'date_planted' => $data->date_planted,
                    'type_rice_variety' => $data->type_rice_variety,
                    'prefered_variety' => $data->prefered_variety,
                ];
            }
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            return view('user.riceSchedule.rice_planting', compact('plantingSchedule','totalRiceProduction'));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }
    }
    
   
// harvesting schedule  of farmers view by users
    public function RiceHarvestSched(){

        try {
            $harvestData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.agri_district',
                    'personal_informations.last_name',
                    'personal_informations.first_name',
                    'last_production_datas.date_harvested',
                    'farm_profiles.type_rice_variety',
                    'farm_profiles.prefered_variety',
                    
                )
                ->orderBy('personal_informations.agri_district')
                ->get();
    
            // Group the data by district
            $harvestSchedule = [];
            foreach ($harvestData as $data) {
                $harvestSchedule[$data->agri_district][] = [
                    'last_name' => $data->last_name,
                    'first_name' => $data->first_name,
                    'date_harvested' => $data->date_harvested,
                    'type_rice_variety' => $data->type_rice_variety,
                    'prefered_variety' => $data->prefered_variety,
                ];
            }
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            return view('user.riceSchedule.rice_harvest', compact('harvestSchedule','totalRiceProduction'));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }
    }
    // RiceVariety per district

public function VarietyRiceUsers()
{
    // Check if the user is authenticated
    if (Auth::check()) {
        // User is authenticated, proceed with retrieving the user's ID
        $userId = Auth::id();

        // Find the user based on the retrieved ID
        $agent = User::find($userId);

        if ($agent) {
            // Assuming $user represents the currently logged-in user
            $user = auth()->user();

            // Check if user is authenticated before proceeding
            if (!$user) {
                // Handle unauthenticated user, for example, redirect them to login
                return redirect()->route('login');
            }

            // Find the user's personal information by their ID
            $profile = PersonalInformations::where('users_id', $userId)->latest()->first();

            // Fetch the farm ID associated with the user
            $farmId = $user->farm_id;

            // Find the farm profile using the fetched farm ID
            $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

      

            // Fetch inbred variety data
            $inbredData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.agri_district',
                    'farm_profiles.type_rice_variety',
                    'farm_profiles.prefered_variety'
                )
                ->orderBy('personal_informations.agri_district')
                ->get();

            // Group the data by district
            $InbredInfo = [];
            foreach ($inbredData as $data) {
                $typeVariety = $data->type_rice_variety;
                $preferedVariety = $data->prefered_variety;

                // If type of variety is "N/A", use preferred variety
                if (strtolower($typeVariety) === 'n/a' || strtolower($typeVariety) === 'na') {
                    $variety = $preferedVariety;
                } else {
                    $variety = $typeVariety;
                }

                if (!isset($InbredInfo[$data->agri_district][$variety])) {
                    $InbredInfo[$data->agri_district][$variety] = ['count' => 0, 'percentage' => 0];
                }

                $InbredInfo[$data->agri_district][$variety]['count']++;
            }

            // Calculate percentage for each rice variety in each district
            foreach ($InbredInfo as $district => &$varieties) {
                $totalRiceVarietiesInDistrict = array_sum(array_column($varieties, 'count'));
                foreach ($varieties as &$data) {
                    $percentage = ($totalRiceVarietiesInDistrict > 0) ? ($data['count'] / $totalRiceVarietiesInDistrict) * 100 : 0;
                    $data['percentage'] = number_format($percentage, 2);
                }
            }
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('user.RiceVariety.inbred_hybrid', compact('agent','userId', 'profile','totalRiceProduction', 'farmProfile', 'InbredInfo'));
        } else {
            // Handle the case where the user is not found
            // You can redirect the user or display an error message
            return redirect()->route('login')->with('error', 'User not found.');
        }
    } else {
        // Handle the case where the user is not authenticated
        // Redirect the user to the login page
        return redirect()->route('login');
    }
}
 

    // crop production view by user

    // rice crop production per district
    // public function CropRiceProduc(){
    //     try {
    //         $riceProductionData = DB::table('personal_informations')
    //         ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
    //         ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
    //         ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
    //         ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
    //             ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
    //             ->select(
    //                 'personal_informations.*',
    //                 'farm_profiles.*',
    //                 'fixed_costs.*',
    //                 'machineries_useds.*',
    //                 'variable_costs.*',
    //                 'personal_informations.agri_district',
            
    //                 'personal_informations.last_name',
    //                 'personal_informations.first_name',
    //                 'last_production_datas.date_planted',
    //                 'last_production_datas.date_harvested',
    //                 'last_production_datas.yield_tons_per_kg',
    //                 'last_production_datas.unit_price_palay_per_kg',
    //                 'last_production_datas.unit_price_rice_per_kg',
    //                 'last_production_datas.gross_income_palay',
    //                 'last_production_datas.gross_income_rice',
    //                 'last_production_datas.type_of_product'
    //             )
    //             // ->where('last_production_datas.type_of_product', 'rice',) // Filter for rice production only
    //             ->orderBy('personal_informations.agri_district')
    //             ->get();
    
    //         // Group the data by district
    //         $riceProductionSchedule = [];
    //         foreach ($riceProductionData as $data) {
    //             $riceProductionSchedule[$data->agri_district][] = [
    //                 'last_name' => $data->last_name,
    //                 'first_name' => $data->first_name,
    //                 'date_planted' => $data->date_planted,
    //                 'date_harvested' => $data->date_harvested,
    //                 'yield_tons_per_kg' => $data->yield_tons_per_kg,
    //                 'unit_price_palay_per_kg' => $data->unit_price_palay_per_kg,
    //                 'unit_price_rice_per_kg' => $data->unit_price_rice_per_kg,
    //                 'gross_income_palay' => $data->gross_income_palay,
    //                 'gross_income_rice' => $data->gross_income_rice,
    //                 'type_of_product' => $data->type_of_product
    //             ];
    //         }
    
    //         $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    //         return view('user.cropProduction.rice_crop', compact('riceProductionSchedule','totalRiceProduction'));
    //     } catch (\Exception $ex) {
    //         // Log the exception for debugging purposes
    //         dd($ex);
    //         return redirect()->back()->with('message', 'Something went wrong');
    //     }
            
    // }
     
    public function CropRiceProduc()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $agent = User::find($userId);
    
            if ($agent) {
                // Assuming $user represents the currently logged-in user
                $user = auth()->user();
    
                // Check if user is authenticated before proceeding
                if (!$user) {
                    // Handle unauthenticated user, for example, redirect them to login
                    return redirect()->route('login');
                }
    
                // Find the user's personal information by their ID
                $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
    
                // Fetch the farm ID associated with the user
                $farmId = $user->farm_id;
    
                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
    
          
    
                // Fetch last production data  farmers fetching  data
                $riceProductionData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                    ->select(
                        'personal_informations.*',
                        'farm_profiles.*',
                        'fixed_costs.*',
                        'machineries_useds.*',
                        'variable_costs.*',
                        'personal_informations.agri_district',
                
                        'personal_informations.last_name',
                        'personal_informations.first_name',
                        'last_production_datas.date_planted',
                        'last_production_datas.date_harvested',
                        'last_production_datas.yield_tons_per_kg',
                        'last_production_datas.unit_price_palay_per_kg',
                        'last_production_datas.unit_price_rice_per_kg',
                        'last_production_datas.gross_income_palay',
                        'last_production_datas.gross_income_rice',
                        'last_production_datas.type_of_product'
                    )
                    // ->where('last_production_datas.type_of_product', 'rice',) // Filter for rice production only
                    ->orderBy('personal_informations.agri_district')
                    ->get();
        
                // Group the data by district
                $riceProductionSchedule = [];
                foreach ($riceProductionData as $data) {
                    $riceProductionSchedule[$data->agri_district][] = [
                        'last_name' => $data->last_name,
                        'first_name' => $data->first_name,
                        'date_planted' => $data->date_planted,
                        'date_harvested' => $data->date_harvested,
                        'yield_tons_per_kg' => $data->yield_tons_per_kg,
                        'unit_price_palay_per_kg' => $data->unit_price_palay_per_kg,
                        'unit_price_rice_per_kg' => $data->unit_price_rice_per_kg,
                        'gross_income_palay' => $data->gross_income_palay,
                        'gross_income_rice' => $data->gross_income_rice,
                        'type_of_product' => $data->type_of_product
                    ];
                }
                 // Initialize an array to store total rice production per district
            $totalRiceProductionPerDistrict = [];

            // Group the data by district and calculate total rice production per district
            foreach ($riceProductionData as $data) {
                $district = $data->agri_district;
                $riceProduction = $data->yield_tons_per_kg;

                // If the district is not already in the array, initialize it with the rice production
                if (!isset($totalRiceProductionPerDistrict[$district])) {
                    $totalRiceProductionPerDistrict[$district] = $riceProduction;
                } else {
                    // If the district is already in the array, add the rice production to the existing total
                    $totalRiceProductionPerDistrict[$district] += $riceProduction;
                }
            }
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with the fetched data
                return view('user.cropProduction.rice_crop', compact('agent', 'profile', 'farmProfile','totalRiceProduction',
               'riceProductionSchedule','totalRiceProductionPerDistrict'
                ));
            } else {
                // Handle the case where the user is not found
                // You can redirect the user or display an error message
                return redirect()->route('login')->with('error', 'User not found.');
            }
        } else {
            // Handle the case where the user is not authenticated
            // Redirect the user to the login page
            return redirect()->route('login');
        }
    }



    // corn crop prodction per district
    public function CornCropProduction(){

        return view('user.cropProduction.corn_crop');
    }

    // coconut crop production per district view by users
    public function CoconutCropProd(){

        return view('user.cropProduction.coco_crop');
    }


    // userprofile
    public function UserProfile(){
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $agent = User::find($userId);
    
            if ($agent) {
                // Assuming $user represents the currently logged-in user
                $user = auth()->user();
    
                // Check if user is authenticated before proceeding
                if (!$user) {
                    // Handle unauthenticated user, for example, redirect them to login
                    return redirect()->route('login');
                }
    
                // Find the user's personal information by their ID
                $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
    
                // Fetch the farm ID associated with the user
                $farmId = $user->id;
    
                // Find the farm profile using the fetched farm ID
                $farmprofile = FarmProfile::where('id', $farmId)->latest()->first();
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with the fetched data
                return view('user.userprofile.profiles', compact('agent', 'profile','totalRiceProduction', 'farmprofile'));
            } else {
                // Handle the case where the user is not found
                // You can redirect the user or display an error message
                return redirect()->route('login')->with('error', 'User not found.');
            }
        } else {
            // Handle the case where the user is not authenticated
            // Redirect the user to the login page
            return redirect()->route('login');
        }
    }


    // updatte users accounts
    
public function Userupdate(Request $request){
   
    try {
         $id =Auth::user()->id;
    $data= User:: find($id);
    if ($data) {
        // Check if a file is present in the request and if it's valid
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Retrieve the image file from the request
            $image = $request->file('image');

            // Generate a unique image name using current timestamp and file extension
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded image to the 'productimages' directory with the generated name
            $image->move('agentimages', $imagename);

            // Delete the previous image file, if exists
            if ($data->image) {
                Storage::delete('agentimages/' . $data->image);
            }

            // Set the image name in the Product data
            $data->image = $imagename;
        }

    $data->name= $request->name;
    $data->email= $request->email;
    $data->agri_district= $request->agri_district;
    $data->password= $request->password;
    $data->role= $request->role;
 
     
   $data->save();
     // Redirect back after processing
     return redirect()->route('user.userprofile.profiles')->with('message', 'Profile updated successfully');
    } else {
        // Redirect back with error message if product not found
        return redirect()->back()->with('error', 'Product not found');
    }
} catch (\Exception $e) {
    dd($e);
    // Handle any exceptions and redirect back with error message
    return redirect()->back()->with('error', 'Error updating profile: ' . $e->getMessage());
}
}

}