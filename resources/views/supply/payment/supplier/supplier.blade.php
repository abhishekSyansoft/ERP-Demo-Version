@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Goods Recieving Note's:
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>  Invoices Recieved:<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Supplier Profile</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                          @if(Auth::user()->admin==3)
                        <!-- <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>   -->
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
                        <table class="table table-bordered border-primary" style="width: 100%;">
                            <tr>
                              <th rowspan="3">S. No.</th>
                              <th colspan="12">Supplier</th>
                              <!-- <th rowspan="2">Action</th> -->
                            </tr>
                            <tr>
                              <th rowspan="2">Name</th>
                              <th rowspan="2">ID</th>
                              <th colspan="3">Account</th>
                              <th rowspan="2">Tax ID</th>
                              <th rowspan="2">payment Terms</th>
                              <th rowspan="2">Lead Time</th>
                              <th rowspan="2">Supplier Type</th>
                              <th rowspan="2">Contract Terms</th>
                              <th rowspan="2">Tin Number</th>
                              <th rowspan="2">GSTIN</th>
                            </tr>
                            <tr>
                              <th>Number</th>
                              <th>IFSC Code</th>
                              <th>Branch</th>
                            </tr>
                            @php($i=1)
                            @foreach($suppliers as $data)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$data->supplier_name}}</td>
                              <td>{{$data->supplier_id}}</td>
                              <td>{{$data->account_number}}</td>
                              <td>BKID0004947</td>
                              <td>SIKIDIRI</td>
                              <td>{{$data->tax_id}}</td>
                              <td>{{$data->lead_time}}</td>
                              <td>{{$data->payment_terms}}</td>
                              <td>{{$data->type}}</td>
                              <td>{{$data->contract_terms}}</td>
                              <td>{{$data->tin_no}}</td>
                              <td>{{$data->gst_in}}</td>
                              <!-- <td>

                              </td> -->
                            </tr>
                            @endforeach
                        </table>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>


 

<!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Goods Receiving Note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body ">
                        <center><h2>Goods Receiving Note</h2></center>
                        <hr>

                      <table class="grn-table table table-bordered">
                          <tr>
                            <th><strong>Headings</strong></th>
                            <th><strong>Details</strong></th>
                          </tr>
                          <tr>
                            <td><strong>Supplier Information:</strong></td>
                            <td>Name: ABC Supplier<br>Contact: 123-456-7890</td>
                          </tr>
                          <tr>
                            <td><strong>Receiver Information:</strong></td>
                            <td>Name: John Doe<br>Contact: johndoe@example.com</td>
                          </tr>
                          <tr>
                            <td><strong>Goods Details:</strong></td>
                            <td>
                              <table class="table table-bordered p-2">
                                <tr><th>Item</th><th>Description</th><th>Quantity</th></tr>
                                <tr><td>Product A</td><td>Description of Product A</td><td>10</td></tr>
                                <tr><td>Product B</td><td>Description of Product B</td><td>5</td></tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td><strong>Purchase Order Information:</strong></td>
                            <td>PO Number: PO12345<br>Date: 2024-04-18</td>
                          </tr>
                          <tr>
                            <td><strong>Delivery Details:</strong></td>
                            <td>Date: 2024-04-18<br>Mode of Transportation: Truck</td>
                          </tr>
                          <!-- Add more details as needed -->
                        </table>
                        <hr>
                        <div class="form-group mt-2">
                          <!-- <button type="submit" class="btn btn-success">Check one to edit</button> -->
                           <!-- <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                            Check one to edit
                            </button>   -->
                          <button type="button" class="btn btn-secondary">Close</button>
                        </div>
                        <!-- </form> -->
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
