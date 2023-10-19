<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class KmlImportController extends Controller
{
    public function index()
    {
        return view('kml.kml_import');
    }

    public function store(Request $request)
    {  dd($request);
        $request->validate([
            'file' => 'required|mimes:kml'
        ]);

        $file = $request->file('file')->getRealPath();

        // Step 1: Read the KML file
        $kml = simplexml_load_file($file);
        $data = [];

        foreach ($kml->Document->Placemark as $placemark) {
            $name = (string) $placemark->name;
            $coordinates = (string) $placemark->Point->coordinates;
            [$lon, $lat] = explode(',', $coordinates);

            $data[] = [
                'name' => $name,
                'longitude' => $lon,
                'latitude' => $lat
            ];
        }

        // Step 2: Import data into the database
        DB::table('location')->insert($data);

        return redirect('/')->with('success', 'Data imported successfully');
    }
}

