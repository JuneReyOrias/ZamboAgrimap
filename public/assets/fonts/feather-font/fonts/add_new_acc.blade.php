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
        

         

              <div class="row mb-4">
                
                <div>
                  

                  <h4 class="mb-3 mb-md-0">Welcome Back! Create New Account</h4>
                </div>
                <div class="container">
                  <div class="title">Register</div>
                  <div class="content">
                    <form action{{ url('AccountAdd') }} method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="user-details">
                        <div class="input-box">
                          <span class="details">UserName:</span>
                          <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Enter username" value="{{ old('username') }}" >
                          @error('username')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">FirstName:</span>
                          <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" placeholder="Enter firstname" value="{{ old('firstname') }}" >
                          @error('firstname')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">LastName:</span>
                          <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" placeholder="Enter lastname" value="{{ old('lastname') }}" >
                          @error('lastname')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                            <span class="details">College:</span>
                            <select class="form-select @error('college') is-invalid @enderror" name="college" id="college" aria-label="Floating label select e">
                                <option selected disabled>Select</option>
                                <option value="CLA" {{ old('college') == 'CLA' ? 'selected' : '' }}>CLA(College of Liberal Arts)</option>
                                <option value="CN" {{ old('college') == 'CN' ? 'selected' : '' }}>CN(Collge Of Nursing)</option>
                                <option value="CTE" {{ old('college') == 'CTE' ? 'selected' : '' }}>CTE (College of Teacher Eduaction)</option>
                                <option value="COE" {{ old('college') == 'COE' ? 'selected' : '' }}>COE (Collge Of Engineering)</option>
                                <option value="COA" {{ old('college') == 'COA' ? 'selected' : '' }}>COA (Collge Of Architecture)</option>
                                <option value="CCS" {{ old('college') == 'CCS' ? 'selected' : '' }}>CCS (Collge Of Computing Studies)</option>
                                <option value="CHE" {{ old('college') == 'CHE' ? 'selected' : '' }}>CHE (Collge Of Home Economics)</option>
                                <option value="CAIS" {{ old('college') == 'CAIS' ? 'selected' : '' }}>CAIS (Collge Of Islamic and Asian Studies)</option>
                                <option value="CSM" {{ old('college') == 'CSM' ? 'selected' : '' }}>CSM (Collge Of Science and Mathematics)</option>
                                <option value="CCJE" {{ old('college') == 'CCJE' ? 'selected' : '' }}>CCJE (Collge Of Criminal Justice Education)</option>
                                <option value="CSWCD" {{ old('college') == 'CSWCD' ? 'selected' : '' }}>CSWCD (Collge Of Social Work and Community Development)</option>
                               
                                <option value="CPE" {{ old('college') == 'CPE' ? 'selected' : '' }}>CPE (Collge Of Physical Education)</option>
                                <option value="add_new">Add New</option>
                                <option value="UPRESS" {{ old('college') == 'UPRESS' ? 'selected' : '' }}>UPRESS</option>
                            </select>
                            @error('college')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Additional input box for new college -->
                        <div id="additionalCollegeField" class="input-box" style="display: none;">
                            <span class="details">New College Name:</span>
                            <input type="text" class="form-control" name="new_college_name" id="new_college_name">
                        </div>
                        
                        <!-- Department dropdown -->
                    <div class="input-box" id="departmentDropdown" style="display: none;">
                        <span class="details">Department:</span>
                        <select class="form-select" name="department" id="department">
                        <option selected disabled>Select</option>
                        <!-- Options for departments will be populated dynamically -->
                        </select>
                    </div>
                    
                    <!-- Input box for new department -->
                    <div id="additionalDepartmentField" class="input-box" style="display: none;">
                        <span class="details">New Department Name:</span>
                        <input type="text" class="form-control" name="new_department_name" id="new_department_name">
                    </div>
                        <div class="input-box">
                          <span class="details">Email</span>
                          <input type="text"name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" id="email" autocomplete="current-password" value="{{ old('email') }}" >
                          @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                            <span class="details">Contact no.;</span>
                            <input type="text"name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" placeholder="Enter contact_no" id="contact_no" autocomplete="current-password" value="{{ old('contact_no') }}" >
                            @error('contact_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                              <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>customer</option>
                              <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>staff</option>
                            
                            </select>
                          </div>
                        <div class="input-box">
                          <span class="details">UsersCode</span>
                          <input type="text" name="cust_code" class="form-control @error('cust_code') is-invalid @enderror" placeholder="Enter users code" value="{{ old('cust_code') }}">
                          @error('cust_code')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        {{-- <div class="input-box">
                          <span class="details">Product Image</span>
                          <div class="input-group">
                              <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image" accept=".png, .jpeg, .jpg">
                              <label class="custom-file-label" for="inputGroupFile01" style="color: white;">Choose file</label>
                          </div>
                          @error('unit_price')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                       --}}
                      </div>
                 
                      <div class="button d-flex justify-content-end"> <!-- Use d-flex and justify-content-end to align the button to the end -->
                        <input type="submit" class="register-button" value="Add">
                    </div>
                    
                      <a href="{{ route('admin.accounts.view_users_acc') }}" class="btn btn-success ">Back</a>
                    </form>
                  </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  
   
  
  
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  {{-- <script>
   $(document).ready(function() {
    var departments = {
        'CLA': ['Bs Accountancy ','BS Econaomics','BS Psychology','Barsilyer ng Sining Sa Filipino' 'AB Broadcasting ', 'BAELS','AB Journalism', 'AB Political Science','BA History'],
        'CN': ['Nursing'],
        'CTE': ['BSED', 'BEED',],
        'CHE': ['HE'],
        'COE': ['Civil Eng', 'Mechanical Eng', 'Electrical E','Environmental Eng','Geodetic Eng','Industrial Eng','Sanitary Eng','Computer Eng','Agriculture Eng'],
        'COA':['Architecture']
        'CAIS':['Asian Studies','Islamic Studies'],
        'CSM':['BS Chemistry','BS Biology','BS Math','BS Statistics', 'BS Physics'],
        'CCJE':['BSCRIM'],
        'CAIS':['Asian Studies','Islamic Studies'],
        'UPRESS': ['Admin', 'Staff'],
    };

    $('#college').change(function() {
        var selectedCollege = $(this).val();
        var selectedDepartment = departments[selectedCollege];

        $('#department').empty().append('<option selected disabled>Select</option>');
        $.each(selectedDepartment, function(key, value) {
            $('#department').append($("<option></option>")
                .attr("value", value).text(value));
        });

        $('#departmentDropdown').show();
    });

    // Show additional college field if "Add New" is selected
    $('#college').change(function() {
        var selectedCollege = $(this).val();
        if (selectedCollege === 'add_new') {
            $('#additionalCollegeField').show();
            $('#departmentDropdown').hide();
        } else {
            $('#additionalCollegeField').hide();
        }
    });
});

</script> --}}
<script>
  $(document).ready(function() {
   var departments = {
       'CLA': ['Bs Accountancy ','BS Econaomics','BS Psychology','Barsilyer ng Sining Sa Filipino','AB Broadcasting','BAELS','AB Journalism','AB Political Science','BA History'],
       'CN': ['Nursing'],
       'CTE': ['BSED', 'BEED','Bachelor of Early Childhood Educ','Bachelor Of Special Needs Educ','Special Tertiary Education Program'],
       'CHE': ['HE'],
       'COE': ['Civil Eng', 'Mechanical Eng', 'Electrical E','Environmental Eng','Geodetic Eng','Industrial Eng','Sanitary Eng','Computer Eng','Agriculture Eng'],
       'COA':['Architecture'],
        'CAIS':['Asian Studies','Islamic Studies'],
        'CSM':['BS Chemistry','BS Biology','BS Math','BS Statistics', 'BS Physics'],
        'CCJE':['BSCRIM'],
        'CSWCD':['BS Social Work','BS Community Development'],
        'CCS':['BS Computer Science','BS Information Technology'],
        'UPRESS': ['Admin', 'Staff'],
   
      };

   $('#college').change(function() {
       var selectedCollege = $(this).val();
       var selectedDepartment = departments[selectedCollege];

       $('#department').empty().append('<option selected disabled>Select</option>');
       $.each(selectedDepartment, function(key, value) {
           $('#department').append($("<option></option>")
               .attr("value", value).text(value));
       });

       $('#departmentDropdown').show();
   });

   // Show additional college field if "Add New" is selected
   $('#college').change(function() {
       var selectedCollege = $(this).val();
       if (selectedCollege === 'add_new') {
           $('#additionalCollegeField').show();
           $('#departmentDropdown').hide();
       } else {
           $('#additionalCollegeField').hide();
       }
   });
});

</script>
@endsection
