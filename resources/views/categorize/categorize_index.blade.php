@extends('admin.dashb')
@section('admin')

@extends('layouts._footer-script')
@extends('layouts._head')


<div class="page-content">
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    
                    <h2> Category</h2>
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
                        <label for="Seed">Category</label>
                        <div class="tab">
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3 me-md-1">
                                    <h5 for="Seed" class="me-3">Category</h5>
                                </div>
                                                        
                                <div class="me-md-1">
                                    <a href="{{ route('polygon.create') }}" class="btn btn-success">Add</a>
                                </div>
                            
                                <form id="farmProfileSearchForm" action="{{ route('categorize.index') }}" method="GET" class="me-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                            
                                <form id="showAllForm" action="{{ route('categorize.index') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            
                            
                               <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light" >
                                        
                                        <tr >
                                        
                                            <th>CatID</th>
                                            <th>Agri-District</th>
                                            <th>Category Name</th>
                                            <th>Description</th>
                                            <th>Created At</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($categorize->count() > 0)
                                    @foreach($categorize as $categorizes)
                                        <tr class="table-light">
                                        
                                            <td>{{  $categorizes->id }}</td>
                                            <td>{{  $categorizes->agri_districts_id }}</td>
                                            <td>{{  $categorizes->cat_name}}</td>
                                            <td>{{  $categorizes->cat_descript }}</td>
                                          
                                            <td>{{ $categorizes->created_at}}</td>
                                            <td>{{ $categorizes->updated_at}}</td>
                                                                      
                          
                                                <td>
                                                   
                                                     <a href="{{route('polygon.polygons_edit',  $categorizes->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                        
                                                     <form  action="{{ route('polygon.delete', $categorizes->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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
                                <li><a href="{{ $categorize->previousPageUrl() }}">Previous</a></li>
                                @foreach ($categorize->getUrlRange(1,$categorize->lastPage()) as $page => $url)
                                    <li class="{{ $page == $categorize->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ $categorize->nextPageUrl() }}">Next</a></li>
                            </ul>
                        </div>


                        {{-- labor --}}
                        <input type="radio" name="tabs" id="labors" checked="checked">
                        <label for="labors">Crop Cat</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5>Crop Category</h5>
                                </div>
                                <div class="me-md-1">
                                    <a href="{{ route('parcels.new_parcels') }}" class="btn btn-success">Add</a>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('categorize.index') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('categorize.index') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                      <tr >
                                      
                                        <th>CropCatID</th>
                                        <th>CategoryID</th>
                                        <th>Crop Name</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @if($CropCat->count() > 0)
                                    @foreach($CropCat as $cropcat)
                                        <tr class="table-light">
                                          
                                             <td>{{  $cropcat->id }}</td>
                                            <td>{{  $cropcat->categorizes_id }}</td>
                                            <td>{{  $cropcat->crop_name}}</td>
                                            <td>{{  $cropcat->crop_descript }}</td>
                                            <td>{{ $cropcat->created_at}}</td>
                                            <td>{{ $cropcat->updated_at}}</td>
                                      
                                                                    
                        
                                              <td>
                                                 
                                                   <a href="{{route('polygon.polygons_edit',  $categorizes->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                      
                                                   <form  action="{{ route('polygon.delete', $categorizes->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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
                              <li><a href="{{ $categorize->previousPageUrl() }}">Previous</a></li>
                              @foreach ($categorize->getUrlRange(1,$categorize->lastPage()) as $page => $url)
                                  <li class="{{ $page == $categorize->currentPage() ? 'active' : '' }}">
                                      <a href="{{ $url }}">{{ $page }}</a>
                                  </li>
                              @endforeach
                              <li><a href="{{ $categorize->nextPageUrl() }}">Next</a></li>
                          </ul>
                        
                        </div>

                                             {{-- labor --}}
                                             <input type="radio" name="tabs" id="fisheriesCat" checked="checked">
                                             <label for="fisheriesCat">Fisheries Cat</label>
                                             <div class="tab">
                                                 <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                     <div class="input-group mb-3">
                                                         <h5> Fisheries Category</h5>
                                                     </div>
                                                     <div class="me-md-1">
                                                         <a href="{{ route('parcels.new_parcels') }}" class="btn btn-success">Add</a>
                                                     </div>
                                                     <form id="farmProfileSearchForm" action="{{ route('categorize.index') }}" method="GET">
                                                         <div class="input-group mb-3">
                                                             <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                                             <button class="btn btn-outline-success" type="submit">Search</button>
                                                         </div>
                                                     </form>
                                                     <form id="showAllForm" action="{{ route('categorize.index') }}" method="GET">
                                                         <button class="btn btn-outline-success" type="submit">All</button>
                                                     </form>
                                                 </div>
                                                 <div class="table-responsive">
                                                     <table class="table table-bordered datatable">
                                                         <!-- Table content here -->
                                                         <thead class="thead-light">
                                                           <tr >
                                                           
                                                            <th>FishCatID</th>
                                                            <th>CategoryID</th>
                                                            <th>Fisheries <p>Category Name</p></th>
                                                            <th>Description</th>
                                                            <th>Created At</th>
                                                            <th>Updated</th>
                                                            <th>Action</th>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                        @if($FisheriesCat->count() > 0)
                                                        @foreach($FisheriesCat as $fishcat)
                                                            <tr class="table-light">
                                                               
                                                                 <td>{{  $fishcat->id }}</td>
                                                                <td>{{  $fishcat->categorizes_id }}</td>
                                                                <td>{{  $fishcat->fisheries_category_name}}</td>
                                                                <td>{{  $fishcat->fisheries_description }}</td>
                                                               
                                                                <td>{{ $fishcat->created_at}}</td>
                                                                <td>{{ $fishcat->updated_at}}</td>
                                                                
                                                                                         
                                             
                                                                   <td>
                                                                      
                                                                        <a href="{{route('polygon.polygons_edit',  $categorizes->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                                           
                                                                        <form  action="{{ route('polygon.delete', $categorizes->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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
                                                   <li><a href="{{ $FisheriesCat->previousPageUrl() }}">Previous</a></li>
                                                   @foreach ($FisheriesCat->getUrlRange(1,$FisheriesCat->lastPage()) as $page => $url)
                                                       <li class="{{ $page == $FisheriesCat->currentPage() ? 'active' : '' }}">
                                                           <a href="{{ $url }}">{{ $page }}</a>
                                                       </li>
                                                   @endforeach
                                                   <li><a href="{{ $FisheriesCat->nextPageUrl() }}">Next</a></li>
                                               </ul>
                                             
                                             </div>
                                             {{-- labor --}}
                                             <input type="radio" name="tabs" id="livestockCat" checked="checked">
                                             <label for="livestockCat">Livestock Cat</label>
                                             <div class="tab">
                                                 <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                     <div class="input-group mb-3">
                                                         <h5>Livestock Category</h5>
                                                     </div>
                                                     <div class="me-md-1">
                                                         <a href="{{ route('parcels.new_parcels') }}" class="btn btn-success">Add</a>
                                                     </div>
                                                     <form id="farmProfileSearchForm" action="{{ route('categorize.index') }}" method="GET">
                                                         <div class="input-group mb-3">
                                                             <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                                             <button class="btn btn-outline-success" type="submit">Search</button>
                                                         </div>
                                                     </form>
                                                     <form id="showAllForm" action="{{ route('categorize.index') }}" method="GET">
                                                         <button class="btn btn-outline-success" type="submit">All</button>
                                                     </form>
                                                 </div>
                                                 <div class="table-responsive">
                                                     <table class="table table-bordered datatable">
                                                         <!-- Table content here -->
                                                         <thead class="thead-light">
                                                           <tr >
                                                           
                                                            <th>CropCatID</th>
                                                            <th>CategoryID</th>
                                                            <th>Livestock <p>Category Name</p></th>
                                                            <th>Description</th>
                                                            <th>Created At</th>
                                                            <th>Updated</th>
                                                            <th>Action</th>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                        @if($livestock->count() > 0)
                                                        @foreach($livestock as $fishcat)
                                                            <tr class="table-light">
                                                                
                                                                 <td>{{  $fishcat->id }}</td>
                                                                <td>{{  $fishcat->categorizes_id }}</td>
                                                                <td>{{  $fishcat->livestock_category_name}}</td>
                                                                <td>{{  $fishcat->livestock_description }}</td>
                                                               
                                                                <td>{{ $fishcat->created_at}}</td>
                                                                <td>{{ $fishcat->updated_at}}</td>
                                                               
                                                                                         
                                             
                                                                   <td>
                                                                      
                                                                        <a href="{{route('polygon.polygons_edit',  $categorizes->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                                           
                                                                        <form  action="{{ route('polygon.delete', $categorizes->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                                       @csrf
                                                                           @method('DELETE')
                                                                           <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                                       </form> 
                                                                       
                                                                   </td>
                                                           </tr>
                                                           @endforeach
                                                           @else
                                                           <tr>
                                                               <td class="text-center" colspan="5">Livestock Category is empty</td>
                                                           </tr>
                                                           @endif
                                                       </tbody>
                                                   </table>
                                               </div>
                                                <!-- Pagination links -->
                                                <ul class="pagination">
                                                   <li><a href="{{ $livestock->previousPageUrl() }}">Previous</a></li>
                                                   @foreach ($livestock->getUrlRange(1,$livestock->lastPage()) as $page => $url)
                                                       <li class="{{ $page == $livestock->currentPage() ? 'active' : '' }}">
                                                           <a href="{{ $url }}">{{ $page }}</a>
                                                       </li>
                                                   @endforeach
                                                   <li><a href="{{ $livestock->nextPageUrl() }}">Next</a></li>
                                               </ul>
                                             
                                             </div>
                                             {{-- labor --}}
                                             <input type="radio" name="tabs" id="crop" checked="checked">
                                             <label for="crop">Crop </label>
                                             <div class="tab">
                                                 <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                     <div class="input-group mb-3">
                                                         <h5>Crop</h5>
                                                     </div>
                                                     <div class="me-md-1">
                                                         <a href="{{ route('parcels.new_parcels') }}" class="btn btn-success">Add</a>
                                                     </div>
                                                     <form id="farmProfileSearchForm" action="{{ route('categorize.index') }}" method="GET">
                                                         <div class="input-group mb-3">
                                                             <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                                             <button class="btn btn-outline-success" type="submit">Search</button>
                                                         </div>
                                                     </form>
                                                     <form id="showAllForm" action="{{ route('categorize.index') }}" method="GET">
                                                         <button class="btn btn-outline-success" type="submit">All</button>
                                                     </form>
                                                 </div>
                                                 <div class="table-responsive">
                                                     <table class="table table-bordered datatable">
                                                         <!-- Table content here -->
                                                         <thead class="thead-light">
                                                           <tr >
                                                            <th>CropID</th>
                                                            <th>Crop CategoryID</th>
                                                            <th>Crop Name</th>
                                                            <th>Crop Variety Name</th>
                                                            <th>Crop Planting Season</th> 
                                                            <th>Crop Harvest Season</th>
                                                            <th>Crop Type of Soil</th>
                                                            <th>Description</th>
                                                            <th>Created At</th>
                                                            <th>Updated</th>
                                                            <th>Action</th>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                        @if($Crop->count() > 0)
                                                        @foreach($Crop as $cropcat)
                                                            <tr class="table-light">
                                                               
                                                                 <td>{{  $cropcat->id }}</td>
                                                                <td>{{  $cropcat->crop_categorys_id }}</td>
                                                                <td>{{  $cropcat->crop_name}}</td>
                                                                <td>{{  $cropcat->crop_variety }}</td>
                                                                <td>{{  $cropcat->crop_planting_season}}</td>
                                                                <td>{{  $cropcat->crop_harvesting_season }}</td>
                                                                <td>{{  $cropcat->crop_type_soil }}</td>
                                                                <td>{{  $cropcat->crop_description }}</td>
                                                                <td>{{ $cropcat->created_at}}</td>
                                                                <td>{{ $cropcat->updated_at}}</td>
                                                       
                                                                                         
                                             
                                                                   <td>
                                                                      
                                                                        <a href="{{route('polygon.polygons_edit',  $categorizes->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                                           
                                                                        <form  action="{{ route('polygon.delete', $categorizes->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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
                                                   <li><a href="{{ $Crop->previousPageUrl() }}">Previous</a></li>
                                                   @foreach ($Crop->getUrlRange(1,$Crop->lastPage()) as $page => $url)
                                                       <li class="{{ $page == $Crop->currentPage() ? 'active' : '' }}">
                                                           <a href="{{ $url }}">{{ $page }}</a>
                                                       </li>
                                                   @endforeach
                                                   <li><a href="{{ $Crop->nextPageUrl() }}">Next</a></li>
                                               </ul>
                                             
                                             </div>
                                             {{-- labor --}}
                                             <input type="radio" name="tabs" id="fish" checked="checked">
                                             <label for="fish">Fisheries</label>
                                             <div class="tab">
                                                 <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                     <div class="input-group mb-3">
                                                         <h5>b. Crop Category</h5>
                                                     </div>
                                                     <div class="me-md-1">
                                                         <a href="{{ route('parcels.new_parcels') }}" class="btn btn-success">Add</a>
                                                     </div>
                                                     <form id="farmProfileSearchForm" action="{{ route('categorize.index') }}" method="GET">
                                                         <div class="input-group mb-3">
                                                             <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                                             <button class="btn btn-outline-success" type="submit">Search</button>
                                                         </div>
                                                     </form>
                                                     <form id="showAllForm" action="{{ route('categorize.index') }}" method="GET">
                                                         <button class="btn btn-outline-success" type="submit">All</button>
                                                     </form>
                                                 </div>
                                                 <div class="table-responsive">
                                                     <table class="table table-bordered datatable">
                                                         <!-- Table content here -->
                                                         <thead class="thead-light">
                                                           <tr >
                                                           
                                                            <th>fisheriesID</th>
                                                            <th>Fisheries Category ID</th>
                                                            <th>Species Name</th>
                                                            <th>Common Name</th>
                                                            <th>Habitat</th>
                                                            <th>Description</th>
                                                            <th>Created At</th>
                                                            <th>Updated</th>
                                                            <th>Action</th>
                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                        @if($Fisheries->count() > 0)
                                                        @foreach($Fisheries as $fishcat)
                                                            <tr class="table-light">
                                                               
                                                                <td>{{  $fishcat->id }}</td>
                                                                <td>{{  $fishcat->fisheries_categorys_id }}</td>
                                                                <td>{{  $fishcat->species_name}}</td>
                                                                <td>{{  $fishcat->common_name}}</td>
                                                                <td>{{  $fishcat->habitat}}</td>
                                                                <td>{{  $fishcat->fish_description}}</td>
                                                              
                                                                <td>{{ $fishcat->created_at}}</td>
                                                                <td>{{ $fishcat->updated_at}}</td>
                                                               
                                                                                         
                                             
                                                                   <td>
                                                                      
                                                                        <a href="{{route('polygon.polygons_edit',  $categorizes->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                                           
                                                                        <form  action="{{ route('polygon.delete', $categorizes->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                                       @csrf
                                                                           @method('DELETE')
                                                                           <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                                       </form> 
                                                                       
                                                                   </td>
                                                           </tr>
                                                           @endforeach
                                                           @else
                                                           <tr>
                                                               <td class="text-center" colspan="5">Fisheries is empty</td>
                                                           </tr>
                                                           @endif
                                                       </tbody>
                                                   </table>
                                               </div>
                                                <!-- Pagination links -->
                                                <ul class="pagination">
                                                   <li><a href="{{ $Fisheries->previousPageUrl() }}">Previous</a></li>
                                                   @foreach ($Fisheries->getUrlRange(1,$Fisheries->lastPage()) as $page => $url)
                                                       <li class="{{ $page == $Fisheries->currentPage() ? 'active' : '' }}">
                                                           <a href="{{ $url }}">{{ $page }}</a>
                                                       </li>
                                                   @endforeach
                                                   <li><a href="{{ $Fisheries->nextPageUrl() }}">Next</a></li>
                                               </ul>
                                             
                                             </div>
                        {{-- labor --}}
                        <input type="radio" name="tabs" id="livestock" checked="checked">
                        <label for="livestock">Livestock</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5>Livestock</h5>
                                </div>
                                <div class="me-md-1">
                                    <a href="{{ route('parcels.new_parcels') }}" class="btn btn-success">Add</a>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('categorize.index') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('categorize.index') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                      <tr >
                                      
                                        <th>CropCatID</th>
                                        <th>CategoryID</th>
                                        <th> Livestock<p>CategoryID</p></th>
                                        <th>livestock name</th>
                                        <th>breed</th>
                                        <th>age</th>
                                        <th>gender</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @if($Livestock->count() > 0)
                                    @foreach($Livestock as $cropcat)
                                        <tr class="table-light">
                                          
                                             <td>{{  $cropcat->id }}</td>
                                            <td>{{  $cropcat->categorizes_id }}</td>
                                            <td>{{  $cropcat->livestock_categorys_id}}</td>
                                            <td>{{  $cropcat->livestock_name }}</td>
                                            <td>{{  $cropcat->breed }}</td>
                                            <td>{{  $cropcat->age }}</td>
                                            <td>{{  $cropcat->gender }}</td>
                                            <td>{{  $cropcat->livestock_description }}</td>
                                            <td>{{ $cropcat->created_at}}</td>
                                            <td>{{ $cropcat->updated_at}}</td>
                                            <td>
                                                                    
                        
                                              <td>
                                                 
                                                   <a href="{{route('polygon.polygons_edit',  $categorizes->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                      
                                                   <form  action="{{ route('polygon.delete', $categorizes->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                  @csrf
                                                      @method('DELETE')
                                                      <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                  </form> 
                                                  
                                              </td>
                                      </tr>
                                      @endforeach
                                      @else
                                      <tr>
                                          <td class="text-center" colspan="5">Livestock is empty</td>
                                      </tr>
                                      @endif
                                  </tbody>
                              </table>
                          </div>
                           <!-- Pagination links -->
                           <ul class="pagination">
                              <li><a href="{{ $categorize->previousPageUrl() }}">Previous</a></li>
                              @foreach ($categorize->getUrlRange(1,$categorize->lastPage()) as $page => $url)
                                  <li class="{{ $page == $categorize->currentPage() ? 'active' : '' }}">
                                      <a href="{{ $url }}">{{ $page }}</a>
                                  </li>
                              @endforeach
                              <li><a href="{{ $categorize->nextPageUrl() }}">Next</a></li>
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
