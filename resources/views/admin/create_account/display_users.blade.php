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
            <h6 class="card-title align-items-center"><span></span>Users Accounst Info</h6>
            <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a  href="{{route('admin.create_account.new_accounts')}}"button  class="btn btn-success me-md-2">Add New</button></a></p>
                
              </div>
       <br>
           <div class="table-responsive tab ">
            <table class="table table bordered data-table">
                <thead class="thead-light">
                    <tr >
                        <th>NO</th>
                        <th>users id.</th>
                        <th>FullName</th>
                        <th>Email</th>
                        <th>Agri-district</th>
                        <th>password</th>
                        <th>role</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($users->count() > 0)
                @foreach($users as $user)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $user->id }}</td>
                         <td>{{ $user->name }}</td>
                         <td>{{ $user->email }}</td>
                         <td>{{ $user->agri_district }}</td>
                        <td>{{ $user->password }}</td>
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
</div>
</div>

</div>

</div>@endsection