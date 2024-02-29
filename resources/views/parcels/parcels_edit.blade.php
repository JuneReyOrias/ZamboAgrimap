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
      <div class="card">
        
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
          <h6 class="card-title"><span>I.</span>Create New Parcellary Boundary Update</h6>

          
          <p class="text-success">Make sure to fill in the required information accurately for each field to define the parcellary boundary correctly. Once all fields are filled, submit the form to create the new parcellary boundary.</p><br>
       
   
          <form action{{url('ParcelUpdates')}} method="post">
            @csrf
      
            <div class="row mb-3">
             
              
              <div class="col-md-3 mb-3">    
                @php
              $id = Auth::id();

          // Find the user by their ID and eager load the personalInformation relationship
          $agridistrict= App\Models\AgriDistrict::find($id)->all();

            @endphp
                <label class="form-expand" for="agri_districts_id">Agri-District:</label>
                <select class="form-control mb-4 mb-md-0" name="agri_districts_id" aria-label="agri_districts_id">
                  @foreach ($agridistrict as $agridistrict)
                          <option value="{{ $agridistrict->id }}">{{ $agridistrict->district }}</option>
                          @endforeach
                  </select>
                 
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="parcel_name">Parcel Name:</label>
                <input type="text" class="form-control placeholder-text @error('parcel_name') is-invalid @enderror"value="{{$parcels->parcel_name}}" name="parcel_name" id="validationCustom01" placeholder=" Enter parcel name" value="{{ old('parcel_name') }}" >
                @error('parcel_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="arpowner_na">ARP OwnerName:</label>
                <input type="text" class="form-control placeholder-text @error('arpowner_na') is-invalid @enderror"value="{{$parcels->arpowner_na}}" name="arpowner_na" id="validationCustom01" placeholder=" Enter ARP OwnerName" value="{{ old('arpowner_na') }}" >
                @error('arpowner_na')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            
            </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="brgy_name">Brgy. Name:</label>
                <input type="text" class="form-control placeholder-text @error('brgy_name') is-invalid @enderror"value="{{$parcels->brgy_name}}" name="brgy_name" id="validationCustom01" placeholder=" Enter brgy. name" value="{{ old('brgy_name') }}" >
                @error('brgy_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="tct_no">Land Title no.:</label>
                <input type="text" class="form-control placeholder-text @error('tct_no') is-invalid @enderror"value="{{$parcels->tct_no}}" name="tct_no" id="validationCustom01" placeholder=" Enter land title no." value="{{ old('tct_no') }}" >
                @error('tct_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="lot_no">Lot no.:</label>
                <input type="text" class="form-control placeholder-text @error('lot_no') is-invalid @enderror"value="{{$parcels->lot_no}}" name="lot_no" id="validationCustom01" placeholder=" Enter lot no" value="{{ old('lot_no') }}" >
                @error('lot_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="pkind_desc">PKind Description:</label>
                <input type="text" class="form-control placeholder-text @error('pkind_desc') is-invalid @enderror"value="{{$parcels->pkind_desc}}" name="pkind_desc" id="validationCustom01" placeholder=" Enter property kind description" value="{{ old('pkind_desc') }}" >
                @error('pkind_desc')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="puse_desc">PUsed Description:</label>
                  <input type="text" class="form-control placeholder-text @error('puse_desc') is-invalid @enderror"value="{{$parcels->puse_desc}}" name="puse_desc" id="puse_desc" placeholder="Enter property used description" value="{{ old('puse_desc') }}" >
                  @error('verone_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="actual_used">Actual Used:</label>
                  <input type="text" class="form-control placeholder-text @error('actual_used') is-invalid @enderror"value="{{$parcels->actual_used}}" name="actual_used" id="actual_used" placeholder="Enter actual used" value="{{ old('actual_used') }}" >
                  @error('actual_used')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parone_latitude">Point 1 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parone_latitude') is-invalid @enderror"value="{{$parcels->parone_latitude}}" name="parone_latitude" id="parone_latitude" placeholder="Enter point 1 longitude" value="{{ old('parone_latitude') }}" >
                  @error('parone_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-expand" for="parone_longitude">Point 1 Longitude:</label>
                    <input type="text" class="form-control placeholder-text @error('parone_longitude') is-invalid @enderror"value="{{$parcels->parone_longitude}}" name="parone_longitude" id="parone_longitude" placeholder="Enter point 1 longitude" value="{{ old('parone_longitude') }}" >
                    @error('parone_longitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="partwo_latitude">Point 2 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('partwo_latitude') is-invalid @enderror"value="{{$parcels->partwo_latitude}}" name="partwo_latitude" id="partwo_latitude" placeholder="Enter point 2 latitude" value="{{ old('partwo_latitude') }}" >
                  @error('partwo_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="partwo_longitude">Point 2 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('partwo_longitude') is-invalid @enderror"value="{{$parcels->partwo_longitude}}" name="partwo_longitude" id="partwo_longitude" placeholder="Enter point 2 longitude" value="{{ old('partwo_longitude') }}" >
                  @error('partwo_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parthree_latitude">Point 3 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parthree_latitude') is-invalid @enderror"value="{{$parcels->parthree_latitude}}" name="parthree_latitude" id="parthree_latitude" placeholder="Enter point 3 latitude" value="{{ old('parthree_latitude') }}" >
                  @error('parthree_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parthree_longitude">Point 3 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parthree_longitude') is-invalid @enderror"value="{{$parcels->parthree_longitude}}" name="parthree_longitude" id="parthree_longitude" placeholder="Enter point 3 longitude" value="{{ old('parthree_longitude') }}" >
                  @error('parthree_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parfour_latitude">Point 4 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parfour_latitude') is-invalid @enderror"value="{{$parcels->parfour_latitude}}" name="parfour_latitude" id="parfour_latitude" placeholder="Enter point 4 latitude" value="{{ old('parfour_latitude') }}" >
                  @error('parfour_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parfour_longitude">Point 4 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parfour_longitude') is-invalid @enderror"value="{{$parcels->parfour_longitude}}" name="parfour_longitude" id="parfour_longitude" placeholder="Enter point 4 longitude" value="{{ old('parfour_longitude') }}" >
                  @error('parfour_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parfive_latitude">Point 5 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parfive_latitude') is-invalid @enderror"value="{{$parcels->parfive_latitude}}" name="parfive_latitude" id="parfive_latitude" placeholder="Enter point 5 latitude" value="{{ old('parfive_latitude') }}" >
                  @error('parfive_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parfive_longitude">Point 5 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parfive_longitude') is-invalid @enderror"value="{{$parcels->parfive_longitude}}" name="parfive_longitude" id="parfive_longitude" placeholder="Enter point 5 longitude" value="{{ old('parfive_longitude') }}" >
                  @error('parfive_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parsix_latitude">Point 6 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parsix_latitude') is-invalid @enderror"value="{{$parcels->parsix_latitude}}"  name="parsix_latitude" id="parsix_latitude" placeholder="Enter point 6 latitude" value="{{ old('parsix_latitude') }}" >
                  @error('parsix_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parsix_longitude">Point 6 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parsix_longitude') is-invalid @enderror"value="{{$parcels->parsix_longitude}}" name="parsix_longitude" id="parsix_longitude" placeholder="Enter point 6 longitude" value="{{ old('parsix_longitude') }}" >
                  @error('parsix_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parseven_latitude">Point 7 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parseven_latitude') is-invalid @enderror"value="{{$parcels->parseven_latitude}}" name="parseven_latitude" id="parseven_latitude" placeholder="Enter point 7 latitude" value="{{ old('parseven_latitude') }}" >
                  @error('parseven_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parseven_longitude">Point 7 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parseven_longitude') is-invalid @enderror"value="{{$parcels->parseven_longitude}}" name="parseven_longitude" id="parseven_longitude" placeholder="Enter point 7 longitude" value="{{ old('parseven_longitude') }}" >
                  @error('parseven_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pareight_latitude">Point 8 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('pareight_latitude') is-invalid @enderror"value="{{$parcels->pareight_latitude}}" name="pareight_latitude" id="pareight_latitude" placeholder="Enter point 8 latitude" value="{{ old('pareight_latitude') }}" >
                  @error('pareight_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pareight_longitude">Point 8 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('pareight_longitude') is-invalid @enderror"value="{{$parcels->pareight_longitude}}" name="pareight_longitude" id="pareight_longitude" placeholder="Enter point 8 longitude" value="{{ old('pareight_longitude') }}" >
                  @error('pareight_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parnine_latitude">Point 9 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parnine_latitude') is-invalid @enderror"value="{{$parcels->parnine_latitude}}" name="parnine_latitude" id="parnine_latitude" placeholder="Enter point 9 latitude" value="{{ old('parnine_latitude') }}" >
                  @error('parnine_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parnine_longitude">Point 9 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parnine_longitude') is-invalid @enderror"value="{{$parcels->parnine_longitude}}" name="parnine_longitude" id="parnine_longitude" placeholder="Enter point 9 longitude" value="{{ old('parnine_longitude') }}" >
                  @error('parnine_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parten_latitude">Point 10 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parten_latitude') is-invalid @enderror"value="{{$parcels->parten_latitude}}" name="parten_latitude" id="parten_latitude" placeholder="Enter point 10 latitude" value="{{ old('parten_latitude') }}" >
                  @error('parten_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parten_longitude">Point 10 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parten_longitude') is-invalid @enderror"value="{{$parcels->parten_longitude}}" name="parten_longitude" id="parten_longitude" placeholder="Enter point 10 longitude" value="{{ old('parten_longitude') }}" >
                  @error('parten_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pareleven_latitude">Point 11 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('pareleven_latitude') is-invalid @enderror"value="{{$parcels->pareleven_latitude}}" name="pareleven_latitude" id="pareleven_latitude" placeholder="Enter point 11 latitude" value="{{ old('pareleven_latitude') }}" >
                  @error('pareleven_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pareleven_longitude">Point 11 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('pareleven_longitude') is-invalid @enderror"value="{{$parcels->pareleven_longitude}}" name="pareleven_longitude" id="pareleven_longitude" placeholder="Enter point 11 longitude" value="{{ old('pareleven_longitude') }}" >
                  @error('pareleven_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="partwelve_latitude">Point 12 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('partwelve_latitude') is-invalid @enderror"value="{{$parcels->partwelve_latitude}}" name="partwelve_latitude" id="partwelve_latitude" placeholder="Enter point 12 latitude" value="{{ old('partwelve_latitude') }}" >
                  @error('partwelve_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="partwelve_longitude">Point 12 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('partwelve_longitude') is-invalid @enderror"value="{{$parcels->partwelve_longitude}}" name="partwelve_longitude" id="partwelve_longitude" placeholder="Enter point 12 longitude" value="{{ old('partwelve_longitude') }}" >
                  @error('partwelve_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                    
                  <label class="form-expand" for="parcolor">Parcel Color:</label>
                  <select class="form-control placeholder-text @error('parcolor') is-invalid @enderror" name="parcolor"id="parcolor" aria-label="label select e" >
                    <option value="{{$parcels->parcolor}}">{{$parcels->parcolor}}</option>
                    <option value="#FFBF00" {{ old('parcolor') == '#FFBF00' ? 'selected' : '' }}> Rice:#FFBF00</option>
                    <option value="#ffff3" {{ old('parcolor') == '#ffff3' ? 'selected' : '' }}>Corn: #ffff33</option>
                    <option value="#663300" {{ old('parcolor') == '#663300' ? 'selected' : '' }}>Coconut: #663300</option>
                    <option value="#009900" {{ old('parcolor') == '#009900' ? 'selected' : '' }}>Banana: #009900</option>
                    <option value="#0066ff" {{ old('parcolor') == '#0066ff' ? 'selected' : '' }}>FishPond: #0066ff</option>
                    
                  </select>

                  @error('parcolor')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="area">Area:</label>
                  <input type="text" class="form-control placeholder-text @error('area') is-invalid @enderror "value="{{$parcels->area}}" name="area" id="validationCustom01" placeholder=" Enter parcel area" value="{{ old('area') }}" >
                  @error('area')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
            
            </div>
           

<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a  href="{{route('parcels.show')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
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

</div>
@endsection