<?php

namespace App\Http\Controllers\Backend;
use App\Models\PersonalInformations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\MultipleFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalInformationsRequest;
use App\Http\Requests\UpdatePersonalInformationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Strings;

class PersonalInformationsController extends Controller
{

protected $personalInformations;
public function __construct() {
    $this->personalInformations = new PersonalInformations;

}


// join table for farmprfofiles
public function FarmProfiles(){
    try {
   
$farmLocation = DB::table('personal_informations')
->Join('agri_districts', 'personal_informations.agri_districtS_id', '=', 'agri_districts.id')
->leftJoin('polygons', 'personal_informations.polygons_id', '=', 'polygons.id')
->select('personal_informations.*', 'agri_districts.*' , 'polygons.*')
->get();
$agriDistrictIds = [];
$polygonsIds = [];

    
    // // Loop through each row of the result
    foreach ($farmLocation as $location) {
        // Extract agri_district_id and polygons_id from each row
        $agriDistrictIds[] = $location->id;
        $polygonsIds[] = $location->id;
    }
       return view('farm_profile.farm_index', ['farmLocation' => $farmLocation,
       'agriDistrictIds' => $agriDistrictIds,   'polygonsIds' => $polygonsIds,
    ]);
   } catch (\Exception $ex) {
       // Log the exception for debugging purposes
       dd($ex);
       return redirect()->back()->with('message', 'Something went wrong');
   }
    }

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
     return view('map.gmap',compact('personalInformations'));
    }
    public function PersonalInfo(): View
    {
        $personalInformation= PersonalInformations::all();
    return view('personalinfo.index',compact('personalInformation'));
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
        
            $data= $request->validated();
            $data= $request->all();
            PersonalInformations::create($data);
    
            return redirect('/farmprofile')->with('message','Personal informations added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/personalinformation')->with('message','Someting went wrong');
            
        }   
        
        
               
          
  

} 
    

    /**
     * Display the specified resource.
     */
    public function show(personalInformations $personalInformations): View
    {
        // $personalInformations = PersonalInformations::find($id);
        return view('personalinfo.create')->with('personalInformations',$personalInformations);
    }
    
    public function showPersonalInfo()
    {
        // Fetch personal information data
        $personalInformations = PersonalInformations::select('id', 'first_name', 'last_name')->get();

        // Pass the data to the view
        return view('farm_profile.farm_index', compact('personalInformation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($personal_information_id)
    {
        // dd($farmer_no);
        $personalInformations = PersonalInformations::where('personal_information_id',$personal_information_id)->first();
        // // $personalInformation = PersonalInformations::findOrFail($personalInformation);
        return view('personalinfo.edit')->with('personalInformation',$personalInformations);
       ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonalInformationRequest $request,  $farmer_no)
    {
            // dd(($request->all()));
            try {
                // Get validated data from the request (if you're using validation rules)
                $data = $request->validated();
            
                // If you want to use all data, use this line instead of the above line.
                // $data = $request->all();
            
                // Update the PersonalInformations table
                PersonalInformations::where('farmer_no', $farmer_no)->update($data);
            
                // Optionally, you can return a response indicating success
                return redirect('/personalinfo/create')->with('message','Personal informations updated successsfully');
            } catch (\Exception $e) {
                // Handle any exceptions that might occur during the update process
                return response()->json(['message' => 'Error updating record: ' . $e->getMessage()], 500);
            }

    
           
        }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try {
            $personalInformations = PersonalInformations::where('id', $id);
        
            if ($personalInformations) {
                $personalInformations->delete();
                return redirect()->route('personalinfo.create')
                                 ->with('message', 'Personal Informations deleted successfully');
            } else {
                return redirect()->route('personalinfo.create')
                                 ->with('message', 'Personal Informations not found');
            }
        } catch (\Exception $e) {
            return redirect()->route('personalinfo.create')
                             ->with('message', 'Error deleting Personal Informations : ' . $e->getMessage());
        }
        
          
    }


    public function viewpersoninfo($id){
        $perinfo = PersonalInformations::find($id);
        return view('agent.formvalidation.valpersonal.personinfo_edit',compact('perinfo'));
    }
    
    public function alldataform() {
// agent all data form 
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



public function forms() {
// agent all data form 
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



public function profileFarmer($id) {
    // agent all data form 
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





}
