@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Inbound Outbound Logistic
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Order Fulfillment<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        Add Inbound Outbound Logistic
                        </button>  
                        <hr>
                      <h4 class="card-title float-left">Inbound Outbound Logistic Lists</h4>
                           
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                        Edit Supplier
                        </button>   -->

                        <!-- <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit Order &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button> -->
                        
                        
                <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div class="">
                        <table class="table table-hover table-bordered mt-2 mx-auto"style="width: 100%;">
                            <tr>
                                <th>S No.</th>
                                <th>Transport</th>
                                <th>Order_number</th>
                                <th>Received Date</th>
                                <th>Disapatched Date</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($iol as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->transport_mode == 1 ? 'Road' : ($data->transport_mode == 2 ? 'Rail' : ($data->transport_mode == 3 ? 'Air' : ($data->transport_mode == 4 ? 'Sea' : 'Not selected'))) }}</td>
                                    <td>{{$data->order_number}}</td>
                                    <td>{{$data->received_date}}</td>
                                    <td>{{$data->dispatched_date}}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-iol/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-iol/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Inbound Outbound Logistic</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('iol.store')}}" class="row">
                        @csrf

                        <div class="mb-3 col-md-6">
                            <label for="transport_id" class="form-label">{{ __('Warehouse') }}</label>
                            <select id="transport_id" class="form-control p-3" name="transport_id" required>
                            <option value="0">--Select Transport--</option>
                                @foreach($transports as $transport)
                                <option value="{{$transport->id}}">{{$transport->transport_mode == 1 ? 'Road' : ($transport->transport_mode == 2 ? 'Rail' : ($transport->transport_mode == 3 ? 'Air' : ($transport->transport_mode == 4 ? 'Sea' : 'Not selected'))) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="order_id" class="form-label">{{ __('Order Number') }}</label>
                            <select id="order_id" class="form-control p-3" name="order_id" required>
                            <option value="0">--Select order number--</option>
                                @foreach($orders as $order)
                                <option value="{{$order->id}}">{{$order->order_id}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="received_date" class="form-label">{{ __('Received date') }}</label>
                            <input type="date" id="received_date" class="form-control" name="received_date" placeholder="Enter the location to make a new network" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="dispatched_date" class="form-label">{{ __('Dispatched Date') }}</label>
                            <input type="date" id="dispatched_date" placeholder="Capacity of the warehouse" class="form-control" name="dispatched_date" required>
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
                                <th>Order Number</th>
                                <th>Fulfillment Date</th>
                                <th>Status</th>
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
