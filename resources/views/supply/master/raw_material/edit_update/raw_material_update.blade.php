@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Update Material
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Material<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
        </nav>
    </div>
    <div>
    <div>
<div>
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Update Material :</h4>
            <!-- <hr> -->

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($rawmaterial->id))
           <form method="POST" action="{{ url('raw-material/update/'.$encryptedId)}}" class="row">
                        @csrf
                        <hr>
                        <h4>Material detail's :</h4>
                        <hr>
                        <div class="mb-3 col-md-6">
                            <label for="material_name" class="form-label">{{ __('Material Name') }}</label>
                            <input id="material_name" type="text" class="form-control" name="material_name" placeholder="Name of the raw material" value="{{$rawmaterial->material_name}}" required autofocus>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="material_description" class="form-label">{{ __('Material Description') }}</label>
                            <textarea id="material_description" class="form-control" name="material_description" placeholder="Description or additional details about the raw material" value="{{$rawmaterial->material_description}}" required>{{$rawmaterial->material_description}}</textarea>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="size" class="form-label">{{ __('Size') }}</label>
                            <input id="size" type="text" class="form-control" name="size" placeholder="Size of the raw material in number" value="{{$rawmaterial->size}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="unit_of_measure" class="form-label">{{ __('Unit') }}</label>
                            <input id="unit_of_measure" type="text" class="form-control" name="unit_of_measure" placeholder="Unit of measure for the raw material (e.g., kg, liter, meter)" value="{{$rawmaterial->unit}}" required>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="storage_condition" class="form-label">{{ __('Storage Condition') }}</label>
                            <input id="storage_condition" type="text" class="form-control" name="storage_condition" placeholder="Storage condition requirements for the raw material" value="{{$rawmaterial->storage_condition}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="shelf_life" class="form-label">{{ __('Shelf Life') }}</label>
                            <input id="shelf_life" type="text" class="form-control" name="shelf_life" placeholder="Shelf life of the raw material (in days)" value="{{$rawmaterial->shelf_life}}" required>
                        </div>

                        

                        <div class="mb-3 col-md-6">
                            <label for="supplier_id" class="form-label">{{ __('Supplier') }}</label>
                            <select id="supplier_id" class="form-control p-3" name="supplier_id" placeholder="" required>
                                <option value="0">--Select Supplier--</option>
                                @foreach($suppliers as $vendor)
                                <option value="{{$vendor->id}}"{{$vendor->id == $rawmaterial->supplier_id ? 'Selected':''}}>{{$vendor->supplier_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="cost_per_unit" class="form-label">{{ __('Cost Per Unit') }}</label>
                            <input id="cost_per_unit" type="text" class="form-control" name="cost_per_unit" placeholder="Cost per unit of the raw material" value="{{$rawmaterial->cost_per_unit}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="remarks" class="form-label">{{ __('Remarks') }}</label>
                            <input id="remarks" type="text" class="form-control" name="remarks" placeholder="Enter remark for this material" value="{{$rawmaterial->remarks}}" required>
                        </div>

                        <hr>
                        <h4>Stock detail's :</h4>
                        <hr>

                        <div class="mb-3 col-md-6 border-primary">
                            <label class="form-label"><strong>{{ __('Safety Stock :') }}</strong></label>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="safety_stock_quantity">Quantity</label>
                                <input type="text" name="safety_stock_quantity" id="safety_stock_quantity" placeholder="Enter safety stock quantity" value="{{$rawmaterial->safety_stock_quantity}}" class="form-control">
                              </div>
                              <div class="col-md-6">
                                <label for="safety_stock_amount">Amount</label>
                                <input type="text" name="safety_stock_amount" id="safety_stock_amount" placeholder="Enter safety stock Amount" value="{{$rawmaterial->safety_stock_amount}}" class="form-control">

                              </div>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6 border-primary">
                            <label class="form-label"><strong>{{ __('Last Month Stock :') }}</strong></label>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="this_month_stock_quantity">Quantity</label>
                                <input type="text" name="this_month_stock_quantity" id="this_month_stock_quantity" placeholder="Enter last month stock quantity" value="{{$rawmaterial->current_month_stock_quantity}}" class="form-control">
                              </div>
                              <div class="col-md-6">
                                <label for="this_month_stock_amount">Amount</label>
                                <input type="text" name="this_month_stock_amount" id="this_month_stock_amount" placeholder="Enter last month stock Amount" value="{{$rawmaterial->current_month_stock_amount}}" class="form-control">

                              </div>
                            </div>
                        </div>


                        <div class="mb-3 col-md-6 border-primary">
                            <label class="form-label"><strong>{{ __('Entering Warehouse This Month Stock :') }}</strong></label>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="entering_warehouse_this_month_stock_quantity">Quantity</label>
                                <input type="text" name="entering_warehouse_this_month_stock_quantity" id="entering_warehouse_this_month_stock_quantity" placeholder="Enter this month stock quantity entering warehouse" value="{{$rawmaterial->current_month_stock_quantity_entering_warehouse}}" class="form-control">
                              </div>
                              <div class="col-md-6">
                                <label for="entering_warehouse_this_month_stock_amount">Amount</label>
                                <input type="text" name="entering_warehouse_this_month_stock_amount" id="entering_warehouse_this_month_stock_amount" placeholder="Enter this month stock Amount entering warehouse" value="{{$rawmaterial->current_month_stock_amount_entering_warehouse}}" class="form-control">

                              </div>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6 border-primary">
                            <label class="form-label"><strong>{{ __('Out of Warehouse This Month Stock :') }}</strong></label>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="out_of_warehouse_this_month_stock_quantity">Quantity</label>
                                <input type="text" name="out_of_warehouse_this_month_stock_quantity" id="out_of_warehouse_this_month_stock_quantity" placeholder="Enter this month stock quantity out of warehouse" value="{{$rawmaterial->current_month_stock_quantity_out_warehouse}}" class="form-control">
                              </div>
                              <div class="col-md-6">
                                <label for="out_of_warehouse_this_month_stock_amount">Amount</label>
                                <input type="text" name="out_of_warehouse_this_month_stock_amount" id="out_of_warehouse_this_month_stock_amount" placeholder="Enter this month stock Amount out of warehouse" value="{{$rawmaterial->current_month_stock_amount_out_warehouse}}" class="form-control">

                              </div>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6 border-primary">
                            <label class="form-label"><strong>{{ __('Last Month Stock :') }}</strong></label>
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="last_month_stock_quantity">Quantity</label>
                                <input type="text" name="last_month_stock_quantity" id="last_month_stock_quantity" placeholder="Enter this month stock quantity" value="{{$rawmaterial->last_month_stock_quantity}}" class="form-control">
                              </div>
                              <div class="col-md-6">
                                <label for="last_month_stock_amount">Amount</label>
                                <input type="text" name="last_month_stock_amount" id="last_month_stock_amount" placeholder="Enter this month stock Amount" value="{{$rawmaterial->last_month_stock_amount}}" class="form-control">
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
            <!-- <p class="card-description"> Add class <code>.table</code>
            </p> -->
            </div>
        </div>
    </div>

    </div>
        
    </div>
</div>
</div>
</div>
          <!-- content-wrapper ends -->
@include('admin.layout.footer')

