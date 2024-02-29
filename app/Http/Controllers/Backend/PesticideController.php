<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PesticidesRequest;
use App\Models\Pesticide;
use Illuminate\Http\Request;

class PesticideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function PesticidesVar(){
        $pesticides= Pesticide::all();
    return view('variable_cost.pesticides.pesticides_store',compact('pesticides'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(PesticidesRequest $request)
    {
        try{
            $data= $request->validated();
            $data= $request->all();
            Pesticide::create($data);
    
            return redirect('/transport')->with('message','Pesticides data added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/pesticides')->with('message','Someting went wrong');
        }
    }

    
// edit, delete and view 0f pesticides data by admin


public function pestView(){
    $pesticides= Pesticide::orderBy('id','desc')->paginate(10);
    return view('variable_cost.pesticides.view',compact('pesticides'));
}





public function editpest($id){
    $pesticides= Pesticide::find($id);
    return view('variable_cost.pesticides.pest_edit',compact('pesticides'));
}

public function updateslaborpest(PesticidesRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Pesticide::find($id);

       $data->pesticides_name = $request->pesticides_name;  
       $data->type_ofpesticides = $request->type_ofpesticides;
       $data->no_of_l_kg = $request->no_of_l_kg;
       $data->unitprice_ofpesticides = $request->unitprice_ofpesticides;
       $data->total_cost_pesticides = $request->total_cost_pesticides;
              
       $data->save();     
       
   
       return redirect('/view-variable-cost-pesticides')->with('message','Pesticide Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/edit-variable-cost-pesticides/{$pesticides}')->with('message','Someting went wrong');
       
   }   
} 


public function pestdelete($id) {
   try {
       // Find the personal information by ID
       $pesticides= Pesticide::find($id);

       // Check if the personal information exists
       if (! $pesticides) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
      $pesticides->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'Pesticiddes data deleted Successfully');

   } catch (\Exception $e) {
    //    dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}
}
