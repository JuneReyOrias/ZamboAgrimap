@extends('admin.dashb')
@section('admin')
<div class="page-content">

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
 
    @if (session('message'))
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
@endif
        

         
              @csrf
              <div class="row mb-4">
                <div>
                  <h4 class="mb-3 mb-md-0">Welcome Back! Creacte New Account</h4>
                </div>
                <div class="container">
                  <div class="title">Registration</div>
                  <div class="content">
                    <form method="post" action{{url('updateAccounts') }}>
                      @csrf
                      <div class="user-details">
                        <div class="input-box">
                          <span class="details">Full Name</span>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter your fullname"value="{{ old('name') }}" >
                          @error('name')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">email</span>
                          <input type="text"name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your username" >
                          @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Agri-District</span>
                          <select class="form-control @error('agri_district') is-invalid @enderror"  name="agri_district"id="validationCustom01" aria-label="Floating label select e">
                            <option selected disabled>Select Agri-District</option>
                            <option value="Ayala Distict" {{ old('agri_district') == 'Ayala Distict' ? 'selected' : '' }}>Ayala Distict</option>
                            <option value="Tumaga District" {{ old('agri_district') == 'Tumaga District' ? 'selected' : '' }}>Tumaga District</option>
                            <option value="Culianan District " {{ old('agri_district') == 'Culianan District' ? 'selected' : '' }}>Culianan District</option>
                            <option value="Manicahan District" {{ old('agri_district') == 'Manicahan District' ? 'selected' : '' }}>Manicahan District</option>
                            <option value="Curuan District" {{ old('agri_district') == 'Curuan District' ? 'selected' : '' }}>Curuan District</option>
                            <option value="Vitali District" {{ old('agri_district') == 'Vitali District' ? 'selected' : '' }}>Vitali District</option>
                          </select>
                        </div>
                        <div class="input-box">
                          <span class="details">Password</span>
                          <input type="text"name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password"id="password" autocomplete="current-password" value="{{ old('password') }}" >
                          @error('password')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>

                        <div class="input-box">
                          <span class="details">Confirm Password</span>
                          <input type="text"  class="form-control @error('password') is-invalid @enderror"id="password" autocomplete="current-password" placeholder="Password" value="{{ old('password') }}" >
                          @error('password')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Role</span>
                          <select class="form-select" name="role"id="validationCustom01" aria-label="Floating label select e">
                            <option selected disabled>Select role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                            <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>agent</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>user</option>
                          
                          </select>
                        </div>
                      </div>
                 
                      <div class="button">
                        <input type="submit" value="Register">
                      </div>
                      <a  href="{{route('admin.create_account.display_users')}}"button  class="btn btn-success ">Back</button></a></p>
                    </form>
                  </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  
   
  
  
  </div>
  <script>
    // Get references to the input fields
    const no_of_ha = document.getElementById('no_of_ha');
    const cost_per_ha = document.getElementById('cost_per_ha');
    const total_amount = document.getElementById('total_amount');
   
    
    // Function to calculate and display the total cost
    function calculateTotalCost() {
        const nooFhas = parseFloat(no_of_ha.value) || 0;
        const costPerHAS= parseFloat(cost_per_ha.value) || 0;
      
       
    
        const totalCost = nooFhas * costPerHAS
    
        // Display the total cost in the total cost input field
        totalCostInput.value = totalCost.toFixed(2); // You can adjust the number of decimal places as needed
    }
    
    // Calculate the total cost whenever any of the input fields change
    no_of_ha.addEventListener('input', calculateTotalCost);
    cost_per_ha.addEventListener('input', calculateTotalCost);
  
   
    
    // Initial calculation when the page loads
    calculateTotalCost();
    </script>
  @endsection