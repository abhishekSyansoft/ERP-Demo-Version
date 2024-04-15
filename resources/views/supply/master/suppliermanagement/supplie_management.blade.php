@include('admin.layout.header')
@include('admin.layout.navbar')
   <div class="main-panel">
          <div class="content-wrapper mx-auto">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Suppliers/Vendor Management
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Suppliers/Vendor <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
              
            <div class="row mx-auto">
              <div class="col-md-12" style="margin:auto;">
                <div class="card mx-auto">
                  <div class="card-body mx-auto">
                    <div class="clearfix">
                      <h4 class="card-title float-left">Suppliers/vendor Lists</h4>
                        <!-- Button to open the modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                        Add Supplier
                        </button>  
                           
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                        Edit Supplier
                        </button>   -->

                        <!-- <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit Order &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button> -->
                        
                        
                <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div class="mx-auto">
                        <table class="table table-hover table-bordered mt-2 mx-auto">
                            <tr>
                                
                                <th>S No.</th>
                                <!-- <th>Module Id</th> -->
                                <th>Supplier Name</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th>Phone nUmber</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Postal Code</th>
                                <th>Account Number</th>
                                <th>Tax Id</th>
                                <th>Payment Terms</th>
                                <th>Lead Time</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($supplier as $vendor)
                            <tr>
                                
                                <td>{{$i++}}</td>
                                <td>{{$vendor->supplier_name}}</td>
                                <td>{{$vendor->contact_person}}</td>
                                <td>{{$vendor->email}}</td>
                                <td>{{$vendor->phone_number}}</td>
                                <td>{{$vendor->address}}</td>
                                <td>{{$vendor->city}}</td>
                                <td>{{$vendor->state}}</td>
                                <td>{{$vendor->country}}</td>
                                <td>{{$vendor->postal_code}}</td>
                                <td>{{$vendor->account_number}}</td>
                                <td>{{$vendor->tax_id}}</td>
                                <td>{{$vendor->payment_terms}}</td>
                                <td>{{$vendor->lead_time}}</td>
                                <td>{{$vendor->notes}}</td>
                                @php($encryptedId = encrypt($vendor->id))
                               
                                <td>
                                    <a href="{{url('edit-supplier/'.$encryptedId)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{url('delete-supplier/'.$encryptedId)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
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
        <h4 class="modal-title" id="addSupplierModalLabel">Add Supplier</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Supplier Form -->
        <form id="addSupplierForm" method="POST" action="{{route('supplier.add')}}" class="row">
        @csrf
          <!-- Supplier ID
          <div class="mb-3 col-md-6">
            <label for="supplier_id" class="form-label">Supplier ID</label>
            <input type="text" class="form-control" id="supplier_id" name="supplier_id" required>
          </div> -->

          <!-- Supplier Name -->
          <div class="mb-3 col-md-6">
            <label for="supplier_name" class="form-label">Supplier Name</label>
            <input type="text" class="form-control" id="supplier_name" name="supplier_name" required placeholder="Name of the supplier/vendor">
          </div>
          <!-- Contact Person -->
          <div class="mb-3 col-md-6">
            <label for="contact_person" class="form-label">Contact Person</label>
            <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact person at the supplier/vendor">
          </div>
          <!-- Email -->
          <div class="mb-3 col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email address of the supplier/vendor">
          </div>
          <!-- Phone Number -->
          <div class="mb-3 col-md-6">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number of the supplier/vendor">
          </div>
          <!-- Address -->
          <div class="mb-3 col-md-6">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address of the supplier/vendor">
          </div>
          <!-- City -->
          <div class="mb-3 col-md-6">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="City of the supplier/vendor">
          </div>
          <!-- State -->
          <div class="mb-3 col-md-6">
            <label for="state" class="form-label">State</label>
            <input type="text" class="form-control" id="state" name="state" placeholder="State or region of the supplier/vendor">
          </div>
          <!-- Country -->
          <div class="mb-3 col-md-6">
            <label for="country" class="form-label">Country</label>
            <input type="text" class="form-control" id="country" name="country" placeholder="Country of the supplier/vendor">
          </div>
          <!-- Postal Code -->
          <div class="mb-3 col-md-6">
            <label for="postal_code" class="form-label">Postal Code</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal code of the supplier/vendor">
          </div>
          <!-- Account Number -->
          <div class="mb-3 col-md-6">
            <label for="account_number" class="form-label">Account Number</label>
            <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account number for financial transactions">
          </div>
          <!-- Tax ID -->
          <div class="mb-3 col-md-6">
            <label for="tax_id" class="form-label">Tax ID</label>
            <input type="text" class="form-control" id="tax_id" name="tax_id" placeholder="Tax identification number for the supplier/vendor">
          </div>
          <!-- Payment Terms -->
          <div class="mb-3 col-md-6">
            <label for="payment_terms" class="form-label">Payment Terms</label>
            <input type="text" class="form-control" id="payment_terms" name="payment_terms" placeholder="Payment terms agreed upon with the supplier/vendor">
          </div>
          <!-- Lead Time -->
          <div class="mb-3 col-md-6">
            <label for="lead_time" class="form-label">Lead Time</label>
            <input type="text" class="form-control" id="lead_time" name="lead_time" placeholder="Lead time for order fulfilment from the supplier/vendor">
          </div>
          <!-- Notes -->
          <div class="mb-3 col-md-6">
            <label for="notes" class="form-label">Notes</label>
            <input type="text" class="form-control" id="notes" name="notes" placeholder="Additional notes or comments about the supplier/vendor">
          </div>
          <!-- Submit Button -->
          <div class="form-group col-md-6">
          <button type="submit" class="btn btn-primary">Add Supplier</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Edit Supplier Modal -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Supplier Form -->
        <form id="editSupplierForm" method="POST" action="" class="row">
          @csrf
          @method('PUT')
          <!-- Hidden Field for Supplier ID -->
          <input type="hidden" id="edit_supplier_id" name="supplier_id">

          <!-- Supplier Name -->
          <div class="mb-3 col-md-6">
            <label for="edit_supplier_name" class="form-label">Supplier Name</label>
            <input type="text" class="form-control" id="edit_supplier_name" name="supplier_name" required>
          </div>
          <!-- Contact Person -->
          <div class="mb-3 col-md-6">
            <label for="edit_contact_person" class="form-label">Contact Person</label>
            <input type="text" class="form-control" id="edit_contact_person" name="contact_person">
          </div>
          <!-- Email -->
          <div class="mb-3 col-md-6">
            <label for="edit_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="edit_email" name="email">
          </div>
          <!-- Phone Number -->
          <div class="mb-3 col-md-6">
            <label for="edit_phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="edit_phone_number" name="phone_number">
          </div>
          <!-- Address -->
          <div class="mb-3 col-md-6">
            <label for="edit_address" class="form-label">Address</label>
            <input type="text" class="form-control" id="edit_address" name="address">
          </div>
          <!-- City -->
          <div class="mb-3 col-md-6">
            <label for="edit_city" class="form-label">City</label>
            <input type="text" class="form-control" id="edit_city" name="city">
          </div>
          <!-- State -->
          <div class="mb-3 col-md-6">
            <label for="edit_state" class="form-label">State</label>
            <input type="text" class="form-control" id="edit_state" name="state">
          </div>
          <!-- Country -->
          <div class="mb-3 col-md-6">
            <label for="edit_country" class="form-label">Country</label>
            <input type="text" class="form-control" id="edit_country" name="country">
          </div>
          <!-- Postal Code -->
          <div class="mb-3 col-md-6">
            <label for="edit_postal_code" class="form-label">Postal Code</label>
            <input type="text" class="form-control" id="edit_postal_code" name="postal_code">
          </div>
          <!-- Account Number -->
          <div class="mb-3 col-md-6">
            <label for="edit_account_number" class="form-label">Account Number</label>
            <input type="text" class="form-control" id="edit_account_number" name="account_number">
          </div>
          <!-- Tax ID -->
          <div class="mb-3 col-md-6">
            <label for="edit_tax_id" class="form-label">Tax ID</label>
            <input type="text" class="form-control" id="edit_tax_id" name="tax_id">
          </div>
          <!-- Payment Terms -->
          <div class="mb-3 col-md-6">
            <label for="edit_payment_terms" class="form-label">Payment Terms</label>
            <input type="text" class="form-control" id="edit_payment_terms" name="payment_terms">
          </div>
          <!-- Lead Time -->
          <div class="mb-3 col-md-6">
            <label for="edit_lead_time" class="form-label">Lead Time</label>
            <input type="text" class="form-control" id="edit_lead_time" name="lead_time">
          </div>
          <!-- Notes -->
          <div class="mb-3 col-md-6">
            <label for="edit_notes" class="form-label">Notes</label>
            <input type="text" class="form-control" id="edit_notes" name="notes">
          </div>
          <!-- Submit Button -->
          <div class="form-group col-md-6">
            <button type="submit" class="btn btn-primary">Update Supplier</button>
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
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Generated Orders</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body  mx-auto">

                  
                      <form method="GET" action="" id="edit_supplier_form">
                      <table class="table table-hover table-bordered mt-2">
                      <tr>
                                <th></td>
                                <th>S No.</th>
                                <!-- <th>Module Id</th> -->
                                <th>Supplier Name</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th>Phone nUmber</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Postal Code</th>
                                <th>Account Number</th>
                                <th>Tax Id</th>
                                <th>Payment Terms</th>
                                <th>Lead Time</th>
                                <th>Notes</th>
                                <!-- <th>Action</th> -->
                            </tr>
                            @php($i=1)
                            @foreach($supplier as $vendor)
                            <tr>
                                <td><input type="radio" value="{{$vendor->id}}" name="edit_vendor"></td>
                                <td>{{$i++}}</td>
                                <td>{{$vendor->supplier_name}}</td>
                                <td>{{$vendor->contact_person}}</td>
                                <td>{{$vendor->email}}</td>
                                <td>{{$vendor->phone_number}}</td>
                                <td>{{$vendor->address}}</td>
                                <td>{{$vendor->city}}</td>
                                <td>{{$vendor->state}}</td>
                                <td>{{$vendor->country}}</td>
                                <td>{{$vendor->postal_code}}</td>
                                <td>{{$vendor->account_number}}</td>
                                <td>{{$vendor->tax_id}}</td>
                                <td>{{$vendor->payment_terms}}</td>
                                <td>{{$vendor->lead_time}}</td>
                                <td>{{$vendor->notes}}</td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="form-group mt-2">
                          <!-- <button type="submit" class="btn btn-success">Check one to edit</button> -->
                           <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                            Check one to edit
                            </button>  
                          <button type="button" class="btn btn-secondary">Close</button>
                        </div>
                        </form>
                      </div>
                      
                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                      <!-- </div> -->
                    </div>
                  </div>
                </div>

          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')
