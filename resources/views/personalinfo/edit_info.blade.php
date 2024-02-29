@extends('admin.dashb')
@section('admin')
{{-- @extends('agent.agent_Dashboard')
@section('agent')  --}}
{{-- @extends('agent.agent_Dashboard') --}}

{{-- @section('agent') --}}

<div class="page-content">

  <nav class="page-breadcrumb">

  </nav>
  {{-- <div class="progress mb-3">
    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">15% Complete</div>

  </div> --}}
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        {{-- @if($errors->any())
        <ul class="alert alert-warning">
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
        @endif --}}
      
        <div class="card-body">
          @if (session()->has('message'))
          <div class="alert alert-success" id="success-alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      
      
              {{session()->get('message')}}
            </div>
            @endif
          @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif
          <h4 class="card-titles" style="display: flex;text-align: center; "><span></span>Rice Survey Form Zamboanga City</h4>
          <br>
          <h6 class="card-title"><span>I.</span>Personal Informations</h6>

          <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
        
         <form action{{url('personal_informations')}} method="post">
            @csrf

         

              <div >

             
             
                <input type="hidden" name="users_id" value="{{ $personalinfos->users_id }}">{{ $personalinfos->users_id }}</input>
                
               
             
         </div>
            
          
     
      <div class="row mb-3">
        <h6 class="card-title"><span>a.</span>Personal Info:</h6>
        <div class="col-md-3 mb-3">
          <label class="form-expand" for="first_name">First name</label>
          <input type="text" class="form-control placeholder-text @error('first_name') is-invalid @enderror" name="first_name" value="{{ $personalinfos->first_name}}"id="first_name" placeholder="First name" value="{{ old('first_name') }}">
          @error('first_name')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
        <div class="col-md-3 mb-3">
          <label class="form-expand" for="middle_name">Middle name</label>
          <input type="text" class="form-control placeholder-text @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ $personalinfos->middle_name}}" id="middle_name" placeholder="Middle name"value="{{ old('middle_name') }}" >
          @error('middle_name')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
        <div class="col-md-3 mb-3">
          <label class="form-expand" for="last_name">Last name</label>
          <input type="text" class="form-control placeholder-text @error('last_name') is-invalid @enderror" name="last_name" value="{{ $personalinfos->last_name}}" id="last_name" placeholder="Last name" value="{{ old('last_name') }}" >
          @error('last_name')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
        <div class="col-md-3 mb-3">
          <label class="form-expand" for="extension_name">Extension name</label>
          <input type="text" class="form-control placeholder-text @error('extension_name') is-invalid @enderror" name="extension_name" value="{{ $personalinfos->extension_name}}" id="extension_name" placeholder="Extension name" value="{{ old('extension_name') }}" >
          @error('extension_name')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
      </div>
      
   

    <div class="row mb-3">
      <h6 class="card-title"><span>b.</span>Contact & Demographic Information:</h6>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="home_address">Home Address</label>
        <input type="text" class="form-control placeholder-text @error('home_address') is-invalid @enderror"name="home_address"value="{{ $personalinfos->home_address}}" id="home_address" placeholder="Home Address" value="{{ old('home_address') }}" >
        @error('home_address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="contact_no">Contact No.</label>
        <input type="text" class="form-control placeholder-text @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ $personalinfos->contact_no}}"id="contact_no" placeholder="Contact No." value="{{ old('contact_no') }}" >
        @error('contact_no')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="sex">Sex:</label>
      
        <select class="form-control placeholder-text @error('sex') is-invalid @enderror" name="sex"id="sex" aria-label="label select e" >
          <option value="{{ $personalinfos->sex}}">{{ $personalinfos->sex}}</option>
          <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
          <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
        </select>
        @error('sex')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="religion">Religion:</label>
        <input type="text" class="form-control placeholder-text @error('religion') is-invalid @enderror" value="{{ $personalinfos->religion}}" name="religion" id="religion" placeholder="Religion" value="{{ old('religion') }}" >
        @error('religion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-expand" for="date_of_birth">Date of Birth</label>
        <input class="form-control placeholder-text @error('date_of_birth') is-invalid @enderror"
               name="date_of_birth"value="{{ $personalinfos->date_of_birth}}" id="datepicker" placeholder="Date of Birth"
               value="{{ old('date_of_birth') }}" data-input='true'>
        @error('date_of_birth')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="place_of_birth">Place of Birth</label>
        <input type="text" class="form-control placeholder-text @error('place_of_birth') is-invalid @enderror"value="{{ $personalinfos->place_of_birth}}" name="place_of_birth" id="validationCustom02" placeholder="Place of Birth"  value="{{ old('place_of_birth') }}" >
        @error('place_of_birth')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="validationCustom01">Civil Status:</label>
      
        <select class="form-control placeholder-text @error('civil_status') is-invalid @enderror" name="civil_status"id="validationCustom01" aria-label="Floating label select e">
          <option value="{{ $personalinfos->civil_status}}">{{ $personalinfos->civil_status}}</option>
          <option value="Single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
          <option value="Maried" {{ old('civil_status') == 'Maried' ? 'selected' : '' }}>Maried</option>
          <option value="Divorced" {{ old('civil_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
          <option value="Widowed" {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
         
        </select>
        @error('civil_status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="name_legal_spouse">Name of Spouse:</label>
        <input type="text" class="form-control placeholder-text @error('name_legal_spouse') is-invalid @enderror" value="{{ $personalinfos->name_legal_spouse}}"name="name_legal_spouse" id="name_legal_spouse" placeholder="Name of Legal Spouse"  value="{{ old('name_legal_spouse') }}">
        @error('name_legal_spouse')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-expand" for="no_of_children">No. of Children</label>
        <select class="form-control placeholder-text  @error('no_of_children') is-invalid @enderror"value="{{ $personalinfos->no_of_children}}"name="no_of_children"id="validationCustom01" aria-label="Floating label select e">
          <option value="{{ $personalinfos->no_of_children}}">{{ $personalinfos->no_of_children}}</option>
          <option value="1" {{ old('no_of_children') == '1' ? 'selected' : '' }}>1</option>
          <option value="2" {{ old('no_of_children') == '2' ? 'selected' : '' }}>2</option>
          <option value="3" {{ old('no_of_children') == '3' ? 'selected' : '' }}>3</option>
          <option value="4" {{ old('no_of_children') == '4' ? 'selected' : '' }}>4</option>
          <option value="5" {{ old('no_of_children') == '5' ? 'selected' : '' }}>5</option>
          <option value="6-7" {{ old('no_of_children') == '6-7' ? 'selected' : '' }}>6-7</option>
          <option value="8-10" {{ old('no_of_children') == '8-10' ? 'selected' : '' }}>8-10</option>
          <option value="N/A" {{ old('no_of_children') == 'N/A' ? 'selected' : '' }}>N/A</option>
        </select>
        @error('no_of_children')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="mothers_maiden_name">Mother's Maiden Name</label>
        <input type="text" class="form-control placeholder-text @error('mothers_maiden_name') is-invalid @enderror"value="{{ $personalinfos->mothers_maiden_name}}"name="mothers_maiden_name" id="mothers_maiden_name" placeholder="Mother's Maiden Name"  value="{{ old('mothers_maiden_name') }}">
        @error('mothers_maiden_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="highest_formal_education">Highest Formal Education:</label>
      
        <select class="form-control placeholder-text  @error('highest_formal_education') is-invalid @enderror" name="highest_formal_education"id="validationCustom01" aria-label="Floating label select e">
          <option value="{{ $personalinfos->highest_formal_education}}">{{ $personalinfos->highest_formal_education}}</option>
          <option value="No Formal Education" {{ old('highest_formal_education') == 'No Formal Education' ? 'selected' : '' }}>No Formal Education</option>
          <option value="Primary Education" {{ old('highest_formal_education') == 'Primary Education' ? 'selected' : '' }}>Primary Education</option>
          <option value="Secondary Education" {{ old('highest_formal_education') == 'Secondary Education' ? 'selected' : '' }}>Secondary Education</option>
          <option value="Vocational Training" {{ old('highest_formal_education') == 'Vocational Training' ? 'selected' : '' }}>Vocational Training</option>
          <option value="Bachelors Degree" {{ old('highest_formal_education') == 'Bachelors Degree' ? 'selected' : '' }}>Bachelor's Degree</option>
          <option value="Masters Degree" {{ old('highest_formal_education') == 'Masters Degree' ? 'selected' : '' }}>Master's Degree</option>
          <option value="Doctorate" {{ old('highest_formal_education') == 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
         
          
        </select>
        @error('highest_formal_education')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="person_with_disability">Person with Disability:</label>
        <select class="form-control placeholder-text  @error('person_with_disability') is-invalid @enderror" name="person_with_disability"id="validationCustom01" aria-label="Floating label select e">
          <option  value="{{ $personalinfos->person_with_disability}}">{{ $personalinfos->person_with_disability}}</option>
          <option value="Yes" {{ old('person_with_disability') == 'Yes' ? 'selected' : '' }}>Yes</option>
          <option value="No" {{ old('person_with_disability') == 'No' ? 'selected' : '' }}>No</option>
          
        
        </select>
        @error('person_with_disability')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="pwd_id_no">PWD ID No.</label>
        <input type="text" class="form-control placeholder-text @error('pwd_id_no') is-invalid @enderror"value="{{ $personalinfos->pwd_id_no}}"name="pwd_id_no" id="pwd_id_no" placeholder="PWD ID No." value="{{ old('pwd_id_no') }}"  >
        @error('pwd_id_no')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-expand" for="'government_issued_id">Government Issued ID</label>
        <select class="form-control placeholder-text @error('government_issued_id') is-invalid @enderror"  name="government_issued_id"id="validationCustom01" aria-label="Floating label select e">
          <option value="{{ $personalinfos->government_issued_id}}">{{ $personalinfos->government_issued_id}}</option>
          <option value="Yes" {{ old('government_issued_id') == 'Yes' ? 'selected' : '' }}>Yes</option>
          <option value="No" {{ old('government_issued_id') == 'No' ? 'selected' : '' }}>No</option>
        
        </select>
        @error('government_issued_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="validationCustom02">ID Type</label>
        <select class="form-control placeholder-text @error('id_type') is-invalid @enderror" name="id_type"id="validationCustom01" aria-label="Floating label select e">
          <option value="{{ $personalinfos->id_type}}">{{ $personalinfos->id_type}}</option>
          <option value="Driver License" {{ old('id_type') == 'Driver License' ? 'selected' : '' }}>Driver License</option>
          <option value="Passport" {{ old('id_type') == 'Passport' ? 'selected' : '' }}>Passport</option>
          <option value="Postal ID" {{ old('id_type') == 'Postal ID' ? 'selected' : '' }}>Postal ID</option>
          <option value="Phil National ID" {{ old('id_type') == 'Phil National ID' ? 'selected' : '' }}>Phil National ID</option>
          <option value="PRC ID" {{ old('id_type') == 'PRC ID' ? 'selected' : '' }}>PRC ID</option>
          <option value="Brgy. ID" {{ old('id_type') == 'Brgy. ID' ? 'selected' : '' }}>Brgy. ID</option>
          <option value="PhilHealth ID" {{ old('id_type') == 'PhilHealth ID' ? 'selected' : '' }}>PhilHealth ID</option>
          <option value="Tin ID" {{ old('id_type') == 'Tin ID' ? 'selected' : '' }}>Tin ID</option>
          <option value="SSS ID" {{ old('id_type') == 'SSS ID' ? 'selected' : '' }}>SSS ID</option>
          <option value="N/A" {{ old('id_type') == 'N/A' ? 'selected' : '' }}>N/A</option>

        
        </select>
    @error('id_type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="gov_id_no">ID No.</label>
        <input type="text" class="form-control placeholder-text @error('gov_id_no') is-invalid @enderror"value="{{ $personalinfos->gov_id_no}}"name="gov_id_no" id="gov_id_no" placeholder="ID No."  value="{{ old('gov_id_no') }}">
        @error('gov_id_no')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
    </div>

    <div class="row mb-3">
      <h6 class="card-title"><span>C.</span>Association Information:</h6>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="validationCustom01" style="font-size: 10px;">Member of any Farmers Ass/Org/Coop
        </label>
        <select class="form-control placeholder-text @error('member_ofany_farmers_ass_org_coop') is-invalid @enderror" id="validationCustom01" name="member_ofany_farmers_ass_org_coop" aria-label="Floating label select e">
          <option value="{{ $personalinfos->member_ofany_farmers_ass_org_coop}}">{{ $personalinfos->member_ofany_farmers_ass_org_coop}}</option>
          <option value="Yes" {{ old('member_ofany_farmers_ass_org_coop') == 'Yes' ? 'selected' : '' }}>Yes</option>
          <option value="No" {{ old('member_ofany_farmers_ass_org_coop') == 'No' ? 'selected' : '' }}>No</option>
        
        </select>
        @error('member_ofany_farmers_ass_org_coop')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="nameof_farmers_ass_org_coop" style="font-size: 12px;">Name of Farmers Ass/Org/Coop</label>
        <input type="text" class="form-control placeholder-text @error('nameof_farmers_ass_org_coop') is-invalid @enderror"value="{{ $personalinfos->nameof_farmers_ass_org_coop}}" id="validationCustom02"name="nameof_farmers_ass_org_coop" placeholder="if Yes please specify" value="{{ old('nameof_farmers_ass_org_coop') }}">
        @error('nameof_farmers_ass_org_coop')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="name_contact_person">Name of Contact Person</label>
        <input type="text" class="form-control placeholder-text @error('name_contact_person') is-invalid @enderror"value="{{ $personalinfos->name_contact_person}}" id="name_contact_person"name="name_contact_person"  placeholder="Name of Contact Person"  value="{{ old('name_contact_person') }}">
        @error('name_contact_person')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-expand" for="'cp_tel_no">Celphone/Tel.no</label>
        <input type="text" class="form-control placeholder-text @error('cp_tel_no') is-invalid @enderror"value="{{ $personalinfos->cp_tel_no}}" id="'cp_tel_no"name="cp_tel_no" placeholder="Celphone/Tel.no"  value="{{ old('cp_tel_no') }}" >
        @error('cp_tel_no')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>

      <div class="col-md-3 mb-3">
        <label class="form-expand" for="image" class="form-label" style="color: green;">UploadPhoto</label>
        <input type="file" class="custom-file-input" id="inputGroupFile01"
        aria-describedby="inputGroupFileAddon01">
    </div>


    </div>



    <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a  href="{{route('personalinfo.create')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
      <button  type="submit" class="btn btn-success me-md-2">Next</button></a></p>
    </div>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      flatpickr("#datepicker", {
          dateFormat: "Y-m-d", // Date format (YYYY-MM-DD)
          // Additional options can be added here
      });
  });
</script>

@endsection