<?php

namespace App\Http\Controllers;

use App\Imports\ImportMultipleFile;
use App\Imports\ImportFarmProfile;
use App\Imports\PersonalInformationsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\PersonalInformations;
use App\Models\FarmProfile;
use App\Models\User;
use App\Models\LastProductionDatas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FileController extends Controller
{

            public function  MultiFiles()
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
                    return view('multifile.import', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
                    
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

    public function  MultiFilesAgent()
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
                return view('multifile.import_agent', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
                
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
// public function saveUploadForm(Request $request)
// {

   
//         $request->validate([
//             'upload_file' => 'required|mimes:xlsx,xls,csv',
//         ]);
    
//         $uploadFile = $request->file('upload_file');
    
//         try {
//             // Load the data from the Excel file
//             $import = new ImportMultipleFile();
//             $importedRows = Excel::import($import, $uploadFile);
    
//             // Check if any rows were inserted into the database
//             if ($importedRows > 0) {
//                 return back()->withStatus('File Imported Successfully');
//             } else {
//                 return back()->withError('No data inserted into the database.');
//             }
//         } catch (\Exception $e) {
//             dd($e); // Debugging statement to inspect the exception
//             return back()->withError('Error importing file: ' . $e->getMessage());
//         }
// }

public function saveUploadForm(Request $request)
{
    $request->validate([
        'upload_file' => 'required|mimes:xlsx,xls,csv',
    ]);

    $uploadFile = $request->file('upload_file');

    try {
        // Import data for PersonalInformations
        $personalInformationImport = new PersonalInformationsImport();
        Excel::import($personalInformationImport, $uploadFile);

        // Get the ID of the last inserted PersonalInformation
        $personalInformationId = PersonalInformations::latest()->first()->id;

        // Import data for FarmProfiles and pass the PersonalInformation ID
        $farmProfilesImport = new FarmProfile($personalInformationId);
        Excel::import($farmProfilesImport, $uploadFile);

        return back()->withStatus('Data Imported Successfully');
    } catch (\Exception $e) {
        dd($e); // Debugging statement to inspect the exception
        return back()->withError('Error importing data: ' . $e->getMessage());
    }
}
}
