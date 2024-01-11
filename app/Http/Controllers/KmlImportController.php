<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Nubs\RandomNameGenerator\All;
class KmlImportController extends Controller
{





public function index() 
    
    {
        return view('kml.kml_import');
    }

    public function upload(Request $request)
{
    try {
        $request->validate([
            'file' => 'required|max:2048',
        ]);
      
        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        // Attempt to store the file
        $file->storeAs('public/kml_folder', $fileName);

        // If the file was stored successfully, return a success response
        return response()->json(['message' => 'File uploaded successfully']);
    } catch (\Exception $e) {

  
        // If an error occurs, return an error response
        return response()->json(['error' => 'File upload failed', 'message' => $e->getMessage()], 500);
    }
}

    public function displayMap($fileName)

    {
                // Get the content of the KML file
                $kmlContent = Storage::get("public/kml_folder/{$fileName}");

        return view('map.arcmap', ['fileName' => $fileName]);
    }

}
    // {  dd($request);
    //     $request->validate([
    //         'file' => 'required|mimes:kml'
    //     ]);

    //     $file = $request->file('file')->getRealPath();

    //     // Step 1: Read the KML file
    //     $kml = simplexml_load_file($file);
    //     $data = [];

    //     foreach ($kml->Document->Placemark as $placemark) {
    //         $name = (string) $placemark->name;
    //         $coordinates = (string) $placemark->Point->coordinates;
    //         [$lon, $lat] = explode(',', $coordinates);

    //         $data[] = [
    //             'name' => $name,
    //             'longitude' => $lon,
    //             'latitude' => $lat
    //         ];
    //     }

        // Step 2: Import data into the database
    //     DB::table('location')->insert($data);

    //     return redirect('/')->with('success', 'Data imported successfully');
    // }


// }