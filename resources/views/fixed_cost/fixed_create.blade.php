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
            <h6 class="card-title"><span>III.</span>Fixed Cost</h6>
  
           <p class="text-muted mb-3">Read the <a href="https://github.com/RobinHerbots/Inputmask" target="_blank"> Official Inputmask Documentation </a>for a full list of instructions and other options.</p>
           <div class="table-responsive tab ">
            <table class="table table table-info">
                <thead class="thead-light">
                    <tr >
                        <th>fixed_no.</th>
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
                  @if($fixedcost->count() > 0)
                @foreach($fixedcost as $fixedcost)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                        <td>{{ $fixedcost->particular }}</td>
                        <td>{{ $fixedcost->no_of_ha }}</td>
                        <td>{{ $fixedcost->cost_per_ha}}</td>
                        <td>{{ $fixedcost->total_amount }}</td>
                        <td>{{ $fixedcost->created_at}}</td>
                        <td>{{ $fixedcost->updated_at}}</td>
                        
  
                        <td>
                           
                             <a href="{{route('fixed_cost.edit', $fixedcost->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action="{{ route('fixed_cost.destroy', $fixedcost->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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
        </div>
      </div>
    </div>
</div>
</div>
</div>

</div>

</div>@endsection