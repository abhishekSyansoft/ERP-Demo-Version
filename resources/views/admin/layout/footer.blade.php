   <!-- page-body-wrapper ends -->
   </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('backend/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->

     {{-- toastr js --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
     <script>
$(function(){
    // Function to display toast notifications with color and animation
    function showToast(message, type) {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "toastClass": "toast-white"
        };

        switch (type) {
            case 'success':
                toastr.success(message, 'Success');
                break;
            case 'error':
                toastr.error(message, 'Error');
                break;
            case 'delete':
                toastr.error(message, 'Deleted');
                break;
            default:
                toastr.info(message);
                break;
        }
    }

    // Display toast notifications based on session messages
    @if(Session::has('success'))
        var successData = "{{ Session::get('success') }}"; // Assuming success data is stored in 'success_data'
        if (successData) {
            showToast(successData, 'success');
        }
    @endif

    @if(Session::has('error'))
        var errorData = "{{ Session::get('error') }}"; // Assuming error data is stored in 'error_data'
        if (errorData) {
            showToast(errorData, 'error');
        }
    @endif

    @if(Session::has('delete'))
        var errorData = "{{ Session::get('delete') }}"; // Assuming error data is stored in 'error_data'
        if (errorData) {
            showToast(errorData, 'delete');
        }
    @endif
});
</script>


    <!-- Plugin js for this page -->
    <script src="{{asset('backend/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('backend/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('backend/js/off-canvas.js')}}"></script>
    <script src="{{asset('backend/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('backend/js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('backend/js/dashboard.js')}}"></script>
    <script src="{{asset('backend/js/todolist.js')}}"></script>
    <!-- End custom js for this page -->
    <script>
    // Wait for the DOM content to load
    document.addEventListener("DOMContentLoaded", function() {
        // Hide all tab content elements except the first one
        var tabcontent = document.getElementsByClassName("tabcontent");
        for (var i = 1; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
    });

    function openCity(event, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        event.currentTarget.className += " active";
    }
</script>

    <script>
      $('.form-control').css('border-bottom','1px solid black');
      $('.table th').addClass('table-primary border-warning')
      $('.table tr').addClass('table-warning')
    </script>
    </body>
</html>