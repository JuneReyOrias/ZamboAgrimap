<?php

namespace App\Http\Controllers\Backend;
use App\Models\FarmProfile;
use App\Http\Controllers\Controller;
use App\Http\Requests\FarmProfileRequest;
use App\Http\Requests\UpdateFarmProfileRequest;
use App\Models\PersonalInformations;
use App\Models\FixedCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Optional;

class FarmProfileController extends Controller
{
    public function FarmProfiles(){
        try {
        //    Retrieve the necessary information from the personal_informations table
    //        $farmLocation = PersonalInformations::select('id', 'first_name', 'last_name', 'mothers_maiden_name')
    //        ->latest('id') // Order by id in descending order (latest first)
    //     ->first()
    // ->get();
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
   
    public function index()
    {
        //
    }

    //arcmap for admin
    public function Arcmap()
    {
        // $farmprofile= FarmProfile::all();
        $farmLocation = DB::table('farm_profiles')
     ->Join('agri_districts', 'farm_profiles.agri_districtS_id', '=', 'agri_districts.id')
     ->leftJoin('polygons', 'farm_profiles.polygons_id', '=', 'polygons.id')
     ->leftJoin('personal_informations', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
     ->select('farm_profiles.*', 'agri_districts.*' , 'polygons.*','personal_informations.*')
     ->get();

     // Initialize empty arrays
$agriDistrictIds = [];
$polygonsIds = [];

// Loop through each row of the result
foreach ($farmLocation as $location) {
    // Extract agri_district_id and polygons_id from each row
    $agriDistrictIds[] = $location->id;
    $polygonsIds[] = $location->id;
}


    //  return view('map.arcmap',compact('farmprofile'));
    // return  $farmLocation;
    return view('map.arcmap', [
        'farmLocation' => $farmLocation,
        'agriDistrictIds' => $agriDistrictIds,
    'polygonsIds' => $polygonsIds,

]);

     }


     

     //gmap is for agent of 
     public function Gmap()
     {
         // $farmprofile= FarmProfile::all();
         $farmLocation = DB::table('farm_profiles')
      ->Join('agri_districts', 'farm_profiles.agri_districtS_id', '=', 'agri_districts.id')
      ->leftJoin('polygons', 'farm_profiles.polygons_id', '=', 'polygons.id')
      ->leftJoin('personal_informations', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
      ->select('farm_profiles.*', 'agri_districts.*' , 'polygons.*','personal_informations.*')
      ->get();
 
      // Initialize empty arrays
 $agriDistrictIds = [];
 $polygonsIds = [];
 
 // Loop through each row of the result
 foreach ($farmLocation as $location) {
     // Extract agri_district_id and polygons_id from each row
     $agriDistrictIds[] = $location->id;
     $polygonsIds[] = $location->id;
 }
 
 
     //  return view('map.arcmap',compact('farmprofile'));
     // return  $farmLocation;
     return view('map.gmap', [
         'farmLocation' => $farmLocation,
         'agriDistrictIds' => $agriDistrictIds,
     'polygonsIds' => $polygonsIds,
 
 ]);
 
      }
      public function agrimap()
      {
          // $farmprofile= FarmProfile::all();
          $farmLocation = DB::table('farm_profiles')
       ->Join('agri_districts', 'farm_profiles.agri_districtS_id', '=', 'agri_districts.id')
       ->leftJoin('polygons', 'farm_profiles.polygons_id', '=', 'polygons.id')
       ->leftJoin('personal_informations', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
       ->select('farm_profiles.*', 'agri_districts.*' , 'polygons.*','personal_informations.*')
       ->get();
  
       // Initialize empty arrays
  $agriDistrictIds = [];
  $polygonsIds = [];
  
  // Loop through each row of the result
  foreach ($farmLocation as $location) {
      // Extract agri_district_id and polygons_id from each row
      $agriDistrictIds[] = $location->id;
      $polygonsIds[] = $location->id;
  }
  
  
      //  return view('map.arcmap',compact('farmprofile'));
      // return  $farmLocation;
      return view('map.agrimap', [
          'farmLocation' => $farmLocation,
          'agriDistrictIds' => $agriDistrictIds,
      'polygonsIds' => $polygonsIds,
  
  ]);}
    public function searchfarm(Request $request){
 
        $gps_latitude=$request->gps_latitude;
        $gps_longitude=$request->gps_longitude;

        $farmprofile=FarmProfile::whereBetween('gps_latitude',[$gps_latitude-0.1,$gps_latitude+0.1])->whereBetween('gps_longitude',[$gps_longitude-0.1,$gps_longitude+0.1]);

        return   $farmprofile;
    }
    public function FarmProfile(){
        $farmprofile= FarmProfile::all();
    return view('farm_profile.farm_index',compact('farmprofile'));
 }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function FarmProfileCrud()
    {
        $farmprofile= FarmProfile::latest()->get();
        return view('farm_profile.farm_show',compact('farmprofile'));
        
    }
   


    public function store(FarmProfileRequest $request)
    {
       
        try {
           
            $user = auth()->user();
            $data = $request->validated();
            $personalInformationId = 1;

       

    // Check if the associated PersonalInformations record exists
    // Access the primary key of the PersonalInformations model instance

    $farmProfile = FarmProfile::create([
             'personal_informations_id' => $request->input('personal_informations_id'),
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
            'source_of_capital' => request('source_of_capital'),
            'remarks_recommendation' => request('remarks_recommendation'),
            'oca_district_office' => request('oca_district_office'),
            'name_technicians' => request('name_technicians'),
            'date_interview' => request('date_interview'),
            ]);
            
// Retrieve the personal_information_id
$personalInformationId = $farmProfile->getKey();

// Associate the FarmProfile with PersonalInformations
$personalInformation = PersonalInformations::find($personalInformationId);
$farmProfile->personalInformations()->associate($personalInformation);
$farmProfile->save();

         
    

return redirect('/fixedcost')->with('message', 'Farm Profile added successfully');
} catch (\Exception $ex) {
    // Handle the exception
    dd($ex);
    return redirect('/farmprofile')->with('message', 'Something went wrong');
}
       
    }
    
     
   
    
    public function edit($farmprofile)
    {
        // dd($id);
        $farmprofile = PersonalInformations::find($farmprofile);
      
      // $personalInformation = PersonalInformations::findOrFail($personalInformation);
        return view('farm_profile.farm_edit')->with('farmprofile',$farmprofile);
       ;
    }
  

 
    public function update(UpdateFarmProfileRequest $request, $id)
    {
        try {
            $data = $request->validated();
            
         
            FarmProfile::where('id', $id)->update($data);
    
            return redirect('/farmprofile/create')->with('message', 'Farm Profile updated successfully');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating record: ' . $e->getMessage()], 500);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $farmprofile = FarmProfile::where('id', $id);
        
            if ($farmprofile) {
                $farmprofile->delete();
                return redirect()->route('farm_profile.show')
                                 ->with('message', 'Fixed Cost deleted successfully');
            } else {
                return redirect()->route('farm_profile.show')
                                 ->with('message', 'Fixed Cost not found');
            }
        } catch (\Exception $e) {
            return redirect()->route('farm_profile.show')
                             ->with('message', 'Error deleting Fixed Cost : ' . $e->getMessage());
        }
    }
}
