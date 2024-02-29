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
        return view('admin.index',compact('totalfarms','totalAreaPlanted','totalAreaYield','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted'));
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
        return view('admin.admin_profile', compact('admin'));
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
    return view('parcels.new_parcels');
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
    return view('parcels.show',compact('parcels'));
}

// admin cost update
public function ParcelEdit($id){
    $parcels=ParcellaryBoundaries::find($id);
    return view('parcels.parcels_edit',compact('parcels'));
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
    return view('admin.create_account.new_accounts');
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
    return view('admin.create_account.display_users',compact('users'));
}

// admin cost update
public function  editAccount($id){
    $users=User::find($id);
    return view('admin.create_account.edit_accounts',compact('users'));
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
  dd($data);
    // Redirect back after processing
    return redirect('/view-accounts')->with('message', 'Account updated successfully');
   } 
} catch (Exception $e) {
   dd($e);
   // Handle any exceptions and redirect back with error message
   return redirect('/edit-accounts/{users}')->with('error', 'Error updating product: ' . $e->getMessage());
}
}








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
}

