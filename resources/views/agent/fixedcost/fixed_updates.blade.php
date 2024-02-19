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
        
            <h6 class="card-title"><span>III.</span>Fixed Cost Update</h6>
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
         

           <form  action{{url('AddFcost')}} method="post"  >
              @csrf

              <div class="row mb-3">    
                <div class="col-md-3">
   
                    <div class="form-floating mb-4 mb-md-0">
                    <input id="personal_informations_id" class="form-control mb-4 mb-md-0" name="personal_informations_id" value="{{$fixedcosts->personal_informations_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput"readonly>
                    <label for="personal_informations_id" >Personal Information ID:</label>
                  </div>
                
                </div>
                <div class="col-md-3">
   
                    <div class="form-floating mb-4 mb-md-0">
                    <input id="lastname" class="form-control mb-4 mb-md-0" name="farm_profiles_id" value="{{$fixedcosts->farm_profiles_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput">
                    <label for="farm_profiles_id" >Farm Profiles ID:</label>
                  </div>
                
                </div>
                </div>
    
               

              <div class="row mb-3">
                     
                <div class="col-md-3">
  
                  <div class="form-floating mb-4 mb-md-0">
                  <input id="lastname" class="form-control mb-4 mb-md-0" name="particular"value="{{$fixedcosts->particular}}" placeholder="Lastname" type="text" aria-label="Lastname"id="particular">
                  <label for="floatingInput" >Particulars:</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input id="lastname" class="form-control mb-4 mb-md-0" name="no_of_ha" value="{{$fixedcosts->no_of_ha}}" placeholder="Lastname" type="text" aria-label="ExtensionName"id="noofha">
                <label for="floatingInput" >No. of Has:</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="cost_per_ha" value="{{$fixedcosts->cost_per_ha}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="costperhas">
              <label for="floatingInput" >Cost/Has(has):</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="total_amount" value="{{$fixedcosts->total_amount}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="totalamount">
            <label for="floatingInput" >Total Amount(P):</label>
          </div>
        </div>
     </div>
    
  
  <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a  href="{{route('agent.fixedcost.fcost_view')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
    <button  type="submit" class="btn btn-success me-md-2">Next</button></a></p>
            </form>
         
          </div>
        </div>
      </div>
    </div>
  
   
  
  
  </div>
  @endsection