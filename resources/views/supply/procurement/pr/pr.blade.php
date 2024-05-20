@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Purchase Requisition
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span> Purchase Requisition<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Purchase Requisition Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
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
                        <table class="table table-bordered border-primary">
                        <!-- <thead> -->
                              <tr>
                                  <th rowspan="2">S. No</th>
                                  <th rowspan="2">PR Number</th>
                                  <th rowspan="2">View PR</th>
                                  <th rowspan="2">PR Items</th>
                                  <th colspan="4">Requester</th>
                                  <th rowspan="2">Department</th>
                                  <th rowspan="2">Requisition Date</th>
                                  <th rowspan="2">Priority</th>
                                  <th colspan="4">Delivery Location</th>
                                  <th colspan="4">Supplier</th>
                                  <th rowspan="2">Attachments</th>
                                  <th rowspan="2">Notes</th>
                                  <th rowspan="2">Reference Number</th>
                                  <th rowspan="2">Created At</th>
                                  <th rowspan="2">Action</th>
                              </tr>
                              <tr>
                                  <th>Name</th>
                                  <th>Phone</th>
                                  <th>Email</th>
                                  <th>Designation</th>
                                  <th>Street Address</th>
                                  <th>City</th>
                                  <th>State</th>
                                  <th>Date</th>
                                  <th>Name</th>
                                  <th>Phone Number</th>
                                  <th>Email</th>
                                  <th>Contact Person</th>
                              </tr>
                          <!-- </thead>
                          <tbody> -->
                            @php($i=1)
                              @foreach($pr as $requisition)
                              <tr>
                                  <td>{{$i++}}</td>
                                  <td>{{ $requisition->pr_num }}</td>
                                  <!-- data-bs-toggle="modal" data-bs-target="#staticBackdrop" -->
                                  <td><a class="btn btn-primary mdi mdi-eye prView" data-id="{{$requisition->pr_num}}"></a></td>
                                  <td><a class="btn btn-primary mdi mdi-eye prItemListsView" data-id="{{$requisition->id}}"></a></td>
                                  <td>{{ $requisition->req_name }}</td>
                                  <td>{{ $requisition->req_phone }}</td>
                                  <td>{{ $requisition->req_email }}</td>
                                  <td>{{ $requisition->req_desig }}</td>
                                  <td>{{ $requisition->department }}</td>
                                  <td>{{ $requisition->requisition_date }}</td>
                                  <td>{{ $requisition->priority }}</td>
                                  <td>{{ $requisition->del_addr }}</td>
                                  <td>{{ $requisition->del_city }}</td>
                                  <td>{{ $requisition->del_state }}</td>
                                  <td>{{ $requisition->del_date }}</td>
                                  <td>{{ $requisition->supplier }}</td>
                                  <td>{{ $requisition->supplier_phone }}</td>
                                  <td>{{ $requisition->supplier_email }}</td>
                                  <td>{{ $requisition->supplier_person }}</td>
                                  @if($requisition->attachments )
                                  <td><a class="mdi mdi-file btn btn-primary" href="{{ asset('Storage/'.$requisition->attachments) }}"></a></td>
                                  @else
                                  <td></td>
                                  @endif
                                  <td>{{ $requisition->notes }}</td>
                                  <td>{{ $requisition->ref_number }}</td>
                                  <td>{{ $requisition->created_at }}</td>
                                  @php($encryptedId = encrypt($requisition->id))
                                  <td>
                                      <a href="{{url('edit-pr/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                      <a href="{{url('delete-pr/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                                  </td>
                              </tr>
                              @endforeach
                          <!-- </tbody> -->
                        </table>
                  </div>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Create Purchase Requisition</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->
                <form method="POST" action="{{route('pr.store')}}" class="row" id="PRAddModalForm" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                          <hr>
                          <h4>Requisitioner Detail's</h4>
                          <hr>
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="pr_num">PR Number</label>
                          <input type="text" name="pr_num" class="form-control" id="pr_num" value="PR_{{uniqid()}}" placeholder="Pr Number will be autogenerated">
                        </div>

                          
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="req_name" class="form-label">{{ __('Requisitioner Name') }}<sup class="text-danger">*</sup></label>
                            <input list="req_name_list" id="req_name" class="form-control" name="req_name" placeholder="Enter Requisitionar Name" required>
                            <datalist id="req_name_list">
                                @foreach($users as $user)
                                    <option value="{{$user->name}}">
                                @endforeach
                                <!-- Add more options as needed -->
                            </datalist>
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="req_phone">Phone Number</label>
                          <input type="text" name="req_phone" class="form-control" id="req_phone" placeholder="Enter Contact of the Requisitioner">
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="req_email">Email</label>
                          <input type="text" name="req_email" class="form-control" id="req_email" placeholder="Enter Email of the Requisitioner">
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="req_desig">Designation</label>
                          <input type="text" name="req_desig" class="form-control" id="req_desig" placeholder="Enter designantion of the Requisitioner">
                        </div>
                       
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="department" class="form-label">{{ __('Department') }}</label>
                            <select id="department"  class="form-control p-3" name="department" required>
                                <option value="0">--Select Department--</option>
                                <option value="HR Department">HR Department</option>
                                <option value="IT Department">IT Department</option>
                                <option value="Sales Department">Sales Department</option>
                                <option value="Service Department">Service Department</option>
                                <option value="Consultation Department">Consultation Department</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="requisition_date" class="form-label">{{ __('Requisition Date') }}</label>
                            <input type="date" id="requisition_date" value="{{ date('Y-m-d') }}" class="form-control" name="requisition_date" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="priority" class="form-label">{{ __('Priority') }}</label>
                            <select id="priority"  class="form-control p-3" name="priority" required>
                                <option value="">--Select Priority Level--</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>


                        <div class="col-12">
                          <hr>
                          <h4>Delivery Detail's</h4>
                          <hr>
                        </div>

                          
                          <div class="col-md-6 col-lg-3 form-group">
                            <label for="del_addr">Address Line 1</label>
                            <input type="text" name="del_addr" id="del_addr" class="form-control" placeholder="Address for delivery">
                          </div>

                          <div class="col-md-6 col-lg-3 form-group">
                            <label for="del_city">City</label>
                            <input type="text" name="del_city" class="form-control" id="del_city" placeholder="City where order needed to be delivered">
                          </div>

                          <div class="col-md-6 col-lg-3 form-group">
                            <label for="del_state">State</label>
                            <input type="text" name="del_state" class="form-control" id="del_state" placeholder="State where order needed to be delivered">
                          </div>

                          <div class="col-md-6 col-lg-3 form-group">
                            <label for="del_date">Delivery Date</label>
                            <input type="date" name="del_date" class="form-control" id="del_date" placeholder="If required on particular date for delivery">
                          </div>


                          <div class="col-12">
                            <hr>
                            <h4>Item Details</h4>
                            <hr>
                          </div>

                          <div class="col-md-6 col-lg-4 form-group">
                            <label for="item_type">Type</label>
                            <select  name="item_type" class="form-control p-3 text-center" id="item_type" placeholder="Quantityof the item">
                              <option value="">--Select--</option>
                              <option value="Goods">Goods</option>
                              <option value="Services">Services</option>
                            </select>
                          </div>

                          <div class="col-md-6 col-lg-4 form-group">
                            <label for="item_des">Item Description</label>
                            <input type="text" name="item_des" id="item_des" class="form-control" placeholder="Mention description pf item to purchase">
                          </div>

                          <div class="col-md-6 col-lg-4 form-group">
                            <label for="item_qty">Quantity</label>
                            <input type="number" name="item_qty" class="form-control" id="item_qty" placeholder="Quantity of the item">
                          </div>
                          


                          <div class="col-md-12 form-group">
                            <label for="item_feature">Features</label>
                            <textarea type="text" name="item_feature" cols="10" rows="10" class="form-control" id="item_feature" placeholder="If any features or spacification"></textarea>
                          </div>


                          <div class="form-group">
                            <a class="btn btn-primary" id="add_pr_item">Add Item</a>
                          </div>

                          <div class="form-group">
                           <h6>PR Item List's</h6>
                           <table class="table table-bordered border-primary">
                            <thead>
                            <tr>
                              <th>PR Number</th>
                                <th>Type</th>
                                <th>Item Description</th>
                                <th>Quantity</th>
                                <th>Feature</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody id="pr_item_lists">

                            </tbody>
                           </table>
                          </div>




                          <div class="col-12">
                          <hr>
                          <h4>Supplier Detail's</h4><span>(If any suitable supplier for your PR.)</span>
                          <hr>
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



                          <div class="col-12">
                            <hr>
                            <h4>Other Detail's</h4>
                            <hr>
                          </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                          <label for="attachments">Attachments</label>
                          <input type="file" name="attachments" class="form-control" id="attachments" placeholder="Upload file related with PR if any">
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                          <label for="notes">Comment's/Notes</label>
                          <input type="text" name="notes" class="form-control" id="notes" placeholder="Enter any comments or notes related with PR">
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                          <label for="ref_number">Reference Number</label>
                          <input type="text" name="ref_number" class="form-control" id="ref_number" placeholder="Enter if this PR is related with any past PR">
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
            <div class="modal fade" id="PRViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="PRViewModalLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="PRViewModalLabel">Purchase Requisition</h5>
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
                    </div>
                  </div>
                </div>




                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Purchase Requisition</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body">

                   
                      <!-- <center><u> <h3>Purchase Requisition Detail's</h3></u></br></br></center> -->
                        
                              <h5><b>PR Items List's: </b></h5>
                              <table class="table table-bordered border-primary">
                               <!-- <thead> -->
                                <tr>
                                    <th>S no.</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Features</th>
                                  </tr>
                               <!-- </thead> -->
                               <tbody id="prItemView">

                               </tbody>
                              </table>           
                              <hr>


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
