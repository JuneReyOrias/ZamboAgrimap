@extends('admin.dashb')
@section('admin')

@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content">

    <nav class="page-breadcrumb">
  
    </nav>
    <div id="personal_info_section"class="table-section">
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
           
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h4 class="mb-3 mb-md-0">Farm Profile</h4> <br>
  
        <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <form id="farmProfileSearchForm" action="{{ route('farm_profile.farminfo_view') }}" method="GET">
              <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                  <button class="btn btn-outline-success" type="submit">Search</button>
              </div>
          </form>
          <form id="showAllForm" action="{{ route('farm_profile.farminfo_view') }}" method="GET">
              <button class="btn btn-outline-success" type="submit">Show All</button>
          </form>
      </div>
        <div class="table-responsive tab ">
           <table class="table table-bordered datatable">
                <thead class="thead-light">
                    <tr >
                    
                        <th>Farm ID.</th>
                        <th>Farmer Name</th>
                        <th>AgriDistrict</th>
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
                         <td>{{ $farmprofile->id }}</td>
                         <td>{{ $farmprofile->personalInformation->last_name }}</td>
                         <td>{{ $farmprofile->agriDistrict->district }}</td>
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
                    
                        <td>
                           
                            <a href="{{route('farm_profile.farm_edit', $farmprofile->id)}}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
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
                    <td class="text-center" colspan="5">Personal Informations not found</td>
                </tr>
            @endif
                </tbody>
            </table>
        </div>
  
   
          </div>
                      <!-- Pagination links -->
            <div class="row"style="align-content: center;display: flex;
            align-items: center; align-self: center">
                <div class="col-md-7" style="align-content: center;display: flex;
                align-items: center;">
                    {{ $farmProfiles->links() }}
                </div>
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