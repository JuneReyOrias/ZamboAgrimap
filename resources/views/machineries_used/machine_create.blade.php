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
            </div>
               
            @endif
            <h6 class="card-title"><span>IV.</span>Machineries Used</h6>
  
           <p class="text-muted mb-3">Read the <a href="https://github.com/RobinHerbots/Inputmask" target="_blank"> Official Inputmask Documentation </a>for a full list of instructions and other options.</p>
           <div class="table-responsive tab ">
            <table class="table table table-info">
                <thead class="thead-light">
                    <tr >
                        <th>Farmno.</th>
                        <th>plowing_machineries_used</th>
                        <th>plo_ownership_status</th>
                        <th>no_of_plowing</th>
                        <th>plowing_cost</th>
                        <th>harrowing_machineries_used</th>
                        <th>harro_ownership_status</th>
                        <th>no_of_harrowing</th>
                        <th>harrowing_cost</th>
                        <th>harvesting_machineries_used</th>
                        <th>harvest_ownership_status</th>
                        <th>harvesting_cost</th>
                        <th>postharvest_machineries_used</th>
                        <th>postharv_ownership_status</th>
                        <th>post_harvest_cost</th>
                        <th>total_cost_for_machineries'</th>
                        <th>Time of input</th>
                        <th>Updated at Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($machineriesused->count() > 0)
                @foreach($machineriesused as $machineriesused)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                        <td>{{ $machineriesused->plowing_machineries_used }}</td>
                        <td>{{ $machineriesused->plo_ownership_status }}</td>
                        <td>{{ $machineriesused->no_of_plowing }}</td>
                        <td>{{ $machineriesused->plowing_cost }}</td>
                        <td>{{ $machineriesused->harrowing_machineries_used}}</td>
                        <td>{{ $machineriesused->harro_ownership_status }}</td>
                        <td>{{ $machineriesused->no_of_harrowing }}</td>
                        <td>{{ $machineriesused->harrowing_cost }}</td>
                        <td>{{ $machineriesused->harvesting_machineries_used}}</td>
                        <td>{{ $machineriesused->harvest_ownership_status}}</td>
                        <td>{{ $machineriesused->harvesting_cost}}</td>
                        <td>{{ $machineriesused->postharvest_machineries_used }}</td>
                        <td>{{ $machineriesused->postharv_ownership_status }}</td>
                        <td>{{ $machineriesused->post_harvest_cost }}</td>
                        <td>{{ $machineriesused->total_cost_for_machineries}}</td>
                        <td>{{ $machineriesused->created_at}}</td>
                        <td>{{ $machineriesused->updated_at}}</td>
                        <td>
                        
                            <a href="{{route('machineries_used.edit', $machineriesused->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action="{{ route('machineries_used.destroy', $machineriesused->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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
        </div>
      </div>
    </div>
</div>
</div>
</div>

</div>

</div>@endsection