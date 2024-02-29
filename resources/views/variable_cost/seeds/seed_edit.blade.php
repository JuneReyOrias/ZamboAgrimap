
@extends('admin.dashb')
@section('admin')



<div class="page-content">

    <nav class="page-breadcrumb">
      <ol class="breadcrumb">
    </nav>
    {{-- <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75% Complete</div>
  
    </div> --}}
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
        {{-- <h4 class="card-titles" style="display: flex;text-align: center; "><span></span>Rice Survey Form Zamboanga City</h4>
          <br> --}}
            <h6 class="card-title"><span>V.</span>Variable Cost</h6>
            <h5 class="card-title"><span>a.</span>Seeds Update</h5>
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
        
           <form action{{url('AddNewSeeed')}} method="post">
              @csrf

                   {{-- seeds --}}
                   <div class="row mb-3">
                    <h2 class="card-title"><span></span>seeds informations:</h2>
                  
                   
             
                    <div class="col-md-3 mb-3">
                      <label class="form-expand" for="seed_name">Seed Name:</label>
                      <input type="text" class="form-control placeholder-text "value="{{$seeds->seed_name}}" name="seed_name" id="validationCustom01" placeholder=" enter seed name" value="{{ old('seed_name') }}" >
                    </div>
                      <div class="col-md-3 mb-3">
                        <label class="form-expand" for="seed_type">Seed Type:</label>
                        <input type="text" class="form-control placeholder-text @error('seed_type') is-invalid @enderror"value="{{$seeds->seed_type}}" name="seed_type" id="validationCustom01" placeholder="Enter seed type" value="{{ old('seed_type') }}" >
                     
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
                      <label class="form-expand" for="unit_price">Unit Price:</label>
                      <input type="text" class="form-control placeholder-text @error('unit_price') is-invalid @enderror"value="{{$seeds->unit_price}}" name="unit_price" id="unitPriceInput" placeholder="Enter unit price" value="{{ old('unit_price') }}" >
                      @error('unit_price')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                      <label class="form-expand" for="total_seed_cost">Total Seed Cost:</label>
                      <input type="text" class="form-control placeholder-text @error('total_seed_cost') is-invalid @enderror"value="{{$seeds->total_seed_cost}}" name="total_seed_cost" id="totalSeedCostInput" placeholder="Enter total seed cost" value="{{ old('total_seed_cost') }}" >
                      @error('total_seed_cost')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                    </div>
                  </div>
    
             
            
        
    
              
       
    
  
 
  <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a  href="{{route('variable_cost.seeds.view')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
    <button  type="submit" class="btn btn-success me-md-2">Save</button></a></p>
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
    </script>
  @endsection