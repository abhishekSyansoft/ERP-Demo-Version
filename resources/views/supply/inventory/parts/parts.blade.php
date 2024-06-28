@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Parts Inventory Management
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>> Parts Inventory Material <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Parts Inventory Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>  
                        <!-- </div> -->
                        <a style="font-size:30px;float:right;margin-right:10px;" class="mdi mdi-filter"></a>

                        <div class="search-container" style="float:right;">
                          <input type="search" name="search" id="search" placeholder="Search" class="p-2">
                          <i class="mdi mdi-magnify"></i>
                        </div>
                        <button class="btn-primary p-2" style="float:right;margin-right:10px;border:0px;" data-bs-toggle="modal" data-bs-target="#bulk_upload_modal">Bulk Upload</button>

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
                                <th>Product</th>
                                <th>Category</th>
                                <th>Item Code</th>
                                <th>Serial Number</th>
                                <th>Part Name</th>
                                <th>Part Description</th>
                                <th>Notes</th>
                                <th>Warranty Information</th>
                                <th>Location</th>
                                <th>Bin/Shelf Number</th>
                                <th>Condition</th>
                                <th>Unit Cost</th>
                                <th>Added On</th>
                                <th>Last Updated</th>
                                <th>Quantity On Hand</th>
                                <th>Minimum Stock level</th>
                                <th>Maximum Stock level</th>
                                <th>Compatibility</th>
                                <th>Availability</th>
                                <th>QR Code</th>
                                <th>Barcode Code</th>
                                <th>Images</th>
                                <th>Supplier</th>
                                <th>Delivery Date</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($parts as $part)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ $part->vehicle}}</td>
                                <td>{{ $part->category}}</td>
                                <td>{{ $part->part_number}}</td>
                                <td>{{ $part->serial_number}}</td>
                                <td>{{ $part->part_name}}</td>
                                <td>{{ $part->part_description}}</td>
                                <td>{{ $part->notes}}</td>
                                <td>{{ $part->warranty_description}}</td>
                                <td>{{ $part->location}}</td>
                                <td>{{ $part->shelf_number}}</td>
                                <td>{{ $part->condition}}</td>
                                <td>{{ $part->unit_cost}}</td>
                                <td>{{ $part->created_at ? $part->created_at->diffForHumans() : 'N/A' }}</td>
                                <td>{{ $part->updated_at ? $part->updated_at->diffForHumans() : 'N/A' }}</td>
                                <td>{{ $part->qty_on_hand}}</td>
                                <td>{{ $part->min_stock_level}}</td>
                                <td>{{ $part->max_stock_level}}</td>
                                <td>{{ $part->compatability}}</td>
                                <td>{{ $part->availability}}</td>
                                @if($part->barcode)
                                <td><a class="mdi mdi-eye btn btn-primary" data-bs-target="#qrcodeModal" data-bs-toggle="modal" data-qrcode="{{ asset('Storage/' . $part->barcode) }}"></a></td>
                                @else
                                <td><a class="cqfi btn btn-primary" style="text-decoration:none;" data-code-id="{{$part->id}}">Generate QRCode</a></td>
                                @endif
                                @if($part->qrcode)
                                <td><a id="barcodeImage" class="mdi mdi-eye btn btn-primary" data-bs-target="#barcodeModal" data-bs-toggle="modal" data-barcode="{{asset('Storage/'.$part->qrcode)}}"></a></td>
                                @else
                                <td><a class="cbfi btn btn-primary" style="text-decoration:none;" data-barcode-id="{{$part->id}}">Generate Barcode</a></td>
                                @endif                                
                                <!-- <td></td> -->
                                @if($part->image)
                                <td><a id="partImage" class="mdi mdi-eye btn btn-primary" data-bs-target="#partImageModal" data-bs-toggle="modal" data-id="{{asset('Storage/'.$part->image)}}"></a></td>
                                @else
                                <td></td>
                                @endif   
                                <td>{{ $part->supplier_id}}</td>
                                <td>{{ $part->lead_time}}</td>
                                @php($encryptedId = encrypt($part->id)) 
                                <td>
                                    <a href="{{url('edit-partsinv/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{url('delete-partsinv/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
<div class="modal fade" id="bulk_upload_modal" tabindex="-1" aria-labelledby="bulkUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h5 class="modal-title" id="bulkUploadModalLabel">Bulk Upload</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="bulkUploadForm" enctype="multipart/form-data">
          <div class="form-group">
            <label for="uploadFile">Upload File</label>
            <input type="file" class="form-control" id="uploadFile" name="uploadFile" required>
          </div>
          <!-- Add any additional form fields here -->
          <!-- <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div> -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="uploadButton">Upload</button>
      </div>
    </div>
  </div>
</div>


         <!-- Modal -->
         <div class="modal fade" id="partImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color:white;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <center>
                        <!-- QR Code image will be loaded here -->
                        <td><img id="partImageUrl" style="border-radius:0px;" src="" alt="PartImage"></td>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



          <!-- Modal -->
          <div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
         <div class="modal fade" id="qrcodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Item's</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Supplier Form -->
                <form method="POST" action="{{ route('partsinv.store') }}" class="row" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <hr>
                            <h4>Item Detail's :</h4>
                            <hr>
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
                          <label for="category" class="form-label">{{ __('Category') }}<sup class="text-danger">*</sup></label>
                          <select id="category" class="form-control p-3" name="category" placeholder="" required autofocus>
                              <option value="">--Select Category--</option>
                              @foreach($categories as $category)
                              @if($category->parent_id == 0)
                              @php($label = $category->category_name)
                              @php($parent_id = $category->id)
                              @endif 
                              <optgroup label="{{$label}}">
                              @foreach($sub_categories as $subcategory)
                              @if($parent_id == $subcategory->parent_id)
                                  <option value="{{$subcategory->category_name}}">{{$subcategory->category_name}}</option>
                                  @endif
                              @endforeach
                              </optgroup>
                              @endforeach
                              <!-- Add more Bajaj bike types as needed -->
                          </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="part_number" class="form-label">{{ __('Item Code') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="part_number" class="form-control" name="part_number" value="VPTN_{{rand(0,999999)}}" placeholder="Part number will be auto generated by the system" required>
                        </div>

                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="serial_number" class="form-label">{{ __('Serial Number') }}<sup class="text-danger">*</sup></label>
                            <input id="serial_number" type="text" class="form-control" name="serial_number" value="{{rand(0,9999999999999)}}" placeholder="For serialized parts, a unique serial number assigned to each unit." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="part_name" class="form-label">{{ __('Name') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="part_name" class="form-control p-3" name="part_name" placeholder="Enter the name of the part" required autofocus>     
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="location" class="form-label">{{ __('Location') }}<sup class="text-danger">*</sup></label>
                            <input id="location" type="text" class="form-control" name="location" placeholder="The physical location within the warehouse or storage facility where the part is stored." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="shelf_number" class="form-label">{{ __('Bin/Shelf Number') }}<sup class="text-danger">*</sup></label>
                            <input id="shelf_number" type="text" class="form-control" name="shelf_number" placeholder="The specific bin or shelf number where the part is stored." required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                          <label for="availability" class="form-label">{{ __('Availability') }}</label>
                          <select id="availability" type="text" class="form-control p-3" name="availability">
                              <option value="">--Select--</option>
                              <option value="In Stock">In Stock</option>
                              <option value="Out Of Stock">Out Of Stock</option>
                          </select>
                        </div>


                        

                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="part_description" class="form-label">{{ __('Part Description') }}</label>
                            <textarea id="part_description" rows="4" cols="50" type="text" class="form-control" name="part_description" placeholder="A brief description of the part, including its name, type, and specifications."></textarea>
                        </div>


                        <!-- <div class="mb-3 col-md-6 col-lg-3">
                            <label for="reorder_point" class="form-label">{{ __('Reorder Point') }}</label>
                            <input id="reorder_point" type="text" class="form-control" name="reorder_point" placeholder="The minimum quantity of the part that triggers a reorder." required>
                        </div> -->

                        

                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="notes" class="form-label">{{ __('Notes') }}</label>
                            <textarea id="notes" type="text" rows="4" cols="50" class="form-control" name="notes" placeholder="Any additional notes or comments related to the part."></textarea>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="warranty_information" class="form-label">{{ __('Warranty Information') }}</label>
                            <textarea id="warranty_information" rows="4" cols="50" type="text" class="form-control" name="warranty_information" placeholder=" Warranty details for the part, including warranty period and terms."></textarea>
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


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="unit_cost" class="form-label">{{ __('Unit Cost') }}<sup class="text-danger">*</sup></label>
                            <input id="unit_cost" type="text" class="form-control" name="unit_cost" placeholder="The cost of purchasing one unit of the part." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="qty_on_hand" class="form-label">{{ __('Quantity On Hand') }}<sup class="text-danger">*</sup></label>
                            <input id="qty_on_hand" type="text" class="form-control" name="qty_on_hand" placeholder="The current quantity of the part available in inventory." required>
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

                        

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="compatability" class="form-label">{{ __('Compatability') }}</label>
                            <input id="compatability" type="text" class="form-control" name="compatability" placeholder="Compatibility information indicating which vehicles or models the part is compatible with." >
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="image" class="form-label">{{ __('Image') }}</label>
                            <input id="image" type="file" class="form-control" name="image">
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


                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="lead_time" class="form-label">{{ __('Delivery Date') }}</label>
                            <input id="lead_time" type="date" class="form-control" name="lead_time" placeholder=" The lead time or delivery time for replenishing the part from the supplier.">
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
