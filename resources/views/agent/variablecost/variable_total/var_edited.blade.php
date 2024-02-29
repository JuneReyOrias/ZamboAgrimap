
@extends('agent.agent_Dashboard')
@section('agent') 
<nav class="page-breadcrumb">
  
</nav>
{{-- <div class="progress mb-3">
  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100% Complete</div>

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
        <h6 class="card-title"><span>VI.</span>Variable Cost</h6>
        <h5 class="card-title"><span>F.</span>Variable Cost Total</h5>
        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
      
        <form action{{url('updatevaria')}} method="post">
          @csrf
          <div>
            @php
       $id = Auth::id();

       // Find the user by their ID and eager load the personalInformation relationship
       $seed= App\Models\Seed::find($id)->latest()->first();

        @endphp
            
            <input type="hidden" id="seeds_id" class="form-control mb-4 mb-md-0" name="total_seed_cost" id="seeds_id" value="{{ $seed->total_seed_cost}}">
             
          </div>  

          <div>
            @php
       $id = Auth::id();

       // Find the user by their ID and eager load the personalInformation relationship
       $labor= App\Models\Labor::find($id)->latest()->first();

        @endphp
            
            <input type="hidden" id="labors_id" class="form-control mb-4 mb-md-0" name="total_labor_cost" value="{{ $labor->total_labor_cost}}">
             
          </div>  


          <div>
            @php
       $id = Auth::id();

       // Find the user by their ID and eager load the personalInformation relationship
       $fertilize= App\Models\Fertilizer::find($id)->latest()->first();

        @endphp
            
            <input type="hidden" id="fertilizers_id" class="form-control mb-4 mb-md-0" name="total_cost_fertilizers" i value="{{ $fertilize->total_cost_fertilizers}}">
             
          </div>

          {{-- hidden id of pesticides to fetch to total --}}
          <div>
            @php
       $id = Auth::id();

       // Find the user by their ID and eager load the personalInformation relationship
       $pesticide= App\Models\Pesticide::find($id)->latest()->first();

        @endphp
            
            <input type="hidden" id="pesticides_id" class="form-control mb-4 mb-md-0" name="total_cost_fertilizers" i value="{{ $pesticide->total_cost_pesticides}}">
             
          </div>
{{-- hidden id of delivery cost to fetch to total variable cost--}}
          <div>
            @php
       $id = Auth::id();

       // Find the user by their ID and eager load the personalInformation relationship
       $transport = App\Models\Transport::find($id)->latest()->first();

        @endphp
            
            <input type="hidden" id="transports_id" class="form-control mb-4 mb-md-0" name="total_transport_per_deliverycost" i value="{{ $transport->total_transport_per_deliverycost}}">
             
          </div>
          <div class="row mb-3">
            <h2 class="card-title"><span>a.</span>Farmer Variable Cost:</h2>
            <div class="col-md-3 mb-3">
                <label class="form-expand" for="seeds_id"> Seeds ID:</label>
                <input type="text" class="form-control placeholder-text @error('seeds_id') is-invalid @enderror" name="seeds_id" id="seeds_id" value="{{$variable->seeds_id}}" placeholder="Enter total fuel cost" value="{{ old('seeds_id') }}" readonly>
                @error('seeds_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="labors_id">Labor ID:</label>
                <input type="text" class="form-control placeholder-text @error('labors_id') is-invalid @enderror" name="labors_id" id="labors_id"value="{{$variable->labors_id}}" placeholder="Enter total fuel cost" value="{{ old('labors_id') }}" readonly>
                @error('seeds_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="fertilizers_id">Fertilizers ID:</label>
                <input type="text" class="form-control placeholder-text @error('fertilizers_id') is-invalid @enderror" name="fertilizers_id" id="fertilizers_id"value="{{$variable->fertilizers_id}}" placeholder="Enter total fuel cost" value="{{ old('fertilizers_id') }}" readonly>
                @error('seeds_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="pesticides_id">Pesticides ID:</label>
                <input type="text" class="form-control placeholder-text @error('pesticides_id') is-invalid @enderror" name="pesticides_id" id="pesticides_id"value="{{$variable->pesticides_id}}" placeholder="Enter total fuel cost" value="{{ old('pesticides_id') }}" readonly>
                @error('seeds_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="transports_id">Transport ID:</label>
                <input type="text" class="form-control placeholder-text @error('transports_id') is-invalid @enderror" name="transports_id" id="transports_id"value="{{$variable->transports_id}}" placeholder="Enter total fuel cost" value="{{ old('transports_id') }}" readonly>
                @error('seeds_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            <div class="col-md-3 mb-3">
              <label class="form-expand" for="total_machinery_fuel_cost">Total Fuel Cost:</label>
              <input type="text" class="form-control placeholder-text @error('total_machinery_fuel_cost') is-invalid @enderror"value="{{$variable->total_machinery_fuel_cost}}" name="total_machinery_fuel_cost" id="total_machinery_fuel_cost" placeholder="Enter total fuel cost" value="{{ old('total_machinery_fuel_cost') }}" >
              @error('total_machinery_fuel_cost')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
            </div>
           
            <div class="col-md-3 mb-3">
              <label class="form-expand" for="total_variable_cost">Total Variable Cost:</label>
              <input type="text" class="form-control placeholder-text @error('total_variable_cost') is-invalid @enderror"value="{{$variable->total_variable_cost}}" name="total_variable_cost" id="total_variable_cost" placeholder="Enter total variable cost" value="{{ old('total_variable_cost') }}" >
              @error('total_variable_cost')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
            </div>
          </div>

<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a  href="{{route('agent.variablecost.variable_total.show_var')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
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
<script>
// Calculate total variable cost
function calculateTotalVariableCost() {
// Get the values of individual costs by their IDs
let totalSeedCost = parseFloat(document.getElementById('seeds_id').value) || 0;
let totalLaborCost = parseFloat(document.getElementById('labors_id').value) || 0;
let totalFertilizerCost = parseFloat(document.getElementById('fertilizers_id').value) || 0;
let totalPesticidesCost = parseFloat(document.getElementById('pesticides_id').value) || 0;
let totalTransportCost = parseFloat(document.getElementById('transports_id').value) || 0;
let totalFuelCost = parseFloat(document.getElementById('total_machinery_fuel_cost').value) || 0;
// Calculate the total variable cost by summing up individual costs
let totalVariableCost = totalSeedCost + totalLaborCost + totalFertilizerCost + totalPesticidesCost + totalTransportCost + totalFuelCost;

// Update Total Variable Cost input field with the calculated total variable cost
document.getElementById('total_variable_cost').value = totalVariableCost.toFixed(2);
}

// Attach change event listeners to select elements representing costs
document.getElementById('seeds_id').addEventListener('change', calculateTotalVariableCost);
document.getElementById('labors_id').addEventListener('change', calculateTotalVariableCost);
document.getElementById('fertilizers_id').addEventListener('change', calculateTotalVariableCost);
document.getElementById('pesticides_id').addEventListener('change', calculateTotalVariableCost);
document.getElementById('transports_id').addEventListener('change', calculateTotalVariableCost);
document.getElementById('total_machinery_fuel_cost').addEventListener('input', calculateTotalVariableCost);
// Initial calculation on page load
calculateTotalVariableCost();

</script>

@endsection