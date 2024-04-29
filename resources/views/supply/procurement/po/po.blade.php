@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Purchase Orders
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Contract Management:<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
              
            <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Purchase Order Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                          @if(Auth::user()->admin == 3)
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
                        <table class="table">
                            <tr>
                                <th>S No.</th>
                                <!-- <th>Quotation View</th> -->
                                <th>PO Number</th>
                                <th>PR Number</th>
                                <th>Product</th>
                                <th>Sub Category</th>
                                <th>Category</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Supplier</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <!-- <th>Total Amount</th> -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($po as $data)
                            @for($a=0;$a<4;$a++)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <!-- <td><a class="mdi mdi-eye" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a></td> -->
                                    <!-- <td><a class="mdi mdi-file" style="font-size:20px;color:red;" href="https://www.wordtemplatesonline.net/wp-content/uploads/2021/06/Quotation-Template-06-2021-04.jpg"></a></td> -->
                                    <td>PO{{mt_rand(1000, 9999)}}</td>
                                    <td>PR{{mt_rand(1000, 9999)}}</td>
                                    <!-- <td>VEN{{mt_rand(1000, 9999)}}</td> -->
                                  
                                    <td>Bike</td>
                                    <td></td>
                                    <td>Vehicle</td>
                                    <td>Item</td>
                                    <td>29</td>
                                    
                                    <td>{{$data->supplier}}</td>
                                    <td>{{$data->order_date}}</td>
                                    <td>{{$data->delivery_date}}</td>
                                    <!-- <td>{{$data->total_amount}}</td> -->
                                    <td>{{$data->status == 1 ? 'Pending' : ($data->status == 2 ? 'Issued' : ($data->status == 3 ? 'Received' : '')) }}</td>
                                    @php($encryptedId = encrypt($data->id)) 
                                    <td>
                                      @if(Auth::user()->admin == 3)
                                        <a href="{{url('edit-po/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('delete-po/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                                        <a class="btn btn-success approvalBTN">Send to approve</a>
                                      @else
                                        <a class="btn btn-success createInvoice" data-bs-toggle="modal" data-bs-target="#downloadInvoiceModal">Create Invoice</a>
                                      @endif
                                    </td>
                                </tr>
                                @endfor
                            @endforeach
                        </table>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Purchase Orders</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('po.store')}}" class="row" id="createPOform">
                        @csrf


                        <div class="mb-3 col-md-6">
                            <label for="order_no" class="form-label">{{ __('Order No') }}</label>
                            <select id="order_no"  class="form-control p-3" name="order_no" required>
                                <option value="0">--Select Order--</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier->id}}">Order_no_{{mt_rand(1000, 9999)}}</option>
                                @endforeach
                            </select>
                        </div>

<center>
                        <div class="mb-3 col-md-10 demotable" style="display:none;">
                        <table class="table table-bordered">
                                <tr>
                                  <th>S no.</th>
                                  <th>Item Code</th>
                                  <th>Item Name</th>
                                  <th>Unit</th>
                                </tr>
                                <tr>
                                 <td> 1</td>
                                 <td>7925</td>
                                 <td>Wheel</td>
                                 <td>17</td>
                                </tr>

                                <tr>
                                 <td> 2</td>
                                 <td>9232</td>
                                 <td>Meter</td>
                                 <td>12</td>
                                </tr>

                                <tr>
                                 <td> 3</td>
                                 <td>2342</td>
                                 <td>Handle</td>
                                 <td>20</td>
                                </tr>

                                <tr>
                                 <td> 4</td>
                                 <td>679</td>
                                 <td>Break Shoe</td>
                                 <td>2</td>
                                </tr>
                              </table>
                            </div>
                            </center>


                        <div class="mb-3 col-md-6">
                            <label for="supplier_id" class="form-label">{{ __('Supplier') }}</label>
                            <select id="supplier_id"  class="form-control p-3" name="supplier_id" required>
                                <option value="0">--Select Supplier--</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="order_date" class="form-label">{{ __('Order Date') }}</label>
                            <input type="date" id="order_date" class="form-control" name="order_date" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="delivery_date" class="form-label">{{ __('Delivery Date') }}</label>
                            <input type="date" id="delivery_date" class="form-control" name="delivery_date" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="total_amount" class="form-label">{{ __('Total Amount') }}</label>
                            <input type="text" id="total_amount" class="form-control" name="total_amount" placeholder="Enetr terms & condition" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select id="status" class="form-control p-3" name="status" required>
                                <option value="0">--Select Option--</option>
                                <option value="1">Pending</option>
                                <option value="2">Issued</option>
                                <option value="3">Received</option>
                            </select>
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



<!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Quotation regarding PO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body">

                      <center><h2><u>Quotation</u></h2><br><br><br><br></center>
                      <h1><a href="{{asset('images/products/quotation.docx')}}" class="mdi mdi-file-pdf mb-3"><span style="font-size:18px;">click to download</span></a></h1>

                          <div class="row">

                          <!-- Sender company details -->
                          <div class="sender-company col-md-9">
                            <h4>Company Detail's : </h4>
                            <hr>
                            <p><strong>Sender Company Name:</strong> SyanSoft</p>
                            <p><strong>Contact Person:</strong> Jane Smith</p>
                            <p><strong>Contact Number:</strong> 987-654-3210</p>
                            <p><strong>Email:</strong> jane@example.com</p>
                            <!-- Add more sender company details as needed -->
                          </div>

                          <!-- Supplier details -->
                          <div class="supplier-details col-md-3">
                            <h4>Supplier Detail's :</h4>
                            <hr>
                            <p><strong>Supplier Name:</strong> ABC Supplier</p>
                            <p><strong>Contact Person:</strong> John Doe</p>
                            <p><strong>Contact Number:</strong> 123-456-7890</p>
                            <p><strong>Email:</strong> john@example.com</p>
                            <!-- Add more supplier details as needed -->
                          </div>

                          <!-- Company details -->
                          <!-- <div class="company-details">
                            <p><strong>Company Name:</strong> XYZ Company</p>
                            <p><strong>Contact Person:</strong> Jane Smith</p>
                            <p><strong>Contact Number:</strong> 987-654-3210</p>
                            <p><strong>Email:</strong> jane@example.com</p> -->
                            <!-- Add more company details as needed -->
                          <!-- </div> -->


                          </div>
                          <!-- Items -->
                          <table class="quotation-table  table table-bordered">
                            <tr>
                              <th>Item</th>
                              <th>Description</th>
                              <th>Quantity</th>
                              <th>Unit Price</th>
                              <th>Total</th>
                            </tr>
                            <tr>
                              <td>Product A</td>
                              <td>Description of Product A</td>
                              <td>2</td>
                              <td>$50</td>
                              <td>$100</td>
                            </tr>
                            <tr>
                              <td>Product B</td>
                              <td>Description of Product B</td>
                              <td>1</td>
                              <td>$75</td>
                              <td>$75</td>
                            </tr>
                          </table>

                          <!-- Total amount
                          <div class="total-amount">
                            <p><strong>Total Amount:</strong> $175</p>
                          </div> -->

                          <!-- Other details -->
                          <hr>
                          <div class="other-details row mx-auto mt-2">
                          <p class=" col"><strong>Total Amount:</strong> $175</p>
                            <p class=" col"><strong>PR Number:</strong> PR12345</p>
                            <p class=" col"><strong>PO Number:</strong> PO67890</p>
                            <p class=" col"><strong>Validity:</strong> 30 days</p>
                            <p class=" col"><strong>Delivery Time:</strong> 2 weeks</p>
                            <!-- Add more details as needed -->
                          </div>
                           <!-- <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                            Check one to edit
                            </button>   -->
                          <button type="button" class="btn btn-secondary">Close</button>
                        </div>
                        </form>
                      </div>
                      
                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                      <!-- </div> -->
                    </div>
                  </div>
                </div>
                <!-- </div>
                  </div> -->
                <!-- </div> -->


          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
