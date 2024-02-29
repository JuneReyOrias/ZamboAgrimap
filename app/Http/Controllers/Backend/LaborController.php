<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\laborRequest;
use App\Models\Labor;
use Illuminate\Http\Request;

class LaborController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function LaborsVar(){
        $pesticides= Labor::all();
    return view('variable_cost.labor.labor_store',compact('pesticides'));
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
    public function store(laborRequest $request)
    {
        try{
            $data= $request->validated();
            $data= $request->all();
            Labor::create($data);
    
            return redirect('/fertilizer')->with('message','Labors data added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/labor')->with('message','Someting went wrong');
        }
    }

   
// labors data edit and view by agentt


public function laborView(){
    $labors= Labor::orderBy('id','desc')->paginate(10);
    return view('variable_cost.labor.labors_view',compact('labors'));
}





public function editlabor($id){
    $labors= Labor::find($id);
    return view('variable_cost.labor.labors_edit',compact('labors'));
}

public function updateslabor(LaborRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Labor::find($id);

       $data->no_of_person = $request->no_of_person;  
       $data->rate_per_person = $request->rate_per_person;
       $data->total_labor_cost = $request->total_labor_cost;
       

       $data->save();     
       
   
       return redirect('/view-variable-cost-labor')->with('message','Labor Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/update-variable-cost-labor/{labors}')->with('message','Someting went wrong');
       
   }   
} 






public function deletel($id) {
   try {
       // Find the personal information by ID
       $labors= Labor::find($id);

       // Check if the personal information exists
       if (! $labors) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
      $labors->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'labor data deleted Successfully');

   } catch (\Exception $e) {
    //    dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}


}
