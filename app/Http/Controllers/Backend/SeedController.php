<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeedRequest;
use App\Models\Seed;
use Illuminate\Http\Request;

class SeedController extends Controller
{
    public function SeedsVar(){
        $pesticides= Seed::all();
    return view('variable_cost.seeds.seeds_store',compact('pesticides'));
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
            Seed::create($data);
    
            return redirect('labor')->with('message','Seeds data added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/seeds')->with('message','Someting went wrong');
        }
    }


// Seeds data update and view accessed by agent

public function SeedsView(){
    $seeds= Seed::orderBy('id','desc')->paginate(10);
    return view('variable_cost.seeds.view',compact('seeds'));
}





public function editSeeds($id){
    $seeds= Seed::find($id);
    return view('variable_cost.seeds.seed_edit',compact('seeds'));
}

public function updatesSeeds(SeedRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Seed::find($id);

       $data->seed_name = $request->seed_name;  
       $data->seed_type = $request->seed_type;
       $data->unit = $request->unit;
       $data->quantity = $request->quantity;
       $data->unit_price = $request->unit_price;

       $data->total_seed_cost = $request->total_seed_cost;

       $data->save();     
       
   
       return redirect('/view-variable-cost-seed')->with('message','Seeds Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/edit-variable-cost-seed/{seeds}')->with('message','Someting went wrong');
       
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
