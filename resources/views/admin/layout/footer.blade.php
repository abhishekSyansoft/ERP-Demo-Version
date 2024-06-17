   <!-- partial:partials/_footer.html -->
   <footer class="footer" style="background-color:white;color:black;">
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
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{asset('backend/js/jquery.cookie.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.tiny.cloud/1/hk0f0e88romq2xcsd198zlsl7nfw00tlegcbx29pr71q77l0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea'
    });
</script>
<script>
function toggleAccordion(element) {
    var content = element.nextElementSibling;
    if (content.style.display === "block") {
        content.style.display = "none";
    } else {
        content.style.display = "block";
    }
}
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(event) {
      var targetId = event.target.id;
      var element, opt;

      switch(targetId) {
        case 'printGRN':
          element = document.querySelector('#GRNiewModal .printContent');
          opt = {
            margin: 0.5,
            filename: 'Goods_Receiving_Note.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'A3', orientation: 'landscape' }
          };
          html2pdf().from(element).set(opt).save();
          break;
          
        case 'downloadPO':
          element = document.querySelector('#viewPOmodal .content-wrapper');
          opt = {
            margin: 0.5,
            filename: 'Purchase_Order.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'A4', orientation: 'portrait' }
          };
          html2pdf().from(element).set(opt).save();
          break;
          
        case 'rfqQUTLabel':
          element = document.querySelector('#rfqQUT .container');
          opt = {
            margin: 0.5,
            filename: 'quotation.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'A3', orientation: 'landscape' }
          };
          html2pdf().from(element).set(opt).save();
          break;
          
        case 'rfqViewModalLabel':
          element = document.querySelector('#rfqViewModal .container');
          opt = {
            margin: 0.5,
            filename: 'RFQ.pdf',
            image: { type: 'png', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'A4', orientation: 'landscape' }
          };
          html2pdf().from(element).set(opt).save();
          break;
          
        default:
          return; // Exit if no matching ID
      }
    });
  });

  function closeModal() {
    document.getElementById('viewPOmodal').style.display = 'none';
  }
</script>



     {{-- toastr js --}}
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

                <!-- Include the jsPDF library using the CDN -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
                <script>
                    // Your jQuery code
                    $(document).ready(function() {



                        $('#addSupplierModal #scraptype').on('change', function(e){
                        var type = $('#TACForm #scraptype').children('option:selected').val();

                            if( type != "From Inventory" ){

                            }else{
                                $('#addSupplierModal #grn_number').hide();
                                $('#addSupplierModal #dnn_number').hide();
                            }
                        });


                        // $('#downloadPO').on('click', function() {
                        //     try {
                        //         // Create a new jsPDF instance
                        //         const doc = new jsPDF();
                        //         // Clone the modal content
                        //         var modalContent = $('#viewPOmodal .content-wrapper').clone();

                        //         // Create a temporary container to hold the cloned content
                        //         var printableContent = $('<div></div>').append(modalContent);

                        //         // Apply inline styles to printableContent
                        //         printableContent.find('*').each(function() {
                        //             $(this).attr('style', $(this).attr('style')); // Copy existing styles to inline styles
                        //         });

                        //         // Append the temporary container to the body
                        //         $('body').append(printableContent);
                                                                    
                        //                     // Calculate the maximum width for content to fit on one page
                        //                     var maxWidth = 210; // A4 paper width - margin

                        //             // Check if the modal content width exceeds the maximum width
                        //             var modalWidth = modalContent.outerWidth();
                        //             if (modalWidth > maxWidth) {
                        //                 // Adjust the width of the modal content to fit within one page
                        //                 modalContent.css('width', maxWidth + 'mm');
                        //             }

                        //         // Apply styles for printing
                        //         printableContent.css({
                        //             'position': 'absolute',
                        //             'left': '0',
                        //             'top': '0',
                        //             'padding': '0',
                        //             'margin': '0',
                        //             'background-color': '#ffffff' // Set background color to white
                        //         });

                        //         html2canvas(printableContent[0], {
                        //             backgroundColor: 'white' // Set background color to white
                        //         }).then(function(canvas) {
                        //             // Create a new jsPDF instance
                        //             const doc = new jsPDF({
                        //                 unit: 'mm',
                        //                 format: [canvas.width * 0.26583, canvas.height * 0.26083] // Convert canvas size from pixels to millimeters
                        //             });

                        //                 // Save canvas as image
                        //                 var imgData = canvas.toDataURL('image/jpeg');

                        //                 // Add image to PDF
                        //                 doc.addImage(imgData, 'JPEG', 0, 0);

                        //               // Generate a random number between 0 and 9999
                        //             const randomNumber = Math.floor(Math.random() * 10000);

                        //             // Construct the file name with the random number and the ".pdf" extension
                        //             const fileName = `PO_${randomNumber}.pdf`;

                        //             // Save the PDF file with the random name
                        //             doc.save(fileName);
                        //             });
                        //         // Save the PDF file
                        //         // doc.save("output.pdf");

                             
                        //     } catch (error) {
                        //         console.error('An error occurred while generating PDF:', error);
                        //     }
                        // });



                        $('#downloadInvoiceModal .printInvoice').on('click', function(e) {
                            try {
                                e.preventDefault();
                                // Create a new jsPDF instance
                                const doc = new jsPDF();
                                // Clone the modal content
                                var modalContent = $('#downloadInvoiceModal .content-wrapper').clone();

                                // Create a temporary container to hold the cloned content
                                var printableContent = $('<div></div>').append(modalContent);

                                // Apply inline styles to printableContent
                                printableContent.find('*').each(function() {
                                    $(this).attr('style', $(this).attr('style')); // Copy existing styles to inline styles
                                });

                                // Append the temporary container to the body
                                $('body').append(printableContent);

                                                                    
                                            // Calculate the maximum width for content to fit on one page
                                            var maxWidth = 210 - 20; // A4 paper width - margin

                                    // Check if the modal content width exceeds the maximum width
                                    var modalWidth = modalContent.outerWidth();
                                    if (modalWidth > maxWidth) {
                                        // Adjust the width of the modal content to fit within one page
                                        modalContent.css('width', maxWidth + 'mm');
                                    }

                                // Apply styles for printing
                                printableContent.css({
                                    'position': 'absolute',
                                    'left': '0',
                                    'top': '0',
                                    'padding': '0',
                                    'margin': '0',
                                    'background-color': '#ffffff' // Set background color to white
                                });

                                html2canvas(printableContent[0], {
                                    backgroundColor: 'white' // Set background color to white
                                }).then(function(canvas) {
                                    // Create a new jsPDF instance
                                    const doc = new jsPDF({
                                        unit: 'mm',
                                        format: [canvas.width * 0.26583, canvas.height * 0.27083] // Convert canvas size from pixels to millimeters
                                    });

                                        // Save canvas as image
                                        var imgData = canvas.toDataURL('image/jpeg');

                                        // Add image to PDF
                                        doc.addImage(imgData, 'JPEG', 0, 0);

                                      // Generate a random number between 0 and 9999
                                    const randomNumber = Math.floor(Math.random() * 10000);

                                    // Construct the file name with the random number and the ".pdf" extension
                                    const fileName = `INV_${randomNumber}.pdf`;

                                    // Save the PDF file with the random name
                                    doc.save(fileName);
                                    });
                                // Save the PDF file
                                // doc.save("output.pdf");

                             
                            } catch (error) {
                                console.error('An error occurred while generating PDF:', error);
                            }
                        });


                    });

                </script>

     <script>



    $(document).ready(function() {
        
        $('.vehicleQRCode').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get the order ID from the data attribute
                var id = $(this).data('code-id');

                // Get the CSRF token value from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Make AJAX call with the id and CSRF token
                $.ajax({
                    url: '/generate_qrcode_vehicle',
                    type: 'POST', // or 'GET', depending on your server endpoint
                    data: {
                        id: id,
                        _token: csrfToken // Include the CSRF token in the data
                    },
                    success: function(response) {
                        // Handle the AJAX response here
                        $('#messageModal').modal('show');
                        $('#messageModal').on('hidden.bs.modal', function (e) {
                            // Reload the page when the modal is closed
                            window.location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors here
                        console.error(xhr.responseText);
                    }
                });
            });


            $('#TACForm #part_number').on('keyup',function(){
                var id = $('#part_number').val();

                  // Get the CSRF token value from the meta tag
                  var csrfToken = $('meta[name="csrf-token"]').attr('content');

                  // Make AJAX call
                    $.ajax({
                        url: '/fetch-part-details', // Specify your endpoint URL
                        type: 'POST', // Or 'GET' depending on your server route
                        data: {
                                id: id,
                                _token: csrfToken // Include the CSRF token in the data
                            }, // Send the order ID in the request
                        success: function(response) {

                            // console.log(response.part);
                            var part = response.part;

                            $('#TACForm #serial_number').val(part.serial_number);
                            $('#TACForm #vehicle').val(part.vehicle);
                            var createdDate = new Date(part.created_at);
                            var formattedCreatedDate = createdDate.toISOString().slice(0,10); // toISOString() provides the date in "YYYY-MM-DDTHH:mm:ss" format
                            $('#TACForm #received_date').val(formattedCreatedDate);

                            var updatedDate = new Date(part.updated_at);
                            var formattedUpdatedDate = updatedDate.toISOString().slice(0,10);
                            $('#TACForm #updated_date').val(formattedUpdatedDate);
                            $('#TACForm #reorder_point').val(part.min_stock_level);
                            $('#TACForm #condition').val(part.condition);
                            $('#TACForm #location').val(part.location);
                            $('#TACForm #availability').val(part.condition);
                            $('#TACForm #min_stock_level').val(part.min_stock_level);
                            $('#TACForm #max_stock_level').val(part.max_stock_level);
                            $('#TACForm #part_description').val(part.part_description);
                            $('#TACForm #quality_control_details').val(part.condition);
                            $('#TACForm #supplier_id').val(part.supplier_id);
                            $('#TACForm #qrcode').val(part.qrcode);
                            $('#TACForm #barcode').val(part.barcode);
                            // var Unit_cost = parseFloat(part.unit_cost);
                            // var qty_on_hand = parseFloat(part.qty_on_hand);
                            $('#TACForm #unit_cost').val(part.unit_cost);
                            $('#TACForm #qty_on_hand').val(part.qty_on_hand);

                            // Calculate total cost
                            var total_cost = part.unit_cost * part.qty_on_hand;
                            // Set total cost in number format
                            $('#TACForm #total_cost').val(total_cost);
                            // $('#TACForm #condition').val(part.condition);
                            // $('#TACForm #condition').val(part.condition);
                            // $('#TACForm #condition').val(part.condition);
                            // $('#TACForm #condition').val(part.condition);
                            // $('#TACForm #condition').val(part.condition);


                        },
                        error: function(xhr, status, error) {
                            // Handle any errors
                            console.error('Error:', error);
                        }
                    });
            })


            $('.vehicleBarcode').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get the order ID from the data attribute
                var id = $(this).data('barcode-id');

                // Get the CSRF token value from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Make AJAX call with the id and CSRF token
                $.ajax({
                    url: '/generate_barcode_vehicle',
                    type: 'POST', // or 'GET', depending on your server endpoint
                    data: {
                        id: id,
                        _token: csrfToken // Include the CSRF token in the data
                    },
                    success: function(response) {
                        // Handle the AJAX response here
                        $('#messageModal').modal('show');
                        $('#messageModal').on('hidden.bs.modal', function (e) {
                            // Reload the page when the modal is closed
                            window.location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors here
                        console.error(xhr.responseText);
                    }
                });
            });




            $('.warehouseQRCode').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get the order ID from the data attribute
                var id = $(this).data('code-id');

                // Get the CSRF token value from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Make AJAX call with the id and CSRF token
                $.ajax({
                    url: '/generate_qrcode_warehouse',
                    type: 'POST', // or 'GET', depending on your server endpoint
                    data: {
                        id: id,
                        _token: csrfToken // Include the CSRF token in the data
                    },
                    success: function(response) {
                        // Handle the AJAX response here
                        $('#messageModal').modal('show');
                        $('#messageModal').on('hidden.bs.modal', function (e) {
                            // Reload the page when the modal is closed
                            window.location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors here
                        console.error(xhr.responseText);
                    }
                });
            });


            $('.warehouseBarcode').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get the order ID from the data attribute
                var id = $(this).data('barcode-id');

                // Get the CSRF token value from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Make AJAX call with the id and CSRF token
                $.ajax({
                    url: '/generate_barcode_warehouse',
                    type: 'POST', // or 'GET', depending on your server endpoint
                    data: {
                        id: id,
                        _token: csrfToken // Include the CSRF token in the data
                    },
                    success: function(response) {
                        // Handle the AJAX response here
                        $('#messageModal').modal('show');
                        $('#messageModal').on('hidden.bs.modal', function (e) {
                            // Reload the page when the modal is closed
                            window.location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors here
                        console.error(xhr.responseText);
                    }
                });
            });




        $('.cqfi').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get the order ID from the data attribute
                var id = $(this).data('code-id');

                // Get the CSRF token value from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Make AJAX call with the id and CSRF token
                $.ajax({
                    url: '/generate_qrcode',
                    type: 'POST', // or 'GET', depending on your server endpoint
                    data: {
                        id: id,
                        _token: csrfToken // Include the CSRF token in the data
                    },
                    success: function(response) {
                        // Handle the AJAX response here
                        $('#messageModal').modal('show');
                        $('#messageModal').on('hidden.bs.modal', function (e) {
                            // Reload the page when the modal is closed
                            window.location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors here
                        console.error(xhr.responseText);
                    }
                });
            });


            $('.cbfi').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get the order ID from the data attribute
                var id = $(this).data('barcode-id');

                // Get the CSRF token value from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Make AJAX call with the id and CSRF token
                $.ajax({
                    url: '/generate_barcode',
                    type: 'POST', // or 'GET', depending on your server endpoint
                    data: {
                        id: id,
                        _token: csrfToken // Include the CSRF token in the data
                    },
                    success: function(response) {
                        // Handle the AJAX response here
                          // Handle the AJAX response here
                          $('#messageModal').modal('show');
                        $('#messageModal').on('hidden.bs.modal', function (e) {
                            // Reload the page when the modal is closed
                            window.location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors here
                        console.error(xhr.responseText);
                    }
                });
            });


             // When the modal is shown
             $('#vehiclesBarcodeModal').on('show.bs.modal', function (event) {
                    // Get the button that triggered the modal
                    var button = $(event.relatedTarget);
                    // Extract URL from data attribute
                    var qrcodeUrl = button.data('barcode');
                    // Update the src attribute of the QR code image
                    $('#barcodeImageUrl').attr('src', qrcodeUrl);
                });

                $('#warehouseQrcodeModal').on('show.bs.modal', function (event) {
                    // Get the button that triggered the modal
                    var button = $(event.relatedTarget);
                    // Extract URL from data attribute
                    var qrcodeUrl = button.data('qrcode');
                    // Update the src attribute of the QR code image
                    $('#qrcodeImage').attr('src', qrcodeUrl);
                });



                $('#warehouseBarcodeModal').on('show.bs.modal', function (event) {
                    // Get the button that triggered the modal
                    var button = $(event.relatedTarget);
                    // Extract URL from data attribute
                    var qrcodeUrl = button.data('barcode');
                    // Update the src attribute of the QR code image
                    $('#barcodeImageUrl').attr('src', qrcodeUrl);
                });

                $('#vehiclesQrcodeModal').on('show.bs.modal', function (event) {
                    // Get the button that triggered the modal
                    var button = $(event.relatedTarget);
                    // Extract URL from data attribute
                    var qrcodeUrl = button.data('qrcode');
                    // Update the src attribute of the QR code image
                    $('#qrcodeImage').attr('src', qrcodeUrl);
                });



                // When the modal is shown
                $('#qrcodeModal').on('show.bs.modal', function (event) {
                    // Get the button that triggered the modal
                    var button = $(event.relatedTarget);
                    // Extract URL from data attribute
                    var qrcodeUrl = button.data('qrcode');
                    // Update the src attribute of the QR code image
                    $('#qrcodeImage').attr('src', qrcodeUrl);
                });

                // When the modal is shown
                $('#VehiclesImageModal').on('show.bs.modal', function (event) {
                    // Get the button that triggered the modal
                    var button = $(event.relatedTarget);
                    // Extract URL from data attribute
                    var qrcodeUrl = button.data('id');
                    // alert(qrcodeUrl);
                    // Update the src attribute of the QR code image
                    $('#vehicleImageUrl').attr('src', qrcodeUrl);
                });


                 // When the modal is shown
                 $('#VehiclesIdendificationDoc').on('show.bs.modal', function (event) {
                    // Get the button that triggered the modal
                    var button = $(event.relatedTarget);
                    // Extract URL from data attribute
                    var qrcodeUrl = button.data('id');
                    alert(qrcodeUrl);
                    // Update the src attribute of the QR code image
                    $('#document').attr('src', qrcodeUrl);
                });

                 // When the modal is shown
                 $('#partImageModal').on('show.bs.modal', function (event) {
                    // Get the button that triggered the modal
                    var button = $(event.relatedTarget);
                    // Extract URL from data attribute
                    var qrcodeUrl = button.data('id');
                    // Update the src attribute of the QR code image
                    $('#partImageUrl').attr('src', qrcodeUrl);
                });

                // When the modal is shown
                $('#barcodeModal').on('show.bs.modal', function (event) {
                    // Get the button that triggered the modal
                    var button = $(event.relatedTarget);
                    // Extract URL from data attribute
                    var barcodeUrl = button.data('barcode');
                    // Update the src attribute of the QR code image
                    $('#barcodeImageUrl').attr('src', barcodeUrl);
                });

    $('input').addClass('scrollable-placeholder');

        $('#PRAddModalForm #order_id').on('change', function() {
            // Log a message to confirm the event listener is triggered
            // alert('Keyup event triggered');
            
            // Get the entered value
            var orderId = $(this).children('option:selected').html();
            
            // Log the entered value
            // alert('Entered Order ID:', orderId);
            
            // You can perform further actions here, such as making an AJAX request to fetch data related to the entered order_id.
        });






        $('#rawMaterialForm')




        // Declare formDataArray outside the document ready function
        var formDataArray = [];     

                // Handle form submission
                    $('#addItemModalTestForm').submit(function(event) {
                        event.preventDefault(); // Prevent default form submission
                        console.clear(); // Clear console
                        var formData = $(this).serialize(); // Serialize form data

                        // Push form data into the array
                        formDataArray.push(formData);

                        // Create a new row for the table
                        var newRow = $('<tr>');

                        // Add data from the form to the new row
                        // newRow.append('<td>' + (formDataArray.length) + '</td>'); // Index number
                        newRow.append('<td>' + $('#product_id option:selected').text() + '</td>'); // Product Name
                        newRow.append('<td hidden>' + $('#order_id').val() + '</td>'); // Order ID
                        newRow.append('<td hidden>' + $('#product_id').val() + '</td>'); // Product ID
                        newRow.append('<td hidden>' + $('#sku').val() + '</td>'); // SKU
                        newRow.append('<td>' + $('#unitprice').val() + '</td>'); // Unit Price
                        newRow.append('<td>' + $('#quantity').val() + '</td>'); // Quantity
                        newRow.append('<td>' + $('#total_price').val() + '</td>'); // SKU
                        newRow.append('<td>' + $('#tax_rate').val() + '</td>'); // Tax Rate
                        newRow.append('<td>' + $('#tax_amount').val() + '</td>'); // Tax Amount
                        newRow.append('<td>' + $('#discount').val() + '</td>'); // Discount
                        newRow.append('<td>' + $('#sub_total').val() + '</td>'); // Sub Total
                        newRow.append('<td><a style="color:red;cursor:pointer;" id="testOrderDelete" class="mdi mdi-delete"></a></td>');
                        newRow.append('</tr>'); // Sub Total

                        // Append the new row to the table body
                        $('#orderItemTest').append(newRow);
                        

                        // Clear the form fields after submission
                        $('#addItemModalTestForm')[0].reset();

                        // Close the modal
                        $('#addItemModalTest').modal('hide');

                        
                        function parseFormData(formDataArray) {
                    var formData = {}; // Object to store form data

                    // Split the string by '&' to get individual key-value pairs
                    var keyValuePairs = formDataArray.split('&');

                    // Loop through each key-value pair
                    keyValuePairs.forEach(function(pair) {
                        // Split each pair by '=' to separate key and value
                        var keyValue = pair.split('=');
                        var key = decodeURIComponent(keyValue[0]); // Decode URI component for the key
                        var value = decodeURIComponent(keyValue[1]); // Decode URI component for the value
                        if (key !== '_token') { // Skip adding the token field to formData
                            formData[key] = value; // Add key-value pair to formData object
                        }
                        // formData[key] = value; // Add key-value pair to formData object
                    });

                    return formData;
                }

                // Function to parse all form data strings in the array
                function parseAllFormData(formDataArray) {
                    var allFormData = []; // Array to store parsed form data

                    // Loop through each form data string
                    formDataArray.forEach(function(formDataArray) {
                        // Parse the form data string and add to the array
                        var parsedFormData = parseFormData(formDataArray);
                        allFormData.push(parsedFormData);
                    });

                    return allFormData;
                }

                // Parse all form data strings
                var parsedFormData = parseAllFormData(formDataArray);

                // Log the parsed form data
                // console.log(parsedFormData);
                $('#orderItemTest').on('click','#testOrderDelete',function(){
                    var row = $(this).closest('tr').remove();
                    console.clear();
                    
                    // Remove the corresponding data from the parsedFormData array
                    var index = row.index();
                    parsedFormData.splice(index, 1);

                    return parsedFormData;
                    // Remove the row from the DOM
                    row.remove();
                })
             });

             
             $('.itemListsBTNSales').on('click', function(){
                // Get the order ID from the data attribute
                var id = $(this).data('id');
                // alert(id);
              
                // Send the order ID as data in the AJAX request
                $.ajax({
                    url: '/fetch_order_item_lists_sales',
                    method: 'POST',
                    data: { id: id }, // Pass id as an object
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    success: function(response) {
                        // Close all modals on success
                       console.log(response);
                        $('#staticBackdrop').modal('show');

                        // Optionally, you can redirect the user to a success page or perform any other actions
                            var tableBody = '';
                            
                            $.each(response.orderitems, function(index, item) {
                                tableBody += '<tr>';
                                tableBody += '<td>' + (index + 1) + '</td>';
                                tableBody += '<td>' + item.vehicle + '</td>';
                                tableBody += '<td>' + item.category + '</td>';
                                tableBody += '<td>' + item.part_number + '</td>';
                                tableBody += '<td>' + item.part_name + '</td>';
                                tableBody += '<td>' + parseInt(item.unit_price).toLocaleString() + '</td>';
                                tableBody += '<td>' + parseFloat(item.quantity).toLocaleString() + '</td>';
                                tableBody += '<td>' + parseFloat(item.total_price).toLocaleString() + '</td>';
                                tableBody += '</tr>';

                                
                            });

                            $('#staticBackdrop #OrdereditemlistsPO').html(tableBody);


                        // Other actions after successful AJAX call
                    },
                    error: function(xhr, status, error) {
                        // Error handling
                    }
                });
            });




            $('.fileAudit').on('click', function(event){
                event.preventDefault();
                var id = $(this).data('id');

                $('#addSupplierModal #inventory_id').val(id);
                
                $('#addSupplierModal').modal('show');
            })



            $('.viewAuditReport').on('click', function(event){
                event.preventDefault();
                var id = $(this).data('id');

                // alert(id);

                 // Send the order ID as data in the AJAX request
                 $.ajax({
                    url: '/fetch_audit_report',
                    method: 'POST',
                    data: { id: id }, // Pass id as an object
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    success: function(response) {
                        // Close all modals on success
                       console.log(response);

                       $('#staticBackdrop #date').text(response.date);
                       $('#staticBackdrop #name').text(response.name);
                        // Set the href attribute of the file link
                       $('#staticBackdrop #file').attr('href', 'Storage/'+response.file);
                        $('#staticBackdrop').modal('show');


                        // Other actions after successful AJAX call
                    },
                    error: function(xhr, status, error) {
                        // Error handling
                          // Handle any errors
                          console.error('Error:', error);
                    }
                });
            });

            // })




             $('.itemListsBTN').on('click', function(){
                // Get the order ID from the data attribute
                var id = $(this).data('id');
                // alert(id);
              
                // Send the order ID as data in the AJAX request
                $.ajax({
                    url: '/fetch_order_item_lists',
                    method: 'POST',
                    data: { id: id }, // Pass id as an object
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    success: function(response) {
                        // Close all modals on success
                    //    console.log(response);
                        $('#staticBackdrop').modal('show');

                        // Optionally, you can redirect the user to a success page or perform any other actions
                            var tableBody = '';
                            
                            $.each(response.orderitems, function(index, item) {
                                tableBody += '<tr>';
                                tableBody += '<td>' + (index + 1) + '</td>';
                                tableBody += '<td>' + item.vehicle + '</td>';
                                tableBody += '<td>' + item.category + '</td>';
                                tableBody += '<td>' + item.part_number + '</td>';
                                tableBody += '<td>' + item.part_name + '</td>';
                                tableBody += '<td>' + parseInt(item.unit_price).toLocaleString() + '</td>';
                                tableBody += '<td>' + parseFloat(item.quantity).toLocaleString() + '</td>';
                                tableBody += '<td>' + parseFloat(item.total_price).toLocaleString() + '</td>';
                                tableBody += '</tr>';

                                
                            });

                            $('#staticBackdrop #OrdereditemlistsPO').html(tableBody);


                        // Other actions after successful AJAX call
                    },
                    error: function(xhr, status, error) {
                        // Error handling
                    }
                });
            });

            $('#printPO').on('click', function() {
                // Clone the modal content
                var modalContent = $('#viewPOmodal .modal-content .content-wrapper').clone();

                // Create a temporary container to hold the cloned content
                var printableContent = $('<div></div>').append(modalContent);

                // Append the temporary container to the body
                $('body').append(printableContent);

                // Calculate the maximum width for content to fit on one page
                var maxWidth = 210 - 20; // A4 paper width - margin

                // Check if the modal content width exceeds the maximum width
                var modalWidth = modalContent.outerWidth();
                if (modalWidth > maxWidth) {
                    // Adjust the width of the modal content to fit within one page
                    modalContent.css('width', maxWidth + 'mm');
                }

                // Apply styles for printing
                printableContent.css({
                    'position': 'absolute',
                    'left': '0',
                    'top': '0',
                    'width': '215mm', // A4 paper width
                    'height': '297mm', // A4 paper height
                    'padding': '0',
                    'margin': '0',
                });

                // Apply styles to modal content
                modalContent.css({
                    'overflow': 'auto' // Enable scrolling if content exceeds page size
                });

                // Print the content
                window.print();

            });







            $('.itemListsPOBTN').on('click', function(){
                // Get the order ID from the data attribute
                var id = $(this).data('id');
              
                // Send the order ID as data in the AJAX request
                $.ajax({
                    url: '/fetch_order_item_data',
                    method: 'POST',
                    data: { id: id }, // Pass id as an object
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    success: function(response) {
                        // Close all modals on success
                    //    console.log(response);
                        $('#viewPOmodal').modal('show');

                        var orderDetails = response.orderDetails;
                        var supplier = response.supplier;


                        $('#viewPOmodal #vendor_street_address').text(supplier.address + ', ' +supplier.city + ', '+supplier.state + ' ' +supplier.postal_code + ', ' +supplier.country);
                        $('#viewPOmodal #vendor_phone').text(supplier.phone_number);
                        $('#viewPOmodal #vendor_email').text(supplier.email);
                        $('#viewPOmodal #vendor_name').text(supplier.cotact_person);
                        $('#viewPOmodal #vendor_gstin').text(supplier.tax_id);
                        $('#viewPOmodal #order_id').text(orderDetails.po_id);
                        $('#viewPOmodal #billing_street_address').text(orderDetails.billing_address);
                        $('#viewPOmodal #billing_address').text(orderDetails.billing_city + ', '+orderDetails.billing_state + ' ' +orderDetails.billing_pincode);
                        $('#viewPOmodal #shipping_street_address').text(orderDetails.delivery_address + ', ' +orderDetails.delivery_city + ', '+orderDetails.delivery_state + ' ' +orderDetails.delivery_pincode);
                        $('#viewPOmodal #order_date').text(orderDetails.order_date);
                        $('#viewPOmodal #expected_delivery_date').text(orderDetails.delivery_date);
                        $('#viewPOmodal #lead_time').text(orderDetails.payment_terms);
                        $('#viewPOmodal #total_quantity').text(parseFloat(orderDetails.total_qty).toLocaleString());
                        $('#viewPOmodal #line_item_total').text(parseFloat(orderDetails.line_amount_total).toLocaleString());
                        $('#viewPOmodal #total_items').text(orderDetails.total_unit);
                        $('#viewPOmodal #delivery_method').text(orderDetails.shipping_method);
                        var tax = orderDetails.line_amount_total * (18/100);
                        var total =  parseFloat(orderDetails.line_amount_total);
                        var sgst = tax/2;
                        var cgst = tax/2;
                        var handling = 200;
                        var other = 1000;
                        var final = sgst + cgst + handling + other + total;
                        $('#viewPOmodal #sgst').text(parseFloat(sgst).toLocaleString());
                        $('#viewPOmodal #cgst').text(parseFloat(cgst).toLocaleString());
                        $('#viewPOmodal #handling').text(parseFloat(handling).toLocaleString());
                        $('#viewPOmodal #other').text(parseFloat(other).toLocaleString());
                        $('#viewPOmodal #final').text(parseFloat(final).toLocaleString());
                        // Optionally, you can redirect the user to a success page or perform any other actions
                            var tableBody = '';

                              // Clear previous items
                                $('.item_code, .item_name, .item_category, .item_vehicle, .item_unit_price, .item_quantity, .item_total').empty();

                                $.each(response.orderitems, function(index, item) {
                                    var unit_price = parseFloat(item.unit_price).toLocaleString();
                                    var total_price = parseFloat(item.total_price).toLocaleString();
                                    $('.item_code').append(item.part_number + '<br>');
                                    $('.item_name').append(item.part_name + '<br>');
                                    $('.item_category').append(item.category + '<br>');
                                    $('.item_vehicle').append(item.vehicle + '<br>');
                                    $('.item_unit_price').append(unit_price + '<br>');
                                    $('.item_quantity').append(item.quantity + '<br>');
                                    $('.item_total').append(total_price + '<br>');
                                });

                            $('#viewPOmodal #table_items_po #table_items_po_tbl_bdy').append(tableBody);
                            console.clear();


                        // Other actions after successful AJAX call
                    },
                    error: function(xhr, status, error) {
                        // Error handling
                    }
                });
            });


                $('#PRAddModalForm #supplier').on('keyup',function(){
                var id = $('#PRAddModalForm #supplier').val();
                // alert(id);
                
                  // Get the CSRF token value from the meta tag
                  var csrfToken = $('meta[name="csrf-token"]').attr('content');

                  // Make AJAX call
                    $.ajax({
                        url: '/fetch-supplier-details', // Specify your endpoint URL
                        type: 'POST', // Or 'GET' depending on your server route
                        data: {
                                id: id,
                                _token: csrfToken // Include the CSRF token in the data
                            }, // Send the order ID in the request
                        success: function(response) {

                            // console.log(response);
                           
                            var supplier = response.supplier;
                            $('#PRAddModalForm #supplier_phone').val(supplier.phone_number);
                            $('#PRAddModalForm #supplier_email').val(supplier.email);
                            $('#PRAddModalForm #supplier_person').val(supplier.contact_person);

                        },
                        error: function(xhr, status, error) {
                            // Handle any errors
                            console.error('Error:', error);
                        }
                    });
                })


                $('#PRAddModalForm #req_name').on('keyup',function(){
                var id = $('#PRAddModalForm #req_name').val();
                
                  // Get the CSRF token value from the meta tag
                  var csrfToken = $('meta[name="csrf-token"]').attr('content');

                  // Make AJAX call
                    $.ajax({
                        url: '/fetch-requisitioner-details', // Specify your endpoint URL
                        type: 'POST', // Or 'GET' depending on your server route
                        data: {
                                id: id,
                                _token: csrfToken // Include the CSRF token in the data
                            }, // Send the order ID in the request
                        success: function(response) {

                            // console.log(response);
                           
                            var requisitioner = response.requisitioner;
                            $('#PRAddModalForm #req_phone').val(requisitioner.phone);
                            $('#PRAddModalForm #req_email').val(requisitioner.email);
                            $('#PRAddModalForm #req_desig').val(requisitioner.designation);

                        },
                        error: function(xhr, status, error) {
                            // Handle any errors
                            console.error('Error:', error);
                        }
                    });
                })







                $('#quotationCreateForm').on('submit',function(event){
                    event.preventDefault(); // Prevent default form submission
                    // Serialize form data
                     // Serialize form data
                    var formData = $(this).serialize();
                   
                    var dataToSend = [];

                        // Loop through each row of the table
                        $("#quotationCreateForm #itemlistsQUT tr").each(function() {
                            var rowData = {};

                            // Loop through each cell of the current row
                            $(this).find("td").each(function() {
                                // Get the column name from the table header
                                var columnName = $(this).closest('table').find('th').eq($(this).index()).text().trim();
                                
                                // Get the text content of the cell
                                var cellData = $(this).text().trim();
                                
                                // Add cell data to rowData with column name as key
                                rowData[columnName] = cellData;
                            });

                            // Push the rowData object to dataToSend array
                            dataToSend.push(rowData);
                        });

                        // Send data to server via AJAX
                        sendDataToQUTItemLists(dataToSend);

                        console.log(dataToSend);
                    // AJAX request
                    $.ajax({
                        url: '{{ route("quotation.store") }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        success: function(response) {

                            // location.reload();
                            // console.log(response);
                            // Handle success response from the server
                            $('#updateQuotation').modal('hide');


                            toastr.options = {
                                "timeOut": "3000",
                                "toastClass": "toast-green",
                                "extendedTimeOut": "2000",
                                "progressBar": true,
                                "closeButton": true,
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut",
                                "progressBarBgColor": "#ff0000",
                                "preventDuplicates": true,
                                "onHidden": function() {
                                    window.location.reload(); // Reload the page when the toastr is hidden
                                }

                            };
                            toastr.success('Quotation Created Successfully');
                           

                        },
                        error: function(xhr, status, error) {
                             // Handle error response from the server
                                console.error('Error:', error);

                           // Show validation errors in a toaster
                            var errorMessage = 'Oops! Some fields are missing';
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                errorMessage = '<ul>'; // Start the unordered list
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    errorMessage += '<li>' + value.join('</li><li>') + '</li>'; // Add each error message as a list item
                                });
                                errorMessage += '</ul>'; // End the unordered list
                            }


                            toastr.error(errorMessage, 'Validation Error', {
                                    "timeOut": "5000", // Set the time the notification stays visible (in milliseconds)
                                    "toastClass": "toast-red", // Add custom class to the notification
                                    "extendedTimeOut": "2000", // Set the duration of the extended timeout for mouse hover (in milliseconds)
                                    "progressBar": true, // Show a progress bar for timing of the notification
                                    "closeButton": true, // Show a close button for the notification
                                    "positionClass": "toast-top-right", // Set the position of the notification
                                    "showDuration": "300", // Set the duration of the show animation (in milliseconds)
                                    "hideDuration": "1000", // Set the duration of the hide animation (in milliseconds)
                                    "showEasing": "swing", // Set the easing of the show animation
                                    "hideEasing": "linear", // Set the easing of the hide animation
                                    "showMethod": "fadeIn", // Set the method of showing the notification
                                    "hideMethod": "fadeOut", // Set the method of hiding the notification
                                    "progressBarBgColor": "#ff0000", // Set the background color of the progress bar
                                    "preventDuplicates": true // Prevent duplicate notifications from being shown
                                });
                        }
                    });

                    });




                        // Set up AJAX to include the CSRF token
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });


                            $('#gateEntryForm #po_number').on('keyup', function(event){
                                event.preventDefault();
                                var id = $(this).val();
                                
                                                    
                                    // Get the CSRF token value from the meta tag
                                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                                        // Make AJAX call
                                        $.ajax({
                                            url: '/fetch-order-details-inv-erp', // Specify your endpoint URL
                                            type: 'POST', // Or 'GET' depending on your server route
                                            data: {
                                                    id: id,
                                                    _token: csrfToken // Include the CSRF token in the data
                                                }, // Send the order ID in the request
                                            success: function(response) {

                                                console.log(response.items);
                                                
                                                var order_date = response.order_date;
                                                $('#gateEntryForm #order_date').val(order_date);
                                                var partNumbers = [];
                                                var partNames = [];

                                                $.each(response.items, function(index, item) {
                                                    partNumbers.push(item.part_number);
                                                    partNames.push(item.part_name);
                                                });

                                                $('#gateEntryForm #item_id').val(partNumbers.join(', '));
                                                $('#gateEntryForm #item_name').val(partNames.join(', '));
                                            },
                                            error: function(xhr, status, error) {
                                                // Handle any errors
                                                console.error('Error:', error);
                                            }
                                        });

                                     })


                                     $('#inspectionForm #dnn').on('keyup',function(e){
                                        e.preventDefault();  //remove any further function from the background
                                        var id = $(this).val();  //get the DNN number form the form
                                         // Get the CSRF token value from the meta tag
                                        var csrfToken = $('meta[name="csrf-token"]').attr('content');

                                            // Make AJAX call
                                            $.ajax({
                                                url: '/fetch-dnn-details-inv-erp', // Specify your endpoint URL
                                                type: 'POST', // Or 'GET' depending on your server route
                                                data: {
                                                        id: id,
                                                        _token: csrfToken // Include the CSRF token in the data
                                                    }, // Send the order ID in the request
                                                success: function(response) {

                                                    // console.log(response);
                                                    $('#inspectionForm #po_num').val(response.po_number);
                                                    $('#inspectionForm #ordered_qty').val(response.qty_ordered);
                                                    
                                                  
                                                },
                                                error: function(xhr, status, error) {
                                                    // Handle any errors
                                                    console.error('Error:', error);
                                                }
                                            });

                                        })

//                                         $('#printGRN').on('click', function(event) {
//     try {
//         // Clone the modal content
//         var modalContent = $('#GRNiewModal .grnModalBdy').clone();

//         // Create a temporary container to hold the cloned content
//         var printableContent = $('<div></div>').append(modalContent);

//         // Apply inline styles to printableContent
//         printableContent.find('*').each(function() {
//             var computedStyle = window.getComputedStyle(this);
//             for (var i = 0; i < computedStyle.length; i++) {
//                 $(this).css(computedStyle[i], computedStyle.getPropertyValue(computedStyle[i]));
//             }
//         });

//         // Ensure table borders are applied inline and set to black
//         printableContent.find('table').css({
//             'border-collapse': 'collapse', // Ensures borders are not doubled
//             'width': '100%'
//         });

//         printableContent.find('th, td').css({
//             'border': '1px solid black', // Set border color to black
//             'padding': '8px', // Consistent padding for table cells
//             'text-align': 'left' // Default text alignment for table cells
//         });

//         // Append the temporary container to the body
//         $('body').append(printableContent);

//         // Calculate the maximum width for content to fit on one page
//         var maxWidth = 297; // A4 paper width in landscape orientation (297mm)

//         // Check if the modal content width exceeds the maximum width
//         var modalWidth = modalContent.outerWidth();
//         if (modalWidth > maxWidth) {
//             // Adjust the width of the modal content to fit within one page
//             modalContent.css('width', maxWidth + 'mm');
//         }

//         // Apply styles for printing
//         printableContent.css({
//             'position': 'absolute',
//             'left': '0',
//             'top': '0',
//             'padding': '0',
//             'margin': '0',
//             'background-color': '#ffffff' // Set background color to white
//         });

//         html2canvas(printableContent[0], {
//             backgroundColor: 'white' // Set background color to white
//         }).then(function(canvas) {
//             // Create a new jsPDF instance with landscape orientation
//             const doc = new jsPDF('landscape', 'mm', 'a4');

//             // Save canvas as image
//             var imgData = canvas.toDataURL('image/jpeg');

//             // Add image to PDF
//             doc.addImage(imgData, 'JPEG', 0, 0, 297, 210); // A4 dimensions in landscape (297x210 mm)

//             // Generate a random number between 0 and 9999
//             const randomNumber = Math.floor(Math.random() * 10000);

//             // Construct the file name with the random number and the ".pdf" extension
//             const fileName = `GRN_${randomNumber}.pdf`;

//             // Save the PDF file with the random name
//             doc.save(fileName);

//             // Remove the temporary container from the body
//             printableContent.remove();
//         });

//     } catch (error) {
//         console.error('An error occurred while generating PDF:', error);
//     }
// });






                                        $('.viewGRN').on('click', function(e) {
    e.preventDefault();
    var dnn = $(this).data('dnn');
    // Get the CSRF token value from the meta tag
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Make AJAX call
    $.ajax({
        url: '/fetch-grn-details-inv-erp', // Specify your endpoint URL
        type: 'POST', // Or 'GET' depending on your server route
        data: {
            id: dnn,
            _token: csrfToken // Include the CSRF token in the data
        }, // Send the order ID in the request
        success: function(response) {
            console.log(response);

            if(response.dnnDetails) {
                var item = response.dnnDetails
                $('#GRNiewModal #inspector_name_grn').text(item.inspector_name);
                $('#GRNiewModal #inspector_id_grn').text(item.inspector_id_signature);
                $('#GRNiewModal #po_number_grn').text(item.po_number);
                $('#GRNiewModal #order_date_grn').text(item.order_date);
                $('#GRNiewModal #delivery_date_grn').text(item.delivery_date);
                $('#GRNiewModal #delivery_time_grn').text(item.delivery_time);
                $('#GRNiewModal #vehicle_number_grn').text(item.vehicle_number);
                $('#GRNiewModal #dnn_grn').text(item.dnn);
                $('#GRNiewModal #item_code').text(item.item_id);
                $('#GRNiewModal #item_name').text(item.item_name);
                $('#GRNiewModal #order_dty').text(item.ordered_qty);
                $('#GRNiewModal #deliver_qty').text(item.quantity_delivered);
                $('#GRNiewModal #okTested_qty').text(item.passed_qty);
                $('#GRNiewModal #rejected_qty').text(item.failed_qty);
            } else {
                console.error('No DNN details found in the response');
            }

            if(response.supplierDetails) {
                var supplier = response.supplierDetails;
                $('#GRNiewModal #supplier_name_grn').text(supplier.supplier_name);
                $('#GRNiewModal #supplier_contact_grn').text(supplier.phone_number);
            } else {
                console.error('No supplier details found in the response');
            }

            $('#GRNiewModal').modal('show');
        },
        error: function(xhr, status, error) {
            // Handle any errors
            console.error('Error:', error);
        }
    });
});




                    $('#createSalesform').on('submit', function(event){
                        event.preventDefault();
                    // Serialize form data
                     // Serialize form data
                    var formData = $(this).serialize();
                    // console.log(formData);
                    var dataToSend = [];

                    // Loop through each row of the table
                    $("#itemlistsPO tr").each(function() {
                        var rowData = {};

                        // Loop through each cell of the current row
                        $(this).find("td").each(function() {
                            // Get the column name from the table header
                            var columnName = $(this).closest('table').find('th').eq($(this).index()).text().trim();
                            
                            // Get the text content of the cell
                            var cellData = $(this).text().trim();
                            
                            // Add cell data to rowData with column name as key
                            rowData[columnName] = cellData;
                        });

                        // Push the rowData object to dataToSend array
                        dataToSend.push(rowData);
                    });

                      // Send data to server via AJAX
                      sendDataToItemLists(dataToSend);

                      var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        // Make AJAX call
                        $.ajax({
                            url: '/store_inward_data', // Specify your endpoint URL
                            method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        // dataType: 'json',
                        
                            success: function(response) {

                            // location.reload();
                            console.log(response);
                            // Handle success response from the server
                            toastr.options = {
                                    "timeOut": "5000",
                                    "toastClass": "toast-green",
                                    "extendedTimeOut": "2000",
                                    "progressBar": true,
                                    "closeButton": true,
                                    "positionClass": "toast-top-right",
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut",
                                    "progressBarBgColor": "#ff0000",
                                    "preventDuplicates": true,
                                    "onHidden": function() {
                                        window.location.reload(); // Reload the page when the toastr is hidden
                                    }
                                };

                                toastr.success(response.message);

                                $('.modal').modal('hide');

                        },
                        error: function(xhr, status, error) {
                             // Handle error response from the server
                                console.error('Error:', error);

                           // Show validation errors in a toaster
                            var errorMessage = 'Oops! Some fields are missing';
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                errorMessage = '<ul>'; // Start the unordered list
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    errorMessage += '<li>' + value.join('</li><li>') + '</li>'; // Add each error message as a list item
                                });
                                errorMessage += '</ul>'; // End the unordered list
                            }


                            toastr.error(errorMessage, 'Validation Error', {
                                    "timeOut": "5000", // Set the time the notification stays visible (in milliseconds)
                                    "toastClass": "toast-red", // Add custom class to the notification
                                    "extendedTimeOut": "2000", // Set the duration of the extended timeout for mouse hover (in milliseconds)
                                    "progressBar": true, // Show a progress bar for timing of the notification
                                    "closeButton": true, // Show a close button for the notification
                                    "positionClass": "toast-top-right", // Set the position of the notification
                                    "showDuration": "300", // Set the duration of the show animation (in milliseconds)
                                    "hideDuration": "1000", // Set the duration of the hide animation (in milliseconds)
                                    "showEasing": "swing", // Set the easing of the show animation
                                    "hideEasing": "linear", // Set the easing of the hide animation
                                    "showMethod": "fadeIn", // Set the method of showing the notification
                                    "hideMethod": "fadeOut", // Set the method of hiding the notification
                                    "progressBarBgColor": "#ff0000", // Set the background color of the progress bar
                                    "preventDuplicates": true // Prevent duplicate notifications from being shown
                                });
                        }
                    });

                });




                            $('.creatBarcodeForInv').on('click', function(e){
                            e.preventDefault(); 

                            var id = $(this).data('id');
                            // alert(id);
                             // Get the CSRF token value from the meta tag
                            var csrfToken = $('meta[name="csrf-token"]').attr('content');

                            // Make AJAX call
                            $.ajax({
                                url: '/create_inv_barcode', // Specify your endpoint URL
                                type: 'POST', // Or 'GET' depending on your server route
                                data: {
                                    id: id,
                                    _token: csrfToken // Include the CSRF token in the data
                                }, // Send the order ID in the request
                                success: function(response) {
                                    console.log(response);

                                    if(response.success){
                                            toastr.options = {
                                            "timeOut": "1000",
                                            "toastClass": "toast-green",
                                            "extendedTimeOut": "1000",
                                            "progressBar": true,
                                            "closeButton": true,
                                            "positionClass": "toast-top-right",
                                            "showDuration": "300",
                                            "hideDuration": "1000",
                                            "showEasing": "swing",
                                            "hideEasing": "linear",
                                            "showMethod": "fadeIn",
                                            "hideMethod": "fadeOut",
                                            "preventDuplicates": true,
                                            "onHidden": function() {
                                                window.location.reload(); // Reload the page when the toastr is hidden
                                            }
                                        }
                                    }

                                        toastr.success(response.message);
                                },
                                error: function(xhr, status, error) {
                                    // Handle any errors
                                    console.error('Error:', error);
                                }
                            });

                            })



                        $('.creatQRForInv').on('click', function(e){
                            e.preventDefault(); 

                            var id = $(this).data('id');
                            // alert(id);
                             // Get the CSRF token value from the meta tag
                                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                            // Make AJAX call
                            $.ajax({
                                url: '/create_inv_qr_code', // Specify your endpoint URL
                                type: 'POST', // Or 'GET' depending on your server route
                                data: {
                                    id: id,
                                    _token: csrfToken // Include the CSRF token in the data
                                }, // Send the order ID in the request
                                success: function(response) {
                                    console.log(response);

                                    if(response.success){
                                            toastr.options = {
                                            "timeOut": "1000",
                                            "toastClass": "toast-green",
                                            "extendedTimeOut": "1000",
                                            "progressBar": true,
                                            "closeButton": true,
                                            "positionClass": "toast-top-right",
                                            "showDuration": "300",
                                            "hideDuration": "1000",
                                            "showEasing": "swing",
                                            "hideEasing": "linear",
                                            "showMethod": "fadeIn",
                                            "hideMethod": "fadeOut",
                                            "preventDuplicates": true,
                                            "onHidden": function() {
                                                window.location.reload(); // Reload the page when the toastr is hidden
                                            }
                                        }
                                    }

                                        toastr.success(response.message);
                                },
                                error: function(xhr, status, error) {
                                    // Handle any errors
                                    console.error('Error:', error);
                                }
                            });
                        })





                            $('#CompareQutBTN').on('click', function(event) {
                                event.preventDefault();
                                var checkedIds = [];
                                $('#VendorQuotationsLists .compareCheckBox:checked').each(function() {
                                    checkedIds.push($(this).data('id'));
                                });

                                if (checkedIds.length > 0) {
                                    $.ajax({
                                        url: '/select_quotation_to_compare',
                                        type: 'POST',
                                        data: JSON.stringify({ ids: checkedIds }),
                                        contentType: 'application/json; charset=utf-8',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(response) {
                                            console.log(response);

                                            var tableBody = '';
                                            // Define the number formatter
                                const numberFormatter = new Intl.NumberFormat('en-US', {
                                    style: 'decimal',
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                                    // Initialize an array to store grouped content
                                                    var groupedContent = [];

                                                    // Add headings as the first entry in the groupedContent array
                                                    var headings = ["Details", "Qut_number", "Total (rs.)", "Tax Rate %", "Tax (rs.)", "Others (rs.)", "Final Amount (rs.)", "Delivery Time <b>(week)</b>", " Payment before Delivery <b>(%)</b>:", "Quality", "Customer Service"];
                                                    groupedContent.push(headings);


                                                    var tableBody1 = '';
                                    
                                                        $.each(response.data, function(index, item) {
                                                            tableBody1 += '<tr>';
                                                            tableBody1 += '<td>' + (index + 1) + '</td>';
                                                            tableBody1 += '<td>' + item.supplierName + '</td>';
                                                            tableBody1 += '<td>' + item.qut_num + '</td>';
                                                            if(item.QutApproval == 1){
                                                            tableBody1 += '<td class="text-center"><a class="btn mdi mdi-check-circle" style="color:green;font-size:20px;"></a></td>';
                                                            }else{
                                                                tableBody1 += '<td class="text-center"><a class="btn btn-success text-center SApprovalQutFromModal" data-qutnum="'+item.qut_num+'"> Send For Approval </a></td>'; 
                                                            }

                                                            if(item.QutNego == 1){
                                                            tableBody1 += '<td class="text-center"><a class="btn mdi mdi-check-circle" style="color:green;font-size:20px;"></a></td>';
                                                            }else{
                                                                tableBody1 += '<td class="text-center"><a class="btn btn-primary text-center SNegoQutFromModal" data-qutnum="'+item.qut_num+'"> Send For Negotiation </a></td>';
                                                            }
                                                            tableBody1 += '</tr>';
                                                        });

                                                    $('#actionOnCompQuot').html(tableBody1);
                                                    // Group the content of each item
                                                    $.each(response.data, function(index, item) {
                                                        // Push the content of each item into the groupedContent array
                                                        var quality = 'Good';
                                                        var rating = 'Excellent';
                                                        var others = 3000;
                                                         // Calculate the final amount including tax and fixed amount
                                                        var totalAmount = parseFloat(item.total_amount);
                                                        var taxAmount = parseFloat(0.18 * totalAmount);
                                                        var finalAmount = totalAmount + taxAmount + 3000;
                                                        var taxrate = 18;
                                                        groupedContent.push([
                                                            item.supplierName,
                                                            item.qut_num,
                                                            item.total_amount,
                                                            taxrate,
                                                            taxAmount,
                                                            others,
                                                            finalAmount,
                                                            item.lead_time,
                                                            item.payment_terms,
                                                            quality,
                                                            rating
                                                        ]);
                                                    });

                                                    
                                                      // Generate HTML for the grouped content
                                                        var tableBody = '';
                                                        var columnRatings = []; // Array to store the ratings for each column
                                                        for (var i = 0; i < groupedContent[0].length; i++) {
                                                            tableBody += '<tr>';
                                                            for (var j = 0; j < groupedContent.length; j++) {
                                                                if (j === 0) {
                                                                    tableBody += '<th style="color:darkblue;" class="text-center">' + groupedContent[j][i] + '</th>';
                                                                } else {
                                                                    var cellValue = groupedContent[j][i];
                                                                    var isNumeric = !isNaN(parseFloat(cellValue)) && isFinite(cellValue); // Check if the cell value is numeric

                                                                    // Check if the cell value is numeric and convert it to float for comparison
                                                                    if (isNumeric) {
                                                                        cellValue = parseFloat(cellValue);
                                                                    }

                                                                    var allValuesEqual = true; // Initialize flag to check if all values in the column are equal
                                                                    var hasDuplicates = false; // Initialize flag to check for duplicates
                                                                    var hasMultipleGreatest = false; // Initialize flag to check for multiple greatest values
                                                                    var greatestValue = null;
                                                                    var lowestValue = null;
                                                                    var valueCounts = {}; // Object to count occurrences of each value
                                                                    var lowestValueCount = 0; // Count of lowest values in the column
                                                                    var greatestValueCount = 0; // Count of greatest values in the column


                                                                        // Determine greatest and lowest values for the column, if the column is not excluded
                                                                        if (![0, 1, 10, 9].includes(i)) {
                                                                            for (var k = 1; k < groupedContent.length; k++) {
                                                                                var value = parseFloat(groupedContent[k][i]);
                                                                                if (!isNaN(value) && isFinite(value)) {
                                                                                    if (greatestValue === null || value > greatestValue) {
                                                                                        greatestValue = value;
                                                                                    }
                                                                                    if (lowestValue === null || value < lowestValue) {
                                                                                        lowestValue = value;
                                                                                    }
                                                                                    // Count occurrences of each value
                                                                                    valueCounts[value] = (valueCounts[value] || 0) + 1;
                                                                                }
                                                                            }

                                                                            // Check if all values in the column are equal
                                                                            for (var m = 1; m < groupedContent.length; m++) {
                                                                                var value = parseFloat(groupedContent[m][i]);
                                                                                if (!isNaN(value) && isFinite(value)) {
                                                                                    if (value !== greatestValue || value !== lowestValue) {
                                                                                        allValuesEqual = false;
                                                                                    }
                                                                                    if (value === greatestValue && valueCounts[value] > 1) {
                                                                                        hasMultipleGreatest = true;
                                                                                    }
                                                                                    if (valueCounts[value] > 1 && value !== greatestValue) {
                                                                                        hasDuplicates = true;
                                                                                    }
                                                                                }
                                                                            }
    // }
                                                                        }
                                                                   
                                                                       
                                                                        // Set background color based on the conditions
                                                                        if (allValuesEqual && ![0, 1, 9, 7, 10].includes(i)) {
                                                                            if ([0, 1, 9, 5, 7].includes(i)) {
                                                                            tableBody += '<td class="text-center"><b>' + numberFormatter.format(groupedContent[j][i]) + '</b></td>';
                                                                            }else{
                                                                                tableBody += '<td class="text-center"><b>' + groupedContent[j][i] + '</b></td>';

                                                                            }
                                                                        } else if (cellValue === lowestValue) {
                                                                            if ([0, 1, 8, 3, 9, 7].includes(i)) {
                                                                                tableBody += '<td style="background-color: #90ee90;" class="text-center"><b>' + groupedContent[j][i] + '</b></td>';
                                                                            } else {
                                                                                tableBody += '<td style="background-color: #90ee90;" class="text-center"><b>' + numberFormatter.format(groupedContent[j][i]) + '</b></td>';
                                                                            }
                                                                        } else if (hasMultipleGreatest && cellValue === greatestValue && !allValuesEqual && ![0, 1, 3, 10, 9].includes(i)) {
                                                                            tableBody += '<td style="background-color: #8BDCF1;" class="text-center">' + groupedContent[j][i] + '</td>';
                                                                        } else if (cellValue === greatestValue) {
                                                                            if ([0, 1, 8, 3, 9, 7].includes(i)) {
                                                                                tableBody += '<td style="background-color: #EB9595;" class="text-center">' + groupedContent[j][i] + '</td>';
                                                                            } else {
                                                                                tableBody += '<td style="background-color: #EB9595;" class="text-center">' + numberFormatter.format(groupedContent[j][i]) + '</td>';
                                                                            }
                                                                        } else {
                                                                            if ([0, 1, 8, 9, 3, 10, 7].includes(i)) {
                                                                                if ([0].includes(i)) {
                                                                                    tableBody += '<th class="text-center" style="color:darkblue;">' + groupedContent[j][i] + '</th>';
                                                                                } else {
                                                                                    tableBody += '<td class="text-center">' + groupedContent[j][i] + '</td>';
                                                                                }
                                                                            } else {
                                                                                tableBody += '<td class="text-center">' + numberFormatter.format(groupedContent[j][i]) + '</td>';
                                                                            }
                                                                        }


                                                                    // }
                                                                }
                                                            }
                                                            tableBody += '</tr>';
                                                        }
                                                        // Display the HTML in the table body
                                                        $('#CompSupplierList').html(tableBody);

                                               $('#staticBackdrop').modal('show');

                              


                                        },
                                        error: function(xhr, status, error) {
                                            alert("Error: " + xhr.responseText);
                                        }
                                    });
                                } else {
                                    alert("No quotations selected.");
                                }
                            });




                            
                    $('.SApprovalQut').on('click',function(event){
                        event.preventDefault();

                        var qutnum = $(this).data('qutnum');
                         // Get the CSRF token value from the meta tag
                         var csrfToken = $('meta[name="csrf-token"]').attr('content');

                            // Make AJAX call with the id and CSRF token
                            $.ajax({
                                url: '/send_quotation_for_approval',
                                type: 'POST', // or 'GET', depending on your server endpoint
                                data: {
                                    id: qutnum,
                                    _token: csrfToken // Include the CSRF token in the data
                                },
                                success: function(response) {
                                    // Handle the AJAX response here
                                   if(response.success){
                                            toastr.options = {
                                            "timeOut": "1000",
                                            "toastClass": "toast-green",
                                            "extendedTimeOut": "1000",
                                            "progressBar": true,
                                            "closeButton": true,
                                            "positionClass": "toast-top-right",
                                            "showDuration": "300",
                                            "hideDuration": "1000",
                                            "showEasing": "swing",
                                            "hideEasing": "linear",
                                            "showMethod": "fadeIn",
                                            "hideMethod": "fadeOut",
                                            "preventDuplicates": true,
                                            "onHidden": function() {
                                                window.location.reload(); // Reload the page when the toastr is hidden
                                            }
                                        }

                                        toastr.success(response.message);
                                }
                                },
                                error: function(xhr, status, error) {
                                    // Handle AJAX errors here
                                    console.error(xhr.responseText);
                                }
                            });
                        })



                        $('.compare').on('click','.SApprovalQutFromModal',function(){
                        // event.preventDefault();

                        var qutnum = $(this).data('qutnum');
                         // Get the CSRF token value from the meta tag
                         var csrfToken = $('meta[name="csrf-token"]').attr('content');

                            // Make AJAX call with the id and CSRF token
                            $.ajax({
                                url: '/send_quotation_for_approval',
                                type: 'POST', // or 'GET', depending on your server endpoint
                                data: {
                                    id: qutnum,
                                    _token: csrfToken // Include the CSRF token in the data
                                },
                                success: function(response) {
                                    // Handle the AJAX response here
                                   if(response.success){
                                            toastr.options = {
                                            "timeOut": "1000",
                                            "toastClass": "toast-green",
                                            "extendedTimeOut": "1000",
                                            "progressBar": true,
                                            "closeButton": true,
                                            "positionClass": "toast-top-right",
                                            "showDuration": "300",
                                            "hideDuration": "1000",
                                            "showEasing": "swing",
                                            "hideEasing": "linear",
                                            "showMethod": "fadeIn",
                                            "hideMethod": "fadeOut",
                                            "preventDuplicates": true,
                                            "onHidden": function() {
                                                window.location.reload(); // Reload the page when the toastr is hidden
                                            }
                                        }

                                        toastr.success(response.message);
                                }
                                },
                                error: function(xhr, status, error) {
                                    // Handle AJAX errors here
                                    console.error(xhr.responseText);
                                }
                            });
                        })








                    $('.SNegoQut').on('click',function(event){
                        event.preventDefault();

                        var qutnum = $(this).data('qutnum');
                         // Get the CSRF token value from the meta tag
                         var csrfToken = $('meta[name="csrf-token"]').attr('content');

                            // Make AJAX call with the id and CSRF token
                            $.ajax({
                                url: '/send_quotation_for_negotiation',
                                type: 'POST', // or 'GET', depending on your server endpoint
                                data: {
                                    id: qutnum,
                                    _token: csrfToken // Include the CSRF token in the data
                                },
                                success: function(response) {
                                    // Handle the AJAX response here
                                   if(response.success){
                                            toastr.options = {
                                            "timeOut": "1000",
                                            "toastClass": "toast-green",
                                            "extendedTimeOut": "1000",
                                            "progressBar": true,
                                            "closeButton": true,
                                            "positionClass": "toast-top-right",
                                            "showDuration": "300",
                                            "hideDuration": "1000",
                                            "showEasing": "swing",
                                            "hideEasing": "linear",
                                            "showMethod": "fadeIn",
                                            "hideMethod": "fadeOut",
                                            "preventDuplicates": true,
                                            "onHidden": function() {
                                                window.location.reload(); // Reload the page when the toastr is hidden
                                            }
                                        }

                                        toastr.success(response.message);


                                }


                                },
                                error: function(xhr, status, error) {
                                    // Handle AJAX errors here
                                    console.error(xhr.responseText);
                                }
                            });

                    })




                    $('.compare').on('click','.SNegoQutFromModal',function(){
                        // event.preventDefault();

                        var qutnum = $(this).data('qutnum');
                         // Get the CSRF token value from the meta tag
                         var csrfToken = $('meta[name="csrf-token"]').attr('content');

                            // Make AJAX call with the id and CSRF token
                            $.ajax({
                                url: '/send_quotation_for_negotiation',
                                type: 'POST', // or 'GET', depending on your server endpoint
                                data: {
                                    id: qutnum,
                                    _token: csrfToken // Include the CSRF token in the data
                                },
                                success: function(response) {
                                    // Handle the AJAX response here
                                   if(response.success){
                                            toastr.options = {
                                            "timeOut": "1000",
                                            "toastClass": "toast-green",
                                            "extendedTimeOut": "1000",
                                            "progressBar": true,
                                            "closeButton": true,
                                            "positionClass": "toast-top-right",
                                            "showDuration": "300",
                                            "hideDuration": "1000",
                                            "showEasing": "swing",
                                            "hideEasing": "linear",
                                            "showMethod": "fadeIn",
                                            "hideMethod": "fadeOut",
                                            "preventDuplicates": true,
                                            "onHidden": function() {
                                                window.location.reload(); // Reload the page when the toastr is hidden
                                            }
                                        }

                                        toastr.success(response.message);


                                }


                                },
                                error: function(xhr, status, error) {
                                    // Handle AJAX errors here
                                    console.error(xhr.responseText);
                                }
                            });

                    })




                    $('.rfqView').click('click',function(event){
                        event.preventDefault();
                          // Get the order ID from the data attribute
                    var id = $(this).data('prnum');

                        // alert(id);
                        // Get the CSRF token value from the meta tag
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        // Make AJAX call with the id and CSRF token
                        $.ajax({
                            url: '/view_pr',
                            type: 'POST', // or 'GET', depending on your server endpoint
                            data: {
                                id: id,
                                _token: csrfToken // Include the CSRF token in the data
                            },
                            success: function(response) {
                                // Handle the AJAX response here
                                console.log(response);


                                var prDetails = response.prDetails;
                                var rfqDetails = response.rfq;
                                $('#rfqViewModal #req_name').html(prDetails.req_name);
                                $('#rfqViewModal #rfq_num').html(rfqDetails.rfq_num);
                                $('#rfqViewModal #lead_time').html(rfqDetails.lead_time);
                                $('#rfqViewModal #pr_num').html(prDetails.pr_num);
                                $('#rfqViewModal #req_phone').html(prDetails.req_phone);
                                $('#rfqViewModal #req_email').html(prDetails.req_email);
                                $('#rfqViewModal #req_desig').html(prDetails.req_desig);

                                $('#rfqViewModal #street_address').html(prDetails.del_addr);
                                $('#rfqViewModal #del_city').html(prDetails.del_city);
                                $('#rfqViewModal #del_state').html(prDetails.del_state);
                                $('#rfqViewModal #del_date').html(prDetails.del_date);
                                $('#rfqViewModal #pr_number').html(prDetails.pr_num);
                                $('#rfqViewModal #vendorName').html(prDetails.supplier);
                                $('#rfqViewModal #vendorPhone').html(prDetails.supplier_phone);
                                $('#rfqViewModal #vendorEmail').html(prDetails.supplier_email);
                                $('#rfqViewModal #contactPerson').html(prDetails.supplier_person);
                                $('#rfqViewModal #req_depatment').html(prDetails.department);

                                var tableBody = '';
                                    
                                    $.each(response.prItems, function(index, item) {
                                        tableBody += '<tr>';
                                        tableBody += '<td>' + (index + 1) + '</td>';
                                        tableBody += '<td>' + item.item_type + '</td>';
                                        tableBody += '<td>' + item.item_des + '</td>';
                                        tableBody += '<td>' + item.quantity + '</td>';
                                        tableBody += '<td>' + item.item_feature + '</td>';
                                        tableBody += '</tr>';
                                    });

                                $('.prItemViewAllList').html(tableBody);

                                $('#rfqViewModal').modal('show');

                            },
                            error: function(xhr, status, error) {
                                // Handle AJAX errors here
                                console.error(xhr.responseText);
                            }
                        });

                    })


                $('.sendQut').on('click',function(event){
                    event.preventDefault();
                    var qut_num = $(this).data('qutnum');
                       // Get the CSRF token value from the meta tag
                       var csrfToken = $('meta[name="csrf-token"]').attr('content');

                            // Make AJAX call
                            $.ajax({
                                url: '/send_quotation', // Specify your endpoint URL
                                type: 'POST', // Or 'GET' depending on your server route
                                data: {
                                        id: qut_num,
                                        _token: csrfToken // Include the CSRF token in the data
                                    }, // Send the order ID in the request
                                success: function(response) {

                                   console.log(response);
                                   
                                   if (response.success) {
                                        toastr.options = {
                                            "timeOut": "5000",
                                            "toastClass": "toast-green",
                                            "extendedTimeOut": "2000",
                                            "progressBar": true,
                                            "closeButton": true,
                                            "positionClass": "toast-top-right",
                                            "showDuration": "300",
                                            "hideDuration": "1000",
                                            "showEasing": "swing",
                                            "hideEasing": "linear",
                                            "showMethod": "fadeIn",
                                            "hideMethod": "fadeOut",
                                            "preventDuplicates": true,
                                            "onHidden": function() {
                                                window.location.reload(); // Reload the page when the toastr is hidden
                                            }
                                        };
                                        toastr.success('Quotation sent successfully');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // Handle any errors
                                    console.error('Error:', error);
                                }
                            });
                        })









                $('.qutbtn').on('click',function(event){
                    event.preventDefault();

                    var id = $(this).data('qutnum');
                    // alert(id);

                     // Get the CSRF token value from the meta tag
                     var csrfToken = $('meta[name="csrf-token"]').attr('content');

                     // Make AJAX call
                     $.ajax({
                            url: '/fetch-quotation-details', // Specify your endpoint URL
                            type: 'POST', // Or 'GET' depending on your server route
                            data: {
                                    id: id,
                                    _token: csrfToken // Include the CSRF token in the data
                                }, // Send the order ID in the request
                            success: function(response) {

                                console.log(response);

                                var qut = response.qut_details;

                                $('#rfqQUT #qut_num').text(qut.qut_num);
                                $('#rfqQUT #pr_num').text(qut.pr_num);
                                $('#rfqQUT #rfq_num').text(qut.rfq_num);
                                $('#rfqQUT #qut_date').text(qut.qut_date);
                                $('#rfqQUT #lead_time').text(qut.lead_time);
                                $('#rfqQUT #payment_terms').text(qut.payment_terms);

                                // Define the number formatter
                                const numberFormatter = new Intl.NumberFormat('en-US', {
                                    style: 'decimal',
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });


                                var tableBody = '';
                            
                                    $.each(response.items, function(index, item) {
                                        // Append each part_number value to the element with class .item_code
                                            tableBody += '<tr>';
                                            tableBody += '<td>' + (index + 1) + '</td>';
                                            tableBody += '<td>' + item.item_name + '</td>';
                                            tableBody += '<td>' + item.features + '</td>';
                                            tableBody += '<td>' + numberFormatter.format(item.quantity) + '</td>';
                                            tableBody += '<td>' + numberFormatter.format(item.unitprice) + '</td>';
                                            tableBody += '<td>' + numberFormatter.format(item.total) + '</td>';
                                            tableBody += '</tr>';
                                    });

                                    var total_amount =  numberFormatter.format(qut.total_amount);
                                    var tax_rate = 18;
                                    var cgst_rate = tax_rate/2;
                                    var sgst_rate = tax_rate/2;

                                    var cgst_calc = qut.total_amount * (cgst_rate/100);
                                    var sgst_calc = qut.total_amount * (sgst_rate/100);

                                    var cgst = numberFormatter.format(cgst_calc);
                                    var sgst = numberFormatter.format(sgst_calc);

                                    var others = numberFormatter.format(3000);


                                    let sub_total = parseFloat(qut.total_amount);
                                    let cgst_calc1 = parseFloat(cgst_calc);
                                    let sgst_calc1 = parseFloat(sgst_calc);
                                    let others1 = 3000;

                                    // Perform the addition
                                    let finalAmount = sub_total + cgst_calc1 + sgst_calc1 + others1;

                                    var overall_amount = numberFormatter.format(finalAmount);



                                    // var overall_amount = qut.total_amount + cgst_calc + sgst_calc + others;


                                    $('#rfqQUT #sub_total').html(total_amount);
                                    $('#rfqQUT #cgst').html(cgst);
                                    $('#rfqQUT #sgst').html(sgst);
                                    $('#rfqQUT #others').html(others);
                                    $('#rfqQUT #total_amount').html(overall_amount);

                                    $('#QUTItemViewAllList').html(tableBody);


                                $('#rfqQUT').modal('show');

                            },
                            error: function(xhr, status, error) {
                                // Handle any errors
                                console.error('Error:', error);
                            }
                        });
                   
                })












                $('.createQuotation').on('click', function(event){
                    event.preventDefault();

                    var pr_num = $(this).data('prnum');
                    var rfq_num = $(this).data('rfqnum');
                    // alert(pr_num);

                    $('#pr_num').val(pr_num);
                    $('#rfq_num').val(rfq_num);



                        // Get the CSRF token value from the meta tag
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        // Make AJAX call
                        $.ajax({
                            url: '/fetch-item-name', // Specify your endpoint URL
                            type: 'POST', // Or 'GET' depending on your server route
                            data: {
                                    id: pr_num,
                                    _token: csrfToken // Include the CSRF token in the data
                                }, // Send the order ID in the request
                            success: function(response) {

                                // console.lo

                                $.each(response.items, function(index, item) {
                                    // Create a new option element
                                    var option = $('<option></option>')
                                        .attr('value', item.id) // assuming item_id is the value you want to use
                                        .text(item.item_des); // assuming item_des is the text you want to display

                                    // Append the option to the select element
                                    $('#item_name').append(option);
                                });
                                
                                // var requisitioner = response.requisitioner;
                                // $('#PRAddModalForm #req_phone').val(requisitioner.phone);
                                // $('#PRAddModalForm #req_email').val(requisitioner.email);
                                // $('#PRAddModalForm #req_desig').val(requisitioner.designation);

                            },
                            error: function(xhr, status, error) {
                                // Handle any errors
                                console.error('Error:', error);
                            }
                        });
                    $('#updateQuotation').modal('show');
                })



                $('#quotationCreateForm #item_name').on('change',function(){
                    var id = $(this).children('option:selected').val();
                     // Get the CSRF token value from the meta tag
                     var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        // Make AJAX call
                        $.ajax({
                            url: '/fetch-item-details-for-quotation', // Specify your endpoint URL
                            type: 'POST', // Or 'GET' depending on your server route
                            data: {
                                    id: id,
                                    _token: csrfToken // Include the CSRF token in the data
                                }, // Send the order ID in the request
                            success: function(response) {

                                // console.log(response);

                                var details = response.details;
                                $('#quotationCreateForm #quantity').val(details.quantity);
                                $('#quotationCreateForm #feature').val(details.item_feature);
                                // $('#quotationCreateForm #req_desig').val(requisitioner.designation);

                            },
                            error: function(xhr, status, error) {
                                // Handle any errors
                                console.error('Error:', error);
                            }
                        });
                    });


                        $('#add_item_qut').on('click', function(){
                            var item_name = $('#quotationCreateForm #item_name').children('option:selected').html();
                            var qty = $('#quotationCreateForm #quantity').val();
                            var features = $('#quotationCreateForm #feature').val();
                            var unitprice = $('#quotationCreateForm #unitprice').val();
                            var pr_num = $('#quotationCreateForm #pr_num').val();
                            var rfq_num = $('#quotationCreateForm #rfq_num').val();
                            var qut_num = $('#quotationCreateForm #qut_num').val();

                            var total_price = qty * unitprice;

                            var tableBody = '';  

                            tableBody += '<tr>';
                            tableBody += '<td>' + qut_num + '</td>';
                            tableBody += '<td>' + pr_num + '</td>';
                            tableBody += '<td>' + rfq_num + '</td>';
                            tableBody += '<td>' + item_name + '</td>';
                            tableBody += '<td>' + features + '</td>';
                            tableBody += '<td>' + qty + '</td>';
                            tableBody += '<td>' + unitprice + '</td>';
                            tableBody += '<td>' + total_price + '</td>';
                            // tableBody += '<td><a class="delete-link-po btn btn-primary" style="color:white;"><i class="mdi mdi-delete"></i></a>';
                            // tableBody += '</td>';
                            tableBody += '</tr>';   
                            $('#quotationCreateForm #itemlistsQUT').append(tableBody);


                            toastr.options = {
                                    "timeOut": "5000",
                                    "toastClass": "toast-green",
                                    "extendedTimeOut": "2000",
                                    "progressBar": true,
                                    "closeButton": true,
                                    "positionClass": "toast-top-right",
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut",
                                    "progressBarBgColor": "#ff0000",
                                    "preventDuplicates": true,
                                };
                                toastr.success('Item Updated Successfully');
                           $('#quotationCreateForm #item_name').val('');
                           $('#quotationCreateForm #quantity').val('');
                           $('#quotationCreateForm #feature').val('');
                           $('#quotationCreateForm #unitprice').val('');
                        });


                $('#quotationCreateForm .delete-link-po').on('click', function(event) {
                    event.preventDefault(); // Prevent default action if necessary
                    $(this).closest('tr').remove(); // Find the closest tr and remove it
                });




                    $('#addSuppliersRFQ').on('click',function(){

                        var pr_num = $('#createRFQModalForm #pr_num').val();
                        var rfq_num = $('#createRFQModalForm #rfq_num').val();
                        var supplier = $('#createRFQModalForm #supplier').val();
                        var phone = $('#createRFQModalForm #supplier_phone').val();
                        var email = $('#createRFQModalForm #supplier_email').val();
                        var person = $('#createRFQModalForm #supplier_person').val();

                        var tableBody = '';  

                        tableBody += '<tr>';
                        tableBody += '<td>' + pr_num + '</td>';
                        tableBody += '<td>' + rfq_num + '</td>';
                        tableBody += '<td>' + supplier + '</td>';
                        tableBody += '<td>' + phone + '</td>';
                        tableBody += '<td>' + email + '</td>';
                        tableBody += '<td>' + person + '</td>';
                        tableBody += '<td><a class="delete-link-po btn btn-primary" style="color:white;"><i class="mdi mdi-delete"></i></a>';
                        tableBody += '</td>';
                        tableBody += '</tr>';   
                        $('#createRFQModalForm #suppliersLists').append(tableBody);
                        // var pr_num = $('#createRFQModalForm #pr_num').val('');
                        var supplier = $('#createRFQModalForm #supplier').val('');
                        var phone = $('#createRFQModalForm #supplier_phone').val('');
                        var email = $('#createRFQModalForm #supplier_email').val('');
                        var person = $('#createRFQModalForm #supplier_person').val('');
                    })



                    $('#auctionInitiate #type').on('change', function(e){
                        var type = $('#auctionInitiate #type').children('option:selected').val();

                        if( type == 'Forward Auction' ){
                            $('#auctionInitiate #bid').val('Increment');
                        }else{
                            console.clear();
                            $('#auctionInitiate #bid').val('Decrement');
                            $('#auctionInitiate #price_field').hide();
                        }
                    })


                    $('#auctionInitiate .addAuctionItem').on('click', function(){
                        // alert('hi');
                        var auction_id = $('#createRFQModalForm #auction_id').val();
                        var supplier = $('#createRFQModalForm #supplier').val();
                        var phone = $('#createRFQModalForm #supplier_phone').val();
                        var email = $('#createRFQModalForm #supplier_email').val();
                        var person = $('#createRFQModalForm #supplier_person').val();
                        var tableBody = '';  
                        tableBody += '<tr>';
                        tableBody += '<td>' + auction_id + '</td>';
                        tableBody += '<td>' + supplier + '</td>';
                        tableBody += '<td>' + phone + '</td>';
                        tableBody += '<td>' + email + '</td>';
                        tableBody += '<td>' + person + '</td>';
                        tableBody += '<td><a class="delete-link-po btn btn-primary" style="color:white;"><i class="mdi mdi-delete"></i></a>';
                        tableBody += '</td>';
                        tableBody += '</tr>';   
                        if(supplier != ''){
                        $('#auctionInitiate .auctionItemsLists').append(tableBody);
                        }else{
                            alert('add auction product');
                        }

                         // var pr_num = $('#createRFQModalForm #pr_num').val('');
                         var supplier = $('#createRFQModalForm #supplier').val('');
                        var phone = $('#createRFQModalForm #supplier_phone').val('');
                        var email = $('#createRFQModalForm #supplier_email').val('');
                        var person = $('#createRFQModalForm #supplier_person').val('');
                    })

                    $(document).on('click', '.delete-link-po', function(e){
                        e.preventDefault(); // Prevent the default action, if necessary
                        $(this).closest('tr').remove(); // Remove the closest 'tr' element
                    });

                    $('#addSuppliersAuction').on('click',function(){

                        var auction_id = $('#createRFQModalForm #auction_id').val();
                        var rfq_num = $('#createRFQModalForm #rfq_num').val();
                        var supplier = $('#createRFQModalForm #supplier').val();
                        var phone = $('#createRFQModalForm #supplier_phone').val();
                        var email = $('#createRFQModalForm #supplier_email').val();
                        var person = $('#createRFQModalForm #supplier_person').val();

                        var tableBody = '';  

                        tableBody += '<tr>';
                        tableBody += '<td>' + auction_id + '</td>';
                        tableBody += '<td>' + supplier + '</td>';
                        tableBody += '<td>' + phone + '</td>';
                        tableBody += '<td>' + email + '</td>';
                        tableBody += '<td>' + person + '</td>';
                        tableBody += '<td><a class="delete-link-po btn btn-primary" style="color:white;"><i class="mdi mdi-delete"></i></a>';
                        tableBody += '</td>';
                        tableBody += '</tr>';   
                        $('#createRFQModalForm #suppliersLists').append(tableBody);
                        // var pr_num = $('#createRFQModalForm #pr_num').val('');
                        var supplier = $('#createRFQModalForm #supplier').val('');
                        var phone = $('#createRFQModalForm #supplier_phone').val('');
                        var email = $('#createRFQModalForm #supplier_email').val('');
                        var person = $('#createRFQModalForm #supplier_person').val('');
                    })

                    $('.setVisibility').on('click',function(event){
                        event.preventDefault();

                        var id = $(this).data('rfq');
                       
                        // Get CSRF token value from meta tag
                        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get CSRF token
                       // Make AJAX call with the id and CSRF token
                            $.ajax({
                                url: '/set_pr_visibility',
                                type: 'POST', // or 'GET', depending on your server endpoint
                                data: {
                                    id: id,
                                    _token: csrfToken // Include the CSRF token in the data
                                },
                                success: function(response) {
                                    // Handle the AJAX response here
                                    console.log(response);


                                    toastr.options = {
                                    "timeOut": "5000",
                                    "toastClass": "toast-green",
                                    "extendedTimeOut": "2000",
                                    "progressBar": true,
                                    "closeButton": true,
                                    "positionClass": "toast-top-right",
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut",
                                    "progressBarBgColor": "#ff0000",
                                    "preventDuplicates": true,
                                    "onHidden": function() {
                                        window.location.reload(); // Reload the page when the toastr is hidden
                                    }

                                };
                                toastr.success('RFQ sent to the selected suppliers');

                                    // $('#staticBackdrop').on('hidden.bs.modal', function (e) {
                                        // Reload the page when the modal is closed
                                        // window.location.reload();
                                    // });
                                },
                                error: function(xhr, status, error) {
                                    // Handle AJAX errors here
                                    console.error(xhr.responseText);
                                }
                            });
                    })



                    $('.suppliersListsForRFQ').on('click', function(){
                        var rfq = $(this).data('rfq');

                        // Get CSRF token value from meta tag
                        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get CSRF token
                       // Make AJAX call with the id and CSRF token
                            $.ajax({
                                url: '/view_rfq_suppliers_lists',
                                type: 'POST', // or 'GET', depending on your server endpoint
                                data: {
                                    id: rfq,
                                    _token: csrfToken // Include the CSRF token in the data
                                },
                                success: function(response) {
                                    // Handle the AJAX response here
                                    console.log(response);
                                    // Optionally, you can redirect the user to a success page or perform any other actions
                                        var tableBody = '';
                                        
                                        $.each(response.suppliers, function(index, item) {
                                            tableBody += '<tr>';
                                            tableBody += '<td>' + (index + 1) + '</td>';
                                            tableBody += '<td>' + item.supplier + '</td>';
                                            tableBody += '<td>' + item.phone + '</td>';
                                            tableBody += '<td>' + item.email + '</td>';
                                            tableBody += '<td>' + item.person + '</td>';
                                            tableBody += '</tr>';
                                        });

                                    $('#supplierTableBody').html(tableBody);
                                    $('#suppliersModal').modal('show');
                                    // $('#staticBackdrop').on('hidden.bs.modal', function (e) {
                                        // Reload the page when the modal is closed
                                        // window.location.reload();
                                    // });
                                },
                                error: function(xhr, status, error) {
                                    // Handle AJAX errors here
                                    console.error(xhr.responseText);
                                }
                            });
                 
                        });




                    $('#createRFQModalForm').on('submit',function(event){
                    event.preventDefault(); // Prevent default form submission
                    // Serialize form data
                     // Serialize form data
                    var formData = $(this).serialize();
                   console.log(formData);
                    // console.log(formData);
                    var dataToSend = [];

                    // Loop through each row of the table
                    $("#suppliersLists tr").each(function() {
                        var rowData = {};

                        // Loop through each cell of the current row
                        $(this).find("td").each(function() {
                            // Get the column name from the table header
                            var columnName = $(this).closest('table').find('th').eq($(this).index()).text().trim();
                            
                            // Get the text content of the cell
                            var cellData = $(this).text().trim();
                            
                            // Add cell data to rowData with column name as key
                            rowData[columnName] = cellData;
                        });

                        // Push the rowData object to dataToSend array
                        dataToSend.push(rowData);
                    });

                      // Send data to server via AJAX
                      sendDataToPrSupplierLists(dataToSend);

                    // Get CSRF token value from meta tag
                    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get CSRF token

                    // AJAX request
                    $.ajax({
                        url: '{{ route("crfq.store") }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        // dataType: 'json',
                        success: function(response) {

                            // location.reload();
                            console.log(response);
                            // Handle success response from the server
                            toastr.options = {
                                    "timeOut": "5000",
                                    "toastClass": "toast-green",
                                    "extendedTimeOut": "2000",
                                    "progressBar": true,
                                    "closeButton": true,
                                    "positionClass": "toast-top-right",
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut",
                                    "progressBarBgColor": "#ff0000",
                                    "preventDuplicates": true,
                                    "onHidden": function() {
                                        window.location.reload(); // Reload the page when the toastr is hidden
                                    }
                                };

                                toastr.success('RFQ Created Successfully');

                                $('.modal').modal('hide');

                        },
                        error: function(xhr, status, error) {
                             // Handle error response from the server
                                console.error('Error:', error);

                           // Show validation errors in a toaster
                            var errorMessage = 'Oops! Some fields are missing';
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                errorMessage = '<ul>'; // Start the unordered list
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    errorMessage += '<li>' + value.join('</li><li>') + '</li>'; // Add each error message as a list item
                                });
                                errorMessage += '</ul>'; // End the unordered list
                            }


                            toastr.error(errorMessage, 'Validation Error', {
                                    "timeOut": "5000", // Set the time the notification stays visible (in milliseconds)
                                    "toastClass": "toast-red", // Add custom class to the notification
                                    "extendedTimeOut": "2000", // Set the duration of the extended timeout for mouse hover (in milliseconds)
                                    "progressBar": true, // Show a progress bar for timing of the notification
                                    "closeButton": true, // Show a close button for the notification
                                    "positionClass": "toast-top-right", // Set the position of the notification
                                    "showDuration": "300", // Set the duration of the show animation (in milliseconds)
                                    "hideDuration": "1000", // Set the duration of the hide animation (in milliseconds)
                                    "showEasing": "swing", // Set the easing of the show animation
                                    "hideEasing": "linear", // Set the easing of the hide animation
                                    "showMethod": "fadeIn", // Set the method of showing the notification
                                    "hideMethod": "fadeOut", // Set the method of hiding the notification
                                    "progressBarBgColor": "#ff0000", // Set the background color of the progress bar
                                    "preventDuplicates": true // Prevent duplicate notifications from being shown
                                });
                        }
                    });

                    });


                    




                $('.createRfq').on('click',function(e){
                    e.preventDefault();
                    var id = $(this).data('prnum');

                    $('#createRFQModal #pr_num').val(id);

                     // alert(id);
                    // Get the CSRF token value from the meta tag
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Make AJAX call with the id and CSRF token
                    $.ajax({
                        url: '/view_pr',
                        type: 'POST', // or 'GET', depending on your server endpoint
                        data: {
                            id: id,
                            _token: csrfToken // Include the CSRF token in the data
                        },
                        success: function(response) {
                            // Handle the AJAX response here
                            console.log(response);


                            var prDetails = response.prDetails;
                           
                            $('#rfqPR #req_name').html(prDetails.req_name);
                            $('#rfqPR #req_phone').html(prDetails.req_phone);
                            $('#rfqPR #req_email').html(prDetails.req_email);
                            $('#rfqPR #req_desig').html(prDetails.req_desig);

                            $('#rfqPR #street_address').html(prDetails.del_addr);
                            $('#rfqPR #del_city').html(prDetails.del_city);
                            $('#rfqPR #del_state').html(prDetails.del_state);
                            $('#rfqPR #del_date').html(prDetails.del_date);
                            $('#rfqPR #pr_number').html(prDetails.pr_num);
                            $('#rfqPR #vendorName').html(prDetails.supplier);
                            $('#rfqPR #vendorPhone').html(prDetails.supplier_phone);
                            $('#rfqPR #vendorEmail').html(prDetails.supplier_email);
                            $('#rfqPR #contactPerson').html(prDetails.supplier_person);
                            $('#rfqPR #req_depatment').html(prDetails.department);

                            var tableBody = '';
                                
                                $.each(response.prItems, function(index, item) {
                                    tableBody += '<tr>';
                                    tableBody += '<td>' + (index + 1) + '</td>';
                                    tableBody += '<td>' + item.item_type + '</td>';
                                    tableBody += '<td>' + item.item_des + '</td>';
                                    tableBody += '<td>' + item.quantity + '</td>';
                                    tableBody += '<td>' + item.item_feature + '</td>';
                                    tableBody += '</tr>';
                                });

                            $('.prItemViewAll').html(tableBody);

                            // $('#rfqPR').modal('show');

                        },
                        error: function(xhr, status, error) {
                            // Handle AJAX errors here
                            console.error(xhr.responseText);
                        }
                    });


                    $('#createRFQModal').modal('show');
                })


                $('#createRFQModalForm #supplier').on('keyup',function(){

                    var id = $('#createRFQModalForm #supplier').val();
                   
                  // Get the CSRF token value from the meta tag
                  var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Make AJAX call
                    $.ajax({
                        url: '/fetch-supplier-details', // Specify your endpoint URL
                        type: 'POST', // Or 'GET' depending on your server route
                        data: {
                                id: id,
                                _token: csrfToken // Include the CSRF token in the data
                            }, // Send the order ID in the request
                        success: function(response) {

                            // console.log(response);
                            
                            var supplier = response.supplier;
                            $('#createRFQModalForm #supplier_phone').val(supplier.phone_number);
                            $('#createRFQModalForm #supplier_email').val(supplier.email);
                            $('#createRFQModalForm #supplier_person').val(supplier.contact_person);

                        },
                        error: function(xhr, status, error) {
                            // Handle any errors
                            console.error('Error:', error);
                        }
                    });   
                })






                $('.rfqPRView').on('click',function(e){
                    e.preventDefault(); // Prevent default form submission

                    // Get the order ID from the data attribute
                    var id = $(this).data('prnum');

                    // alert(id);
                    // Get the CSRF token value from the meta tag
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Make AJAX call with the id and CSRF token
                    $.ajax({
                        url: '/view_pr',
                        type: 'POST', // or 'GET', depending on your server endpoint
                        data: {
                            id: id,
                            _token: csrfToken // Include the CSRF token in the data
                        },
                        success: function(response) {
                            // Handle the AJAX response here
                            console.log(response);


                            var prDetails = response.prDetails;
                            $('#rfqPR #req_name').html(prDetails.req_name);
                            $('#rfqPR #req_phone').html(prDetails.req_phone);
                            $('#rfqPR #req_email').html(prDetails.req_email);
                            $('#rfqPR #req_desig').html(prDetails.req_desig);

                            $('#rfqPR #street_address').html(prDetails.del_addr);
                            $('#rfqPR #del_city').html(prDetails.del_city);
                            $('#rfqPR #del_state').html(prDetails.del_state);
                            $('#rfqPR #del_date').html(prDetails.del_date);
                            $('#rfqPR #pr_number').html(prDetails.pr_num);
                            $('#rfqPR #vendorName').html(prDetails.supplier);
                            $('#rfqPR #vendorPhone').html(prDetails.supplier_phone);
                            $('#rfqPR #vendorEmail').html(prDetails.supplier_email);
                            $('#rfqPR #contactPerson').html(prDetails.supplier_person);
                            $('#rfqPR #req_depatment').html(prDetails.department);

                            var tableBody = '';
                                
                                $.each(response.prItems, function(index, item) {
                                    // $.each(data, function(index, item) {
                                    tableBody += '<tr>';
                                    tableBody += '<td>' + (index + 1) + '</td>';
                                    tableBody += '<td>' + item.item_type + '</td>';
                                    tableBody += '<td>' + item.item_des + '</td>';
                                    // tableBody += '<td>' + item.item_des + '</td>';
                                    tableBody += '<td>' + item.quantity + '</td>';
                                    tableBody += '<td>' + item.item_feature + '</td>';
                                    tableBody += '</tr>';
                                    // })
                                });

                            $('.prItemViewAllList').html(tableBody);

                            $('#rfqPR').modal('show');

                        },
                        error: function(xhr, status, error) {
                            // Handle AJAX errors here
                            console.error(xhr.responseText);
                        }
                    });

                });



                $('.prView').on('click',function(e){
                    e.preventDefault(); // Prevent default form submission

                    // Get the order ID from the data attribute
                    var id = $(this).data('id');

                    // Get the CSRF token value from the meta tag
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Make AJAX call with the id and CSRF token
                    $.ajax({
                        url: '/view_pr',
                        type: 'POST', // or 'GET', depending on your server endpoint
                        data: {
                            id: id,
                            _token: csrfToken // Include the CSRF token in the data
                        },
                        success: function(response) {
                            // Handle the AJAX response here
                            console.log(response);


                            var prDetails = response.prDetails;
                            $('#PRViewModal #req_name').html(prDetails.req_name);
                            $('#PRViewModal #req_phone').html(prDetails.req_phone);
                            $('#PRViewModal #req_email').html(prDetails.req_email);
                            $('#PRViewModal #req_desig').html(prDetails.req_desig);

                            $('#PRViewModal #street_address').html(prDetails.del_addr);
                            $('#PRViewModal #del_city').html(prDetails.del_city);
                            $('#PRViewModal #del_state').html(prDetails.del_state);
                            $('#PRViewModal #del_date').html(prDetails.del_date);
                            $('#PRViewModal #pr_number').html(prDetails.pr_num);
                            $('#PRViewModal #vendorName').html(prDetails.supplier);
                            $('#PRViewModal #vendorPhone').html(prDetails.supplier_phone);
                            $('#PRViewModal #vendorEmail').html(prDetails.supplier_email);
                            $('#PRViewModal #contactPerson').html(prDetails.supplier_person);
                            $('#PRViewModal #req_depatment').html(prDetails.department);

                            var tableBody = '';
                                
                                $.each(response.prItems, function(index, item) {
                                    tableBody += '<tr>';
                                    tableBody += '<td>' + (index + 1) + '</td>';
                                    tableBody += '<td>' + item.item_type + '</td>';
                                    tableBody += '<td>' + item.item_des + '</td>';
                                    tableBody += '<td>' + item.quantity + '</td>';
                                    tableBody += '<td>' + item.item_feature + '</td>';
                                    tableBody += '</tr>';
                                });

                            $('#prItemViewAll').html(tableBody);

                            $('#PRViewModal').modal('show');

                        },
                        error: function(xhr, status, error) {
                            // Handle AJAX errors here
                            console.error(xhr.responseText);
                        }
                    });

                });

                $('.prItemListsView').on('click',function(e){
                    e.preventDefault(); // Prevent default form submission

                    // Get the order ID from the data attribute
                    var id = $(this).data('id');

                    // Get the CSRF token value from the meta tag
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Make AJAX call with the id and CSRF token
                    $.ajax({
                        url: '/view_pr_item_lists',
                        type: 'POST', // or 'GET', depending on your server endpoint
                        data: {
                            id: id,
                            _token: csrfToken // Include the CSRF token in the data
                        },
                        success: function(response) {
                            // Handle the AJAX response here
                            console.log(response);
                              // Optionally, you can redirect the user to a success page or perform any other actions
                                var tableBody = '';
                                
                                $.each(response.prItems, function(index, item) {
                                    tableBody += '<tr>';
                                    tableBody += '<td>' + (index + 1) + '</td>';
                                    tableBody += '<td>' + item.item_des + '</td>';
                                    tableBody += '<td>' + item.quantity + '</td>';
                                    tableBody += '<td>' + item.item_feature + '</td>';
                                    tableBody += '</tr>';
                                });

                            $('#prItemView').html(tableBody);
                            $('#staticBackdrop').modal('show');
                            $('#staticBackdrop').on('hidden.bs.modal', function (e) {
                                // Reload the page when the modal is closed
                                // window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle AJAX errors here
                            console.error(xhr.responseText);
                        }
                    });
                })

                $('label').css('font-weight','bold');


                $('#add_pr_item').on('click',function(){

                        var type = $('#PRAddModalForm #item_type').children('option:selected').val();
                        var item_description = $('#PRAddModalForm #item_des').val();
                        var pr_number = $('#PRAddModalForm #pr_num').val();

                        var item_feature = $('#PRAddModalForm #item_feature').val();
                        var item_qty = $('#PRAddModalForm #item_qty').val();

                        var tableBody = '';  

                        tableBody += '<tr>';
                        tableBody += '<td>' + pr_number + '</td>';
                        tableBody += '<td>' + type + '</td>';
                        tableBody += '<td>' + item_description + '</td>';
                        tableBody += '<td>' + item_qty + '</td>';
                        tableBody += '<td>' + item_feature + '</td>';
                        tableBody += '<td><a class="delete-link-po btn btn-primary" style="color:white;"><i class="mdi mdi-delete"></i></a>';
                        tableBody += '</td>';
                        tableBody += '</tr>';   
                        $('#pr_item_lists').append(tableBody);
                })


             $('#createPOform').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission
                    // Serialize form data
                     // Serialize form data
                    var formData = $(this).serialize();
                    // console.log(formData);
                    var dataToSend = [];

                    // Loop through each row of the table
                    $("#itemlistsPO tr").each(function() {
                        var rowData = {};

                        // Loop through each cell of the current row
                        $(this).find("td").each(function() {
                            // Get the column name from the table header
                            var columnName = $(this).closest('table').find('th').eq($(this).index()).text().trim();
                            
                            // Get the text content of the cell
                            var cellData = $(this).text().trim();
                            
                            // Add cell data to rowData with column name as key
                            rowData[columnName] = cellData;
                        });

                        // Push the rowData object to dataToSend array
                        dataToSend.push(rowData);
                    });

                      // Send data to server via AJAX
                      sendDataToItemLists(dataToSend);

                    // Get CSRF token value from meta tag
                    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get CSRF token

                    // AJAX request
                    $.ajax({
                        url: '{{ route("po.store") }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        // dataType: 'json',
                        success: function(response) {

                            // location.reload();
                            // console.log(response);
                            // Handle success response from the server
                            toastr.options = {
                                    "timeOut": "5000",
                                    "toastClass": "toast-green",
                                    "extendedTimeOut": "2000",
                                    "progressBar": true,
                                    "closeButton": true,
                                    "positionClass": "toast-top-right",
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut",
                                    "progressBarBgColor": "#ff0000",
                                    "preventDuplicates": true,
                                    "onHidden": function() {
                                        window.location.reload(); // Reload the page when the toastr is hidden
                                    }
                                };

                                toastr.success('Order Created Successfully');

                                $('.modal').modal('hide');

                        },
                        error: function(xhr, status, error) {
                             // Handle error response from the server
                                console.error('Error:', error);

                           // Show validation errors in a toaster
                            var errorMessage = 'Oops! Some fields are missing';
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                errorMessage = '<ul>'; // Start the unordered list
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    errorMessage += '<li>' + value.join('</li><li>') + '</li>'; // Add each error message as a list item
                                });
                                errorMessage += '</ul>'; // End the unordered list
                            }


                            toastr.error(errorMessage, 'Validation Error', {
                                    "timeOut": "5000", // Set the time the notification stays visible (in milliseconds)
                                    "toastClass": "toast-red", // Add custom class to the notification
                                    "extendedTimeOut": "2000", // Set the duration of the extended timeout for mouse hover (in milliseconds)
                                    "progressBar": true, // Show a progress bar for timing of the notification
                                    "closeButton": true, // Show a close button for the notification
                                    "positionClass": "toast-top-right", // Set the position of the notification
                                    "showDuration": "300", // Set the duration of the show animation (in milliseconds)
                                    "hideDuration": "1000", // Set the duration of the hide animation (in milliseconds)
                                    "showEasing": "swing", // Set the easing of the show animation
                                    "hideEasing": "linear", // Set the easing of the hide animation
                                    "showMethod": "fadeIn", // Set the method of showing the notification
                                    "hideMethod": "fadeOut", // Set the method of hiding the notification
                                    "progressBarBgColor": "#ff0000", // Set the background color of the progress bar
                                    "preventDuplicates": true // Prevent duplicate notifications from being shown
                                });
                        }
                    });

                });






                $('#PRAddModalForm').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission
                    // Serialize form data
                     // Serialize form data
                    var formData = $(this).serialize();
                    // console.log(formData);
                    var dataToSend = [];

                    // Loop through each row of the table
                    $("#pr_item_lists tr").each(function() {
                        var rowData = {};

                        // Loop through each cell of the current row
                        $(this).find("td").each(function() {
                            // Get the column name from the table header
                            var columnName = $(this).closest('table').find('th').eq($(this).index()).text().trim();
                            
                            // Get the text content of the cell
                            var cellData = $(this).text().trim();
                            
                            // Add cell data to rowData with column name as key
                            rowData[columnName] = cellData;
                        });

                        // Push the rowData object to dataToSend array
                        dataToSend.push(rowData);
                    });

                      // Send data to server via AJAX
                      sendDataToPRItemLists(dataToSend);
                      console.log(dataToSend);

                    // Get CSRF token value from meta tag
                    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get CSRF token

                    // AJAX request
                    $.ajax({
                        url: '{{ route("pr.store") }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        // dataType: 'json',
                        success: function(response) {

                            // location.reload();
                            // console.log(response);
                            // Handle success response from the server
                            toastr.options = {
                                    "timeOut": "5000",
                                    "toastClass": "toast-green",
                                    "extendedTimeOut": "2000",
                                    "progressBar": true,
                                    "closeButton": true,
                                    "positionClass": "toast-top-right",
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut",
                                    "progressBarBgColor": "#ff0000",
                                    "preventDuplicates": true,
                                    "onHidden": function() {
                                        window.location.reload(); // Reload the page when the toastr is hidden
                                    }
                                };

                                toastr.success('PR Created Successfully');

                                $('.modal').modal('hide');

                        },
                        error: function(xhr, status, error) {
                             // Handle error response from the server
                                console.error('Error:', error);

                           // Show validation errors in a toaster
                            var errorMessage = 'Oops! Some fields are missing';
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                errorMessage = '<ul>'; // Start the unordered list
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    errorMessage += '<li>' + value.join('</li><li>') + '</li>'; // Add each error message as a list item
                                });
                                errorMessage += '</ul>'; // End the unordered list
                            }


                            toastr.error(errorMessage, 'Validation Error', {
                                    "timeOut": "5000", // Set the time the notification stays visible (in milliseconds)
                                    "toastClass": "toast-red", // Add custom class to the notification
                                    "extendedTimeOut": "2000", // Set the duration of the extended timeout for mouse hover (in milliseconds)
                                    "progressBar": true, // Show a progress bar for timing of the notification
                                    "closeButton": true, // Show a close button for the notification
                                    "positionClass": "toast-top-right", // Set the position of the notification
                                    "showDuration": "300", // Set the duration of the show animation (in milliseconds)
                                    "hideDuration": "1000", // Set the duration of the hide animation (in milliseconds)
                                    "showEasing": "swing", // Set the easing of the show animation
                                    "hideEasing": "linear", // Set the easing of the hide animation
                                    "showMethod": "fadeIn", // Set the method of showing the notification
                                    "hideMethod": "fadeOut", // Set the method of hiding the notification
                                    "progressBarBgColor": "#ff0000", // Set the background color of the progress bar
                                    "preventDuplicates": true // Prevent duplicate notifications from being shown
                                });
                        }
                    });

                });















             $('#createPOform #order_no').on('change',function(){
                // alert('hi');

                $('#createPOform .demotable').show();

             });

             function printImage(imageId) {
                var imageSrc = $('#' + imageId).attr('src');
                var printWindow = window.open('', '_blank');
                printWindow.document.write('<html><head><title>Print Invoice</title></head><body><img src="' + imageSrc + '" style="max-width:100%;" /></body></html>');
                printWindow.document.close();
                printWindow.onload = function() {
                    printWindow.print();
                    printWindow.close();
                };
            }


             $("#send_modal_data").click(function() {
                    var dataToSend = [];

                    // Loop through each row of the table
                    $("#dataTableTestTable tbody tr").each(function() {
                        var rowData = {};

                        // Loop through each cell of the current row
                        $(this).find("td").each(function() {
                            // Get the column name from the table header
                            var columnName = $(this).closest('table').find('th').eq($(this).index()).text().trim();
                            
                            // Get the text content of the cell
                            var cellData = $(this).text().trim();
                            
                            // Add cell data to rowData with column name as key
                            rowData[columnName] = cellData;
                        });

                        // Push the rowData object to dataToSend array
                        dataToSend.push(rowData);
                    });

                    // Send data to server via AJAX
                    sendDataToServer(dataToSend);
                    sendDataToServerHeader();
                });




                function sendDataToQUTItemLists(data) {
                    // Send data via AJAX to a Laravel route that maps to a controller function
                    // Replace 'your-route' with the actual route name in your Laravel routes file
                    // Replace 'your-controller-method' with the actual method name in your controller
                    
                    $.ajax({
                        url: '/save_these_qut_item_data',
                        type: 'POST',
                        contentType: 'application/json',
                        dataType: 'json', // Specify that you're expecting JSON data in the response
                        data: JSON.stringify({ data: data }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('Data sent successfully:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error sending data:', error);
                        }
                    });

                    }



                function sendDataToPrSupplierLists(data) {
                    // Send data via AJAX to a Laravel route that maps to a controller function
                    // Replace 'your-route' with the actual route name in your Laravel routes file
                    // Replace 'your-controller-method' with the actual method name in your controller
                    
                    $.ajax({
                        url: '/save_these_supplier_data',
                        type: 'POST',
                        contentType: 'application/json',
                        dataType: 'json', // Specify that you're expecting JSON data in the response
                        data: JSON.stringify({ data: data }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // console.log('Data sent successfully:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error sending data:', error);
                        }
                    });

                    }





                $('.createInvoice').on('click',function(){
                    alert('Invoice Created Successfully.');
                });


                function toggleDropdown() {
                    var dropdownContent = document.getElementById("dropdownContent");
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                    }

                    function selectOption(option) {
                    var dropbtn = document.querySelector(".dropbtn");
                    dropbtn.textContent = option;
                    toggleDropdown(); // Close the dropdown after selection
                    }



                    function sendDataToServer(data) {
                    // Send data via AJAX to a Laravel route that maps to a controller function
                    // Replace 'your-route' with the actual route name in your Laravel routes file
                    // Replace 'your-controller-method' with the actual method name in your controller
                    
                    $.ajax({
                        url: '/save_these_data',
                        type: 'POST',
                        contentType: 'application/json',
                        dataType: 'json', // Specify that you're expecting JSON data in the response
                        data: JSON.stringify({ data: data }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // console.log('Data sent successfully:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error sending data:', error);
                        }
                    });

                    }



                    function sendDataToPRItemLists(data) {
                    // Send data via AJAX to a Laravel route that maps to a controller function
                    // Replace 'your-route' with the actual route name in your Laravel routes file
                    // Replace 'your-controller-method' with the actual method name in your controller
                    
                    $.ajax({
                        url: '/save_item_lists_pr',
                        type: 'POST',
                        contentType: 'application/json',
                        dataType: 'json', // Specify that you're expecting JSON data in the response
                        data: JSON.stringify({ data: data }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // console.log('Data sent successfully:', response);
                        },
                        error: function(xhr, status, error) {
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

                    }



                    
                    function sendDataToItemLists(data) {
                    // Send data via AJAX to a Laravel route that maps to a controller function
                    // Replace 'your-route' with the actual route name in your Laravel routes file
                    // Replace 'your-controller-method' with the actual method name in your controller
                    
                    $.ajax({
                        url: '/save_item_lists',
                        type: 'POST',
                        contentType: 'application/json',
                        dataType: 'json', // Specify that you're expecting JSON data in the response
                        data: JSON.stringify({ data: data }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('Data sent successfully:', response);
                        },
                        error: function(xhr, status, error) {
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

                    }


                    function sendDataToServerHeader(){
                        $('#headerOrderForm').submit();
                        $('#headerOrderForm').submit(function(event){
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

                                                // console.log(response);

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
                        }

                        $('.btn').css('padding','15px');
                        $('.page-item span').css('background-color','#283b97');
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



 // Attach click event handler to the anchor element
 $('.checkMpsDetails').on('click', function(e) {
        // Prevent the default action of the anchor
        e.preventDefault();
        
        // Get the order ID from the data attribute
        var id = $(this).data('id');
        
        // Make AJAX call
        $.ajax({
            url: '/fetch-mps-details', // Specify your endpoint URL
            type: 'GET', // Or 'GET' depending on your server route
            data: { id: id }, // Send the order ID in the request
            success: function(response) {
                // Handle the AJAX response here
                // console.log('Response:', response);

                $('#FetchMpsDetailsModal').modal('show');


                // Optionally, you can redirect the user to a success page or perform any other actions
                var tableBody = '';
                  
                  $.each(response.order_items, function(index, item) {
                      tableBody += '<tr>';
                      tableBody += '<td>' + (index + 1) + '</td>';
                      tableBody += '<td>' + item.product_name + '</td>';
                      tableBody += '<td>' + parseFloat(item.unit_price).toLocaleString() + '</td>';
                      tableBody += '<td>' + parseInt(item.quantity).toLocaleString() + '</td>';
                      tableBody += '<td>' + parseFloat(item.total_price).toLocaleString() + '</td>';
                      tableBody += '<td>' + parseFloat(item.tax_amount).toLocaleString() + '</td>';
                      tableBody += '<td>' + parseFloat(item.discount).toLocaleString() + '</td>';
                      tableBody += '<td>' + parseFloat(item.sub_total).toLocaleString() + '</td>';
                      tableBody += '</tr>';
                  });

                  $('#checkMpsDetailstblBody').html(tableBody);

                //   $.each(response.plannedHeader, function(index, item) {

                    var plannedHeader = response.plannedHeader;

                    $('#fetched_order_id').text(plannedHeader.order_id);
                    $('#total_amount').text(parseFloat(plannedHeader.order_totoal).toLocaleString() );
                    $('#total_discount').text(parseFloat(plannedHeader.discount).toLocaleString() );
                    $('#line_item_total').text(parseFloat(plannedHeader.total_amount).toLocaleString() );
                    $('#total_tax').text(parseFloat(response.totalTaxAmount).toLocaleString() );
  
                   var mpsdetails =   response.mpsdetails;
                   var status = status = mpsdetails.status == 1 ? 'Pending':(mpsdetails.status == 2 ? 'Processing':(mpsdetails.status == 3 ? 'Completed': ''))
                   $('#fetched_status').text(status);
                   $('#fetched_start_date').text(mpsdetails.planned_start_date);
                   $('#fetched_end_date').text(mpsdetails.planned_end_date);
                   $('#fetched_quantity').text(mpsdetails.planned_quantity);
                   $('#fetched_line').text(mpsdetails.conveyour_line);        
                //   });

            },
            error: function(xhr, status, error) {
                // Handle any errors
                console.error('Error:', error);
            }
        });
    });



        // When the button with id forecastProductModalButton is clicked
    $('#forecastProductModalButton').click(function(event) {
        // Prevent the default behavior of the link
        event.preventDefault();


        // Get the value of forecast_link_id
        var forecastLinkId = $('input[name="forecast_link_id"]').val();

        // Now you can use forecastLinkId for further processing
        // alert('Forecast Link ID:'+ forecastLinkId);
    });

        $('#order_accordian_toggle').click(function(){
            $('.accordion-item #collapseOne').collapse('hide');
            $('.accordion-item #collapseTwo').collapse('hide');
            $('.accordion-item #collapseThree').collapse('hide');
            $('.accordion-item #collapseOne').toggle();
            $('.accordion-item #collapseTwo').toggle();
            $('.accordion-item #collapseThree').toggle();
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
                    // console.log(response);

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



            // $("#addBtn").click(function(){
            //     var todoText = $("#todoInput").val();
            //     // var priority = $("#prioritySelect").val();
            //     if(todoText !== ''){
            //         $("#todoList").append("<li class='col-md-4'>" + todoText + "</li>");
            //         $("#todoInput").val('0');
            //     } else {
            //         alert("Please enter a task.");
            //     }
            // });





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
                        // console.log(response.item);
                        
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

                                // console.log(response);
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

    $('a.btn:contains("Edit")').addClass('mdi mdi-pen').html('');
    $('a.btn:contains("Delete")').addClass('mdi mdi-delete').html('');


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


    $('#createPOform #supplier_id').on('change',function(){
        var id = $(this).children('option:selected').val();

        // Get CSRF token value from meta tag
        var csrfToken = $('meta[name=csrf-token]').attr('content');

         // AJAX request
         $.ajax({
            url: 'fetch_supplier_for_po', // Replace 'your_server_endpoint_here' with the actual server endpoint
            method: 'POST', // or 'GET' depending on your server configuration
            headers: {
                'X-CSRF-Token': csrfToken // Include CSRF token in the request headers
            },
            data: {
                id: id,
            },
            success: function(response) {
                // Handle success response from the server
               
                var supplier = response.suppliers;
                // console.log('Success:', supplier);


                $('#createPOform #payment_terms').val(supplier.payment_terms);
                $('#createPOform #lead_time').val(supplier.lead_time);
            },
            error: function(xhr, status, error) {
                // Handle error response from the server
                console.error('Error:', error);
            }
        });
    })


    $('.itemListsPOBTNInInvoice').on('click', function(e){
        e.preventDefault();

        var id = $(this).data('id');
       // Send the order ID as data in the AJAX request
       $.ajax({
                    url: '/fetch_order_item_data_for_invoice',
                    method: 'POST',
                    data: { id: id }, // Pass id as an object
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    success: function(response) {
                        // Close all modals on success
                    //    console.log(response);
                        $('#viewPOmodal').modal('show');

                        var orderDetails = response.orderDetails;
                        var supplier = response.supplier;


                        $('#viewPOmodal #vendor_street_address').text(supplier.address + ', ' +supplier.city + ', '+supplier.state + ' ' +supplier.postal_code + ', ' +supplier.country);
                        $('#viewPOmodal #vendor_phone').text(supplier.phone_number);
                        $('#viewPOmodal #vendor_email').text(supplier.email);
                        $('#viewPOmodal #vendor_name').text(supplier.cotact_person);
                        $('#viewPOmodal #vendor_gstin').text(supplier.tax_id);
                        $('#viewPOmodal #order_id').text(orderDetails.po_id);
                        $('#viewPOmodal #billing_street_address').text(orderDetails.billing_address);
                        $('#viewPOmodal #billing_address').text(orderDetails.billing_city + ', '+orderDetails.billing_state + ' ' +orderDetails.billing_pincode);
                        $('#viewPOmodal #shipping_street_address').text(orderDetails.delivery_address + ', ' +orderDetails.delivery_city + ', '+orderDetails.delivery_state + ' ' +orderDetails.delivery_pincode);
                        $('#viewPOmodal #order_date').text(orderDetails.order_date);
                        $('#viewPOmodal #expected_delivery_date').text(orderDetails.delivery_date);
                        $('#viewPOmodal #lead_time').text(orderDetails.payment_terms);
                        $('#viewPOmodal #total_quantity').text(parseFloat(orderDetails.total_qty).toLocaleString());
                        $('#viewPOmodal #line_item_total').text(parseFloat(orderDetails.line_amount_total).toLocaleString());
                        $('#viewPOmodal #total_items').text(orderDetails.total_unit);
                        $('#viewPOmodal #delivery_method').text(orderDetails.shipping_method);
                        var tax = orderDetails.line_amount_total * (18/100);
                        var total =  parseFloat(orderDetails.line_amount_total);
                        var sgst = tax/2;
                        var cgst = tax/2;
                        var handling = 200;
                        var other = 1000;
                        var final = sgst + cgst + handling + other + total;
                        $('#viewPOmodal #sgst').text(parseFloat(sgst).toLocaleString());
                        $('#viewPOmodal #cgst').text(parseFloat(cgst).toLocaleString());
                        $('#viewPOmodal #handling').text(parseFloat(handling).toLocaleString());
                        $('#viewPOmodal #other').text(parseFloat(other).toLocaleString());
                        $('#viewPOmodal #final').text(parseFloat(final).toLocaleString());
                        // Optionally, you can redirect the user to a success page or perform any other actions
                            var tableBody = '';

                              // Clear previous items
                                $('.item_code, .item_name, .item_category, .item_vehicle, .item_unit_price, .item_quantity, .item_total').empty();

                                $.each(response.orderitems, function(index, item) {
                                    var unit_price = parseFloat(item.unit_price).toLocaleString();
                                    var total_price = parseFloat(item.total_price).toLocaleString();
                                    $('.item_code').append(item.part_number + '<br>');
                                    $('.item_name').append(item.part_name + '<br>');
                                    $('.item_category').append(item.category + '<br>');
                                    $('.item_vehicle').append(item.vehicle + '<br>');
                                    $('.item_unit_price').append(unit_price + '<br>');
                                    $('.item_quantity').append(item.quantity + '<br>');
                                    $('.item_total').append(total_price + '<br>');
                                });

                            $('#viewPOmodal #table_items_po #table_items_po_tbl_bdy').append(tableBody);
                            console.clear();


                        // Other actions after successful AJAX call
                    },
                    error: function(xhr, status, error) {
                        // Error handling
                    }
                });
    })


                    $('.approveValidateInvoice').on('click', function(e){
                        e.preventDefault();

                        var id = $(this).data('id');
                        // Get CSRF token value from meta tag
                        var csrfToken = $('meta[name=csrf-token]').attr('content');

                        // AJAX request
                        $.ajax({
                        url: '/approve_invoice', // Replace 'your_server_endpoint_here' with the actual server endpoint
                        method: 'POST', // or 'GET' depending on your server configuration
                        headers: {
                            'X-CSRF-Token': csrfToken // Include CSRF token in the request headers
                        },
                        data: {
                            id: id,
                        },
                        success: function(response) {
                           
                            // Handle success response from the server
                            if(response.success == true){
                            toastr.options = {
                                "timeOut": "5000",
                                "toastClass": "toast-green",
                                "extendedTimeOut": "2000",
                                "progressBar": true,
                                "closeButton": true,
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut",
                                "progressBarBgColor": "#ff0000",
                                "preventDuplicates": true,
                                "onHidden": function() {
                                    window.location.reload(); // Reload the page when the toastr is hidden
                                }
                            };

                            toastr.success(response.message);
                           }else{
                            toastr.options = {
                                "timeOut": "5000",
                                "toastClass": "toast-red",
                                "extendedTimeOut": "2000",
                                "progressBar": true,
                                "closeButton": true,
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut",
                                "progressBarBgColor": "#ff0000",
                                "preventDuplicates": true,
                                "onHidden": function() {
                                    window.location.reload(); // Reload the page when the toastr is hidden
                                }
                            };

                            toastr.success('Some Error occur contact service provider');
                           }
                           
                        },
                        error: function(xhr, status, error) {

                            // Handle error response from the server
                            console.error('Error:', error);
                        }
                        });
                    });


                    $('.rejectValidateInvoice').on('click', function(e){
                        e.preventDefault();

                        var id = $(this).data('id');
                        // Get CSRF token value from meta tag
                        var csrfToken = $('meta[name=csrf-token]').attr('content');

                        // AJAX request
                        $.ajax({
                        url: '/reject_invoice', // Replace 'your_server_endpoint_here' with the actual server endpoint
                        method: 'POST', // or 'GET' depending on your server configuration
                        headers: {
                            'X-CSRF-Token': csrfToken // Include CSRF token in the request headers
                        },
                        data: {
                            id: id,
                        },
                        success: function(response) {

                            // Handle success response from the server
                           if(response.success == true){
                            toastr.options = {
                                "timeOut": "5000",
                                "toastClass": "toast-red",
                                "extendedTimeOut": "2000",
                                "progressBar": true,
                                "closeButton": true,
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut",
                                "progressBarBgColor": "#ff0000",
                                "preventDuplicates": true,
                                "onHidden": function() {
                                    window.location.reload(); // Reload the page when the toastr is hidden
                                }
                            };

                            toastr.success(response.message);
                           }else{
                            toastr.options = {
                                "timeOut": "5000",
                                "toastClass": "toast-red",
                                "extendedTimeOut": "2000",
                                "progressBar": true,
                                "closeButton": true,
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut",
                                "progressBarBgColor": "#ff0000",
                                "preventDuplicates": true,
                                "onHidden": function() {
                                    window.location.reload(); // Reload the page when the toastr is hidden
                                }
                            };

                            toastr.success('Some Error occur contact service provider');
                           }
                            
                        },
                        error: function(xhr, status, error) {
                            // Handle error response from the server
                            console.error('Error:', error);
                        }
                        });
                    });




                $('.viewInvoice').on('click', function(e){
                    e.preventDefault();

                    var id = $(this).data('id');
                    
                // Get CSRF token value from meta tag
                var csrfToken = $('meta[name=csrf-token]').attr('content');

                // AJAX request
                $.ajax({
                    url: 'fetch_invoice_details', // Replace 'your_server_endpoint_here' with the actual server endpoint
                    method: 'POST', // or 'GET' depending on your server configuration
                    headers: {
                        'X-CSRF-Token': csrfToken // Include CSRF token in the request headers
                    },
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        // Handle success response from the server
                        console.clear();
                        console.log('Success:', response);
                          // Clear previous items
                     $('#serial_num, #description, #unitprice, #quantity, #total').empty();


                        $.each(response.items, function(index, item) {
                            var unit_price = parseFloat(item.unit_price).toLocaleString();
                            var total_price = parseFloat(item.total_price).toLocaleString();
                            $('#downloadInvoiceModal #serial_num').append(index+1);
                            $('#downloadInvoiceModal #description').append(item.part_name + '<br>');
                            $('#downloadInvoiceModal #unitprice').append('<b>Rs.</b>'+unit_price + '<br>');
                            $('#downloadInvoiceModal #quantity').append(item.quantity + '<b>pcs.</b><br>');
                            $('#downloadInvoiceModal #total').append('<b>Rs.</b>'+total_price + '<br>');
                        });


                        var po_details = response.po_details;
                        var invoice = response.invoice;
                        var supplier = response.supplier;

                       // Define the variables
                        var tax_rate = 18;
                        var other = 2000;

                        // Assume po_details.line_amount_total is provided as a number or a string that represents a number
                        var line_amount_total = parseFloat(po_details.line_amount_total);

                        // Calculate the tax amount
                        var tax_amt = line_amount_total * tax_rate / 100;

                        // Ensure the values are numbers before addition
                        var final_tax_amt = parseFloat(tax_amt); // Already a number, but ensuring it's a float
                        var final_line_amount_total = parseFloat(line_amount_total); // Ensuring it's a float

                        // Calculate the overall amount
                        var overall_amt = final_tax_amt + final_line_amount_total + other;

                        var formatted_other =parseFloat(other).toLocaleString();

                        // Format the amounts to strings with commas for readability, if needed
                        var formatted_tax_amt = parseFloat(final_tax_amt).toLocaleString();
                        var formatted_line_amount_total = parseFloat(final_line_amount_total).toLocaleString();
                        var formatted_overall_amt = parseFloat(overall_amt).toLocaleString();
                        
                        $('#downloadInvoiceModal #po_number').html(po_details.po_id);
                        $('#downloadInvoiceModal #po_date').html(po_details.order_date);
                        $('#downloadInvoiceModal #sub_total').html('<b>Rs.</b>'+formatted_line_amount_total);
                        $('#downloadInvoiceModal #tax').html('<b>Rs.</b>'+formatted_tax_amt);
                        $('#downloadInvoiceModal #other').html('<b>Rs.</b>'+formatted_other);
                        $('#downloadInvoiceModal #line_item_total').html('<b>Rs.</b>'+formatted_overall_amt);
                        $('#downloadInvoiceModal #invoice_id').html(invoice.invoice_number);
                        $('#downloadInvoiceModal #invoice_date').html(invoice.invoice_date);
                        $('#downloadInvoiceModal #vendor_name').html(supplier.supplier_name);
                        $('#downloadInvoiceModal #address_line_1').html(invoice.address);
                        $('#downloadInvoiceModal #address_line_2').html(supplier.city + ',' + supplier.state + ',' + supplier.postal_code);
                        $('#downloadInvoiceModal #terms').html(supplier.steps);
                        $('#downloadInvoiceModal #notes').html(supplier.notes);
                        $('#downloadInvoiceModal #supplier_gst').html(supplier.gst_in);
                        $('#downloadInvoiceModal #bill_to_address').html(po_details.billing_address);
                        $('#downloadInvoiceModal #bill_to_address_city').html(po_details.billing_city + ',' + po_details.billing_state + ',' + po_details.billing_pincode);
                        $('#downloadInvoiceModal #ship_to_address').html(po_details.delivery_address);
                        $('#downloadInvoiceModal #ship_to_address_city').html(po_details.delivery_city + ',' + po_details.delivery_state + ','+  po_details.delivery_pincode);
                       
                        
                    },
                    error: function(xhr, status, error) {
                        // Handle error response from the server
                        console.error('Error:', error);
                    }
                });
                })

                $('.sendInvoice').on('click', function(e){
                    e.preventDefault();

                    var id = $(this).data('id');
                    // Get CSRF token value from meta tag
                        var csrfToken = $('meta[name=csrf-token]').attr('content');

                    // AJAX request
                    $.ajax({
                        url: '/send_invoice', // Replace 'your_server_endpoint_here' with the actual server endpoint
                        method: 'POST', // or 'GET' depending on your server configuration
                        headers: {
                            'X-CSRF-Token': csrfToken // Include CSRF token in the request headers
                        },
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            // Handle success response from the server
                            console.log('Success:', response);

                            toastr.options = {
                            "timeOut": "5000",
                            "toastClass": "toast-green",
                            "extendedTimeOut": "2000",
                            "progressBar": true,
                            "closeButton": true,
                            "positionClass": "toast-top-right",
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut",
                            "progressBarBgColor": "#ff0000",
                            "preventDuplicates": true,
                            "onHidden": function() {
                                window.location.reload(); // Reload the page when the toastr is hidden
                            }
                        };

                        toastr.success(response.message);
                            
                        },
                        error: function(xhr, status, error) {
                            // Handle error response from the server
                            console.error('Error:', error);
                        }
                    });
                })







    $('#add_item_po').on('click', function() {
    var po_number = $('#order_no').val();
    // alert(po_number);
   
    var item_code = $('.item_name').children('option:selected').val();
    var quantity = $('#quantity').val();
    // alert(item_code);

    // Get CSRF token value from meta tag
    var csrfToken = $('meta[name=csrf-token]').attr('content');

        // AJAX request
        $.ajax({
            url: 'fetch_item_lists_po', // Replace 'your_server_endpoint_here' with the actual server endpoint
            method: 'POST', // or 'GET' depending on your server configuration
            headers: {
                'X-CSRF-Token': csrfToken // Include CSRF token in the request headers
            },
            data: {
                item_code: item_code,
            },
            success: function(response) {
                // Handle success response from the server
                // console.log('Success:', response);
                var items = response.part;

                var tableBody = '';  

               var total_cost = quantity * items.unit_cost;
                        tableBody += '<tr>';
                        // tableBody += '<td>' + (index + 1) + '</td>';
                        tableBody += '<td>' + po_number + '</td>';
                        tableBody += '<td>' + items.part_number + '</td>';
                        tableBody += '<td>' + items.part_name + '</td>';
                        tableBody += '<td>' + items.category + '</td>';
                        tableBody += '<td>' + items.vehicle + '</td>';
                        tableBody += '<td>' + items.unit_cost + '</td>';
                        tableBody += '<td>' + quantity + '</td>';
                        tableBody += '<td>' + total_cost + '</td>';
                        tableBody += '<td><a class="delete-link-po btn btn-primary" style="color:white;"><i class="mdi mdi-delete"></i></a>';
                        tableBody += '</td>';
                        tableBody += '</tr>';   
                        if(po_number !== ''){
                        $('#itemlistsPO').append(tableBody);
                        }else{
                            toastr.error('error', 'PO number is not in valid format! Item no added to Item Lists.', {
                                "timeOut": "5000",
                                "extendedTimeOut": "2000",
                                "progressBar": true,
                                "closeButton": true,
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut",
                                "preventDuplicates": true,
                                "toastClass": "toast-red" // Add custom class to the notification
                            });
                        }
                        $('#item_name').val(0);
                        $('#quantity').val(0);
                        // console.clear();
            },
            error: function(xhr, status, error) {
                // Handle error response from the server
                console.error('Error:', error);
            }
        });
    });

    $('.delete-link-po').on('click',function(){
      alert('hi');
    })

    $('.generateInvoice').on('click', function(event){
        event.preventDefault();

        var id = $(this).data('id');
        // Get CSRF token value from meta tag
        var csrfToken = $('meta[name=csrf-token]').attr('content');

        $.ajax({
                url: '/generate_invoice', //Route URL
                method: 'POST',
                headers: {
                'X-CSRF-Token': csrfToken // Include CSRF token in the request headers
                 },
                data: {
                    id: id // Pass the selected PO ID as data
                },
                success: function(response) {
                   
                    toastr.options = {
                        "timeOut": "5000",
                        "toastClass": "toast-green",
                        "extendedTimeOut": "2000",
                        "progressBar": true,
                        "closeButton": true,
                        "positionClass": "toast-top-right",
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "progressBarBgColor": "#ff0000",
                        "preventDuplicates": true,
                        "onHidden": function() {
                            window.location.reload(); // Reload the page when the toastr is hidden
                        }
                    };

                    toastr.success(response.message);

                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', error);
                }
                
            });

        });





        let quantity = $('quantity').val();
        $('#tick_check').hide();

        $('#addItemModalTest').on('hidden.bs.modal', function () {
            $('#order_items, #addItemModalTest #product_id').css('background-color', 'white');
            $('#tick_check').hide();
        });
        // Attach change event listener to the select element
        $('#exampleModal,#addItemModalTest #product_id').change(function() {
            // Get the selected dealer ID
            var selectedDealerId = $(this).children('option:selected').val(); // Get the value of the selected option
            // alert('Selected Dealer ID:' + selectedDealerId);
            $('#tick_check').show();
            $('#order_items,#addItemModalTest #product_id').css('background-color','rgba(72,235,150,0.5)');

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
       $(document).ready(function() {
      $('.form-control').css('border-bottom','1px solid black');
      $('.table th').css('color','#273a96');
    //   $('.table tr').css('border-bottom','1px solid #273a96');
    //   $('.table th').css('color','white');
     
    //   $('.table th').css('background-color','#598ac2');
    //   $('.table tr').css('background-color','#d5d7da')
      $('.table').addClass('table-sm');
      $('table').removeClass('table-hovered');
});
    </script>
    </body>
</html>