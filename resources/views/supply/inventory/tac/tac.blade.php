@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Inventory Tracking and Control Management
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Inventory Tracking and Control <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Inventory Tracking and Control Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
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
                                <th>S No.</th>
                                <th>Inventory ID</th>
                                <th>Item Code</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Quantity On Hand</th>
                                <th>Minumum Stock Level</th>
                                <th>Maximum Stock Level</th>
                                <th>Reorder Point</th>
                                <th>Unit Cost</th>
                                <th>Total Cost</th>
                                <th>Supplier</th>
                                <th>Last Recieved Date</th>
                                <th>Last Updated Date</th>
                                <th>Serial Number</th>
                                <th>QR Code</th>
                                <th>Barcode</th>
                                <th>Condition</th>
                                <th>Expiration Date</th>
                                <th>Quality Control Detail's</th>
                                <th>Availability</th>
                                <th>Action</th>
                            </tr>
                            @php($i = 1)
                            @foreach($trackings as $tracking)
                            @for($a=0;$a<=4;$a++)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$tracking->inventory_id}}</td>
                                <td>{{$tracking->item_code}}</td>
                                <td>{{$tracking->description}}</td>
                                <td>{{$tracking->category}}</td>
                                <td>{{$tracking->location}}</td>
                                <td>{{$tracking->qty_on_hand}}</td>
                                <td>{{$tracking->min_stock_level}}</td>
                                <td>{{$tracking->max_stock_level}}</td>
                                <td>{{$tracking->reorder_point}}</td>
                                <td>{{$tracking->unit_cost}}</td>
                                <td>{{$tracking->total_cost}}</td>
                                <td>{{$tracking->supplier}}</td>
                                <td>{{$tracking->received_date}}</td>
                                <td>{{$tracking->updated_date}}</td>
                                <td>{{$tracking->serial_number}}</td>
                                @if($tracking->qrcode)
                                <!-- <td>{{$tracking->qrcode}}</td> -->
                                <td><a class="mdi mdi-eye btn btn-primary" data-bs-target="#vehiclesQrcodeModal" data-bs-toggle="modal" data-qrcode="{{asset('Storage/'.$tracking->barcode)}}"></a></td>
                                @else
                                <td></td>
                                @endif
                                @if($tracking->barcode)
                                <!-- <td>{{$tracking->barcode}}</td> -->
                                <td><a class="mdi mdi-eye btn btn-primary" data-bs-target="#vehiclesBarcodeModal" data-bs-toggle="modal" data-barcode="{{asset('Storage/'.$tracking->qrcode)}}"></a></td>
                                @else
                                <td></td>
                                @endif
                                <td>{{$tracking->condition}}</td>
                                <td>{{$tracking->expiry_date}}</td>
                                <td>{{$tracking->quality_control_detail}}</td>
                                <td>{{$tracking->availability}}</td>
                                @php($encryptedId = encrypt($tracking->id)) 
                                <td>
                                <a href="{{url('delete-tac/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
                <form method="POST" action="{{ route('tac.store') }}" class="row" enctype="multipart/form-data" id="TACForm">
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
                            <input type="text" id="inventory_id" class="form-control" name="inventory_id" value="INVID_{{rand(0,999999)}}" placeholder="A unique identifier for each inventory item." required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="part_number" class="form-label">{{ __('Item Code') }}<sup class="text-danger">*</sup></label>
                            <input list="part_number_list" id="part_number" class="form-control" name="part_number" placeholder="Part number will be auto generated by the system" required>
                            <datalist id="part_number_list">
                                @foreach($parts as $part)
                                    <option value="{{$part->part_number}}">
                                @endforeach
                                <!-- Add more options as needed -->
                            </datalist>
                        </div>

                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="serial_number" class="form-label">{{ __('Serial Number') }}<sup class="text-danger">*</sup></label>
                            <input id="serial_number" type="text" class="form-control" name="serial_number" placeholder="For serialized parts, a unique serial number assigned to each unit." required>
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
                            <label for="received_date" class="form-label">{{ __('Last Received Date') }}<sup class="text-danger">*</sup></label>
                            <input id="received_date" type="date" class="form-control" name="received_date" placeholder="The Last date of receiving part or item" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="updated_date" class="form-label">{{ __('Last Updated Date') }}<sup class="text-danger">*</sup></label>
                            <input id="updated_date" type="date" class="form-control" name="updated_date" placeholder="The Last date when part or item detail's updated" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="reorder_point" class="form-label">{{ __('Reorder Point') }}<sup class="text-danger">*</sup></label>
                            <input id="reorder_point" type="text" class="form-control" name="reorder_point" placeholder="Mention the reorder point of the part or item" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="expiry_date" class="form-label">{{ __('Expiry Date') }}<sup class="text-danger">*</sup></label>
                            <input id="expiry_date" type="date" class="form-control" name="expiry_date" placeholder="Mention the expirt date of the part or item" required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="condition" class="form-label">{{ __('Condition') }}<sup class="text-danger">*</sup></label>
                            <select id="condition" class="form-control p-3" name="condition" required autofocus>
                                <option value="">--Select The condition or status of the part (e.g., new, used, refurbished).--</option> 
                                <option value="New">New</option>
                                <option value="Used">Used</option>
                                <option value="Refurbished">Refurbished</option>
                                
                            </select>
                        </div>


                        <!-- <div class="mb-3 col-md-6 col-lg-3">
                            <label for="reorder_point" class="form-label">{{ __('Reorder Point') }}</label>
                            <input id="reorder_point" type="text" class="form-control" name="reorder_point" placeholder="The minimum quantity of the part that triggers a reorder." required>
                        </div> -->


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="unit_cost" class="form-label">{{ __('Unit Cost') }}<sup class="text-danger">*</sup></label>
                            <input id="unit_cost" type="text" class="form-control" name="unit_cost" placeholder="The cost of purchasing one unit of the part." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="total_cost" class="form-label">{{ __('Total Cost') }}<sup class="text-danger">*</sup></label>
                            <input id="total_cost" type="text" class="form-control" name="total_cost" placeholder="The cost of purchasing overall unit of the part." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="qty_on_hand" class="form-label">{{ __('Quantity On Hand') }}<sup class="text-danger">*</sup></label>
                            <input id="qty_on_hand" type="text" class="form-control" name="qty_on_hand" placeholder="The current quantity of the part available in inventory." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="availability" class="form-label">{{ __('Availability') }}<sup class="text-danger">*</sup></label>
                            <input id="availability" type="text" class="form-control" name="availability" placeholder="Information about the availability of the inventory item for sale or use, including current stock levels and allocations." required>
                        </div>

                        
                        <!-- <div class="mb-3 col-md-6 col-lg-3">
                            <label for="category" class="form-label">{{ __('Category') }}</label>
                            <select id="category" class="form-control p-3" name="category" placeholder="The category or classification of the part (e.g., engine parts, body parts, electrical components)." required autofocus>
                                <option value="">--Selecty Category--</option> 
                                <option value="engine_parts">Engine Parts</option>
                                <option value="body_parts">Body Parts</option>
                                <option value="electrical_components">Electrical Components</option>
                                <option value="suspension_systems">Suspension Systems</option>
                                <option value="braking_systems">Braking Systems</option>
                                <option value="transmission_parts">Transmission Parts</option>
                                <option value="interior_accessories">Interior Accessories</option>
                                <option value="exterior_accessories">Exterior Accessories</option>
                            </select>
                        </div> -->


                        <!-- <div class="mb-3 col-md-6 col-lg-3">
                            <label for="manufacturer" class="form-label">{{ __('Manufacturer') }}</label>
                            <input type="text" id="manufacturer" class="form-control" name="manufacturer" placeholder="The manufacturer or brand of the part." required>
                        </div> -->


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="min_stock_level" class="form-label">{{ __('Minimum Stock Level') }}<sup class="text-danger">*</sup></label>
                            <input id="min_stock_level" type="text" class="form-control" name="min_stock_level" placeholder="The minimum stock level for the part to ensure availability." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="max_stock_level" class="form-label">{{ __('Maximum Stock Level') }}<sup class="text-danger">*</sup></label>
                            <input id="max_stock_level" type="text" class="form-control" name="max_stock_level" placeholder="The maximum stock level for the part to ensure availability." required>
                        </div>



                        <div class="col-12">
                        <hr>
                        <h4>Breif Detail's :</h4>
                        <hr>
                        </div>
                        
                        <div class="mb-3 col-md-6">
                            <label for="part_description" class="form-label">{{ __('Part Description') }}</label>
                            <textarea id="part_description" rows="4" cols="50" type="text" class="form-control" name="part_description" placeholder="A brief description of the part, including its name, type, and specifications."></textarea>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="quality_control_details" class="form-label">{{ __('Quality Control Details') }}</label>
                            <textarea id="quality_control_details" rows="4" cols="50" type="text" class="form-control" name="quality_control_details" placeholder="A brief description of the quality control of the part and item."></textarea>
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
