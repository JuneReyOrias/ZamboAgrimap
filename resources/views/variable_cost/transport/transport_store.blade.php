@extends('admin.dashb')
@section('admin')


<div class="page-content">

  <nav class="page-breadcrumb">

  </nav>
  
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card bordered rounded">
       
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


        <h6 class="card-title"><span>V.</span>Variable Cost</h6>
        <h5 class="card-title"><span>e.</span>Transport</h5>
        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
       
         
         <form action{{url('transports')}} method="post">
            @csrf
                   {{-- adding new transport data --}}
                   <div class="row mb-3">
                    <h2 class="card-title"><span></span>Transport info:</h2>
                  
                   
                    <div class="col-md-3 mb-3">
                      <label class="form-expand" for="name_of_vehicle">Name of Vehicle:</label>
                      <input type="text" class="form-control placeholder-text @error('name_of_vehicle') is-invalid @enderror" name="name_of_vehicle" id="quantityInput" placeholder="Enter name of vehicle" value="{{ old('name_of_vehicle') }}" >
                      @error('name_of_vehicle')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                    </div>
      
                    <div class="col-md-3 mb-3">
                      <label class="form-expand" for="type_of_vehicle">Type of Vehicle:</label>
                      <input type="text" class="form-control placeholder-text @error('type_of_vehicle') is-invalid @enderror" name="type_of_vehicle" id="unitPriceInput" placeholder="Enter type of vehicle" value="{{ old('type_of_vehicle') }}" >
                      @error('type_of_vehicle')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                    </div>
      
                    <div class="col-md-3 mb-3">
                      <label class="form-expand" for="total_transport_per_deliverycost">Total Transport/DeliveryCost:</label>
                      <input type="text" class="form-control placeholder-text @error('total_transport_per_deliverycost') is-invalid @enderror" name="total_transport_per_deliverycost" id="totalLaborCostInput" placeholder="Enter total transport cost" value="{{ old('total_transport_per_deliverycost') }}" >
                      @error('total_transport_per_deliverycost')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                    </div>
                  </div>
      
                 
         <div  class="d-grid gap-2 d-md-flex justify-content-md-end">
            {{-- <a  href="{{route('production_data.index')}}"button  class="btn btn-success me-md-2">Back</button></a></p> --}}
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
        
        </div>@endsection