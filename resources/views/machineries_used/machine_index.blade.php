@extends('admin.dashb')
@section('admin')


<div class="page-content">

  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      
    </ol>
  </nav>
  <div class="progress mb-3">
    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">4 out of 6 to Complete</div>

  </div>
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
      <h4 class="card-titles" style="display: flex;text-align: center; "><span></span>Rice Survey Form Zamboanga City</h4>
      <br>

          <h6 class="card-title"><span>IV.</span>machineries Used</h6>

          <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
       
         
         
         <form id="myForm" action{{url('store')}} method="post"  >
            @csrf
            <div class="row mb-3">
              <h2 class="card-title" ><span>a.</span>Plowing Machineries:</h2>
              <div >
                <input type="hidden" name="users_id" value="{{ $userId }}">
               
             
         </div>
                <div class="col-md-3 mb-3">    
           
                  <label class="form-expand" for="personal_informations_id">Farmers Name:</label>
                  <select class="form-control placeholder-text" name="personal_informations_id" aria-label="personal_informations_id">
                        
                    <option value="{{ $profile->id }}">{{ $profile->first_name.' '. $profile->last_name}}</option>
              
            </select>
                </div>
                <div class="col-md-3 mb-3">    
          
                  <label class="form-expand" for="farm_profiles_id">FarmProfile:</label>
                  <select class="form-control mb-4 mb-md-0" name="farm_profiles_id" aria-label="farm_profiles_id">
                      @if($farmprofile)
                          <option value="{{ $farmprofile->id }}">{{ $farmprofile->tenurial_status }}</option>
                      @else
                          <option value="" disabled>No farm profile available</option>
                      @endif
                  </select>
                </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="plowing_machineries_used">Plowing Machineries Used:</label>
                <select class="form-control placeholder-text @error('plowing_machineries_used') is-invalid @enderror" name="plowing_machineries_used" id="selectPlowing" onchange="checkPlowing()" aria-label="label select e">
                  <option selected disabled>Select</option>
                  <option value="Hand Tractor" {{ old('plowing_machineries_used') == 'Hand Tractor' ? 'selected' : '' }}>Hand Tractor</option>
                  <option value="Four-Wheel Tractors" {{ old('plowing_machineries_used') == 'Four-Wheel Tractors' ? 'selected' : '' }}>Four-Wheel Tractors</option>
                  <option value="Compact Tractors:" {{ old('plowing_machineries_used') == 'Compact Tractors:' ? 'selected' : '' }}>Compact Tractors:</option>
                  <option value="Rice Transplanters" {{ old('plowing_machineries_used') == 'Rice Transplanters' ? 'selected' : '' }}>Rice Transplanters</option>
                  <option value="Crawler Tractors" {{ old('plowing_machineries_used') == 'Crawler Tractors' ? 'selected' : '' }}>Crawler Tractors</option>
                  <option value="OthersPlowing" {{ old('plowing_machineries_used') == 'OthersPlowing' ? 'selected' : '' }}>Others</option>
                </select>
             
              </div>

                {{-- add new plowing Machineries --}}
                <div class="col-md-3 mb-3" id="PlowingmachineriesInput" style="display: none;">
                  <label for="PlowingmachineriesInput">Others(input here):</label>
                  <input type="text" id="PlowingmachineriesInputField" class="form-control placeholder-text @error('add_Plowingmachineries') is-invalid @enderror" name="add_Plowingmachineries" placeholder=" Enter plowing machineries used" value="{{ old('add_Plowingmachineries') }}">
                  @error('add_Plowingmachineries')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="plo_ownership_status">Ownership Status:</label>
                  <select class="form-control placeholder-text @error('plo_ownership_status') is-invalid @enderror" name="plo_ownership_status" id="selectPlowingStatus" onchange="checkPlowingStatus()" aria-label="label select e">
                    <option selected disabled>Select</option>
                    <option value="Own" {{ old('plo_ownership_status') == 'Own' ? 'selected' : '' }}>Own</option>
                    <option value="Rent" {{ old('plo_ownership_status') == 'Rent' ? 'selected' : '' }}>Rent</option>
                    <option value="Other" {{ old('plo_ownership_status') == 'Other' ? 'selected' : '' }}>Other</option>
                  </select>
                 
                </div>

                {{-- add new plowing status Machineries --}}
                <div class="col-md-3 mb-3" id="PlowingStatusInput" style="display: none;">
                  <label for="PlowingStatusInput">Other(input here):</label>
                  <input type="text" id="PlowingStatusInputField" class="form-control placeholder-text @error('add_PlowingStatus') is-invalid @enderror" name="add_PlowingStatus" placeholder=" Enter ownership status" value="{{ old('add_PlowingStatus') }}">
                  @error('add_PlowingStatus')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="no_of_plowing">No. of Plowing:</label>
                <input type="text" class="form-control placeholder-text @error('no_of_plowing') is-invalid @enderror" name="no_of_plowing" id="noPlowing" placeholder="Enter no. of plowing" value="{{ old('no_of_plowing') }}" >
                @error('no_of_plowing')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="cost_per_plowing">Cost per Plowing:</label>
                <input type="text" class="form-control placeholder-text @error('cost_per_plowing') is-invalid @enderror" name="cost_per_plowing" id="plowingperCostInput" placeholder="Enter plowing cost" value="{{ old('cost_per_plowing') }}" >
                @error('cost_per_plowing')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="plowing_cost">Total Plowing Cost:</label>
                <input type="text" class="form-control placeholder-text @error('plowing_cost') is-invalid @enderror" name="plowing_cost" id="plowingCostInput" placeholder="Enter plowing cost" value="{{ old('plowing_cost') }}" >
                @error('plowing_cost')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            </div>


              {{-- harrowing machineries --}}
            <div class="row mb-3">
              <h2 class="card-title"><span>b.</span>Harrowing Machineries:</h2>
            
             
       
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="harrowing_machineries_used">Harrowing Machineries Used:</label>
                <select class="form-control placeholder-text @error('harrowing_machineries_used') is-invalid @enderror" name="harrowing_machineries_used" id="selectHarrowing" onchange="checkHarrowing()" aria-label="label select e">
                  <option selected disabled>Select</option>
                  <option value="Hand Tractor" {{ old('harrowing_machineries_used') == 'Hand Tractor' ? 'selected' : '' }}>Hand Tractor</option>
                  <option value="Four-Wheel Tractors" {{ old('harrowing_machineries_used') == 'Four-Wheel Tractors' ? 'selected' : '' }}>Four-Wheel Tractors</option>
                  <option value="Compact Tractors:" {{ old('harrowing_machineries_used') == 'Compact Tractors:' ? 'selected' : '' }}>Compact Tractors:</option>
                  <option value="Rice Transplanters" {{ old('harrowing_machineries_used') == 'Rice Transplanters' ? 'selected' : '' }}>Rice Transplanters</option>
                  <option value="Crawler Tractors" {{ old('harrowing_machineries_used') == 'Crawler Tractors' ? 'selected' : '' }}>Crawler Tractors</option>
                  <option value="OtherHarrowing" {{ old('harrowing_machineries_used') == 'OtherHarrowing' ? 'selected' : '' }}>Others</option>
                </select>
              </div>

           {{-- add new harrowing Machineries used --}}
           <div class="col-md-3 mb-3" id="HarrowingmachineriesInput" style="display: none;">
            <label for="HarrowingmachineriesInput">Others(input here):</label>
            <input type="text" id="HarrowingmachineriesInputField" class="form-control placeholder-text @error('Add_HarrowingMachineries') is-invalid @enderror" name="Add_HarrowingMachineries" placeholder=" Enter harrowing machineries used" value="{{ old('Add_HarrowingMachineries') }}">
            @error('Add_HarrowingMachineries')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>


                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="harro_ownership_status">Ownership Status:</label>
                  <select class="form-control placeholder-text @error('harro_ownership_status') is-invalid @enderror" name="harro_ownership_status" id="selectStatus" onchange="checkStatus()" aria-label="label select e">
                    <option selected disabled>Select</option>
                    <option value="Own" {{ old('harro_ownership_status') == 'Own' ? 'selected' : '' }}>Own</option>
                    <option value="Rent" {{ old('harro_ownership_status') == 'Rent' ? 'selected' : '' }}>Rent</option>
                    <option value="Otherharros" {{ old('harro_ownership_status') == 'Otherharros' ? 'selected' : '' }}>Other</option>
                  </select>

                </div>
                  {{-- add new plowing status Machineries --}}
                  <div class="col-md-3 mb-3" id="StatusInput" style="display: none;">
                    <label for="StatusInput">Other(input here):</label>
                    <input type="text" id="harroStatusInputField" class="form-control placeholder-text @error('add_harrowStatus') is-invalid @enderror" name="add_harrowStatus" placeholder=" Enter ownership status" value="{{ old('add_harrowStatus') }}">
                    @error('add_harrowStatus')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="no_of_harrowing">No. of Harrowing:</label>
                <input type="text" class="form-control placeholder-text @error('no_of_harrowing') is-invalid @enderror" name="no_of_harrowing" id="noHarrowing" placeholder="Enter no. of harrowing" value="{{ old('no_of_harrowing') }}" >
                @error('no_of_harrowing')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="cost_per_harrowing">Cost per Harrowing:</label>
                <input type="text" class="form-control placeholder-text @error('cost_per_harrowing') is-invalid @enderror" name="cost_per_harrowing" id="costPerHarrowingInput" placeholder="Enter no. of harrowing">
                @error('cost_per_harrowing')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-expand" for="harrowing_cost">Harrowing Cost:</label>
                <input type="text" class="form-control placeholder-text @error('harrowing_cost') is-invalid @enderror" name="harrowing_cost" id="harrowingCostInput" placeholder="Enter harrowing cost">
                @error('harrowing_cost')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            
            </div>


               {{-- harvesting machineries --}}
               <div class="row mb-3">
                <h2 class="card-title"><span>c.</span>Harvesting Machineries:</h2>
              
               
         
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="harvesting_machineries_used">Harvesting Machineries Used:</label>
                  <select class="form-control placeholder-text @error('harvesting_machineries_used') is-invalid @enderror" name="harvesting_machineries_used" id="selectHarvesting" onchange="checkHarvesting()" aria-label="label select e">
                    <option selected disabled>Select</option>
                    <option value="Combine Harvesters" {{ old('harvesting_machineries_used') == 'Combine Harvesters' ? 'selected' : '' }}>Combine Harvesters</option>
                    <option value="Mini-Combine Harvesters" {{ old('harvesting_machineries_used') == 'Mini-Combine Harvesters' ? 'selected' : '' }}>Mini-Combine Harvesters</option>
                    <option value="Rice Reapers" {{ old('harvesting_machineries_used') == 'Rice Reapers' ? 'selected' : '' }}>Compact Tractors</option>
                    <option value="Handheld Sickles" {{ old('harvesting_machineries_used') == 'Handheld Sickles' ? 'selected' : '' }}>Handheld Sickles</option>
                    <option value="OtherHarvesting" {{ old('harvesting_machineries_used') == 'OtherHarvesting' ? 'selected' : '' }}>Others</option>
                  </select>
                  
                </div>

                  {{-- add new Harvesting Machineries used --}}
                  <div class="col-md-3 mb-3" id="harvestingmachineriesInput" style="display: none;">
                    <label for="harvestingmachineriesInput">Others(input here):</label>
                    <input type="text" id="harvestingmachineriesInputField" class="form-control placeholder-text @error('add_HarvestingMachineries') is-invalid @enderror" name="add_HarvestingMachineries" placeholder=" Enter harvesting machineries used" value="{{ old('add_HarvestingMachineries') }}">
                    @error('add_HarvestingMachineries')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="harvest_ownership_status">Ownership Status:</label>
                    <select class="form-control placeholder-text @error('harvest_ownership_status') is-invalid @enderror" name="harvest_ownership_status" id="selectHarvestStatus" onchange="checkHarvestStatus()" aria-label="label select e">
                      <option selected disabled>Select</option>
                      <option value="Own" {{ old('harvest_ownership_status') == 'Own' ? 'selected' : '' }}>Own</option>
                      <option value="Rent" {{ old('harvest_ownership_status') == 'Rent' ? 'selected' : '' }}>Rent</option>
                      <option value="Otherharveststat" {{ old('harvest_ownership_status') == 'Otherharvest' ? 'selected' : '' }}>Other</option>
                    </select>

                  </div>
                    {{-- add new Harvesting status Machineries --}}
                    <div class="col-md-3 mb-3" id="HarvestStatusInput" style="display: none;">
                      <label for="HarvestStatusInput">Other(input here):</label>
                      <input type="text" id="HarvestStatusInputField" class="form-control placeholder-text @error('add_harvestingStatus') is-invalid @enderror" name="add_harvestingStatus" placeholder=" Enter ownership status" value="{{ old('add_harvestingStatus') }}">
                      @error('add_harvestingStatus')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
               
               
                <div class="col-md-3 mb-3">
    <label class="form-expand" for="harvesting_cost">Harvesting Cost:</label>
    <input type="text" class="form-control placeholder-text @error('harvesting_cost') is-invalid @enderror" name="harvesting_cost" id="harvestingCostInputs" placeholder="Enter harvesting cost" value="{{ old('harvesting_cost') ? number_format(old('harvesting_cost'), 2) : '' }}" >
    @error('harvesting_cost')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


             
                </div>
            

              
  {{-- PostHarvest machineries --}}
  <div class="row mb-3">
  <h2 class="card-title"><span>D.</span>Post Harvest Machineries:</h2>



  <div class="col-md-3 mb-3">
    <label class="form-expand" for="postharvest_machineries_used">PostHarvest Machineries Used:</label>
    <select class="form-control placeholder-text @error('postharvest_machineries_used') is-invalid @enderror" name="postharvest_machineries_used" id="selectpostharvest" onchange="checkpostharvest()" aria-label="label select e">
      <option selected disabled>Select</option>
      <option value="Rice Threshers" {{ old('postharvest_machineries_used') == 'Rice Threshers' ? 'selected' : '' }}>Rice Threshers</option>
      <option value="Rice Milling Machines" {{ old('postharvest_machineries_used') == 'Rice Milling Machines' ? 'selected' : '' }}>Rice Milling Machines</option>

      <option value="Otherpostharvest" {{ old('postharvest_machineries_used') == 'Otherpostharvest' ? 'selected' : '' }}>Others</option>
    </select>
    
  </div>

    {{-- add new postharvest Machineries used --}}
    <div class="col-md-3 mb-3" id="postharvestmachineriesInput" style="display: none;">
      <label for="postharvestmachineriesInput">Others(input here):</label>
      <input type="text" id="postharvestmachineriesInputField" class="form-control placeholder-text @error('add_postharvestMachineries') is-invalid @enderror" name="add_postharvestMachineries" placeholder=" Enter postharvest machineries used" value="{{ old('add_postharvestMachineries') }}">
      @error('add_postharvestMachineries')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-md-3 mb-3">
      <label class="form-expand" for="postharv_ownership_status">Ownership Status:</label>
      <select class="form-control placeholder-text @error('postharv_ownership_status') is-invalid @enderror" name="postharv_ownership_status" id="selectpostHarvestStatus" onchange="checkpostHarvestStatus()" aria-label="label select e">
        <option selected disabled>Select</option>
        <option value="Own" {{ old('postharv_ownership_status') == 'Own' ? 'selected' : '' }}>Own</option>
        <option value="Rent" {{ old('postharv_ownership_status') == 'Rent' ? 'selected' : '' }}>Rent</option>
        <option value="OtherpostharvestStatus" {{ old('postharv_ownership_status') == 'OtherpostharvestStatus' ? 'selected' : '' }}>Other</option>
      </select>

    </div>
      {{-- add new postHarvesting status Machineries --}}
      <div class="col-md-3 mb-3" id="postHarvestStatusInput" style="display: none;">
        <label for="postHarvestStatusInput">Other(input here):</label>
        <input type="text" id="postHarvestStatusInputField" class="form-control placeholder-text @error('add_postStatus') is-invalid @enderror" name="add_postStatus" placeholder=" Enter ownership status" value="{{ old('add_postStatus') }}">
        @error('add_postStatus')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

  <div class="col-md-3 mb-3">
    <label class="form-expand" for="post_harvest_cost">PostHarvest Cost:</label>
    <input type="text" class="form-control placeholder-text @error('post_harvest_cost') is-invalid @enderror" name="post_harvest_cost" id="postHarvestCostInput" placeholder="Enter of post harvest cost" value="{{ old('post_harvest_cost') }}" >
    @error('post_harvest_cost')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
  </div>
{{-- <div>
 
<button type="button" id="addFieldsButton" class="btn btn-success me-md-2">Add</button>
</div>
<div  id="additionalFieldsContainer"></div> --}}

<div class="col-md-3 mb-3">
  <label class="form-expand" for="total_cost_for_machineries">Total Cost for Machineries:</label>
  <input type="text" class="form-control placeholder-text @error('total_cost_for_machineries') is-invalid @enderror" name="total_cost_for_machineries" id="totalCostInput" placeholder="Enter total expenses" value="{{ old('total_cost_for_machineries') }}" >
  @error('total_cost_for_machineries')
  <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
</div>

           
             
             
            
          
       
          

<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  {{-- <a  href="{{route('agent.fixedcost.add_fcost')}}"button  class="btn btn-success me-md-2">Back</button></a></p> --}}
  <button type="submit" class="btn btn-success me-md-2 btn-submit">Next</button>
          </form>
       
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
 document.addEventListener('DOMContentLoaded', function() {
    // Get references to the input fields
    const plowingCostInput = document.getElementById('plowingCostInput');
    const harrowingCostInput = document.getElementById('harrowingCostInput');
    const harvestingCostInputs = document.getElementById('harvestingCostInputs');
    const postHarvestCostInput = document.getElementById('postHarvestCostInput');
    const totalCostInput = document.getElementById('totalCostInput');

    // Function to calculate and display the total cost
    function calculateTotalCost() {
        const plowingCost = parseFloat(plowingCostInput.value) || 0;
        const harrowingCost = parseFloat(harrowingCostInput.value) || 0;
        const harvestingCosts = parseFloat(harvestingCostInputs.value) || 0;
        const postHarvestCost = parseFloat(postHarvestCostInput.value) || 0;

        const totalCost = plowingCost + harrowingCost + harvestingCosts + postHarvestCost;

        // Display the total cost in the total cost input field
        totalCostInput.value = totalCost.toFixed(2); // You can adjust the number of decimal places as needed
    }

    // Calculate the total cost whenever any of the input fields change
    plowingCostInput.addEventListener('input', calculateTotalCost);
    harrowingCostInput.addEventListener('input', calculateTotalCost);
    harvestingCostInputs.addEventListener('input', calculateTotalCost);
    postHarvestCostInput.addEventListener('input', calculateTotalCost);

    // Initial calculation when the page loads
    calculateTotalCost();
});

  // selecting others where to add prefer plowing machinery used
  function checkPlowing() {
      var select = document.getElementById("selectPlowing");
      var option = select.options[select.selectedIndex].value;
  
      if (option === 'OthersPlowing') {
        document.getElementById("PlowingmachineriesInput").style.display = "block";
      } else {
        document.getElementById("PlowingmachineriesInput").style.display = "none";
      }
      
    }
  
    // Add new tenurial status to the select element
    document.getElementById("PlowingmachineriesInputField").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("selectPlowing");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      }
    });

    // selecting Other Where add new prefer Plowing Status
    function checkPlowingStatus() {
      var select = document.getElementById("selectPlowingStatus");
      var option = select.options[select.selectedIndex].value;
  
      if (option === 'Other') {
        document.getElementById("PlowingStatusInput").style.display = "block";
      } else {
        document.getElementById("PlowingStatusInput").style.display = "none";
      }
      
    }
  
    // Add new PlowingStatus to the select element
    document.getElementById("PlowingStatusInputField").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("selectPlowingStatus");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      }
    });

          // selecting OtherHarrowing Where add new prefer Plowing machinereis used
      function checkHarrowing() {
      var select = document.getElementById("selectHarrowing");
      var option = select.options[select.selectedIndex].value;
  
      if (option === 'OtherHarrowing') {
        document.getElementById("HarrowingmachineriesInput").style.display = "block";
      } else {
        document.getElementById("HarrowingmachineriesInput").style.display = "none";
      }
      
    }
  
    // Add new Harrowing to the select element
    document.getElementById("HarrowingmachineriesInputField").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("selectHarrowing");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      }
    });
          // selecting OtherHarrowing Where add new prefer Plowing machinereis status
     function checkStatus() {
      var select = document.getElementById("selectStatus");
      var option = select.options[select.selectedIndex].value;
  
      if (option === 'Otherharros') {
        document.getElementById("StatusInput").style.display = "block";
      } else {
        document.getElementById("StatusInput").style.display = "none";
      }
      
    }
  
    // Add new Harrowing status to the select element
    document.getElementById("harroStatusInputField").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("selectStatus");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      }
    });

     // selecting OtherHaarvesting Where add new prefer Harvesting machinereis used
     function checkHarvesting() {
      var select = document.getElementById("selectHarvesting");
      var option = select.options[select.selectedIndex].value;
  
      if (option === 'OtherHarvesting') {
        document.getElementById("harvestingmachineriesInput").style.display = "block";
      } else {
        document.getElementById("harvestingmachineriesInput").style.display = "none";
      }
      
    }
  
    // Add new Harvesting machinereis used to the select element
    document.getElementById("harvestingmachineriesInputField").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("selectHarvesting");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      }
    });


    // selecting OtherHarvesting Where add new prefer Harvesting machinereis Status
    function checkHarvestStatus() {
      var select = document.getElementById("selectHarvestStatus");
      var option = select.options[select.selectedIndex].value;
  
      if (option === 'Otherharvest') {
        document.getElementById("HarvestStatusInput").style.display = "block";
      } else {
        document.getElementById("HarvestStatusInput").style.display = "none";
      }
      
    }
  
    // Add new Harvesting machinereis Status to the select element
    document.getElementById("HarvestStatusInputField").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("selectHarvestStatus");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      }
    });
    
    // selecting Otherpostharvest Where add new prefer postharvest machinereis Status
    function checkpostharvest() {
      var select = document.getElementById("selectpostharvest");
      var option = select.options[select.selectedIndex].value;
  
      if (option === 'Otherpostharvest') {
        document.getElementById("postharvestmachineriesInput").style.display = "block";
      } else {
        document.getElementById("postharvestmachineriesInput").style.display = "none";
      }
      
    }
  
    // Add new postharvest machinereis Status to the select element
    document.getElementById("postharvestmachineriesInputField").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("selectpostharvest");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      }
    });

          // selecting OtherHarvesting Where add new prefer Harvesting machinereis Status
          function checkpostHarvestStatus() {
      var select = document.getElementById("selectpostHarvestStatus");
      var option = select.options[select.selectedIndex].value;
  
      if (option === 'OtherpostharvestStatus') {
        document.getElementById("postHarvestStatusInput").style.display = "block";
      } else {
        document.getElementById("postHarvestStatusInput").style.display = "none";
      }
      
    }
  
    // Add new postHarvesting machinereis Status to the select element
    document.getElementById("postHarvestStatusInputField").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("selectpostHarvestStatus");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      }
    });
  </script>


<script>
// cost per harrowing and total harrowing cost in decimal formats
document.addEventListener('DOMContentLoaded', function() {
  // Get input elements
  const costPerHarrowingInput = document.getElementById('costPerHarrowingInput');
  const harrowingCostInput = document.getElementById('harrowingCostInput');

  // Add event listeners for input events
  costPerHarrowingInput.addEventListener('input', formatDecimal);
  harrowingCostInput.addEventListener('input', formatDecimal);

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

// cost per plowing and total plowing cost in decimal formats
document.addEventListener('DOMContentLoaded', function() {
  // Get input elements
  const plowingperCostInput = document.getElementById('plowingperCostInput');
  const plowingCostInput = document.getElementById('plowingCostInput');

  // Add event listeners for input events
  plowingperCostInput.addEventListener('input', formatDecimal);
  plowingCostInput.addEventListener('input', formatDecimal);

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
// cost per plowing and total plowing cost in decimal formats
document.addEventListener('DOMContentLoaded', function() {
  // Get input elements
  const plowingperCostInput = document.getElementById('plowingperCostInput');
  const plowingCostInput = document.getElementById('plowingCostInput');

  // Add event listeners for input events
  plowingperCostInput.addEventListener('input', formatDecimal);
  plowingCostInput.addEventListener('input', formatDecimal);

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

// cost harvesting cost in decimal formats
document.addEventListener('DOMContentLoaded', function() {
  // Get input elements
  const harvestingCostInputs = document.getElementById('harvestingCostInputs');
 

  // Add event listeners for input events
  harvestingCostInputs.addEventListener('input', formatDecimal);


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

// cost harvesting cost in decimal formats
document.addEventListener('DOMContentLoaded', function() {
  // Get input elements
  const postHarvestCostInput = document.getElementById('postHarvestCostInput');


  // Add event listeners for input events
  postHarvestCostInput.addEventListener('input', formatDecimal);


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
// calcualtion of no of plowing multiply by cost per plowing 
document.addEventListener("DOMContentLoaded", function () {
          var noPlowingInput = document.getElementById("noPlowing");
          var plowingPerCostInput = document.getElementById("plowingperCostInput");
          var plowingCostInput = document.getElementById("plowingCostInput");

          function calculatePlowingCost() {
              var noPlowing = parseFloat(noPlowingInput.value);
              var costPerPlowing = parseFloat(plowingPerCostInput.value);
              var totalCost = noPlowing * costPerPlowing;
              plowingCostInput.value = isNaN(totalCost) ? '0.00' : totalCost.toFixed(2);
          }

          noPlowingInput.addEventListener("input", calculatePlowingCost);
          plowingPerCostInput.addEventListener("input", calculatePlowingCost);

          // Calculate on page load
          calculatePlowingCost();
      });

      // calcualtion of no of harrowing multiply by cost per harrowing 
    document.addEventListener("DOMContentLoaded", function () {
          var noPlowingInput = document.getElementById("noPlowing");
          var plowingPerCostInput = document.getElementById("plowingperCostInput");
          var plowingCostInput = document.getElementById("plowingCostInput");

          function calculatePlowingCost() {
              var noPlowing = parseFloat(noPlowingInput.value);
              var costPerPlowing = parseFloat(plowingPerCostInput.value);
              var totalCost = noPlowing * costPerPlowing;
              plowingCostInput.value = isNaN(totalCost) ? '0.00' : totalCost.toFixed(2);
          }

          noPlowingInput.addEventListener("input", calculatePlowingCost);
          plowingPerCostInput.addEventListener("input", calculatePlowingCost);

          // Calculate on page load
          calculatePlowingCost();
      });


      document.addEventListener("DOMContentLoaded", function () {
          var noHarrowingInput = document.getElementById("noHarrowing");
          var costPerHarrowingInput = document.getElementById("costPerHarrowingInput");
          var harrowingCostInput = document.getElementById("harrowingCostInput");

          function calculateHarrowingCost() {
              var noHarrowing = parseFloat(noHarrowingInput.value);
              var costPerHarrowing = parseFloat(costPerHarrowingInput.value);
              var totalCost = noHarrowing * costPerHarrowing;
              harrowingCostInput.value = isNaN(totalCost) ? '0.00' : totalCost.toFixed(2);
          }

          noHarrowingInput.addEventListener("input", calculateHarrowingCost);
          costPerHarrowingInput.addEventListener("input", calculateHarrowingCost);

          // Calculate on page load
          calculateHarrowingCost();
      });

</script>


  
@endsection