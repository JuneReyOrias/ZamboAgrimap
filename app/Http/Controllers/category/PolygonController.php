<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\PolygonRequest;
use App\Models\Polygon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PolygonController extends Controller
{
     /**
     * Display a listing of the resource.
     */
 
    public function FarmProfiles(){
        try {
            // $farmprofile= FarmProfile::all();
    $farmLocation = DB::table('polygons')
    ->join('agri_districts', 'polygons.id', '=', 'agri_districts.id')
       
    ->select('polygons.*',
      'agri_districts.*'
      )
    
    ->get();

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
    /**
     * Show the form for creating a new resource.
     */
    public function Polygons()
    {
        // $agridistrictS= AgriDistrictController::latest()->get();
     return view('polygon.polygon_create');
    }

    public function Arcmap()
    {
        // $polygons= Polygon::all();
        $farmLocation = DB::table('polygons')
     ->Join ('agri_districts', 'polygons.agri_districtS_id', '=', 'agri_districts.id')
     ->join('farm_profiles', 'polygons.farm_profiles_id', '=', 'farm_profiles.id')
     ->select('polygons.*', 'agri_districts.*','farm_profiles.*')
     ->get();


    //  return view('map.arcmap',compact('farmprofile'));
    // return  $farmLocation;
    return view('map.arcmap', ['farmLocation' =>$farmLocation]);
 
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
            'users_id' => $request->input('users_id'),
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
            'perimeter'=>$request->input('area'),
           ]);
    
            return redirect('/polygon/create')->with('message','Personal informations added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/personalinformation')->with('message','Someting went wrong');
            
        }   
    }

    /**
     * Display the specified resource.
     */
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
       $agridistricts = Polygon::where('personal_information_id',$id)->first();
     
       return view('personalinfo.edit')->with('personalInformation',$agridistricts);
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
               Polygon::where('agri_districts_id', $id)->update($data);
            
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
            $agridistricts =Polygon::where('id', $id);
        
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
