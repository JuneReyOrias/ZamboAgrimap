@extends('agent.agent_Dashboard')
@section('agent') 



<div class="page-content">

    <nav class="page-breadcrumb">
      <ol class="breadcrumb">
        
      </ol>
    </nav>
    {{-- <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30% Complete</div>
        
               
    </div> --}}
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          <div class="card-body">
  
            @if (session('message'))
            <div class="alert alert-success" role="alert">
              {{ session('message')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
               
            @endif
           
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h4 class="card-titles" style="display: flex;text-align: center; "><span></span>Rice Survey Form Zamboanga City</h4>
        <br>
            <h6 class="card-title"><span>II.</span>Farm Profile</h6>
        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
         
            <form  action{{url('AddFarmProfile')}} method="post"  >
              @csrf
             
                <div class="row mb-3">
                  <h2 class="card-title"><span>a.</span>Farm Location and Tenure:</h2>
                  <div class="col mb-4 mb-md-0">    
                    @php
                  $id = Auth::id();

              // Find the user by their ID and eager load the personalInformation relationship
              $profile= App\Models\PersonalInformations::where('users_id', $id)->latest()->first();

                @endphp
                    <label class="form-expand" for="personal_informations_id">Farmers Name:</label>
                    <select class="form-control placeholder-text" name="personal_informations_id" aria-label="personal_informations_id">
                          
                      <option value="{{ $profile->id }}">{{ $profile->first_name.' '. $profile->last_name}}</option>
                
              </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    @php
                    $id = Auth::id();

                // Find the user by their ID and eager load the personalInformation relationship
                $agridistrict= App\Models\AgriDistrict::find($id)->all();

                  @endphp
                    <label class="form-expand" for="agri_districts_id">Agri-District:</label>
                    <select class="form-control placeholder-text " name="agri_districts_id" aria-label="agri_districts_id">
                      @foreach ( $agridistrict as  $agridistrict)
                              <option value="{{ $agridistrict->id }}">{{ $agridistrict->district }}</option>
                          @endforeach
                      </select>
                  </div>
                  {{-- <div class="col-md-3 mb-3">
                    @php
                    $id = Auth::id();
          
                // Find the user by their ID and eager load the personalInformation relationship
                $polygons= App\Models\Polygon::find($id)->all();
          
                  @endphp

                    <label class="form-expand" for="polygons_id">Polygons:</label>
                    <select class="form-control placeholder-text" name="polygons_id" aria-label="User ID">
                      @foreach ( $polygons as  $polygons)
                          <option value="{{  $polygons->id }}">{{  $polygons->poly_name}}</option>
                      @endforeach
                  </select>
                  </div> --}}
                  <div class="col-md-3 mb-3">
                    
                    <label class="form-expand" for="tenurial_status">Tenurial Status:</label>
                    <select class="form-control placeholder-text @error('tenurial_status') is-invalid @enderror" name="tenurial_status"id="tenurial_status" aria-label="label select e" >
                      <option selected disabled>Select</option>
                      <option value="Owner" {{ old('tenurial_status') == 'Owner' ? 'selected' : '' }}>Owner</option>
                      <option value="Owner Tiller" {{ old('tenurial_status') == 'Owner Tiller' ? 'selected' : '' }}>Owner Tiller</option>
                      <option value="Tenant" {{ old('tenurial_status') == 'Tenant' ? 'selected' : '' }}>Tenant</option>
                      <option value="Tiller" {{ old('tenurial_status') == 'Tiller' ? 'selected' : '' }}>Tiller</option>
                      <option value="Lease" {{ old('tenurial_status') == 'Lease' ? 'selected' : '' }}>Lease</option>
                     
                    </select>

                    @error('tenurial_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                  
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="rice_farm_address">Rice Farm Address:</label>
                    <input type="text" class="form-control placeholder-text @error('rice_farm_address') is-invalid @enderror" name="rice_farm_address" id="rice_farm_address" placeholder="Enter Rice Farm Address"value="{{ old('rice_farm_address') }}" >
                    @error('rice_farm_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="no_of_years_as_farmers">No. of Years as Farmer:</label>
                    <input type="text" class="form-control placeholder-text @error('no_of_years_as_farmers') is-invalid @enderror" name="no_of_years_as_farmers" id="validationCustom01" placeholder="Enter No. of Years" value="{{ old('no_of_years_as_farmers') }}" >
                    @error('no_of_years_as_farmers')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="gps_longitude">GPS_longitude</label>
                    <input type="text" class="form-control placeholder-text  @error('gps_longitude') is-invalid @enderror" name="gps_longitude"  id="gps_longitude" placeholder="Enter GPS_longitude" value="{{ old('gps_longitude') }}" >
                    @error('gps_longitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="gps_latitude">GPS_Latitude</label>
                    <input type="text" class="form-control placeholder-text  @error('gps_latitude') is-invalid @enderror" name="gps_latitude"  id="gps_latitude" placeholder="Enter  GPS_Latitude" value="{{ old('gps_latitude') }}" >
                    @error('gps_latitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                </div>
                
             
    
              <div class="row mb-3">
                <h6 class="card-title"><span>b.</span>Land Informations and Environmental Factors:</h6>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="total_physical_area_has">Total Physical Area(has)</label>
                  <input type="text" class="form-control placeholder-text @error('total_physical_area_has') is-invalid @enderror"name="total_physical_area_has" id="total_physical_area_has" placeholder="Enter Total Physical Area" value="{{ old('total_physical_area_has') }}" >
                  @error('total_physical_area_has')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="rice_area_cultivated_has">Total Cultivated Area(has)</label>
                  <input type="text" class="form-control placeholder-text @error('rice_area_cultivated_has') is-invalid @enderror" name="rice_area_cultivated_has"id="rice_area_cultivated_has" placeholder="Enter Total Cultivated Area" value="{{ old('rice_area_cultivated_has') }}" >
                  @error('rice_area_cultivated_has')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="land_title_no">Land Title No.</label>
                  <input type="text" class="form-control placeholder-text @error('land_title_no') is-invalid @enderror" name="land_title_no"id="land_title_no" placeholder="Enter Land Title No." value="{{ old('land_title_no') }}" >
                  @error('land_title_no')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="lot_no">Lot No.:</label>
                  <input type="text" class="form-control placeholder-text @error('lot_no') is-invalid @enderror" name="lot_no" id="lot_no" placeholder="Enter Lot No." value="{{ old('lot_no') }}" >
                  @error('lot_no')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="validationCustom01" >Area Prone to:
                  </label>
                  <select class="form-control placeholder-text @error('area_prone_to') is-invalid @enderror" id="validationCustom01" name="area_prone_to" aria-label="Floating label select e">
                    <option selected disabled>Select</option>
                    <option value="Flood" {{ old('area_prone_to') == 'Flood' ? 'selected' : '' }}>Flood</option>
                    <option value="Drought" {{ old('area_prone_to') == 'Drought' ? 'selected' : '' }}>Drought</option>
                    <option value="Saline" {{ old('area_prone_to') == 'Saline' ? 'selected' : '' }}>Saline</option>
                    <option value="N/A" {{ old('area_prone_to') == 'N/A' ? 'selected' : '' }}>N/A</option>
                  </select>
                  @error('area_prone_to')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="validationCustom01" >Ecosystem
                  </label>
                  <select class="form-control placeholder-text @error('ecosystem') is-invalid @enderror" id="validationCustom01" name="ecosystem" aria-label="Floating label select e">
                    <option selected disabled>Select</option>
                    <option value="Lowland Rain Fed" {{ old('ecosystem') == 'Lowland Rain Fed' ? 'selected' : '' }}>Lowland Rain Fed</option>
                    <option value="Lowland Irrigated" {{ old('ecosystem') == 'Lowland Irrigated' ? 'selected' : '' }}>Lowland Irrigated</option>
                  
                  </select>
                  @error('ecosystem')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
              </div>
              <div class="row mb-3">
                <h6 class="card-title"><span>C.</span>Crop and Planting Details:</h6>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="type_rice_variety" >Type of Rice Variety
                  </label>
                  <select class="form-control placeholder-text @error('type_rice_variety') is-invalid @enderror" id="type_rice_variety" name="type_rice_variety" aria-label="Floating label select e">
                    <option selected disabled>Select</option>
                    <option value="Inbred" {{ old('type_rice_variety') == 'Inbred' ? 'selected' : '' }}>Inbred</option>
                    <option value="Hybrid" {{ old('type_rice_variety') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                    <option value="N/A" {{ old('type_rice_variety') == 'N/A' ? 'selected' : '' }}>N/A</option>
                  </select>
                  @error('type_rice_variety')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="prefered_variety" >Preferred variety:pls Specify</label>
                  <input type="text" class="form-control placeholder-text @error('prefered_variety') is-invalid @enderror" id="prefered_variety"name="prefered_variety" placeholder="if Yes please specify" value="{{ old('prefered_variety') }}">
                  @error('prefered_variety')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="plant_schedule_wetseason">Planting schedule(Wet Season):</label>
                  <input class="form-control placeholder-text @error('plant_schedule_wetseason') is-invalid @enderror"
                         name="plant_schedule_wetseason" id="datepicker" placeholder="Planting schedule"
                         value="{{ old('plant_schedule_wetseason') }}" data-input='true'>
                  @error('plant_schedule_wetseason')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="plant_schedule_dryseason">Planting schedule(Dry Season):</label>
                <input class="form-control placeholder-text @error('plant_schedule_dryseason') is-invalid @enderror"
                       name="plant_schedule_dryseason" id="datepicker" placeholder="Planting schedule"
                       value="{{ old('plant_schedule_dryseason') }}" data-input='true'>
                @error('plant_schedule_dryseason')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="no_of_cropping_yr">No. of Cropping/year:</label>
                  <input type="text" class="form-control placeholder-text @error('no_of_cropping_yr') is-invalid @enderror" id="no_of_cropping_yr"name="no_of_cropping_yr"  placeholder="Enter No.of Cropping/year"  value="{{ old('no_of_cropping_yr') }}">
                  @error('no_of_cropping_yr')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="validationCustom02">Yield (Kg/Ha):</label>
                  <input type="text" class="form-control placeholder-text @error('yield_kg_ha') is-invalid @enderror" id="validationCustom02"name="yield_kg_ha" placeholder="Enter Celphone/Tel.no"  value="{{ old('yield_kg_ha') }}" >
                  @error('yield_kg_ha')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
    
       
              </div>
              <div class="row mb-3">
                <h6 class="card-title"><span>d.</span>Insurance and Financial Information:</h6>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="rsba_register" >RSBA Registered
                  </label>
                  <select class="form-control placeholder-text @error('rsba_register') is-invalid @enderror" id="rsba_register" name="rsba_register" aria-label="Floating label select e">
                    <option selected disabled>Select</option>
                    <option value="Yes" {{ old('rsba_register') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('rsba_register') == 'No' ? 'selected' : '' }}>No</option>
              
                  </select>
                  @error('rsba_register')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pcic_insured" >PCIC Insured</label>
                  <select class="form-control placeholder-text @error('pcic_insured') is-invalid @enderror" id="pcic_insured" name="pcic_insured" aria-label="Floating label select e">
                    <option selected disabled>Select</option>
                    <option value="Yes" {{ old('pcic_insured') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('pcic_insured') == 'No' ? 'selected' : '' }}>No</option>
              
                  </select>
                  @error('pcic_insured')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="government_assisted" >Government Assisted</label>
                  <select class="form-control placeholder-text @error('government_assisted') is-invalid @enderror" id="government_assisted" name="government_assisted" aria-label="Floating label select e">
                    <option selected disabled>Select</option>
                    <option value="Yes" {{ old('government_assisted') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('government_assisted') == 'No' ? 'selected' : '' }}>No</option>
              
                  </select>
                  @error('government_assisted')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="source_of_capital">Source of Capital:</label>
                  <select class="form-control placeholder-text @error('source_of_capital') is-invalid @enderror" id="source_of_capital" name="source_of_capital" aria-label="Floating label select e">
                    <option selected disabled>Select</option>
                    <option value="Own" {{ old('source_of_capital') == 'Own' ? 'selected' : '' }}>Own</option>
                    <option value="Loan" {{ old('source_of_capital') == 'Loan' ? 'selected' : '' }}>Loan</option>
                    <option value="Financed" {{ old('source_of_capital') == 'Financed' ? 'selected' : '' }}>Financed</option>
              
                  </select>
                  @error('source_of_capital')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="validationCustom02">Remarks/Recommendation:</label>
                  <input type="text" class="form-control placeholder-text @error('remarks_recommendation') is-invalid @enderror" id="validationCustom02"name="remarks_recommendation" placeholder="Enter Remarks"  value="{{ old('remarks_recommendation') }}" >
                  @error('remarks_recommendation')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="validationCustom02">OCA District Office:</label>
                  <input type="text" class="form-control placeholder-text @error('oca_district_office') is-invalid @enderror" id="validationCustom02"name="oca_district_office" placeholder="Enter OCA District Office"  value="{{ old('oca_district_office') }}" >
                  @error('oca_district_office')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="validationCustom02" style="font-size: 12px;">Name of Field Officers:</label>
                  <input type="text" class="form-control placeholder-text @error('name_technicians') is-invalid @enderror" id="validationCustom02"name="name_technicians" placeholder="Enter name of Field Officer"  value="{{ old('name_technicians') }}" >
                  @error('name_technicians')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="validationCustom02" style="font-size: 12px;">Date Interview:</label>
                  <input class="form-control placeholder-text @error('date_interview') is-invalid @enderror"
                         name="date_interview" id="datepicker" placeholder="Date Interview"
                         value="{{ old('date_interview') }}" data-input='true'>
                  @error('date_interview')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="image" class="form-label" style="color: green;">UploadPhoto</label>
                  <input type="file" class="custom-file-input" id="inputGroupFile01"
                  aria-describedby="inputGroupFileAddon01">
              </div>
    
       
              </div>
              
    <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
      <button  type="submit" class="btn btn-success me-md-2">Next</button></a></p>
    </div>
              </form>
            
              
            </div>
          </div>
        </div>
      </div>
     
      
    
    
    
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          flatpickr("#datepicker", {
              dateFormat: "Y-m-d", // Date format (YYYY-MM-DD)
              // Additional options can be added here
          });
      });
    </script>
    
    @endsection