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
        @if($errors->any())
        <ul class="alert alert-warning">
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
        @endif
        <div class="card-body">
          
          <h6 class="card-title"><span>I.</span>Create Parcellary Boarders</h6>

          
         {{-- <p class="text-muted mb-3">Read the <a href="https://github.com/RobinHerbots/Inputmask" target="_blank"> Official Inputmask Documentation </a>for a full list of instructions and other options.</p> --}}
          <form action{{url('parcellary_boundaries')}} method="post">
            @csrf
            <div class="row mb-3">
             
                <div class="col-md-3">
  
                  
                  <div class="form-floating mb-4 mb-md-0"> 
                     <select class="form-control mb-4 mb-md-0" name="agri_districts_id" aria-label="User ID">
                          @foreach ($agriculture as $agriculture)
                              <option value="{{ $agriculture->id }}">{{ $agriculture->district }}</option>
                          @endforeach
                      </select>
                      <label for="agri_districts_id">Agri_District Name:</label>
                  </div>
                
              </div>
              
              <div class="col-md-3">
  
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="parcel_name" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                  <label for="floatingInput" >Parcel Name:</label>
                </div>
                
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name="Area" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                <label for="floatingInput" >Area:</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="series" placeholder="Lastname" type="text" aria-label="LastName"id="floatingInput">
              <label for="floatingInput" >Series:</label>
            </div>
          </div>
          {{-- <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0"  name="longitude"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
            <label for="floatingInput" >Longitude:</label>
          </div>
        </div> --}}
                </div>
                <div class="row mb-3">
             
                    <div class="col-md-3">
      
                      
                      <div class="form-floating mb-4 mb-md-0">
                          <input  class="form-control mb-4 mb-md-0" name="tct_no" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                          <label for="floatingInput" >Tct_no:</label>
                        </div>
                    
                  </div>
                  
                  <div class="col-md-3">
      
                      <div class="form-floating mb-4 mb-md-0">
                      <input  class="form-control mb-4 mb-md-0" name="brgy_name" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                      <label for="floatingInput" >Brgy. Name:</label>
                    </div>
                    
                  </div>
                  <div class="col-md-3">
                    <div class="form-floating mb-4 mb-md-0">
                    <input  class="form-control mb-4 mb-md-0" name="atdn" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                    <label for="floatingInput" >atdn:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="arpowner_na" placeholder="Lastname" type="text" aria-label="LastName"id="floatingInput">
                  <label for="floatingInput" >arp owner na:</label>
                </div>
              </div>
              {{-- <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0"  name="longitude"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
                <label for="floatingInput" >Longitude:</label>
              </div>
            </div> --}}
                    </div>
            <div class="row mb-3">
             
              <div class="col-md-3">

                
                <div class="form-floating mb-4 mb-md-0">
                    <input  class="form-control mb-4 mb-md-0" name="pkind_desc" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                    <label for="floatingInput" >Pkind Desc:</label>
                  </div>
              
            </div>
            
            <div class="col-md-3">

                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name="puse_desc" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                <label for="floatingInput" >puse_desc:</label>
              </div>
              
            </div>
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="actual_used" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
              <label for="floatingInput" >actual_used:</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="market_value" placeholder="Lastname" type="text" aria-label="LastName"id="floatingInput">
            <label for="floatingInput" >market_value:</label>
          </div>
        </div>
        {{-- <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
          <input  class="form-control mb-4 mb-md-0"  name="longitude"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
          <label for="floatingInput" >Longitude:</label>
        </div>
      </div> --}}
              </div>
              <div class="row mb-3">

              
              <div class="col-md-3">
  
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="asssesedva" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                  <label for="floatingInput" >asssesedva:</label>
                </div>
                
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name="parone_latitude" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                <label for="floatingInput" >Point 1 Latitude:</label>
              </div>
            </div>
          
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0"  name="parone_longitude"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
            <label for="floatingInput" >Point 1 Longitude:</label>
          </div>
        </div>
        <div class="col-md-3">
  
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="partwo_latitude" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
            <label for="floatingInput" >Point 2 Latitude:</label>
          </div>
          
        </div>
                </div>
                <div class="row mb-3">

              
                    <div class="col-md-3">
        
                        <div class="form-floating mb-4 mb-md-0">
                        <input  class="form-control mb-4 mb-md-0" name="partwo_longitude" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                        <label for="floatingInput" >Point 2 Longitude:</label>
                      </div>
                      
                    </div>
                    <div class="col-md-3">
                      <div class="form-floating mb-4 mb-md-0">
                      <input  class="form-control mb-4 mb-md-0" name="parthree_latitude" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                      <label for="floatingInput" >Point 3 Latitude:</label>
                    </div>
                  </div>
                
                <div class="col-md-3">
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0"  name="parthree_longitude"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
                  <label for="floatingInput" >Point 3 Longitude:</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0"  name="parfour_latitude"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
                <label for="floatingInput" >Point 4 latitude:</label>
              </div>
            </div>
                      </div>
                      <div class="row mb-3">

              
                        <div class="col-md-3">
            
                            <div class="form-floating mb-4 mb-md-0">
                            <input  class="form-control mb-4 mb-md-0" name="parfour_longitude" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                            <label for="floatingInput" >Point 4 Longitude:</label>
                          </div>
                          
                        </div>
                        <div class="col-md-3">
                          <div class="form-floating mb-4 mb-md-0">
                          <input  class="form-control mb-4 mb-md-0" name="parfive_latitude" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                          <label for="floatingInput" >Point 5 Latitude:</label>
                        </div>
                      </div>
                    
                    <div class="col-md-3">
                      <div class="form-floating mb-4 mb-md-0">
                      <input  class="form-control mb-4 mb-md-0"  name="parfive_longitude"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
                      <label for="floatingInput" >Point 5 Longitude:</label>
                    </div>
                  </div>
                  <div class="col-md-3">
            
                      <div class="form-floating mb-4 mb-md-0">
                      <input  class="form-control mb-4 mb-md-0" name="parsix_latitude" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                      <label for="floatingInput" >Point 6 Latitude:</label>
                    </div>
                    
                  </div>
                          </div>
                          <div class="row mb-3">

              
                            <div class="col-md-3">
                
                                <div class="form-floating mb-4 mb-md-0">
                                <input  class="form-control mb-4 mb-md-0" name="parsix_longitude" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                                <label for="floatingInput" >Point 6 Longitude:</label>
                              </div>
                              
                            </div>
                            <div class="col-md-3">
                              <div class="form-floating mb-4 mb-md-0">
                              <input  class="form-control mb-4 mb-md-0" name="parseven_latitude" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                              <label for="floatingInput" >Point 7 Latitude:</label>
                            </div>
                          </div>
                            <div class="col-md-3">
                              <div class="form-floating mb-4 mb-md-0">
                              <input  class="form-control mb-4 mb-md-0" name="parseven_longitude" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                              <label for="floatingInput" >Point 7 Longitude:</label>
                            </div>
                          </div>
                        
                        <div class="col-md-3">
                          <div class="form-floating mb-4 mb-md-0">
                          <input  class="form-control mb-4 mb-md-0"  name="pareight_latitude"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
                          <label for="floatingInput" >Point 8 Latitude:</label>
                        </div>
                      </div>
                   </div>
                   <div class="row mb-3">

              
                    <div class="col-md-3">
        
                        <div class="form-floating mb-4 mb-md-0">
                        <input  class="form-control mb-4 mb-md-0" name="pareight_longitude" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                        <label for="floatingInput" >Point 8 Longitude:</label>
                      </div>
                      
                    </div>
                    <div class="col-md-3">
                      <div class="form-floating mb-4 mb-md-0">
                      <input  class="form-control mb-4 mb-md-0" name="parnine_latitude" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                      <label for="floatingInput" >Point 9 Latitude:</label>
                    </div>
                  </div>
                    <div class="col-md-3">
                      <div class="form-floating mb-4 mb-md-0">
                      <input  class="form-control mb-4 mb-md-0" name="parnine_longitude" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                      <label for="floatingInput" >Point 9 Longitude:</label>
                    </div>
                  </div>
                
                <div class="col-md-3">
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0"  name="parten_latitude"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
                  <label for="floatingInput" >Point 10 Latitude:</label>
                </div>
              </div>
              
                      </div>
                      <div class="row mb-3">

              
                        <div class="col-md-3">
            
                            <div class="form-floating mb-4 mb-md-0">
                            <input  class="form-control mb-4 mb-md-0" name="parten_longitude" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                            <label for="floatingInput" >Point 10 Longitude:</label>
                          </div>
                          
                        </div>
                        <div class="col-md-3">
                          <div class="form-floating mb-4 mb-md-0">
                          <input  class="form-control mb-4 mb-md-0" name="pareleven_latitude" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                          <label for="floatingInput" >Point 11 Latitude:</label>
                        </div>
                      </div>
                        <div class="col-md-3">
                          <div class="form-floating mb-4 mb-md-0">
                          <input  class="form-control mb-4 mb-md-0" name="pareleven_longitude" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                          <label for="floatingInput" >Point 11 Longitude:</label>
                        </div>
                      </div>
                    
                    <div class="col-md-3">
                      <div class="form-floating mb-4 mb-md-0">
                      <input  class="form-control mb-4 mb-md-0"  name="partwelve_latitude"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
                      <label for="floatingInput" >Point 12 Latitude:</label>
                    </div>
                  </div>
                  
                          </div>         
                          <div class="row mb-3">

              
                            <div class="col-md-3">
                
                                <div class="form-floating mb-4 mb-md-0">
                                <input  class="form-control mb-4 mb-md-0" name="partwelve_longitude" placeholder="FirstName" type="text" aria-label="FirstName"id="floatingInput">
                                <label for="floatingInput" >Point 12 Longitude:</label>
                              </div>
                              
                            </div>
                            {{-- <div class="col-md-3">
                              <div class="form-floating mb-4 mb-md-0">
                              <input  class="form-control mb-4 mb-md-0" name="pareleven_latitude" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                              <label for="floatingInput" >Point 11 Latitude:</label>
                            </div>
                          </div>
                            <div class="col-md-3">
                              <div class="form-floating mb-4 mb-md-0">
                              <input  class="form-control mb-4 mb-md-0" name="pareleven_longitude" placeholder="MiddleName" type="text" aria-label="MiddleName"id="floatingInput">
                              <label for="floatingInput" >Point 11 Longitude:</label>
                            </div>
                          </div>
                        
                        <div class="col-md-3">
                          <div class="form-floating mb-4 mb-md-0">
                          <input  class="form-control mb-4 mb-md-0"  name="partwelve_latitude"  placeholder="Extension Name" type="text" aria-label="ExtensionName"id="floatingInput">
                          <label for="floatingInput" >Point 12 Latitude:</label>
                        </div>
                      </div> --}}
                      
                              </div>  
{{--   
            <div class="row mb-3">
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name= "home_address"placeholder="Home Address" type="text" aria-label="HomeAddress"id="floatingInput">
                <label for="floatingInput" >Home Address:</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
                <select class="form-select mb-4 mb-md-0" name="sex"id="floatingSelect" aria-label="Floating label select e">
                  <option selected disabled>Select</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
              <label for="floatingInput" >Sex:</label>
            </div>
          </div>
                <div class="col-md-3">
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="religion" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
                  <label for="floatingInput" >Religion:</label>
                </div>
              </div>
           
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="date_of_birth" placeholder="Date Of Birth" type="date" aria-label="DateOfBirth"id="floatingInput">
              <label for="floatingInput" >Date of Birth:</label>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="place_of_birth"placeholder="Place OF Birth" type="text" aria-label="PlaceOfBirth"id="floatingInput">
            <label for="floatingInput" >Place of Birth:</label>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
          <input  class="form-control mb-4 mb-md-0" name="contact_no" placeholder="Contact no." type="text" aria-label="ContactNo"id="floatingInput">
          <label for="floatingInput" >Contact No.:</label>
        </div>
      </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
            <select class="form-select mb-4 mb-md-0" name="civil_status"id="floatingSelect" aria-label="Floating label select e">
              <option selected disabled>Select</option>
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
          <input  class="form-control mb-4 mb-md-0" name="name_legal_spouse"placeholder="Name of legal spouse" type="text" aria-label="NameOfLegalSpouse"id="floatingInput">
          <label for="floatingInput" >Name Of LegalSpouse:</label>
        </div>
      </div>
    </div>
            <div class="row mb-3">
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="no_of_children" placeholder="No. Of Children" type="text" aria-label="No.OfChildren"id="floatingInput">
            <label for="floatingInput" >No.of Children:</label>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
          <input  class="form-control mb-4 mb-md-0" name="mothers_maiden_name" placeholder="Mothers Maiden Name" type="text" aria-label="MothersMaidenName"id="floatingInput">
          <label for="floatingInput" >Mother's maiden Name:</label>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-floating mb-4 mb-md-0">
        <input  class="form-control mb-4 mb-md-0" name="highest_formal_education" placeholder="Highest Formal Education" type="text" aria-label="highest_formal_education"id="floatingInput">
        <label for="floatingInput" >Highest Formal Education:</label>
      </div>
    </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
            <select class="form-select mb-4 mb-md-0" name="person_with_disability"id="floatingSelect" aria-label="Floating label select e">
              <option selected disabled>Select</option>
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
      <input  class="form-control mb-4 mb-md-0" name="pwd_id_no" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
      <label for="floatingInput" >PWD ID No.:</label>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-floating mb-4 mb-md-0">
      <select class="form-select mb-4 mb-md-0" name="government_issued_id" id="floatingSelect" aria-label="Floating label select e">
        <option selected disabled>Select</option>
        <option>Yes</option>
        <option>No</option>
      </select>
    <label for="floatingInput" >Government Issued ID:</label>
  </div>
</div>
<div class="col-md-3">
  <div class="form-floating mb-4 mb-md-0">
  <input  class="form-control mb-4 mb-md-0" name="id_type" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
  <label for="floatingInput" >ID Type:</label>
</div>
</div>
<div class="col-md-3">
<div class="form-floating mb-4 mb-md-0">
<input  class="form-control mb-4 mb-md-0"name="gov_id_no" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
<label for="floatingInput" >ID No.:</label>
</div>
</div>

</div>
<div class="row mb-3">

<div class="col-md-3">
  <div class="form-floating mb-4 mb-md-0">
    <select class="form-select mb-4 mb-md-0" name="member_ofany_farmers_ass_org_coop"id="floatingSelect" aria-label="Floating label select e">
      <option selected disabled>Select</option>
      <option>Yes</option>
      <option>No</option>
    </select>
  <label for="floatingInput" >Members in any farmers Ass/Org/Coop:</label>
</div>
</div>
<div class="col-md-3">
  <div class="form-floating mb-4 mb-md-0">
  <input  class="form-control mb-4 mb-md-0" name="nameof_farmers_ass_org_coop" type="text" aria-label="MiddlName"id="floatingInput">
  <label for="floatingInput" >If yes,please specify:</label>
</div>
</div>
<div class="col-md-3">
<div class="form-floating mb-4 mb-md-0">
<input  class="form-control mb-4 mb-md-0" name="name_contact_person" type="text" aria-label="MiddlName"id="floatingInput">
<label for="floatingInput" >Name of Contact Person:</label>
</div>
</div>
<div class="col-md-3">
<div class="form-floating mb-4 mb-md-0">
<input  class="form-control mb-4 mb-md-0" name="cp_tel_no" type="text" aria-label="MiddlName"id="floatingInput">
<label for="floatingInput" >Cellphone/Tel.no.:</label>
</div> 
</div>

</div> --}}
<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button  type="submit" class="btn btn-success me-md-2">Submit</button></a></p>
</div>
          </form>
        
          
        </div>
      </div>
    </div>
  </div>
  <h6 class="card-title"><span>I.</span>Personal Information</h6>
  
  <p class="text-muted mb-3">Read the <a href="https://github.com/RobinHerbots/Inputmask" target="_blank"> Official Inputmask Documentation </a>for a full list of instructions and other options.</p>
  <div class="table-responsive tab ">
   <table class="table table table-info">
       <thead class="thead-light">
           <tr >
               <th>ID</th>
               <th>District Name</th>
               <th>Description</th>
               <th>Latitude</th>
               <th>Longitude</th>
              
               <th>Action</th>
           </tr>
       </thead>
       <tbody>
         {{-- @if($Agriculture->count() > 0) 
      @foreach($Agriculture as $agridistrict)
           <tr class="table-light">
                <td>{{ $loop->iteration }}</td>
               <td>{{  $agridistrict->district }}</td>
               <td>{{  $agridistrict->description }}</td>
               <td>{{  $agridistrict->latitude }}</td>
               <td>{{  $agridistrict->longitude }}</td>
              
               

               <td>
                  
                    <a href="{{route('personalinfo.edit',  $agridistrict->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
       
                    <form  action="{{ route('personalinfo.destroy',  $agridistrict->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                       {{ csrf_field()}}
                       <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                   </form>
                    <div class="col-sm">
                       <form action="{{ route('personalinfo.destroy', $personalInformations->id) }}" method="post">
                         @csrf
                         @method('DELETE')
                         <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                       </form>
                   </div>
               </td>
           </tr>
       @endforeach
       @else
       <tr>
           <td class="text-center" colspan="5">Personal Informations not found</td>
       </tr>
   @endif -- --}}
       </tbody>
   </table>
</div>


 </div>
</div>
</div>
</div>
 
  <!--end for Production Cost-->
  {{-- <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <h6 class="card-title">Import File</h6>
            <p class="text-muted mb-3">Import excel file, csv file or Msacces file only.</p>
            <div class="form-errors"></div>
            <form id="upload-form" method="post" enctype="multipart/form-data" onsubmit="saveForm(event)">
              @csrf
       
                <div class="form-group mb-3">
                  <label for=inputemail>Upload</label>
                  <input type="file" class ="form-control" id="myDropify" name="upload_file" aria-describedby="emailHelp">
                  <span class="text-danger input_image_err formErrors"></span>
              </div>
            <div class="form-group mb-2 text-center">
              <button type="submit" class="btn btn-primary me-2">Submit</button>
            </div>
             
            </form>
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
                var uploadForm= $('upload-for,')(0);
                Var uploadFormData= new FormData(uploadForm);

                $.ajax({
                  method="Post",
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
             </script> --}}
           
       
        </div>
      </div>
    </div>
  
  </div>

</div>@endsection
    

