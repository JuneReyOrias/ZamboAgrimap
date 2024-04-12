<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransportRequest;
use App\Models\LastProductionDatas;
use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function TransportVar(){
        $transport= Transport::all();
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    return view('variable_cost.transport.transport_store',compact('transport','totalRiceProduction'));
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
    public function store(TransportRequest $request)
    {
        try{
            $data= $request->validated();
            $data= $request->all();
            Transport::create($data);
    
            return redirect('/admin-variablecost')->with('message','transport data added successsfully');
        
        }
        catch(\Exception $ex){
            return redirect('/admin-transport')->with('message','Someting went wrong');
        }
    }

   
// view, edit of transport by agent

public function trasnportView(){
    $transports= Transport::orderBy('id','desc')->paginate(10);
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    return view('variable_cost.transport.show',compact('transports','totalRiceProduction'));
}





public function edittransport($id){
    $transports= Transport::find($id);
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    return view('variable_cost.transport.update',compact('transports','totalRiceProduction'));
}

public function updatestransport(TransportRequest $request,$id)
{

   try{
       

       $data= $request->validated();
       $data= $request->all();
       
       $data=Transport::find($id);

       $data->name_of_vehicle = $request->name_of_vehicle;  
       $data->type_of_vehicle = $request->type_of_vehicle;
     
       $data->total_transport_per_deliverycost;
      
              
       $data->save();     
       
   
       return redirect('/admin-view-variable-cost-transport')->with('message','Transport Data Updated successsfully');
   
   }
   catch(\Exception $ex){
    //    dd($ex); // Debugging statement to inspect the exception
       return redirect('/admin-edit-variable-cost-transport/{transports}')->with('message','Someting went wrong');
       
   }   
} 


public function transportdelete($id) {
   try {
       // Find the personal information by ID
       $transports= Transport::find($id);

       // Check if the personal information exists
       if (! $transports) {
           return redirect()->back()->with('error', 'Farm Profilenot found');
       }

       // Delete the personal information data from the database
      $transports->delete();

       // Redirect back with success message
       return redirect()->back()->with('message', 'Transports data deleted Successfully');

   } catch (\Exception $e) {
    //    dd($e);// Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
   }
}
}
