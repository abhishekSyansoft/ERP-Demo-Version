@include('admin.layout.header')
@include('admin.layout.navbar')

<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Edit Role
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Role <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card" style="margin:auto;">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit created role</h4>
                    <!-- <p class="card-description"> Add class <code>.table</code>
                    </p> -->
                    <form method="POST" action="{{ url('roles/update/'.$roles->id) }}">
                    @csrf
                      <div class="row">
                        <div class="col-md-12 row">
                            <div class="form-group col-lg-6">
                                <!-- <label for="module" class="form-check-label"> Module Name </label> -->
                                <input type="text" name="name" id="name" placeholder="Add new module enter module name" class="form-control" value="{{$roles->name}}">
                            </div>
                            <div class="col-lg-6">
                            <button class="btn btn-primary btn-md">Update</button>
                            <button class="btn btn-success btn-md">Back</button>
                            </div>
                        <div>  
                    </form>
                  </div>
                </div>
              </div>

            </div>
             
          </div>
</div>
</div>
</div>
          <!-- content-wrapper ends -->
@include('admin.layout.footer')


