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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">{{ Auth::user()->admin == 3 ? 'Stock Replenishment & Allocation Lists' : 'Inventory Control' }}</h4></h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <!-- <input type="search" name="search" id="search" placeholder="Search" class="p-2"> -->
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
                                <th rowspan="2">Inventory Section</th>
                                <th colspan="2">Item</th>
                                <th rowspan="2">Category</th>
                                <th rowspan="2">Product</th>
                                <th rowspan="2">Supplier</th>
                                <th colspan="3">Stock Description</th>
                                <th rowspan="2">Reorder Point</th>
                                <th rowspan="2">Lead Time</th>
                                <th rowspan="2">Last Replenishment Date</th>
                                <th rowspan="2">View Report</th>
                                <th colspan="2">Forecasting</th>
                                <th rowspan="2">Sales Channels</th>
                                <th colspan="3">Allocation</th>
                                <th rowspan="2">Shelf/Bin Number</th>
                                <th rowspan="2">Safety Stock</th>
                                <th rowspan="2">Order Quantity</th>
                                <th rowspan="2">Availability</th>
                                <!-- <th rowspan="2">QR Code</th>
                                <th rowspan="2">Barcode</th> -->
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <th>Code</th>
                              <th>Description</th>
                              <th>Current Level</th>
                              <th>Minimum Level</th>
                              <th>Maximum Level</th>
                              <th>Demand Forecast</th>
                              <th>Required Stock</th>
                              <th>Quantity</th>
                              <th>Date</th>
                              <th>Location</th>
                            </tr>
                            @php($i = 1)
                            @foreach($allocations as $allocation)
                          
                              <tr>
                                <td>{{$i++}}</td>
                                <td>{{$allocation->inventory_id}}</td>
                                <td>{{$allocation->item_code}}</td>
                                <td>{{$allocation->item_name}}</td>
                                <td>Vehicle</td>
                                <td>{{$allocation->category}}</td>
                                <td>{{$allocation->supplier}}</td>
                                <td>{{$allocation->current_stock_level}}pcs.</td>
                                <td>{{$allocation->min_stock_level}}pcs.</td>
                                <td>{{$allocation->max_stock_level}}pcs.</td>
                                <td>{{$allocation->reorder_point}}pcs.</td>
                                <td>{{$allocation->lead_time}}</td>
                                <td>{{$allocation->last_replenishment_date}}</td>
                                <td><a class="mdi mdi-eye btn btn-primary" data-bs-target="#viewReport" data-bs-toggle="modal"></a></td>
                                <td>{{$allocation->demand_forecast}}pcs.</td>
                                <td>{{$allocation->demand_forecast - $allocation->current_stock_level}}pcs.</td>
                                <td>{{$allocation->sales_channels}}</td>
                                <td>{{$allocation->allocation_qty}}pcs.</td>
                                <td>{{$allocation->alloation_date}}</td>
                                <td>{{$allocation->location}}</td>
                                <td>{{$allocation->demand_variability}}</td>
                                <td>{{$allocation->safety_stock}}pcs.</td>
                                <td>{{$allocation->order_qty}}pcs.</td>
                                <td>{{$allocation->availability}}</td>
                                <!-- <td><a class="btn btn-primary creatQRForInv" data-id="{{$allocation->inventory_id}}">Create QR Code</a></td>
                                <td><a class="btn btn-primary createBarcodeInv" data-id="{{$allocation->inventory_id}}">Create Barode</a></td> -->
                                <!-- <td>{{$allocation->qr_code}}</td>
                                <td>{{$allocation->barcode}}</td> -->
                                @php($encryptedId = encrypt($allocation->id))
                               
                               <td>
                                   <a href="{{url('edit-sra/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                   <a href="{{url('delete-sra/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <div class="modal fade" id="viewReport" tabindex="-1" aria-labelledby="viewReportLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color:white;">
                    <div class="modal-header">
                        <h5 class="modal-title btn btn-primary" id="downloadForecastReport"><a href="{{asset('Storage/images/Reports/Inventory_Forecasting_Template.xlsx')}}" style="text-decoration:none; color:white;">Export Reports</a></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <center>
                        <!-- QR Code image will be loaded here -->
                        <td><img id="barcodeImageUrl" src="https://docs.aligni.com/wp-content/uploads/2022/08/InventoryForecastChart@2x.png" style="width:100%;height:100%;object-fit:contain;" alt="Barcode"></td>
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
                <form method="POST" action="{{ route('sra.store') }}" class="row" enctype="multipart/form-data" id="TACForm">
                        @csrf

                        <div class="col-12">
                            <hr>
                            <h4>Item Detail's :</h4>
                            <hr>
                            <input type="hidden" name="qrcode" id="qrcode">
                            <input type="hidden" name="barcode" id="barcode">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_id" class="form-label">{{ __('Inventory ID') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="inventory_id" class="form-control" name="inventory_id" value="INVID_{{rand(0,999999)}}" placeholder="A unique identifier for each inventory item" required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="part_number" class="form-label">{{ __('Item Code') }}<sup class="text-danger">*</sup></label>
                            <input list="part_number_list" id="part_number" class="form-control" name="part_number" placeholder="The part number or identifier assigned to each inventory item." required>
                            <datalist id="part_number_list">
                                @foreach($parts as $part)
                                    <option value="{{$part->part_number}}">
                                @endforeach
                                <!-- Add more options as needed -->
                            </datalist>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                        <label for="vehicle" class="form-label">{{ __('Product') }}<sup class="text-danger">*</sup></label>
                        <select id="vehicle" class="form-control p-3" name="vehicle" placeholder="" required autofocus>
                            <option value="">--Select Vehicle--</option>
                            <option value="pulsar">Pulsar</option>
                            <option value="discover">Discover</option>
                            <option value="platina">Platina</option>
                            <option value="avenger">Avenger</option>
                            <option value="dominar">Dominar</option>
                            <option value="ct_100">CT 100</option>
                            <option value="kratos">Kratos</option>
                            <!-- Add more Bajaj bike types as needed -->
                        </select>
                        </div>
                        

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="location" class="form-label">{{ __('Location') }}<sup class="text-danger">*</sup></label>
                            <input id="location" type="text" class="form-control" name="location" placeholder="The physical location within the warehouse or storage facility where the part is stored." required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="current_stock_level" class="form-label">{{ __('Current Stock Level') }}<sup class="text-danger">*</sup></label>
                            <input id="current_stock_level" type="text" class="form-control" name="current_stock_level" placeholder="The current quantity of the inventory item available in stock." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="min_stock_level" class="form-label">{{ __('Minimum Stock Level') }}<sup class="text-danger">*</sup></label>
                            <input id="min_stock_level" type="text" class="form-control" name="min_stock_level" placeholder="The minimum stock level for the part to ensure availability." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="max_stock_level" class="form-label">{{ __('Maximum Stock Level') }}<sup class="text-danger">*</sup></label>
                            <input id="max_stock_level" type="text" class="form-control" name="max_stock_level" placeholder="The maximum stock level for the part to ensure availability." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="reorder_point" class="form-label">{{ __('Reorder Point') }}<sup class="text-danger">*</sup></label>
                            <input id="reorder_point" type="text" class="form-control" name="reorder_point" placeholder="The inventory level at which a reorder of the item should be triggered." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="lead_time" class="form-label">{{ __('Lead Time') }}<sup class="text-danger">*</sup></label>
                            <input id="lead_time" type="text" class="form-control" name="lead_time" placeholder="The lead time or delivery time for replenishing the inventory item from the supplier." required>
                        </div>
                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="last_replenishment_date" class="form-label">{{ __('Last Replenishment date') }}<sup class="text-danger">*</sup></label>
                            <input id="last_replenishment_date" type="date" class="form-control" name="last_replenishment_date" placeholder="The date when the inventory item was last replenished." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="demand_forecast" class="form-label">{{ __('Demand Forecast') }}<sup class="text-danger">*</sup></label>
                            <input id="demand_forecast" type="text" class="form-control" name="demand_forecast" placeholder="Forecasted demand for the inventory item over a specific period." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="sales_channels" class="form-label">{{ __('Sales Channels') }}<sup class="text-danger">*</sup></label>
                            <input id="sales_channels" type="text" class="form-control" name="sales_channels" placeholder="The sales channel or distribution channel through which the inventory item is sold (e.g., retail stores, online marketplace)." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="allocation_qty" class="form-label">{{ __('Allocation Quantity') }}<sup class="text-danger">*</sup></label>
                            <input id="allocation_qty" type="text" class="form-control" name="allocation_qty" placeholder="The quantity of the inventory item allocated to a specific sales channel, location, or order." required>
                        </div>
                        

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="allocation_date" class="form-label">{{ __('Allocation Date') }}<sup class="text-danger">*</sup></label>
                            <input id="allocation_date" type="date" class="form-control" name="allocation_date" placeholder="The maximum stock level for the part to ensure availability." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="location" class="form-label">{{ __('Location') }}<sup class="text-danger">*</sup></label>
                            <input id="location" type="text" class="form-control" name="location" placeholder="The physical location within the warehouse or storage facility where the inventory item is stored." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="demand_variability" class="form-label">{{ __('Shelf/Bin Number') }}<sup class="text-danger">*</sup></label>
                            <input id="demand_variability" type="text" class="form-control" name="demand_variability" placeholder="Variability in demand for the inventory item, based on factors such as seasonality, promotions, and market trends." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="safety_stock" class="form-label">{{ __('Safety Stock') }}<sup class="text-danger">*</sup></label>
                            <input id="safety_stock" type="text" class="form-control" name="safety_stock" placeholder="Additional stock held as a buffer to mitigate the risk of stockouts due to demand variability or lead time variability." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="order_qty" class="form-label">{{ __('Order Quantity') }}<sup class="text-danger">*</sup></label>
                            <input id="order_qty" type="text" class="form-control" name="order_qty" placeholder="The quantity of the inventory item to be ordered for replenishment, calculated based on factors such as demand forecast, lead time, and safety stock." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="availability" class="form-label">{{ __('Availability') }}<sup class="text-danger">*</sup></label>
                            <input id="availability" type="text" class="form-control" name="availability" placeholder="Information about the availability of the inventory item for sale or use, including current stock levels and allocations." required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="part_description" class="form-label">{{ __('Part Description') }}</label>
                            <textarea id="part_description" rows="4" cols="50" type="text" class="form-control" name="part_description" placeholder=": A description of the inventory item, including its name, type, and specifications."></textarea>
                        </div>

                  


                        <div class="col-12">
                        <hr>
                        <h4>Supplier Detail's :</h4>
                        <hr>
                        </div>
                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="supplier_id" class="form-label">{{ __('Supplier') }}<sup class="text-danger">*</sup></label>
                            <select id="supplier_id" class="form-control p-3" name="supplier_id" placeholder="The category or classification of the part (e.g., engine parts, body parts, electrical components)." required autofocus>
                                <option value="">--Select Supplier--</option> 
                                <option value="Abhishek">Abhishek</option>
                                <option value="Priyanka">Priyanka</option>
                                <option value="Kalpana">Kalpana</option>
                                <option value="Arush">Arush</option>
                            </select>
                        </div>

                        <div class="col-12"><hr></div>


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
