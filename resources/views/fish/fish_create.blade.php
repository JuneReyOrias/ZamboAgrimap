@extends('admin.dashb')
@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')
{{-- @extends('agent.agent_Dashboard')
@section('agent')  --}}
{{-- @extends('agent.agent_Dashboard') --}}

{{-- @section('agent') --}}

<div class="page-content">

  <nav class="page-breadcrumb">

  </nav>
  
  {{-- <div class="progress mb-3">
    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">15% Complete</div>

  </div> --}}
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card border rounded">
        @if($errors->any())
        <ul class="alert alert-warning">
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
        @endif
      
          <div class="card-body">
          
          <h6 class="card-title"><span>I.</span>Create Fisheries</h6>

          <br>
       <br>
          <form action{{url('fisheries')}} method="post">
            @csrf
            <div class="row mb-3">
              <div class="col-md-3 mb-3" >
                <label class="form-expand" >Fisheries Category Name:</label>
                <select class="form-control placeholder-text @error('fisheries_categorys_id') is-invalid @enderror" name="fisheries_categorys_id" id="selectseedVarie" onchange="checkseedVarie()" aria-label="label select e">
                  @foreach ($FishCat as $Categorize)
                  <option value="{{ $Categorize->id }}">{{ $Categorize->fisheries_category_name }}</option>

                  @endforeach
                </select>
               
                @error('agri_districts_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="species_name"style="font-size:12px;">Species Name:</label>
                <input type="text" class="form-control placeholder-text @error('species_name') is-invalid @enderror" name="species_name" id="validationCustom01" placeholder="Enter species name" value="{{ old('species_name') }}" >
                @error('species_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="common_name">Common Name:</label>
                <input type="text" class="form-control placeholder-text @error('common_name') is-invalid @enderror" name="common_name" id="validationCustom01" placeholder="Enter common name" value="{{ old('cat_descript') }}" >
                @error('common_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="habitat">Habitat:</label>
                <input type="text" class="form-control placeholder-text @error('habitat') is-invalid @enderror" name="habitat" id="validationCustom01" placeholder="Enter habitat" value="{{ old('cat_descript') }}" >
                @error('habitat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="fish_description">Description:</label>
                <input type="text" class="form-control placeholder-text @error('fish_description') is-invalid @enderror" name="fish_description" id="validationCustom01" placeholder="Enter description" value="{{ old('cat_descript') }}" >
                @error('fish_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            

              </div>

<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button  type="submit" class="btn btn-success me-md-2">Submit</button></a></p>
</div>
          </form>
        
          
        </div>
      </div>
    </div>
  </div>
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
        
          <h4 class="mb-3 mb-md-0">Fisheries</h4>
            <br>
       <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         <div class="table-responsive tab ">
          <table class="table table-bordered datatable">
              <thead class="thead-light">
                  <tr >
                    <th>No.</th>
                      <th>fisheriesID</th>
                      <th>Fisheries Category ID</th>
                      <th>Species Name</th>
                      <th>Common Name</th>
                      <th>Habitat</th>
                      <th>Description</th>
                      <th>Created At</th>
                      <th>Updated</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @if($Fisheries->count() > 0)
              @foreach($Fisheries as $fishcat)
                  <tr class="table-light">
                       <td>{{ $loop->iteration }}</td>
                       <td>{{  $fishcat->id }}</td>
                      <td>{{  $fishcat->fisheries_categorys_id }}</td>
                      <td>{{  $fishcat->species_name}}</td>
                      <td>{{  $fishcat->common_name}}</td>
                      <td>{{  $fishcat->habitat}}</td>
                      <td>{{  $fishcat->fish_description}}</td>
                     
                      <td>{{ $fishcat->created_at}}</td>
                      <td>{{ $fishcat->updated_at}}</td>
                      <td>
{{--                          
                           <a href="{{route('parcels.edit',  $categorize->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
              
                           <form  action="{{ route('parcels.delete',  $categorize->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                              {{ csrf_field()}}
                              <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                          </form> --}}
                         
                      </td>
                  </tr>
              @endforeach
              @else
              <tr>
                  <td class="text-center" colspan="5">Fisheries not found</td>
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
            {{ $Fisheries->links() }}
        </div>
    </div>
      </div>
    </div>
  </div>
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
    

