@extends('admin.dashb')
@section('admin')


<div class="page-content">

  <nav class="page-breadcrumb">

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



        <h6 class="card-title"><span>V.</span>Variable Cost</h6>
        <h5 class="card-title"><span>d.</span>Pesticides</h5>
        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
    
         <form action{{url('pesticides')}} method="post">
            @csrf
            
              {{-- pesticides --}}
              <div class="row mb-3">
                <h2 class="card-title"><span></span>Pesticides informations:</h2>
              
               
         
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pesticides_name">Pesticides Name:</label>
                  <input type="text" class="form-control placeholder-text " name="pesticides_name" id="validationCustom01" placeholder=" Enter pesticides name" value="{{ old('pesticides_name') }}" >
                </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="type_ofpesticides">Type of Pesticides:</label>
                    <input type="text" class="form-control placeholder-text @error('type_ofpesticides') is-invalid @enderror" name="type_ofpesticides" id="validationCustom01" placeholder="Enter type of pesticides" value="{{ old('type_ofpesticides') }}" >
                 
                  </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="no_of_l_kg">Number of L or kg:</label>
                  <input type="text" class="form-control placeholder-text @error('no_of_l_kg') is-invalid @enderror" name="no_of_l_kg" id="no_of_l_kg" placeholder="Enter no of L or Kg" value="{{ old('no_of_l_kg') }}" >
                  @error('no_of_l_kg')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="unitprice_ofpesticides">Unit Price of Pesticides:</label>
                  <input type="text" class="form-control placeholder-text @error('unitprice_ofpesticides') is-invalid @enderror" name="unitprice_ofpesticides" id="unitprice_ofpesticides" placeholder="Enter unit price pesticides" value="{{ old('unitprice_ofpesticides') }}" >
                  @error('unitprice_ofpesticides')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="total_cost_pesticides">Total Cost Pesticides:</label>
                  <input type="text" class="form-control placeholder-text @error('total_cost_pesticides') is-invalid @enderror" name="total_cost_pesticides" id="total_cost_pesticides" placeholder="Enter total cost" value="{{ old('total_cost_pesticides') }}" >
                  @error('total_cost_pesticides')
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
  
   
             
             
         
          </div>
        </div>
      </div>
    
    </div>
  
  </div>
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
  @endsection