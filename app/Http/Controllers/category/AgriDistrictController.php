<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Models\AgriDistrict;
use App\Models\Categorize;
use App\Models\LastProductionDatas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AgriDistrictController extends Controller
{
    //parcellary boarders foreign key join functions
            public function ParcelBoarders()
            {
      
        $agriculture = DB::table('agri_districts')
        ->Join('users', 'agri_districts.users_id', '=', 'users.id')

        ->select('agri_districts.*', 'users.*' )
        ->get();
        return view('parcels.parcels_create',compact('agriculture'));

    }
     //farmprofiles foreign key join functions
    public function FarmProfiles(){
        try {
            $farmLocation= AgriDistrict::all();
    // $farmLocation = DB::table('polygons')
    // ->join('agri_districts', 'polygons.id', '=', 'agri_districts.id')
       
    // ->select('polygons.*',
    //   'agri_districts.*'
    //   )
    
    // ->get();

           // You can return the data to a view or process it further
           return view('farm_profile.farm_index', [  
        'farmLocation' => $farmLocation,
      
    
    ]);
       } catch (\Exception $ex) {
           // Log the exception for debugging purposes
           dd($ex);
           return redirect()->back()->with('message', 'Something went wrong');
       }
        }  
    public function Gmap()
    {
        $districts= AgriDistrict::all();
    //     $farmLocation = DB::table('farm_profiles')
    //  ->Join('agri_districts', 'farm_profiles.agri_districtS_id', '=', 'agri_districts.id')
    //  ->select('farm_profiles.*', 'agri_districts.*')
    //  ->get();


    //  return view('map.arcmap',compact('farmprofile'));
    // return  $farmLocation;
    return view('map.gmap', ['districts' => $districts]);

     }

    //polygons foreign key join functions
    public function Polygons()
    {
        $agriculture = AgriDistrict::all();
     return view('polygon.polygon_create',compact('agriculture'));
    }

     //category foreign key join functions
    public function category()
    {
      
        $agriculture = DB::table('agri_districts')
        ->Join('users', 'agri_districts.users_id', '=', 'users.id')
       
        ->select('agri_districts.*', 'users.*' )
        ->get();
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        $showcat=Categorize::orderBy('id','desc')->paginate(10);
     return view('categorize.categorize_index',compact('agriculture','totalRiceProduction','showcat'));
    }
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        
            // $data= $request->validated([]);
            // $data= $request->all();
            AgriDistrict::create([
                'users_id' => $request->input('users_id'),
                'district' => $request->input('district'),
                'description' => $request->input('description'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
              ]);
    
            return redirect('/district')->with('message','Personal informations added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/district')->with('message','Someting went wrong');
            
        }   
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function DisplayAgri()
    {
       // dd($farmer_no);
       $Agriculture= AgriDistrict::all();
       $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
       return view('agri_districts.display',compact('Agriculture','totalRiceProduction'));
    }

    // polygon agri district fetching by admin
    public function PolyAgris()
    {
       $agridistrict= AgriDistrict::all();
       $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
       return view('polygon.polygon_create',compact('agridistrict','totalRiceProduction'));
    } 

    public function ParcelAgrifetch()
    {
       $agridistricts= AgriDistrict::all();
       $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
       return view('parcels.new_parcels',compact('agridistricts','totalRiceProduction'));
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
                AgriDistrict::where('agri_districts_id', $id)->update($data);
            
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
            $agridistrict = AgriDistrict::where('id', $id);
        
            if ($agridistrict) {
                $agridistrict->delete();
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
