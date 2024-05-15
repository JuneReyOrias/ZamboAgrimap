@extends('admin.dashb')
@section('admin')

@extends('layouts._footer-script')
@extends('layouts._head')


<div class="page-content">
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    
                    <h2> Rice Boarders</h2>
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
                        <input type="radio" name="tabs" id="Seed" checked="checked">
                        <label for="Seed">Polygon</label>
                        <div class="tab">
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3 me-md-1">
                                    <h5 for="Seed" class="me-3">a. Polygon Boundary</h5>
                                </div>
                                                        
                                <div class="me-md-1">
                                    <a href="{{ route('polygon.create') }}" class="btn btn-success">Add</a>
                                </div>
                            
                                <form id="farmProfileSearchForm" action="{{ route('polygon.polygons_show') }}" method="GET" class="me-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                            
                                <form id="showAllForm" action="{{ route('polygon.polygons_show') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            
                            
                               <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light" >
                                        <tr>
                                            <th>#</th>
                                            <th>agri-district id.</th>
                                            <th>Polygon name</th>
                                            <th>color</th>
                                            <th>point 1 lat</th>
                                            <th>point 1 lng</th>
                                            <th>pontt 2 lat</th>
                                            <th>point 2 lng</th>
                                            <th>pontt 3 lat</th>
                                            <th>point 3 lng</th>
                                            <th>pontt 4 lat</th>
                                            <th>point 4 lng</th>
                                            <th>point 5 lat</th>
                                            <th>point 5 lng</th>
                                            <th>pontt 6 lat</th>
                                            <th>point 6 lng</th>
                                            <th>pontt 7 lat</th>
                                            <th>point 7 lng</th>
                                            <th>pontt 8 lat</th>
                                            <th>point 8 lng</th>
                                            <th>area</th>
                                            <th>perimeter</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($polygons->count() > 0)
                                        @foreach($polygons as $seed)
                                            <tr class="table-light">
                                                 
                                                 <td>{{$seed->id}}</td>
                                                 <td>{{$seed->agri_districts_id }}</td>
                                                 <td>{{$seed->poly_name }}</td>
                                                 <td>{{$seed->strokecolor }}</td>
                                                 <td>{{$seed->verone_latitude }}</td>
                                                <td>{{$seed->verone_longitude}}</td>
                                                <td>{{$seed->vertwo_latitude }}</td>
                                                <td>{{$seed->vertwo_longitude}}</td>
                                                <td>{{$seed->verthree_latitude }}</td>
                                                <td>{{$seed->verthree_longitude }}</td>
                        
                                                <td>{{$seed->vertfour_latitude }}</td>
                                                <td>{{$seed->vertfour_longitude}}</td>
                                                <td>{{$seed->verfive_latitude }}</td>
                                                <td>{{$seed->verfive_longitude}}</td>
                                                <td>{{$seed->versix_latitude }}</td>
                                                <td>{{$seed->versix_longitude}}</td>
                                                <td>{{$seed->verseven_latitude }}</td>
                                                <td>{{$seed->verseven_longitude}}</td>
                                                <td>{{$seed->vereight_latitude }}</td>
                                                <td>{{$seed->verteight_longitude}}</td>
                                                <td>{{$seed->area}}</td>
                                                <td>{{$seed->perimeter}}</td>
                                                
                                                
                          
                                                <td>
                                                   
                                                     <a href="{{route('polygon.polygons_edit',  $seed->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                        
                                                     <form  action="{{ route('polygon.delete', $seed->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                    @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                    </form> 
                                                    
                                                </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Polygon Cost is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                             <!-- Pagination links -->
                             <ul class="pagination">
                                <li><a href="{{ $polygons->previousPageUrl() }}">Previous</a></li>
                                @foreach ($polygons->getUrlRange(1,$polygons->lastPage()) as $page => $url)
                                    <li class="{{ $page == $polygons->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ $polygons->nextPageUrl() }}">Next</a></li>
                            </ul>
                        </div>


                        {{-- labor --}}
                        <input type="radio" name="tabs" id="labors" checked="checked">
                        <label for="labors">Parcel</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5>b. Parcellary Boarder</h5>
                                </div>
                                <div class="me-md-1">
                                    <a href="{{ route('parcels.new_parcels') }}" class="btn btn-success">Add</a>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('polygon.polygons_show') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('polygon.polygons_show') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr >
                                            
                                              <th>parcels id</th>
                                              <th>Agri-District</th>
                                              <th>Parcel Name</th>
                                              <th>ARPOwnerName</th>
                                              <th>brgyName</th>
                                              <th>land title no</th>
                                              <th>Lot no.</th>
                                              <th>pkind desc</th>
                                              <th>pused desc</th>
                                              <th>actual used</th>
                                             
                                              <th>Point 1 lat</th>
                                              <th>Point 1 lng</th>
                                              <th>Point 2 lat</th>
                                              <th>Point 2 lng</th>
                                              <th>Point 3 lat</th>
                                              <th>Point 3 lng</th>
                                              <th>Point 4 lat</th>
                                              <th>Point 4 lng</th>
                                              <th>Point 5 lat</th>
                                              <th>Point 5 lng</th>
                                              <th>Point 6 lat</th>
                                              <th>Point 6 lng</th>
                                              <th>Point 7 lat</th>
                                              <th>Point 7 lng</th>
                                              <th>Point 8 lat</th>
                                              <th>Point 8 lng</th>
                                              <th>Point 9 lat</th>
                                              <th>Point 9 lng</th>
                                              <th>Point 10 lat</th>
                                              <th>Point 10 lng</th>
                                              <th>Point 11 lat</th>
                                              <th>Point 11 lng</th>
                                              <th>Point 12 lat</th>
                                              <th>Point 12 lng</th>
                                              <th>Area</th>
                                              <th>Parcel Color</th>
                                       
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @if($parcels->count() > 0)
                                      @foreach($parcels as $personalinformation)
                                          <tr class="table-light">
                                             
                                               <td>{{  $personalinformation->id }}</td>
                                              <td>{{  $personalinformation->agri_districts_id }}</td>
                                              <td>{{  $personalinformation->parcel_name}}</td>
                                              <td>{{  $personalinformation->arpowner_na }}</td>
                                              <td>{{  $personalinformation->brgy_name }}</td>
                                              <td>{{  $personalinformation->tct_no}}</td>
                                              <td>{{  $personalinformation->lot_no }}</td>
                                              <td>{{  $personalinformation->pkind_desc }}</td>
                                              <td>{{  $personalinformation->puse_desc }}</td>
                                              <td>{{  $personalinformation->actual_used}}</td>
                                              <td>{{  $personalinformation->parone_latitude }}</td>
                                              <td>{{  $personalinformation->parone_longitude }}</td>
                                              <td>{{  $personalinformation->partwo_latitude }}</td>
                                              <td>{{  $personalinformation->partwo_longitude }}</td>
                                              <td>{{  $personalinformation->parthree_latitude}}</td>
                                              <td>{{  $personalinformation->parthree_longitude }}</td>
                                              <td>{{  $personalinformation->parfour_latitude}}</td>
                                              <td>{{  $personalinformation->parfour_longitude }}</td>
                                              <td>{{  $personalinformation->parfive_latitude }}</td>
                                              <td>{{  $personalinformation->parfive_longitude }}</td>
                                              <td>{{  $personalinformation->parsix_latitude }}</td>
                                            
                                              <td>{{  $personalinformation->parsix_longitude  }}</td>
                                              <td>{{  $personalinformation->parseven_latitude }}</td>
                                              <td>{{  $personalinformation->parseven_longitude }}</td>
                      
                                              <td>{{  $personalinformation->pareight_latitude }}</td>
                                              <td>{{  $personalinformation->pareight_longitude }}</td>
                                              <td>{{  $personalinformation->parnine_latitude}}</td>
                                              <td>{{  $personalinformation->parnine_longitude }}</td>
                                              <td>{{  $personalinformation->parten_latitude }}</td>
                                              <td>{{  $personalinformation->parten_longitude}}</td>
                                              <td>{{  $personalinformation->pareleven_latitude }}</td>
                                              <td>{{  $personalinformation->pareleven_longitude }}</td>
                                              <td>{{  $personalinformation->partwelve_latitude }}</td>
                                              <td>{{  $personalinformation->partwelve_longitude }}</td>
                                              <td>{{  $personalinformation->area }}</td>
                                              <td>{{  $personalinformation->parcolor }}</td>
                                             
                                              <td>
                                                 
                                                   <a href="{{route('parcels.edit',  $personalinformation->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                      
                                                   <form  action="{{ route('parcels.delete',  $personalinformation->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                      {{ csrf_field()}}
                                                      <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                  </form>
                                                 
                                              </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Parcel  is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                             <!-- Pagination links -->
                             <ul class="pagination">
                                <li><a href="{{ $parcels->previousPageUrl() }}">Previous</a></li>
                                @foreach ($parcels->getUrlRange(1,$parcels->lastPage()) as $page => $url)
                                    <li class="{{ $page == $parcels->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ $parcels->nextPageUrl() }}">Next</a></li>
                            </ul>
                        </div>

                     
                        <!-- Repeat the same structure for other tabs -->
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
