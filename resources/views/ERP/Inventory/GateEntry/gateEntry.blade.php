@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Stock Replenishment & Allocation Management
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Stock Replenishment & Allocation <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Gate Entry Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <!-- <input type="search" name="search" id="search" placeholder="Search" class="p-2"> -->
                        <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>  
                         <!-- </div> -->
                         <a style="font-size:30px;float:right;margin-right:10px;" class="mdi mdi-filter"></a>

<div class="search-container" style="float:right;">
  <input type="search" name="search" id="search" placeholder="Search" class="p-2">
  <i class="mdi mdi-magnify"></i>
</div>
<!-- <button class="btn-primary p-2" style="float:right;margin-right:10px;border:0px;" data-bs-toggle="modal" data-bs-target="#bulk_upload_modal">Bulk Upload</button> -->

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
                            <th rowspan="2">S. Number</th>
                                <th rowspan="2">DNN</th>
                                <th rowspan="1" colspan="2">Invoice</th>
                                <th rowspan="1" colspan="2">Delivery</th>
                                <th  rowspan="1" colspan="2">Supplier</th>
                                <th colspan="2">Driver</th>
                                <th colspan="2">Order</th>
                                <th colspan="2">Item</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <!-- <th>DNN</th> -->
                              <th colspan="1">Number</th>
                              <th colspan="1">Date</th>
                              <th colspan="1"> Date</th>
                              <th colspan="1"> Time</th>
                              <th colspan="1">Identity</th>
                              <th colspan="1"> Name</th>
                              <th>Name</th>
                              <th>Contect</th>
                              <th>PO Number</th>
                              <th>Order Date</th>
                              <th>Item ID</th>
                              <th>Item Name/Description</th>
                            </tr>

                            @php($i=1)
                            @foreach($details as $data)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$data->dnn}}</td>
                                <td>{{$data->invoice_number}}</td>
                                <td>{{$data->invoice_date}}</td>
                                <td>{{$data->delivery_date}}</td>
                                <td>{{$data->delivery_time}}</td>
                                <td>{{$data->supplier}}</td>
                                <td>{{$data->supplier_name}}</td>
                                <td>{{$data->driver_name}}</td>
                                <td>{{$data->driver_contact}}</td>
                                <td>{{$data->po_number}}</td>
                                <td>{{$data->order_date}}</td>
                                <td>{{$data->item_id}}</td>
                                <td>{{$data->item_name}}</td>
                                <td>
                                    <a class="btn btn-primary">Edit</a>
                                    <a class="btn btn-danger">Delete</a>
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
        <div class="modal fade" id="vehiclesBarcodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color:white;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Barode</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <center>
                        <!-- QR Code image will be loaded here -->
                        <td><img id="barcodeImageUrl" style="border-radius:0px;max-width:400px;height:100px;" src="" alt="Barcode"></td>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal -->
         <div class="modal fade" id="VehiclesIdendificationDoc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color:white;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Barode</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <center>
                        <!-- QR Code image will be loaded here -->
                        <td><img id="document" src="" alt="Doc"></td>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal -->
         <div class="modal fade" id="VehiclesImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color:white;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Vehicle Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <center>
                        <!-- QR Code image will be loaded here -->
                        <td><img id="vehicleImageUrl" style="border-radius:0px;" src="" alt="PartImage"></td>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


         <!-- Modal -->
         <div class="modal fade" id="vehiclesQrcodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color:white;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">QR Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <center>
                        <!-- QR Code image will be loaded here -->
                        <img id="qrcodeImage" style="border-radius: 0px;width:300px;object-fit:contain;" src="" alt="QR Code">
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Message Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Message content goes here -->
        <p class="text-success">Generated successfully</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- Additional buttons or actions can go here -->
      </div>
    </div>
  </div>
</div>


          
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSupplierModalLabel">Gate Entry</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Supplier Form -->
                <form method="POST" action="{{ route('gateentry.store') }}" class="row" enctype="multipart/form-data" id="gateEntryForm">
                        @csrf

                        <!-- <div class="col-12">
                            <hr>
                            <h4>Item Detail's :</h4>
                            <hr>
                            <input type="hidden" name="qrcode" id="qrcode">
                            <input type="hidden" name="barcode" id="barcode">
                        </div> -->

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="dnn" class="form-label">{{ __('DN Number') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="dnn" class="form-control" name="dnn" placeholder="A unique identifier for each Delivery" required>
                        </div>
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="delivery_date" class="form-label">{{ __('Delivery Date') }}<sup class="text-danger">*</sup></label>
                            <input type="date" id="delivery_date" value="{{date('Y-m-d')}}" class="form-control" name="delivery_date" placeholder="The Date when the order is delivered" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="delivery_time" class="form-label">{{ __('Delivery Time') }}<sup class="text-danger">*</sup></label>
                            <input type="time" id="delivery_time" name="delivery_time" value="{{date('H:i', strtotime('+5 hours 30 minutes'))}}" class="form-control">                        </div>
                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="supplier" class="form-label">{{ __('Supplier') }}<sup class="text-danger">*</sup></label>
                            <input list="supplier_lists" id="supplier" class="form-control" name="supplier" placeholder="The Order number or PO Number" required>
                            <datalist id="supplier_lists"> 
                                <!-- Add more options as needed -->
                                @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->supplier_id}}">{{$supplier->supplier_name}}</option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="vehicle_number" class="form-label">{{ __('Vehicle Number') }}<sup class="text-danger">*</sup></label>
                            <input id="vehicle_number" type="text" class="form-control" name="vehicle_number" placeholder="Vehicle Number through which the order is delivered" required>
                        </div>



                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="driver_name" class="form-label">{{ __('Driver Name') }}<sup class="text-danger">*</sup></label>
                            <input id="driver_name" type="text" class="form-control" name="driver_name" placeholder="Name of the driver who delivers the order" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="driver_contact" class="form-label">{{ __('Driver Contact') }}<sup class="text-danger">*</sup></label>
                            <input id="driver_contact" type="text" class="form-control" name="driver_contact" placeholder="Phone Number of the driverr" required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="invoice_number" class="form-label">{{ __('Invoice Number') }}<sup class="text-danger">*</sup></label>
                            <input id="invoice_number" type="text" class="form-control" name="invoice_number" placeholder="Invoice umer related with the the order" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="invoice_date" class="form-label">{{ __('Invoice date') }}<sup class="text-danger">*</sup></label>
                            <input id="invoice_date" type="date" class="form-control" name="invoice_date" placeholder="Date when the invoice generated" required>
                        </div>



                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="po_number" class="form-label">{{ __('PO Number') }}<sup class="text-danger">*</sup></label>
                            <input list="po_number_lists" id="po_number" class="form-control" name="po_number" placeholder="The Order number or PO Number" required>
                            <datalist id="po_number_lists">
                                <!-- Add more options as needed -->
                                @foreach ($pos as $po)
                                <option value="{{$po->po_id}}">
                                @endforeach
                            </datalist>
                        </div>
                        

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="order_date" class="form-label">{{ __('Order Date') }}<sup class="text-danger">*</sup></label>
                            <input id="order_date" type="date" class="form-control" name="order_date" placeholder="Date when the order is created" required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="item_id" class="form-label">{{ __('Item ID') }}<sup class="text-danger">*</sup></label>
                            <input id="item_id" type="text" class="form-control" name="item_id" placeholder="Item ID">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="item_name" class="form-label">{{ __('Item Name/Description') }}<sup class="text-danger">*</sup></label>
                            <input id="item_name" type="text" class="form-control" name="item_name" placeholder="Item ID">
                        </div>

                        <div class="form-group col-md-12">
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
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Generated Orders</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body  mx-auto">

                  
                      <form method="GET" action="" id="edit_supplier_form">
                      <table class="table table-hover table-bordered mt-2">
                        <tr>
                            <th></td>
                            <th>S No.</th>
                            <th>Supplier Name</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Phone nUmber</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Postal Code</th>
                            <th>Account Number</th>
                            <th>Tax Id</th>
                            <th>Payment Terms</th>
                            <th>Lead Time</th>
                            <th>Notes</th>
                            <!-- <th>Action</th> -->
                        </tr>
                           
                        </table>
                        <div class="form-group mt-2">
                          <!-- <button type="submit" class="btn btn-success">Check one to edit</button> -->
                           <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                            Check one to edit
                            </button>  
                          <button type="button" class="btn btn-secondary">Close</button>
                        </div>
                        </form>
                      </div>
                      
                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                      <!-- </div> -->
                    </div>
                  </div>
                </div>

          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
