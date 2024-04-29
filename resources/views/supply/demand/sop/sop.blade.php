@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Sales And Operations Planning
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Sales And Operations Planning<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Sales and Operations Planning Lists</h4>
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
                                <th>Product Name</th>
                                <th>Forcast Details</th>
                                <th>Production Detail</th>
                                <th>Sales Target</th>
                                <th>Production Target</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($sop as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->product_name}}</td>
                                    <td id="forecast_link"> 
                                        @php($encryptedId = encrypt($data->forecast_id))
                                        <a style="color:red;" href="{{url('view/'.$encryptedId)}}"><i class="mdi mdi-eye"></i></a>
                                    </td>
                                    <td>
                                    @php($encryptedId = encrypt($data->production_plan_id))
                                        <a style="color:red;" href="{{url('view-mps/'.$encryptedId)}}"><i class="mdi mdi-eye"></i></a>
                                    </td>
                                    <td>{{ $data->sales_target}}</td>
                                    <td>{{ $data->production_target}}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-sop/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-sop/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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


          <!-- Modal -->
            <div class="modal fade" id="forecastProductModal" tabindex="-1" aria-labelledby="forecastProductModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forecastProductModalLabel">Add Forecast Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <!-- Form to add or edit forecast product -->
                    <!-- You can customize this form according to your requirements -->
                    <div class="mb-3 col-md-6">
                            <label for="product_id" class="form-label">{{ __('Product') }}</label>
                            <select id="product_id"  class="form-control p-3" name="product_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="forecast_quantity" class="form-label">{{ __('Forecast Quantity') }}</label>
                            <input type="text" id="forecast_quantity" class="form-control" value="" name="forecast_quantity"  placeholder="Enter forecast quantity" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="forecast_date" class="form-label">{{ __('Forecast Date') }}</label>
                            <input type="date" id="forecast_date" class="form-control" name="forecast_date"  placeholder="Date for the capacity planning" required>
                        </div>

                    <!-- Add more input fields for other forecast product attributes -->
                    <!-- <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div> -->
                </form>
                </div>
                </div>
            </div>
            </div>


          
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSupplierModalLabel">Add Sales And Operations Planning</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('sop.store')}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="forecasting_id" class="form-label">{{ __('Demand Forecasting Product') }}</label>
                            <select id="forecasting_id"  class="form-control p-3" name="forecasting_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($forecastings as $forecasting)
                                <option value="{{$forecasting->id}}">{{$forecasting->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="production_plan_id" class="form-label">{{ __('Production Plan Product') }}</label>
                            <select id="production_plan_id"  class="form-control p-3" name="production_plan_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($productions as $production)
                                <option value="{{$production->id}}">{{$production->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="sales_target" class="form-label">{{ __('Sales Target') }}</label>
                            <input type="text" id="sales_target" class="form-control" name="sales_target"  placeholder="Enter the sales target" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="production_target" class="form-label">{{ __('Production Target') }}</label>
                            <input type="text" id="production_target" class="form-control" name="production_target"  placeholder="Enter the production Target" required>
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

          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
