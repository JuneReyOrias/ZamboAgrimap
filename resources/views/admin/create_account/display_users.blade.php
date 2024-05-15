@extends('admin.dashb')
@section('admin')

@extends('layouts._footer-script')
@extends('layouts._head')


<div class="page-content">
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    
                    <h2> Accounts</h2>
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
                        <input type="radio" name="tabs" id="admin" checked="checked">
                        <label for="admin">Admin</label>
                        <div class="tab">
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3 me-md-1">
                                    <h5 for="Seed" class="me-3">a. Admin</h5>
                                </div>
                                                        
                                <div class="me-md-1">
                                    <a href="{{ route('admin.create_account.new_accounts') }}" class="btn btn-success">Add</a>
                                </div>
                            
                                <form id="farmProfileSearchForm" action="{{ route('admin.create_account.display_users') }}" method="GET" class="me-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                            
                                <form id="showAllForm" action="{{ route('admin.create_account.display_users') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            
                            
                               <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light" >
                                        <tr>
                                            <th>#</th>
                                            <th>FullName</th>
                                            <th>Email</th>
                                            <th>Agri-district</th>
                                            
                                            <th>role</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($users->count() > 0)
                                    @foreach($users->where('role','admin') as $user)
                                        <tr class="table-light">
                                           
                                             <td>{{ $user->id }}</td>
                                             <td>{{ $user->first_name.' '.$user->last_name }}</td>
                                             <td>{{ $user->email }}</td>
                                             <td>{{ $user->agri_district }}</td>
                                           
                                            <td>{{ $user->role }}</td>
                                            
                                            <td>{{ $user->created_at}}</td>
                                            <td>{{ $user->updated_at}}</td>
                                            <td>
                                               
                                                 <a href="{{route('admin.create_account.edit_accounts', $user->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                    
                                                 <form  action="{{ route('admin.create_account.delete', $user->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                    {{-- {{ csrf_field()}} --}}@csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                </form>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Admin Account is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                             <!-- Pagination links -->
                             <ul class="pagination">
                                <li><a href="{{ $users->previousPageUrl() }}">Previous</a></li>
                                @foreach ($users->getUrlRange(1,$users->lastPage()) as $page => $url)
                                    <li class="{{ $page == $users->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ $users->nextPageUrl() }}">Next</a></li>
                            </ul>
                        </div>


                        {{-- labor --}}
                        <input type="radio" name="tabs" id="Agent" checked="checked">
                        <label for="Agent">Agent</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5>b. Agent</h5>
                                </div>
                                <div class="me-md-1">
                                    <a href="{{ route('admin.create_account.new_accounts') }}" class="btn btn-success">Add</a>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('admin.create_account.display_users') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('admin.create_account.display_users') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>FullName</th>
                                            <th>Email</th>
                                            <th>Agri-district</th>
                                            
                                            <th>role</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($users->count() > 0)
                                    @foreach($users->where('role','agent') as $user)
                                        <tr class="table-light">
                                           
                                             <td>{{ $user->id }}</td>
                                             <td>{{ $user->first_name.' '.$user->last_name }}</td>
                                             <td>{{ $user->email }}</td>
                                             <td>{{ $user->agri_district }}</td>
                                           
                                            <td>{{ $user->role }}</td>
                                            
                                            <td>{{ $user->created_at}}</td>
                                            <td>{{ $user->updated_at}}</td>
                                            <td>
                                               
                                                 <a href="{{route('admin.create_account.edit_accounts', $user->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                    
                                                 <form  action="{{ route('admin.create_account.delete', $user->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                    {{-- {{ csrf_field()}} --}}@csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                </form>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Agent Account is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                             <!-- Pagination links -->
                             <ul class="pagination">
                                <li><a href="{{ $users->previousPageUrl() }}">Previous</a></li>
                                @foreach ($users->getUrlRange(1,$users->lastPage()) as $page => $url)
                                    <li class="{{ $page == $users->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ $users->nextPageUrl() }}">Next</a></li>
                            </ul>
                        </div>

                     

                        {{-- labor --}}
                        <input type="radio" name="tabs" id="labors" checked="checked">
                        <label for="labors">User</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5>c. Users</h5>
                                </div>
                                <div class="me-md-1">
                                    <a href="{{ route('admin.create_account.new_accounts') }}" class="btn btn-success">Add</a>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('admin.create_account.display_users') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('admin.create_account.display_users') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>FullName</th>
                                            <th>Email</th>
                                            <th>Agri-district</th>
                                            
                                            <th>role</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($users->count() > 0)
                                    @foreach($users->where('role','user') as $user)
                                        <tr class="table-light">
                                           
                                             <td>{{ $user->id }}</td>
                                             <td>{{ $user->first_name.' '.$user->last_name }}</td>
                                             <td>{{ $user->email }}</td>
                                             <td>{{ $user->agri_district }}</td>
                                           
                                            <td>{{ $user->role }}</td>
                                            
                                            <td>{{ $user->created_at}}</td>
                                            <td>{{ $user->updated_at}}</td>
                                            <td>
                                               
                                                 <a href="{{route('admin.create_account.edit_accounts', $user->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                    
                                                 <form  action="{{ route('admin.create_account.delete', $user->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                    {{-- {{ csrf_field()}} --}}@csrf
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
                                <li><a href="{{ $users->previousPageUrl() }}">Previous</a></li>
                                @foreach ($users->getUrlRange(1,$users->lastPage()) as $page => $url)
                                    <li class="{{ $page == $users->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ $users->nextPageUrl() }}">Next</a></li>
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
