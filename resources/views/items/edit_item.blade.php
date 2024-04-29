@include('admin.layout.header')
@include('admin.layout.navbar')

<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Update Product
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Update Product<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div>
                        <div>
                        <div>
            <div class="row">
              <div class="col-lg-12 m-0 p-0">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Product</h4>
                    <hr>
                    <!-- <p class="card-description"> Add class <code>.table</code>
                    </p> -->
                    <form action="{{url('update/products/'.$product->id)}}" method="POST" class="row" enctype="multipart/form-data">
                            @csrf

                            <!-- product quantity  -->
                            <div class="form-group col-md-12">
                                <label for="category" class="form-control-label"><b>Select Category :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select  style="color:black;" name="category" id="category" class="form-control p-3" value="{{$product->category_id}}">
                                  @foreach($category as $cat)
                                  <option value="{{$cat->id}}" {{$cat->id == $product->category_id ? 'selected' : ''}}>
                                      {{$cat->category_name}}
                                  </option>
                                  @endforeach
                                </select>
                                @error('category')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            <!--End product quantity  -->

                            <!-- product name  -->
                            <div class="form-group col-md-6">
                                <label for="product" class="form-control-label"><b>Product :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="product" id="product" placeholder="Enter product name" value="{{$product->product_name}}">
                                @error('product')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            <!--End product name  -->

                             <!-- product image  -->
                             <div class="form-group col-md-6">
                                <label for="image" class="form-control-label"><b>Image :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="file" class="form-control" name="image" id="image" placeholder="Select image to upload" value="{{$product->product_image}}">
                                @error('image')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            <!--End product image  -->

                            
                            <!-- product description  -->
                            <div class="form-group col-md-6">
                                <label for="description" class="form-control-label"><b>Description :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Product description" value="{{$product->product_description}}">
                            
                            @error('description')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product description  -->

                            <!-- product SKU  -->
                            <div class="form-group col-md-6">
                                <label for="sku" class="form-control-label"><b>Product SKU :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="sku" id="sku" placeholder="Product SKU" value="{{$product->product_sku}}">
                            
                            @error('sku')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product SKU  -->

                            <!-- product hsn  -->
                            <div class="form-group col-md-6">
                                <label for="hsn" class="form-control-label"><b>Product HSN :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="hsn" id="hsn" placeholder="Product HSN" value="{{$product->product_hsn}}">
                            
                            @error('hsn')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product hsn  -->

                            <!-- product uom  -->
                            <div class="form-group col-md-6">
                                <label for="uom" class="form-control-label"><b>Product UOM :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="uom" id="uom" placeholder="Product UOM" value="{{$product->product_uom}}">
                            
                            @error('uom')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product uom  -->

                            <!-- product weight  -->
                            <div class="form-group col-md-6">
                                <label for="weight" class="form-control-label"><b>Product Weight :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="weight" id="weight" placeholder="Product Weight" value="{{$product->product_weight}}">
                            
                            @error('weight')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product weight  -->

                            <!-- product volume  -->
                            <div class="form-group col-md-6">
                                <label for="volume" class="form-control-label"><b>Product Volume :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="volume" id="volume" placeholder="Product Volume" value="{{$product->product_volume}}">
                            
                            @error('volume')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product volume  -->

                            <!-- product taxrate  -->
                            <div class="form-group col-md-6">
                                <label for="taxrate" class="form-control-label"><b>Product Tax-Rate :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="taxrate" id="taxrate" placeholder="Product Tax-Rate" value="{{$product->product_taxrate}}">
                            
                            @error('taxrate')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product taxrate  -->

                            <!-- product price  -->
                            <div class="form-group col-md-6">
                                <label for="price" class="form-control-label"><b>Product Price :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="price" id="price" placeholder="Product Price" value="{{$product->product_price}}">
                            
                            @error('price')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product price  -->

                            <!-- product currency  -->
                            <div class="form-group col-md-6">
                                <label for="currency" class="form-control-label"><b>Product Currency :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="currency" id="currency" placeholder="Product currency" value="{{$product->product_currency}}">
                            
                            @error('currency')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product currency  -->

                            <!-- product quantity  -->
                            <div class="form-group col-md-6">
                                <label for="quantity" class="form-control-label"><b>Product Quantity :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Product Quantity" value="{{$product->product_quantity}}">
                            
                            @error('quantity')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product quantity  -->
                            
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-md" value="Update Product">
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


