@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Raw Material Management
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Raw Material <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Raw Material Lists</h4>
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
                                
                                <th rowspan="2">S No.</th>
                                <th rowspan="2">Product</th>
                                <th rowspan="2">Item Name</th>
                                <th rowspan="2">Item Description</th>
                                <th rowspan="2">Cost Per Unit</th>
                                <th rowspan="2">Storage condition</th>
                                <th rowspan="2">Shelf Life</th>
                                <th rowspan="2">Size</th>
                                <th rowspan="2">Unit</th>
                                <th rowspan="2">Supplier Name</th>
                                <th rowspan="1" colspan="2">Safety Stock</th>
                                <th rowspan="1" colspan="2">Current Month Stock</th>
                                <!-- <th>Safety Stock</th> -->
                                <th rowspan="1" colspan="2">Stock entering Warehouse in current month</th>
                                <th rowspan="1" colspan="2">Stock out Of Warehouse in current Month</th>
                                <th rowspan="1" colspan="2">Current Month Stock</th>
                                <th rowspan="2">Remarks</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                                
                                <!-- <th></th> -->
                                <!-- <th>Module Id</th> -->
                                <!-- <th></th>
                                <th></th>
                                <th></th>
                                <th></th> -->
                                <th rowspan="1" colspan="1">Quantity</th>
                                <th rowspan="1" colspan="1">Amount</th>
                                <th rowspan="1" colspan="1">Quantity</th>
                                <th rowspan="1" colspan="1">Amount</th>
                                <!-- <th>Safety Stock</th> -->
                                <th rowspan="1" colspan="1">Quantity</th>
                                <th rowspan="1" colspan="1">Amount</th>
                                <th rowspan="1" colspan="1">Quantity</th>
                                <th rowspan="1" colspan="1">Amount</th>
                                <th rowspan="1" colspan="1">Quantity</th>
                                <th rowspan="1" colspan="1">Amount</th>
                                <!-- <th></th> -->
                                <!-- <th></th> -->
                               
                            </tr>

                            @php($i=1)
                            @foreach($rawmaterial as $material)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$material->material_name}}</td>
                              <td>{{$material->item}}</td>
                              <td>{{$material->material_description}}</td>
                              <td>{{$material->cost_per_unit}}</td>
                              <td>{{$material->storage_condition}}</td>
                              <td>{{$material->shelf_life}}</td>
                              <td>{{$material->size}}</td>
                              <td>{{$material->unit}}</td>
                              <td>{{$material->supplier_name}}</td>
                              <td>{{$material->safety_stock_quantity}}</td>
                              <td>{{$material->safety_stock_amount}}</td>
                              <td>{{$material->current_month_stock_quantity}}</td>
                              <td>{{$material->current_month_stock_amount}}</td>
                              <td>{{$material->current_month_stock_quantity_entering_warehouse}}</td>
                              <td>{{$material->current_month_stock_amount_entering_warehouse}}</td>
                              <td>{{$material->current_month_stock_quantity_out_warehouse}}</td>
                              <td>{{$material->current_month_stock_amount_out_warehouse}}</td>
                              <td>{{$material->last_month_stock_quantity}}</td>
                              <td>{{$material->last_month_stock_amount}}</td>
                              <td>{{$material->remarks}}</td>
                              @php($encryptedId = encrypt($material->id)) 
                                <td>
                                    <a href="{{url('edit-material/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{url('delete-material/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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


          
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSupplierModalLabel">Add Raw Material</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Supplier Form -->
                <form method="POST" action="{{ route('materials.store') }}" class="row" id="rawMaterialForm">
                        @csrf

                        <hr>
                        <h4>Material detail's :</h4>
                        <hr>
                        <div class="mb-3 col-md-6">
                            <label for="material_name" class="form-label">{{ __('Product') }}</label>
                            <select id="material_name" class="form-control p-3" name="material_name" required autofocus>
                              <option value="">--Select--</option>
                              @foreach($categories as $category)
                                  <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                              @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="item" class="form-label">{{ __('Item') }}</label>
                            <select id="item" class="form-control p-3" name="item" required autofocus>
                              <option value="">--Select--</option>
                              @foreach($products as $product)
                              <option value="{{$product->product_name}}">{{$product->product_name}}</option>
                              @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="material_description" class="form-label">{{ __('Item Description') }}</label>
                            <textarea id="material_description" class="form-control" name="material_description" placeholder="Description or additional details about the raw material" required></textarea>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="size" class="form-label">{{ __('Size') }}</label>
                            <input id="size" type="text" class="form-control" name="size" placeholder="Size of the raw material in number" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="unit_of_measure" class="form-label">{{ __('Unit') }}</label>
                            <input id="unit_of_measure" type="text" class="form-control" name="unit_of_measure" placeholder="Unit of measure for the raw material (e.g., kg, liter, meter)" required>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="storage_condition" class="form-label">{{ __('Storage Condition') }}</label>
                            <input id="storage_condition" type="text" class="form-control" name="storage_condition" placeholder="Storage condition requirements for the raw material" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="shelf_life" class="form-label">{{ __('Shelf Life') }}</label>
                            <input id="shelf_life" type="text" class="form-control" name="shelf_life" placeholder="Shelf life of the raw material (in days)" required>
                        </div>

                        

                        <div class="mb-3 col-md-6">
                            <label for="supplier_id" class="form-label">{{ __('Supplier') }}</label>
                            <select id="supplier_id" class="form-control p-3" name="supplier_id" placeholder="" required>
                                <option value="0">--Select Supplier--</option>
                                @foreach($supplier as $vendor)
                                <option value="{{$vendor->id}}">{{$vendor->supplier_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="cost_per_unit" class="form-label">{{ __('Cost Per Unit') }}</label>
                            <input id="cost_per_unit" type="text" class="form-control" name="cost_per_unit" placeholder="Cost per unit of the raw material" required>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="remarks" class="form-label">{{ __('Remarks') }}</label>
                            <input id="remarks" type="text" class="form-control" name="remarks" placeholder="Enter remark for this material" required>
                        </div>

                        <hr>
                        <h4>Stock detail's :</h4>
                        <hr>

                        <div class="mb-3 col-md-6 border-primary">
                            <label class="form-label"><strong>{{ __('Safety Stock :') }}</strong></label>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="safety_stock_quantity">Quantity</label>
                                <input type="text" name="safety_stock_quantity" id="safety_stock_quantity" placeholder="Enter safety stock quantity" class="form-control">
                              </div>
                              <div class="col-md-6">
                                <label for="safety_stock_amount">Amount</label>
                                <input type="text" name="safety_stock_amount" id="safety_stock_amount" placeholder="Enter safety stock Amount" class="form-control">

                              </div>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6 border-primary">
                            <label class="form-label"><strong>{{ __('Last Month Stock :') }}</strong></label>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="this_month_stock_quantity">Quantity</label>
                                <input type="text" name="this_month_stock_quantity" id="this_month_stock_quantity" placeholder="Enter last month stock quantity" class="form-control">
                              </div>
                              <div class="col-md-6">
                                <label for="this_month_stock_amount">Amount</label>
                                <input type="text" name="this_month_stock_amount" id="this_month_stock_amount" placeholder="Enter last month stock Amount" class="form-control">

                              </div>
                            </div>
                        </div>


                        <div class="mb-3 col-md-6 border-primary">
                            <label class="form-label"><strong>{{ __('Entering Warehouse This Month Stock :') }}</strong></label>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="entering_warehouse_this_month_stock_quantity">Quantity</label>
                                <input type="text" name="entering_warehouse_this_month_stock_quantity" id="entering_warehouse_this_month_stock_quantity" placeholder="Enter this month stock quantity entering warehouse" class="form-control">
                              </div>
                              <div class="col-md-6">
                                <label for="entering_warehouse_this_month_stock_amount">Amount</label>
                                <input type="text" name="entering_warehouse_this_month_stock_amount" id="entering_warehouse_this_month_stock_amount" placeholder="Enter this month stock Amount entering warehouse" class="form-control">

                              </div>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6 border-primary">
                            <label class="form-label"><strong>{{ __('Out of Warehouse This Month Stock :') }}</strong></label>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="out_of_warehouse_this_month_stock_quantity">Quantity</label>
                                <input type="text" name="out_of_warehouse_this_month_stock_quantity" id="out_of_warehouse_this_month_stock_quantity" placeholder="Enter this month stock quantity out of warehouse" class="form-control">
                              </div>
                              <div class="col-md-6">
                                <label for="out_of_warehouse_this_month_stock_amount">Amount</label>
                                <input type="text" name="out_of_warehouse_this_month_stock_amount" id="out_of_warehouse_this_month_stock_amount" placeholder="Enter this month stock Amount out of warehouse" class="form-control">

                              </div>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6 border-primary">
                            <label class="form-label"><strong>{{ __('Last Month Stock :') }}</strong></label>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="last_month_stock_quantity">Quantity</label>
                                <input type="text" name="last_month_stock_quantity" id="last_month_stock_quantity" placeholder="Enter this month stock quantity" class="form-control">
                              </div>
                              <div class="col-md-6">
                                <label for="last_month_stock_amount">Amount</label>
                                <input type="text" name="last_month_stock_amount" id="last_month_stock_amount" placeholder="Enter this month stock Amount" class="form-control">

                              </div>
                            </div>
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
