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
            <h6 class="card-title"><span>III.</span>Fixed Cost (View, Edit, Delete )</h6>
           <br><br>
            <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <form id="farmProfileSearchForm" action="{{ route('fixed_cost.fixed_create') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </div>
                </form>
                <form id="showAllForm" action="{{ route('fixed_cost.fixed_create') }}" method="GET">
                    <button class="btn btn-outline-success" type="submit">Show All</button>
                </form>
            </div>
           <div class="table-responsive tab ">
            <table class="table table table-info">
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
                         <td>{{ $fixedcost->id}}</td>
                         
                        
                         <td>
                            @if (optional($fixedcost->personalinformation)->last_name && strtolower($fixedcost->personalinformation->ast_name) != 'N/A')
                                {{ $fixedcost->personalinformation->last_name}}
                            @else
                             
                            @endif
                          </td>
                         <td>
                            @if (optional($fixedcost->farmprofile)->tenurial_status && strtolower($fixedcost->farmprofile->tenurial_status) != 'N/A')
                                {{ $fixedcost->farmprofile->tenurial_status}}
                            @else
                             
                            @endif
                          </td>
                         <td>
                            @if ($fixedcost->particular && strtolower($fixedcost->particular) != 'n/a')
                                {{ $fixedcost->particular }}
                            @else
                             
                            @endif
                          </td>
                      
                     
                        <td>{{ $fixedcost->no_of_ha }}</td>
                        <td>{{ $fixedcost->cost_per_ha}}</td>
                        <td>{{ $fixedcost->total_amount }}</td>
                        
                        
  
                        <td>
                           
                             <a href="{{route('fixed_cost.fixed_edit', $fixedcost->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action="{{ route('fixed_cost.delete', $fixedcost->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                            @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form> 
                            
                        </td>
                    </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="5">Fixed Cost not found</td>
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
        {{ $fixedcosts->links() }}
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