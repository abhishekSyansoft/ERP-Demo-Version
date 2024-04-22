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
              
            <div class="row mx-auto">
              <div class="col-md-12" style="margin:auto;">
                <div class="card mx-auto">
                  <div class="card-body">
                    <div class="clearfix">
                         <!-- Button to open the modal -->
                         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                        Create Master Production Schedule
                        </button>  
                        <hr>
                      <h4 class="card-title float-left">Master Production Schedule Lists</h4>
                           
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                        Edit Supplier
                        </button>   -->

                        <!-- <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit 
                           &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button> -->
                        
                        
                <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div class="">
                        <table class="table table-hover table-bordered mt-2 mx-auto"style="width: 100%;">
                            <tr>
                                <th>S No.</th>
                                <th>View prodction Details</th>
                                <th>Product</th>
                                <th>Planned Quantity</th>
                                <th>Planned Start Date</th>
                                <th>Planned End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($mps as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a class="mdi mdi-eye" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                                    <td>{{$data->product}}</td>
                                    <td>{{$data->planned_quantity}}</td>
                                    <td>{{$data->planned_start_date}}</td>
                                    <td>{{$data->planned_end_date}}</td>
                                    <td>{{ $data->status == 1 ? 'Pending' : ($data->status == 2 ? 'Completed' : '') }}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-mps/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-mps/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
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
                            <label for="product_id" class="form-label">{{ __('Product') }}</label>
                            <select id="product_id"  class="form-control p-3" name="product_id" required>
                            <option value="4">Bajaj Pulsar</option>
                              <option value="4">Bajaj Dominar</option>
                              <option value="4">Bajaj Platina</option>
                              <option value="4">Bajaj Avenger</option>
                              <option value="4">Bajaj CT</option>
                              <option value="4">Bajaj Chetak</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 row">
                            <label for="items" class="form-label">{{ __('Items') }}</label>
                           <div class="col-md-10">
                           <select id="todoInput"  class="form-control p-3 col-md-8" name="items" required>
                                <option value="0">--Select Item--</option> 
                                <option value="engine">Engine</option>
                                  <option value="transmission">Transmission</option>
                                  <option value="brakes">Brakes</option>
                                  <option value="suspension">Suspension</option>
                                  <option value="steering">Steering</option>
                                  <option value="electrical system">Electrical System</option>
                                  <option value="cooling system">Cooling System</option>
                                  <option value="exhaust system">Exhaust System</option>
                                  <option value="fuel system">Fuel System</option>
                                  <option value="body parts">Body Parts</option>
                            </select>
                           </div>
                           <div class="col-md-2 m-0 p-0">
                              <a class="btn btn-primary" style="width:100%;" id="addBtn" class="p-2">Add</a>
                           </div>
                            <p id="todoList" class="row col-12"></p>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="conveyour_line" class="form-label">{{ __('Conveyor Line') }}</label>
                            <select id="conveyour_line"  class="form-control p-3" name="conveyour_line" required>
                                <option value="1">Conveyor Line 1</option>
                                <option value="2">Conveyor Line 2</option>
                                <option value="3">Conveyor Line 3</option>
                                <option value="4">Conveyor Line 4</option>
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



<!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">View Detail's</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body">

                             <center><u> <h3>Production Plan Details</h3></u></br></br></center>
                              <h5><b>Product Name : </b> Pulsar 125</h5>
                              <h5><b>Items : </b> 
                              <table class="table table-bordered">
                                <tr>
                                  <th>Item 1</th>
                                  <th>Item 2</th>
                                  <th>Item 3</th>
                                  <th>Item 4</th>
                                  <th>Item 5</th>
                                  <th>Item 6</th>
                                </tr>
                                <tr>
                                 <td>Seat</td>
                                 <td>Break Shoe</td>
                                 <td>Chain</td>
                                 <td>Engine</td>
                                 <td>Wheel</td>
                                 <td>Handle</td>
                              </table>
                            
                              </h5>
                              <h5><b>Conveyour Line : </b> Conveyour Line 5</h5>
                              <h5><b>Product Quantity : </b> 25 unit</h5>
                              <h5><b>Planned Start date : </b> 2024-04-15</h5>
                              <h5><b>Planned End date : </b> 2024-04-15</h5>
                              <h5><b>Status : </b> Processing</h5>
                              <hr>

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
