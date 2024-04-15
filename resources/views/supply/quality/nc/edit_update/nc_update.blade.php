@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Non Conformance
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Non Conformance<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Non Conformance:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
                    @php($encryptedId = encrypt($nc->id))
                    <form method="POST" action="{{ url('nc/update/'.$encryptedId)}}" class="row">
                    @csrf
                        <div class="mb-3 col-md-6">
                            <label for="qc_id" class="form-label">{{ __('Quality Control') }}</label>
                            <select id="qc_id"  class="form-control p-3" name="qc_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($qc as $qc)
                                <option value="{{$qc->id}}"{{$qc->id == $nc->qc_id ? 'Selected': ''}}>{{$qc->product}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="non_conformance_date" class="form-label">{{ __('Non Conformance Date') }}</label>
                            <input type="date" value="{{$nc->non_conformance_date}}" id="non_conformance_date" class="form-control" name="non_conformance_date" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="action_taken" class="form-label">{{ __('Remarks') }}</label>
                            <input type="text" value="{{$nc->action_taken}}" id="action_taken" class="form-control" name="action_taken" placeholder="Action Taken" required>
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

