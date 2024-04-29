@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>   Master Production Shedule Managemant
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update  Master Production Shedule<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Master Production Shedule :</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($mps->id))
           <form method="POST" action="{{ url('mps/update/'.$encryptedId)}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="product_id" class="form-label">{{ __('Product') }}</label>
                            <select id="product_id"  class="form-control p-3" name="product_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($products as $product)
                                <option value="{{$mps->product_id}}"{{$mps->product_id == $product->id ? 'Selected' :''}}>{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="planned_quantity" class="form-label">{{ __('Planned Quantity') }}</label>
                            <input type="text" id="planned_quantity" class="form-control" name="planned_quantity" value="{{$mps->planned_quantity}}" placeholder="Planned quantity for production purpose" required></textarea>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="planned_start_date" class="form-label">{{ __('Planned Start Date') }}</label>
                            <input type="date" id="planned_start_date" class="form-control" name="planned_start_date" value="{{$mps->planned_start_date}}" placeholder="Planned quantity for production purpose" required>
                            </div>
                        <div class="mb-3 col-md-6">
                            <label for="planned_end_date" class="form-label">{{ __('Planned End Date') }}</label>
                            <input type="date" id="planned_end_date" class="form-control" name="planned_end_date" value="{{$mps->planned_end_date}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select type="text" id="status" class="form-control p-3" name="status" required>
                                <option value="0" {{$mps->status == 0 ? 'Selected' :''}}>--Select status--</option>
                                <option value="1" {{$mps->status == 1 ? 'Selected' :''}}>Pending</option>
                                <option value="2" {{$mps->status == 2 ? 'Selected' :''}}>Completed</option>
                            </select>
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

