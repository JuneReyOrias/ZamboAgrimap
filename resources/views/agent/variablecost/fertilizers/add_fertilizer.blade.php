@extends('agent.agent_Dashboard')
@section('agent') 

<div class="page-content">

    <nav class="page-breadcrumb">
  
    </nav>
    {{-- <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85% Complete</div>
  
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
            <h6 class="card-title"><span>V.</span>Variable Cost</h6>
            <h5 class="card-title"><span>c.</span>Fertilizers</h5>
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
        
           <form action{{url('AddNewfertilizers')}} method="post">
              @csrf



              {{-- fertilizers --}}
              <div class="row mb-3">
                <h2 class="card-title"><span></span>fertilizer informations:</h2>
              
               
         
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="name_of_fertilizer">Name Of Ferilizer:</label>
                  <input type="text" class="form-control placeholder-text " name="name_of_fertilizer" id="validationCustom01" placeholder=" Enter fertilizer name" value="{{ old('name_of_fertilizer') }}" >
                </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="type_of_fertilizer">Type of Fertilizer:</label>
                    <input type="text" class="form-control placeholder-text @error('type_of_fertilizer') is-invalid @enderror" name="type_of_fertilizer" id="validationCustom01" placeholder="Enter type fertilizer" value="{{ old('type_of_fertilizer') }}" >
                 
                  </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="no_ofsacks">No. of Sacks:</label>
                  <input type="text" class="form-control placeholder-text @error('no_ofsacks') is-invalid @enderror" name="no_ofsacks" id="no_ofsacks" placeholder="Enter no of sacks" value="{{ old('no_ofsacks') }}" >
                  @error('no_ofsacks')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="unitprice_per_sacks">Unit Price per sacks:</label>
                  <input type="text" class="form-control placeholder-text @error('unitprice_per_sacks') is-invalid @enderror" name="unitprice_per_sacks" id="unitprice_per_sacks" placeholder="Enter unit price/sacks" value="{{ old('unitprice_per_sacks') }}" >
                  @error('unitprice_per_sacks')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="total_cost_fertilizers">Total Cost Fertilizers:</label>
                  <input type="text" class="form-control placeholder-text @error('total_cost_fertilizers') is-invalid @enderror" name="total_cost_fertilizers" id="total_cost_fertilizers" placeholder="Enter total cost" value="{{ old('total_cost_fertilizers') }}" >
                  @error('total_cost_fertilizers')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

           
              </div>

         
              
   <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
      {{-- <a  href="{{route('production_data.index')}}"button  class="btn btn-success me-md-2">Back</button></a></p> --}}
    <button  type="submit" class="btn btn-success me-md-2">Next</button></a></p>
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
  
  </div>
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
    </script>
  @endsection