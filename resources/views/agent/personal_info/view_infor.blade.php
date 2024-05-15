
@extends('agent.agent_Dashboard')
@section('agent') 


@extends('layouts._footer-script')
@extends('layouts._head')



<div class="page-content">
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    
                    <h2>Rice Farmers Data</h2>
                </div>
                <br>
                @if (session()->has('message'))
                <div class="alert alert-success" id="success-alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
              {{session()->get('message')}}
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
                    <!-- Your card content here -->
                    <div class="tabs">
                        <input type="radio" name="tabs" id="personainfo" checked="checked">
                        <label for="personainfo">Personal Info</label>
                        <div class="tab">
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5 for="personainfo">I.Personal Information</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                               <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead >
                                        <tr >
                    
                                            <th>Farmer No.</th>
                                            <th>Farmer Name</th>
                                           
                                            <th>Home Address</th>
                                            <th>Sex</th>
                                            <th>Religion</th>
                                            <th>date_of_birth</th>
                                            <th>place_of_birth</th>
                                            <th>contact no.</th>
                                            <th>civil_status</th>
                                            <th>name of legal spuse</th>
                                            <th>No of Children</th>
                                            <th>mothers_maiden_name</th>
                                            <th>highest_formal_education</th>
                                            <th>person_with_disability</th>
                                            <th>pwd_id_no</th>
                                            <th>government_issued_id</th>
                                            <th>id_type</th>
                                            <th>gov_id_no</th>
                                            <th>member_ofany_farmers_ass_org_coop</th>
                                            <th>nameof_farmers_ass_org_coop</th>
                                            <th>name_contact_person</th>
                                            <th>cp_tel_no</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($personalinfos->count() > 0)
                                    @foreach($personalinfos as $personalinformation)      
                                <tr class="table-light">
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{  $personalinformation->id }}</td>
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
                                
                                    $full_name .= ' ' . $last_name;
                                
                                    // Check if extension_name is not empty and not equal to "N/A"
                                    if (!empty($extension_name) && $extension_name !== 'N/A') {
                                        $full_name .= ' ' . $extension_name;
                                    }
                                
                                    // Output the full name
                                    echo htmlspecialchars($full_name);
                                    ?>
                                </td>
                                <td>
                                @if ($personalinformation->barangay || $personalinformation->agri_district || $personalinformation->city)
                                    {{ $personalinformation->barangay ?? 'N/A' }}, {{ $personalinformation->agri_district ?? 'N/A' }}, {{ $personalinformation->city ?? 'N/A' }}
                                @else
                            
                                @endif
                            </td>
                            <td>
                                @if ($personalinformation->sex && $personalinformation->sex != 'N/A')
                                    {{ $personalinformation->sex }}
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                @if ($personalinformation->religion && $personalinformation->religion != 'N/A')
                                    {{ $personalinformation->religion }}
                                @else
                                
                                @endif
                            </td>
                            <td>
                            @if ($personalinformation->date_of_birth && $personalinformation->date_of_birth != 'N/A')
                                {{ $personalinformation->date_of_birth }}
                            @else
                      
                                    @endif
                                </td>
                                <td>
                                    @if ($personalinformation->place_of_birth && $personalinformation->place_of_birth != 'N/A')
                                        {{ $personalinformation->place_of_birth }}
                                    @else
                                    
                                    @endif
                                </td>

                                <td>
                                    @if ($personalinformation->contact_no && strtolower($personalinformation->contact_no) != 'n/a')
                                        {{ $personalinformation->contact_no }}
                                    @else
                                    
                                    @endif
                                </td>
                                <td>
                                @if ($personalinformation->civil_status && strtolower($personalinformation->civil_status) != 'n/a')
                                    {{ $personalinformation->civil_status }}
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                @if ($personalinformation->name_legal_spouse && strtolower($personalinformation->name_legal_spouse) != 'n/a')
                                    {{ $personalinformation->name_legal_spouse }}
                                @else
                                
                                @endif
                            </td>
                            <td>
                            @if ($personalinformation->no_of_children && strtolower($personalinformation->no_of_children) != 'n/a')
                                {{ $personalinformation->no_of_children }}
                            @else
                                
                            @endif
                        </td>
                        <td>
                            @if ($personalinformation->mothers_maiden_name && strtolower($personalinformation->mothers_maiden_name) != 'n/a')
                                {{ $personalinformation->mothers_maiden_name }}
                            @else
                            
                            @endif
                        </td>
                        <td>
                            @if ($personalinformation->highest_formal_education && strtolower($personalinformation->highest_formal_education) != 'n/a')
                                {{ $personalinformation->highest_formal_education }}
                            @else
                            
                            @endif
                        </td>
                        <td>
                        @if ($personalinformation->person_with_disability && strtolower($personalinformation->person_with_disability) != 'n/a')
                            {{ $personalinformation->person_with_disability }}
                        @else
                            
                        @endif
                    </td>

                    <td>
                        @if ($personalinformation->government_issued_id && strtolower($personalinformation->government_issued_id) != 'n/a')
                            {{ $personalinformation->government_issued_id }}
                        @else
                        
                        @endif
                    </td>
                    <td>
                    @if ($personalinformation->government_issued_id && strtolower($personalinformation->government_issued_id) != 'n/a')
                        {{ $personalinformation->government_issued_id }}
                    @else
                        
                    @endif
                    </td>
                    <td>
                    @if ($personalinformation->id_type && strtolower($personalinformation->id_type) != 'n/a')
                        {{ $personalinformation->id_type }}
                    @else
                    
                    @endif
                    </td>
                    <td>
                    @if ($personalinformation->gov_id_no && strtolower($personalinformation->gov_id_no) != 'n/a')
                        {{ $personalinformation->gov_id_no }}
                    @else
                    
                    @endif
                    </td>
                    <td>
                    @if ($personalinformation->member_ofany_farmers_ass_org_coop && strtolower($personalinformation->member_ofany_farmers_ass_org_coop) != 'n/a')
                        {{ $personalinformation->member_ofany_farmers_ass_org_coop }}
                    @else
                    
                    @endif
                    </td>

                    <td>
                    @if ($personalinformation->nameof_farmers_ass_org_coop && strtolower($personalinformation->nameof_farmers_ass_org_coop) != 'n/a')
                        {{ $personalinformation->nameof_farmers_ass_org_coop }}
                    @else
                    
                    @endif
                    </td>

                    <td>
                    @if ($personalinformation->name_contact_person && strtolower($personalinformation->name_contact_person) != 'n/a')
                        {{ $personalinformation->name_contact_person }}
                    @else
                    
                    @endif
                    </td>
                    <td>
                    @if ($personalinformation->cp_tel_no && strtolower($personalinformation->cp_tel_no) != 'n/a')
                        {{ $personalinformation->cp_tel_no }}
                    @else
                    
                    @endif
                    </td>
                       <td>
                          
                            <a href="{{route('agent.personal_info.update_records',  $personalinformation->id)}}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
               
                            <form  action="{{ route('personalinfo.delete',  $personalinformation->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                               {{ csrf_field()}}
                               <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                           </form>
                          
                       </td>
                   </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Seed Cost is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                
                                <!-- Pagination links -->
                                <ul class="pagination">
                                    <li><a href="{{ $personalinfos->previousPageUrl() }}">Previous</a></li>
                                    @foreach ($personalinfos->getUrlRange(1,$personalinfos->lastPage()) as $page => $url)
                                        <li class="{{ $page == $personalinfos->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ $personalinfos->nextPageUrl() }}">Next</a></li>
                                </ul>

                            </div>
                        </div>


                        {{-- farm profile page--}}
                        <input type="radio" name="tabs" id="farm" checked="checked">
                        <label for="farm">Farm</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5>II.Farm Profile</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr >
                    
                                            <th>Farm no.</th>
                                            <th>Farmer Name</th>
                                            <th>Agri-District</th>
                                            <th>tenurial status</th>
                                            <th>rice farm address</th>
                                            <th>years as farmer</th>
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
                                          
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($farmProfiles->count() > 0)
                                    @foreach($farmProfiles as $farmprofile)      
                                <tr class="table-light">
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{  $farmprofile->id }}</td>
                                    <td class=" d-md-table-cell">
                                    <?php
                                    // Define variables
                                    $first_name = $farmprofile->personalinformation->first_name;
                                    $middle_name = $farmprofile->personalinformation->middle_name;
                                    $last_name = $farmprofile->personalinformation->last_name;
                                    $extension_name = $farmprofile->personalinformation->extension_name;
                                
                                    // Construct the full name
                                    $full_name = $first_name;
                                
                                    // Check and append the middle name
                                    if (!empty($middle_name) && $middle_name !== 'N/A') {
                                        $full_name .= ' ' . $middle_name;
                                    }
                                
                                    $full_name .= ' ' . $last_name;
                                
                                    // Check if extension_name is not empty and not equal to "N/A"
                                    if (!empty($extension_name) && $extension_name !== 'N/A') {
                                        $full_name .= ' ' . $extension_name;
                                    }
                                
                                    // Output the full name
                                    echo htmlspecialchars($full_name);
                                    ?>
                                </td>
                               
                            <td>
                                @if ($farmprofile->agriDistrict->district && $farmprofile->agriDistrict->district != 'N/A')
                                    {{ $farmprofile->agriDistrict->district }}
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                @if ($farmprofile->tenurial_status && $farmprofile->tenurial_status != 'N/A')
                                    {{ $farmprofile->tenurial_status }}
                                @else
                                
                                @endif
                            </td>
                            <td>
                            @if ($farmprofile->rice_farm_address && $farmprofile->rice_farm_address != 'N/A')
                                {{ $farmprofile->rice_farm_address }}
                            @else
                      
                                    @endif
                                </td>
                                <td>
                                    @if ($farmprofile->no_of_years_as_farmers && $farmprofile->no_of_years_as_farmers != 'N/A')
                                        {{ $farmprofile->no_of_years_as_farmers }}
                                    @else
                                    
                                    @endif
                                </td>

                                <td>
                                    @if ($farmprofile->gps_longitude && strtolower($farmprofile->gps_longitude) != 'n/a')
                                        {{ $farmprofile->gps_longitude }}
                                    @else
                                    
                                    @endif
                                </td>
                                <td>
                                @if ($farmprofile->gps_latitude && strtolower($farmprofile->gps_latitude) != 'n/a')
                                    {{ $farmprofile->gps_latitude }}
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                @if ($farmprofile->total_physical_area_has && strtolower($farmprofile->total_physical_area_has) != 'n/a')
                                    {{ number_format($farmprofile->total_physical_area_has,2) }}
                                @else
                                
                                @endif
                            </td>
                            <td>
                                @if ($farmprofile->rice_area_cultivated_has && strtolower($farmprofile->rice_area_cultivated_has) != 'n/a')
                                    {{ number_format($farmprofile->rice_area_cultivated_has,2) }}
                                @else
                                
                                @endif
                            </td>
                        <td>
                            @if ($farmprofile->land_title_no && strtolower($farmprofile->land_title_no) != 'n/a')
                                {{ $farmprofile->land_title_no }}
                            @else
                            
                            @endif
                        </td>
                        <td>
                            @if ($farmprofile->lot_no && strtolower($farmprofile->lot_no) != 'n/a')
                                {{ $farmprofile->lot_no }}
                            @else
                            
                            @endif
                        </td>
                        <td>
                        @if ($farmprofile->area_prone_to && strtolower($farmprofile->area_prone_to) != 'n/a')
                            {{ $farmprofile->area_prone_to }}
                        @else
                            
                        @endif
                    </td>

                    <td>
                        @if ($farmprofile->ecosystem && strtolower($farmprofile->ecosystem) != 'n/a')
                            {{ $farmprofile->ecosystem }}
                        @else
                        
                        @endif
                    </td>
                    <td>
                    @if ($farmprofile->type_rice_variety && strtolower($farmprofile->type_rice_variety) != 'n/a')
                        {{ $farmprofile->type_rice_variety }}
                    @else
                        
                    @endif
                    </td>
                    <td>
                    @if ($farmprofile->prefered_variety && strtolower($farmprofile->prefered_variety) != 'n/a')
                        {{ $farmprofile->prefered_variety }}
                    @else
                    
                    @endif
                    </td>
                    <td>
                    @if ($farmprofile->plant_schedule_wetseason && strtolower($farmprofile->plant_schedule_wetseason) != 'n/a')
                        {{ $farmprofile->plant_schedule_wetseason }}
                    @else
                    
                    @endif
                    </td>
                    <td>
                    @if ($farmprofile->plant_schedule_dryseason && strtolower($farmprofile->plant_schedule_dryseason) != 'n/a')
                        {{ $farmprofile->plant_schedule_dryseason }}
                    @else
                    
                    @endif
                    </td>

                    <td>
                    @if ($farmprofile->no_of_cropping_yr && strtolower($farmprofile->no_of_cropping_yr) != 'n/a')
                        {{ $farmprofile->no_of_cropping_yr }}
                    @else
                    
                    @endif
                    </td>

                    <td>
                    @if ($farmprofile->yield_kg_ha && strtolower($farmprofile->yield_kg_ha) != 'n/a')
                        {{ $farmprofile->yield_kg_ha }}
                    @else
                    
                    @endif
                    </td>
                    <td>
                    @if ($farmprofile->rsba_register && strtolower($farmprofile->rsba_register) != 'n/a')
                        {{ $farmprofile->rsba_register }}
                    @else
                    
                    @endif
                    </td>
                    <td>{{ $farmprofile->pcic_insured }}</td>
                    <td>{{ $farmprofile->source_of_capital}}</td>
                    <td>{{ $farmprofile->remarks_recommendation}}</td>
                    <td>{{ $farmprofile->oca_district_office}}</td>
                    <td>{{ $farmprofile->name_technicians}}</td>
                    <td>{{ $farmprofile->date_interview}}</td>
                    
                       <td>

                                                     
                        <a href="{{route('agent.farmprofile.farm_update', $farmprofile->id)}}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                        <form  action="{{ route('agent.farmprofile.delete', $farmprofile->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                           {{-- {{ csrf_field()}} --}}@csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                       </form>

                       </td>
                   </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Farm Profile Data is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <!-- Pagination links -->
                                <ul class="pagination">
                                    <li><a href="{{ $farmProfiles->previousPageUrl() }}">Previous</a></li>
                                    @foreach ($farmProfiles->getUrlRange(1,$farmProfiles->lastPage()) as $page => $url)
                                        <li class="{{ $page == $farmProfiles->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ $farmProfiles->nextPageUrl() }}">Next</a></li>
                                </ul>
                            </div>
                        </div>

                        {{-- fertilizer --}}
                        {{-- labor --}}
                        <input type="radio" name="tabs" id="Fixed" checked="checked">
                        <label for="Fixed">Fixed</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5 for="Fixed">III. Fixed Cost</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr >
                    
                                             <th>#</th>
                                            <th>Farmer Name</th>
                                            <th>Tenurial STATUS</th>
                                            <th>particular</th>
                                            <th>no_of_ha</th>
                                            <th>cost_per_ha</th>
                                            <th>total_amount</th>
                                        
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($fixedcosts->count() > 0)
                                    @foreach($fixedcosts as $fixedcost)      
                                <tr class="table-light">
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{  $fixedcost->id }}</td>
                                    <td class=" d-md-table-cell">
                                    <?php
                                    // Define variables
                                    $first_name = $fixedcost->personalinformation->first_name;
                                    $middle_name = $fixedcost->personalinformation->middle_name;
                                    $last_name = $fixedcost->personalinformation->last_name;
                                    $extension_name = $fixedcost->personalinformation->extension_name;
                                
                                    // Construct the full name
                                    $full_name = $first_name;
                                
                                    // Check and append the middle name
                                    if (!empty($middle_name) && $middle_name !== 'N/A') {
                                        $full_name .= ' ' . $middle_name;
                                    }
                                
                                    $full_name .= ' ' . $last_name;
                                
                                    // Check if extension_name is not empty and not equal to "N/A"
                                    if (!empty($extension_name) && $extension_name !== 'N/A') {
                                        $full_name .= ' ' . $extension_name;
                                    }
                                
                                    // Output the full name
                                    echo htmlspecialchars($full_name);
                                    ?>
                                </td>
                                <td>
                                    @if (optional($fixedcost->farmprofile)->tenurial_status && strtolower($fixedcost->farmprofile->tenurial_status) != 'N/A')
                                        {{ $fixedcost->farmprofile->tenurial_status}}
                                    @else
                                     
                                    @endif
                                  </td>
                            <td>
                                @if ($fixedcost->particular && $fixedcost->particular != 'N/A')
                                    {{ $fixedcost->particular }}
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                @if ($fixedcost->no_of_ha && $fixedcost->no_of_ha != 'N/A')
                                    {{ $fixedcost->no_of_ha }}
                                @else
                                
                                @endif
                            </td>
                           
                                <td>
                                    @if ($fixedcost->cost_per_ha && strtolower($fixedcost->cost_per_ha) != 'n/a')
                                        {{ number_format($fixedcost->cost_per_ha,2) }}
                                    @else
                                    
                                    @endif
                                </td>
                                <td>
                                    @if ($fixedcost->total_amount && strtolower($fixedcost->total_amount) != 'n/a')
                                        {{ number_format($fixedcost->total_amount,2) }}
                                    @else
                                    
                                    @endif
                                </td>


                       <td>
                          
                        <a href="{{route('agent.fixedcost.fixed_updates', $fixedcost->id)}}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                        <form  action="{{ route('fixed_cost.delete', $fixedcost->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                       @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                       </form>
                          
                       </td>
                   </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Fixed Cost Data is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <!-- Pagination links -->
                                <ul class="pagination">
                                    <li><a href="{{ $fixedcosts->previousPageUrl() }}">Previous</a></li>
                                    @foreach ($fixedcosts->getUrlRange(1,$fixedcosts->lastPage()) as $page => $url)
                                        <li class="{{ $page == $fixedcosts->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ $fixedcosts->nextPageUrl() }}">Next</a></li>
                                </ul>
                            </div>
                        </div>

                        {{-- machineries used page  --}}
                       
                        <input type="radio" name="tabs" id="Machineries" checked="checked">
                        <label for="Machineries">Machineries</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5 for="Seed">IV. Machineries Used</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr >
                    
                                            <th>#</th>
                                            <th>Farmer Name</th>
                                            <th>Tenurial <p> Status</p></th>
                                            <th>plowing <p>machineries used</p></th>
                                            <th>plowing <p>ownership</p> <p> status</p></th>
                                            <th>no of <p>plowing</p></th>
                                            <th>plowing <p>cost</p></th>
                                            <th>harrowing <p>machineries used</p></th>
                                            <th>harro <p>ownership</p> <p> status</p></th>
                                            <th>no of <p>harrowing</p></th>
                                            <th>harrowing <p>cost</p></th>
                                            <th>harvesting <p>machineries used</p></th>
                                            <th>harvest <p>ownership</p> <p> status</p></th>
                                            <th>harvest <p>cost</p></th>
                                            <th>postharvest <p>machineries used</p></th>
                                            <th>post harvest <p>ownership</p> <p> status </p></th>
                                            <th>post harvest <p>cost</p></th>
                                            <th>total cost <p>for machineries</p></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($machineries->count() > 0)
                                    @foreach($machineries as $machineriesused)      
                                <tr class="table-light">
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{  $machineriesused->id }}</td>
                                    <td class=" d-md-table-cell">
                                    <?php
                                    // Define variables
                                    $first_name = $machineriesused->personalinformation->first_name;
                                    $middle_name = $machineriesused->personalinformation->middle_name;
                                    $last_name = $machineriesused->personalinformation->last_name;
                                    $extension_name = $machineriesused->personalinformation->extension_name;
                                
                                    // Construct the full name
                                    $full_name = $first_name;
                                
                                    // Check and append the middle name
                                    if (!empty($middle_name) && $middle_name !== 'N/A') {
                                        $full_name .= ' ' . $middle_name;
                                    }
                                
                                    $full_name .= ' ' . $last_name;
                                
                                    // Check if extension_name is not empty and not equal to "N/A"
                                    if (!empty($extension_name) && $extension_name !== 'N/A') {
                                        $full_name .= ' ' . $extension_name;
                                    }
                                
                                    // Output the full name
                                    echo htmlspecialchars($full_name);
                                    ?>
                                </td>
                                <td>
                                    @if (optional($machineriesused->farmprofile)->tenurial_status && strtolower($machineriesused->farmprofile->tenurial_status) != 'N/A')
                                        {{ $machineriesused->farmprofile->tenurial_status}}
                                    @else
                                     
                                    @endif
                                  </td>
                            <td>
                                @if ($machineriesused->plowing_machineries_used && $machineriesused->plowing_machineries_used != 'N/A')
                                    {{ $machineriesused->plowing_machineries_used }}
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                @if ($machineriesused->plo_ownership_status && $machineriesused->plo_ownership_status != 'N/A')
                                    {{ $machineriesused->plo_ownership_status }}
                                @else
                                
                                @endif
                            </td>
                            <td>
                            @if ($machineriesused->no_of_plowing && $machineriesused->no_of_plowing != 'N/A')
                                {{ $machineriesused->no_of_plowing }}
                            @else
                      
                                    @endif
                                </td>
                                <td>
                                    @if ($machineriesused->plowing_cost && $machineriesused->plowing_cost != 'N/A')
                                        {{ number_format($machineriesused->plowing_cost,2) }}
                                    @else
                                    
                                    @endif
                                </td>

                                <td>
                                    @if ($machineriesused->harrowing_machineries_used && strtolower($machineriesused->harrowing_machineries_used) != 'n/a')
                                        {{ $machineriesused->harrowing_machineries_used }}
                                    @else
                                    
                                    @endif
                                </td>
                                <td>
                                @if ($machineriesused->harro_ownership_status && strtolower($machineriesused->harro_ownership_status) != 'n/a')
                                    {{ $machineriesused->harro_ownership_status }}
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                @if ($machineriesused->no_of_harrowing && strtolower($machineriesused->no_of_harrowing) != 'n/a')
                                    {{ $machineriesused->no_of_harrowing }}
                                @else
                                
                                @endif
                            </td>
                            <td>
                            @if ($machineriesused->harrowing_cost && strtolower($machineriesused->harrowing_cost) != 'n/a')
                                {{ number_format($machineriesused->harrowing_cost,2) }}
                            @else
                                
                            @endif
                        </td>
                        <td>
                            @if ($machineriesused->harvesting_machineries_used && strtolower($machineriesused->harvesting_machineries_used) != 'n/a')
                                {{ $machineriesused->harvesting_machineries_used }}
                            @else
                            
                            @endif
                        </td>
                        <td>
                            @if ($machineriesused->harvest_ownership_status && strtolower($machineriesused->harvest_ownership_status) != 'n/a')
                                {{ $machineriesused->harvest_ownership_status }}
                            @else
                            
                            @endif
                        </td>
                        <td>
                        @if ($machineriesused->harvesting_cost && strtolower($machineriesused->harvesting_cost) != 'n/a')
                            {{ number_format($machineriesused->harvesting_cost,2) }}
                        @else
                            
                        @endif
                    </td>

                    <td>
                        @if ($machineriesused->postharvest_machineries_used && strtolower($machineriesused->postharvest_machineries_used) != 'n/a')
                            {{ $machineriesused->postharvest_machineries_used }}
                        @else
                        
                        @endif
                    </td>
                    <td>
                    @if ($machineriesused->postharv_ownership_status && strtolower($machineriesused->postharv_ownership_status) != 'n/a')
                        {{ $machineriesused->postharv_ownership_status }}
                    @else
                        
                    @endif
                    </td>
                    <td>
                    @if ($machineriesused->post_harvest_cost && strtolower($machineriesused->post_harvest_cost) != 'n/a')
                        {{ number_format($machineriesused->post_harvest_cost,2) }}
                    @else
                    
                    @endif
                    </td>
                    <td>
                    @if ($machineriesused->total_cost_for_machineries && strtolower($machineriesused->total_cost_for_machineries) != 'n/a')
                        {{ number_format($machineriesused->total_cost_for_machineries,2) }}
                    @else
                    
                    @endif
                    </td>
                    

                 

                   
                       <td>
                          
                        <a href="{{route('agent.machineused.update_machine', $machineriesused->id)}}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
              
                        <form  action="{{ route('machineries_used.delete', $machineriesused->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                           {{-- {{ csrf_field()}} --}}@csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                       </form> 
                          
                       </td>
                   </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Machineries Used Data is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <!-- Pagination links -->
                                <ul class="pagination">
                                    <li><a href="{{ $machineries->previousPageUrl() }}">Previous</a></li>
                                    @foreach ($machineries->getUrlRange(1,$machineries->lastPage()) as $page => $url)
                                        <li class="{{ $page == $machineries->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ $machineries->nextPageUrl() }}">Next</a></li>
                                </ul>
                            </div>
                        </div>

                        {{-- transport --}}
                        {{-- labor --}}
                        <input type="radio" name="tabs" id="Variable" checked="checked">
                        <label for="Variable">Variable</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5 for="Seed">V. Variable Cost</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr >
                    
                                            <th>#</th>
                                            <th>Farmer Name</th>
                                            <th>Tenurial <p> Status</p></th>
                                            <th>seed cost</th>
                                            <th>labor <p>cost</p></th>
                                            <th>fertilizer<p>cost</p></th>
                                            <th>pesticides<p>cost</p></th>
                                            <th>transport<p>cost</p></th>
                                            <th>total machinery <p>/delivery cost</p> </th>
                                            <th>total variable <p> cost</p></th>
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($variable->count() > 0)
                                    @foreach($variable as $vartotal)      
                                <tr class="table-light">
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{  $vartotal->id }}</td>
                                    <td>
                                        @if (optional($vartotal->personalinformation)->first_name && $vartotal->personalinformation->first_name != 'N/A' && $vartotal->personalinformation->first_name != 'NULL')
                                            {{ $vartotal->personalinformation->first_name }}
                                        @else
                                           
                                        @endif
                                    
                                        @if (optional($vartotal->personalinformation)->last_name && $vartotal->personalinformation->last_name != 'N/A' && $vartotal->personalinformation->last_name != 'NULL')
                                            {{ $vartotal->personalinformation->last_name }}
                                        @else
                                        
                                        @endif
                                    
                                        @if (optional($vartotal->personalinformation)->extension_name && $vartotal->personalinformation->extension_name != 'N/A' && $vartotal->personalinformation->extension_name != 'NULL')
                                            {{ $vartotal->personalinformation->extension_name }}
                                        @else
                                       
                                        @endif
                                    </td>
                                    
                                    
                                    
                                    <td>
                                        @if (optional($vartotal->farmprofile)->tenurial_status && strtolower($vartotal->farmprofile->tenurial_status) != 'N/A')
                                            {{ $vartotal->farmprofile->tenurial_status}}
                                        @else
                                         
                                        @endif
                                      </td>


                                    <td>
                                        @if ($vartotal->seeds->total_seed_cost && strtolower($vartotal->seeds->total_seed_cost) != 'n/a')
                                            {{ number_format($vartotal->seeds->total_seed_cost,2) }}
                                        @else
                                        
                                        @endif
                                        </td>
                                        <td>
                                            @if ($vartotal->labors->total_labor_cost && strtolower($vartotal->labors->total_labor_cost) != 'n/a')
                                                {{ number_format($vartotal->labors->total_labor_cost,2) }}
                                            @else
                                            
                                            @endif
                                            </td>
                                            <td>
                                                @if ($vartotal->fertilizers->total_cost_fertilizers && strtolower($vartotal->fertilizers->total_cost_fertilizers) != 'n/a')
                                                    {{ number_format($vartotal->fertilizers->total_cost_fertilizers,2) }}
                                                @else
                                                
                                                @endif
                                                </td>
                                                <td>
                                                    @if ($vartotal->pesticides->total_cost_pesticides && strtolower($vartotal->pesticides->total_cost_pesticides) != 'n/a')
                                                        {{ number_format($vartotal->pesticides->total_cost_pesticides,2) }}
                                                    @else
                                                    
                                                    @endif
                                                    </td>
                                                    <td>
                                                        @if ($vartotal->transports->total_transport_per_deliverycost && strtolower($vartotal->transports->total_transport_per_deliverycost) != 'n/a')
                                                            {{ number_format($vartotal->transports->total_transport_per_deliverycost,2) }}
                                                        @else
                                                        
                                                        @endif
                                                        </td>
                                                        <td>
                                                            @if ($vartotal->total_machinery_fuel_cost && strtolower($vartotal->total_machinery_fuel_cost) != 'n/a')
                                                                {{ number_format($vartotal->total_machinery_fuel_cost,2) }}
                                                            @else
                                                            
                                                            @endif
                                                            </td>
                                                            <td>
                                                                @if ($vartotal->total_variable_cost && strtolower($vartotal->total_variable_cost) != 'n/a')
                                                                    {{ number_format($vartotal->total_variable_cost,2) }}
                                                             @else
                                                                
                                                         @endif
                                                    </td>
 
                                                <td>
                                                    
                                                    <a href="{{route('agent.variablecost.variable_total.var_edited',  $vartotal->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                                                    <form  action="{{ route('agent.variablecost.variable_total.delete', $vartotal->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                   @csrf
                                                       @method('DELETE')
                                                       <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                   </form> 
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Variable Cost Data is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <br>
                                <!-- Pagination links -->
                                <ul class="pagination">
                                    <li><a href="{{ $variable->previousPageUrl() }}">Previous</a></li>
                                    @foreach ($variable->getUrlRange(1,$variable->lastPage()) as $page => $url)
                                        <li class="{{ $page == $variable->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ $variable->nextPageUrl() }}">Next</a></li>
                                </ul>
                        </div>
                        {{-- total Variable cost --}}
                       
                        <input type="radio" name="tabs" id="Production" checked="checked">
                        <label for="Production">Last Production</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5 for="Seed">VI. Last Production Data</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('personalinfo.create') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr >
                    
                                            <th>#</th>
                                            <th>Farmer Name</th>
                                            <th>Tenurial <p> Status</p></th>
                                            <th>agri-district</th>
                                            <th>seed <p>type used</p></th>
                                            <th>seeds used <p>in kg</p></th>
                                            <th>seed_source</th>
                                            <th>no of fertilizer
                                            <p> used in bags</p></th>
                                            <th>no of pesticides <p> used in L/kg</p></th>
                                            <th>no of insecticides <p>used in L</p></th>
                                            <th>area planted</th>
                                            <th>date planted</th>
                                            <th>date_harvested</th>
                                            <th>yield <p>tons/kg</p></th>
                                            <th>unit price <p> palay/kg</p></th>
                                            <th>unit price <p>rice/kg</p></th>
                                            <th>type of <p>product</p></th>
                                            <th>sold to</th>
                                            <th>palay milled</th>
                                            <th>gross income <p>palay</p></th>
                                            <th>gross income <p> rice</p></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($productions->count() > 0)
                                    @foreach($productions as $lastproductdata)      
                                <tr class="table-light">
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{  $lastproductdata->id }}</td>
                                    <td>
                                        @if (optional($lastproductdata->personalinformation)->first_name && $lastproductdata->personalinformation->first_name != 'N/A' && $lastproductdata->personalinformation->first_name != 'NULL')
                                            {{ $lastproductdata->personalinformation->first_name }}
                                        @else
                                           
                                        @endif
                                    
                                        @if (optional($lastproductdata->personalinformation)->last_name && $lastproductdata->personalinformation->last_name != 'N/A' && $lastproductdata->personalinformation->last_name != 'NULL')
                                            {{ $lastproductdata->personalinformation->last_name }}
                                        @else
                                        
                                        @endif
                                    
                                        @if (optional($lastproductdata->personalinformation)->extension_name && $lastproductdata->personalinformation->extension_name != 'N/A' && $lastproductdata->personalinformation->extension_name != 'NULL')
                                            {{ $lastproductdata->personalinformation->extension_name }}
                                        @else
                                       
                                        @endif
                                    </td>

                                    
                                    <td>
                                        @if (optional($lastproductdata->farmprofile)->tenurial_status && strtolower($lastproductdata->farmprofile->tenurial_status) != 'N/A')
                                            {{ $lastproductdata->farmprofile->tenurial_status}}
                                        @else
                                         
                                        @endif
                                      </td>

                                      <td>
                                        @if (optional($lastproductdata->agridistrict)->district && strtolower($lastproductdata->agridistrict->district) != 'N/A')
                                            {{ $lastproductdata->agridistrict->district}}
                                        @else
                                         
                                        @endif
                                      </td>
                                      <td>
                                        @if ($lastproductdata->seeds_typed_used && strtolower($lastproductdata->seeds_typed_used) !== 'n/a')
                                            {{ $lastproductdata->seeds_typed_used }}
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if ($lastproductdata->seeds_used_in_kg && strtolower($lastproductdata->seeds_used_in_kg) !== 'n/a')
                                            {{ number_format($lastproductdata->seeds_used_in_kg,2)}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->seed_source && strtolower($lastproductdata->seed_source) !== 'n/a')
                                            {{ $lastproductdata->seed_source }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->no_of_fertilizer_used_in_bags && strtolower($lastproductdata->no_of_fertilizer_used_in_bags) !== 'n/a')
                                            {{ number_format($lastproductdata->no_of_fertilizer_used_in_bags,2)}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->no_of_pesticides_used_in_l_per_kg && strtolower($lastproductdata->no_of_pesticides_used_in_l_per_kg) !== 'n/a')
                                            {{ number_format($lastproductdata->no_of_pesticides_used_in_l_per_kg,2)}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->no_of_insecticides_used_in_l && strtolower($lastproductdata->no_of_insecticides_used_in_l) !== 'n/a')
                                            {{ number_format($lastproductdata->no_of_insecticides_used_in_l,2)}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->area_planted && strtolower($lastproductdata->area_planted) !== 'n/a')
                                            {{ $lastproductdata->area_planted}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->date_planted && strtolower($lastproductdata->date_planted) !== 'n/a')
                                            {{ $lastproductdata->date_planted}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->date_harvested && strtolower($lastproductdata->date_harvested) !== 'n/a')
                                            {{ $lastproductdata->date_harvested}}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($lastproductdata->yield_tons_per_kg && strtolower($lastproductdata->yield_tons_per_kg) !== 'n/a')
                                            {{ number_format($lastproductdata->yield_tons_per_kg,2)}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->unit_price_palay_per_kg && strtolower($lastproductdata->unit_price_palay_per_kg) !== 'n/a')
                                            {{ number_format($lastproductdata->unit_price_palay_per_kg,2)}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->unit_price_rice_per_kg && strtolower($lastproductdata->unit_price_rice_per_kg) !== 'n/a')
                                            {{ number_format($lastproductdata->unit_price_rice_per_kg,2)}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->type_of_product && strtolower($lastproductdata->type_of_product) !== 'n/a')
                                            {{ $lastproductdata->type_of_product}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->sold_to && strtolower($lastproductdata->sold_to) !== 'n/a')
                                            {{ $lastproductdata->sold_to}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->if_palay_milled_where && strtolower($lastproductdata->if_palay_milled_where) !== 'n/a')
                                            {{ $lastproductdata->if_palay_milled_where}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->gross_income_palay && strtolower($lastproductdata->gross_income_palay) !== 'n/a')
                                            {{ number_format($lastproductdata->gross_income_palay,2)}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($lastproductdata->gross_income_rice && strtolower($lastproductdata->gross_income_rice) !== 'n/a')
                                            {{ number_format($lastproductdata->gross_income_rice,2)}}
                                        @endif
                                    </td>

                                                    <td>
                                                        
                                                        <a href="{{route('agent.lastproduction.last_edit', $lastproductdata->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                            
                                                        <form  action="{{ route('production_data.delete', $lastproductdata->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                        {{-- {{ csrf_field()}} --}}@csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                    </form> 
                                                        
                                                    </td>
                                                </tr>  
                                            @endforeach
                                          @else
                                         <tr>
                                            <td class="text-center" colspan="5">Last Production Data is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                               
                            </div>
                            <br>
                            <!-- Pagination links -->
                            <ul class="pagination">
                                <li><a href="{{ $productions->previousPageUrl() }}">Previous</a></li>
                                @foreach ($productions->getUrlRange(1,$productions->lastPage()) as $page => $url)
                                    <li class="{{ $page == $productions->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ $productions->nextPageUrl() }}">Next</a></li>
                            </ul>
                        </div>
                      
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('searchInput');
        const farmProfileSearchForm = document.getElementById('farmProfileSearchForm');
        const showAllForm = document.getElementById('showAllForm');
  
        let timer;
  
        // Add event listener for search input
        searchInput.addEventListener('input', function() {
            // Clear previous timer
            clearTimeout(timer);
            // Start new timer with a delay of 500 milliseconds (adjust as needed)
            timer = setTimeout(function() {
                // Submit the search form
                farmProfileSearchForm.submit();
            }, 1000);
        });
  
        // Add event listener for "Show All" button
        showAllForm.addEventListener('click', function(event) {
            // Prevent default form submission behavior
            event.preventDefault();
            // Remove search query from input field
            searchInput.value = '';
            // Submit the form
            showAllForm.submit();
        });
    });
  </script>
@endsection
