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
            <h6 class="card-title"><span>V.</span>Variable Cost</h6>
            <br><br>
            <h5 class="card-title"><span>d.</span>pesticides</h5>
            
       <br><br>
            <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         
          
           <div class="table-responsive tab ">
            <table class="table table table-info">
                <thead class="thead-light">
                    <tr >
                        <th>No.</th>
                        <th>Variable id.</th>
                        <th>Pesticide Name.</th>
                        <th>type of pesticide</th>
                        <th>no. of l or kg</th>
                        <th>unit price of pesticides</th>
                        <th>total cost of pesticides</th>
                        
        
                        <th>Created at time</th>
                        <th>Updated at Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($pesticides->count() > 0)
                @foreach($pesticides as $pesticide)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                         <td>{{$pesticide->id}}</td>
                         <td>{{$pesticide->pesticides_name }}</td>
                         <td>{{$pesticide->type_ofpesticides }}</td>
                        <td>{{$pesticide->no__of_l_kg}}</td>
                        <td>{{$pesticide->unitprice_ofpesticides }}</td>
                        <td>{{$pesticide->total_cost_pesticides}}</td>
                       
                        <td>{{$pesticide->created_at}}</td>
                        <td>{{$pesticide->updated_at}}</td>
                        
  
                        <td>
                           
                             <a href="{{route('agent.variablecost.pesticides.formsEdit_pesticidesData',  $pesticide->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action="{{ route('agent.variablecost.pesticides.delete', $pesticide->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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