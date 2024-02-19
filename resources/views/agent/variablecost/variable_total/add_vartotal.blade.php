
@extends('agent.agent_Dashboard')
@section('agent') 

<div class="page-content">

    <nav class="page-breadcrumb">
  
    </nav>
    <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100% Complete</div>
  
    </div>
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
            <h6 class="card-title"><span>VI.</span>Variable Cost</h6>
            <h5 class="card-title"><span>F.</span>Variable Cost Total</h5>
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
          
            <form action{{url('AddNewVartotal')}} method="post">
              @csrf

              <div class="row mb-3">
                
                <div class="col-md-3">

                  @php
                  $id = Auth::id();

              // Find the user by their ID and eager load the personalInformation relationship
              $profile= App\Models\PersonalInformations::find($id)->latest()->first();

                @endphp
                  <div class="form-floating mb-4 mb-md-0"> 
                     <select class="form-control mb-4 mb-md-0" name="personal_informations_id" aria-label="personal_informations_id">
                          {{-- @foreach ($profile->sortByDesc('id') as $location)  --}}
                              <option value="{{ $profile->id }}">{{ $profile->first_name.' '. $profile->last_name}}</option>
                          {{-- @endforeach --}}
                      </select>
                      <label for="personal_informations_id">Farmers Name</label>
                  </div>
                
              
          </div>
              <div class="col-md-3">
  
             @php
                    $id = Auth::id();

                // Find the user by their ID and eager load the personalInformation relationship
                $farmprofile= App\Models\FarmProfile::find($id)->latest()->first();

                  @endphp
                <div class="form-floating mb-4 mb-md-0"> 
                   <select class="form-control mb-4 mb-md-0" name="farm_profiles_id" aria-label="farm_profiles_id">
                    {{-- @foreach ( $farmprofile->sortByDesc('id') as  $farmprofile) --}}
                            <option value="{{ $farmprofile->id }}">{{ $farmprofile->tenurial_status }}</option>
                        {{-- @endforeach --}}
                    </select>
                    <label for="farm_profiles_id">FarmProfile:</label>
                </div>
              
            
        </div>
    
        <div class="col-md-3">
  
          @php
                 $id = Auth::id();

             // Find the user by their ID and eager load the personalInformation relationship
             $seed= App\Models\Seed::find($id)->latest()->first();

               @endphp
             <div class="form-floating mb-4 mb-md-0"> 
                <select class="form-control mb-4 mb-md-0" name="seeds_id" aria-label="seeds_id">
                 {{-- @foreach ( $seed->sortByDesc('id') as  $seed) --}}
                         <option value="{{ $seed->id }}">{{ $seed->total_seed_cost }}</option>
                     {{-- @endforeach --}}
                 </select>
                 <label for="seeds_id">Total Seed Cost:</label>
             </div>
           
         
     </div>
     <div class="col-md-3">
  
      @php
             $id = Auth::id();

         // Find the user by their ID and eager load the personalInformation relationship
         $labor= App\Models\Labor::find($id)->latest()->first();

           @endphp
         <div class="form-floating mb-4 mb-md-0"> 
            <select class="form-control mb-4 mb-md-0" name="labors_id" aria-label="labors_id">
             {{-- @foreach ( $labor as  $labor) --}}
                     <option value="{{ $labor->id }}">{{ $labor->total_labor_cost}}</option>
                 {{-- @endforeach --}}
             </select>
             <label for="labors_id">Total Labor Cost:</label>
         </div>
       
     
 </div>
                </div>



                {{-- new row  --}}
                <div class="row mb-3">
                
                  <div class="col-md-3">
  
                    @php
                    $id = Auth::id();
  
                // Find the user by their ID and eager load the personalInformation relationship
                $fertilize= App\Models\Fertilizer::find($id)->latest()->first();
  
                  @endphp
                    <div class="form-floating mb-4 mb-md-0"> 
                       <select class="form-control mb-4 mb-md-0" name="fertilizers_id" aria-label="fertilizers_id">
                            {{-- @foreach ($profile->sortByDesc('id') as $location) --}}
                                <option value="{{ $fertilize->id }}">{{ $fertilize->total_cost_fertilizers	}}</option>
                            {{-- @endforeach --}}
                        </select>
                        <label for="fertilizers_id">Total Cost Fertilizer</label>
                    </div>
                  
                
            </div>
                <div class="col-md-3">
    
               @php
                      $id = Auth::id();
  
                  // Find the user by their ID and eager load the personalInformation relationship
                  $pesticide= App\Models\Pesticide::find($id)->latest()->first();
  
                    @endphp
                  <div class="form-floating mb-4 mb-md-0"> 
                     <select class="form-control mb-4 mb-md-0" name="pesticides_id" aria-label="pesticides_id">
                      {{-- @foreach ( $farmprofile->sortByDesc('id') as  $farmprofile) --}}
                              <option value="{{ $pesticide->id }}">{{ $pesticide->total_cost_pesticides }}</option>
                          {{-- @endforeach --}}
                      </select>
                      <label for="pesticides_id">Total Cost Pesticides:</label>
                  </div>
                
              
          </div>
      
          <div class="col-md-3">
            @php
                $id = Auth::id();
                // Find the user by their ID and eager load the personalInformation relationship
                $transport = App\Models\Transport::find($id)->latest()->first();
            @endphp
            <div class="form-floating mb-4 mb-md-0"> 
                <select class="form-control mb-4 mb-md-0" name="transports_id" aria-label="pesticides_id">
                    @if ($transport)
                        <option value="{{ $transport->id }}">{{ $transport->total_transport_per_deliverycost }}</option>
                    @else
                        <option value="">No Transport Record Found</option>
                    @endif
                </select>
                <label for="transports_id">Total Cost Pesticides:</label>
            </div>
        </div>
     
                  <div class="col-md-3">
              
                    <div class="form-floating mb-4 mb-md-0">
                    <input  class="form-control mb-4 mb-md-0" name="total_machinery_fuel_cost" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                    <label for="floatingInput" >Total Machinery Fuel Cost:</label>
                  </div>
                  </div>





              <div class="row mb-3">
              
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name="total_variable_cost" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                <label for="floatingInput" ><Table></Table>Total Variable cost:</label>
              </div>
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
  
  </div>@endsection