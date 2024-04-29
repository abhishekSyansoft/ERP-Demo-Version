@include('admin.layout.header')
<!-- @include('admin.layout.navbar') -->
   <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Users
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Users <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
   

                    
            <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;"> Users Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <b style="color:white;font-size:20px;"><a href="{{route('user.create')}}" class="btn btn-primary mdi mdi-plus-circle" style="color:white;float:right;">New</a></b>
                       
                        </div>
                        <!-- <hr>   -->
                      </div>   
                    </div>  

                        <div class="table-wrapper">
                    <table class="table">
                        <tr>
                            <th>S. No.</th>
                            <th>User Id</th>
                            <th>Username</th>
                            <th>User Email</th>
                            <th>Designation</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        @php($i=1)
                        @foreach($user as $user)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user->userid}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->designation}}</td>
                            
                            <td>{{$user->role}}</td>
                           
                            <td>
                            <a href="{{url('user/edit/'.$user->userid)}}" class="btn btn-sm btn-info">Edit</a>
                            <a href="" class="btn btn-sm btn-primary">Update Role</a>
                            <a href="{{url('User/Delete/'.$user->id)}}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>
          <!-- content-wrapper ends -->
          
       
        <!-- main-panel ends -->
      
@include('admin.layout.footer')
