@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel mx-auto">
    <div class="content-wrapper mx-auto">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Product Details
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Products <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>     

        <!-- <div class="card mb-2 mt-2">
            <form method="GET" class="row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="product" id="product" value="{{ isset($_GET['product']) ? $_GET['product'] : '' }}">
                </div>
                <div class="col-md-6 form-group">
                  <input class="btn btn-success btn-md" type="submit" value="Submit">
                </div>
            </form>
        </div> -->
        


        <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Products Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                            <a style="float:right;" href="{{ route('products.create') }}" class="btn btn-primary btn-md mdi mdi-plus-circle">New</a>
                        </div>
                        <!-- <hr>   -->
                      </div>     

</div>
                        <div class="table-wrapper col-md-12 p-0 m-0">
                        <table class="table">
                            <tr>
                                <th>S. No.</th>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th>Product image</th>
                                <th>Product Description</th>
                                <th>Product SKU</th>
                                <th>Product HSN</th>
                                <th>Product UOM</th>
                                <th>Product Weight</th>
                                <th>Product Volume</th>
                                <th>Tax Rate</th>
                                <th>Product Price</th>
                                <th>Product Currency</th>
                                <th>Product Quantity</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($products as $items)
                            @if(request()->has('products') && strpos($items->product_name, request('product')) !== false)
                                    <tr>
                                        <td>{{ $i++ }}</td>      
                                        <td>{{ $items->category_name }}</td>
                                        <td>{{ $items->products_name }}</td>
                                        <td><img src="{{ asset('storage/'.$items->product_image) }}" style="height:80px;width:80px;object-fit:contain;border-radius:0px;mix-blend-mode: darken;"></td>
                                        <td>{{ $items->product_description }}</td>
                                        <td>{{ $items->product_sku }}</td>
                                        <td>{{ $items->product_hsn }}</td>
                                        <td>{{ $items->product_uom }}</td>
                                        <td>{{ $items->product_weight }} gram</td>
                                        <td>{{ $items->product_volume }}</td>
                                        <td>{{ $items->product_taxrate }}%</td>
                                        <td>{{ number_format($items->product_price) }}</td>
                                        <td>{{ $items->product_currency }}</td>
                                        <td>{{ number_format($items->product_quantity) }}</td>
                                        <td>
                                            <a href="{{ url('products/edit/'.$items->product_id) }}" class="mdi mdi-pen mdi-lg m-2 btn btn-primary btn-sm">  Edit</a>
                                            <a href="{{ url('products/delete/'.$items->product_id) }}" class="mdi mdi-delete mdi-lg m-2 btn btn-danger btn-sm">  Delete</a>
                                        </td>
                                    </tr>
                                @elseif(!isset($_GET['product']))
                                    <tr>
                                        <td>{{ $i++ }}</td>      
                                        <td>{{ $items->category_name }}</td>
                                        <td>{{ $items->products_name }}</td>
                                        <td><img src="{{ asset('storage/'.$items->product_image) }}" style="height:80px;width:80px;object-fit:contain;border-radius:0px;mix-blend-mode: darken;"></td>
                                        <td>{{ $items->product_description }}</td>
                                        <td>{{ $items->product_sku }}</td>
                                        <td>{{ $items->product_hsn }}</td>
                                        <td>{{ $items->product_uom }}</td>
                                        <td>{{ $items->product_weight }} gram</td>
                                        <td>{{ $items->product_volume }}</td>
                                        <td>{{ $items->product_taxrate }}%</td>
                                        <td>{{ number_format($items->product_price) }}</td>
                                        <td>{{ $items->product_currency }}</td>
                                        <td>{{ number_format($items->product_quantity) }}</td>
                                        <td>
                                            <a href="{{ url('products/edit/'.$items->product_id) }}" class="mdi mdi-pen mdi-lg m-2 btn btn-primary btn-sm">  Edit</a>
                                            <a href="{{ url('products/delete/'.$items->product_id) }}" class="mdi mdi-delete mdi-lg m-2 btn btn-danger btn-sm">  Delete</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@include('admin.layout.footer')
