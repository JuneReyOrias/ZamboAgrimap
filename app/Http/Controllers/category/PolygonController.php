<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\PolygonRequest;
use App\Models\AgriDistrict;
use App\Models\FarmProfile;
use App\Models\Fertilizer;
use App\Models\Labor;
use App\Models\LastProductionDatas;
use App\Models\ParcellaryBoundaries;
use App\Models\PersonalInformations;
use App\Models\Pesticide;
use App\Models\Polygon;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

use App\Models\User;
use App\Models\VariableCost;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PolygonController extends Controller
{
     /**
     * Display a listing of the resource.
     */
  
    /**
     * Show the form for creating a new resource.
     */
  
    


    public function Polygons()
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
            $agriculture = AgriDistrict::all();
      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('polygon.polygon_create', compact('admin', 'profile', 'farmprofile','totalRiceProduction'
            ,'agri_districts','agri_districts_id','userId','agriculture'
            
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(PolygonRequest $request)
    {
        try{
        
            $data= $request->validated();
            // $data= $request->all();
           Polygon::create([
         
            'agri_districts_id'=>$request->input('agri_districts_id'),
            'verone_latitude'=>$request->input('verone_latitude'),
            'verone_longitude'=>$request->input('verone_longitude'),
            'vertwo_latitude'=>$request->input('vertwo_latitude'),
            'vertwo_longitude'=>$request->input('vertwo_longitude'),
            'verthree_latitude'=>$request->input('verthree_latitude'),
            'verthree_longitude'=>$request->input('verthree_longitude'),
            'vertfour_latitude'=>$request->input('vertfour_latitude'),
            'vertfour_longitude'=>$request->input('vertfour_longitude'),
            'verfive_latitude'=>$request->input('verfive_latitude'),
            'verfive_longitude'=>$request->input('verfive_longitude'),
            'versix_latitude'=>$request->input('versix_latitude'),
            'versix_longitude'=>$request->input('versix_longitude'),
            'verseven_latitude'=>$request->input('verseven_latitude'),
            'verseven_longitude'=>$request->input('verseven_longitude'),
            'vereight_latitude'=>$request->input('vereight_latitude'),
            'verteight_longitude'=>$request->input('verteight_longitude'),
            'strokecolor'=>$request->input('strokecolor'),
            'area'=>$request->input('area'),
            'perimeter'=>$request->input('perimeter'),
            'poly_name'=>$request->input('poly_name'),
           ]);
    
            return redirect('/polygon/create')->with('message','Polygon Boundary added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/personalinformation')->with('message','Someting went wrong');
            
        }   
    }
// fixed cost view





public function  polygonshow(Request $request)
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
            $polygonsQuery = Polygon::query();
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $polygonsQuery->where('poly_name', 'like', "%$searchTerm%");
            }
            $polygons = $polygonsQuery->orderBy('id','asc')->paginate(10);
          
            // Query for labors with search functionality
                $parcelsQuery = ParcellaryBoundaries::query();
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $parcelsQuery->where(function($query) use ($searchTerm) {
                        $query->where('no_of_person', 'like', "%$searchTerm%")
                            ->orWhere('total_labor_cost', 'like', "%$searchTerm%")
                            ->orWhere('rate_per_person', 'like', "%$searchTerm%");
                    });
                }
                $parcels = $parcelsQuery->orderBy('id','asc')->paginate(10);

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
            return view('polygon.polygons_show', compact('admin','polygons', 'profile', 'parcels','fertilizers','pesticides','transports','variable', 'totalRiceProduction'));
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




// polgygons boundary for edit view by fetching the spicific id

public function polygonEdit($id)
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
            $polygons=Polygon::find($id);
      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('polygon.polygons_edit', compact('admin', 'profile', 'farmprofile','totalRiceProduction'
            ,'agri_districts','agri_districts_id','userId','polygons'
            
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
public function polygonUpdates(PolygonRequest $request,$id)
{

    try{
        

        $data= $request->validated();
        $data= $request->all();
        
        $data= Polygon::find($id);

       
        $data->agri_districts_id = $request->agri_districts_id;
        $data->verone_latitude=$request->verone_latitude;
        $data-> verone_longitude=$request->verone_longitude;
        $data-> vertwo_latitude=$request->vertwo_latitude;
        $data-> vertwo_longitude=$request->vertwo_longitude;
        $data->verthree_latitude=$request->verthree_latitude;
        $data-> verthree_longitude=$request->verthree_longitude;
        $data->vertfour_latitude=$request->vertfour_latitude;
        $data->vertfour_longitude=$request->vertfour_longitude;
        $data->verfive_latitude=$request->verfive_latitude;
        $data->verfive_longitude=$request->verfive_longitude;
        $data->versix_latitude=$request->versix_latitude;
        $data->versix_longitude=$request->versix_longitude;
        $data->verseven_latitude=$request->verseven_latitude;
        $data-> verseven_longitude=$request->verseven_longitude;
        $data->vereight_latitude=$request->vereight_latitude;
        $data->verteight_longitude=$request->verteight_longitude;
        $data->strokecolor=$request->strokecolor;
        $data->area=$request->area;
        $data->perimeter=$request->perimeter;
        $data->poly_name=$request->poly_name;
       

        
        $data->save();     
        
    
        return redirect('/admin-view-polygon')->with('message','Polygon Boundary Data Updated successsfully');
    
    }
    catch(\Exception $ex){
        dd($ex); // Debugging statement to inspect the exception
        return redirect('/admin-edit-polygon/{polygons}')->with('message','Someting went wrong');
        
    }   
} 






public function polygondelete($id) {
    try {
        // Find the personal information by ID
       $polygons = Polygon::find($id);

        // Check if the personal information exists
        if (!$polygons) {
            return redirect()->back()->with('error', 'PoLygon Boundary not found');
        }

        // Delete the personal information data from the database
       $polygons->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'PoLygon Boundary deleted Successfully');

    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting PoLygon Boundary: ' . $e->getMessage());
    }
}


    }
