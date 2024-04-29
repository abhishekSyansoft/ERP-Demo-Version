@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Update Material
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Material<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Material :</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($rawmaterial->id))
           <form method="POST" action="{{ url('raw-material/update/'.$encryptedId)}}" class="row">
                        @csrf

                        <div class="mb-3 col-md-6">
                            <label for="material_name" class="form-label">{{ __('Material Name') }}</label>
                            <input id="material_name" type="text" class="form-control" name="material_name" value="{{$rawmaterial->material_name}}" required autofocus>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="material_description" class="form-label">{{ __('Material Description') }}</label>
                            <input type="text" id="material_description" class="form-control" name="material_description" value="{{$rawmaterial->material_description}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="unit_of_measure" class="form-label">{{ __('Unit of Measure') }}</label>
                            <input id="unit_of_measure" type="text" class="form-control" name="unit_of_measure" value="{{$rawmaterial->unit_of_measure}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="lead_time" class="form-label">{{ __('Lead Time') }}</label>
                            <input id="lead_time" type="text" class="form-control" name="lead_time" value="{{$rawmaterial->lead_time}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="safety_stock" class="form-label">{{ __('Safety Stock') }}</label>
                            <input id="safety_stock" type="text" class="form-control" name="safety_stock" value="{{$rawmaterial->safety_stock}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="storage_condition" class="form-label">{{ __('Storage Condition') }}</label>
                            <input id="storage_condition" type="text" class="form-control" name="storage_condition" value="{{$rawmaterial->storage_condition}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="shelf_life" class="form-label">{{ __('Shelf Life') }}</label>
                            <input id="shelf_life" type="text" class="form-control" name="shelf_life" value="{{$rawmaterial->shelf_life}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="supplier_id" class="form-label">{{ __('Supplier') }}</label>
                            <select id="supplier_id" class="form-control p-3" name="supplier_id">
                                <option value="">--Select--</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier->id}}"{{ $supplier->id == $rawmaterial->supplier_id ? 'selected' : '' }}>{{$supplier->supplier_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="cost_per_unit" class="form-label">{{ __('Cost Per Unit') }}</label>
                            <input id="cost_per_unit" type="text" class="form-control" name="cost_per_unit" value="{{$rawmaterial->cost_per_unit}}" required>
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        </div>
                    </form>
                </div>
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
          <!-- content-wrapper ends -->
@include('admin.layout.footer')

