@extends('admin.dashb')
@section('admin')


<div class="page-content">

    <nav class="page-breadcrumb">
  
    </nav>
   
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          
          <div class="card-body">
            @if (session('message'))
            <div class="alert alert-success" role="alert">
              {{ session('message')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
           
            @endif
            <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a  href="{{route('parcels.new_parcels')}}"button  class="btn btn-success me-md-2">Add New Polygon</button></a></p>
              
              </div>   
            <h6 class="card-title"><span>I.</span>Personal Information</h6>
  
         <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
           <div class="table-responsive tab ">
            <table class="table table table-info">
                <thead class="thead-light">
                    <tr >
                      <th>No.</th>
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
                        <th>created</th>
                        <th>updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($parcels->count() > 0)
                @foreach($parcels as $personalinformation)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
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
                        <td>{{ $personalinformation->created_at}}</td>
                        <td>{{ $personalinformation->updated_at}}</td>
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
              {{ $parcels->links() }}
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