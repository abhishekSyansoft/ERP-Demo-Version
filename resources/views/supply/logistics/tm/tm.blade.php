@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Transportstion Management
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Transportstion Management<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        Create Transportstion Management
                        </button>  
                        <hr>
                      <h4 class="card-title float-left">Transportstion Management Lists</h4>
                           
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                        Edit Supplier
                        </button>   -->

                        <!-- <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit Order &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button> -->
                        
                        
                <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div class="">
                        <table class="table table-hover table-bordered mt-2 mx-auto"style="width: 100%;">
                            <tr>
                                <th>S No.</th>
                                <th>Tranportation Mode</th>
                                <th>Departure Location</th>
                                <th>Arrival Location</th>
                                <th>Departure Date</th>
                                <th>Arrival Date</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($tm as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->transport_mode == 1 ? 'Road' : ($data->transport_mode == 2 ? 'Rail' : ($data->transport_mode == 3 ? 'Air' : ($data->transport_mode == 4 ? 'Sea' : 'Not selected'))) }}</td>
                                    <td>{{$data->departure_location}}</td>
                                    <td>{{$data->arrival_location}}</td>
                                    <td>{{$data->departure_date}}</td>
                                    <td>{{$data->arrival_date}}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-tm/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-tm/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Inventory Optimization</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('tm.store')}}" class="row">
                        @csrf

                        <div class="mb-3 col-md-6">
                            <label for="tranport_mode" class="form-label">{{ __('Transport Mode') }}</label>
                            <select id="tranport_mode" class="form-control p-3" name="tranport_mode" required>
                                <option value="0">--Select product--</option>
                                <option value="1">Road</option>
                                <option value="2">Rail</option>
                                <option value="3">Air</option>
                                <option value="4">Sea</option>
                            </select>
                        </div>
                       

                        <div class="mb-3 col-md-6">
                            <label for="departure_location" class="form-label">{{ __('Departure Location') }}</label>
                            <input type="text" id="departure_location" class="form-control" name="departure_location" placeholder="Enter Departure Location" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="arrival_location" class="form-label">{{ __('Arrival Location') }}</label>
                            <input type="text" id="arrival_location" class="form-control" name="arrival_location" placeholder="Enter the Warehouse location" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="departure_date" class="form-label">{{ __('Departure Date') }}</label>
                            <input type="date" id="departure_date" class="form-control" name="departure_date" placeholder="Enter the Warehouse location" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="arrival_date" class="form-label">{{ __('Arrival Date') }}</label>
                            <input type="date" id="arrival_date" class="form-control" name="arrival_date" placeholder="Enter the Warehouse location" required>
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
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Generated Orders</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body  mx-auto">

                  
                      <form method="GET" action="" id="edit_supplier_form">
                      <table class="table table-hover table-bordered mt-2">
                            <tr>
                                <th>S No.</th>
                                <th>Product</th>
                                <th>Reorder Point</th>
                                <th>Optimal quantity</th>
                                <th>Action</th>
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
                <!-- </div>
                  </div> -->
                <!-- </div> -->


          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
