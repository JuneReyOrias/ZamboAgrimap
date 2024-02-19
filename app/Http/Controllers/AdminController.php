<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Exception;
class AdminController extends Controller
{
    public function adminDashb(){
        return view('admin.index');
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
        $profileData = User:: find($id);
        return view('admin.admin_profile', compact('profileData'));
    }
    public function update(Request $request){
        
        $id =Auth::user()->id;
        $data= User:: find($id);
        $data->name= $request->name;
        $data->email= $request->email;
        $data->agri_district= $request->agri_district;
        $data->password= $request->password;
        $data->role= $request->role;
        if ($request->file('photo')){
            $file =$request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
             $file->move(public_path('upload/'),$filename);
             $data['photo']=$filename;
        }
    
         
         
       $data->save();
        return redirect('admin.dashb')->back();
    }
}

