@include('admin.layout.header')
@include('admin.layout.navbar')

<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Add Module
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
              <!-- <div> -->
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create a new module</h4>
                    <hr>
                    <!-- <p class="card-description"> Add class <code>.table</code>
                    </p> -->
                    <form method="POST" action="{{ route('store.module') }}">
                    @csrf
                      <div class="row">
                        <div class="col-md-12 row">
                            <div class="form-group col-lg-6">
                                <label for="module" class="form-check-label"> Module Name <sup style="color:red;font-size:15px;">*</sup></label>
                                <input type="text" name="name" id="name" placeholder="Add new module enter module name" class="form-control">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="url" class="form-check-label"> Url <sup style="color:red;font-size:15px;">*</sup></label>
                                <input type="text" name="url" id="url" placeholder="Add Url for routing" class="form-control">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="mdi_icon" class="form-check-label"> Mdi Icon <sup style="color:red;font-size:15px;">*</sup></label>
                                <input type="text" name="mdi_icon" id="mdi_icon" placeholder="Add Mdi Icon" class="form-control">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="order" class="form-check-label"> Module Listing Order <sup style="color:red;font-size:15px;">*</sup></label>
                                <input type="text" name="order" id="order" placeholder="Add order no." class="form-control">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="parent_module" class="form-check-label"> Select Parent Module <sup style="color:red;font-size:15px;">*</sup></label>
                                <select name="parent_module" id="parent_module" class="form-control p-3" placeholder="Select parent module">
                                    @foreach($parents as $mod)
                                      <option value="{{$mod->id}}">{{$mod->parent_module}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="module_name" class="form-check-label"> Select Module</label>
                                <select name="module_name" id="module_name" class="form-control p-3" placeholder="Select module">
                                    @foreach($module as $mode)
                                      <option value="{{$mode->id}}">{{$mode->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-12">
                            <button class="btn btn-primary btn-md">Submit</button>                            </div>
                        <div>  
                    </form>
                    <!-- <hr> -->
                    <!-- <form class="col" style="float:right;margin-top:-42px;" method="POST" action="{{route('back')}}">
                      @csrf
                      <button type='submit' name="submit" class="btn btn-info btn-md">Go Back</button>
                    </form> -->
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