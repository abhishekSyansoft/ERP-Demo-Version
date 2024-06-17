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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Inventory Contorol</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                         
                        <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>  
                        
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
                                <!-- <th rowspan="2">View GRN</th> -->
                                <th rowspan="2">DNN</th>
                                <th rowspan="1" colspan="2">Order</th>
                                <!-- <th rowspan="2">Delivered Quanity</th> -->
                                <!-- <th rowspan="2">Qunatity</th> -->
                                <th colspan="3">Warehouse Name</th>
                                <th rowspan="2">BIN/Shelf's Number</th>
                                <th colspan="2">Isnpector</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <!-- <th>DNN</th> -->
                              <th colspan="1">PO Number</th>
                              <th colspan="1"> Quantity </th>
                              <th colspan="1"> ID </th>
                              <th colspan="1">Name</th>
                              <th colspan="1"> Location </th>
                             
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
                            <tr>
                               
                            </tr>
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
                <!-- Supplier Form -->
                <form method="POST" action="{{ route('inspection.store') }}" class="row" enctype="multipart/form-data" id="inspectionForm">
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
                            <input list="dnn_lists" id="dnn" class="form-control" name="dnn" placeholder="Select The DN Number to update inspection" required>
                            <datalist id="dnn_lists"> 
                                <!-- Add more options as needed -->
                                @foreach ($details as $detail)
                                <option value="{{$detail->dnn}}">
                                @endforeach
                            </datalist>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="po_num" class="form-label">{{ __('PO Number') }}<sup class="text-danger">*</sup></label>
                            <input id="po_num" type="text" class="form-control" name="po_num" placeholder="Unique identification number for purchase order">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="ordered_qty" class="form-label">{{ __('Ordered Quantity') }}<sup class="text-danger">*</sup></label>
                            <input id="ordered_qty" type="text" class="form-control" name="ordered_qty" placeholder="Total quantity ordered in PO">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="packaging_condition" class="form-label">{{ __('Packaging Condition') }}</label>
                            <select id="packaging_condition" type="text" class="form-control p-3" name="packaging_condition" placeholder="Unique identification number for purchase order">
                            <option value="">----Select Package Condition----</option>
                            <option value="Intact">Intact</option>
                            <option value="Damaged">Damaged</option>
                            <option value="Sealed">Sealed</option>
                            <option value="Opened">Opened</option>
                            <option value="Resealed">Resealed</option>
                            <option value="Wet/Damp">Wet/Damp</option>
                            <option value="Clean">Clean</option>
                            <option value="Dirty">Dirty</option>
                            <option value="Properly Labeled">Properly Labeled</option>
                            <option value="Mislabelled">Mislabelled</option>
                            <option value="Deformed">Deformed</option>
                            <option value="Secure">Secure</option>
                            <option value="Loose">Loose</option>
                            <option value="Tampered">Tampered</option>
                            <option value="Expired">Expired</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="labeling" class="form-label">{{ __('Labeling') }}</label>
                            <select name="labeling" id="labeling" class="form-control p-3">
                                <option value="">----Select Labeling Type----</option>
                                <option value="Correctly Labeled">Correctly Labeled</option>
                                <option value="Incorrectly Labeled">Incorrectly Labeled</option>
                                <option value="Missing Label">Missing Label</option>
                                <option value="Unreadable Label">Unreadable Label</option>
                                <option value="Misplaced Label">Misplaced Label</option>
                                <option value="Multiple Labels">Multiple Labels</option>
                            </select>                        
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="quantity_delivered" class="form-label">{{ __('Delivered Quantity') }}<sup class="text-danger">*</sup></label>
                            <input id="quantity_delivered" type="text" class="form-control" name="quantity_delivered" placeholder="Total quantity passed in isnpection">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="passed_qty" class="form-label">{{ __('Pass Quantity') }}<sup class="text-danger">*</sup></label>
                            <input id="passed_qty" type="text" class="form-control" name="passed_qty" placeholder="Total quantity passed in isnpection">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="failed_qty" class="form-label">{{ __('Fail Quantity') }}<sup class="text-danger">*</sup></label>
                            <input id="failed_qty" type="text" class="form-control" name="failed_qty" placeholder="Total quantity failed in isnpection">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="photo_evidence" class="form-label">{{ __('Photo Evidence') }}<sup class="text-danger">*</sup></label>
                            <input id="photo_evidence" type="file" class="form-control" name="photo_evidence" placeholder="Photographic evedience of order recieved">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inspector_name" class="form-label">{{ __('Inspector Name') }}<sup class="text-danger">*</sup></label>
                            <input id="inspector_name" type="text" class="form-control" name="inspector_name" placeholder="The name of the inspector">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inspector_id" class="form-label">{{ __('Inspector ID') }}<sup class="text-danger">*</sup></label>
                            <input id="inspector_id" type="text" class="form-control" name="inspector_id" placeholder="The ID of the inspector">
                        </div>


                        <div class="mb-3 col-md-12">
                            <label for="visual_inspection_notes" class="form-label">{{ __('Visual Inspecton Note') }}<sup class="text-danger">*</sup></label>
                            <textarea id="visual_inspection_notes" rows="10" class="form-control" name="visual_inspection_notes" placeholder="mention visual inspection note"></textarea>
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
