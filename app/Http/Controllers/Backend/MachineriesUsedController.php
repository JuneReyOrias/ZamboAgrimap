<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MachineriesUsedtRequest;
use App\Http\Requests\UpdateMachineriesUsedRequest;
use App\Http\Requests\FixedCostRequest;
use App\Http\Requests\UpdateFixedCostRequest;
use App\Models\LastProductionDatas;
use App\Models\MachineriesUseds;
use Illuminate\Http\Request;
use App\Models\AgriDistrict;
use App\Models\FarmProfile;
use App\Http\Requests\FarmProfileRequest;
use App\Http\Requests\UpdateFarmProfileRequest;
use App\Models\PersonalInformations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Optional;
use App\Models\KmlFile;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MachineriesUsedController extends Controller
{



    public function MachineForms()
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
            $farmId = $user->id;

            // Find the farm profile using the fetched farm ID
            $farmprofile = FarmProfile::where('users_id', $farmId)->latest()->first();
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('machineries_used.machine_index', compact('admin', 'profile', 'farmprofile','totalRiceProduction','userId'));
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
    
    // storing new data by admin
    public function store(MachineriesUsedtRequest $request)
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
           $machineused-> users_id = $request->users_id;
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
    
            return redirect('/admin-variable-cost-seeds')->with('message','Machineries Cost added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/admin-machineries-used')->with('message','Please try again');
        }
    }

   
// // machineries used view 
// public function MachineriesVieew(){
//     $machineries= MachineriesUseds::orderBy('id','desc')->paginate(20);
//     $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
//     return view('machineries_used.machine_create',compact('machineries','totalRiceProduction'));
// }
public function  MachineriesVieew(Request $request)
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
            // $machineries= MachineriesUseds::orderBy('id','desc')->paginate(20);
            // Query for fixed costs with eager loading of related models
            $machineries = MachineriesUseds::with('personalinformation', 'farmprofile')
                ->orderBy('id', 'desc');

            // Apply search functionality
            if ($request->has('search')) {
                $keyword = $request->input('search');
                $machineries->where(function ($query) use ($keyword) {
                    $query->whereHas('personalinformation', function ($query) use ($keyword) {
                        $query->where('last_name', 'like', "%$keyword%")
                              ->orWhere('first_name', 'like', "%$keyword%");
                    });
                });
            }

            // Paginate the results
            $machineries = $machineries->paginate(20);

            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');

            // Return the view with the fetched data
            return view('machineries_used.machine_create', compact('admin', 'profile', 'machineries', 'totalRiceProduction'));
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

// fixed cost update
// public function editMachineries($id){
//    $machineries=MachineriesUseds::find($id);
//    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
//     return view('machineries_used.machine_edit',compact('machineries','totalRiceProduction'));
// }
public function editMachineries($id)
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
            $farmprofile = FarmProfile::where('users_id', $farmId)->latest()->first();
            $machineries=MachineriesUseds::find($id);
      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('machineries_used.machine_edit', compact('admin', 'profile', 'farmprofile','totalRiceProduction'
            ,'agri_districts','agri_districts_id','userId','machineries'
            
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


public function updateMachineries(MachineriesUsedtRequest $request,$id)
{

    try{
        

     

      
        $data= $request->validated();
        $data= $request->all();
      $data= MachineriesUseds::find($id);
       $data-> users_id = $request->users_id;
       $data-> personal_informations_id = $request->personal_informations_id;
       $data->farm_profiles_id = $request->farm_profiles_id;
       $data-> plowing_machineries_used = $request->plowing_machineries_used === 'OthersPlowing' ? $request->add_Plowingmachineries : $request->plowing_machineries_used;
       $data-> plo_ownership_status = $request->plo_ownership_status === 'Other' ? $request->add_PlowingStatus : $request->plo_ownership_status;
       $data->no_of_plowing = $request->no_of_plowing;
       $data->cost_per_plowing = $request->cost_per_plowing;
       $data-> plowing_cost = $request->plowing_cost;
        
       $data-> harrowing_machineries_used = $request->harrowing_machineries_used=== 'OtherHarrowing' ? $request->Add_HarrowingMachineries : $request->harrowing_machineries_used;
       $data->harro_ownership_status = $request->harro_ownership_status=== 'Otherharveststat' ? $request->add_harvestingStatus : $request->harro_ownership_status;
       $data->no_of_harrowing = $request->no_of_harrowing; 
       $data->cost_per_harrowing = $request->cost_per_harrowing; 
       $data->harrowing_cost = $request->harrowing_cost;

       $data->harvesting_machineries_used = $request->harvesting_machineries_used=== 'OtherHarvesting' ? $request->add_HarvestingMachineries : $request->harvesting_machineries_used;
       $data->harvest_ownership_status = $request->harvest_ownership_status=== 'OtherHarvesting' ? $request->add_HarvestingMachineries : $request->harvest_ownership_status;
       $data->harvesting_cost = $request->harvesting_cost;

       $data->postharvest_machineries_used = $request->postharvest_machineries_used=== 'Otherpostharvest' ? $request->add_postharvestMachineries : $request->postharvest_machineries_used;
       $data->postharv_ownership_status = $request->postharv_ownership_status=== 'OtherpostharvestStatus' ? $request->add_postStatus : $request->postharv_ownership_status;
       $data->post_harvest_cost = $request->post_harvest_cost;
       $data->total_cost_for_machineries = $request->total_cost_for_machineries;
         
        // dd($data);
        $data->save();    
        
    
        return redirect('/admin-view-personalinfo')->with('message','Machineries Used Data Updated successsfully');
    
    }
    catch(\Exception $ex){
        // dd($ex); // Debugging statement to inspect the exception
        return redirect('/admin-edit-machineries-used/{machineries}')->with('message','Someting went wrong');
        
    }   
} 






public function machineriesdestroy($id) {
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
}
