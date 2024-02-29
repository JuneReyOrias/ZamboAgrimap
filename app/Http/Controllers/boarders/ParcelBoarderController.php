<?php

namespace App\Http\Controllers\boarders;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParcelBoarderRequest;
use App\Http\Requests\ParcellaryBoundariesRequest;
use App\Models\ParcelBoarder;
use App\Models\ParcellaryBoundaries;
use Illuminate\Http\Request;

class ParcelBoarderController extends Controller
{
    //view the page
    public function ParcelBoarders()
    {
        // $category= Categorize::latest()->get();
     return view('parcels.new_parcels');
    }
 //store 
  
//  public function  newparcels(Request $request)
//  {
//      try{
//         //  $existingFixedCost =  ParcellaryBoundaries::where([
//         //      ['personal_informations_id', '=', $request->input('personal_informations_id')],
//         //      ['farm_profiles_id', '=', $request->input('farm_profiles_id')],
         
 
//         //      // Add other fields here
//         //  ])->first();
         
//         //  if ( $existingFixedCost) {
//         //      // FarmProfile with the given personal_informations_id and other fields already exists
//         //      // You can handle this scenario here, for example, return an error message
//         //      return redirect('/fixedcost')->with('error', 'Farm Profile with this information already exists.');
//         //  }
//          $data= $request->validated();
//          $data= $request->all();
//          ParcellaryBoundaries::create($data);
 
//          return redirect('machineriesused')->with('message','Fixed Cost added successsfully');
     
//      }
//      catch(\Exception $ex){
//          return redirect('/fixedcost')->with('message','Someting went wrong');
//      }
//  }



//  public function newparcels(ParcelBoarderRequest $request){
//     try{
        
      
//         $data= $request->all();
//         $parcel=ParcellaryBoundaries::create([
//             'users_id' => $request->input('users_id'),
//             'agri_districts_id'=>$request->input('agri_districts_id'),
//             'ricefield_boarders_id'=>$request->input('ricefield_boarders_id'),
//             'parcel_name' => $request->input('parcel_name'),
//             'area' => $request->input('area'),
//             'lot_no' => $request->input('lot_no'),
//             'tct_no' => $request->input('tct_no'),
//             'brgy_name' => $request->input('brgy_name'),
//             'atdn' => $request->input('atdn'),
//             'arpowner_na' => $request->input('arpowner_na'),
//             'pkind_desc' => $request->input('pkind_desc'),
//             'puse_desc' => $request->input('puse_desc'),
//             'actual_used' => $request->input('actual_used'),
//             'market_value' => $request->input('market_value'),
//             'asssesedva' => $request->input('asssesedva'),
//             'parone_latitude' => $request->input('parone_latitude'),
//             'parone_longitude' => $request->input('parone_longitude'),
//             'partwo_latitude' => $request->input('partwo_latitude'),
//             'partwo_longitude' => $request->input('partwo_longitude'),
//             'parthree_latitude' => $request->input('parthree_latitude'),
//             'parthree_longitude' => $request->input('parthree_longitude'),
//             'parfour_latitude' => $request->input('parfour_latitude'),
//             'parfour_longitude' => $request->input('parfour_longitude'),
//             'parfive_latitude' => $request->input('parfive_latitude'),
//             'parfive_longitude' => $request->input('parfive_longitude'),
//             'parsix_latitude' => $request->input('parsix_latitude'),
//             'parsix_longitude' => $request->input('parsix_longitude'),
//             'parseven_latitude' => $request->input('parseven_latitude'),
//             'parseven_longitude' => $request->input('parseven_longitude'),
//             'pareight_latitude' => $request->input('pareight_latitude'),
//             'pareight_longitude' => $request->input('pareight_longitude'),
//             'parnine_latitude'=>$request->input('parnine_latitude'),
//             'parnine_longitude'=>$request->input('parnine_longitude'),
//             'parten_latitude'=>$request->input('parten_latitude'),
//             'parten_longitude'=>$request->input('parten_longitude'),
//             'pareleven_latitude'=>$request->input('pareleven_latitude'),
//             'pareleven_longitude'=>$request->input('pareleven_longitude'),
//             'partwelve_latitude'=>$request->input('partwelve_latitude'),
//             'partwelve_longitude'=>$request->input('partwelve_longitude')

//           ]);
//           dd($parcel);
//           $parcel->save();
//         return redirect('/add-parcel')->with('message','Parcelary Boundaries added successsfully');
    
//     }
//     catch(\Exception $ex){
//         dd($ex); // Debugging statement to inspect the exception
//         return redirect('/add-parcel')->with('message','Someting went wrong');
        
//     }   
//  }

public function newparcels(ParcellaryBoundariesRequest $request)
{
    try {
        // Get validated data
        $data = $request->validated();

        // Create new ParcellaryBoundaries object
        $parcel = ParcellaryBoundaries::create($data);

        // Redirect with success message
        return redirect('/add-parcel')->with('message', 'Parcelary Boundaries added successfully');
    } catch (\Exception $ex) {
        // Debugging statement to inspect the exception
        dd($ex);
        // Redirect with error message
        return redirect('/add-parcel')->with('message', 'Something went wrong');
    }
}



}
