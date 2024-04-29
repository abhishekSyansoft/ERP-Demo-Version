@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Master Production Schedule
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Master Production Schedule <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Master Production Schedule Lists</h4>
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

                        <!-- <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit 
                           &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button> -->
                        
                        
                <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <div class="table-wrapper">
                        <table class="table" style="width: 100%;">
                            <tr>
                                <th>S No.</th>
                                <th>View prodction Details</th>
                                <!-- <th>Product</th> -->
                                <th>Planned Quantity</th>
                                <th>Planned Start Date</th>
                                <th>Planned End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($mps as $data)
                            @for($a=0;$a<5;$a++)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a class="mdi mdi-eye checkMpsDetails" data-id="{{$data->id}}"></a></td>
                                    
                                    <td>{{$data->planned_quantity}}</td>
                                    <td>{{$data->planned_start_date}}</td>
                                    <td>{{$data->planned_end_date}}</td>
                                    <td>{{ $data->status == 1 ? 'Pending' : ($data->status == 2 ? 'Processing' : ($data->status == 3 ? 'Completed' : '')) }}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-mps/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-mps/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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


          
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSupplierModalLabel">Add Master Production Schedule</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('mps.store')}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="product_id" class="form-label">{{ __('Order Number') }}</label>
                            <select id="product_id"  class="form-control p-3" name="product_id" required>
                              <option value="0">--Select Order Number--</option>
                                @foreach($orders as $order)
                                  <option value="{{$order->id}}">{{$order->order_id}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="conveyour_line" class="form-label">{{ __('Conveyor Line') }}</label>
                            <select id="conveyour_line"  class="form-control p-3" name="conveyour_line" required>
                                <option value="Conveyor Line 1">Conveyor Line 1</option>
                                <option value="Conveyor Line 2">Conveyor Line 2</option>
                                <option value="Conveyor Line 3">Conveyor Line 3</option>
                                <option value="Conveyor Line 4">Conveyor Line 4</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="planned_quantity" class="form-label">{{ __('Planned Quantity') }}</label>
                            <input type="text" id="planned_quantity" class="form-control" name="planned_quantity" placeholder="Planned quantity for production purpose" required></textarea>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="planned_start_date" class="form-label">{{ __('Planned Start Date') }}</label>
                            <input type="date" id="planned_start_date" class="form-control" name="planned_start_date" placeholder="Planned quantity for production purpose" required>
                            </div>
                        <div class="mb-3 col-md-6">
                            <label for="planned_end_date" class="form-label">{{ __('Planned End Date') }}</label>
                            <input type="date" id="planned_end_date" class="form-control" name="planned_end_date" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select type="text" id="status" class="form-control p-3" name="status" required>
                                <option value="0">--Select status--</option>
                                <option value="1">Pending</option>
                                <option value="3">Processing</option>
                                <option value="2">Completed</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create') }}
                        </button>
                        </div>
                    </form>
                </div>
       </div>
            </div>
        </div>
        <!-- </div> -->
        <!-- </div> -->



<!-- Modal -->
<div class="modal fade" id="FetchMpsDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="FetchMpsDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg mx-auto">
            <div class="modal-content card mx-auto">
                <div class="modal-header">
                    <h5 class="modal-title" id="FetchMpsDetailsModalLabel">View Detail's</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <center><u><h3>Production Plan Details</h3></u></br></br></center>
                    <h5><b>Order Id : </b><span id="fetched_order_id"></span></h5>
                    <h5><b>Items : </b> 
                    <table class="table table-bordered" id="checkMpsTblBody">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Product Name</th>
                                <th>Unitprice</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Tax Rate</th>
                                <th>Tax Amount</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody id="checkMpsDetailstblBody"></tbody>
                    </table>

                    <div class="row mx-auto col-md-5 mt-3" style="float:right;">
                        <table class="table table-bordered table-hover">
                            <tbody class="">
                              <tr>
                                  <th>Total Amount</th>
                                  <td id="total_amount"></td>
                              </tr>
                              <tr>
                                  <th>Total Tax</th>
                                  <td id="total_tax"></td>
                              </tr>
                              <tr>
                                  <th>Total Discount</th>
                                  <td id="total_discount"></td>
                              </tr>
                              <tr>
                                  <th>Line Item Total</th>
                                  <td id="line_item_total"></td>
                              </tr>
                              </tbody>
                        </table>
                    </div>

                    </h5>
                    <h5><b>Conveyour Line : </b><span id="fetched_line"></span></h5>
                    <h5><b>Product Quantity : </b><span id="fetched_quantity"></span></h5>
                    <h5><b>Planned Start date : </b><span id="fetched_start_date"></span></h5>
                    <h5><b>Planned End date : </b><span id="fetched_end_date"></span></h5>
                    <h5><b>Status : </b><span id="fetched_status"></span></h5>
                    <hr>
                    <div class="form-group">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>                <!-- </div>
                  </div> -->
                <!-- </div> -->


          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
