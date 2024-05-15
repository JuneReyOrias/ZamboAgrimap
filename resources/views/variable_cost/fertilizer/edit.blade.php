@extends('admin.dashb')
@section('admin')

<div class="page-content">

  <nav class="page-breadcrumb">

  </nav>
  <div class="progress mb-3">
    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">5(C) out of 6 to Complete</div>

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
          <h6 class="card-title"><span>V.</span>Variable Cost</h6>
          <h5 class="card-title"><span>c.</span>Update Fertilizers</h5>
          <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
      
         <form id="myForm" action{{url('updatesfertilizer')}} method="post">
            @csrf

            <div >

              <input type="hidden" name="users_id" value="{{ $userId}}">
             
           
       </div>

            {{-- fertilizers --}}
            <div class="row mb-3">
              <h2 class="card-title"><span></span>fertilizer informations:</h2>
            
             
       
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="name_of_fertilizer">Name Of Fertilizer:</label>
                
             
              <select class="form-control placeholder-text @error('name_of_fertilizer') is-invalid @enderror" name="name_of_fertilizer" id="selectpostharvest" onchange="checkpostharvest()" aria-label="label select e">
                <option value="{{$fertilizers->name_of_fertilizer}}">{{$fertilizers->name_of_fertilizer}}</option>
                <option value="Nitrogen Fertilizers" {{ old('name_of_fertilizer') == 'Nitrogen Fertilizers' ? 'selected' : '' }}>Nitrogen Fertilizers</option>
                <option value="Phosphorus Fertilizers" {{ old('name_of_fertilizer') == 'Phosphorus Fertilizers' ? 'selected' : '' }}>Phosphorus Fertilizers</option>
                <option value="Potassium Fertilizers" {{ old('name_of_fertilizer') == 'Potassium Fertilizers' ? 'selected' : '' }}>Potassium Fertilizers</option>
                <option value="Compound Fertilizers" {{ old('name_of_fertilizer') == 'Compound Fertilizers' ? 'selected' : '' }}>Compound Fertilizers</option>
                <option value="Organic Fertilizers" {{ old('name_of_fertilizer') == 'Organic Fertilizers' ? 'selected' : '' }}>Organic Fertilizers</option>
                <option value="Slow-Release Fertilizers" {{ old('name_of_fertilizer') == 'Slow-Release Fertilizers' ? 'selected' : '' }}>Slow-Release Fertilizers</option>
                <option value="Micronutrient Fertilizers" {{ old('name_of_fertilizer') == 'Micronutrient Fertilizers' ? 'selected' : '' }}>Micronutrient Fertilizers</option>
                <option value="Liquid Fertilizers" {{ old('name_of_fertilizer') == 'Liquid Fertilizers' ? 'selected' : '' }}>Liquid Fertilizers</option>
                <option value="other" {{ old('name_of_fertilizer') == 'other' ? 'selected' : '' }}>other</option>
               
              </select>
              
            </div>
            <div class="col-md-3 mb-3" id="additionalFertilizerField" style="display: none;">
              <label class="form-expand" for="additionalFertilizer">Add Prefer Name Of Fertilizer</label>
              <input type="text" class="form-control" name="additionalFertilizer" id="additionalFertilizer"placeholder="Enter fertilizer name">
          </div>

            {{-- SELECT TYPE OF FERTILIZER --}}
            <div class="col-md-3 mb-3" id="fertilizerInput" style="display: none;">
              <label class="form-expand" for="type_of_fertilizer">Type of Fertilizer</label>
              <select class="form-control" name="type_of_fertilizer" id="SelectFertilizer">
                <option selected disabled>Select</option>
                  <!-- Options will be dynamically populated based on the selected fertilizer category -->
              </select>
            </div>
            
         
              {{-- add new postharvest Machineries used --}}
              <div class="col-md-3 mb-3" id="preferFertilizerinput" style="display: none;">
                <label for="preferFertilizerinput">Type of Fertilizer</label>
                <input type="text" id="preferFertilizerinput" class="form-control placeholder-text @error('type_of_fertilizers') is-invalid @enderror" name="type_of_fertilizers" placeholder=" Enter type of fertilizer" value="{{ old('type_of_fertilizers') }}">
                @error('type_of_fertilizers')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
           
              
              
        
        
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="no_ofsacks">No. of Sacks:</label>
                <input type="text" class="form-control placeholder-text @error('no_ofsacks') is-invalid @enderror"value="{{$fertilizers->no_ofsacks}}" name="no_ofsacks" id="no_ofsacks" placeholder="Enter no of sacks" value="{{ old('no_ofsacks') }}" >
                @error('no_ofsacks')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="unitprice_per_sacks">Unit Price per sacks(PHP):</label>
                <input type="text" class="form-control placeholder-text @error('unitprice_per_sacks') is-invalid @enderror"value="{{$fertilizers->no_ofsacks}}" name="unitprice_per_sacks" id="unitprice_per_sacks" placeholder="Enter unit price/sacks" value="{{ old('unitprice_per_sacks') }}" >
                @error('unitprice_per_sacks')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-expand" for="total_cost_fertilizers">Total Cost Fertilizers(PHP):</label>
                <input type="text" class="form-control placeholder-text @error('total_cost_fertilizers') is-invalid @enderror" name="total_cost_fertilizers" id="total_cost_fertilizers" placeholder="Enter total cost" value="{{ old('total_cost_fertilizers') }}" >
                @error('total_cost_fertilizers')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>

         
            </div>

       
            
 <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a  href="{{route('variable_cost.seeds.view')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
    <button type="submit" class="btn btn-success me-md-2 btn-submit">Next</button>
</div>
          </form>
        
          
        </div>
      </div>
    </div>
  </div>

 
  <!--end for Production Cost-->

           
       
        </div>
      </div>
    </div>
  
  </div>

</div> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
  // Get references to the input fields
  const no_ofsacks = document.getElementById('no_ofsacks');
  const unitprice_per_sacks = document.getElementById('unitprice_per_sacks');
  const total_cost_fertilizers = document.getElementById('total_cost_fertilizers');
  
  // Function to calculate and display the total seed cost
  function calculateTotalFertilizerCost() {
      const quantity = parseFloat(no_ofsacks.value) || 0;
      const unitPrice = parseFloat(unitprice_per_sacks.value) || 0;
  
      const totalFertilizerCost = quantity * unitPrice;
  
      // Display the total seed cost in the input field
      total_cost_fertilizers.value = totalFertilizerCost.toFixed(2); // You can adjust the number of decimal places as needed
  }
  
  // Calculate the total seed cost whenever the quantity or unit price changes
  no_ofsacks.addEventListener('input', calculateTotalFertilizerCost);
  unitprice_per_sacks.addEventListener('input', calculateTotalFertilizerCost);
  
  // Initial calculation when the page loads
  calculateTotalFertilizerCost();



  <?php
// Fetch the data for manicahan from your database or any other source
$fertilizerData = $fertilizers->type_of_fertilizer;
?>
  function populateFertilizers(fertilizerCategory) {
      var fertilizerSelect = document.getElementById("SelectFertilizer");
      var fertilizer = <?php echo json_encode($fertilizerData); ?>;
      // Clear previous options
      fertilizerSelect.innerHTML = '';

      // Populate fertilizers based on selected category
      var fertilizers = [];
      switch (fertilizerCategory) {
          case 'Nitrogen Fertilizers':
              fertilizers = [fertilizer,"Urea", "Ammonium Sulfate (AS)"];
              break;
          case 'Phosphorus Fertilizers':
              fertilizers = [fertilizer,"Diammonium Phosphate (DAP)", "Triple Superphosphate (TSP)"];
              break;
          case 'Potassium Fertilizers':
              fertilizers = [fertilizer,"Potassium Chloride (Muriate of Potash)", "Potassium Sulfate"];
              break;
       case 'Compound Fertilizers':
              fertilizers = [fertilizer,"10-10-10, ", "0-10-10, 14-14-14:"];
              break;
      case 'Organic Fertilizers':
              fertilizers = [fertilizer,"Compost", "Manure", "Fertilizer I"];
              break;
      case 'Slow-Release Fertilizers':
              fertilizers = [fertilizer,"Polymer-Coated Urea", "Controlled-Release Fertilizers"];
              break;    
       case 'Micronutrient Fertilizers':
              fertilizers = [fertilizer,"Foliar Sprays", "Soil Amendments"];
              break; 
    
      case 'Liquid Fertilizers':
              fertilizers = [fertilizer,"Fertigation Solutions", "Foliar Sprays"];
              break;
      case 'other':
              fertilizers = [fertilizer,"N/A"];
              break;  
     
          // Add cases for other fertilizer categories as needed
      
      }

      // Populate dropdown with fertilizers
      fertilizers.forEach(function(fertilizer) {
          var option = document.createElement("option");
          option.text = fertilizer;
          option.value = fertilizer;
          fertilizerSelect.appendChild(option); // Append option to select element
      });

      // Add an option to add new fertilizer
      var addNewOption = document.createElement("option");
      addNewOption.text = "Add type of fertilizer";
      addNewOption.value = "";
      fertilizerSelect.appendChild(addNewOption);
  }

  // Function to handle the fertilizer selection
  function handleFertilizerSelection() {
      var fertilizerSelect = document.getElementById("SelectFertilizer");
      var selectedOption = fertilizerSelect.value;

      if (selectedOption === "") {
          var newFertilizer = prompt("Enter new type of fertilizer:");
          if (newFertilizer !== null && newFertilizer !== "") {
              // Add the new fertilizer to the dropdown
              var option = document.createElement("option");
              option.text = newFertilizer;
              option.value = newFertilizer;
              fertilizerSelect.insertBefore(option, fertilizerSelect.lastChild); // Add option before the last option ("Add New Fertilizer")
              // Select the newly added fertilizer
              fertilizerSelect.value = newFertilizer;
          }
      }
  }

  // Function to check selected fertilizer category and display fertilizer input accordingly
  function checkFertilizer() {
  var fertilizerCategory = document.getElementById("selectpostharvest").value;
  var fertilizerInput = document.getElementById("fertilizerInput");
  var additionalFertilizerField = document.getElementById("additionalFertilizerField");
  var preferFertilizerinput = document.getElementById("preferFertilizerinput")
  if (fertilizerCategory !== "other" && fertilizerCategory !== "AdditionalOption") {
      fertilizerInput.style.display = "block"; // Show fertilizer input
      additionalFertilizerField.style.display = "none"; // Show additional fertilizer field
      preferFertilizerinput.style.display = "none"; // Show additional fertilizer field
      populateFertilizers(fertilizerCategory); // Populate fertilizers based on selected category
  } 
  else if (fertilizerCategory === "other") {
      fertilizerInput.style.display = "none"; // Hide fertilizer input
      additionalFertilizerField.style.display = "block"; // Show additional fertilizer field
      preferFertilizerinput.style.display = "block"; // Show additional fertilizer field
     
  } 
  else if (fertilizerCategory === "AdditionalOption") {
      fertilizerInput.style.display = "none"; // Hide fertilizer input
      additionalFertilizerField.style.display = "block"; // Show additional fertilizer field
      preferFertilizerinput.style.display = "none"; // Show additional fertilizer field
      // Additional actions specific to the Additional Option can be added here
  }
  else {
      fertilizerInput.style.display = "none"; // Hide fertilizer input
      additionalFertilizerField.style.display = "none"; // Hide additional fertilizer field
      additionalFertilizerField.style.display = "none"; // Show additional fertilizer field
  }
}
document.getElementById("additionalFertilizer").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("selectpostharvest");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      } })

  // Call the checkFertilizer function when the page loads
  window.onload = checkFertilizer;

  // Call the checkFertilizer function when the fertilizer selection changes
  document.getElementById("selectpostharvest").addEventListener("change", checkFertilizer);

  // Call the handleFertilizerSelection function when a fertilizer is selected
  document.getElementById("SelectFertilizer").addEventListener("change", handleFertilizerSelection);


// cost per fertilize  and total cost in decimal formats
document.addEventListener('DOMContentLoaded', function() {
  // Get input elements
  const unitprice_per_sacks = document.getElementById('unitprice_per_sacks');


  // Add event listeners for input events
  unitprice_per_sacks.addEventListener('input', formatDecimal);
 

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