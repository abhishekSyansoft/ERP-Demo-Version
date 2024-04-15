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
              
            <div class="row mx-auto">
              <div class="col-md-12" style="margin:auto;">
                <div class="card mx-auto">
                  <div class="card-body mx-auto">
                    <div class="clearfix">
                         <!-- Button to open the modal -->
                         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                        Add Raw Material
                        </button>  
                        <hr>
                      <h4 class="card-title float-left">Raw Material Lists</h4>
                           
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                        Edit Supplier
                        </button>   -->

                        <!-- <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit Order &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button> -->
                        
                        
                <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div class="mx-auto">
                        <table class="table table-hover table-bordered mt-2 mx-auto">
                            <tr>
                                
                                <th>S No.</th>
                                <!-- <th>Module Id</th> -->
                                <th>Material Name</th>
                                <th>Material Description</th>
                                <th>Unit Of Measure</th>
                                <th>Lead Time</th>
                                <th>Safety Stock</th>
                                <th>Storage Condition</th>
                                <th>Shelf Life</th>
                                <th>Supplier</th>
                                <th>Cost_per_unit</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($rawmaterial as $material)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$material->material_name}}</td>
                                <td>{{$material->material_description}}</td>
                                <td>{{$material->unit_of_measure}}</td>
                                <td>{{$material->lead_time}}</td>
                                <td>{{$material->safety_stock}}</td>
                                <td>{{$material->storage_condition}}</td>
                                <td>{{$material->shelf_life}}</td>
                                <td>{{$material->supplier_name}}</td>
                                <td>{{$material->cost_per_unit}}</td>
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
                <form method="POST" action="{{ route('materials.store') }}" class="row">
                        @csrf

                        <div class="mb-3 col-md-6">
                            <label for="material_name" class="form-label">{{ __('Material Name') }}</label>
                            <input id="material_name" type="text" class="form-control" name="material_name" placeholder="Name of the raw material" required autofocus>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="material_description" class="form-label">{{ __('Material Description') }}</label>
                            <textarea id="material_description" class="form-control" name="material_description" placeholder="Description or additional details about the raw material" required></textarea>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="unit_of_measure" class="form-label">{{ __('Unit of Measure') }}</label>
                            <input id="unit_of_measure" type="text" class="form-control" name="unit_of_measure" placeholder="Unit of measure for the raw material (e.g., kg, liter)" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="lead_time" class="form-label">{{ __('Lead Time') }}</label>
                            <input id="lead_time" type="text" class="form-control" name="lead_time" placeholder="Lead time for ordering the raw material (in days)" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="safety_stock" class="form-label">{{ __('Safety Stock') }}</label>
                            <input id="safety_stock" type="text" class="form-control" name="safety_stock" placeholder="Safety stock level for the raw material" required>
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
