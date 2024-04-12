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
          
          <h6 class="card-title"><span>VI.</span>Last Production Data (view, edit, delete)</h6>
<br><br>
          <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
       
         <div class="table-responsive tab ">
          <table class="table table bordered dataTable">
              <thead class="thead-light">
                  <tr >
                      <th>no.</th>
                      <th>Last production_id</th>
                      <th>personal info id</th>
                      <th>farm profile id</th>
                      <th>agri district id</th>
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
                @if($productions->count() > 0)
              @foreach($productions as $lastproductdata)
                  <tr class="table-light">
                       <td>{{ $loop->iteration }}</td>
                       <td>{{ $lastproductdata->id}}</td>
                       <td>{{ $lastproductdata->personal_informations_id}}</td>
                       <td>{{ $lastproductdata->farm_profiles_id}}</td>
                       <td>{{ $lastproductdata->agri_districts_id}}</td>

                      <td>{{ $lastproductdata->seeds_typed_used}}</td>
                      <td>{{ $lastproductdata->seeds_used_in_kg}}</td>
                      <td>{{ $lastproductdata->seed_source}}</td>
                      <td>{{ $lastproductdata->no_of_fertilizer_used_in_bags}}</td>
                      <td>{{ $lastproductdata->no_of_pesticides_used_in_l_per_kg}}</td>
                      <td>{{ $lastproductdata->no_of_insecticides_used_in_l }}</td>
                      <td>{{ $lastproductdata->area_planted }}</td>
                      <td>{{ $lastproductdata->date_planted}}</td>
                      <td>{{ $lastproductdata->date_harvested}}</td>
                      <td>{{ $lastproductdata->yield_tons_per_kg}}</td>
                      <td>{{ $lastproductdata->unit_price_palay_per_kg}}</td>
                      <td>{{ $lastproductdata->unit_price_rice_per_kg}}</td>
                      <td>{{ $lastproductdata->type_of_product}}</td>
                      <td>{{ $lastproductdata->sold_to}}</td>
                      <td>{{ $lastproductdata->if_palay_milled_where}}</td>
                      <td>{{ $lastproductdata->gross_income_palay}}</td>
                      <td>{{ $lastproductdata->gross_income_rice}}</td>
                      <td>{{ $lastproductdata->created_at}}</td>
                      <td>{{ $lastproductdata->updated_at}}</td>
                      <td>
                      
                          <a href="{{route('agent.lastproduction.last_edit', $lastproductdata->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
              
                           <form  action="{{ route('agent.lastproduction.delete', $lastproductdata->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
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
           <!-- Pagination links -->
<div class="row"style="align-content: center;display: flex;
      align-items: center; align-self: center">
<div class="col-md-7" style="align-content: center;display: flex;
           align-items: center;">
      {{ $productions->links() }}
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