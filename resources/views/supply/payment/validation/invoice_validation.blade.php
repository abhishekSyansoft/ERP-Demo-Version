@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Goods Recieving Note's:
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>  Invoices Recieved:<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
              
            <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Invoice Validation</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                          @if(Auth::user()->admin==3)
                        <!-- <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>   -->
                        @endif
                        </div>
                        <!-- <hr>   -->
                      </div>     
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                        Edit Supplier
                        </button>   -->

                        <!-- <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit Order &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button> -->
                        
                        
                <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <div class="table-wrapper">
                        <table class="table table-bordered border-primary" style="width: 100%;">
                            <tr>
                              <th rowspan="2">S. No.</th>
                              <th rowspan="2">View PO</th>
                              <th rowspan="2">View Invoice</th>
                              <th colspan="2">Invoice</th>
                              <th colspan="2">Order</th>
                              <th colspan="2">Supplier</th>
                              <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <th>Number</th>
                              <th>Date</th>
                              <th>Number</th>
                              <th>Date</th>
                              <th>Name</th>
                              <th>Identity Number</th>
                            </tr>
                            @php($a=1)
                            @foreach($grn as $data)
                           
                                <tr>
                                    <td>{{$a++}}</td>
                                    <td><a class="btn btn-primary itemListsPOBTNInInvoice" data-bs-toggle="modal" data-bs-target="#viewPOmodal" data-id="{{$data->po_number}}"><i class="mdi mdi-eye"></i></a></td>
                                    <td><a class="btn btn-primary mdi mdi-eye viewInvoice" data-id="{{$data->po_number}}" data-bs-target="#downloadInvoiceModal" data-bs-toggle="modal"></a></td>
                                    <td>{{$data->invoice_number}}</td>
                                    <td>{{$data->invoice_date}}</td>
                                    <td>{{$data->po_number}}</td>
                                    <td>{{$data->po_date}}</td>
                                    <td>{{$data->supplier_name}}</td>
                                    <td>{{$data->supplier_id}}</td>
                                    <td>
                                   
                                   @if($data->approved == 1)
                                   <a class="mdi mdi-checkbox-multiple-marked-circle text-success" style="font-size:20px;"></a>
                                   @elseif($data->rejected == 1)
                                   <a class="mdi mdi-alert-octagon" style="font-size:20px;color:red;"></a>
                                   @else
                                    
                                      <a class="btn btn-primary approveValidateInvoice" data-id="{{$data->invoice_number}}"> Approve </a>
                                      <a class="btn btn-danger rejectValidateInvoice" data-id="{{$data->invoice_number}}"> Reject </a>
                                    
                                  @endif
                                  </td>
                                </tr>
                             
                            @endforeach
                        </table>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>


             <!-- Modal -->
        <div class="modal fade" id="viewPOmodal" tabindex="-1" role="dialog" aria-labelledby="viewPOmodalLabel" aria-hidden="true">
          <div class="modal-dialog mx-auto" style="max-width:900px;" role="document">
            <div class="modal-content card" style="background-color:white;">
              <div class="modal-header">
                <h5 class="modal-title" id="viewPOmodalLabel">View Purchase Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body m-0 p-2">
                <div class="" style="border:1px solid black;">
                      <div class="content-wrapper m-0 p-2">
                            <div class="row">
                              <div class="col-6">
                                <h4 class="m-0">SyanSoft Pvt. Ltd.</h4>
                                <h6 class="m-0">Solution for innovators</h6>
                              </div>
                              <div class="col-6">
                                <h2 style="float:right;">Purchase Order</h2>
                                
                                <h5 style="float:right">
                                PO No. : <span id="order_id"></span><br>
                                Order Date. : <span id="order_date"></span>
                              </h5>
                               
                              </div>
                              </div>
                            <!-- </div> -->
                            <br>
                       
                            <div class="row">
                            <div class="col-6">
                                  <h4>Vendor Detail's :</h4>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Name :</b><span id="vendor_name"> Abhishek Kumar</span></p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Company Name :</b> SyanSoft Pvt. Ltd.</p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Address :</b><span id="vendor_street_address">Unit No. 306, Tower B4, Spaze ITech Park, Sohna Road, Sector 49, Gurugram, Haryana 122018</span></p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Phone :</b>+91-<span id="vendor_phone">6202074551</span> </p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Email :</b><span id="vendor_email"> abc@gmail.com</span></p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Tin No. :</b><span id="vendor_gstin"> Tin Number </span></p></i>
                                </div>
                            </div>
                            <br>
                         

                            <!-- <div class="row">
                              <div class="col-6">
                                <p class="m-0" style="font-weight:200;">The folowing number must appear on all related <br> correspondence,shipping papers and invoices </p>
                                <br><h5>Order Number : <span id="order_id">PO_663b364a4778a</span></h5>
                              </div>
                            </div>
                            <br> -->


                            <div class="row">
                              <div class="col-6">
                               <h4>Bill TO : </h4>
                               <i><h5 class="m-0" id="billing_street_address"> Unit No. 306, Tower B4, Spaze ITech Park,<br> Sohna Road, Sector 49</h5>
                                <h6 class="m-0" id="billing_address"> Gurugram, Haryana 122018</h6></i><br>
                                <i class="mdi mdi-phone"></i> <b>Phone Number :</b><span id="bill_phone"> +91-6202074551 </span><br>
                                <i class="mdi mdi-email"></i> <b>Email :</b> <span id="bill_email"> +91-6202074551 </span>
                              </div>

                              <div class="col-6">
                                  <h4>SHIP TO :</h4> <span style="font-weight: 100 !important;"><i>Please Include as much information as possible. Maps are veryfull.</i></span><br><br>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Name :</b> Abhishek Kumar</p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Company Name :</b> SyanSoft Pvt. Ltd.</p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Address :</b>  <span id="shipping_street_address">Unit No. 306, Tower B4, Spaze ITech Park, Sohna Road, Sector 49, Gurugram, Haryana 122018</span></p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Phone :</b><span id="shipping_phone"> +91-6202074551</span> </p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Email :</b><span id="shipping_email"> abc@gmail.com</span></p></i>
                              </div>
                            </div>
                            <br>

                            <div class="row">
                              <div class="col-12 table-wrapper" style="margin:0px !important;height:auto;">
                              <table class="table table-bordered border-primary">
                                  <!-- <thead> -->
                                    <tr>
                                      <!-- <th>P.O. DATE</th> -->
                                      <th>REQUISITIONER</th>
                                      <th>SHIPPED VIA</th>
                                      <th>SHIPPEMENT DATE</th>
                                      <th>TERMS</th>
                                    </tr>
                                  <!-- </thead>
                                  <tbody> -->
                                   <tr>
                                      <!-- <td id="order_date">2024-05-08</td> -->
                                      <td>SyanSoft Pvt. Ltd</td>
                                      <td id="delivery_method">Will Call</td>
                                      <td id="expected_delivery_date">2024-05-08</td>
                                      <td id="lead_time">Net 30days</td>
                                   </tr>
                                  <!-- </tbody> -->
                              </table>
                              </div>
                            </div>
                       


                            <div class="row mt-4">
                              <div class="col-12" style="margin:0px !important;height:auto;">
                              <table class="table table-bordered border-primary" id="table_items_po">
                                  <!-- <thead> -->
                                    <tr>
                                      <th>Item Code</th>
                                      <th>Item Name</th>
                                      <!-- <th>Category</th> -->
                                      <th>Vehicle</th>
                                      <th>Unitprice</th>
                                      <th>Quantity</th>
                                      <!-- <th>Total Price</th> -->
                                    </tr>
                                    <tbody id="table_items_po_tbl_bdy">

                                    </tbody>
                                    <tr>
                                      <td style="min-height:200px;" class="item_code"></td>
                                      <td style="min-height:200px;" class="item_name"></td>
                                      <!-- <td style="min-height:200px;" class="item_category"></td> -->
                                      <td style="min-height:200px;" class="item_vehicle"></td>
                                      <td style="min-height:200px;" class="item_unit_price"></td>
                                      <td style="min-height:200px;" class="item_quantity"></td>
                                      <!-- <td style="min-height:200px;" class="item_total"></td> -->
                                    </tr>
                                  <!-- </thead>
                                  <tbody> -->
                                   <tr>
                                      
                                   </tr>
                                  <!-- </tbody> -->
                              </table>
                              </div>
                            </div>

                            <div class="row mt-4">
                              <div class="col-6">
                                <h6><b>Terms And Conditions: </b></h6>
                                <ul>
                                  <li><b>Delivery Schedule:</b> Supplier must adhere to agreed delivery dates. Non-conforming items may be rejected.</li>
                                </ul>
                              </div>
                              <div class="col-6">
                                <table class="table table-bordered border-primary">
                                <tr>
                                  <th class="p-1">Total Price</th>
                                  <td id="line_item_total"></td>
                                </tr>
                                <tr>
                                  <th class="p-1">SGST</th>
                                  <td id="sgst"></td>
                                </tr>
                                <tr>
                                  <th class="p-1">CGST</th>
                                  <td id="cgst"></td>
                                </tr>
                                <tr>
                                  <th class="p-1">Shipping & Handling</th>
                                  <td id="handling"></td>
                                </tr>
                                <tr>
                                  <th class="p-1">Other</th>
                                  <td id="other"></td>
                                </tr>
                                <tr>
                                  <th class="p-1">Final Amount</th>
                                  <td id="final"></td>
                                </tr>
                                 
                                </table>
                              </div>
                            </div>


                            <div class="row">
                              <!-- <div class="col-6">
                              </div> -->
                              <div class="col-6">
                                <h6>Signature : <i class="bi bi-patch-check-fill" style="color:green;">Digitally Verefied</i></h6>
                              </div>
                            </div>
                       
                       


                      </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="downloadPO">Download PO</button>
                <button type="button" class="btn btn-success" id="printPO">Print PO</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                    <p class="m-0 text-end"><b>Inv No./Date : </b><span id="invoice_id">INV_665d9984acc0e</span>/<span id="invoice_date">2024-06-03</span></p>
                    <p class="m-0 text-end"><b>PO No./Date : </b><span id="po_number">PO_66597c97051aa</span>/<span id="po_date">2024-06-03</span></p>
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




<!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Goods Receiving Note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body ">
                        <center><h2>Goods Receiving Note</h2></center>
                        <hr>

                      <table class="grn-table table table-bordered">
                          <tr>
                            <th><strong>Headings</strong></th>
                            <th><strong>Details</strong></th>
                          </tr>
                          <tr>
                            <td><strong>Supplier Information:</strong></td>
                            <td>Name: ABC Supplier<br>Contact: 123-456-7890</td>
                          </tr>
                          <tr>
                            <td><strong>Receiver Information:</strong></td>
                            <td>Name: John Doe<br>Contact: johndoe@example.com</td>
                          </tr>
                          <tr>
                            <td><strong>Goods Details:</strong></td>
                            <td>
                              <table class="table table-bordered p-2">
                                <tr><th>Item</th><th>Description</th><th>Quantity</th></tr>
                                <tr><td>Product A</td><td>Description of Product A</td><td>10</td></tr>
                                <tr><td>Product B</td><td>Description of Product B</td><td>5</td></tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td><strong>Purchase Order Information:</strong></td>
                            <td>PO Number: PO12345<br>Date: 2024-04-18</td>
                          </tr>
                          <tr>
                            <td><strong>Delivery Details:</strong></td>
                            <td>Date: 2024-04-18<br>Mode of Transportation: Truck</td>
                          </tr>
                          <!-- Add more details as needed -->
                        </table>
                        <hr>
                        <div class="form-group mt-2">
                          <!-- <button type="submit" class="btn btn-success">Check one to edit</button> -->
                           <!-- <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                            Check one to edit
                            </button>   -->
                          <button type="button" class="btn btn-secondary">Close</button>
                        </div>
                        <!-- </form> -->
                      </div>
                      
                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                      <!-- </div> -->
                    </div>
                  </div>
                </div>
                <!-- </div>
                  </div> -->
                <!-- </div> -->


          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
