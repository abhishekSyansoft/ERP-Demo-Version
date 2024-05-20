@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Inventory Valuation & Reporting
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Inventory Valuation & Reporting<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;"> Inventory Valuation & Reporting Lists</h4>
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
                        <table class="table table-bordered border-primary" style="width: 100%;">
                            <tr>
                                <th rowspan="2">S No.</th>
                                <th rowspan="2">Inventory Id</th>
                                <th colspan="6">Item</th>
                                <th colspan="2">Valuation</th>
                                <th colspan="2">Inventory</th>
                                <th rowspan="2">Stock Aging</th>
                                <th rowspan="2">Financial Metrics</th>
                                <th colspan="4">Inventory</th>
                                <th rowspan="2">Comparision Metrics</th>
                                <th rowspan="2">CRR</th>
                                <th rowspan="2">Audit Trails</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <th>Part/Item number</th>
                              <th>Description</th>
                              <th>Product</th>
                              <th>Unit Cost</th>
                              <th>Quantity On Hand</th>
                              <th>Total Costs</th>
                              <th>Method</th>
                              <th>Date</th>
                              <th>Value</th>
                              <th>Turnover</th>
                              <th>Adjustments</th>
                              <th>Reserves</th>
                              <th>Analysis</th>
                              <th>Reports</th>
                            </tr>
                            @php($i=1)
                            @foreach($iv as $data)
                           
                                <tr>
                                <td>{{$i++}}</td>
                                <td>{{$data->inventory_id}}</td>
                                <td>{{$data->part_number}}</td>
                                <td>{{$data->description}}</td>
                                <td>{{$data->vehicle}}</td>
                                <td>{{number_format($data->unit_cost)}}</td> <!-- Assuming this is intentional -->
                                <td>{{number_format($data->qty_on_hand)}}</td>
                                <td>{{number_format($data->total_cost)}}</td>
                                <td>{{$data->valuation_method}}</td>
                                <td>{{$data->valuation_date}}</td>
                                <td>{{$data->inventory_value}}</td>
                                <td>{{$data->inventory_turnover}}</td>
                                <td>{{$data->stock_aging}}</td>
                                <td>{{$data->financial_metrics}}</td>
                                <td>{{$data->inventory_adjustments}}</td>
                                <td>{{$data->inventory_reserves}}</td>
                                <td>{{$data->inventory_analysis}}</td>
                                <td>{{$data->inventory_reports}}</td>
                                <td>{{$data->comparison_metrics}}</td>
                                <td>{{$data->compliance}}</td>
                                <td>{{$data->audit_trials}}</td>
                                   
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-iv/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-iv/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Inventory Valuation</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('iv.store')}}" class="row" id="TACForm">
                        @csrf

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_id" class="form-label">{{ __('Inventory ID') }}<sup class="text-danger">*</sup></label>
                            <input type="text" id="inventory_id" class="form-control" name="inventory_id" value="INVID_{{rand(0,999999)}}" placeholder="A unique identifier for each inventory item." required>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="part_number" class="form-label">{{ __('Item Code') }}<sup class="text-danger">*</sup></label>
                            <input list="part_number_list" id="part_number" class="form-control" name="part_number" placeholder="Part number will be auto generated by the system" required>
                            <datalist id="part_number_list">
                                @foreach($parts as $part)
                                    <option value="{{$part->part_number}}">
                                @endforeach
                                <!-- Add more options as needed -->
                            </datalist>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                        <label for="vehicle" class="form-label">{{ __('Product') }}<sup class="text-danger">*</sup></label>
                        <select id="vehicle" class="form-control p-3" name="vehicle" placeholder="" required autofocus>
                            <option value="">--Select Vehicle--</option>
                            <option value="pulsar">Pulsar</option>
                            <option value="discover">Discover</option>
                            <option value="platina">Platina</option>
                            <option value="avenger">Avenger</option>
                            <option value="dominar">Dominar</option>
                            <option value="ct_100">CT 100</option>
                            <option value="kratos">Kratos</option>
                            <!-- Add more Bajaj bike types as needed -->
                        </select>
                        </div>
        

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="unit_cost" class="form-label">{{ __('Unit Cost') }}<sup class="text-danger">*</sup></label>
                            <input id="unit_cost" type="text" class="form-control" name="unit_cost" placeholder="The cost of purchasing one unit of the part." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="qty_on_hand" class="form-label">{{ __('Quantity On Hand') }}<sup class="text-danger">*</sup></label>
                            <input id="qty_on_hand" type="text" class="form-control" name="qty_on_hand" placeholder="The current quantity of the part available in inventory." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="total_cost" class="form-label">{{ __('Total Cost') }}<sup class="text-danger">*</sup></label>
                            <input id="total_cost" type="text" class="form-control" name="total_cost" placeholder="The cost of purchasing overall unit of the part." required>
                        </div>

             
                        
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="valuation_method" class="form-label">{{ __('Valuation Method') }}</label>
                            <select id="valuation_method" class="form-control p-3" name="valuation_method" placeholder="The method used to value the inventory item (e.g., FIFO, LIFO, weighted average)." required autofocus>
                                <option value="">--Select Method--</option> 
                                <option value="FIFO">FIFO</option>
                                <option value="LIFO">LIFO</option>
                                <option value="Weighted Average">Weighted Average</option>
                            </select>
                        </div>


                        <!-- <div class="mb-3 col-md-6 col-lg-3">
                            <label for="manufacturer" class="form-label">{{ __('Manufacturer') }}</label>
                            <input type="text" id="manufacturer" class="form-control" name="manufacturer" placeholder="The manufacturer or brand of the part." required>
                        </div> -->


                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="valuation_date" class="form-label">{{ __('Valuation Date') }}<sup class="text-danger">*</sup></label>
                            <input id="valuation_date" type="date" class="form-control" name="valuation_date" placeholder="The date on which the inventory valuation is performed." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_value" class="form-label">{{ __('Inventory Value') }}<sup class="text-danger">*</sup></label>
                            <input id="inventory_value" type="text" class="form-control" name="inventory_value" placeholder="The total value of the inventory item on hand, calculated based on the unit cost and quantity on hand." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_turnover" class="form-label">{{ __('Inventory Turnover') }}<sup class="text-danger">*</sup></label>
                            <input id="inventory_turnover" type="text" class="form-control" name="inventory_turnover" placeholder="The rate at which inventory is sold and replaced over a specific period, calculated as the cost of goods sold divided by average inventory." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="stock_aging" class="form-label">{{ __('Stock Aging') }}<sup class="text-danger">*</sup></label>
                            <input id="stock_aging" type="text" class="form-control" name="stock_aging" placeholder="Analysis of the age of inventory items based on the time elapsed since receipt or purchase." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="financial_metrics" class="form-label">{{ __('Financial Metrics') }}<sup class="text-danger">*</sup></label>
                            <input id="financial_metrics" type="text" class="form-control" name="financial_metrics" placeholder="Financial metrics related to inventory management, such as inventory turnover ratio, days sales of inventory (DSI), and inventory carrying cost." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_adjustments" class="form-label">{{ __('Inventory Adjustments') }}<sup class="text-danger">*</sup></label>
                            <input id="inventory_adjustments" type="text" class="form-control" name="inventory_adjustments" placeholder="Any adjustments made to inventory quantities or values, such as write-offs, write-downs, or revaluations." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_reserves" class="form-label">{{ __('Inventory Reserves') }}<sup class="text-danger">*</sup></label>
                            <input id="inventory_reserves" type="text" class="form-control" name="inventory_reserves" placeholder="Reserves set aside to account for potential losses or obsolescence of inventory items." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_analysis" class="form-label">{{ __('Inventory Analysis') }}<sup class="text-danger">*</sup></label>
                            <input id="inventory_analysis" type="text" class="form-control" name="inventory_analysis" placeholder="Analysis of inventory data to identify trends, patterns, and opportunities for optimization." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="inventory_reports" class="form-label">{{ __('Inventory Reports') }}<sup class="text-danger">*</sup></label>
                            <input id="inventory_reports" type="text" class="form-control" name="inventory_reports" placeholder="Reports generated based on inventory data, including balance sheets, income statements, and inventory aging reports." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="comparison_metrics" class="form-label">{{ __('Comparison Metrics') }}<sup class="text-danger">*</sup></label>
                            <input id="comparison_metrics" type="text" class="form-control" name="comparison_metrics" placeholder="Metrics comparing current inventory levels and values to historical data or industry benchmarks." required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                          <label for="comlpiance" class="form-label">{{ __('CRR') }}<sup class="text-danger">*</sup></label>
                          <select id="comlpiance" type="text" class="form-control p-3" name="comlpiance" placeholder=": Compliance with accounting standards and regulatory requirements related to inventory valuation and reporting (e.g., GAAP, IFRS)." required>
                            <option value="">--Select--</option>
                            <option value="GAAP">GAAP</option>
                            <option value="IFRS">IFRS</option>
                          </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="audit_trials" class="form-label">{{ __('Audit Trials') }}<sup class="text-danger">*</sup></label>
                            <input id="audit_trials" type="text" class="form-control" name="audit_trials" placeholder="A log of changes made to inventory data, including dates, times, and users who made the changes." required>
                        </div>




                        <div class="col-12">
                        <hr>
                        <h4>Breif Detail's :</h4>
                        <hr>
                        </div>
                        
                        <div class="mb-3 col-md-6">
                            <label for="part_description" class="form-label">{{ __('Item Description') }}</label>
                            <textarea id="part_description" rows="4" cols="50" type="text" class="form-control" name="part_description" placeholder="A brief description of the part, including its name, type, and specifications."></textarea>
                        </div>

                        <div class="col-12"><hr></div>



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
