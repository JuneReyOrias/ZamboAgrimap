<?php

namespace App\Http\Controllers;

use App\Imports\FixedsImport;
use App\Imports\ImportFertilizer;
use App\Imports\ImportLastProductionDatas;
use App\Imports\ImportMultipleFile;
use App\Imports\ImportPesticide;
use App\Imports\ImportSeed;
use App\Imports\ImportTransport;
use App\Imports\ImportVariableCost;
use App\Imports\PersonalinfoImport;
use App\Imports\FarmImport;
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
use App\Imports\CombineImport; // Import the CombinedImport class if needed
use App\Imports\ImportFixedCost;
use App\Imports\ImportLabor;
use App\Imports\MachinesImport;
use Illuminate\Support\Facades\Validator;

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
  // Validate the file input
  $request->validate([
    'upload_file' => 'required|file|mimes:xlsx,xls',
]);

// $uploadFile = $request->file('upload_file');

try {
    $userId = Auth::id();
    $user = auth()->user();
    $agri_districts_id = $user->agri_districts_id;
    $agri_district = $user->agri_district;

    // Import data for PersonalInformations
    $personalInformationImport = new PersonalInfoImport();
    $personalInformations = Excel::toCollection($personalInformationImport, $request->file('upload_file'))->first();

// Check if the uploaded file is empty
if ($personalInformations->isEmpty()) {
return back()->withError("Error: The Excel file is empty. Please upload a file with data.");
}

foreach ($personalInformations as $personalInformation) {
// Define an array of required fields
$requiredFields = ['first name', 'last name', 'middle name', 'extension name', 'home address', 'sex', 'religion', 'date of birth', 'place of birth', 'contact no', 'civil_status', 'name legal spouse', 'no of children', 'mothers  maiden name', 'highest formal education', 'person with disability', 'pwd id no', 'government_issued_id', 'id_type', 'gov id no', 'member of any farmers ass org coop', 'name of farmers ass  org coop', 'name contact person', 'cp tel no'];

// Check if any required field is empty or null
foreach ($requiredFields as $field) {
    if (empty($personalInformation[$field])) {
        return back()->withError("Error: The $field field cannot be empty.");
    }
}
// Validate personal information fields
$personalInformationValidator = Validator::make($personalInformation->toArray(), [
    // Define validation rules for personal information fields
    'first_name' => 'required',
    'middle_name' => 'required',
    'last_name'=> 'required',
    'extension_name'=> 'required',
    'home_address'=> 'required',
    'sex'=> 'required',
    'religion'=> 'required',
    'date_of_birth'=> 'required',
    'place_of_birth'=> 'required',
    'contact_no'=> 'required',
    'civil_status'=> 'required',
    'name_legal_spouse'=> 'required',
    'no_of_children'=> 'required',
    'mothers_maiden_name'=> 'required',
    'highest_formal_education'=> 'required',
    'person_with_disability'=> 'required',
    'pwd_id_no'=> 'required',
    'government_issued_id'=> 'required',
    'id_type'=> 'required',
    'gov_id_no'=> 'required',
    'member_ofany_farmers_ass_org_coop'=> 'required',
    'nameof_farmers_ass_org_coop'=> 'required',
    'name_contact_person'=> 'required',
    'cp_tel_no'=> 'required',
    // Add more rules for other fields as needed
]);

if ($personalInformationValidator->fails()) {
    // Get the error messages
    $errors = $personalInformationValidator->errors()->all();
    // Redirect back with error messages
    return back()->withError('Error: Personal information validation failed')->withErrors($errors);
}

        
        $personalInformationModel = new PersonalInformations([
            'users_id' => $userId,
            'agri_districts_id' => $agri_districts_id,
            'agri_district' => $agri_district,
            'first_name' => $personalInformation['first_name'],
            'middle_name' => $personalInformation['middle_name'],
            'last_name' => $personalInformation['last_name'],
            'extension_name' => $personalInformation['extension_name'],
            'home_address' => $personalInformation['home_address'],
            'sex' => $personalInformation['sex'],
            'religion' => $personalInformation['religion'],
            'date_of_birth' => $personalInformation['date_of_birth'],
            'place_of_birth' => $personalInformation['place_of_birth'],
            'contact_no' => $personalInformation['contact_no'],
            'civil_status' => $personalInformation['civil_status'],
            'name_legal_spouse' => $personalInformation['name_legal_spouse'],
            'no_of_children' => $personalInformation['no_of_children'],
            'mothers_maiden_name' => $personalInformation['mothers_maiden_name'],
            'highest_formal_education' => $personalInformation['highest_formal_education'],
            'person_with_disability' => $personalInformation['person_with_disability'],
            'pwd_id_no' => $personalInformation['pwd_id_no'],
            'government_issued_id' => $personalInformation['government_issued_id'],
            'id_type' => $personalInformation['id_type'],
            'gov_id_no' => $personalInformation['gov_id_no'],
            'member_ofany_farmers_ass_org_coop' => $personalInformation['member_ofany_farmers_ass_org_coop'],
            'nameof_farmers_ass_org_coop' => $personalInformation['nameof_farmers_ass_org_coop'],
            'name_contact_person' => $personalInformation['name_contact_person'],
            'cp_tel_no' => $personalInformation['cp_tel_no'],
            // Add other fields as needed
        ]);

        $personalInformationModel->save();

        if ($personalInformationModel->id) {
            // Import farm profile and retrieve the primary ID
            $farmProfileImport = new FarmImport($personalInformationModel->id);
            Excel::import($farmProfileImport, $request->file('upload_file'));
            $farmModel = $farmProfileImport->getFarmModel();

            // Check if farm model exists
            if ($farmModel && $farmModel->id) {
                // Import fixed cost and machines data
                $fixedCostImport = new FixedsImport($personalInformationModel->id, $farmModel->id);
                $machinesImport = new MachinesImport($personalInformationModel->id, $farmModel->id);
                Excel::import($fixedCostImport, $request->file('upload_file'));
                Excel::import($machinesImport, $request->file('upload_file'));

                // Import seeds, labors, fertilizers, pesticides, transport data
                $seedsImport = new ImportSeed($personalInformationModel->id, $farmModel->id);
                Excel::import($seedsImport, $request->file('upload_file'));
                $seedsIds = $seedsImport->getImportedIds(); // Assume getImportedIds() method returns the imported seed IDs

                $laborsImport = new ImportLabor($personalInformationModel->id, $farmModel->id);
                Excel::import($laborsImport, $request->file('upload_file'));
                $laborsIds = $laborsImport->getlaborsId(); // Assume getImportedIds() method returns the imported labor IDs

                $fertilizerImport = new ImportFertilizer($personalInformationModel->id, $farmModel->id);
                Excel::import($fertilizerImport, $request->file('upload_file'));
                $fertilizerIds = $fertilizerImport->getfertilizerId(); // Assume getImportedIds() method returns the imported fertilizer IDs

                $pesticidesImport = new ImportPesticide($personalInformationModel->id, $farmModel->id);
                Excel::import($pesticidesImport, $request->file('upload_file'));
                $pesticidesIds = $pesticidesImport->getpesticideId(); // Assume getImportedIds() method returns the imported pesticide IDs

                $transportImport = new ImportTransport($personalInformationModel->id, $farmModel->id);
                Excel::import($transportImport, $request->file('upload_file'));
                $transportIds = $transportImport->transportId(); // Assume getImportedIds() method returns the imported transport IDs

                // Import variable cost data using the retrieved IDs
                $variableImport = new ImportVariableCost(
                    $personalInformationModel->id,
                    $farmModel->id,
                    $seedsIds,
                    $laborsIds,
                    $fertilizerIds,
                    $pesticidesIds,
                    $transportIds
                );
                Excel::import($variableImport, $request->file('upload_file'));

                // Import last production data
                $lastproductionImport = new ImportLastProductionDatas($personalInformationModel->id, $farmModel->id);
                Excel::import($lastproductionImport, $request->file('upload_file'));
            } else {
                // Handle error if farm profile ID is not retrieved
                return back()->withError('Error: Failed to save farm profile record');
            }
        } else {
            // Display an error message if the primary key is null
            return back()->withError('Error: Failed to save personal information record');
        }
    }
    return back()->withStatus('Data Imported Successfully');
} catch (\Exception $e) {
    // dd($e); // Debugging statement to inspect the exception
    return back()->withError('Error importing data: ' . $e->getMessage());
}
}

public function AgentsaveUploadForm(Request $request)
{
    // Validate the file input
    $request->validate([
        'upload_file' => 'required|file|mimes:xlsx,xls',
    ]);

    // $uploadFile = $request->file('upload_file');

    try {
        $userId = Auth::id();
        $user = auth()->user();
        $agri_districts_id = $user->agri_districts_id;
        $agri_district = $user->agri_district;

        // Import data for PersonalInformations
        $personalInformationImport = new PersonalInfoImport();
        $personalInformations = Excel::toCollection($personalInformationImport, $request->file('upload_file'))->first();

 // Check if the uploaded file is empty
if ($personalInformations->isEmpty()) {
    return back()->withError("Error: The Excel file is empty. Please upload a file with data.");
}

foreach ($personalInformations as $personalInformation) {
    // Define an array of required fields
    $requiredFields = ['first name', 'last name', 'middle name', 'extension name', 'home address', 'sex', 'religion', 'date of birth', 'place of birth', 'contact no', 'civil_status', 'name legal spouse', 'no of children', 'mothers  maiden name', 'highest formal education', 'person with disability', 'pwd id no', 'government_issued_id', 'id_type', 'gov id no', 'member of any farmers ass org coop', 'name of farmers ass  org coop', 'name contact person', 'cp tel no'];

    // Check if any required field is empty or null
    foreach ($requiredFields as $field) {
        if (empty($personalInformation[$field])) {
            return back()->withError("Error: The $field field cannot be empty.");
        }
    }
    // Validate personal information fields
    $personalInformationValidator = Validator::make($personalInformation->toArray(), [
        // Define validation rules for personal information fields
        'first_name' => 'required',
        'middle_name' => 'required',
        'last_name'=> 'required',
        'extension_name'=> 'required',
        'home_address'=> 'required',
        'sex'=> 'required',
        'religion'=> 'required',
        'date_of_birth'=> 'required',
        'place_of_birth'=> 'required',
        'contact_no'=> 'required',
        'civil_status'=> 'required',
        'name_legal_spouse'=> 'required',
        'no_of_children'=> 'required',
        'mothers_maiden_name'=> 'required',
        'highest_formal_education'=> 'required',
        'person_with_disability'=> 'required',
        'pwd_id_no'=> 'required',
        'government_issued_id'=> 'required',
        'id_type'=> 'required',
        'gov_id_no'=> 'required',
        'member_ofany_farmers_ass_org_coop'=> 'required',
        'nameof_farmers_ass_org_coop'=> 'required',
        'name_contact_person'=> 'required',
        'cp_tel_no'=> 'required',
        // Add more rules for other fields as needed
    ]);

    if ($personalInformationValidator->fails()) {
        // Get the error messages
        $errors = $personalInformationValidator->errors()->all();
        // Redirect back with error messages
        return back()->withError('Error: Personal information validation failed')->withErrors($errors);
    }

            
            $personalInformationModel = new PersonalInformations([
                'users_id' => $userId,
                'agri_districts_id' => $agri_districts_id,
                'agri_district' => $agri_district,
                'first_name' => $personalInformation['first_name'],
                'middle_name' => $personalInformation['middle_name'],
                'last_name' => $personalInformation['last_name'],
                'extension_name' => $personalInformation['extension_name'],
                'home_address' => $personalInformation['home_address'],
                'sex' => $personalInformation['sex'],
                'religion' => $personalInformation['religion'],
                'date_of_birth' => $personalInformation['date_of_birth'],
                'place_of_birth' => $personalInformation['place_of_birth'],
                'contact_no' => $personalInformation['contact_no'],
                'civil_status' => $personalInformation['civil_status'],
                'name_legal_spouse' => $personalInformation['name_legal_spouse'],
                'no_of_children' => $personalInformation['no_of_children'],
                'mothers_maiden_name' => $personalInformation['mothers_maiden_name'],
                'highest_formal_education' => $personalInformation['highest_formal_education'],
                'person_with_disability' => $personalInformation['person_with_disability'],
                'pwd_id_no' => $personalInformation['pwd_id_no'],
                'government_issued_id' => $personalInformation['government_issued_id'],
                'id_type' => $personalInformation['id_type'],
                'gov_id_no' => $personalInformation['gov_id_no'],
                'member_ofany_farmers_ass_org_coop' => $personalInformation['member_ofany_farmers_ass_org_coop'],
                'nameof_farmers_ass_org_coop' => $personalInformation['nameof_farmers_ass_org_coop'],
                'name_contact_person' => $personalInformation['name_contact_person'],
                'cp_tel_no' => $personalInformation['cp_tel_no'],
                // Add other fields as needed
            ]);

            $personalInformationModel->save();

            if ($personalInformationModel->id) {
                // Import farm profile and retrieve the primary ID
                $farmProfileImport = new FarmImport($personalInformationModel->id);
                Excel::import($farmProfileImport, $request->file('upload_file'));
                $farmModel = $farmProfileImport->getFarmModel();

                // Check if farm model exists
                if ($farmModel && $farmModel->id) {
                    // Import fixed cost and machines data
                    $fixedCostImport = new FixedsImport($personalInformationModel->id, $farmModel->id);
                    $machinesImport = new MachinesImport($personalInformationModel->id, $farmModel->id);
                    Excel::import($fixedCostImport, $request->file('upload_file'));
                    Excel::import($machinesImport, $request->file('upload_file'));

                    // Import seeds, labors, fertilizers, pesticides, transport data
                    $seedsImport = new ImportSeed($personalInformationModel->id, $farmModel->id);
                    Excel::import($seedsImport, $request->file('upload_file'));
                    $seedsIds = $seedsImport->getImportedIds(); // Assume getImportedIds() method returns the imported seed IDs

                    $laborsImport = new ImportLabor($personalInformationModel->id, $farmModel->id);
                    Excel::import($laborsImport, $request->file('upload_file'));
                    $laborsIds = $laborsImport->getlaborsId(); // Assume getImportedIds() method returns the imported labor IDs

                    $fertilizerImport = new ImportFertilizer($personalInformationModel->id, $farmModel->id);
                    Excel::import($fertilizerImport, $request->file('upload_file'));
                    $fertilizerIds = $fertilizerImport->getfertilizerId(); // Assume getImportedIds() method returns the imported fertilizer IDs

                    $pesticidesImport = new ImportPesticide($personalInformationModel->id, $farmModel->id);
                    Excel::import($pesticidesImport, $request->file('upload_file'));
                    $pesticidesIds = $pesticidesImport->getpesticideId(); // Assume getImportedIds() method returns the imported pesticide IDs

                    $transportImport = new ImportTransport($personalInformationModel->id, $farmModel->id);
                    Excel::import($transportImport, $request->file('upload_file'));
                    $transportIds = $transportImport->transportId(); // Assume getImportedIds() method returns the imported transport IDs

                    // Import variable cost data using the retrieved IDs
                    $variableImport = new ImportVariableCost(
                        $personalInformationModel->id,
                        $farmModel->id,
                        $seedsIds,
                        $laborsIds,
                        $fertilizerIds,
                        $pesticidesIds,
                        $transportIds
                    );
                    Excel::import($variableImport, $request->file('upload_file'));

                    // Import last production data
                    $lastproductionImport = new ImportLastProductionDatas($personalInformationModel->id, $farmModel->id);
                    Excel::import($lastproductionImport, $request->file('upload_file'));
                } else {
                    // Handle error if farm profile ID is not retrieved
                    return back()->withError('Error: Failed to save farm profile record');
                }
            } else {
                // Display an error message if the primary key is null
                return back()->withError('Error: Failed to save personal information record');
            }
        }
        return back()->withStatus('Data Imported Successfully');
    } catch (\Exception $e) {
        // dd($e); // Debugging statement to inspect the exception
        return back()->withError('Error importing data: ' . $e->getMessage());
    }
}

}
