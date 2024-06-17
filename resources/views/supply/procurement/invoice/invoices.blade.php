@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel p-1 m-0">
          <div class="content-wrapper m-0 p-1">
            
              
                
          <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Invoices Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                          @if(Auth::user()->admin == 1)
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
                        <table class="table" style="width: 100%;">
                            <tr>
                                <th rowspan="2">S No.</th>
                                <th rowspan="2">View Invoice</th>
                                <th colspan="2" rowspan="1">Order</th>
                                <th colspan="2" rowspan="1">Invoice</th>
                                <th rowspan="1" colspan="2">Supplier</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <th>Order Number</th>
                              <th>Order Date</th>
                              <th>Invoice Number</th>
                              <th>Invoice Date Date</th>
                              <th>Supplier Name</th>
                              <th>Supplier ID</th>
                            </tr>
                            
                            @php($i=1)
                            @foreach($invoices as $data)
                            @if(Auth::user()->admin == 3)
                            @if($data->send_status == 1)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a class="btn btn-primary mdi mdi-eye viewInvoice" data-id="{{$data->po_id}}" data-bs-target="#downloadInvoiceModal" data-bs-toggle="modal"></a></td>
                                    <td>{{$data->po_id}}</td>
                                    <td>{{$data->order_date}}</td>
                                    <td>{{$data->invoice_number}}</td>
                                    <td>{{$data->invoice_date}}</td>
                                    <td>{{$data->supplier_id}}</td>
                                    <td>{{$data->supplier_id}}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-invoice/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-invoice/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endif
                                @else
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a class="btn btn-primary mdi mdi-eye viewInvoice" data-id="{{$data->po_id}}" data-bs-target="#downloadInvoiceModal" data-bs-toggle="modal"></a></td>
                                    <td>{{$data->po_id}}</td>
                                    <td>{{$data->order_date}}</td>
                                    <td>{{$data->invoice_number}}</td>
                                    <td>{{$data->invoice_date}}</td>
                                    <td>{{$data->supplier_id}}</td>
                                    <td>{{$data->supplier_id}}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                        <td>
                                          @if($data->send_status == 1)
                                          <a class="mdi mdi-check-circle text-success" style="font-size:20px;"></a>
                                          @else
                                            <a class="btn btn-danger sendInvoice" data-id="{{$data->invoice_number}}">Send</a>
                                          @endif
                                        </td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                        <!-- <a class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Compare Quotation</a> -->
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
