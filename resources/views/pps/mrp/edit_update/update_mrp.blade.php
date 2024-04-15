@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>   Master Production Shedule Managemant
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update  Master Production Shedule<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Master Production Shedule :</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($mrp->id))
           <form method="POST" action="{{ url('mrp/update/'.$encryptedId)}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="material_id" class="form-label">{{ __('Material') }}</label>
                            <select id="material_id"  class="form-control p-3" name="material_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($materials as $material)
                                <option value="{{$mrp->material_id}}"{{$mrp->material_id == $material->id ? 'Selected' :''}}>{{$material->material_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="quantity_required" class="form-label">{{ __('Quantity Required') }}</label>
                            <input type="text" id="quantity_required" class="form-control" name="quantity_required" value="{{$mrp->quantity_required}}" placeholder="Planned quantity for production purpose" required></textarea>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="due_date" class="form-label">{{ __('DueDate') }}</label>
                            <input type="date" id="due_date" class="form-control" name="due_date" value="{{$mrp->due_date}}" required>
                            </div>

                        <div class="mb-3 col-md-6">
                            <label for="order_type" class="form-label">{{ __('Status') }}</label>
                            <select type="text" id="order_type" class="form-control p-3" name="order_type" required>
                                <option value="0" {{$mrp->order_type == 0 ? 'Selected' :''}}>--Select status--</option>
                                <option value="1" {{$mrp->order_type == 1 ? 'Selected' :''}}>Purchasing Order</option>
                                <option value="2" {{$mrp->order_type == 2 ? 'Selected' :''}}>Manufacturing Order</option>
                            </select>
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

