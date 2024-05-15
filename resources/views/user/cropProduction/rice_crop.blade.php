@extends('user.user_Dashboard')

@section('user')

@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content">

    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

 
    <div class="dropdown d-flex flex-wrap justify-content-between align-items-center"  style="user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
    -o-user-select: none;">
        <h4 class="mb-3 mb-md-0 font-weight-bold">Farmer Rice Production</h4>
        
        <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
            <!--<span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>-->
            <!--<input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>-->
        </div>
       
        <button type="button" class="btn btn-primary btn-icon-text me-2 mb-2 mb-md-0 hide-on-print" onclick="printAllData()" data-toggle="popover" title="Print All Data" data-content="Click to print all data from all districts.">
            <i class="btn-icon-prepend" data-feather="printer"></i>
            Print All Data
        </button>
        <button type="button" class="btn btn-primary btn-icon-text me-2 mb-2 mb-md-0 hide-on-print" onclick="printDataPerDistrict()" data-toggle="popover" title="Print Data Per District" data-content="Click to print data per district.">
            <i class="btn-icon-prepend" data-feather="printer"></i>
            Print Data Per District
        </button>
        
        <div class="btn-group hide-on-print">
            <button class="btn btn-primary dropdown-toggle dropdown-success" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Agri-District
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <button class="btn btn-primary mx-2 my-2" onclick="showAllSections()">View All</button>
                @foreach($riceProductionSchedule as $district => $farmers)
                <button class="btn btn-primary mx-2 my-2" onclick="showSection('{{ strtoupper($district) }}')">{{ strtoupper($district) }}</button>
                @endforeach
            </div>
        </div>
    </div>
    <br>
    {{-- <h2>Total Rice Production per District</h2>
    <ul>
        @foreach($totalRiceProductionPerDistrict as $district => $totalProduction)
            <li>{{ $district }}: {{ $totalProduction }} tons</li>
        @endforeach
    </ul> --}}

    @foreach($riceProductionSchedule as $district => $farmers)
    {{-- <h4 class="mb-3 mb-md-0">{{ $district }} Rice Farmers Info</h4> --}}

    <div id="{{ strtoupper($district) }}_section" class="table-section">
        <br>
        <div class="card border rounded">
            <div class="card-body">
                <h4 class="mb-3 mb-md-0">{{ strtoupper($district) }} Rice Crop Production</h4>

                <div class="table-responsive tab">
                    <table class="table table-bordered datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Farmer <p>Name</p></th>
                                <th>Date <p>planted</p></th>
                                <th>Date <p>Harvest</p></th>
                                <th>Yield <p>(tons/kg)</p></th>
                                <th>Unit price <p>palay/kg</p></th>
                                <th>Unit price <p>rice/kg</p></th>
                                <th>Gross <p>income</p> <p>palay</p></th>
                                <th>Gross <p>income</p> <p>rice</p></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($farmers as $farmer)
                            <tr class="table-light">
                                <td>{{ $farmer['first_name'].' '.$farmer['last_name'] }}</td>
                                <td>{{ $farmer['date_planted'] }}</td>
                                <td>{{ $farmer['date_harvested'] }}</td>
                                <td>{{ $farmer['yield_tons_per_kg'] }}</td>
                                <td>{{ $farmer['unit_price_palay_per_kg'] }}</td>
                                <td>{{ $farmer['unit_price_rice_per_kg'] }}</td>
                                <td>{{ $farmer['gross_income_palay'] }}</td>
                                <td>{{ $farmer['gross_income_rice'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
         

              
                
            </div>
     
        </div>

        
    </div>
    @endforeach
    <div class="card mt-4">
        <div class="card-header">
            <h4>Total Rice Production per District (Bar Chart)</h4>
        </div>
        <div class="card-body">
            <div id="barChartContainer">
                <canvas id="barChart"></canvas>
            </div>
        
        </div>
    </div>

</div>

<script>
function showAllSections() {
        // Show all sections
        document.querySelectorAll('[id$="_section"]').forEach(section => {
            section.style.display = 'block';
        });
    }

    function showSection(sectionName) {
        // Hide all sections
        document.querySelectorAll('[id$="_section"]').forEach(section => {
            section.style.display = 'none';
        });

        // Show the selected section
        document.getElementById(sectionName + '_section').style.display = 'block';
    }
</script>
<script>
    function showAllSections() {
        // Show all sections
        document.querySelectorAll('[id$="_section"]').forEach(section => {
            section.style.display = 'block';
        });
    }

    function showSection(sectionName) {
        // Hide all sections
        document.querySelectorAll('[id$="_section"]').forEach(section => {
            section.style.display = 'none';
        });

        // Show the selected section
        document.getElementById(sectionName + '_section').style.display = 'block';
    }

    function printAllData() {
        // Hide navbar and buttons before printing
        document.querySelector('.navbar').style.display = 'none';
        document.querySelectorAll('.hide-on-print').forEach(button => {
            button.style.display = 'none';
        });

        // Add title and date
        document.title = 'Rice Variety Report';
        const date = new Date().toLocaleDateString();
        const title = document.createElement('h1');
        title.innerText = 'Rice Variety Report - ' + date;
        document.body.insertBefore(title, document.body.firstChild);

        // Print
        window.print();

        // Show navbar and buttons after printing
        document.querySelector('.navbar').style.display = 'block';
        document.querySelectorAll('.hide-on-print').forEach(button => {
            button.style.display = 'block';
        });

        // Remove added title
        title.remove();
        // Restore original title
        document.title = 'Your original title here';
    }

    function printDataPerDistrict() {
        // Hide all sections
        document.querySelectorAll('[id$="_section"]').forEach(section => {
            section.style.display = 'none';
        });

        // Hide navbar and buttons before printing
        document.querySelector('.navbar').style.display = 'none';
        document.querySelectorAll('.hide-on-print').forEach(button => {
            button.style.display = 'none';
        });

        // Print each district's data
        document.querySelectorAll('[id$="_section"]').forEach(section => {
            section.style.display = 'block';

            // Add title and date for each section
            document.title = 'Rice Variety Report';
            const date = new Date().toLocaleDateString();
            const title = document.createElement('h1');
            title.innerText = 'Rice Variety Report - ' + date;
            document.body.insertBefore(title, document.body.firstChild);

            // Print
            window.print();

            // Remove added title
            title.remove();

            section.style.display = 'none';
        });

        // Show navbar and buttons after printing
        document.querySelector('.navbar').style.display = 'block';
        document.querySelectorAll('.hide-on-print').forEach(button => {
            button.style.display = 'block';
        });
    }


</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for the bar chart
    const districtLabels = {!! json_encode(array_keys($totalRiceProductionPerDistrict)) !!};
    const districtProduction = {!! json_encode(array_values($totalRiceProductionPerDistrict)) !!};

    // Define an array of colors for each district
    const districtColors = [
        'rgba(255, 99, 132, 0.6)',   // Red
        'rgba(54, 162, 235, 0.6)',   // Blue
        'rgba(255, 205, 86, 0.6)',   // Yellow
        // Add more colors as needed
    ];

    // Bar chart configuration
    const config = {
        type: 'bar',
        data: {
            labels: districtLabels,
            datasets: [{
                label: 'Total Rice Production (tons)',
                data: districtProduction,
                backgroundColor: districtColors,
                borderColor: districtColors.map(color => color.replace('0.6', '1')), // Use the same color but with full opacity for border
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Create the bar chart
    const ctx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(ctx, config);
</script>




    

@endsection
