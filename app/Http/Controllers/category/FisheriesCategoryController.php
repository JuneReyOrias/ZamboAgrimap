<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Models\FisheriesCategory;
use Illuminate\Http\Request;

class FisheriesCategoryController extends Controller
{
    public function Fisheries()
    {
        $fisheries = FisheriesCategory::all(); 
     return view('fish.fish_create',compact('fisheries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function FisheriesCategory()
    {
        // $agridistrictS= AgriDistrictController::latest()->get();
     return view('fisheries_category.fisheries_create');
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
    public function store(Request $request)
    {
        try{
        
            // $data= $request->validated();
            // $data= $request->all();
           FisheriesCategory::create([ 
            'categorizes_id'=>$request->input('categorizes_id'),
            'fisheries_category_name'=>$request->input('fisheries_category_name'),
            'fisheries_description'=>$request->input('fisheries_description'),
    ]  );
          
            return redirect('/fisheriescategory/create')->with('message','Personal informations added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/fisheriescategory/create')->with('message','Someting went wrong');
            
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('personalinfo.create')->with('personalInformations',$id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       // dd($farmer_no);
       $agridistricts =   FisheriesCategory::where('personal_information_id',$id)->first();
     
       return view('personalinfo.edit')->with('personalInformation',$agridistricts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
            // dd(($request->all()));
            try {
                // Get validated data from the request (if you're using validation rules)
                $data = $request->validated();
            
                // If you want to use all data, use this line instead of the above line.
                // $data = $request->all();
            
                // Update the PersonalInformations table
                 FisheriesCategory::where('agri_districts_id', $id)->update($data);
            
                // Optionally, you can return a response indicating success
                return redirect('/personalinfo/create')->with('message','Personal informations updated successsfully');
            } catch (\Exception $e) {
                // Handle any exceptions that might occur during the update process
                return response()->json(['message' => 'Error updating record: ' . $e->getMessage()], 500);
            }
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $agridistricts =  FisheriesCategory::where('id', $id);
        
            if ($agridistricts) {
                $agridistricts->delete();
                return redirect()->route('personalinfo.create')
                                 ->with('message', 'Personal Informations deleted successfully');
            } else {
                return redirect()->route('personalinfo.create')
                                 ->with('message', 'Personal Informations not found');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('personalinfo.create')
                             ->with('message', 'Error deleting Personal Informations : ' . $e->getMessage());
        }
    }
}
