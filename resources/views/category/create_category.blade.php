@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Create New Category/Sub-Category
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Create Item<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card" style="margin:auto;">
                <div class="card">
                  <div class="card-body">
                    <!-- <h4 class="card-title">Create Category</h4> -->
                    <!-- <p class="card-description"> Add class <code>.table</code>
                    </p> -->



                    <div class="tab">
                    <button class="tablinks btn btn-lg btn-success" onclick="openCity(event, 'category')">Category</button>
                    <button class="tablinks btn btn-lg btn-success" onclick="openCity(event, 'subcategory')">Sub-Category</button>
                    <button class="tablinks btn btn-lg btn-success" onclick="openCity(event, 'bulk')">Bulk Upload</button>
                    </div>
                    <hr>

                    <div id="category" class="tabcontent">
                        <h3>Add Category</h3>
                        <form action="{{route('add.category_item')}}" method="POST" class="row">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="category1" class="form-control-label"><b>Category :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="category1" id="category1" placeholder="Enter name to add category">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-md" value="Add Category">
                            </div>
                        </form>
                    </div>

                    <div id="subcategory" class="tabcontent">
                        <h3>Add Sub-Category</h3>
                        <form action="{{route('add.sub-category_item')}}" method="POST" class="row">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="category" class="form-control-label"><b>Select Category : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select name="category" id="category" class="form-control p-3">
                                    @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                    <hr>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subcategory" class="form-control-label"><b>Sub-Category Name : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" name="subcategory" id="subcategory" class="form-control" placeholder="Enter name to add sub-category">
                            </div>
                            <div class="form-group col-md-6">
                                <button name="submit" type="submit" class="btn btn-primary btn-md">Add Sub-Category</button>
                            </div>
                        </form>
                    </div>

                    <div id="bulk" class="tabcontent">
                    <h3>Bulk Upload</h3>
                      <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data" class="row">
                          @csrf
                          <div class="form-group col-md-6">
                            <label for="file">Upload File <span style="color:red;">( .csv & .txt and .xlsx files only)<sup style="color:red;font-size:15px;">*</sup></span></label>
                            <input type="file" name="file" id="file" class="form-control">
                          </div>
                          <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary">Upload</button>
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
</div>
          <!-- content-wrapper ends -->
@include('admin.layout.footer')


