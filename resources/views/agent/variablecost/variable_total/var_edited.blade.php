
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
          
            <form action{{url('updatevaria')}} method="post">
              @csrf

              <div class="row mb-3">
                
                <div class="col-md-3">
   
                    <div class="form-floating mb-4 mb-md-0">
                    <input id="personal_informations_id" class="form-control mb-4 mb-md-0" name="personal_informations_id" value="{{$variable->personal_informations_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput"readonly>
                    <label for="personal_informations_id" >Personal Information ID:</label>
                  </div>
                
                </div>
                <div class="col-md-3">
   
                    <div class="form-floating mb-4 mb-md-0">
                    <input id="lastname" class="form-control mb-4 mb-md-0" name="farm_profiles_id" value="{{$variable->farm_profiles_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput">
                    <label for="farm_profiles_id" >Farm Profiles ID:</label>
                  </div>
                
                </div>
    
                <div class="col-md-3">
   
                    <div class="form-floating mb-4 mb-md-0">
                    <input id="personal_informations_id" class="form-control mb-4 mb-md-0" name="seeds_id" value="{{$variable->seeds_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput"readonly>
                    <label for="seeds_id" >Seeds ID:</label>
                  </div>
                
                </div>
                <div class="col-md-3">
   
                    <div class="form-floating mb-4 mb-md-0">
                    <input id="lastname" class="form-control mb-4 mb-md-0" name="labors_id" value="{{$variable->labors_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput">
                    <label for="labors_id" >Labors ID:</label>
                  </div>
                
                </div>
                </div>



                {{-- new row  --}}
                <div class="row mb-3">
                
                    <div class="col-md-3">
   
                        <div class="form-floating mb-4 mb-md-0">
                        <input id="fertilizers_id" class="form-control mb-4 mb-md-0" name="fertilizers_id" value="{{$variable->fertilizers_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput"readonly>
                        <label for="fertilizers_id" >Fertilizers ID:</label>
                      </div>
                    
                    </div>
                    <div class="col-md-3">
       
                        <div class="form-floating mb-4 mb-md-0">
                        <input id="lastname" class="form-control mb-4 mb-md-0" name="pesticides_id" value="{{$variable->pesticides_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput">
                        <label for="pesticides_id" >Pesticides ID:</label>
                      </div>
                    
                    </div>
                    <div class="col-md-3">
       
                        <div class="form-floating mb-4 mb-md-0">
                        <input id="lastname" class="form-control mb-4 mb-md-0" name="transports_id" value="{{$variable->transports_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput">
                        <label for="transports_id" >Tranports Profiles ID:</label>
                      </div>
                    
                    </div>
     
                  <div class="col-md-3">
              
                    <div class="form-floating mb-4 mb-md-0">
                    <input  class="form-control mb-4 mb-md-0" name="total_machinery_fuel_cost"value="{{$variable->total_machinery_fuel_cost}}" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                    <label for="floatingInput" >Total Machinery Fuel Cost:</label>
                  </div>
                  </div>





              <div class="row mb-3">
              
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name="total_variable_cost"value="{{$variable->total_variable_cost}}" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
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