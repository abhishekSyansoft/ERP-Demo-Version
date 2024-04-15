@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Supplier Quality
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Supplier Quality Details<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Supplier Quality Details:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($sq->id))
           <form method="POST" action="{{ url('sq/update/'.$encryptedId)}}" class="row">
           @csrf
                <div class="mb-3 col-md-6">
                    <label for="supplier_id" class="form-label">{{ __('Supplier') }}</label>
                    <select id="supplier_id"  class="form-control p-3" name="supplier_id" required>
                        <option value="0">--Select supplier--</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{$supplier->id}}"{{$supplier->id == $sq->supplier_id ? 'Selected' : ''}}>{{$supplier->supplier_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="quality_rating" class="form-label">{{ __('Quality Rating') }}</label>
                    <input type="text" value="{{$sq->quality_rating}}" id="quality_rating" class="form-control" name="quality_rating" placeholder="Quality Rating" required>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="audit_date" class="form-label">{{ __('Audit Date') }}</label>
                    <input type="date" value="{{$sq->audit_date}}" id="audit_date" class="form-control" name="audit_date" placeholder="Action Taken" required>
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

