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
        $data = KmlUpload::find($id);

        if ($data) {
            // Check if a file is present in the request and if it's valid
            if ($request->hasFile('kml_file') && $request->file('kml_file')->isValid()) {
                // Retrieve the KML file from the request
                $kmlFile = $request->file('kml_file');

                // Generate a unique filename using current timestamp and file extension
                $filename = time() . '.' . $kmlFile->getClientOriginalExtension();

                // Move the uploaded KML file to the 'kml_files' directory with the generated filename
                $kmlFile->move(public_path('kml_files'), $filename);

                // Delete the previous KML file, if it exists
                if ($data->kml_file) {
                    // Assuming the file is saved in public_path('kml_files')
                    if (file_exists(public_path('kml_files/' . $data->kml_file))) {
                        unlink(public_path('kml_files/' . $data->kml_file));
                    }
                }

                // Set the filename in the appropriate column in the database
                $data->kml_file = $filename;

                // Save the model instance to update the database record
                $data->save();
            }
        }
    } catch (\Exception $e) {
        // Handle the exception, log it, or return an error response
        return response()->json(['error' => 'An error occurred while uploading KML file.'], 500);
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