@extends('agent.agent_Dashboard')
@section('agent') 


<div class="page-content">

    <nav class="page-breadcrumb">
      <ol class="breadcrumb">
        
      </ol>
    </nav>
    <div class="progress mb-3">
      <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70% Complete</div>
  
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
         
          <div class="card-body">
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

            <h6 class="card-title"><span>V.</span>Last Production Data Update</h6>
  
            <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
           
           <form  action{{url('AddNewProduction')}} method="post"  >
              @csrf

              
              <div class="row mb-3">    
                <div class="col-md-3">
   
                    <div class="form-floating mb-4 mb-md-0">
                    <input id="personal_informations_id" class="form-control mb-4 mb-md-0" name="personal_informations_id" value="{{ $productions->personal_informations_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput"readonly>
                    <label for="personal_informations_id" >Personal Information ID:</label>
                  </div>
                
                </div>
                <div class="col-md-3">
   
                    <div class="form-floating mb-4 mb-md-0">
                    <input id="lastname" class="form-control mb-4 mb-md-0" name="farm_profiles_id" value="{{ $productions->farm_profiles_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput"readonly>
                    <label for="farm_profiles_id" >Farm Profiles ID:</label>
                  </div>
                
                </div>

                <div class="col-md-3">
   
                    <div class="form-floating mb-4 mb-md-0">
                    <input id="lastname" class="form-control mb-4 mb-md-0" name="agri_districts_id" value="{{ $productions->agri_districts_id}}" placeholder="" type="text" aria-label="Lastname"id="floatingInput">
                    <label for="agri_districts_id" >Agri District ID:</label>
                  </div>
                
                </div>
                </div>


              <div class="row mb-3">
               
                <div class="col-md-3">
  
                  <div class="form-floating mb-4 mb-md-0">
                  <input id="lastname" class="form-control mb-4 mb-md-0" name="seeds_typed_used"value="{{ $productions->seeds_typed_used}}" placeholder="" type="text" aria-label="seeds_typed_used"id="floatingInput">
                  <label for="floatingInput" >Seed Type used:</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input id="lastname" class="form-control mb-4 mb-md-0" name="seeds_used_in_kg"value="{{ $productions->seeds_used_in_kg}}" placeholder="Lastname" type="text" aria-label="ExtensionName"id="floatingInput">
                <label for="floatingInput" >Seeds in kgs/bag used:</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
                <select class="form-select mb-4 mb-md-0" name="seed_source"id="floatingSelect" aria-label="Floating label select e">
                  <option value="{{ $productions->seed_source}}">{{ $productions->seed_source}}</option>
                  <option>Government Subsidy</option>
                  <option>Traders</option>
                  <option>Own</option>
                </select> 
              <label for="floatingInput" >Seed Source:</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="no_of_fertilizer_used_in_bags"value="{{ $productions->no_of_fertilizer_used_in_bags}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
            <label for="floatingInput" >  No. of fertilizer used in bags:</label>
          </div>
        </div>
                </div>
    
              <div class="row mb-3">
                <div class="col-md-3">
                  <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="no_of_pesticides_used_in_l_per_kg"value="{{ $productions->no_of_pesticides_used_in_l_per_kg}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
                  <label for="floatingInput" >No. of pesticides used in l per kg:</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                  <input  class="form-control mb-4 mb-md-0" name="no_of_insecticides_used_in_l"value="{{ $productions->no_of_insecticides_used_in_l}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
                  <label for="floatingInput" >No. of insecticides used in l:</label>
              </div>
            </div>
                  <div class="col-md-3">
                    <div class="form-floating mb-4 mb-md-0">
                    <input  class="form-control mb-4 mb-md-0" name="area_planted"value="{{ $productions->area_planted}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
                    <label for="floatingInput" >Area planted:</label>
                  </div>
                </div>
             
              <div class="col-md-3">
                <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name="date_planted"value="{{ $productions->date_planted}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
                <label for="floatingInput" >Date Planted:</label>
              </div>
            </div>
          </div>
  
          <div class="row mb-3">
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="date_harvested" value="{{ $productions->date_harvested}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
              <label for="floatingInput" >Date Harvested:</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="yield_tons_per_kg"value="{{ $productions->yield_tons_per_kg}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
            <label for="floatingInput" >Yield (tons/kg):</label>
          </div>
        </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="unit_price_palay_per_kg"value="{{ $productions->unit_price_palay_per_kg}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
              <label for="floatingInput" >Unit price palay per kg:</label>
          </div>
        </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
            <input  class="form-control mb-4 mb-md-0" name="unit_price_rice_per_kg"value="{{ $productions->unit_price_rice_per_kg}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
            <label for="floatingInput" >Unit price rice per kg:</label>
          </div>
        </div>
      </div>
              <div class="row mb-3">
            <div class="col-md-3">
              <div class="form-floating mb-4 mb-md-0">
                <input  class="form-control mb-4 mb-md-0" name="type_of_product"value="{{ $productions->type_of_product}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
                <label for="floatingInput" >Type of product:</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
              <select class="form-select mb-4 mb-md-0" name="sold_to"id="floatingSelect" aria-label="Floating label select e">
                <option value="{{ $productions->sold_to}}">{{ $productions->sold_to}}</option>
                <option>Palay</option>
                <option>Rice</option>
              </select>
            <label for="floatingInput" >Sold To:</label>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-floating mb-4 mb-md-0">
          <input  class="form-control mb-4 mb-md-0" name="if_palay_milled_where"value="{{ $productions->if_palay_milled_where}}"placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
          <label for="floatingInput" >If palay milled where?:</label>
        </div>
      </div>
          <div class="col-md-3">
            <div class="form-floating mb-4 mb-md-0">
              <input  class="form-control mb-4 mb-md-0" name="gross_income_palay" value="{{ $productions->gross_income_palay}}" placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
        <label for="floatingInput" >Gross Income (Palay)</label>
          </div>
        </div>
       
    </div>
     <div class="row mb-3">
      <div class="col-md-3">
        <div class="form-floating mb-4 mb-md-0">
        <input  class="form-control mb-4 mb-md-0" name="gross_income_rice"value="{{ $productions->gross_income_rice}}"placeholder="Lastname" type="text" aria-label="MiddlName"id="floatingInput">
        <label for="floatingInput" >Gross Income (Rice):</label>
      </div>
    </div>
  
 
  
  </div>
  <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a  href="{{route('agent.lastproduction.view_prod')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
    <button  type="submit" class="btn btn-success me-md-2">Next</button></a></p>
            </form>
         
          </div>
        </div>
      </div>
    </div>
  
  
  
  </div>
  @endsection