@extends('user.user_Dashboard')

@section('user')


@extends('layouts._footer-script')
@extends('layouts._head')


<div class="page-content">

    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  
<div class="d-flex flex-wrap justify-content-center">
<button class="btn btn-primary mx-2 my-2" onclick="showAllSections()">View All</button>
<button class="btn btn-primary mx-2 my-2" onclick="showSection('personal_info')">Personal Info</button>
<button class="btn btn-primary mx-2 my-2" onclick="showSection('farm_profile')">Farm Profile</button>
<button class="btn btn-primary mx-2 my-2" onclick="showSection('fixed_cost')">Fixed Cost</button>
<button class="btn btn-primary mx-2 my-2" onclick="showSection('machineries')">Machineries</button>
<button class="btn btn-primary mx-2 my-2" onclick="showSection('variable_cost')">Variable Cost</button>
<button class="btn btn-primary mx-2 my-2" onclick="showSection('last_production_data')">Last Production Data</button>
</div>

<br>

<h4 class="mb-3 mb-md-0">Vitali Rice Farmers Info</h4>

    <!-- Personal Info Table Section -->
    <div id="personal_info_section"class="table-section">
      
        <br>
        <div class="card border rounded">
            <div class="card-body">
                <h4 class="mb-3 mb-md-0">Personal Informations</h4>
      
        <div class="table-responsive tab">
            <table  class="table table-bordered datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Farmer No.</th>
                        <th>FirtsName</th>
                        <th>MiddleName</th>
                        <th>LastName</th>
                        <th>ExtentionName</th>
                        <th>Home Address</th>
                        <th>Sex</th>
                        <th>Religion</th>
                        <th>date_of_birth</th>
                        <th>place_of_birth</th>
                        <th>contact no.</th>
                        <th>civil_status</th>
                        <th>name of legal spuse</th>
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
                    @foreach($FarmersData->where('agri_district','vitali') as $personalinformation)
                        <tr class="table-light">
                            <td>{{  $personalinformation->personal_informations_id }}</td>
                  
                            <td>{{  $personalinformation->first_name }}</td>
                            <td>{{  $personalinformation->middle_name }}</td>
                            <td>{{  $personalinformation->last_name }}</td>
                            <td>{{  $personalinformation->extension_name }}</td>
                            <td>{{  $personalinformation->barangay.' ,'.$personalinformation->agri_district.' ,'.$personalinformation->city}}</td>
                            <td>{{  $personalinformation->sex }}</td>
                            <td>{{  $personalinformation->religion }}</td>
                            <td>{{  $personalinformation->date_of_birth }}</td>
                            <td>{{  $personalinformation->place_of_birth}}</td>
                            <td>{{  $personalinformation->contact_no }}</td>
                            <td>{{  $personalinformation->civil_status }}</td>
                            <td>{{  $personalinformation->name_legal_spouse }}</td>
                            <td>{{  $personalinformation->no_of_children }}</td>
                            <td>{{  $personalinformation->mothers_maiden_name }}</td>
                            <td>{{  $personalinformation->highest_formal_education }}</td>
                            <td>{{  $personalinformation->person_with_disability}}</td>
                            <td>{{  $personalinformation->government_issued_id }}</td>
                            <td>{{  $personalinformation->id_type }}</td>
                            <td>{{  $personalinformation->gov_id_no }}</td>
                            <td>{{  $personalinformation->member_ofany_farmers_ass_org_coop }}</td>
                            <td>{{  $personalinformation->nameof_farmers_ass_org_coop }}</td>
                            <td>{{  $personalinformation->name_contact_person }}</td>
                            <td>{{  $personalinformation->cp_tel_no }}</td>   
                        
                            <td>
                           
                    {{-- <a href="{{ route('agent.vitali.show_personal_info', ['id' => $personalinformation->id]) }}" class="btn btn-primary">Show Details</a> --}}

         {{-- <form  action="{{ route('agent.personal_info.delete', $personalinformation->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
           @csrf
                       <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                  
                   </form> --}}
                   {{-- <div class="col-sm">
                       <form action="{{ route('personalinfo.destroy', $personalinformation->id) }}" method="post">
                         @csrf
                         @method('DELETE')
                         <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                       </form>
                   </div> --}}
               </td>
            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>

    <!-- Farm Profile Table Section -->
    <div id="farm_profile_section" style="display: none;">
        <br>
        <div class="card border rounded">
            <div class="card-body">
                <h4 class="mb-3 mb-md-0">Farm Profile</h4>
      
        <div class="table-responsive tab">
            <table  class="table table-bordered datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Farmer No.</th>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($FarmersData->where('agri_district','vitali') as $farmers)
                        <tr class="table-light">
                            <td>{{  $farmers->personal_informations_id }}</td>
                  
                            <td>{{ $farmers->tenurial_status }}</td>
                            <td>{{ $farmers->rice_farm_address }}</td>
                            <td>{{ $farmers->no_of_years_as_farmers }}</td>
                            <td>{{ $farmers->gps_longitude }}</td>
                            <td>{{ $farmers->gps_latitude}}</td>
                            <td>{{ $farmers->total_physical_area_has }}</td>
                            <td>{{ $farmers->rice_area_cultivated_has }}</td>
                            <td>{{ $farmers->land_title_no }}</td>
                            <td>{{ $farmers->lot_no}}</td>
                            <td>{{ $farmers->area_prone_to}}</td>
                            <td>{{ $farmers->ecosystem }}</td>
                            <td>{{ $farmers->type_rice_variety }}</td>
                            <td>{{ $farmers->prefered_variety }}</td>
                            <td>{{ $farmers->plant_schedule_wetseason }}</td>
                            <td>{{ $farmers->plant_schedule_dryseason}}</td>
                            <td>{{ $farmers->no_of_cropping_yr }}</td>
                            <td>{{ $farmers->yield_kg_ha}}</td>
                            <td>{{ $farmers->rsba_register}}</td>
                            <td>{{ $farmers->pcic_insured }}</td>
                            <td>{{ $farmers->source_of_capital}}</td>
                            <td>{{ $farmers->remarks_recommendation}}</td>
                            <td>{{ $farmers->oca_district_office}}</td>
                            <td>{{ $farmers->name_technicians}}</td>
                            <td>{{ $farmers->date_interview}}</td>        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>

    <!-- Fixed Cost Table Section -->
    <div id="fixed_cost_section" style="display: none;">
       <br>
       <div class="card border rounded">
        <div class="card-body">
            <h4 class="mb-3 mb-md-0">Fixed Cost</h4>
  
    <div class="table-responsive tab">
        <table  class="table table-bordered datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Farmer No.</th>
                        <th>particular(FixedCost)</th>
                        <th>no of has</th>
                         <th>cost per has</th>
                        <th>total Fixed Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($FarmersData->where('agri_district','vitali') as $farmers)
                        <tr class="table-light">
                            <td>{{  $farmers->personal_informations_id }}</td>
                  
                            <td>{{ $farmers->particular }}</td>
                            <td>{{ $farmers->no_of_ha }}</td>
                            <td>{{ number_format($farmers->cost_per_ha,2)}}</td>
                            <td>{{ number_format($farmers->total_amount,2) }}</td>      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
    <!-- Machineries Table Section -->
    <div id="machineries_section" style="display: none;">
        <br>
        <div class="card border rounded">
            <div class="card-body">
                <h4 class="mb-3 mb-md-0">Machineries Used Cost</h4>
      
        <div class="table-responsive tab">
            <table  class="table table-bordered datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Farmer No.</th>
                        <th>plowing_machineries_used</th>
                        <th>plo_ownership_status</th>
                        <th>no_of_plowing</th>
                        <th>plowing_cost</th>
                        <th>harrowing_machineries_used</th>
                        <th>harro_ownership_status</th>
                        <th>no_of_harrowing</th>
                        <th>harrowing_cost</th>
                        <th>harvesting_machineries_used</th>
                        <th>harvest_ownership_status</th>
                        <th>harvesting_cost</th>
                        <th>postharvest_machineries_used</th>
                        <th>postharv_ownership_status</th>
                        <th>post_harvest_cost</th>
                        <th>total_cost_for_machineries'</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($FarmersData->where('agri_district','vitali') as $farmers)
                        <tr class="table-light">
                            <td>{{  $farmers->personal_informations_id }}</td>
                  
                            <td>{{ $farmers->plowing_machineries_used }}</td>
                            <td>{{ $farmers->plo_ownership_status }}</td>
                            <td>{{ $farmers->no_of_plowing }}</td>
                            <td>{{ number_format($farmers->plowing_cost,2) }}</td>
                            <td>{{ $farmers->harrowing_machineries_used}}</td>
                            <td>{{ $farmers->harro_ownership_status }}</td>
                            <td>{{ $farmers->no_of_harrowing }}</td>
                            <td>{{ number_format($farmers->harrowing_cost,2 )}}</td>
                            <td>{{ $farmers->harvesting_machineries_used}}</td>
                            <td>{{ $farmers->harvest_ownership_status}}</td>
                            <td>{{ number_format($farmers->harvesting_cost,2)}}</td>
                            <td>{{ $farmers->postharvest_machineries_used }}</td>
                            <td>{{ $farmers->postharv_ownership_status }}</td>
                            <td>{{ number_format($farmers->post_harvest_cost,2) }}</td>
                            <td>{{ number_format($farmers->total_cost_for_machineries,2)}}</td>     </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
    </div>

    <!-- Variable Cost Table Section -->
    <div id="variable_cost_section" style="display: none;">
        <br>
        <div class="card border rounded">
            <div class="card-body">
                <h4 class="mb-3 mb-md-0">Variable Cost</h4>
      
        <div class="table-responsive tab">
            <table  class="table table-bordered datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Farmer No.</th>
                        <th>total seed cost</th>
                        <th>total labor cost</th>
                        <th>total cost ferilizers</th>
                        <th>total cost of pesticides</th>
                        <th>total transport/delivery cost</th>
                        <th>total machinery/delivery cost</th>
                        <th>total variable cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($FarmersData->where('agri_district','vitali') as $farmers)
                        <tr class="table-light">
                            <td>{{  $farmers->personal_informations_id }}</td>
                  
                            <td>{{ number_format($farmers->total_seed_cost,2) }}</td>
                            <td>{{ number_format($farmers->total_labor_cost,2)}}</td>
                            <td>{{ number_format($farmers->total_cost_fertilizers,2) }}</td>
                            <td>{{ number_format($farmers->total_cost_pesticides,2)}}</td>
                            <td>{{ number_format($farmers->total_transport_per_deliverycost,2)}}</td>
                            <td>{{number_format($farmers->total_machinery_fuel_cost,2) }}</td>
                            <td>{{number_format($farmers->total_variable_cost,2)}}</td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        </div>
    </div>


    <!-- Last Production Data Table Section -->
    <div id="last_production_data_section" style="display: none;">
        <br>
        <div class="card border rounded">
            <div class="card-body">
                <h4 class="mb-3 mb-md-0">Last Production Data</h4>
      
        <div class="table-responsive tab">
            <table  class="table table-bordered datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Farmer No.</th>
                        <th>seed_type_used</th>
                        <th>seeds_used_in_kg</th>
                        <th>seed_source</th>
                        <th>no_of_fertilizer_used</th>
                        <th>no_of_pesticides_used</th>
                        <th>no_of_insecticides_used</th>
                        <th>areaplanted</th>
                        <th>date planted</th>
                        <th>date harvested</th>
                        <th>yield tons per kg</th>
                        <th>unitprice palay kgt</th>
                        <th>unitprice rice kg</th>
                        <th>type of product</th>
                        <th>sold to</th>
                        <th>palay milled</th>
                        <th>gross income_palay'</th>
                        <th>gross income_rice'</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($FarmersData->where('agri_district','vitali') as $farmers)
                        <tr class="table-light">
                            <td>{{  $farmers->personal_informations_id }}</td>
                  
                            <td>{{ $farmers->seeds_typed_used}}</td>
                            <td>{{ $farmers->seeds_used_in_kg}}</td>
                            <td>{{ $farmers->seed_source}}</td>
                            <td>{{ $farmers->no_of_fertilizer_used_in_bags}}</td>
                            <td>{{ $farmers->no_of_pesticides_used_in_l_per_kg}}</td>
                            <td>{{ $farmers->no_of_insecticides_used_in_l }}</td>
                            <td>{{ $farmers->area_planted }}</td>
                            <td>{{ $farmers->date_planted}}</td>
                            <td>{{ $farmers->date_harvested}}</td>
                            <td>{{ $farmers->yield_tons_per_kg}}</td>
                            <td>{{ $farmers->unit_price_palay_per_kg}}</td>
                            <td>{{ $farmers->unit_price_rice_per_kg}}</td>
                            <td>{{ $farmers->type_of_product}}</td>
                            <td>{{ $farmers->sold_to}}</td>
                            <td>{{ $farmers->if_palay_milled_where}}</td>
                            <td>{{ $farmers->gross_income_palay}}</td>
                            <td>{{ $farmers->gross_income_rice}}</td>
                            </tr>
                    @endforeach
                      </tbody>
                  </table>
              </div>
             </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

<script>
function showSection(sectionName) {
// Hide all sections
document.querySelectorAll('[id$="_section"]').forEach(section => {
section.style.display = 'none';
});

// Show the selected section
document.getElementById(sectionName + '_section').style.display = 'block';
}
</script>
<script>
    function showAllSections() {
    // Show all sections
    document.querySelectorAll('[id$="_section"]').forEach(section => {
        section.style.display = 'block';
    });
}

</script>
@endsection
