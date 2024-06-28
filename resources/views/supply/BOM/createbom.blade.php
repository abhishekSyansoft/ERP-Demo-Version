@include('admin.layout.header')
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
                  <div class="card-body p-0" style="border-radius:15px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">Bill Of Material Lists for different Bike</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6 mx-auto">
   
                        
                        <!-- <button type="button" class="btn btn-primary" id="compareAuctionBTN" style="float:right;margin-left:10px;">
                        <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-compare"></a></b>
                        Compare Reverse Bidding
                        </button>
                        <button type="button" class="btn btn-primary" id="compareForwardBTN" style="float:right;margin-left:10px;">
                        <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-compare"></a></b>  
                            Compare Forward Bidding
                        </button>  -->
                        <button style="float:right;" type="button" id="CreateNewBOMButton" class="btn btn-primary btn-sm">
                          <b style="color:white;font-size:20px;"><a style="color:white;" class="mdi mdi-plus-circle"></a></b>New
                        </button> 
                        </div>
                        <!-- <hr>   -->
                      </div>                                
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                        Edit Supplier\\\\\\\\\\
                        </button>   -->

                        <!-- <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit Order &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button> -->
                        
                        
                <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <div class="table-wrapper">
                        <table class="table" style="width: 100%;" id="auction_bid_table_received">
                            <tr>
                                <th>S. No.</throws>
                                <th>Product ID</th>
                                <th>File Uploaded</th>
                                <th>View BOM</th>
                                <!-- <th>Created On</th> -->
                                <th>Action</th>
                            </tr>
                            @php($a=1)
                              @foreach($boms as $bom)
                                <tr>
                                  <td>{{$a++}}</td>
                                  <td>{{$bom->product_id}}</td>
                                  <td><a class="btn btn-primary mdi mdi-eye" href="{{asset($bom->file_path)}}"></a></td>
                                  <td><a class="mdi mdi-eye btn btn-primary viewBomLists" data-id="{{$bom->product_id}}"></a></td>
                                  <td>
                                      <a class="btn btn-primary">Edit</a>
                                      <a class="btn btn-danger">Delete</a>
                                  </td>
                                </tr>
                              @endforeach
                        </table>
                       
                  </div>
                 
                </div>
              </div>
            </div>
          </div>
        <!-- </div> -->




<!-- Modal -->
<div class="modal fade" id="suppliersModal" tabindex="-1" aria-labelledby="suppliersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h5 class="modal-title" id="suppliersModalLabel">Auction Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3 class="mb-3">Auction Item  and complete details</h3>
        <div class="table-wrapper" style="height:auto;">
        <table class="table table-bordered border-primary mb-3">
          <tr>
            <th>Item Decription</th>
            <th>Item Features</th>
            <th>Quantity</th>
           
          </tr>
          <tr>
            <td id="desc"></td>
            <td id="features"></td>
            <td id="quantity"></td>
          </tr>
          
        </table>
        </div>
        <div class="table-wrapper" style="height:auto;">
        <table class=" table table-bordered border-primary" style="width:100%;">
          <tr>
            <th class="p-2">Description</th>
            <th class="p-2">Details</th>
            <th class="p-2">Photo</th>
          </tr>
          <tr>
            <th class="p-2" style="text-align:left !important;">Auction Number : <td class="p-2" id="auction_number">Auct_66712207eb7eb</td></th>
            <td rowspan="6" class="p-0 m-0" style="background-color:black;"><img id="item_img" src="https://th.bing.com/th?id=OIP.qNJ-3o_aLdtFRswCO9VLOgHaEK&w=333&h=187&c=8&rs=1&qlt=90&o=6&dpr=1.5&pid=3.1&rm=2" style="object-fit:cotain;height:100%;width:100%;border-radius:0px;padding:0px;margib:0px;" alt=""></td>
          </tr>
          <tr>
            <th class="p-2" style="text-align:left !important;">Auction Created On : <td class="p-2" id="c_date" style="text-align:left !important;">2024-06-18</td></th>
          </tr>
          <tr>
            <th class="p-2" style="text-align:left !important;">Last date to submit bid in Auction : <td class="p-2" id="last_date_to_submit" style="text-align:left !important;">2024-06-28</td></th>
          </tr>
          <tr>
            <th class="p-2" style="text-align:left !important;">Start Price : <td class="p-2" id="price" style="text-align:left !important;"></td></th>
          </tr>
          <tr>
            <th class="p-2" style="text-align:left !important;">Auction Type : <td class="p-2" id="auction_type" style="text-align:left !important;">Reverse Auction</td></th>
          </tr>
          <tr>
            <th class="p-2" style="text-align:left !important;">Bidding Type : <td class="p-2" id="bidding_type" style="text-align:left !important;">Decrement</td></th>
          </tr>
          <tr>
            <th class="p-2" style="text-align:left !important;">Note's/Comments : <td class="p-2" colspan="2" id="notes" style="text-align:left !important;">Not Any till now</td></th>
          </tr>
        </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg mx-auto">
                    <div class="modal-content card mx-auto">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Comparision of AuctionBID</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <div class="modal-body compare">

                     <center> <h2 id="auction_type_head">AuctionBID Comparison</h2></center>
                     <hr>


      <div style="border:1px solid black;">
      <div class="row col-4 table-wrapper" style="height:auto !important;">
                        <h5 class="m-0 p-0 mb-3"><b>Comparison Metrics</b></h5>
                          <table class="col-6 table table-bordered table-striped">
                                <!-- <tr class="m-1">
                                  <th>Highest BID</th>
                                  <td style="background-color: #EB9595;"></td>
                                </tr> -->
                                <tr>
                                  <th id="bidder_name">Lowest BID</th>
                                  <td style="background-color: #90ee90;margin:10px !important;"></td>
                                </tr>
                                <!-- <tr>
                                  <th>All Equal</th>
                                  <td class="m-1" style="background-color:#F0F396;"></td>
                                </tr> -->
                                <!-- <tr>
                                  <th>Multiple Highest BID</th>
                                  <td style="background-color:#8BDCF1;"></td>
                                </tr> -->

                          </table>
                        </div>

                        <div class="table-wrapper" style="height:auto !important;">
                          <table class="table table-bordered border-primary">

                            <tbody id="CompSupplierList">
                            </tbody>
                          </table>
                        </div>

                        <div class="table-wrapper" style="height:auto !important;">
                        <table class="table table-bordered mt-2">
                          <thead>
                              <tr>
                                <th>Serial No</th>
                                <th>Vendor Name</th>
                                <th>Auction Number</th>
                                <th>Unique BID Number</th>
                                <th class="text-center">Send For Approval</th>
                                <th class="text-center">Send For Negotiation</th>
                              </tr>
                          </thead>
                        <tbody id="actionOnAuctBID">
                        </tbody>
                        </table>
                        </div>
                        <div class="form-group mt-2">
                          <!-- <button type="submit" class="btn btn-success">Check one to edit</button> -->
                           <!-- <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                            Check one to edit
                            </button>   -->
                        </div>
                        </div>
                          <button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal">Close</button>
                        
                       
                      </div>
                      
                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                      <!-- </div> -->
                    </div>
                  </div>
                </div>





  <!-- Modal -->
  <div class="modal fade" id="BOMViewModal" tabindex="-1" aria-labelledby="BOMViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:white;">
                <div class="modal-header">
                    <h5 class="modal-title btn btn-primary">Bill Of Material for <span class="product_name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                <div class="row mx-auto">
                  <div class="col-md-6 row">
                        <h5 class="col-12"><b>Product Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="product_name"></span></h5>
                        <h5 class="col-12"><b>Product Code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="product_code"></span></h5>
                        <h5 class="col-12"><b>Model Year & Date &nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="model_year"></span></h5>
                        <h5 class="col-12"><b>Total Cost Of Material &nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rs. <span id="material_cost"></span></h5>

                  </div>
                  <div class="col-md-6 row">
                        <h5 class="col-12"><b>Mileage Of Bike &nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="mileage"></span>km/hr.</h5>
                        <h5 class="col-12"><b>Selling Price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rs.<span id="sp"></span></h5>
                        <h5 class="col-12">
                          <b>Color of Bike &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                          <span id="color" style="height:10px;width:20px;padding-left:200px !important;"></span>
                        </h5>
                  </div>
                </div>
                <div class="container p-3" style="border:1px solid black;">
                  
                  <div class="table-wrapper" style="height:auto !important;">
                    <table class="table table-bordered border-primary">
                    <th>Part Name</th>
                    <th>Item Number</th>
                    <th>Serial Number</th>
                    <th>Category</th>
                    <th>Parent Item</th>
                    <th>Child Item</th>
                    <th>Unit Cost (₹)</th>
                    <th>Quantity</th>
                    <th>Unit of Measure</th>
                    <th>Total Cost (₹)</th>
                    <th>Dependencies</th>
                    <th>Constraints</th>
                    <th>Hazardous Material</th>
                    <th>Life Cycle Stage</th>
                    <th>Supplier Name</th>
                    <th>Supplier Part Number</th>
                    <th>Lead Time (Days)</th>
                    <th>Disposable Info</th>
                    <th>EOL Info</th>
                    <th>Created At</th>
                      <tbody class="BOMItemLists">

                      </tbody>
                    </table>
                  </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>






          
<!-- Add Supplier Modal -->
<div class="modal fade" id="auctionInitiate" tabindex="-1" aria-labelledby="auctionInitiateLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color:white;">
      <div class="modal-header">
        <h4 class="modal-title" id="auctionInitiateLabel">
        <div class="tab" id="bom_part_creation">
            <button class="tablinks btn btn-lg btn-success" onclick="openCity(event, 'category')">Using Form</button>
            <button class="tablinks btn btn-lg btn-success" onclick="openCity(event, 'bulk')">Bulk Upload</button>
        </div>
        </h4>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close Form</button>
      </div>
      <div class="modal-body">
        <!-- Rescource Form -->

                    <div id="category" class="tabcontent">
                        <form method="POST" class="row">
                            @csrf

                            <div class="form-group col-md-12">
                                <div class="table-wrapper" style="height:auto;margin:0px !important;">
                                    <table class="table p-0 m-0 table-bordered border-primary" style="width:100%;">
                                       
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Year Of Model</th>
                                                <th>Mileage Of the Bike</th>
                                                <th>Decided Selling Price</th>
                                                <th>Status Of the Bike</th>
                                                <th>Color</th>
                                                <th>Part</th>
                                                <th>Item Number</th>
                                                <th>Serial Number</th>
                                                <th>Category</th>
                                                <th>Quantity</th>
                                                <th>Unit of Measure</th>
                                                <th>Parent Item</th>
                                                <th>Child Item</th>
                                                <th>Unit Cost <b>(Rs.)</b></th>
                                                <th>Total Cost <b>(Rs.)</b></th>
                                                <th>Dependencies</th>
                                                <th>Constraints</th>
                                                <th>Hazardous Material</th>
                                                <th hidden>Disposable Information</th>
                                                <th>Life Cycle Stage</th>
                                                <th hidden>EOL Info</th>
                                                <th>Supplier Name</th>
                                                <th>Supplier Part Number</th>
                                                <th>Lead Time (Days)</th>
                                            </tr>
                                       
                                        <tbody id="BOMListsTableItem">
                                            <!-- New rows will be appended here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <hr>
                                <h4>Product Detail's</h4>
                                <hr>
                            </div>




                            <div class="form-group col-md-3">
                                <label for="product_name" class="form-control-label"><b> Product Name : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter the name of the product">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="product_code" class="form-control-label"><b> Product Code : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" name="product_code" id="product_code" class="form-control" value="VIN_{{uniqid()}}" placeholder="Unique code for the product">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="year" class="form-control-label"><b> Model Year : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="date" name="year" id="year" class="form-control" placeholder="year of the model when the model of bike is developes">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="mileage" class="form-control-label"><b> Mileage of the Bike : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="varchar" name="mileage" id="mileage" class="form-control" placeholder="Mileage of the bike">
                            </div>

                            <!-- <div class="form-group col-md-3">
                                <label for="sprice" class="form-control-label"><b> Selling Price of the bike : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" name="sprice" id="sprice" class="form-control" placeholder="Price of the bike">
                            </div> -->

                            <div class="form-group col-md-3">
                                <label for="status" class="form-control-label"><b> Bike status : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select name="status" id="status" class="form-control p-3">
                                  <option value="">--Select status--</option>
                                  <option value="Sale">Sale</option>
                                  <option value="Under Development">Under Development</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="bikeColor">Choose a bike color:</label>
                              <input list="colors" id="bikeColor" name="bikeColor" class="form-control">
                              <datalist id="colors">
                                <option value="Red"></option>
                                <option value="Green"></option>
                                <option value="Blue"></option>
                                <option value="Yellow"></option>
                                <option value="Orange"></option>
                                <option value="Purple"></option>
                                <option value="Black"></option>
                                <option value="White"></option>
                                <option value="Grey"></option>
                                <option value="Gold"></option>
                              </datalist>

                              <div class="row mt-3">
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#FF0000">
                                  <span class="color-option" style="background-color:#FF0000;"></span> Red
                                </div>
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#00FF00">
                                  <span class="color-option" style="background-color:#00FF00;"></span> Green
                                </div>
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#0000FF">
                                  <span class="color-option" style="background-color:#0000FF;"></span> Blue
                                </div>
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#FFFF00">
                                  <span class="color-option" style="background-color:#FFFF00;"></span> Yellow
                                </div>
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#FFA500">
                                  <span class="color-option" style="background-color:#FFA500;"></span> Orange
                                </div>
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#800080">
                                  <span class="color-option" style="background-color:#800080;"></span> Purple
                                </div>
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#000000">
                                  <span class="color-option" style="background-color:#000000;"></span> Black
                                </div>
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#FFFFFF">
                                  <span class="color-option" style="background-color:#FFFFFF; border: 1px solid #000;"></span> White
                                </div>
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#A9A9A9">
                                  <span class="color-option" style="background-color:#A9A9A9;"></span> Grey
                                </div>
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#FFD700">
                                  <span class="color-option" style="background-color:#FFD700;"></span> Gold
                                </div>
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#A9A9A9">
                                  <span class="color-option" style="background-color:#A9A9A9;"></span> Grey
                                </div>
                                <div class="color-label col-md-6 col-lg-4">
                                  <input type="radio" name="color" value="#FFD700">
                                  <span class="color-option" style="background-color:#FFD700;"></span> Gold
                                </div>
                              </div>
                            </div>



                            <div class="form-group col-md-12">
                                <hr>
                                <h4>Item Detail's</h4>
                                <hr>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="parts" class="form-control-label"><b>Item description: <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input list="parts" name="part" id="part" class="form-control p-3" placeholder="--Select Parts--">
                                <datalist id="parts">
                                    @foreach($categories as $category)
                                        @if($category->parent_id == 0)
                                            @php($label = $category->category_name)
                                            @php($parent_id = $category->id)
                                        @endif
                                        <optgroup label="{{$label}}">
                                            @foreach($sub_categories as $subcategory)
                                                @if($parent_id == $subcategory->parent_id)
                                                    <option value="{{$subcategory->category_name}}">{{$subcategory->category_name}}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </datalist>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="item_number" class="form-control-label"><b> Item Number : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" name="item_number" id="item_number" class="form-control" placeholder="SKU for the particular item">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="serial" class="form-control-label"><b> Serial Number : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" name="serial" id="serial" class="form-control" placeholder="Serial number for th item">
                            </div>


                            <div class="form-group col-md-3">
                                <label for="product" class="form-control-label"><b>Category: <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input list="products" name="product" id="product" class="form-control p-3" placeholder="Select category fro which the part belongs to">
                                <datalist id="products">
                                    @foreach($categories as $category)
                                        @if($category->parent_id == 0)
                                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                        @endif
                                    @endforeach
                                </datalist>
                            </div>

                            <div class="col-12 row p-0 m-0">
                                <div class="col-md-6 row mx-auto p-0">
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4>Quantity</h4>
                                        <hr>
                                    </div> 
                                    <div class="form-group col-md-6">
                                        <label for="qty_required" class="form-control-label"><b> Quantity : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                        <input type="number" name="qty_required" id="qty_required" class="form-control" placeholder="Enter the quantity required in number">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="unit" class="form-control-label"><b> Unit of Measure :</b></label>
                                        <input type="text" name="unit" id="unit" class="form-control" placeholder="Enter the unit of measure required">
                                    </div>
                                </div>
                                <div class="col-md-6 row mx-auto p-0">
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4>Hierarchical Structure</h4>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="parent" class="form-control-label"><b> Parent Item : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                        <input type="text" name="parent" id="parent" class="form-control" placeholder="Name of the parent Item">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="child" class="form-control-label"><b> Child Item :</b></label>
                                        <input type="text" name="child" id="child" class="form-control" placeholder="Name of the child Item">
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 row p-0 m-0">
                                <div class="col-md-6 row mx-auto p-0">
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4>Cost Information</h4>
                                        <hr>
                                    </div> 
                                    <div class="form-group col-md-6">
                                        <label for="unit_cost" class="form-control-label"><b> Unit Costs <b>(Rs.)</b> : </b><sup style="color:red;font-size:15px;">*</sup></b></label>
                                        <input type="number" name="unit_cost" id="unit_cost" class="form-control" placeholder="Unit cost for the item">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="total_cost" class="form-control-label"><b> Total Costs <b>(Rs.)</b> :</b></label>
                                        <input type="text" name="total_cost" id="total_cost" class="form-control" placeholder="Total cost for the item (unit * quantity)">
                                    </div>
                                </div>
                                <div class="col-md-6 row mx-auto p-0">
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4>Dependencies and Constraints</h4>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="dependencies" class="form-control-label"><b>Dependencies :</b></label>
                                        <input list="dependency" name="dependencies" id="dependencies" class="form-control p-3" placeholder="Item that affect production">
                                        <datalist id="dependency">
                                            @foreach($categories as $category)
                                                @if($category->parent_id == 0)
                                                    @php($label = $category->category_name)
                                                    @php($parent_id = $category->id)
                                                @endif
                                                <optgroup label="{{$label}}">
                                                    @foreach($sub_categories as $subcategory)
                                                        @if($parent_id == $subcategory->parent_id)
                                                            <option value="{{$subcategory->category_name}}">{{$subcategory->category_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </datalist>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="constraints" class="form-control-label"><b> Constraints :</b></label>
                                        <input type="text" name="constraints" id="constraints" class="form-control" placeholder="Limitations or restrictions">
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 row p-0 m-0">
                            <div class="col-md-6 row mx-auto p-0">
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4>Enviromental and Safety Information</h4>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="hazardous_material" class="form-control-label"><b>Hazardous Material : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                        <select name="hazardous_material" id="hazardous_material" class="form-control p-3">
                                            <option value="">--select lifecycle stage--</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="dinfo" class="form-control-label"><b> Disposable Information :</b></label>
                                        <textarea  name="dinfo" id="dinfo" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 row mx-auto p-0">
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4>LifeCycle Management</h4>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="life_cycle" class="form-control-label"><b> LifeCycle Stage : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                        <select type="text" name="life_cycle" id="life_cycle" class="form-control p-3">
                                            <option value="">--select lifecycle stage--</option>
                                            <option value="Design">Design</option>
                                            <option value="Production">Production</option>
                                            <option value="Obsolete">Obsolete</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="eol" class="form-control-label"><b> EOL Info :</b></label>
                                        <textarea  name="eol" id="eol" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <hr>
                                <h4>Supplier Information</h4>
                                <hr>
                            </div>


                            <div class="form-group col-md-4">
                                <label for="supplier_name" class="form-control-label"><b> Supplier Name : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" name="supplier_name" id="supplier_name" class="form-control" placeholder="Name Of the supplier">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="supplier_part_number" class="form-control-label"><b> Part Number with the supplier : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" name="supplier_part_number" id="supplier_part_number" class="form-control" placeholder="Part number for this item to the supplier">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="lead_time_bom" class="form-control-label"><b> Lead Time in Days : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="number" name="lead_time_bom" id="lead_time_bom" class="form-control" placeholder="Lead Time for the item">
                            </div>

                            <div class="form-group col-md-12">
                               <hr>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-md" id="submit_bill_of_material">Submit Bill Of Material</button>
                                <a class="btn btn-primary btn-md" id="addToBOMLists">Add To BOM Lists</a>
                            </div>

                        </form>
                    </div>

                    <!-- <div id="subcategory" class="tabcontent">
                        <h3>Add Sub-Category</h3>
                        <form action="{{route('add.sub-category_item')}}" method="POST" class="row">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="product" class="form-control-label"><b> Vehicle Name : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" name="product" id="product" placeholder="Enter the name of the new Product Or vehicle">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subcategory" class="form-control-label"><b>Sub-Category Name : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" name="subcategory" id="subcategory" class="form-control" placeholder="Enter name to add sub-category">
                            </div>
                            <div class="form-group col-md-6">
                                <button name="submit" type="submit" class="btn btn-primary btn-md">Add Sub-Category</button>
                            </div>
                        </form>
                    </div> -->

                    <div id="bulk" class="tabcontent">
                    <h3>Bulk Upload</h3>
                      <form action="{{route('upload_bom')}}" method="post" enctype="multipart/form-data" class="row">
                          @csrf
                         <div class="mb-3 mt-3">  
                         <a class="mdi mdi-file" href="{{asset('Storage/images/imp_files/BOM_file.xlsx')}}" style="color:red;font-size:30px;"></a>
                         <i>Format to upload file to create a BOM <b>(click to download)</b></i>
                         </div>
                          <div class="form-group col-md-6">
                            <label for="file">Upload File <span style="color:red;">( .csv & .txt and .xlsx files only)<sup style="color:red;font-size:15px;">*</sup></span></label>
                            <input type="file" name="file" id="file" class="form-control">
                          </div>
                          <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                          </div>
                      </form>
                    </div>
                  </div>
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
                          <tbody class="prItemViewAllList">

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
                          <tbody class="prVendorList">
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