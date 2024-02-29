@extends('agent.agent_Dashboard')
@section('agent') 

<div class="page-content">

    <nav class="page-breadcrumb">
      <ol class="breadcrumb">
        
      </ol>
    </nav>
    {{-- <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60% Complete</div>
  
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

            <h6 class="card-title"><span>IV.</span>machineries Used</h6>
  
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
         
           
           
           <form  action{{url('AddMused')}} method="post"  >
              @csrf
              <div class="row mb-3">
                <h2 class="card-title"><span>a.</span>Plowing Machineries:</h2>
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
                  <label class="form-expand" for="plowing_machineries_used">Plowing Machineries Used:</label>
                  <input type="text" class="form-control placeholder-text " name="plowing_machineries_used" id="validationCustom01" placeholder=" enter plowing machineries used" value="{{ old('plowing_machineries_used') }}" >
                </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="plo_ownership_status">Ownership Status:</label>
                    <input type="text" class="form-control placeholder-text @error('plo_ownership_status') is-invalid @enderror" name="plo_ownership_status" id="validationCustom01" placeholder="Enter ownership status" value="{{ old('plo_ownership_status') }}" >
                 
                  </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="no_of_plowing">No. of Plowing:</label>
                  <input type="text" class="form-control placeholder-text @error('no_of_plowing') is-invalid @enderror" name="no_of_plowing" id="validationCustom01" placeholder="Enter no. of plowing" value="{{ old('no_of_plowing') }}" >
                  @error('no_of_plowing')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="plowing_cost">Plowing Cost:</label>
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
                  <input type="text" class="form-control placeholder-text " name="harrowing_machineries_used" id="validationCustom01" placeholder=" enter plowing machineries used" value="{{ old('harrowing_machineries_used') }}" >
                </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="harro_ownership_status">Ownership Status:</label>
                    <input type="text" class="form-control placeholder-text @error('harro_ownership_status') is-invalid @enderror" name="harro_ownership_status" id="validationCustom01" placeholder="Enter ownership status" value="{{ old('harro_ownership_status') }}" >
                 
                  </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="no_of_harrowing">No. of Harrowing:</label>
                  <input type="text" class="form-control placeholder-text @error('no_of_harrowing') is-invalid @enderror" name="no_of_harrowing" id="validationCustom01" placeholder="Enter no. of harrowing" value="{{ old('no_of_harrowing') }}" >
                  @error('no_of_harrowing')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="harrowing_cost">Harrowing Cost:</label>
                  <input type="text" class="form-control placeholder-text @error('harrowing_cost') is-invalid @enderror" name="harrowing_cost" id="harrowingCostInput" placeholder="Enter harrowing cost" value="{{ old('harrowing_cost') }}" >
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
                    <input type="text" class="form-control placeholder-text " name="harvesting_machineries_used" id="validationCustom01" placeholder=" enter  machineries used" value="{{ old('harvesting_machineries_used') }}" >
                  </div>
                    <div class="col-md-3 mb-3">
                      <label class="form-expand" for="harvest_ownership_status">Ownership Status:</label>
                      <input type="text" class="form-control placeholder-text @error('harvest_ownership_status') is-invalid @enderror" name="harvest_ownership_status" id="validationCustom01" placeholder="Enter ownership status" value="{{ old('harvest_ownership_status') }}" >
                   
                    </div>
                 
                 
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="harvesting_cost">Harvesting Cost:</label>
                    <input type="text" class="form-control placeholder-text @error('harvesting_cost') is-invalid @enderror" name="harvesting_cost" id="harvestingCostInput" placeholder="Enter harvesting cost" value="{{ old('harvesting_cost') }}" >
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
    <input type="text" class="form-control placeholder-text " name="postharvest_machineries_used" id="validationCustom01" placeholder=" enter machineries used" value="{{ old('postharvest_machineries_used') }}" >
  </div>
    <div class="col-md-3 mb-3">
      <label class="form-expand" for="postharv_ownership_status">Ownership Status:</label>
      <input type="text" class="form-control placeholder-text @error('postharv_ownership_status') is-invalid @enderror" name="postharv_ownership_status" id="validationCustom01" placeholder="Enter ownership status" value="{{ old('postharv_ownership_status') }}" >
   
    </div>
 
 
  <div class="col-md-3 mb-3">
    <label class="form-expand" for="post_harvest_cost">PostHarvest Cost:</label>
    <input type="text" class="form-control placeholder-text @error('post_harvest_cost') is-invalid @enderror" name="post_harvest_cost" id="postHarvestCostInput" placeholder="Enter of post harvest cost" value="{{ old('post_harvest_cost') }}" >
    @error('post_harvest_cost')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
  </div>

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
    <button  type="submit" class="btn btn-success me-md-2">Next</button></a></p>
            </form>
         
          </div>
        </div>
      </div>
    </div>
  
   
   
  </div>
  <script>
    // Get references to the input fields
    const plowingCostInput = document.getElementById('plowingCostInput');
    const harrowingCostInput = document.getElementById('harrowingCostInput');
    const harvestingCostInput = document.getElementById('harvestingCostInput');
    const postHarvestCostInput = document.getElementById('postHarvestCostInput');
    const totalCostInput = document.getElementById('totalCostInput');
    
    // Function to calculate and display the total cost
    function calculateTotalCost() {
        const plowingCost = parseFloat(plowingCostInput.value) || 0;
        const harrowingCost = parseFloat(harrowingCostInput.value) || 0;
        const harvestingCost = parseFloat(harvestingCostInput.value) || 0;
        const postHarvestCost = parseFloat(postHarvestCostInput.value) || 0;
    
        const totalCost = plowingCost + harrowingCost + harvestingCost + postHarvestCost;
    
        // Display the total cost in the total cost input field
        totalCostInput.value = totalCost.toFixed(2); // You can adjust the number of decimal places as needed
    }
    
    // Calculate the total cost whenever any of the input fields change
    plowingCostInput.addEventListener('input', calculateTotalCost);
    harrowingCostInput.addEventListener('input', calculateTotalCost);
    harvestingCostInput.addEventListener('input', calculateTotalCost);
    postHarvestCostInput.addEventListener('input', calculateTotalCost);
    
    // Initial calculation when the page loads
    calculateTotalCost();
    </script>
  @endsection