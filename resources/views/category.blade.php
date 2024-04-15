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
                    <span></span>category <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
              
            <div class="row">
              <div class="col-md-12" style="margin:auto;">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix row">
                      <div class="col">
                        <h4 class="card-title float-left">All Category</h4>
                        <a href="{{route('add.category')}}" class="btn btn-primary">Create New</a>
                        
                        <!-- Button trigger modal -->
                          <!-- <button type="button" id="cat" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Category
                          </button> -->

                        <!-- Button trigger modal -->
                          <!-- <button id="subCat" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            Add Sub-Category
                          </button> -->

                        <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                      </div>
                      <div class="col">
                        <div style="float:right">
                            <a class="mdi mdi-human p-2" style="background-color:rgba(0, 0, 0, 0.4);border-radius:50%;"></a>
                            <a class="mdi mdi-filter p-2" style="background-color:rgba(0, 0, 0, 0.4);border-radius:50%;"></a>
                            <a class="mdi mdi-pencil p-2" style="background-color:rgba(0, 0, 0, 0.4);border-radius:50%;"></a>
                        </div>
                      </div>
                    </div>
                    
                    <table class="table table-hover table-striped table-bordered border-warning table-warning table-sm mt-2">
                        <tr class="table-primary">
                            <th>S No.</th>
                            
                            <th>Parent Category</th>
                            
                            <th>Category Name</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                        @php($i=1)
                        @foreach($category as $cat)
                        <tr>
                            <td>{{$i++}}</td>
                           
                            @if($cat->parent == 0)
                            <td></td>
                            @else
                            <td>{{$cat->parent}}</td>
                            @endif


                            <td>{{$cat->category_name}}</td>
                            @if($cat->parent == 0)
                            <td>Category</td>
                            @else
                            <td>Sub-Category</td>
                            @endif
                            <td>
                                <a href="{{url('category/edit/'.$cat->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{url('category/delete/'.$cat->id)}}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{$category->links()}}
                 </div>
                </div>
              </div>
            </div>
          </div>

        <!-- AddCategory Modal  -->
        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <form method="POST" action="">
                    @csrf
                      <div class="row">
                        <div class="col-md-12 row">
                            <div class="form-group col-lg-12">
                                <label for="item_name" class="form-check-label"> Category </label>
                                <input type="text" name="item_name" id="item_name" placeholder="Add new item" class="form-control">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="item_name" class="form-check-label"> Sub-Category </label>
                                <input type="text" name="item_name" id="item_name" placeholder="Add new item" class="form-control">
                            </div>
                           
                            <div class="col-lg-12">
                            <button type="button" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        <div>  
                    </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div> -->
        <!-- End Add Add Sub-Ctegory Modal  -->


       <!-- End Add Add Sub-Ctegory Modal  -->
        <!-- <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div> -->
        <!-- End Add AddCtegory Modal  -->



          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')