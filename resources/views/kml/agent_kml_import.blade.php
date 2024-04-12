@extends('agent.agent_Dashboard')
@section('agent') 


<div class="page-content">

    <nav class="page-breadcrumb">
  
    </nav>
    @if (session()->has('message'))
    <div class="alert alert-success" id="success-alert">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>


        {{session()->get('message')}}
      </div>
      @endif
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
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
         
          <div class="card-body">
            
            
            
          {{-- {{-- </div>
        </div>
      </div>
    </div> --}}
  
    <!--end for Production Cost-->
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
              {{-- @if (session('message'))
              <div class="alert alert-success" role="alert">
                {{ session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                 
              @endif
             
              @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif --}}
  
               <div class="card-header">Upload KML File</div>
  
               <div class="card-body">
                <form action{{url('uploadkml') }} method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="file" name="kmlFile">
                  <button type="submit">Upload</button>
              </form>
            </div>
            
              </div>
              <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
              integrity="sha384-oBqDVmz9ATKxIep9tiCx5/Z9fNEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
              </script>
              <script sr="https://cdn. jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
              integrity="sha384-7VPbUDkoPSGFnVtY10QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
              </script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
               {{-- <script>
                function saveForm(e){
                  e.preventDefault();
                  console.log($('#upload-form'));
                  var uploadForm= $('upload-form,')(0);
                  Var uploadFormData= new FormData(uploadForm);
  
                  $.ajax({
                    method="POST",
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
              --}}
         
          </div>
        </div>
      </div>
    
    </div>
  
  </div>
  <script ></script>
  @endsection