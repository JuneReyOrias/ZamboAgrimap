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
            <h6 class="card-title"><span>I.</span>Farmers Demographic and Production data</h6>
  
           <p class="text-muted mb-3">Read the <a href="https://github.com/RobinHerbots/Inputmask" target="_blank"> Official Inputmask Documentation </a>for a full list of instructions and other options.</p>
           <div class="table-responsive tab ">
            <table class="table table table-info">
                <thead class="thead-light">
                    <tr >
                        <th>Farmer No.</th>
                        <th>FirtsName</th>
                        <th>LastnName</th>
                        <th>tenurial status</th>
                        <th>total amount</th>
                        <th>total cost for_machineries</th>
                        <th>total seed cost</th>
                        <th>total cost fertilizers</th>
                        <th>total labor cost</th>
                        <th>total cost pesticides</th>
                        <th>total transport per_deliverycost</th>
                        <th>total machinery fuel_cost</th>
                        <th>gross income palay</th>
                        <th>gross income rice</th>
                       
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($personalInformations->count() > 0)

                @foreach($personalInformations as $personalInformation)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                        <td>{{ $personalInformation->first_name }}</td>
                        <td>{{ $personalInformation->last_name }}</td>
                      <td>{{ $personalInformation->tenurial_status }}</td>
                        <td>{{ $personalInformation->total_amount}}</td>
                        <td>{{ $personalInformation->total_cost_for_machineries }}</td>
                        <td>{{ $personalInformation->total_seed_cost }}</td>
                        <td>{{ $personalInformation->total_cost_fertilizers }}</td>
                        <td>{{ $personalInformation->total_labor_cost}}</td>
                        <td>{{ $personalInformation->total_cost_pesticides }}</td>
                        <td>{{ $personalInformation->total_transport_per_deliverycost }}</td>
                        <td>{{ $personalInformation->total_machinery_fuel_cost}}</td>
                        <td>{{ $personalInformation->gross_income_palay}}</td>
                        <td>{{ $personalInformation->gross_income_rice }}</td>
                       
                        
  
                        <td>
                           
                             {{-- <a href="" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action=""method="post" accept-charset="UTF-8" style="display:inline">
                                {{ csrf_field()}}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form> --}}
                            {{-- <div class="col-sm">
                                <form action="{{ route('personalinfo.destroy', $personalInformations->id) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div> --}}
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