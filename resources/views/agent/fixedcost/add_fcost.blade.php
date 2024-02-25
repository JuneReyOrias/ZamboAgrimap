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
            $farmprofile= App\Models\FarmProfile::where('id', $id)->latest()->first();

              @endphp
                  <label class="form-expand" for="farm_profiles_id">FarmProfile:</label>
                  <select class="form-control mb-4 mb-md-0" name="farm_profiles_id" aria-label="farm_profiles_id">
                 
                            <option value="{{ $farmprofile->id }}">{{ $farmprofile->tenurial_status }}</option>
                      
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="particular">Particular (Fixed Cost):</label>
                  <input type="text" class="form-control placeholder-text " name="particular" id="validationCustom01" placeholder=" enter Particular fixed Cost" value="{{ old('particular') }}" >
                </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="no_of_ha">No. of Has:</label>
                    <input type="text" class="form-control placeholder-text @error('no_of_ha') is-invalid @enderror" name="no_of_ha" id="validationCustom01" placeholder="Enter No. of Has" value="{{ old('no_of_ha') }}" >
                    @error('no_of_ha')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="cost_per_ha">Cost/Has(Has):</label>
                  <input type="text" class="form-control placeholder-text @error('cost_per_ha') is-invalid @enderror" name="cost_per_ha" id="validationCustom01" placeholder="Enter Cost/Has" value="{{ old('cost_per_ha') }}" >
                  @error('cost_per_ha')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
               
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="total_amount">Total Amount:</label>
                  <input type="text" class="form-control placeholder-text @error('total_amount') is-invalid @enderror" name="total_amount" id="validationCustom01" placeholder="Enter No. of Years" value="{{ old('total_amount') }}" >
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
  @endsection