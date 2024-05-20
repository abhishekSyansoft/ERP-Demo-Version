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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;"> Create RFQ</h4>
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
                                <th>Create RFQ</th>
                                <th>PR Number</th>
                                
                                <th>PR View</th>
                                <!-- <th>RFQ No.</th>
                                <th>QUT No.</th> -->
                                
                                <th>RFQ Number</th>
                                <th>RFQ Status</th>
                                <th>Suppliers Lists</th>
                                <th>Last Date Of submission</th>
                               <th>Action</th>
                            </tr>
                            @php($a=1)
                            @foreach($prs as $pr)
                              <tr>
                                <td>{{$a++}}</td>
                                <td><a class="btn btn-primary createRfq" data-prnum="{{$pr->pr_num}}">Create</a></td>
                                <td>{{$pr->pr_num}}</td>
                                <td>
                                  <a class="btn btn-primary mdi mdi-eye rfqPRView" data-prnum="{{$pr->pr_num}}"></a>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                  <!-- <a class="btn btn-primary mdi mdi-eye"></a>\ -->
                                </td>
                                <td></td>
                                <td></td>
                              </tr>
                            @endforeach 
                        </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
<!-- Add Supplier Modal -->
<div class="modal fade" id="createRFQModal" tabindex="-1" aria-labelledby="createRFQModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="createRFQModalLabel">Create RFQ</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('mrp.store')}}" class="row mx-auto" id="createRFQModalForm">
                        @csrf
                        

                        <div class="col-12">
                          <hr>RFQ Detail's <hr>
                        </div>


                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="pr_num" class="form-label">{{ __('PR Number') }}</label>
                            <input type="text" id="pr_num" class="form-control" name="pr_num" placeholder="PR Number to create RFQ" disabled>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="rfq_num" class="form-label">{{ __('RFQ Number') }}</label>
                            <input type="text" id="rfq_num" class="form-control" name="rfq_num" value="RFQ_{{uniqid()}}" placeholder="RFQ Number to create RFQ" disabled>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-4">
                            <label for="dos" class="form-label">{{ __('Quotation Submission Date') }} (on or before)</label>
                            <input type="date" id="dos" class="form-control" name="dos" placeholder="Last date of quotation subbmission">
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
                            <th>S No.</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Features</th>
                          <!-- </thead> -->
                          <tbody id="prItemViewAll">

                          </tbody>
                        </table>
                        </div>
                        </div>



                        <div class="col-12">
                          <hr>Supplier's Detail <hr>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="part_number" class="form-label">{{ __('Supplier') }}<sup class="text-danger">*</sup></label>
                            <input list="supplier_list" id="supplier" class="form-control" name="supplier" placeholder="Supplier name if any for this PR" required>
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
                          <a class="btn btn-primary" id="addSuppliersRFQ">Add Suppliers</a>
                        </div>


                        <div class="col-12 form-group">
                          <div class="table-wrapper" style="height:auto;margin:0pc !important;">
                            <table class="table table-bordered border-primary">
                              <thead>
                                <th>PR Number</th>
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
                          <tbody id="prItemViewAll">

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
                          <tbody id="prVendorList">
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
