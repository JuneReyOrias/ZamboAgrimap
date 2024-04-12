<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Models\Categorize;
use App\Models\CropCategory;
use App\Models\LastProductionDatas;
use Illuminate\Http\Request;

class CropCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function CropCategory()
    {
       $Cat= Categorize::all();
       $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
       $CropCat= CropCategory::orderBy('id','desc')->paginate(10);
     return view('crop_category.crop_create',compact('Cat','totalRiceProduction','CropCat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function Cropping()
    {
        $cropcat = CropCategory::all();
     return view('crops.crops_create',compact('cropcat'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        
            // $data= $request->validated();
            // $data= $request->all();
           CropCategory::create([
            'agri_districts_id' => $request->input('agri_districts_id'),
            'categorizes_id' => $request->input('categorizes_id'),
                'crop_name' => $request->input('crop_name'),
                'crop_descript' => $request->input('crop_descript'),
           ]);
    
            return redirect('/crops-category')->with('message','Crop Category added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/crops-category')->with('message','Someting went wrong');
            
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
       $agridistricts =  CropCategory::where('personal_information_id',$id)->first();
     
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
                CropCategory::where('agri_districts_id', $id)->update($data);
            
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
            $agridistricts = CropCategory::where('id', $id);
        
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
