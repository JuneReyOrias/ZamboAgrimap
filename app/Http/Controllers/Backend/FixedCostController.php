<?php

namespace App\Http\Controllers\Backend;
use App\Models\FixedCost;
use App\Http\Controllers\Controller;
use App\Http\Requests\FixedCostRequest;
use App\Http\Requests\UpdateFixedCostRequest;
use App\Models\LastProductionDatas;
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
class FixedCostController extends Controller
{
   

    public function FixedForms()
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
            return view('fixed_cost.fixed_index', compact('admin', 'profile', 'farmprofile','totalRiceProduction','userId'));
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
    
    public function store(FixedCostRequest $request)
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
                return redirect('/admin-fixedcost')->with('error', 'Farm Profile with this information already exists.');
            }
    
    
            $data= $request->validated();
            $data= $request->all();
            $fixedcost= new FixedCost;
            $fixedcost->users_id = $request->users_id;
            $fixedcost->personal_informations_id = $request->personal_informations_id;
            $fixedcost->farm_profiles_id = $request->farm_profiles_id;
            $fixedcost->particular = $request->particular=== 'Other' ? $request->Add_Particular : $request->particular;
            $fixedcost->no_of_ha = $request->no_of_ha;
            $fixedcost->cost_per_ha = $request->cost_per_ha;
            $fixedcost->total_amount = $request->total_amount;
        
        //    dd($fixedcost);
            $fixedcost->save();
            return redirect('/admin-machineries-used')->with('message','Fixed Cost added successsfully');
        
        }
        catch(\Exception $ex){

            dd($ex);
            return redirect('/admin-fixedcost')->with('message','Someting went wrong');
        }
    }



    // fixed cost view

    public function FixedCostView(Request $request)
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
    
                // Query for fixed costs with eager loading of related models
                $fixedcosts = FixedCost::with('personalinformation', 'farmprofile')
                    ->orderBy('id', 'desc');
    
                // Apply search functionality
                if ($request->has('search')) {
                    $keyword = $request->input('search'); 
                    $fixedcosts->where(function ($query) use ($keyword) {
                        $query->whereHas('personalinformation', function ($query) use ($keyword) {
                            $query->where('last_name', 'like', "%$keyword%")
                                  ->orWhere('first_name', 'like', "%$keyword%");
                        });
                    });
                }
    
                // Paginate the results
                $fixedcosts = $fixedcosts->paginate(20);
    
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    
                // Return the view with the fetched data
                return view('fixed_cost.fixed_create', compact('admin', 'profile', 'fixedcosts', 'totalRiceProduction'));
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
   
    public function editFixedcost($id)
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
                $fixedcosts=FixedCost::find($id);
          
    
                
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with the fetched data
                return view('fixed_cost.fixed_edit', compact('admin', 'profile', 'farmprofile','totalRiceProduction'
                ,'agri_districts','agri_districts_id','userId','fixedcosts'
                
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
    
    public function updateFixedcosts(FixedCostRequest $request,$id)
    {
    
        try{
            
    
            $data= $request->validated();
            $data= $request->all();
            
            $data= FixedCost::find($id);
    
            $data->users_id = $request->users_id;
            $data->personal_informations_id = $request->personal_informations_id;
            $data->farm_profiles_id = $request->farm_profiles_id;
            $data->particular = $request->particular=== 'Other' ? $request->Add_Particular : $request->particular;
            $data->no_of_ha = $request->no_of_ha;
            $data->cost_per_ha = $request->cost_per_ha;
            $data->total_amount = $request->total_amount;
      
        //    dd($data);
    
            
            $data->save();     
            
        
            return redirect('/admin-view-personalinfo')->with('message','Fixed cost Data Updated successsfully');
        
        }
        catch(\Exception $ex){
            // dd($ex); // Debugging statement to inspect the exception
            return redirect('/admin-edit-fixedcost/{fixedcost}')->with('message','Someting went wrong');
            
        }   
    } 
    
    
    

    // deleting the fixed data
    
    public function destroyFixedcost($id) {
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
    
}
