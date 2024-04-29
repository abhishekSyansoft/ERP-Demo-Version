@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Create Product
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Create Products<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 m-0 p-0">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create Product</h4>

                    <div class="tab">
                    <button class="tablinks btn btn-lg btn-success" onclick="openCity(event, 'products')">Products</button>
                    <button class="tablinks btn btn-lg btn-success" onclick="openCity(event, 'bulk')">Bulk Upload</button>
                    </div>
                    <hr>
                      <div>
                        <div>
                        <div>



                    <div id="products" class="tabcontent">
                        <h3>Add Product</h3>
                        <form action="{{route('add.products')}}" method="POST" class="row" enctype="multipart/form-data">
                            @csrf

                            <!-- product quantity  -->
                            <div class="form-group col-md-12">
                                <label for="category" class="form-control-label"><b>Select Category : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select name="category" id="category" class="form-control p-3">
                                  @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                  @endforeach
                                </select>
                                @error('category')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            <!--End product quantity  -->

                            <!-- product name  -->
                            <div class="form-group col-md-6">
                                <label for="product" class="form-control-label"><b>Product : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="product" id="product" placeholder="Enter product name">
                                @error('product')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            <!--End product name  -->

                             <!-- product image  -->
                             <div class="form-group col-md-6">
                                <label for="image" class="form-control-label"><b>Image : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="file" class="form-control" name="image" id="image" placeholder="Select image to upload">
                                @error('image')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            <!--End product image  -->

                            
                            <!-- product description  -->
                            <div class="form-group col-md-6">
                                <label for="description" class="form-control-label"><b>Description : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Product description">
                            
                            @error('description')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product description  -->

                            <!-- product SKU  -->
                            <div class="form-group col-md-6">
                                <label for="sku" class="form-control-label"><b>Product SKU : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="sku" id="sku" placeholder="Product SKU">
                            
                            @error('sku')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product SKU  -->

                            <!-- product hsn  -->
                            <div class="form-group col-md-6">
                                <label for="hsn" class="form-control-label"><b>Product HSN : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="hsn" id="hsn" placeholder="Product HSN">
                            
                            @error('hsn')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product hsn  -->

                            <!-- product uom  -->
                            <div class="form-group col-md-6">
                                <label for="uom" class="form-control-label"><b>Product UOM : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="uom" id="uom" placeholder="Product UOM">
                            
                            @error('uom')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product uom  -->

                            <!-- product weight  -->
                            <div class="form-group col-md-6">
                                <label for="weight" class="form-control-label"><b>Product Weight : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="weight" id="weight" placeholder="Product Weight">
                            
                            @error('weight')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product weight  -->

                            <!-- product volume  -->
                            <div class="form-group col-md-6">
                                <label for="volume" class="form-control-label"><b>Product Volume : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="volume" id="volume" placeholder="Product Volume">
                            
                            @error('volume')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product volume  -->

                            <!-- product taxrate  -->
                            <div class="form-group col-md-6">
                                <label for="taxrate" class="form-control-label"><b>Product Tax-Rate :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="taxrate" id="taxrate" placeholder="Product Tax-Rate">
                            
                            @error('taxrate')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product taxrate  -->

                            <!-- product price  -->
                            <div class="form-group col-md-6">
                                <label for="price" class="form-control-label"><b>Product Price : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="price" id="price" placeholder="Product Price">
                            
                            @error('price')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product price  -->

                            <!-- product currency  -->
                            <div class="form-group col-md-6">
                                <label for="currency" class="form-control-label"><b>Product Currency : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="currency" id="currency" placeholder="Product currency">
                            
                            @error('currency')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product currency  -->

                            <!-- product quantity  -->
                            <div class="form-group col-md-6">
                                <label for="quantity" class="form-control-label"><b>Product Quantity : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Product Quantity">
                            
                            @error('quantity')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product quantity  -->
                            
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-md" value="Add Category">
                            </div>
                        </form>
                    </div>
                    <!-- <p class="card-description"> Add class <code>.table</code>
                    </p> -->


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


