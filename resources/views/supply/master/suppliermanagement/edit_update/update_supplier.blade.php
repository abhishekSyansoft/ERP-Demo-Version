@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Update Supplier
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update Supplier<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
        </nav>
    </div>
    <div>
    <div>
<div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card" style="margin:auto;">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Update Supplier :</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($supplier->id))
                    <form id="editSupplierForm" method="POST" action="{{url('update_vendor/'.$encryptedId)}}" class="row">
                    @csrf
                    <!-- Hidden Field for Supplier ID -->
                    <input type="hidden" id="edit_supplier_id" name="supplier_id">

                    <!-- Supplier Name -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_supplier_name" class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" id="edit_supplier_name" name="supplier_name" value="{{$supplier->supplier_name}}">
                    </div>
                    <!-- Contact Person -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_contact_person" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="edit_contact_person" name="contact_person" value="{{$supplier->contact_person}}">
                    </div>
                    <!-- Email -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" value="{{$supplier->email}}">
                    </div>
                    <!-- Phone Number -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="edit_phone_number" name="phone_number" value="{{$supplier->phone_number}}">
                    </div>
                    <!-- Address -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="edit_address" name="address" value="{{$supplier->address}}">
                    </div>
                    <!-- City -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_city" class="form-label">City</label>
                        <input type="text" class="form-control" id="edit_city" name="city" value="{{$supplier->city}}">
                    </div>
                    <!-- State -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_state" class="form-label">State</label>
                        <input type="text" class="form-control" id="edit_state" name="state" value="{{$supplier->state}}">
                    </div>
                    <!-- Country -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="edit_country" name="country" value="{{$supplier->country}}">
                    </div>
                    <!-- Postal Code -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_postal_code" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="edit_postal_code" name="postal_code" value="{{$supplier->postal_code}}">
                    </div>
                    <!-- Account Number -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_account_number" class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="edit_account_number" name="account_number" value="{{$supplier->account_number}}">
                    </div>
                    <!-- Tax ID -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_tax_id" class="form-label">Tax ID</label>
                        <input type="text" class="form-control" id="edit_tax_id" name="tax_id" value="{{$supplier->tax_id}}">
                    </div>
                    <!-- Payment Terms -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_payment_terms" class="form-label">Payment Terms</label>
                        <input type="text" class="form-control" id="edit_payment_terms" name="payment_terms" value="{{$supplier->payment_terms}}">
                    </div>
                    <!-- Lead Time -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_lead_time" class="form-label">Lead Time</label>
                        <input type="text" class="form-control" id="edit_lead_time" name="lead_time" value="{{$supplier->lead_time}}">
                    </div>
                    <!-- Notes -->
                    <div class="mb-3 col-md-6">
                        <label for="edit_notes" class="form-label">Notes</label>
                        <input type="text" class="form-control" id="edit_notes" name="notes" value="{{$supplier->notes}}">
                    </div>
                    <!-- Submit Button -->
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">Update Supplier</button>
                    </div>
                    </form>
                </div>
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
          <!-- content-wrapper ends -->
@include('admin.layout.footer')
