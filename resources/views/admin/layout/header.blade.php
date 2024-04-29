<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SyanSoft Solutioning For Innovator</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('backend/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/css/vendor.bundle.base.css')}}">
    
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    {{-- toastr --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('backend/images/company_mini_logo.png')}}" />
  </head>

 <style>
  .table-wrapper{
    overflow-x: auto !important;
    overflow-y: hidden !important;
    margin:30px !important;
  }

  #editBackdrop .card, .previewModalForm .card{
    overflow-x: auto !important;
    overflow-y: hidden !important;
    /* margin:auto !important; */
  }


  #edit_order_form  .table-wrapper, .accordion-body .card {
    overflow-x: auto !important;
    overflow-y: hidden !important;
    margin:30px !important;
  }

  .main-panel,.content-wrapper{
    margin:0px;
    padding:0px;
  }
  /* .card{
    height:100vh;
  } */
  .card-body:not(.main-panel-dashboard .card-body) {
    height: 100vh;
    box-shadow: 0 0 53px 10px rgba(0, 0, 0, 0.6);
}

.main-panel-dashboard .card-body{
    /* box-shadow: 0 0 14px 1px rgba(0, 0, 0, 0.6); */
}

  .btn{
    padding:7px !important;
  }

   /* .card-body{
    margin:auto;
  } */
  /* Hide scrollbar by default */
  ::-webkit-scrollbar {
        background-color: #0081bb;
        display:none;
      }


  .main-panel .content-wrapper .page-header:not(.main-panel-dashboard .page-header){
    display: none !important;
    }

    .sidebar-item .sidebar-link:hover {
    background-color: #273a96 !important;
    color:white !important;
    }

    .sidebar-item a.active {
    color:white !important;
    }

    .sidebar-item a:hover {
    color: white !important;
    }

    .sidebar-item .sidebar-link{
      padding-top:10px !important;
      padding-bottom:10px !important;
    }

  .main-panel,.content-wrapper{
    margin:1px;
    padding:1px;
  }

  .table td,.table{
    padding:5px;
    text-align:center;
  }

  .btn-danger{
    background-color:#79a4e4;
    border:0px;
  }
  select option {
    padding: 10px 10px;
  }

  .pagination{
    margin-top:20px;
  }

  .card-body{
    border-radius:10px !important;
  }
  .clearfix:not(.main-panel-dashboard .card-body .clearfix){
    background-image:linear-gradient(to right, #273a96, #74b6d1) !important;
    padding-top:20px !important;
    padding-bottom:20px !important;
  }

    .accordion-button[aria-expanded="true"] {
      background-image: linear-gradient(to right, #273a96, #74b6d1) !important;
      color:white !important;
    }
  


  @media (min-width: 992px) {
    .modal-xl {
      max-width: 1200px; /* Define extra-large width for larger screens */
    }
  }

  .compare table {
  font-family: Arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.compare td,  .compare th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.compare tr:nth-child(even) {
  background-color: #f2f2f2;
}

.compare .good {
  background-color: lightgreen;
}

 .compare .bad {
  background-color: #ffcccc;
}
.delete-link,.edit-link{
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropbtn {
  background-color: #273a96;
  color: white;
  padding: 8px;
  border: none;
  cursor: pointer;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  max-height: 100px; /* Set the max height for the dropdown */
  overflow-y: auto; /* Enable vertical scrolling */
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #74b6d1;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #74b6d1;
}

  </style>
  <body>
    <div class="container-scroller">
       <!-- partial:partials/_navbar.html -->
 <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="{{asset('dashboard')}}"><img src="{{asset('backend/images/company_logo.png')}}" style="object-fit:contain;mix-blend-mode:darken;width:150px;height:70px;" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="{{asset('dashboard')}}"><img src="{{asset('backend/images/company_mini_logo.png')}}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                @if (!Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="nav-profile-img">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                    <span class="availability-status online"></span>
                    </div>
                @else   
                    <div class="nav-profile-text">
                    <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                    </div>
                @endif
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached me-2 text-success"></i> Activity Log 
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-human me-2 text-success"></i> Profile 
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('logout')}}">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-warning"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('backend/images/faces/face4.jpg')}}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('backend/images/faces/face2.jpg')}}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('backend/images/faces/face3.jpg')}}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 new messages</h6>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-settings"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
              </div>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="{{route('logout')}}">
                <i class="mdi mdi-power"></i>
              </a>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-format-line-spacing"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{ Auth::user()->profile_photo_url }}" alt="{{Auth::user()->name}}">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">{{Auth::user()->name}}</span>
                  <span class="text-secondary text-small">{{Auth::user()->designation}}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>

            <li class="nav-item sidebar-item" style="padding-left:10px;padding-right:10px;">
              <a class="nav-link sidebar-link" style="padding-left:10px;padding-right:10px;" href="{{route('dashboard')}}"><b>Dashboard</b>  <i class="mdi mdi-view-dashboard menu-icon"></i></a>
            </li>

            @if(Auth::user()->admin == 2)
              @foreach($modules as $mod)
              @if($mod->name !== "Role's" && $mod->name !== 'Mapping')
              <li class="nav-item sidebar-item pl-2">
                    <a class="nav-link sidebar-link" href="http://127.0.0.1:8000/{{ $mod->url }}">
                        <span><i class="mdi {{ $mod->mdi_icon }} menu-icon"></i>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <b>{{ $mod->name !== "Complete Lists" ? ($mod->name === 'RFQ' ? 'RFQ' : $mod->name) : 'RFQ' }}</b>
                    </a>
                </li>               
              @endif
              @endforeach
            @endif
            @foreach($parents as $parent)
            <li class="nav-item sidebar-item" style="padding-left:10px;padding-right:10px;">
              <a class="nav-link sidebar-link" style="padding-left:10px;padding-right:10px;" data-bs-toggle="collapse" href="#R{{$parent->id}}" aria-expanded="false" aria-controls="R{{$parent->id}}">
                
              <span class="menu-title"><b>{{$parent->headermodule}}</b></span>
              <i class="menu-arrow"></i>
              <i class="mdi {{$parent->headericon}} menu-icon"></i>
              </a>
              <div class="collapse" id="R{{$parent->id}}">
                <ul class="nav flex-column sub-menu">
                @foreach($modules as $mod)
                  @if($mod->parent_id == $parent->id)
                  <li class="nav-item sidebar-item"> <a class="nav-link sidebar-link" href="http://127.0.0.1:8000/{{$mod->url}}"> <span><i class="mdi {{$mod->mdi_icon}} menu-icon"></i>&nbsp;&nbsp;&nbsp;&nbsp;</span><b>{{$mod->name}}</b></a></li>
                  @endif
                  @endforeach
                </ul>
              </div>
            </li>
            @endforeach
           
          </ul>
        </nav>
        <!-- partial -->
      