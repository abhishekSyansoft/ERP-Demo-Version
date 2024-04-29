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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;"> Create RFQ</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        @if(Auth::user()->admin == 3)
                        <a class="btn btn-primary p-2" href="{{route('send_rfq')}}" style="float:right;">
                            Submit
                        </a>  
                        @endif

                        @if(Auth::user()->admin == 4)
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
                            @if(Auth::user()->admin == 3)
                                <th></th>
                                @endif
                                <th>View</th>
                                
                                <th>Req No.</th>
                                <th>RFQ No.</th>
                                <th>QUT No.</th>
                                
                                <th>Product</th>
                                <th>Sub Category</th>
                                <th>Category</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Number</th>
                                @if(Auth::user()->admin == 3)
                                <th>Action</th>
                                @endif
                            </tr>
                            
                            @for($i=0;$i<10;$i++)

                            <tr>
                                @if(Auth::user()->admin == 3)
                                    <td><input type="checkbox"></td>
                                @endif
                                <td><a href="https://www.projectmanager.com/wp-content/uploads/2021/01/RFQ-Screenshot-600x508.jpg" style="background-image:linear-gradient(to right, #283b96, #96a1d6);color:white;border-radius:5px;" class="btn mdi mdi-eye p-2"></a></td>
                                <td>PR{{mt_rand(1000, 9999)}}</td>
                                <td>RFQ{{mt_rand(1000, 9999)}}</td>
                                <td>VEN{{mt_rand(1000, 9999)}}</td>
                               
                                <td>Bike</td>
                                <td></td>
                                <td>Vehicle</td>
                                <td>Item</td>
                                <td>21</td>
                                <td>28</td>
                                @if(Auth::user()->admin == 3)
                                <td>
                                    <a href="" class="btn btn-primary">Edit</a>
                                    <a href="" class="btn btn-danger">Delete</a>
                                </td>
                                @endif
                            </tr>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Material Requirment Planning</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('mrp.store')}}" class="row mx-auto">
                        @csrf

                        <div class="mb-3 col-md-6">
                            <label for="order_type" class="form-label">{{ __('Order Type') }}</label>
                            <select id="order_type" class="form-control p-3" name="order_type" required>
                                <option value="0">--Select Option--</option>
                                <option value="1">Purchase Order</option>
                                <option value="2">manufacturing Order</option>
                            </select>
                        </div>



                        <div class="mb-3 col-md-6">
                            <label for="material_id" class="form-label">{{ __('Product') }}</label>
                            <select id="material_id"  class="form-control p-3" name="material_id" required>
                                <option value="0">--Select Product--</option>
                                <!-- <option value="4">--Select Product--</option> -->
                                <option value="4">Bajaj Pulsar</option>
                                <option value="4">Bajaj Dominar</option>
                                <option value="4">Bajaj Platina</option>
                                <option value="4">Bajaj Avenger</option>
                                <option value="4">Bajaj CT</option>
                                <option value="4">Bajaj Chetak</option>
                            </select>
                        </div>


                        <!-- <div class="mb-3 col-md-6">
                            <label for="product_name" class="form-label">{{ __('Product Name') }}</label>
                            <input type="text" id="product_name" class="form-control" name="product_name" value="Laptop 2 in 1 touch"  required>
                        </div> -->

                        <div class="mb-3 col-md-6">
                            <label for="product_id_dummy" class="form-label">{{ __('Product Id') }}</label>
                            <input type="text" id="product_id_dummy" class="form-control" name="product_id_dummy" value="{{uniqid().Carbon\Carbon::now()}}"  placeholder="Quantity Required  for order" required></textarea>
                        </div>


                        <div class="mb-3 col-md-6 row">
                            <label for="items" class="form-label">{{ __('Items') }}</label>
                           <div class="col-md-10">
                           <select id="todoInputMR"  class="form-control p-3 col-md-8" name="items" required>
                                <option value="0">--Select Item--</option> 
                                <option value="4">Engine</option>
                                <option value="engine">Engine</option>
                                <option value="transmission">Transmission</option>
                                <option value="brakes">Brakes</option>
                                <option value="suspension">Suspension</option>
                                <option value="steering">Steering</option>
                                <option value="electrical">Electrical System</option>
                                <option value="cooling">Cooling System</option>
                                <option value="exhaust">Exhaust System</option>
                                <option value="fuel">Fuel System</option>
                                <option value="body">Body Parts</option>
                            </select>
                           </div>
                           <div class="col-md-2">
                              <a class="btn btn-primary" style="width:100%;" id="addBtninMR">Add</a>
                           </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="quantity_required" class="form-label">{{ __('Quantity Required') }}</label>
                            <input type="text" id="quantity_required" class="form-control" name="quantity_required"  placeholder="Quantity Required  for order" required></textarea>
                        </div>

                        <center>
                        <table id="todoListMR" class="col-md-11 table table-bordered mx-auto mb-3" style="width:100%;">
                              <tr>
                                <th>S no.</th>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Unit</th>
                                <!-- <th>dummy</th> -->
                              </tr>
                        </table>
                        </center>


                        <div class="mb-3 col-md-6">
                            <label for="due_date" class="form-label">{{ __('Due Date') }}</label>
                            <input type="date" id="due_date" class="form-control" name="due_date" placeholder="Mention due date" required>
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
