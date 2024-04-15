   <!-- partial:partials/_footer.html -->
   <footer class="footer">
      <div class="container-fluid d-flex justify-content-between">
        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block"><span><img style="mix-blend-mode:darken;object-fit:contain;height:20px;width:20px;" src="{{asset('backend/images/company_mini_logo.png')}}"></span>&nbsp;&nbsp;&nbsp;Copyright © SyanSoft 2024</span>
        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"><a href="" target="_blank"><img style="mix-blend-mode:darken;object-fit:contain;height:30px;" src="{{asset('backend/images/company_mini_logo.png')}}"><img style="mix-blend-mode:darken;object-fit:contain;height:30px;width:80px;" src="{{asset('backend/images/company_logo_name.png')}}"></a></span>
      </div>
    </footer>
    <!-- partial -->
  <!-- page-body-wrapper ends -->
   </div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('backend/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->

     {{-- toastr js --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


     <script>



    $(document).ready(function() {
        // $('.btn').css('padding','15px');
        $('.page-item span').css('background-color','#c67bff');
        $('.page-item span').css('color','white');
        // Function to show Toastr notifications
        function showToast(message, type) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "1000",
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

    @if(Session::has('message'))
        var successData = "{{ Session::get('message') }}"; // Assuming success data is stored in 'success_data'
        if (successData) {
            showToast(successData, 'message');
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
<script>
    $(document).ready(function() {

        // When the button with id forecastProductModalButton is clicked
    $('#forecastProductModalButton').click(function(event) {
        // Prevent the default behavior of the link
        event.preventDefault();


        // Get the value of forecast_link_id
        var forecastLinkId = $('input[name="forecast_link_id"]').val();

        // Now you can use forecastLinkId for further processing
        alert('Forecast Link ID:'+ forecastLinkId);
    });

        $('#order_accordian_toggle').click(function(){
            $('.accordion-item #collapseOne').collapse('hide');
            $('.accordion-item #collapseTwo').collapse('hide');
            $('#collapseOne').toggle('hide');
            $('#collapseTwo').toggle('hide');
            // $('#collapseThree').toggle();
        })

        $('#preview_orders').hide();

        $('#add_order_page').click(function(){
            $('#add_orders').show();
            $('#preview_orders').hide();
            $('#preview_orders .form-control').prop('disabled', true);
        })

        $('#view_preview').click(function(){
            $('#add_orders').hide();
            $('#preview_orders').show();
            $('#preview_orders .form-control').prop('disabled', true);
        })

        $('.form-control').css('color','black');


        // Submit form data using AJAX when the form is submitted
        $('#order_items_form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
            
            // Serialize form data
            var formData = $(this).serialize();

            // Send AJAX request
            $.ajax({
                url: '{{ route("store.order-items") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    var order_header = response.order_header;
                    // console.log(order_header);
                    // console.log(response);
                    // console.log(order_header);
                    $.each(response.order_header, function(index,header){
                        $('#total_order_items').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_items_quantity').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_subtotal').html(parseInt(header.item_count).toLocaleString());
                        $('#total_order_discount').html(parseFloat(header.discount).toLocaleString());
                        $('#total_order_amount').html(parseFloat(header.total_amount).toLocaleString());
                    });


                    // Optionally, you can redirect the user to a success page or perform any other actions
                    var tableBody = '';
                  
                        $.each(response.orderItems, function(index, item) {
                            tableBody += '<tr>';
                            tableBody += '<td>' + (index + 1) + '</td>';
                            tableBody += '<td>' + item.product_name + '</td>';
                            tableBody += '<td>' + parseInt(item.quantity).toLocaleString() + '</td>';
                            tableBody += '<td>' + parseFloat(item.unit_price).toLocaleString() + '</td>';
                            tableBody += '<td>' + parseFloat(item.total_price).toLocaleString() + '</td>';
                            tableBody += '<td>' + parseFloat(item.tax_amount).toLocaleString() + '</td>';
                            tableBody += '<td>' + parseFloat(item.discount).toLocaleString() + '</td>';
                            tableBody += '<td>' + parseFloat(item.sub_total).toLocaleString() + '</td>';
                            tableBody += '<td>';
                            tableBody += '<a href=""><i class="mdi mdi-pen"></i></a>';
                            tableBody += '&nbsp;&nbsp;&nbsp;';
                            tableBody += '<a href="/order-item/delete/' + item.id + '" style="color:red;"><i class="mdi mdi-delete"></i></a>';
                            tableBody += '</td>';
                            tableBody += '</tr>';
                        });


                        $('#orderedItemsBody').html(tableBody);
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });


        $('#preview_order_form').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get the value of the selected radio button (order ID)
            var orderID = $("input[name='preview_order_id']:checked").val();
            // alert(orderID);

            // Make sure an order is selected
            if (orderID) {
                // Send AJAX request to the specified URL with the selected order ID
                $.ajax({
                    url: $(this).attr('action'), // URL specified in the form's action attribute
                    type: $(this).attr('method'), // HTTP method specified in the form's method attribute
                    data: { order_id: orderID }, // Data to send in the request (order ID)
                    success: function(response) {
                        // Handle successful response
                        console.log(response);
                        
                    // Optionally, you can redirect the user to a success page or perform any other actions
                    var tableBody = '';
                  
                        $.each(response.previewitems, function(index, items) {
                            tableBody += '<tr>';
                            tableBody += '<td>' + (index + 1) + '</td>';
                            tableBody += '<td>' + items.product_name + '</td>';
                            tableBody += '<td>' + parseInt(items.quantity).toLocaleString() + '</td>';
                            tableBody += '<td>' + parseFloat(items.unit_price).toLocaleString() + '</td>';
                            tableBody += '<td>' + parseFloat(items.total_price).toLocaleString() + '</td>';
                            tableBody += '<td>' + parseFloat(items.tax_amount).toLocaleString() + '</td>';
                            tableBody += '<td>' + parseFloat(items.discount).toLocaleString() + '</td>';
                            tableBody += '<td>' + parseFloat(items.sub_total).toLocaleString() + '</td>';
                            tableBody += '</tr>';
                        });

                        $.each(response.previewheaders, function(index,header){
                            // <td id="preview_items"></td>
                            //     <td id="preview_discount"></td>
                            //     <td id="preview_total_amount"></td>
                            $('#preview_order_status').val(header.order_status);
                            $('#preview_shipping_address').val(header.shipping_address);
                            $('#preview_billing_address').val(header.billing_address);
                            $('#preview_dealer').val(header.dealer_id);
                            $('#preview_comments').val(header.comments);
                            $('#preview_return_rma').val(header.return_rma);
                            $('#preview_priority').val(header.priority);
                            $('#preview_order_source').val(header.order_source);
                            $('#preview_order_notes').val(header.order_notes);
                            $('#preview_expected_delivery_date').val(header.expected_delivery_date);
                            $('#preview_shipping_tracking_number').val(header.shipping_tracking_number);
                            $('#preview_shipping_carrier').val(header.shipping_carrier);
                            $('#preview_shipping_method').val(header.sipping_method);
                            $('#preview_payment_status').val(header.payment_status);
                            $('#preview_payment_method').val(header.payment_method);
                            $('#preview_billing_address').val(header.billing_address);
                            $('#preview_shipping_address').val(header.shipping_address);
                            $('#preview_representative').val(header.sales_representative);





                        $('#preview_items').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_items_quantity').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_subtotal').html(parseInt(header.item_count).toLocaleString());
                        $('#preview_discount').html(parseFloat(header.discount).toLocaleString());
                        $('#preview_total_amount').html(parseFloat(header.total_amount).toLocaleString());
                    });


                        $('#PrevieworderedItemsBody').html(tableBody);
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            } else {
                // If no order is selected, display an error message or take appropriate action
                alert('Please select an order to preview.');
            }
        });

    //     $('#addSupplierForm').submit(function(event) {
    //     // Prevent default form submission
    //     event.preventDefault();

    //     // Serialize form data
    //     var formData = $(this).serialize();

    //     // Send AJAX request
    //     $.ajax({
    //         url: "{{ route('supplier.add') }}",
    //         type: "POST",
    //         data: formData,
    //         success: function(response) {
    //             // Close modal
    //             $('#addSupplierModal').modal('hide');

    //             console.log(response);

    //             // Reload the page to display updated data
    //             location.reload();

    //             // Alternatively, you can update the table dynamically without reloading the page
    //         },
    //         error: function(xhr) {
    //             // Handle errors
    //             alert('Failed to add supplier: ' + xhr.responseText);
    //         }
    //     });
    // });


        $('#order_header_form').submit(function(event){
        event.preventDefault(); // Prevent default form submission

        var formData = new FormData(this); // Serialize form data
        
        // AJAX submission
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                // console.log(response);
                if (response.message) {
                        // Display success message from response
                        toastr.success('Order created successfully');
                    } else {
                        // Fallback to a default success message
                        toastr.error('Order not created some ting missing or wrong');
                    }
                // If AJAX request successful, close current accordion
                },
            error: function(xhr, status, error){
                // Handle error if AJAX request fails
                console.error(error);
            }
        });
    });


        let quantity = $('quantity').val();
        $('#tick_check').hide();
        // Attach change event listener to the select element
        $('#exampleModal #product_id').change(function() {
            // Get the selected dealer ID
            var selectedDealerId = $(this).children('option:selected').val(); // Get the value of the selected option
            // alert('Selected Dealer ID:' + selectedDealerId);
            $('#tick_check').show();
            $('#order_items #product_id').css('background-color','rgba(72,235,150,0.5)');

            $.ajax({
                url: '/add_order_items/fetch-dealer-details', // Route URL
                method: 'GET',
                data: {
                    dealer_id: selectedDealerId // Pass the selected dealer ID as data
                },
                success: function(response) {
                   
                    // Handle successful response
                    // alert('Dealer details:', response);
                    // Store the dealer details in session storage
                    // Parse the JSON response
                            //  toastr.success('Order item added successfully');
                    var dealerDetails = response;

                    // Log the product price to the console
                    // console.log(response);
                    $('#product_name').val(dealerDetails.product_name);
                    $('#total_price').val(dealerDetails.product_price);
                    $('#unitprice').val(dealerDetails.product_price);
                    $('#tax_rate').val(dealerDetails.product_taxrate);
                    $('#sku').val(dealerDetails.product_sku);
                    var tax_amount = dealerDetails.product_price * (dealerDetails.product_taxrate / 100);
                    $('#tax_amount').val(tax_amount);   
                    var sub_total = parseFloat(dealerDetails.product_price) + tax_amount;
                    $('#sub_total').val(sub_total);  
                    $('#quantity, #discount').keyup(function() {
                        // Get the value of the input fields
                        var quantity = $('#quantity').val();
                        var discount = parseFloat($('#discount').val()); // Convert discount to a floating-point number
                        // Perform any other action you want to do with the input values here
                        // For example, update another element with the calculated total price
                        var total_price = (dealerDetails.product_price * quantity) - discount;
                        // alert(total_price);
                        // var total_calculated_price = total_price.toLocalstring();
                        $('#product_name').val(dealerDetails.product_name);
                        $('#total_price').val(total_price);
                        $('#unitprice').val(dealerDetails.product_price);
                        $('#total_price').val(parseFloat(dealerDetails.product_price * quantity));
                        $('#sku').val(dealerDetails.product_sku);
                        $('#tax_rate').val(dealerDetails.product_taxrate);
                        var tax_amount = total_price * (dealerDetails.product_taxrate / 100);
                        
                            $('#tax_amount').val(tax_amount);                        // $('#discount').val(dealerDetails.product_discount);
                        var sub_total = total_price + tax_amount;
                        $('#sub_total').val(sub_total);
                        // alert(sub_total);
                    });


                        // Now you can access the inputValue variable outside of the event listener
                        // For example, you can use it in another event listener or function
                        $('#show-value').click(function() {
                            // This alert will display the value of the inputValue variable after typing in the input field
                            // alert('Input value: ' + inputValue);
                        });

                    // Set the value of the input tag with id 'unitprice' to the product price


                    // Calculate subtotal
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        });
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
    //   $('.table th').css('background-color','#598ac2');
    //   $('.table tr').css('background-color','#d5d7da')
      $('.table').addClass('table-sm')
    </script>
    </body>
</html>