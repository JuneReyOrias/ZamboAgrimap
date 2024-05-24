<?php

namespace App\Http\Controllers\Backend;
use App\Models\AgriDistrict;
use App\Models\FarmProfile;
use App\Http\Controllers\Controller;
use App\Http\Requests\FarmProfileRequest;
use App\Http\Requests\UpdateFarmProfileRequest;
use App\Models\LastProductionDatas;
use App\Models\PersonalInformations;
use App\Models\FixedCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Optional;
use App\Models\KmlFile;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class FarmProfileController extends Controller
{
   

        // adding new farm profile data
                    public function FarmProfile()
            {
                // Check if the user is authenticated
                if (Auth::check()) {
                    // User is authenticated, proceed with retrieving the user's ID
                    $userId = Auth::id();

                    // Find the user based on the retrieved ID
                    $admin = User::find($userId);

                    if ($admin) {
                        // Assuming $user represents the currently logged-in user
                        $user = auth()->user();

                        // Check if user is authenticated before proceeding
                        if (!$user) {
                            // Handle unauthenticated user, for example, redirect them to login
                            return redirect()->route('login');
                        }

                        // Fetch user's information
                        $user_id = $user->id;
                        $agri_districts = $user->agri_district;
                        $agri_districts_id = $user->agri_districts_id;

                        // Find the user by their ID and eager load the personalInformation relationship
                        $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
                        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                        // Return the view with the fetched data
                        return view('farm_profile.farm_index', compact('agri_districts', 'agri_districts_id', 'admin', 'profile','totalRiceProduction','userId'));
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

       public function Arcmap(Request $request)
{
    // Check if the user is authenticated
    if (Auth::check()) {
        // User is authenticated, proceed with retrieving the user's ID
        $userId = Auth::id();

        // Find the user based on the retrieved ID
        $admin = User::find($userId);

        if ($admin) {
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

           // Retrieve the search query from the request
           $searchQuery = $request->input('query');
           $searchType = $request->input('search_type'); // Assuming 'search_type' is provided in the request
           
           // Check if the search query is in all capital letters
           if ($searchQuery === mb_strtoupper($searchQuery, 'UTF-8')) {
               // If the search query is in all capital letters, redirect back with an error message
               return redirect()->back()->withErrors(['search_error' => 'Search query cannot be in all capital letters.']);
           }
           
           // Query to fetch farm locations based on last name, middle name, first name, longitude, or latitude
           $farmLocationQuery = DB::table('farm_profiles')
               ->join('agri_districts', 'farm_profiles.agri_districts_id', '=', 'agri_districts.id')
               ->leftJoin('polygons', 'farm_profiles.polygons_id', '=', 'polygons.id')
               ->leftJoin('personal_informations', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
               ->select('farm_profiles.*', 'agri_districts.*', 'polygons.*', 'personal_informations.*');
           
           // Check the search type and add appropriate conditions
           switch ($searchType) {
               case 'longitude':
                   $farmLocationQuery->where('farm_profiles.longitude', '=', $searchQuery);
                   break;
               case 'latitude':
                   $farmLocationQuery->where('farm_profiles.latitude', '=', $searchQuery);
                   break;
               default:
                   // For other search types, search in names
                   $farmLocationQuery->where(function ($query) use ($searchQuery) {
                       $query->where('personal_informations.last_name', 'like', '%' . $searchQuery . '%')
                             ->orWhere('personal_informations.middle_name', 'like', '%' . $searchQuery . '%')
                             ->orWhere('personal_informations.first_name', 'like', '%' . $searchQuery . '%')
                             ->orWhere('farm_profiles.tenurial_status', 'like', '%' . $searchQuery . '%');
                   });
                   break;
           }
           
           // Execute the query to fetch farm locations
           $farmLocation = $farmLocationQuery->get();
           
           // If no farm locations are found, redirect back with an error message
           if ($farmLocation->isEmpty()) {
               return redirect()->back()->withErrors(['search_error' => 'No farm locations found for the provided query.']);
           }
           
           // Initialize empty arrays
           $agriDistrictIds = [];
           $polygonsIds = [];
           
           // Loop through each row of the result
           foreach ($farmLocation as $location) {
               // Extract agri_district_id and polygons_id from each row
               $agriDistrictIds[] = $location->id;
               $polygonsIds[] = $location->id;
           }

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            $kmlFiles = KmlFile::all()->map(function ($file) {
                return asset('storage/' . $file->filename);
            });
    
            // Return the view with the fetched data
            return view('map.arcmap', compact( 'profile', 'farmProfile','farmLocation','totalRiceProduction',
            'agriDistrictIds', 'agriDistrictIds',
            'polygonsIds','admin','kmlFiles',
            'searchQuery' , // Pass the search query to the view
            'searchType', // Pass the search type to the view
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

// agent map view
public function Gmap(Request $request)
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

           // Retrieve the search query from the request
           $searchQuery = $request->input('query');
           $searchType = $request->input('search_type'); // Assuming 'search_type' is provided in the request
           
           // Check if the search query is in all capital letters
           if ($searchQuery === mb_strtoupper($searchQuery, 'UTF-8')) {
               // If the search query is in all capital letters, redirect back with an error message
               return redirect()->back()->withErrors(['search_error' => 'Search query cannot be in all capital letters.']);
           }
           
           // Query to fetch farm locations based on last name, middle name, first name, longitude, or latitude
           $farmLocationQuery = DB::table('farm_profiles')
               ->join('agri_districts', 'farm_profiles.agri_districts_id', '=', 'agri_districts.id')
               ->leftJoin('polygons', 'farm_profiles.polygons_id', '=', 'polygons.id')
               ->leftJoin('personal_informations', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
               ->select('farm_profiles.*', 'agri_districts.*', 'polygons.*', 'personal_informations.*');
           
           // Check the search type and add appropriate conditions
           switch ($searchType) {
               case 'longitude':
                   $farmLocationQuery->where('farm_profiles.longitude', '=', $searchQuery);
                   break;
               case 'latitude':
                   $farmLocationQuery->where('farm_profiles.latitude', '=', $searchQuery);
                   break;
               default:
                   // For other search types, search in names
                   $farmLocationQuery->where(function ($query) use ($searchQuery) {
                       $query->where('personal_informations.last_name', 'like', '%' . $searchQuery . '%')
                             ->orWhere('personal_informations.middle_name', 'like', '%' . $searchQuery . '%')
                             ->orWhere('personal_informations.first_name', 'like', '%' . $searchQuery . '%')
                             ->orWhere('farm_profiles.tenurial_status', 'like', '%' . $searchQuery . '%');
                   });
                   break;
           }
           
           // Execute the query to fetch farm locations
           $farmLocation = $farmLocationQuery->get();
           
           // If no farm locations are found, redirect back with an error message
           if ($farmLocation->isEmpty()) {
               return redirect()->back()->withErrors(['search_error' => 'No farm locations found for the provided query.']);
           }
           
           // Initialize empty arrays
           $agriDistrictIds = [];
           $polygonsIds = [];
           
           // Loop through each row of the result
           foreach ($farmLocation as $location) {
               // Extract agri_district_id and polygons_id from each row
               $agriDistrictIds[] = $location->id;
               $polygonsIds[] = $location->id;
           }

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('map.gmap', compact('agent', 'profile', 'farmProfile','farmLocation','totalRiceProduction',
            'agriDistrictIds', 'agriDistrictIds',
            'polygonsIds',
            'searchQuery' , // Pass the search query to the view
            'searchType', // Pass the search type to the view
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
        // user view the map
    public function agrimap(Request $request)
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
    
               // Retrieve the search query from the request
               $searchQuery = $request->input('query');
               $searchType = $request->input('search_type'); // Assuming 'search_type' is provided in the request
               
               // Check if the search query is in all capital letters
               if ($searchQuery === mb_strtoupper($searchQuery, 'UTF-8')) {
                   // If the search query is in all capital letters, redirect back with an error message
                   return redirect()->back()->withErrors(['search_error' => 'Search query cannot be in all capital letters.']);
               }
               
               // Query to fetch farm locations based on last name, middle name, first name, longitude, or latitude
               $farmLocationQuery = DB::table('farm_profiles')
                   ->join('agri_districts', 'farm_profiles.agri_districts_id', '=', 'agri_districts.id')
                   ->leftJoin('polygons', 'farm_profiles.polygons_id', '=', 'polygons.id')
                   ->leftJoin('personal_informations', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                   ->select('farm_profiles.*', 'agri_districts.*', 'polygons.*', 'personal_informations.*');
               
               // Check the search type and add appropriate conditions
               switch ($searchType) {
                   case 'longitude':
                       $farmLocationQuery->where('farm_profiles.longitude', '=', $searchQuery);
                       break;
                   case 'latitude':
                       $farmLocationQuery->where('farm_profiles.latitude', '=', $searchQuery);
                       break;
                   default:
                       // For other search types, search in names
                       $farmLocationQuery->where(function ($query) use ($searchQuery) {
                           $query->where('personal_informations.last_name', 'like', '%' . $searchQuery . '%')
                                 ->orWhere('personal_informations.middle_name', 'like', '%' . $searchQuery . '%')
                                 ->orWhere('personal_informations.first_name', 'like', '%' . $searchQuery . '%')
                                 ->orWhere('farm_profiles.tenurial_status', 'like', '%' . $searchQuery . '%');
                       });
                       break;
               }
               
               // Execute the query to fetch farm locations
               $farmLocation = $farmLocationQuery->get();
               
               // If no farm locations are found, redirect back with an error message
               if ($farmLocation->isEmpty()) {
                   return redirect()->back()->withErrors(['search_error' => 'No farm locations found for the provided query.']);
               }
               
               // Initialize empty arrays
               $agriDistrictIds = [];
               $polygonsIds = [];
               
               // Loop through each row of the result
               foreach ($farmLocation as $location) {
                   // Extract agri_district_id and polygons_id from each row
                   $agriDistrictIds[] = $location->id;
                   $polygonsIds[] = $location->id;
               }
    
                
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with the fetched data
                return view('map.agrimap', compact('agent', 'profile', 'farmProfile','farmLocation','totalRiceProduction',
                'agriDistrictIds', 'agriDistrictIds',
                'polygonsIds',
                'searchQuery' , // Pass the search query to the view
                'searchType', // Pass the search type to the view
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
    
   
  
   

    // insertion of new data into farm profile table by admin

public function store(FarmProfileRequest $request)
{
    try {
        // Get authenticated user
        $user = auth()->user();

        // Validate the incoming request data
        $data = $request->validated();

        // Check if FarmProfile with the given personal_informations_id already exists
        $existingFarmProfile = FarmProfile::where('personal_informations_id', $request->input('personal_informations_id'))->first();

        if ($existingFarmProfile) {
            return redirect('/admin-farmprofile')->with('error', 'Farm Profile with this information already exists.');
        }

        // Create a new FarmProfile instance
        $farmProfile = new FarmProfile;
        $farmProfile->users_id = $request->users_id;
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
        return redirect('/admin-fixedcost')->with('message', 'Farm Profile added successfully');
    } catch (\Exception $ex) {
        // Log the exception or handle it appropriately
        // dd($ex);
        return redirect('/admin-farmprofile')->with('message', 'Something went wrong');
    }
}  
   
    // farmers view of all the data from farm profile by admin 
    
    public function ViewFarmProfile(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $admin = User::find($userId);
    
            if ($admin) {
                // Assuming $user represents the currently logged-in user
                $user = auth()->user();
    
                // Check if user is authenticated before proceeding
                if (!$user) {
                    // Handle unauthenticated user, for example, redirect them to login
                    return redirect()->route('login');
                }
    
                // Find the user's personal information by their ID
                $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
    
                // Fetch all farm profiles with their associated personal information and agricultural districts
                $farmProfiles = FarmProfile::select('farm_profiles.*')
                    ->leftJoin('personal_informations', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->with('agriDistrict')
                    ->orderBy('farm_profiles.id', 'desc');
    
                // Check if a search query is provided
                if ($request->has('search')) {
                    $keyword = $request->input('search');
                    // Apply search filters for last name and first name
                    $farmProfiles->where(function ($query) use ($keyword) {
                        $query->where('personal_informations.last_name', 'like', "%$keyword%")
                              ->orWhere('personal_informations.first_name', 'like', "%$keyword%");
                    });
                }
    
                // Paginate the results
                $farmProfiles = $farmProfiles->paginate(20);
    
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    
                // Return the view with the fetched data
                return view('farm_profile.farminfo_view', compact('admin', 'profile', 'farmProfiles', 'totalRiceProduction'));
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
    
    
    // agent farm profile update data view
    public function EditFarmProfile($id)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $admin = User::find($userId);
    
            if ($admin) {
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
                $agri_districts = $user->agri_district;
                $agri_districts_id = $user->agri_districts_id;

                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                $farmprofiles=FarmProfile::find($id);
          
    
                
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with the fetched data
                return view('farm_profile.farm_edit', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
                ,'farmprofiles','agri_districts','agri_districts_id','userId'
                
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
    
    // agent farm profile update data
        public function UpdateFarmProfiles(FarmProfileRequest $request,$id)
        {
        
            try{
                
    
                $data= $request->validated();
                $data= $request->all();
                
                $data= FarmProfile::find($id);

               
                $data->users_id = $request->users_id;
                $data->personal_informations_id = $request->personal_informations_id;
                $data->agri_districts_id = $request->agri_districts_id;
                $data->agri_districts = $request->agri_districts;
                $data->tenurial_status = $request->tenurial_status === 'Add' ? $request->add_newTenure : $request->tenurial_status;
                $data->rice_farm_address = $request->rice_farm_address;
                $data->no_of_years_as_farmers = $request->no_of_years_as_farmers === 'Add' ? $request->add_newFarmyears : $request->no_of_years_as_farmers;
                $data->gps_longitude = $request->gps_longitude;
                $data->gps_latitude = $request->gps_latitude;
                $data->total_physical_area_has = $request->total_physical_area_has;
                $data->rice_area_cultivated_has = $request->rice_area_cultivated_has;
                $data->land_title_no = $request->land_title_no;
                $data->lot_no = $request->lot_no;
                $data->area_prone_to = $request->area_prone_to === 'Add Prone' ? $request->add_newProneYear : $request->area_prone_to;
                $data->ecosystem = $request->ecosystem === 'Add ecosystem' ? $request->Add_Ecosystem : $request->ecosystem;
                $data->type_rice_variety = $request->type_rice_variety;
                $data->prefered_variety = $request->prefered_variety;
                $data->plant_schedule_wetseason = $request->plant_schedule_wetseason;
                $data->plant_schedule_dryseason = $request->plant_schedule_dryseason;
                $data->no_of_cropping_yr = $request->no_of_cropping_yr === 'Adds' ? $request->add_cropyear : $request->no_of_cropping_yr;
                $data->yield_kg_ha = $request->yield_kg_ha;
                $data->rsba_register = $request->rsba_register;
                $data->pcic_insured = $request->pcic_insured;
                $data->government_assisted = $request->government_assisted;
                $data->source_of_capital = $request->source_of_capital === 'Others' ? $request->add_sourceCapital : $request->source_of_capital;
                $data->remarks_recommendation = $request->remarks_recommendation;
                $data->oca_district_office = $request->oca_district_office;
                $data->name_technicians = $request->name_technicians;
                $data->date_interview = $request->date_interview;

                // Handle image upload
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('farmimage'), $imageName);
                $data->image = $imageName;
            }

                // dd($data);
                $data->save();     
                
            // Redirect back with success message
            return redirect('/admin-view-personalinfo')->with('message', 'Farm Profile Data updated successfully');
    
    }catch(\Exception $ex){
   
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
