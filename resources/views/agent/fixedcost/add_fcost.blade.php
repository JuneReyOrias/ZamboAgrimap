@extends('agent.agent_Dashboard')
@section('agent') 

<div class="page-content">

    <nav class="page-breadcrumb">
      <ol class="breadcrumb">
        
      </ol>
    </nav>
    {{-- <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45% Complete</div>
  
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
        <h4 class="card-titles" style="display: flex;text-align: center; "><span></span>Rice Survey Form Zamboanga City</h4>
        <br>
            <h6 class="card-title"><span>III.</span>Fixed Cost</h6>
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
         

           <form  action{{url('AddFcost')}} method="post"  >
              @csrf
               <div class="row mb-3">
                <h2 class="card-title"><span>a.</span>Rice Farmers Fixed Cost:</h2>
                <div class="col-md-3 mb-3">    
                  @php
                $id = Auth::id();
  
            // Find the user by their ID and eager load the personalInformation relationship
            $profile= App\Models\PersonalInformations::where('users_id', $id)->latest()->first();
  
              @endphp
                  <label class="form-expand" for="personal_informations_id">Farmers Name:</label>
                  <select class="form-control placeholder-text" name="personal_informations_id" aria-label="personal_informations_id">
                        
                    <option value="{{ $profile->id }}">{{ $profile->first_name.' '. $profile->last_name}}</option>
              
            </select>
                </div>
                <div class="col-md-3 mb-3">    
                  @php
                $id = Auth::id();
  
            // Find the user by their ID and eager load the personalInformation relationship
            $farmprofile= App\Models\FarmProfile::find($id)->latest()->first();
  
              @endphp
                  <label class="form-expand" for="farm_profiles_id">FarmProfile:</label>
                  <select class="form-control mb-4 mb-md-0" name="farm_profiles_id" aria-label="farm_profiles_id">
                 
                            <option value="{{ $farmprofile->id }}">{{ $farmprofile->tenurial_status }}</option>
                      
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="particular">Particular (Fixed Cost):</label>
                  <select class="form-control placeholder-text @error('particular') is-invalid @enderror" name="particular" id="selectParticular" onchange="checkParticular()" aria-label="label select e">
                    <option selected disabled>Select</option>
                    <option value="Land Rental Cost" {{ old('particular') == 'Land Rental' ? 'selected' : '' }}>Land Rental</option>
                    <option value="Land Ownership Cost" {{ old('particular') == 'Land Ownership Cost' ? 'selected' : '' }}>Land Ownership Cost</option>
                    <option value="Equipment Costs" {{ old('particular') == 'Equipment Costs' ? 'selected' : '' }}>Equipment Costs</option>
                    <option value="Infrastructure Costs" {{ old('particular') == 'Infrastructure Costs' ? 'selected' : '' }}>Infrastructure Costs</option>
          
                    <option value="Other" {{ old('particular') == 'Other' ? 'selected' : '' }}>Others</option>
                  </select>
                  
                  
                </div>
                 {{-- add new tenurial status --}}
                 <div class="col-md-3 mb-3" id="ParticularInput" style="display: none;">
                  <label for="ParticularInput">Others(Input here):</label>
                  <input type="text" id="ParticularInputField" class="form-control placeholder-text @error('Add_Particular') is-invalid @enderror" name="Add_Particular" placeholder=" Enter particular(fixed cost)" value="{{ old('Add_Particular') }}">
                  @error('Add_Particular')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="no_of_ha">No. of Has:</label>
                  <input type="text" class="form-control placeholder-text @error('no_of_ha') is-invalid @enderror" name="no_of_ha" id="no_of_ha" placeholder="Enter No. of Has" value="{{ old('no_of_ha') }}" >
                  @error('no_of_ha')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="cost_per_ha">Cost/Has(Has):</label>
                <input type="text" class="form-control placeholder-text @error('cost_per_ha') is-invalid @enderror" name="cost_per_ha" id="cost_per_ha" placeholder="Enter Cost/Has" value="{{ old('cost_per_ha') }}" >
                @error('cost_per_ha')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="total_amount">Total Amount:</label>
                <input type="text" class="form-control placeholder-text @error('total_amount') is-invalid @enderror" name="total_amount" id="total_amount" placeholder="Enter total amount" value="{{ old('total_amount') }}" >
                @error('total_amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            </div>
           
  
            
  
  <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  {{-- <a  href="{{route('agent.farmprofile.add_profile')}}"button  class="btn btn-success me-md-2">Back</button></a></p> --}}
  <button  type="submit" class="btn btn-success me-md-2">Next</button></a></p>
          </form>
       
        </div>
      </div>
    </div>
  </div>
  
  
  
  
  </div>
  <script>
  // Get references to the input fields
  const no_of_ha = document.getElementById('no_of_ha');
  const cost_per_ha = document.getElementById('cost_per_ha');
  const total_amount = document.getElementById('total_amount');
  
  // Function to calculate and display the total cost
  function calculateTotalFertilizerCost() {
      const quantity = parseFloat(no_of_ha.value) || 0;
      const unitPrice = parseFloat(cost_per_ha.value) || 0;
  
      const totalFertilizerCost = quantity * unitPrice;
  
      // Display the total fertilizer cost in the input field
      total_amount.value = totalFertilizerCost.toFixed(2); // You can adjust the text of decimal places as needed
  }
  
  // Calculate the total fertilizer cost whenever the quantity or unit price changes
  no_of_ha.addEventListener('input', calculateTotalFertilizerCost);
  cost_per_ha.addEventListener('input', calculateTotalFertilizerCost);
  
  // Initial calculation when the page loads
  calculateTotalFertilizerCost();
  
  // selected   others to add a new particular input
  function checkParticular() {
        var select = document.getElementById("selectParticular");
        var option = select.options[select.selectedIndex].value;
    
        if (option === 'Other') {
          document.getElementById("ParticularInput").style.display = "block";
        } else {
          document.getElementById("ParticularInput").style.display = "none";
        }
        
      }
    
      // Add new tenurial status to the select element
      document.getElementById("ParticularInputField").addEventListener("change", function() {
        var newTenure = this.value.trim();
        if (newTenure !== '') {
          var select = document.getElementById("selectParticular");
          var option = document.createElement("option");
          option.text = newTenure;
          option.value = newTenure;
          select.add(option);
        }
      });
      </script>
  @endsection