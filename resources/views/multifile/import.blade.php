@extends('admin.dashb')
@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content">

  <nav class="page-breadcrumb">

  </nav>

  <div class="row">
    <div class="col-md-12 grid-margin">
     <div class="card border rounded">
        
        <div class="card-body">
          
          
          
        {{-- {{-- </div>
      </div>
    </div>
  </div> --}}

  <!--end for Production Cost-->
  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
     <div class="card border rounded">
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status')}}
          </div>
           
          @endif
            <h6 class="card-title">Multiple Import File</h6><br><br>
            <p class="text-muted mb-3">Import excel file, csv file or Msacces file only.</p>
            <div class="form-errors"></div>
            <form id="upload-form" method="post" enctype="multipart/form-data" onsubmit="saveForm(event)">
              @csrf
              <input type="file" name="upload_file"><br>
              <div class="form-group mb-2 text-end">
                <button type="submit" class="btn btn-success me-2">Upload</button>
              </div>
          </form>
           
                {{-- <div class="form-group mb-3">
                  <label for=inputemail>Upload</label>
                  <input type="file" class ="form-control" name="upload_file" aria-describedby="emailHelp">
                  <span class="text-danger input_image_err formErrors"></span>
              </div>
            <div class="form-group mb-2 text-center">
              <button type="submit" class="btn btn-primary me-2">Submit</button>
            </div>
             
            </form> --}}
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
           
       
        </div>
      </div>
    </div>
  
  </div>

</div>@endsection