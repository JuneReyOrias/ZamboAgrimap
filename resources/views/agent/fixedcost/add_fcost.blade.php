@extends('agent.agent_Dashboard')
@section('agent') 

<div class="page-content">

    <nav class="page-breadcrumb">
      <ol class="breadcrumb">
        
      </ol>
    </nav>
    <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45% Complete</div>
  
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
        
            <h6 class="card-title"><span>III.</span>Fixed Cost</h6>
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
         

           <form  action{{url('AddFcost')}} method="post"  >
              @csrf

              <div class="row mb-3">
                
                <div class="col-md-3">

                  @php
                  $id = Auth::id();

              // Find the user by their ID and eager load the personalInformation relationship
              $profile= App\Models\PersonalInformations::find($id)->all();

                @endphp
                  <div class="form-floating mb-4 mb-md-0"> 
                     <select class="form-control mb-4 mb-md-0" name="personal_informations_id" aria-label="personal_informations_id">
                          @foreach ($profile->sortByDesc('id') as $location)
                              <option value="{{ $location->id }}">{{ $location->first_name.' '. $location->last_name}}</option>
                          @endforeach
                      </select>
                      <label for="personal_informations_id">Farmers Name</label>
                  </div>
                
              
          </div>
              <div class="col-md-3">
  
             @php
                    $id = Auth::id();

                // Find the user by their ID and eager load the personalInformation relationship
                $farmprofile= App\Models\FarmProfile::find($id)->all();

                  @endphp
                <div class="form-floating mb-4 mb-md-0"> 
                   <select class="form-control mb-4 mb-md-0" name="farm_profiles_id" aria-label="farm_profiles_id">
                    @foreach ( $farmprofile->sortByDesc('id') as  $farmprofile)
                            <option value="{{ $farmprofile->id }}">{{ $farmprofile->tenurial_status }}</option>
                        @endforeach
                    </select>
                    <label for="farm_profiles_id">FarmProfile:</label>
                </div>
              
            
        </div>
    
        {{-- <div class="col-md-3">
          @php
          $id = Auth::id();

      // Find the user by their ID and eager load the personalInformation relationship
      $polygons= App\Models\Polygon::find($id)->all();

        @endphp
                  
          <div class="form-floating mb-4 mb-md-0"> 
             <select class="form-control mb-4 mb-md-0" name="polygons_id" aria-label="User ID">
                  @foreach ( $polygons as  $polygons)
                      <option value="{{  $polygons->id }}">{{  $polygons->id}}</option>
                  @endforeach
              </select>
              <label for="polygons_id">Polygon:</label>
          </div>
         --}}
      {{-- </div>  --}}
          {{-- <div class="col-md-3">
  
                  
          <div class="form-floating mb-4 mb-md-0"> 
             <select class="form-control mb-4 mb-md-0" name="agri_districts_id"aria-label="agri_districts_id">
                  @foreach ( $agriDistrictIds as  $agriDistrictIds)
                      <option value="{{  $agriDistrictIds }}">{{$agriDistrictIds
  
                       }}</option>
                         
                  @endforeach
              </select>
              <label for="agri_districts_id">Agri-District:</label>
          </div>
        
      
  </div> --}}
                </div>

              <div class="row mb-3">
                     
                <div class="col-md-3">
  
                  <div class="form-floating mb-4 mb-md-0">
                  <input id="lastname" class="form-control mb-4 mb-md-0" name="particular" placeholder="Lastname" type="text" aria-label="Lastname"id="particular">
                  <label for="floatingInput" >Particulars:</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input id="lastname" class="form-control mb-4 mb-md-0" name="no_of_ha" placeholder="Lastname" type="text" aria-label="ExtensionName"id="noofha">
                <label for="floatingInput" >No. of Has:</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="cost_per_ha" placeholder="Lastname" type="text" aria-label="MiddlName"id="costperhas">
              <label for="floatingInput" >Cost/Has(has):</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="total_amount" placeholder="Lastname" type="text" aria-label="MiddlName"id="totalamount">
            <label for="floatingInput" >Total Amount(P):</label>
          </div>
        </div>
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