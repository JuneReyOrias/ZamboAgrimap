@extends('admin.dashb')
@section('admin')
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
        <div class="card-body">
          
          @if (session('message'))
          <div class="alert alert-success" role="alert">
            {{ session('message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
             
          @endif
         
          @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif
          <h6 class="card-title"><span>I.</span>Create New Polygon Boundary</h6>

          
          <p class="text-success">Make sure to fill in the required information accurately for each field to define the polygon boundary correctly. Once all fields are filled, submit the form to create the new polygon boundary.</p><br>
       
   
         <form action{{url('polygons')}} method="post">
            @csrf
            <div class="row mb-3">
              <h2 class="card-title"><span>a.</span>Polygon per Agri-District:</h2>
              
              <div class="col-md-3 mb-3">
                
                <label class="form-expand" for="agri_districts_id">Agri-District:</label>
                <select class="form-control placeholder-text " name="agri_districts_id" aria-label="agri_districts_id">
                  @foreach ( $agridistrict as  $agridistrict)
                          <option value="{{ $agridistrict->id }}">{{ $agridistrict->district }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="poly_name">PoLy Name:</label>
                <input type="text" class="form-control placeholder-text " name="poly_name" id="validationCustom01" placeholder=" Enter poly name" value="{{ old('poly_name') }}" >
              </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="verone_latitude">Point 1 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('verone_latitude') is-invalid @enderror" name="verone_latitude" id="verone_latitude" placeholder="Enter point 1 latitude" value="{{ old('verone_latitude') }}" >
                  @error('verone_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="verone_longitude">Point 1 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('verone_longitude') is-invalid @enderror" name="verone_longitude" id="verone_longitude" placeholder="Enter point 1 longitude" value="{{ old('verone_longitude') }}" >
                  @error('verone_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="vertwo_latitude">Point 2 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('vertwo_latitude') is-invalid @enderror" name="vertwo_latitude" id="vertwo_latitude" placeholder="Enter point 2 latitude" value="{{ old('vertwo_latitude') }}" >
                  @error('vertwo_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="vertwo_longitude">Point 2 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('vertwo_longitude') is-invalid @enderror" name="vertwo_longitude" id="vertwo_longitude" placeholder="Enter point 2 longitude" value="{{ old('vertwo_longitude') }}" >
                  @error('vertwo_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="verthree_latitude">Point 3 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('verthree_latitude') is-invalid @enderror" name="verthree_latitude" id="verthree_latitude" placeholder="Enter point 3 latitude" value="{{ old('verthree_latitude') }}" >
                  @error('verthree_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="verthree_longitude">Point 3 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('verthree_longitude') is-invalid @enderror" name="verthree_longitude" id="verthree_longitude" placeholder="Enter point 3 longitude" value="{{ old('verthree_longitude') }}" >
                  @error('verthree_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="vertfour_latitude">Point 4 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('vertfour_latitude') is-invalid @enderror" name="vertfour_latitude" id="vertfour_latitude" placeholder="Enter point 4 latitude" value="{{ old('vertfour_latitude') }}" >
                  @error('vertfour_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="vertfour_longitude">Point 4 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('vertfour_longitude') is-invalid @enderror" name="vertfour_longitude" id="vertfour_longitude" placeholder="Enter point 4 longitude" value="{{ old('vertfour_longitude') }}" >
                  @error('vertfour_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="verfive_latitude">Point 5 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('verfive_latitude') is-invalid @enderror" name="verfive_latitude" id="verfive_latitude" placeholder="Enter point 5 latitude" value="{{ old('verfive_latitude') }}" >
                  @error('verfive_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="verfive_longitude">Point 5 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('verfive_longitude') is-invalid @enderror" name="verfive_longitude" id="verfive_longitude" placeholder="Enter point 5 longitude" value="{{ old('verfive_longitude') }}" >
                  @error('verfive_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="versix_latitude">Point 6 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('versix_latitude') is-invalid @enderror" name="versix_latitude" id="versix_latitude" placeholder="Enter point 6 latitude" value="{{ old('versix_latitude') }}" >
                  @error('versix_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="versix_longitude">Point 6 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('versix_longitude') is-invalid @enderror" name="versix_longitude" id="versix_longitude" placeholder="Enter point 6 longitude" value="{{ old('versix_longitude') }}" >
                  @error('versix_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="verseven_latitude">Point 7 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('verseven_latitude') is-invalid @enderror" name="verseven_latitude" id="verseven_latitude" placeholder="Enter point 7 latitude" value="{{ old('verseven_latitude') }}" >
                  @error('verseven_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="verseven_longitude">Point 7 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('verseven_longitude') is-invalid @enderror" name="verseven_longitude" id="verseven_longitude" placeholder="Enter point 7 longitude" value="{{ old('verseven_longitude') }}" >
                  @error('verseven_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="vereight_latitude">Point 8 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('vereight_latitude') is-invalid @enderror" name="vereight_latitude" id="vereight_latitude" placeholder="Enter point 8 latitude" value="{{ old('vereight_latitude') }}" >
                  @error('vereight_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="verteight_longitude">Point 8 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('verteight_longitude') is-invalid @enderror" name="verteight_longitude" id="verteight_longitude" placeholder="Enter point 8 longitude" value="{{ old('verteight_longitude') }}" >
                  @error('verteight_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                    
                  <label class="form-expand" for="strokecolor">Polygon Color:</label>
                  <select class="form-control placeholder-text @error('strokecolor') is-invalid @enderror" name="strokecolor"id="strokecolor" aria-label="label select e" >
                    <option selected disabled>Select color</option>
                    <option value="#00aa00" {{ old('strokecolor') == '#00aa00' ? 'selected' : '' }}>Ayala: #00aa00</option>
                    <option value="#55007f" {{ old('strokecolor') == '#55007f' ? 'selected' : '' }}>Tumaga: #55007f</option>
                    <option value="#ffff00" {{ old('strokecolor') == '#ffff00' ? 'selected' : '' }}>Culianan: #ffff00</option>
                    <option value="#ff5500" {{ old('strokecolor') == '#ff5500' ? 'selected' : '' }}>Manicahan: #ff5500</option>
                    <option value="#ff00ff" {{ old('strokecolor') == '#ff00ff' ? 'selected' : '' }}>Curuan: #ff00ff</option>
                    <option value="#ff0000" {{ old('strokecolor') == '#ff0000' ? 'selected' : '' }}>Vitali: #ff0000</option>
                  </select>

                  @error('strokecolor')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="area">Area:</label>
                  <input type="text" class="form-control placeholder-text @error('area') is-invalid @enderror " name="area" id="validationCustom01" placeholder=" Enter poly area" value="{{ old('area') }}" >
                  @error('area')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="perimeter">Perimeter:</label>
                  <input type="text" class="form-control placeholder-text @error('perimeter') is-invalid @enderror " name="perimeter" id="validationCustom01" placeholder=" Enter poly perimeter" value="{{ old('perimeter') }}" >
             
                @error('perimeter')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
            </div>
           

<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a  href="{{route('polygon.polygons_show')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
  <button  type="submit" class="btn btn-success me-md-2">Submit</button></a></p>
</div>
          </form>
        
          
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