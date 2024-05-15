@extends('agent.agent_Dashboard')
@section('agent') 
@extends('layouts._footer-script')
@extends('layouts._head')


<div class="page-content">
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    
                    <h2>Rice Farmer Variable Cost</h2>
                </div>
                <br>
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

                    <!-- Your card content here -->
                    <div class="tabs">
                        <input type="radio" name="tabs" id="Seed" checked="checked">
                        <label for="Seed">Seeds</label>
                        <div class="tab">
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5 for="Seed">a. Seeds</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                               <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light" >
                                        <tr>
                                            <th>seeds id.</th>
                                            <th>Seed Name.</th>
                                            <th>seed type</th>
                                            <th>unit</th>
                                            <th>quantity</th>
                                            <th>unit price</th>
                                            <th>total seed <p>cost</p></th>
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($seeds->count() > 0)
                                        @foreach($seeds as $seed)
                                        <tr class="table-light">
                                            <td>{{$seed->id}}</td>
                                            <td>
                                                @if ($seed->seed_name && strtolower($seed->seed_name) != 'n/a')
                                                    {{$seed->seed_name }}
                                                @else
                                                
                                                @endif
                                            </td>
                                              <td>
                                                @if ($seed->seed_type&& strtolower($seed->seed_type) != 'n/a')
                                                    {{$seed->seed_type }}
                                                @else
                                                
                                                @endif
                                            </td>
                                            <td>
                                                @if ($seed->unit&& strtolower($seed->unit) != 'n/a')
                                                    {{$seed->unit }}
                                                @else
                                                
                                                @endif
                                            </td>
                                            <td>
                                                @if ($seed->quantity&& strtolower($seed->quantity) != 'n/a')
                                                    {{$seed->quantity }}
                                                @else
                                                
                                                @endif
                                            </td>
                                            <td>
                                                @if ($seed->unit_price&& strtolower($seed->unit_price) != 'n/a')
                                                    {{number_format($seed->unit_price,2)}}
                                                @else
                                                
                                                @endif
                                            </td>
                                            <td>
                                                @if ($seed->total_seed_cost&& strtolower($seed->total_seed_cost) != 'n/a')
                                                    {{number_format($seed->total_seed_cost,2)}}
                                                @else
                                                
                                                @endif
                                            </td>
                                          
                                            
                                        
                                           

                                            <td>
                                                <a href="{{route('agent.variablecost.seed.seeds_form_edit', $seed->id)}}"
                                                    title="Edit"><button class="btn btn-primary btn-sm"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit</button></a>

                                                <form action="{{ route('agent.variablecost.seed.delete', $seed->id) }}"
                                                    method="post" accept-charset="UTF-8" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                </form>

                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Seed Cost is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        {{-- labor --}}
                        <input type="radio" name="tabs" id="labors" checked="checked">
                        <label for="labors">Labor</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5>b. Labor</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr >
                                           
                                            <th>#</th>
                                            <th>No. OF PERSON</th>
                                            <th>rate/person</th>
                                            <th>total labor cost</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($labors->count() > 0)
                                    @foreach($labors as $labor)
                                        <tr class="table-light">
                                             {{-- <td>{{ $loop->iteration }}</td> --}}
                                             <td>{{$labor->id}}</td>
                                             <td>
                                                @if ($labor->no_of_person && strtolower($labor->no_of_person) != 'n/a')
                                                    {{$labor->no_of_person }}
                                                @else
                                                
                                                @endif
                                            </td>


                                            <td>
                                                @if ($labor->rate_per_person && strtolower($labor->rate_per_person) != 'n/a')
                                                    {{number_format($labor->rate_per_person,2) }}
                                                @else
                                                
                                                @endif
                                            </td>
                                            <td>
                                                @if ($labor->total_labor_cost && strtolower($labor->total_labor_cost) != 'n/a')
                                                    {{number_format($labor->total_labor_cost,2) }}
                                                @else
                                                
                                                @endif
                                            </td>
                                           
                                           
                              
                                            
                      
                                            <td>
                                                  <a href="{{route('agent.variablecost.labor.formEdit_labors',  $labor->id)}}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                
                                             <form  action="{{ route('agent.variablecost.labor.delete', $labor->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                            @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form> 
                                            
                                        </td>
                                    </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Labor Cost is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- fertilizer --}}
                        {{-- labor --}}
                        <input type="radio" name="tabs" id="Fertilizer" checked="checked">
                        <label for="Fertilizer">Fertilizer</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5 for="Seed">c. Fertilizer</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr >
                                           
                                            <th>#</th>
                                            <th>name of fertilizers</th>
                                            <th>type of fertilizer</th>
                                            <th>no of <p>sacks</p></th>
                                            <th>unit <p>price/sacks</p></th>
                                            <th>total cost <p>fertilizers</p></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($fertilizers->count() > 0)
                                    @foreach($fertilizers as $fertilizer)
                                        <tr class="table-light">
                                             
                                             <td>{{$fertilizer->id}}</td>
                                             <td>
                                                @if ($fertilizer->name_of_fertilizer && strtolower($fertilizer->name_of_fertilizer) != 'n/a')
                                                    {{$fertilizer->name_of_fertilizer }}
                                                @else
                                                
                                                @endif
                                                </td>
                                                <td>
                                                    @if ($fertilizer->type_of_fertilizer && strtolower($fertilizer->type_of_fertilizer) != 'n/a')
                                                        {{$fertilizer->type_of_fertilizer }}
                                                    @else
                                                    
                                                    @endif
                                                    </td>
                                                    <td>
                                                        @if ($fertilizer->no_ofsacks && strtolower($fertilizer->no_ofsacks) != 'n/a')
                                                            {{$fertilizer->no_ofsacks }}
                                                        @else
                                                        
                                                        @endif
                                                        </td>
                                                        <td>
                                                            @if ($fertilizer->unitprice_per_sacks && strtolower($fertilizer->unitprice_per_sacks) != 'n/a')
                                                                {{number_format($fertilizer->unitprice_per_sacks,2) }}
                                                            @else
                                                            
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($fertilizer->total_cost_fertilizers && strtolower($fertilizer->total_cost_fertilizers) != 'n/a')
                                                                {{number_format($fertilizer->total_cost_fertilizers,2) }}
                                                            @else
                                                            
                                                            @endif
                                                        </td>
                                        
                                            <td>
                                                  <a href="{{route('agent.variablecost.fertilizers.formsEdit_fertilizeData',  $fertilizer->id)}}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                
                                             <form  action="{{ route('agent.variablecost.fertilizers.delete', $fertilizer->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                            @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form> 
                                            
                                        </td>
                                    </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Fertilizer Cost is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- pesticides --}}
                        {{-- labor --}}
                        <input type="radio" name="tabs" id="Pesticide" checked="checked">
                        <label for="Pesticide">Pesticide</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5 for="Seed">d. Pesticide</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr >
                                            
                                            <th>#</th>
                                            <th>Pesticide Name.</th>
                                            <th>type of pesticide</th>
                                            <th>no. of <p>l or kg</p></th>
                                            <th>unit price <p>of pesticides</p></th>
                                            <th>total cost <p>of pesticides</p></th>
                                            
                            
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($pesticides->count() > 0)
                                    @foreach($pesticides as $pesticide)
                                        <tr class="table-light">
                                             {{-- <td>{{ $loop->iteration }}</td> --}}
                                             <td>{{$pesticide->id}}</td>
                                             <td>
                                                @if ($pesticide->pesticides_name && strtolower($pesticide->pesticides_name) != 'n/a')
                                                    {{$pesticide->pesticides_name }}
                                                @else
                                                
                                                @endif
                                                </td>

                                                <td>
                                                    @if ($pesticide->type_ofpesticides && strtolower($pesticide->type_ofpesticides) != 'n/a')
                                                        {{$pesticide->type_ofpesticides }}
                                                    @else
                                                    
                                                    @endif
                                                    </td>
                                                    <td>
                                                        @if ($pesticide->no_of_l_kg && strtolower($pesticide->no_of_l_kg) != 'n/a')
                                                            {{$pesticide->no_of_l_kg }}
                                                        @else
                                                        
                                                        @endif
                                                        </td>
                                            
                                                        <td>
                                                            @if ($pesticide->unitprice_ofpesticides && strtolower($pesticide->unitprice_ofpesticides) != 'n/a')
                                                                {{$pesticide->unitprice_ofpesticides }}
                                                            @else
                                                            
                                                            @endif
                                                            </td>
                                                            <td>
                                                                @if ($pesticide->total_cost_pesticides && strtolower($pesticide->total_cost_pesticides) != 'n/a')
                                                                    {{$pesticide->total_cost_pesticides }}
                                                                @else
                                                                
                                                                @endif
                                                                </td>
                                          
                                           
                                            
                                            
                      
                                            <td>
                                               
                                                 <a href="{{route('agent.variablecost.pesticides.formsEdit_pesticidesData',  $pesticide->id)}}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                    
                                                 <form  action="{{ route('agent.variablecost.pesticides.delete', $pesticide->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                </form> 
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Pesticide Cost is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- transport --}}
                        {{-- labor --}}
                        <input type="radio" name="tabs" id="Transport" checked="checked">
                        <label for="Transport">Transport</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5 for="Seed">e. Transport</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr >
                                           
                                            <th>#</th>
                                            <th>name of <p> vehicle</p></th>
                                            <th>type of<p> vehicle</p></th>
                                            <th>total transport <p>/delivery cost</p></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($transports->count() > 0)
                                    @foreach($transports as $transport)
                                        <tr class="table-light">
                                             
                                             <td>{{$transport->id}}</td>
                                             <td>
                                                @if ($transport->name_of_vehicle && strtolower($transport->name_of_vehicle) != 'n/a')
                                                    {{$transport->name_of_vehicle }}
                                                @else
                                                
                                                @endif
                                                </td>
                                                <td>
                                                    @if ($transport->type_of_vehicle && strtolower($transport->type_of_vehicle) != 'n/a')
                                                        {{$transport->type_of_vehicle }}
                                                    @else
                                                    
                                                    @endif
                                                    </td>
                                                    <td>
                                                        @if ($transport->total_transport_per_deliverycost && strtolower($transport->total_transport_per_deliverycost) != 'n/a')
                                                            {{number_format($transport->total_transport_per_deliverycost,2) }}
                                                        @else
                                                        
                                                        @endif
                                                        </td>

                                            <td>
                                               
                                                 <a href="{{route('agent.variablecost.transport.formsEdit_transportsData',  $transport->id)}}" title="Edit "><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                                    
                                                 <form  action="{{ route('agent.variablecost.transport.delete', $transport->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete " onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                </form> 
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Transport Cost is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <!-- Pagination links -->
                            <ul class="pagination">
                                <li><a href="{{ $variable->previousPageUrl() }}">Previous</a></li>
                                @foreach ($variable->getUrlRange(1,$variable->lastPage()) as $page => $url)
                                    <li class="{{ $page == $variable->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ $variable->nextPageUrl() }}">Next</a></li>
                            </ul>
                        </div>
                        {{-- total Variable cost --}}
                        {{-- labor --}}
                        <input type="radio" name="tabs" id="total" checked="checked">
                        <label for="total">Total Variable Cost</label>
                        <div class="tab">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group mb-3">
                                    <h5 for="Seed">f. Total Variable Cost</h5>
                                </div>
                                <form id="farmProfileSearchForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </div>
                                </form>
                                <form id="showAllForm" action="{{ route('variable_cost.seeds.view') }}" method="GET">
                                    <button class="btn btn-outline-success" type="submit">All</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <!-- Table content here -->
                                    <thead class="thead-light">
                                        <tr >
                    
                                            <th>#</th>
                                            <th>Farmer Name</th>
                                            <th>Tenurial <p> Status</p></th>
                                            <th>seed cost</th>
                                            <th>labor <p>cost</p></th>
                                            <th>fertilizer<p>cost</p></th>
                                            <th>pesticides<p>cost</p></th>
                                            <th>transport<p>cost</p></th>
                                            <th>total machinery <p>/delivery cost</p> </th>
                                            <th>total variable <p> cost</p></th>
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($variable->count() > 0)
                                    @foreach($variable as $vartotal)      
                                <tr class="table-light">
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{  $vartotal->id }}</td>
                                    <td>
                                        @if (optional($vartotal->personalinformation)->first_name && $vartotal->personalinformation->first_name != 'N/A' && $vartotal->personalinformation->first_name != 'NULL')
                                            {{ $vartotal->personalinformation->first_name }}
                                        @else
                                           
                                        @endif
                                    
                                        @if (optional($vartotal->personalinformation)->last_name && $vartotal->personalinformation->last_name != 'N/A' && $vartotal->personalinformation->last_name != 'NULL')
                                            {{ $vartotal->personalinformation->last_name }}
                                        @else
                                        
                                        @endif
                                    
                                        @if (optional($vartotal->personalinformation)->extension_name && $vartotal->personalinformation->extension_name != 'N/A' && $vartotal->personalinformation->extension_name != 'NULL')
                                            {{ $vartotal->personalinformation->extension_name }}
                                        @else
                                       
                                        @endif
                                    </td>
                                    
                                    
                                    
                                    <td>
                                        @if (optional($vartotal->farmprofile)->tenurial_status && strtolower($vartotal->farmprofile->tenurial_status) != 'N/A')
                                            {{ $vartotal->farmprofile->tenurial_status}}
                                        @else
                                         
                                        @endif
                                      </td>


                                    <td>
                                        @if ($vartotal->seeds->total_seed_cost && strtolower($vartotal->seeds->total_seed_cost) != 'n/a')
                                            {{ number_format($vartotal->seeds->total_seed_cost,2) }}
                                        @else
                                        
                                        @endif
                                        </td>
                                        <td>
                                            @if ($vartotal->labors->total_labor_cost && strtolower($vartotal->labors->total_labor_cost) != 'n/a')
                                                {{ number_format($vartotal->labors->total_labor_cost,2) }}
                                            @else
                                            
                                            @endif
                                            </td>
                                            <td>
                                                @if ($vartotal->fertilizers->total_cost_fertilizers && strtolower($vartotal->fertilizers->total_cost_fertilizers) != 'n/a')
                                                    {{ number_format($vartotal->fertilizers->total_cost_fertilizers,2) }}
                                                @else
                                                
                                                @endif
                                                </td>
                                                <td>
                                                    @if ($vartotal->pesticides->total_cost_pesticides && strtolower($vartotal->pesticides->total_cost_pesticides) != 'n/a')
                                                        {{ number_format($vartotal->pesticides->total_cost_pesticides,2) }}
                                                    @else
                                                    
                                                    @endif
                                                    </td>
                                                    <td>
                                                        @if ($vartotal->transports->total_transport_per_deliverycost && strtolower($vartotal->transports->total_transport_per_deliverycost) != 'n/a')
                                                            {{ number_format($vartotal->transports->total_transport_per_deliverycost,2) }}
                                                        @else
                                                        
                                                        @endif
                                                        </td>
                                                        <td>
                                                            @if ($vartotal->total_machinery_fuel_cost && strtolower($vartotal->total_machinery_fuel_cost) != 'n/a')
                                                                {{ number_format($vartotal->total_machinery_fuel_cost,2) }}
                                                            @else
                                                            
                                                            @endif
                                                            </td>
                                                            <td>
                                                                @if ($vartotal->total_variable_cost && strtolower($vartotal->total_variable_cost) != 'n/a')
                                                                    {{ number_format($vartotal->total_variable_cost,2) }}
                                                             @else
                                                                
                                                         @endif
                                                    </td>
 
                                                <td>
                                                    
                                                    <a href="{{route('agent.variablecost.variable_total.var_edited',  $vartotal->id)}}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                                                    <form  action="{{ route('agent.variablecost.variable_total.delete', $vartotal->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                                   @csrf
                                                       @method('DELETE')
                                                       <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                   </form> 
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Variable Cost Data is empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <br>
                                <!-- Pagination links -->
                                <ul class="pagination">
                                    <li><a href="{{ $variable->previousPageUrl() }}">Previous</a></li>
                                    @foreach ($variable->getUrlRange(1,$variable->lastPage()) as $page => $url)
                                        <li class="{{ $page == $variable->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ $variable->nextPageUrl() }}">Next</a></li>
                                </ul>
                        </div>
                        <!-- Repeat the same structure for other tabs -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('searchInput');
        const farmProfileSearchForm = document.getElementById('farmProfileSearchForm');
        const showAllForm = document.getElementById('showAllForm');
  
        let timer;
  
        // Add event listener for search input
        searchInput.addEventListener('input', function() {
            // Clear previous timer
            clearTimeout(timer);
            // Start new timer with a delay of 500 milliseconds (adjust as needed)
            timer = setTimeout(function() {
                // Submit the search form
                farmProfileSearchForm.submit();
            }, 1000);
        });
  
        // Add event listener for "Show All" button
        showAllForm.addEventListener('click', function(event) {
            // Prevent default form submission behavior
            event.preventDefault();
            // Remove search query from input field
            searchInput.value = '';
            // Submit the form
            showAllForm.submit();
        });
    });
  </script>
@endsection
