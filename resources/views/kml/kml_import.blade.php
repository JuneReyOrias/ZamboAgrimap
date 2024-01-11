@extends('admin.dashb')
@section('admin')


<div class="page-content">

  <nav class="page-breadcrumb">

  </nav>

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
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status')}}
          </div>
           
          @endif
             <div class="card-header">Upload KML File</div>

            <div class="card-body">
              <form action="/kml/import" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".kml,.kmz" required>
                <button type="submit">Upload</button>
              </form>
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

</div>@endsection