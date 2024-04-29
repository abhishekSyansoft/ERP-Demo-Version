@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>Inventory Optimization
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Inventory Optimization<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Inventory Optimization:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($io->id))
           <form method="POST" action="{{ url('io/update/'.$encryptedId)}}" class="row">
           @csrf
                       
                        <div class="mb-3 col-md-6">
                            <label for="product_id" class="form-label">{{ __('Product') }}</label>
                            <select id="product_id" class="form-control p-3" name="product_id" required>
                                <option value="0">--Select product--</option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}"{{$product->id == $io->product_id ? 'Selected':''}}>{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                       

                        <div class="mb-3 col-md-6">
                            <label for="reorder_point" class="form-label">{{ __('Reorder Point') }}</label>
                            <input type="text" id="reorder_point" class="form-control" value="{{$io->reorder_point}}" name="reorder_point" placeholder="Enter the Warehouse name" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="optimal_quantity" class="form-label">{{ __('Optimal Quantity') }}</label>
                            <input type="text" id="optimal_quantity" class="form-control" value="{{$io->optimal_quantity}}" name="optimal_quantity" placeholder="Enter the Warehouse location" required>
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        </div>
                    </form>
<!--                    
</div>
</div>
                    </div> -->
            <!-- <p class="card-description"> Add class <code>.table</code>
            </p> -->
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

