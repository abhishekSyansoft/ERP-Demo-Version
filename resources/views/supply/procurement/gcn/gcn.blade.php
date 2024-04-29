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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">GRN Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                          @if(Auth::user()->admin==3)
                        <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>  
                        @endif
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
                        <table class="table" style="width: 100%;">
                            <tr>
                                <th>S No.</th>
                                <th>Preview</th>
                                <!-- <th>Attachment</th> -->
                                <th>PO no.</th>
                                <th>Invoice Number</th>
                                <th>QUT Number</th>
                                <!-- <th>Order Number</th> -->
                                <th>Received Date</th>
                                <th>Received Quantity</th>
                                <!-- <th>Status</th> -->
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($grn as $data)
                            @for($a=0;$a<10;$a++)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a class="mdi mdi-eye p-1" style="background-image:linear-gradient(to right, #283b96, #96a1d6);color:white;border-radius:5px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                                    <!-- <td><a class="mdi mdi-file" href="https://templatearchive.com/wp-content/uploads/2020/06/quotation-template-06-scaled.jpg" style="font-size:20px;color:red;"></a></td> -->
                                    <td>PO{{mt_rand(1000, 9999)}}</td>
                                    <td>Invoice_{{mt_rand(1000, 9999)}}</td>
                                    <td>QUT{{mt_rand(1000, 9999)}}</td>
                                    <td>{{$data->received_date}}</td>
                                    <td>{{$data->received_quantity}}</td>
                                    <!-- <td>Approved</td> -->
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                    @if(Auth::user()->admin==3)
                                        <a href="{{url('edit-grn/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                    @endif
                                        <a href="{{url('delete-grn/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Goods Recieving Note's</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('grn.store')}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="order_id" class="form-label">{{ __('Order Number') }}</label>
                            <select id="order_id"  class="form-control p-3" name="order_id" required>
                                <option value="0">--Select order number--</option>
                                @foreach($orders as $order)
                                <option value="{{$order->id}}">{{$order->order_id}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="received_date" class="form-label">{{ __('Received Date') }}</label>
                            <input type="date" id="received_date" class="form-control" name="received_date" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="received_quantity" class="form-label">{{ __('Received Quantity') }}</label>
                            <input type="text" id="received_quantity" class="form-control" name="received_quantity" required>
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
                        <h5 class="modal-title" id="staticBackdropLabel">Goods Receiving Note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body ">
                        <center><h2>Goods Receiving Note</h2></center>
                        <hr>

                      <table class="grn-table table table-bordered">
                          <tr>
                            <th><strong>Headings</strong></th>
                            <th><strong>Details</strong></th>
                          </tr>
                          <tr>
                            <td><strong>Supplier Information:</strong></td>
                            <td>Name: ABC Supplier<br>Contact: 123-456-7890</td>
                          </tr>
                          <tr>
                            <td><strong>Receiver Information:</strong></td>
                            <td>Name: John Doe<br>Contact: johndoe@example.com</td>
                          </tr>
                          <tr>
                            <td><strong>Goods Details:</strong></td>
                            <td>
                              <table class="table table-bordered p-2">
                                <tr><th>Item</th><th>Description</th><th>Quantity</th></tr>
                                <tr><td>Product A</td><td>Description of Product A</td><td>10</td></tr>
                                <tr><td>Product B</td><td>Description of Product B</td><td>5</td></tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td><strong>Purchase Order Information:</strong></td>
                            <td>PO Number: PO12345<br>Date: 2024-04-18</td>
                          </tr>
                          <tr>
                            <td><strong>Delivery Details:</strong></td>
                            <td>Date: 2024-04-18<br>Mode of Transportation: Truck</td>
                          </tr>
                          <!-- Add more details as needed -->
                        </table>
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
