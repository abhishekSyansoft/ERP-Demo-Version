@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Supplier Quotation/Negotiation
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Supplier Quotation<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Supplier Quotation/Negotiation Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <!-- <button style="float:right;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>   -->
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
                        <table class="table mx-auto" style="width: 100%;">
                            <tr>
                                <th>S No.</th>
                               
                                <th>View</th>
                                <!-- <th>Create</th> -->
                                <th>Req No.</th>
                                <th>RFQ No.</th>
                                <th>QUT No.</th>
                                <th>Vendor Name.</th>
                                <th>Product</th>
                                <th>Sub Category</th>
                                <th>Category</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Number</th>
                                <th>Vendor Name</th>
                                <th>Price</th>
                                <th>Delivery Date</th>
                                <!-- <th>Neq Price</th>
                                <th>Neq Date</th> -->
                                <th>Status</th>
                                <th>Quotation PDF</th>
                                <th>Approval</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @for($a=0;$a<6;$a++)
                            @foreach($sqn as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    
                                    <td><a href="https://www.projectmanager.com/wp-content/uploads/2021/01/RFQ-Screenshot-600x508.jpg" style="background-image:linear-gradient(to right, #283b96, #96a1d6);color:white;border-radius:5px;" class="btn mdi mdi-eye p-2"></a></td>
                                    <td>PR{{mt_rand(1000, 9999)}}</td>
                                    <td>RFQ{{mt_rand(1000, 9999)}}</td>
                                    <td>VEN{{mt_rand(1000, 9999)}}</td>
                                    <td>Abhishek Kumar</td>
                                    <td>Bike</td>
                                    <td></td>
                                    <td>Vehicle</td>
                                    <td>Item</td>
                                    <td>21</td>
                                    <td>28</td>
                                   
                                    <td>{{$data->supplier}}</td>
                                    <td>Rs. {{mt_rand(1000, 9999)}}</td>
                                    <td>{{$data->valid_until}}</td>
                                    <!-- <td>Rs. {{mt_rand(1000, 9999)}}</td>
                                    <td>{{$data->valid_until}}</td> -->
                                    <td>
                                      <div class="dropdown">
                                        <a class="dropbtn" style="background-color:transparent;text-decoration:none;color:black;color:{{ $i % 2 == 0 ? 'Green' : 'Red' }}" onclick="toggleDropdown()">{{ $i % 2 == 0 ? 'Approved' : 'Rejected' }}</a>
                                        <div id="dropdownContent" class="dropdown-content">
                                          <a href="#" onclick="selectOption('Approved')">Approved</a>
                                          <a href="#" onclick="selectOption('Rejected')">Rejected</a>
                                          <a href="#" onclick="selectOption('Pending')">Pending</a>
                                          <!-- Add more options as needed -->
                                        </div>
                                      </div>
                                    </td>
                                  
                                    <td><h3><a style="color:red;" href="https://i.pinimg.com/originals/d5/eb/40/d5eb400220228d1ad2f285563e9ef221.jpg" class="mdi mdi-file"></a></h3></td>
                                    <td><a class="btn btn-success appr">Send</a></td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-sqn/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-sqn/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            @endfor
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Supplier Quotation/Negotiation</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('sqn.store')}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="supplier_id" class="form-label">{{ __('Supplier') }}</label>
                            <select id="supplier_id"  class="form-control p-3" name="supplier_id" required>
                                <option value="0">--Select Supplier--</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="item_id" class="form-label">{{ __('Item') }}</label>
                            <select id="item_id"  class="form-control p-3" name="item_id" required>
                                <option value="0">--Select Item--</option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="price" class="form-label">{{ __('Price') }}</label>
                            <input type="text" id="price" class="form-control" name="price" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="valid_until" class="form-label">{{ __('Valid Until') }}</label>
                            <input type="date" id="valid_until" class="form-control" name="valid_until" required>
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
                        <h5 class="modal-title" id="staticBackdropLabel">Comparision of Quotations</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body compare">

                     <center> <h2>Quotation Comparison</h2></center>

                        <table class="table table-bordered table-hover">
                            <tr>
                              <th>Details</th>
                              <th>Quotation A</th>
                              <th>Quotation B</th>
                              <th>Quotation C</th>
                            </tr>
                            <tr>
                              <td>Price</td>
                              <td>$1000</td>
                              <td>$1200</td>
                              <td>$1100</td>
                            </tr>
                            <tr>
                              <td>Delivery Time</td>
                              <td>2 weeks</td>
                              <td>1 week</td>
                              <td>3 weeks</td>
                            </tr>
                            <tr>
                              <td>Quality</td>
                              <td>High</td>
                              <td>Medium</td>
                              <td>High</td>
                            </tr>
                            <tr>
                              <td>Payment Terms</td>
                              <td>50% advance, 50% on delivery</td>
                              <td>Full payment on delivery</td>
                              <td>30% advance, 70% on delivery</td>
                            </tr>
                            <tr>
                              <td>Customer Service</td>
                              <td>Excellent</td>
                              <td>Good</td>
                              <td>Average</td>
                            </tr>
                          <!-- Add more rows for other details -->
                        </table>

                        <table class="table table-bordered mt-2">
                          <tr>
                            <th>Serial Number</th>
                            <th>Quotation Number</th>
                            <th>Quotation Name</th>
                            <th>Action</th>
                          </tr>
                          <tr>
                            <td>1</td>
                            <td>{{uniqid().uniqid()}}</td>
                            <td>Quotation 1</td>
                            <td>
                              <a class="btn btn-success appr">Send for Approval</a>
                              <a class="btn btn-info nego">Negotiation</a>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>{{uniqid().uniqid()}}</td>
                            <td>Quotation 2</td>
                            <td>
                              <a class="btn btn-success appr">Send for Approval</a>
                              <a class="btn btn-info nego">Negotiation</a>
                            </td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>{{uniqid().uniqid()}}</td>
                            <td>Quotation 3</td>
                            <td>
                              <a class="btn btn-success appr">Send for Approval</a>
                              <a class="btn btn-info nego">Negotiation</a>
                            </td>
                          </tr>

                        </table>
                        <div class="form-group mt-2">
                          <!-- <button type="submit" class="btn btn-success">Check one to edit</button> -->
                           <!-- <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                            Check one to edit
                            </button>   -->
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
