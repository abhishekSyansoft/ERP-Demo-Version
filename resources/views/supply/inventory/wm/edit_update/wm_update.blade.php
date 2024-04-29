@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Warehouse management
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Warehouse management<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Warehouse management:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($wm->id))
           <form method="POST" action="{{ url('wm/update/'.$encryptedId)}}" class="row">
           @csrf
                         <div class="mb-3 col-md-6">
                            <label for="warehouse_name" class="form-label">{{ __('Warehoues Name') }}</label>
                            <input type="text" id="warehouse_name" value="{{$wm->warehouse_name}}" class="form-control" name="warehouse_name" placeholder="Enter the Warehouse name" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="location" class="form-label">{{ __('Warehoues Location') }}</label>
                            <input type="text" id="location" class="form-control" value="{{$wm->location}}" name="location" placeholder="Enter the Warehouse location" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="capacity" class="form-label">{{ __('Capacity') }}</label>
                            <input type="text" id="capacity" class="form-control" value="{{$wm->capacity}}" name="capacity" placeholder="Mention Capacit of the warehouse" required>
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

