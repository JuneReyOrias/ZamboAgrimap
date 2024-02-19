@extends('agent.agent_Dashboard')
@section('agent') 


<div class="page-content">

  <nav class="page-breadcrumb">

  </nav>
  <div class="progress mb-3">
    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">15% Complete</div>

  </div>
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">

    
        <div class="card-body">
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
        <h6 class="card-title">Rice Survey Form Update</h6>
          <h6 class="card-title"><span>I.</span>Personal Information</h6>

          <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
        
          <form action{{url('updateinfo')}} method="post" enctype="multipart/form-data">
            @csrf
       
       
            {{-- <div class="row mb-3">
            
              <div class="col-md-3">
                @php
                $id =Auth::user()->id;
                       $agent = App\Models\User:: find($id);
    
            
                           @endphp
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name="users_id" placeholder="FirstName" value="{{$agent->name}}"type="text" aria-label="FirstName"id="floatingInput">
                <label for="floatingInput" >FirstName:</label>
              </div>
            </div>

            <div class="col-md-3">
  
                @php
                       $id = Auth::id();
   
                   // Find the user by their ID and eager load the personalInformation relationship
                  $agridisrict= App\Models\AgriDistrict::find($id)->all();
   
                     @endphp
                   <div class="form-floating mb-4 mb-md-0"> 
                      <select class="form-control mb-4 mb-md-0" name="agri_districts_id" aria-label="agri_districts_id">
                       @foreach ($agridisrict as $agridisrict)
                               <option value="{{$agridisrict->id }}">{{ $agridisrict->district }}</option>
                           @endforeach
                       </select>
                       <label for="agri_districts_id">Agri District:</label>
                   </div>
                 

            </div>  
            {{-- <div class="col-md-3">
  
                @php
                       $id = Auth::id();
   
                   // Find the user by their ID and eager load the personalInformation relationship
                  $cropcat= App\Models\CropCategory::find($id)->all();
   
                     @endphp
                   <div class="form-floating mb-4 mb-md-0"> 
                      <select class="form-control mb-4 mb-md-0" name="crop_categorys_id" aria-label="crop_categorys_id">
                       @foreach ($cropcat as $cropcat)
                               <option value="{{$cropcat->id }}">{{ $cropcat->crop_name}}</option>
                           @endforeach
                       </select>
                       <label for="crop_categorys_id">Agri District:</label>
                   </div>
                 

            </div>   
        </div> --}}
        {{-- @php
        $id = Auth::id();

    // Find the user by their ID and eager load the personalInformation relationship
    $personlinformation= App\Models\PersonalInformations::where('id', $id)->first();

      @endphp --}}
            <div class="row mb-3">
             
              <div class="col-md-3">

                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name="first_name" placeholder="FirstName" value="{{$personlinformation->first_name}}" type="text" aria-label="FirstName"id="floatingInput">
                <label for="floatingInput" >FirstName:</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="middle_name" placeholder="MiddleName" value="{{$personlinformation->middle_name}}"  type="text" aria-label="MiddleName"id="floatingInput">
              <label for="floatingInput" >MiddeName:</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="last_name" placeholder="Lastname"value="{{$personlinformation->last_name}}" type="text" aria-label="LastName"id="floatingInput">
            <label for="floatingInput" >LastName:</label>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
          <input  class="form-control mb-4 mb-md-0"  name="extension_name"  placeholder="Extension Name" value="{{$personlinformation->extension_name}}" type="text" aria-label="ExtensionName"id="floatingInput">
          <label for="floatingInput" >Extension Name:</label>
        </div>
      </div>
              </div>
  
            <div class="row mb-3">
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name= "home_address"placeholder="Home Address"value="{{$personlinformation->home_address}}" type="text" aria-label="HomeAddress"id="floatingInput">
                <label for="floatingInput" >Home Address:</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
                <select class="form-select mb-4 mb-md-0" name="sex" id="floatingSelect" aria-label="Floating label select e">
               
                  <option value="{{$personlinformation->sex}}">{{$personlinformation->sex}}</option>
                  <option>Male</option>
                  <option>Female</option>
                 
                </select>
              <label for="sex" >Sex:</label>
            </div>
          </div>
                <div class="col-md-3">
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="religion" placeholder="Lastname"value="{{$personlinformation->religion}}" type="text" aria-label="MiddlName"id="floatingInput">
                  <label for="floatingInput" >Religion:</label>
                </div>
              </div>
           
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="date_of_birth" placeholder="Date Of Birth"value="{{$personlinformation->date_of_birth}}" type="date" aria-label="DateOfBirth"id="floatingInput">
              <label for="floatingInput" >Date of Birth:</label>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="place_of_birth"placeholder="Place OF Birth" value="{{$personlinformation->place_of_birth}}" type="text" aria-label="PlaceOfBirth"id="floatingInput">
            <label for="floatingInput" >Place of Birth:</label>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
          <input  class="form-control mb-4 mb-md-0" name="contact_no" placeholder="Contact no." value="{{$personlinformation->contact_no}}"type="text" aria-label="ContactNo"id="floatingInput">
          <label for="floatingInput" >Contact No.:</label>
        </div>
      </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
            <select class="form-select mb-4 mb-md-0" name="civil_status"id="floatingSelect" aria-label="Floating label select e">
              <option value="{{$personlinformation->civil_status}}">{{$personlinformation->civil_status}}</option>
              <option>Single</option>
              <option>Maried</option>
              <option>Divorced</option>
              <option>Widowed</option>
            </select>
          <label for="floatingInput" >Civil Status:</label>
        </div>
      </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
          <input  class="form-control mb-4 mb-md-0" name="name_legal_spouse"placeholder="Name of legal spouse" value="{{$personlinformation->name_legal_spouse}}"type="text" aria-label="NameOfLegalSpouse"id="floatingInput">
          <label for="floatingInput" >Name Of LegalSpouse:</label>
        </div>
      </div>
    </div>
            <div class="row mb-3">
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="no_of_children" placeholder="No. Of Children"value="{{$personlinformation->no_of_children}}" type="text" aria-label="No.OfChildren"id="floatingInput">
            <label for="floatingInput" >No.of Children:</label>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
          <input  class="form-control mb-4 mb-md-0" name="mothers_maiden_name" placeholder="Mothers Maiden Name"value="{{$personlinformation->mothers_maiden_name}}" type="text" aria-label="MothersMaidenName"id="floatingInput">
          <label for="floatingInput" >Mother's maiden Name:</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-floating mb-4 mb-md-0">
        <input  class="form-control mb-4 mb-md-0" name="highest_formal_education" value="{{$personlinformation->highest_formal_education}}" placeholder="Highest Formal Education" type="text" aria-label="highest_formal_education"id="floatingInput">
        <label for="floatingInput" >Highest Formal Education:</label>
      </div>
    </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
            <select class="form-select mb-4 mb-md-0" name="person_with_disability"id="floatingSelect" aria-label="Floating label select e">
              <option value="{{$personlinformation->person_with_disability}}">{{$personlinformation->person_with_disability}}</option>
              <option>Yes</option>
              <option>No</option>
            </select>
          <label for="floatingInput" >Person with Disability:</label>
        </div>
      </div>
     
  </div>
  <div class="row mb-3">
    <div class="col-md-3">
      <div class="form-floating mb-4 mb-md-0">
      <input  class="form-control mb-4 mb-md-0" name="pwd_id_no"value="{{$personlinformation->pwd_id_no}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
      <label for="floatingInput" >PWD ID No.:</label>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-floating mb-4 mb-md-0">
      <select class="form-select mb-4 mb-md-0" name="government_issued_id" id="floatingSelect" aria-label="Floating label select e">
        <option value="{{$personlinformation->government_issued_id}}">{{$personlinformation->government_issued_id}}</option>
        <option>Yes</option>
        <option>No</option>
      </select>
    <label for="government_issued_id" >Government Issued ID:</label>
  </div>
</div>
<div class="col-md-3">
  <div class="form-floating mb-4 mb-md-0">
  <input  class="form-control mb-4 mb-md-0" name="id_type" value="{{$personlinformation->id_type}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
  <label for="floatingInput" >ID Type:</label>
</div>
</div>
<div class="col-md-3">
<div class="form-floating mb-4 mb-md-0">
<input  class="form-control mb-4 mb-md-0"name="gov_id_no" value="{{$personlinformation->gov_id_no}}"placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
<label for="floatingInput" >ID No.:</label>
</div>
</div>

</div>
<div class="row mb-3">

<div class="col-md-3">
  <div class="form-floating mb-4 mb-md-0">
    <select class="form-select mb-4 mb-md-0" name="member_ofany_farmers_ass_org_coop"id="floatingSelect" aria-label="Floating label select e">
    <option value="{{$personlinformation->member_ofany_farmers_ass_org_coop}}">{{$personlinformation->member_ofany_farmers_ass_org_coop}}</option>
      <option>Yes</option>
      <option>No</option>
    </select>
  <label for="member_ofany_farmers_ass_org_coop" >Members in any farmers Ass/Org/Coop:</label>
</div>
</div>
<div class="col-md-3">
  <div class="form-floating mb-4 mb-md-0">
  <input  class="form-control mb-4 mb-md-0" name="nameof_farmers_ass_org_coop"value="{{$personlinformation->nameof_farmers_ass_org_coop}}" type="text" aria-label="MiddlName"id="floatingInput">
  <label for="floatingInput" >If yes,please specify:</label>
</div>
</div>
<div class="col-md-3">
<div class="form-floating mb-4 mb-md-0">
<input  class="form-control mb-4 mb-md-0" name="name_contact_person"value="{{$personlinformation->name_contact_person}}" type="text" aria-label="MiddlName"id="floatingInput">
<label for="floatingInput" >Name of Contact Person:</label>
</div>
</div>
<div class="col-md-3">
<div class="form-floating mb-4 mb-md-0">
<input  class="form-control mb-4 mb-md-0" name="cp_tel_no" value="{{$personlinformation->cp_tel_no}}" type="text" aria-label="MiddlName"id="floatingInput">
<label for="floatingInput" >Cellphone/Tel.no.:</label>
</div>
</div>

</div>
<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a  href="{{route('agent.personal_info.view_infor')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
  <button  type="submit" class="btn btn-success me-md-2">Next</button></a></p>
</div>
          </form>
        
          
        </div>
      </div>
    </div>
  </div>
   
 
  



</div>
@endsection