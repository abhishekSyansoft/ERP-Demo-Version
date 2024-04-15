@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>   Capacity Planning Managemant
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Capacity Plan<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Capacity Plan :</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($cp->id))
           <form method="POST" action="{{ url('capacity-planning/update/'.$encryptedId)}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="resource_id" class="form-label">{{ __('Product') }}</label>
                            <select id="resource_id"  class="form-control p-3" name="resource_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($resources as $resource)
                                <option value="{{$cp->resource_id}}"{{$cp->resource_id == $resource->id ? 'Selected' :''}}>{{$resource->resource_name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="date" class="form-label">{{ __('Date') }}</label>
                            <input type="date" id="date" class="form-control" name="date" value="{{$cp->date}}" required>
                            </div>

                        <div class="mb-3 col-md-6">
                            <label for="shift" class="form-label">{{ __('Shift') }}</label>
                            <select type="text" id="shift" class="form-control p-3" name="shift" required>
                                <option value="0" {{$cp->shift == 0 ? 'Selected' :''}}>--Select status--</option>
                                <option value="1" {{$cp->shift == 1 ? 'Selected' :''}}>Morning</option>
                                <option value="2" {{$cp->shift == 2 ? 'Selected' :''}}>Evening</option>
                                <option value="3" {{$cp->shift == 3 ? 'Selected' :''}}>Night</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="capacity_available" class="form-label">{{ __('Capacity Available') }}</label>
                            <input type="text" id="capacity_available" class="form-control" name="capacity_available" value="{{$cp->capacity_available}}" required>
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

