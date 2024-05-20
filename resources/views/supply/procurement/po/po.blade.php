@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Purchase Orders
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Contract Management:<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Purchase Order Lists</h4>
                        <!-- <div class="card"> -->
                                <!-- <form method="GET" class="row">
                                  @csrf
                                    <div class="form-group" class="col-md-8">
                                        <input type="text" class="form-control" name="product" id="product">
                                    </div>
                                    <div class="form-group" class="col-md-4">
                                      <input class="btn btn-primary btn-md p-5" type="submit" value="Search">
                                    </div>
                                </form> -->
                            <!-- </div> -->
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                            
                          @if(Auth::user()->admin == 3)
                        <button style="float:right;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>  
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
                        <table class="table table-bordered border-primary">
                            <tr>
                                <th rowspan="2">S. No.</th>
                                <th rowspan="2">PO Number</th>
                               
                                <!-- <th rowspan="2">Quotation Number</th> -->
                                <th rowspan="2">View PO</th>
                                <th rowspan="2">View Items</th>
                                <th rowspan="2">QRCode</th>
                                <th rowspan="2">Barcode</th>
                                <th rowspan="1" colspan="3">Supplier</th>
                                <th rowspan="1" colspan="4">Order</th>
                                <th rowspan="2">Expected Delivery Date</th>
                        
                                <th rowspan="1" colspan="4">Delivery Location</th>
                                <th rowspan="1" colspan="4">Billing Location</th>
                                <th rowspan="2">Comments</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th>Payment Terms</th>
                                <th>Lead Time</th>
                                <th>Date</th>
                                <th>Total Items</th>
                                <th>Total quantity</th>
                                <th>Total amount</th>
                                <th> Address</th>
                                <th> City</th>
                                <th> State</th>
                                <th> Pincode</th>
                                <th> Address</th>
                                <th> City</th>
                                <th> State</th>
                                <th> Pincode</th>
                            </tr>
                            @php($i=1)
                            @foreach($po as $data)
                            @if (strpos(strtolower($data->supplier), strtolower($_GET['product'] ?? $data->supplier)) !== false)
                           
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->po_id}}</td>
                                    <td><a class="btn btn-primary itemListsPOBTN" data-bs-toggle="modal" data-bs-target="#viewPOmodal" data-id="{{$data->id}}"><i class="mdi mdi-eye"></i></a></td>
                                    <td><a class="btn btn-primary itemListsBTN" data-id="{{$data->id}}"><i class="mdi mdi-eye"></i></a></td>
                                    <td><a class="btn btn-primary"><i class="mdi mdi-eye"></i></a></td>
                                    <td><a class="btn btn-primary"><i class="mdi mdi-eye"></i></a></td>
                                    <!-- <td><a class="mdi mdi-eye" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td> -->
                                    <!-- <td><a class="mdi mdi-file" style="font-size:20px;color:red;" href="https://www.wordtemplatesonline.net/wp-content/uploads/2021/06/Quotation-Template-06-2021-04.jpg"></a></td> -->
                                    <td>{{$data->supplier}}</td>
                                    <td>{{$data->payment_terms}}</td>
                                    <td>{{$data->lead_time}}</td>
                                    <td>{{$data->order_date}}</td>
                                    <td>{{$data->total_unit}}</td>
                                    <td>{{$data->total_qty}}</td>
                                    <td><b>$ </b>{{number_format($data->line_amount_total)}}</td>
                                    <!-- <td>{{$data->order_date}}</td> -->
                                    <td>{{$data->delivery_date}}</td>
                                    <td>{{$data->delivery_address}}</td>
                                    <td>{{$data->delivery_city}}</td>
                                    <td>{{$data->delivery_state}}</td>
                                    <td>{{$data->delivery_pincode}}</td>
                                    
                                    <td>{{$data->billing_address}}</td>
                                    <td>{{$data->billing_city}}</td>
                                    <td>{{$data->billing_state}}</td>
                                    <td>{{$data->billing_pincode}}</td>
                                    <td>{{$data->comments}}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                      @if(Auth::user()->admin == 3)
                                        <a href="{{url('edit-po/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-po/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                                        <div class="dropdown">
                                          <a class="dropdownToggle dropbtn btn btn-success" style="background-color:transparent;text-decoration:none;color:black;">{{ $i % 2 == 0 ? 'Approved' : 'Rejected' }}</a>
                                          <div class="dropdownContent dropdown-content">
                                              <a class="optionSendForApproved btn btn-success" href="#">Send For Approved</a>
                                              <a class="optionRejected btn btn-success" href="#">Rejected</a>
                                              <a class="optionApproved btn btn-success" href="#">Approved</a>
                                              <a class="optionPending btn btn-success" href="#">Pending</a>
                                              <!-- Add more options as needed -->
                                          </div>
                                      </div>
                                      @else
                                        <a class="btn btn-success createInvoice" data-bs-toggle="modal" data-bs-target="#downloadInvoiceModal">Create Invoice</a>
                                      @endif
                                    </td>
                                </tr>
                                
                                @endif
                            @endforeach
                        </table>
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
                    <h5 class="modal-title" id="downloadInvoiceModalLabel">Download Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <center>
                      <img src="https://cdn.vertex42.com/WordTemplates/images/word-invoice-template.png" id="invoice-image" style="object-fit:contain;" alt="Invoice">
                    </center>
                    <div class="mt-3 text-center">
                      <!-- Download button -->
                      <a href="https://cdn.vertex42.com/WordTemplates/images/word-invoice-template.png" download="invoice.png" class="btn btn-primary mx-2">Download</a>
                      <!-- Print button -->
                      <!-- <button onclick="printImage('invoice-image')" class="btn btn-secondary mx-2">Print</button> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSupplierModalLabel">Create PO</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" class="row" id="createPOform">
                        @csrf
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="order_no" class="form-label">{{ __('PO Number') }}</label>
                            <input type="text" name="order_no" id="order_no" class="form-control" placeholder="Purchase order number" value="{{'PO_'.uniqid()}}">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="supplier_id" class="form-label">{{ __('Supplier') }}</label>
                            <select id="supplier_id"  class="form-control p-3" name="supplier_id" >
                                <option value="">--Select Supplier--</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="mb-3 col-md-6">
                            <label for="qut_no" class="form-label">{{ __('Quotation Number') }}</label>
                            <select id="qut_no" class="form-control p-3" name="qut_no" required>
                                <option value="0">--Select Option--</option>
                                @for($i=1;$i<=8;$i++)
                                <option value="1">QUT_{{uniqid()}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="payment_terms" class="form-label">{{ __('Payment Terms') }}</label>
                            <input type="text" id="payment_terms" class="form-control" name="payment_terms" placeholder="Payment terms discussed with the vendor">
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="lead_time" class="form-label">{{ __('Lead Time') }}(weeks)</label>
                            <input type="text" id="lead_time" class="form-control" name="lead_time" placeholder="Lead Time fixed for the dealer" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="order_date" class="form-label">{{ __('Order Date') }}</label>
                            <input type="date" id="order_date" class="form-control" name="order_date" value="{{ date('Y-m-d') }}" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="shipping_method" class="form-label">{{ __('Shipping Method') }}</label>
                            <input type="text" id="shipping_method" class="form-control" name="shipping_method" placeholder="Shipping method chossen for delivery">
                        </div>

                    
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="delivery_date" class="form-label">{{ __('Expected Delivery Date') }}</label>
                            <input type="date" id="delivery_date" class="form-control" name="delivery_date" placeholder="Enter the negotiated price" required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select id="status" class="form-control p-3" name="status" required>
                                <option value="0">--Select Option--</option>
                                <option value="1">Pending</option>
                                <option value="2">Issued</option>
                                <option value="3">Received</option>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                          <label for="comments">Comments</label>
                          <textarea name="comments" rows="10" class="form-control" id="comments" placeholder="Enter any comments or any notes"></textarea>
                        </div>


                        <div class="mb-3">
                          <hr>
                          <h4>Address</h4>
                          <hr>
                        </div>


                        <div class="mb-3 col-md-6 row mx-auto p-0">
                          <h4>Delivery Address : </h4>
                            <div class="form-group col-md-6">
                              <label for="delivery_address" class="form-label">{{ __('Address') }}</label>
                              <input type="text" id="delivery_address" class="form-control" name="delivery_address" placeholder="A brief address detail where to be delivered" required>
                            </div>

                            <div class="form-group col-md-6">
                              <label for="delivery_city" class="form-label">{{ __('City') }}</label>
                              <input type="text" id="delivery_city" class="form-control" name="delivery_city" placeholder="City name where the order needed to be delivered" required>
                            </div>

                            <div class="form-group col-md-6">
                              <label for="delivery_state" class="form-label">{{ __('State') }}</label>
                              <input type="text" id="delivery_state" class="form-control" name="delivery_state" placeholder="State name where the order needed to be delivered" required>
                            </div>

                            <div class="form-group col-md-6">
                              <label for="delivery_pincode" class="form-label">{{ __('Pincode') }}</label>
                              <input type="text" id="delivery_pincode" class="form-control" name="delivery_pincode" placeholder="Pincode where the order needed to be delivered" required>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6 row mx-auto  p-0">
                          <h4>Billing Address : </h4>
                            <div class="form-group col-md-6">
                              <label for="billing_address" class="form-label">{{ __('Address') }}</label>
                              <input type="text" id="billing_address" class="form-control" name="billing_address" placeholder="A brief address detailpayment will be processed" required>
                            </div>

                            <div class="form-group col-md-6">
                              <label for="billing_city" class="form-label">{{ __('City') }}</label>
                              <input type="text" id="billing_city" class="form-control" name="billing_city" placeholder="Billing City name where the order needed to be delivered" required>
                            </div>

                            <div class="form-group col-md-6">
                              <label for="billing_state" class="form-label">{{ __('State') }}</label>
                              <input type="text" id="billing_state" class="form-control" name="billing_state" placeholder="Billing state for this order" required>
                            </div>

                            <div class="form-group col-md-6">
                              <label for="billing_pincode" class="form-label">{{ __('Billing Pincode') }}</label>
                              <input type="text" id="billing_pincode" class="form-control" name="billing_pincode" placeholder="Billing Pincode where the order needed to be delivered" required>
                            </div>
                        </div>
                        

                        <div class="mb-3">
                          <hr>
                          <h4>Item Lists</h4>
                          <hr>
                        </div>

                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="item_name" class="form-label">{{ __('Item') }}</label>
                            <select id="item_name" class="form-control p-3 item_name" name="item_name" required>
                                <option value="0">--Select Option--</option>
                               @foreach($parts as $part)
                               <option value="{{$part->id}}">{{$part->part_name.' for '.$part->vehicle}}</option>
                               @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="quantity" class="form-label">{{ __('Quantity') }}</label>
                            <input type="text" id="quantity" class="form-control" name="quantity" placeholder="Quantity required to purchase for a particular item" required>
                        </div>

                        <div class="mb-3 col-md-12">
                        
                          <div class="table-wrapper m-0 p-0" style="margin:0px !important; height:auto !important;">
                            <table class="table table-bordered border-primary">
                              <thead>
                                <tr>
                                  <!-- <th>S. No.</th> -->
                                  <th>PO Number</th>
                                  <th>Item Code</th>
                                  <th>Item Name</th>
                                  <th>Category</th>
                                  <th>Vehicle</th>
                                  <th>Unitprice</th>
                                  <th>Quantity</th>
                                  <th>Total Price</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                              <tbody id="itemlistsPO">
                               
                              </tbody>
                            </table>
                          </div>
                        </div>


                        <div class="mb-3 col-md-12">
                          <a class="btn btn-primary" id="add_item_po">Add Items</a>
                        </div>

                        <div class="mb-3 col-md-12">
                          <hr>
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
                                    <!-- <tbody id="table_items_po_tbl_bdy">

                                    </tbody> -->
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
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Item Lists</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body">
                     <div class="table-wrapper">
                     <table class="table table-bordered">
                        <thead>
                          <tr>
                            <!-- <th>S. No.</th> -->
                            <th>S. No</th>
                            <th>Vehicle</th>
                            <th>Category</th>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Unitprice</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                          </tr>
                        </thead>
                        <tbody id="OrdereditemlistsPO">
                          
                        </tbody>
                      </table>                      
                     </div>
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
