
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SyanSoft Solutioning For Innovator</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('backend/images/company_mini_logo.png')}}" />
  </head>
  <style>
   .login_back{
    background:url("/backend/images/company_mini_logo.png") center 80% no-repeat;
    background-size:contain;
    /* mix-blend-mode:darken; */
   }
  </style>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
          <div class="col-xl-7 col-lg-6 col-md-4 login_back">
          </div>
            <div class="col-xl-5 col-lg-6 col-md-8">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="{{ asset('backend/images/company_logo.png') }}">
                </div>
                <hr>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <hr>
                <form  method="POST" action="{{ route('login') }}">
                @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label for="remember_me" class="form-check-label text-muted">
                        <input type="checkbox" id="remember_me" namde="remember_me" class="form-check-input"> Keep me signed in </label>
                    </div>
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                  </div>
                  <!-- <div class="mb-2">
                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                      <i class="mdi mdi-facebook me-2"></i>Connect using facebook </button>
                  </div> -->
                  <!-- <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="{{ route('register')}}" class="text-primary">Create</a> -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
      <div class="container-fluid d-flex justify-content-between">
        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block"><span><img style="mix-blend-mode:darken;object-fit:contain;height:20px;width:20px;" src="{{asset('backend/images/company_mini_logo.png')}}"></span>&nbsp;&nbsp;&nbsp;Copyright © SyanSoft 2024</span>
        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"><a href="" target="_blank"><img style="mix-blend-mode:darken;object-fit:contain;height:40px;width:80px;" src="{{asset('backend/images/company_mini_logo.png')}}"><img style="mix-blend-mode:darken;object-fit:contain;height:40px;width:80px;" src="{{asset('backend/images/company_logo_name.png')}}"></a></span>
      </div>
    </footer>
    <!-- partial -->
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('backendvendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('backendjs/off-canvas.js') }}"></script>
    <script src="{{ asset('backendjs/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('backendjs/misc.js') }}"></script>
    <!-- endinject -->
  </body>
</html>
