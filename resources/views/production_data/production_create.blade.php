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
            <h6 class="card-title"><span>VI.</span>Last Production Data</h6>
  
           <p class="text-muted mb-3">Read the <a href="https://github.com/RobinHerbots/Inputmask" target="_blank"> Official Inputmask Documentation </a>for a full list of instructions and other options.</p>
           <div class="table-responsive tab ">
            <table class="table table table-info">
                <thead class="thead-light">
                    <tr >
                        <th>production_id</th>
                        <th>seed_type_used</th>
                        <th>seeds_used_in_kg</th>
                        <th>seed_source</th>
                        <th>no_of_fertilizer_used</th>
                        <th>no_of_pesticides_used</th>
                        <th>no_of_insecticides_used</th>
                        <th>area_planted</th>
                        <th>date_planted</th>
                        <th>date_harvested</th>
                        <th>yield_tons_per_kg</th>
                        <th>unitprice_palay_kgt</th>
                        <th>unitprice_rice_kg</th>
                        <th>type_ofproduct</th>
                        <th>sold_to</th>
                        <th>palay_milled'</th>
                        <th>gross_income_palay'</th>
                        <th>gross_income_rice'</th>
                        <th>Time of input</th>
                        <th>Updated at Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($lastproductiondata->count() > 0)
                @foreach($lastproductiondata as $lastproductiondata)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                        <td>{{ $lastproductiondata->seeds_typed_used}}</td>
                        <td>{{ $lastproductiondata->seeds_used_in_kg}}</td>
                        <td>{{ $lastproductiondata->seed_source}}</td>
                        <td>{{ $lastproductiondata->no_of_fertilizer_used_in_bags}}</td>
                        <td>{{ $lastproductiondata->no_of_pesticides_used_in_l_per_kg}}</td>
                        <td>{{ $lastproductiondata->no_of_insecticides_used_in_l }}</td>
                        <td>{{ $lastproductiondata->area_planted }}</td>
                        <td>{{ $lastproductiondata->date_planted}}</td>
                        <td>{{ $lastproductiondata->date_harvested}}</td>
                        <td>{{ $lastproductiondata->yield_tons_per_kg}}</td>
                        <td>{{ $lastproductiondata->unit_price_palay_per_kg}}</td>
                        <td>{{ $lastproductiondata->unit_price_rice_per_kg}}</td>
                        <td>{{ $lastproductiondata->type_of_product}}</td>
                        <td>{{ $lastproductiondata->sold_to}}</td>
                        <td>{{ $lastproductiondata->if_palay_milled_where}}</td>
                        <td>{{ $lastproductiondata->gross_income_palay}}</td>
                        <td>{{ $lastproductiondata->gross_income_rice}}</td>
                        <td>{{ $lastproductiondata->created_at}}</td>
                        <td>{{ $lastproductiondata->updated_at}}</td>
                        <td>
                        
                            <a href="{{route('production_data.edit', $lastproductiondata->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action="{{ route('production_data.destroy', $lastproductiondata->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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