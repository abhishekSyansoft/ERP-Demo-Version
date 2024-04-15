@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Stock Control:
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Stock Control:<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        Create Stock Control
                        </button>  
                        <hr>
                      <h4 class="card-title float-left"> Stock Control Lists</h4>
                           
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
                                <th>Quantity Available</th>
                                <th>location</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($sc as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->product}}</td>
                                    <td>{{$data->quantity_available}}</td>
                                    <td>{{$data->warehouse_name}} located in {{$data->location}}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-sc/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-sc/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Stock Control Management</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('sc.store')}}" class="row">
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
                            <label for="quantity_available" class="form-label">{{ __('Quantity Available') }}</label>
                            <input type="text" id="quantity_available" class="form-control" name="quantity_available" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="warehouse_id" class="form-label">{{ __('Warehouse & Location') }}</label>
                            <select id="warehouse_id" class="form-control p-3" name="warehouse_id" required>
                             <option value="0">--Select Warehouse with location--</option>
                            @foreach($warehouses as $warehouse)
                              <option value="{{$warehouse->id}}">{{$warehouse->warehouse_name}} located in {{$warehouse->location}}</option>
                              @endforeach
                            </select>
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
                                <th>Resource Name</th>
                                <th>Resource Description</th>
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
                <!-- </div>
                  </div> -->
                <!-- </div> -->


          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
