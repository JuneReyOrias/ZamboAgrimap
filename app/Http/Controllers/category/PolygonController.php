<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\PolygonRequest;
use App\Models\AgriDistrict;
use App\Models\Polygon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PolygonController extends Controller
{
     /**
     * Display a listing of the resource.
     */
 
     public function DisplayAgri()
     {
        // dd($farmer_no);
        $Agriculture= AgriDistrict::all();
        return view('agri_districts.display',compact('Agriculture'));
     }  
    /**
     * Show the form for creating a new resource.
     */
    public function Polygons()
    {
     return view('polygon.polygon_create');
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
    
            return redirect('/polygon/create')->with('message','Personal informations added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/personalinformation')->with('message','Someting went wrong');
            
        }   
    }
// fixed cost view
public function polygonshow(){
    $polygons=Polygon::orderBy('id','desc')->paginate(10);
    return view('polygon.polygons_show',compact('polygons'));
}

// fixed cost update
public function polygonEdit($id){
    $polygons=Polygon::find($id);
    return view('polygon.polygons_edit',compact('polygons'));
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
        
    
        return redirect('/view-polygon')->with('message','Fixed cost Data Updated successsfully');
    
    }
    catch(\Exception $ex){
        dd($ex); // Debugging statement to inspect the exception
        return redirect('/edit-polygon/{polygons}')->with('message','Someting went wrong');
        
    }   
} 






public function polygondelete($id) {
    try {
        // Find the personal information by ID
       $polygons = Polygon::find($id);

        // Check if the personal information exists
        if (!$polygons) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
       $polygons->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Fixed Cost deleted Successfully');

    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}


    }
