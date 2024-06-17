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
                  <div class="card-body p-0" style="border-radius:15px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Request For Quotation</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
   
                        <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#auctionInitiate">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button>  
                       
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
                               <th>Action</th>
                            </tr>
                            @php($a=1)
                              <tr>
                                <td>{{$a++}}</td>
                                <td>
                                  <a class="btn btn-primary">Edit</a>
                                  <a class="btn btn-danger">Delete</a>
                                </td>
                              </tr> 
                        </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>




<!-- Modal -->
<div class="modal fade" id="suppliersModal" tabindex="-1" aria-labelledby="suppliersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h5 class="modal-title" id="suppliersModalLabel">Supplier List</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>Supplier List</h5>
        <table class="table table-bordered border-primary">
          <thead>
            <tr>
              <th>S. Number</th>
              <th>Supplier Name</th>
              <th>Phone Number</th>
              <th>Email</th>
              <th>Contact Person</th>
            </tr>
          </thead>
          <tbody id="supplierTableBody">
            <!-- Supplier list will be dynamically populated here -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





  <!-- Modal -->
  <div class="modal fade" id="rfqViewModal" tabindex="-1" aria-labelledby="rfqViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:white;">
                <div class="modal-header">
                    <h5 class="modal-title btn btn-primary" id="rfqViewModalLabel">Download RFQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="container p-3" style="border:1px solid black;">
                        <h2 class="text-center">SyanSoft Private Limited</h2>
                        <!-- <h1 class="text-center text-primary">**************************</h1> -->
                        <h4 class="text-center">Solutioning For Innovator, An IT Company</h4>
                        <h6 class="text-center">Unit No. 306, Tower B4, Spaze I-Tech Park, Badshahpur Sohna Rd Hwy, Sector 49, Gurugram, Haryana 122018</h6>
                        <h6 class="text-center">Phone #+91 6202074551 Fax #309-278-0186 Toll Free #+91 9570191426 </h6>
                        <h6 class="text-center">Email Address <span class="text-primary">#abhishek.kumar@syansoft.in</span></h6>
                        <!-- <div><b>PR No. </b><span id="pr_num">    </span></div> -->
                        <div><b>RFQ No. </b><span id="rfq_num">    </span></div>
                        <div><b>Delivery: </b><span id="del_date">  </span><b>(on or before) </b></div><br><br>

                        <h2 class="text-center"><b>REQUEST FOR QUOTE FORM</b></h2>
                        <!-- <h5><b>Item Lists</b></h5> -->
                       <div class="table-wrapper" style="height:auto;">
                       <table class="table table-bordered border-primary">
                          <!-- <thead> -->
                            <th>S No.</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Features</th>
                          <!-- </thead> -->
                          <tbody class="prItemViewAllList">

                          </tbody>
                        </table>

                       </div>

                       <h6>Lead time on above material is : <span id="lead_time"></span></h6>
                       <h4 class="text-center mt-4">This quote is prepared by : SyanSoft Private Limited Established in 1998. </h4>
                   
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>






          
<!-- Add Supplier Modal -->
<div class="modal fade" id="auctionInitiate" tabindex="-1" aria-labelledby="auctionInitiateLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="auctionInitiateLabel">Prepare for Auction</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" class="row mx-auto" id="createRFQModalForm">
                        @csrf

                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="auction_id" class="form-label">{{ __('Auction Number') }}</label>
                            <input type="text" id="auction_id" class="form-control" name="auction_id" value="Auct_{{uniqid()}}" placeholder="Auction ID">
                        </div>
                       
                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="type" class="form-label">{{ __('Auction Type') }}</label>
                            <select type="type" id="type" class="form-control p-3" name="type" placeholder="Auction Type">
                                <option value="">--Select Auction Type--</option>
                                <option value="Forward Auction">Forward Auction</option>
                                <option value="Reverse Auction">Reverse Auction</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="bid" class="form-label">{{ __('Bidding Type') }}</label>
                            <select type="bid" id="bid" class="form-control p-3" name="type" placeholder="Auction Type">
                                <option value="">--Select Bidding Type--</option>
                                <option value="Increment">Increment</option>
                                <option value="Decrement">Decrement</option>
                            </select>
                        </div>

                        
                        <div class="mb-3 col-md-6 col-lg-4" id="price_field">
                            <label for="start_price" class="form-label">{{ __('Starting Price') }}</label>
                            <input type="number" id="start_price" class="form-control" name="start_price" placeholder="mention the starting price of the assets">
                        </div>


                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="doc" class="form-label">{{ __('Date of Creation') }}</label><b>(Auction)</b></label>
                            <input type="date" id="doc" class="form-control" name="doc" value="{{date('Y-m-d')}}" placeholder="Last date of bid submission">
                        </div>


                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="dos" class="form-label">{{ __('Date of Submission') }}</label>
                            <input type="date" id="dos" class="form-control" name="dos" placeholder="Last date of bid submission">
                        </div>


                        <div class="col-12">
                            <hr>
                            <h5>Item Detail's</h5>
                            <hr>
                        </div>


                        <div class="col-12 form-group">
                        <div class="table-wrapper" style="height:auto;margin:0pc !important;">
                            <table class="table table-bordered border-primary">
                                <!-- <thead> -->
                                    <!-- <th>S No.</th> -->
                                    <th>E-Auction Number</th>
                                    <th>E-Auction Item Description</th>
                                    <th>Quantity</th>
                                    <th>Features</th>
                                    <th>Delete</th>
                                <!-- </thead> -->
                                <tbody id="auctionItemsLists" class="auctionItemsLists">

                                </tbody>
                            </table>
                        </div>
                        <a class="btn btn-primary addAuctionItem mt-3">AddItems</a>

                        </div>



                        <div class="col-12">
                          <hr>Supplier's Detail <hr>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="part_number" class="form-label">{{ __('Supplier') }}<sup class="text-danger">*</sup></label>
                            <input list="supplier_list" id="supplier" class="form-control" name="supplier" placeholder="Supplier name if any for this PR">
                            <datalist id="supplier_list">
                                @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->supplier_name}}">
                                @endforeach
                                <!-- Add more options as needed -->
                            </datalist>
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="supplier_phone">Phone Number</label>
                          <input type="text" name="supplier_phone" class="form-control" id="supplier_phone" placeholder="Supplier Contact number">
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="supplier_email">Email</label>
                          <input type="text" name="supplier_email" class="form-control" id="supplier_email" placeholder="Supplier email">
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="supplier_person">Contact Person</label>
                          <input type="text" name="supplier_person" class="form-control" id="supplier_person" placeholder="Supplier contact person">
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <a class="btn btn-primary" id="addSuppliersAuction">Add Suppliers</a>
                        </div>


                        <div class="col-12 form-group">
                          <div class="table-wrapper" style="height:auto;margin:0pc !important;">
                            <table class="table table-bordered border-primary">
                              <thead>
                                <th>Auction Number</th>
                                <th>Supplier Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Contact Person</th>
                                <th>Action</th>
                              </thead>
                              <tbody id="suppliersLists">

                              </tbody>
                            </table>
                          </div>
                        </div>

                        <div class="col-12">
                          <hr>
                        </div>



                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create') }}
                        </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>



<!-- Modal -->
                <div class="modal fade" id="rfqPR" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rfqPRLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="rfqPRLabel">Purchase Requisition</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body">
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
                       <div class="table-wrapper" style="height:auto;">
                       <table class="table table-bordered border-primary">
                          <!-- <thead> -->
                            <th>S No.</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Features</th>
                          <!-- </thead> -->
                          <tbody class="prItemViewAllList">

                          </tbody>
                        </table>

                       </div>
                        <br><br>
                        <br>


                        

                        <h5><b>Vendor Details</b></h5>
                        <div class="table-wrapper" style="height:auto;">
                        <table class="table table-bordered border-primary">
                          <!-- <thead> -->
                            <!-- <th>S No.</th> -->
                            <th>Vendor Name</th>
                            <th>Phone Number</th>
                            <th>Contact Email</th>
                            <th>Contact Person</th>
                          <!-- </thead> -->
                          <tbody class="prVendorList">
                            <tr>
                              <td id="vendorName">Abhishek Kumar</td>
                              <td id="vendorPhone">+91 6202074551</td>
                              <td id="vendorEmail">kumarpuplish@gmail.com</td>
                              <td id="contactPerson">Priyanka Tamta</td>
                            </tr>
                          </tbody>
                        </table>
                        </div>



                        <br><br>

                        <div><b> Request For Department: </b><span id="req_depatment">IT Department</span></div>
                        <div><b> Purpose: </b><span id="purpose">Fullfilment f products to the employees</span></div>
                        
                        <br><br><br>

                        <div><h4><b>Approval Details: </b></h4></div>


                            <!-- Responsive step process component with minimal markup -->
                            <div dir="RTL">
                            <ol class="checkout">
                              <li class="step completed">
                              <span class="step-icon"></span><br>
                                <span class="step-label step-label">Approved</span>
                              </li>
                              <li class="step reject">
                                <span class="step-icon"></span><br>
                                <span class="step-label step-label-even">Rejected</span>
                              </li>
                              <li class="step reviow">
                                <span class="step-icon"></span><br>
                                <span class="step-label">Pending</span>
                              </li>
                              <li class="step skip">
                                <span class="step-icon"></span><br>
                                <span class="step-label">On Hold</span>
                              </li>
                              <li class="step active">
                                <span class="step-icon"></span><br>
                                <span class="step-label">Processing</span>
                              </li>
                              <li class="step">
                                <span class="step-icon"></span><br>
                                <span class="step-label">Active</span>
                              </li>
                            </ol>
                            </div>
                      </div>
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
