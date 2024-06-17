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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Sales And Orders</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <!-- <input style="float:right;" type="search" name="search" id="search" placeholder="Search" class="p-2"> -->
                        <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>  
                        <a style="font-size:30px;float:right;margin-right:10px;" class="mdi mdi-filter"></a>
                        <div class="search-container" style="float:right;">
                        <input type="search" name="search" id="search" placeholder="Search" class="p-2">
                        <i class="mdi mdi-magnify"></i>
                        </div>
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
                                <th rowspan="2">S No.</th>
                                <th colspan="2">Order</th>
                                <th colspan="3">Customer</th>
                                <th colspan="4">Address</th>
                                <th rowspan="2">ItemLists</th>
                                <th rowspan="2">Total Item</th>
                                <th rowspan="2">Total Quantity</th>
                                <th rowspan="2">Tax rate</th>
                                <th rowspan="2">Tax Amount</th>
                                <th rowspan="2">Line Amount Total</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <th>Numeber</th>
                              <th>Order date</th>
                              <th>Name</th>
                              <th>Phone Number</th>
                              <th>Email</th>
                              <th>Street Address</th>
                              <th>City</th>
                              <th>State</th>
                              <th>Pincode</th>
                            </tr>
                            @php($i = 1)
                            @foreach($orders as $order)
                            @for($a=0;$a<5;$a++)
                            <td>{{$i++}}</td>
                            <td>{{$order->order_id}}</td>
                            <td>{{$order->order_date}}</td>
                            <td>{{$order->customer_name}}</td>
                            <td>{{$order->customer_phone}}</td>
                            <td>{{$order->customer_email}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->city}}</td>
                            <td>{{$order->state}}</td>
                            <td>{{$order->pincode}}</td>
                            <td><a class="btn btn-primary itemListsBTNSales" data-id="{{$order->order_id}}"><i class="mdi mdi-eye"></i></a></td>
                            <td>{{$order->total_item}}</td>
                            <td>{{$order->total_qty}}pcs.</td>
                            <td>{{$order->tax_rate}}%</td>
                            <td>RS.{{number_format($order->tax_amt)}}</td>
                            <td>RS.{{number_format($order->total_amt)}}</td>
                            
                                @php($encryptedId = encrypt($order->id))
                               
                               <td>
                                   <a href="{{url('edit-sra/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                   <a href="{{url('delete-sra/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                               </td>
                              </tr>
                              @endfor
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add new</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Supplier Form -->
        <form method="POST" class="row" id="createSalesform">
                        @csrf
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="order_no" class="form-label">{{ __('Order Number') }}</label>
                            <input type="text" name="order_no" id="order_no" class="form-control" placeholder="Purchase order number" value="{{'PO_'.uniqid()}}">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="order_date" class="form-label">{{ __('Order Date') }}</label>
                            <input type="date" id="order_date" class="form-control" name="order_date" value="{{ date('Y-m-d') }}" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3">
                          <hr>
                          <h4>Customer Information</h4>
                          <hr>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="customer_name" class="form-label">{{ __('Customer Name') }}</label>
                            <input type="text" id="customer_name" class="form-control" name="customer_name" placeholder="Name of the customer" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="customer_phone" class="form-label">{{ __('Phone Number') }}</label>
                            <input type="text" id="customer_phone" class="form-control" name="customer_phone" placeholder="Phone Number Of the customer" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="customer_email" class="form-label">{{ __('Customer Email') }}</label>
                            <input type="email" id="customer_email" class="form-control" name="customer_email" placeholder="Email Of the customer" required>
                        </div>


                        <div class="mb-3">
                          <hr>
                          <h4>Address</h4>
                          <hr>
                        </div>


                        <div class="mb-3 col-md-12 row mx-auto p-0">
                          <!-- <h4>Delivery Address : </h4> -->
                            <div class="form-group col-md-3">
                              <label for="address" class="form-label">{{ __('Address') }}</label>
                              <input type="text" id="address" class="form-control" name="address" placeholder="A brief address detail where to be delivered" required>
                            </div>

                            <div class="form-group col-md-3">
                              <label for="city" class="form-label">{{ __('City') }}</label>
                              <input type="text" id="city" class="form-control" name="city" placeholder="City name where the order needed to be delivered" required>
                            </div>

                            <div class="form-group col-md-3">
                              <label for="state" class="form-label">{{ __('State') }}</label>
                              <input type="text" id="state" class="form-control" name="state" placeholder="State name where the order needed to be delivered" required>
                            </div>

                            <div class="form-group col-md-3">
                              <label for="pincode" class="form-label">{{ __('Pincode') }}</label>
                              <input type="text" id="pincode" class="form-control" name="pincode" placeholder="Pincode where the order needed to be delivered" required>
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
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Item Lists</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body  mx-auto">

                      <div class="table-wrapper" Style="height:auto;">
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

          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
