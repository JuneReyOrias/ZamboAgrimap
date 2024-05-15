<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PesticidesRequest;
use App\Models\LastProductionDatas;
use App\Models\Pesticide;
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

class PesticideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
 
    
    public function PesticidesVar()
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
            return view('variable_cost.pesticides.pesticides_store', compact('admin', 'profile', 'farmprofile','totalRiceProduction','userId'));
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
    public function store(PesticidesRequest $request)
    {
        try{
            $data= $request->validated();
            $data= $request->all();
           
            $pesticides = new Pesticide;
            if ($request->pesticides_name === 'OtherPestName') {
                // If 'OtherPestName' option is selected, use the value from the additionalFertilizer field
                $pesticides->pesticides_name = $request->add_PestName;
                // You may also want to handle the type_ofpesticides differently here based on your requirement
                $pesticides->type_ofpesticides = $request->Add_typePest;
            } else {
                // If a predefined option is selected, use its value for both pesticides_name and type_ofpesticides
                $pesticides->pesticides_name = $request->pesticides_name;
                $pesticides->type_ofpesticides = $request->type_ofpesticides;
            }
            // Proceed with OtherPestName fields as usual
            $pesticides->no_of_l_kg = $request->no_of_l_kg;
            $pesticides->unitprice_ofpesticides = $request->unitprice_ofpesticides;
            $pesticides->total_cost_pesticides = $request->total_cost_pesticides;
            // dd($pesticides);
            // Save the pesticides data
            $pesticides->save();
    
            return redirect('/admin-variable-cost-transport')->with('message','Pesticides data added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/admin-variable-cost-pesticides')->with('message','Someting went wrong');
        }
    }

    
// edit, delete and view 0f pesticides data by admin


public function editpest($id)
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
            $pesticides= Pesticide::find($id);
      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('variable_cost.pesticides.pest_edit', compact('admin', 'profile', 'farmprofile','totalRiceProduction'
            ,'agri_districts','agri_districts_id','userId','pesticides'
            
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
public function updateslaborpest(PesticidesRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Pesticide::find($id);
       if ($request->pesticides_name === 'OtherPestName') {
        // If 'OtherPestName' option is selected, use the value from the additionalFertilizer field
        $data->pesticides_name = $request->add_PestName;
        // You may also want to handle the type_ofpesticides differently here based on your requirement
        $data->type_ofpesticides = $request->Add_typePest;
    } else {
        // If a predefined option is selected, use its value for both pesticides_name and type_ofpesticides
        $data->pesticides_name = $request->pesticides_name;
        $data->type_ofpesticides = $request->type_ofpesticides;
    }
    // Proceed with OtherPestName fields as usual
    $data->no_of_l_kg = $request->no_of_l_kg;
    $data->unitprice_ofpesticides = $request->unitprice_ofpesticides;
    $data->total_cost_pesticides = $request->total_cost_pesticides;
    // dd($data);
    // Save the data data
    $data->save();    
       
   
       return redirect('/admin-view-variable-cost-seed')->with('message','Pesticide Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/admin-edit-variable-cost-pesticides/{$pesticides}')->with('message','Someting went wrong');
       
   }   
} 


public function pestdelete($id) {
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
}
