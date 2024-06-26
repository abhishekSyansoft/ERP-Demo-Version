@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Quality Control:
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Quality Control:<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Quality Control Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>  
                        </div>
                        <!-- <hr>   -->
                      </div>     
                       
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                                <th>Category Name</th>
                                <th>Inspection date</th>
                                <th>Result</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($qc as $data)
                            @for($a=0;$a<10;$a++)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{ $i % 2 == 0 ? 'Bajaj Pulsar' : 'Mahindra Thar' }}</td>
                                    <td>{{ $i % 2 == 0 ? 'Small Vehicle' : 'Large Vehicle' }}</td>
                                    <td>{{$data->inspection_date}}</td>
                                    <td>{{ $i % 2 == 0 ? 'Fail' : 'Pass' }}</td>
                                    <td>{{ $i % 2 == 0 ? 'Rework' : 'Rejected' }}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-qc/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-qc/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Quality Control</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('qc.store')}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="product_id" class="form-label">{{ __('Products') }}</label>
                            <select id="product_id"  class="form-control p-3" name="product_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="product_id" class="form-label">{{ __('Category') }}</label>
                            <select id="product_id"  class="form-control p-3" name="product_id" required>
                                <option value="0">--Select Category--</option>
                                <option >Small Vehicle</option>
                                <option >Medium Vehicle</option>
                                <option >Large Vehicle</option>
                               
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="inspection_date" class="form-label">{{ __('Inspection Date') }}</label>
                            <input type="date" id="inspection_date" class="form-control" name="inspection_date" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="result" class="form-label">{{ __('Result') }}</label>
                            <select id="result" class="form-control p-3" name="result" required>
                                <option value="0">--Select Option--</option>
                                <option value="1">Pass</option>
                                <option value="2">Fail</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="remarks" class="form-label">{{ __('Remarks') }}</label>
                            <input type="text" id="remarks" class="form-control" name="remarks" placeholder="Enetr your remarks" required>
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
                  <div class="modal-dialog  modal-lg">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Generated Orders</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body  mx-auto">             
                      <div class="mb-3 col-md-6">
                            <label for="product" class="form-label">{{ __(' ') }}</label>
                            @foreach($products as $product)
                            @if($product->id == 3)
                            <input type="text" id="product" value="{{$product->product_name}}" class="form-control" name="product"  required>
                            @endif
                            @endforeach
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="inspection_date" class="form-label">{{ __(' ') }}</label>
                            <input type="date" id="inspection_date" class="form-control" name="inspection_date" placeholder="Enter the negotiated price" required>
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
