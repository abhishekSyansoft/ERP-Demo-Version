@include('admin.layout.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Edit user
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Edit <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
<div>
  <div>
            <div class="col-12 grid-margin stretch-card" style="margin:auto;">
            <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <hr>
                    <!-- <p class="card-description"> Basic form elements </p> -->
                    <form class="forms-sample row" method="POST" action="{{ url('user/update/'.$users->id)}}">
                    @csrf
                      <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="Name" placeholder="Enter your name" value="{{$users->name}}">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="{{$users->email}}">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="admin">Role</label>
                        <select class="form-control p-3" name="admin" id="exampleSelectGender" style="color:black;">
                            <option value="">Select</option>
                            @foreach($roles as $role)
                              <option value="{{$role->id}}" {{ $users->admin == $role->id ? 'selected' : '' }}>{{$role->name}}</option>
                            @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-6">
                        <label for="designation">Desination</label>
                        <input type="designation" name="designation" class="form-control" id="designation" placeholder="Designation" value="{{$users->designation}}">
                      </div>
                      <div class="form-group">
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
        </div>
    </div>          
</div>
<!-- content-wrapper ends -->

@include('admin.layout.footer')