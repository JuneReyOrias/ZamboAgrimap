<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    { 
        try {
            // Fetch validated data directly into $data
            $data = $request->validated();
            
            $user = new User;
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->agri_district = $request['agri_district'];
            $user->password = bcrypt($request['password']); // Hash the password for security
            $user->role = $request['role'];
            // dd($data);
            $user->save();
            
            return redirect('/login')->with('message', 'Registered successfully');
        } catch(\Exception $ex) {
            dd($ex);
            return redirect('/register')->with('message', 'Something went wrong');
        }
    }
    
 
    // // {
    // //     $request->validate([
    // //         'name' => ['required', 'string', 'max:255'],
    // //         'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
    // //         'agri_district' => ['required', 'string', 'max:255'],
    // //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    // //         'role' => ['required', 'string', 'max:255'],
    // //     ]);

    // //     $user = User::create([
    // //         'name' => $request->name,
    // //         'email' => $request->email,
    // //         'agri_district' => $request->agri_district,
    // //         'password' => Hash::make($request->password),
    // //         'role' => $request->role,
    // //     ]);

    // //     event(new Registered($user));

    // //     Auth::login($user);

    // //     return redirect(RouteServiceProvider::HOME);
    }