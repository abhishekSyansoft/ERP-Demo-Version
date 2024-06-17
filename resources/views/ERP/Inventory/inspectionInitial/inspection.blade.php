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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Initial Inspection</h4>
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
                            <th rowspan="2">S. Number</th>
                                <th rowspan="2">DNN</th>
                                <th rowspan="2">GRN Number</th>
                                <th rowspan="1" colspan="2">Invoice</th>
                                <!-- <th rowspan="1" colspan="2">Order</th> -->
                                <th rowspan="2">Delivered Quanity</th>
                                <th colspan="2">Inspection Quantity</th>
                                <th colspan="2">Item</th>
                                <th colspan="2">Supplier</th>
                                <th colspan="2">Conditions</th>
                                <th rowspan="2" class="inspection_notes">Visual Inspection Notes</th>
                                <th colspan="3">inspector Details</th>
                                <!-- <th rowspan="2">Inspection Status</th> -->
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <!-- <th>DNN</th> -->
                              <th colspan="1"> Number</th>
                              <th colspan="1">  Date </th>
                              <!-- <th colspan="1">PO Number</th>
                              <th colspan="1"> Ordered Quantity </th> -->
                              <th>OK Tested </th>
                              <th>Rejected/Return </th>
                              <th>Item Code</th>
                              <th>Item Name</th>
                              <th>Supplier ID</th>
                              <th>Supplie Name</th>
                              <th>Packaging</th>
                              <th>Labeling</th>
                              <th>Name</th>
                              <th>ID/Signature</th>
                              <th>Photo</th>
                            </tr>

                            @php($i=1)
                            @foreach($details as $data)
                            @if($data->quantity_delivered)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$data->dnn}}</td>
                                <td>{{$data->grn_number}}</td>
                                <td>{{$data->invoice_number}}</td>
                                <td>{{$data->invoice_date}}</td>
                                <!-- <td>{{$data->po_number}}</td>
                                <td>{{$data->ordered_qty}}</td> -->
                                <td>{{$data->quantity_delivered}} pcs.</td>
                                <td>{{$data->passed_qty}} pcs.</td>
                                <td>{{$data->failed_qty}} pcs.</td>
                                <td>{{$data->item_id}}</td>
                                <td>{{$data->item_name}}</td>
                                <td>{{$data->supplier}}</td>
                                <td>{{$data->supplier_name}}</td>
                                <td>{{$data->packaging_condition}}</td>
                                <td>{{$data->labeling}}</td>
                                <td class="inspection_notes">{!!$data->visual_inspection_notes!!}</td>      
                                                          <td>{{$data->inspector_name}}</td>
                                <td>{{$data->inspector_id_signature}}</td>
                                @if($data->photo_evidence)
                                <td><a href="{{asset('Storage/'.$data->photo_evidence)}}" class="btn btn-primary mdi mdi-eye"></a></td>
                                @else
                                <td></td>
                                @endif
                                <!-- @if($data->inspection_status == 1)
                                <td><a class="mdi mdi-check-circle text-success" style="font-size:20px;"></a></td>
                                @else
                                <td></td>
                                @endif -->
                                <td>
                                    <a class="btn btn-primary">Edit</a>
                                    <a class="btn btn-danger">Delete</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Initial Inspection Entry</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
                            <label for="photo_evidence" class="form-label">{{ __('Photo Evidence') }}</label>
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
