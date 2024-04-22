@extends('admin.dashb')
@section('admin')

@extends('layouts._footer-script')
@extends('layouts._head')
<div class="page-content">

    <nav class="page-breadcrumb">
  
    </nav>
   
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card border rounded">
          
          <div class="card-body">
            @if (session('message'))
            <div class="alert alert-success" role="alert">
              {{ session('message')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
               
            @endif
            <h6 class="card-title"><span>II.</span>Farm Profile (view, edit, delete)</h6>
            <br><br>
            <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         
           <div class="table-responsive tab ">
            <table class="table table bordered data-table">
                <thead class="thead-light">
                    <tr >
                        <th>Farmno.</th>
                        <th>Farm ID.</th>
                        <th>Personal Info ID.</th>
                        <th>Agri District ID.</th>
                        <th>tenurial status</th>
                        <th>rice farm address</th>
                        <th>no of years as farmers</th>
                        <th>gps longitude</th>
                        <th>gps latitude</th>
                        <th>total physical area has</th>
                        <th>rice_area_cultivated has</th>
                        <th>land_title_no</th>
                        <th>lot_no</th>
                        <th>area_prone_to</th>
                        <th>ecosystem</th>
                        <th>type_rice_variety</th>
                        <th>prefered_variety</th>
                        <th>plant_schedule_wetseason</th>
                        <th>plant_schedule_dryseason'</th>
                        <th>no_of_cropping_yr</th>
                        <th>yield_kg_ha</th>
                        <th>rsba_register</th>
                        <th>pcic_insured</th>
                        <th>source_of_capital</th>
                        <th>remarks_recommendation</th>
                        <th>oca_district_office</th>
                        <th>name_technicians</th>
                        <th>date_interview</th>
                        <th>Time of input</th>
                        <th>Updated at Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($farmprofiles->count() > 0)
                @foreach($farmprofiles as $farmprofile)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $farmprofile->id }}</td>
                         <td>{{ $farmprofile->personal_informations_id }}</td>
                         <td>{{ $farmprofile->agri_districts_id }}</td>
                        <td>{{ $farmprofile->tenurial_status }}</td>
                        <td>{{ $farmprofile->rice_farm_address }}</td>
                        <td>{{ $farmprofile->no_of_years_as_farmers }}</td>
                        <td>{{ $farmprofile->gps_longitude }}</td>
                        <td>{{ $farmprofile->gps_latitude}}</td>
                        <td>{{ $farmprofile->total_physical_area_has }}</td>
                        <td>{{ $farmprofile->rice_area_cultivated_has }}</td>
                        <td>{{ $farmprofile->land_title_no }}</td>
                        <td>{{ $farmprofile->lot_no}}</td>
                        <td>{{ $farmprofile->area_prone_to}}</td>
                        <td>{{ $farmprofile->ecosystem }}</td>
                        <td>{{ $farmprofile->type_rice_variety }}</td>
                        <td>{{ $farmprofile->prefered_variety }}</td>
                        <td>{{ $farmprofile->plant_schedule_wetseason }}</td>
                        <td>{{ $farmprofile->plant_schedule_dryseason}}</td>
                        <td>{{ $farmprofile->no_of_cropping_yr }}</td>
                        <td>{{ $farmprofile->yield_kg_ha}}</td>
                        <td>{{ $farmprofile->rsba_register}}</td>
                        <td>{{ $farmprofile->pcic_insured }}</td>
                        <td>{{ $farmprofile->source_of_capital}}</td>
                        <td>{{ $farmprofile->remarks_recommendation}}</td>
                        <td>{{ $farmprofile->oca_district_office}}</td>
                        <td>{{ $farmprofile->name_technicians}}</td>
                        <td>{{ $farmprofile->date_interview}}</td>
                        <td>{{ $farmprofile->created_at}}</td>
                        <td>{{ $farmprofile->updated_at}}</td>
                        <td>
                          {{-- <a href="#" title="View" data-toggle="modal" data-target="#exampleModal{{ $farmprofile->id }}">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa fa-eye" aria-hidden="true"></i> 
                            </button>
                        </a> --}}
                   
                             <a href="{{route('farm_profile.farm_edit', $farmprofile->id)}}" title="Edit farm profile"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action="{{ route('farm_profile.delete', $farmprofile->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                {{-- {{ csrf_field()}} --}}@csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                            
                        </td>
                    </tr>

                     <!-- Modal -->
        <div class="modal fade" id="exampleModal{{ $farmprofile->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                    
                  
                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                  
                            <h6 class="card-title"><span>II.</span>Farm Profile Update</h6>
                        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
                         
                            <form  action{{url('UpdateFarmProfiles')}} method="post" >
                              @csrf
                            
                              <div class="row mb-3">
                                <h2 class="card-title"><span>a.</span>Farm Location and Tenure:</h2>
                                {{-- personl info id --}}
                                {{-- <div >    
                                 
                                  <input type="hidden" id="personal_informations_id"  name="personal_informations_id" value="{{$farmprofiles->personal_informations_id}}" >
                                </div>
                  
                                <div >    
                                 
                                  <input type="hidden" id="agri_districts_id"  name="agri_districts_id" value="{{$farmprofiles->agri_districts_id}}" >
                                </div>
                  
                                <div >    
                                 
                                  <input type="hidden" id="polygons_id"  name="polygons_id" value="{{$farmprofiles->polygons_id}}" >
                                </div>
                   --}}
                                
                                <div class="col-md-3 mb-3">
                                  
                                  <label class="form-expand" for="tenurial_status">Tenurial Status:</label>
                                  <select class="form-control placeholder-text @error('tenurial_status') is-invalid @enderror" name="tenurial_status"id="tenurial_status" aria-label="label select e" >
                                    <option value="{{$farmprofile->tenurial_status}}">{{$farmprofile->tenurial_status}}</option>
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
                                  <input type="text" class="form-control placeholder-text @error('rice_farm_address') is-invalid @enderror"value="{{$farmprofile->rice_farm_address}}" name="rice_farm_address" id="rice_farm_address" placeholder="Enter Rice Farm Address"value="{{ old('rice_farm_address') }}" >
                                  @error('rice_farm_address')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                  <label class="form-expand" for="no_of_years_as_farmers">No. of Years as Farmer:</label>
                                  <input type="text" class="form-control placeholder-text @error('no_of_years_as_farmers') is-invalid @enderror" value="{{$farmprofile->no_of_years_as_farmers}}"name="no_of_years_as_farmers" id="validationCustom01" placeholder="Enter No. of Years" value="{{ old('no_of_years_as_farmers') }}" >
                                  @error('no_of_years_as_farmers')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                  <label class="form-expand" for="gps_longitude">GPS_longitude</label>
                                  <input type="text" class="form-control placeholder-text  @error('gps_longitude') is-invalid @enderror" value="{{$farmprofile->gps_longitude}}" name="gps_longitude"  id="gps_longitude" placeholder="Enter GPS_longitude" value="{{ old('gps_longitude') }}" >
                                  @error('gps_longitude')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                  <label class="form-expand" for="gps_latitude">GPS_Latitude</label>
                                  <input type="text" class="form-control placeholder-text  @error('gps_latitude') is-invalid @enderror"value="{{$farmprofile->gps_latitude}}" name="gps_latitude"  id="gps_latitude" placeholder="Enter  GPS_Latitude" value="{{ old('gps_latitude') }}" >
                                  @error('gps_latitude')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                                </div>
                              </div>
                              
                           
                  
                            <div class="row mb-3">
                              <h6 class="card-title"><span>b.</span>Land Informations and Environmental Factors:</h6>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="total_physical_area_has">Total Physical Area(has)</label>
                                <input type="text" class="form-control placeholder-text @error('total_physical_area_has') is-invalid @enderror" value="{{$farmprofile->total_physical_area_has}}"  name="total_physical_area_has" id="total_physical_area_has" placeholder="Enter Total Physical Area" value="{{ old('total_physical_area_has') }}" >
                                @error('total_physical_area_has')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="rice_area_cultivated_has">Total Cultivated Area(has)</label>
                                <input type="text" class="form-control placeholder-text @error('rice_area_cultivated_has') is-invalid @enderror" value="{{$farmprofile->rice_area_cultivated_has}}" name="rice_area_cultivated_has"id="rice_area_cultivated_has" placeholder="Enter Total Cultivated Area" value="{{ old('rice_area_cultivated_has') }}" >
                                @error('rice_area_cultivated_has')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="land_title_no">Land Title No.</label>
                                <input type="text" class="form-control placeholder-text @error('land_title_no') is-invalid @enderror"value="{{$farmprofile->land_title_no}}" name="land_title_no"id="land_title_no" placeholder="Enter Land Title No." value="{{ old('land_title_no') }}" >
                                @error('land_title_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="lot_no">Lot No.:</label>
                                <input type="text" class="form-control placeholder-text @error('lot_no') is-invalid @enderror"value="{{$farmprofile->lot_no}}"  name="lot_no" id="lot_no" placeholder="Enter Lot No." value="{{ old('lot_no') }}" >
                                @error('lot_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="validationCustom01" >Area Prone to:
                                </label>
                                <select class="form-control placeholder-text @error('area_prone_to') is-invalid @enderror" id="validationCustom01" name="area_prone_to" aria-label="Floating label select e">
                                  <option value="{{$farmprofile->area_prone_to}}">{{$farmprofile->area_prone_to}}</option>
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
                                  <option value="{{$farmprofile->ecosystem}}">{{$farmprofile->ecosystem}}</option>
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
                                  <option value="{{$farmprofile->type_rice_variety}}">{{$farmprofile->type_rice_variety}}</option>
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
                                <input type="text" class="form-control placeholder-text @error('prefered_variety') is-invalid @enderror"value="{{$farmprofile->prefered_variety}}"  id="prefered_variety"name="prefered_variety" placeholder="if Yes please specify" value="{{ old('prefered_variety') }}">
                                @error('prefered_variety')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="plant_schedule_wetseason">Planting schedule(Wet Season):</label>
                                <input class="form-control placeholder-text @error('plant_schedule_wetseason') is-invalid @enderror"
                                       name="plant_schedule_wetseason"  value="{{$farmprofile->plant_schedule_wetseason}}" id="datepicker" placeholder="Planting schedule"
                                       value="{{ old('plant_schedule_wetseason') }}" data-input='true'>
                                @error('plant_schedule_wetseason')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                              <label class="form-expand" for="plant_schedule_dryseason">Planting schedule(Dry Season):</label>
                              <input class="form-control placeholder-text @error('plant_schedule_dryseason') is-invalid @enderror"
                                     name="plant_schedule_dryseason"value="{{$farmprofile->plant_schedule_dryseason}}" id="datepicker" placeholder="Planting schedule"
                                     value="{{ old('plant_schedule_dryseason') }}" data-input='true'>
                              @error('plant_schedule_dryseason')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="no_of_cropping_yr">No. of Cropping/year:</label>
                                <input type="text" class="form-control placeholder-text @error('no_of_cropping_yr') is-invalid @enderror"value="{{$farmprofile->no_of_cropping_yr}}" id="no_of_cropping_yr"name="no_of_cropping_yr"  placeholder="Enter No.of Cropping/year"  value="{{ old('no_of_cropping_yr') }}">
                                @error('no_of_cropping_yr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="yield_kg_ha">Yield (Kg/Ha):</label>
                                <input type="text" class="form-control placeholder-text @error('yield_kg_ha') is-invalid @enderror"value="{{$farmprofile->yield_kg_ha}}" id="yield_kg_ha"name="yield_kg_ha" placeholder="Enter Celphone/Tel.no"  value="{{ old('yield_kg_ha') }}" >
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
                                  <option value="{{$farmprofile->rsba_register}}">{{$farmprofile->rsba_register}}</option>
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
                                  <option value="{{$farmprofile->pcic_insured}}">{{$farmprofile->pcic_insured}}</option>
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
                                  <option value="{{$farmprofile->government_assisted}}">{{$farmprofile->government_assisted}}</option>
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
                                  <option value="{{$farmprofile->source_of_capital}}">{{$farmprofile->source_of_capital}}</option>
                                  <option value="Own" {{ old('source_of_capital') == 'Own' ? 'selected' : '' }}>Own</option>
                                  <option value="Loan" {{ old('source_of_capital') == 'Loan' ? 'selected' : '' }}>Loan</option>
                                  <option value="Financed" {{ old('source_of_capital') == 'Financed' ? 'selected' : '' }}>Financed</option>
                            
                                </select>
                                @error('source_of_capital')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="remarks_recommendation">Remarks/Recommendation:</label>
                                <input type="text" class="form-control placeholder-text @error('remarks_recommendation') is-invalid @enderror" value="{{$farmprofile->remarks_recommendation}}"id="remarks_recommendation"name="remarks_recommendation" placeholder="Enter Remarks"  value="{{ old('remarks_recommendation') }}" >
                                @error('remarks_recommendation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="oca_district_office">OCA District Office:</label>
                                <input type="text" class="form-control placeholder-text @error('oca_district_office') is-invalid @enderror"value="{{$farmprofile->oca_district_office}}" id="oca_district_office"name="oca_district_office" placeholder="Enter OCA District Office"  value="{{ old('oca_district_office') }}" >
                                @error('oca_district_office')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="name_technicians" style="font-size: 12px;">Name of Field Officers:</label>
                                <input type="text" class="form-control placeholder-text @error('name_technicians') is-invalid @enderror"value="{{$farmprofile->name_technicians}}" id="name_technicians"name="name_technicians" placeholder="Enter name of Field Officer"  value="{{ old('name_technicians') }}" >
                                @error('name_technicians')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="date_interview" style="font-size: 12px;">Date Interview:</label>
                                <input class="form-control placeholder-text @error('date_interview') is-invalid @enderror"
                                       name="date_interview"value="{{$farmprofile->date_interview}}" id="datepicker" placeholder="Date Interview"
                                       value="{{ old('date_interview') }}" data-input='true'>
                                @error('date_interview')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-expand" for="personal_photo" class="form-label" style="color: green;">UploadPhoto</label>
                                <input type="file" class="custom-file-input" name="personal_photo" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" accept=".jpeg, .jpg, .png">
                            </div>
                  
                     
                            </div>
                  
                            <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a  href="{{route('farm_profile.farminfo_view')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
                            <button  type="submit" class="btn btn-success me-md-2">Next</button></a></p>
                                    </form>
                         
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
                @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="5">Personal Informations not found</td>
                </tr>
            @endif
                </tbody>
            </table>
        </div>
  
   
          </div>
                      {{-- <!-- Pagination links -->
                      <div class="row"style="align-content: center;display: flex;
                      align-items: center; align-self: center">
                          <div class="col-md-7" style="align-content: center;display: flex;
                          align-items: center;">
                              {{ $farmprofile->links() }}
                          </div>
                      </div> --}}
        </div>
      </div>
    </div>
</div>
</div>
</div>

</div>

</div>@endsection