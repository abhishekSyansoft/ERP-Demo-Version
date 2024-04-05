@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dealer Details
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Dealer's <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
              
            <div class="row">
              <div class="col-md-12" style="margin:auto;">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">All Dealers</h4>
                      
                      <a href="{{route('dealers.create')}}" class="btn btn-primary btn-md">Add New Dealer</a>
                     
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <table class="table table-hover table-bordered mt-2">
                        <tr>
                            <th>S. No.</th>
                            <th>Dealer Name</th>
                            <th>Contact Person</th>
                            <th>Contact Number</th>
                            <th>Dealer's Email</th>
                            <th>Dealer's Address</th>
                            <th>Dealer's City</th>
                            <th>State/Province</th>
                            <th>Dealer's Country</th>
                            <th>Dealer's Zipcode</th>
                            <th>Dealer's Type</th>
                            <th>Bussiness Type</th>
                            <th>Associated Brands</th>
                            <th>Sales Territory</th>
                            <th>Dealership TaxId</th>
                            <th>Dealership Licence Number</th>
                            <!-- <th>Dealership Registration Number</th> -->
                            <th>Dealership Registration Date</th>
                            <th>Dealership Licence Renewal Date</th>
                            <th>Dealership Status</th>
                            <th>Notes</th>
                            <th>Action</th>
                        </tr>
                        @php($i=1)
                        @foreach($dealers as $dealer)
                        <tr>
                            <td>{{$i++}}</td>      
                            <td>{{$dealer->dealership_name}}</td>
                            <td>{{$dealer->dealership_contact_person}}</td>
                            <td>{{$dealer->dealership_contact_number}}</td>
                            <td>{{$dealer->dealership_contact_email}}</td>
                            <td>{{$dealer->dealership_contact_address}}</td>
                            <td>{{$dealer->dealership_located_city}}</td>
                            <td>{{$dealer->dealership_located_state}}</td>
                            <td>{{$dealer->dealership_located_country}}</td>
                            <td>{{$dealer->dealership_located_pincode}}</td>
                            <td>{{$dealer->dealership_type}}</td>
                            <td>{{$dealer->dealership_business_type}}</td>
                            <td>{{$dealer->dealership_associated_brand}}</td>
                            <td>{{$dealer->dealership_sales_territory}}</td>
                            <td>{{$dealer->dealership_taxid}}</td>
                            <td>{{$dealer->dealership_licence_number}}</td>
                            
                            <td>{{$dealer->dealership_registration_date}}</td>
                            <td>{{$dealer->dealership_licence_renewal_date}}</td>
                            
                            <td>{{$status = $dealer->dealership_status == 2 ? 'active' : ($dealer->dealership_status == 3 ? 'inactive' : 'false');}}</td>
                            <td>{{$dealer->dealership_notes}}</td>
                            <td>
                            <a href="{{url('dealers/edit/'.$dealer->id)}}" class="mdi mdi-pen mdi-lg m-2 btn btn-primary btn-sm">  Edit</a>
                            <!-- <a href="" class="btn btn-sm btn-primary">Update Role</a> -->
                            <a href="{{url('dealers/delete/'.$dealer->id)}}" class="mdi mdi-delete mdi-lg m-2 btn btn-danger btn-sm">  Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
           <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © SyanSoft 2024</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a href="" target="_blank">Module Master admin template</a> from Syansoft</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
@include('admin.layout.footer')