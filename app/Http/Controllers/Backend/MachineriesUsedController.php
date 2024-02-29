<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MachineriesUsedtRequest;
use App\Http\Requests\UpdateMachineriesUsedRequest;
use App\Models\MachineriesUsed;
use App\Models\MachineriesUseds;
use Illuminate\Http\Request;

class MachineriesUsedController extends Controller
{
    // storing new data by admin
    public function store(MachineriesUsedtRequest $request)
    {
        try{
            $existingMachineriesUseds =  MachineriesUseds::where([
                ['personal_informations_id', '=', $request->input('personal_informations_id')],
                ['farm_profiles_id', '=', $request->input('farm_profiles_id')],
            
    
                // Add other fields here
            ])->first();
            
            if ($existingMachineriesUseds) {
                // FarmProfile with the given personal_informations_id and other fields already exists
                // You can handle this scenario here, for example, return an error message
                return redirect('/machineriesused')->with('error', 'Farm Profile with this information already exists.');
            }
        
            $data= $request->validated();
            $data= $request->all();
            MachineriesUseds::create($data);
    
            return redirect('/seeds')->with('message','Machineries Cost added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/machineriesused')->with('message','Someting went wrong');
        }
    }

   
// machineries used view 
public function MachineriesVieew(){
    $machineries= MachineriesUseds::orderBy('id','desc')->paginate(20);
    return view('machineries_used.machine_create',compact('machineries'));
}


// fixed cost update
public function editMachineries($id){
   $machineries=MachineriesUseds::find($id);
    return view('machineries_used.machine_edit',compact('machineries'));
}



public function updateMachineries(MachineriesUsedtRequest $request,$id)
{

    try{
        

        $data= $request->validated();
        $data= $request->all();
        
        $data= MachineriesUseds::find($id);

        $data->personal_informations_id = $request->personal_informations_id;  
        $data->farm_profiles_id = $request->farm_profiles_id;
        $data->plowing_machineries_used = $request->plowing_machineries_used;
        $data->plo_ownership_status = $request->plo_ownership_status;
        $data->no_of_plowing = $request->no_of_plowing;
        $data->plowing_cost = $request->plowing_cost;
        
        $data->harrowing_machineries_used = $request->harrowing_machineries_used;
        $data->harro_ownership_status = $request->harro_ownership_status;
        $data->no_of_harrowing = $request->no_of_harrowing;

        $data->harrowing_cost = $request->harrowing_cost;
        $data->harvesting_machineries_used = $request->harvesting_machineries_used;
        $data->harvest_ownership_status = $request->harvest_ownership_status;
        $data->harvesting_cost = $request->harvesting_cost;
        $data->postharvest_machineries_used = $request->postharvest_machineries_used;
        $data->postharv_ownership_status = $request->postharv_ownership_status;
        $data->post_harvest_cost = $request->post_harvest_cost;
       
        $data->total_cost_for_machineries = $request->total_cost_for_machineries;
  

       
        $data->save();     
        
    
        return redirect('/view-machineries-used')->with('message','Machineries Used Data Updated successsfully');
    
    }
    catch(\Exception $ex){
        // dd($ex); // Debugging statement to inspect the exception
        return redirect('/edit-machineries-used/{machineries}')->with('message','Someting went wrong');
        
    }   
} 






public function machineriesdestroy($id) {
    try {
        // Find the personal information by ID
      $machineries =MachineriesUseds::find($id);

        // Check if the personal information exists
        if (!$machineries) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
      $machineries->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Machineries Used deleted Successfully');

    } catch (\Exception $e) {
        dd($e);// Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}
}
