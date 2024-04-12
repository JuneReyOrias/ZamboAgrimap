@extends('admin.dashb')
@section('admin')

@extends('layouts._footer-script')
@extends('layouts._head')

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
            <h6 class="card-title"><span>V.</span>Variable Cost</h6>
           <br><br> <h5 class="card-title"><span>b.</span>labors</h5>
            
       <br><br>
            <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         
          
          
            <div class="table-responsive tab ">
                <table class="table table bordered datatable">
                    <thead class="thead-light">
                        <tr >
                            <th>No.</th>
                            <th>labor id.</th>
                            <th>No. OF PERSON</th>
                            <th>rate/person</th>
                            <th>total labor cost</th>
                            
                      
            
                            <th>Created at time</th>
                            <th>Updated at Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if($labors->count() > 0)
                    @foreach($labors as $labor)
                        <tr class="table-light">
                             <td>{{ $loop->iteration }}</td>
                             <td>{{$labor->id}}</td>
                             <td>{{$labor->no_of_person }}</td>
                             <td>{{$labor->rate_per_person }}</td>
                            <td>{{$labor->total_labor_cost}}</td>
                           
                            
                            <td>{{$labor->created_at}}</td>
                            <td>{{$labor->updated_at}}</td>
                            
      
                            <td>
                                  <a href="{{route('variable_cost.labor.labors_edit',  $labor->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action="{{ route('variable_cost.labor.delete', $labor->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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
          {{-- <!-- Pagination links -->
<div class="row"style="align-content: center;display: flex;
align-items: center; align-self: center">
    <div class="col-md-7" style="align-content: center;display: flex;
    align-items: center;">
        {{ $fixedcosts->links() }}
    </div> --}}
</div>
        </div>
      </div>
    </div>
</div>
</div>
</div>

</div>

</div>@endsection