@extends('agent.agent_Dashboard')
@section('agent') 

@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content">

 
  <div class="progress mb-3">
    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">5(A) out of 6 to Complete</div>

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
      {{-- <h4 class="card-titles" style="display: flex;text-align: center; "><span></span>Rice Survey Form Zamboanga City</h4>
        <br> --}}
          <h6 class="card-title"><span>V.</span>Variable Cost</h6><br><br>
          <h5 class="card-title"><span>a.</span>Seeds</h5><br><br>
          <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
      
         <form id="myForm" action{{url('updatesSeeds')}} method="post">
            @csrf

                 {{-- seeds --}}
                 <div class="row mb-3">
                  <h2 class="card-title"><span></span>Rice Seeds Information:</h2>
                  <div >

                    <input type="hidden" name="users_id" value="{{ $userId}}">
                   
                 
             </div>
                 
                  <div class="col-md-3 mb-3"style="font-size: 10px">
                    <label class="form-expand" for="seed_type">Rice Seed Variety:</label>
                    
                    <select class="form-control placeholder-text @error('seed_type') is-invalid @enderror" name="seed_type" id="selectseedVariety" onchange="checkseedVariety()" aria-label="label select e">
                      @if($farmprofile)
                      <option value="{{ $farmprofile->type_rice_variety !== 'n/a' ? $farmprofile->type_rice_variety : ($farmprofile->preferred_variety ? $farmprofile->preferred_variety : ($farmprofile->type_of_variety === 'inbred' || $farmprofile->type_of_variety === 'hybrid' ? $farmprofile->type_of_variety : '')) }}">
                        {{ $farmprofile->type_rice_variety !== 'n/a' ? $farmprofile->type_rice_variety : ($farmprofile->preferred_variety ? $farmprofile->preferred_variety : ($farmprofile->type_of_variety === 'inbred' || $farmprofile->type_of_variety === 'hybrid' ? $farmprofile->type_of_variety : '')) }}
                    </option>
                    
                    @else
                        <option value="" disabled>No farm profile available</option>
                    @endif
                      <option value="Inbred Rice Seeds" {{ old('seed_type') == 'Inbred Rice Seeds' ? 'selected' : '' }}>Inbred Rice Seeds</option>
                      <option value="Hybrid Rice Seeds" {{ old('seed_type') == 'Hybrid Rice Seeds' ? 'selected' : '' }}>Hybrid Rice Seeds</option>
                      <option value="N/A" {{ old('seed_type') == 'N/A' ? 'selected' : '' }}>N/A</option>

                      <option value="OtherseedVariety" {{ old('seed_type') == 'OtherseedVariety' ? 'selected' : '' }}>Others</option>
                    </select>
                    
                  </div>
                
                    {{-- add new postharvest Machineries used --}}
                    <div class="col-md-3 mb-3" id="OthersInput" style="display: none;">
                      <label for="OthersInput">Others(input here):</label>
                      <input type="text" id="OthersInputField" class="form-control placeholder-text @error('AddRiceVariety') is-invalid @enderror" name="AddRiceVariety" placeholder=" Enter rice seed" variety value="{{ old('AddRiceVariety') }}">
                      @error('AddRiceVariety')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    {{-- inbred serlcet variety --}}
                    <div class="col-md-3 mb-3" id="seedInput" style="display: none;">
                      <label for="seedInput">Seed Name:</label>
                      <select class="form-control placeholder-text @error('seed_name') is-invalid @enderror" name="seed_name" id="selectseedName" onchange="checkseedName()" aria-label="label select e">
                        <option value="{{$seeds->seed_name}}">{{$seeds->seed_name}}</option>
                        <option value="NSIC Rc222" {{ old('seed_name') == 'NSIC Rc222' ? 'selected' : '' }}>NSIC Rc222</option>
                        <option value="NSIC Rc18" {{ old('seed_name') == 'NSIC Rc18' ? 'selected' : '' }}>NSIC Rc18</option>
                       
                        <option value="NSIC Rc160" {{ old('seed_name') == 'NSIC Rc160' ? 'selected' : '' }}>NSIC Rc160</option>
                        <option value="PSB Rc82" {{ old('seed_name') == 'PSB Rc82' ? 'selected' : '' }}>PSB Rc82</option>
                        <option value="OtherseedName" {{ old('seed_name') == 'OtherseedName' ? 'selected' : '' }}>Others</option>
                      </select>
                     
                      @error('seed_name')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                     
                    {{-- add new postharvest Machineries used --}}
                       <div class="col-md-3 mb-3" id="seedNameInput" style="display: none;">
                        <label for="seedNameInput">Others(input here):</label>
                        <input type="text" id="seedNameInputField" class="form-control placeholder-text @error('add_newInbreeds') is-invalid @enderror" name="add_newInbreeds" placeholder=" Enter seed name" >
                        @error('add_newInbreed')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    

                    {{-- hybrid --}}
                    <div class="col-md-3 mb-3" id="HybridInput" style="display: none;">
                      <label for="HybridInput">Seed Name:</label>
                      <select class="form-control placeholder-text @error('seed_name') is-invalid @enderror" name="seed_name" id="selectseedVarie" onchange="checkseedVarie()" aria-label="label select e">
                        <option value="{{$seeds->seed_name}}">{{$seeds->seed_name}}</option>
                        <option value="NSIC Rc298" {{ old('seed_name') == 'NSIC Rc298' ? 'selected' : '' }}>NSIC Rc298</option>
                        <option value="NSIC RC 262H (MESTISO 38)" {{ old('seed_name') == 'NSIC RC 262H (MESTISO 38)' ? 'selected' : '' }}>NSIC RC 262H (MESTISO 38)</option>
                        <option value="NSIC RC 408H (MESTISO 68)" {{ old('seed_name') == 'NSIC RC 408H (MESTISO 68)' ? 'selected' : '' }}>NSIC RC 408H (MESTISO 68)</option>
                        
                        
                      
                        <option value="OtherseedVarie" {{ old('seed_name') == 'OtherseedVarie' ? 'selected' : '' }}>Others</option>
                      </select>
                     
                      @error('seed_name')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                          {{-- add new postharvest Machineries used --}}
                          <div class="col-md-3 mb-3" id="HybridNameInput" style="display: none;">
                            <label for="HybridNameInput">Others(input here):</label>
                            <input type="text" id="HybridNameInputField" class="form-control placeholder-text " name="add_newInbreed" placeholder=" Enter seed name">
                         
                          </div>
                 
                   
                 
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="unit">Unit:</label>
                    <input type="text" class="form-control placeholder-text @error('unit') is-invalid @enderror"value="{{$seeds->unit}}" name="unit" id="validationCustom01" placeholder="Enter unit" value="{{ old('unit') }}" >
                    @error('unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                 
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="quantity">Quantity:</label>
                    <input type="text" class="form-control placeholder-text @error('quantity') is-invalid @enderror"value="{{$seeds->quantity}}" name="quantity" id="quantityInput" placeholder="Enter quantity" value="{{ old('quantity') }}" >
                    @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>

                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="unit_price">Unit Price(PHP):</label>
                    <input type="text" class="form-control placeholder-text @error('unit_price') is-invalid @enderror"value="{{$seeds->unit_price}}" name="unit_price" id="unitPriceInput" placeholder="Enter unit price" value="{{ old('unit_price') }}" >
                    @error('unit_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>

                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="total_seed_cost">Total Seed Cost(PHP):</label>
                    <input type="text" class="form-control placeholder-text @error('total_seed_cost') is-invalid @enderror"value="
                    {{$seeds->total_seed_cost}}" name="total_seed_cost" id="totalSeedCostInput" placeholder="Enter total seed cost" value="{{ old('total_seed_cost') }}" >
                    @error('total_seed_cost')
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
  // Get references to the input fields
  const quantityInput = document.getElementById('quantityInput');
  const unitPriceInput = document.getElementById('unitPriceInput');
  const totalSeedCostInput = document.getElementById('totalSeedCostInput');
  
  // Function to calculate and display the total seed cost
  function calculateTotalSeedCost() {
      const quantity = parseFloat(quantityInput.value) || 0;
      const unitPrice = parseFloat(unitPriceInput.value) || 0;
  
      const totalSeedCost = quantity * unitPrice;
  
      // Display the total seed cost in the input field
      totalSeedCostInput.value = totalSeedCost.toFixed(2); // You can adjust the number of decimal places as needed
  }
  
  // Calculate the total seed cost whenever the quantity or unit price changes
  quantityInput.addEventListener('input', calculateTotalSeedCost);
  unitPriceInput.addEventListener('input', calculateTotalSeedCost);
  
  // Initial calculation when the page loads
  calculateTotalSeedCost();


  
// check selected seedVariety then input n/a
function checkseedVariety() {
  var selectseedVariety = document.getElementById("selectseedVariety").value.toLowerCase(); // Convert input value to lowercase
  var seedInput = document.getElementById("seedInput");
  var HybridInput = document.getElementById("HybridInput");
  var OthersInput = document.getElementById("OthersInput");

  if (selectseedVariety === "inbred rice seeds" || selectseedVariety === "Inbred") {
      seedInput.style.display = "block";
      HybridInput.style.display = "none";
      OthersInput.style.display = "none";
  } else if (selectseedVariety === "hybrid rice seeds" || selectseedVariety === "Hybrid") {
      HybridInput.style.display = "block";
      seedInput.style.display = "none";
      OthersInput.style.display = "none";
  } else if (selectseedVariety === "otherseedvariety") {
      OthersInput.style.display = "block";
      seedInput.style.display = "none";
      HybridInput.style.display = "none";
  } else {
      seedInput.style.display = "none";
      HybridInput.style.display = "none";
      OthersInput.style.display = "none";
  }
}


// selection othersseed name inbred seed
function checkseedName() {
      var select = document.getElementById("selectseedName");
      var option = select.options[select.selectedIndex].value;
  
      if (option === 'OtherseedName') {
        document.getElementById("seedNameInput").style.display = "block";
      } else {
        document.getElementById("seedNameInput").style.display = "none";
      }
      
    }
  
    // Add new tenurial status to the select element
    document.getElementById("seedNameInputField").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("selectseedName");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      }
    });

    
// selection othersseed name inbred seed
function checkseedVarie() {
      var select = document.getElementById("selectseedVarie");
      var option = select.options[select.selectedIndex].value;
  
      if (option === 'OtherseedVarie') {
        document.getElementById("HybridNameInput").style.display = "block";
      } else {
        document.getElementById("HybridNameInput").style.display = "none";
      }
      
    }
  
    // Add new tenurial status to the select element
    document.getElementById("HybridNameInputField").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("selectseedVarie");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      }
    });

    document.addEventListener('DOMContentLoaded', function() {
  // Get input elements
  const unitPriceInput = document.getElementById('unitPriceInput');
 

  // Add event listeners for input events
  unitPriceInput.addEventListener('input', formatDecimal);
 
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