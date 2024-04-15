@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Sales And Operations Planning
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Sales And Operations Planning<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Sales And Operations Planning:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($dc->id))
           <form method="POST" action="{{ url('dc/update/'.$encryptedId)}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="product_id" class="form-label">{{ __('Product') }}</label>
                            <select id="product_id"  class="form-control p-3" name="product_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}"{{$dc->product_id == $product->id ? 'Selected':''}}>{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="collabration_id" class="form-label">{{ __('Collabarator') }}</label>
                            <select id="collabration_id"  class="form-control p-3" name="collabration_id" required>
                                <option value="0">--Select colaborator--</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}"{{$dc->collaborator_id == $user->id ? 'Selected':''}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="forecast_quantity" class="form-label">{{ __('Forecast Quantity') }}</label>
                            <input type="text" id="forecast_quantity" class="form-control" value="{{$dc->forecast_quantity}}" name="forecast_quantity"  placeholder="Enter quantity" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="collaboration_date" class="form-label">{{ __('Collaboration Date') }}</label>
                            <input type="date" id="collaboration_date" class="form-control" name="collaboration_date" value="{{$dc->collaboration_date}}"  placeholder="Enter the production Target" required>
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

