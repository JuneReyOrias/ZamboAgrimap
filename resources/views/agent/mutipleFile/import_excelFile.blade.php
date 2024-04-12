@extends('agent.agent_Dashboard')

@section('agent')


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
              <h6 class="card-title">Multiple Import File</h6>
              <p class="text-muted mb-3">Import excel file, csv file or Msacces file only.</p>
              <div class="form-errors"></div>
              <form id="upload-form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="upload_file">Upload</label>
                    <input type="file" class="form-control" id="upload_file" name="upload_file" aria-describedby="uploadHelp">
                    <span class="text-danger input_image_err formErrors"></span>
                </div>
                <div class="form-group mb-2 text-center">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </div>
            </form>
            @endsection
            @push('scripts')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#upload-form').submit(function(e) {
                        e.preventDefault(); // Prevent the default form submission
                        saveForm(); // Call the saveForm function
                    });
                });
            
                function saveForm() {
                    var formData = new FormData($('#upload-form')[1]); // Get form data
                    $.ajax({
                        type: "POST",
                        url: "{{ url('saveUploadForm') }}", // Adjust the route name to match your route
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                            $('.form-errors').html('');
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            </script>
            @endpush
            