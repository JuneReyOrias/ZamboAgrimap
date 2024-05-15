@extends('user.user_dashboard')

@section('user')

@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content" style="user-select: none;
-moz-user-select: none;
-khtml-user-select: none;
-webkit-user-select: none;
-o-user-select: none;">

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
        <h4 class="mb-3 mb-md-0 font-weight-bold">Rice Variety Farmer Planted</h4>
        
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
                @foreach($InbredInfo as $district => $varieties)
                <button class="btn btn-primary mx-2 my-2" onclick="showSection('{{ strtoupper($district) }}')">{{ strtoupper($district) }}</button>
                @endforeach
            </div>
        </div>
    </div>
    <br>

    @foreach($InbredInfo as $district => $varieties)
    <div id="{{ strtoupper($district) }}_section" class="table-section">
        <br>
        <div class="card border rounded">
            <div class="card-body">
                <h4 class="mb-3 mb-md-0">{{ strtoupper($district) }} Rice Variety </h4>
                <div class="table-responsive tab">
                    <table class="table table-bordered datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Rice Variety</th>
                                <th>No. of Farmers</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($varieties as $variety => $data)
                            <tr class="table-light">
                                <td>
                                    @if (strtolower($variety) === 'n/a' || strtolower($variety) === 'na')
                                        {{ isset($data['prefered_variety']) ? $data['prefered_variety'] : 'N/A' }}
                                    @else
                                        {{ $variety }}
                                    @endif
                                </td>
                                <td>{{ $data['count'] }}</td>
                                <td>{{ $data['percentage'] }}%</td>
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
            <h4> Rice Variety per District (Bar Chart)</h4>
        </div>
        <div class="card-body">
            <div id="barChartContainer">
                <canvas id="barChart"></canvas>
            </div>
        
        </div>
    </div>
</div>

{{-- <script>
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
        window.print();
    }

    function printDataPerDistrict() {
        // Hide all sections
        document.querySelectorAll('[id$="_section"]').forEach(section => {
            section.style.display = 'none';
        });

        // Print each district's data
        document.querySelectorAll('[id$="_section"]').forEach(section => {
            section.style.display = 'block';
            window.print();
            section.style.display = 'none';
        });
    }
</script> --}}
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
<!-- JavaScript for bar chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for the bar chart
    const districtLabels = {!! json_encode(array_keys($InbredInfo)) !!};
    const varietyData = {!! json_encode(array_map(function($varieties) {
        return array_map(function($data) {
            return $data['count'];
        }, $varieties);
    }, $InbredInfo)) !!};
    const varietyLabels = {!! json_encode(array_keys($InbredInfo[array_key_first($InbredInfo)])) !!};
    
    // Define colors for each variety
    const varietyColors = [
        'rgba(255, 99, 132, 0.6)',   // Red
        'rgba(54, 162, 235, 0.6)',   // Blue
        'rgba(255, 205, 86, 0.6)',   // Yellow
        // Add more colors as needed
    ];

    // Bar chart configuration
    const config = {
        type: 'bar',
        data: {
            labels: varietyLabels,
            datasets: districtLabels.map((district, index) => ({
                label: district,
                data: varietyData[index],
                backgroundColor: varietyLabels.map((variety, varietyIndex) => 
                    (varietyIndex < varietyColors.length) ? varietyColors[varietyIndex] : getRandomColor()), 
                borderColor: 'rgba(0, 0, 0, 0.6)', // Border color
                borderWidth: 1
            }))
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

    // Function to generate a random color (if needed for additional varieties)
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>



@endsection
