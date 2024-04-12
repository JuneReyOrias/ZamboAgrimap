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
           
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
           
          
            <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a  href="{{route('polygon.create')}}"button  class="btn btn-success me-md-2">Add New Polygon</button></a></p>
              
              </div>   
            <h4 class="mb-3 mb-md-0">Agri-district Polygon Boundary</h4>
            
       <br>
            <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         
          
           <div class="table-responsive tab ">
            <table class="table table-bordered datatable">
                <thead class="thead-light">
                    <tr >
                        <th>No.</th>
                        <th>polygon id.</th>
                        <th>agri-district id.</th>
                        <th>Poly name</th>
                        <th>point 1 lat</th>
                        <th>point 1 lng</th>
                        <th>pontt 2 lat</th>
                        <th>point 2 lng</th>
                        <th>pontt 3 lat</th>
                        <th>point 3 lng</th>
                        <th>pontt 4 lat</th>
                        <th>point 4 lng</th>
                        <th>pontt 5 lat</th>
                        <th>point 5 lng</th>
                        <th>pontt 6 lat</th>
                        <th>point 6 lng</th>
                        <th>pontt 7 lat</th>
                        <th>point 7 lng</th>
                        <th>pontt 8 lat</th>
                        <th>point 8 lng</th>
                        <th>area</th>
                        <th>perimeter</th>
                        <th>Created at time</th>
                        <th>Updated at Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($polygons->count() > 0)
                @foreach($polygons as $seed)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                         <td>{{$seed->id}}</td>
                         <td>{{$seed->agri_districts_id }}</td>
                         <td>{{$seed->poly_name }}</td>
                         <td>{{$seed->strokecolor }}</td>
                         <td>{{$seed->verone_latitude }}</td>
                        <td>{{$seed->verone_longitude}}</td>
                        <td>{{$seed->vertwo_latitude }}</td>
                        <td>{{$seed->vertwo_longitude}}</td>
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
                        <td>{{$seed->created_at}}</td>
                        <td>{{$seed->updated_at}}</td>
                        
  
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
        {{ $polygons->links() }}
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