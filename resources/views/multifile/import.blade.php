@extends('admin.dashb')
@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')

      <div class="page-content">



        <div class="row">
          <div class="col-md-12 grid-margin">
          <div class="card border rounded">
              
              <div class="card-body">
                
                
                
        <div class="row">
          <div class="col-md-6 grid-margin stretch-card">
          <div class="card border rounded">
              <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status')}}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error')}}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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