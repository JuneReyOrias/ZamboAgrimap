<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeedRequest;
use App\Models\Fertilizer;
use App\Models\Labor;
use App\Models\LastProductionDatas;
use App\Models\Pesticide;
use App\Models\Seed;

use App\Models\MachineriesUseds;

use App\Models\AgriDistrict;
use App\Models\FarmProfile;
use App\Http\Requests\FarmProfileRequest;
use App\Http\Requests\UpdateFarmProfileRequest;
use App\Models\PersonalInformations;
use App\Models\VariableCost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Optional;
use App\Models\KmlFile;
use App\Models\Transport;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class SeedController extends Controller
{
    // public function SeedsVar(){
    //     $pesticides= Seed::all();
    //     $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    // return view('variable_cost.seeds.seeds_store',compact('pesticides','totalRiceProduction'));


    
    public function SeedsVar()
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
            return view('variable_cost.seeds.seeds_store', compact('admin', 'profile', 'farmprofile','totalRiceProduction','userId'));
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
    /*
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
    public function store(SeedRequest $request)
    {
        try{
            $data= $request->validated();
            $data= $request->all();
            $seeds= new Seed;
            $seeds->users_id = $request->users_id;
            $seeds->seed_name = $request->seed_name === 'OtherseedName' 
            ? $request->add_newInbreeds 
            : ($request->seed_name === 'OtherseedVarie' 
                ? $request->add_newInbreed
                : $request->seed_name);
    
    
            $seeds->seed_type = $request->seed_type === 'OtherseedVariety' ? $request->AddRiceVariety : $request->seed_type;
           
            $seeds->unit = $request->unit;
            $seeds->quantity = $request->quantity;
            $seeds->unit_price = $request->unit_price;
            $seeds->total_seed_cost = $request->total_seed_cost;
            // dd($seeds);
            $seeds->save();
    
            return redirect('/admin-variable-cost-labor')->with('message','Seeds data added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex);
            return redirect('/admin-variable-cost-seeds')->with('message','Someting went wrong');
        }
    }


// Seeds data update and view accessed by agent



public function  SeedsView(Request $request)
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
         
                // Query for seeds with search functionality
            $seedsQuery = Seed::query();
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $seedsQuery->where('seed_name', 'like', "%$searchTerm%");
            }
            $seeds = $seedsQuery->orderBy('id','asc')->paginate(10);
            
            // Query for labors with search functionality
                $laborsQuery = Labor::query();
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $laborsQuery->where(function($query) use ($searchTerm) {
                        $query->where('no_of_person', 'like', "%$searchTerm%")
                            ->orWhere('total_labor_cost', 'like', "%$searchTerm%")
                            ->orWhere('rate_per_person', 'like', "%$searchTerm%");
                    });
                }
                $labors = $laborsQuery->orderBy('id','asc')->paginate(10);

                      // Query for fertilizer with search functionality
                      $fertilizersQuery = Fertilizer::query();
                      if ($request->has('search')) {
                          $searchTerm = $request->input('search');
                          $fertilizersQuery->where(function($query) use ($searchTerm) {
                              $query->where('name_of_fertilizer', 'like', "%$searchTerm%")
                                  ->orWhere('no_ofsacks', 'like', "%$searchTerm%")
                                  ->orWhere('total_cost_fertilizers', 'like', "%$searchTerm%");
                          });
                      }
                      $fertilizers = $fertilizersQuery->orderBy('id','asc')->paginate(10);

                      // Query for pesticides with search functionality
                    $pesticidesQuery =  Pesticide::query();
                    if ($request->has('search')) {
                        $searchTerm = $request->input('search');
                        $pesticidesQuery->where(function($query) use ($searchTerm) {
                            $query->where('pesticides_name', 'like', "%$searchTerm%")
                                ->orWhere('type_ofpesticides', 'like', "%$searchTerm%")
                                ->orWhere('total_cost_pesticides', 'like', "%$searchTerm%");
                        });
                    }
                    $pesticides = $pesticidesQuery->orderBy('id','asc')->paginate(10);
                    
                     // Query for transports with search functionality
                    $transportsQuery =  Transport::query();
                    if ($request->has('search')) {
                        $searchTerm = $request->input('search');
                        $transportsQuery->where(function($query) use ($searchTerm) {
                            $query->where('name_of_vehicle', 'like', "%$searchTerm%")
                                ->orWhere('type_of_vehicle', 'like', "%$searchTerm%")
                                ->orWhere('total_transport_per_deliverycost', 'like', "%$searchTerm%");
                        });
                    }
                    $transports = $transportsQuery->orderBy('id','asc')->paginate(10);

                    // Query for variable cost with search functionality
                    $variable = VariableCost::with('personalinformation', 'farmprofile','seeds','labors','fertilizers','pesticides','transports')
                    ->orderBy('id', 'asc');
    
                // Apply search functionality
                if ($request->has('search')) {
                    $keyword = $request->input('search');
                    $variable->where(function ($query) use ($keyword) {
                        $query->whereHas('personalinformation', function ($query) use ($keyword) {
                            $query->where('last_name', 'like', "%$keyword%")
                                  ->orWhere('first_name', 'like', "%$keyword%");
                        });
                    });
                }
    
                // Paginate the results
                $variable = $variable->paginate(20);
           
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');

            // Return the view with the fetched data
            return view('variable_cost.seeds.view', compact('admin', 'profile', 'labors', 'seeds','fertilizers','pesticides','transports','variable', 'totalRiceProduction'));
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





public function editSeeds($id)
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
            $seeds= Seed::find($id);
      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('variable_cost.seeds.seed_edit', compact('admin', 'profile', 'farmprofile','totalRiceProduction'
            ,'agri_districts','agri_districts_id','userId','seeds'
            
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

public function updatesSeeds(SeedRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Seed::find($id);

       $data->users_id = $request->users_id;
       $data->seed_name = $request->seed_name === 'OtherseedName' 
       ? $request->add_newInbreeds 
       : ($request->seed_name === 'OtherseedVarie' 
           ? $request->add_newInbreed
           : $request->seed_name);


       $data->seed_type = $request->seed_type === 'OtherseedVariety' ? $request->AddRiceVariety : $request->seed_type;
      
       $data->unit = $request->unit;
       $data->quantity = $request->quantity;
       $data->unit_price = $request->unit_price;
       $data->total_seed_cost = $request->total_seed_cost;
       // dd($data);
       $data->save();
       
   
       return redirect('/admin-view-variable-cost-seed')->with('message','Seeds Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/admin-edit-variable-cost-seed/{seeds}')->with('message','Someting went wrong');
       
   }   
} 






public function SeedsDelete($id) {
   try {
       // Find the personal information by ID
       $seeds= Seed::find($id);

       // Check if the personal information exists
       if (! $seeds) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
      $seeds->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'Seed data deleted Successfully');

   } catch (\Exception $e) {
    //    dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}


}
