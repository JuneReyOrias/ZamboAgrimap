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
            <h6 class="card-title"><span>V.</span>Variable Cost</h6>
            <br><br>
            <h5 class="card-title"><span>a.</span>seeds</h5>
            <br><br>
       
            <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         
          
           <div class="table-responsive tab ">
            <table class="table table bordered datatable">
                <thead class="thead-light">
                    <tr >
                        <th>No.</th>
                        <th>seeds id.</th>
                        <th>Seed Name.</th>
                        <th>seed type</th>
                        <th>unit</th>
                        <th>quantity</th>
                        <th>unit price</th>
                        <th>total seed cost</th>
        
                        <th>Created at time</th>
                        <th>Updated at Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($seeds->count() > 0)
                @foreach($seeds as $seed)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                         <td>{{$seed->id}}</td>
                         <td>{{$seed->seed_name }}</td>
                         <td>{{$seed->seed_type }}</td>
                        <td>{{$seed->unit}}</td>
                        <td>{{$seed->quantity }}</td>
                        <td>{{$seed->unit_price}}</td>
                        <td>{{$seed->total_seed_cost }}</td>
                        <td>{{$seed->created_at}}</td>
                        <td>{{$seed->updated_at}}</td>
                        
  
                        <td>
                           
                             <a href="{{route('variable_cost.seeds.seed_edit',  $seed->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action="{{ route('variable_cost.seeds.delete', $seed->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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