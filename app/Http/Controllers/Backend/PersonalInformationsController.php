<?php

namespace App\Http\Controllers\Backend;
use App\Models\LastProductionDatas;
use App\Models\PersonalInformations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\MultipleFile;
use App\Models\ParcellaryBoundaries;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalInformationsRequest;
use App\Http\Requests\UpdatePersonalInformationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Strings;
use App\Models\KmlFile;
use Illuminate\Support\Facades\Auth;

class PersonalInformationsController extends Controller
{

protected $personalInformations;
public function __construct() {
    $this->personalInformations = new PersonalInformations;

}


// join table for farmprfofiles


    //join all table and then fetch specific column
public function Personalfarms() {

    try { 

    $personalInformations = DB::table('personal_informations')
    ->leftJoin('farm_profiles', 'farm_profiles.id', '=', 'personal_informations.id')
    ->leftJoin('fixed_costs', 'fixed_costs.id', '=', 'personal_informations.id')
    ->leftJoin('machineries_useds', 'machineries_useds.id', '=', 'personal_informations.id')
    ->leftJoin('seeds', 'seeds.id', '=', 'personal_informations.id')
    ->leftJoin('fertilizers', 'fertilizers.id', '=', 'personal_informations.id')
    ->leftJoin('labors', 'labors.id', '=', 'personal_informations.id')
    ->leftJoin('pesticides', 'pesticides.id', '=', 'personal_informations.id')
    ->leftJoin('transports', 'transports.id', '=', 'personal_informations.id')
    ->leftJoin('variable_costs', 'variable_costs.id', '=', 'personal_informations.id')
    ->leftJoin('last_production_datas', 'last_production_datas.id', '=', 'personal_informations.id')
    ->select(
        'personal_informations.*',
        'farm_profiles.*',
        'fixed_costs.*',
        'machineries_useds.*', // Select all columns from machineries_useds
        'seeds.*',
        'fertilizers.*',
        'labors.*',
        'pesticides.*',
        'transports.*',
        'variable_costs.*',
        'last_production_datas.*', 
        )
    ->get();
  
    return view('farm-table.join_table',['personalInformations' => $personalInformations]);
} catch (\Exception $ex) {
    // Log the exception for debugging purposes
    dd($ex);
    return redirect()->back()->with('message', 'Something went wrong');
}
 
// }
    }
   
    public function Gmap()
    {
     $personalInformations= PersonalInformations::all();
     $parcels= ParcellaryBoundaries::all();
   
        // Fetch the latest uploaded KML file from the database
        $kmlFile = KmlFile::latest()->first();

       
    

     return view('map.gmap',compact('personalInformations','parcels','kmlFile'));
    }
    public function PersonalInfo(): View
    {
        $personalInformation= PersonalInformations::all();
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        $user = Auth::user(); // Assuming you're using Laravel's authentication

        // Fetching user's id and agri_district
        $user_id = $user->id;
        $agri_district = $user->agri_district;
    return view('personalinfo.index',compact('personalInformation','totalRiceProduction','user_id','agri_district'));
    }
    public function Agent(): View
    {
        $personalInformation= PersonalInformations::all();
    return view('personalinfo.index_agent',compact('personalInformation'));
    }
   

    public function PersonalInfoCrud():View{
        $personalInformations= PersonalInformations::latest()->get();
        return view('personalinfo.create',compact('personalInformations'));
    }

    //agent form personal info form
    public function PersonalInfoCrudAgent():View{
        $personalInformations= PersonalInformations::latest()->get();
        return view('personalinfo.show_agent',compact('personalInformations'));
    }
   


    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonalInformationsRequest $request): RedirectResponse
    {
      
        try{
        
            $existingPersonalInformations = PersonalInformations::where([
                ['first_name', '=', $request->input('first_name')],
                ['middle_name', '=', $request->input('middle_name')],
                ['last_name', '=', $request->input('last_name')],
               
               
            
              
                // Add other fields here
            ])->first();
            
            if ($existingPersonalInformations) {
                // FarmProfile with the given personal_informations_id and other fields already exists
                // You can handle this scenario here, for example, return an error message
                return redirect('/add-personal-info')->with('error', 'Personal informations with this information already exists.');
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
            
            return redirect('/farmprofile')->with('message','Personal informations Added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/admin-add-personalinformation')->with('message','Someting went wrong');
            
        }   
        
        
               
          
  

} 
    

        // view the personalinfo by admin
        public function PersonalInfoView(){
            $personalinfos=PersonalInformations::OrderBy('id','desc')->paginate(20);
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            return view('personalinfo.create',compact('personalinfos','totalRiceProduction'));
        }
        // edit page for admin
        public function PersonalInfoEdit($id){
            $personalinfos= PersonalInformations::find($id);
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            return view('personalinfo.edit_info',compact('personalinfos','totalRiceProduction'));
        }

        // new update store by admin FOR PERSONAL INFO
        public function PersonalInfoUpdate(PersonalInformationsRequest $request,$id)
        {
  
             try{
        

                    $data= $request->validated();
                    $data= $request->all();
                    $data= PersonalInformations::find($id);
                    
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
                    
                
                    return redirect('/admin-view-personalinfo')->with('message','Personal informations Updated successsfully');
                
                }
                catch(\Exception $ex){
                    // dd($ex); // Debugging statement to inspect the exception
                    return redirect('/admin-update-personalinfo/{personalinfos}')->with('message','Someting went wrong');
                    
                }   
            } 

            // deleting personal info by admin
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




    // Aggent view of all joint table of the six table to personal info
    public function alldataform() {

        try { 
    
        $allfarmers = DB::table('personal_informations')
        ->leftJoin('farm_profiles', 'farm_profiles.id', '=', 'personal_informations.id')
        ->leftJoin('fixed_costs', 'fixed_costs.id', '=', 'personal_informations.id')
        ->leftJoin('machineries_useds', 'machineries_useds.id', '=', 'personal_informations.id')
        ->leftJoin('seeds', 'seeds.id', '=', 'personal_informations.id')
        ->leftJoin('fertilizers', 'fertilizers.id', '=', 'personal_informations.id')
        ->leftJoin('labors', 'labors.id', '=', 'personal_informations.id')
        ->leftJoin('pesticides', 'pesticides.id', '=', 'personal_informations.id')
        ->leftJoin('transports', 'transports.id', '=', 'personal_informations.id')
        ->leftJoin('variable_costs', 'variable_costs.id', '=', 'personal_informations.id')
        ->leftJoin('last_production_datas', 'last_production_datas.id', '=', 'personal_informations.id')
        ->select(
            'personal_informations.*',
            'farm_profiles.*',
            'fixed_costs.*',
            'machineries_useds.*', // Select all columns from machineries_useds
            'seeds.*',
            'fertilizers.*',
            'labors.*',
            'pesticides.*',
            'transports.*',
            'variable_costs.*',
            'last_production_datas.*', 
            )->paginate(10)
    ;
      
        return view('agent.allfarmersinfo.forms_info',compact('allfarmers'));
    } catch (\Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        return redirect()->back()->with('message', 'Something went wrong');
    }



}


// all farmers data view ny the users 
public function forms() {

    try { 

    $allfarmers = DB::table('personal_informations')
    ->leftJoin('farm_profiles', 'farm_profiles.id', '=', 'personal_informations.id')
    ->leftJoin('fixed_costs', 'fixed_costs.id', '=', 'personal_informations.id')
    ->leftJoin('machineries_useds', 'machineries_useds.id', '=', 'personal_informations.id')
    ->leftJoin('seeds', 'seeds.id', '=', 'personal_informations.id')
    ->leftJoin('fertilizers', 'fertilizers.id', '=', 'personal_informations.id')
    ->leftJoin('labors', 'labors.id', '=', 'personal_informations.id')
    ->leftJoin('pesticides', 'pesticides.id', '=', 'personal_informations.id')
    ->leftJoin('transports', 'transports.id', '=', 'personal_informations.id')
    ->leftJoin('variable_costs', 'variable_costs.id', '=', 'personal_informations.id')
    ->leftJoin('last_production_datas', 'last_production_datas.id', '=', 'personal_informations.id')
    ->select(
        'personal_informations.*',
        'farm_profiles.*',
        'fixed_costs.*',
        'machineries_useds.*', // Select all columns from machineries_useds
        'seeds.*',
        'fertilizers.*',
        'labors.*',
        'pesticides.*',
        'transports.*',
        'variable_costs.*',
        'last_production_datas.*', 
        )->paginate(10)
;
  
    return view('user.forms_data',compact('allfarmers'));
} catch (\Exception $ex) {
    // Log the exception for debugging purposes
    dd($ex);
    return redirect()->back()->with('message', 'Something went wrong');
}



}

// viewing the all farmers in farm profile
public function profileFarmer($id) {
   
            try { 
        
            $allfarmers =PersonalInformations:: find($id)
            ->leftJoin('farm_profiles', 'farm_profiles.id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.id', '=', 'personal_informations.id')
            ->leftJoin('seeds', 'seeds.id', '=', 'personal_informations.id')
            ->leftJoin('fertilizers', 'fertilizers.id', '=', 'personal_informations.id')
            ->leftJoin('labors', 'labors.id', '=', 'personal_informations.id')
            ->leftJoin('pesticides', 'pesticides.id', '=', 'personal_informations.id')
            ->leftJoin('transports', 'transports.id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.id', '=', 'personal_informations.id')
            ->leftJoin('last_production_datas', 'last_production_datas.id', '=', 'personal_informations.id')
           
            ->select(
                'personal_informations.*',
                'farm_profiles.*',
                'fixed_costs.*',
                'machineries_useds.*', // Select all columns from machineries_useds
                'seeds.*',
                'fertilizers.*',
                'labors.*',
                'pesticides.*',
                'transports.*',
                'variable_costs.*',
                'last_production_datas.*', 
                ) ->first();
          
            return view('agent.allfarmersinfo.profile',compact('allfarmers'));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }
    
    
    
    }


// admin farmers data display
public function FarmersInfo() {

    try { 

    $allfarmers = DB::table('personal_informations')
    ->leftJoin('farm_profiles', 'farm_profiles.id', '=', 'personal_informations.id')
    ->leftJoin('fixed_costs', 'fixed_costs.id', '=', 'personal_informations.id')
    ->leftJoin('machineries_useds', 'machineries_useds.id', '=', 'personal_informations.id')
    ->leftJoin('seeds', 'seeds.id', '=', 'personal_informations.id')
    ->leftJoin('fertilizers', 'fertilizers.id', '=', 'personal_informations.id')
    ->leftJoin('labors', 'labors.id', '=', 'personal_informations.id')
    ->leftJoin('pesticides', 'pesticides.id', '=', 'personal_informations.id')
    ->leftJoin('transports', 'transports.id', '=', 'personal_informations.id')
    ->leftJoin('variable_costs', 'variable_costs.id', '=', 'personal_informations.id')
    ->leftJoin('last_production_datas', 'last_production_datas.id', '=', 'personal_informations.id')
    ->select(
        'personal_informations.*',
        'farm_profiles.*',
        'fixed_costs.*',
        'machineries_useds.*', // Select all columns from machineries_useds
        'seeds.*',
        'fertilizers.*',
        'labors.*',
        'pesticides.*',
        'transports.*',
        'variable_costs.*',
        'last_production_datas.*', 
        )->paginate(10)
;
  
    return view('admin.allfarmersdata.farmers_info',compact('allfarmers'));
} catch (\Exception $ex) {
    // Log the exception for debugging purposes
    dd($ex);
    return redirect()->back()->with('message', 'Something went wrong');
}



}


}
