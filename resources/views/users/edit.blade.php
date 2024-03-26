@extends('admin.layout.header')
@include('admin.layout.navbar')

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

            <div class="col-9 grid-margin stretch-card" style="margin:auto;">
            <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <hr>
                    <!-- <p class="card-description"> Basic form elements </p> -->
                    <form class="forms-sample" method="POST" action="{{ url('User/Update/'.$users->id)}}">
                    @csrf
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="Name" placeholder="Enter your name" value="{{$users->name}}">
                      </div>
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="{{$users->email}}">
                      </div>

                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                      </div>

                      <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm your password">
                      </div>

                      <div class="form-group">
                        <label for="admin">Role</label>
                        <select class="form-control" name="admin" id="exampleSelectGender">
                                <option value="">Select</option>
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                           
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="designation">Desination</label>
                        <input type="designation" name="designation" class="form-control" id="designation" placeholder="Designation" value="{{$users->designation}}">
                      </div>
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <a class="btn btn-gradient-warning me-2" onClick="back();">Back</a>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
        </div>
    </div>          
</div>
          <!-- content-wrapper ends -->



@extends('admin.layout.footer')