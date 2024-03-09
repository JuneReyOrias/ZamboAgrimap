@extends('agent.agent_Dashboard')
@section('agent') 
<style>
  /* Custom CSS for small screens */
  @media only screen and (max-width: 320px) {
      .table-responsive.tab table {
          font-size: 12px; /* Decrease font size for smaller screens */
      }

      .table-responsive.tab table th,
      .table-responsive.tab table td {
          padding: 2px; /* Adjust cell padding */
      }
  }
</style>

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
            <h6 class="card-title">Farmers Rice Productions</h6>
            <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         
            <div class="table-responsive tab">
                <table class="table table-info table-responsive">
                    <thead class="thead-light">
                        <tr>
                            <th>Farmer No.</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Tenurial Status</th>
                            <th>Total Fixed Cost</th>
                            <th>Total Cost for Machineries</th>
                            <th>Total Seed Cost</th>
                            <th>Total Cost Fertilizers</th>
                            <th>Total Labor Cost</th>
                            <th>Total Cost Pesticides</th>
                            <th>Total Transport per Delivery Cost</th>
                            <th>Total Machinery Fuel Cost</th>
                            <th>Gross Income Palay</th>
                            <th>Gross Income Rice</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($allfarmers->count() > 0)
                            @foreach($allfarmers->sortByDesc('id') as $allfarmer)
                                <tr class="table-light">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $allfarmer->last_name }}</td>
                                    <td>{{ $allfarmer->first_name }}</td>
                                    <td>{{ $allfarmer->middle_name }}</td>
                                    <td>{{ $allfarmer->tenurial_status }}</td>
                                    <td>{{ $allfarmer->total_amount }}</td>
                                    <td>{{ $allfarmer->total_cost_for_machineries }}</td>
                                    <td>{{ $allfarmer->total_seed_cost }}</td>
                                    <td>{{ $allfarmer->total_cost_fertilizers }}</td>
                                    <td>{{ $allfarmer->total_labor_cost }}</td>
                                    <td>{{ $allfarmer->total_cost_pesticides }}</td>
                                    <td>{{ $allfarmer->total_transport_per_deliverycost }}</td>
                                    <td>{{ $allfarmer->total_machinery_fuel_cost }}</td>
                                    <td>{{ $allfarmer->gross_income_palay }}</td>
                                    <td>{{ $allfarmer->gross_income_rice }}</td>
                                    <td>
                                        {{-- Add your action buttons here --}}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="16">Personal Information not found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            <div class="row" style="align-content: center;display: flex;align-items: center;align-self: center;">
                <div class="col-md-7" style="align-content: center;display: flex;align-items: center;">
                    {{ $allfarmers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

</div>

</div>
@endsection
