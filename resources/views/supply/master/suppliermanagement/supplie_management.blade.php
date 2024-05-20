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
              
            <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Supplier/Vendor Lists</h4>
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
                            <tr>
                                
                                <th rowspan="2">S No.</th>
                                <th rowspan="2">Vendor Id</th>
                                <th rowspan="2">Vendor</th>
                                <th rowspan="2">Manager</th>
                                <th rowspan="1" colspan="3">Vendor</th>
                                <th rowspan="1" colspan="4">Contact Information</th>
                                <th rowspan="1" colspan="5">Location</th>
                                <th rowspan="2">Type</th>
                                <th rowspan="2">Product/Serveices</th>
                                <th rowspan="2">Prefered Payment Terms</th>
                                <th rowspan="2">Delivery Shedule</th>
                                <th rowspan="2">Quality Standard</th>
                                <th rowspan="2">Contract Terms</th>
                                <th rowspan="1" colspan="4">Account detail's</th>
                                <th rowspan="2">Notes</th>
                                <th rowspan="2">Next Steps</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                              <th>Evaluation</th>
                              <th>Diversity</th>
                              <th>Relationship</th>
                              <th>Contact Person</th>
                              <th>Phone Number</th>
                              <th>Email</th>
                              <th>Preffered Method</th>
                              <th colspan="1">Address</th>
                              <th colspan="1">City</th>
                              <th colspan="1">State</th>
                              <th colspan="1">Country</th>
                              <th colspan="1">Postal Code</th>
                              <th colspan="1">Account Number</th>
                              <th colspan="1">Tax ID</th>
                              <th colspan="1">GSTIN Number</th>
                              <th colspan="1">TIN Number</th>
                            </tr>
                            @php($i=1)
                            @foreach($supplier as $vendor)
                          
                            <tr>
                                
                                <td>{{$i++}}</td>
                                <td>{{$vendor->supplier_id}}</td>
                                <td>{{$vendor->supplier_name}}</td>
                                <td>{{$vendor->manager}}</td>
                                <td>{{$vendor->supplier_evaluation}}</td>
                                <td>{{$vendor->supplier_diversity}}</td>
                                <td>{{$vendor->supplier_relationship}}</td>
                                <td>{{$vendor->contact_person}}</td>
                                <td>{{$vendor->phone_number}}</td>
                                <td>{{$vendor->email}}</td>
                                <td>{{$vendor->method}}</td>
                                <td>{{$vendor->address}}</td>
                                <td>{{$vendor->city}}</td>
                                <td>{{$vendor->state}}</td>
                                <td>{{$vendor->country}}</td>
                                <td>{{$vendor->postal_code}}</td>
                                <td>{{$vendor->type == 1 ? 'Manufacturing' :($vendor->type == 2 ? 'Sales' :($vendor->type == 3 ? 'Production' :($vendor->type == 4 ? 'Distribution' :'')))}}</td>
                                <td>{{$vendor->service}}</td>
                                <td>{{$vendor->payment_terms}}</td>
                                <td>{{$vendor->lead_time}}</td>
                                <td>{{$vendor->quality_standard}}</td>
                                <td>{{$vendor->contract_terms}}</td>
                                <!-- <td></td> -->
                                <!-- <td></td> -->
                                <!-- <td></td>
                                <td></td> -->
                                <td>{{$vendor->account_number}}</td>
                                <td>{{$vendor->tax_id}}</td>
                                <td>{{$vendor->gst_in}}</td>
                                <td>{{$vendor->tin_no}}</td>
                                <td>{{$vendor->notes}}</td>
                                <td>{{$vendor->steps}}</td>
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
          </div>


          
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSupplierModalLabel">Add Supplier</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 m-1">
        <!-- Supplier Form -->
        <form id="addSupplierForm" method="POST" action="{{route('supplier.add')}}" class="row">
        @csrf
          <!-- Supplier ID
          <div class="mb-3 col-md-6">
            <label for="supplier_id" class="form-label">Supplier ID</label>
            <input type="text" class="form-control" id="supplier_id" name="supplier_id" required>
          </div> -->

          <!-- Supplier Name -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="supplier_name" class="form-label">Vendor Name</label>
            <input type="text" class="form-control" id="supplier_name" name="supplier_name" required placeholder="Name of the supplier/vendor">
          </div>

           <!-- Supplier Name -->
           <div class="mb-3 col-md-6 col-lg-3">
            <label for="service" class="form-label">Product/Service</label>
            <input type="text" class="form-control" id="service" name="service" placeholder="Enter short detail about produt or service" required>      
          </div>

          <!-- Tin Number -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="tin_no" class="form-label">TIN Number</label>
            <input type="text" class="form-control" id="tin_no" name="tin_no" placeholder="Enter TIN Number of the supplier" required>      
          </div>

          <!-- GSTIN Number Number -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="gst_in" class="form-label">GSTIN Number</label>
            <input type="text" class="form-control" id="gst_in" name="gst_in" placeholder="Enter GST IN Number of the supplier" required>      
          </div>

          <!-- Account Manager Number -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="manager" class="form-label">Account Manager</label>
            <input type="text" class="form-control" id="manager" name="manager" placeholder="The designated account manager or representative at the supplier's organization." required>      
          </div>

          <!-- Supplier Evaluation Number -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="supplier_evaluation" class="form-label">Supplier Evaluation</label>
            <input type="text" class="form-control" id="supplier_evaluation" name="supplier_evaluation" placeholder="Evaluation criteria and scores used to assess and rank suppliers based on performance, reliability, and quality." required>      
          </div>

           <!-- Supplier Diversity Number -->
           <div class="mb-3 col-md-6 col-lg-3">
            <label for="supplier_diversity" class="form-label">Supplier Diversity</label>
            <input type="text" class="form-control" id="supplier_diversity" name="supplier_diversity" placeholder="Information about diversity initiatives and programs aimed at sourcing from diverse suppliers." required>      
          </div>

              <!-- Supplier Relationship Number -->
              <div class="mb-3 col-md-6 col-lg-3">
            <label for="supplier_relationship" class="form-label">Supplier Relationship</label>
            <input type="text" class="form-control" id="supplier_relationship" name="supplier_relationship" placeholder="Information about diversity initiatives and programs aimed at sourcing from diverse suppliers." required>      
          </div>

          
          <!-- Account Number -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="account_number" class="form-label">Account Number</label>
            <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account number for financial transactions">
          </div>

          <!-- Tax ID -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="tax_id" class="form-label">Tax ID</label>
            <input type="text" class="form-control" id="tax_id" name="tax_id" placeholder="Tax identification number for the supplier/vendor">
          </div>

          <hr class="m-1 mb-3">

          <div class="mb-3 col-md-6">
             <div class="row">
             <strong class="mb-2">Contact Information : </strong>
          <!-- Contact Person -->
              <div class="col-md-6 mb-3">
                <label for="contact_person" class="form-label">Contact Person</label>
                <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact person at the supplier/vendor">
              </div>
              <!-- Phone Number -->
              <div class="col-md-6 mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number of the supplier/vendor">
              </div>
              <!-- Email -->
              <div class="col-md-12 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address of the supplier/vendor">
              </div>

              <div class="col-md-12 mb-3">
                <label for="method" class="form-label">Preffered Communication Method</label>
                <select class="form-control p-3" id="method" name="method">
                  <option value="">--select--</option>
                  <option value="Email">Email</option>
                  <option value="Phone">Phone</option>
                  <option value="Fax">Fax</option>
                </select>
              </div>
             </div>
          </div>

          <div class="mb-3 col-md-6 row mx-auto">
              <strong class="mb-2">Location : </strong>
              <!-- Address -->
            <div class="col-md-12 mb-3">
              <label for="address" class="form-label">Streen Address</label>
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
          </div>

          <hr class="m-1 mb-3">


          <!-- Type -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-control p-3" id="type" name="type" required>
              <option value="">--Select--</option>
              <option value="1">Manufacturing</option>
              <option value="2">Sales</option>
              <option value="3">Production</option>
              <option value="4">Distribution</option>
            </select>
          </div>

           <!--Prefered Payment Terms -->
           <div class="mb-3 col-md-6 col-lg-3">
            <label for="payment_terms" class="form-label">Prefered Payment Terms</label>
            <input type="text" class="form-control" id="payment_terms" name="payment_terms" placeholder="Payment terms agreed upon with the supplier/vendor">
          </div>

          <!--Delivery Shedule Lead Time -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="lead_time" class="form-label">Deliery Shedule</label>
            <input type="text" class="form-control" id="lead_time" name="lead_time" placeholder="Lead time for order fulfilment from the supplier/vendor">
          </div>
            <!--Quality Standard -->
            <div class="mb-3 col-md-6 col-lg-3">
            <label for="quality_standard" class="form-label">Quality Standard</label>
            <input type="text" class="form-control" id="quality_standard" name="quality_standard" placeholder="Quality standard approved by goverment (e.g. ISO 9001 Certified)">
          </div>


            <!--Quality Standard -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="contract_terms" class="form-label">Contract Terms</label>
            <input type="text" class="form-control" id="contract_terms" name="contract_terms" placeholder="Contract terms signed (e.g. NON Disclosure Aggreement required)">
          </div>

         
          <!-- Notes -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="notes" class="form-label">Notes</label>
            <input type="text" class="form-control" id="notes" name="notes" placeholder="Additional notes or comments about the supplier/vendor (optional)">
          </div>


          <!-- Notes -->
          <div class="mb-3 col-md-6 col-lg-3">
            <label for="steps" class="form-label">Next Steps</label>
            <input type="text" class="form-control" id="steps" name="steps" placeholder="Enter Next steps (optional)">
          </div>

          <!-- Submit Button -->
          <div class="form-group col-md-12">
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
