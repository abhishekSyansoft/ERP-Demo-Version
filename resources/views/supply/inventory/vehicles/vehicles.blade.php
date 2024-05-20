@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Vehicles Inventory Management
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Vehicles Inventory Material <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Vehicles Inventory Lists</h4>
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
                        <table class="table table-bordered border-primary">

                            <tr>    
                                <th>S No.</th>
                                <th>VIN</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Color</th>
                                
                                <th>Mileage</th>
                                
                                <th>Price</th>
                                <th>Location</th>
                                <th>Status</th>
                                
                                <th>Image</th>
                                <th>Vehicle Identification Document</th>
                                <th>QR Code</th>
                                <th>Barcode</th>
                                <th>features</th>
                               
                                <th>Warranty Information</th>
                                
                                <th>Date Added</th>
                                <th>Last Updated</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($vehicles as $vehicle)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$vehicle->vin}}</td>
                                <td>{{$vehicle->model}}</td>
                                <td>{{$vehicle->year}}</td>
                                <td>{{$vehicle->color}}</td>
                                
                                <td>{{$vehicle->mileage}}</td>
                                <td>{{$vehicle->price}}</td>
                                <td>{{$vehicle->location}}</td>
                                <td>{{$vehicle->status}}</td>
                               
                                @if($vehicle->image)
                                <td><a id="vehiclesImage" class="mdi mdi-eye btn btn-primary" data-bs-target="#VehiclesImageModal" data-bs-toggle="modal" data-id="{{asset('Storage/'.$vehicle->image)}}"></a></td>
                                @else
                                <td></td>
                                @endif   
                                @if($vehicle->vehicles_identification_documents)
                                <td><a class="mdi mdi-file" style="font-size:20px;" href="{{asset('Storage/'.$vehicle->vehicles_identification_documents)}}"></a></td>
                                @else
                                <td></td>
                                @endif
                                @if($vehicle->qrcode)
                                <td><a class="mdi mdi-eye btn btn-primary" data-bs-target="#vehiclesQrcodeModal" data-bs-toggle="modal" data-qrcode="{{ asset('Storage/' . $vehicle->qrcode) }}"></a></td>
                                @else
                                <td><a class="vehicleQRCode btn btn-primary" style="text-decoration:none;" data-code-id="{{$vehicle->id}}">Generate QRCode</a></td>
                                @endif
                                @if($vehicle->barcode)
                                <td><a id="barcodeImage" class="mdi mdi-eye btn btn-primary" data-bs-target="#vehiclesBarcodeModal" data-bs-toggle="modal" data-barcode="{{asset('Storage/'.$vehicle->barcode)}}"></a></td>
                                @else
                                <td><a class="vehicleBarcode btn btn-primary" style="text-decoration:none;" data-barcode-id="{{$vehicle->id}}">Generate Barcode</a></td>
                                @endif   
                                <td>{{$vehicle->features}}</td>
                                
                                <td>{{$vehicle->warranty_information}}</td>
                               
                                <td>{{$vehicle->created_at}}</td>
                                <td>{{$vehicle->updated_at}}</td>
                                @php($encryptedId = encrypt($vehicle->id)) 
                                <td>
                                    <a href="{{url('edit-vinv/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{url('delete-vinv/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Vehicle</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Supplier Form -->
                <form method="POST" action="{{ route('vinv.store') }}" class="row" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <hr>
                            <h4>Vehicle's Detail's :</h4>
                            <hr>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="vin" class="form-label">{{ __('Vehile Identification Number') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="vin" class="form-control" name="vin" value="VIN_{{rand(0,999999)}}" placeholder="Vehicle Identification Number" required>
                        </div>
                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="model" class="form-label">{{ __('Model') }}<sup class="text-danger">*</sup></label>
                            <input id="model" type="text" class="form-control" name="model" placeholder="The specific model or series of the vehicle." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="year" class="form-label">{{ __('Year') }}<sup class="text-danger">*</sup></label>
                            <input type="date" id="year" class="form-control" name="year" placeholder="The manufacturing year of the vehicle." required autofocus>     
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="color" class="form-label">{{ __('Color') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="color" class="form-control" name="color" placeholder="The manufacturing year of the vehicle." required autofocus>     
                        </div>

                        <!-- <div class="mb-3 col-md-6 col-lg-3">
                            <label for="trim" class="form-label">{{ __('Trim') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="trim" class="form-control" name="trim" placeholder="The trim level or package" required autofocus>     
                        </div> -->

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="mileage" class="form-label">{{ __('Mileage') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="mileage" class="form-control" name="mileage" placeholder="The mileage or odometer reading of the vehicle." required autofocus>     
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="price" class="form-label">{{ __('Price') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="price" class="form-control" name="price" placeholder="The selling price of the vehicle." required autofocus>     
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="location" class="form-label">{{ __('Location') }}<sup class="text-danger">*</sup></label>
                            <input id="location" type="text" class="form-control" name="location" placeholder="The physical location within the warehouse or storage facility where the part is stored." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="status" class="form-label">{{ __('Status') }}<sup class="text-danger">*</sup></label>
                            <select id="status" class="form-control p-3" name="status" required autofocus>
                                <option value="">--The current status of the vehicle (e.g., available for sale or on hold)..--</option> 
                                <option value="sale">Available for sale</option>
                                <option value="hold">On Hold</option>
                            </select>
                        </div>

                        <!-- <div class="mb-3 col-md-6 col-lg-4">
                            <label for="availability" class="form-label">{{ __('Availability') }}<sup class="text-danger">*</sup></label>
                            <select id="availability" class="form-control p-3" name="availability" required autofocus>
                                <option value="">--:Information about the availability of the vehicle for test drives, inspections, and purchase.--</option> 
                                <option value="TestDrive">TestDrive</option>
                                <option value="Sales">Sales</option>
                                <option value="Purchase">Purchase</option>
                            </select>
                        </div> -->

                        <!-- <div class="mb-3 col-md-6 col-lg-4">
                            <label for="condition" class="form-label">{{ __('Condition') }}<sup class="text-danger">*</sup></label>
                            <select id="condition" class="form-control p-3" name="condition" required autofocus>
                                <option value="">--Select The condition or status of the part (e.g., new, used, refurbished).--</option> 
                                <option value="New">New</option>
                                <option value="Used">Used</option>
                                <option value="Refurbished">Refurbished</option>
                                
                            </select>
                        </div> -->

                        <!-- <div class="mb-3 col-md-6 col-lg-4">
                            <label for="history" class="form-label">{{ __('Vehicle History') }}</label>
                            <textarea id="history" rows="4" cols="50" type="text" class="form-control" name="history" placeholder="Information about the vehicle's history, including previous owners, service records, and accident history."></textarea>
                        </div> -->

                        <div class="mb-3 col-md-6">
                            <label for="features" class="form-label">{{ __('Features') }}</label>
                            <textarea id="features" rows="4" cols="50" class="form-control" name="features" placeholder="A list of features and options included with the vehicle (e.g., navigation system, leather seats, sunroof)."></textarea>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="warranty_information" class="form-label">{{ __('Warranty Information') }}</label>
                            <textarea id="warranty_information" rows="4" cols="50" class="form-control" name="warranty_information" placeholder=" Warranty details for the part, including warranty period and terms."></textarea>
                        </div>
                        
                        <!-- <div class="mb-3 col-md-6">
                            <label for="financial_information" class="form-label">{{ __('Financial Information') }}</label>
                            <textarea id="financial_information" rows="4" cols="50" class="form-control" name="financial_information" placeholder="Financing options, loan details, and payment plans associated with the vehicle."></textarea>
                        </div> -->

                        <!-- <div class="mb-3 col-md-6">
                            <label for="trade_in_information" class="form-label">{{ __('TradeIN Information') }}</label>
                            <textarea id="trade_in_information" rows="4" cols="50" class="form-control" name="trade_in_information" placeholder="Information about trade-in vehicles accepted for the purchase of the vehicle."></textarea>
                        </div> -->


                        <div class="mb-3 col-md-6">
                            <label for="image" class="form-label">{{ __('Vehicle Image') }}</label>
                            <input id="image" type="file" class="form-control" name="image">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="document" class="form-label">{{ __('Vehicle Identification Document') }}</label>
                            <input id="document" type="file" class="form-control" name="document">
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="min_stock_level" class="form-label">{{ __('Minimum Stock Level') }}<sup class="text-danger">*</sup></label>
                            <input id="min_stock_level" type="text" class="form-control" name="min_stock_level" placeholder="The minimum stock level for the part to ensure availability." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="max_stock_level" class="form-label">{{ __('Maximum Stock Level') }}<sup class="text-danger">*</sup></label>
                            <input id="max_stock_level" type="text" class="form-control" name="max_stock_level" placeholder="The maximum stock level for the part to ensure availability." required>
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
