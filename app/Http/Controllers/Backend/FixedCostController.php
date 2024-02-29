<?php

namespace App\Http\Controllers\Backend;
use App\Models\FixedCost;
use App\Http\Controllers\Controller;
use App\Http\Requests\FixedCostRequest;
use App\Http\Requests\UpdateFixedCostRequest;
use Illuminate\Http\Request;

class FixedCostController extends Controller
{
   

    
    public function store(FixedCostRequest $request)
    {
        try{
            $existingFixedCost =  FixedCost::where([
                ['personal_informations_id', '=', $request->input('personal_informations_id')],
                ['farm_profiles_id', '=', $request->input('farm_profiles_id')],
            
    
                // Add other fields here
            ])->first();
            
            if ( $existingFixedCost) {
                // FarmProfile with the given personal_informations_id and other fields already exists
                // You can handle this scenario here, for example, return an error message
                return redirect('/fixedcost')->with('error', 'Farm Profile with this information already exists.');
            }
            $data= $request->validated();
            $data= $request->all();
            FixedCost::create($data);
    
            return redirect('machineriesused')->with('message','Fixed Cost added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/fixedcost')->with('message','Someting went wrong');
        }
    }



    // fixed cost view
    public function FixedCostView(){
        $fixedcosts=FixedCost::orderBy('id','desc')->paginate(20);
        return view('fixed_cost.fixed_create',compact('fixedcosts'));
    }
    
    // fixed cost update
    public function editFixedcost($id){
        $fixedcosts=FixedCost::find($id);
        return view('fixed_cost.fixed_edit',compact('fixedcosts'));
    }
    
    public function updateFixedcosts(FixedCostRequest $request,$id)
    {
    
        try{
            
    
            $data= $request->validated();
            $data= $request->all();
            
            $data= FixedCost::find($id);
    
            $data->personal_informations_id = $request->personal_informations_id;  
            $data->farm_profiles_id = $request->farm_profiles_id;
            $data->particular = $request->particular;
            $data->no_of_ha = $request->no_of_ha;
            $data->cost_per_ha = $request->cost_per_ha;
            $data->total_amount = $request->total_amount;
      
           
    
            
            $data->save();     
            
        
            return redirect('/view-fixedcost')->with('message','Fixed cost Data Updated successsfully');
        
        }
        catch(\Exception $ex){
            // dd($ex); // Debugging statement to inspect the exception
            return redirect('/edit-fixedcost/{fixedcost}')->with('message','Someting went wrong');
            
        }   
    } 
    
    
    

    // deleting the fixed data
    
    public function destroyFixedcost($id) {
        try {
            // Find the personal information by ID
           $fixedcosts = FixedCost::find($id);
    
            // Check if the personal information exists
            if (!$fixedcosts) {
                return redirect()->back()->with('error', 'Farm Profilenot found');
            }
    
            // Delete the personal information data from the database
           $fixedcosts->delete();
    
            // Redirect back with success message
            return redirect()->back()->with('message', 'Fixed Cost deleted Successfully');
    
        } catch (\Exception $e) {
            // Handle any exceptions and redirect back with error message
            return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
        }
    }
    
}
