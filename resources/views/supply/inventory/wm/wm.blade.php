@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Warehouse management
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Warehouse management<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Warehouses Lists</h4>
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
                        <table class="table table-bordered border-primary"style="width: 100%;">
                            <tr>
                                <th rowspan="2">S No.</th>
                                <th rowspan="2">Warehouse ID</th>
                                <th rowspan="2">Warehouse Name</th>
                                <th rowspan="1" colspan="4">Location</th>
                                <th rowspan="2">Warehouse Manager</th>
                                <th rowspan="2">Capacity</th>
                                <th rowspan="2">Vacant Capacity</th>
                                <th rowspan="2">Bin/Shelf Number</th>
                                <th rowspan="1" colspan="3">Inventory</th>
                                <th rowspan="2">Picking and Packing</th>
                                <th rowspan="2">Loading and Unloading</th>
                                <th rowspan="2">Safety and Security</th>
                                <th rowspan="2">Maintenance Shedule</th>
                                <th rowspan="2">Temprature and Climate Control</th>
                                <th rowspan="2">Emergency Procedures</th>
                                <th rowspan="2">Inventory Audits</th>
                                <th rowspan="2">Integration with IMS</th>
                                <th rowspan="2">Documentations and Records</th>
                                <th rowspan="2">Inventory Layout</th>
                                <th rowspan="2">QRCode</th>
                                <th rowspan="2">Barcode</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <th>Address</th>
                              <th>City</th>
                              <th>State</th>
                              <th>Pincode</th>
                              <th>Allocation</th>
                              <th>Movement</th>
                              <th>Levels</th>
                            </tr>
                            @php($i=1)
                            @foreach($warehouses as $data)
                            @for($a=0;$a<5;$a++)
                           
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->warehouse_id}}</td>
                                    <td>{{$data->warehouse_name}}</td>
                                    <td>{{$data->address}}</td>
                                    <td>{{$data->city}}</td>
                                    <td>{{$data->state}}</td>
                                    <td>{{$data->pincode}}</td>
                                    <td>{{$data->warehouse_manager}}</td>
                                    <td>{{$data->capacity}}pcs.</td>
                                    <td>{{$data->storage_zone}}pcs.</td>
                                    <td>{{$data->shelf_number}}</td>
                                    <td>{{$data->inventory_allocation}}</td>
                                    <td>{{$data->inventory_movement}}</td>
                                    <td>{{$data->inventory_levels}}</td>
                                    <td>{{$data->picking_and_packing}}</td>
                                    <td>{{$data->loading_and_unloading}}</td>
                                    <td>{{$data->safety_and_security}}</td>
                                    <td>{{$data->maintenance_and_sheduling}}</td>
                                    <td>{{$data->temprature_and_climate_control}}</td>
                                    <td>{{$data->emergency_procedures}}</td>
                                    <td>{{$data->inventory_audits}}</td>
                                    <td>{{$data->integration_with_ims}}</td>
                                    @if($data->documents_and_records)
                                    <td><a href="{{asset('Storage/'.$data->documents_and_records)}}"><i class="mdi mdi-file" style="font-size:24px;"></i></a></td>
                                    @else
                                    <td></td>
                                    @endif
                                    @if($data->layout)
                                    <td><a href="{{asset('Storage/'.$data->layout)}}"><i class="mdi mdi-file" style="font-size:24px;"></i></a></td>
                                    @else
                                    <td></td>
                                    @endif
                                    @if($data->qrcode)
                                    <td><a class="mdi mdi-eye btn btn-primary" data-bs-target="#warehouseQrcodeModal" data-bs-toggle="modal" data-qrcode="{{ asset('Storage/' . $data->qrcode) }}"></a></td>
                                    @else
                                    <td><a class="warehouseQRCode btn btn-primary" style="text-decoration:none;" data-code-id="{{$data->id}}">Generate QRCode</a></td>
                                    @endif
                                    @if($data->barcode)
                                    <td><a class="mdi mdi-eye btn btn-primary" data-bs-target="#warehouseBarcodeModal" data-bs-toggle="modal" data-barcode="{{asset('Storage/'.$data->barcode)}}"></a></td>
                                    @else
                                    <td><a class="warehouseBarcode btn btn-primary" style="text-decoration:none;" data-barcode-id="{{$data->id}}">Generate Barcode</a></td>
                                    @endif   
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-wm/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-wm/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <div class="modal fade" id="warehouseBarcodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
         <div class="modal fade" id="warehouseQrcodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <h4 class="modal-title" id="addSupplierModalLabel">Warehouse Detail's</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('wm.store')}}" class="row" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <hr>
                              <h4>Warehouse Detail's</h4>
                            <hr>
                        </div>
                       
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="warehouse_id" class="form-label">{{ __('Warehoues ID') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="warehouse_id" class="form-control" name="warehouse_id" value="WM_{{uniqid()}}" placeholder="A unique identifier for each warehouse facility">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="warehouse_name" class="form-label">{{ __('Warehoues Name') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="warehouse_name" class="form-control" name="warehouse_name" placeholder="The name or description of the warehouse.">
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="capacity" class="form-label">{{ __('Capacity') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="capacity" class="form-control" name="capacity" placeholder="Mention Capacit of the warehouse">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="warehouse_manager" class="form-label">{{ __('Manager') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="warehouse_manager" class="form-control" name="warehouse_manager" placeholder="The name or identifier of the employee responsible for managing the warehouse.">
                        </div>


                        <div class="col-12">
                            <hr>
                              <h4>Location Detail's</h4>
                            <hr>
                        </div>


                        <div class="mb-3 row">
                            <div class="col-md-6 col-lg-3">
                              <label for="address" class="form-label">{{ __('Address') }}<sup class="text-danger">*</sup></label>
                              <input type="text" id="address" class="form-control" name="address" placeholder="Enter Street address where the ware house located">
                            </div>

                            <div class="col-md-6 col-lg-3">
                              <label for="city" class="form-label">{{ __('City') }}<sup class="text-danger">*</sup></label>
                              <select type="text" id="city" class="form-control p-3" name="city" placeholder="Enter name of city where warehouse located">
                              <optgroup label="Haryana">
                                    <option value="Gurgaon">Gurgaon</option>
                                    <option value="Faridabad">Faridabad</option>
                                    <option value="Panipat">Panipat</option>
                                    <option value="Ambala">Ambala</option>
                                    <option value="Karnal">Karnal</option>
                                </optgroup>
                                <optgroup label="Andhra Pradesh">
                                    <option value="Visakhapatnam">Visakhapatnam</option>
                                    <option value="Vijayawada">Vijayawada</option>
                                    <option value="Tirupati">Tirupati</option>
                                    <option value="Kakinada">Kakinada</option>
                                    <option value="Rajahmundry">Rajahmundry</option>
                                </optgroup>
                                <optgroup label="Arunachal Pradesh">
                                    <option value="Itanagar">Itanagar</option>
                                    <option value="Naharlagun">Naharlagun</option>
                                    <option value="Tawang">Tawang</option>
                                    <option value="Pasighat">Pasighat</option>
                                </optgroup>
                                <optgroup label="Assam">
                                    <option value="Guwahati">Guwahati</option>
                                    <option value="Silchar">Silchar</option>
                                    <option value="Dibrugarh">Dibrugarh</option>
                                    <option value="Jorhat">Jorhat</option>
                                    <option value="Tezpur">Tezpur</option>
                                </optgroup>
                                <optgroup label="Bihar">
                                    <option value="Patna">Patna</option>
                                    <option value="Gaya">Gaya</option>
                                    <option value="Muzaffarpur">Muzaffarpur</option>
                                    <option value="Bhagalpur">Bhagalpur</option>
                                    <option value="Darbhanga">Darbhanga</option>
                                </optgroup>
                                <!-- Other states and cities follow -->
                              </select>       
                            </div>

                            <div class="col-md-6 col-lg-3">
                              <label for="state" class="form-label">{{ __('State') }}<sup class="text-danger">*</sup></label>
                              <select id="state" class="form-control p-3" name="state" placeholder="Enter name of state where warehouse located">
                              <option value="Andhra Pradesh">Andhra Pradesh</option>
                                  <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                  <option value="Assam">Assam</option>
                                  <option value="Bihar">Bihar</option>
                                  <option value="Chhattisgarh">Chhattisgarh</option>
                                  <option value="Goa">Goa</option>
                                  <option value="Gujarat">Gujarat</option>
                                  <option value="Haryana">Haryana</option>
                                  <option value="Himachal Pradesh">Himachal Pradesh</option>
                                  <option value="Jharkhand">Jharkhand</option>
                                  <option value="Karnataka">Karnataka</option>
                                  <option value="Kerala">Kerala</option>
                                  <option value="Madhya Pradesh">Madhya Pradesh</option>
                                  <option value="Maharashtra">Maharashtra</option>
                                  <option value="Manipur">Manipur</option>
                                  <option value="Meghalaya">Meghalaya</option>
                                  <option value="Mizoram">Mizoram</option>
                                  <option value="Nagaland">Nagaland</option>
                                  <option value="Odisha">Odisha</option>
                                  <option value="Punjab">Punjab</option>
                                  <option value="Rajasthan">Rajasthan</option>
                                  <option value="Sikkim">Sikkim</option>
                                  <option value="Tamil Nadu">Tamil Nadu</option>
                                  <option value="Telangana">Telangana</option>
                                  <option value="Tripura">Tripura</option>
                                  <option value="Uttar Pradesh">Uttar Pradesh</option>
                                  <option value="Uttarakhand">Uttarakhand</option>
                                  <option value="West Bengal">West Bengal</option>
                              </select>
                            </div>

                            <div class="col-md-6 col-lg-3">
                              <label for="pincode" class="form-label">{{ __('Postal Code') }}<sup class="text-danger">*</sup></label>
                              <input type="text" id="pincode" class="form-control" name="pincode" placeholder="Enter postal code where warehouse located">
                            </div>
                        </div>

                        <div class="col-12">
                            <hr>
                              <h4>Other Detail's</h4>
                            <hr>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="shelf_number" class="form-label">{{ __('Shelf Number') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="shelf_number" class="form-control" name="shelf_number" placeholder="Identification numbers assigned to individual bins, shelves, or storage locations within the warehouse.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_allocation" class="form-label">{{ __('Inventory Allocation') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="inventory_allocation" class="form-control" name="inventory_allocation" placeholder="Information about the allocation of inventory to specific storage locations within the warehouse.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_movement" class="form-label">{{ __('Inventory Movement') }}</label>
                            <input type="text" id="inventory_movement" class="form-control" name="inventory_movement" placeholder="Tracking of inventory movements within the warehouse, including receipts, transfers, and shipments.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_levels" class="form-label">{{ __('Inventory Levels') }}</label>
                            <input type="text" id="inventory_levels" class="form-control" name="inventory_levels" placeholder="Real-time monitoring of inventory levels within the warehouse, including stock-on-hand and stock-out alerts.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="picking_and_packing" class="form-label">{{ __('Picking And Packing') }}</label>
                            <input type="text" id="picking_and_packing" class="form-control" name="picking_and_packing" placeholder="Details about picking and packing processes within the warehouse, including order picking methods and packing procedures.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="loading_and_unloading" class="form-label">{{ __('Loading And Unloading') }}</label>
                            <input type="text" id="loading_and_unloading" class="form-control" name="loading_and_unloading" placeholder="Procedures for loading and unloading inventory into and out of the warehouse, including equipment and personnel involved.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="safety_and_security" class="form-label">{{ __('Safety And Security') }}</label>
                            <input type="text" id="safety_and_security" class="form-control" name="safety_and_security" placeholder="Safety protocols and security measures implemented within the warehouse to ensure the safety of personnel and inventory.">
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="temprature_and_climate_control" class="form-label">{{ __('Temperature And Climate Conrol') }}<sup class="text-danger">*</sup></label>
                            <input type="number" id="temprature_and_climate_control" class="form-control" name="temprature_and_climate_control" placeholder="Schedule for routine maintenance tasks and inspections of warehouse facilities and equipment.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="emergency_procedures" class="form-label">{{ __('Emergency Procedures') }}</label>
                            <input type="text" id="emergency_procedures" class="form-control" name="emergency_procedures" placeholder="Procedures for handling emergencies such as fires, accidents, or natural disasters within the warehouse.">
                        </div>
 
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="integration_with_ims" class="form-label">{{ __('Integration with IMS') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="integration_with_ims" class="form-control" name="integration_with_ims" placeholder="Integration with inventory management systems to facilitate real-time data exchange and visibility into warehouse operations.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="storage_zone" class="form-label">{{ __('Vacant Capacity') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="storage_zone" class="form-control p-3" name="storage_zone" placeholder="The vacant capacity in warehouse">
                             
                        </div>
                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="maintenance_and_sheduling" class="form-label">{{ __('Maintenance Shedule') }}<sup class="text-danger">*</sup></label>
                            <input type="date" id="maintenance_and_sheduling" class="form-control" name="maintenance_and_sheduling" placeholder="Schedule for routine maintenance tasks and inspections of warehouse facilities and equipment.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_audits" class="form-label">{{ __('Inventory Audits') }}<sup class="text-danger">*</sup></label>
                            <input type="date" id="inventory_audits" class="form-control" name="inventory_audits" placeholder="Schedule and procedures for conducting periodic inventory audits to reconcile physical inventory counts with system records.">
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="documents_and_records" class="form-label">{{ __('Documentation and Records') }}</label>
                            <input type="file" id="documents_and_records" class="form-control" name="documents_and_records" placeholder="Storage of documents and records related to inventory management within the warehouse, including receipts, invoices, and inspection reports.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="layout" class="form-label">{{ __('Layout') }}</label>
                            <input type="file" id="layout" class="form-control" name="layout" placeholder="A layout diagram or description of the warehouse, including aisles, shelves, and storage zones.">
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
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Generated Orders</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body  mx-auto">

                  
                      <form method="GET" action="" id="edit_supplier_form">
                      <table class="table table-hover table-bordered mt-2">
                            <tr>
                                <th></td>
                                <th>S No.</th>
                                <th>Resource Name</th>
                                <th>Resource Description</th>
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
                <!-- </div>
                  </div> -->
                <!-- </div> -->


          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
