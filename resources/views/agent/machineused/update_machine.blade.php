@extends('agent.agent_Dashboard')
@section('agent') 

<div class="page-content">

    <nav class="page-breadcrumb">
      <ol class="breadcrumb">
        
      </ol>
    </nav>
    <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60% Complete</div>
  
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



            <h6 class="card-title"><span>IV.</span>machineries Used</h6>
  
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
         
           
           
           <form  action{{url('UpdateMachines')}} method="post"  >
              @csrf

              <div class="row mb-3">    
                <div class="col-md-3">
   
                    <div class="form-floating mb-4 mb-md-0">
                    <input id="personal_informations_id" class="form-control mb-4 mb-md-0" name="personal_informations_id" value="{{$machineries->personal_informations_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput"readonly>
                    <label for="personal_informations_id" >Personal Information ID:</label>
                  </div>
                
                </div>
                <div class="col-md-3">
   
                    <div class="form-floating mb-4 mb-md-0">
                    <input id="lastname" class="form-control mb-4 mb-md-0" name="farm_profiles_id" value="{{$machineries->farm_profiles_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput">
                    <label for="farm_profiles_id" >Farm Profiles ID:</label>
                  </div>
                
                </div>
                </div>
    

              <div class="row mb-3">
               
                <div class="col-md-3">
  
                  <div class="form-floating mb-4 mb-md-0">
                  <input id="lastname" class="form-control mb-4 mb-md-0" name="plowing_machineries_used"value="{{$machineries->plowing_machineries_used}}" placeholder="Lastname" type="text" aria-label="Lastname"id="floatingInput">
                  <label for="floatingInput" >Plowing Machineries used:</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input id="lastname" class="form-control mb-4 mb-md-0" name="plo_ownership_status"value= "{{$machineries->plo_ownership_status}}" placeholder="Lastname" type="text" aria-label="ExtensionName"id="floatingInput">
                <label for="floatingInput" >Ownership Status:</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="no_of_plowing"value= "{{$machineries->no_of_plowing}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
              <label for="floatingInput" >No. of Plowing:</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="plowing_cost"value= "{{$machineries->plowing_cost}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
            <label for="floatingInput" >Plowing Cost:</label>
          </div>
        </div>
                </div>
    
              <div class="row mb-3">
                <div class="col-md-3">
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="harrowing_machineries_used"value= "{{$machineries->harrowing_machineries_used}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
                  <label for="floatingInput" >Harrowing Machineries Used:</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="harro_ownership_status"value= "{{$machineries->harro_ownership_status}}"  placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
                  <label for="floatingInput" > Ownership Status:</label>
                
              </div>
            </div>
                  <div class="col-md-3">
                    <div class="form-floating mb-4 mb-md-0">
                    <input  class="form-control mb-4 mb-md-0" name="no_of_harrowing"value= "{{$machineries->no_of_harrowing}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
                    <label for="floatingInput" >No. of Harrowing:</label>
                  </div>
                </div>
             
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="harrowing_cost"value= "{{$machineries->harrowing_cost}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
                  <label for="floatingInput" > Harrowing Cost:</label>
              </div>
            </div>
          </div>
  
          <div class="row mb-3">
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="harvesting_machineries_used"value= "{{$machineries->harvesting_machineries_used}}"  placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
              <label for="floatingInput" >Harvesting Machineries Used:</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="harvest_ownership_status"value= "{{$machineries->harvest_ownership_status}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
            <label for="floatingInput" > Ownership Status:</label>
          </div>
        </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="harvesting_cost"value= "{{$machineries->harvesting_cost}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
              <label for="floatingInput" >Harvesting Cost:</label>
          </div>
        </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="postharvest_machineries_used"value= "{{$machineries->postharvest_machineries_used}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
            <label for="floatingInput" >Post Machineries Used:</label>
          </div>
        </div>
      </div>
              <div class="row mb-3">
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="postharv_ownership_status" value= "{{$machineries->postharv_ownership_status}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
              <label for="floatingInput" >Machine Ownership Status:</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="post_harvest_cost" value= "{{$machineries->post_harvest_cost}}"placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
            <label for="floatingInput" >PostHarvest Cost:</label>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
          <input  class="form-control mb-4 mb-md-0" name="total_cost_for_machineries"value= "{{$machineries->total_cost_for_machineries}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
          <label for="floatingInput" >Total Cost for Machineries:</label>
        </div>
      </div>
         
  </div>
  <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a  href="{{route('agent.machineused.show_maused')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
    <button  type="submit" class="btn btn-success me-md-2">Next</button></a></p>
            </form>
         
          </div>
        </div>
      </div>
    </div>
  
   
   
  </div>
  @endsection