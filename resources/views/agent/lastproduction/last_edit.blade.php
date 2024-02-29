@extends('agent.agent_Dashboard')
@section('agent') 


<div class="page-content">

    <nav class="page-breadcrumb">
      <ol class="breadcrumb">
        
      </ol>
    </nav>
    {{-- <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70% Complete</div>
  
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

            <h6 class="card-title"><span>V.</span>Last Production Data Update</h6>
  
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
           
           <form  action{{url('Proddataupdate')}} method="post"  >
              @csrf
              <div class="row mb-3">
                <h2 class="card-title"><span>a.</span>Seed info and Usage details:</h2>
              
             
                {{-- personl info id --}}
                <div >    
                 
                  <input type="hidden" id="personal_informations_id"  name="personal_informations_id" value="{{$productions->personal_informations_id}}" >
                </div>
                <div >    
                 
                  <input type="hidden" id="farm_profiles_id"  name="farm_profiles_id" value="{{$productions->farm_profiles_id}}" >
                </div>
                

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="seeds_typed_used">Seed Type Used:</label>
                  <input type="text" class="form-control placeholder-text @error('seeds_typed_used') is-invalid @enderror"value="{{ $productions->seeds_typed_used}}" name="seeds_typed_used" id="seeds_typed_used" placeholder="Enter seeds type used" value="{{ old('seeds_typed_used') }}" >
                  @error('seeds_typed_used')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="seeds_used_in_kg">Seeds in kgs/bag used:</label>
                  <input type="number" class="form-control placeholder-text @error('seeds_used_in_kg') is-invalid @enderror"value="{{ $productions->seeds_used_in_kg}}" name="seeds_used_in_kg" id="seeds_used_in_kg" placeholder="Enter seeds kg/bag used" value="{{ old('seeds_used_in_kg') }}" >
                  @error('seeds_used_in_kg')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="seed_source">Seed Source:</label>
                    <select class="form-control placeholder-text @error('seed_source') is-invalid @enderror" id="seed_source" name="seed_source" aria-label="Floating label select e">
                      <option value="{{ $productions->seed_source}}">{{ $productions->seed_source}}</option>
                    <option value="Government Subsidy" {{ old('seed_source') == 'Government Subsidy' ? 'selected' : '' }}>Government Subsidy</option>
                    <option value="Traders" {{ old('seed_source') == 'Traders' ? 'selected' : '' }}>Traders</option>
                    <option value="Own" {{ old('seed_source') == 'Own' ? 'selected' : '' }}>Own</option>
                  </select>
                  @error('seed_source')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="no_of_fertilizer_used_in_bags">No. of fertilizer used in bags:</label>
                  <input type="number" class="form-control placeholder-text @error('no_of_fertilizer_used_in_bags') is-invalid @enderror"value="{{ $productions->no_of_fertilizer_used_in_bags}}" name="no_of_fertilizer_used_in_bags" id="no_of_fertilizer_used_in_bags" placeholder="Enter  No. of fertilizer" value="{{ old('no_of_fertilizer_used_in_bags') }}" >
                  @error('no_of_fertilizer_used_in_bags')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>

                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="no_of_pesticides_used_in_l_per_kg">No. of pesticides used in L/kg:</label>
                  <input type="number" class="form-control placeholder-text @error('no_of_pesticides_used_in_l_per_kg') is-invalid @enderror"value="{{ $productions->no_of_pesticides_used_in_l_per_kg}}" name="no_of_pesticides_used_in_l_per_kg" id="no_of_pesticides_used_in_l_per_kg" placeholder="Enter no. of pesticides" value="{{ old('no_of_pesticides_used_in_l_per_kg') }}" >
                  @error('no_of_pesticides_used_in_l_per_kg')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="no_of_insecticides_used_in_l">No. of insecticides used in L:</label>
                  <input type="number" class="form-control placeholder-text @error('no_of_insecticides_used_in_l') is-invalid @enderror"value="{{ $productions->no_of_insecticides_used_in_l}}" name="no_of_insecticides_used_in_l" id="no_of_insecticides_used_in_l" placeholder="Enter no. of insecticides" value="{{ old('no_of_insecticides_used_in_l') }}" >
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
          <input type="text" class="form-control placeholder-text @error('area_planted') is-invalid @enderror" name="area_planted"value="{{ $productions->area_planted}}" id="area_planted" placeholder="Enter area planted" value="{{ old('area_planted') }}" >
          @error('area_planted')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
        <div class="col-md-3 mb-3">
        <label class="form-expand" for="date_planted" style="font-size: 12px;">Date Planted:</label>
        <input class="form-control placeholder-text @error('date_planted') is-invalid @enderror"
               name="date_planted"value="{{ $productions->date_planted}}" id="datepicker" placeholder="date planted"
               value="{{ old('date_planted') }}" data-input='true'>
        @error('date_planted')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
       
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="validationCustom02" style="font-size: 12px;">Date Harvested:</label>
        <input class="form-control placeholder-text @error('date_harvested') is-invalid @enderror"
               name="date_harvested"value="{{ $productions->date_harvested}}" id="datepicker" placeholder="date harvested"
               value="{{ old('date_harvested') }}" data-input='true'>
        @error('date_harvested')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
       
        <div class="col-md-3 mb-3">
          <label class="form-expand" for="yield_tons_per_kg">Yield (tons/kg):</label>
          <input type="number" class="form-control placeholder-text @error('yield_tons_per_kg') is-invalid @enderror"value="{{ $productions->yield_tons_per_kg}}"  name="yield_tons_per_kg" id="harrowingCostInput" placeholder="Enter yields" value="{{ old('yield_tons_per_kg') }}" >
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
          <input type="number" class="form-control placeholder-text @error('unit_price_palay_per_kg') is-invalid @enderror"value="{{ $productions->unit_price_palay_per_kg}}" name="unit_price_palay_per_kg" id="unit_price_palay" placeholder="Enter unit price of palay" value="{{ old('unit_price_palay_per_kg') }}" >
          @error('unit_price_palay_per_kg')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
       
        <div class="col-md-3 mb-3">
          <label class="form-expand" for="unit_price_rice_per_kg">Unit price of Rice/kgs:</label>
          <input type="number" class="form-control placeholder-text @error('unit_price_rice_per_kg') is-invalid @enderror"value="{{ $productions->unit_price_rice_per_kg}}" name="unit_price_rice_per_kg" id="unit_price_rice" placeholder="Enter unit price of rice" value="{{ old('unit_price_rice_per_kg') }}" >
          @error('unit_price_rice_per_kg')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
       
        <div class="col-md-3 mb-3">
          <label class="form-expand" for="type_of_product">Type of product:</label>
          <input type="text" class="form-control placeholder-text @error('type_of_product') is-invalid @enderror"value="{{ $productions->type_of_product}}" name="type_of_product" id="type_of_product" placeholder="Enter type of product" value="{{ old('type_of_product') }}" >
          @error('type_of_product')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
        <div class="col-md-3 mb-3">
        <label class="form-expand" for="sold_to">Sold to:</label>
        <select class="form-control placeholder-text @error('sold_to') is-invalid @enderror" id="sold_to" name="sold_to" aria-label="Floating label select e">
          <option value="{{ $productions->sold_to}}">{{ $productions->sold_to}}</option>
          <option value="Palay" {{ old('sold_to') == 'Palay' ? 'selected' : '' }}>Palay</option>
          <option value="Rice" {{ old('sold_to') == 'Rice' ? 'selected' : '' }}>Rice</option>
          
    
        </select>
        @error('sold_to')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
        <div class="col-md-3 mb-3">
          <label class="form-expand" for="if_palay_milled_where">If palay milled where?:</label>
          <input type="text" class="form-control placeholder-text @error('if_palay_milled_where') is-invalid @enderror"value="{{ $productions->if_palay_milled_where}}" name="if_palay_milled_where" id="palay_milled" placeholder="Enter if palay milled where" value="{{ old('if_palay_milled_where') }}" >
          @error('if_palay_milled_where')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>

        <div class="col-md-3 mb-3">
          <label class="form-expand" for="gross_income_palay">Gross Income (Palay):</label>
          <input type="number" class="form-control placeholder-text @error('gross_income_palay') is-invalid @enderror"value="{{ $productions->gross_income_palay}}" name="gross_income_palay" id="gross_income_palay" placeholder="Enter yields" value="{{ old('gross_income_palay') }}" >
          @error('gross_income_palay')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
        <div class="col-md-3 mb-3">
          <label class="form-expand" for="gross_income_rice">Gross Income (Rice):</label>
          <input type="number" class="form-control placeholder-text @error('gross_income_rice') is-invalid @enderror"value="{{ $productions->gross_income_rice}}" name="gross_income_rice" id="gross_income_rice" placeholder="Enter yields" value="{{ old('gross_income_rice') }}" >
          @error('gross_income_rice')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
      </div>
  
 
  
 
  <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a  href="{{route('production_data.production_create')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
    <button  type="submit" class="btn btn-success me-md-2">Next</button></a></p>
            </form>
         
          </div>
        </div>
      </div>
    </div>
  
  
  
  </div>
  @endsection