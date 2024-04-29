@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Inventory Optimization management
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Inventory Optimization management<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Inventory Optimization Lists</h4>
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
                                <th>Product</th>
                                <th>Warehouse</th>
                                <th>Location</th>
                                <th>Assistant</th>
                                <th>Capacity</th>
                                <th>Item Inventory</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($io as $data)
                            @for($a=0;$a<9;$a++)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="pt-2 pb-2">{{ $i % 2 == 0 ? 'Bajaj Pulsar' : 'Mahindra Thar' }}</td>
                                    <td>{{ $i % 2 == 0 ? 'Warehouse 1' : 'Warehouse 2' }}</td>
                                    <td>{{ $i % 2 == 0 ? 'Gurugram' : 'Greater Noida' }}</td>
                                    <td>{{ $i % 2 == 0 ? 'Abhishek Kumar' : 'Priyanka Tamta' }}</td>
                                    <td>5,000</td>
                                    <td>{{$data->optimal_quantity}}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-io/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-io/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Inventory Optimization</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('io.store')}}" class="row">
                        @csrf

                        <div class="mb-3 col-md-6">
                            <label for="product_id" class="form-label">{{ __('Product') }}</label>
                            <select id="product_id" class="form-control p-3" name="product_id" required>
                            <option value="0">--Select product--</option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="warehouse" class="form-label">{{ __('Warehouse') }}</label>
                            <select id="warehouse" class="form-control p-3" name="warehouse" required>
                            <option value="0">Warehouse 1</option>
                            <option value="0">Warehouse 2</option>
                            </select>
                        </div>
                       

                        <div class="mb-3 col-md-6">
                            <label for="reorder_point" class="form-label">{{ __('Location') }}</label>
                            <input type="text" id="reorder_point" class="form-control" name="reorder_point" placeholder="Enter the Warehouse name" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="assistant" class="form-label">{{ __('Assistant') }}</label>
                            <input type="text" id="assistant" class="form-control" name="assistant" placeholder="Enter the Assistant name" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="optimal_quantity" class="form-label">{{ __('Capacity') }}</label>
                            <input type="text" id="optimal_quantity" class="form-control" name="optimal_quantity" placeholder="Enter the Warehouse location" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="item" class="form-label">{{ __('Item Inventory') }}</label>
                            <input type="text" id="item" class="form-control" name="item" placeholder="Enter the Item Inventory" required>
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
