@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel p-1 m-0">
          <div class="content-wrapper m-0 p-1">
            
              
                
          <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Invoices Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                          @if(Auth::user()->admin == 1)
                        <button style="float:right;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>  
                        @endif
                        </div>
                        <!-- <hr>   -->
                      </div>     
                           
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                        Edit Supplier
                        </button>   -->
                        <!-- <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit Order &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button> -->
                        
                        
                <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <div class="table-wrapper">
                        <table class="table" style="width: 100%;">
                            <tr>
                                <th>S No.</th>
                                
                                <th>View</th>
                                <!-- <th>Create</th> -->
                                <th>RFQ No.</th>
                                <th>QUT No.</th>
                                <th>PO No.</th>
                                <!-- <th>Vendor Name.</th> -->
                                <th>Product</th>
                                <th>Sub Category</th>
                                <th>Category</th>
                                <!-- <th>Item</th> -->
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Invoice Number</th>
                                <th>Invoice Total Amount</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                                <!-- <th>Invoice PDF</th> -->
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($invoices as $data)
                            @for($a=0;$a<6;$a++)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a href="https://www.projectmanager.com/wp-content/uploads/2021/01/RFQ-Screenshot-600x508.jpg" style="background-image:linear-gradient(to right, #283b96, #96a1d6);color:white;border-radius:5px;" class="btn mdi mdi-eye p-2 mt-2 mb-2"></a></td>
                                   
                                    <td>RFQ{{mt_rand(1000, 9999)}}</td>
                                    <td>VEN{{mt_rand(1000, 9999)}}</td>
                                    <td>PO{{mt_rand(1000, 9999)}}</td>
                                  
                                    <td>Bike</td>

                                    <td></td>
                                    <td>Vehicle</td>
                                    <td>25</td>
                                    <td>Rs. {{mt_rand(1000, 9999)}}</td>
                                    <!-- <td>28</td> -->
                                    <td>Invoice_{{mt_rand(1000, 9999)}}</td>
                                   
                                    <td>Rs. {{$data->invoice_total}}</td>
                                    <td>{{$data->invoice_date}}</td>
                                    <td>Approved</td>
                                    <!-- <td><h1><a  style="color:red;" href="{{asset('Storage/'.$data->attachment)}}" class="mdi mdi-file"></a></h1></td> -->
                                    @php($encryptedId = encrypt($data->id)) 
                                    @if(Auth::user()->admin == 3)
                                    <td>
                                        <a href="{{url('edit-invoice/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-invoice/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                    @else
                                    <td>
                                    <a type="button" class="btn btn-primary createInvoice" data-bs-toggle="modal" data-bs-target="#downloadInvoiceModal">
                                      Create Invoice
                                    </a>                                        
                                    <a  class="btn btn-danger">Send</a>
                                    </td>
                                    @endif
                                </tr>
                                @endfor
                            @endforeach
                        </table>
                        <!-- <a class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Compare Quotation</a> -->
                    </div>
                </div>
              </div>
            </div>
          </div>
          </div>


          <!-- Modal -->
          <div class="modal fade" id="downloadInvoiceModal" tabindex="-1" aria-labelledby="downloadInvoiceModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:white;">
              <div class="modal-header">
                <h5 class="modal-title" id="downloadInvoiceModalLabel">Download Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <center>
                  <img src="https://cdn.vertex42.com/WordTemplates/images/word-invoice-template.png" id="invoice-image" style="object-fit:contain;" alt="Invoice">
                </center>
                <div class="mt-3 text-center">
                  <!-- Download button -->
                  <a href="https://cdn.vertex42.com/WordTemplates/images/word-invoice-template.png" download="invoice.png" class="btn btn-primary mx-2">Download</a>
                  <!-- Print button -->
                  <!-- <button onclick="printImage('invoice-image')" class="btn btn-secondary mx-2">Print</button> -->
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
                            <input type="text" id="invoice_number" class="form-control" name="invoice_number" value="{{ uniqid() . dechex(\Carbon\Carbon::now()->timestamp) }}" required>
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
