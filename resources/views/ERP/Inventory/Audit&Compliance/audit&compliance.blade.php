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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Audit And Compliance</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <!-- <input type="search" name="search" id="search" placeholder="Search" class="p-2"> -->
                        <!-- <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>   -->
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
                                <th rowspan="2">Audit</th>
                                <th rowspan="2">View Audit Report</th>
                                <th rowspan="2">Check Compliance</th>
                                <th rowspan="2">Inventory Section</th>
                                <th colspan="2">Item</th>
                                <th rowspan="2">Vehicle</th>
                                
                                <th colspan="3">Stock Description</th>
                                <th rowspan="2">Reorder Point</th>
                               
                                <th rowspan="2">Last Replenishment Date</th>
                               
                                <!-- <th rowspan="2">Sales Channels</th> -->
                                <th colspan="3">Allocation</th>
                                <!-- <th rowspan="2">Demand Variability</th> -->
                               
                               
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
                             
                              <th>Quantity</th>
                              <th>Date</th>
                              <th>Location</th>
                            </tr>
                            @php($i = 1)
                            @foreach($allocations as $allocation)
                              <tr>
                                <td>{{$i++}}</td>
                                <td><a class="btn btn-primary fileAudit" data-id="{{$allocation->inventory_id}}">Upload Audit Report</a></td>
                                @if($allocation->audit_date != '')
                                <td><a class="btn btn-primary mdi mdi-eye viewAuditReport" data-id="{{$allocation->inventory_id}}"></a></td>
                                @else
                                <td>NA</td>
                                @endif
                                <td><a class="btn btn-primary mdi mdi-eye" data-bs-toggle="modal" data-bs-target="#vehiclesBarcodeModal"></a></td>
                                <td>{{$allocation->inventory_id}}</td>
                                <td>{{$allocation->item_code}}</td>
                                <td>{{$allocation->description}}</td>
                                <td>{{$allocation->category}}</td>
                                <td>{{$allocation->current_stock_level}}pcs.</td>
                                <td>{{$allocation->min_stock_level}}pcs.</td>
                                <td>{{$allocation->max_stock_level}}pcs.</td>
                                <td>{{$allocation->reorder_point}}pcs.</td>
                                
                                <td>{{$allocation->last_replenishment_date}}</td>
                               
                                <td>{{$allocation->allocation_qty}}pcs.</td>
                                <td>{{$allocation->alloation_date}}</td>
                                <td>{{$allocation->location}}</td>
                               
                               
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
        <div class="modal fade" id="vehiclesBarcodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color:white;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Compliance Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <center>
                        <!-- QR Code image will be loaded here -->
                        <td><img src="https://assets.contenthub.wolterskluwer.com/api/public/content/7f47684afa3b44079b4a218125ffd34a?v=85c0c56d&t=w768l" style="height:90vh;object-fit:contain;" alt="Compliance Report"></td>
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
                <form method="POST" action="{{ route('audit.store') }}" class="row" enctype="multipart/form-data" id="TACForm">
                        @csrf

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_id" class="form-label">{{ __('Inventory ID') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="inventory_id" class="form-control" name="inventory_id" placeholder="A unique identifier for each inventory item" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="audit_date" class="form-label">{{ __('Audit Date') }}<sup class="text-danger">*</sup></label>
                            <input type="date" id="audit_date" class="form-control" name="audit_date" placeholder="Date of the audit" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="auditor" class="form-label">{{ __('Auditor Name') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="auditor" class="form-control" name="auditor" placeholder="Name of the auditor" required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="status" class="form-label">{{ __('Auditor Status') }}<sup class="text-danger">*</sup></label>
                            <select type="text" id="status" class="form-control p-3" name="status" placeholder="ANme of the auditor" required>
                                <option value="">--Select--</option>
                                <option value="Passed">Passed</option>
                                <option value="Failed">Failed</option>
                                <option value="Pending">Pending</option>
                            </select>           
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="files" class="form-label">{{ __('Upload Audit Report') }}<sup class="text-danger">*</sup></label>
                            <input type="file" id="files" class="form-control" name="files" placeholder="Submit Detailsd report of audit" required>
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
                        <h5 class="modal-title" id="staticBackdropLabel">Audit Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body">
                            <table class="table table-bordered border-primary" style="width:100%;">
                                <tr>
                                <th>Audit Date</th>
                                <th>Auditor Name</th>
                                <th>Audit Detail Report</th>
                                </tr>
                                <tr>
                                    <td id="date"></td>
                                    <td id="name"></td>
                                    <td><a href="" class="mdi mdi-file" id="file" style="font-size:30px;"></a></td>
                                </tr>
                            </table>
                      </div>
                      
                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                      <!-- </div> -->
                    </div>
                  </div>
                </div>

          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
