<?php

namespace App\Http\Controllers;

use App\Models\FarmProfile;
use App\Models\KmlUpload;
use App\Models\PersonalInformations;
use Illuminate\Http\Request;
use App\Models\KmlFile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\LastProductionDatas;
use SimpleXMLElement;
use ZipArchive;
use Exception;
use Illuminate\Support\Facades\Storage;
class KmlFileController extends Controller
{
    // admin import of kml
    public function index()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $admin = User::find($userId);
    
            if ($admin) {
                // Assuming $user represents the currently logged-in user
                $user = auth()->user();
    
                // Check if user is authenticated before proceeding
                if (!$user) {
                    // Handle unauthenticated user, for example, redirect them to login
                    return redirect()->route('login');
                }
    
                // Find the user's personal information by their ID
                $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
    
                // Fetch the farm ID associated with the user
                $farmId = $user->farm_id;
    
                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
    
          
    
                
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with the fetched data
                return view('kml.kml_import', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
                
                ));
            } else {
                // Handle the case where the user is not found
                // You can redirect the user or display an error message
                return redirect()->route('login')->with('error', 'User not found.');
            }
        } else {
            // Handle the case where the user is not authenticated
            // Redirect the user to the login page
            return redirect()->route('login');
        }
    }
    public function upload(Request $request)
    {
        try {
            $fileName = $request->file('kmlFile')->getClientOriginalName();
            $extension = $request->file('kmlFile')->getClientOriginalExtension();
    
            // Check if a file with the same name already exists in the database
            $existingFile = KmlFile::where('file_name', $fileName)->first();
            if ($existingFile) {
                return redirect()->route('kml.import')->with('error', 'File with the same name already exists.');
            }
    
            // Save the file to the public directory
            $filePath = $request->file('kmlFile')->storeAs('public', $fileName);
    
            // Retrieve the public URL of the saved file
            $publicUrl = Storage::url($filePath);
    
            // Save the URL in the database
            $kmlFile = new KmlFile();
            $kmlFile->file_name = $fileName;
            $kmlFile->file_path = $publicUrl;
            $kmlFile->save();
    
            return redirect()->route('kml.import')->with('message', 'File uploaded successfully. Filename: ' . $fileName . ', URL: ' . $publicUrl);
        } catch (Exception $e) {
            dd($e); // Dump and die to inspect the exception
            return redirect()->route('kml.import')->with('error', $e->getMessage());
        }
    }
    

// agent import of kml
 public function AgentKmlImport()
 {
     // Check if the user is authenticated
     if (Auth::check()) {
         // User is authenticated, proceed with retrieving the user's ID
         $userId = Auth::id();
 
         // Find the user based on the retrieved ID
         $agent = User::find($userId);
 
         if ($agent) {
             // Assuming $user represents the currently logged-in user
             $user = auth()->user();
 
             // Check if user is authenticated before proceeding
             if (!$user) {
                 // Handle unauthenticated user, for example, redirect them to login
                 return redirect()->route('login');
             }
 
             // Find the user's personal information by their ID
             $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
 
             // Fetch the farm ID associated with the user
             $farmId = $user->farm_id;
 
             // Find the farm profile using the fetched farm ID
             $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
 
       
 
             
             $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
             // Return the view with the fetched data
             return view('kml.agent_kml_import', compact('agent', 'profile', 'farmProfile','totalRiceProduction'
             
             ));
         } else {
             // Handle the case where the user is not found
             // You can redirect the user or display an error message
             return redirect()->route('login')->with('error', 'User not found.');
         }
     } else {
         // Handle the case where the user is not authenticated
         // Redirect the user to the login page
         return redirect()->route('login');
     }
 }
//  upload the new kml to database
public function uploadkml(Request $request)
{
    // $request->validate([
    //     'kmlFile' => 'required|mimes:kml,kmz',
    // ]);

    try {
        $fileName = $request->file('kmlFile')->getClientOriginalName();
        $extension = $request->file('kmlFile')->getClientOriginalExtension();

        // Check if a file with the same name already exists in the database
        $existingFile = KmlFile::where('file_name', $fileName)->first();
        if ($existingFile) {
            return redirect()->route('kml.agent_kml_import')->with('error', 'File with the same name already exists.');
        }

        // Save the file to the public directory
        $filePath = $request->file('kmlFile')->storeAs('public', $fileName);

        // Retrieve the public URL of the saved file
        $publicUrl = Storage::url($filePath);

        // Save the URL in the database
        $kmlFile = new KmlFile();
        $kmlFile->file_name = $fileName;
        $kmlFile->file_path = $publicUrl;
        // dd($kmlFile); // Dump and die to inspect $kmlFile before saving
        $kmlFile->save();

        return redirect()->route('kml.agent_kml_import')->with('message', 'File uploaded successfully. Filename: ' . $fileName . ', URL: ' . $publicUrl);
    } catch (Exception $e) {
        dd($e); // Dump and die to inspect the exception
        return redirect()->route('kml.agent_kml_import')->with('error', $e->getMessage());
    }
}

}
