@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Purchase Requisition
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Purchase Requisition<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Purchase Requisition Lists</h4>
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
                        <table class="table mx-auto">
                            <tr>
                                <th>S No.</th>
                                <th>View Details</th>
                                <th>Department</th>
                                <th>User</th>
                                <th>Designation</th>
                                <th>Vendor</th>
                                <th>Requisition Date</th>
                                <th>Status</th>
                                <th>Request</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($pr as $data)
                            @for($a=1;$a<4;$a++)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a style="color:white;font-size:18px;background-color:#0081b6;border-radius:5px;" class="mdi mdi-eye p-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                                    <td>{{$data->department}}</td>
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->designation}}</td>
                                    <td>{{$data->vendor}}</td>
                                    <td>{{$data->requisition_date}}</td>
                                    <td style="color: {{ $data->status == 1 ? 'yellow' : ($data->status == 2 ? 'green' : ($data->status == 3 ? 'red' : '')) }}">
                                        {{ $data->status == 1 ? 'Pending' : ($data->status == 2 ? 'Approved' : ($data->status == 3 ? 'Rejected' : '')) }}
                                    </td>
                                    <td> {{ $data->status == 1 ? '' : ($data->status == 2 ? 'RFQ' : ($data->status == 3 ? '' : '')) }}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-pr/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-pr/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Purchase Requisition</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('pr.store')}}" class="row" id="PRAddModalForm">
                        @csrf


                        <div class="mb-3 col-md-6">
                            <label for="order_id" class="form-label">{{ __('Select Order Number For PR') }}</label>
                            <select  id="order_id"  class="form-control p-3" name="order_id" required>
                                <!-- <option value="">--Select Order Number--</option> -->
                                @foreach($orders as $order)
                                <option value="{{$order->id}}">{{$order->order_id}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="department" class="form-label">{{ __('Department') }}</label>
                            <select id="department"  class="form-control p-3" name="department" required>
                                <option value="0">--Select Department--</option>
                                <option value="HR Department">HR Department</option>
                                <option value="IT Department">IT Department</option>
                                <option value="Sales Department">Sales Department</option>
                                <option value="Service Department">Service Department</option>
                                <option value="Consultation Department">Consultation Department</option>
                            </select>
                        </div>

                        <center>
                        <table id="prItemListTable" class="col-md-11 table table-bordered mx-auto mb-3" style="width:100%;">
                              <tr>
                                <th>S no.</th>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <!-- <th>dummy</th> -->
                              </tr>
                              <tbody id="prItemList">
                                
                              </tbody>
                        </table>
                        </center>

                        <div class="mb-3 col-md-6">
                            <label for="quantity" class="form-label">{{ __('Quantity') }}</label>
                            <input type="text" id="quantity" class="form-control" name="quantity" placeholder="Enter quantity wanted to send for RFQ" required>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="user_id" class="form-label">{{ __('Person ') }}</label>
                            <select id="user_id"  class="form-control p-3" name="user_id" required>
                                <option value="0">--Select Person--</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="designation" class="form-label">{{ __('Designation') }}</label>
                            <select id="designation"  class="form-control p-3" name="designation" required>
                                <option value="0">--Select Product--</option>
                                @foreach($users as $user)
                                <option value="{{$user->designation}}">{{$user->designation}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="vendor" class="form-label">{{ __('Vendor') }}</label>
                            <select id="vendor"  class="form-control p-3" name="vendor" required>
                                <option value="0">--Select vendor--</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier->supplier_name}}">{{$supplier->supplier_name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="requisition_date" class="form-label">{{ __('Requisition Date') }}</label>
                            <input type="date" id="requisition_date" class="form-control" name="requisition_date" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select id="status" class="form-control p-3" name="status" required>
                                <option value="0">--Select Option--</option>
                                <option value="1">Pending</option>
                                <option value="2">Approved</option>
                                <option value="3">Rejected</option>
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
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Generated Orders</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body">

                   
                      <center><u> <h3>Purchase Requisition Detail's</h3></u></br></br></center>
                        
                              <h5><b>Items : </b></h5>
                              <table class="table table-bordered">
                                <tr>
                                  <th>S no.</th>
                                  <th>Item Code</th>
                                  <th>Item Name</th>
                                  <th>Unit</th>
                                </tr>
                                <tr>
                                 <td> 1</td>
                                 <td>7925</td>
                                 <td>Wheel</td>
                                 <td>17</td>
                                </tr>

                                <tr>
                                 <td> 2</td>
                                 <td>9232</td>
                                 <td>Meter</td>
                                 <td>12</td>
                                </tr>

                                <tr>
                                 <td> 3</td>
                                 <td>2342</td>
                                 <td>Handle</td>
                                 <td>20</td>
                                </tr>

                                <tr>
                                 <td> 4</td>
                                 <td>679</td>
                                 <td>Break Shoe</td>
                                 <td>2</td>
                                </tr>
                              </table>

                              <h5><b>Quantity : </b> {{uniqid()}}</h5>
                              <h5><b>Department : </b>HR Department</h5>
                              <h5><b>Designation : </b>Consultant</h5>
                              <h5><b>Requisition Date : </b> 2024-04-15</h5>
                              <h5><b>Status : </b> Processing</h5>
                              <center> 
                                <h4 style="color:blue;"><u>Click on image to print your Purchase Requisition</u></h4>
                                <a href="https://images.sampletemplates.com/wp-content/uploads/2017/04/Purchase-Requisition-Form-Sample.jpg" download>
                                  <img src="https://images.sampletemplates.com/wp-content/uploads/2017/04/Purchase-Requisition-Form-Sample.jpg" style="object-fit: contain; width: 50%;" alt="Image">
                              </a>        
                            </center>                      
                              <hr>


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
