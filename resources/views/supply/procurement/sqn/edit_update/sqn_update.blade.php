@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>Supplier Quotation/Negotiation
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Supplier Quotation/Negotiation<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Supplier Quotation/Negotiation :</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($sqn->id))
           <form method="POST" action="{{ url('sqn/update/'.$encryptedId)}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="supplier_id" class="form-label">{{ __('Supplier') }}</label>
                            <select id="supplier_id"  class="form-control p-3" name="supplier_id" required>
                                <option value="0">--Select Supplier--</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$sqn->supplier_id}}"{{$sqn->supplier_id == $supplier->id ? 'Selected' :''}}>{{$supplier->supplier_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="item_id" class="form-label">{{ __('Item') }}</label>
                            <select id="item_id"  class="form-control p-3" name="item_id" required>
                                <option value="0">--Select Item--</option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}"{{$product->id == $sqn->item_id ? 'Selected' :''}}>{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="price" class="form-label">{{ __('Price') }}</label>
                            <input type="text" id="price" class="form-control" value="{{$sqn->price}}" name="price" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="valid_until" class="form-label">{{ __('Valid Until') }}</label>
                            <input type="date" id="valid_until" class="form-control" value="{{$sqn->valid_until}}" name="valid_until" required>
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

