<?php

namespace App\Http\Controllers;

use App\Models\FarmProfile;
use App\Models\Fertilizer;
use App\Models\FixedCost;
use App\Models\Labor;
use App\Models\LastProductionDatas;
use App\Models\MachineriesUseds;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\AgriDistrict;
use Illuminate\Support\Facades\Storage;
use App\Models\PersonalInformations;
use App\Http\Requests\PersonalInformationsRequest;
use App\Http\Controllers\Backend\PersonalInformationsController;
use App\Models\Transport;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class AgentController extends Controller
{



    public function AgentDashboard(){
        $totalfarms= FarmProfile::count();
        $totalAreaPlanted = FarmProfile::sum('total_physical_area_has');
        $totalAreaYield = FarmProfile::sum('yield_kg_ha');
        $totalCost= VariableCost::sum('total_variable_cost');

        $yieldPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalAreaYield / $totalAreaPlanted : 0;
        $averageCostPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalCost / $totalAreaPlanted : 0;
        return view('agent.agent_index',compact('totalfarms','totalAreaPlanted','totalAreaYield','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted'));
    }
    public function agentlog(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');


      
    }//end 
//fetching the data of personal info, coordinates to inserted in farmprofile



      //agent add personal informations 
      public function addpersonalInfo(){
     // Assuming you have the authenticated user
    $user = Auth::user(); // Assuming you're using Laravel's authentication

    // Fetching user's id and agri_district
    $user_id = $user->id;
    $agri_district = $user->agri_district;

        return view('agent.personal_info.add_info', compact('user_id', 'agri_district'));
    }

    // agent input persona info
    public function addinfo(PersonalInformationsRequest $request)
    {
      
        try{
            // Check if the associated PersonalInformations record exists
    // Access the primary key of the PersonalInformations model instance

    $existingPersonalInformations = PersonalInformations::where([
        ['first_name', '=', $request->input('first_name')],
        ['middle_name', '=', $request->input('middle_name')],
        ['last_name', '=', $request->input('last_name')],
       
       
    
      
        // Add other fields here
    ])->first();
    
    if ($existingPersonalInformations) {
        // FarmProfile with the given personal_informations_id and other fields already exists
        // You can handle this scenario here, for example, return an error message
        return redirect('/add-personal-info')->with('error', 'Farm Profile with this information already exists.');
    }
    
    $personalInformation= $request->validated();
    $personalInformation= $request->all();
           $personalInformation= new PersonalInformations;
        //    dd($request->all());
     
  // Check if a file is present in the request and if it's valid
if ($request->hasFile('image') && $request->file('image')->isValid()) {
    // Retrieve the image file from the request
    $image = $request->file('image');
    
    // Generate a unique image name using current timestamp and file extension
    $imagename = time() . '.' . $image->getClientOriginalExtension();
    
    // Move the uploaded image to the 'personalInfoimages' directory with the generated name
    $image->move('personalInfoimages', $imagename);
    
    // Set the image name in the PersonalInformation model
    $personalInformation->image = $imagename;
} 
            $personalInformation->users_id =$request->users_id;
            $personalInformation->first_name= $request->first_name;
            $personalInformation->middle_name= $request->middle_name;
            $personalInformation->last_name=  $request->last_name;

            if ($request->extension_name === 'others') {
                $personalInformation->extension_name = $request->add_extName; // Use the value entered in the "add_extenstion name" input field
           } else {
                $personalInformation->extension_name = $request->extension_name; // Use the selected color from the dropdown
           }
            $personalInformation->country=  $request->country;
            $personalInformation->province=  $request->province;
            $personalInformation->city=  $request->city;
            $personalInformation->agri_district=  $request->agri_district;
            $personalInformation->barangay=  $request->barangay;
            
             $personalInformation->home_address=  $request->home_address;
             $personalInformation->sex=  $request->sex;

             if ($request->religion=== 'other') {
                $personalInformation->religion= $request->add_Religion; // Use the value entered in the "religion" input field
           } else {
                $personalInformation->religion= $request->religion; // Use the selected religion from the dropdown
           }
             $personalInformation->date_of_birth=  $request->date_of_birth;
            
             if ($request->place_of_birth=== 'Add Place of Birth') {
                $personalInformation->place_of_birth= $request->add_PlaceBirth; // Use the value entered in the "place_of_birth" input field
           } else {
                $personalInformation->place_of_birth= $request->place_of_birth; // Use the selected place_of_birth from the dropdown
           }
             $personalInformation->contact_no=  $request->contact_no;
             $personalInformation->civil_status=  $request->civil_status;
             $personalInformation->name_legal_spouse=  $request->name_legal_spouse;

             if ($request->no_of_children=== 'Add') {
                $personalInformation->no_of_children= $request->add_noChildren; // Use the value entered in the "no_of_children" input field
                } else {
                        $personalInformation->no_of_children= $request->no_of_children; // Use the selected no_of_children from the dropdown
                }
    
             $personalInformation->mothers_maiden_name=  $request->mothers_maiden_name;
             if ($request->highest_formal_education=== 'Other') {
                $personalInformation->highest_formal_education= $request->add_formEduc; // Use the value entered in the "highest_formal_education" input field
                } else {
                        $personalInformation->highest_formal_education= $request->highest_formal_education; // Use the selected highest_formal_education from the dropdown
                }
             $personalInformation->person_with_disability=  $request->person_with_disability;
             $personalInformation->pwd_id_no=  $request->pwd_id_no;
             $personalInformation->government_issued_id=  $request->government_issued_id;
             $personalInformation->id_type=  $request->id_type;
             $personalInformation->gov_id_no=  $request->gov_id_no;
             $personalInformation->member_ofany_farmers_ass_org_coop=  $request->member_ofany_farmers_ass_org_coop;
             
             if ($request->nameof_farmers_ass_org_coop === 'add') {
                $personalInformation->nameof_farmers_ass_org_coop = $request->add_FarmersGroup; // Use the value entered in the "add_extenstion name" input field
           } else {
                $personalInformation->nameof_farmers_ass_org_coop = $request->nameof_farmers_ass_org_coop; // Use the selected color from the dropdown
           }
             $personalInformation->name_contact_person=  $request->name_contact_person;
      
             $personalInformation->cp_tel_no=  $request->cp_tel_no;
            



        
            // dd($personalInformation);
             $personalInformation->save();
            return redirect('/add-farm-profile')->with('message','Personal informations added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/add-personal-info')->with('message','Someting went wrong');
            
        }   


        //inserting multiple insertion of data into database
        
        
               
          
  

} 
public function fetchtables()
{
    try {
        // Fetch farm locations with related data
        $farmLocation = DB::table('personal_informations')
            ->join('agri_districts', 'personal_informations.agri_districts_id', '=', 'agri_districts.id')
            // ->leftJoin('polygons', 'personal_informations.polygons_id', '=', 'polygons.id')
            ->select('personal_informations.*', 'agri_districts.*',)
            ->get();

        // Initialize arrays to store agri_district_ids and polygons_ids
        $agriDistrictIds = [];
        

        // Loop through each row of the result to extract agri_district_id and polygons_id
        foreach ($farmLocation as $location) {
            $agriDistrictIds[] = $location->id; // Assuming id refers to agri_district_id
           
        }

        // Pass data to the view
        return view('agent.farmprofile.add_profile', [
            'farmLocation' => $farmLocation,
            'agriDistrictIds' => $agriDistrictIds,
           
        ]);
    } catch (\Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        // Redirect back with error message
        return redirect()->back()->with('message', 'Something went wrong');
    }
}


public function farmprofiles(){
     // Assuming $user represents the currently logged-in user
     $user = auth()->user();

     // Check if user is authenticated before proceeding
     if (!$user) {
         // Handle unauthenticated user, for example, redirect them to login
         return redirect()->route('login');
     }
    $user_id = $user->id;
    $agri_districts = $user->agri_district;
    $agri_districts_id = $user->agri_districts_id;
    return view('agent.farmprofile.add_profile',compact('agri_districts','agri_districts_id'));
}
// public function farmprofiles(){
//     // Assuming $user represents the currently logged-in user
//     $user = auth()->user();

//     // Check if user is authenticated before proceeding
//     if (!$user) {
//         // Handle unauthenticated user, for example, redirect them to login
//         return redirect()->route('login');
//     }

//     // Fetching user ID
//     $user_id = $user->id;

//     // Fetching agri_districts for the user
//     $agri_districts = $user->agri_districts; // assuming 'agri_districts' is the relationship name

//     // Fetching agri_districts_id based on the user's ID and agri_districts
//     $agri_districts_ids = $agri_districts->pluck('id');

//     // Assuming AgriDistrict is your model for agricultural districts
//     // Fetching AgriDistricts based on their IDs
//     $agri_districts_info = AgriDistrict::whereIn('id', $agri_districts_ids)->get();

//     return view('agent.farmprofile.add_profile', compact('agri_districts_info'));
// }


// agent added new farm profiles
// public function AddFarmProfile(FarmProfileRequest $request)
//     {
       
//         try {
           
//             $user = auth()->user();
//             $data = $request->validated();
           

       

//     // Check if the associated PersonalInformations record exists
//     // Access the primary key of the PersonalInformations model instance

//     $existingFarmProfile = FarmProfile::where([
//         ['personal_informations_id', '=', $request->input('personal_informations_id')],
       
    
       
       
    
      
//         // Add other fields here
//     ])->first();
    
//     if ($existingFarmProfile) {
//         // FarmProfile with the given personal_informations_id and other fields already exists
//         // You can handle this scenario here, for example, return an error message
//         return redirect('/add-farm-profile')->with('error', 'Farm Profile with this information already exists.');
//     }
    

//             $farmProfile = new FarmProfile;
//             $farmProfile->personal_informations_id= $request->personal_informations_id;
//         //    $farmProfile->users_id= $request->users_id;
//         $farmProfile->agri_districts_id= $request->agri_districts_id;
//         // $farmProfile->polygons_id= $request->polygons_id;
//         $farmProfile->agri_districts= $request->agri_districts;
//         if ($request->tenurial_status=== 'Add') {
//               $farmProfile->tenurial_status= $request->add_newTenure; // Use the value entered in the "tenurial_status" input field
//             } else {
//                       $farmProfile->tenurial_status= $request->tenurial_status; // Use the selected no_of_children from the dropdown
//             }
//         $farmProfile->rice_farm_address= $request->rice_farm_address;
      
//         if ($request->no_of_years_as_farmers=== 'Add') {
//             $farmProfile->no_of_years_as_farmers= $request->add_newFarmyears; // Use the value entered in the "no_of_years_as_farmers" input field
//           } else {
//                     $farmProfile->no_of_years_as_farmers= $request->no_of_years_as_farmers; // Use the selected no_of_children from the dropdown
//           }
//         $farmProfile->gps_longitude= $request->gps_longitude;
//         $farmProfile->gps_latitude= $request->gps_latitude;
//         $farmProfile->total_physical_area_has= $request->total_physical_area_has;
//         $farmProfile->rice_area_cultivated_has= $request->rice_area_cultivated_has;
//         $farmProfile->land_title_no= $request->land_title_no;
//         $farmProfile->lot_no= $request->lot_no;
       
//         if ($request->area_prone_to=== 'Add Prone') {
//             $farmProfile->area_prone_to= $request->add_newProneYear; // Use the value entered in the "area_prone_to" input field
//           } else {
//                     $farmProfile->area_prone_to= $request->area_prone_to; // Use the selected no_of_children from the dropdown
//           }

//         if ($request->ecosystem=== 'Add ecosystem') {
//             $farmProfile->ecosystem= $request->Add_Ecosystem; // Use the value entered in the "ecosystem" input field
//           } else {
//                     $farmProfile->ecosystem= $request->ecosystem; // Use the selected no_of_children from the dropdown
//           }
//         $farmProfile->type_rice_variety= $request->type_rice_variety;
//         $farmProfile->prefered_variety= $request->prefered_variety;
//         $farmProfile->plant_schedule_wetseason= $request->plant_schedule_wetseason;
//         $farmProfile->plant_schedule_dryseason= $request->plant_schedule_dryseason;
      
//         if ($request->no_of_cropping_yr=== 'Adds') {
//             $farmProfile->no_of_cropping_yr= $request->add_cropyear; // Use the value entered in the "no_of_cropping_yr" input field
//           } else {
//                     $farmProfile->no_of_cropping_yr= $request->no_of_cropping_yr; // Use the selected no_of_children from the dropdown
//           }
//         $farmProfile->yield_kg_ha= $request->yield_kg_ha;
//         $farmProfile->rsba_register= $request->rsba_register;
//         $farmProfile->pcic_insured= $request->pcic_insured;
//         $farmProfile->government_assisted= $request->government_assisted;
       
//         if ($request->source_of_capital=== 'Others') {
//             $farmProfile->source_of_capital= $request->add_sourceCapital; // Use the value entered in the "source_of_capital" input field
//           } else {
//                     $farmProfile->source_of_capital= $request->source_of_capital; // Use the selected no_of_children from the dropdown
//           }
//         $farmProfile->remarks_recommendation= $request->remarks_recommendation;
//         $farmProfile->oca_district_office= $request->oca_district_office;
//         $farmProfile->name_technicians= $request->name_technicians;
//         $farmProfile->date_interview= $request->date_interview;



//           dd($farmProfile);
//         //   save new info
//         $farmProfile->save();

         
    

// return redirect('/add-fixed-cost')->with('message', 'Farm Profile added successfully');
// } catch (\Exception $ex) {
//     // Handle the exception
//    dd($ex);
//     return redirect('/add-farm-profile')->with('message', 'Something went wrong');
// }
       
//     }
public function AddFarmProfile(FarmProfileRequest $request)
{
    try {
        // Get authenticated user
        $user = auth()->user();

        // Validate the incoming request data
        $data = $request->validated();

        // Check if FarmProfile with the given personal_informations_id already exists
        $existingFarmProfile = FarmProfile::where('personal_informations_id', $request->input('personal_informations_id'))->first();

        if ($existingFarmProfile) {
            return redirect('/add-farm-profile')->with('error', 'Farm Profile with this information already exists.');
        }

        // Create a new FarmProfile instance
        $farmProfile = new FarmProfile;
        $farmProfile->personal_informations_id = $request->personal_informations_id;
        $farmProfile->agri_districts_id = $request->agri_districts_id;
        $farmProfile->agri_districts = $request->agri_districts;
        $farmProfile->tenurial_status = $request->tenurial_status === 'Add' ? $request->add_newTenure : $request->tenurial_status;
        $farmProfile->rice_farm_address = $request->rice_farm_address;
        $farmProfile->no_of_years_as_farmers = $request->no_of_years_as_farmers === 'Add' ? $request->add_newFarmyears : $request->no_of_years_as_farmers;
        $farmProfile->gps_longitude = $request->gps_longitude;
        $farmProfile->gps_latitude = $request->gps_latitude;
        $farmProfile->total_physical_area_has = $request->total_physical_area_has;
        $farmProfile->rice_area_cultivated_has = $request->rice_area_cultivated_has;
        $farmProfile->land_title_no = $request->land_title_no;
        $farmProfile->lot_no = $request->lot_no;
        $farmProfile->area_prone_to = $request->area_prone_to === 'Add Prone' ? $request->add_newProneYear : $request->area_prone_to;
        $farmProfile->ecosystem = $request->ecosystem === 'Add ecosystem' ? $request->Add_Ecosystem : $request->ecosystem;
        $farmProfile->type_rice_variety = $request->type_rice_variety;
        $farmProfile->prefered_variety = $request->prefered_variety;
        $farmProfile->plant_schedule_wetseason = $request->plant_schedule_wetseason;
        $farmProfile->plant_schedule_dryseason = $request->plant_schedule_dryseason;
        $farmProfile->no_of_cropping_yr = $request->no_of_cropping_yr === 'Adds' ? $request->add_cropyear : $request->no_of_cropping_yr;
        $farmProfile->yield_kg_ha = $request->yield_kg_ha;
        $farmProfile->rsba_register = $request->rsba_register;
        $farmProfile->pcic_insured = $request->pcic_insured;
        $farmProfile->government_assisted = $request->government_assisted;
        $farmProfile->source_of_capital = $request->source_of_capital === 'Others' ? $request->add_sourceCapital : $request->source_of_capital;
        $farmProfile->remarks_recommendation = $request->remarks_recommendation;
        $farmProfile->oca_district_office = $request->oca_district_office;
        $farmProfile->name_technicians = $request->name_technicians;
        $farmProfile->date_interview = $request->date_interview;
        // dd($farmProfile);
        // Save the new FarmProfile
        $farmProfile->save();

        // Redirect with success message
        return redirect('/add-fixed-cost')->with('message', 'Farm Profile added successfully');
    } catch (\Exception $ex) {
        // Log the exception or handle it appropriately
        dd($ex);
        return redirect('/add-farm-profile')->with('message', 'Something went wrong');
    }
}

// agent fixed cost view
public function fixedCost(){
    return view('agent.fixedcost.add_fcost');
}

//agent add a new fixed cost

public function AddFcost(FixedCostRequest $request)
{
    try{

        $existingFixedCost =  FixedCost::where([
            ['personal_informations_id', '=', $request->input('personal_informations_id')],
            ['farm_profiles_id', '=', $request->input('farm_profiles_id')],
        

            // Add other fields here
        ])->first();
        
        if ( $existingFixedCost) {
            // FarmProfile with the given personal_informations_id and other fields already exists
            // You can handle this scenario here, for example, return an error message
            return redirect('/add-farm-profile')->with('error', 'Farm Profile with this information already exists.');
        }


        $data= $request->validated();
        $data= $request->all();
        $fixedcost= new FixedCost;
        $fixedcost->personal_informations_id = $request->personal_informations_id;
        $fixedcost->farm_profiles_id = $request->farm_profiles_id;
        $fixedcost->particular = $request->particular=== 'Other' ? $request->Add_Particular : $request->particular;
        $fixedcost->no_of_ha = $request->no_of_ha;
        $fixedcost->cost_per_ha = $request->cost_per_ha;
        $fixedcost->total_amount = $request->total_amount;
    
    //    dd($fixedcost);
        $fixedcost->save();


        return redirect('/add-machinereies-used')->with('message','Machineries Cost added successsfully');
    
    }
    catch(\Exception $ex){
        return redirect('/add-fixed-cost')->with('message','Someting went wrong');
    }
}

//agent machineris used view
public function machineUsed(){
    return view('agent.machineused.add_mused');
}

// agent add new machineries used
public function AddMused(MachineriesUsedtRequest $request)
{
    try{
        $existingMachineriesUseds =  MachineriesUseds::where([
            ['personal_informations_id', '=', $request->input('personal_informations_id')],
            ['farm_profiles_id', '=', $request->input('farm_profiles_id')],
        

            // Add other fields here
        ])->first();
        
        if ($existingMachineriesUseds) {
            // FarmProfile with the given personal_informations_id and other fields already exists
            // You can handle this scenario here, for example, return an error message
            return redirect('/add-machinereies-used')->with('error', 'Farm Profile with this information already exists.');
        }



        $data= $request->validated();
        $data= $request->all();
       $machineused= new MachineriesUseds;
       $machineused-> personal_informations_id = $request->personal_informations_id;
       $machineused->farm_profiles_id = $request->farm_profiles_id;
       $machineused-> plowing_machineries_used = $request->plowing_machineries_used === 'OthersPlowing' ? $request->add_Plowingmachineries : $request->plowing_machineries_used;
       $machineused-> plo_ownership_status = $request->plo_ownership_status === 'Other' ? $request->add_PlowingStatus : $request->plo_ownership_status;
       $machineused->no_of_plowing = $request->no_of_plowing;
       $machineused->cost_per_plowing = $request->cost_per_plowing;
       $machineused-> plowing_cost = $request->plowing_cost;
        
       $machineused-> harrowing_machineries_used = $request->harrowing_machineries_used=== 'OtherHarrowing' ? $request->Add_HarrowingMachineries : $request->harrowing_machineries_used;
       $machineused->harro_ownership_status = $request->harro_ownership_status=== 'Otherharveststat' ? $request->add_harvestingStatus : $request->harro_ownership_status;
       $machineused->no_of_harrowing = $request->no_of_harrowing; 
       $machineused->cost_per_harrowing = $request->cost_per_harrowing; 
       $machineused->harrowing_cost = $request->harrowing_cost;

       $machineused->harvesting_machineries_used = $request->harvesting_machineries_used=== 'OtherHarvesting' ? $request->add_HarvestingMachineries : $request->harvesting_machineries_used;
       $machineused->harvest_ownership_status = $request->harvest_ownership_status=== 'OtherHarvesting' ? $request->add_HarvestingMachineries : $request->harvest_ownership_status;
       $machineused->harvesting_cost = $request->harvesting_cost;

       $machineused->postharvest_machineries_used = $request->postharvest_machineries_used=== 'Otherpostharvest' ? $request->add_postharvestMachineries : $request->postharvest_machineries_used;
       $machineused->postharv_ownership_status = $request->postharv_ownership_status=== 'OtherpostharvestStatus' ? $request->add_postStatus : $request->postharv_ownership_status;
       $machineused->post_harvest_cost = $request->post_harvest_cost;
       $machineused->total_cost_for_machineries = $request->total_cost_for_machineries;
         
        // dd($machineused);
        $machineused->save();
        return redirect('/add-variable-cost-seed')->with('message','Machineries Used added successsfully');
    
    }
    catch(\Exception $ex){

        dd($ex);
        return redirect('/add-machinereies-used')->with('message','Someting went wrong');
    }
}

// agent lastt production view
public function LastProduction(){
    return view('agent.lastproduction.add_production');
}

// agent added new last production data
public function AddNewProduction(LastProductionDatasRequest $request)
    {
        try{
            $existingLastProductionDatas =  LastProductionDatas::where([
                ['personal_informations_id', '=', $request->input('personal_informations_id')],
                ['farm_profiles_id', '=', $request->input('farm_profiles_id')],
                ['agri_districts_id', '=', $request->input('agri_districts_id')],
            
    
                // Add other fields here
            ])->first();
            
            if ($existingLastProductionDatas) {
                // FarmProfile with the given personal_informations_id and other fields already exists
                // You can handle this scenario here, for example, return an error message
                return redirect('/add-machinereies-used')->with('error', 'Farm Profile with this information already exists.');
            }
    


            $data= $request->validated();
            $data= $request->all();
           $lastproduction= new LastProductionDatas;

           $lastproduction->personal_informations_id = $request->personal_informations_id;
           $lastproduction->farm_profiles_id = $request->farm_profiles_id;
           $lastproduction->agri_districts_id = $request->agri_districts_id;
           $lastproduction->seeds_typed_used = $request->seeds_typed_used;
           $lastproduction->seeds_used_in_kg = $request->seeds_used_in_kg;
           $lastproduction->seed_source = $request->seed_source=== 'Add' ? $request->add_seedsource : $request->seed_source;
           $lastproduction->no_of_fertilizer_used_in_bags = $request->no_of_fertilizer_used_in_bags;
                
           $lastproduction->no_of_pesticides_used_in_l_per_kg = $request->no_of_pesticides_used_in_l_per_kg;
           $lastproduction->no_of_insecticides_used_in_l = $request->no_of_insecticides_used_in_l;
           $lastproduction->area_planted = $request->area_planted;
           $lastproduction->date_planted = $request->date_planted;
           $lastproduction->date_harvested = $request->date_harvested;
           $lastproduction->yield_tons_per_kg = $request->yield_tons_per_kg;
        
           $lastproduction->unit_price_palay_per_kg = $request->unit_price_palay_per_kg;
           $lastproduction->unit_price_rice_per_kg = $request->unit_price_rice_per_kg;
           $lastproduction->type_of_product = $request->type_of_product;
           $lastproduction->sold_to = $request->sold_to;
           $lastproduction->if_palay_milled_where =  $request->if_palay_milled_where;
           $lastproduction->gross_income_palay = $request->gross_income_palay;
           $lastproduction->gross_income_rice =  $request->gross_income_rice;
        
            // dd($lastproduction);
            $lastproduction->save();
            return redirect('/add-personal-info')->with('message','Rice Survey Form Completed!');
        
        }
        catch(\Exception $ex){
            return redirect('/add-last-production')->with('message','Someting went wrong');
        }
    }

// varaible cost nott yet have bblade view remember

// agnet varaible cost view seed 

public function variableSeed(){
    return view('agent.variablecost.seed.add_seeds');
}


// agent added new last production data
public function AddNewSeeed(SeedRequest $request)
{
    try{
        $data= $request->validated();
        $data= $request->all();
        $seeds= new Seed;
        $seeds->seed_name = $request->seed_name === 'OtherseedName' 
        ? $request->add_newInbreeds 
        : ($request->seed_name === 'OtherseedVarie' 
            ? $request->add_newInbreed
            : $request->seed_name);


        $seeds->seed_type = $request->seed_type === 'OtherseedVariety' ? $request->AddRiceVariety : $request->seed_type;
       
        $seeds->unit = $request->unit;
        $seeds->quantity = $request->quantity;
        $seeds->unit_price = $request->unit_price;
        $seeds->total_seed_cost = $request->total_seed_cost;
        // dd($seeds);
        $seeds->save();
        return redirect('/add-variable-cost-labor')->with('message','Rice Seeds added successsfully');
    
    }
    catch(\Exception $ex){
        return redirect('/add-variable-cost-seed')->with('message','Someting went wrong');
    }
}

// agnet varaible cost view labor

public function variableLabor(){
    return view('agent.variablecost.labor.add_labors');
}

// add new variable cost labor
public function AddNewLabor(laborRequest $request)
{
    try{
        $data= $request->validated();
        $data= $request->all();
        Labor::create($data);

        return redirect('/add-variable-cost-fertilizers')->with('message','Labors data added successsfully');
    
    }
    catch(\Exception $ex){
        return redirect('/add-variable-cost-labor')->with('message','Someting went wrong');
    }
}

//agent variablecost fertilizers

public function variableFertilizers(){
    return view('agent.variablecost.fertilizers.add_fertilizer');
}

//agent variablecost fertilizers add new
// public function AddNewfertilizers(Request $request)
// {
//     try{
//         // $data= $request->validated();
//         // $data= $request->all();
//         $fertilizer= new Fertilizer;
//         $fertilizer->name_of_fertilizer = $request->name_of_fertilizer === 'other' ? $request->additionalFertilizer : $request->name_of_fertilizer;
//         $fertilizer->type_of_fertilizer = $request->type_of_fertilizer;
//         $fertilizer->no_ofsacks = $request->no_ofsacks;
//         $fertilizer->unitprice_per_sacks = $request->unitprice_per_sacks;
//         $fertilizer->total_cost_fertilizers = $request->total_cost_fertilizers;
//         dd($fertilizer);
//         $fertilizer->save();
//         return redirect('/add-variable-cost-pesticides')->with('message','Fertilizers data added successsfully');
    
//     }
//     catch(\Exception $ex){
//         return redirect('/add-variable-cost-fertilizers')->with('message','Someting went wrong');
//     }
// }
public function AddNewfertilizers(FertilizerRequest $request)
{
    try {
         $data= $request->validated();
        // $data= $request->all();
        $fertilizer = new Fertilizer;
        if ($request->name_of_fertilizer === 'other') {
            // If 'other' option is selected, use the value from the additionalFertilizer field
            $fertilizer->name_of_fertilizer = $request->additionalFertilizer;
            // You may also want to handle the type_of_fertilizer differently here based on your requirement
            $fertilizer->type_of_fertilizer = $request->type_of_fertilizers;
        } else {
            // If a predefined option is selected, use its value for both name_of_fertilizer and type_of_fertilizer
            $fertilizer->name_of_fertilizer = $request->name_of_fertilizer;
            $fertilizer->type_of_fertilizer = $request->type_of_fertilizer;
        }
        // Proceed with other fields as usual
        $fertilizer->no_ofsacks = $request->no_ofsacks;
        $fertilizer->unitprice_per_sacks = $request->unitprice_per_sacks;
        $fertilizer->total_cost_fertilizers = $request->total_cost_fertilizers;
        // dd($fertilizer);
        // Save the fertilizer data
        $fertilizer->save();
        
        // Redirect with success message
        return redirect('/add-variable-cost-pesticides')->with('message', 'Fertilizer data added successfully');
    } catch (\Exception $e) {
        // Handle any exceptions here
        // For example, you can return an error response or redirect back with an error message
        return redirect()->back()->withInput()->withErrors(['error' => 'Failed to add Fertilizer data. Please try again.']);
    }
}    

// Agent variable cost pesticides view
 public function variablePesticides(){
    return view('agent.variablecost.pesticides.add_pesticide');
 }

//  agent variablecost pesticides add new
public function AddNewPesticide( PesticidesRequest $request)
    {
        try{
            $data= $request->validated();
            $data= $request->all();
           
            $pesticides = new Pesticide;
            if ($request->pesticides_name === 'OtherPestName') {
                // If 'OtherPestName' option is selected, use the value from the additionalFertilizer field
                $pesticides->pesticides_name = $request->add_PestName;
                // You may also want to handle the type_ofpesticides differently here based on your requirement
                $pesticides->type_ofpesticides = $request->Add_typePest;
            } else {
                // If a predefined option is selected, use its value for both pesticides_name and type_ofpesticides
                $pesticides->pesticides_name = $request->pesticides_name;
                $pesticides->type_ofpesticides = $request->type_ofpesticides;
            }
            // Proceed with OtherPestName fields as usual
            $pesticides->no_of_l_kg = $request->no_of_l_kg;
            $pesticides->unitprice_ofpesticides = $request->unitprice_ofpesticides;
            $pesticides->total_cost_pesticides = $request->total_cost_pesticides;
            // dd($pesticides);
            // Save the pesticides data
            $pesticides->save();
            return redirect('/add-variable-cost-transport')->with('message','Pesticides data added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/add-variable-cost-pesticides ')->with('message','Someting went wrong');
        }
    }

    // agent variable cost transport
    public function variableTransport(){
        return view('agent.variablecost.transport.add_transports');
    }
//  agent add new variable cost transport
public function AddNewTransport(TransportRequest $request)
{
    try{
        $data= $request->validated();
        $data= $request->all();
        Transport::create($data);

        return redirect('/add-variable-cost-vartotal')->with('message','transport data added successsfully');
    
    }
    catch(\Exception $ex){
        return redirect('/add-variable-cost-transport')->with('message','Someting went wrong');
    }
}

// agent varible cost variabletotal
public function variableVartotal(){
    return view('agent.variablecost.variable_total.add_vartotal');

}

// agent add new varaible cost vartotal
public function AddNewVartotal(VariableCostRequest $request)
    {
        {
            try{
                $existingVariableCost =  VariableCost::where([
                    ['personal_informations_id', '=', $request->input('personal_informations_id')],
                    ['farm_profiles_id', '=', $request->input('farm_profiles_id')],
                    ['seeds_id', '=', $request->input('seeds_id')],
                    ['labors_id', '=', $request->input('labors_id')],
                    ['fertilizers_id', '=', $request->input('fertilizers_id')],
                
                    ['pesticides_id', '=', $request->input('pesticides_id')],
                    ['transports_id', '=', $request->input('transports_id')],
                
                
        
                    // Add other fields here
                ])->first();
                
                if ($existingVariableCost) {
                    // FarmProfile with the given personal_informations_id and other fields already exists
                    // You can handle this scenario here, for example, return an error message
                    return redirect('/add-variable-cost-vartotal')->with('error', 'VariableCost with this information already exists.');
                }
                $data= $request->validated();
                $data= $request->all();
                
              $vartotal= new VariableCost;
              $vartotal->personal_informations_id = $request->personal_informations_id;
              $vartotal->farm_profiles_id = $request->farm_profiles_id;
              $vartotal->seeds_id = $request->seeds_id;
              $vartotal->labors_id = $request->labors_id;
              $vartotal->fertilizers_id = $request->fertilizers_id;
              $vartotal->pesticides_id = $request->pesticides_id;
              $vartotal->transports_id = $request->transports_id;
              $vartotal->total_seed_cost = $request->total_seed_cost;
              $vartotal->total_labor_cost = $request->total_labor_cost;
              $vartotal->total_cost_fertilizers = $request->total_cost_fertilizers;
              $vartotal->total_cost_pesticides = $request->total_cost_pesticides;
              $vartotal->total_transport_per_deliverycost = $request->total_transport_per_deliverycost;


              $vartotal->total_machinery_fuel_cost =$request->total_machinery_fuel_cost;
              $vartotal->total_variable_cost =$request->total_variable_cost;
             
            //   dd($vartotal);
               $vartotal->save();
                return redirect('/add-last-production')->with('message','Variable Cost Added Successfully');
            
            }
            catch(\Exception $ex){
                // dd($ex);
                return redirect('/add-variable-cost-vartotal')->with('message','Someting went wrong');
            }
        }
    }




// checking of the Receipt of datta inserted for personal information
public function viewpersoninfo(){
   $personalinformations=PersonalInformations::orderBy('id','desc')->paginate(20);
    return view('agent.personal_info.view_infor',compact('personalinformations'));
}

// UPDATE view
public function updateview($id){
    $personlinformation=PersonalInformations::find($id);
    return view('agent.personal_info.update_records',compact('personlinformation'));
}
// edit the receipt form
public function updateinfo(PersonalInformationsRequest $request,$id)
{
  
    try{
        

        $data= $request->validated();
        $data= $request->all();
        $data= PersonalInformations::find($id);
                                    
                // Check if a file is present in the request and if it's valid
                if ($request->hasFile('personal_photo') && $request->file('personal_photo')->isValid()) {
                    // Retrieve the personal_photo file from the request
                    $personal_photo = $request->file('personal_photo');

                    // Generate a unique personal_photo name using current timestamp and file extension
                    $imagename = time() . '.' . $personal_photo->getClientOriginalExtension();

                    // Move the uploaded personal_photo to the 'productimages' directory with the generated name
                    $personal_photo->move('farmimages', $imagename);

                    // Delete the previous personal_photo file, if exists
                    if ($data->personal_photo) {
                        Storage::delete('farmimages/' . $data->personal_photo);
                    }

                    // Set the personal_photo name in the Product data
                    $data->personal_photo = $imagename;
                }
            $data->first_name = $request->first_name;
        $data->middle_name = $request->middle_name;
        $data->last_name = $request->last_name;
        $data->extension_name = $request->extension_name;
        $data->home_address = $request->home_address;
        $data->sex = $request->sex;
        $data->religion = $request->religion;
        $data->date_of_birth = $request->date_of_birth;
        $data->place_of_birth = $request->place_of_birth;
        $data->contact_no = $request->contact_no;
        $data->civil_status = $request->civil_status;
        $data->name_legal_spouse = $request->name_legal_spouse;

        $data->no_of_children = $request->no_of_children;
        $data->mothers_maiden_name = $request->mothers_maiden_name;
        $data->highest_formal_education = $request->highest_formal_education;
        $data->person_with_disability = $request->person_with_disability;
        $data->pwd_id_no = $request->pwd_id_no;
        $data->government_issued_id = $request->government_issued_id;
        $data->id_type = $request->id_type;
        $data->gov_id_no = $request->gov_id_no;
        $data->member_ofany_farmers_ass_org_coop = $request->member_ofany_farmers_ass_org_coop;
        $data->nameof_farmers_ass_org_coop = $request->nameof_farmers_ass_org_coop;
        $data->name_contact_person = $request->name_contact_person;
        $data->cp_tel_no = $request->cp_tel_no;
        $data->cp_tel_no = $request->cp_tel_no;

      
         $data->save();     
        
       
        return redirect('/show-personal-info')->with('message','Personal informations Updated successsfully');
    
    }
    catch(\Exception $ex){
        // dd($ex); // Debugging statement to inspect the exception
        return redirect('/update-personal-info/{personlinformations}')->with('message','Someting went wrong');
        
    }   
} 

// deleting personal informations
public function infodelete($id) {
    try {
        // Find the personal information by ID
        $personalinformations = PersonalInformations::find($id);

        // Check if the personal information exists
        if (!$personalinformations) {
            return redirect()->back()->with('error', 'Personal information not found');
        }

        // Delete the personal information data from the database
        $personalinformations->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Personal information deleted successfully');

    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}








public function showfarm(){
    $farmprofiles=FarmProfile::orderBy('id','desc')->paginate(20);
    return view('agent.farmprofile.farm_view',compact('farmprofiles'));
}
// agent farm profile update data view
public function farmUpdate($id){
    $farmprofiles=FarmProfile::find($id);
    return view('agent.farmprofile.farm_update',compact('farmprofiles'));
}


// agent farm profile update data
    public function updatesFarm(FarmProfileRequest $request,$id)
    {
    
        try{
            

            $data= $request->validated();
            $data= $request->all();
            
            $data= FarmProfile::find($id);

 // Check if a file is present in the request and if it's valid
 if ($request->hasFile('farm_images') && $request->file('farm_images')->isValid()) {
    // Retrieve the farm_images file from the request
    $farm_images = $request->file('farm_images');

    // Generate a unique farm_images name using current timestamp and file extension
    $imagename = time() . '.' . $farm_images->getClientOriginalExtension();

    // Move the uploaded farm_images to the 'productimages' directory with the generated name
    $farm_images->move('farmimages', $imagename);

    // Delete the previous farm_images file, if exists
    if ($data->farm_images) {
        Storage::delete('farmimages/' . $data->farm_images);
    }

    // Set the farm_images name in the Product data
    $data->farm_images = $imagename;
}
            $data->personal_informations_id = $request->personal_informations_id;  
            $data->agri_districts_id = $request->agri_districts_id;
            $data->tenurial_status = $request->tenurial_status;
            $data->rice_farm_address = $request->rice_farm_address;
            $data->no_of_years_as_farmers = $request->no_of_years_as_farmers;
            $data->gps_longitude = $request->gps_longitude;
            $data->gps_latitude = $request->gps_latitude;
            $data->total_physical_area_has = $request->total_physical_area_has;
            $data->rice_area_cultivated_has = $request->rice_area_cultivated_has;
            $data->rice_area_cultivated_has = $request->rice_area_cultivated_has;
            $data->land_title_no = $request->land_title_no;
            $data->lot_no = $request->lot_no;
            $data->area_prone_to= $request->area_prone_to;

            $data->ecosystem = $request->ecosystem;
            $data->type_rice_variety = $request->type_rice_variety;
            $data->prefered_variety = $request->prefered_variety;
            $data->plant_schedule_wetseason = $request->plant_schedule_wetseason;
            $data->plant_schedule_dryseason = $request->plant_schedule_dryseason;
            $data->no_of_cropping_yr = $request->no_of_cropping_yr;
            $data->yield_kg_ha = $request->yield_kg_ha;
            $data->rsba_register = $request->rsba_register;
            $data->pcic_insured = $request->pcic_insured;
            $data->source_of_capital = $request->source_of_capital;
            $data->remarks_recommendation = $request->remarks_recommendation;
            $data->oca_district_office = $request->oca_district_office;
            $data->name_technicians = $request->name_technicians;
            $data->date_interview = $request->date_interview;

            
            $data->save();     
            
        
            return redirect('/show-farm-profile')->with('message','Farm Profile Data Update successsfully');
        
        }
        catch(\Exception $ex){
            // dd($ex); // Debugging statement to inspect the exception
            return redirect('/update-farm-profile/{farmprofiles}')->with('message','Someting went wrong');
            
        }   
    } 

// fFarm profile delete
public function farmdelete($id) {
    try {
        // Find the personal information by ID
        $farmprofiles = FarmProfile::find($id);

        // Check if the personal information exists
        if (!$farmprofiles) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
        $farmprofiles->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Farm Profile deleted successfully');

    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}

// fixed cost view
public function viewFixed(){
    $fixedcosts=FixedCost::orderBy('id','desc')->paginate(20);
    return view('agent.fixedcost.fcost_view',compact('fixedcosts'));
}

// fixed cost update
public function FixedUpdate($id){
    $fixedcosts=FixedCost::find($id);
    return view('agent.fixedcost.fixed_updates',compact('fixedcosts'));
}

public function UpdateFixedCost(FixedCostRequest $request,$id)
{

    try{
        

        $data= $request->validated();
        $data= $request->all();
        
        $data= FixedCost::find($id);

        $data->personal_informations_id = $request->personal_informations_id;  
        $data->farm_profiles_id = $request->farm_profiles_id;
        $data->particular = $request->particular;
        $data->no_of_ha = $request->no_of_ha;
        $data->cost_per_ha = $request->cost_per_ha;
        $data->total_amount = $request->total_amount;
  
       

        
        $data->save();     
        
    
        return redirect('/show-fixed-cost')->with('message','Fixed cost Data Updated successsfully');
    
    }
    catch(\Exception $ex){
        // dd($ex); // Debugging statement to inspect the exception
        return redirect('/update-farm-profile/{farmprofiles}')->with('message','Someting went wrong');
        
    }   
} 






public function fixedcostdelete($id) {
    try {
        // Find the personal information by ID
       $fixedcosts = FixedCost::find($id);

        // Check if the personal information exists
        if (!$fixedcosts) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
       $fixedcosts->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Fixed Cost deleted Successfully');

    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}



// machineries used view 
public function showMachine(){
    $machineries= MachineriesUseds::orderBy('id','desc')->paginate(20);
    return view('agent.machineused.show_maused',compact('machineries'));
}


// fixed cost update
public function MachineUpdate($id){
   $machineries=MachineriesUseds::find($id);
    return view('agent.machineused.update_machine',compact('machineries'));
}



public function UpdateMachines(MachineriesUsedtRequest $request,$id)
{

    try{
        

        $data= $request->validated();
        $data= $request->all();
        
        $data= MachineriesUseds::find($id);

        $data->personal_informations_id = $request->personal_informations_id;  
        $data->farm_profiles_id = $request->farm_profiles_id;
        $data->plowing_machineries_used = $request->plowing_machineries_used;
        $data->plo_ownership_status = $request->plo_ownership_status;
        $data->no_of_plowing = $request->no_of_plowing;
        $data->plowing_cost = $request->plowing_cost;
        
        $data->harrowing_machineries_used = $request->harrowing_machineries_used;
        $data->harro_ownership_status = $request->harro_ownership_status;
        $data->no_of_harrowing = $request->no_of_harrowing;

        $data->harrowing_cost = $request->harrowing_cost;
        $data->harvesting_machineries_used = $request->harvesting_machineries_used;
        $data->harvest_ownership_status = $request->harvest_ownership_status;
        $data->harvesting_cost = $request->harvesting_cost;
        $data->postharvest_machineries_used = $request->postharvest_machineries_used;
        $data->postharv_ownership_status = $request->postharv_ownership_status;
        $data->post_harvest_cost = $request->post_harvest_cost;
       
        $data->total_cost_for_machineries = $request->total_cost_for_machineries;
  

       
        $data->save();     
        
    
        return redirect('/show-machinereies-used')->with('message','Machineries Used Data Updated successsfully');
    
    }
    catch(\Exception $ex){
        // dd($ex); // Debugging statement to inspect the exception
        return redirect('/update-machineries-used/{machineries}')->with('message','Someting went wrong');
        
    }   
} 






public function machinedelete($id) {
    try {
        // Find the personal information by ID
      $machineries =MachineriesUseds::find($id);

        // Check if the personal information exists
        if (!$machineries) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
      $machineries->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Machineries Used deleted Successfully');

    } catch (\Exception $e) {
        dd($e);// Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}

// last production view
public function viewProduction(){
    $productions= LastProductionDatas::orderBy('id','desc')->paginate(20);
    return view('agent.lastproduction.view_prod',compact('productions'));
}

// last prduction view update
public function produpdate($id){
     $productions= LastProductionDatas::find($id);
     return view('agent.lastproduction.last_edit',compact('productions'));
 }

 public function update(LastProductionDatasRequest $request,$id)
{

    try{
        

        $data= $request->validated();
        $data= $request->all();
        
        $data=LastProductionDatas::find($id);

        $data->personal_informations_id = $request->personal_informations_id;  
        $data->farm_profiles_id = $request->farm_profiles_id;
        $data->agri_districts_id = $request->agri_districts_id;

        $data->seeds_typed_used = $request->seeds_typed_used;
        $data->seeds_used_in_kg = $request->seeds_used_in_kg;
        $data->seed_source = $request->seed_source;
        
        $data->no_of_fertilizer_used_in_bags = $request->no_of_fertilizer_used_in_bags;
        $data->no_of_pesticides_used_in_l_per_kg = $request->no_of_pesticides_used_in_l_per_kg;
        $data->no_of_insecticides_used_in_l = $request->no_of_insecticides_used_in_l;

        $data->area_planted = $request->area_planted;
        $data->date_planted = $request->date_planted;
        $data->date_harvested = $request->date_harvested;
        $data->yield_tons_per_kg = $request->yield_tons_per_kg;
        $data->unit_price_palay_per_kg = $request->unit_price_palay_per_kg;
        $data->unit_price_rice_per_kg = $request->unit_price_rice_per_kg;
        $data->type_of_product = $request->type_of_product;
       
        $data->sold_to = $request->sold_to;
  
        $data->if_palay_milled_where= $request->if_palay_milled_where;
        
        $data->gross_income_palay = $request->gross_income_palay;
        
        $data->gross_income_rice= $request->gross_income_rice;

        
        $data->save();     
        
    
        return redirect('/show-last-production')->with('message','Last Production Data Updated successsfully');
    
    }
    catch(\Exception $ex){
        // dd($ex); // Debugging statement to inspect the exception
        return redirect('/update-last-production/{productions}')->with('message','Someting went wrong');
        
    }   
} 






public function ProductionDelete($id) {
    try {
        // Find the personal information by ID
       $productions =LastProductionDatas::find($id);

        // Check if the personal information exists
        if (! $productions) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
       $productions->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Last Production Data deleted Successfully');

    } catch (\Exception $e) {
        dd($e);// Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}

// varaible cost view, edit, update and delete access by agent
public function  displayvar(){
    $variable= VariableCost::orderBy('id','desc')->paginate(10);
    return view('agent.variablecost.variable_total.show_var',compact('variable'));
}





public function varupdate($id){
   $variable= VariableCost::find($id);
    return view('agent.variablecost.variable_total.var_edited',compact('variable'));
}

public function updatevaria(VariableCostRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=VariableCost::find($id);

       $data->personal_informations_id = $request->personal_informations_id;  
       $data->farm_profiles_id = $request->farm_profiles_id;


       $data->seeds_id = $request->seeds_id;
       $data->labors_id = $request->labors_id;
       $data->fertilizers_id = $request->fertilizers_id;
       
       $data->pesticides_id = $request->pesticides_id;
       $data->transports_id = $request->transports_id;
       $data->total_machinery_fuel_cost = $request->total_machinery_fuel_cost;

       $data->total_variable_cost = $request->total_variable_cost;
 
       $data->save();     
       
   
       return redirect('/show-last-production')->with('message','Variable Cost Data Updated successsfully');
   
   }
   catch(\Exception $ex){
       dd($ex); // Debugging statement to inspect the exception
       return redirect('update-variable-cost/{variable}')->with('message','Someting went wrong');
       
   }   
} 






public function vardelete($id) {
   try {
       // Find the personal information by ID
     $variable =VariableCost::find($id);

       // Check if the personal information exists
       if (!$variable) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
     $variable->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'Variable Cost deleted Successfully');

   } catch (\Exception $e) {
       dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}




// agent update profile


public function AgentProfile(){
    $id =Auth::user()->id;
    $agent = User:: find($id);
    return view('agent.profile.agent_profiles', compact('agent'));
}

public function Agentupdate(Request $request){
   
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
     return redirect()->route('agent.profile.agent_profiles')->with('message', 'Profile updated successfully');
    } else {
        // Redirect back with error message if product not found
        return redirect()->back()->with('error', 'Product not found');
    }
} catch (\Exception $e) {
    dd($e);
    // Handle any exceptions and redirect back with error message
    return redirect()->back()->with('error', 'Error updating product: ' . $e->getMessage());
}
}




// Seeds data update and view accessed by agent

public function SeedDataView(){
    $seeds= Seed::orderBy('id','desc')->paginate(10);
    return view('agent.variablecost.seed.show_seeds_data',compact('seeds'));
}





public function SeedsUpdate($id){
    $seeds= Seed::find($id);
    return view('agent.variablecost.seed.seeds_form_edit',compact('seeds'));
}

public function SeedDataupdate(SeedRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Seed::find($id);

       $data->seed_name = $request->seed_name;  
       $data->seed_type = $request->seed_type;
       $data->unit = $request->unit;
       $data->quantity = $request->quantity;
       $data->unit_price = $request->unit_price;

       $data->total_seed_cost = $request->total_seed_cost;

       $data->save();     
       
   
       return redirect('/show-variable-cost-seed')->with('message','Seeds Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/update-variable-cost-seed/{seeds}')->with('message','Someting went wrong');
       
   }   
} 






public function SeedsDelete($id) {
   try {
       // Find the personal information by ID
       $seeds= Seed::find($id);

       // Check if the personal information exists
       if (! $seeds) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
      $seeds->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'Seed data deleted Successfully');

   } catch (\Exception $e) {
    //    dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}



// labors data edit and view by agentt


public function LaborsDataView(){
    $labors= Labor::orderBy('id','desc')->paginate(10);
    return view('agent.variablecost.labor.show_laborData',compact('labors'));
}





public function LaborUpdate($id){
    $labors= Labor::find($id);
    return view('agent.variablecost.labor.formEdit_labors',compact('labors'));
}

public function LaborDataupdate(LaborRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Labor::find($id);

       $data->no_of_person = $request->no_of_person;  
       $data->rate_per_person = $request->rate_per_person;
       $data->total_labor_cost = $request->total_labor_cost;
       

       $data->save();     
       
   
       return redirect('/show-variable-cost-labor')->with('message','Labor Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/update-variable-cost-labor/{labors}')->with('message','Someting went wrong');
       
   }   
} 






public function LaborsDelete($id) {
   try {
       // Find the personal information by ID
       $labors= Labor::find($id);

       // Check if the personal information exists
       if (! $labors) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
      $labors->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'labor data deleted Successfully');

   } catch (\Exception $e) {
    //    dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}



// eidt ,view and delete of fertilizer


public function FertilizerDataView(){
    $fertilizers= Fertilizer::orderBy('id','desc')->paginate(10);
    return view('agent.variablecost.fertilizers.show_fertilizeData',compact('fertilizers'));
}





public function FertilizerUpdate($id){
    $fertilizers= Fertilizer::find($id);
    return view('agent.variablecost.fertilizers.formsEdit_fertilizeData',compact('fertilizers'));
}

public function FertilizerDataupdate(FertilizerRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Fertilizer::find($id);

       $data->name_of_fertilizer = $request->name_of_fertilizer;  
       $data->type_of_fertilizer = $request->type_of_fertilizer;
       $data->no_ofsacks = $request->no_ofsacks;
       $data->unitprice_per_sacks = $request->unitprice_per_sacks;
       $data->total_cost_fertilizers = $request->total_cost_fertilizers;

       $data->save();     
       
   
       return redirect('/show-variable-cost-fertilizers')->with('message','Fertilizer Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/update-variable-cost-fertilizers/{fertilizers}')->with('message','Someting went wrong');
       
   }   
} 


public function FertilizerDelete($id) {
   try {
       // Find the personal information by ID
       $fertilizers= Fertilizer::find($id);

       // Check if the personal information exists
       if (! $fertilizers) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
      $fertilizers->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'Fertilizer data deleted Successfully');

   } catch (\Exception $e) {
    //    dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}



// edit, delete and view 0f pesticides data by agent


public function PesticideDataView(){
    $pesticides= Pesticide::orderBy('id','desc')->paginate(10);
    return view('agent.variablecost.pesticides.show_pesticidesData',compact('pesticides'));
}





public function PesticideUpdate($id){
    $pesticides= Pesticide::find($id);
    return view('agent.variablecost.pesticides.formsEdit_pesticidesData',compact('pesticides'));
}

public function PesticideDataupdate(PesticidesRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Pesticide::find($id);

       $data->pesticides_name = $request->pesticides_name;  
       $data->type_ofpesticides = $request->type_ofpesticides;
       $data->no_of_l_kg = $request->no_of_l_kg;
       $data->unitprice_ofpesticides = $request->unitprice_ofpesticides;
       $data->total_cost_pesticides = $request->total_cost_pesticides;
              
       $data->save();     
       
   
       return redirect('/show-variable-cost-pesticides')->with('message','Pesticide Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/update-variable-cost-pesticides/{pesticides}')->with('message','Someting went wrong');
       
   }   
} 


public function PesticideDelete($id) {
   try {
       // Find the personal information by ID
       $pesticides= Pesticide::find($id);

       // Check if the personal information exists
       if (! $pesticides) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
      $pesticides->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'Pesticiddes data deleted Successfully');

   } catch (\Exception $e) {
    //    dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}

// view, edit of transport by agent

public function TransportDataView(){
    $transports= Transport::orderBy('id','desc')->paginate(10);
    return view('agent.variablecost.transport.show_ttransportsData',compact('transports'));
}





public function TransportUpdate($id){
    $transports= Transport::find($id);
    return view('agent.variablecost.transport.formsEdit_transportsData',compact('transports'));
}

public function TransportDataupdate(TransportRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Transport::find($id);

       $data->name_of_vehicle = $request->name_of_vehicle;  
       $data->type_of_vehicle = $request->type_of_vehicle;
     
       $data->total_transport_per_deliverycost;
      
              
       $data->save();     
       
   
       return redirect('/show-variable-cost-transport')->with('message','Transport Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/update-variable-cost-transports/{transports}')->with('message','Someting went wrong');
       
   }   
} 


public function TransportDelete($id) {
   try {
       // Find the personal information by ID
       $transports= Transport::find($id);

       // Check if the personal information exists
       if (! $transports) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
      $transports->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'Transports data deleted Successfully');

   } catch (\Exception $e) {
    //    dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}

// map view by agent
public function mapView($id){
    $personlinformation=PersonalInformations::find($id);
    return view('map.view_map_info',compact('personlinformation'));
}

// Rice Variety "Inbred
public function InbredVariety()
{
    try {
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

        return view('agent.riceVariety.inbred_variety', compact('InbredInfo'));
    } catch (\Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        return redirect()->back()->with('message', 'Something went wrong');
    }
}




// // Rice Variety "Hybrid" access by agent
// public function HybridVariety(){
//     try {
//         $FarmersData = DB::table('personal_informations')
//             ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
//             ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
//             ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
//             ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
//             ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
//             ->select(
//                 'personal_informations.*',
//                 'farm_profiles.*',
//                 'fixed_costs.*',
//                 'machineries_useds.*',
//                 'variable_costs.*',
//                 'last_production_datas.*'
//             )
//             ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
//             ->get();

//         return view('agent.riceVariety.hybrid_variety', compact('FarmersData'));
//     } catch (\Exception $ex) {
//         // Log the exception for debugging purposes
//         dd($ex);
//         return redirect()->back()->with('message', 'Something went wrong');
//     }
    
// }


// Rice harvest sch
public function HarvestSched(){
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

        return view('agent.Schedule.harvest', compact('harvestSchedule'));
    } catch (\Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        return redirect()->back()->with('message', 'Something went wrong');
    }
}



// Rice Planting schedule of farmers per district
public function PlantingSched(){
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
        return view('agent.Schedule.planting', compact('plantingSchedule'));
    } catch (\Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        return redirect()->back()->with('message', 'Something went wrong');
    }
}


// Rice farmers per districts informations

// ayala farmers
public function AyalaFarmers()
{
    try {
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
        return view('agent.agriDistricts.ayala_farmers', compact('FarmersData','totalRiceProduction',
        'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
        'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
        'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
        'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'
    ));
    } catch (\Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        return redirect()->back()->with('message', 'Something went wrong');
    }

       
}

public function show($id)
{
    try {
        $ayalaData = DB::table('personal_informations')
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
            ->where('personal_informations.id', $id)
            ->first();

        if (!$ayalaData) {
            return redirect()->back()->with('error', 'Data not found');
        }

        return view('agent.ayala.show_personal_info', compact('ayalaData'));
    } catch (\Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        return redirect()->back()->with('error', 'Something went wrong');
    }
}



// tumaga farmers
public function TumagaFarmers(){
    try {
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
                ->where('farm_profiles.agri_districtS', 'Ayala')
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
                //count no of farmers organization
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
    return view('agent.agriDistricts.tumaga_farmers', compact('FarmersData','totalRiceProduction',
    'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
    'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
    'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
    'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner',
    'countorg'
));
} catch (\Exception $ex) {
    // Log the exception for debugging purposes
    dd($ex);
    return redirect()->back()->with('message', 'Something went wrong');
}

   
}


// culianan farmers
public function CuliananFarmers(){
    try {
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
                ->where('farm_profiles.agri_districtS', 'Ayala')
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
                //count no of farmers organization
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
                return view('agent.agriDistricts.culianan_farmers', compact('FarmersData','totalRiceProduction',
                'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
                'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
                'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
                'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner',
                'countorg'
            ));
            } catch (\Exception $ex) {
                // Log the exception for debugging purposes
                dd($ex);
                return redirect()->back()->with('message', 'Something went wrong');
            }       

       
   
}

// Manicahan farmers
public function ManicahanFarmers(){
    try {
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
            ->where('farm_profiles.agri_districtS', 'Ayala')
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
            //count no of farmers organization
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
            return view('agent.agriDistricts.manicahan_farmers', compact('FarmersData','totalRiceProduction',
            'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
            'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
            'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
            'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner',
            'countorg'
        ));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }       
       
  
}

// curuan farmers
public function CuruanFarmers(){
    try {
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
            ->where('farm_profiles.agri_districtS', 'Ayala')
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
            //count no of farmers organization
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
            return view('agent.agriDistricts.curuan_farmers', compact('FarmersData','totalRiceProduction',
            'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
            'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
            'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
            'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner',
            'countorg'
        ));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }       
        
   
}

// vitali farmers
public function VitaliFarmers(){
    try {
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
        ->where('farm_profiles.agri_districtS', 'Ayala')
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
        //count no of farmers organization
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
        return view('agent.agriDistricts.vitali_farmers', compact('FarmersData','totalRiceProduction',
        'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
        'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
        'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
        'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner',
        'countorg'
    ));
    } catch (\Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        return redirect()->back()->with('message', 'Something went wrong');
    }       
       
  
}
public function RiceCrop(){
    try {
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


        return view('agent.cropProductions.rice_crop', compact('riceProductionSchedule'));
    } catch (\Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        return redirect()->back()->with('message', 'Something went wrong');
    }
        
}

// multiple impor of excels in Dataase access by agent
public function ExcelFile(){
    return view('agent.mutipleFile.import_excelFile');
}

public function FarmersReport(){
    
}
}