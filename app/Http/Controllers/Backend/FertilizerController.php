<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FertilizerRequest;
use App\Models\Fertilizer;
use App\Models\Labor;
use App\Models\LastProductionDatas;
use Illuminate\Http\Request;
use App\Models\MachineriesUseds;

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
class FertilizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function FertilizersVar()
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
            return view('variable_cost.fertilizer.fertilizer_store', compact('admin', 'profile', 'farmprofile','totalRiceProduction','userId'));
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
    public function store(FertilizerRequest $request)
    {
        try{

            
            $data= $request->validated();
        // $data= $request->all();
        $fertilizer = new Fertilizer;
        if ($request->name_of_fertilizer === 'other') {
            // If 'other' option is selected, use the value from the additionalFertilizer field
            $fertilizer->name_of_fertilizer = $request->additionalFertilizer;
            // You may also want to handle the type_of_fertilizer differently here based on your requirement
            $fertilizer->type_of_fertilizer = $request->type_of_fertilizers;
        } else {
            // If a predefined option is selected, use its value for both name_of_fertilizer and type_of_fertilizer
            $fertilizer->name_of_fertilizer = $request->name_of_fertilizer;
            $fertilizer->type_of_fertilizer = $request->type_of_fertilizer;
        }
        // Proceed with other fields as usual
        $fertilizer->no_ofsacks = $request->no_ofsacks;
        $fertilizer->unitprice_per_sacks = $request->unitprice_per_sacks;
        $fertilizer->total_cost_fertilizers = $request->total_cost_fertilizers;
        // dd($fertilizer);
        // Save the fertilizer data
        $fertilizer->save();
    
            return redirect('/admin-variable-cost-pesticides')->with('message','Fertilizers data added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/admin-variable-cost-fertilizer')->with('message','Someting went wrong');
        }
    }

  

// edit ,view and delete of fertilizer access by admin

public function editfertilizer($id)
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
            $fertilizers= Fertilizer::find($id);
      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('variable_cost.fertilizer.edit', compact('admin', 'profile', 'farmprofile','totalRiceProduction'
            ,'agri_districts','agri_districts_id','userId','fertilizers'
            
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

// admin update the fetilizers data
public function updatesfertilizer(FertilizerRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Fertilizer::find($id);

            if ($request->name_of_fertilizer === 'other') {
                // If 'other' option is selected, use the value from the additionalFertilizer field
                $data->name_of_fertilizer = $request->additionalFertilizer;
                // You may also want to handle the type_of_fertilizer differently here based on your requirement
                $data->type_of_fertilizer = $request->type_of_fertilizers;
            } else {
                // If a predefined option is selected, use its value for both name_of_fertilizer and type_of_fertilizer
                $data->name_of_fertilizer = $request->name_of_fertilizer;
                $data->type_of_fertilizer = $request->type_of_fertilizer;
            }
            // Proceed with other fields as usual
            $data->no_ofsacks = $request->no_ofsacks;
            $data->unitprice_per_sacks = $request->unitprice_per_sacks;
            $data->total_cost_fertilizers = $request->total_cost_fertilizers;
            // dd($data);
            // Save the data data
            $data->save();
            
   
       return redirect('/admin-view-variable-cost-seed')->with('message','Fertilizer Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/admin-edit-variable-cost-fertilizer/{fertilizers}')->with('message','Someting went wrong');
       
   }   
} 


public function FertilizerDelete($id) {
   try {
       // Find the personal information by ID
       $fertilizers= Fertilizer::find($id);

       // Check if the personal information exists
       if (! $fertilizers) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
      $fertilizers->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'Fertilizer data deleted Successfully');

   } catch (\Exception $e) {
    //    dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}


}
