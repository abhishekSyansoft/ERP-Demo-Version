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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Scrap Item Lists</h4></h4>
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
                            <th>S. Number</th>
                            <th>Inventory ID</th>
                            <th>Scrap Item From</th>
                            <th>Item Code</th>
                            <th>For Vehicle</th>
                           
                            <th>Warehouse Location</th>
                            <th>Scrap Quantity</th>
                            <th>DN Number</th>
                            <th>GRN Number</th>
                            <th>Action</th>
                        </tr>
                        @php($i=1)
                        @foreach($scrapItems as $data)
                     
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data->inventory_id}}</td>
                            <td>{{$data->scraptype}}</td>
                            <td>{{$data->part_number}}</td>
                            <td>{{$data->vehicle}}</td>
                            <td>{{$data->location}}</td>
                            <td>{{number_format($data->scrap_quantity)}} pcs.</td>
                            <td>{{$data->dnn}}</td>
                            <td>{{$data->grn}}</td>
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
                <form method="POST" action="{{ route('scrap.store') }}" class="row" enctype="multipart/form-data" id="TACForm">
                        @csrf

                        <div class="col-12">
                            <hr>
                            <h4>Item Detail's :</h4>
                            <hr>
                           
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_id" class="form-label">{{ __('Inventory ID') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="inventory_id" class="form-control" name="inventory_id" placeholder="A unique identifier for each inventory item" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="scraptype" class="form-label">{{ __('Scrap Item From') }}<sup class="text-danger">*</sup></label>
                            <select type="text" id="scraptype" class="form-control p-3" name="scraptype" required>
                                <option value="">--Select--</option>
                                <option value="From Inventory">From Inventory</option>
                                <option value="From Received Order">From Received Order</option>
                            </select>
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
                            <label for="scrap_quantity" class="form-label">{{ __('Scrap Quantity') }}(.pcs)<sup class="text-danger">*</sup></label>
                            <input id="scrap_quantity" type="text" class="form-control" name="scrap_quantity" placeholder="Scrap Quantity" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3" id="dnn_number">
                            <label for="dnn" class="form-label">{{ __('DNN Number') }}<sup class="text-danger">*</sup></label>
                            <input id="dnn" type="text" class="form-control" name="dnn" placeholder=" Enter DNN Number">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3" id="grn_number">
                            <label for="grn" class="form-label">{{ __('GRN Number') }}<sup class="text-danger">*</sup></label>
                            <input id="grn" type="text" class="form-control" name="grn" placeholder=" Enter GRN Number">
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
