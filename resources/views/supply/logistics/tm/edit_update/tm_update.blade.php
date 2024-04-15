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
           @php($encryptedId = encrypt($tm->id))
           <form method="POST" action="{{ url('tm/update/'.$encryptedId)}}" class="row">
           @csrf
                       
           <div class="mb-3 col-md-6">
                            <label for="tranport_mode" class="form-label">{{ __('Transport Mode') }}</label>
                            <select id="tranport_mode" class="form-control p-3" name="tranport_mode" required>
                                <option value="0" {{$tm->transport_mode == 0 ? 'Selected': ''}}>--Select product--</option>
                                <option value="1" {{$tm->transport_mode == 1 ? 'Selected': ''}}>Road</option>
                                <option value="2" {{$tm->transport_mode == 2 ? 'Selected': ''}}>Rail</option>
                                <option value="3" {{$tm->transport_mode == 3 ? 'Selected': ''}}>Air</option>
                                <option value="4" {{$tm->transport_mode == 4 ? 'Selected': ''}}>Sea</option>
                            </select>
                        </div>
                       

                        <div class="mb-3 col-md-6">
                            <label for="departure_location" class="form-label">{{ __('Departure Location') }}</label>
                            <input type="text" id="departure_location" class="form-control" name="departure_location" value="{{$tm->departure_location}}" placeholder="Enter Departure Location" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="arrival_location" class="form-label">{{ __('Arrival Location') }}</label>
                            <input type="text" id="arrival_location" class="form-control" name="arrival_location" value="{{$tm->arrival_location}}" placeholder="Enter the Warehouse location" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="departure_date" class="form-label">{{ __('Departure Date') }}</label>
                            <input type="date" id="departure_date" class="form-control" name="departure_date" value="{{$tm->departure_date}}" placeholder="Enter the Warehouse location" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="arrival_date" class="form-label">{{ __('Arrival Date') }}</label>
                            <input type="date" id="arrival_date" class="form-control" name="arrival_date" value="{{$tm->arrival_date}}" placeholder="Enter the Warehouse location" required>
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

