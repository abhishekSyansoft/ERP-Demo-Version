@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel p-1 m-0">
          <div class="content-wrapper m-0 p-1">
            
              
                
          <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                  <div style="margin: auto; padding: 20px; font-family: Arial, sans-serif; line-height: 1.6;">
    <h2 style="text-align: center; color: #2c3e50;">Frequently Asked Questions</h2>

    <div class="accordion">
        <div class="accordion-item" style="border-bottom: 1px solid #ddd; padding: 10px 0;">
            <h3 style="color: #2980b9; cursor: pointer;" onclick="toggleAccordion(this)">Question 1: How can I reset my password?</h3>
            <div class="accordion-content" style="display: none; padding-top: 10px;">
                <p>To reset your password, click on the 'Forgot Password' link on the login page and follow the instructions sent to your registered email address.</p>
            </div>
        </div>

        <div class="accordion-item" style="border-bottom: 1px solid #ddd; padding: 10px 0;">
            <h3 style="color: #2980b9; cursor: pointer;" onclick="toggleAccordion(this)">Question 2: How do I contact customer support?</h3>
            <div class="accordion-content" style="display: none; padding-top: 10px;">
                <p>You can contact customer support by clicking on the 'Contact Us' link at the bottom of our website, or by sending an email to support@example.com.</p>
            </div>
        </div>

        <div class="accordion-item" style="border-bottom: 1px solid #ddd; padding: 10px 0;">
            <h3 style="color: #2980b9; cursor: pointer;" onclick="toggleAccordion(this)">Question 3: Where can I find the user manual?</h3>
            <div class="accordion-content" style="display: none; padding-top: 10px;">
                <p>The user manual can be downloaded from the 'Resources' section of our website.</p>
            </div>
        </div>
    </div>

    <h2 style="text-align: center; color: #2c3e50; margin-top: 40px;">Help Desk</h2>

    <div class="accordion">
        <div class="accordion-item" style="border-bottom: 1px solid #ddd; padding: 10px 0;">
            <h3 style="color: #2980b9; cursor: pointer;" onclick="toggleAccordion(this)">How to Submit a Ticket</h3>
            <div class="accordion-content" style="display: none; padding-top: 10px;">
                <p>To submit a help desk ticket, log in to your account, go to the 'Help Desk' section, and click on 'Submit a Ticket'. Fill out the form with the necessary details and submit.</p>
            </div>
        </div>

        <div class="accordion-item" style="border-bottom: 1px solid #ddd; padding: 10px 0;">
            <h3 style="color: #2980b9; cursor: pointer;" onclick="toggleAccordion(this)">Response Time</h3>
            <div class="accordion-content" style="display: none; padding-top: 10px;">
                <p>Our support team typically responds to tickets within 24 hours on business days. You will receive an email notification once your ticket has been addressed.</p>
            </div>
        </div>

        <div class="accordion-item" style="border-bottom: 1px solid #ddd; padding: 10px 0;">
            <h3 style="color: #2980b9; cursor: pointer;" onclick="toggleAccordion(this)">Contacting Support Directly</h3>
            <div class="accordion-content" style="display: none; padding-top: 10px;">
                <p>If you need immediate assistance, you can call our support line at 1-800-123-4567. Our phone support is available from 9 AM to 5 PM, Monday through Friday.</p>
            </div>
        </div>
    </div>
</div>

                
                </div>
              </div>
            </div>
          </div>
          </div>


          <!-- Modal -->
          <div class="modal fade" id="downloadInvoiceModal" tabindex="-1" aria-labelledby="downloadInvoiceModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:white;">
              <div class="modal-header">
                <a class="btn btn-success printInvoice m-1" style="float:right !important;">Download Invoice <span class="mdi mdi-file"></span></a>                
                <button type="button" class="btn-close m-1" data-bs-dismiss="modal" aria-label="Close" style="float:right !important;"></button>
              </div>
              <div class="modal-body row content-wrapper">
                <div class="row mx-auto p-0">
                <div class="col-6">
                    <h1 class="text-primary"><span id="vendor_name">Kalpana Automobile Agency</span></h1>
                    <p class="m-0"><b>Address : </b><span id="address_line_1">Sec-48</span></p>
                            <!-- <p class="m-0"><b>Address Line 2 : </b><span id="address_line_1">Gurugram</span></p> -->
                    <p class="m-0"><b>City, State, ZipCode: </b><span id="address_line_2">Haryana</span></p>
                  </div>
                  <div class="col-6 p-2">
                    <h1 class="text-primary text-end" style="padding-right:10px;">Invoice</h1>
                    <p class="m-0 text-end" style="padding-right:10px;"><b>Inv No./Date : </b><span id="invoice_id">INV_665d9984acc0e</span>/<span id="invoice_date">2024-06-03</span></p>
                    <p class="m-0 text-end" style="padding-right:10px;"><b>PO No./Date : </b><span id="po_number">PO_66597c97051aa</span>/<span id="po_date">2024-06-03</span></p>
                    <p class="m-0 text-end"><b>GST Number: </b><span id="supplier_gst"></span></p>
                  </div>
                </div>
      
                  <div class="row mt-4 mx-auto">
                    <div class="p-2 col-6">
                      <h4 class="text-primary">Bill To:</h4>
                      <!-- id="ven_name" -->
                      <p class="m-0"><b>SyanSoft Technologies Private Limited</b></p>
                      <p class="m-0"><b>Address : </b><span id="bill_to_address">Unit No. 306, Tower B4, Spaze I-Tech Park, Badshahpur Sohna Rd Hwy, Sector 49</span></p>
                      <!-- <p class="m-0"><b>Address Line 2 : </b><span id="address_line_1">Gurugram</span></p> -->
                      <p class="m-0"><b>City, State, ZipCode: </b><span id="bill_to_address_city">Gurugram, Haryana 122018</span></p>
                      <p class="m-0"><b>Customer GSTIN : </b><span id="" class="text-end">29ABCDE1234F1Z5</span></p>
                    </div>

                    <div class="p-2 col-6">
                      <h4 class="text-primary">Ship To:</h4>
                      <!-- id="ven_name" -->
                      <p class="m-0"><b>SyanSoft Technologies Private Limited</b></p>
                      <p class="m-0"><b>Address Line 1 : </b><span id="ship_to_address">Unit No. 306, Tower B4, Spaze I-Tech Park, Badshahpur Sohna Rd Hwy, Sector 49</span></p>
                      <!-- <p class="m-0"><b>Address Line 2 : </b><span id="address_line_1">Gurugram</span></p> -->
                      <p class="m-0"><b>City, State, ZipCode: </b><span id="ship_to_address_city">Gurugram, Haryana 122018</span></p>
                    </div>
                  </div>
                  <div class="col-6 mt-4">
                    <b><p class="text-primary">Subject</p></b>
                  </div>

                  <div>
                    <table class="table table-hovered" style="border:0px !important;">
                      
                        <tr style="background-color:none !important;">
                          <th>S.No</th>
                          <th>Description</th>
                          <!-- <th>HSN Code</th> -->
                          <th>Unitprice</th>
                          <th>Quantity</th>
                          <th>Total</th>
                        </tr>
                        <tr>
                          <td id="serial_num">1</td>
                          <td id="description"></td>
                          <!-- <td></td> -->
                          <td id="unitprice"></td>
                          <td id="quantity"></td>
                          <td id="total"></td>
                        </tr>
                    </table>
                  </div>

                  <div class="row mb-4 mx-auto">
                    <div class="col-6 mt-4 p-0">
                     
                      <p><b>Term's & Conditions</b></p>
                     <div id="terms">

                     </div>
                    </div>
                    <div class="col-6 mt-4 m-0 p-0">
                      <table class="table table-bordered">
                        <tr>
                          <td>Sub-total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          <td id="sub_total"></td>
                        </tr>
                        <tr>
                          <td>Tax Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                          <td id="tax"></td>
                        </tr>
                        <tr>
                          <td>Other's &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                          <td id="other"></td>
                        </tr>
                        <tr>
                          <th>Final Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
                          <th id="line_item_total"></th>
                        </tr>
                      </table>
                      <!-- <p><b>Sub-total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> <span id="subtotal"></span></p>
                      <p><b>Tax Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> <span id="total_tax"></span></p> -->
                    </div>
                  </div>
                 <div class="row mx-auto">
                  <hr>
                  <h4>Notes:</h4>
                  <p id="notes">Invoices are vital documents in commercial transactions, detailing products or services provided, costs, and payment terms. They ensure transparency, facilitate accounting, and serve as legal records for both sellers and buyers.</p>
                  <hr>
                </div>
                <h5 class="text-primary" style="font-family:Georgia, serif;">Thank's for your business.</h5>
              </div>
            </div>
          </div>
        </div>


          
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSupplierModalLabel">Add Invoice</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('invoices.store')}}" enctype="multipart/form-data" class="row">
                        @csrf
                        
                        <div class="mb-3 col-md-6">
                            <label for="invoice_number" class="form-label">{{ __('Invoice Number') }}</label>
                            <input type="text" id="invoice_number" class="form-control" name="invoice_number" value="{{ uniqid() . dechex(\Carbon\Carbon::now()->timestamp) }}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="invoice_date" class="form-label">{{ __('Invoice date') }}</label>
                            <input type="date" id="invoice_date" class="form-control" name="invoice_date"  required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="invoice_total" class="form-label">{{ __('Invoice Total Amount') }}</label>
                            <input type="text" id="invoice_total" class="form-control" name="invoice_total" placeholder="Enter total amount"  required>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="attachments" class="form-label">{{ __('Attachments') }}</label>
                            <input type="file" id="attachments" class="form-control" name="attachments">
                        </div>

                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>


          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
