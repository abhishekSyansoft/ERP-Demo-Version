@include('admin.layout.header')
@include('admin.layout.navbar')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
          <i class="mdi mdi-home"></i>
        </span> Edit Module
      </h3>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
          </li>
        </ul>
      </nav>
    </div>
    <!-- <div> -->
                        <!-- <div> -->
                        <!-- <div> -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit created module</h4>
            <!-- <p class="card-description"> Add class <code>.table</code>
            </p> -->
                @php($encryptedID = encrypt($module->id))
                <form method="POST" action="{{ url('modules/update/'.$encryptedID) }}">
                @csrf
                <div class="row">
                    <div class="col-md-12 row">
                        <div class="form-group col-lg-6">
                            <label for="module" class="form-check-label"> Module Name </label>
                            <input type="text" name="name" id="name" placeholder="Add new module enter module name" class="form-control" value="{{$module->name}}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="url" class="form-check-label"> Url </label>
                            <input type="text" name="url" id="url" placeholder="Add Url for routing" class="form-control" value="{{$module->url}}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="mdi_icon" class="form-check-label"> Mdi Icon </label>
                            <input type="text" name="mdi_icon" id="mdi_icon" placeholder="Add Mdi Icon" class="form-control" value="{{$module->mdi_icon}}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="order" class="form-check-label"> Module Listing Order </label>
                            <input type="text" name="order" id="order" placeholder="Add order no." class="form-control" value="{{$module->order}}">
                        </div>
                        <div class="form-group col-lg-6">
                                <label for="parent_module" class="form-check-label"> Select Parent Module: </label>
                                <select name="parent_module" id="parent_module" class="form-control p-3" placeholder="Select parent module">
                                    @foreach($parents as $mod)
                                      <option value="{{$mod->id}}"{{$mod->id == $module->parent_id ? 'Selected' : ''}}>{{$mod->parent_module}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="module_name" class="form-check-label"> Select Module</label>
                                <select name="module_name" id="module_name" class="form-control p-3" placeholder="Select module">
                                  <option value="">--Select--</option>
                                    @foreach($modules as $mode)
                                      <option value="{{$mode->id}}"{{$mode->id == $module->module_name ? 'Selected' : ''}}>{{$mode->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        <div class="col-lg-12">
                        <button class="btn btn-primary btn-md">Update</button>
                        <a href="{{route('back')}}" class="btn btn-success btn-md">Back</a>
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


