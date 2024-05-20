@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Warehouse management
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Warehouse management<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
        </nav>
    </div>
    <div>
    <div>
<div>
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Update Warehouse management:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($wm->id))
           <form method="POST" action="{{ url('wm/update/'.$encryptedId)}}" class="row">
           @csrf
                        
           <div class="col-12">
                            <hr>
                              <h4>Warehouse Detail's</h4>
                            <hr>
                        </div>
                       
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="warehouse_id" class="form-label">{{ __('Warehoues ID') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="warehouse_id" class="form-control" name="warehouse_id" value="{{$wm->warehouse_id}}" placeholder="A unique identifier for each warehouse facility">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="warehouse_name" class="form-label">{{ __('Warehoues Name') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="warehouse_name" class="form-control" name="warehouse_name" value="{{$wm->warehouse_name}}" placeholder="The name or description of the warehouse.">
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="capacity" class="form-label">{{ __('Capacity') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="capacity" class="form-control" name="capacity" value="{{$wm->capacity}}" placeholder="Mention Capacit of the warehouse">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="warehouse_manager" class="form-label">{{ __('Manager') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="warehouse_manager" class="form-control" value="{{$wm->warehouse_manager}}" name="warehouse_manager" placeholder="The name or identifier of the employee responsible for managing the warehouse.">
                        </div>


                        <div class="col-12">
                            <hr>
                              <h4>Location Detail's</h4>
                            <hr>
                        </div>


                        <div class="mb-3 row">
                            <div class="col-md-6 col-lg-3">
                              <label for="address" class="form-label">{{ __('Address') }}<sup class="text-danger">*</sup></label>
                              <input type="text" id="address" class="form-control" name="address" value="{{$wm->address}}" placeholder="Enter Street address where the ware house located">
                            </div>

                            <div class="col-md-6 col-lg-3">
                              <label for="city" class="form-label">{{ __('City') }}<sup class="text-danger">*</sup></label>
                              <select type="text" id="city" class="form-control p-3" value="{{$wm->city}}" name="city" placeholder="Enter name of city where warehouse located">
                              <optgroup label="Haryana">
                                    <option value="Gurgaon"{{$wm->city == 'Gurgaon' ? 'Selected' : ''}}>Gurgaon</option>
                                    <option value="Faridabad"{{$wm->city == 'Faridabad' ? 'Selected' : ''}}>Faridabad</option>
                                    <option value="Panipat"{{$wm->city == 'Panipat' ? 'Selected' : ''}}>Panipat</option>
                                    <option value="Ambala"{{$wm->city == 'Ambala' ? 'Selected' : ''}}>Ambala</option>
                                    <option value="Karnal"{{$wm->city == 'Karnal' ? 'Selected' : ''}}>Karnal</option>
                                </optgroup>
                                <optgroup label="Andhra Pradesh">
                                    <option value="Visakhapatnam"{{$wm->city == 'Visakhapatnam' ? 'Selected' : ''}}>Visakhapatnam</option>
                                    <option value="Vijayawada"{{$wm->city == 'Vijayawada' ? 'Selected' : ''}}>Vijayawada</option>
                                    <option value="Tirupati"{{$wm->city == 'Tirupati' ? 'Selected' : ''}}>Tirupati</option>
                                    <option value="Kakinada"{{$wm->city == 'Kakinada' ? 'Selected' : ''}}>Kakinada</option>
                                    <option value="Rajahmundry"{{$wm->city == 'Rajahmundry' ? 'Selected' : ''}}>Rajahmundry</option>
                                </optgroup>
                                <optgroup label="Arunachal Pradesh">
                                    <option value="Itanagar"{{$wm->city == 'Itanagar' ? 'Selected' : ''}}>Itanagar</option>
                                    <option value="Naharlagun"{{$wm->city == '' ? 'Selected' : ''}}>Naharlagun</option>
                                    <option value="Tawang"{{$wm->city == 'Naharlagun' ? 'Selected' : ''}}>Tawang</option>
                                    <option value="Pasighat"{{$wm->city == 'Pasighat' ? 'Selected' : ''}}>Pasighat</option>
                                </optgroup>
                                <optgroup label="Assam">
                                    <option value="Guwahati"{{$wm->city == 'Guwahati' ? 'Selected' : ''}}>Guwahati</option>
                                    <option value="Silchar"{{$wm->city == 'Silchar' ? 'Selected' : ''}}>Silchar</option>
                                    <option value="Dibrugarh"{{$wm->city == 'Dibrugarh' ? 'Selected' : ''}}>Dibrugarh</option>
                                    <option value="Jorhat"{{$wm->city == 'Jorhat' ? 'Selected' : ''}}>Jorhat</option>
                                    <option value="Tezpur"{{$wm->city == 'Tezpur' ? 'Selected' : ''}}>Tezpur</option>
                                </optgroup>
                                <optgroup label="Bihar">
                                    <option value="Patna"{{$wm->city == 'Patna' ? 'Selected' : ''}}>Patna</option>
                                    <option value="Gaya"{{$wm->city == 'Gaya' ? 'Selected' : ''}}>Gaya</option>
                                    <option value="Muzaffarpur"{{$wm->city == 'Muzaffarpur' ? 'Selected' : ''}}>Muzaffarpur</option>
                                    <option value="Bhagalpur"{{$wm->city == 'Bhagalpur' ? 'Selected' : ''}}>Bhagalpur</option>
                                    <option value="Darbhanga"{{$wm->city == 'Darbhanga' ? 'Selected' : ''}}>Darbhanga</option>
                                </optgroup>
                                <!-- Other states and cities follow -->
                              </select>       
                            </div>

                            <div class="col-md-6 col-lg-3">
                              <label for="state" class="form-label">{{ __('State') }}<sup class="text-danger">*</sup></label>
                              <select id="state" class="form-control p-3" value="{{$wm->state}}" name="state" placeholder="Enter name of state where warehouse located">
                              <option value="Andhra Pradesh"{{$wm->state == 'Andhra Pradesh' ? 'Selected' : ''}}>Andhra Pradesh</option>
                                  <option value="Arunachal Pradesh"{{$wm->state == 'Arunachal Pradesh' ? 'Selected' : ''}}>Arunachal Pradesh</option>
                                  <option value="Assam"{{$wm->state == 'Assam' ? 'Selected' : ''}}>Assam</option>
                                  <option value="Bihar"{{$wm->state == 'Bihar' ? 'Selected' : ''}}>Bihar</option>
                                  <option value="Chhattisgarh"{{$wm->state == 'Chhattisgarh' ? 'Selected' : ''}}>Chhattisgarh</option>
                                  <option value="Goa"{{$wm->state == 'Goa' ? 'Selected' : ''}}>Goa</option>
                                  <option value="Gujarat"{{$wm->state == 'Gujarat' ? 'Selected' : ''}}>Gujarat</option>
                                  <option value="Haryana"{{$wm->state == 'Haryana' ? 'Selected' : ''}}>Haryana</option>
                                  <option value="Himachal Pradesh"{{$wm->state == 'Himachal Pradesh' ? 'Selected' : ''}}>Himachal Pradesh</option>
                                  <option value="Jharkhand"{{$wm->state == 'Jharkhand' ? 'Selected' : ''}}>Jharkhand</option>
                                  <option value="Karnataka"{{$wm->state == 'Karnataka' ? 'Selected' : ''}}>Karnataka</option>
                                  <option value="Kerala"{{$wm->state == 'Kerala' ? 'Selected' : ''}}>Kerala</option>
                                  <option value="Madhya Pradesh"{{$wm->state == 'Madhya Pradesh' ? 'Selected' : ''}}>Madhya Pradesh</option>
                                  <option value="Maharashtra"{{$wm->state == 'Maharashtra' ? 'Selected' : ''}}>Maharashtra</option>
                                  <option value="Manipur"{{$wm->state == 'Manipur' ? 'Selected' : ''}}>Manipur</option>
                                  <option value="Meghalaya"{{$wm->state == 'Meghalaya' ? 'Selected' : ''}}>Meghalaya</option>
                                  <option value="Mizoram"{{$wm->state == 'Mizoram' ? 'Selected' : ''}}>Mizoram</option>
                                  <option value="Nagaland"{{$wm->state == 'Nagaland' ? 'Selected' : ''}}>Nagaland</option>
                                  <option value="Odisha"{{$wm->state == 'Odisha' ? 'Selected' : ''}}>Odisha</option>
                                  <option value="Punjab"{{$wm->state == 'Punjab' ? 'Selected' : ''}}>Punjab</option>
                                  <option value="Rajasthan"{{$wm->state == 'Rajasthan' ? 'Selected' : ''}}>Rajasthan</option>
                                  <option value="Sikkim"{{$wm->state == 'Sikkim' ? 'Selected' : ''}}>Sikkim</option>
                                  <option value="Tamil Nadu"{{$wm->state == 'Tamil Nadu' ? 'Selected' : ''}}>Tamil Nadu</option>
                                  <option value="Telangana"{{$wm->state == 'Telangana' ? 'Selected' : ''}}>Telangana</option>
                                  <option value="Tripura"{{$wm->state == 'Tripura' ? 'Selected' : ''}}>Tripura</option>
                                  <option value="Uttar Pradesh"{{$wm->state == 'Uttar Pradesh' ? 'Selected' : ''}}>Uttar Pradesh</option>
                                  <option value="Uttarakhand"{{$wm->state == 'Uttarakhand' ? 'Selected' : ''}}>Uttarakhand</option>
                                  <option value="West Bengal"{{$wm->state == 'West Bengal' ? 'Selected' : ''}}>West Bengal</option>
                              </select>
                            </div>

                            <div class="col-md-6 col-lg-3">
                              <label for="pincode" class="form-label">{{ __('Postal Code') }}<sup class="text-danger">*</sup></label>
                              <input type="text" id="pincode" class="form-control" value="{{$wm->pincode}}" name="pincode" placeholder="Enter postal code where warehouse located">
                            </div>
                        </div>

                        <div class="col-12">
                            <hr>
                              <h4>Other Detail's</h4>
                            <hr>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="shelf_number" class="form-label">{{ __('Shelf Number') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="shelf_number" class="form-control" value="{{$wm->shelf_number}}" name="shelf_number" placeholder="Identification numbers assigned to individual bins, shelves, or storage locations within the warehouse.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_allocation" class="form-label">{{ __('Inventory Allocation') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="inventory_allocation" class="form-control" value="{{$wm->inventory_allocation}}" name="inventory_allocation" placeholder="Information about the allocation of inventory to specific storage locations within the warehouse.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_movement" class="form-label">{{ __('Inventory Movement') }}</label>
                            <input type="text" id="inventory_movement" class="form-control" name="inventory_movement" value="{{$wm->inventory_movement}}" placeholder="Tracking of inventory movements within the warehouse, including receipts, transfers, and shipments.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_levels" class="form-label">{{ __('Inventory Levels') }}</label>
                            <input type="text" id="inventory_levels" class="form-control" name="inventory_levels" value="{{$wm->inventory_levels}}" placeholder="Real-time monitoring of inventory levels within the warehouse, including stock-on-hand and stock-out alerts.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="picking_and_packing" class="form-label">{{ __('Picking And Packing') }}</label>
                            <input type="text" id="picking_and_packing" class="form-control" name="picking_and_packing" value="{{$wm->picking_and_packing}}" placeholder="Details about picking and packing processes within the warehouse, including order picking methods and packing procedures.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="loading_and_unloading" class="form-label">{{ __('Loading And Unloading') }}</label>
                            <input type="text" id="loading_and_unloading" class="form-control" name="loading_and_unloading" value="{{$wm->loading_and_unloading}}" placeholder="Procedures for loading and unloading inventory into and out of the warehouse, including equipment and personnel involved.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="safety_and_security" class="form-label">{{ __('Safety And Security') }}</label>
                            <input type="text" id="safety_and_security" class="form-control" name="safety_and_security" value="{{$wm->safety_and_security}}" placeholder="Safety protocols and security measures implemented within the warehouse to ensure the safety of personnel and inventory.">
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="temprature_and_climate_control" class="form-label">{{ __('Temperature And Climate Conrol') }}<sup class="text-danger">*</sup></label>
                            <input type="number" id="temprature_and_climate_control" class="form-control" value="{{$wm->temprature_and_climate_control}}" name="temprature_and_climate_control" placeholder="Schedule for routine maintenance tasks and inspections of warehouse facilities and equipment.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="emergency_procedures" class="form-label">{{ __('Emergency Procedures') }}</label>
                            <input type="text" id="emergency_procedures" class="form-control" value="{{$wm->emergency_procedures}}" name="emergency_procedures" placeholder="Procedures for handling emergencies such as fires, accidents, or natural disasters within the warehouse.">
                        </div>
 
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="integration_with_ims" class="form-label">{{ __('Integration with IMS') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="integration_with_ims" class="form-control" name="integration_with_ims" value="{{$wm->integration_with_ims}}" placeholder="Integration with inventory management systems to facilitate real-time data exchange and visibility into warehouse operations.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="storage_zone" class="form-label">{{ __('Storage Zones') }}<sup class="text-danger">*</sup></label>
                            <select type="text" id="storage_zone" class="form-control p-3" name="storage_zone" placeholder=": Division of the warehouse into different storage zones or areas (e.g., receiving area, picking area, storage racks).">
                              <option value=""{{$wm->storage_zone == '' ? 'Selected' : ''}}>--Select receiving area, picking area, storage racks--</option>
                              <option value="Receiving Area"{{$wm->storage_zone == 'Receiving Area' ? 'Selected' : ''}}>Receiving Area</option>
                              <option value="Picking Area"{{$wm->storage_zone == 'Picking Area' ? 'Selected' : ''}}>Picking Area</option>
                              <option value="Storage Racks"{{$wm->storage_zone == 'Storage Racks' ? 'Selected' : ''}}>Storage Racks</option>
                            </select>
                        </div>
                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="maintenance_and_sheduling" class="form-label">{{ __('Maintenance Shedule') }}<sup class="text-danger">*</sup></label>
                            <input type="date" id="maintenance_and_sheduling" value="{{$wm->maintenance_and_sheduling}}" class="form-control" name="maintenance_and_sheduling" placeholder="Schedule for routine maintenance tasks and inspections of warehouse facilities and equipment.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_audits" class="form-label">{{ __('Inventory Audits') }}<sup class="text-danger">*</sup></label>
                            <input type="date" value="{{$wm->inventory_audits}}" id="inventory_audits" class="form-control" name="inventory_audits" placeholder="Schedule and procedures for conducting periodic inventory audits to reconcile physical inventory counts with system records.">
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="documents_and_records" class="form-label">{{ __('Documentation and Records') }}</label>
                            <input type="file" id="documents_and_records" class="form-control" name="documents_and_records" placeholder="Storage of documents and records related to inventory management within the warehouse, including receipts, invoices, and inspection reports.">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="layout" class="form-label">{{ __('Layout') }}</label>
                            <input type="file" id="layout" class="form-control" name="layout" placeholder="A layout diagram or description of the warehouse, including aisles, shelves, and storage zones.">
                        </div>


                        <div class="mb-3 col-md-6">
                            <a href="{{asset('Storage/'.$wm->documents_and_records)}}"><i style="font-size:170px;" class="mdi mdi-file primary"></i></a>
                            <p class="text-warning">Old Document and records</p>
                            <b>Note :</b> <p> <b>-></b> Click to open file <br> <b>-></b> If you want to change the file upload another file in Document and records section</p>

                        </div>

                        <div class="mb-3 col-md-6">
                            <a href="{{asset('Storage/'.$wm->layout)}}"><i style="font-size:170px;" class="mdi mdi-file primary"></i></a>
                            <p class="text-warning">Old Layout</p>
                           <b>Note :</b> <p> <b>-></b> Click to open file <br> <b>-></b> If you want to change the file upload another file in layout section</p>
                        </div>


                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        </div>
                    </form>
<!--                    
</div>
</div>
                    </div> -->
            <!-- <p class="card-description"> Add class <code>.table</code>
            </p> -->
            </div>
            </div>
        </div>
    </div>

    </div>
        
    </div>
</div>
</div>
</div>
          <!-- content-wrapper ends -->
@include('admin.layout.footer')

