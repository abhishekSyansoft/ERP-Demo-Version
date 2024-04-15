@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>Transportation Management
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Transportation Management<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Transportation Management:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($of->id))
           <form method="POST" action="{{ url('of/update/'.$encryptedId)}}" class="row">
           @csrf

                        <div class="mb-3 col-md-6">
                            <label for="order_id" class="form-label">{{ __('Order Number') }}</label>
                            <select id="order_id" class="form-control p-3" name="order_id" required>
                            <option value="0">--Select product--</option>
                                @foreach($orders as $order)
                                <option value="{{$order->id}}"{{$order->id == $of->order_id ? 'Selected': ''}}>{{$order->order_id}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="fulfillment_date" class="form-label">{{ __('Fulfillment Date') }}</label>
                            <input type="date" id="fulfillment_date" class="form-control" value="{{$of->fulfillment}}" name="fulfillment_date" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select id="status" class="form-control p-3" name="status" required>
                                <option value="0"{{$of->status == 0 ? 'Selected':''}}>--Select product--</option>
                                <option value="1"{{$of->status == 1 ? 'Selected':''}}>Processing</option>
                                <option value="2"{{$of->status == 2 ? 'Selected':''}}>Shipped</option>
                                <option value="3"{{$of->status == 3 ? 'Selected':''}}>Delivered</option>
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

