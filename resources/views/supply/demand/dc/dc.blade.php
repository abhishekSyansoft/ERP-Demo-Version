@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Demand Collaboration
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Demand Collaboration<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        Create Demand Collaboration
                        </button>  
                        <hr>
                      <h4 class="card-title float-left">Demand Collaboration Lists</h4>
                           
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                        Edit Supplier
                        </button>   -->

                        <!-- <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit Order &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button> -->
                        
                        
                <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div class="">
                        <table class="table table-hover table-bordered mt-2 mx-auto"style="width: 100%;">
                            <tr>
                                <th>S No.</th>
                                <th>Product</th>
                                <th>Collaborator</th>
                                <th>Forecast Quantity</th>
                                <th>Collaboration Date</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($dc as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{ $data->product}}</td>
                                    <td>{{ $data->username}}</td>
                                    <td>{{ $data->forecast_quantity}}</td>
                                    <td>{{ $data->collaboration_date}}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-dc/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-dc/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
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
                    <h5 class="modal-title" id="forecastProductModalLabel">Add Demand Collaboration</h5>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Demand Collaboration</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('dc.store')}}" class="row">
                        @csrf
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
                            <label for="collabration_id" class="form-label">{{ __('Collabarator') }}</label>
                            <select id="collabration_id"  class="form-control p-3" name="collabration_id" required>
                                <option value="0">--Select colaborator--</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="forecast_quantity" class="form-label">{{ __('Forecast Quantity') }}</label>
                            <input type="text" id="forecast_quantity" class="form-control" name="forecast_quantity"  placeholder="Enter quantity" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="collaboration_date" class="form-label">{{ __('Collaboration Date') }}</label>
                            <input type="date" id="collaboration_date" class="form-control" name="collaboration_date"  placeholder="Enter the production Target" required>
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
