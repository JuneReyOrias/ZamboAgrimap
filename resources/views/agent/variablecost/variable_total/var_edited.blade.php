
@extends('agent.agent_Dashboard')
@section('agent') 
<div class="page-content">

  <nav class="page-breadcrumb">
    <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">5(F) out of 6 to Complete</div>
  
    </div>
  </nav>
  
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card border rounded">
        
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
        <h6 class="card-title"><span>VI.</span>Variable Cost</h6><br><br>
        <h5 class="card-title"><span>F. </span>Variable Cost Total</h5><br><br>
        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
      
         <form id="myForm" action{{url('updatesvar')}} method="post">
            @csrf

            <div>
             
              
              <input type="hidden" id="seeds_id" class="form-control mb-4 mb-md-0" name="total_seed_cost" id="seeds_id" value="{{ $variable->seeds->total_seed_cost}}">
               
            </div>  

            <div>
             
              
              <input type="hidden" id="labors_id" class="form-control mb-4 mb-md-0" name="total_labor_cost" value="{{ $variable->labors->total_labor_cost}}">
               
            </div>  


            <div>
            
              <input type="hidden" id="fertilizers_id" class="form-control mb-4 mb-md-0" name="total_cost_fertilizers" i value="{{ $variable->fertilizers->total_cost_fertilizers}}">
               
            </div>

        
            <div>
             
              
              <input type="hidden" id="pesticides_id" class="form-control mb-4 mb-md-0" name="total_cost_pesticides" i value="{{ $variable->pesticides->total_cost_pesticides}}">
               
            </div>

            <div>
            
              
              <input type="hidden" id="transports_id" class="form-control mb-4 mb-md-0" name="total_transport_per_deliverycost" i value="{{ $variable->transports->total_transport_per_deliverycost}}">
               
            </div>


            <div class="row mb-3">
              <h2 class="card-title"><span>a.</span>Farmer Variable Cost:</h2>
                     <div >

                    <input type="hidden" name="users_id" value="{{ $userId}}">
                   
                 
             </div>
              <div class="col-md-3 mb-3">    
             
                <label class="form-expand" for="personal_informations_id">Farmers Name:</label>
                <select class="form-control placeholder-text" name="personal_informations_id" aria-label="personal_informations_id">
                      
                  <option value="{{ $variable->personal_informations_id }}">{{ $variable->personalinformation->first_name.' '. $variable->personalinformation->last_name}}</option>
            
          </select>
              </div>
              <div class="col-md-3 mb-3">    
               
                <label class="form-expand" for="farm_profiles_id">FarmProfile:</label>
                <select class="form-control mb-4 mb-md-0" name="farm_profiles_id" aria-label="farm_profiles_id">
               
                  @if($variable)

                  <option value="{{ $variable->farm_profiles_id }}">{{ $variable->farmprofile->tenurial_status }}</option>
                  @else
                      <option value="" disabled>No farm profile available</option>
                  @endif
                  </select>
              </div>


              <div class="col-md-3 mb-3">    
       
                <label class="form-expand" for="seeds_id">Total Seed Cost(PHP):</label>
                <select  class="form-control mb-4 mb-md-0" name="seeds_id" aria-label="seeds_id">
                  {{-- @foreach ( $seed->sortByDesc('id') as  $seed) --}}
                          <option  value="{{ $variable->seeds_id }}">{{ number_format($variable->seeds->total_seed_cost,2) }}</option>
                      {{-- @endforeach --}}
                  </select>
              </div>
     
             
              <div class="col-md-3 mb-3">    
          
                <label class="form-expand" for="labors_id">Total Labor Cost(PHP):</label>
                <select  class="form-control mb-4 mb-md-0" name="labors_id" aria-label="labors_id">
                  {{-- @foreach ( $labor as  $labor) --}}
                          <option value="{{ $variable->labors_id }}">{{ number_format($variable->labors->total_labor_cost,2)}}</option>
                      {{-- @endforeach --}}
                  </select>
              </div>
             
   
              <div class="col-md-3 mb-3">    
         
                <label class="form-expand" for="fertilizers_id">Total Fertilizers Cost(PHP):</label>
                <select  class="form-control mb-4 mb-md-0" name="fertilizers_id" aria-label="fertilizers_id">
                  {{-- @foreach ($profile->sortByDesc('id') as $location) --}}
                      <option  value="{{ $variable->fertilizers_id }}">{{ number_format($variable->fertilizers->total_cost_fertilizers,2)	}}</option>
                  {{-- @endforeach --}}
              </select>
              </div>

              
              <div class="col-md-3 mb-3">    
       
                <label class="form-expand" for="pesticides_id">Total Pesticides Cost(PHP):</label>
                <select class="form-control mb-4 mb-md-0" name="pesticides_id" aria-label="pesticides_id">
                  {{-- @foreach ( $farmprofile->sortByDesc('id') as  $farmprofile) --}}
                          <option value="{{ $variable->pesticides_id }}">{{ number_format($variable->pesticides->total_cost_pesticides,2) }}</option>
                      {{-- @endforeach --}}
                  </select>
              </div>
  
              <div class="col-md-3 mb-3">    
      
                <label class="form-expand" for="transports_id">Total Delivery Cost(PHP):</label>
                <select class="form-control mb-4 mb-md-0" name="transports_id" aria-label="transports_id">
                
                      <option value="{{ $variable->transports_id }}">{{ number_format($variable->transports->total_transport_per_deliverycost,2) }}</option>
               
              </select>
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="total_machinery_fuel_cost">Total Fuel Cost:</label>
                <input type="text" class="form-control placeholder-text @error('total_machinery_fuel_cost') is-invalid @enderror"value="{{number_format($variable->total_machinery_fuel_cost,2)}}" name="total_machinery_fuel_cost" id="total_machinery_fuel_cost" placeholder="Enter total fuel cost" value="{{ old('total_machinery_fuel_cost') }}" >
                @error('total_machinery_fuel_cost')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="total_variable_cost">Total Variable Cost:</label>
                <input type="text" class="form-control placeholder-text @error('total_variable_cost') is-invalid @enderror"value="{{$variable->total_variable_cost}}" name="total_variable_cost" id="total_variable_cost" placeholder="Enter total variable cost" value="{{ old('total_variable_cost') }}" >
                @error('total_variable_cost')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            </div>

 <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a  href="{{route('personalinfo.create')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
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
// Calculate total variable cost
function calculateTotalVariableCost() {
  // Get the values of individual costs by their IDs
  let totalSeedCost = parseFloat(document.getElementById('seeds_id').value) || 0;
  let totalLaborCost = parseFloat(document.getElementById('labors_id').value) || 0;
  let totalFertilizerCost = parseFloat(document.getElementById('fertilizers_id').value) || 0;
  let totalPesticidesCost = parseFloat(document.getElementById('pesticides_id').value) || 0;
  let totalTransportCost = parseFloat(document.getElementById('transports_id').value) || 0;
  let totalFuelCost = parseFloat(document.getElementById('total_machinery_fuel_cost').value) || 0;
  // Calculate the total variable cost by summing up individual costs
  let totalVariableCost = totalSeedCost + totalLaborCost + totalFertilizerCost + totalPesticidesCost + totalTransportCost + totalFuelCost;

  // Update Total Variable Cost input field with the calculated total variable cost
  document.getElementById('total_variable_cost').value = totalVariableCost.toFixed(2);
}

// Attach change event listeners to select elements representing costs
document.getElementById('seeds_id').addEventListener('change', calculateTotalVariableCost);
document.getElementById('labors_id').addEventListener('change', calculateTotalVariableCost);
document.getElementById('fertilizers_id').addEventListener('change', calculateTotalVariableCost);
document.getElementById('pesticides_id').addEventListener('change', calculateTotalVariableCost);
document.getElementById('transports_id').addEventListener('change', calculateTotalVariableCost);
document.getElementById('total_machinery_fuel_cost').addEventListener('input', calculateTotalVariableCost);
// Initial calculation on page load
calculateTotalVariableCost();

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
//  total FUEL cost in decimal formats
document.addEventListener('DOMContentLoaded', function() {
// Get input elements
const totalLaborCostInput = document.getElementById('total_machinery_fuel_cost');


// Add event listeners for input events
total_machinery_fuel_cost.addEventListener('input', formatDecimal);


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