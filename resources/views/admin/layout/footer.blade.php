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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


     {{-- toastr js --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


     <script>



    $(document).ready(function() {
        $('.btn').css('padding','15px');
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
        $('#edit_orders').hide();

        $('#add_order_page').click(function(){
            $('#preview_orders').hide();
            $('#edit_orders').hide();
            $('#add_orders').show();
            $('#preview_orders .form-control').prop('disabled', true);
        })

        $('#past_generated_order').click(function(){
            $('#add_orders').hide();
            $('#edit_orders').show();
            $('#preview_orders').hide();
            // $('#preview_orders .form-control').prop('disabled', true);
        })

        $('#view_preview').click(function(){
            $('#add_orders').hide();
            $('#edit_orders').hide();
            $('#preview_orders').show();
            $('#preview_orders .form-control').prop('disabled', true);
        })

        $('.form-control').css('color','black');
        // update_order_items_form




// Submit form data using AJAX when the form is submitted
$('#update_order_items_form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
            
            // Serialize form data
            var formData = $(this).serialize();

            // Send AJAX request
            $.ajax({
                url: '{{ route("update.order-items") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    var order_header = response.order_header;
                    // console.log(order_header);
                    // console.log(response);
                    // console.log(order_header);
                    $.each(response.order_header, function(index,header){
                        $('#update_edit_items').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_items_quantity').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_subtotal').html(parseInt(header.item_count).toLocaleString());
                        $('#update_edit_discount').html(parseFloat(header.discount).toLocaleString());
                        $('#update_edit_total_amount').html(parseFloat(header.total_amount).toLocaleString());
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
                            tableBody += '<a  class="edit-link" data-order-id="'+item.id+'"><i class="mdi mdi-pen"></i></a>';
                            tableBody += '&nbsp;&nbsp;&nbsp;';
                            tableBody += '<a class="delete-link" data-order-id="'+item.id+'" style="color:red;"><i class="mdi mdi-delete"></i></a>';
                            tableBody += '</td>';
                            tableBody += '</tr>';
                        });

                        var discount = response.discount;
                        var amount = response.totalAmount;
                        var quantity = response.totalQuantity;

                        $.each(response.order_header, function(index,header){
                            // <td id="preview_items"></td>
                            //     <td id="preview_discount"></td>
                            //     <td id="preview_total_amount"></td>
                            $('#edit_order_status').val(header.order_status);
                            $('#edit_shipping_address').val(header.shipping_address);
                            $('#edit_billing_address').val(header.billing_address);
                            $('#edit_dealer').val(header.dealer_id);
                            $('#edit_comments').val(header.comments);
                            $('#edit_return_rma').val(header.return_rma);
                            $('#edit_priority').val(header.priority);
                            $('#edit_order_source').val(header.order_source);
                            $('#edit_order_notes').val(header.order_notes);
                            $('#edit_expected_delivery_date').val(header.expected_delivery_date);
                            $('#edit_shipping_tracking_number').val(header.shipping_tracking_number);
                            $('#edit_shipping_carrier').val(header.shipping_carrier);
                            $('#edit_shipping_method').val(header.sipping_method);
                            $('#edit_payment_status').val(header.payment_status);
                            $('#edit_payment_method').val(header.payment_method);
                            $('#edit_billing_address').val(header.billing_address);
                            $('#edit_shipping_address').val(header.shipping_address);
                            $('#edit_representative').val(header.sales_representative);
                            $('#addMoreItems #update_order_id').val(header.order_id);

                        $('#update_edit_items').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_items_quantity').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_subtotal').html(parseInt(header.item_count).toLocaleString());
                        $('#update_edit_discount').html(parseFloat(header.discount).toLocaleString());
                        $('#update_edit_total_amount').html(parseFloat(header.total_amount).toLocaleString());


                        });

                        // $('#update_edit_items').html(parseInt(quantity).toLocaleString());
                        // // $('#total_order_items_quantity').html(parseInt(header.item_count).toLocaleString());
                        // // $('#total_order_subtotal').html(parseInt(header.item_count).toLocaleString());
                        // $('#update_edit_discount').html(parseFloat(discount).toLocaleString());
                        // $('#update_edit_total_amount').html(parseFloat(amount).toLocaleString());


                        $('#EditorderedItemsBody').html(tableBody);
                },
                error: function(xhr, status, error) {
                    if (response.errors) {
                        // Clear the existing content of the errorList element
                        $('#errorList').empty();
                        
                        // Initialize an empty string to store HTML markup for error messages
                        var errorMessageList = '';
                        
                        // Loop through each error and handle them
                        for (var key in response.errors) {
                            if (response.errors.hasOwnProperty(key)) {
                                // Get the error message for the current field
                                var errorMessage = response.errors[key][0];
                                
                                // Generate HTML markup for the error message and append it to errorMessageList
                                errorMessageList += '<p>' + errorMessage + '</p>';
                            }
                        }
                        
                        // Append the HTML markup for error messages to the errorList element
                        $('#errorList').html(errorMessageList);
                    }

                }
            });
        });










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
                    // var order_header = response.order_header;
                    // console.log(order_header);
                    console.log(response);

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

                         // console.log(order_header);
                    $.each(response.order_header, function(index,header){
                        $('#total_order_items').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_items_quantity').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_subtotal').html(parseInt(header.item_count).toLocaleString());
                        $('#total_order_discount').html(parseFloat(header.discount).toLocaleString());
                        $('#total_order_amount').html(parseFloat(header.total_amount).toLocaleString());
                    });



                        $('#orderedItemsBody').html(tableBody);
                },
                error: function(xhr, status, error) {
                    // Parse the response JSON to access the error messages
                    var response = JSON.parse(xhr.responseText);
                    
                    // Check if the response contains errors
                    if (response.errors) {
                        // Initialize an empty string to store HTML markup for error messages
                    var errorMessageList = '';
                    
                    // Loop through each error and handle them
                    for (var key in response.errors) {
                        if (response.errors.hasOwnProperty(key)) {
                            // Get the error message for the current field
                            var errorMessage = response.errors[key][0];
                            
                            // Generate HTML markup for the error message and append it to errorMessageList
                            errorMessageList += '<p class="alert alert-danger">' + errorMessage + '</p>';
                        }
                    }
                    
                    // Append the HTML markup for error messages to the errorList element
                    $('#errorList').empty();
                    $('#errorList').html(errorMessageList);
                    $('#updateEditItemsModal').modal('toggle');
                        // Show the modal
                        $('#errorsModal').modal('show');
                    } else {
                        // If there are no specific errors, log the general error message
                        console.error('An error occurred:', error);
                    }
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
                        // console.log(response);
                        
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
                        $('#EditorderedItemsBody').html(tableBody);
                    },
                    error: function(xhr, status, error) {
                       // Parse the response JSON to access the error messages
                       var response = JSON.parse(xhr.responseText);
                                                    
                                                    // Check if the response contains errors
                                                    if (response.errors) {
                                                       // Initialize an empty string to store HTML markup for error messages
                                                    var errorMessageList = '';
                                                    
                                                    // Loop through each error and handle them
                                                    for (var key in response.errors) {
                                                        if (response.errors.hasOwnProperty(key)) {
                                                            // Get the error message for the current field
                                                            var errorMessage = response.errors[key][0];
                                                            
                                                            // Generate HTML markup for the error message and append it to errorMessageList
                                                            errorMessageList += '<p class="alert alert-danger">' + errorMessage + '</p>';
                                                        }
                                                    }
                                                    
                                                    // Append the HTML markup for error messages to the errorList element
                                                    $('#errorList').empty();
                                                    $('#errorList').html(errorMessageList);
                                                    $('#updateEditItemsModal').modal('toggle');
                                                     // Show the modal
                                                     $('#errorsModal').modal('show');
                                                    } else {
                                                        // If there are no specific errors, log the general error message
                                                        console.error('An error occurred:', error);
                                                    }
                    }
                });
            } else {
                // If no order is selected, display an error message or take appropriate action
                alert('Please select an order to preview.');
            }
        });
        

        $('.approvalBTN').click(function(){
            alert('Thanks your request for approval is sent successfully.');
        })



        $("#addBtn").click(function(){
        var todoText = $("#todoInput").val();
        // var priority = $("#prioritySelect").val();
        if(todoText !== ''){
            $("#todoList").append("<li class='col-md-4'>" + todoText + "</li>");
            $("#todoInput").val('0');
        } else {
            alert("Please enter a task.");
        }
    });





    $(".compare tr").each(function(index, row) {
    if (index === 0) return; // Skip header row
    var cells = $(row).find("td");
    cells.each(function(cellIndex, cell) {
      if (cellIndex === 0) return; // Skip first column
      var cellValue = $(cell).text().trim();
      if (!isNaN(parseFloat(cellValue))) { // Check if the cell contains a number
        cellValue = parseFloat(cellValue.replace(/[^0-9.-]+/g, "")); // Remove non-numeric characters
        var minValue = Math.min.apply(null, $.map(cells.slice(1), function(c) { return parseFloat($(c).text().replace(/[^0-9.-]+/g, "")); }));
        var maxValue = Math.max.apply(null, $.map(cells.slice(1), function(c) { return parseFloat($(c).text().replace(/[^0-9.-]+/g, "")); }));
        if (cellValue === minValue) {
          $(cell).addClass("good");
        } else if (cellValue === maxValue) {
          $(cell).addClass("bad");
        }
      }
    });
  });




    $("#addBtninPR").click(function(){


        function generateRandomString(length) {
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var result = '';
            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * characters.length);
                result += characters.charAt(randomIndex);
            }
            return result;
        }

        var randomString = generateRandomString(10);

        var todoText = $("#todoInputPR").val();
        var randomNumber = Math.floor(Math.random() * 10000) + 1;
        var unit = Math.floor(Math.random() * 10) + 1;
        var i = 0;
        if(todoText !== ''){
            $("#todoListPR").append("<tr><td>" + (i+1) + "</td> <td>" + randomString + "</td><td>" + todoText + "</td><td>" + unit + "</td></tr>");
            $("#todoInputPR").val('0');
        } else {
            alert("Please enter a task.");
        }
    });

    $('.compare .nego').click(function(){
        alert('Thanks quotation is sent for the negotiation.');
    });

    $('.compare .appr').click(function(){
        alert('Thanks quotation is sent for the approval. We will update the quotation status soon');
    });


    $("#addBtninMR").click(function(){
        var todoText = $("#todoInputMR").val();
        var randomNumber = Math.floor(Math.random() * 10000) + 1;
        var unit = Math.floor(Math.random() * 10) + 1;
        var i = 0;
        if(todoText !== ''){
            $("#todoListMR").append("<tr><td>" + (i+1) + "</td> <td>" + randomNumber + "</td><td>" + todoText + "</td><td>" + unit + "</td></tr>");
            $("#todoInputMR").val('0');
        } else {
            alert("Please enter a task.");
        }
    });
    //  $("#addBtn").click(function(){
    //     var todoText = $("#todoInput").val();
    //     var priority = $("#prioritySelect").val();
    //     if(todoText !== ''){
    //         $("#todoList").append("<li class='" + priority + " col-md-3'>" + todoText + "</li>");
    //         $("#todoInput").val('0');
    //     } else {
    //         alert("Please enter a task.");
    //     }
    // });

    $(document).on('click', 'li', function(){
        $(this).toggleClass('completed');
    });

    


        $(document).on('click', '.delete-link', function(event) {
        event.preventDefault(); // Prevent the default action of the link
        var id = $(this).data('order-id');
        // Perform further actions here, such as making an AJAX request to delete the item
        if (confirm("Are you sure you want to delete this item?")) {
                $.ajax({
                    url: '/order-item/delete/' + id, // Replace with your delete item route
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Remove the table row upon successful deletion
                            var tableBody = '';
                  
                            $.each(response.orderItems, function(index, items) {
                                tableBody += '<tr>';
                                tableBody += '<td>' + (index + 1) + '</td>';
                                tableBody += '<td>' + items.product_name + '</td>';
                                tableBody += '<td>' + parseInt(items.quantity).toLocaleString() + '</td>';
                                tableBody += '<td>' + parseFloat(items.unit_price).toLocaleString() + '</td>';
                                tableBody += '<td>' + parseFloat(items.total_price).toLocaleString() + '</td>';
                                tableBody += '<td>' + parseFloat(items.tax_amount).toLocaleString() + '</td>';
                                tableBody += '<td>' + parseFloat(items.discount).toLocaleString() + '</td>';
                                tableBody += '<td>' + parseFloat(items.sub_total).toLocaleString() + '</td>';
                                tableBody += '<td>';
                                tableBody += '<a  class="edit-link" data-order-id="'+items.id+'"><i class="mdi mdi-pen"></i></a>';
                                tableBody += '&nbsp;&nbsp;&nbsp;';
                                tableBody += '<a class="delete-link" data-order-id="'+items.id+'" style="color:red;"><i class="mdi mdi-delete"></i></a>';
                                tableBody += '</td>';
                                tableBody += '</tr>';
                            });
                            
                            $('#errorList').empty();
                            $('#errorList').html('<p class="alert text-success p-0">'+response.message+'</p>');

                                // Show the modal
                                $('#errorsModal').modal('show');
                           





                            $.each(response.order_header, function(index,header){
                            // <td id="preview_items"></td>
                            //     <td id="preview_discount"></td>
                            //     <td id="preview_total_amount"></td>
                            $('#edit_order_status').val(header.order_status);
                            $('#edit_shipping_address').val(header.shipping_address);
                            $('#edit_billing_address').val(header.billing_address);
                            $('#edit_dealer').val(header.dealer_id);
                            $('#edit_comments').val(header.comments);
                            $('#edit_return_rma').val(header.return_rma);
                            $('#edit_priority').val(header.priority);
                            $('#edit_order_source').val(header.order_source);
                            $('#edit_order_notes').val(header.order_notes);
                            $('#edit_expected_delivery_date').val(header.expected_delivery_date);
                            $('#edit_shipping_tracking_number').val(header.shipping_tracking_number);
                            $('#edit_shipping_carrier').val(header.shipping_carrier);
                            $('#edit_shipping_method').val(header.sipping_method);
                            $('#edit_payment_status').val(header.payment_status);
                            $('#edit_payment_method').val(header.payment_method);
                            $('#edit_billing_address').val(header.billing_address);
                            $('#edit_shipping_address').val(header.shipping_address);
                            $('#edit_representative').val(header.sales_representative);
                            $('#addMoreItems #update_order_id').val(header.order_id);





                        $('#update_edit_items').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_items_quantity').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_subtotal').html(parseInt(header.item_count).toLocaleString());
                        $('#update_edit_discount').html(parseFloat(header.discount).toLocaleString());
                        $('#update_edit_total_amount').html(parseFloat(header.total_amount).toLocaleString());
                    });

                            $('#EditorderedItemsBody').html(tableBody);

                            $(this).closest('tr').remove();
                            // console.log(response);
                        } else {
                            alert('Failed to delete item: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Parse the response JSON to access the error messages
                        var response = JSON.parse(xhr.responseText);
                                                    
                                                    // Check if the response contains errors
                                                    if (response.errors) {
                                                       // Initialize an empty string to store HTML markup for error messages
                                                    var errorMessageList = '';
                                                    
                                                    // Loop through each error and handle them
                                                    for (var key in response.errors) {
                                                        if (response.errors.hasOwnProperty(key)) {
                                                            // Get the error message for the current field
                                                            var errorMessage = response.errors[key][0];
                                                            
                                                            // Generate HTML markup for the error message and append it to errorMessageList
                                                            errorMessageList += '<p class="alert alert-danger">' + errorMessage + '</p>';
                                                        }
                                                    }
                                                    
                                                    // Append the HTML markup for error messages to the errorList element
                                                    $('#errorList').empty();
                                                    $('#errorList').html(errorMessageList);
                                                    $('#updateEditItemsModal').modal('toggle');
                                                     // Show the modal
                                                     $('#errorsModal').modal('show');
                                                    } else {
                                                        // If there are no specific errors, log the general error message
                                                        console.error('An error occurred:', error);
                                                    }
                    }
                });
            }
        // For now, let's just log the orderId
        // console.log('Order ID:', orderId);
    });












    $(document).on('click', '.edit-link', function(event) {
        event.preventDefault(); // Prevent the default action of the link
        var id = $(this).data('order-id');
        // Perform further actions here, such as making an AJAX request to delete the item
        if (confirm("Are you sure you want to edit this item?")) {
                $.ajax({
                    url: '/order-item/edit/' + id, // Replace with your delete item route
                    type: 'GET',
                    success: function(response) {

                        $('#updateEditItemsModal').modal('toggle');
                        console.log(response.item);
                        
                        var item = JSON.parse(JSON.stringify(response.item));
                        $('#update_edit_order_item_id').val(item.id);
                        $('#update_edit_order_id').val(item.order_id);
                        $('#update_edit_product_id').val(item.product_id);
                        $('#update_edit_quantity').val(item.quantity);
                        $('#update_edit_unitprice').val(item.unit_price);
                        $('#update_edit_total_price').val(item.total_price);
                        $('#update_edit_sku').val(item.sku);
                        $('#update_edit_tax_rate').val(item.tax_rate);
                        $('#update_edit_tax_amount').val(item.tax_amount);
                        $('#update_edit_hit_discount').val(item.discount);
                        $('#update_edit_sub_total').val(item.sub_total);
                        $('#update_edit_product_name').val(item.product_name);

                        $('#update_edit_quantity, #update_edit_hit_discount').keyup(function(){
                           var new_quantity = $('#update_edit_quantity').val();
                           var new_discount = $('#update_edit_hit_discount').val();
                           
                        //    $('#update_edit_discount').change(function(){

                            var new_total_price = item.unit_price*new_quantity;
                            $('#update_edit_total_price').val(new_total_price);

                            var new_tax_amount = new_total_price *(item.tax_rate/100);
                            $('#update_edit_tax_amount').val(new_tax_amount);
                            var new_sub_total = new_tax_amount + new_total_price;
                            $('#update_edit_sub_total').val(new_sub_total-new_discount);

                        });
                        
                        // Toggles the modal visibility

                        let update_quantity = $('update_edit_quantity').val();
                            $('#update_edit_tick_check').hide();
                            // Attach change event listener to the select element
                            $('#update_edit_product_id').change(function() {
                                // Get the selected dealer ID
                                var selectedDealerId = $(this).children('option:selected').val(); // Get the value of the selected option
                                // alert('Selected Dealer ID:' + selectedDealerId);
                                $('#update_edit_tick_check').show();
                                $('#update_edit_product_id').css('background-color','rgba(72,235,150,0.5)');

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
                                        $('#update_edit_product_name').val(dealerDetails.product_name);
                                        $('#update_edit_total_price').val(dealerDetails.product_price);
                                        $('#update_edit_unitprice').val(dealerDetails.product_price);
                                        $('#update_edit_tax_rate').val(dealerDetails.product_taxrate);
                                        $('#update_edit_sku').val(dealerDetails.product_sku);
                                        var tax_amount = dealerDetails.product_price * (dealerDetails.product_taxrate / 100);
                                        $('#update_edit_tax_amount').val(tax_amount);   
                                        var sub_total = parseFloat(dealerDetails.product_price) + tax_amount;
                                        $('#update_edit_sub_total').val(sub_total);  
                                        $('#update_edit_quantity, #update_edit_hit_discount').keyup(function() {
                                            // Get the value of the input fields
                                            var quantity = $('#update_edit_quantity').val();
                                            var discount = $('#update_edit_hit_discount').val(); // Convert discount to a floating-point number
                                            // Perform any other action you want to do with the input values here
                                            // For example, update another element with the calculated total price
                                            var total_price = (dealerDetails.product_price * quantity) - discount;
                                            // alert(total_price);
                                            // var total_calculated_price = total_price.toLocalstring();
                                            $('#update_edit_product_name').val(dealerDetails.product_name);
                                            $('#update_edit_total_price').val(total_price);
                                            $('#update_edit_unitprice').val(dealerDetails.product_price);
                                            $('#update_edit_total_price').val(parseFloat(dealerDetails.product_price * quantity));
                                            $('#update_edit_sku').val(dealerDetails.product_sku);
                                            $('#update_edit_tax_rate').val(dealerDetails.product_taxrate);
                                            var tax_amount = total_price * (dealerDetails.product_taxrate / 100);
                                            
                                                $('#update_edit_tax_amount').val(tax_amount);                       
                                                 // $('#discount').val(dealerDetails.product_discount);
                                            var sub_total = total_price + tax_amount;
                                            $('#update_edit_sub_total').val(sub_total);
                                            // alert(sub_total);
                                        });  
                                        // Submit form data using AJAX when the form is submitted
                                        // Set the value of the input tag with id 'unitprice' to the product price
                                        // Calculate subtotal
                                    },
                                    error: function(xhr, status, error) {
                                       // Parse the response JSON to access the error messages
                                       var response = JSON.parse(xhr.responseText);
                                                    
                                                    // Check if the response contains errors
                                                    if (response.errors) {
                                                       // Initialize an empty string to store HTML markup for error messages
                                                    var errorMessageList = '';
                                                    
                                                    // Loop through each error and handle them
                                                    for (var key in response.errors) {
                                                        if (response.errors.hasOwnProperty(key)) {
                                                            // Get the error message for the current field
                                                            var errorMessage = response.errors[key][0];
                                                            
                                                            // Generate HTML markup for the error message and append it to errorMessageList
                                                            errorMessageList += '<p class="alert alert-danger">' + errorMessage + '</p>';
                                                        }
                                                    }
                                                    
                                                    // Append the HTML markup for error messages to the errorList element
                                                    $('#errorList').empty();
                                                    $('#errorList').html(errorMessageList);
                                                    $('#updateEditItemsModal').modal('toggle');
                                                     // Show the modal
                                                     $('#errorsModal').modal('show');
                                                    } else {
                                                        // If there are no specific errors, log the general error message
                                                        console.error('An error occurred:', error);
                                                    }
                                    }
                                });
                            });



                    },
                    error: function(xhr, status, error) {
                        alert('Failed to delete item: ' + error);
                    }
                });
            }
        // For now, let's just log the orderId
        // console.log('Order ID:', orderId);
    });




                                     $('#update_edit_items_form').submit(function(e) {
                                            e.preventDefault(); // Prevent the default form submission

                                        var id =  $('#update_edit_order_item_id').val();

                                        // alert(id);
                                            
                                            // Serialize form data
                                            var formData = $(this).serialize();

                                            // Send AJAX request
                                            $.ajax({
                                                url: '/update/order-items/'+id,
                                                type: 'POST',
                                                data: formData,
                                                success: function(response) {
                                                    $('#updateEditItemsModal').modal('toggle');

                                                    var tableBody = '';  

                                                    $.each(response.data, function(index, items) {
                                                            tableBody += '<tr>';
                                                            tableBody += '<td>' + (index + 1) + '</td>';
                                                            tableBody += '<td>' + items.product_name + '</td>';
                                                            tableBody += '<td>' + parseInt(items.quantity).toLocaleString() + '</td>';
                                                            tableBody += '<td>' + parseFloat(items.unit_price).toLocaleString() + '</td>';
                                                            tableBody += '<td>' + parseFloat(items.total_price).toLocaleString() + '</td>';
                                                            tableBody += '<td>' + parseFloat(items.tax_amount).toLocaleString() + '</td>';
                                                            tableBody += '<td>' + parseFloat(items.discount).toLocaleString() + '</td>';
                                                            tableBody += '<td>' + parseFloat(items.sub_total).toLocaleString() + '</td>';
                                                            tableBody += '<td>';
                                                            tableBody += '<a  class="edit-link" data-order-id="'+items.id+'"><i class="mdi mdi-pen"></i></a>';
                                                            tableBody += '&nbsp;&nbsp;&nbsp;';
                                                            tableBody += '<a class="delete-link" data-order-id="'+items.id+'" style="color:red;"><i class="mdi mdi-delete"></i></a>';
                                                            tableBody += '</td>';
                                                            tableBody += '</tr>';
                                                        });

                                                        $('#EditorderedItemsBody').html(tableBody);


                                                        $.each(response.data1, function(index,header){
                                                        // // <td id="preview_items"></td>
                                                        // //     <td id="preview_discount"></td>
                                                        // //     <td id="preview_total_amount"></td>
                                                        // $('#edit_order_status').val(header.order_status);
                                                        // $('#edit_shipping_address').val(header.shipping_address);
                                                        // $('#edit_billing_address').val(header.billing_address);
                                                        // $('#edit_dealer').val(header.dealer_id);
                                                        // $('#edit_comments').val(header.comments);
                                                        // $('#edit_return_rma').val(header.return_rma);
                                                        // $('#edit_priority').val(header.priority);
                                                        // $('#edit_order_source').val(header.order_source);
                                                        // $('#edit_order_notes').val(header.order_notes);
                                                        // $('#edit_expected_delivery_date').val(header.expected_delivery_date);
                                                        // $('#edit_shipping_tracking_number').val(header.shipping_tracking_number);
                                                        // $('#edit_shipping_carrier').val(header.shipping_carrier);
                                                        // $('#edit_shipping_method').val(header.sipping_method);
                                                        // $('#edit_payment_status').val(header.payment_status);
                                                        // $('#edit_payment_method').val(header.payment_method);
                                                        // $('#edit_billing_address').val(header.billing_address);
                                                        // $('#edit_shipping_address').val(header.shipping_address);
                                                        // $('#edit_representative').val(header.sales_representative);
                                                        // $('#addMoreItems #update_order_id').val(header.order_id);
                                                    $('#update_edit_items').html(parseInt(header.item_count).toLocaleString());
                                                    // $('#total_order_items_quantity').html(parseInt(header.item_count).toLocaleString());
                                                    // $('#total_order_subtotal').html(parseInt(header.item_count).toLocaleString());
                                                    $('#update_edit_discount').html(parseFloat(header.discount).toLocaleString());
                                                    $('#update_edit_total_amount').html(parseFloat(header.total_amount).toLocaleString());
                                                });

                                                $('#errorList').empty();



                                                $('#errorList').append('<li class="alert alert-success">' + response.message + '</li>');
                                                    // $('#updateEditItemsModal').modal('toggle');
                                                     // Show the modal
                                                     $('#errorsModal').modal('show');

                                                        // $('#EditorderedItemsBody').html(tableBody);

                                                    console.log(response);
                                                },
                                                error: function(xhr, status, error) {
                                                    // Parse the response JSON to access the error messages
                                                    var response = JSON.parse(xhr.responseText);
                                                    
                                                    // Check if the response contains errors
                                                    if (response.errors) {
                                                       // Initialize an empty string to store HTML markup for error messages
                                                    var errorMessageList = '';
                                                    
                                                    // Loop through each error and handle them
                                                    for (var key in response.errors) {
                                                        if (response.errors.hasOwnProperty(key)) {
                                                            // Get the error message for the current field
                                                            var errorMessage = response.errors[key][0];
                                                            
                                                            // Generate HTML markup for the error message and append it to errorMessageList
                                                            errorMessageList += '<p class="alert alert-danger">' + errorMessage + '</p>';
                                                        }
                                                    }
                                                    
                                                    // Append the HTML markup for error messages to the errorList element
                                                    $('#errorList').empty();
                                                    $('#errorList').html(errorMessageList);
                                                    $('#updateEditItemsModal').modal('toggle');
                                                     // Show the modal
                                                     $('#errorsModal').modal('show');
                                                    } else {
                                                        // If there are no specific errors, log the general error message
                                                        console.error('An error occurred:', error);
                                                    }
                                                }
                                            });
                                        });
                                       









        $('#sourceSelect').change(function(){
            var selectedItems = $(this).val();
            var displayText = '';
            for(var i=0; i<selectedItems.length; i++){
            displayText += selectedItems[i] + '<br>';
            }
            $('#selectedItems').html(displayText);
        });


        $('#edit_order_form').submit(function(event) {
            event.preventDefault(); // Prevent default form submission
            $('#editBackdrop').toggle('model');
            // $('#editBackdrop').hide('model');

            // Get the value of the selected radio button (order ID)
            var orderID = $("input[name='edit_order_id']:checked").val();
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
                        // console.log(response);
                        
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
                            tableBody += '<td>';
                            tableBody += '<a  class="edit-link" data-order-id="'+items.id+'"><i class="mdi mdi-pen"></i></a>';
                            tableBody += '&nbsp;&nbsp;&nbsp;';
                            tableBody += '<a class="delete-link" data-order-id="'+items.id+'" style="color:red;"><i class="mdi mdi-delete"></i></a>';
                            tableBody += '</td>';
                            tableBody += '</tr>';
                        });

                        $.each(response.previewheaders, function(index,header){
                            // <td id="preview_items"></td>
                            //     <td id="preview_discount"></td>
                            //     <td id="preview_total_amount"></td>
                            $('#edit_order_status').val(header.order_status);
                            $('#edit_shipping_address').val(header.shipping_address);
                            $('#edit_billing_address').val(header.billing_address);
                            $('#edit_dealer').val(header.dealer_id);
                            $('#edit_comments').val(header.comments);
                            $('#edit_return_rma').val(header.return_rma);
                            $('#edit_priority').val(header.priority);
                            $('#edit_order_source').val(header.order_source);
                            $('#edit_order_notes').val(header.order_notes);
                            $('#edit_expected_delivery_date').val(header.expected_delivery_date);
                            $('#edit_shipping_tracking_number').val(header.shipping_tracking_number);
                            $('#edit_shipping_carrier').val(header.shipping_carrier);
                            $('#edit_shipping_method').val(header.sipping_method);
                            $('#edit_payment_status').val(header.payment_status);
                            $('#edit_payment_method').val(header.payment_method);
                            $('#edit_billing_address').val(header.billing_address);
                            $('#edit_shipping_address').val(header.shipping_address);
                            $('#edit_representative').val(header.sales_representative);
                            $('#addMoreItems #update_order_id').val(header.order_id);





                        $('#update_edit_items').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_items_quantity').html(parseInt(header.item_count).toLocaleString());
                        // $('#total_order_subtotal').html(parseInt(header.item_count).toLocaleString());
                        $('#update_edit_discount').html(parseFloat(header.discount).toLocaleString());
                        $('#update_edit_total_amount').html(parseFloat(header.total_amount).toLocaleString());
                    });
                        $('#EditorderedItemsBody').html(tableBody);




                        let update_quantity = $('update_quantity').val();
                            $('#update_tick_check').hide();
                            // Attach change event listener to the select element
                            $('#addMoreItems #update_product_id').change(function() {
                                // Get the selected dealer ID
                                var selectedDealerId = $(this).children('option:selected').val(); // Get the value of the selected option
                                // alert('Selected Dealer ID:' + selectedDealerId);
                                $('#update_tick_check').show();
                                $('#update_product_id').css('background-color','rgba(72,235,150,0.5)');

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
                                        $('#update_product_name').val(dealerDetails.product_name);
                                        $('#update_total_price').val(dealerDetails.product_price);
                                        $('#update_unitprice').val(dealerDetails.product_price);
                                        $('#update_tax_rate').val(dealerDetails.product_taxrate);
                                        $('#update_sku').val(dealerDetails.product_sku);
                                        var tax_amount = dealerDetails.product_price * (dealerDetails.product_taxrate / 100);
                                        $('#update_tax_amount').val(tax_amount);   
                                        var sub_total = parseFloat(dealerDetails.product_price) + tax_amount;
                                        $('#update_sub_total').val(sub_total);  
                                        $('#update_quantity, #update_discount').keyup(function() {
                                            // Get the value of the input fields
                                            var quantity = $('#update_quantity').val();
                                            var discount = parseFloat($('#update_discount').val()); // Convert discount to a floating-point number
                                            // Perform any other action you want to do with the input values here
                                            // For example, update another element with the calculated total price
                                            var total_price = (dealerDetails.product_price * quantity) - discount;
                                            // alert(total_price);
                                            // var total_calculated_price = total_price.toLocalstring();
                                            $('#update_product_name').val(dealerDetails.product_name);
                                            $('#update_total_price').val(total_price);
                                            $('#update_unitprice').val(dealerDetails.product_price);
                                            $('#update_total_price').val(parseFloat(dealerDetails.product_price * quantity));
                                            $('#update_sku').val(dealerDetails.product_sku);
                                            $('#update_tax_rate').val(dealerDetails.product_taxrate);
                                            var tax_amount = total_price * (dealerDetails.product_taxrate / 100);
                                            
                                                $('#update_tax_amount').val(tax_amount);                        // $('#discount').val(dealerDetails.product_discount);
                                            var sub_total = total_price + tax_amount;
                                            $('#update_sub_total').val(sub_total);
                                            // alert(sub_total);
                                        });


                                            // Now you can access the inputValue variable outside of the event listener
                                            // For example, you can use it in another event listener or function
                                            $('#update_show-value').click(function() {
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
                        // });



                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            } else {
                // If no order is selected, display an error message or take appropriate action
                alert('Please select an order to edit.');
            }
        });


    //     $('#addSupplierForm').submit(function(event) {
    //     // Prevent default form submission
    //     event.preventDefault();

    //     // Serialize form data
    //     var formData = $(this).serialize();

    //     // Send AJAX request
    //     $.ajax({
            // url: "
    //  route('supplier.add') 
     
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
                
                        $('#errorList').empty();
                        // Append the HTML markup for error messages to the errorList element
                        $('#errorList').append('<p class="alert text-success">'+response.message+'</p>');
                        $('#errorsModal').modal('show');

                            // If AJAX request successful, close current accordion
                },
            error: function(xhr, status, error){
                            // Check if the response JSON contains errors
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Clear the existing content of the errorList element
                    $('#errorList').empty();
                    
                    // Initialize an empty string to store HTML markup for error messages
                    var errorMessageList = '';
                    
                    // Loop through each error and handle them
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        // Generate HTML markup for the error message and append it to errorMessageList
                        errorMessageList += '<p class="alert text-danger p-0">' + value[0] + '</p>';
                    });

                    // Append the HTML markup for error messages to the errorList element
                    $('#errorList').html(errorMessageList);
                    
                    // Show the modal containing error messages
                    $('#errorsModal').modal('show');
                }
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