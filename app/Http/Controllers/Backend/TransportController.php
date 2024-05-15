<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransportRequest;
use App\Models\LastProductionDatas;
use App\Models\Transport;
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
class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 

    public function TransportVar()
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
            return view('variable_cost.transport.transport_store', compact('admin', 'profile', 'farmprofile','totalRiceProduction','userId'));
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
     * Store a newly created resource in storage.
     */
    public function store(TransportRequest $request)
    {
        try{
            $data= $request->validated();
            $data= $request->all();
            Transport::create($data);
    
            return redirect('/admin-variablecost')->with('message','transport data added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/admin-variable-cost-transport')->with('message','Someting went wrong');
        }
    }

   
// view, edit of transport by agent

public function edittransport($id)
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
            $transports= Transport::find($id);
      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('variable_cost.transport.update', compact('admin', 'profile', 'farmprofile','totalRiceProduction'
            ,'agri_districts','agri_districts_id','userId','transports'
            
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
public function updatestransport(TransportRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Transport::find($id);

       $data->name_of_vehicle = $request->name_of_vehicle;  
       $data->type_of_vehicle = $request->type_of_vehicle;
     
       $data->total_transport_per_deliverycost;
      
              
       $data->save();     
       
   
       return redirect('/admin-view-variable-cost-seed')->with('message','Transport Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/admin-edit-variable-cost-transport/{transports}')->with('message','Someting went wrong');
       
   }   
} 


public function transportdelete($id) {
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
}
