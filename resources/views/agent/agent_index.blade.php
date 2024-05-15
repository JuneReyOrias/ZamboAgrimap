@extends('agent.agent_Dashboard')

@section('agent')

<div class="page-content">
 
  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  
    <div>
      <h4 class="mb-3 mb-md-0 " style="font-size: 19px;align-items:center;"> Zamboanga City Rice Industry Dashboard</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      {{-- <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
        <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
        <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
      </div> --}}
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0 hide-on-print" onclick="printReport()">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>

      {{-- <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
        <i class="btn-icon-prepend" data-feather="download-cloud"></i>
        Download Report
      </button> --}}
    </div>
 
   
  </div>

  <div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow-1">
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Numbers of Farms</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                   
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($totalfarms, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+3.3%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                  <div id="totalFarmsChart" class="mt-md-3 mt-xl-0"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Area PLanted</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($totalAreaPlanted, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-danger">
                      <span>-2.8%</span>
                      <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Area Yield(Kg/Ha)</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                   
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($totalAreaYield, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+2.8%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- row -->
  

  <div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow-1">
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Cost</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($totalCost, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+3.3%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Average  Yield  Per Area Planted (Kg/Ha)</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                   
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($yieldPerAreaPlanted, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-danger">
                      <span>-2.8%</span>
                      <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Average Cost Per Area Planted(Ha)</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-1">{{ number_format($averageCostPerAreaPlanted, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+2.8%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
              
            </div>
          </div>
        </div>

        
      
      </div>
    </div>
  </div> <!-- row -->
      

  <div class="row">
    <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-baseline mb-2">
            <h6 class="card-title mb-0">Famers Yearly sales</h6>
            <div class="dropdown mb-2">
              <a type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
              
                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
              </div>
            </div>
          </div>
          
          <div id="monthlySalesChart"></div>
        </div> 
      </div>
    </div>
    <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Rice Production Chart</h6>
              </div>
              <div id="storageChart"></div>
          </div>
      </div>
  </div>

  
  </div>  

      </div>
    </div>
  </div> <!-- row -->
<div class="production" ></div>

<script>
function printReport() {
    // Apply print styles
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '{{ asset('css/print.css') }}';
    document.head.appendChild(link);

    // Get current date
    var currentDate = new Date();
    var formattedDate = currentDate.toLocaleDateString();
    var formattedTime = currentDate.toLocaleTimeString();

    // Create a new element to hold the title and the current date
    const titleElement = document.createElement('div');
    titleElement.textContent = 'Farmers Data Report';
    titleElement.style.fontWeight = 'bold'; // Adjust styling as needed

    const currentDateElement = document.createElement('div');
    currentDateElement.textContent = 'Printed on: ' + currentDate;
    currentDateElement.style.marginBottom = '20px'; // Adjust styling as needed

    // Insert the title and the current date elements into the document body
    document.body.insertBefore(titleElement, document.body.firstChild);
    document.body.insertBefore(currentDateElement, titleElement.nextSibling);

    // Hide the navbar
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.style.display = 'none';
    }

    // Hide other elements not to be printed
    const elementsToHide = document.querySelectorAll('.exclude-from-print');
    elementsToHide.forEach(element => {
        element.style.display = 'none';
    });
    document.querySelectorAll('.hide-on-print').forEach(button => {
            button.style.display = 'none';
        });
    // Insert space after "Average Cost per Area Planted"
    insertSpaceForPrinting();

    // Print only the page content
    window.print();

    // Show the navbar after printing
    if (navbar) {
        navbar.style.display = '';
    }

    // Show the hidden elements after printing
    elementsToHide.forEach(element => {
        element.style.display = '';
    });
    document.querySelectorAll('.hide-on-print').forEach(button => {
            button.style.display = 'block';
        });
    // Remove the title and the current date elements after printing
    titleElement.remove();
    currentDateElement.remove();
}

// Function to insert a space after "Average Cost per Area Planted" when printing
function insertSpaceForPrinting() {
    const averageCostSection = document.getElementById('average-cost-section'); // Adjust the ID accordingly
    if (averageCostSection) {
        const spaceDiv = document.createElement('div');
        spaceDiv.style.marginBottom = '1000px'; // Adjust the margin as needed
        averageCostSection.parentNode.insertBefore(spaceDiv, averageCostSection.nextSibling);
    }
}


</script>
@endsection