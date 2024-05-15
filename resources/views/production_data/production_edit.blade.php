@extends('admin.dashb')
@section('admin')


<div class="page-content">

  <nav class="page-breadcrumb">
    <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">6 out of 6 to Complete</div>
  
    </div>
  </nav>
  
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

  <h6 class="card-title"><span>VI.</span>Last Production Data</h6>
  
  <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
 
         <form id="surveyForm" action{{url('Proddataupdate')}} method="post" >
            @csrf

            
            <div >

              <input type="hidden" name="users_id" value="{{ $userId}}">
             
           
       </div>
            <div>
               
              <input type="hidden" name="agri_districts_id"  value="{{$agri_districts_id}}">
                 
               
            
           
            
          </div>
            <div class="row mb-3">
              <h2 class="card-title"><span>a.</span>Seed info and Usage details:</h2>
              <div class="col-md-3 mb-3">    
           
                <label class="form-expand" for="personal_informations_id">Farmers Name:</label>
                <select class="form-control placeholder-text" name="personal_informations_id" aria-label="personal_informations_id">
                      
                
                  <option value="{{ $productions->personal_informations_id }}">{{ $productions->personalInformation->first_name.' '. $productions->personalInformation->last_name}}</option>
            
          </select>
              </div>
              <div class="col-md-3 mb-3">    
        
                <label class="form-expand" for="farm_profiles_id">FarmProfile:</label>
                <select class="form-control mb-4 mb-md-0" name="farm_profiles_id" aria-label="farm_profiles_id">
                    @if($productions)

                    <option value="{{ $productions->farm_profiles_id }}">{{ $productions->farmprofile->tenurial_status }}</option>
                    @else
                        <option value="" disabled>No farm profile available</option>
                    @endif
                </select>
              </div>
              <div class="col-md-3 mb-3"style="font-size: 10px">
                <label class="form-expand" for="seeds_typed_used">Rice Seed Variety:</label>
                
                <select class="form-control placeholder-text @error('seeds_typed_used') is-invalid @enderror" name="seeds_typed_used" id="selectseedVariety" onchange="checkseedVariety()" aria-label="label select e">
                  {{-- @if($farmprofile)
                  <option value="{{ $farmprofile->type_rice_variety !== 'n/a' ? $farmprofile->type_rice_variety : ($farmprofile->preferred_variety ? $farmprofile->preferred_variety : ($farmprofile->type_of_variety === 'inbred' || $farmprofile->type_of_variety === 'hybrid' ? $farmprofile->type_of_variety : '')) }}">
                    {{ $farmprofile->type_rice_variety !== 'n/a' ? $farmprofile->type_rice_variety : ($farmprofile->preferred_variety ? $farmprofile->preferred_variety : ($farmprofile->type_of_variety === 'inbred' || $farmprofile->type_of_variety === 'hybrid' ? $farmprofile->type_of_variety : '')) }}
                </option>
                
                @else
                    <option value="" disabled>No farm profile available</option>
                @endif --}}

                @if($productions)

                <option value="{{ $productions->seeds_typed_used }}">{{ $productions->seeds_typed_used }}</option>
                @else
                    <option value="" disabled>No farm profile available</option>
                @endif
                 
                </select>
                
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="seeds_used_in_kg">Seeds in kgs/bag used:</label>
                <input type="text" class="form-control placeholder-text @error('seeds_used_in_kg') is-invalid @enderror"value="{{ number_format($productions->seeds_used_in_kg,2)}}" name="seeds_used_in_kg" id="seeds_used_in_kg" placeholder="Enter seeds kg/bag used" value="{{ old('seeds_used_in_kg') }}" >
                @error('seeds_used_in_kg')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-expand" for="seed_source">Seed Source:</label>
                  <select class="form-control placeholder-text @error('seed_source') is-invalid @enderror" id="seed_source"onchange="checkSeedsrc()" name="seed_source" aria-label="Floating label select e">
                    <option value="{{ $productions->seed_source}}">{{ $productions->seed_source}}</option>
                  <option value="Government Subsidy" {{ old('seed_source') == 'Government Subsidy' ? 'selected' : '' }}>Government Subsidy</option>
                  <option value="Traders" {{ old('seed_source') == 'Traders' ? 'selected' : '' }}>Traders</option>
                  <option value="Own" {{ old('seed_source') == 'Own' ? 'selected' : '' }}>Own</option>
                  <option value="Add" {{ old('seed_source') == 'Add' ? 'selected' : '' }}>Add</option>
                </select>
                @error('seed_source')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
                              {{-- addding new source capital --}}
                              <div class="col-md-3 mb-3" id="SeedSrcInput" style="display: none;">
                                <label for="SeedSrcInput">Add Seed Source :</label>
                                <input type="text" id="SourceCapitalInputField" class="form-control placeholder-text @error('add_seedsource') is-invalid @enderror" name="add_seedsource" placeholder=" Enter source of Capital" value="{{ old('add_seedsource') }}">
                                @error('add_seedsource')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="no_of_fertilizer_used_in_bags">No. of fertilizer used in bags:</label>
                <input type="text" class="form-control placeholder-text @error('no_of_fertilizer_used_in_bags') is-invalid @enderror"value="{{ number_format($productions->no_of_fertilizer_used_in_bags,2)}}" name="no_of_fertilizer_used_in_bags" id="no_of_fertilizer_used_in_bags" placeholder="Enter  No. of fertilizer" value="{{ old('no_of_fertilizer_used_in_bags') }}" >
                @error('no_of_fertilizer_used_in_bags')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-expand" for="no_of_pesticides_used_in_l_per_kg">No. of pesticides used in L/kg:</label>
                <input type="text" class="form-control placeholder-text @error('no_of_pesticides_used_in_l_per_kg') is-invalid @enderror"value="{{ number_format($productions->no_of_pesticides_used_in_l_per_kg,2)}}" name="no_of_pesticides_used_in_l_per_kg" id="no_of_pesticides_used_in_l_per_kg" placeholder="Enter no. of pesticides" value="{{ old('no_of_pesticides_used_in_l_per_kg') }}" >
                @error('no_of_pesticides_used_in_l_per_kg')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="no_of_insecticides_used_in_l">No. of insecticides used in L:</label>
                <input type="text" class="form-control placeholder-text @error('no_of_insecticides_used_in_l') is-invalid @enderror"value="{{ number_format($productions->no_of_insecticides_used_in_l,2)}}" name="no_of_insecticides_used_in_l" id="no_of_insecticides_used_in_l" placeholder="Enter no. of insecticides" value="{{ old('no_of_insecticides_used_in_l') }}" >
                @error('no_of_insecticides_used_in_l')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>

              
            </div>
    {{-- Crop Planting Details --}}
    <div class="row mb-3">
      <h2 class="card-title"><span>b.</span>Crop Planting Details:</h2>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="area_planted">Area planted:</label>
        <input type="text" class="form-control placeholder-text @error('area_planted') is-invalid @enderror"value="{{ $productions->area_planted}}" name="area_planted" id="validationCustom01" placeholder="Enter area planted" value="{{ old('area_planted') }}" >
        @error('area_planted')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
      <label class="form-expand" for="date_planted" style="font-size: 12px;">Date Planted:</label>
      <input class="form-control placeholder-text @error('date_planted') is-invalid @enderror"
             name="date_planted" id="datepicker" placeholder="date planted"value="{{ $productions->date_planted}}"
             value="{{ old('date_planted') }}" data-input='true'>
      @error('date_planted')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
     
    <div class="col-md-3 mb-3">
      <label class="form-expand" for="validationCustom02" style="font-size: 12px;">Date Harvested:</label>
      <input class="form-control placeholder-text @error('date_harvested') is-invalid @enderror"
             name="date_harvested" id="datepicker" placeholder="date harvested"value="{{ $productions->date_harvested}}" 
             value="{{ old('date_harvested') }}" data-input='true'>
      @error('date_harvested')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
     
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="yield_tons_per_kg">Yield (tons/kg):</label>
        <input type="text" class="form-control placeholder-text @error('yield_tons_per_kg') is-invalid @enderror"value="{{ $productions->yield_tons_per_kg}}" name="yield_tons_per_kg" id="harrowingCostInput" placeholder="Enter yields" value="{{ old('yield_tons_per_kg') }}" >
        @error('yield_tons_per_kg')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
    </div>
           
        
                {{-- Crop Planting Details --}}
    <div class="row mb-3">
      <h2 class="card-title"><span>c.</span>Pricing and Sales Info:</h2>
    
     

      <div class="col-md-3 mb-3">
        <label class="form-expand" for="unit_price_palay_per_kg">Unit price of Palay per/kgs:</label>
        <input type="text" class="form-control placeholder-text @error('unit_price_palay_per_kg') is-invalid @enderror"value="{{ $productions->unit_price_palay_per_kg}}" name="unit_price_palay_per_kg" id="unit_price_palay_per_kg" placeholder="Enter unit price of palay" value="{{ old('unit_price_palay_per_kg') }}" >
        @error('unit_price_palay_per_kg')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
     
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="unit_price_rice_per_kg">Unit price of Rice/kgs(PHP):</label>
        <input type="text" class="form-control placeholder-text @error('unit_price_rice_per_kg') is-invalid @enderror"value="{{ $productions->unit_price_rice_per_kg}}" name="unit_price_rice_per_kg" id="unit_price_rice_per_kg" placeholder="Enter unit price of rice" value="{{ old('unit_price_rice_per_kg') }}" >
        @error('unit_price_rice_per_kg')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
     
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="type_of_product">Type of product:</label>
        <input type="text" class="form-control placeholder-text @error('type_of_product') is-invalid @enderror"value="{{ $productions->type_of_product}}" name="type_of_product" id="validationCustom01" placeholder="Enter type of product" value="{{ old('type_of_product') }}" >
        @error('type_of_product')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
      <label class="form-expand" for="sold_to">Sold to:</label>
      <select class="form-control placeholder-text @error('sold_to') is-invalid @enderror" id="sold_to"onchange="checkSoldTo()" name="sold_to" aria-label="Floating label select e">
        <option value="{{ $productions->sold_to}}">{{ $productions->sold_to}}</option>
        <option value="Palay" {{ old('sold_to') == 'Palay' ? 'selected' : '' }}>Palay</option>
        <option value="Rice" {{ old('sold_to') == 'Rice' ? 'selected' : '' }}>Rice</option>
        
  
      </select>
      @error('sold_to')
      <div class="invalid-feedback">{{ $message }}</div>
  @enderror
    </div>
      {{-- when selected a Palay then open window of input of the prefer for miiling loaction ot machine used --}}
      <div class="col-md-3 mb-3" id="PalayInput" style="display: none;">
        <label for="OthersInput">If palay milled where?:</label>
        <input type="text" id="OthersInput" class="form-control placeholder-text @error('if_palay_milled_where') is-invalid @enderror"value="{{ $productions->if_palay_milled_where}}" name="if_palay_milled_where" id="validationCustom02" placeholder=" palay milled where?"  value="{{ old('if_palay_milled_where') }}">
        @error('if_palay_milled_where')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
      </div>

      <div class="col-md-3 mb-3" id="RiceInput" style="display: none;">
        <label for="OthersInput">If palay milled where?:</label>
        
        <select class="form-control placeholder-text @error('if_palay_milled_where') is-invalid @enderror" id="if_palay_milled_where"onchange="checkSoldTo()" name="if_palay_milled_where" aria-label="Floating label select e">
        <option selected disabled>Select</option>
        <option value="N/A" {{ old('sold_to') == 'N/A' ? 'selected' : '' }}>N/A</option>
       
  
      </select>
       
        @error('if_palay_milled_where')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
      </div>



      <div class="col-md-3 mb-3">
        <label class="form-expand" for="gross_income_palay">Gross Income (Palay)PHP:</label>
        <input type="text" class="form-control placeholder-text @error('gross_income_palay') is-invalid @enderror"value="{{ $productions->gross_income_palay}}" name="gross_income_palay" id="gross_income_palay" placeholder="Enter yields" value="{{ old('gross_income_palay') }}" >
        @error('gross_income_palay')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="gross_income_rice">Gross Income (Rice)PHP:</label>
        <input type="text" class="form-control placeholder-text @error('gross_income_rice') is-invalid @enderror"value="{{$productions->gross_income_rice}}" name="gross_income_rice" id="gross_income_rice" placeholder="Enter yields" value="{{ old('gross_income_rice') }}" >
        @error('gross_income_rice')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
    </div>
           
        

<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a  href="{{route('personalinfo.create')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
  <button type="submit" class="btn btn-success me-md-2 btn-submit">Submit</button>

          </form>
       
        </div>
      </div>
    </div>
  </div>



</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
      $(document).on('click', '.btn-submit', function(event){
          var form = $(this).closest("form");
          
          event.preventDefault(); // Prevent the default button action
          
          swal({
              title: "Are you sure you want to submit this form?",
              text: "Please confirm your action.",
              icon: "warning",
              buttons: {
                  cancel: "Cancel",
                  confirm: {
                      text: "Yes, submit it!",
                      value: true,
                      visible: true,
                      className: "btn-success", // Add the success class to the button
                      closeModal: false // Prevent dialog from closing on confirmation
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
                  }, 500);
              }
          });
      });
  });

  // Function to handle successful form submission
  function handleFormSubmissionSuccess() {
      swal({
          title: "Rice survey completed successfully!",
          text: "Thank you for your submission.",
          icon: "success",
      });
  }
</script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      flatpickr("#datepicker", {
          dateFormat: "Y-m-d", // Date format (YYYY-MM-DD)
          // Additional options can be added here
      });
  });

   // selection of adding no. of cropping per year
   function checkSeedsrc() {
      var select = document.getElementById("seed_source");
      var option = select.options[select.selectedIndex].value;
  
      if (option === 'Add') {
        document.getElementById("SeedSrcInput").style.display = "block";
      } else {
        document.getElementById("SeedSrcInput").style.display = "none";
      }
      
    }
  
    // Add new tenurial status to the select element
    document.getElementById("CroppingInputField").addEventListener("change", function() {
      var newTenure = this.value.trim();
      if (newTenure !== '') {
        var select = document.getElementById("seed_source");
        var option = document.createElement("option");
        option.text = newTenure;
        option.value = newTenure;
        select.add(option);
      }
    });

    // selection for sold to 
    function checkSoldTo() {
  var sold_to = document.getElementById("sold_to");
  var PalayInput = document.getElementById("PalayInput");
  var RiceInput = document.getElementById("RiceInput");

  if (sold_to.value === "Palay") {
      PalayInput.style.display = "block";
      RiceInput.style.display = "none";
  } else if (sold_to.value === "Rice") {
      RiceInput.style.display = "block";
      PalayInput.style.display = "none";
  } else {
      PalayInput.style.display = "none";
      RiceInput.style.display = "none";
  }
}

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Get input elements
  const unit_price_palay_per_kg = document.getElementById('unit_price_palay_per_kg');
  const unit_price_rice_per_kg = document.getElementById('unit_price_rice_per_kg');
  const gross_income_palay = document.getElementById('gross_income_palay');
  const gross_income_rice = document.getElementById('gross_income_rice');

  // Add event listeners for input events
  unit_price_palay_per_kg.addEventListener('input', formatDecimal);
  unit_price_rice_per_kg.addEventListener('input', formatDecimal);
  gross_income_palay.addEventListener('input', formatDecimal);
  gross_income_rice.addEventListener('input', formatDecimal);

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