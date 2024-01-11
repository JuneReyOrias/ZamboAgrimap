<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function Mapping()
    {
        $user = User::all();

        return view('agri_districts.insertdata', compact('user'));
    }
    public function categories()
    {
        $user = User::all();

     return view('categorize.categorize_index',compact('user'));
    }
  
    public function commonFunction()
    {
        return "This is a common function for all users.";
    }

    // public function roleBasedFunction()
    // {
    //     // Get the authenticated user
    //     $user = Auth::user();

    //     // Check the user's role and perform an action accordingly
    //     switch ($user->role) {
    //         case 'admin':
    //             return $this->adminFunction();
    //             break;

    //         case 'agent':
    //             return $this->agentFunction();
    //             break;

    //         // Add more cases for other roles if needed

    //         default:
    //             return $this->commonFunction();
    //             break;
    //     }
    // }

    // private function adminFunction()
    // {
    //     return "This is an admin-specific function.";
    // }

    // private function agentFunction()
    // {
    //     return "This is an agent-specific function.";
    // }
    
    public function UserDashboard(){
        return view('user.user_dashboard');
    }
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/landing');
    }
}
