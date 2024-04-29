@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Sales And Operations Planning
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Sales And Operations Planning<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Sales And Operations Planning:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($sop->id))
           <form method="POST" action="{{ url('sop/update/'.$encryptedId)}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="forecasting_id" class="form-label">{{ __('Demand Forecasting Product') }}</label>
                            <select id="forecasting_id"  class="form-control p-3" name="forecasting_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($forecastings as $forecasting)
                                <option value="{{$forecasting->id}}"{{$sop->forecast_id == $forecasting->id ? 'Selected':''}}>{{$forecasting->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="production_plan_id" class="form-label">{{ __('Production Plan Product') }}</label>
                            <select id="production_plan_id"  class="form-control p-3" name="production_plan_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($productions as $production)
                                <option value="{{$production->id}}"{{$sop->production_plan_id == $production->id ? 'Selected':''}}>{{$production->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="sales_target" class="form-label">{{ __('Sales Target') }}</label>
                            <input type="text" id="sales_target" class="form-control" value="{{$sop->sales_target}}" name="sales_target"  placeholder="Enter the sales target" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="production_target" class="form-label">{{ __('Production Target') }}</label>
                            <input type="text" id="production_target" class="form-control" value="{{$sop->production_target}}" name="production_target"  placeholder="Enter the production Target" required>
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

