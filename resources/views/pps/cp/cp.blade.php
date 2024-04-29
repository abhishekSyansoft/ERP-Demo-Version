@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Capacity Planning
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Capacity Planning<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Capacity Planning Lists</h4>
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
                                <th>Resource</th>
                                <th>Date</th>
                                <th>Shift</th>
                                <th>Capacity Available</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($cps as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->resource}}</td>
                                    <td>{{$data->date}}</td>
                                    <td>{{ $data->shift == 1 ? 'Morning' : ($data->shift == 2 ? 'Evening' : ($data->shift == 3 ? 'Night' : '')) }}</td>
                                    <td>{{ $data->capacity_available}}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-capacity-planning/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-capacity-planning/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Capacity Plan</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('capacity-planning.store')}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="resource_id" class="form-label">{{ __('Resource') }}</label>
                            <select id="resource_id"  class="form-control p-3" name="resource_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($resources as $resource)
                                <option value="{{$resource->id}}">{{$resource->resource_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="date" class="form-label">{{ __('Date') }}</label>
                            <input type="date" id="date" class="form-control" name="date"  placeholder="Date for the capacity planning" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="shift" class="form-label">{{ __('Shifts') }}</label>
                            <select id="shift" class="form-control p-3" name="shift" required>
                                <option value="0">--Select Option--</option>
                                <option value="1">Morning</option>
                                <option value="2">Evening</option>
                                <option value="2">Night</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="capacity_available" class="form-label">{{ __('Capacity Available') }}</label>
                            <input type="text" id="capacity_available" class="form-control" name="capacity_available"  placeholder="Current Available Capacity" required>
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
