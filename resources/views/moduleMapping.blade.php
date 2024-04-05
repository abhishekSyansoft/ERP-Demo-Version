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
                      <a href="{{route('add.mapping')}}" class="btn btn-primary btn-md">Add Module's</a>
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <table class="table table-hover table-bordered mt-2">
                        <tr>
                            <th>Id</th>
                            <th>Mapping Id</th>
                            <th>Module Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        @php($i=1)
                       @foreach($details as $detail)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$detail->mappingId}}</td>
                            <td>{{$detail->modulename}}</td>
                            <td>{{$detail->rolename}}</td>
                            <td>
                                <a href="{{url('Module/Delete/'.$detail->mappingId)}}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{$details->links()}}
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
