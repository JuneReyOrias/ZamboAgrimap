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
            {{-- @if($errors->any())
            <ul class="alert alert-warning">
              @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            
              @endforeach
              <button type="button"  class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </ul>
            @endif --}}
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
            <h6 class="card-title"><span>III.</span>Fixed Cost Update</h6>
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
         

           <form  action{{url(' UpdateFixedCost')}} method="post"  >
              @csrf

              <div class="row mb-3">
                <h2 class="card-title"><span>a.</span>Rice Farmers Fixed Cost:</h2>
                
                {{-- personl info id --}}
                <div >    
                 
                  <input type="hidden" id="personal_informations_id"  name="personal_informations_id" value="{{$fixedcosts->personal_informations_id}}" >
                </div>
                <div >    
                 
                  <input type="hidden" id="farm_profiles_id"  name="farm_profiles_id" value="{{$fixedcosts->farm_profiles_id}}" >
                </div>
                
              
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="particular">Particular (Fixed Cost):</label>
                  <input type="text" class="form-control placeholder-text "value="{{$fixedcosts->particular}}" name="particular" id="particular" placeholder=" enter Particular fixed Cost" value="{{ old('particular') }}" >
                </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="no_of_ha">No. of Has:</label>
                    <input type="text" class="form-control placeholder-text @error('no_of_ha') is-invalid @enderror"value="{{$fixedcosts->no_of_ha}}" name="no_of_ha" id="no_of_ha" placeholder="Enter No. of Has" value="{{ old('no_of_ha') }}" >
                    @error('no_of_ha')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="cost_per_ha">Cost/Has(Has):</label>
                  <input type="text" class="form-control placeholder-text @error('cost_per_ha') is-invalid @enderror" value="{{$fixedcosts->cost_per_ha}}" name="cost_per_ha" id="cost_per_ha" placeholder="Enter Cost/Has" value="{{ old('cost_per_ha') }}" >
                  @error('cost_per_ha')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="total_amount">Total Amount:</label>
                  <input type="text" class="form-control placeholder-text @error('total_amount') is-invalid @enderror"value="{{$fixedcosts->total_amount}}" name="total_amount" id="total_amount" placeholder="Enter No. of Years" value="{{ old('total_amount') }}" >
                  @error('total_amount')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
              </div>
             
  
        <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
          <a  href="{{route('agent.fixedcost.fcost_view')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
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
    function calculateTotalCost() {
        const noOfHasCost = parseFloat(no_of_ha.value) || 0;
        const CostperHasCost = parseFloat(cost_per_ha.value) || 0;
       
    
        const totalCost = noOfHasCost * CostperHasCost ;
    
        // Display the total cost in the total cost input field
        total_amount.value = totalCost.toFixed(2); // You can adjust the number of decimal places as needed
    }
    
    // Calculate the total cost whenever any of the input fields change
    no_of_ha.addEventListener('input', calculateTotalCost);
    cost_per_ha.addEventListener('input', calculateTotalCost);
    
    // Initial calculation when the page loads
    calculateTotalCost();
    </script>
  @endsection