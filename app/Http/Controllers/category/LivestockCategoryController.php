<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Models\Categorize;
use App\Models\LastProductionDatas;
use App\Models\livestockCategory;
use Illuminate\Http\Request;

class LivestockCategoryController extends Controller
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
    //  */
    // public function Livestocks()
    // {
    //     $Cat= Categorize::all();
    //     $livestock = livestockCategory::orderBy('id','desc')->paginate(10);
    //     $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        
    //  return view('livestocks.livestocks_create',compact('livestock','totalRiceProduction'));
    // }
    public function LivestockCategorys()
    {
        $Cat= Categorize::all();
        $livestock = livestockCategory::orderBy('id','desc')->paginate(10);
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        
     return view('livestock_category.livestock_create',compact('livestock','totalRiceProduction','Cat'));
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
            livestockCategory::create([
                'categorizes_id' =>$request->input('categorizes_id'),
                'livestock_category_name' =>$request->input('livestock_category_name'),
                'livestock_description'=>$request->input('livestock_description'),
            ]);
    
            return redirect('/livestockcategory/create')->with('message','Personal informations added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/livestockcategory/create')->with('message','Someting went wrong');
            
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
       $agridistricts =  livestockCategory::where('personal_information_id',$id)->first();
     
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
                livestockCategory::where('agri_districts_id', $id)->update($data);
            
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
            $agridistricts = livestockCategory::where('id', $id);
        
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
