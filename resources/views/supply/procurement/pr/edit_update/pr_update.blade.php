@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>   Purchase Requisition
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Purchase Requisition <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
        </nav>
    </div>
    <div>
    <div>
<div>
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Update Purchase Requisition :</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($pr->id))
           <form method="POST" action="{{ url('pr/update/'.$encryptedId)}}" class="row" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                          <hr>
                          <h4>Requisitioner Detail's</h4>
                          <hr>
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="pr_num">PR Number</label>
                          <input type="text" name="pr_num" class="form-control" id="pr_num" value="{{$pr->pr_num}}" placeholder="Pr Number will be autogenerated">
                        </div>

                          
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="req_name" class="form-label">{{ __('Requisitioner Name') }}<sup class="text-danger">*</sup></label>
                            <input list="req_name_list" id="req_name" value="{{$pr->req_name}}" class="form-control" name="req_name" placeholder="Enter Requisitionar Name" required>
                            <datalist id="req_name_list">
                                @foreach($users as $user)
                                    <option value="{{$user->name}}">
                                @endforeach
                                <!-- Add more options as needed -->
                            </datalist>
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="req_phone">Phone Number</label>
                          <input type="text" name="req_phone" value="{{$pr->req_phone}}" class="form-control" id="req_phone" placeholder="Enter Contact of the Requisitioner">
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="req_email">Email</label>
                          <input type="text" name="req_email" value="{{$pr->req_email}}" class="form-control" id="req_email" placeholder="Enter Email of the Requisitioner">
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="req_desig">Designation</label>
                          <input type="text" name="req_desig" value="{{$pr->req_desig}}" class="form-control" id="req_desig" placeholder="Enter designantion of the Requisitioner">
                        </div>
                       
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="department" class="form-label">{{ __('Department') }}</label>
                            <select id="department"  class="form-control p-3" name="department" required>
                                <option value="0">--Select Department--</option>
                                <option value="HR Department"{{$pr->department == 'HR Department' ? 'Selected' : ''}}>HR Department</option>
                                <option value="IT Department"{{$pr->department == 'IT Department' ? 'Selected' : ''}}>IT Department</option>
                                <option value="Sales Department"{{$pr->department == 'Sales Department' ? 'Selected' : ''}}>Sales Department</option>
                                <option value="Service Department"{{$pr->department == 'Service Department' ? 'Selected' : ''}}>Service Department</option>
                                <option value="Consultation Department"{{$pr->department == 'Consultation Department' ? 'Selected' : ''}}>Consultation Department</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="requisition_date" class="form-label">{{ __('Requisition Date') }}</label>
                            <input type="date" id="requisition_date" value="{{$pr->requisition_date}}" class="form-control" name="requisition_date" required>
                        </div>

                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="priority" class="form-label">{{ __('Priority') }}</label>
                            <select id="priority"  class="form-control p-3" name="priority" required>
                                <option value="">--Select Priority Level--</option>
                                <option value="Low"{{$pr->priority == 'Low' ? 'Selected' : ''}}>Low</option>
                                <option value="Medium"{{$pr->priority == 'Medium' ? 'Selected' : ''}}>Medium</option>
                                <option value="High"{{$pr->priority == 'High' ? 'Selected' : ''}}>High</option>
                            </select>
                        </div>


                        <div class="col-12">
                          <hr>
                          <h4>Delivery Detail's</h4>
                          <hr>
                        </div>

                          
                          <div class="col-md-6 col-lg-3 form-group">
                            <label for="del_addr">Address Line 1</label>
                            <input type="text" name="del_addr" value="{{$pr->del_addr}}" id="del_addr" class="form-control" placeholder="Address for delivery">
                          </div>

                          <div class="col-md-6 col-lg-3 form-group">
                            <label for="del_city">City</label>
                            <input type="text" name="del_city" value="{{$pr->del_city}}" class="form-control" id="del_city" placeholder="City where order needed to be delivered">
                          </div>

                          <div class="col-md-6 col-lg-3 form-group">
                            <label for="del_state">State</label>
                            <input type="text" name="del_state" value="{{$pr->del_state}}" class="form-control" id="del_state" placeholder="State where order needed to be delivered">
                          </div>

                          <div class="col-md-6 col-lg-3 form-group">
                            <label for="del_date">Delivery Date</label>
                            <input type="date" name="del_date" value="{{$pr->del_date}}" class="form-control" id="del_date" placeholder="If required on particular date for delivery">
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
                            <input type="text"  name="item_des" id="item_des" class="form-control" placeholder="Mention description pf item to purchase">
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
                            <tr>
                              <th>Type</th>
                              <th>Item Description</th>
                              <th>Quantity</th>
                              <th>Feature</th>
                              <th>Action</th>
                            </tr>
                           </table>
                          </div>




                          <div class="col-12">
                          <hr>
                          <h4>Supplier Detail's</h4><span>(If any suitable supplier for your PR.)</span>
                          <hr>
                        </div>

                          
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="part_number" class="form-label">{{ __('Supplier') }}<sup class="text-danger">*</sup></label>
                            <input list="supplier_list" value="{{$pr->supplier}}" id="supplier" class="form-control" name="supplier" placeholder="Supplier name if any for this PR" required>
                            <datalist id="supplier_list">
                                @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->supplier_name}}">
                                @endforeach
                                <!-- Add more options as needed -->
                            </datalist>
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="supplier_phone">Phone Number</label>
                          <input type="text" name="supplier_phone" value="{{$pr->supplier_phone}}" class="form-control" id="supplier_phone" placeholder="Supplier Contact number">
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="supplier_email">Email</label>
                          <input type="text" name="supplier_email" value="{{$pr->supplier_email}}" class="form-control" id="supplier_email" placeholder="Supplier email">
                        </div>

                        <div class="col-md-6 col-lg-3 form-group">
                          <label for="supplier_person">Contact Person</label>
                          <input type="text" name="supplier_person" value="{{$pr->supplier_person}}" class="form-control" id="supplier_person" placeholder="Supplier contact person">
                        </div>



                          <div class="col-12">
                            <hr>
                            <h4>Other Detail's</h4>
                            <hr>
                          </div>

                        <div class="col-md-6 col-lg-4 mb-3">
                          <label for="attachments">Attachments</label>
                          <input type="file" name="attachments" class="form-control" id="attachments" placeholder="Upload file related with PR if any">
                        </div>

                        <div class="col-md-6 col-lg-4 mb-3">
                          <label for="notes">Comment's/Notes</label>
                          <input type="text" name="notes" value="{{$pr->notes}}" class="form-control" id="notes" placeholder="Enter any comments or notes related with PR">
                        </div>

                        <div class="col-md-6 col-lg-4 mb-3">
                          <label for="ref_number">Reference Number</label>
                          <input type="text" value="{{$pr->ref_number}}" name="ref_number" class="form-control" id="ref_number" placeholder="Enter if this PR is related with any past PR">
                        </div>

                        <div>
                            <hr>
                        </div>

                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        </div>
                    </form>
<!--                    
</div>
</div>
                    </div> -->
            <!-- <p class="card-description"> Add class <code>.table</code>
            </p> -->
            </div>
            </div>
        </div>
    </div>

    </div>
        
    </div>
</div>
</div>
</div>
          <!-- content-wrapper ends -->
@include('admin.layout.footer')

