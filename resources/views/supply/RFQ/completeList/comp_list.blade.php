@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Material Requirment Planning
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Matrial Requirment Planning<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Request For Quotation</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
   
                        <!-- <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
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
                        <table class="table" style="width: 100%;">
                            <tr>
                                <th>S. No.</th>
                                <!-- <th>PR Number</th>
                                <th>PR View</th> -->
                                <th>RFQ Number</th>
                                <th>QUT Number</th>
                                <th>Preview Quotation</th>
                                <th>Create Quotation</th>
                                <th>Send Quotation</th>
                                <th>Date Of submission (on or before)</th>
                                <!-- <th>Notes/Comments</th> -->
                               <th>Action</th>
                            </tr>
                            @php($a=1)
                            @foreach($rfq as $rfqs)
                           
                              <tr>
                                <td>{{$a++}}</td>
                               
                                <td>{{$rfqs->rfq_num}}</td>
                                <td>{{$rfqs->qut_num}}</td>
                                @if($rfqs->qut_status == 1)
                                <td><a class="mdi mdi-eye btn btn-primary qutbtn" data-qutnum="{{$rfqs->qut_num}}"></a></td>
                                @else
                                <td></td>
                                @endif
                                @if($rfqs->qut_status == 1)
                                <td><a class="btn mdi mdi-check-circle" style="color:green;font-size:20px;"></a></td>
                                @else
                                <td><a class="btn btn-primary createQuotation" data-prnum="{{$rfqs->pr_num}}" data-rfqnum="{{$rfqs->rfq_num}}">Create Quotation</a></td>
                                @endif
                                @if($rfqs->qut_status == 1 && $rfqs->send_status == null)
                                    <td><a class="btn btn-primary sendQut" data-qutnum="{{ $rfqs->qut_num }}">Send Quotation</a></td>
                                @elseif($rfqs->qut_status == 1 && $rfqs->send_status == 1)
                                    <td><a class="btn mdi mdi-check-circle" style="color: green; font-size: 20px;"></a></td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{$rfqs->dos}}</td>
                                <!-- <td></td> -->
                                <td>
                                  <a class="btn btn-primary">Edit</a>
                                  <a class="btn btn-danger">Delete</a>
                                </td>
                              </tr>
                             
                            @endforeach 
                        </table>
                  <!-- </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>




<!-- Modal -->
<div class="modal fade" id="updateQuotation" tabindex="-1" aria-labelledby="updateQuotationLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h5 class="modal-title" id="updateQuotationLabel">Quotation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form method="POST" class="row" id="quotationCreateForm">
       @csrf

                    <div class="mb-3 col-md-6 col-lg-3">
                        <label for="pr_num" class="form-label">{{ __('PR Number') }}</label>
                        <input type="text" name="pr_num" id="pr_num" class="form-control" placeholder="PR Number for which the quotation is raised">
                    </div>

                    <div class="mb-3 col-md-6 col-lg-3">
                        <label for="rfq_num" class="form-label">{{ __('RFQ Number') }}</label>
                        <input type="text" name="rfq_num" id="rfq_num" class="form-control" placeholder="RFQ Number on which quotation will be prepared">
                    </div>
                  
                    <div class="mb-3 col-md-6 col-lg-3">
                        <label for="qut_num" class="form-label">{{ __('Quotation Number') }}</label>
                        <input type="text" name="qut_num" id="qut_num" class="form-control" placeholder="Quotation Number for uniquie idendification" value="{{'QUT_'.uniqid()}}">
                    </div>

                    <div class="mb-3 col-md-6 col-lg-3">
                        <label for="payment_terms" class="form-label">{{ __('Payment Terms') }}</label>
                        <input type="text" id="payment_terms" class="form-control" name="payment_terms" placeholder="Payment terms discussed with the vendor">
                    </div>


                    <div class="mb-3 col-md-6 col-lg-3">
                        <label for="lead_time" class="form-label">{{ __('Lead Time') }}(weeks)</label>
                        <input type="text" id="lead_time" class="form-control" name="lead_time" placeholder="Lead Time fixed for the dealer" required>
                    </div>

                    <div class="mb-3 col-md-6 col-lg-3">
                        <label for="qut_date" class="form-label">{{ __('Quotation Date') }}</label>
                        <input type="date" id="qut_date" class="form-control" name="qut_date" value="{{ date('Y-m-d') }}" placeholder="Date when the quotation is prepared" required>
                    </div>

                    <div class="mb-3">
                      <hr>
                      <h4>Item Lists</h4>
                      <hr>
                    </div>  
                    
                    <div class="mb-3 col-md-6 col-lg-3">
                        <label for="item_name" class="form-label">{{ __('Item Name') }}</label>
                        <select type="text" id="item_name" class="form-control p-3" name="item_name">
                          <option value="">--Select item--</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6 col-lg-3">
                        <label for="feature" class="form-label">{{ __('Feature') }}</label>
                        <input type="text" id="feature" class="form-control" name="feature" placeholder="If there is any specific requirment or features">
                    </div>

                    <div class="mb-3 col-md-6 col-lg-3">
                        <label for="quantity" class="form-label">{{ __('Quantity') }}</label>
                        <input type="text" id="quantity" class="form-control" name="quantity" placeholder="Quantity required to purchase for a particular item">
                    </div>

                    <div class="mb-3 col-md-6 col-lg-3">
                        <label for="unitprice" class="form-label">{{ __('Unit Price') }}</label>
                        <input type="text" id="unitprice" class="form-control" name="unitprice" placeholder="Price of one unit of item">
                    </div>

                        <div class="mb-3 col-md-12">
                        
                          <div class="table-wrapper m-0 p-0" style="margin:0px !important; height:auto !important;">
                            <table class="table table-bordered border-primary">
                              <thead>
                                <tr>
                                  <!-- <th>S. No.</th> -->
                                  <th>QUT Number</th>
                                  <th>PR Number</th>
                                  <th>RFQ Number</th>
                                  <th>Item Name</th>
                                  <th>Feature</th>
                                  <th>Quantity</th>
                                  <th>Unitprice</th>
                                  <th>Amount</th>
                                  <!-- <th>Delete</th> -->
                                </tr>
                              </thead>
                              <tbody id="itemlistsQUT">
                               
                              </tbody>
                            </table>
                          </div>
                        </div>


                        <div class="mb-3 col-md-12">
                          <a class="btn btn-primary" id="add_item_qut">Add Items</a>
                        </div>

                        <div class="mb-3 col-md-12">
                          <hr>
                        </div>
                        <div class="mb-3 col-md-12">
                          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>    
                        
       </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
</div>






          
<!-- Add Supplier Modal -->
<div class="modal fade" id="rfqPR" tabindex="-1" aria-labelledby="rfqPRLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="rfqPRLabel">Purchase Requisition</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
        <div class="container p-3" style="border:1px solid black;">
                        <h2 class="text-center">Purchase Requisition</h2>
                        <h6 class="text-center">The Owner's Corporation of SyanSoft Pvt. Ltd.</h6>
                        <div style="float:right;"><b>PR No. </b><span id="pr_number">  PR_6647027e0e15e  </span></div><br><br><br>

                        <div><b>Delivery: </b><span id="del_date"> 2024-05-17 </span><b>(on or before) </b></div><br><br>

                        <div id="details" class="row">
                          <div class="col-md-6">
                            <div><h4><b>Requester Details: </b></h4></div>
                            <div class="mb-1"><b>Name:&nbsp;&nbsp;&nbsp;</b><span id="req_name">Abhishek Kumar</span></div>
                            <div class="mb-1"><b>Email:&nbsp;&nbsp;&nbsp;</b><span id="req_email">kumarpuplish@gmail.com</span></div>
                            <div class="mb-1"><b>Phone:&nbsp;&nbsp;&nbsp;</b><span id="req_phone">+91 6202074551</span></div>
                            <div class="mb-1"><b>Designation:&nbsp;&nbsp;&nbsp;</b><span id="req_desig">PHP Developer</span></div>
                          </div>
                          <div class="col-md-6">
                            <div><h4><b>Delivery Location: </b></h4></div>
                            <div class="mb-1"><b>Street Address:&nbsp;&nbsp;&nbsp;</b></><span id="street_address">&nbsp;&nbsp;&nbsp;D-136, Fazilpur Road, Sec-48</span></div>
                            <div class="mb-1"><b>City:&nbsp;&nbsp;&nbsp;</b><span id="del_city">&nbsp;&nbsp;&nbsp;Gurugram</span></div>
                            <div class="mb-1"><b>State:&nbsp;&nbsp;&nbsp;</b><span id="del_state">&nbsp;&nbsp;&nbsp;Haryana</span></div>
                          </div>
                        </div>


                        <br><br>
                        <h5><b>Item Lists</b></h5>
                       <div class="table-wrapper" style="height:auto;margin:0pc !important;">
                       <table class="table table-bordered border-primary">
                          <!-- <thead> -->
                            <th>S No.</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Features</th>
                          <!-- </thead> -->
                          <tbody id="prItemViewAllList">

                          </tbody>
                        </table>

                       </div>
                        <br>

                        <div><b> Request For Department: </b><span id="req_depatment">IT Department</span></div>
                        <div><b> Purpose: </b><span id="purpose">Fullfilment f products to the employees</span></div>
                   
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
                            <div class="mb-1"><b>Payment before Delivery (%):&nbsp;&nbsp;&nbsp;</b><span id="payment_terms"></span>&nbsp;&nbsp;days</div>
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
                <!-- </div>
                  </div> -->
                <!-- </div> -->


          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
