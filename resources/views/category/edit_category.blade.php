@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Update Existing Category/Sub-Category
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Update Category/Sub-category<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                    <hr>
                    @if($category->parent_id != 0)
                    <div id="subcategory">
                        <h3>Update Sub-Category</h3>
                        <form action="{{url('update/sub-category/'.$category->id)}}" method="POST" class="row">
                            @csrf
                           
                            <div class="form-group col-md-6">
                                <label for="category" class="form-control-label"><b>Select Category : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select name="category" id="category" class="form-control p-3" style="color:black;">
                                    @foreach($categoryall as $cat)
                                    <option value="{{$cat->id}}" {{$cat->id == $category->parent_id ? 'selected' : ''}}>{{$cat->category_name}}</option>
                                    <hr>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subcategory" class="form-control-label"><b>Sub-Category Name : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" name="subcategory" id="subcategory" class="form-control" placeholder="Enter name to add sub-category" value="{{$category->category_name}}">
                            </div>
                            <div class="form-group col-md-12">
                                <button name="submit" type="submit" class="btn btn-primary btn-md">Update Sub-Category</button>
                            </div>
                        </form>
                    </div>
                   @endif
                   @if($category->parent_id == 0)
                   <div id="category">
                        <h3>Update Category</h3>
                        <form action="{{url('update/category/'.$category->id)}}" method="POST" class="row">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="category1" class="form-control-label"><b>Category : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="category1" id="category1" placeholder="Enter name to add category" value="{{$category->category_name}}">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-md" value="Update Category">
                            </div>
                        </form>
                    </div>
                    @endif
                   
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


