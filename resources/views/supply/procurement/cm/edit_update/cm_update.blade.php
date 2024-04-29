@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Contract Management
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Contract Management<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Contract Management:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($cm->id))
           <form method="POST" action="{{ url('cm/update/'.$encryptedId)}}" class="row">
           @csrf
                        <div class="mb-3 col-md-6">
                            <label for="supplier_id" class="form-label">{{ __('Supplier') }}</label>
                            <select id="supplier_id"  class="form-control p-3" name="supplier_id" required>
                                <option value="0">--Select Supplier--</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier->id}}"{{$supplier->id == $cm->supplier_id ? 'Selected':''}}>{{$supplier->supplier_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                            <input type="date" id="start_date" class="form-control" value="{{$cm->start_date}}" name="start_date" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                            <input type="date" id="end_date" class="form-control" value="{{$cm->end_date}}" name="end_date" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="terms_and_conditions" class="form-label">{{ __('Terms & Conditions') }}</label>
                            <input type="text" id="terms_and_conditions" value="{{$cm->terms_and_conditions}}" class="form-control" name="terms_and_conditions" placeholder="Enetr terms & condition" required>
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

