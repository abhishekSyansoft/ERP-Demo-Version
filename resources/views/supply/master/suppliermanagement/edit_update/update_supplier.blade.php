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
        <div class="col-lg-12">
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
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="supplier_name" class="form-label">Vendor Name</label>
                            <input type="text" value="{{$supplier->supplier_name}}" class="form-control" id="supplier_name" name="supplier_name" required placeholder="Name of the supplier/vendor">
                        </div>

                        <!-- Supplier Name -->
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="service" class="form-label">Product/Service</label>
                            <input type="text" value="{{$supplier->service}}" class="form-control" id="service" name="service" placeholder="Enter short detail about produt or service" required>      
                        </div>

                        <!-- Tin Number -->
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="tin_no" class="form-label">TIN Number</label>
                            <input type="text" value="{{$supplier->tin_no}}" class="form-control" id="tin_no" name="tin_no" placeholder="Enter TIN Number of the supplier" required>      
                        </div>

                        <!-- GSTIN Number Number -->
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="gst_in" class="form-label">GSTIN Number</label>
                            <input type="text" value="{{$supplier->gst_in}}" class="form-control" id="gst_in" name="gst_in" placeholder="Enter GST IN Number of the supplier" required>      
                        </div>

                        <!-- Account Manager Number -->
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="manager" class="form-label">Account Manager</label>
                            <input type="text" value="{{$supplier->manager}}" class="form-control" id="manager" name="manager" placeholder="The designated account manager or representative at the supplier's organization." required>      
                        </div>

                        <!-- Supplier Evaluation Number -->
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="supplier_evaluation" class="form-label">Supplier Evaluation</label>
                            <input type="text" value="{{$supplier->supplier_evaluation}}" class="form-control" id="supplier_evaluation" name="supplier_evaluation" placeholder="Evaluation criteria and scores used to assess and rank suppliers based on performance, reliability, and quality." required>      
                        </div>

                        <!-- Supplier Diversity Number -->
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="supplier_diversity" class="form-label">Supplier Diversity</label>
                            <input type="text" value="{{$supplier->supplier_diversity}}" class="form-control" id="supplier_diversity" name="supplier_diversity" placeholder="Information about diversity initiatives and programs aimed at sourcing from diverse suppliers." required>      
                        </div>

                            <!-- Supplier Relationship Number -->
                            <div class="mb-3 col-md-6 col-lg-3">
                            <label for="supplier_relationship" class="form-label">Supplier Relationship</label>
                            <input type="text" value="{{$supplier->supplier_relationship}}" class="form-control" id="supplier_relationship" name="supplier_relationship" placeholder="Information about diversity initiatives and programs aimed at sourcing from diverse suppliers." required>      
                        </div>

                        
                        <!-- Account Number -->
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="account_number" class="form-label">Account Number</label>
                            <input type="text" value="{{$supplier->account_number}}" class="form-control" id="account_number" name="account_number" placeholder="Account number for financial transactions">
                        </div>

                        <!-- Tax ID -->
                        <div class="mb-3 col-md-6 col-lg-3">
                            <label for="tax_id" class="form-label">Tax ID</label>
                            <input type="text" value="{{$supplier->tax_id}}" class="form-control" id="tax_id" name="tax_id" placeholder="Tax identification number for the supplier/vendor">
                        </div>

                        <hr class="m-1 mb-3">

                        <div class="mb-3 col-md-6">
                            <div class="row">
                            <strong class="mb-2">Contact Information : </strong>
                        <!-- Contact Person -->
                            <div class="col-md-6 mb-3">
                                <label for="contact_person" class="form-label">Contact Person</label>
                                <input type="text" class="form-control" id="contact_person" value="{{$supplier->contact_person}}" name="contact_person" placeholder="Contact person at the supplier/vendor">
                            </div>
                            <!-- Phone Number -->
                            <div class="col-md-6 mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$supplier->phone_number}}" placeholder="Phone number of the supplier/vendor">
                            </div>
                            <!-- Email -->
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$supplier->email}}" placeholder="Email address of the supplier/vendor">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="method" class="form-label">Preffered Communication Method</label>
                                <select class="form-control p-3" id="method" name="method">
                                <option value="">--select--</option>
                                <option value="Email"{{$supplier->method == 'Email' ? 'Selected' : ''}}>Email</option>
                                <option value="Phone"{{$supplier->method == 'Phone' ? 'Selected' : ''}}>Phone</option>
                                <option value="Fax"{{$supplier->method == 'Fax' ? 'Selected' : ''}}>Fax</option>
                                </select>
                            </div>
                            <!-- </div> -->

                            </div>
                        </div>

                        <div class="mb-3 col-md-6 row mx-auto">
                            <strong class="mb-2">Location : </strong>
                            <!-- Address -->
                            <div class="col-md-12 mb-3">
                            <label for="address" class="form-label">Streen Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{$supplier->address}}" placeholder="Address of the supplier/vendor">
                            </div>
                            <!-- City -->
                            <div class="mb-3 col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{$supplier->city}}" placeholder="City of the supplier/vendor">
                            </div>
                            <!-- State -->
                            <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" value="{{$supplier->state}}" placeholder="State or region of the supplier/vendor">
                            </div>
                            <!-- Country -->
                            <div class="mb-3 col-md-6">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{$supplier->country}}" placeholder="Country of the supplier/vendor">
                            </div>
                            <!-- Postal Code -->
                            <div class="mb-3 col-md-6">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{$supplier->postal_code}}" placeholder="Postal code of the supplier/vendor">
                            </div>
                        </div>

                        <hr class="m-1 mb-3">


                        <!-- Type -->
                        <div class="mb-3 col-md-6">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control p-3" id="type" name="type" required>
                            <option value="">--Select--</option>
                            <option value="1"{{$supplier->type == 1 ? 'Selected':''}}>Manufacturing</option>
                            <option value="2"{{$supplier->type == 2 ? 'Selected':''}}>Sales</option>
                            <option value="3"{{$supplier->type == 3 ? 'Selected':''}}>Production</option>
                            <option value="4"{{$supplier->type == 4 ? 'Selected':''}}>Distribution</option>
                            </select>
                        </div>

                        <!--Prefered Payment Terms -->
                        <div class="mb-3 col-md-6">
                            <label for="payment_terms" class="form-label">Prefered Payment Terms</label>
                            <input type="text" class="form-control" id="payment_terms" name="payment_terms" value="{{$supplier->payment_terms}}" placeholder="Payment terms agreed upon with the supplier/vendor">
                        </div>

                        <!--Delivery Shedule Lead Time -->
                        <div class="mb-3 col-md-6">
                            <label for="lead_time" class="form-label">Deliery Shedule</label>
                            <input type="text" class="form-control" id="lead_time" name="lead_time" value="{{$supplier->lead_time}}" placeholder="Lead time for order fulfilment from the supplier/vendor">
                        </div>
                            <!--Quality Standard -->
                            <div class="mb-3 col-md-6">
                            <label for="quality_standard" class="form-label">Quality Standard</label>
                            <input type="text" class="form-control" id="quality_standard" name="quality_standard" value="{{$supplier->quality_standard}}" placeholder="Quality standard approved by goverment (e.g. ISO 9001 Certified)">
                        </div>


                            <!--Quality Standard -->
                        <div class="mb-3 col-md-6">
                            <label for="contract_terms" class="form-label">Contract Terms</label>
                            <input type="text" class="form-control" id="contract_terms" name="contract_terms" value="{{$supplier->contract_terms}}" placeholder="Contract terms signed (e.g. NON Disclosure Aggreement required)">
                        </div>

                        
                        <!-- Notes -->
                        <div class="mb-3 col-md-6">
                            <label for="notes" class="form-label">Notes</label>
                            <input type="text" class="form-control" id="notes" name="notes" value="{{$supplier->notes}}" placeholder="Additional notes or comments about the supplier/vendor (optional)">
                        </div>


                        <!-- Notes -->
                        <div class="mb-3 col-md-6">
                            <label for="steps" class="form-label">Next Steps</label>
                            <input type="text" class="form-control" id="steps" name="steps" value="{{$supplier->steps}}" placeholder="Enter Next steps (optional)">
                        </div>


                    <!-- Submit Button -->
                    <div class="form-group col-md-12">
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
