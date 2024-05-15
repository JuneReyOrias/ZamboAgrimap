@extends('admin.dashb')
@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')

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
          <h6 class="card-title"><span>I.</span>Create New Parcellary Boundary</h6>

          <br><br>
          <p class="text-success">Make sure to fill in the required information accurately for each field to define the parcellary boundary correctly. Once all fields are filled, submit the form to create the new parcellary boundary.</p><br>
       
   
          <form action{{url('newparcels')}} method="post">
            @csrf
      
            <div class="row mb-3">
              <h6 class="card-title"><span>I.</span>Parcel owner Informations</h6>
              
              <div class="col-md-3 mb-3">    
               
                <label class="form-expand" for="agri_districts_id">Agri-District:</label>
                <select class="form-control mb-4 mb-md-0" name="agri_districts_id" aria-label="agri_districts_id">
                  @foreach ($agridistricts as $agridistrict)
                          <option value="{{ $agridistrict->id }}">{{ $agridistrict->district }}</option>
                          @endforeach
                  </select>
                 
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="parcel_name">Parcel Name:</label>
                <input type="text" class="form-control placeholder-text @error('parcel_name') is-invalid @enderror" name="parcel_name" id="validationCustom01" placeholder=" Enter parcel name" value="{{ old('parcel_name') }}" >
                @error('parcel_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="arpowner_na">ARP OwnerName:</label>
                <input type="text" class="form-control placeholder-text @error('arpowner_na') is-invalid @enderror" name="arpowner_na" id="validationCustom01" placeholder=" Enter ARP OwnerName" value="{{ old('arpowner_na') }}" >
                @error('arpowner_na')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            
            </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="brgy_name">Brgy. Name:</label>
                <input type="text" class="form-control placeholder-text @error('brgy_name') is-invalid @enderror" name="brgy_name" id="validationCustom01" placeholder=" Enter brgy. name" value="{{ old('brgy_name') }}" >
                @error('brgy_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="tct_no">Land Title no.:</label>
                <input type="text" class="form-control placeholder-text @error('tct_no') is-invalid @enderror" name="tct_no" id="validationCustom01" placeholder=" Enter land title no." value="{{ old('tct_no') }}" >
                @error('tct_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="lot_no">Lot no.:</label>
                <input type="text" class="form-control placeholder-text @error('lot_no') is-invalid @enderror" name="lot_no" id="validationCustom01" placeholder=" Enter lot no" value="{{ old('lot_no') }}" >
                @error('lot_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="pkind_desc">PKind Description:</label>
                <input type="text" class="form-control placeholder-text @error('pkind_desc') is-invalid @enderror" name="pkind_desc" id="validationCustom01" placeholder=" Enter property kind description" value="{{ old('pkind_desc') }}" >
                @error('pkind_desc')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="puse_desc">PUsed Description:</label>
                  <input type="text" class="form-control placeholder-text @error('puse_desc') is-invalid @enderror" name="puse_desc" id="puse_desc" placeholder="Enter property used description" value="{{ old('puse_desc') }}" >
                  @error('verone_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="actual_used">Actual Used:</label>
                  <input type="text" class="form-control placeholder-text @error('actual_used') is-invalid @enderror" name="actual_used" id="actual_used" placeholder="Enter actual used" value="{{ old('actual_used') }}" >
                  @error('actual_used')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <h6 class="card-title"><span>II.</span>Parcel Coordinates</h6>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parone_latitude">Point 1 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parone_latitude') is-invalid @enderror" name="parone_latitude" id="parone_latitude" placeholder="Enter point 1 longitude" value="{{ old('parone_latitude') }}" >
                  @error('parone_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-expand" for="parone_longitude">Point 1 Longitude:</label>
                    <input type="text" class="form-control placeholder-text @error('parone_longitude') is-invalid @enderror" name="parone_longitude" id="parone_longitude" placeholder="Enter point 1 longitude" value="{{ old('parone_longitude') }}" >
                    @error('parone_longitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="partwo_latitude">Point 2 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('partwo_latitude') is-invalid @enderror" name="partwo_latitude" id="partwo_latitude" placeholder="Enter point 2 latitude" value="{{ old('partwo_latitude') }}" >
                  @error('partwo_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="partwo_longitude">Point 2 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('partwo_longitude') is-invalid @enderror" name="partwo_longitude" id="partwo_longitude" placeholder="Enter point 2 longitude" value="{{ old('partwo_longitude') }}" >
                  @error('partwo_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parthree_latitude">Point 3 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parthree_latitude') is-invalid @enderror" name="parthree_latitude" id="parthree_latitude" placeholder="Enter point 3 latitude" value="{{ old('parthree_latitude') }}" >
                  @error('parthree_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parthree_longitude">Point 3 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parthree_longitude') is-invalid @enderror" name="parthree_longitude" id="parthree_longitude" placeholder="Enter point 3 longitude" value="{{ old('parthree_longitude') }}" >
                  @error('parthree_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parfour_latitude">Point 4 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parfour_latitude') is-invalid @enderror" name="parfour_latitude" id="parfour_latitude" placeholder="Enter point 4 latitude" value="{{ old('parfour_latitude') }}" >
                  @error('parfour_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parfour_longitude">Point 4 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parfour_longitude') is-invalid @enderror" name="parfour_longitude" id="parfour_longitude" placeholder="Enter point 4 longitude" value="{{ old('parfour_longitude') }}" >
                  @error('parfour_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parfive_latitude">Point 5 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parfive_latitude') is-invalid @enderror" name="parfive_latitude" id="parfive_latitude" placeholder="Enter point 5 latitude" value="{{ old('parfive_latitude') }}" >
                  @error('parfive_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parfive_longitude">Point 5 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parfive_longitude') is-invalid @enderror" name="parfive_longitude" id="parfive_longitude" placeholder="Enter point 5 longitude" value="{{ old('parfive_longitude') }}" >
                  @error('parfive_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parsix_latitude">Point 6 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parsix_latitude') is-invalid @enderror" name="parsix_latitude" id="parsix_latitude" placeholder="Enter point 6 latitude" value="{{ old('parsix_latitude') }}" >
                  @error('parsix_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parsix_longitude">Point 6 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parsix_longitude') is-invalid @enderror" name="parsix_longitude" id="parsix_longitude" placeholder="Enter point 6 longitude" value="{{ old('parsix_longitude') }}" >
                  @error('parsix_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parseven_latitude">Point 7 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parseven_latitude') is-invalid @enderror" name="parseven_latitude" id="parseven_latitude" placeholder="Enter point 7 latitude" value="{{ old('parseven_latitude') }}" >
                  @error('parseven_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parseven_longitude">Point 7 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parseven_longitude') is-invalid @enderror" name="parseven_longitude" id="parseven_longitude" placeholder="Enter point 7 longitude" value="{{ old('parseven_longitude') }}" >
                  @error('parseven_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pareight_latitude">Point 8 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('pareight_latitude') is-invalid @enderror" name="pareight_latitude" id="pareight_latitude" placeholder="Enter point 8 latitude" value="{{ old('pareight_latitude') }}" >
                  @error('pareight_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pareight_longitude">Point 8 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('pareight_longitude') is-invalid @enderror" name="pareight_longitude" id="pareight_longitude" placeholder="Enter point 8 longitude" value="{{ old('pareight_longitude') }}" >
                  @error('pareight_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parnine_latitude">Point 9 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parnine_latitude') is-invalid @enderror" name="parnine_latitude" id="parnine_latitude" placeholder="Enter point 9 latitude" value="{{ old('parnine_latitude') }}" >
                  @error('parnine_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parnine_longitude">Point 9 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parnine_longitude') is-invalid @enderror" name="parnine_longitude" id="parnine_longitude" placeholder="Enter point 9 longitude" value="{{ old('parnine_longitude') }}" >
                  @error('parnine_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parten_latitude">Point 10 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parten_latitude') is-invalid @enderror" name="parten_latitude" id="parten_latitude" placeholder="Enter point 10 latitude" value="{{ old('parten_latitude') }}" >
                  @error('parten_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parten_longitude">Point 10 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('parten_longitude') is-invalid @enderror" name="parten_longitude" id="parten_longitude" placeholder="Enter point 10 longitude" value="{{ old('parten_longitude') }}" >
                  @error('parten_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pareleven_latitude">Point 11 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('pareleven_latitude') is-invalid @enderror" name="pareleven_latitude" id="pareleven_latitude" placeholder="Enter point 11 latitude" value="{{ old('pareleven_latitude') }}" >
                  @error('pareleven_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pareleven_longitude">Point 11 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('pareleven_longitude') is-invalid @enderror" name="pareleven_longitude" id="pareleven_longitude" placeholder="Enter point 11 longitude" value="{{ old('pareleven_longitude') }}" >
                  @error('pareleven_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="partwelve_latitude">Point 12 Latitude:</label>
                  <input type="text" class="form-control placeholder-text @error('partwelve_latitude') is-invalid @enderror" name="partwelve_latitude" id="partwelve_latitude" placeholder="Enter point 12 latitude" value="{{ old('partwelve_latitude') }}" >
                  @error('partwelve_latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="partwelve_longitude">Point 12 Longitude:</label>
                  <input type="text" class="form-control placeholder-text @error('partwelve_longitude') is-invalid @enderror" name="partwelve_longitude" id="partwelve_longitude" placeholder="Enter point 12 longitude" value="{{ old('partwelve_longitude') }}" >
                  @error('partwelve_longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <h6 class="card-title"><span>III.</span>Parcel color and Area</h6>
                <div class="col-md-3 mb-3">
                    
                  <label class="form-expand" for="parcolor">Parcel Color:</label>
                  <select class="form-control placeholder-text @error('parcolor') is-invalid @enderror" name="parcolor"id="parcolor" aria-label="label select e" >
                    <option selected disabled>Select color</option>
                    <option value="#FFBF00" {{ old('parcolor') == '#FFBF00' ? 'selected' : '' }}>Rice: #FFBF00</option>
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
                  <input type="text" class="form-control placeholder-text @error('area') is-invalid @enderror " name="area" id="validationCustom01" placeholder=" Enter poly area" value="{{ old('area') }}" >
                  @error('area')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
            
            </div>
           

<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a  href="{{route('polygon.polygons_show')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
  <button type="submit" class="btn btn-success me-md-2 btn-submit">Save Changes</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">


  // // Function to handle successful form submission
  // function handleFormSubmissionSuccess() {

    
  //     // Display success message after a short delay
  //     setTimeout(function() {
  //         swal({
  //             title: "Farm Profile completed successfully!",
  //             text: "Thank you for your submission.",
  //             icon: "success",
  //         }).then(() => {
  //             // Redirect to the next page
  //             window.location.href = "/admin-fixedcost"; // Replace with the actual URL
  //         });
  //     }, 500);
  // }

  // jQuery script for form submission
  $(document).ready(function() {
      $(document).on('click', '.btn-submit', function(event) {
          var form = $(this).closest("form");

          event.preventDefault(); // Prevent the default button action

          swal({
              title: "Are you sure you want to submit this form?",
              text: "Please confirm your action.",
              icon: "warning",
              buttons: {
                  cancel: "Cancel",
                  confirm: {
                      text: "Yes, Continue!",
                      value: true,
                      visible: true,
                      className: "btn-success",
                      closeModal: false
                  }
              },
              dangerMode: true,
          }).then((willSubmit) => {
              if (willSubmit) {
                  // Display loading indicator
                  swal({
                      title: "Processing...",
                      text: "Please wait.",
                      buttons: false,
                      closeOnClickOutside: false,
                      closeOnEsc: false,
                      icon: "info",
                      timerProgressBar: true,
                  });

                  // Submit the form after a short delay to allow the loading indicator to be shown
                  setTimeout(function() {
                      form.submit(); // Submit the form
                      handleFormSubmissionSuccess(); // Call the success handling function
                  }, 500);
              }
          });
      });
  });
</script>

@endsection