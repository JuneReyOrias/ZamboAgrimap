<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LastProductionDatasRequest;
use App\Http\Requests\UpdateLastProductiondatasRequest;
use App\Models\LastProductionData;
use App\Models\LastProductionDatas;
use Illuminate\Http\Request;

class LastProductionDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function ProductionForms(){
        $lastproductiondata= LastProductionDatas::all();
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    return view('production_data.production_index',compact('lastproductiondata','totalRiceProduction'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function ProductionDataCrud()
    {
        $lastproductiondata= LastProductionDatas::latest()->get();
        return view('production_data.production_create',compact('lastproductiondata'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(LastProductionDatasRequest $request)
    {
        try{
            $existingLastProductionDatas =  LastProductionDatas::where([
                ['personal_informations_id', '=', $request->input('personal_informations_id')],
                ['farm_profiles_id', '=', $request->input('farm_profiles_id')],
               
            
    
                // Add other fields here
            ])->first();
            
            if ($existingLastProductionDatas) {
                // FarmProfile with the given personal_informations_id and other fields already exists
                // You can handle this scenario here, for example, return an error message
                return redirect('/production')->with('error', ' Last Production Data with this information already exists.');
            }
            $data= $request->validated();
            $data= $request->all();
            LastProductionDatas::create($data);
    
            return redirect('/admin-personalinformation')->with('message','Rice Survey Form Completed successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('admin-lastproduction-data')->with('message','Someting went wrong');
        }
    }

  
// last production view
public function Productionview(){
    $productions= LastProductionDatas::orderBy('id','desc')->paginate(20);
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    return view('production_data.production_create',compact('productions','totalRiceProduction'));
}

// last prduction view update
public function Prodedit($id){
     $productions= LastProductionDatas::find($id);
     $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
     return view('production_data.production_edit',compact('productions','totalRiceProduction'));
 }

 public function Proddataupdate(LastProductionDatasRequest $request,$id)
{

    try{
        

        $data= $request->validated();
        $data= $request->all();
        
        $data=LastProductionDatas::find($id);

        $data->personal_informations_id = $request->personal_informations_id;  
        $data->farm_profiles_id = $request->farm_profiles_id;
        $data->agri_districts_id = $request->agri_districts_id;

        $data->seeds_typed_used = $request->seeds_typed_used;
        $data->seeds_used_in_kg = $request->seeds_used_in_kg;
        $data->seed_source = $request->seed_source;
        
        $data->no_of_fertilizer_used_in_bags = $request->no_of_fertilizer_used_in_bags;
        $data->no_of_pesticides_used_in_l_per_kg = $request->no_of_pesticides_used_in_l_per_kg;
        $data->no_of_insecticides_used_in_l = $request->no_of_insecticides_used_in_l;

        $data->area_planted = $request->area_planted;
        $data->date_planted = $request->date_planted;
        $data->date_harvested = $request->date_harvested;
        $data->yield_tons_per_kg = $request->yield_tons_per_kg;
        $data->unit_price_palay_per_kg = $request->unit_price_palay_per_kg;
        $data->unit_price_rice_per_kg = $request->unit_price_rice_per_kg;
        $data->type_of_product = $request->type_of_product;
       
        $data->sold_to = $request->sold_to;
  
        $data->if_palay_milled_where= $request->if_palay_milled_where;
        
        $data->gross_income_palay = $request->gross_income_palay;
        
        $data->gross_income_rice= $request->gross_income_rice;

        
        $data->save();     
        
    
        return redirect('/admin-view-production-data')->with('message','Last Production Data Updated successsfully');
    
    }
    catch(\Exception $ex){
        // dd($ex); // Debugging statement to inspect the exception
        return redirect('/admin-edit-lastproduction-data/{productions}')->with('message','Someting went wrong');
        
    }   
} 






public function ProdDestroy($id) {
    try {
        // Find the personal information by ID
       $productions =LastProductionDatas::find($id);

        // Check if the personal information exists
        if (! $productions) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
       $productions->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Last Production Data deleted Successfully');

    } catch (\Exception $e) {
        dd($e);// Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}
}
