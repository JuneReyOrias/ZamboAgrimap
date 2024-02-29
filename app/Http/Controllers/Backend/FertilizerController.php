<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FertilizerRequest;
use App\Models\Fertilizer;
use App\Models\Labor;
use Illuminate\Http\Request;

class FertilizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function FertilizersVar(){
        $pesticides= Fertilizer::all();
    return view('variable_cost.fertilizer.fertilizer_store',compact('pesticides'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(FertilizerRequest $request)
    {
        try{

            
            $data= $request->validated();
            $data= $request->all();
            Fertilizer::create($data);
    
            return redirect('/pesticides')->with('message','Fertilizers data added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/fertilizer')->with('message','Someting went wrong');
        }
    }

  

// edit ,view and delete of fertilizer access by admin


public function fertilizerView(){
    $fertilizers= Fertilizer::orderBy('id','desc')->paginate(10);
    return view('variable_cost.fertilizer.view',compact('fertilizers'));
}





public function editfertilizer($id){
    $fertilizers= Fertilizer::find($id);
    return view('variable_cost.fertilizer.edit',compact('fertilizers'));
}

public function updatesfertilizer(FertilizerRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Fertilizer::find($id);

       $data->name_of_fertilizer = $request->name_of_fertilizer;  
       $data->type_of_fertilizer = $request->type_of_fertilizer;
       $data->no_ofsacks = $request->no_ofsacks;
       $data->unitprice_per_sacks = $request->unitprice_per_sacks;
       $data->total_cost_fertilizers = $request->total_cost_fertilizers;

       $data->save();     
       
   
       return redirect('/view-variable-cost-fertilizer')->with('message','Fertilizer Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/edit-variable-cost-fertilizer/{fertilizers}')->with('message','Someting went wrong');
       
   }   
} 


public function FertilizerDelete($id) {
   try {
       // Find the personal information by ID
       $fertilizers= Fertilizer::find($id);

       // Check if the personal information exists
       if (! $fertilizers) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
      $fertilizers->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'Fertilizer data deleted Successfully');

   } catch (\Exception $e) {
    //    dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}


}
