@extends('agent.agent_Dashboard')
@section('agent') 

<div class="page-content">

    <nav class="page-breadcrumb">
  
    </nav>
    <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">90% Complete</div>
  
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
            <h5 class="card-title"><span>d.</span>Pesticides</h5>
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
        
           <form action{{url('AddNewPesticide')}} method="post">
              @csrf
              <div class="row mb-3">
               
                <div class="col-md-3">
  
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="pesticides_name" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                  <label for="floatingInput" >Pesticides Name:</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name="type_ofpesticides" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                <label for="floatingInput" >Type of Pesticides:</label>
              </div>
            </div>
             <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="no_of_l_kg" placeholder="Lastname" type="text" aria-label="LastName"id="floatingInput">
              <label for="floatingInput" >Number of L/kg:</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0"  name="unitprice_ofpesticides"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
            <label for="floatingInput" >Unit Price of Pesticides:</label>
          </div>
        </div>
                </div>
    
              <div class="row mb-3">
                <div class="col-md-3">
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name= "total_cost_pesticides"placeholder="Home Address" type="text" aria-label="HomeAddress"id="floatingInput">
                  <label for="floatingInput" >Total Cost Pesticides:</label>
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
      </div>
    
    </div>
  
  </div>@endsection