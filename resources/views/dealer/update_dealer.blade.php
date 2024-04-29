@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Update {{$dealer->dealership_name}}
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Update {{$dealer->dealership_name}} Dealer<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
        </nav>
    </div>
    <div>
                        <div>
                        <div>
    <div class="row">
        <div class="col-lg-12 m-0 p-0">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Update {{$dealer->dealership_name}} :</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
                <form action="{{url('dealers/update/'.$dealer->id)}}" method="POST" class="row">
                    @csrf
                    <!-- Dealership name  -->
                    <div class="form-group col-md-6">
                        <label for="dealer_name" class="form-control-label"><b>Dealership Name :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="text" class="form-control" name="dealer_name" id="dealer_name" placeholder="Name of the dealer or dealership." value="{{$dealer->dealership_name}}">
                        @error('dealer_name')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    <!--End Dealership name  -->



                    <!-- Dealership contact_person name  -->
                    <div class="form-group col-md-6">
                        <label for="contact_person" class="form-control-label"><b>Contact Person Name :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Name of the primary contact person at the dealership." value="{{$dealer->dealership_contact_person}}">
                        @error('contact_person')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    <!--End Dealership contact_person name  -->

                    <!-- Dealership contact_number name  -->
                    <div class="form-group col-md-6">
                        <label for="contact_number" class="form-control-label"><b>Contact Number :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Phone number of the primary contact person." value="{{$dealer->dealership_contact_number}}">
                        @error('contact_number')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    <!--End Dealership contact_number name  -->

                    <!-- Dealership contact_email name  -->
                    <div class="form-group col-md-6">
                        <label for="contact_email" class="form-control-label"><b>Contact Email :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="email" class="form-control" name="contact_email" id="contact_email" placeholder="Email address of the primary contact person." value="{{$dealer->dealership_contact_email}}">
                        @error('contact_email')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    <!--End Dealership contact_email name  -->

                    <!-- Dealership contact_address name  -->
                        <div class="form-group col-md-6">
                        <label for="contact_address" class="form-control-label"><b>Contact Address :</b></label>
                        <input type="text" class="form-control" name="contact_address" id="contact_address" placeholder="Physical address of the dealership." value="{{$dealer->dealership_contact_address}}">
                        @error('contact_address')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    <!--End contact_address name  -->

                    <!-- Dealership dealership_located_city name  -->
                    <div class="form-group col-md-6">
                        <label for="dealership_located_city" class="form-control-label"><b>Dealership City :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="text" class="form-control" name="dealership_located_city" id="dealership_located_city" placeholder="City where the dealership is located." value="{{$dealer->dealership_located_city}}">
                        @error('dealership_located_city')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    <!--End dealership_located_city name  -->

                    <!-- Dealership dealership_located_state name  -->
                    <div class="form-group col-md-6">
                        <label for="dealership_located_state" class="form-control-label"><b>Dealership State :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="text" class="form-control" name="dealership_located_state" id="dealership_located_state" placeholder="State or province where the dealership is located." value="{{$dealer->dealership_located_state}}">
                        @error('dealership_located_state')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    <!--End dealership_located_state name  -->

                    <!-- Dealership dealership_located_country name  -->
                    <div class="form-group col-md-6">
                        <label for="dealership_located_country" class="form-control-label"><b>Dealership Country :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="text" class="form-control" name="dealership_located_country" id="dealership_located_country" placeholder="Country where the dealership is located." value="{{$dealer->dealership_located_country}}">
                        @error('dealership_located_country')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    <!--End dealership_located_country name  -->

                    <!-- Dealership dealership_located_pincode name  -->
                        <div class="form-group col-md-6">
                        <label for="dealership_located_pincode" class="form-control-label"><b>Zipcode/Pincode :</b></label>
                        <input type="text" class="form-control" name="dealership_located_pincode" id="dealership_located_pincode" placeholder="ZIP/Postal Code: ZIP or postal code of the dealership location." value="{{$dealer->dealership_located_pincode}}">
                        @error('dealership_located_pincode')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    <!--End dealership_located_pincode name  -->

                    <!-- Dealership dealership_type name  -->
                    <div class="form-group col-md-6">
                        <label for="dealership_type" class="form-control-label"><b>Dealership Type :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="text" class="form-control" name="dealership_type" id="dealership_type" placeholder="Dealership Type (e.g., Authorized dealer, Independent dealer)." value="{{$dealer->dealership_type}}">
                        @error('dealership_type')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    <!--End dealership_type name  -->

                    <!-- Dealership dealership_business_type name  -->
                    <div class="form-group col-md-6">
                        <label for="dealership_business_type" class="form-control-label"><b>Dealership Business Type :</b></label>
                        <input type="text" class="form-control" name="dealership_business_type" id="dealership_business_type" placeholder="Nature of the dealership business (e.g., Sales, Service, Both)." value="{{$dealer->dealership_business_type}}">
                        @error('dealership_business_type')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--End dealership_business_type name  -->

                    <!-- Dealership dealership_associated_brands name  -->
                    <div class="form-group col-md-6">
                        <label for="dealership_associated_brands" class="form-control-label"><b>Dealership Associated Brands :</b></label>
                        <input type="text" class="form-control" name="dealership_associated_brands" id="dealership_associated_brands" placeholder="Brands or manufacturers associated with the dealership." value="{{$dealer->dealership_associated_brand}}">
                        @error('dealership_associated_brands')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--End dealership_associated_brands name  -->

                    <!-- Dealership dealership_sales_territory name  -->
                    <div class="form-group col-md-6">
                        <label for="dealership_sales_territory" class="form-control-label"><b>Sales Territory :</b></label>
                        <input type="text" class="form-control" name="dealership_sales_territory" id="dealership_sales_territory" placeholder="Territory or region served by the dealership." value="{{$dealer->dealership_sales_territory}}">
                        @error('dealership_sales_territory')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--End dealership_sales_territory name  -->

                    <!-- Dealership dealership_taxid name  -->
                    <div class="form-group col-md-6">
                        <label for="dealership_taxid" class="form-control-label"><b>Dealership TaxId :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="text" class="form-control" name="dealership_taxid" id="dealership_taxid" placeholder="Tax identification number of the dealership." value="{{$dealer->dealership_taxid}}">
                        @error('dealership_sales_territory')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--End dealership_taxid name  -->

                    <!-- Dealership dealership_licence_number   -->
                    <div class="form-group col-md-6">
                        <label for="dealership_licence_number" class="form-control-label"><b>Dealership Licence Number :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="text" class="form-control" name="dealership_licence_number" id="dealership_licence_number" placeholder="License number of the dealership (if applicable)." value="{{$dealer->dealership_licence_number}}">
                        @error('dealership_licence_number')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--End dealership_licence_number   -->

                    <!-- Dealership dealership_registration_date  -->
                    <div class="form-group col-md-6">
                        <label for="dealership_registration_date" class="form-control-label"><b>Dealership Registration Date :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="date" class="form-control" name="dealership_registration_date" id="dealership_registration_date" placeholder="License number of the dealership (if applicable)." value="{{$dealer->dealership_registration_date}}">
                        @error('dealership_registration_number')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--End dealership_registration_date   -->

                    <!-- Dealership dealership_licence_renewal_date  -->
                    <div class="form-group col-md-6">
                        <label for="dealership_licence_renewal_date" class="form-control-label"><b>Renewal Date :<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <input type="date" class="form-control" name="dealership_licence_renewal_date" id="dealership_licence_renewal_date" placeholder="Date for license or registration renewal." value="{{$dealer->dealership_licence_renewal_date}}">
                        @error('dealership_licence_renewal_date')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--End dealership_licence_renewal_date   -->

                    <!-- Dealership dealership_status  -->
                    <div class="form-group col-md-6">
                        <label for="dealership_status" class="form-control-label"><b>Dealership Status:<sup style="color:red;font-size:15px;">*</sup></b></label>
                        <select class="form-control p-3" name="dealership_status" id="dealership_status" style="color:black;">
                            <option value="1" {{ $dealer->dealership_status == 1 ? 'selected' : '' }}>Select</option>
                            <option value="2" {{ $dealer->dealership_status == 2 ? 'selected' : '' }}>Active</option>
                            <option value="3" {{ $dealer->dealership_status == 3 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('dealership_status')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--End dealership_status   -->

                    <!-- Dealership dealership_notes  -->
                    <div class="form-group col-md-12">
                        <label for="dealership_notes" class="form-control-label"><b>Dealership Note's:</b></label>
                        <input type="text" class="form-control" name="dealership_notes" id="dealership_notes" placeholder="Any additional notes or remarks about the dealership. &nbsp;&nbsp;(eg. maximum 250words)"  value="{{$dealer->dealership_notes}}">
                        @error('dealership_notes')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--End dealership_notes   -->


                    
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-md" value="Submit">
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


