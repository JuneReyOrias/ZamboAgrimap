<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParcellaryBoundariesRequest;
use App\Http\Requests\RegisterRequest;

use App\Models\FarmProfile;
use App\Models\Fertilizer;
use App\Models\FixedCost;
use App\Models\Labor;
use App\Models\LastProductionDatas;
use App\Models\MachineriesUseds;
use App\Models\ParcellaryBoundaries;
use App\Models\Pesticide;
use App\Models\Seed;
use App\Models\VariableCost;
use App\Http\Requests\FarmProfileRequest;
use App\Http\Requests\FixedCostRequest;
use App\Http\Requests\MachineriesUsedtRequest;
use App\Http\Requests\UpdateMachineriesUsedRequest;
use App\Http\Requests\LastProductionDatasRequest;
use App\Http\Requests\UpdateLastProductiondatasRequest;
use App\Http\Requests\SeedRequest;
use App\Http\Requests\LaborRequest;
use App\Http\Requests\FertilizerRequest;
use App\Http\Requests\PesticidesRequest;
use App\Http\Requests\TransportRequest;
use App\Http\Requests\VariableCostRequest;
use App\Models\PersonalInformations;
use App\Http\Requests\PersonalInformationsRequest;
use App\Http\Controllers\Backend\PersonalInformationsController;
use App\Models\Transport;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use Exception;
class AdminController extends Controller
{
    public function adminDashb(){
        $totalfarms= FarmProfile::count();
        $totalAreaPlanted = FarmProfile::sum('total_physical_area_has');
        $totalAreaYield = FarmProfile::sum('yield_kg_ha');
        $totalCost= VariableCost::sum('total_variable_cost');

        $yieldPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalAreaYield / $totalAreaPlanted : 0;
        $averageCostPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalCost / $totalAreaPlanted : 0;
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        return view('admin.index',compact('totalfarms','totalAreaPlanted','totalAreaYield','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted','totalRiceProduction'));
    }//end method

        public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }//end 
    public function AdminLogin(){
         return view('admin.admin_login');
    }//end

    public function AdminProfile(){
        $id =Auth::user()->id;
        $admin = User:: find($id);
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        return view('admin.admin_profile', compact('admin','totalRiceProduction'));
    }
    public function update(Request $request){
        
        try {
            $id =Auth::user()->id;
       $data= User:: find($id);
       if ($data) {
           // Check if a file is present in the request and if it's valid
           if ($request->hasFile('image') && $request->file('image')->isValid()) {
               // Retrieve the image file from the request
               $image = $request->file('image');
   
               // Generate a unique image name using current timestamp and file extension
               $imagename = time() . '.' . $image->getClientOriginalExtension();
   
               // Move the uploaded image to the 'productimages' directory with the generated name
               $image->move('adminimages', $imagename);
   
               // Delete the previous image file, if exists
               if ($data->image) {
                   Storage::delete('adminimages/' . $data->image);
               }
   
               // Set the image name in the Product data
               $data->image = $imagename;
           }
   
       $data->name= $request->name;
       $data->email= $request->email;
       $data->agri_district= $request->agri_district;
       $data->password= $request->password;
       $data->role= $request->role;
    
        
      $data->save();
        // Redirect back after processing
        return redirect()->route('admin.admin_profile')->with('message', 'Profile updated successfully');
       } else {
           // Redirect back with error message if product not found
           return redirect()->back()->with('error', 'Product not found');
       }
   } catch (Exception $e) {
       dd($e);
       // Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error updating product: ' . $e->getMessage());
   }
   }





   
   public function ParcelBoarders()
   {
       // $category= Categorize::latest()->get();
       $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    return view('parcels.new_parcels',compact('totalRiceProduction'));
   }
   
public function newparcels(ParcellaryBoundariesRequest $request)
{
    try {
        // Get validated data
        $data = $request->validated();

        // Create new ParcellaryBoundaries object
        $parcel=ParcellaryBoundaries::create([
                        'users_id' => $request->input('users_id'),
                        'agri_districts_id'=>$request->input('agri_districts_id'),
                        'ricefield_boarders_id'=>$request->input('ricefield_boarders_id'),
                        'parcel_name' => $request->input('parcel_name'),
                        'area' => $request->input('area'),
                        'lot_no' => $request->input('lot_no'),
                        'tct_no' => $request->input('tct_no'),
                        'brgy_name' => $request->input('brgy_name'),
                        'atdn' => $request->input('atdn'),
                        'arpowner_na' => $request->input('arpowner_na'),
                        'pkind_desc' => $request->input('pkind_desc'),
                        'puse_desc' => $request->input('puse_desc'),
                        'actual_used' => $request->input('actual_used'),
                        'parcolor' => $request->input('parcolor'),
                        'parone_latitude' => $request->input('parone_latitude'),
                        'parone_longitude' => $request->input('parone_longitude'),
                        'partwo_latitude' => $request->input('partwo_latitude'),
                        'partwo_longitude' => $request->input('partwo_longitude'),
                        'parthree_latitude' => $request->input('parthree_latitude'),
                        'parthree_longitude' => $request->input('parthree_longitude'),
                        'parfour_latitude' => $request->input('parfour_latitude'),
                        'parfour_longitude' => $request->input('parfour_longitude'),
                        'parfive_latitude' => $request->input('parfive_latitude'),
                        'parfive_longitude' => $request->input('parfive_longitude'),
                        'parsix_latitude' => $request->input('parsix_latitude'),
                        'parsix_longitude' => $request->input('parsix_longitude'),
                        'parseven_latitude' => $request->input('parseven_latitude'),
                        'parseven_longitude' => $request->input('parseven_longitude'),
                        'pareight_latitude' => $request->input('pareight_latitude'),
                        'pareight_longitude' => $request->input('pareight_longitude'),
                        'parnine_latitude'=>$request->input('parnine_latitude'),
                        'parnine_longitude'=>$request->input('parnine_longitude'),
                        'parten_latitude'=>$request->input('parten_latitude'),
                        'parten_longitude'=>$request->input('parten_longitude'),
                        'pareleven_latitude'=>$request->input('pareleven_latitude'),
                        'pareleven_longitude'=>$request->input('pareleven_longitude'),
                        'partwelve_latitude'=>$request->input('partwelve_latitude'),
                        'partwelve_longitude'=>$request->input('partwelve_longitude')
            
                      ]);

        // Redirect with success message
        return redirect('/add-parcel')->with('message', 'Parcelary Boundaries added successfully');
    } catch (Exception $ex) {
        // Debugging statement to inspect the exception
        dd($ex);
        // Redirect with error message
        return redirect('/add-parcel')->with('message', 'Something went wrong');
    }
}



// admin cost view
public function Parcelshow(){
    $parcels=ParcellaryBoundaries::orderBy('id','desc')->paginate(20);
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    return view('parcels.show',compact('parcels','totalRiceProduction'));
}

// admin cost update
public function ParcelEdit($id){
    $parcels=ParcellaryBoundaries::find($id);
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    return view('parcels.parcels_edit',compact('parcels','totalRiceProduction'));
}

public function ParcelUpdates(ParcellaryBoundariesRequest $request,$id)
{

    try{
        

        $data= $request->validated();
        $data= $request->all();
        
        $data= ParcellaryBoundaries::find($id);

        $data-> agri_districts_id=$request->agri_districts_id;
      
        $data->parcel_name = $request->parcel_name;
        $data->area = $request->area;
        $data->lot_no = $request->lot_no;
        $data-> tct_no = $request->tct_no;
        $data->brgy_name = $request->brgy_name;
       
        $data->arpowner_na = $request->arpowner_na;
        $data->pkind_desc = $request->pkind_desc;
        $data-> puse_desc = $request->puse_desc;
        $data-> actual_used = $request->actual_used;
        $data->parcolor = $request->parcolor;
        $data->parone_latitude = $request->parone_latitude;
        $data->parone_longitude = $request->parone_longitude;
        $data->partwo_latitude = $request->partwo_latitude;
        $data->partwo_longitude = $request->partwo_longitude;
        $data->parthree_latitude = $request->parthree_latitude;
        $data->parthree_longitude = $request->parthree_longitude;
        $data->parfour_latitude = $request->parfour_latitude;
        $data->parfour_longitude = $request->parfour_longitude;
        $data-> parfive_latitude = $request->parfive_latitude;
        $data->parfive_longitude = $request->parfive_longitude;
        $data->parsix_latitude = $request->parsix_latitude;
        $data->parsix_longitude = $request->parsix_longitude;
        $data->parseven_latitude = $request->parseven_latitude;
        $data->parseven_longitude = $request->parseven_longitude;
        $data->pareight_latitude = $request->pareight_latitude;
        $data-> pareight_longitude = $request->pareight_longitude;
        $data->parnine_latitude=$request->parnine_latitude;
        $data->parnine_longitude=$request->parnine_longitude;
        $data->parten_latitude=$request->parten_latitude;
        $data->parten_longitude=$request->parten_longitude;
        $data->pareleven_latitude=$request->pareleven_latitude;
        $data->pareleven_longitude=$request->pareleven_longitude;
        $data->partwelve_latitude=$request->partwelve_latitude;
        $data->partwelve_longitude=$request->partwelve_longitude;
  
       


        $data->save();     
        
    
        return redirect('/view-parcel-boarders')->with('message','Parcellary Boundaries Data Updated successsfully');
    
    }
    catch(Exception $ex){
        dd($ex); // Debugging statement to inspect the exception
        return redirect('/edit-parcel-boarders/{parcels}')->with('message','Someting went wrong');
        
    }   
} 






public function Parceldelete($id) {
    try {
        // Find the personal information by ID
       $parcels = ParcellaryBoundaries::find($id);

        // Check if the personal information exists
        if (!$parcels) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
       $parcels->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Parcellary Boundaries deleted Successfully');

    } catch (Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}

// creatinng new users account
public function newAccounts(){
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    return view('admin.create_account.new_accounts',compact('totalRiceProduction'));
}

public function NewUsers(RegisterRequest $request){
    try{
        // dd($request->all());
        $data= $request->validated();
        $data= $request->all();
        $users= User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'agri_district' => $request->input('agri_district'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
           
        ]);
       
        $users->save();
        return redirect('/new-accounts')->with('message','Registered uccesssfully');
    
    }
    catch(Exception $ex){
        dd($ex);
        return redirect('/new-accounts')->with('message','Someting went wrong');
    }

    
}
public function Accountview(){
    $users=User::orderBy('id','desc')->paginate(20);
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    return view('admin.create_account.display_users',compact('users','totalRiceProduction'));
}

// admin cost update
public function  editAccount($id){
    $users=User::find($id);
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    return view('admin.create_account.edit_accounts',compact('users','totalRiceProduction'));
}

public function updateAccounts(Request $request, $id){
        
    try {
        
   $data= User:: find($id);
   if ($data) {
       // Check if a file is present in the request and if it's valid
       if ($request->hasFile('image') && $request->file('image')->isValid()) {
           // Retrieve the image file from the request
           $image = $request->file('image');

           // Generate a unique image name using current timestamp and file extension
           $imagename = time() . '.' . $image->getClientOriginalExtension();

           // Move the uploaded image to the 'productimages' directory with the generated name
           $image->move('adminimages', $imagename);

           // Delete the previous image file, if exists
           if ($data->image) {
               Storage::delete('adminimages/' . $data->image);
           }

           // Set the image name in the Product data
           $data->image = $imagename;
       }

   $data->name= $request->name;
   $data->email= $request->email;
   $data->agri_district= $request->agri_district;
   $data->password= $request->password;
   $data->role= $request->role;
     
    
  $data->save();

    // Redirect back after processing
    return redirect('/view-accounts')->with('message', 'Account updated successfully');
   } 
} catch (Exception $e) {
//    dd($e);
   // Handle any exceptions and redirect back with error message
   return redirect('/edit-accounts/{users}')->with('error', 'Error updating product: ' . $e->getMessage());
}
}







// Delete users access by admin
public function deleteusers($id) {
    try {
        // Find the personal information by ID
       $users = User::find($id);

        // Check if the personal information exists
        if (!$users) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
       $users->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Parcellary Boundaries deleted Successfully');

    } catch (Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}


// farmers info per agri district
 public function farmerAyalas(){
    try {
        $FarmersData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
            ->select(
                'personal_informations.*',
                'farm_profiles.*',
                'fixed_costs.*',
                'machineries_useds.*',
                'variable_costs.*',
                'last_production_datas.*'
            )
            ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
            ->get();
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        return view('admin.Agri_district.ayala_farmer', compact('FarmersData','totalRiceProduction'));
    } catch (Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        return redirect()->back()->with('message', 'Something went wrong');
    }

 }

//  tumaga farmers info view by admin
public function FarmerTumagainfo(){

    try {
        $FarmersData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
            ->select(
                'personal_informations.*',
                'farm_profiles.*',
                'fixed_costs.*',
                'machineries_useds.*',
                'variable_costs.*',
                'last_production_datas.*'
            )
            ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
            ->get();
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        return view('admin.Agri_district.tumaga_farmer', compact('FarmersData','totalRiceProduction'));
    } catch (Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        return redirect()->back()->with('message', 'Something went wrong');
    }
 
 
}

// culaianan rice farmers view by admin
public function FarmerCulianansInfo(){
    try {
        $FarmersData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
            ->select(
                'personal_informations.*',
                'farm_profiles.*',
                'fixed_costs.*',
                'machineries_useds.*',
                'variable_costs.*',
                'last_production_datas.*'
            )
            ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
            ->get();
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        return view('admin.Agri_district.culianan_farmer', compact('FarmersData','totalRiceProduction'));
    } catch (Exception $ex) {
        // Log the exception for debugging purposes
        dd($ex);
        return redirect()->back()->with('message', 'Something went wrong');
    }
 
}
        // manicahan famrers info view by admin
        public function FarmerManicahanInfo(){
            try {
                $FarmersData = DB::table('personal_informations')
                    ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                    ->select(
                        'personal_informations.*',
                        'farm_profiles.*',
                        'fixed_costs.*',
                        'machineries_useds.*',
                        'variable_costs.*',
                        'last_production_datas.*'
                    )
                    ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
                    ->get();
                    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                return view('admin.Agri_district.manicahan_farmer', compact('FarmersData','totalRiceProduction'));
            } catch (Exception $ex) {
                // Log the exception for debugging purposes
                dd($ex);
                return redirect()->back()->with('message', 'Something went wrong');
            }
        }

        // curUan farmers info view by admin
        public function FarmercuruanInfo(){
            try {
                $FarmersData = DB::table('personal_informations')
                    ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                    ->select(
                        'personal_informations.*',
                        'farm_profiles.*',
                        'fixed_costs.*',
                        'machineries_useds.*',
                        'variable_costs.*',
                        'last_production_datas.*'
                    )
                    ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
                    ->get();
                    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                return view('admin.Agri_district.curuan_farmer', compact('FarmersData','totalRiceProduction'));
            } catch (\Exception $ex) {
                // Log the exception for debugging purposes
                dd($ex);
                return redirect()->back()->with('message', 'Something went wrong');
            }
            
        }
    
        //vitalifarmers view by users
    
        public function VitaliInfoFarmer(){
    
            try {
                $FarmersData = DB::table('personal_informations')
                    ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                    ->select(
                        'personal_informations.*',
                        'farm_profiles.*',
                        'fixed_costs.*',
                        'machineries_useds.*',
                        'variable_costs.*',
                        'last_production_datas.*'
                    )
                    ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
                    ->get();
                    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                return view('admin.Agri_district.vitali_farmer', compact('FarmersData','totalRiceProduction'));
            } catch (Exception $ex) {
                // Log the exception for debugging purposes
                dd($ex);
                return redirect()->back()->with('message', 'Something went wrong');
        }
       
}

    // crop varietys per agri district access by admin

    // rice varieties per agri-district view by admin
    public function FarmersRiceVarietyDistrict(){

        try {
            $riceData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.agri_district',
                    'farm_profiles.type_rice_variety',
                    'farm_profiles.prefered_variety'
                )
                ->orderBy('personal_informations.agri_district')
                ->get();
      // Initialize counts for inbred, hybrid, and preferred variety
   
            // Initialize $InbredInfo as an associative array
            $InbredInfo = [];
    
            foreach ($riceData as $data) {
                $agri_district = $data->agri_district;
                $typeVariety = strtolower($data->type_rice_variety);
                $preferedVariety = strtolower($data->prefered_variety);
    
                // Initialize counts for each variety if district not already in $InbredInfo
                if (!isset($InbredInfo[$agri_district])) {
                    $InbredInfo[$agri_district] = [];
                }
    
                // If type of variety is "N/A", use preferred variety
                if ($typeVariety === 'n/a' || $typeVariety === 'na') {
                    $variety = $preferedVariety;
                } else {
                    $variety = $typeVariety;
                }
    
                // If variety not already in district's array, initialize count to 0
                if (!isset($InbredInfo[$agri_district][$variety])) {
                    $InbredInfo[$agri_district][$variety] = ['count' => 0, 'percentage' => 0];
                }
    
                // Increment count for the variety
                $InbredInfo[$agri_district][$variety]['count']++;
            }
    
            // Calculate percentage for each rice variety in each district
            foreach ($InbredInfo as $district => &$varieties) {
                $totalRiceVarietiesInDistrict = array_sum(array_column($varieties, 'count'));
                foreach ($varieties as &$data) {
                    $percentage = ($totalRiceVarietiesInDistrict > 0) ? ($data['count'] / $totalRiceVarietiesInDistrict) * 100 : 0;
                    $data['percentage'] = number_format($percentage, 2);
                }
            }
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            return view('admin.rice_varieties.rice_varietydistrict', compact('InbredInfo','totalRiceProduction'));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }
       
    }

    public function Plantingschedrice(){
        try {
            $farmersData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.agri_district',
                    'last_production_datas.date_planted',
                    'farm_profiles.*',
                    'personal_informations.last_name',
                    'personal_informations.first_name',
                    'farm_profiles.type_rice_variety',
                    'farm_profiles.prefered_variety',
                )
                ->orderBy('personal_informations.agri_district')
                ->get();
    
            // Group the data by district
            $plantingSchedule = [];
            foreach ($farmersData as $data) {
                $plantingSchedule[$data->agri_district][] = [
                    'last_name' => $data->last_name,
                    'first_name' => $data->first_name,
                    'date_planted' => $data->date_planted,
                    'type_rice_variety' => $data->type_rice_variety,
                    'prefered_variety' => $data->prefered_variety,
                ];
            }
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            return view('admin.rice_schedule.rice_planting', compact('plantingSchedule','totalRiceProduction'));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }
       
    }

    // rice harvest
    public function HarvestSchedRices(){
        try {
            $harvestData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.agri_district',
                    'personal_informations.last_name',
                    'personal_informations.first_name',
                    'last_production_datas.date_harvested',
                    'farm_profiles.type_rice_variety',
                    'farm_profiles.prefered_variety',
                    
                )
                ->orderBy('personal_informations.agri_district')
                ->get();
    
            // Group the data by district
            $harvestSchedule = [];
            foreach ($harvestData as $data) {
                $harvestSchedule[$data->agri_district][] = [
                    'last_name' => $data->last_name,
                    'first_name' => $data->first_name,
                    'date_harvested' => $data->date_harvested,
                    'type_rice_variety' => $data->type_rice_variety,
                    'prefered_variety' => $data->prefered_variety,
                ];
            }
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            return view('admin.rice_schedule.rice_harvest', compact('harvestSchedule','totalRiceProduction'));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }
        
    }

    // crop production per district
    public function ProductionperRice(){
        try {
            $riceProductionData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.*',
                    'farm_profiles.*',
                    'fixed_costs.*',
                    'machineries_useds.*',
                    'variable_costs.*',
                    'personal_informations.agri_district',
            
                    'personal_informations.last_name',
                    'personal_informations.first_name',
                    'last_production_datas.date_planted',
                    'last_production_datas.date_harvested',
                    'last_production_datas.yield_tons_per_kg',
                    'last_production_datas.unit_price_palay_per_kg',
                    'last_production_datas.unit_price_rice_per_kg',
                    'last_production_datas.gross_income_palay',
                    'last_production_datas.gross_income_rice',
                    'last_production_datas.type_of_product'
                )
                // ->where('last_production_datas.type_of_product', 'rice',) // Filter for rice production only
                ->orderBy('personal_informations.agri_district')
                ->get();
    
            // Group the data by district
            $riceProductionSchedule = [];
            foreach ($riceProductionData as $data) {
                $riceProductionSchedule[$data->agri_district][] = [
                    'last_name' => $data->last_name,
                    'first_name' => $data->first_name,
                    'date_planted' => $data->date_planted,
                    'date_harvested' => $data->date_harvested,
                    'yield_tons_per_kg' => $data->yield_tons_per_kg,
                    'unit_price_palay_per_kg' => $data->unit_price_palay_per_kg,
                    'unit_price_rice_per_kg' => $data->unit_price_rice_per_kg,
                    'gross_income_palay' => $data->gross_income_palay,
                    'gross_income_rice' => $data->gross_income_rice,
                    'type_of_product' => $data->type_of_product
                ];
            }
    
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            return view('admin.crop_production.rice_crops', compact('riceProductionSchedule','totalRiceProduction'));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }
        
    }
}
