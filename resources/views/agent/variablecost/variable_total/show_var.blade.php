@extends('agent.agent_Dashboard')
@section('agent') 
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
            <h6 class="card-title"><span>VI.</span>Variable Cost</h6>
            <br><br>
            <h5 class="card-title"><span>F.</span>Variable Cost Total</h5>
            
       <br><br>
            <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         
          
           <div class="table-responsive tab ">
            <table class="table table table-info">
                <thead class="thead-light">
                    <tr >
                        <th>No.</th>
                        <th>seeds id.</th>
                        <th>Personl Info id.</th>
                        <th>farm profile id</th>
                        <th>seed id</th>
                        <th>labor id</th>
                        <th>fertilizer id</th>
                        <th>pesticides id</th>
                        <th>transport id</th>
                        <th>total machinery/delivery cost</th>
                        <th>total variable cost</th>
                        <th>Created at time</th>
                        <th>Updated at Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($variable->count() > 0)
                @foreach($variable as $vartotal)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                         <td>{{$vartotal->id}}</td>
                         <td>{{$vartotal->personal_informations_id }}</td>
                         <td>{{$vartotal->farm_profiles_id }}</td>
                        <td>{{$vartotal->seeds_id}}</td>
                        <td>{{$vartotal->labors_id }}</td>
                        <td>{{$vartotal->fertilizers_id}}</td>
                        <td>{{$vartotal->pesticides_id }}</td>
                       
                        <td>{{$vartotal->transports_id}}</td>
                        <td>{{$vartotal->total_machinery_fuel_cost }}</td>
                        <td>{{$vartotal->total_variable_cost}}</td>
                        <td>{{$vartotal->created_at}}</td>
                        <td>{{$vartotal->updated_at}}</td>
                        
  
                        <td>
                           
                             <a href="{{route('agent.variablecost.variable_total.var_edited',  $vartotal->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action="{{ route('agent.variablecost.variable_total.delete', $vartotal->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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