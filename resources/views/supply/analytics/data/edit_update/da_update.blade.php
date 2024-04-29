@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>Data Analytics
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Data Analytics Details<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Data Analytics Details:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($analytics->id))
           <form method="POST" action="{{ url('analytics/update/'.$encryptedId)}}" class="row">
           @csrf
                    <div class="mb-3 col-md-6">
                        <label for="metric_name" class="form-label">{{ __('Metric Name') }}</label>
                        <input type="text" id="metric_name" value="{{ $analytics->metric_name }}" class="form-control" name="metric_name" placeholder="Enter metric name" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="value" class="form-label">{{ __('Value') }}</label>
                        <input type="text" id="value" value="{{ $analytics->value }}" class="form-control" name="value" placeholder="Value according to current data in numbers" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="date" class="form-label">{{ __('Date') }}</label>
                        <input type="date" value="{{ $analytics->date }}" id="date" class="form-control" name="date" required>
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

