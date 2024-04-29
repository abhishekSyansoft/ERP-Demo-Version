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



            <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Dealers Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <b style="color:white;font-size:20px;"><a href="{{route('dealers.create')}}" class="btn btn-primary mdi mdi-plus-circle" style="color:white;float:right;">New</a></b>
                       
                        </div>
                        <!-- <hr>   -->
                      </div>   
                    </div>  
                        <div class="table-wrapper">
                    <table class="table">
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
                        @for($a=0;$a<8;$a++)
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
                        @endfor
                        @endforeach
                    </table>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
          <!-- content-wrapper ends -->
         
        <!-- main-panel ends -->
@include('admin.layout.footer')