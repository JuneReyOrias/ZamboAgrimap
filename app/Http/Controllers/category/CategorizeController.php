<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorizeRequest;
use App\Models\AgricDistrict;
use App\Models\Categorize;
use Illuminate\Http\Request;

class CategorizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    } 
    public function Fisheries()
    {
        $categorize = Categorize::all(); 
     return view('fish.fish_create',compact('categorize'));
    }
    public function Livestocks()
    {
        $categorize = Categorize::all();
     return view('livestocks.livestocks_create',compact('categorize'));
    }
    public function Cropping()
    {
        $categorize = Categorize::all();
     return view('crops.crops_create',compact('categorize'));
    }
    public function LivestockCategory()
    {
        $categorize = Categorize::all();
     return view('livestock_category.livestock_create',compact('categorize'));
    } 
    public function FisheriesCategory()
    {
        $categorize = Categorize::all();
     return view('fisheries_category.fisheries_create',compact('categorize'));
    }
    public function CropCategory()
    {
        $categorize = Categorize::all();

     return view('crop_category.crop_create',compact('categorize'));
    }
    public function category()
    {
        // $category= Categorize::latest()->get();
     return view('categorize.categorize_index');
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
            $categorize  =Categorize::create([
           'users_id' => $request->input('users_id'), 
            'agri_districts_id' => $request->input('agri_districts_id'),
                'cat_name' => $request->input('cat_name'),
                'cat_descript' => $request->input('cat_descript'),
                
           ]);
    
           $lastInsertedAgriDistrictId = $categorize->agri_districts_id;
            return redirect('/category')->with('message','Personal informations added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/category')->with('message','Someting went wrong');
            
        }   
    }

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
       $agridistricts = Categorize::where('personal_information_id',$id)->first();
     
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
               Categorize::where('agri_districts_id', $id)->update($data);
            
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
            $agridistricts =Categorize::where('id', $id);
        
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
