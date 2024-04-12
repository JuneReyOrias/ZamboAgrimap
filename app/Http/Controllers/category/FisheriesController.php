<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Models\Fisheries;
use App\Models\FisheriesCategory;
use App\Models\LastProductionDatas;
use App\Models\Polygon;
use Illuminate\Http\Request;

class FisheriesController extends Controller
{
   
    /**
     * Show the form for creating a new resource.
     */
    public function Fisheries()
    {
        $FishCat =FisheriesCategory::all();
        $Fisheries= Fisheries::orderBy('id','desc')->paginate(10);
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        
     return view('fish.fish_create',compact('totalRiceProduction','FishCat','Fisheries'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        
            // $data= $request->validated();
            // $data= $request->all();
           Fisheries::create([
            'categorizes_id'=>$request->input('categorizes_id'),
            'fisheries_categorys_id'=>$request->input('fisheries_categorys_id'),
            'species_name'=>$request->input('species_name'),
            'common_name'=>$request->input('common_name'),
            'habitat'=>$request->input('habitat'),
            'fish_description'=>$request->input('fish_description'),
           ]);
    
            return redirect('/fisheries/create')->with('message','New Fisheries added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/fisheries/create')->with('message','Someting went wrong');
            
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
       $agridistricts = Fisheries::where('personal_information_id',$id)->first();
     
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
               Fisheries::where('agri_districts_id', $id)->update($data);
            
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
            $agridistricts =Fisheries::where('id', $id);
        
            if ($agridistricts) {
                $agridistricts->delete();
                return redirect()->route('personalinfo.create')
                                 ->with('message', 'Personal Informations deleted successfully');
            } else {
                return redirect()->route('personalinfo.create')
                                 ->with('message', 'Personal Informations not found');
            }
        } catch (\Exception $e) {
            return redirect()->route('personalinfo.create')
                             ->with('message', 'Error deleting Personal Informations : ' . $e->getMessage());
        }
    }
}
