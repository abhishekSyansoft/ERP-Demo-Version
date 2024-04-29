@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>Inbound Outbound Logistic
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Inbound Outbound Logistic<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Inbound Outbound Logistic:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($iol->id))
           <form method="POST" action="{{ url('iol/update/'.$encryptedId)}}" class="row">
           @csrf
                         <div class="mb-3 col-md-6">
                            <label for="transport_id" class="form-label">{{ __('Warehouse') }}</label>
                            <select id="transport_id" class="form-control p-3" name="transport_id" required>
                            <option value="0">--Select Transport--</option>
                                @foreach($transports as $transport)
                                <option value="{{$transport->id}}"{{$transport->id == $iol->transport_id ? 'Selected':''}}>{{$transport->transport_mode == 1 ? 'Road' : ($transport->transport_mode == 2 ? 'Rail' : ($transport->transport_mode == 3 ? 'Air' : ($transport->transport_mode == 4 ? 'Sea' : 'Not selected'))) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="order_id" class="form-label">{{ __('Order Number') }}</label>
                            <select id="order_id" class="form-control p-3" name="order_id" required>
                            <option value="0">--Select order number--</option>
                                @foreach($orders as $order)
                                <option value="{{$order->id}}"{{$order->id == $iol->order_id ? 'Selected':''}}>{{$order->order_id}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="received_date" class="form-label">{{ __('Received date') }}</label>
                            <input type="date" id="received_date" class="form-control" name="received_date" value="{{$iol->received_date}}" placeholder="Enter the location to make a new network" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="dispatched_date" class="form-label">{{ __('Dispatched Date') }}</label>
                            <input type="date" id="dispatched_date" placeholder="Capacity of the warehouse" value="{{$iol->dispatched_date}}" class="form-control" name="dispatched_date" required>
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

