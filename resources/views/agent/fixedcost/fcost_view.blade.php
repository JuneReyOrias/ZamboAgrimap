@extends('agent.agent_Dashboard')
@section('agent') 

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
            <h6 class="card-title"><span>III.</span>Fixed Cost Update</h6>
            <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         
          
           <div class="table-responsive tab ">
            <table class="table table table-info">
                <thead class="thead-light">
                    <tr >
                        <th>No.</th>
                        <th>fixed cost id.</th>
                        <th>personal info id.</th>
                        <th>farm profile id</th>
                        <th>particular</th>
                        <th>no_of_ha</th>
                        <th>cost_per_ha</th>
                        <th>total_amount</th>
                        <th>Time of input</th>
                        <th>Updated at Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($fixedcosts->count() > 0)
                @foreach($fixedcosts as $fixedcost)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $fixedcost->id}}</td>
                         <td>{{ $fixedcost->personal_informations_id }}</td>
                         <td>{{ $fixedcost->farm_profiles_id }}</td>
                        <td>{{ $fixedcost->particular }}</td>
                        <td>{{ $fixedcost->no_of_ha }}</td>
                        <td>{{ $fixedcost->cost_per_ha}}</td>
                        <td>{{ $fixedcost->total_amount }}</td>
                        <td>{{ $fixedcost->created_at}}</td>
                        <td>{{ $fixedcost->updated_at}}</td>
                        
  
                        <td>
                           
                             <a href="{{route('agent.fixedcost.fixed_updates', $fixedcost->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action="{{ route('agent.fixedcost.delete', $fixedcost->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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
        {{ $fixedcosts->links() }}
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