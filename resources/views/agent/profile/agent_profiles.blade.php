@extends('agent.agent_Dashboard')
@section('agent') 

<section style="background-color: #eee;">
  <div class="container-profile py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0" style="margin-top: 2rem;">
            <li class="breadcrumb-item active" aria-current="page"></li>
          </ol>
          <h6 class="agent-profile text-center" style="font-size: 20px;">
            Profile
          </h6>
        </nav>
      </div>
    </div>
    @if (session()->has('message'))
    <div class="alert alert-success" id="success-alert">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      {{ session()->get('message') }}
    </div>
    @endif
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            @if ($agent->image)
              <img src="/agentimages/{{$agent->image}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 140px;">
            @else
              <img src="/upload/profile.jpg" alt="default avatar" class="rounded-circle img-fluid" style="width: 150px; height: 140px;">
            @endif
            <h5 class="my-3">{{ $agent->first_name.' '.$agent->last_name}}</h5>
            <p class="my-3">{{$agent->email}}</p>
           
            {{-- <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary">Follow</button>
              <button type="button" class="btn btn-outline-primary ms-1">Message</button>
            </div> --}}
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <form action="{{ url('update') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row mb-3">
                <div class="col-sm-3">
                  <label class="mb-0">Full Name</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="name" autocomplete="off" value="{{$agent->first_name.' '.$agent->last_name}}">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <input type="email" class="form-control" name="email" id="exampleInputEmail1" value="{{$agent->email}}">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Agri-District</p>
                </div>
                <div class="col-sm-9">
                  <input type="text" class="form-control"name="agri_district" id="agri_district" autocomplete="off" value="{{$agent->agri_district}}">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Role</p>
                </div>
                <div class="col-sm-9">
                  <input type="text" class="form-control"name="role" id="role" autocomplete="off" value="{{$agent->role}}">
                </div>
              </div>
              <hr>
  
              <div class="row mb-3">
                <div class="col-sm-3">
                  <label class="mb-0" for="image">Image</label>
                </div>
                <div class="col-sm-9">
                  <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
                </div>
              </div>
              <hr>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <label class="mb-0">Image</label>
                </div>
                <div class="col-sm-9">
                  <img class="rounded-circle" name="image" id="showImage" src="/agentimages/{{$agent->image}}" alt="profile">
                </div>
              </div>
              <hr>
              <button type="submit" class="btn btn-primary me-2">Save Changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  document.getElementById("togglePasswordVisibilityCheckbox").addEventListener("change", function () {
      var passwordInput = document.getElementById("password");

      if (this.checked) {
          passwordInput.type = "text";
      } else {
          passwordInput.type = "password";
      }
  });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#inputGroupFile01').change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files[0]);
    });
  });
</script>
@endsection
