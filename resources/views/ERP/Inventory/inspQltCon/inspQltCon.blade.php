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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Inspection and Quality Control</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                          @if(Auth::user()->admin==3 || Auth::user()->admin==8)
                        <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
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
                        <table class="table table-bordered border-primary" style="width: 100%;">
                        <tr>    
                                <th rowspan="2">S. Number</th>
                                <th rowspan="2">GRN Number</th>
                                <th rowspan="2">DNN</th>
                                <th rowspan="1" colspan="2">Order</th>
                                <!-- <th rowspan="2">Delivered Quanity</th> -->
                                <th rowspan="2">Qunatity</th>
                                <th colspan="2">inspector Details</th>
                                <th rowspan="2">Test Status</th>
                                <th rowspan="2">Inspection Status</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <!-- <th>DNN</th> -->
                              <th colspan="1">PO Number</th>
                              <th colspan="1"> Ordered Quantity </th>
                              <th>Name</th>
                              <th>ID/Signature</th>
                            </tr>
                            <tr>
                              <!-- <th>Date</th>
                              <th>Person</th>
                              <th>Location</th>
                            </tr> -->
                           
                            @php($i=1)
                            @foreach($details as $data)
                            @if($data->passed_qty > 0)
                            <tr>
                                <td>{{$i++}}</td>
                                <!-- <td><a class="btn btn-primary mdi mdi-eye viewGRN" data-dnn="{{$data->dnn}}"></a></td> -->
                                <td>{{$data->grn_number}}</td>
                                <td>{{$data->dnn}}</td>
                                <td>{{$data->po_number}}</td>
                                <td>{{$data->ordered_qty}} .pcs</td>
                               
                                <td>{{$data->passed_qty}} .pcs</td>
                               
                              
                                <td>{{$data->inspector_name}}</td>
                                <td>{{$data->inspector_id_signature}}</td>
                                <!-- <td><a href="{{asset('Storage/'.$data->photo_evidence)}}" class="btn btn-primary mdi mdi-eye"></a></td> -->
                                <td><a style="color:green"><b>OK Tested</b></a></td>
                                @if($data->inspection_status == 1)
                                <td><a class="mdi mdi-check-circle text-success" style="font-size:20px;"></a></td>
                                @else
                                <td></td>
                                @endif
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                    @if(Auth::user()->admin==3)
                                        <a href="{{url('edit-grn/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                    @endif
                                        <a href="{{url('delete-grn/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
          </div>


          
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSupplierModalLabel"> {{ Auth::user()->admin==3 ? 'Create Goods Recieving Notes' : 'Material Inward' }}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('grn.store')}}" class="row">
                        @csrf

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="reciept_number" class="form-label">{{ __('Reciept Number') }}</label>
                            <input type="text" id="reciept_number" class="form-control" name="reciept_number" value="RPT_{{uniqid()}}" placeholder="Enter the Reciept Number" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="po_num" class="form-label">{{ __('PO Number') }}</label>
                            <select id="po_num" class="form-select p-2" name="po_num" required>
                                <!-- Options for PO Number will be populated dynamically here -->
                                @for($i=0;$i<5;$i++)
                                  <option value="PO_{{uniqid()}}">PO_{{uniqid()}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="qut_number" class="form-label">{{ __('Quotation Number') }}</label>
                            <select id="qut_number" class="form-select p-2" name="qut_number" required>
                                <!-- Options for Quotation Number will be populated dynamically here -->
                                @for($i=0;$i<5;$i++)
                                  <option value="QUT_{{uniqid()}}">QUT_{{uniqid()}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="invoice_number" class="form-label">{{ __('Invoice Number') }}</label>
                            <select id="invoice_number" class="form-select p-2" name="invoice_number" required>
                                <!-- Options for Invoice Number will be populated dynamically here -->
                                @for($i=0;$i<5;$i++)
                                  <option value="INV_{{uniqid()}}">INV_{{uniqid()}}</option>
                                @endfor
                            </select>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="received_date" class="form-label">{{ __('Received Date') }}</label>
                            <input type="date" id="received_date" class="form-control" name="received_date" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="received_by" class="form-label">{{ __('Received By') }}</label>
                            <input type="text" id="received_by" class="form-control" name="received_by" placeholder="Enter the name of the person who recieves the order" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="received_quantity" class="form-label">{{ __('Received Quantity') }}</label>
                            <input type="text" id="received_quantity" class="form-control" name="received_quantity" placeholder="Enter the no. of quantity recieved" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="expected_quantity" class="form-label">{{ __('Expected Quantity') }}</label>
                            <input type="text" id="expected_quantity" class="form-control" name="expected_quantity" placeholder="Enter the no. of expected quantity to be recieved" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="unit_cost" class="form-label">{{ __('Unit Cost') }}</label>
                            <input type="text" id="unit_cost" class="form-control" name="unit_cost" placeholder="The unit cost of each item received." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="total_cost" class="form-label">{{ __('Total Cost') }}</label>
                            <input type="text" id="total_cost" class="form-control" name="total_cost" placeholder="The total cost of the received inventory, calculated based on the unit cost and received quantity." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="remarks" class="form-label">{{ __('Remarks/Comments') }}</label>
                            <input type="text" id="remarks" class="form-control" name="remarks" placeholder="Any additional remarks or comments related to the receipt and inspection process." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="receiving_location" class="form-label">{{ __('Receiving Location') }}</label>
                            <input type="text" id="receiving_location" class="form-control" name="receiving_location" placeholder="The location within the warehouse or facility where the inventory was received and stored." required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="quality_control_information" class="form-label">{{ __('Quality Control Information') }}</label>
                            <input type="text" id="quality_control_information" class="form-control" name="quality_control_information" placeholder="Details about quality control procedures followed during the receipt and inspection process." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="serial_number" class="form-label">{{ __('Serial Number') }}</label>
                            <input type="text" id="serial_number" class="form-control" name="serial_number" placeholder="Serial numbers assigned to individual items received, if applicable." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="tracking_number" class="form-label">{{ __('Shipping Tracking Number') }}</label>
                            <input type="text" id="tracking_number" class="form-control" name="tracking_number" placeholder="The tracking number assigned to the shipment by the shipping carrier.">
                        </div>

                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="delivery_method" class="form-label">{{ __('Delivery Method') }}</label>
                            <select id="delivery_method" class="form-control p-3" name="delivery_method" placeholder="Enter the name of the person who receives the order">
                                <option value="">--Select--</option>
                                <option value="Courier Services">Courier Services</option>
                                <option value="Truck Delivery">Truck Delivery</option>
                                <option value="Local Pickup">Local Pickup</option>
                                <option value="Express Shipping">Express Shipping</option>
                                <option value="Postal Mail">Postal Mail</option>
                                <option value="Air Freight">Air Freight</option>
                                <!-- Add more options as needed -->
                            </select>
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

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="order_id" class="form-label">{{ __('Order Number') }}</label>
                            <select id="order_id"  class="form-control p-3" name="order_id" required>
                              
                            </select>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="shipping_carrier" class="form-label">{{ __('Shipping Carrier') }}</label>
                            <select id="shipping_carrier" class="form-control p-3" name="shipping_carrier" placeholder="Enter the name of the person who receives the order">
                                <option value="">--Select--</option>
                                <option value="DHL">DHL</option>
                                <option value="FedEx">FedEx</option>
                                <option value="UPS">UPS</option>
                                <option value="USPS">USPS</option>
                                <option value="TNT">TNT</option>
                                <option value="Purolator">Purolator</option>
                                <option value="Canada Post">Canada Post</option>
                                <option value="Royal Mail">Royal Mail</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>



                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="condition" class="form-label">{{ __('Condition') }}</label>
                            <select id="condition" class="form-control p-3" name="condition" placeholder="Enter the name of the person who receives the order">
                                <option value="">--Select--</option>
                                <option value="New">New</option>
                                <option value="Used">Used</option>
                                <option value="Damaged">Damaged</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inspection_result" class="form-label">{{ __('Inspection Results') }}</label>
                            <select id="inspection_result" class="form-control p-3" name="inspection_result" placeholder="Enter the name of the person who receives the order">
                                <option value="">--Select--</option>
                                <option value="Pass">Pass</option>
                                <option value="Fail">Fail</option>
                            </select>
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
                <div class="modal fade" id="GRNiewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="GRNiewModalLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="GRNiewModalLabel">Goods Receiving Note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body grnModalBdy">
                        <center><h2>Goods Receiving Note</h2></center>
                        <hr>
                        <div class="table-wrapper" style="height:auto;">
                      <table class="grn-table table table-bordered border-primary" style="text-align:left !important;">
                          <tr>
                            <th><strong>Headings</strong></th>
                            <th><strong>Details</strong></th>
                          </tr>
                          <tr>
                            <td><strong>Supplier Information:</strong></td>
                            <td style="text-align:left !important;"><b>Name:</b> <span id="supplier_name_grn"></span><br><br><b>Contact:</b> <span id="supplier_contact_grn"></span></td>
                          </tr>
                          <tr>
                            <td><strong>Receiver Information:</strong></td>
                            <td style="text-align:left !important;"><b>Name:</b> <span id="inspector_name_grn"></span><br><br> <b>Identity Number:</b> <span id="inspector_id_grn"></span></td>
                          </tr>
                          <tr>
                            <td><strong>Goods Details:</strong></td>
                            <td>
                              <div class="table-wrapper" style="height:auto;">
                              <table class="table table-bordered p-1 border-primary">
                                <tr><th>Item Code</th><th>Description</th><th>Ordered Quantity</th><th>Received Quantity</th></tr>
                                <tbody id="grn_item_lists_grn">
                                  <td id="item_code"></td>
                                  <td id="item_name"></td>
                                  <td id="order_dty"></td>
                                  <td id="deliver_qty"></td>

                                </tbody>
                              </table>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><strong>Purchase Order Information:</strong></td>
                            <td style="text-align:left !important;"><b>PO Number:</b> <span id="po_number_grn"></span><br><br><b>Date:</b> <span id="order_date_grn"></span></td>
                          </tr>
                          <tr>
                            <td><strong>Delivery Details:</strong></td>
                            <td style="text-align:left !important;"><b>Date:</b> <span id="delivery_date_grn"></span>
                            <br><br><b>Delivery Timing:</b> <span id="delivery_time_grn"></span>
                            <br><br><b>Vehicle Number:</b> <span id="vehicle_number_grn"></span>
                            <br><br><b>DN Number:</b> <span id="dnn_grn"></span></td>
                          </tr>
                          <!-- Add more details as needed -->
                        </table>
                        </div>
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
