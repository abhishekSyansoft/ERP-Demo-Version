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
           @php($encryptedId = encrypt($dn->id))
           <form method="POST" action="{{ url('dn/update/'.$encryptedId)}}" class="row">
           @csrf
           <div class="mb-3 col-md-6">
                            <label for="distribution_center_id" class="form-label">{{ __('Warehouse') }}</label>
                            <select id="distribution_center_id" class="form-control p-3" name="distribution_center_id" required>
                            <option value="0">--Select product--</option>
                                @foreach($warehouses as $warehouse)
                                <option value="{{$warehouse->id}}"{{$warehouse->id == $dn->distribution_center_id ? 'Selected':''}}>{{$warehouse->warehouse_name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="location" class="form-label">{{ __('Location') }}</label>
                            <input type="text" id="location" class="form-control" name="location" value="{{$dn->location}}" placeholder="Enter the location to make a new network" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="capacity" class="form-label">{{ __('Capacity') }}</label>
                            <input type="text" id="capacity" placeholder="Capacity of the warehouse" value="{{$dn->capacity}}" class="form-control" name="capacity" required>
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

