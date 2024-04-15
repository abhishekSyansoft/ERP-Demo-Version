@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> View Quality-control Detail
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>View Quality-control Detail<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
        </nav>
    </div>
    <div>
    <div>
<div>
    <!-- <div class="row"> -->
        <div class="col-lg-12 grid-margin stretch-card" style="margin:auto;">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">View Quality-control Detail:</h4>
            <hr>
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
                      <div class="modal-body  mx-auto">
                        <form class="row">
                          <div class="form-group col-md-6">
                            @foreach($products as $product)
                                @if($product->id == $quality->product_id)
                                @php($product_name = $product->product_name)
                                @endif
                            @endforeach
                            <label for="">Product</label>
                             <input disabled type="text" class="form-control" value="{{$product_name}}">
                          </div>

                          <div class="form-group col-md-6">
                            <label for="">Inspection Date</label>
                             <input disabled type="date" class="form-control" value="{{$quality->inspection_date}}">
                          </div>

                          <div class="form-group col-md-6">
                            <label for="">Result</label>
                             <input disabled type="text" class="form-control" value="{{ ($quality->result == 1) ? 'Pass' : (($quality->result == 2) ? 'Fail' : '')}}">
                          </div>

                          <div class="form-group col-md-6">
                            <label for="">Remarks</label>
                             <input disabled type="text" class="form-control" value="{{$quality->remarks}}">
                          </div>

                        </form>
                        <div>
    <div>
<div>
    </div>
        
    </div>
</div>
</div>
</div>
                   
</div>
</div>
                    </div>
            <!-- <p class="card-description"> Add class <code>.table</code>
            </p> -->
            </div>
    <div>
    <div>
<div>
    </div>
        
    </div>
</div>
</div>
</div>
          <!-- content-wrapper ends -->
@include('admin.layout.footer')

