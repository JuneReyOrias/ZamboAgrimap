<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
     Zambo<span>Agrimap</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="{{route('user.user_dash')}}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Maps</li>
     
      <li class="nav-item">
        <a href="{{route('map.agrimap')}}" class="nav-link">
          <i class="link-icon" data-feather="map"></i>
          <span class="link-title">Agri-Map</span>
        </a>
      </li>
     
      <li class="nav-item nav-category">Features</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
          <i class="link-icon" data-feather="list"></i>
          <span class="link-title">Report/Agri-Districts</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="uiComponents">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('user.agriFarmers.ayala_farmers')}}" class="nav-link">Ayala RIce Farmers</a>
            </li>
            <li class="nav-item">
              <a href="{{route('user.agriFarmers.tumaga_farmers')}}" class="nav-link">Tumaga RIce Farmers</a>
            </li>
            <li class="nav-item">
              <a href="{{route('user.agriFarmers.culianan_farmers')}}" class="nav-link">Culianan Rice Farmers</a>
            </li>
            <li class="nav-item">
              <a href="{{route('user.agriFarmers.manicahan_farmers')}}" class="nav-link">Manicahan Rice Farmers</a>
            </li>
            <li class="nav-item">
              <a href="{{route('user.agriFarmers.curuan_farmers')}}" class="nav-link">Curuan Rice Farmers</a>
            </li>
            <li class="nav-item">
              <a href="{{route('user.agriFarmers.vitali_farmers')}}" class="nav-link">Vitali Rice Farmers</a>
            </li>
            
          </ul>
        </div>
      </li> 
      {{-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
          <i class="link-icon" data-feather="anchor"></i>
          <span class="link-title">Agriculture Sector</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="advancedUI">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="" class="nav-link">Crops</a>
            </li>
            <li class="nav-item">
              <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Livestock</a>
            </li>
            <li class="nav-item">
              <a href="pages/advanced-ui/sortablejs.html" class="nav-link">Fisheries</a>
            </li>
            
          </ul>
        </div>
      </li> --}}
      {{-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#forms" role="button" aria-expanded="false" aria-controls="forms">
          <i class="link-icon" data-feather="inbox"></i>
          <span class="link-title">Forms</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="forms">
          <ul class="nav sub-menu">
          
            <li class="nav-item">
              <a href="{{route('agent.personal_info.add_info')}}" class="nav-link">Rice Survey Form</a>
            </li>
            <li class="nav-item">
              <a href="{{route('agent.personal_info.add_info')}}" class="nav-link">Corn Survey Form</a>
            </li>
             <li class="nav-item">
              <a href="{{route('agent.personal_info.add_info')}}" class="nav-link">Coconut Survey Form</a>
            </li>
            <li class="nav-item">
              <a href="{{route('multifile.import_agent')}}" class="nav-link">Multiple Import Form</a>
            </li>
           
              <li class="nav-item">
              <a href="{{route('kml.import')}}" class="nav-link">Kml Import</a>
            </li>
         
          </ul>
        </div>
      </li> --}}
      {{-- <li class="nav-item">
        <a class="nav-link"  data-bs-toggle="collapse" href="#farmers" role="button" aria-expanded="false" aria-controls="charts">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Farmers Info</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="farmers">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('user.forms_data')}}" class="nav-link">Farmers Rice Info</a>
            </li>
           
          
          </ul>
        </div>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link"  data-bs-toggle="collapse" href="#charts" role="button" aria-expanded="false" aria-controls="calendar">
          <i class="link-icon" data-feather="slack"></i>
          <span class="link-title">Crop Varieties</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="charts">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('user.RiceVariety.inbred_hybrid')}}" class="nav-link">Rice Varieties/District</a>
            </li>
            {{-- <li class="nav-item">
              <a href="pages/charts/chartjs.html" class="nav-link">Corn Varieties</a>
            </li>
            <li class="nav-item">
              <a href="pages/charts/flot.html" class="nav-link">Coconut</a>
            </li> --}}
           
          </ul>
        </div>
      </li> 
      {{-- <li class="nav-item">
        <a class="nav-link"  data-bs-toggle="collapse" href="#schedule" role="button" aria-expanded="false" aria-controls="charts">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Schedule</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="schedule">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('user.riceSchedule.rice_planting')}}" class="nav-link">Planting</a>
            </li>
            <li class="nav-item">
              <a href="{{route('user.riceSchedule.rice_harvest')}}" class="nav-link">Harvest</a>
            </li>
          
          </ul>
        </div>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#tables" role="button" aria-expanded="false" aria-controls="tables">
          <i class="link-icon" data-feather="bar-chart-2"></i>
          <span class="link-title">Crops Production</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('user.cropProduction.rice_crop')}}" class="nav-link">Rice Crop</a>
            </li>
            <li class="nav-item">
              <a href="pages/tables/data-table.html" class="nav-link">Corn Crop</a>
            </li>
            <li class="nav-item">
              <a href="pages/tables/data-table.html" class="nav-link">Coconut</a>
            </li>
          </ul>
        </div>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#icons" role="button" aria-expanded="false" aria-controls="icons">
          <i class="link-icon" data-feather="smile"></i>
          <span class="link-title">Coordinates Update</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="pages/icons/feather-icons.html" class="nav-link">polygon Boundary</a>
            </li>
            <li class="nav-item">
              <a href="pages/icons/flag-icons.html" class="nav-link">latitude</a>
            </li>
            <li class="nav-item">
              <a href="pages/icons/mdi-icons.html" class="nav-link">longhitude</a>
            </li>
          </ul>
        </div>
      </li> --}}
    <!--  <li class="nav-item nav-category">Pages</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" role="button" aria-expanded="false" aria-controls="general-pages">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Special pages</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="general-pages">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="pages/general/blank-page.html" class="nav-link">Blank page</a>
            </li>
            <li class="nav-item">
              <a href="pages/general/faq.html" class="nav-link">Faq</a>
            </li>
            <li class="nav-item">
              <a href="pages/general/invoice.html" class="nav-link">Invoice</a>
            </li>
            <li class="nav-item">
              <a href="pages/general/profile.html" class="nav-link">Profile</a>
            </li>
            <li class="nav-item">
              <a href="pages/general/pricing.html" class="nav-link">Pricing</a>
            </li>
            <li class="nav-item">
              <a href="pages/general/timeline.html" class="nav-link">Timeline</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#authPages" role="button" aria-expanded="false" aria-controls="authPages">
          <i class="link-icon" data-feather="unlock"></i>
          <span class="link-title">Authentication</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="authPages">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="admin_login" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
              <a href="pages/auth/register.html" class="nav-link">Register</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#errorPages" role="button" aria-expanded="false" aria-controls="errorPages">
          <i class="link-icon" data-feather="cloud-off"></i>
          <span class="link-title">Error</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="errorPages">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="pages/error/404.html" class="nav-link">404</a>
            </li>
            <li class="nav-item">
              <a href="pages/error/500.html" class="nav-link">500</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">Docs</li>
      <li class="nav-item">
        <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
          <i class="link-icon" data-feather="hash"></i>
          <span class="link-title">Documentation</span>
        </a>
      </li>-->
    </ul>
  </div>
</nav>