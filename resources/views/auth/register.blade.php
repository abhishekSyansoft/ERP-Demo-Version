<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Module Admin</title>
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
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}" />
  </head>
  <style>
    .colorCheck{
      background:linear-gradient(120deg,#d98bff,#a55fff);
      color:white;
    }
  </style>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="{{ asset('backend/images/company_logo.png')}}">
                  <hr>
                  <h6>New here?</h6>
                  <hp class="font-weight-light">Signing up is easy. It only takes a few steps</p>
                </div>
                <hr>
                <div class="p-2 mb-3">
                <!-- <h4>New here?</h4> -->
                <!-- <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6> -->
                </div>
                <form method="POST" action="{{ route('register') }}">
                @csrf
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control form-control-lg" id="name" placeholder="Username">
                  </div>
                  <div class="form-group">
                  <label for="email">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email">
                  </div>
                  <!-- <div class="form-group">
                    <select class="form-control form-control-lg" id="exampleFormControlSelect2">
                      <option>Country</option>
                      <option>United States of America</option>
                      <option>United Kingdom</option>
                      <option>India</option>
                      <option>Germany</option>
                      <option>Argentina</option>
                    </select>
                  </div> -->
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                  </div>

                  <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-lg" id="password_confirmation" placeholder="Confirm Password">
                  </div>
                  <div class="mb-4">
                    <div class="form-check">
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <div class="ms-2">
                                    <x-checkbox name="terms" id="terms" required />
                                        {!! __('Agree :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif
                    </div>
                  </div>
                  <div class="mt-3">
                  <button type="submit" class="btn btn-gradient-primary btn-icon-text">
                    <i class="mdi mdi-file-check btn-icon-prepend"></i> Sign Up 
                  </button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
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
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('backend/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('backend/js/off-canvas.js') }}"></script>
    <script src="{{ asset('backend/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('backend/js/misc.js') }}"></script>
    <!-- endinject -->
  </body>
</html>
