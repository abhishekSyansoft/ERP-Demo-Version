@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Modules
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Modules <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
              
            <div class="row">
              <div class="col-md-12" style="margin:auto;">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">All Modules</h4>
                      
                      


                            <!-- Button to trigger the modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#moduleMappingModal">
                            Open Module Mapping Modal
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="moduleMappingModal" tabindex="-1" aria-labelledby="moduleMappingModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="moduleMappingModalLabel">Module Mapping</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <!-- Your module mapping form or content goes here -->
                                    <form id="moduleMappingForm" class="row" method="POST" action="{{route('store.data')}}">
                                    @csrf
                                    <!-- Form fields for module mapping -->
                                    <div class="mb-3 col-md-6">
                                        <label for="moduleSelect" class="form-label">Select Module:</label>
                                        <select class="form-select" id="moduleSelect" name="moduleSelect">
                                        @foreach($details as $detail2)
                                            <option value="{{$detail2->id}}">{{$detail2->parent_module}}</option>
                                         @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="roleSelect" class="form-label">Select Role:</label>
                                        <select class="form-select" id="roleSelect" name="roleSelect">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                         @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="status" class="form-label">Select Status:</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="0">--Select Status--</option>
                                            <option value="1">Active</option>
                                            <option value="2">In-Active</option>
                                        </select>
                                    </div>
                                    <!-- Other form fields for mapping -->
                                    <!-- For example: -->
                                    <div class="mb-3 col-md-6">
                                        <label for="order_number" class="form-label">Order Number</label>
                                        <input type="number" class="form-control" id="order_number" name="order_number">
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="submit" class="btn btn-primary" id="saveModuleMapping">Save Changes</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>




                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <table class="table table-hover table-bordered mt-2">
                        <tr>
                            <th>Id</th>
                            <th>Parent Module Name</th>
                            <th>Role</th>
                            <th>Order Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @php($i=1)
                       @foreach($details3 as $detail)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$detail->parent_module}}</td>
                            <td>{{$detail->rolename}}</td>
                            <td>{{$detail->order_no}}</td>
                            <td>{{($detail->status == 1 ? 'Active' : ($detail->status == 2 ? 'In-Active' : ($detail->status ==  0 ? 'Not Selected' : '')))}}</td>
                            <td>
                                @php($encryptedID = encrypt($detail->id))
                                <a href="{{'edit/parent/'.$encryptedID}}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{'delete/parent/'.$encryptedID}}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                   {{$details3->links()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          
        <!-- main-panel ends -->
@include('admin.layout.footer')
