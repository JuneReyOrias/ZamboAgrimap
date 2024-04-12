<?php

namespace App\Http\Controllers;

use App\Models\KmlUpload;
use Illuminate\Http\Request;
use App\Models\KmlFile;
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
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        return view('kml.kml_import',compact('totalRiceProduction'));
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
 public function AgentKmlImport(){
    return view('kml.agent_kml_import');
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
