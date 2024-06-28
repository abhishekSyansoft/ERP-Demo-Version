@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Material Requirment Planning
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Matrial Requirment Planning<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;"> Matrial Requirment Planning Lists</h4>
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
                        <table class="table" style="width: 100%;">
                            <tr>
                                <th>S No.</th>
                                <th>View details</th>
                                <th>Material</th>
                                <th>Material ID</th>
                                <th>Quantity Required</th>
                                <th>Due Date</th>
                                <th>Order Type</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($mrp as $data)
                            @for($a=0;$a<3;$a++)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a class="mdi mdi-eye" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td>
                                    <td>{{$data->material}}</td>
                                    <td>{{uniqid()}}</td>
                                    <td>{{$data->quantity_required}}</td>
                                    <td>{{$data->due_date}}</td>
                                    <td>{{ $data->order_type == 1 ? 'Purchase Order' : ($data->order_type == 2 ? 'Manufacturing Order' : '') }}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-mrp/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-mrp/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                                        <a class="btn btn-success approvalBTN">Send for Approval</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Material Requirment Planning</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('mrp.store')}}" class="row mx-auto" id="mrpAddForm">
                        @csrf

                        <div class="mb-3 col-md-3">
                            <label for="order_type" class="form-label">{{ __('Order Type') }}</label>
                            <select id="order_type" class="form-control p-3" name="order_type" required>
                                <option value="0">--Select Option--</option>
                                <option value="1">Purchase Order</option>
                                <option value="2">manufacturing Order</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="quantity" class="form-label">{{ __('Product Manufacturing Volume') }}</label>
                            <input type="text" id="quantity" class="form-control" name="quantity" placeholder="Product quantity required for manufacturing">
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="material_id" class="form-label">{{ __('Product') }}</label>
                            <select id="material_id"  class="form-control p-3" name="material_id" required>
                                <option value="0">--Select Product--</option>
                                <!-- <option value="4">--Select Product--</option> -->
                                  @foreach($vehicles as $vehicle)
                                    <option value="{{$vehicle->vin}}">{{$vehicle->model}}</option>
                                  @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="product_id" class="form-label">{{ __('Product Id') }}</label>
                            <input type="text" id="product_id" class="form-control" name="product_id"  placeholder="Uniquie Identity for the product"></textarea>
                        </div>


                        <div class="mb-3 col-md-3">
                            <label for="due_date" class="form-label">{{ __('MRP Date') }}</label>
                            <input type="date" id="due_date" class="form-control" name="due_date" value="{{ now()->format('Y-m-d') }}" placeholder="Mention due date" required>
                        </div>

                        <div class="col-12">
                          <hr>
                          <h3>Bill If Materials :</h3>
                          <hr>
                        </div>

                        <center>
                        <div class="table-wrapper" style="height:auto;margin:0px !important;">
                        <table class="col-md-11 table table-bordered border-primary mx-auto mb-3" style="width:100%;text-align:left !important;">
                              <tr>
                                <th>Item Name</th>
                                <th>Item Code</th>
                                <th>Serial Number</th>
                                <th>Item Category</th>
                                <th>Quantity/Product</th>
                                <th>Unit Of Measure</th>
                                <th>Quantity/Total Product</th>
                                <th>Stock In Inventory</th>
                                <th>Forecasted Quantity</th>
                              </tr>

                              <tbody id="mrp_item_lists">

                              </tbody>
                        </table>
                        </div>
                        </center>


                       

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
                        <h5 class="modal-title" id="staticBackdropLabel">Material Requirement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body">
                       
                      <center><u> <h3>Material Requirment Detail's</h3></u></br></br></center>
                              <h5><b>Product Name : </b> Pulsar 125</h5>
                              <h5><b>Product Id : </b> 661ebc33576b12024-04-16 17:58:11</h5>
                              <h5><b>Items : </b> 
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
                            
                              </h5>
                              <h5><b>Quantity Required : </b> 250 units</h5>
                              <h5><b>Due Date : </b> 2024-04-15</h5>
                              <h5><b>Status : </b> Processing</h5>
                              <hr>

                        <div class="form-group mt-2">
                          <!-- <button type="submit" class="btn btn-success">Check one to edit</button> -->
                           <!-- <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                            Check one to edit
                            </button>   -->
                          <button type="button" class="btn btn-secondary">Close</button>
                        </div>
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
