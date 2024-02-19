
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zambo AgriMap</title>
   
     
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
 
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
    <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
 
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
 


    <!-- ===== All CSS files ===== -->
    <link rel="stylesheet" href="landing_page/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="landing_page/assets/css/animate.css" />
    <link rel="stylesheet" href="landing_page/assets/css/lineicons.css" />
    <link rel="stylesheet" href="landing_page/assets/css/ud-styles.css" />
  
  </head>
  <body>
    <!-- ====== Header Start ====== -->
    <header class="ud-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">
              <a class="navbar-brand" href="index.html">
                <img src="landing_page/assets/images/logo/logo-main.png" alt="Logo" style="width:50px; border-radius:50%; text-align:left;" />
              </a>
              <button class="navbar-toggler">
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
              </button>
              {{-- @if($errors->any())
              <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
              </ul>
              @endif --}}
              <div class="navbar-collapse">
                <ul id="nav" class="navbar-nav mx-auto">
                  <li class="nav-item">
                    <a class="ud-menu-scroll " href="#home">Home</a>
                  </li>

                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#about">About</a>
                  </li>
           
                
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#contact">Contact</a>
                    
                  </li>
                  <li class="nav-item">
                    <a  href="{{route('login')}}" href="javascript:void(0)">Log in</a>
              
                  </li>
                  <li class="nav-item">
                    <a href="{{route('register')}}" href="javascript:void(0)" >Register</a>
              
                  </li>
                </ul>
              </div>

              <div class="navbar-btn d-none d-sm-inline-block">
                {{-- <a href="{{ route('login') }}" class="ud-main-btn ud-login-btn">
                  Log in
                </a> --}}
                {{-- <button class="btn btn-success "  class="ud-main-btn ud-login-btn" onClick="login()" href="javascript:void(0)" >  Log in</button> --}}
                {{-- <button class="btn btn-success "  class="ud-main-btn ud-login-btn"  href="javascript:void(0)" >  Sign Up</button> --}}
             
                {{-- <button class="btn btn-success "  class="ud-main-btn ud-login-btn" onClick="add()" href="javascript:void(0)">  Sign Up</button> --}}
                            {{-- <div class="pull-right mb-2">
                                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Company</a>
                            </div> --}}
                            {{-- <!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <title>Laravel 10 AJAX CRUD using DataTable js Tutorial From Scratch - Tutsmake.com</title>
                                 
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                 
                                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
                             
                                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                 
                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                             
                                <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
                             
                                <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
                             
                            </head>
                            <body>
                             
                            <div class="container mt-2">
                             
                            <div class="row">
                                    <div class="col-lg-12 margin-tb">
                                        <div class="pull-left">
                                            <h2>Laravel 10 Ajax CRUD DataTables Tutorial</h2>
                                        </div>
                                        <div class="pull-right mb-2">
                                            <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Company</a>
                                        </div>
                                    </div>
                                </div>
                                
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                             
                                <div class="card-body">
                             
                                    <table class="table table-bordered" id="ajax-crud-datatable">
                                       <thead>
                                          <tr>
                                             <th>Id</th>
                                             <th>Name</th>
                                             <th>Email</th>
                                             <th>Address</th>
                                             <th>Created at</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                    </table>
                             
                                </div>
                                
                            </div>
                              --}}
                             
                {{-- <a  href="{{ route('register') }}" class="ud-main-btn ud-white-btn" href="javascript:void(0)">
                  Sign Up
                </a> --}}
              </div>
            </div>

           </div>
      </div>

    </header>

    <!-- ====== Header End ====== -->

    <!-- ====== Hero Start ====== -->
    <section class="ud-hero" id="home">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-hero-content wow fadeInUp" data-wow-delay=".2s">
              <h1 class="ud-hero-title">
             Zambo AgriMap or Geo mapping 
              </h1>
              <p class="ud-hero-desc">
                Zambo AgriMap is an innovative geo-mapping tool
                 designed specifically for Zamboanga City. It provides detailed 
                agricultural data and spatial information, enabling 
                stakeholders to make informed decisions about land use,
                 crop planning, and resource allocation. </p>
                 
              {{-- <ul class="ud-hero-buttons">
                <li>
                  <a href="https://links.uideck.com/play-bootstrap-download" rel="nofollow noopener" target="_blank" class="ud-main-btn ud-white-btn">
                    Download Now
                  </a>
                </li>
                <li>
                  <a href="https://github.com/uideck/play-bootstrap" rel="nofollow noopener" target="_blank" class="ud-main-btn ud-link-btn">
                    Learn More <i class="lni lni-arrow-right"></i>
                  </a>
                </li>
              </ul> --}}
            </div>
            <div
              class="ud-hero-brands-wrapper wow fadeInUp"
              data-wow-delay=".3s"
            >
              {{-- <img src="landing_page/assets/images/hero/header-logo.svg" alt="header-logo" /> --}}
              <img src="landing_page/assets/images/hero/logo DA.jfif" alt="header-logo"style="width: 500px;border-radius:5%; " />
            </div>
            <div class="ud-hero-image wow fadeInUp" data-wow-delay=".25s">
              <img src="landing_page/assets/images/hero/geomap.jpg" alt="hero-image" style="border-radius:10%; "/>
              <img
                src="landing_page/assets/images/hero/dotted-shape.svg"
                alt="shape"
                class="shape shape-1"
              />
              <img
                src="landing_page/assets/images/hero/dotted-shape.svg"
                alt="shape"
                class="shape shape-2"
              />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Hero End ====== -->

    <!-- ====== Features Start ====== --> 
    <section id="features" class="ud-features">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title">
              <span>Features</span>
              
              <h2>Zambo Agrimapping - Farmer-Centric Features</h2>
              <p>
               
                Zambo Agrimapping puts farmers at the forefront, offering real-time
                insights into crop yields, historical production data, 
                and personalized recommendations based on specific field locations.
                With customizable farm profiles, resource utilization reports,
                and a community-driven knowledge exchange, Zambo 
                Agrimapping empowers farmers for precision cultivation and collaborative success. 
              
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".1s">
              <div class="ud-feature-icon">
                <i class="lni lni-gift"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title"> Production Insights Dashboard</h3>
                <p class="ud-feature-desc">
                  Real-time Yield Tracking: Monitor and track crop yields in real-time through an intuitive dashboard.
                  Historical Production Data: Access historical data to analyze trends and make informed decisions.
                  Crop-Specific Insights: Provide detailed insights into the production of specific crops.


                </p>
                <a href="javascript:void(0)" class="ud-feature-link">
                  Learn More
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".15s">
              <div class="ud-feature-icon">
                <i class="lni lni-move"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title">Location-Based Planning</h3>
                <p class="ud-feature-desc">
                  Field Zoning: Implement field zoning based on soil composition, topography, and historical performance.
                  Location-Specific Recommendations: Deliver location-specific recommendations for crop selection and cultivation practices.
                  Weather-Integrated Planning: Plan activities based on location-specific weather forecasts.
                </p>
                <a href="javascript:void(0)" class="ud-feature-link">
                  Learn More
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".2s">
              <div class="ud-feature-icon">
                <i class="lni lni-layout"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title">Customizable Farm Profiles</h3>
                <p class="ud-feature-desc">
                  Personalized Information Hub: Allow farmers to create customizable profiles for their farms.
                  Documented Practices: Enable farmers to document and track their agricultural practices over time.
                  Resource Utilization Reports: Provide reports on resource utilization efficiency for each farm.
                  
                </p>
                <a href="javascript:void(0)" class="ud-feature-link">
                  Learn More
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".25s">
              <div class="ud-feature-icon">
                <i class="lni lni-layers"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title">Community-Driven Information Sharing</h3>
                <p class="ud-feature-desc">
                  Localized Knowledge Exchange: Foster a community-driven platform for farmers to share insights and experiences.
                  Marketplace Integration: Facilitate localized buying and selling of agricultural products within the community.
                  
                </p>
                <a href="javascript:void(0)" class="ud-feature-link">
                  Learn More
                </a>
              </div>
            </div>
        <!-- boostrap company model -->
        <div class="modal fade" id="company-modal" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content" style="background-image: url(https://watchmendailyjournal.com/wp-content/uploads/2023/04/da.jpg);">
              <div class="modal-header">
                <h4 class="modal-title" id="CompanyModal"></h4>
              </div>
              <div class="modal-body">
                @if($errors->any())
                <ul class="alert alert-warning">
                  @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
                  @endforeach
                </ul>
                @endif
                <div class="main_div">
                 
                  
                <div class="title">Sign Up Form</div>
                <form class="forms-sample " method="post" action="{{ route('register') }}">
                  @csrf
                  {{-- <div class="input_box">
                    <input type="text" class="form-control" name ="name"autocomplete="name" placeholder="Name" required>
                    <div class="icon"><i class="fas fa-user"></i></div>
                  </div>
                  <div class="input_box">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    <div class="icon"><i class="fas fa-user"></i></div>
                  </div>
                  <div class="input_box">
                    <input type="text" name="agri_district" class="form-control" placeholder="Agri_District" required>
                    <div class="icon"><i class="fas fa-user"></i></div>
                  </div>
                  <div class="input_box">
                    <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" placeholder="Password"required>
                    <div class="icon"><i class="fas fa-lock"></i></div>
                  </div>
                  <div class="input_box">
                    <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" placeholder="Password"required>
                    <div class="icon"><i class="fas fa-lock"></i></div>
                  </div>
                  <div class="input_box">
                    <input type="text" name="role" class="form-control" id="userEmail" placeholder="Role"required>
                    <div class="icon"><i class="fas fa-lock"></i></div>
                  </div> --}}
                  <div class="mb-3">
                    
                    <input type="text" class="form-control" id="exampleInputUsername1" name ="name"autocomplete="name" placeholder="name" >
                  </div>
                  <div class="mb-3">
                
                    <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email">
                  </div>
                  <div class="mb-3">
                   
                    <input type="text" name="agri_district" class="form-control" id="userEmail" placeholder="Agri_District">
                  </div>
                  <div class="mb-3">
                
                    <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" placeholder="Password">
                  </div>
                  <div class="mb-3">
                   
                    <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" placeholder="Password">
                  </div>
                  <div class="mb-3">
                  
                    <input type="text" name="role" class="form-control" id="userEmail" placeholder="Role">
                  </div>
                  <div class="option_div">
                    <div class="check_box">
                      <input type="checkbox">
                      <span>Remember me</span>
                    </div>
                    <div class="forget_div">
                      <a href="#">Forgot password?</a>
                    </div>
                  </div>
                  <div class="input_box button">
                    <input type="submit" value="Sign Up">
                  </div> 
                 
                  <div class="sign_up">
                    Not a member? <a href="{{route('register')}}">Signup now</a>
                  </div>
               
            <div class="modal-footer">
               
            </div>
          </div>
        </div>
      </div>
      <!-- end bootstrap model -->
      
    </body>
    <script type="text/javascript">
          
     $(document).ready( function () {
     
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $('#ajax-crud-datatable').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ url('ajax-crud-datatable') }}",
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'address', name: 'address' },
                        { data: 'created_at', name: 'created_at' },
                        {data: 'action', name: 'action', orderable: false},
                     ],
                     order: [[0, 'desc']]
           });
     
      });
       
      function add(){
     
           $('#CompanyForm').trigger("reset");
           $('#CompanyModal').html("Web Agrimap");
           $('#company-modal').modal('show');
           $('#id').val('');
     
      }   
      function editFunc(id){
         
        $.ajax({
            type:"POST",
            url: "{{ url('edit-company') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#CompanyModal').html("Edit Company");
              $('#company-modal').modal('show');
              $('#id').val(res.id);
              $('#name').val(res.name);
              $('#address').val(res.address);
              $('#email').val(res.email);
           }
        });
      }  
     
      function deleteFunc(id){
            if (confirm("Delete Record?") == true) {
            var id = id;
              
              // ajax
              $.ajax({
                  type:"POST",
                  url: "{{ url('delete-company') }}",
                  data: { id: id },
                  dataType: 'json',
                  success: function(res){
     
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                 }
              });
           }
      }
     
      $('#CompanyForm').submit(function(e) {
     
         e.preventDefault();
       
         var formData = new FormData(this);
       
         $.ajax({
            type:'POST',
            url: "{{ route('register')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
              $("#company-modal").modal('hide');
              var oTable = $('#ajax-crud-datatable').dataTable();
              oTable.fnDraw(false);
              $("#btn-save").html('Submit');
              $("#btn-save"). attr("disabled", false);
            },
            error: function(data){
               console.log(data);
             }
           });
       });
     
    </script>
    </html>         
                 
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Features End ====== -->

    <!-- ====== About Start ====== -->
    <section id="about" class="ud-about">
      <div class="container">
        <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
          <div class="ud-about-content-wrapper">
            <div class="ud-about-content">
              <span class="tag">About Us</span>
              <h2>Welcome to Agrimap.</h2>
              <p>
                At Agrimap, we believe in the power of sustainable agriculture
                to transform communities and nourish the world. Established in [2023],
                we have been dedicated to providing innovative solutions
                that empower farmers, enhance productivity, and promote environmental stewardship.
              </p>
              <h2>Our Mission</h2>
              <p>
                Cultivating Sustainability: Agrimap is on a mission to revolutionize
                he agricultural landscape by promoting sustainable practices
                hat balance productivity with environmental consciousness. 
                We aim to create a future where agriculture not only meets the growing
                obal demand for food but does so in a way
                that preserves the planet for generations to come.
              </p>
              <a href="javascript:void(0)" class="ud-main-btn">Learn More</a>
            </div>
          </div>
          <div class="ud-about-image">
            <img src="landing_page/assets/images/about/about-image.svg" alt="about-image" />
          </div>
        </div>
      </div>
    </section>
    <!-- ====== About End ====== -->

    <!-- ====== Pricing Start ====== -->
    {{-- <section id="pricing" class="ud-pricing">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title mx-auto text-center">
              <span>Pricing</span>
              <h2>Our Pricing Plans</h2>
              <p>
                There are many variations of passages of Lorem Ipsum available
                but the majority have suffered alteration in some form.
              </p>
            </div>
          </div>
        </div>

        <div class="row g-0 align-items-center justify-content-center">
          <div class="col-lg-4 col-md-6 col-sm-10">
            <div
              class="ud-single-pricing first-item wow fadeInUp"
              data-wow-delay=".15s"
            >
              <div class="ud-pricing-header">
                <h3>STARTING FROM</h3>
                <h4>$ 19.99/mo</h4>
              </div>
              <div class="ud-pricing-body">
                <ul>
                  <li>5 User</li>
                  <li>All UI components</li>
                  <li>Lifetime access</li>
                  <li>Free updates</li>
                  <li>Use on 1 (one) project</li>
                  <li>4 Months support</li>
                </ul>
              </div>
              <div class="ud-pricing-footer">
                <a href="javascript:void(0)" class="ud-main-btn ud-border-btn">
                  Purchase Now
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-10">
            <div
              class="ud-single-pricing active wow fadeInUp"
              data-wow-delay=".1s"
            >
              <span class="ud-popular-tag">POPULAR</span>
              <div class="ud-pricing-header">
                <h3>STARTING FROM</h3>
                <h4>$ 30.99/mo</h4>
              </div>
              <div class="ud-pricing-body">
                <ul>
                  <li>5 User</li>
                  <li>All UI components</li>
                  <li>Lifetime access</li>
                  <li>Free updates</li>
                  <li>Use on 1 (one) project</li>
                  <li>4 Months support</li>
                </ul>
              </div>
              <div class="ud-pricing-footer">
                <a href="javascript:void(0)" class="ud-main-btn ud-white-btn">
                  Purchase Now
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-10">
            <div
              class="ud-single-pricing last-item wow fadeInUp"
              data-wow-delay=".15s"
            >
              <div class="ud-pricing-header">
                <h3>STARTING FROM</h3>
                <h4>$ 70.99/mo</h4>
              </div>
              <div class="ud-pricing-body">
                <ul>
                  <li>5 User</li>
                  <li>All UI components</li>
                  <li>Lifetime access</li>
                  <li>Free updates</li>
                  <li>Use on 1 (one) project</li>
                  <li>4 Months support</li>
                </ul>
              </div>
              <div class="ud-pricing-footer">
                <a href="javascript:void(0)" class="ud-main-btn ud-border-btn">
                  Purchase Now
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    <!-- ====== Pricing End ====== -->

    <!-- ====== FAQ Start ====== -->
    {{-- <section id="faq" class="ud-faq">
      <div class="shape">
        <img src="landing_page/assets/images/faq/shape.svg" alt="shape" />
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <span>FAQ</span>
              <h2>Any Questions? Answered</h2>
              <p>
                There are many variations of passages of Lorem Ipsum available
                but the majority have suffered alteration in some form.
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".1s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseOne"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>How to use UIdeck?</span>
                </button>
                <div id="collapseOne" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".15s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>How to download icons from Lineicons?</span>
                </button>
                <div id="collapseTwo" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".2s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseThree"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Is GrayGrids part of UIdeck?</span>
                </button>
                <div id="collapseThree" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".1s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseFour"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Can I use this template for commercial project?</span>
                </button>
                <div id="collapseFour" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".15s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseFive"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Do you have plan releasing Play Pro?</span>
                </button>
                <div id="collapseFive" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".2s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseSix"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Where and how to host this template?</span>
                </button>
                <div id="collapseSix" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== FAQ End ====== -->

    <!-- ====== Testimonials Start ====== -->
    <section id="testimonials" class="ud-testimonials">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title mx-auto text-center">
              <span>Testimonials</span>
              <h2>What our Customers Says</h2>
              <p>
                There are many variations of passages of Lorem Ipsum available
                but the majority have suffered alteration in some form.
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div
              class="ud-single-testimonial wow fadeInUp"
              data-wow-delay=".1s"
            >
              <div class="ud-testimonial-ratings">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="ud-testimonial-content">
                <p>
                  “Our members are so impressed. It's intuitive. It's clean.
                  It's distraction free. If you're building a community.
                </p>
              </div>
              <div class="ud-testimonial-info">
                <div class="ud-testimonial-image">
                  <img
                    src="landing_page/assets/images/testimonials/author-01.png"
                    alt="author"
                  />
                </div>
                <div class="ud-testimonial-meta">
                  <h4>Sabo Masties</h4>
                  <p>Founder @UIdeck</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div
              class="ud-single-testimonial wow fadeInUp"
              data-wow-delay=".15s"
            >
              <div class="ud-testimonial-ratings">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="ud-testimonial-content">
                <p>
                  “Our members are so impressed. It's intuitive. It's clean.
                  It's distraction free. If you're building a community.
                </p>
              </div>
              <div class="ud-testimonial-info">
                <div class="ud-testimonial-image">
                  <img
                    src="landing_page/assets/images/testimonials/author-02.png"
                    alt="author"
                  />
                </div>
                <div class="ud-testimonial-meta">
                  <h4>Margin Gesmu</h4>
                  <p>Founder @Lineicons</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div
              class="ud-single-testimonial wow fadeInUp"
              data-wow-delay=".2s"
            >
              <div class="ud-testimonial-ratings">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="ud-testimonial-content">
                <p>
                  “Our members are so impressed. It's intuitive. It's clean.
                  It's distraction free. If you're building a community.
                </p>
              </div>
              <div class="ud-testimonial-info">
                <div class="ud-testimonial-image">
                  <img
                    src="landing_page/assets/images/testimonials/author-03.png"
                    alt="author"
                  />
                </div>
                <div class="ud-testimonial-meta">
                  <h4>William Smith</h4>
                  <p>Founder @GrayGrids</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-brands wow fadeInUp" data-wow-delay=".2s">
              <div class="ud-title">
                <h6>Trusted and Used by</h6>
              </div>
              <div class="ud-brands-logo">
                <div class="ud-single-logo">
                  <img src="landing_page/assets/images/brands/ayroui.svg" alt="ayroui" />
                </div>
                <div class="ud-single-logo">
                  <img src="landing_page/assets/images/brands/uideck.svg" alt="uideck" />
                </div>
                <div class="ud-single-logo">
                  <img
                    src="landing_page/assets/images/brands/graygrids.svg"
                    alt="graygrids"
                  />
                </div>
                <div class="ud-single-logo">
                  <img
                    src="landing_page/assets/images/brands/lineicons.svg"
                    alt="lineicons"
                  />
                </div>
                <div class="ud-single-logo">
                  <img
                    src="landing_page/assets/images/brands/ecommerce-html.svg"
                    alt="ecommerce-html"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    <!-- ====== Testimonials End ====== -->

    <!-- ====== Team Start ====== -->
    {{-- <section id="team" class="ud-team">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title mx-auto text-center">
              <span>Our Team</span>
              <h2>Meet The Team</h2>
              <p>
                There are many variations of passages of Lorem Ipsum available
                but the majority have suffered alteration in some form.
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".1s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="assets/images/team/team-01.png" alt="team" />
                </div>

                <img
                  src="assets/images/team/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="landing_page/assets/images/team/shape-2.svg"
                  alt="shape"
                  class="shape shape-2"
                />
              </div>
              <div class="ud-team-info">
                <h5>Adveen Desuza</h5>
                <h6>UI Designer</h6>
              </div>
              <ul class="ud-team-socials">
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-facebook-filled"></i>
                  </a>
                </li>
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-twitter-filled"></i>
                  </a>
                </li>
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-instagram-filled"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".15s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="landing_page/assets/images/team/team-02.png" alt="team" />
                </div>

                <img
                  src="landing_page/assets/images/team/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="landing_page/assets/images/team/shape-2.svg"
                  alt="shape"
                  class="shape shape-2"
                />
              </div>
              <div class="ud-team-info">
                <h5>Jezmin uniya</h5>
                <h6>Product Designer</h6>
              </div>
              <ul class="ud-team-socials">
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-facebook-filled"></i>
                  </a>
                </li>
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-twitter-filled"></i>
                  </a>
                </li>
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-instagram-filled"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".2s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="assets/images/team/team-03.png" alt="team" />
                </div>

                <img
                  src="landing_page/assets/images/team/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="landing_page/assets/images/team/shape-2.svg"
                  alt="shape"
                  class="shape shape-2"
                />
              </div>
              <div class="ud-team-info">
                <h5>Andrieo Gloree</h5>
                <h6>App Developer</h6>
              </div>
              <ul class="ud-team-socials">
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-facebook-filled"></i>
                  </a>
                </li>
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-twitter-filled"></i>
                  </a>
                </li>
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-instagram-filled"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".25s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="assets/images/team/team-04.png" alt="team" />
                </div>

                <img
                  src="landing_page/assets/images/team/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="landing_page/assets/images/team/shape-2.svg"
                  alt="shape"
                  class="shape shape-2"
                />
              </div>
              <div class="ud-team-info">
                <h5>Jackie Sanders</h5>
                <h6>Content Writer</h6>
              </div>
              <ul class="ud-team-socials">
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-facebook-filled"></i>
                  </a>
                </li>
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-twitter-filled"></i>
                  </a>
                </li>
                <li>
                  <a href="https://twitter.com/MusharofChy">
                    <i class="lni lni-instagram-filled"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    <!-- ====== Team End ====== -->

    <!-- ====== Contact Start ====== -->
    <section id="contact" class="ud-contact">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-8 col-lg-7">
            <div class="ud-contact-content-wrapper">
              <div class="ud-contact-title">
                <span>CONTACT US</span>
                <h2>
                  Let’s talk about <br />
                  Love to hear from you!
                </h2>
              </div>
              <div class="ud-contact-info-wrapper">
                <div class="ud-single-info">
                  <div class="ud-info-icon">
                    <i class="lni lni-map-marker"></i>
                  </div>
                  <div class="ud-info-meta">
                    <h5>Our Location</h5>
                    <p>Normal Road, Western Mindanao State University, 
                      CCS at campus B ,Zamboanga City, Philippines </p>
                  </div>
                </div>
                <div class="ud-single-info">
                  <div class="ud-info-icon">
                    <i class="lni lni-envelope"></i>
                  </div>
                  <div class="ud-info-meta">
                    <h5>How Can We Help?</h5>
                    <p>agrimapzambo@gmail.com</p>
                    <p>contact#:09925280948</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-5">
            <div
              class="ud-contact-form-wrapper wow fadeInUp"
              data-wow-delay=".2s"
            >
              <h3 class="ud-contact-form-title">Send us a Message</h3>
              <form class="ud-contact-form">
                <div class="ud-form-group">
                  <label for="fullName">Full Name*</label>
                  <input
                    type="text"
                    name="fullName"
                    placeholder="Adam Gelius"
                  />
                </div>
                <div class="ud-form-group">
                  <label for="email">Email*</label>
                  <input
                    type="email"
                    name="email"
                    placeholder="example@yourmail.com"
                  />
                </div>
                <div class="ud-form-group">
                  <label for="phone">Phone*</label>
                  <input
                    type="text"
                    name="phone"
                    placeholder="+885 1254 5211 552"
                  />
                </div>
                <div class="ud-form-group">
                  <label for="message">Message*</label>
                  <textarea
                    name="message"
                    rows="1"
                    placeholder="type your message here"
                  ></textarea>
                </div>
                <div class="ud-form-group mb-0">
                  <button type="submit" class="ud-main-btn">
                    Send Message
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Contact End ====== -->

    <!-- ====== Footer Start ====== -->
    <footer class="ud-footer wow fadeInUp" data-wow-delay=".15s">
      <div class="shape shape-1">
        <img src="landing_page/assets/images/footer/shape-1.svg" alt="shape" />
      </div>
      <div class="shape shape-2">
        <img src="landing_page/assets/images/footer/shape-2.svg" alt="shape" />
      </div>
      <div class="shape shape-3">
        <img src="landing_page/assets/images/footer/shape-3.svg" alt="shape" />
      </div>
      <div class="ud-footer-widgets">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
              <div class="ud-widget">
                <a href="index.html" class="ud-footer-logo">
                  <img src="landing_page/assets/images/logo/logo.png" alt="logo" />
                </a>
                <p class="ud-widget-desc">
                  Zambo AgriMap is an innovative geo-mapping tool
                  designed specifically for Zamboanga City. 
                </p>
                <ul class="ud-widget-socials">
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-facebook-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-twitter-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-instagram-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-linkedin-original"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">About Us</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a href="#home">Home</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Features</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">About</a>
                  </li>
                  {{-- <li>
                    <a href="javascript:void(0)">Testimonial</a>
                  </li> --}}
                </ul>
              </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Features</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a href="javascript:void(0)">How it works</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Privacy policy</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Terms of service</a>
                  </li>
                  {{-- <li>
                    <a href="javascript:void(0)">Refund policy</a>
                  </li> --}}
                </ul>
              </div>
            </div>
            {{-- <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Our Products</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a
                      href="https://lineicons.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Lineicons
                    </a>
                  </li>
                  <li>
                    <a
                      href="https://ecommercehtml.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Ecommerce HTML</a
                    >
                  </li>
                  <li>
                    <a
                      href="https://ayroui.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Ayro UI</a
                    >
                  </li>
                  <li>
                    <a
                      href="https://graygrids.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Plain Admin</a
                    >
                  </li>
                </ul>
              </div>
            </div> --}}
            <div class="col-xl-3 col-lg-6 col-md-8 col-sm-10">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Partners</h5>
                <ul class="ud-widget-brands">
                  <li>
                    <a
                      href="http://wmsu.edu.ph/"
                      rel="WMSU"
                      target="_blank"
                    >
                      <img 
                         src="landing_page/assets/images/footer/brands/Picture1.png"
                        alt="WMSU" 
                      />
                    </a>
                  </li>
                  <li>
                    <a
                      href=""
                      rel="nofollow noopner"
                      target="_blank"
                    >
                      <img
                        src="landing_page/assets/images/footer/brands/cs-logo.png"
                        alt="CCS"
                      />
                    </a>
                  </li>
                  <li>
                    <a
                      href=""
                      rel="nofollow noopner"
                      target="_blank"
                    >
                      <img
                        src="landing_page/assets/images/footer/brands/agri-logo.png"
                        alt="graygrids"
                      />
                    </a>
                  </li>
                  <li>
                    <a
                      href=""
                      rel="nofollow noopner"
                      target="_blank"
                    >
                      <img
                        src="landing_page/assets/images/logo/logo-main.png"
                        alt="lineicons"
                      />
                    </a>
                  </li>
                  <li>
                    {{-- <a
                      href="https://uideck.com/"
                      rel="nofollow noopner"
                      target="_blank"
                    >
                      <img
                        src="landing_page/assets/images/footer/brands/uideck.svg"
                        alt="uideck"
                      />
                    </a> --}}
                  </li>
                  <li>
                    {{-- <a
                      href="https://tailwindtemplates.co/"
                      rel="nofollow noopner"
                      target="_blank"
                    >
                      <img
                        src="landing_page/assets/images/footer/brands/tailwindtemplates.svg"
                        alt="tailwindtemplates"
                      />
                    </a> --}}
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ud-footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <ul class="ud-footer-bottom-left">
                {{-- <li>
                  <a href="javascript:void(0)">Privacy policy</a>
                </li>
                <li>
                  <a href="javascript:void(0)">Support policy</a>
                </li>
                <li>
                  <a href="javascript:void(0)">Terms of service</a>
                </li> --}}
              </ul>
            </div>
            <div class="col-md-4">
              <p class="ud-footer-bottom-right">
               Developed by
                <a href="https://uideck.com" rel="nofollow">OJR</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- ====== Footer End ====== -->

    <!-- ====== Back To Top Start ====== -->
    <a href="javascript:void(0)" class="back-to-top">
      <i class="lni lni-chevron-up"> </i>
    </a>
    <!-- ====== Back To Top End ====== -->

    <!-- ====== All Javascript Files ====== -->
    <script src="landing_page/assets/js/bootstrap.bundle.min.js"></script>
    <script src="landing_page/assets/js/wow.min.js"></script>
    <script src="landing_page/assets/js/main.js"></script>
    <script src="landing_page/assets/js/auth.js"></script>
    <script src="landing_page/assets/js/signup.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    {{-- <script src="landing_page/assets/js/todo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> --}}
    <script>
      // ==== for menu scroll
      const pageLink = document.querySelectorAll(".ud-menu-scroll");

      pageLink.forEach((elem) => {
        elem.addEventListener("click", (e) => {
          e.preventDefault();
          document.querySelector(elem.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
            offsetTop: 1 - 60,
          });
        });
      });

      // section menu active
      function onScroll(event) {
        const sections = document.querySelectorAll(".ud-menu-scroll");
        const scrollPos =
          window.pageYOffset ||
          document.documentElement.scrollTop ||
          document.body.scrollTop;

        for (let i = 0; i < sections.length; i++) {
          const currLink = sections[i];
          const val = currLink.getAttribute("href");
          const refElement = document.querySelector(val);
          const scrollTopMinus = scrollPos + 73;
          if (
            refElement.offsetTop <= scrollTopMinus &&
            refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
          ) {
            document
              .querySelector(".ud-menu-scroll")
              .classList.remove("active");
            currLink.classList.add("active");
          } else {
            currLink.classList.remove("active");
          }
        }
      }

      window.document.addEventListener("scroll", onScroll);
    </script>
    @include('modal.login')
    @include('modal.register')
  </body>
</html>
