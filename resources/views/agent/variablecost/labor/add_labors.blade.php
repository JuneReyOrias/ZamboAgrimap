@extends('agent.agent_Dashboard')
@section('agent') 
<div class="page-content">

    <nav class="page-breadcrumb">
  
    </nav>
    <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80% Complete</div>
  
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
         
          <div class="card-body">
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
            <h5 class="card-title"><span>b.</span>Labor</h5>
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
        
           <form action{{url('AddNewLabor')}} method="post">
              @csrf
              <div class="row mb-3">
               
                <div class="col-md-3">
  
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="no_of_person" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                  <label for="floatingInput" >No of Person:</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name="rate_per_person" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                <label for="floatingInput" >Rate per Person:</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="total_labor_cost" placeholder="Lastname" type="text" aria-label="LastName"id="floatingInput">
              <label for="floatingInput" >Total Labor Cost:</label>
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
  
   
 
              <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
              integrity="sha384-oBqDVmz9ATKxIep9tiCx5/Z9fNEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
              </script>
              <script sr="https://cdn. jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
              integrity="sha384-7VPbUDkoPSGFnVtY10QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
              </script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
               <script>
                function saveForm(e){
                  e.preventDefault();
                  console.log($('#upload-form'));
                  var uploadForm= $('upload-for,')(0);
                  Var uploadFormData= new FormData(uploadForm);
  
                  $.ajax({
                    method="Post",
                    url:"{{url('saveUploadForm')}}",
                    data:uploadFormData,
                    processData:false,
                    contentType:false,
                    success:function(response){
                      console.log(response);
                      $(#form-errors).html('');
                    },
                    error:function(response){
  
                    }
                  })
                }
               </script>
             
         
          </div>
        </div>
      </div>
    
    </div>
  
  </div>@endsection