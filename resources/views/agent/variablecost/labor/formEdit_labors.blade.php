@extends('agent.agent_Dashboard')
@section('agent') 
<div class="page-content">

    <nav class="page-breadcrumb">
  
    </nav>
    {{-- <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80% Complete</div>
  
    </div> --}}
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
         
          <div class="card-body">
            <div class="card-body">

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <h6 class="card-title"><span>V.</span>Variable Cost</h6>
            <h5 class="card-title"><span>b.</span>Labor Update</h5>
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
        
           <form action{{url('LaborDataupdate')}} method="post">
              @csrf
            {{-- adding new labor data --}}
            <div class="row mb-3">
              <h2 class="card-title"><span></span>Labors informations:</h2>
            
             
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="no_of_person">No of Person:</label>
                <input type="text" class="form-control placeholder-text @error('no_of_person') is-invalid @enderror"value="{{$labors->no_of_person}}" name="no_of_person" id="quantityInput" placeholder="Enter no_of_person" value="{{ old('no_of_person') }}" >
                @error('no_of_person')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-expand" for="rate_per_person">Rate per Person:</label>
                <input type="text" class="form-control placeholder-text @error('rate_per_person') is-invalid @enderror"value="{{$labors->rate_per_person}}" name="rate_per_person" id="unitPriceInput" placeholder="Enter rate/person" value="{{ old('rate_per_person') }}" >
                @error('rate_per_person')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-expand" for="total_labor_cost">Total Labor Cost:</label>
                <input type="text" class="form-control placeholder-text @error('total_labor_cost') is-invalid @enderror"value="{{$labors->total_labor_cost}}" name="total_labor_cost" id="totalLaborCostInput" placeholder="Enter total labor cost" value="{{ old('total_labor_cost') }}" >
                @error('total_labor_cost')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            </div>


  <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a  href="{{route('agent.variablecost.labor.show_laborData')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
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
    // Function to calculate total labor cost
    function calculateTotalLaborCost() {
        var noOfPerson = parseFloat(document.getElementById("quantityInput").value);
        var ratePerPerson = parseFloat(document.getElementById("unitPriceInput").value);
        
        var totalLaborCost = noOfPerson * ratePerPerson;

        // Update the total labor cost input field
        document.getElementById("totalLaborCostInput").value = totalLaborCost.toFixed(2); // Format to two decimal places
    }

    // Attach event listeners to trigger calculation on input change
    document.getElementById("quantityInput").addEventListener("input", calculateTotalLaborCost);
    document.getElementById("unitPriceInput").addEventListener("input", calculateTotalLaborCost);
</script>
  
  
  
  
  
  @endsection