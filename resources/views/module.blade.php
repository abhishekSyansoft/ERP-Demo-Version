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


            <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">All Modules Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <b style="color:white;font-size:20px;"><a href="{{route('add.module')}}" class="btn btn-primary mdi mdi-plus-circle" style="color:white;float:right;">New</a></b>
                       
                        </div>
                        <!-- <hr>   -->
                      </div>   
                    </div> 
                    <div class="table-wrapper">
       
                    <table class="table">
                        <tr>
                            <th>S No.</th>
                            <!-- <th>Module Id</th> -->
                            <th>Parent_module id</th>
                            <th>Module Name</th>
                            <th>Url</th>
                            <th>Icon Name</th>
                            <th>List Order</th>
                            <th>Action</th>
                        </tr>
                        @php($i=1)
                        @foreach($modules as $mod)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$mod->parent_id}}</td>
                            <td>{{$mod->name}}</td>
                            <td>{{$mod->url}}</td>
                            <td>{{$mod->mdi_icon}}</td>
                            <td>{{$mod->order}}</td>
                            <td>
                                <a href="{{ url('modules/edit/'.$mod->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ url('modules/delete/'.$mod->id)}}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $modules->links() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
