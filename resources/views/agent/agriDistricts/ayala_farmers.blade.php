@extends('agent.agent_Dashboard')
@section('agent') 
@extends('layouts._footer-script')
@extends('layouts._head')
<style>
  .container-fluid {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
  }
  .row {
      display: flex;
      justify-content: center;
  }
</style>

<div class="page-content">

  
  @if (session('message'))
  <div class="alert alert-success" role="alert">
      {{ session('message')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
    <div class="dropdown d-flex flex-wrap justify-content-between align-items-center">
      <h4 class="mb-3 mb-md-0 font-weight-bold">Ayala Rice Farmers</h4>
      
      <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
          <!--<span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>-->
          <!--<input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>-->
      </div>
     
      <button type="button" class="btn btn-primary btn-icon-text me-2 mb-2 mb-md-0 hide-on-print" onclick="printTableContent()" data-toggle="popover" title="Print" data-content="Click to print the table content.">
        <i class="btn-icon-prepend" data-feather="printer"></i>
        Print Table
    </button>
    <button onclick="printPersonalInfo()" class="btn btn-primary hide-on-print">Print Report</button>

  
      <div class="btn-group">
          <button class="btn btn-primary dropdown-toggle dropdown-success hide-on-print" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Menu
          </button>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
              <button class="dropdown-item" onclick="showSection('personal_info')">Report</button>
              <!-- <button class="dropdown-item" onclick="showAllSections()">View All</button> -->
              <button class="dropdown-item dropdown-success" onclick="showSection('fixed_cost')">Farmers Info</button>
              {{-- <button class="dropdown-item" onclick="showSection('farm_profile')">Farm Profile</button> --}}
          </div>
      </div>
  </div>
  
      
      

    <!-- Personal Info Table Section -->
    <div id="fixed_cost_section"class="table-section" >
      
        <br>
        {{-- <div class="card border rounded">
            <div class="card-body"> --}}
                <h4 class="mb-3 mb-md-0">Personal Informations</h4>
      
                <div class="table-responsive tab">
                  <table id="printTable" class="table table-bordered table-sm datatable">
              
                        <thead class="thead-light">
                            <tr>
                                <th>Farmer No.</th>
                                <th>Farmers Name</th>
                                <th>Farm Address</th>
                                <th>Farmer Org/assoc/coop</th>
                                <th>Tenurial Status</th>
                                <th>Total Fixed Cost</th>
                                <th>Total Machineries Used</th>
                                <th>Variable Cost</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($FarmersData->where('agri_district','ayala') as $personalinformation)
                            <tr class="table-light">
                                <td class=" d-md-table-cell">{{ $personalinformation->personal_informations_id }}</td>
                                <td class=" d-md-table-cell">
                                    <?php
                                    // Define variables
                                    $first_name = $personalinformation->first_name;
                                    $middle_name = $personalinformation->middle_name;
                                    $last_name = $personalinformation->last_name;
                                    $extension_name = $personalinformation->extension_name;
                                
                                    // Construct the full name
                                    $full_name = $first_name;
                                
                                    // Check and append the middle name
                                    if (!empty($middle_name) && $middle_name !== 'N/A') {
                                        $full_name .= ' ' . $middle_name;
                                    }
                                
                                    $full_name .= ', ' . $last_name;
                                
                                    // Check if extension_name is not empty and not equal to "N/A"
                                    if (!empty($extension_name) && $extension_name !== 'N/A') {
                                        $full_name .= ' ' . $extension_name;
                                    }
                                
                                    // Output the full name
                                    echo htmlspecialchars($full_name);
                                    ?>
                                </td>
                                
                                <td class=" d-sm-table-cell">{{ $personalinformation->rice_farm_address . ', ' . $personalinformation->agri_district . ', ' . $personalinformation->city }}</td>
                                <td class=" d-sm-table-cell">
                                    {{ $personalinformation->nameof_farmers_ass_org_coop !== 'N/A' ? $personalinformation->nameof_farmers_ass_org_coop : 'No farms org/assoc/coop' }}
                                </td>
                                
                                <td class=" d-sm-table-cell">{{ $personalinformation->tenurial_status }}</td>
                                <td class=" d-sm-table-cell">{{ $personalinformation->total_amount }}</td>
                                <td class=" d-sm-table-cell">{{ $personalinformation->total_cost_for_machineries }}</td>
                                <td class=" d-sm-table-cell"> {{ $personalinformation->total_transport_per_deliverycost	}}</td>
                                <td class=" d-sm-table-cell">
                                    <a href="#" title="View" data-toggle="modal" data-target="#exampleModal{{ $personalinformation->personal_informations_id }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye" aria-hidden="true"></i> 
                                        </button>
                                    </a>
                                </td>
                                
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $personalinformation->personal_informations_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Farmers Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                          
 

                                            <form>
                                             
                                              
                                              
                                              <div class="box d-flex flex-column align-items-center">
                                                <img src="/upload/farmerprof.png" alt="default avatar"  class="wd-80 ht-80 rounded-circle">
                                                <p class="text">{{$full_name}}</p>
                                                <p class="text">Age:{{$personalinformation->age}}</p>
                                                <div id="overlay">
                                                    <div class="image">
                                                        <div class="trick"></div>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                            
                                          
                                                    <div class="panel-group align-items-left" id="accordion" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" role="tab" id="headingOne">
                                                                <h4 class="panel-title">
                                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="" aria-controls="collapseOne">
                                                                        <div class="title btn btn-success btn-outline btn-lg">Personal Info</div>
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                                <div class="panel-body">
                                                                  <br>
                                                                  <div class="row mb-3">
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Farmers Org/Assoc/Coop:</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0"> {{ $personalinformation->nameof_farmers_ass_org_coop !== 'N/A' ? $personalinformation->nameof_farmers_ass_org_coop : 'No farms org/assoc/coop' }}</p>
                                                                      </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Home Address:</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0">{{$personalinformation->barangay . ', ' . $personalinformation->agri_district . ', ' . $personalinformation->city }}</p>
                                                                      </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Sex:</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0">{{ $personalinformation->sex }}</p>
                                                                      </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Civil Status:</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0">{{$personalinformation->civil_status}}</p>
                                                                      </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Religion:</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0">{{$personalinformation->religion}}</p>
                                                                      </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Date iof Birth:</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0">{{$personalinformation->date_of_birth}}</p>
                                                                      </div>
                                                                    </div>
                                                                                 
                                                                      </div>
                                                                   </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                        <div class="title btn btn-success btn-outline btn-lg">Farm Profile </div>
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                                <div class="panel-body">
                                                                  <br>
                                                                  <div class="row mb-3">
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Tenurial Status:</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0">{{ $personalinformation->tenurial_status }}</p>
                                                                      </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Farm Address:</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0">{{ $personalinformation->rice_farm_address . ', ' . $personalinformation->agri_district . ', ' . $personalinformation->city }}</p>
                                                                      </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Years as Farmers:</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0">{{ $personalinformation->no_of_years_as_farmers }}</p>
                                                                      </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Land Title:</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0">{{$personalinformation->land_title_no}}</p>
                                                                      </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Lot No.:</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0">{{$personalinformation->lot_no}}</p>
                                                                      </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                      <div class="col-sm-3">
                                                                        <p class="mb-0">Total Physical area (HAS):</p>
                                                                      </div>
                                                                      <div class="col-sm-9">
                                                                        <p class="text-muted mb-0">{{$personalinformation->total_physical_area_has}}</p>
                                                                      </div>
                                                                    </div>
                                                                    <hr>
                                                                      <div class="row">
                                                                        <div class="col-sm-3">
                                                                          <p class="mb-0">Rice Area Cultivated (HAS):</p>
                                                                        </div>
                                                                        <div class="col-sm-9">
                                                                          <p class="text-muted mb-0">{{$personalinformation->rice_area_cultivated_has}}</p>
                                                                        </div>
                                                                      </div>
                                                                    
                                                                      <hr>
                                                                      <div class="row">
                                                                        <div class="col-sm-3">
                                                                          <p class="mb-0">Area Prone To:</p>
                                                                        </div>
                                                                        <div class="col-sm-9">
                                                                          <p class="text-muted mb-0">{{$personalinformation->area_prone_to}}</p>
                                                                        </div>
                                                                      </div>
                                                                      <hr>
                                                                      <div class="row">
                                                                        <div class="col-sm-3">
                                                                          <p class="mb-0">Ecosystem:</p>
                                                                        </div>
                                                                        <div class="col-sm-9">
                                                                          <p class="text-muted mb-0">{{$personalinformation->ecosystem}}</p>
                                                                        </div>
                                                                      </div>
                                                                      <hr>
                                                                      <div class="row">
                                                                        <div class="col-sm-3">
                                                                          <p class="mb-0">Rice Variety:</p>
                                                                        </div>
                                                                        <div class="col-sm-9">
                                                                          <p class="text-muted mb-0"> @if(strtoupper($personalinformation->type_rice_variety) === 'N/A')
                                                                            @if(strtoupper($personalinformation->prefered_variety) === 'N/A')
                                                                                N/A
                                                                            @else
                                                                                {{ $personalinformation->prefered_variety }}
                                                                            @endif
                                                                        @else
                                                                            {{ $personalinformation->type_rice_variety }}
                                                                        @endif</p>
                                                                        </div>
                                                                      </div>
                                                                        <hr>
                                                                        <div class="row">
                                                                          <div class="col-sm-3">
                                                                            <p class="mb-0">Yield(tons/has):</p>
                                                                          </div>
                                                                          <div class="col-sm-9">
                                                                            <p class="text-muted mb-0">{{$personalinformation->yield_kg_ha}}</p>
                                                                          </div>
                                                                        </div>
                                                                        <hr>
                                                                     
                                                                            
                                                                                  <!-- Add more form fields as needed -->
                                                                              </div>
                                                                             
                                                               
                                                                                  <!-- Add more form fields as needed -->
                                                                              </div>
                                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                          <div class="panel-heading" role="tab" id="headingthree">
                                                              <h4 class="panel-title">
                                                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsethree" aria-expanded="" aria-controls="collapsethree">
                                                                      <div class="title btn btn-success btn-outline btn-lg">Fixed Cost</div>
                                                                  </a>
                                                              </h4>
                                                          </div>
                                                          <div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingthree">
                                                              <div class="panel-body">
                                                                <br>
                                                                <div class="row mb-3">
                                                                                
                                                                        <div class="row">
                                                                          <div class="col-sm-3">
                                                                            <p class="mb-0">Particular:</p>
                                                                          </div>
                                                                          <div class="col-sm-9">
                                                                            <p class="text-muted mb-0">{{ $personalinformation->particular }}</p>
                                                                          </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="row">
                                                                          <div class="col-sm-3">
                                                                            <p class="mb-0">No. of has:</p>
                                                                          </div>
                                                                          <div class="col-sm-9">
                                                                            <p class="text-muted mb-0">{{ $personalinformation->no_of_ha }}</p>
                                                                          </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="row">
                                                                          <div class="col-sm-3">
                                                                            <p class="mb-0">Cost/Has:</p>
                                                                          </div>
                                                                          <div class="col-sm-9">
                                                                            <p class="text-muted mb-0">{{$personalinformation->cost_per_ha}}</p>
                                                                          </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="row">
                                                                          <div class="col-sm-3">
                                                                            <p class="mb-0">Total Amount:</p>
                                                                          </div>
                                                                          <div class="col-sm-9">
                                                                            <p class="text-muted mb-0">{{$personalinformation->total_amount}}</p>
                                                                          </div>
                                                                        </div>
                                                                       
                                                                      
                                                            
                                                                                <!-- Add more form fields as needed -->
                                                                            </div>
                                                                                                                                </div>
                                                          </div>
                                                          
                                                      </div>

                                                      <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingfour">
                                                            <h4 class="panel-title">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="" aria-controls="collapsefour">
                                                                    <div class="title btn btn-success btn-outline btn-lg">Machineries Used</div>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapsefour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingfour">
                                                            <div class="panel-body">
                                                              <br>
                                                           
                                                                <div class="col">
                                                                 
                                                                      <label for="full_name">Plowing</label></label>
                                                              </div>
                                                              {{-- plowing --}}
                                                              <div class="row mb-3">
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Machineries Used (Plowing):</p>
                                                                </div>
                                                                <br>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{ $personalinformation->plowing_machineries_used }}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Ownership (Plowing):</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{ $personalinformation->plo_ownership_status }}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">No of Plowing:</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{$personalinformation->no_of_plowing}}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Cost/Plowing:</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{$personalinformation->cost_per_plowing}}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Plowing Cost:</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{$personalinformation->plowing_cost}}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                         
                                                              <br>
                                                           
                                                              <div class="col">
                                                               
                                                                    <label for="full_name"> Harrowing</label>
                                                            </div>

                                                            {{-- harrowing --}}
                                                            <div class="row mb-3">
                                                            <div class="row">
                                                              <div class="col-sm-3">
                                                                <p class="mb-0">Machineries Used (Harrowing):</p>
                                                              </div>
                                                              <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{ $personalinformation->harrowing_machineries_used }}</p>
                                                              </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                              <div class="col-sm-3">
                                                                <p class="mb-0">Ownership (Harrowing):</p>
                                                              </div>
                                                              <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{ $personalinformation->plo_ownership_status }}</p>
                                                              </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                              <div class="col-sm-3">
                                                                <p class="mb-0">No of Harrowing:</p>
                                                              </div>
                                                              <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{$personalinformation->no_of_harrowing}}</p>
                                                              </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                              <div class="col-sm-3">
                                                                <p class="mb-0">Cost/Plowing:</p>
                                                              </div>
                                                              <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{$personalinformation->cost_per_harrowing}}</p>
                                                              </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                              <div class="col-sm-3">
                                                                <p class="mb-0">Harrowing Cost:</p>
                                                              </div>
                                                              <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{$personalinformation->harrowing_cost}}</p>
                                                              </div>
                                                            </div>
                                                            <hr> 
                                                            <br>
                                                           
                                                            <div class="col">
                                                             
                                                                  <label for="full_name"> Harvesting</label>
                                                          </div>
                                                             {{-- harvesting --}}
                                                             <div class="row mb-3">
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Machineries Used (Harvest):</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{ $personalinformation->harvesting_machineries_used }}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Ownership (harvest):</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{ $personalinformation->harvest_ownership_status }}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Harvest Cost:</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{$personalinformation->harvesting_cost}}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <br>
                                                           
                                                            <div class="col">
                                                             
                                                                  <label for="full_name"> PostHarvest</label>
                                                          </div>
                                                             {{-- harvesting --}}
                                                             <div class="row mb-3">
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Machineries Used (PostHarvest):</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{ $personalinformation->postharvest_machineries_used }}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Ownership (Postharvest):</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{ $personalinformation->postharv_ownership_status}}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">PostHarvest Cost:</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{$personalinformation->post_harvest_cost}}</p>
                                                                </div>
                                                              </div>
                                                            
                                                          
                                                                              <!-- Add more form fields as needed -->
                                                                          </div>
                                                                                                                              </div>
                                                        </div>
                                                        
                                                    </div>
                                                    </div>
                                                  </div>
                                                   

                                                </div>
                                                <div class="panel panel-default">
                                                  <div class="panel-heading" role="tab" id="HeadingFive">
                                                      <h4 class="panel-title">
                                                          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="" aria-controls="collapsefive">
                                                              <div class="title btn btn-success btn-outline btn-lg">Variable Cost</div>
                                                          </a>
                                                      </h4>
                                                  </div>
                                                  <div id="collapsefive" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="HeadingFive">
                                                      <div class="panel-body">
                                                        <br>
                                                        <div class="row mb-3">
                                                                        
                                                                <div class="row">
                                                                  <div class="col-sm-3">
                                                                    <p class="mb-0">Seed Cost:</p>
                                                                  </div>
                                                                  <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">{{ $personalinformation->total_seed_cost }}</p>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                  <div class="col-sm-3">
                                                                    <p class="mb-0">Labor Cost:</p>
                                                                  </div>
                                                                  <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">{{ $personalinformation->total_labor_cost }}</p>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                  <div class="col-sm-3">
                                                                    <p class="mb-0">Fertilizer Cost:</p>
                                                                  </div>
                                                                  <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">{{$personalinformation->total_cost_fertilizers}}</p>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                  <div class="col-sm-3">
                                                                    <p class="mb-0">Pesticide Cost:</p>
                                                                  </div>
                                                                  <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">{{$personalinformation->total_cost_pesticides}}</p>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                  <div class="col-sm-3">
                                                                    <p class="mb-0">Transport Cost:</p>
                                                                  </div>
                                                                  <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">{{$personalinformation->total_transport_per_deliverycost}}</p>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                  <div class="col-sm-3">
                                                                    <p class="mb-0">Total Machinery Fuel Cost:</p>
                                                                  </div>
                                                                  <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">{{$personalinformation->total_machinery_fuel_cost}}</p>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                  <div class="col-sm-3">
                                                                    <p class="mb-0">Total Variable Cost:</p>
                                                                  </div>
                                                                  <div class="col-sm-9">
                                                                    <p class="text-muted mb-0">{{$personalinformation->total_variable_cost}}</p>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                               
                                                              
                                                    
                                                                        <!-- Add more form fields as needed -->
                                                                    </div>
                                                                                                                        </div>
                                                  </div>
                                                  
                                              </div>

                                              <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingsix">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="" aria-controls="collapsesix">
                                                            <div class="title btn btn-success btn-outline btn-lg">Last Production</div>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapsesix" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingsix">
                                                    <div class="panel-body">
                                                      <br>
                                                      <div class="row mb-3">
                                                                      
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Seed Source:</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{ $personalinformation->seed_source }}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Area planted:</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{ $personalinformation->area_planted }}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Yield (tons/kg):</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{$personalinformation->yield_tons_per_kg}}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Unit Price Palay/kg:</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{$personalinformation->unit_price_palay_per_kg}}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Unit Price Rice/kg:</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{$personalinformation->unit_price_rice_per_kg}}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Sold To:</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{$personalinformation->sold_to}}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Gross Income (Palay):</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{$personalinformation->gross_income_palay}}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                              <div class="row">
                                                                <div class="col-sm-3">
                                                                  <p class="mb-0">Gross Income (Rice):</p>
                                                                </div> 
                                                                <div class="col-sm-9">
                                                                  <p class="text-muted mb-0">{{$personalinformation->gross_income_rice}}</p>
                                                                </div>
                                                              </div>
                                                              <hr>
                                                                     
                                                                  </div>
                                                                                                                      </div>
                                                </div>
                                                
                                            </div>
                                            </form>
                                                                 
                                        </div>
                                        {{-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                
    {{-- </div>
</div> --}}
    </div>

   

    <!-- Fixed Cost Table Section -->
    <div id="personal_info_section" style="display: none;">
       <br>
     


  <div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow-1">
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">No. of Farmers</h6>
                {{-- <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div> --}}
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ $totalfarms }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+3.3%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                     <!-- Add a canvas element for the bar chart -->
                <canvas id="farmersBarChart" width="200" height="200"></canvas>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Area PLanted</h6>
                {{-- <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div> --}}
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($totalAreaPlantedAyala, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-danger">
                      <span>-2.8%</span>
                      <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Area Yield(Kg/Ha)</h6>
                {{-- <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div> --}}
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($totalAreaYieldAyala, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+2.8%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- row -->
  

  <div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow-1">
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total  Fixed Cost</h6>
                {{-- <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div> --}}
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">PHP {{ number_format($totalFixedCostAyala, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+3.3%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Machineries Used</h6>
                {{-- <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div> --}}
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">PHP {{ number_format($totalMachineriesUsedAyala, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-danger">
                      <span>-2.8%</span>
                      <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Variable Cost</h6>
                {{-- <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div> --}}
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-1">PHP {{ number_format($totalVariableCostAyala, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+2.8%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
              
            </div>
          </div>
        </div>

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Average  Yield  Per Area Planted (Kg/Ha)</h6>
                  {{-- <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div> --}}
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>
                    <h3 class="mb-1">{{ number_format($yieldPerAreaPlanted, 2) }}</h3>
                    <div class="d-flex align-items-baseline">
                      {{-- <p class="text-success">
                        <span>+2.8%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                      </p> --}}
                    </div>
                  </div>
                  {{-- <div class="col-6 col-md-12 col-xl-7">
                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                  </div> --}}
                </div>
                
              </div>
            </div>
          </div>

          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Average Cost Per Area Planted(Ha)</h6>
                  {{-- <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div> --}}
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>
                    <h3 class="mb-1">PHP {{ number_format($averageCostPerAreaPlanted, 2) }}</h3>
                    <div class="d-flex align-items-baseline">
                      {{-- <p class="text-success">
                        <span>+2.8%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                      </p> --}}
                    </div>
                  </div>
                  {{-- <div class="col-6 col-md-12 col-xl-7">
                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                  </div> --}}
                </div>
                
              </div>
            </div>
          </div>

          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Rice Farmers Productivity </h6>
                  {{-- <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div> --}}
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>
                    <h3 class="mb-1">{{ number_format($riceProductivityAyala * 100, 2) }}%</h3>
                    <div class="d-flex align-items-baseline">
                      {{-- <p class="text-success">
                        <span>+2.8%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                      </p> --}}
                    </div>
                  </div>
                  {{-- <div class="col-6 col-md-12 col-xl-7">
                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                  </div> --}}
                </div>
                
              </div>
            </div>
          </div>

          
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Owner </h6>
                  {{-- <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div> --}}
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>
                    <h3 class="mb-1">{{ $countOwner }}</h3>
                    <div class="d-flex align-items-baseline">
                      {{-- <p class="text-success">
                        <span>+2.8%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                      </p> --}}
                    </div>
                  </div>
                  {{-- <div class="col-6 col-md-12 col-xl-7">
                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                  </div> --}}
                </div>
                
              </div>
            </div>
          </div>

          
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Tenant</h6>
                  {{-- <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div> --}}
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>
                    <h3 class="mb-1">{{ $countOwnerTenants }}</h3>
                    <div class="d-flex align-items-baseline">
                      {{-- <p class="text-success">
                        <span>+2.8%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                      </p> --}}
                    </div>
                  </div>
                  {{-- <div class="col-6 col-md-12 col-xl-7">
                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                  </div> --}}
                </div>
                
              </div>
            </div>
          </div>
          
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Tiller Tenants </h6>
                  {{-- <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div> --}}
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>
                    <h3 class="mb-1">{{ $countTillerTenantTenants }}</h3>
                    <div class="d-flex align-items-baseline">
                      {{-- <p class="text-success">
                        <span>+2.8%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                      </p> --}}
                    </div>
                  </div>
                  {{-- <div class="col-6 col-md-12 col-xl-7">
                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                  </div> --}}
                </div>
                
              </div>
            </div>
          </div>
          
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Tiller</h6>
                  {{-- <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div> --}}
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>
                    <h3 class="mb-1">{{ $countTillerTenants }}</h3>
                    <div class="d-flex align-items-baseline">
                      {{-- <p class="text-success">
                        <span>+2.8%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                      </p> --}}
                    </div>
                  </div>
                  {{-- <div class="col-6 col-md-12 col-xl-7">
                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                  </div> --}}
                </div>
                
              </div>
            </div>
          </div>
          
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Lease </h6>
                  {{-- <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div> --}}
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>
                    <h3 class="mb-1">{{ $countLeaseTenants }}</h3>
                    <div class="d-flex align-items-baseline">
                      {{-- <p class="text-success">
                        <span>+2.8%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                      </p> --}}
                    </div>
                  </div>
                  {{-- <div class="col-6 col-md-12 col-xl-7">
                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                  </div> --}}
                </div>
                
              </div>
            </div>
          </div>

          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Total Farmers Org/Assoc/Coop</h6>
                  {{-- <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div> --}}
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5"><br>
                    <h3 class="mb-1">{{ $countorg }}</h3>
                    <div class="d-flex align-items-baseline">
                      {{-- <p class="text-success">
                        <span>+2.8%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                      </p> --}}
                    </div>
                  </div>
                  {{-- <div class="col-6 col-md-12 col-xl-7">
                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                  </div> --}}
                </div>
                
              </div>
            </div>
          </div>
      </div>
    </div>
  </div> <!-- row -->




      </div>
    </div>
</div>


    
    </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.jsdelivr.net/npm/@sgratzl/chartjs-chart-geo@latest"></script>
    
<script>
function showSection(sectionName) {
 // Hide all sections
 document.querySelectorAll('[id$="_section"]').forEach(section => {
        section.style.display = 'none';
    });

    // Show the selected section
    var selectedSection = document.getElementById(sectionName + '_section');
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}

// Display the "fixed_cost_section" first
showSection('personal_info');

</script>


<script>
function printTableContent() {
    // Function to remove the last column from the table
    function removeLastColumnFromTable(table) {
        // Get all rows in the table body
        var rows = table.querySelectorAll('tbody tr');
        // Iterate over each row and remove the last cell
        rows.forEach(function(row) {
            var lastCell = row.lastElementChild;
            row.removeChild(lastCell);
        });

        // Get the table header row
        var headerRow = table.querySelector('thead tr');
        // Remove the last cell from the header row
        var lastHeaderCell = headerRow.lastElementChild;
        headerRow.removeChild(lastHeaderCell);
    }

    // Get the current date and time
    var currentDate = new Date();
    var formattedDate = currentDate.toLocaleDateString();
    var formattedTime = currentDate.toLocaleTimeString();

    // Get the table element
    var table = document.getElementById('printTable');
    // Remove the last column from the table
    removeLastColumnFromTable(table);

    // Content for the print window
    var description = "This table displays the Ayala Farmers Information.";
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Print Table</title>');

    // Add external CSS stylesheets
    var stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
    stylesheets.forEach(function(sheet) {
        printWindow.document.write('<link rel="stylesheet" href="' + sheet.href + '">');
    });

    // Write description, date, time, and table content
    printWindow.document.write('</head><body><p>' + description + '</p>');
    printWindow.document.write('<p>Printed on: ' + formattedDate + ' at ' + formattedTime + '</p>');
    printWindow.document.write(table.outerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    // Wait for a short time for stylesheets to load
    setTimeout(function() {
        printWindow.print();
        printWindow.close();
    }, 100); //  // Adjust the timeout value as needed
}


// // Function to print the personal_info_section content and its design
// function printPersonalInfo() {
//     // Get the container element containing the personal_info_section content
//     var container = document.getElementById('personal_info_section');

//     // Create a new window
//     var printWindow = window.open('', '_blank');

//     // Write the HTML content to the new window
//     printWindow.document.write('<html><head><title>Print Personal Info</title>');

//     // Get the CSS styles of the container
//     var containerStyles = document.createElement('style');
//     containerStyles.innerHTML = getComputedStyle(container).cssText;

//     // Append the CSS styles to the new window
//     printWindow.document.head.appendChild(containerStyles);

//     // Write the report description above the content
//     printWindow.document.write(`
//         </head>
//         <body>
//             <div class="container-fluid">
//                 <h2>Ayala Farmers Report</h2>
//                 <p>This report contains Ayala Farmers Report.</p>
//             </div>
//             <hr>
//     `);

//     // Write the personal_info_section content to the new window with space between each data item
//     printWindow.document.write(`
//             <div class="container-fluid">
//                 <div class="row">
//                     <!-- Start of the modified cards -->
//                     ${container.innerHTML.split('</div>').join('</div><div class="mb-4"></div>')}
//                     <!-- End of the modified cards -->
//                 </div>
//             </div>
//         </body>
//     </html>
//     `);

//     // Close the new window
//     printWindow.document.close();

//     // Print the content in the new window
//     printWindow.print();

//     // Close the new window after printing
//     printWindow.close();
// }

function printPersonalInfo() {
    // Apply print styles
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '{{ asset('css/print.css') }}';
    document.head.appendChild(link);

    // Get current date
    // Get the current date and time
    var currentDate = new Date();
    var formattedDate = currentDate.toLocaleDateString();
    var formattedTime = currentDate.toLocaleTimeString();

    // Create a new element to hold the title and the current date
    const titleElement = document.createElement('div');
    titleElement.textContent = 'Ayala Farmers Report';
    titleElement.style.fontWeight = 'bold'; // Adjust styling as needed

    const currentDateElement = document.createElement('div');
    currentDateElement.textContent = 'Printed on: ' + currentDate;
    currentDateElement.style.marginBottom = '20px'; // Adjust styling as needed

    // Insert the title and the current date elements into the document body
    document.body.insertBefore(titleElement, document.body.firstChild);
    document.body.insertBefore(currentDateElement, titleElement.nextSibling);

    // Hide the navbar
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.style.display = 'none';
    }
    document.querySelectorAll('.hide-on-print').forEach(button => {
            button.style.display = 'none';
        });
    // Hide other elements not to be printed
    const elementsToHide = document.querySelectorAll('.exclude-from-print');
    elementsToHide.forEach(element => {
        element.style.display = 'none';
    });

    // Insert space after "Average Cost per Area Planted"
    insertSpaceForPrinting();

    // Print only the page content
    window.print();

    // Show the navbar after printing
    if (navbar) {
        navbar.style.display = '';
    }

    // Show the hidden elements after printing
    elementsToHide.forEach(element => {
        element.style.display = '';
    });
    document.querySelectorAll('.hide-on-print').forEach(button => {
            button.style.display = 'block';
        });

    // Remove the title and the current date elements after printing
    titleElement.remove();
    currentDateElement.remove();
}

// Function to insert a space after "Average Cost per Area Planted" when printing
function insertSpaceForPrinting() {
    const averageCostSection = document.getElementById('average-cost-section'); // Adjust the ID accordingly
    if (averageCostSection) {
        const spaceDiv = document.createElement('div');
        spaceDiv.style.marginBottom = '1000px'; // Adjust the margin as needed
        averageCostSection.parentNode.insertBefore(spaceDiv, averageCostSection.nextSibling);
    }
}

</script>
@endsection
