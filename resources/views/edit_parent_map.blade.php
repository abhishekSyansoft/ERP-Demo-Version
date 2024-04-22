@include('admin.layout.header')
@include('admin.layout.navbar')

<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Edit Parent Map Details
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
                    <h4 class="card-title">Edit Parent Map Details</h4>
                    <!-- <p class="card-description"> Add class <code>.table</code>
                    </p> -->
                    @php($encryptedID = encrypt($parent_details->id))
                    <form method="POST" action="{{ url('update/parent/'.$encryptedID) }}" class="row">
                    @csrf
                    <div class="mb-3 col-md-6">
                        <label for="moduleSelect" class="form-label">Select Module:</label>
                        <select class="form-select p-3" id="moduleSelect" name="moduleSelect">
                        @foreach($parent_modules as $parent)
                            <option value="{{$parent->id}}"{{$parent->id == $parent_details->parentID ? 'Selected':''}}>{{$parent->parent_module}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="roleSelect" class="form-label">Select Role:</label>
                        <select class="form-select p-3" id="roleSelect" name="roleSelect">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}"{{$role->id == $parent_details->roleID ? 'Selected':''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Other form fields for mapping -->
                    <!-- For example: -->
                    <div class="mb-3 col-md-6">
                        <label for="order_number" class="form-label">Order Number</label>
                        <input type="number" value="{{$parent_details->order_no}}" class="form-control" id="order_number" placeholder="Please enter order number in which position you want to this module" name="order_number">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="status" class="form-label">Select Status:</label>
                        <select class="form-select" id="status" name="status">
                            <option value="0">--Select Status--</option>
                            <option value="1">Active</option>
                            <option value="2">In-Active</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group col-md-12">
                        <button class="btn btn-success" type="submit" name="submit">Update</button>
                    </div>
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


