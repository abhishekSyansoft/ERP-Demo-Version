@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>  Resource Management
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Resource<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Resource :</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($resources->id))
           <form method="POST" action="{{ url('resource/update/'.$encryptedId)}}" class="row">
                        @csrf
                        <div class="mb-3">
                            <label for="resource_name" class="form-label">{{ __('Resource Name') }}</label>
                            <input id="resource_name" type="text" class="form-control" name="resource_name" value="{{$resources->resource_name}}" placeholder="Name of the Resource" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="resource_description" class="form-label">{{ __('Resource Description') }}</label>
                            <textarea rows="10" id="resource_description" class="form-control" name="resource_description" value="{{$resources->resource_description}}" placeholder="Description or additional details about the resource" required>{{$resources->resource_description}}</textarea>
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

