<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PersonalInformationsController;
use App\Http\Controllers\Backend\FixedCostController;
use App\Http\Controllers\Backend\FarmProfileController;
use App\Http\Controllers\Backend\FertilizerController;
use App\Http\Controllers\Backend\LaborController;
use App\Http\Controllers\Backend\LastProductionDataController;
use App\Http\Controllers\Backend\MachineriesUsedController;
use App\Http\Controllers\Backend\PesticideController;
use App\Http\Controllers\Backend\SeedController;
use App\Http\Controllers\Backend\TransportController;
use App\Http\Controllers\Backend\VariableCostController;
use App\Http\Controllers\boarders\ParcelBoarderController;
use App\Http\Controllers\category\AgriDistrictController;
use App\Http\Controllers\category\CategorizeController;
use App\Http\Controllers\category\CropCategoryController;
use App\Http\Controllers\category\CropController;
use App\Http\Controllers\category\FisheriesCategoryController;
use App\Http\Controllers\category\FisheriesController;
use App\Http\Controllers\category\LivestockCategoryController;
use App\Http\Controllers\category\LivestockController;
use App\Http\Controllers\category\PolygonController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\KmlImportController;
use App\Http\Controllers\LandingPageController;

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\UserAccountController;
use App\Models\AgriDistrict;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('home/', function () {
//     return view('home');
// });

Route::get('user/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// // formcheck reciept edit of farm profile
// Route::get('/form-checking-farm-profile',[AgentController::class, 'checkfarm'])->name('agent.formvalidation.valfarmprofile.farmprofile_edit');
// Route::post('/form-checking-farm-profile',[AgentController::class, 'updateFarmprofile']);


// formcheck reciept edit of personal information
// Route::get('/form-checking',[PersonalInformationsController::class, 'viewpersoninfo'])->name('agent.formvalidation.valpersonal.personinfo_edit');
// Route::post('/form-checking/{perinfo}',[AgentController::class, 'updatePerinfo']);
// Route::get('/form-checking',[AgentController::class, 'viewpersoninfo'])->name('agent.formvalidation.valpersonal.personinfo_edit');

Route::get('/agent-profile',[AgentController::class, 'AgentProfile'])->name('agent.profile.agent_profiles');
Route::post('/agent-profile',[AgentController::class, 'Agentupdate']);


// aall data fetch of farmers profile
Route::get('/farmers-data',[PersonalInformationsController::class,'alldataform'])->name('agent.allfarmersinfo.forms_info');
Route::get('/farmer-profile',[PersonalInformationsController::class,'profileFarmer'])->name('agent.allfarmersinfo.profile');

// for user 
Route::get('/user-all-farmers',[PersonalInformationsController::class,'forms'])->name('user.forms_data');

// add variable cost variable by agent
Route::get('/add-variable-cost-vartotal',[AgentController::class, 'variableVartotal'])->name('agent.variablecost.variable_total.add_vartotal');
Route::post('/add-variable-cost-vartotal',[AgentController::class, 'AddNewVartotal']);

//fetching the data Vaible cost total in variable cost
Route::get('/show-variable-cost',[AgentController::class,'displayvar'])->name('agent.variablecost.variable_total.show_var');
Route::delete('/delete-variable-cost/{variable}',[AgentController::class,'vardelete'])->name('agent.variablecost.variable_total.delete'); //deleteing 
Route::get('/update-variable-cost/{variables}',[AgentController::class,'varupdate'])->name('agent.variablecost.variable_total.var_edited');
Route::post('/update-variable-cost/{variable}',[AgentController::class,'updatevaria']);



// add variable cost transport by agent
Route::get('/add-variable-cost-transport',[AgentController::class, 'variableTransport'])->name('agent.variablecost.transport.add_transports');
Route::post('/add-variable-cost-transport',[AgentController::class, 'AddNewTransport']);

// edit and view of transport data by agent
Route::get('/show-variable-cost-transport',[AgentController::class,'TransportDataView'])->name('agent.variablecost.transport.show_ttransportsData');
Route::delete('/delete-variable-cost-transport/{pesticides}',[AgentController::class,'TransportDelete'])->name('agent.variablecost.transport.delete'); //deleteing 
Route::get('/update-variable-cost-transport/{pesticides}',[AgentController::class,'TransportUpdate'])->name('agent.variablecost.transport.formsEdit_transportsData');
Route::post('/update-variable-cost-transport/{pesticides}',[AgentController::class,'TransportDataupdate']);


// add variable cost pesticides by agent
Route::get('/add-variable-cost-pesticides',[AgentController::class, 'variablePesticides'])->name('agent.variablecost.pesticides.add_pesticide');
Route::post('/add-variable-cost-pesticides',[AgentController::class, 'AddNewPesticide']);

// edit and view of pesticides data by agent
Route::get('/show-variable-cost-pesticides',[AgentController::class,'PesticideDataView'])->name('agent.variablecost.pesticides.show_pesticidesData');
Route::delete('/delete-variable-cost-pesticides/{pesticides}',[AgentController::class,'PesticideDelete'])->name('agent.variablecost.pesticides.delete'); //deleteing 
Route::get('/update-variable-cost-pesticides/{pesticides}',[AgentController::class,'PesticideUpdate'])->name('agent.variablecost.pesticides.formsEdit_pesticidesData');
Route::post('/update-variable-cost-pesticides/{pesticides}',[AgentController::class,'PesticideDataupdate']);



// add variable cost fertilizers by agent
Route::get('/add-variable-cost-fertilizers',[AgentController::class, 'variableFertilizers'])->name('agent.variablecost.fertilizers.add_fertilizer');
Route::post('/add-variable-cost-fertilizers',[AgentController::class, 'AddNewfertilizers']);

// edit and view of FERTILIZERS data by agent
Route::get('/show-variable-cost-fertilizers',[AgentController::class,'FertilizerDataView'])->name('agent.variablecost.fertilizers.show_fertilizeData');
Route::delete('/delete-variable-cost-fertilizers/{fertilizers}',[AgentController::class,'FertilizerDelete'])->name('agent.variablecost.fertilizers.delete'); //deleteing 
Route::get('/update-variable-cost-fertilizers/{fertilizers}',[AgentController::class,'FertilizerUpdate'])->name('agent.variablecost.fertilizers.formsEdit_fertilizeData');
Route::post('/update-variable-cost-fertilizers/{fertilizers}',[AgentController::class,'FertilizerDataupdate']);



// add variable cost labor by agent
Route::get('/add-variable-cost-labor',[AgentController::class, 'variableLabor'])->name('agent.variablecost.labor.add_labors');
Route::post('/add-variable-cost-labor',[AgentController::class, 'AddNewLabor']);

// edit and view of labors data by agent
Route::get('/show-variable-cost-labor',[AgentController::class,'LaborsDataView'])->name('agent.variablecost.labor.show_laborData');
Route::delete('/delete-variable-cost-labor/{labors}',[AgentController::class,'LaborsDelete'])->name('agent.variablecost.labor.delete'); //deleteing 
Route::get('/update-variable-cost-labor/{labors}',[AgentController::class,'LaborUpdate'])->name('agent.variablecost.labor.formEdit_labors');
Route::post('/update-variable-cost-labor/{labors}',[AgentController::class,'LaborDataupdate']);


// add variable cost seed by agent
Route::get('/add-variable-cost-seed',[AgentController::class, 'variableSeed'])->name('agent.variablecost.seed.add_seeds');
Route::post('/add-variable-cost-seed',[AgentController::class, 'AddNewSeeed']);

// edit and view of seed data by agent
Route::get('/show-variable-cost-seed',[AgentController::class,'SeedDataView'])->name('agent.variablecost.seed.show_seeds_data');
Route::delete('/delete-variable-cost-seed/{seeds}',[AgentController::class,'SeedsDelete'])->name('agent.variablecost.seed.delete'); //deleteing 
Route::get('/update-variable-cost-seed/{seeds}',[AgentController::class,'SeedsUpdate'])->name('agent.variablecost.seed.seeds_form_edit');
Route::post('/update-variable-cost-seed/{seeds}',[AgentController::class,'SeedDataupdate']);


// add last production by agent
Route::get('/add-last-production',[AgentController::class, 'LastProduction'])->name('agent.lastproduction.add_production');
Route::post('/add-last-production',[AgentController::class, 'AddNewProduction']);

// add last production
Route::get('/show-last-production',[AgentController::class,'viewProduction'])->name('agent.lastproduction.view_prod');
Route::delete('/delete-last-production/{productions}',[AgentController::class,'ProductionDelete'])->name('agent.lastproduction.delete'); //deleteing 
Route::get('/update-last-production/{production}',[AgentController::class,'produpdate'])->name('agent.lastproduction.last_edit');
Route::post('/update-last-production/{productions}',[AgentController::class,'update']);


// add machineries Used by agent
Route::get('/add-machinereies-used',[AgentController::class, 'machineUsed'])->name('agent.machineused.add_mused');
Route::post('/add-machinereies-used',[AgentController::class, 'AddMused']);

// fetch machineries by agent
Route::get('/show-machinereies-used',[AgentController::class,'showMachine'])->name('agent.machineused.show_maused');
Route::delete('/delete-machinereies-used/{machineries}',[AgentController::class,'machinedelete'])->name('agent.machineused.delete'); //deleteing 
Route::get('/update-machinereies-used/{machineries}',[AgentController::class,'MachineUpdate'])->name('agent.machineused.update_machine');
Route::post('/update-machinereies-used/{machineries}',[AgentController::class,'UpdateMachines']);


// add fixed by agent
Route::get('/add-fixed-cost',[AgentController::class, 'fixedCost'])->name('agent.fixedcost.add_fcost');
Route::post('/add-fixed-cost',[AgentController::class, 'AddFcost']);

// fetching and edit of fixed cost
Route::get('/show-fixed-cost',[AgentController::class,'viewFixed'])->name('agent.fixedcost.fcost_view');
Route::delete('/delete-fixed-cost/{fixedcosts}',[AgentController::class,'fixedcostdelete'])->name('agent.fixedcost.delete'); //deleteing fixed cost data
Route::get('/update-fixed-cost/{fixedcosts}',[AgentController::class,'FixedUpdate'])->name('agent.fixedcost.fixed_updates');
Route::post('/update-fixed-cost/{fixedcosts}',[AgentController::class,'UpdateFixedCost']);


// add farm profile by agent
Route::get('/add-farm-profile',[AgentController::class, 'farmprofiles'])->name('agent.farmprofile.add_profile');
Route::post('/add-farm-profile',[AgentController::class, 'AddFarmProfile']);

// fetching of data from 3 tables to be inserted in farm profiles
// Route::get('/add-farm-profile',[AgentController::class, 'fetchtables'])->name('agent.farmprofile.add_profile');
Route::get('/show-farm-profile',[AgentController::class,'showfarm'])->name('agent.farmprofile.farm_view');
Route::delete('/delete-farm-profile/{farmprofiles}',[AgentController::class,'farmdelete'])->name('agent.farmprofile.delete');
Route::get('/update-farm-profile/{farmprofiles}',[AgentController::class,'farmUpdate'])->name('agent.farmprofile.farm_update');
Route::post('/update-farm-profile/{farmprofiles}',[AgentController::class,'updatesFarm']);





//add personal informatio by agent
Route::get('/add-personal-info',[AgentController::class, 'addpersonalInfo'])->name('agent.personal_info.add_info');

Route::post('/add-personal-info',[AgentController::class, 'addinfo']);
Route::get('/show-personal-info',[AgentController::class,'viewpersoninfo'])->name('agent.personal_info.view_infor');
Route::post('/personal-info/{personlinformations}',[AgentController::class,'infodelete'])->name('agent.personal_info.delete');
Route::get('/update-personal-info/{personlinformations}',[AgentController::class,'updateview'])->name('agent.personal_info.update_records');
Route::post('/update-personal-info/{personlinformations}',[AgentController::class,'updateinfo']);

//landingg page 
Route::get('/', [LandingPageController::class, 'LandingPage'])->name('landing-page.page');

//kml file upload
Route::get('/kml/import', [KmlImportController::class, 'index'])->name('kml.import');
Route::post('/kml/import',[KmlImportController::class, 'upload']);
Route::get('/map/arcmap/{fileName}', [KmlImportController::class, 'displayMap']);

//parcelaryBoarders
Route::get('/parcel/create',[ParcelBoarderController::class, 'ParcelBoarders'])->name('parcels.create');
Route::post('/parcel/create',[ParcelBoarderController::class, 'store']);
Route::get('/parcel/create',[AgriDistrictController::class, 'ParcelBoarders'])->name('parcels.create');
//polygons
Route::get('/polygon/create',[PolygonController:: class, 'Polygons'])->name('polygon.create');
Route::post('/polygon/create',[PolygonController::class, 'store']);
Route::get('/polygon/create',[AgriDistrictController:: class, 'Polygons'])->name('polygon.create');
//fish
Route::get('/fisheries/create',[FisheriesController::class, 'Fisheries'])->name('fish.create');
Route::post('/fisheries/create',[FisheriesController::class, 'store']);
Route::get('/fisheries/create',[FisheriesCategoryController::class, 'Fisheries'])->name('fish.create');
// Route::get('/fisheries/create',[CategorizeController::class, 'Fisheries'])->name('fish.create');

//livestocks
Route::get('/livestocks/create',[LivestockController::class, 'Livestocks'])->name('livestocks.create');
Route::post('/livestocks/create',[LivestockController::class, 'store']);
Route::get('/livestocks/create',[CategorizeController::class, 'Livestocks'])->name('livestocks.create');
Route::get('/livestocks/create',[LivestockCategoryController::class, 'Livestocks'])->name('livestocks.create');

//crops
Route::get('/crops/create',[CropController::class, 'Cropping'])->name('crops.create');
Route::post('/crops/create',[CropController::class, 'store']);
Route::get('/crops/create',[CropCategoryController::class, 'Cropping'])->name('crops.create');
// Route::get('/crops/create',[CategorizeController::class, 'Cropping'])->name('crops.create');

//livestock-category
Route::get('/livestockcategory/create',[LivestockCategoryController::class, 'LivestockCategory'])->name('livestock_category.livestock_create');
Route::post('/livestockcategory/create',[LivestockCategoryController::class, 'store']);
Route::get('/livestockcategory/create',[CategorizeController::class, 'LivestockCategory'])->name('livestock_category.livestock_create');

//fisheries-category
Route::get('/fisheriescategory/create',[FisheriesCategoryController::class, 'FisheriesCategory'])->name('fisheries_category.fisheries_create');
Route::post('/fisheriescategory/create',[FisheriesCategoryController::class, 'store']);
Route::get('/fisheriescategory/create',[CategorizeController::class, 'FisheriesCategory'])->name('fisheries_category.fisheries_create');

//crop-category
Route::get('/crops-category', [CropCategoryController:: class,'CropCategory'])->name('crop_category.crop_create');
Route::post('/crops-category',[CropCategoryController::class, 'store']);
Route::get('/crops-category', [CategorizeController:: class,'CropCategory'])->name('crop_category.crop_create');

//catgorize router
Route::get('/category', [CategorizeController:: class,'Category'])->name('categorize.index');
Route::post('/category', [CategorizeController::class,'store']);

// Route::get('/category', [UserController:: class,'Categories'])->name('categorize.index');
Route::get('/category', [AgriDistrictController:: class,'Category'])->name('categorize.index');

//agridistricts router
Route::get('/district', [AgriDistrictController::class,'DisplayAgri'])->name('agri_districts.display');
Route::post('/district', [AgriDistrictController::class,'store']);
// Route::get('/district', [UserController::class,'Mapping'])->name('agri_districts.insertdata');
// Route::post('/savePolyline', [PolygonController::class, 'savePolyline']);
// Route::post('/save',[PolygonsController::class,'save']);

//join of all tables which fetch specific column
Route::get('/joinme' ,[PersonalInformationsController::class,'Personalfarms'])->name('farm-table.join_table');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/personalinformation/agent',[PersonalInformationsController::class,'Agent'])->name('personalinfo.index_agent');

Route::middleware(['auth','role:admin','PreventBackHistory'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'adminDashb'])->name('admin.dashb');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    // Route::patch('/admin/store', [AdminController::class, 'AdminProfileStore'])->name('admin.store');




});//end Group admin middleware
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

//agent route
Route::middleware(['auth','role:agent','PreventBackHistory'])->group(function(){
Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.agent_index');
Route::get('/agent/logout', [AgentController::class, 'agentlog'])->name('agent.logout');



});//end Group agent middleware

//user route
Route::middleware(['auth','role:user'])->group(function(){

    Route::get('/user/dashboard', [UserAccountController::class, 'UserDashboard'])->name('user.user_dash');
    
    Route::get('/user/logout', [UserAccountController::class, 'UserLogout'])->name('user.logout');
    
    });//end Group agent middleware

//multi importing of file into the database route
Route::get('/multifile/imports', [FileController::class, 'MultiFilesAgent'])->name('multifile.import_agent');
 Route::get('/multifile/import', [FileController::class, 'MultiFiles'])->name('multifile.import');
  Route::post('/multifile/import',[FileController::class, 'saveUploadForm']);
      
 // admin Map route
      Route::get('/map/gmap',[FarmProfileController::class, 'Gmap'])->name('map.gmap');
      Route::get('/map/agrimap',[FarmProfileController::class, 'agrimap'])->name('map.agrimap');
 
      // admin Map route
      Route::get('/map/arcmap',[FarmProfileController::class, 'ArcMap'])->name('map.arcmap');

      Route::get('/personalinfo/create',[PersonalInformationsController::class, 'PersonalInfoCrud'])->name('personalinfo.create');
     
      //agent  form input
      Route::get('/personalinfo/creates',[PersonalInformationsController::class, 'PersonalInfoCrudAgent'])->name('personalinfo.agent.show_agent');
    

   //Personal Informations route   
Route::controller(PersonalInformationsController::class)->group(function () {
    Route::get('/personalinformation','PersonalInfo')->name('personalinfo.index');
    Route::post('/personalinformation', 'store')->name('personalinfo.store');
    Route::get('/personalinformations/{personalInformations}','edit')->name('personalinfo.edit');
    Route::post('/personalinformation/{personalInformation}', 'update')->name('personalinfo.update');
    Route::post('/personalinformations/{personalInformation}',  'destroy')->name('personalinfo.destroy');
});



//fetch information from personal informations
Route::get('/farmprofile',[PersonalInformationsController::class ,'showPersonalInfo'])->name('farm_profile.index');

//farm profiles route
Route::middleware('auth')->group(function () {
    Route::get('/farmprofile',[FarmProfileController::class ,'FarmProfile'])->name('farm_profile.index');
    // Route::get('/farmprofile',[AgriDistrictController::class ,'FarmProfiles'])->name('farm_profile.index');
    Route::get('/farmprofile',[PersonalInformationsController::class ,'FarmProfiles'])->name('farm_profile.index');
    // Route::get('/farmprofile',[FarmProfileController::class ,'FarmProfiles'])->name('farm_profile.index');
    Route::post('/farmprofile',[FarmProfileController::class, 'store'])->name('farm_profile.store');
    Route::get('/farmprofile/show',[FarmProfileController::class, 'FarmProfileCrud'])->name('farm_profile.show');
    Route::get('/farmprofile/{farmprofile}',[ FarmProfileController::class,'edit'])->name('farm_profile.edit');
    Route::post('/farmprofile/{farmprofile}', [FarmProfileController::class,'update'])->name('farm_profile.update');
    Route::delete('/farmprofile/{farmprofile}', [FarmProfileController::class, 'destroy'])->name('farm_profile.destroy');
});

//fixed cost routes
Route::middleware('auth')->group(function () {
    Route::get('/fixedcost', [FixedCostController::class,'FixedForms'])->name('fixed_cost.index');
    Route::post('/fixedcost',[FixedCostController::class, 'store']);
    Route::get('/fixedcost/create',[FixedCostController::class, 'FixedCost'])->name('fixed_cost.create');
    Route::get('/fixedcost/{fixedcost}',[ FixedCostController::class,'edit'])->name('fixed_cost.edit');
    Route::post('/fixedcost/{fixedcost}', [FixedCostController::class,'update'])->name('fixed_cost.update');
    Route::delete('/fixedcost/{fixedcost}', [FixedCostController::class, 'destroy'])->name('fixed_cost.destroy');

});

//machineries used routes
Route::middleware('auth')->group(function () {
    Route::get('/machineriesused', [MachineriesUsedController::class,'MachineForms'])->name('machineries_used.index');
    Route::post('/machineriesused',[MachineriesUsedController::class, 'store']);
     Route::get('/machineriesused/create',[MachineriesUsedController::class, 'MachineriesUsedCrud'])->name('machineries_used.create');
    Route::get('/machineriesused/{machineriesused}',[ MachineriesUsedController::class, 'edit'])->name('machineries_used.edit');
    Route::post('/machineriesused/{machineriesused}', [MachineriesUsedController::class, 'update'])->name('machineries_used.update');
    Route::delete('/machineriesused/{machineriesused}', [MachineriesUsedController::class,'destroy'])->name('machineries_used.destroy');

});

//last Productions Data routes
Route::middleware('auth')->group(function () {
    Route::get('/production', [LastProductionDataController::class,'ProductionForms'])->name('production_data.index');
    Route::post('/production',[LastProductionDataController::class, 'store']);
    Route::get('/production/create',[LastProductionDataController::class, 'ProductionDataCrud'])->name('production_data.create');
    Route::get('/production/{lastproductiondata}',[ LastProductionDataController::class, 'edit'])->name('production_data.edit');
    Route::post('/production/{lastproductiondata}', [LastProductionDataController::class, 'update'])->name('production_data.update');
    Route::delete('/production/{lastproductiondata}', [LastProductionDataController::class, 'destroy'])->name('production_data.destroy');
});

//Seed routes
Route::middleware('auth')->group(function () {
    Route::get('/seeds', [SeedController::class,'SeedsVar'])->name('variable_cost.seeds.store');
    Route::post('seeds',[SeedController::class, 'store']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//labor routes
Route::middleware('auth')->group(function () {
    Route::get('/labor', [LaborController::class,'LaborsVar'])->name('variable_cost.labor.store');
    Route::post('/labor',[LaborController::class, 'store']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//fertilizers route
Route::middleware('auth')->group(function () {
    Route::get('/fertilizer', [FertilizerController::class,'FertilizersVar'])->name('variable_cost.fertilizer.store');
    Route::post('/fertilizer',[FertilizerController::class, 'store']); 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//pesticides routes
Route::middleware('auth')->group(function () {
    Route::get('/pesticides', [PesticideController::class,'PesticidesVar'])->name('variable_cost.pesticides.store');
    Route::post('/pesticides',[PesticideController::class, 'store']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//transport routes
Route::middleware('auth')->group(function () {
  Route::get('/transport', [TransportController::class,'TransportVar'])->name('variable_cost.transport.store');
    Route::post('/transport',[TransportController::class, 'store']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//variable cost routes
Route::middleware('auth')->group(function () {
Route::get('/variablecost', [VariableCostController::class,'VariableForms'])->name('variable_cost.index');
Route::post('/variablecost',[VariableCostController::class, 'store']);
      Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
      Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
      Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  });
  