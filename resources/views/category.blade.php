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


            <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">All Category Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <b style="color:white;font-size:20px;"><a href="{{route('add.category')}}" class="btn btn-primary mdi mdi-plus-circle" style="color:white;float:right;">New</a></b>
                       
                        </div>
                        <!-- <hr>   -->
                      </div>     
                        
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
                    
                    <!-- </div> -->
                    <div class="table-wrapper">
                    <table class="table">
                        <tr>
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