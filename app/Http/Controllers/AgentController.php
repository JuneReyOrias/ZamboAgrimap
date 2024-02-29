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
use Illuminate\Support\Facades\Storage;
use App\Models\PersonalInformations;
use App\Http\Requests\PersonalInformationsRequest;
use App\Http\Controllers\Backend\PersonalInformationsController;
use App\Models\Transport;
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
        return view('agent.personal_info.add_info');
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
    
            $data= $request->validated();
            $data= $request->all();
            PersonalInformations::create(
                [
                    'users_id' => $request->input('users_id'),
                    'first_name' => $request->input('first_name'),
                    'middle_name' => $request->input('middle_name'),
                    'last_name' => request('last_name'),
                    'extension_name' => request('extension_name'),
                    'home_address' => request('home_address'),
                    'sex' => request('sex'),
                    'religion' => request('religion'),
                    'date_of_birth' => request('date_of_birth'),
                    'place_of_birth' => request('place_of_birth'),
                    'contact_no' => request('contact_no'),
                    'civil_status' => request('civil_status'),
                    'name_legal_spouse' => request('name_legal_spouse'),
                    'no_of_children' => request('no_of_children'),
                    'mothers_maiden_name' => request('mothers_maiden_name'),
                    'highest_formal_education' => request('highest_formal_education'),
                    'person_with_disability' => request('person_with_disability'),
                    'pwd_id_no' => request('pwd_id_no'),
                    'government_issued_id' => request('government_issued_id'),
                    'id_type' => request('id_type'),
                    'gov_id_no' => request('gov_id_no'),
                    'member_ofany_farmers_ass_org_coop' => request('member_ofany_farmers_ass_org_coop'),
                    'nameof_farmers_ass_org_coop' => request('nameof_farmers_ass_org_coop'),
                    'name_contact_person' => request('name_contact_person'),
                    'oca_district_office' => request('oca_district_office'),
                    'cp_tel_no' => request('cp_tel_no'),
                ]
            );
    
            return redirect('/add-farm-profile')->with('message','Personal informations added successsfully');
        
        }
        catch(\Exception $ex){
            // dd($ex); // Debugging statement to inspect the exception
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
    return view('agent.farmprofile.add_profile');
}
// agent added new farm profiles
public function AddFarmProfile(FarmProfileRequest $request)
    {
       
        try {
           
            $user = auth()->user();
            $data = $request->validated();
           

       

    // Check if the associated PersonalInformations record exists
    // Access the primary key of the PersonalInformations model instance

    $existingFarmProfile = FarmProfile::where([
        ['personal_informations_id', '=', $request->input('personal_informations_id')],
       
    
       
       
    
      
        // Add other fields here
    ])->first();
    
    if ($existingFarmProfile) {
        // FarmProfile with the given personal_informations_id and other fields already exists
        // You can handle this scenario here, for example, return an error message
        return redirect('/add-farm-profile')->with('error', 'Farm Profile with this information already exists.');
    }
    

    $farmProfile = FarmProfile::create([
        'personal_informations_id' => $request->input('personal_informations_id'),
        'users_id' => $request->input('users_id'),
        'agri_districts_id' => $request->input('agri_districts_id'),
        'polygons_id' => $request->input('polygons_id'),
       'tenurial_status' => request('tenurial_status'),
       'rice_farm_address' => request('rice_farm_address'),
       'no_of_years_as_farmers' => request('no_of_years_as_farmers'),
       'gps_longitude' => request('gps_longitude'),
       'gps_latitude' => request('gps_latitude'),
       'total_physical_area_has' => request('total_physical_area_has'),
       'rice_area_cultivated_has' => request('rice_area_cultivated_has'),
       'land_title_no' => request('land_title_no'),
       'lot_no' => request('lot_no'),
       'area_prone_to' => request('area_prone_to'),
       'ecosystem' => request('ecosystem'),
       'type_rice_variety' => request('type_rice_variety'),
       'prefered_variety' => request('prefered_variety'),
       'plant_schedule_wetseason' => request('plant_schedule_wetseason'),
       'plant_schedule_dryseason' => request('plant_schedule_dryseason'),
       'no_of_cropping_yr' => request('no_of_cropping_yr'),
       'yield_kg_ha' => request('yield_kg_ha'),
       'rsba_register' => request('rsba_register'),
       'pcic_insured' => request('pcic_insured'),
       'government_assisted' => request('government_assisted'),
       'source_of_capital' => request('source_of_capital'),
       'remarks_recommendation' => request('remarks_recommendation'),
       'oca_district_office' => request('oca_district_office'),
       'name_technicians' => request('name_technicians'),
       'date_interview' => request('date_interview'),

    ]);
            


// $farmProfile->save();

         
    

return redirect('/add-fixed-cost')->with('message', 'Farm Profile added successfully');
} catch (\Exception $ex) {
    // Handle the exception
//    dd($ex);
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
        $fixedcost= FixedCost::create([
        'personal_informations_id' => $request->input('personal_informations_id'),
        'farm_profiles_id' => $request->input('farm_profiles_id'),
        'particular' => $request->input('particular'),
        'no_of_ha' => $request->input('no_of_ha'),
       'cost_per_ha' => request('cost_per_ha'),
       'total_amount' => request('total_amount'),
    
        ]);
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
       $machineused= MachineriesUseds::create([
            'personal_informations_id' => $request->input('personal_informations_id'),
            'farm_profiles_id' => $request->input('farm_profiles_id'),
            'plowing_machineries_used' => $request->input('plowing_machineries_used'),
            'plo_ownership_status' => $request->input('plo_ownership_status'),
           'no_of_plowing' => request('no_of_plowing'),
           'plowing_cost' => request('plowing_cost'),
        
           'harrowing_machineries_used' => $request->input('harrowing_machineries_used'),
           'harro_ownership_status' => $request->input('harro_ownership_status'),
           'no_of_harrowing' => $request->input('no_of_harrowing'),
           'harrowing_cost' => $request->input('harrowing_cost'),
          'harvesting_machineries_used' => request('harvesting_machineries_used'),
          'harvest_ownership_status' => request('harvest_ownership_status'),

          'harvesting_cost' => $request->input('harvesting_cost'),
          'postharvest_machineries_used' => $request->input('postharvest_machineries_used'),
          'postharv_ownership_status' => $request->input('postharv_ownership_status'),
          'post_harvest_cost' => $request->input('post_harvest_cost'),
         'total_cost_for_machineries' => request('total_cost_for_machineries'),
         

        ]);
        // dd($machineused);
        $machineused->save();
        return redirect('/add-variable-cost-seed')->with('message','Fixed Cost added successsfully');
    
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
           $lastproduction= LastProductionDatas::create([

                'personal_informations_id' => $request->input('personal_informations_id'),
                'farm_profiles_id' => $request->input('farm_profiles_id'),
                'agri_districts_id' => $request->input('agri_districts_id'),
                'seeds_typed_used' => $request->input('seeds_typed_used'),
                'seeds_used_in_kg' => $request->input('seeds_used_in_kg'),
                'seed_source' => request('seed_source'),
                'no_of_fertilizer_used_in_bags' => request('no_of_fertilizer_used_in_bags'),
                
                'no_of_pesticides_used_in_l_per_kg' => $request->input('no_of_pesticides_used_in_l_per_kg'),
                'no_of_insecticides_used_in_l' => $request->input('no_of_insecticides_used_in_l'),
                'area_planted' => $request->input('area_planted'),
                'date_planted' => $request->input('date_planted'),
                'date_harvested' => request('date_harvested'),
                'yield_tons_per_kg' => request('yield_tons_per_kg'),
        
                'unit_price_palay_per_kg' => $request->input('unit_price_palay_per_kg'),
                'unit_price_rice_per_kg' => $request->input('unit_price_rice_per_kg'),
                'type_of_product' => $request->input('type_of_product'),
                'sold_to' => $request->input('sold_to'),
                'if_palay_milled_where' => request('if_palay_milled_where'),
                'gross_income_palay' => $request->input('gross_income_palay'),
                'gross_income_rice' => request('gross_income_rice'),
        
            ]);
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
        $seeds=Seed::create([
            'seed_name' => $request->input('seed_name'),
            'seed_type' => $request->input('seed_type'),
            'unit' => $request->input('unit'),
            'quantity' => $request->input('quantity'),
           'unit_price' => request('unit_price'),
           'total_seed_cost' => request('total_seed_cost'),
        ]);
        $seeds->save();
        return redirect('/add-variable-cost-labor')->with('message','Seeds data added successsfully');
    
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
public function AddNewfertilizers(FertilizerRequest $request)
{
    try{
        $data= $request->validated();
        $data= $request->all();
        Fertilizer::create($data);

        return redirect('/add-variable-cost-pesticides')->with('message','Fertilizers data added successsfully');
    
    }
    catch(\Exception $ex){
        return redirect('/add-variable-cost-fertilizers')->with('message','Someting went wrong');
    }
}

// Agent variable cost pesticides view
 public function variablePesticides(){
    return view('agent.variablecost.pesticides.add_pesticide');
 }

//  agent variablecost pesticides add new
public function AddNewPesticide(PesticidesRequest $request)
    {
        try{
            $data= $request->validated();
            $data= $request->all();
            Pesticide::create($data);
    
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
              $vartotal= VariableCost::create([
                'personal_informations_id' => $request->input('personal_informations_id'),
                'farm_profiles_id' => $request->input('farm_profiles_id'),
                'seeds_id' => $request->input('seeds_id'),
                'labors_id' => $request->input('labors_id'),
                'fertilizers_id' => $request->input('fertilizers_id'),
                'pesticides_id' => $request->input('pesticides_id'),
                'transports_id' => $request->input('transports_id'),
                'total_machinery_fuel_cost' => request('total_machinery_fuel_cost'),
                'total_variable_cost' => request('total_variable_cost'),
               ]);

              
               $vartotal->save();
                return redirect('/add-last-production')->with('message','Rice Form Survey Completed Successfully');
            
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
























 //inserting multiple insertion of data into database
//  public function submitForm(Request $request)
//  {
//      try {
//          // Validate form data (you can add more validation as needed)

//          // Insert data into Table1
//          $personalinfo = PersonalInformations::create([
//             'agri_districts_id' => $request->input('agri_districts_id'),
//             //  'crop_categorys_id' => $request->input('crop_categorys_id'),
//             //  'livestock_categorys_id' => $request->input('livestock_categorys_id'),
//             //  'fisheries_categories_id' => $request->input('fisheries_categories_id'),
//              'first_name' => $request->input('first_name'),
//              'middle_name' => $request->input('middle_name'),
//              'last_name' => $request->input('last_name'),
//              'extension_name' => $request->input('extension_name'),
//              'home_address' => $request->input('home_address'),
//              'sex' => $request->input('sex'),
//              'religion' => $request->input('religion'),
//              'date_of_birth' => $request->input('date_of_birth'),
//              'place_of_birth' => $request->input('place_of_birth'),
//              'contact_no' => $request->input('contact_no'),
//              'civil_status' => $request->input('civil_status'),
//              'name_legal_spouse' => $request->input('name_legal_spouse'),
//              'no_of_children' => $request->input('no_of_children'),
//              'mothers_maiden_name' => $request->input('mothers_maiden_name'),

//              'highest_formal_education' => $request->input('highest_formal_education'),
//              'person_with_disability' => $request->input('person_with_disability'),
//              'pwd_id_no' => $request->input('pwd_id_no'),
//              'government_issued_id' => $request->input('government_issued_id'),
//              'id_type' => $request->input('id_type'),
//              'gov_id_no' => $request->input('gov_id_no'),
//              'member_ofany_farmers_ass_org_coop' => $request->input('member_ofany_farmers_ass_org_coop'),
//              'nameof_farmers_ass_org_coop' => $request->input('nameof_farmers_ass_org_coop'),
//              'name_contact_person' => $request->input('name_contact_person'),

//              'cp_tel_no' => $request->input('cp_tel_no'),
//              'users_id' => $request->input('users_id'),
//              // Add more columns as needed
//          ]);
//  // Insert data into Table2
//  $farmprofile = FarmProfile::create([
//     'personal_informations_id' => $request->input('personal_informations_id'),
//      'agri_districts_id' => $request->input('agri_districts_id'),
//      'polygons_id' => $request->input('polygons_id'),
//      'tenurial_status' => $request->input('tenurial_status'),
//      'rice_farm_address' => $request->input('rice_farm_address'),
//      'no_of_years_as_farmers' => $request->input('no_of_years_as_farmers'),
//      'gps_longitude' => $request->input('gps_longitude'),
//      'gps_latitude' => $request->input('gps_latitude'),
//      'total_physical_area_has' => $request->input('total_physical_area_has'),
//      'rice_area_cultivated_has' => $request->input('rice_area_cultivated_has'),
//      'land_title_no' => $request->input('land_title_no'),

//      'lot_no' => $request->input('lot_no'),
//      'area_prone_to' => $request->input('area_prone_to'),
//      'ecosystem' => $request->input('ecosystem'),
//      'type_rice_variety' => $request->input('type_rice_variety'),
//      'prefered_variety' => $request->input('prefered_variety'),
//      'plant_schedule_wetseason' => $request->input('plant_schedule_wetseason'),
//      'plant_schedule_dryseason' => $request->input('plant_schedule_dryseason'),
//      'no_of_cropping_yr' => $request->input('no_of_cropping_yr'),
//      'yield_kg_ha' => $request->input('yield_kg_ha'),
//      'rsba_register' => $request->input('rsba_register'),
//      'pcic_insured' => $request->input('pcic_insured'),
//      'source_of_capital' => $request->input('source_of_capital'),
//      'remarks_recommendation' => $request->input('remarks_recommendation'),
//      'oca_district_office' => $request->input('oca_district_office'),
//      'name_technicians' => $request->input('name_technicians'),
//      'date_interview' => $request->input('date_interview'),
//      // Add more columns as needed
//  ]);


//          // Insert data into Table3
      
//           $fixedcost = FixedCost::create([
//             'personal_informations_id' => $request->input('personal_informations_id'),
//              'farm_profiles_id' => $request->input('farm_profiles_id'),
//              'particular' => $request->input('particular'),
//              'no_of_ha' => $request->input('no_of_ha'),
//              'cost_per_ha' => $request->input('cost_per_ha'),
//              'total_amount' => $request->input('total_amount'),
             
//              // Add more columns as needed
//          ]);

//   // Insert data into Table4
//   $machineries =LastProductionDatas::create([
//     'personal_informations_id' => $request->input('personal_informations_id'),
//      'farm_profiles_id' => $request->input('farm_profiles_id'),
//      'plowing_machineries_used' => $request->input('plowing_machineries_used'),
//      'plo_ownership_status' => $request->input('plo_ownership_status'),
//      'no_of_plowing' => $request->input('no_of_plowing'),
//      'plowing_cost' => $request->input('plowing_cost'),
//      'harrowing_machineries_used' => $request->input('harrowing_machineries_used'),
//      'harro_ownership_status' => $request->input('harro_ownership_status'),
//      'no_of_harrowing' => $request->input('no_of_harrowing'),
//      'harrowing_cost' => $request->input('harrowing_cost'),
//      'harvesting_machineries_used' => $request->input('harvesting_machineries_used'),

//      'harvest_ownership_status' => $request->input('harvest_ownership_status'),
//      'harvesting_cost' => $request->input('harvesting_cost'),
//      'postharvest_machineries_used' => $request->input('postharvest_machineries_used'),
//      'postharv_ownership_status' => $request->input('postharv_ownership_status'),
//      'post_harvest_cost' => $request->input('post_harvest_cost'),
//      'total_cost_for_machineries' => $request->input('total_cost_for_machineries')
   
//      // Add more columns as needed
//  ]);

// // Insert data into Table5
// $lastproduction = LastProductionDatas::create([
//     'personal_informations_id' => $request->input('personal_informations_id'),
//      'farm_profiles_id' => $request->input('farm_profiles_id'),
//      'agri_districts_id' => $request->input('agri_districts_id'),
//      'seeds_typed_used' => $request->input('seeds_typed_used'),
//      'seeds_used_in_kg' => $request->input('seeds_used_in_kg'),
//      'seed_source' => $request->input('seed_source'),
//      'no_of_fertilizer_used_in_bags' => $request->input('no_of_fertilizer_used_in_bags'),
//      'no_of_pesticides_used_in_l_per_kg' => $request->input('no_of_pesticides_used_in_l_per_kg'),
//      'no_of_insecticides_used_in_l' => $request->input('no_of_insecticides_used_in_l'),
//      'area_planted' => $request->input('area_planted'),
//      'date_planted' => $request->input('date_planted'),

//      'date_harvested' => $request->input('date_harvested'),
//      'yield_tons_per_kg' => $request->input('yield_tons_per_kg'),
//      'unit_price_palay_per_kg' => $request->input('unit_price_palay_per_kg'),
//      'unit_price_rice_per_kg' => $request->input('unit_price_rice_per_kg'),
//      'type_of_product' => $request->input('type_of_product'),
//      'sold_to' => $request->input('sold_to'),
//      'if_palay_milled_where' => $request->input('if_palay_milled_where'),
//      'gross_income_palay' => $request->input('gross_income_palay'),
//      'gross_income_rice' => $request->input('gross_income_rice')
   
//      // Add more columns as needed
//  ]);
// // Insert data into Table6
// $seeds = Seed::create([
//     'seed_name' => $request->input('seed_name'),
//      'seed_type' => $request->input('seed_type'),
//      'unit' => $request->input('unit'),
//      'quantity' => $request->input('quantity'),
//      'unit_price' => $request->input('unit_price'),
//      'total_seed_cost' => $request->input('total_seed_cost')
    
//      // Add more columns as needed
//  ]);

// // Insert data into Table7
// $labor = Labor::create([
//     'no_of_person' => $request->input('no_of_person'),
//      'rate_per_person' => $request->input('rate_per_person'),
//      'total_labor_cost' => $request->input('total_labor_cost')
    
    
//      // Add more columns as needed
//  ]);

//  // Insert data into Table8
// $fertilizer = Fertilizer::create([
//     'name_of_fertilizer' => $request->input('name_of_fertilizer'),
//      'type_of_fertilizer' => $request->input('type_of_fertilizer'),
//      'no_ofsacks' => $request->input('no_ofsacks'),
//      'unitprice_per_sacks' => $request->input('unitprice_per_sacks'),
//      'total_cost_fertilizers' => $request->input('total_cost_fertilizers')
    
    
//      // Add more columns as needed
//  ]);
 
//  // Insert data into Table9
// $pesticide = Pesticide::create([
//     'pesticides_name' => $request->input('pesticides_name'),
//      'type_ofpesticides' => $request->input('type_ofpesticides'),
//      'no_of_l_kg' => $request->input('no_of_l_kg'),
//      'unitprice_ofpesticides' => $request->input('unitprice_ofpesticides'),
//      'total_cost_pesticides' => $request->input('total_cost_pesticides')
    
    
//      // Add more columns as needed
//  ]);
//   // Insert data into Table10
//  $transport = Transport::create([
//     'name_of_vehicle' => $request->input('name_of_vehicle'),
//      'type_of_vehicle' => $request->input('type_of_vehicle'),
//      'total_transport_per_deliverycost' => $request->input('total_transport_per_deliverycost')
    
//      // Add more columns as needed
//  ]);

//  $variablecostt = VariableCost::create([
//     'personal_informations_id' => $request->input('personal_informations_id'),
//      'farm_profiles_id' => $request->input('farm_profiles_id'),
//      'seeds_id' => $request->input('seeds_id'),
//      'labors_id' => $request->input('labors_id'),
//      'fertilizers_id' => $request->input('fertilizers_id'),
//      'pesticides_id' => $request->input('pesticides_id'),
//      'transports_id' => $request->input('transports_id'),
//      'total_machinery_fuel_cost' => $request->input('total_machinery_fuel_cost'),
//      'total_variable_cost' => $request->input('total_variable_cost')
    
//      // Add more columns as needed
//  ]);
//          // Similar code for other tables

//          // Optionally, return a success response
//          return response()->json(['message' => 'Data inserted successfully']);
//      } catch (\Exception $e) {
//          // Handle the exception
//          dd($e);
//          return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
//      }
//  }




}
