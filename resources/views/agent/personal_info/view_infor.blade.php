
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
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
               
            @endif
            <h6 class="card-title"><span>I.</span>Personal Information</h6>
  
         <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
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
                  @if($personalinformations->count() > 0)
                @foreach($personalinformations as $personalinformation)
                    <tr class="table-light">
                         <td>{{ $loop->iteration }}</td>
                        <td>{{  $personalinformation->first_name }}</td>
                        <td>{{  $personalinformation->middle_name }}</td>
                        <td>{{  $personalinformation->last_name }}</td>
                        <td>{{  $personalinformation->extension_name }}</td>
                        <td>{{  $personalinformation->home_address}}</td>
                        <td>{{  $personalinformation->sex }}</td>
                        <td>{{  $personalinformation->religion }}</td>
                        <td>{{  $personalinformation->date_of_birth }}</td>
                        <td>{{  $personalinformation->place_of_birth}}</td>
                        <td>{{  $personalinformation->contact_no }}</td>
                        <td>{{  $personalinformation->civil_status }}</td>
                        <td>{{  $personalinformation->name_legal_spouse }}</td>
                        <td>{{  $personalinformation->no_of_children }}</td>
                        <td>{{  $personalinformation->mothers_maiden_name }}</td>
                        <td>{{  $personalinformation->highest_formal_education }}</td>
                        <td>{{  $personalinformation->person_with_disability}}</td>
                        <td>{{  $personalinformation->government_issued_id }}</td>
                        <td>{{  $personalinformation->id_type }}</td>
                        <td>{{  $personalinformation->gov_id_no }}</td>
                        <td>{{  $personalinformation->member_ofany_farmers_ass_org_coop }}</td>
                        <td>{{  $personalinformation->nameof_farmers_ass_org_coop }}</td>
                        <td>{{  $personalinformation->name_contact_person }}</td>
                        <td>{{  $personalinformation->cp_tel_no }}</td>
                        
  
                        <td>
                           
                             <a href="{{route('agent.personal_info.update_records',  $personalinformation->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
                  <form  action="{{ route('agent.personal_info.delete', $personalinformation->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                    @csrf
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                           
                            </form>
                            {{-- <div class="col-sm">
                                <form action="{{ route('personalinfo.destroy', $personalinformation->id) }}" method="post">
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
      <!-- Pagination links -->
      <div class="row"style="align-content: center;display: flex;
      align-items: center; align-self: center">
          <div class="col-md-7" style="align-content: center;display: flex;
          align-items: center;">
              {{ $personalinformations->links() }}
          </div>
      </div>
</div>
</div>
</div>
</div>

</div>

</div>@endsection