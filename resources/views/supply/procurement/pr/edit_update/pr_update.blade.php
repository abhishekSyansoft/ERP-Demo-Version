@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>   Purchase Requisition
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Purchase Requisition <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Purchase Requisition :</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($pr->id))
           <form method="POST" action="{{ url('pr/update/'.$encryptedId)}}" class="row">
                        @csrf
                        <div class="mb-3 col-md-6">
                            <label for="user_id" class="form-label">{{ __('User') }}</label>
                            <select id="user_id"  class="form-control p-3" name="user_id" required>
                                <option value="0">--Select Product--</option>
                                @foreach($users as $user)
                                <option value="{{$pr->user_id}}"{{$pr->user_id == $user->id ? 'Selected' :''}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="requisition_date" class="form-label">{{ __('Requisition Date') }}</label>
                            <input type="text" id="requisition_date" class="form-control" name="requisition_date" value="{{$pr->requisition_date}}" placeholder="Planned quantity for production purpose" required></textarea>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select type="text" id="status" class="form-control p-3" name="status" required>
                                <option value="0" {{$pr->status == 0 ? 'Selected' :''}}>--Select status--</option>
                                <option value="1" {{$pr->status == 1 ? 'Selected' :''}}>Pending</option>
                                <option value="2" {{$pr->status == 2 ? 'Selected' :''}}>Approved</option>
                                <option value="3" {{$pr->status == 3 ? 'Selected' :''}}>Cancelled</option>
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

