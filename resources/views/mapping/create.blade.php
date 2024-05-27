@include('admin.layout.header')
@include('admin.layout.navbar')

<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Add Module Mapping
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Module Mapping <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
              <!-- <div>
                        <div>
                        <div> -->
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">New module mapping</h4>
                    <hr>
                    <!-- <p class="card-description"> Add class <code>.table</code>
                    </p> -->
                    <form method="POST" action="{{ route('store.mapping') }}">
                    @csrf
                      <div class="row">
                        <div class="col-md-12 row">
                            <div class="form-group col-lg-6">
                                <label for="modules">Module Mapping</label>
                                <select name="module" class="form-control p-3">
                                @foreach($module as $modules)
                                        <option value="{{$modules->id}}">{{$modules->name}}</option>
                                     @endforeach 
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="role"> Role</label>
                                <select name="role" class="form-control p-3">
                                    @foreach($role as $roles)
                                        <option value="{{$roles->id}}">{{$roles->name}}</option>
                                     @endforeach  
                                </select>
                            </div>
                            <div class="col-lg-12">
                            <button class="btn btn-primary btn-md">Submit</button>
                            <button class="btn btn-success btn-md" onClick="back();">Back</button>
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