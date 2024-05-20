@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Goods Recieving Note's
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Goods Recieving Note's<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Goods Recieving Note's:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($grn->id))
           <form method="POST" action="{{ url('grn/update/'.$encryptedId)}}" class="row">
                        @csrf
                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="reciept_number" class="form-label">{{ __('Reciept Number') }}</label>
                            <input type="text" value="{{$grn->reciept_number}}" id="reciept_number" class="form-control" name="reciept_number" value="RPT_{{uniqid()}}" placeholder="Enter the Reciept Number" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="received_date" class="form-label">{{ __('Received Date') }}</label>
                            <input type="date" value="{{$grn->received_date}}" id="received_date" class="form-control" name="received_date" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="received_by" class="form-label">{{ __('Received By') }}</label>
                            <input type="text" value="{{$grn->received_by}}" id="received_by" class="form-control" name="received_by" placeholder="Enter the name of the person who recieves the order" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="received_quantity" class="form-label">{{ __('Received Quantity') }}</label>
                            <input type="text" value="{{$grn->received_quantity}}" id="received_quantity" class="form-control" name="received_quantity" placeholder="Enter the no. of quantity recieved" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="expected_quantity" class="form-label">{{ __('Expected Quantity') }}</label>
                            <input type="text" value="{{$grn->expected_quantity}}" id="expected_quantity" class="form-control" name="expected_quantity" placeholder="Enter the no. of expected quantity to be recieved" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="unit_cost" class="form-label">{{ __('Unit Cost') }}</label>
                            <input type="text" value="{{$grn->unit_cost}}" id="unit_cost" class="form-control" name="unit_cost" placeholder="The unit cost of each item received." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="total_cost" class="form-label">{{ __('Total Cost') }}</label>
                            <input type="text" value="{{$grn->total_cost}}" id="total_cost" class="form-control" name="total_cost" placeholder="The total cost of the received inventory, calculated based on the unit cost and received quantity." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="remarks" class="form-label">{{ __('Remarks/Comments') }}</label>
                            <input type="text" value="{{$grn->remarks}}" id="remarks" class="form-control" name="remarks" placeholder="Any additional remarks or comments related to the receipt and inspection process." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="receiving_location" class="form-label">{{ __('Receiving Location') }}</label>
                            <input type="text" value="{{$grn->receiving_location}}" id="receiving_location" class="form-control" name="receiving_location" placeholder="The location within the warehouse or facility where the inventory was received and stored." required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="quality_control_information" class="form-label">{{ __('Quality Control Information') }}</label>
                            <input type="text" value="{{$grn->quality_control_information}}" id="quality_control_information" class="form-control" name="quality_control_information" placeholder="Details about quality control procedures followed during the receipt and inspection process." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="serial_number" class="form-label">{{ __('Serial Number') }}</label>
                            <input type="text" value="{{$grn->serial_number}}" id="serial_number" class="form-control" name="serial_number" placeholder="Serial numbers assigned to individual items received, if applicable." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="tracking_number" class="form-label">{{ __('Shipping Tracking Number') }}</label>
                            <input type="text" value="{{$grn->tracking_number}}" id="tracking_number" class="form-control" name="tracking_number" placeholder="The tracking number assigned to the shipment by the shipping carrier.">
                        </div>

                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="delivery_method" class="form-label">{{ __('Delivery Method') }}</label>
                            <select id="delivery_method" class="form-control p-3" name="delivery_method" placeholder="Enter the name of the person who receives the order">
                                <option value="">--Select--</option>
                                <option value="Courier Services"{{$grn->delivery_method == 'Courier Services' ? 'Selected':''}}>Courier Services</option>
                                <option value="Truck Delivery"{{$grn->delivery_method == 'Truck Delivery' ? 'Selected':''}}>Truck Delivery</option>
                                <option value="Local Pickup"{{$grn->delivery_method == 'Local Pickup' ? 'Selected':''}}>Local Pickup</option>
                                <option value="Express Shipping"{{$grn->delivery_method == 'Express Shipping' ? 'Selected':''}}>Express Shipping</option>
                                <option value="Postal Mail"{{$grn->delivery_method == 'Postal Mail' ? 'Selected':''}}>Postal Mail</option>
                                <option value="Air Freight"{{$grn->delivery_method == 'Air Freight' ? 'Selected':''}}>Air Freight</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="supplier_id" class="form-label">{{ __('Supplier') }}<sup class="text-danger">*</sup></label>
                            <select id="supplier_id" class="form-control p-3" name="supplier_id" placeholder="The category or classification of the part (e.g., engine parts, body parts, electrical components)." required autofocus>
                                <option value="">--Select Supplier--</option> 
                                <option value="Abhishek"{{$grn->supplier_id == 'Abhishek' ? 'Selected' : ''}}>Abhishek</option>
                                <option value="Priyanka"{{$grn->supplier_id == 'Priyanka' ? 'Selected' : ''}}>Priyanka</option>
                                <option value="Kalpana"{{$grn->supplier_id == 'Kalpana' ? 'Selected' : ''}}>Kalpana</option>
                                <option value="Arush"{{$grn->supplier_id == 'Arush' ? 'Selected' : ''}}>Arush</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="order_id" class="form-label">{{ __('Order Number') }}</label>
                            <select id="order_id"  class="form-control p-3" name="order_id" required>
                                <option value="0">--Select order number--</option>
                                @foreach($orders as $order)
                                <option value="{{$order->id}}"{{$grn->po_id == $order->id ? 'Selected' : ''}}>{{$order->order_id}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="shipping_carrier" class="form-label">{{ __('Shipping Carrier') }}</label>
                            <select id="shipping_carrier" class="form-control p-3" name="shipping_carrier" placeholder="Enter the name of the person who receives the order">
                                <option value="">--Select--</option>
                                <option value="DHL"{{$grn->shipping_carrier == 'DHL' ? 'Selected' : ''}}>DHL</option>
                                <option value="FedEx"{{$grn->shipping_carrier == 'FedEx' ? 'Selected' : ''}}>FedEx</option>
                                <option value="UPS"{{$grn->shipping_carrier == 'UPS' ? 'Selected' : ''}}>UPS</option>
                                <option value="USPS"{{$grn->shipping_carrier == 'USPS' ? 'Selected' : ''}}>USPS</option>
                                <option value="TNT"{{$grn->shipping_carrier == 'TNT' ? 'Selected' : ''}}>TNT</option>
                                <option value="Purolator"{{$grn->shipping_carrier == 'Purolator' ? 'Selected' : ''}}>Purolator</option>
                                <option value="Canada Post"{{$grn->shipping_carrier == 'Canada Post' ? 'Selected' : ''}}>Canada Post</option>
                                <option value="Royal Mail"{{$grn->shipping_carrier == '"Royal Mail' ? 'Selected' : ''}}>Royal Mail</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>



                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="condition" class="form-label">{{ __('Condition') }}</label>
                            <select id="condition" class="form-control p-3" name="condition" placeholder="Enter the name of the person who receives the order">
                                <option value="">--Select--</option>
                                <option value="New"{{$grn->condition == 'New' ? 'Selected' : ''}}>New</option>
                                <option value="Used"{{$grn->condition == 'Used' ? 'Selected' : ''}}>Used</option>
                                <option value="Damaged"{{$grn->condition == 'Damaged' ? 'Selected' : ''}}>Damaged</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inspection_result" class="form-label">{{ __('Inspection Results') }}</label>
                            <select id="inspection_result" class="form-control p-3" name="inspection_result" placeholder="Enter the name of the person who receives the order">
                                <option value="">--Select--</option>
                                <option value="Pass"{{$grn->inspection_result == 'Pass' ? 'Selected' : ''}}>Pass</option>
                                <option value="Fail"{{$grn->inspection_result == 'Fail' ? 'Selected' : ''}}>Fail</option>
                            </select>
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

