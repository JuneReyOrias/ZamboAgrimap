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
   
  

    //arcmap for admin for view and fetch of dattta
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

                return view('map.arcmap', [
                    'farmLocation' => $farmLocation,
                    'agriDistrictIds' => $agriDistrictIds,
                'polygonsIds' => $polygonsIds,

            ]);

     }


     

     //gmap is for agent arimap view of the farmers info and location per district
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

    //   users view of agrimap for all farmers info and location
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
  
           return view('map.agrimap', [
            'farmLocation' => $farmLocation,
            'agriDistrictIds' => $agriDistrictIds,
            'polygonsIds' => $polygonsIds,
  
  ]);}


    // search engien for mapping
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


   
   
    public function FarmProfileCrud()
    {
        $farmprofile= FarmProfile::latest()->get();
        return view('farm_profile.farm_show',compact('farmprofile'));
        
    }
   

    // insertion of new data into farm profile table by admin
    public function store(FarmProfileRequest $request)
    {
       
        try {
           
            $user = auth()->user();
            $data = $request->validated();
           
       
            // checking or filtering existed data in farm profiles ddatabase
            $existingFarmProfile = FarmProfile::where([
                ['personal_informations_id', '=', $request->input('personal_informations_id')],
               
            ])->first();
            
            if ($existingFarmProfile) {
                return redirect('/farmprofile')->with('error', 'Farm Profile with this information already exists.');
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
                $farmProfile->save();

            return redirect('/fixedcost')->with('message', 'Farm Profile added successfully');
            } catch (\Exception $ex) {
                // Handle the exception
                dd($ex);
                return redirect('/farmprofile')->with('message', 'Something went wrong');
            }
       
    }
    
     
   
    // farmers view of all the data from farm profile by admin 
    public function ViewFarmProfile(){
        $farmprofiles=FarmProfile::orderBy('id','desc')->paginate(20);
        return view('farm_profile.farminfo_view',compact('farmprofiles'));
    }
    // agent farm profile update data view
    public function EditFarmProfile($id){
        $farmprofiles=FarmProfile::find($id);
        return view('farm_profile.farm_edit',compact('farmprofiles'));
    }
    
    
    // agent farm profile update data
        public function UpdateFarmProfiles(FarmProfileRequest $request,$id)
        {
        
            try{
                
    
                $data= $request->validated();
                $data= $request->all();
                
                $data= FarmProfile::find($id);
    
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
                
            
                return redirect('/view-farmprofile')->with('message','Farm Profile Data Update successsfully');
            
            }
            catch(\Exception $ex){
                // dd($ex); // Debugging statement to inspect the exception
                return redirect('/update-farmprofile/{farmprofiles}')->with('message','Someting went wrong');
                
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
}
