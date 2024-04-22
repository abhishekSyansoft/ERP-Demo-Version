@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Invoices Management
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Invoice<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
              
            <div class="row mx-auto">
              <div class="col-md-12" style="margin:auto;">
                <div class="card mx-auto">
                  <div class="card-body">
                    <div class="clearfix">
                         <!-- Button to open the modal -->
                         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                        Add Invoice Details
                        </button>  
                        <hr>
                      <h4 class="card-title float-left">Invoices Lists</h4>
                           
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                        Edit Supplier
                        </button>   -->

                        <!-- <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit Order &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button> -->
                        
                        
                <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div class="">
                        <table class="table table-hover table-bordered mt-2 mx-auto"style="width: 100%;">
                            <tr>
                                <th>S No.</th>
                                <th>Invoice Number</th>
                                <th>Invoice Date</th>
                                <th>Invoice Total Amount</th>
                                <th>Invoice PDF</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($invoices as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$data->invoice_number}}</td>
                                    <td>{{$data->invoice_date}}</td>
                                    <td>{{$data->invoice_total}}</td>
                                    <td><h1><a  style="color:red;" href="{{asset('Storage/'.$data->attachment)}}" class="mdi mdi-file"></a></h1></td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                        <a href="{{url('edit-invoice/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-invoice/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <!-- <a class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Compare Quotation</a> -->
                    </div>
                </div>
              </div>
            </div>
          </div>


          
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSupplierModalLabel">Add Invoice</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('invoices.store')}}" enctype="multipart/form-data" class="row">
                        @csrf
                        
                        <div class="mb-3 col-md-6">
                            <label for="invoice_number" class="form-label">{{ __('Invoice Number') }}</label>
                            <input type="text" id="invoice_number" class="form-control" name="invoice_number" value="{{uniqid().uniqid()}}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="invoice_date" class="form-label">{{ __('Invoice date') }}</label>
                            <input type="date" id="invoice_date" class="form-control" name="invoice_date"  required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="invoice_total" class="form-label">{{ __('Invoice Total Amount') }}</label>
                            <input type="text" id="invoice_total" class="form-control" name="invoice_total" placeholder="Enter total amount"  required>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="attachments" class="form-label">{{ __('Attachments') }}</label>
                            <input type="file" id="attachments" class="form-control" name="attachments">
                        </div>

                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>


          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
