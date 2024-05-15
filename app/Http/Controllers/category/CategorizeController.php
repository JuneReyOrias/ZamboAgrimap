<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorizeRequest;
use App\Models\AgricDistrict;
use App\Models\AgriDistrict;
use App\Models\Categorize;
use App\Models\Crop;
use App\Models\CropCategory;
use App\Models\Fertilizer;
use App\Models\Fisheries;
use App\Models\FisheriesCategory;
use App\Models\LastProductionDatas;
use App\Models\Livestock;
use App\Models\livestockCategory;
use App\Models\ParcellaryBoundaries;
use App\Models\PersonalInformations;
use App\Models\Pesticide;
use App\Models\Polygon;
use App\Models\Transport;
use App\Models\User;
use App\Models\VariableCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
class CategorizeController extends Controller
{
 
    public function Fisheries()
    {
        $categorize = Categorize::all(); 
     return view('fish.fish_create',compact('categorize'));
    }



    public function Livestocks()
    {
        $categorize = Categorize::all();
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
     return view('livestocks.livestocks_create',compact('categorize','totalRiceProduction'));
    }
    public function Cropping()
    {
        $categorize = Categorize::all();
     return view('crops.crops_create',compact('categorize'));
    }
    public function LivestockCategory()
    {
        $categorize = Categorize::all();
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
     return view('livestock_category.livestock_create',compact('categorize','totalRiceProduction'));
    } 
    public function FisheriesCategory()
    {
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        $categorize = Categorize::all();
     return view('fisheries_category.fisheries_create',compact('categorize','totalRiceProduction'));
    }
    public function CropCategory()
    {
        $categorize = Categorize::all();
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
     return view('crop_category.crop_create',compact('categorize','totalRiceProduction'));
    }


    public function  category(Request $request)
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
                $agridistricts = AgriDistrict::all();
                $categorize = Categorize::all();

                // Query for seeds with search functionality
                $categorizeQuery = Categorize::query();
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $categorizeQuery->where('cat_name', 'like', "%$searchTerm%");
                }
                $categorize = $categorizeQuery->orderBy('id','asc')->paginate(10);
              
                // Query for labors with search functionality
                    $CropCatQuery = CropCategory::query();
                    if ($request->has('search')) {
                        $searchTerm = $request->input('search');
                        $CropCatQuery->where(function($query) use ($searchTerm) {
                            $query->where('no_of_person', 'like', "%$searchTerm%")
                                ->orWhere('total_labor_cost', 'like', "%$searchTerm%")
                                ->orWhere('rate_per_person', 'like', "%$searchTerm%");
                        });
                    }
                    $CropCat = $CropCatQuery->orderBy('id','asc')->paginate(10);
    
                          // Query for fertilizer with search functionality
                          $FisheriesCatQuery = FisheriesCategory::query();
                          if ($request->has('search')) {
                              $searchTerm = $request->input('search');
                              $FisheriesCatQuery->where(function($query) use ($searchTerm) {
                                  $query->where('name_of_fertilizer', 'like', "%$searchTerm%")
                                      ->orWhere('no_ofsacks', 'like', "%$searchTerm%")
                                      ->orWhere('total_cost_fertilizers', 'like', "%$searchTerm%");
                              });
                          }
                          $FisheriesCat = $FisheriesCatQuery->orderBy('id','asc')->paginate(10);
    
                          // Query for pesticides with search functionality
                        $livestockQuery =  livestockCategory::query();
                        if ($request->has('search')) {
                            $searchTerm = $request->input('search');
                            $livestockQuery->where(function($query) use ($searchTerm) {
                                $query->where('pesticides_name', 'like', "%$searchTerm%")
                                    ->orWhere('type_ofpesticides', 'like', "%$searchTerm%")
                                    ->orWhere('total_cost_pesticides', 'like', "%$searchTerm%");
                            });
                        }
                        $livestock= $livestockQuery->orderBy('id','asc')->paginate(10);
                        
                         // Query for transports with search functionality
                        $CropQuery =  Crop::query();
                        if ($request->has('search')) {
                            $searchTerm = $request->input('search');
                            $CropQuery->where(function($query) use ($searchTerm) {
                                $query->where('name_of_vehicle', 'like', "%$searchTerm%")
                                    ->orWhere('type_of_vehicle', 'like', "%$searchTerm%")
                                    ->orWhere('total_transport_per_deliverycost', 'like', "%$searchTerm%");
                            });
                        }
                        $Crop = $CropQuery->orderBy('id','asc')->paginate(10);
                            
                        // Query for transports with search functionality
                             $FisheriesQuery = Fisheries::query();
                             if ($request->has('search')) {
                                 $searchTerm = $request->input('search');
                                 $FisheriesQuery->where(function($query) use ($searchTerm) {
                                     $query->where('name_of_vehicle', 'like', "%$searchTerm%")
                                         ->orWhere('type_of_vehicle', 'like', "%$searchTerm%")
                                         ->orWhere('total_transport_per_deliverycost', 'like', "%$searchTerm%");
                                 });
                             }
                             $Fisheries = $FisheriesQuery->orderBy('id','asc')->paginate(10);
                        
                                // Query for transports with search functionality
                                $LivestockQuery = Livestock::query();
                                if ($request->has('search')) {
                                    $searchTerm = $request->input('search');
                                    $LivestockQuery->where(function($query) use ($searchTerm) {
                                        $query->where('name_of_vehicle', 'like', "%$searchTerm%")
                                            ->orWhere('type_of_vehicle', 'like', "%$searchTerm%")
                                            ->orWhere('total_transport_per_deliverycost', 'like', "%$searchTerm%");
                                    });
                                }
                                $Livestock = $LivestockQuery->orderBy('id','asc')->paginate(10);


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
                return view('categorize.categorize_index', compact('admin','agridistricts','categorize','CropCat' ,'profile','FisheriesCat','livestock','Crop','Fisheries','variable','Livestock', 'totalRiceProduction'));
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
    public function store(Request $request)
    {
       
        try{
        
            // $data= $request->validated();
            // $data= $request->all();
            $categorize  =Categorize::create([
           'users_id' => $request->input('users_id'), 
            'agri_districts_id' => $request->input('agri_districts_id'),
                'cat_name' => $request->input('cat_name'),
                'cat_descript' => $request->input('cat_descript'),
                
           ]);
    
           $lastInsertedAgriDistrictId = $categorize->agri_districts_id;
            return redirect('/category')->with('message','Category added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/category')->with('message','Someting went wrong');
            
        }   
    }

    public function show(string $id)
    {
        return view('personalinfo.create')->with('personalInformations',$id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       // dd($farmer_no);
       $agridistricts = Categorize::where('personal_information_id',$id)->first();
       $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
       return view('personalinfo.edit',compact('agridistricts','totalRiceProduction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
            // dd(($request->all()));
            try {
                // Get validated data from the request (if you're using validation rules)
                $data = $request->validated();
            
                // If you want to use all data, use this line instead of the above line.
                // $data = $request->all();
            
                // Update the PersonalInformations table
               Categorize::where('agri_districts_id', $id)->update($data);
            
                // Optionally, you can return a response indicating success
                return redirect('/personalinfo/create')->with('message','Personal informations updated successsfully');
            } catch (\Exception $e) {
                // Handle any exceptions that might occur during the update process
                return response()->json(['message' => 'Error updating record: ' . $e->getMessage()], 500);
            }
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $agridistricts =Categorize::where('id', $id);
        
            if ($agridistricts) {
                $agridistricts->delete();
                return redirect()->route('personalinfo.create')
                                 ->with('message', 'Personal Informations deleted successfully');
            } else {
                return redirect()->route('personalinfo.create')
                                 ->with('message', 'Personal Informations not found');
            }
        } catch (\Exception $e) {
            return redirect()->route('personalinfo.create')
                             ->with('message', 'Error deleting Personal Informations : ' . $e->getMessage());
        }
    }
}
