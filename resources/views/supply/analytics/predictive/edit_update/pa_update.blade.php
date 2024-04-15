@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>Predictive Analytics
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Predictive Analytics Details<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Predictive Analytics Details:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($predictive->id))
           <form method="POST" action="{{ url('predictive/update/'.$encryptedId)}}" class="row">
           @csrf
                    <div class="mb-3 col-md-6">
                        <label for="modal_name" class="form-label">{{ __('Model Name') }}</label>
                        <input type="text" id="modal_name" value="{{ $predictive->model_name }}" class="form-control" name="modal_name" placeholder="Enter model name" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="predictive_value" class="form-label">{{ __('Predictive Value') }}</label>
                        <input type="text" id="predictive_value" value="{{ $predictive->prediction_value }}" class="form-control" name="predictive_value" placeholder="Value according to current data in numbers" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="predictive_date" class="form-label">{{ __('Predictive Date') }}</label>
                        <input type="date" value="{{ $predictive->prediction_date }}" id="date" class="form-control" name="predictive_date" required>
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

