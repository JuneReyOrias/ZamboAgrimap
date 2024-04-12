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
use App\Models\LastProductionDatas;
use Illuminate\Support\Facades\DB;


class FileController extends Controller
{
    public function MultiFiles()
    {
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        return view('multifile.import',compact('totalRiceProduction'));
    }

    public function MultiFilesAgent()
    {
        return view('multifile.import_agent');
    }

    public function saveUploadForm(Request $request)
    {
        $request->validate([
            'upload_file' => 'required|mimes:xlsx,xls,csv',
        ]);
    
        // Start a database transaction
        DB::beginTransaction();
    
        try {
            // Import PersonalInformations
            $personalInformationsImport = new PersonalInformationsImport();
            $personalInformations = Excel::import($personalInformationsImport, $request->file('upload_file'));
    
            // Get the ID of the imported PersonalInformations
            $personalInformationId = $personalInformationsImport->getPersonalInformationId();
    
            // Debugging: Dump the personalInformationId to inspect its value
            dd($personalInformationId);
    
            // Import FarmProfile
            $importFarmProfile = new ImportFarmProfile($personalInformationId);
            $farmProfiles = Excel::import($importFarmProfile, $request->file('upload_file'));
    
            // Commit the transaction if the import is successful
            DB::commit();
    
            return back()->withSuccess('File imported successfully.');
        } catch (\Exception $e) {
            dd($e);
            // Rollback the transaction if an error occurs
            // DB::rollBack();
            return back()->withError('Error importing file: ' . $e->getMessage());
        }
    }
    
}    