<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariableCostRequest;
use App\Models\Labor;
use App\Models\LastProductionDatas;
use App\Models\Pesticide;
use App\Models\Transport;
use App\Models\VariableCost;
use Illuminate\Http\Request;
use App\Models\AgriDistrict;
use App\Models\FarmProfile;
use App\Http\Requests\FarmProfileRequest;
use App\Http\Requests\UpdateFarmProfileRequest;
use App\Models\Fertilizer;
use App\Models\PersonalInformations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Optional;
use App\Models\KmlFile;
use App\Models\Seed;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class VariableCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function VariableForms()
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
                
                // Calculate total rice production
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                
                // Fetch labor information
                $labor = Labor::where('users_id', $userId)->latest()->first();
                
                // Fetch seed information
                $seed = Seed::where('users_id', $userId)->latest()->first();
                
                // Fetch fertilizer information
                $fertilizer = Fertilizer::where('users_id', $userId)->latest()->first();
                
                // Fetch pesticide information
                $pesticide = Pesticide::where('users_id', $userId)->latest()->first();
                
                // Fetch transport information
                $transport = Transport::where('users_id', $userId)->latest()->first();
    
                // Return the view with the fetched data
                return view('variable_cost.variable_index', compact('admin', 'profile', 'farmprofile', 'totalRiceProduction', 'userId', 'labor', 'seed', 'fertilizer', 'pesticide', 'transport'));
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
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VariableCostRequest $request)
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
                        return redirect('/admin-variablecost')->with('error', 'VariableCost with this information already exists.');
                    }
            
                $data= $request->validated();
                $data= $request->all();
               VariableCost::create($data);
        
                return redirect('/admin-lastproduction-data')->with('message','Variable Cost added successsfully');
            
            }
            catch(\Exception $ex){
                return redirect('/dmin-variablecost')->with('message','Someting went wrong');
            }
        }
    }

   
// // varaible cost view, edit, update and delete access by agent
// public function  varView(){
//     $variable= VariableCost::orderBy('id','desc')->paginate(10);
//     $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
//     return view('variable_cost.var_show',compact('variable','totalRiceProduction'));
// }







public function editvar($id)
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
            $agri_district = $user->agri_district;
            $agri_districts_id = $user->agri_districts_id;
            // Find the farm profile using the fetched farm ID
            $farmprofile = FarmProfile::where('id', $farmId)->latest()->first();
            $variable= VariableCost::find($id);

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('variable_cost.var_update', compact('admin', 'profile', 'farmprofile','totalRiceProduction'
            ,'variable','userId','agri_district','agri_districts_id'
            
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
public function updatesvar(VariableCostRequest $request,$id)
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
       
   
       return redirect('/admin-view-personalinfo')->with('message','Variable Cost Data Updated successsfully');
   
   }
   catch(\Exception $ex){
       dd($ex); // Debugging statement to inspect the exception
       return redirect('/admin-edit-variable-cost/{variable}')->with('message','Someting went wrong');
       
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



}
