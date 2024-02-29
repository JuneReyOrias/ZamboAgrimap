<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariableCostRequest;
use App\Models\VariableCost;
use Illuminate\Http\Request;

class VariableCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function VariableForms(){
        $variablecost= VariableCost::all();
    return view('variable_cost.variable_index',compact('variablecost'));
    }
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
    public function store(VariableCostRequest $request)
    {
        {
            try{
                
                    $existingVariableCost =  VariableCost::where([
                        ['personal_informations_id', '=', $request->input('personal_informations_id')],
                        ['farm_profiles_id', '=', $request->input('farm_profiles_id')],
                        ['seeds_id', '=', $request->input('seeds_id')],
                        ['labors_id', '=', $request->input('labors_id')],
                        ['fertilizers_id', '=', $request->input('fertilizers_id')],
                    
                        ['pesticides_id', '=', $request->input('pesticides_id')],
                        ['transports_id', '=', $request->input('transports_id')],
                    
                    
            
                        // Add other fields here
                    ])->first();
                    
                    if ($existingVariableCost) {
                        // FarmProfile with the given personal_informations_id and other fields already exists
                        // You can handle this scenario here, for example, return an error message
                        return redirect('/variablecost')->with('error', 'VariableCost with this information already exists.');
                    }
            
                $data= $request->validated();
                $data= $request->all();
               VariableCost::create($data);
        
                return redirect('/production')->with('message','Variable Cost added successsfully');
            
            }
            catch(\Exception $ex){
                return redirect('/variable')->with('message','Someting went wrong');
            }
        }
    }

   
// varaible cost view, edit, update and delete access by agent
public function  varView(){
    $variable= VariableCost::orderBy('id','desc')->paginate(10);
    return view('variable_cost.var_show',compact('variable'));
}





public function editvar($id){
   $variable= VariableCost::find($id);
    return view('variable_cost.var_update',compact('variable'));
}

public function updatesvar(VariableCostRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=VariableCost::find($id);

       $data->personal_informations_id = $request->personal_informations_id;  
       $data->farm_profiles_id = $request->farm_profiles_id;


       $data->seeds_id = $request->seeds_id;
       $data->labors_id = $request->labors_id;
       $data->fertilizers_id = $request->fertilizers_id;
       
       $data->pesticides_id = $request->pesticides_id;
       $data->transports_id = $request->transports_id;
       $data->total_machinery_fuel_cost = $request->total_machinery_fuel_cost;

       $data->total_variable_cost = $request->total_variable_cost;
 
       $data->save();     
       
   
       return redirect('/view-variable-cost')->with('message','Variable Cost Data Updated successsfully');
   
   }
   catch(\Exception $ex){
       dd($ex); // Debugging statement to inspect the exception
       return redirect('/edit-variable-cost/{variable}')->with('message','Someting went wrong');
       
   }   
} 






public function vardelete($id) {
   try {
       // Find the personal information by ID
     $variable =VariableCost::find($id);

       // Check if the personal information exists
       if (!$variable) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
     $variable->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'Variable Cost deleted Successfully');

   } catch (\Exception $e) {
       dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}



}
