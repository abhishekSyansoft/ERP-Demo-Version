@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>Invoice Management
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Invoice Detail<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            <h4 class="card-title">Update Invoice :</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($invoices->id))
           <form method="POST" action="{{ url('invoices/update/'.$encryptedId)}}" enctype="multipart/form-data" class="row">
                        @csrf
                        
                        <div class="mb-3 col-md-6">
                            <label for="invoice_number" class="form-label">{{ __('Invoice Number') }}</label>
                            <input type="text" id="invoice_number" class="form-control" name="invoice_number" value="{{$invoices->invoice_number}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="invoice_date" class="form-label">{{ __('Invoice date') }}</label>
                            <input type="date" id="invoice_date" class="form-control" name="invoice_date" value="{{$invoices->invoice_date}}"  required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="invoice_total" class="form-label">{{ __('Invoice Total Amount') }}</label>
                            <input type="text" id="invoice_total" class="form-control" name="invoice_total" value="{{$invoices->invoice_total}}" placeholder="Enter total amount"  required>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="attachments" class="form-label">{{ __('Attachments') }}</label>
                            <input type="file" id="attachments" class="form-control" name="attachments">
                            <h5><a href="{{asset('Storage/'.$invoices->attachment)}}"><i style="color:red;font-size:30px;" class="mdi mdi-file"><span style="color:black;font-size:15px;">click to check old file</span></i></a></h5>
                        </div>

                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        </div>
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
          <!-- content-wrapper ends -->
@include('admin.layout.footer')

