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
          <h6 class="card-title"><span>IV.</span>Machineries Used (view, edit, delete)</h6>
          <br><br>
          <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <form id="farmProfileSearchForm" action="{{ route('machineries_used.machine_create') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </form>
            <form id="showAllForm" action="{{ route('machineries_used.machine_create') }}" method="GET">
                <button class="btn btn-outline-success" type="submit">Show All</button>
            </form>
        </div>
         <div class="table-responsive tab ">
          <table class="table table bordered datatable">
              <thead class="thead-light">
                  <tr >
                   
                      <th>#</th>
                      <th>Farmer Name</th>
                      <th>Tenurial Status</th>
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
                      <th>Time of input</th>
                      <th>Updated at Time</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @if($machineries->count() > 0)
              @foreach($machineries as $machineriesused)
                  <tr class="table-light">
                       {{-- <td>{{ $loop->iteration }}</td> --}}
                       <td>{{ $machineriesused->id }}</td>
                         <td>
                        @if (optional($machineriesused->personalinformation)->last_name && strtolower($machineriesused->personalinformation->ast_name) != 'N/A')
                            {{ $machineriesused->personalinformation->last_name}}
                        @else
                         
                        @endif
                      </td>
                      <td>
                        @if (optional($machineriesused->farmprofile)->tenurial_status && strtolower($machineriesused->farmprofile->tenurial_status) != 'N/A')
                            {{ $machineriesused->farmprofile->tenurial_status}}
                        @else
                         
                        @endif
                      </td>
              
                      <td>{{ $machineriesused->plowing_machineries_used }}</td>
                      <td>{{ $machineriesused->plo_ownership_status }}</td>
                      <td>{{ $machineriesused->no_of_plowing }}</td>
                      <td>{{ $machineriesused->plowing_cost }}</td>
                      <td>{{ $machineriesused->harrowing_machineries_used}}</td>
                      <td>{{ $machineriesused->harro_ownership_status }}</td>
                      <td>{{ $machineriesused->no_of_harrowing }}</td>
                      <td>{{ $machineriesused->harrowing_cost }}</td>
                      <td>{{ $machineriesused->harvesting_machineries_used}}</td>
                      <td>{{ $machineriesused->harvest_ownership_status}}</td>
                      <td>{{ $machineriesused->harvesting_cost}}</td>
                      <td>{{ $machineriesused->postharvest_machineries_used }}</td>
                      <td>{{ $machineriesused->postharv_ownership_status }}</td>
                      <td>{{ $machineriesused->post_harvest_cost }}</td>
                      <td>{{ $machineriesused->total_cost_for_machineries}}</td>
                      <td>{{ $machineriesused->created_at}}</td>
                      <td>{{ $machineriesused->updated_at}}</td>
                      <td>
                      
                          <a href="{{route('machineries_used.machine_edit', $machineriesused->id)}}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
              
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
      {{$machineries->links() }}
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