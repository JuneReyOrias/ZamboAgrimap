<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web"> --}}

	<title>Register Page </title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('../../../assets/vendors/core/core.css')}}">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('../../../assets/fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('../../../assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{asset('./../../assets/css/demo2/style.css')}}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
 
</head>
<body>
  
    <div class="main-wrapper">
		<div class="page-wrapper full-pages">
			<div class="page-contents d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card-register" >
							<div class="row">
                <div class="col-md-4 pe-md-0">
                  <div class="auth-side-wrapper">
                 
                  </div>
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo logo-light d-block mb-2">Web<span>AgriMap</span></a>
                    <h5 class="text-muteds fw-normal mb-4">Create a free account.</h5>
                    <form class="forms-sample " method="post" action="{{ route('register') }}">
                        @csrf
                      <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">FullName</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" id="exampleInputUsername1" name ="name"autocomplete="name" placeholder="Fullname" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div>
                      <div class="mb-3">
                        <label for="userEmail" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="userEmail" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div>
                      <div class="mb-3">
                        <label for="agri_district" class="form-label">Agri District</label>

                        <select class="form-select @error('agri_district') is-invalid @enderror"  name="agri_district"id="validationCustom01" aria-label="Floating label select e">
                          <option selected disabled>Select Agri-District</option>
                          <option value="Ayala Distict" {{ old('agri_district') == 'Ayala Distict' ? 'selected' : '' }}>Ayala Distict</option>
                          <option value="Tumaga District" {{ old('agri_district') == 'Tumaga District' ? 'selected' : '' }}>Tumaga District</option>
                          <option value="Culianan" {{ old('agri_district') == 'Culianan' ? 'selected' : '' }}>Culianan</option>
                          <option value="Manicahan" {{ old('agri_district') == 'Manicahan' ? 'selected' : '' }}>Manicahan</option>
                          <option value="Curuan" {{ old('agri_district') == 'Curuan' ? 'selected' : '' }}>Curuan</option>
                          <option value="Vitali" {{ old('agri_district') == 'Vitali' ? 'selected' : '' }}>Vitali</option>
                        </select>
                        @error('agri_district')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" autocomplete="current-password" placeholder="Password" value="{{ old('password') }}"> 
                        <div class="form-check mb-3">
                          <input type="checkbox" class="form-check-input"id="togglePasswordVisibilityCheckbox">
                          <label class="form-check-label" for="togglePasswordVisibilityCheckbox">Show Password</label>
                        </div>

                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div>
                     
                      <div class="mb-3">
                        <label for="password" class="form-label">confirm Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" autocomplete="current-password" placeholder="Password" value="{{ old('password') }}">
                        {{-- <div class="form-check mb-3">
                          <input type="checkbox" class="form-check-input"id="togglePasswordVisibilityCheckbox">
                          <label class="form-check-label" for="togglePasswordVisibilityCheckbox">Show Password</label>
                        </div> --}}

                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div>
                      <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                    
                        <select class="form-select" name="role"id="validationCustom01" aria-label="Floating label select e">
                          <option selected disabled>Select role</option>
                          <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                          <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>agent</option>
                          <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>user</option>
                        
                        </select>
                    
                    
                      </div>
                    
                      <div>
                        <button type="submit"  class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                            Sign up
                          </button>
                      </div>
                      <a href={{url('/')}} class="d-block mt-3 text-muteds">have already account? Log in</a>
                    </form>
                  </div>
                </div>
              </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
 

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
	<!-- core:js -->
	<script src="{{asset('../../../assets/vendors/core/core.js')}}"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{asset('../../../assets/vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{asset('../../../assets/js/template.js')}}"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
	<!-- End custom js for this page -->

</body>
</html>