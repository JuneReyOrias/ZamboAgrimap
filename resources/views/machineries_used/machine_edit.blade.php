@extends('admin.dashb')
@section('admin')

<div class="page-content">

  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      
    </ol>
  </nav>
 
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">


          @if($errors->any())
          <ul class="alert alert-warning">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          
            @endforeach
            <button type="button"  class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </ul>
          @endif
          @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif



          <h6 class="card-title"><span>IV.</span>machineries Used Update </h6>

          <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
       
         
         
         <form  action{{url('updateMachineries')}} method="post"  >
            @csrf
            <div class="row mb-3">
              <h2 class="card-title"><span>a.</span>Plowing Machineries:</h2>
              
               {{-- personl info id --}}
               <div >    
               
                <input type="hidden" id="personal_informations_id"  name="personal_informations_id" value="{{$machineries->personal_informations_id}}" >
              </div>
              <div >    
               
                <input type="hidden" id="farm_profiles_id"  name="farm_profiles_id" value="{{$machineries->farm_profiles_id}}" >
              </div>
              
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="plowing_machineries_used">Plowing Machineries Used:</label>
                <input type="text" class="form-control placeholder-text "value="{{$machineries->plowing_machineries_used}}" name="plowing_machineries_used" id="plowing_machineries_used" placeholder=" enter plowing machineries used" value="{{ old('plowing_machineries_used') }}" >
              </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="plo_ownership_status">Ownership Status:</label>
                  <input type="text" class="form-control placeholder-text @error('plo_ownership_status') is-invalid @enderror"value= "{{$machineries->plo_ownership_status}}" name="plo_ownership_status" id="plo_ownership_status" placeholder="Enter ownership status" value="{{ old('plo_ownership_status') }}" >
               
                </div>
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="no_of_plowing">No. of Plowing:</label>
                <input type="text" class="form-control placeholder-text @error('no_of_plowing') is-invalid @enderror"name="no_of_plowing"value= "{{$machineries->no_of_plowing}}" name="no_of_plowing" id="no_of_plowing" placeholder="Enter no. of plowing" value="{{ old('no_of_plowing') }}" >
                @error('no_of_plowing')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="plowing_cost">Plowing Cost:</label>
                <input type="text" class="form-control placeholder-text @error('plowing_cost') is-invalid @enderror" name="plowing_cost" id="plowingCostInput"value= "{{$machineries->plowing_cost}}" placeholder="Enter plowing cost" value="{{ old('plowing_cost') }}" >
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
                <input type="text" class="form-control placeholder-text "value= "{{$machineries->harrowing_machineries_used}}" name="harrowing_machineries_used" id="harrowingmachine" placeholder=" enter plowing machineries used" value="{{ old('harrowing_machineries_used') }}" >
              </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="harro_ownership_status">Ownership Status:</label>
                  <input type="text" class="form-control placeholder-text @error('harro_ownership_status') is-invalid @enderror" value= "{{$machineries->harro_ownership_status}}" name="harro_ownership_status" id="validationCustom01" placeholder="Enter ownership status" value="{{ old('harro_ownership_status') }}" >
               
                </div>
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="no_of_harrowing">No. of Harrowing:</label>
                <input type="text" class="form-control placeholder-text @error('no_of_harrowing') is-invalid @enderror"value= "{{$machineries->no_of_harrowing}}" name="no_of_harrowing" id="no_of_harrowing" placeholder="Enterno. of harrowing" value="{{ old('no_of_harrowing') }}" >
                @error('no_of_harrowing')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="harrowing_cost">Harrowing Cost:</label>
                <input type="text" class="form-control placeholder-text @error('harrowing_cost') is-invalid @enderror" name="harrowing_cost" id="harrowingCostInput" value="{{$machineries->harrowing_cost}}" placeholder="Enter harrowing cost" value="{{ old('harrowing_cost') }}" >
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
                  <input type="text" class="form-control placeholder-text " name="harvesting_machineries_used" id="harvesting_machineries_used"value= "{{$machineries->harvesting_machineries_used}}" placeholder=" enter  machineries used" value="{{ old('harvesting_machineries_used') }}" >
                </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="harvest_ownership_status">Ownership Status:</label>
                    <input type="text" class="form-control placeholder-text @error('harvest_ownership_status') is-invalid @enderror" name="harvest_ownership_status"value= "{{$machineries->harvest_ownership_status}}" id="harvest_ownership_status" placeholder="Enter ownership status" value="{{ old('harvest_ownership_status') }}" >
                 
                  </div>
               
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="harvesting_cost">Harvesting Cost:</label>
                  <input type="text" class="form-control placeholder-text @error('harvesting_cost') is-invalid @enderror" name="harvesting_cost" id="harvestingCostInput"value= "{{$machineries->harvesting_cost}}"  placeholder="Enter harvesting cost" value="{{ old('harvesting_cost') }}" >
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
  <input type="text" class="form-control placeholder-text " name="postharvest_machineries_used"value= "{{$machineries->postharvest_machineries_used}}" id="postharavestMachine" placeholder=" enter machineries used" value="{{ old('postharvest_machineries_used') }}" >
</div>
  <div class="col-md-3 mb-3">
    <label class="form-expand" for="postharv_ownership_status">Ownership Status:</label>
    <input type="text" class="form-control placeholder-text @error('postharv_ownership_status') is-invalid @enderror" name="postharv_ownership_status" id="machienStatus"value= "{{$machineries->postharv_ownership_status}}" placeholder="Enter ownership status" value="{{ old('postharv_ownership_status') }}" >
 
  </div>


<div class="col-md-3 mb-3">
  <label class="form-expand" for="post_harvest_cost">PostHarvest Cost:</label>
  <input type="text" class="form-control placeholder-text @error('post_harvest_cost') is-invalid @enderror" name="post_harvest_cost" id="postHarvestCostInput" value= "{{$machineries->post_harvest_cost}}"placeholder="Enter of post harvest cost" value="{{ old('post_harvest_cost') }}" >
  @error('post_harvest_cost')
  <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<div class="col-md-3 mb-3">
  <label class="form-expand" for="total_cost_for_machineries">Total Cost for Machineries:</label>
  <input type="text" class="form-control placeholder-text @error('total_cost_for_machineries') is-invalid @enderror"value= "{{$machineries->total_cost_for_machineries}}" name="total_cost_for_machineries" id="totalCostInput" placeholder="Enter total expenses" value="{{ old('total_cost_for_machineries') }}" >
  @error('total_cost_for_machineries')
  <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
</div>
  
<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a  href="{{route('machineries_used.machine_create')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
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
      totalCostInput.value = totalCost.toFixed(2); // You can adjust the text of decimal places as needed
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