@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Roles
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Roles <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
              
            <div class="row">
              <div class="col-md-12" style="margin:auto;">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">All Roles</h4>
                      <a href="{{route('add.role')}}" class="btn btn-primary btn-md">Add Role's</a>
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <table class="table table-hover table-bordered mt-2">
                        <tr>
                            <th>S. No.</th>
                            <th>Role Id</th>
                            <th>Role Name</th>
                            <th>Action</th>
                        </tr>
                        @php($i=1)
                        @foreach($roles as $role)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <a href="{{ url('roles/edit/'.$role->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ url('roles/delete/'.$role->id)}}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
           <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © SyanSoft 2024</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a href="" target="_blank">Module Master admin template</a> from Syansoft</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
@include('admin.layout.footer')
