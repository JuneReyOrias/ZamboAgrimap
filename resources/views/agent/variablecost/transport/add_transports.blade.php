@extends('agent.agent_Dashboard')
@section('agent') 

<div class="page-content">

  <nav class="page-breadcrumb">
    <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">5(B) out of 6 to Complete</div>
  
    </div>
  </nav>
  
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card bordered rounded">
       
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
        <h5 class="card-title"><span>e.</span>Transport</h5>
        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
       
         
         <form id="myForm" action{{url('AddNewTransport')}} method="post">
            @csrf
            <div >

              <input type="hidden" name="users_id" value="{{ $userId}}">
             
           
       </div>
                  {{-- adding new transport data --}}
            <div class="row mb-3">
              <h2 class="card-title"><span></span>Transport info:</h2>
            
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="name_of_vehicle">Name of Vehicle:</label>
                <input type="text" class="form-control placeholder-text @error('name_of_vehicle') is-invalid @enderror" name="name_of_vehicle" id="quantityInput" placeholder="Enter name of vehicle" value="{{ old('name_of_vehicle') }}" >
                @error('name_of_vehicle')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-expand" for="type_of_vehicle">Type of Vehicle:</label>
                <input type="text" class="form-control placeholder-text @error('type_of_vehicle') is-invalid @enderror" name="type_of_vehicle" id="unitPriceInput" placeholder="Enter type of vehicle" value="{{ old('type_of_vehicle') }}" >
                @error('type_of_vehicle')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-expand" for="total_transport_per_deliverycost">Total DeliveryCost(PHP):</label>
                <input type="text" class="form-control placeholder-text @error('total_transport_per_deliverycost') is-invalid @enderror" name="total_transport_per_deliverycost" id="totalLaborCostInput" placeholder="Enter total transport cost" value="{{ old('total_transport_per_deliverycost') }}" >
                @error('total_transport_per_deliverycost')
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
    //  total Transport cost in decimal formats
document.addEventListener('DOMContentLoaded', function() {
    // Get input elements
    const totalLaborCostInput = document.getElementById('totalLaborCostInput');
  

    // Add event listeners for input events
    totalLaborCostInput.addEventListener('input', formatDecimal);
   

    // Function to format input values as decimal
    function formatDecimal(event) {
        const input = event.target;
        // Get the input value
        let value = input.value;
        // Remove any non-numeric characters and leading zeroes
        value = value.replace(/[^0-9.]/g, '');
        // Format the value as a decimal number
        value = parseFloat(value).toFixed(2);
        // Update the input value
        input.value = value;
    }
    
});
</script>
  @endsection