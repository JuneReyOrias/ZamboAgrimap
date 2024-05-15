@extends('agent.agent_Dashboard')
@section('agent') 

<div class="page-content">

  <div class="progress mb-3">
    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">5(D) out of 6 to Complete</div>

  </div>
  
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
      
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
        <h5 class="card-title"><span>d.</span> update Pesticides</h5>
        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
    
         <form id="myForm" action{{url('PesticideDataupdate')}} method="post">
            @csrf
            <div >

              <input type="hidden" name="users_id" value="{{ $userId}}">
             
           
       </div>
              {{-- pesticides --}}
              <div class="row mb-3">
                <h2 class="card-title"><span></span>Pesticides informations:</h2>
              
               
         
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pesticides_name">Pesticides Name:</label>

                  <select class="form-control @error('pesticides_name') is-invalid @enderror" name="pesticides_name"id="selectPesticideName"onchange="checkIPesticideName()" aria-label="Floating label select e">
                    <option value="{{$pesticides->pesticides_name}}">{{$pesticides->pesticides_name}}</option>
                    <option value="Glyphosate" {{ old('pesticides_name') == 'Glyphosate' ? 'selected' : '' }}>Glyphosate</option>
                      <option value="Malathion" {{ old('pesticides_name') == 'Malathion' ? 'selected' : '' }}>Malathion</option>
                      <option value="Diazinon" {{ old('pesticides_name') == 'Diazinon' ? 'selected' : '' }}>Diazinon</option>
                      <option value="Chlorpyrifos" {{ old('pesticides_name') == 'Chlorpyrifos' ? 'selected' : '' }}>Chlorpyrifos</option>
                      <option value="Lambda-cyhalothrin" {{ old('pesticides_name') == 'Lambda-cyhalothrin' ? 'selected' : '' }}>Lambda-cyhalothrin</option>
                      <option value="Imidacloprid" {{ old('pesticides_name') == 'Imidacloprid' ? 'selected' : '' }}>Imidacloprid</option>
                      <option value="Cypermethrin" {{ old('pesticides_name') == 'Cypermethrin' ? 'selected' : '' }}>Cypermethrin</option>
                      <option value="N/A" {{ old('pesticides_name') == 'N/A' ? 'selected' : '' }}>N/A</option>
                    <option value="OtherPestName" {{ old('pesticides_name') == 'OtherPestName' ? 'selected' : '' }}>Others</option>
    
                  
                  </select>
   
                </div>
                {{-- IF YOU SELECTED the list of the pesticide name then show this type of pesticides --}}
                <div class="col-md-3 mb-3" id="PesticideSelected" >
                  <label for="PesticideSelected">Type of Pesticides:</label>
                  <select class="form-control @error('type_ofpesticides') is-invalid @enderror" name="type_ofpesticides"id="selectIDType"onchange="checkIDtype()" aria-label="Floating label select e">
                    <option value="{{$pesticides->type_ofpesticides}}">{{$pesticides->type_ofpesticides}}</option>
                    <option value="Herbicide" {{ old('type_ofpesticides') == 'Herbicide' ? 'selected' : '' }}>Herbicide</option>
                      <option value="Insecticide" {{ old('type_ofpesticides') == 'Insecticide' ? 'selected' : '' }}>Insecticide</option>
                      <option value="N/A" {{ old('type_ofpesticides') == 'N/A' ? 'selected' : '' }}>N/A</option>
                      <option value="Others" {{ old('type_ofpesticides') == 'Others' ? 'selected' : '' }}>Other</option>

                  </select>
              @error('type_ofpesticides')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                {{-- when selected a others then open window of input of the prefer pesticide naem and type of pesticide  --}}
                <div class="col-md-3 mb-3" id="OthersInput" style="display: none;">
                  <label for="OthersInput">Prefer Pesticide name:</label>
                  <input type="text" id="OthersInput" class="form-control placeholder-text @error('add_PestName') is-invalid @enderror"name="add_PestName" id="validationCustom02" placeholder="Enter pesticide name"  value="{{ old('add_PestName') }}">
                  @error('add_PestName')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              </div>
              <div class="col-md-3 mb-3" id="OtherIDInput" style="display: none;">
                <label for="OtherIDInput">Type of Pesticide:</label>
                <input type="text" id="OtherIDInput" class="form-control placeholder-text @error('add_typePest') is-invalid @enderror"value="{{$pesticides->add_typePest}}" name="Add_typePest" id="validationCustom02" placeholder="Enter type of pesticide"  value="{{ old('add_typePest') }}">
                @error('add_typePest')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="no_of_l_kg">Number of L or kg:</label>
                  <input type="text" class="form-control placeholder-text @error('no_of_l_kg') is-invalid @enderror"value="{{$pesticides->no_of_l_kg}}" name="no_of_l_kg" id="no_of_l_kg" placeholder="Enter no of L or Kg" value="{{ old('no_of_l_kg') }}" >
                  @error('no_of_l_kg')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="unitprice_ofpesticides">Unit Price of Pesticides(PHP):</label>
                  <input type="text" class="form-control placeholder-text @error('unitprice_ofpesticides') is-invalid @enderror"value="{{$pesticides->unitprice_ofpesticides}}" name="unitprice_ofpesticides" id="unitprice_ofpesticides" placeholder="Enter unit price pesticides" value="{{ old('unitprice_ofpesticides') }}" >
                  @error('unitprice_ofpesticides')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="total_cost_pesticides">Total Cost Pesticides(PHP):</label>
                  <input type="text" class="form-control placeholder-text @error('total_cost_pesticides') is-invalid @enderror"value="{{$pesticides->total_cost_pesticides}}" name="total_cost_pesticides" id="total_cost_pesticides" placeholder="Enter total cost" value="{{ old('total_cost_pesticides') }}" >
                  @error('total_cost_pesticides')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

           
              </div>







   <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a  href="{{route('variable_cost.seeds.view')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
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
    const no_of_l_kg = document.getElementById('no_of_l_kg');
    const unitprice_ofpesticides = document.getElementById('unitprice_ofpesticides');
    const total_cost_pesticides = document.getElementById('total_cost_pesticides');
    
    // Function to calculate and display the total seed cost
    function calculateTotalPesticidesCost() {
        const quantity = parseFloat(no_of_l_kg.value) || 0;
        const unitPrice = parseFloat(unitprice_ofpesticides.value) || 0;
    
        const totalPesticidesCost = quantity * unitPrice;
    
        // Display the total seed cost in the input field
        total_cost_pesticides.value = totalPesticidesCost.toFixed(2); // You can adjust the number of decimal places as needed
    }
    
    // Calculate the total seed cost whenever the quantity or unit price changes
    no_of_l_kg.addEventListener('input', calculateTotalPesticidesCost);
    unitprice_ofpesticides.addEventListener('input', calculateTotalPesticidesCost);
    
    // Initial calculation when the page loads
    calculateTotalFertilizerCost();



    
    </script>
    <script>
 //cost per fertilize  and total cost in decimal formats
document.addEventListener('DOMContentLoaded', function() {
    // Get input elements
    const unitprice_ofpesticides = document.getElementById('unitprice_ofpesticides');
  

    // Add event listeners for input events
    unitprice_ofpesticides.addEventListener('input', formatDecimal);
   

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

// dropdown of pesticides name
function checkIPesticideName() {
    var selectPesticideName = document.getElementById("selectPesticideName");
    var PesticideSelected = document.getElementById("PesticideSelected");
    var OthersInput = document.getElementById("OthersInput");
    var OtherIDInput = document.getElementById("OtherIDInput");

    if (selectPesticideName.value === "Glyphosate" || selectPesticideName.value === "Malathion" || selectPesticideName.value === "Diazinon" || selectPesticideName.value === "Chlorpyrifos" || selectPesticideName.value === "Lambda-cyhalothrin" || selectPesticideName.value === "Imidacloprid" || selectPesticideName.value === "Cypermethrin" || selectPesticideName.value === "N/A") {
        PesticideSelected.style.display = "block";
        OthersInput.style.display = "none";
        OtherIDInput.style.display = "none";
    } else if (selectPesticideName.value === "OtherPestName") {
        OthersInput.style.display = "block";
        OtherIDInput.style.display = "block";
        PesticideSelected.style.display = "none";
    } else {
        PesticideSelected.style.display = "none";
        OthersInput.style.display = "none";
        OtherIDInput.style.display = "none";
    }
}


    </script>
  @endsection