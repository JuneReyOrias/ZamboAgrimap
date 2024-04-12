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
          
          <h6 class="card-title"><span>I.</span>Create Livetock Category</h6>

          <br>
          <br>
          <form action{{url('livestock_categorys')}} method="post">
            @csrf
            <div class="row mb-3">
              <div class="col-md-3 mb-3" >
                <label class="form-expand" >Category Name:</label>
                <select class="form-control placeholder-text @error('categorizes_id') is-invalid @enderror" name="categorizes_id" id="selectseedVarie" onchange="checkseedVarie()" aria-label="label select e">
                  @foreach ($Cat as $Categorize)
                  <option value="{{ $Categorize->id }}">{{ $Categorize->cat_name }}</option>

                  @endforeach
                </select>
               
                @error('agri_districts_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="livestock_category_name"style="font-size:11px;">Livestock Category Name:</label>
                <input type="text" class="form-control placeholder-text @error('livestock_category_name') is-invalid @enderror" name="livestock_category_name" id="validationCustom01" placeholder="Enter livestocks category name" value="{{ old('livestock_category_name') }}" >
                @error('livestock_category_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="livestock_description">Description:</label>
                <input type="text" class="form-control placeholder-text @error('livestock_description') is-invalid @enderror" name="livestock_description" id="validationCustom01" placeholder="Enter description" value="{{ old('cat_descript') }}" >
                @error('livestock_description')
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
        
          <h4 class="mb-3 mb-md-0">Livestock Category</h4>
            <br>
       <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         <div class="table-responsive tab ">
          <table class="table table-bordered datatable">
              <thead class="thead-light">
                  <tr >
                    <th>No.</th>
                      <th>CropCatID</th>
                      <th>CategoryID</th>
                      <th>Livestock Category Name</th>
                      <th>Description</th>
                      <th>Created At</th>
                      <th>Updated</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @if($livestock->count() > 0)
              @foreach($livestock as $fishcat)
                  <tr class="table-light">
                       <td>{{ $loop->iteration }}</td>
                       <td>{{  $fishcat->id }}</td>
                      <td>{{  $fishcat->categorizes_id }}</td>
                      <td>{{  $fishcat->livestock_category_name}}</td>
                      <td>{{  $fishcat->livestock_description }}</td>
                     
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
                  <td class="text-center" colspan="5">Livestock Category not found</td>
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
            {{ $livestock->links() }}
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
    

