@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>Quality Control
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Quality Control<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
        </nav>
    </div>
    <div>
    <div>
<div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card" style="margin:auto;">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Update Quality Control:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($qc->id))
           <form method="POST" action="{{ url('qc/update/'.$encryptedId)}}" class="row">
           @csrf
                <div class="mb-3 col-md-6">
                    <label for="product_id" class="form-label">{{ __('Products') }}</label>
                    <select id="product_id"  class="form-control p-3" name="product_id" required>
                        <option value="0">--Select Product--</option>
                        @foreach($products as $product)
                        <option value="{{$product->id}}"{{$product->id == $qc->product_id ? 'Selected' : ''}}>{{$product->product_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="inspection_date" class="form-label">{{ __('Inspection Date') }}</label>
                    <input type="date" id="inspection_date" value="{{$qc->inspection_date}}" class="form-control" name="inspection_date" placeholder="Enter the negotiated price" required>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="result" class="form-label">{{ __('Result') }}</label>
                    <select id="result" class="form-control p-3" name="result" required>
                        <option value="0"{{$qc->result == 0 ? 'Selected' : ''}}>--Select Option--</option>
                        <option value="1"{{$qc->result == 1 ? 'Selected' : ''}}>Pass</option>
                        <option value="2"{{$qc->result == 2 ? 'Selected' : ''}}>Fail</option>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="remarks" class="form-label">{{ __('Remarks') }}</label>
                    <input type="text" id="remarks" value="{{$qc->remarks}}" class="form-control" name="remarks" placeholder="Enetr terms & condition" required>
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

