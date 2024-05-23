@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Supplier Quotation/Negotiation
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Supplier Quotation<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Vendor Quotations</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <!-- <button style="float:right;" type="button" class="btn btn-primary animated-button" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>   -->
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
                        <table class="table mx-auto" style="width: 100%;">
                            <tr>
                                <th>S No.</th>
                                <th>Select to Compare</th>
                                <th>Qut Number</th>
                                <th>View Quotation</th>
                                <th>RFQ No.</th>
                                <th>PR No.</th>
                                <th>Vendor Name.</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Send for Approval</th>
                                <th>Send for Negotiation</th>
                                <th>Action</th>
                            </tr>
                            <tbody id="VendorQuotationsLists">
                            @php($i=1)
                            @foreach($sqn as $data)
                              <tr>
                                <td>{{$i++}}</td>
                                <td><input type="checkbox" class="compareCheckBox" data-id="{{$data->qut_num}}"></td>
                                <td>{{$data->qut_num}}</td>
                                <td><a class="mdi mdi-eye btn btn-primary qutbtn" data-qutnum="{{$data->qut_num}}"></a></td>
                                <td>{{$data->rfq_num}}</td>
                                <td>{{$data->pr_num}}</td>
                                <td>{{$data->supplier}}</td>
                                <td>{{number_format(($data->finalAmount)+((18/100)*$data->finalAmount)+3000)}}</td>
                                <td><i class="text-success"></i></td>
                                @if($data->approval == 1)
                                <td><a class="btn mdi mdi-check-circle" style="color:green;font-size:20px;"></a></td>
                                @else
                                <td><a class="btn btn-primary SApprovalQut" data-qutnum="{{$data->qut_num}}">Send For approval</a></td>
                                @endif
                                @if($data->negotiation == 1)
                                <td><a class="btn mdi mdi-check-circle" style="color:green;font-size:20px;"></a></td>
                                @else
                                <td><a class="btn btn-primary SNegoQut" data-qutnum="{{$data->qut_num}}">Send For Negotiation</a></td>
                                @endif
                                <td>
                                  <a class="btn btn-primary">Edit</a>
                                  <a class="btn btn-danger">Delete</a>
                                </td>
                              </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a class="btn btn-primary m-4" id="CompareQutBTN">Compare Quotation</a>
                    <!-- <a data-bs-toggle="modal" data-bs-target="#staticBackdrop">preview</a> -->
                  </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="rfqQUT" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rfqQUTLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h3 class="modal-title" id="rfqQUTLabel"><b>Quotation</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body">
                      <div class="container row mx-auto p-2" style="border:1px solid black;">


                      <div class="col-12 row mt-4">
                            <div class="col-6">
                              <h2 style="color:green;">Akash EnterPrises</h2>
                            </div>
                            <div class="col-6">
                              <h2 style="float:right;">Quotation</h2>
                            </div>
                      </div>

                      <div class="col-12 row mb-2">
                          <p>D-136, Vipul World, Sec-48, Gurugram, Haryana, 122001</p>
                          <div class="col-4"><b>Phone:&nbsp;&nbsp;</b><span>+91-6202074551</span></div>
                          <div class="col-4"><b>GSTIN:&nbsp;&nbsp;</b><span>08AALCR2857A1ZD</span></div>
                          <div class="col-4"><b>PAN Number:&nbsp;&nbsp;&nbsp;</b><span>FSZPK9748D</span></div>
                      </div>


                      <div class="col-12 row mb-2 mx-auto">
                          <hr class="p-1 mb-0" style="background-color:#fa3033;">
                          <div class="col-12 row mx-auto p-2" style="background-color:#ccf0e6;">
                                <div class="col-6"><b>QUT Number :&nbsp;&nbsp;&nbsp;</b><span id="qut_num"> QUT_664c9e11d8caf</span></div>
                                <div class="col-6 text-end"><b>QUT Date :&nbsp;&nbsp;&nbsp;</b><span id="qut_date"> 2024-05-06</span></div>
                          </div>
                      </div>


                      
                        <div id="details" class="row mb-3">
                          <div class="col-md-6">
                            <div><h4><b>Quotation To: </b></h4></div>
                            <div class="mb-1"><b>SyanSoft Pvt. Ltd.</b></div>
                            <div class="mb-1">Unit No. 306, Tower B4, Spaze I-Tech Park, Badshahpur Sohna Rd Hwy, Sector 49, Gurugram, Haryana 122018</div>
                            <div class="mb-1"><b>Phone:&nbsp;&nbsp;&nbsp;</b><span id="phone">+91 8130874884</span></div>
                            <div class="mb-1"><b>GSTIN:&nbsp;&nbsp;&nbsp;</b><span id="gstin">06ABGCS2293D1ZF</span></div>
                            <div class="mb-1"><b>Pan Number:&nbsp;&nbsp;&nbsp;</b><span id="pan_no">FSZPK9748D</span></div>
                          </div>
                          <div class="col-md-2"></div>
                          <div class="col-md-4">
                            <div><h4><b></b></h4></div>
                            <!-- <div class="mb-1"><b>PR Number:&nbsp;&nbsp;&nbsp;</b><span id="pr_num">+91 6202074551</span></div> -->
                            <div class="mb-1"><b>RFQ Number:&nbsp;&nbsp;&nbsp;</b><span id="rfq_num">08AALCR2857A1ZD</span></div>
                            <div class="mb-1"><b>Lead Time:&nbsp;&nbsp;&nbsp;</b><span id="lead_time"></span>&nbsp;&nbsp;weeks</div>
                            <div class="mb-1"><b>Payment Terms:&nbsp;&nbsp;&nbsp;</b><span id="payment_terms"></span>&nbsp;&nbsp;days</div>
                          </div>
                        </div>


                        <!-- <br><br>
                        <h5><b>Item Lists</b></h5> -->
                       <div class="table-wrapper" style="height:auto;margin:0px !important;">
                       <table class="table" style="border:0px !important;">
                          <thead>
                            <th style="background-color:#9d98c3 !important;">S No.</th>
                            <th style="background-color:#9d98c3 !important;">Item Name</th>
                            <th style="background-color:#9d98c3 !important;">Feature</th>
                            <th style="background-color:#9d98c3 !important;">Quantity</th>
                            <th style="background-color:#9d98c3 !important;">Unit Price</th>
                            <th style="background-color:#9d98c3 !important;">Total</th>
                          </thead>
                          <tbody id="QUTItemViewAllList">
                            <tr>
                              <td>1</td>
                              <td>Laptop</td>
                              <td>NA</td>
                              <td>3</td>
                              <td>2000</td>
                              <td>6000</td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>Laptop</td>
                              <td>NA</td>
                              <td>3</td>
                              <td>2000</td>
                              <td>6000</td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>Laptop</td>
                              <td>NA</td>
                              <td>3</td>
                              <td>2000</td>
                              <td>6000</td>
                            </tr>

                          </tbody>
                        </table>
                       </div>

                      <div class="col-12 row mx-auto">
                        <div class="col-7 mt-3 p-0">
                        <div class="col-12">
                       <div><b> Note's: </b></div>
                       <ul>
                         <li>No Return Deal</li>
                       </ul>
                       </div>

                       <div class="col-12">
                       <div><b>Terms & Condition's: </b></div>
                       <ul>
                         <li>Customer will pay the GST</li>
                         <li>Customer will pay the Delivery Chargers</li>
                         <li>Pay due amount within 15 days</li>
                       </ul>
                       </div>

                          </div>
                        <div class="col-5 mt-3 p-0">
                          
                         <table class="table">
                          <!-- <tbody style="float:right;"> -->
                            <tr>
                              <th style="background-color:#9d98c3 !important;">Sub Total</th>
                              <td id="sub_total">Rs. 555.00</td>
                            </tr>
                            <tr>
                              <th style="background-color:#9d98c3 !important;">CGST</th>
                              <td id="cgst">Rs. 55.00</td>
                            </tr>
                            <tr>
                              <th style="background-color:#9d98c3 !important;">SGST</th>
                              <td id="sgst">Rs. 55.00</td>
                            </tr>
                            <tr>
                              <th style="background-color:#9d98c3 !important;">Others</th>
                              <td id="others">Rs. 5.00</td>
                            </tr>
                            <tr>
                              <th style="background-color:#9d98c3 !important;">Total</th>
                              <td id="total_amount">Rs. 670.00</td>
                            </tr>
                          <!-- </tbody> -->
                         </table>

                        </div>
                      </div>
                        <br><br>

                       <div class="col-12">
                        <p><b>Signature :</b><i class="mdi mdi-check-circle" style="color:green;font-size:20px;">Digitally Verified Signature</i></p>
                       </div>

                       <div class="col-12">
                        <p style="float:right;"><b>Thank you for your business!</b></p>
                       </div>
                        
                      </div>
                      
                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                      </div>
                    </div>
                  </div>
                </div>

          
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSupplierModalLabel">Add Supplier Quotation/Negotiation</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('sqn.store')}}" class="row">
                        @csrf
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
                            <label for="item_id" class="form-label">{{ __('Item') }}</label>
                            <select id="item_id"  class="form-control p-3" name="item_id" required>
                                <option value="0">--Select Item--</option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="price" class="form-label">{{ __('Price') }}</label>
                            <input type="text" id="price" class="form-control" name="price" placeholder="Enter the negotiated price" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="valid_until" class="form-label">{{ __('Valid Until') }}</label>
                            <input type="date" id="valid_until" class="form-control" name="valid_until" required>
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
                        <h5 class="modal-title" id="staticBackdropLabel">Comparision of Quotations</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body compare">

                     <center> <h2>Quotation Comparison</h2></center>

                        <div class="table-wrapper" style="height:auto !important;">
                          <table class="table table-bordered border-primary">

                            <tbody id="CompSupplierList">
                            </tbody>
                          </table>
                        </div>

                        <div class="table-wrapper" style="height:auto !important;">
                        <table class="table table-bordered mt-2">
                          <thead>
                              <tr>
                                <th>Serial No</th>
                                <th>Vendor Name</th>
                                <th>Quotation Number</th>
                                <th class="text-center">Send For Approval</th>
                                <th class="text-center">Send For Negotiation</th>
                              </tr>
                          </thead>
                        <tbody id="actionOnCompQuot">
                        </tbody>
                        </table>
                        </div>
                        <div class="form-group mt-2">
                          <!-- <button type="submit" class="btn btn-success">Check one to edit</button> -->
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
