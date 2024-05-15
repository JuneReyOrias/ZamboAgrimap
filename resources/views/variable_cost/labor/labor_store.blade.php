@extends('admin.dashb')
@section('admin')

@extends('layouts._footer-script')
@extends('layouts._head')
<div class="page-content">

  <nav class="page-breadcrumb">

  </nav>
  <div class="progress mb-3">
    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">5(B) out of 6 to Complete</div>

  </div>
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card border rounded">
        {{-- @if($errors->any())
        <ul class="alert alert-warning">
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
        @endif --}}
        <div class="card-body">
          @if (session()->has('message'))
          <div class="alert alert-success" id="success-alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  
        {{session()->get('message')}}
      </div>
      @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <h6 class="card-title"><span>V.</span>Variable Cost</h6>
        <br> <br>
        <h5 class="card-title"><span>b.</span>Labor</h5><br><br>
        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
    
          <form id="myForm" action{{url('labors')}} method="post">
            @csrf
            <div >

              <input type="hidden" name="users_id" value="{{ $userId}}">
             
           
       </div>
            {{-- adding new labor data --}}
            <div class="row mb-3">
              <h2 class="card-title"><span></span>Labors informations:</h2>
            
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="no_of_person">No of Person:</label>
                <input type="text" class="form-control placeholder-text @error('no_of_person') is-invalid @enderror" name="no_of_person" id="quantityInput" placeholder="Enter no_of_person" value="{{ old('no_of_person') }}" >
                @error('no_of_person')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-expand" for="rate_per_person">Rate per Person:</label>
                <input type="text" class="form-control placeholder-text @error('rate_per_person') is-invalid @enderror" name="rate_per_person" id="unitPriceInput" placeholder="Enter rate/person" value="{{ old('rate_per_person') }}" >
                @error('rate_per_person')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-expand" for="total_labor_cost">Total Labor Cost:</label>
                <input type="text" class="form-control placeholder-text @error('total_labor_cost') is-invalid @enderror" name="total_labor_cost" id="totalLaborCostInput" placeholder="Enter total labor cost" value="{{ old('total_labor_cost') }}" >
                @error('total_labor_cost')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            </div>


  <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
      {{-- <a  href="{{route('production_data.index')}}"button  class="btn btn-success me-md-2">Back</button></a></p> --}}
      <button type="submit" class="btn btn-success me-md-2 btn-submit">Next</button>
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

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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


  <script>
    // Function to calculate total labor cost
    function calculateTotalLaborCost() {
        var noOfPerson = parseFloat(document.getElementById("quantityInput").value);
        var ratePerPerson = parseFloat(document.getElementById("unitPriceInput").value);
        
        var totalLaborCost = noOfPerson * ratePerPerson;

        // Update the total labor cost input field
        document.getElementById("totalLaborCostInput").value = totalLaborCost.toFixed(2); // Format to two decimal places
    }

    // Attach event listeners to trigger calculation on input change
    document.getElementById("quantityInput").addEventListener("input", calculateTotalLaborCost);
    document.getElementById("unitPriceInput").addEventListener("input", calculateTotalLaborCost);
</script>
  
  
  
  
  
  @endsection