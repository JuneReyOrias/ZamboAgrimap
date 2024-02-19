@extends('agent.agent_Dashboard')
@section('agent') 
<div class="page-content">

    <nav class="page-breadcrumb">
  
    </nav>
   
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          
          <div class="card-body">
            @if (session('message'))
            <div class="alert alert-success" role="alert">
              {{ session('message')}}
            </div>
               
            @endif
            <h6 class="card-title"><span>I.</span>Personal Information</h6>
  
           <p class="text-muted mb-3">Read the <a href="https://github.com/RobinHerbots/Inputmask" target="_blank"> Official Inputmask Documentation </a>for a full list of instructions and other options.</p>
           <div class="table-responsive tab ">
            <table class="table table table-info">
                <thead class="thead-light">
                    <tr >
                        <th>Farmer No.</th>
                        <th>FirtsName</th>
                        <th>MiddleName</th>
                        <th>LastName</th>
                        <th>ExtentionName</th>
                        <th>Home Address</th>
                        <th>Sex</th>
                        <th>Religion</th>
                        <th>date_of_birth</th>
                        <th>place_of_birth</th>
                        <th>contact no.</th>
                        <th>civil_status</th>
                        <th>name of legal spuse</th>
                        <th>mothers_maiden_name</th>
                        <th>highest_formal_education</th>
                        <th>person_with_disability</th>
                        <th>pwd_id_no</th>
                        <th>government_issued_id</th>
                        <th>id_type</th>
                        <th>gov_id_no</th>
                        <th>member_ofany_farmers_ass_org_coop</th>
                        <th>nameof_farmers_ass_org_coop</th>
                        <th>name_contact_person</th>
                        <th>cp_tel_no</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($personalInformations->count() > 0)
                @foreach($personalInformations as $personalInformations)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                        <td>{{ $personalInformations->first_name }}</td>
                        <td>{{ $personalInformations->middle_name }}</td>
                        <td>{{ $personalInformations->last_name }}</td>
                        <td>{{ $personalInformations->extension_name }}</td>
                        <td>{{ $personalInformations->home_address}}</td>
                        <td>{{ $personalInformations->sex }}</td>
                        <td>{{ $personalInformations->religion }}</td>
                        <td>{{ $personalInformations->date_of_birth }}</td>
                        <td>{{ $personalInformations->place_of_birth}}</td>
                        <td>{{ $personalInformations->contact_no }}</td>
                        <td>{{ $personalInformations->civil_status }}</td>
                        <td>{{ $personalInformations->name_legal_spouse }}</td>
                        <td>{{ $personalInformations->no_of_children }}</td>
                        <td>{{ $personalInformations->mothers_maiden_name }}</td>
                        <td>{{ $personalInformations->highest_formal_education }}</td>
                        <td>{{ $personalInformations->person_with_disability}}</td>
                        <td>{{ $personalInformations->government_issued_id }}</td>
                        <td>{{ $personalInformations->id_type }}</td>
                        <td>{{ $personalInformations->gov_id_no }}</td>
                        <td>{{ $personalInformations->member_ofany_farmers_ass_org_coop }}</td>
                        <td>{{ $personalInformations->nameof_farmers_ass_org_coop }}</td>
                        <td>{{ $personalInformations->name_contact_person }}</td>
                        <td>{{ $personalInformations->cp_tel_no }}</td>
                        
  
                        <td>
                           
                             <a href="{{route('personalinfo.edit', $personalInformations->farmer_no)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                
                             <form  action="{{ route('personalinfo.destroy', $personalInformations->farmer_no) }}"method="post" accept-charset="UTF-8" style="display:inline">
                                {{ csrf_field()}}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                            {{-- <div class="col-sm">
                                <form action="{{ route('personalinfo.destroy', $personalInformations->id) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div> --}}
                        </td>
                    </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="5">Personal Informations not found</td>
                </tr>
            @endif
                </tbody>
            </table>
        </div>
  
   
          </div>
        </div>
      </div>
    </div>
</div>
</div>
</div>

</div>

</div>@endsection