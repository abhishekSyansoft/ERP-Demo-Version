@include('admin.layout.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Create Order Header
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Create Order Header<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>




            

            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card" style="margin:auto;">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create Order Header</h4>


                    

                    <div class="tab">
                    <button class="tablinks btn btn-lg btn-success" onclick="openCity(event, 'order_header')">Order Header</button>
                    <button class="tablinks btn btn-lg btn-success" onclick="openCity(event, 'bulk')">Bulk Upload</button>
                    </div>
                    <hr>
                      <div>
                        <div>
                        <div>


                        



                    <div id="order_header" class="tabcontent">
                        <h3>Add Order Header</h3>
                        <form action="{{route('store.order-header')}}" method="POST" class="row" enctype="multipart/form-data">
                            @csrf

                            <!-- dealer -->
                            <div class="form-group col-md-6">
                                <label for="dealer" class="form-control-label"><b>Select Dealer : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select name="dealer" id="dealer" class="form-control p-3">
                                  @foreach($dealers as $dealer)
                                    <option value="{{$dealer->id}}">{{$dealer->dealership_name}}</option>
                                  @endforeach
                                </select>
                                @error('dealer')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            <!--End dealer  -->

                             <!-- order_status  -->
                             <!-- <div class="form-group col-md-6">
                                <label for="image" class="form-control-label"><b>Order Status : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="file" class="form-control" name="image" id="image" placeholder="Select image to upload">
                                @error('image')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div> -->
                            <!--End product image  -->

                            
                            <!-- order_status  -->
                            <div class="form-group col-md-6">
                                <label for="order_status" class="form-control-label"><b>Order Status : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select name="order_status" id="order_status" class="form-control p-3">
                                    <option value="0">--Select option--</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Processing</option>
                                    <option value="3">Shipped</option>
                                    <option value="4">Completed</option>
                                    <option value="5">Cancelled</option>
                                </select>                            
                            @error('order_status')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End order_status  -->

                            <!-- total_amount -->
                            <div class="form-group col-md-6">
                                <label for="total_amount" class="form-control-label"><b>Total Amount : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="total_amount" id="total_amount" placeholder="The total cost of the entire order">
                            
                            @error('total_amount')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End total_amount  -->

                            <!-- sales representative  -->
                            <div class="form-group col-md-6">
                                <label for="representative" class="form-control-label"><b>Sales Representative : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="representative" id="representative" placeholder="Name or ID of the sales representative handling the order.">
                            
                            @error('hsn')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End sales representative  -->

                            <!-- Shipping_address  -->
                            <div class="form-group col-md-6">
                                <label for="shipping_address" class="form-control-label"><b>Shipping Address : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="shipping_address" id="shipping_address" placeholder="Address where the order will be shipped.">
                            
                            @error('shipping_address')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product uom  -->

                            <!-- billing_address  -->
                            <div class="form-group col-md-6">
                                <label for="billing_address" class="form-control-label"><b>Billing Address : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="billing_address" id="billing_address" placeholder="Address for billing purposes">
                            
                            @error('billing_address')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End billing_address  -->

                            <!-- Payment Method -->
                            <div class="form-group col-md-6">
                                <label for="payment_method" class="form-control-label"><b>Payment Method : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="payment_method" id="payment_method">
                                    <option>--Select option--</option>
                                    <option value="1">Credit Card</option>
                                    <option value="2">Debit Card</option>
                                    <option value="3">Bank Transfer</option>
                                    <option value="4">Cash</option>
                                    <option value="5">Cash On Delivery</option>
                                </select>                            
                            @error('payment_method')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Payment Method  -->

                            <!-- Payment Status -->
                            <div class="form-group col-md-6">
                                <label for="payment_status" class="form-control-label"><b>Payment Status : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="payment_status" id="payment_status">
                                    <option>--Select option--</option>
                                    <option value="1">Paid</option>
                                    <option value="2">Pending</option>
                                    <option value="3">Overdue</option>
                                </select>                            
                            @error('payment_status')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Payment Status  -->

                            <!-- Shipping Method -->
                            <div class="form-group col-md-6">
                                <label for="shipping_method" class="form-control-label"><b>Shipping Method : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="shipping_method" id="shipping_method">
                                    <option>--Select option--</option>
                                    <option value="1">Standard</option>
                                    <option value="2">Expected</option>
                                </select>                            
                            @error('shipping_method')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Shipping Method  -->

                            <!-- Shipping carrier -->
                            <div class="form-group col-md-6">
                                <label for="shipping_carrier" class="form-control-label"><b>Shipping Carrier : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="shipping_carrier" id="shipping_carrier">
                                    <option>--Select option--</option>
                                    <option value="1">Blue Dart</option>
                                    <option value="2">E-kart</option>
                                    <option value="3">Others</option>
                                </select>                            
                            @error('shipping_carrier')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Shipping carrier  -->

                            <!-- Shipping Tracking Number  -->
                            <div class="form-group col-md-6">
                                <label for="shipping_tracking_number" class="form-control-label"><b>Shipping Tracking Number :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="shipping_tracking_number" id="shipping_tracking_number" placeholder="Tracking number provided by the shipping carrier.">
                            
                            @error('shipping_tracking_number')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Shipping Tracking Number  -->

                            <!-- Expected Delivery date  -->
                            <div class="form-group col-md-6">
                                <label for="expected_delivery_date" class="form-control-label"><b>Expected Delivery date : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="date" class="form-control" name="expected_delivery_date" id="expected_delivery_date" placeholder="Product Price">
                            
                            @error('expected_delivery_date')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Expected Delivery date  -->

                            <!-- order notes  -->
                            <div class="form-group col-md-6">
                                <label for="order_notes" class="form-control-label"><b>Order notes : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="order_notes" id="order_notes" placeholder="Any additional comments or instructions related to the order.">
                            
                            @error('currency')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End order notes  -->

                            <!-- Order Source  -->
                            <div class="form-group col-md-6">
                                <label for="order_source" class="form-control-label"><b>Order Source : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="order_source" id="order_source" placeholder="Indicates order originated from (e.g., online store, in-person sales, phone order).">
                            
                            @error('order_source')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Order Source  -->

                             <!-- Items Count  -->
                             <div class="form-group col-md-6">
                                <label for="item_count" class="form-control-label"><b>Item Count : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="item_count" id="item_count" placeholder="No of item ordered">
                            
                            @error('item_count')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Item Count  -->

                             <!-- Priority  -->
                            <div class="form-group col-md-6">
                                <label for="priority" class="form-control-label"><b>Priority : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="priority" id="priority">
                                    <option>--Select option--</option>
                                    <option value="1">High</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Low</option>
                                </select>                            
                            @error('priority')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Priority  -->

                            <!-- Discount/Promotions  -->
                            <div class="form-group col-md-6">
                                <label for="discount" class="form-control-label"><b> Discount/Promotions : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="discount" id="discount" placeholder="Any discounts or promotions applied to the order.">
                            
                            @error('discount')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Discount/Promotions  -->

                            <!-- Order Total  -->
                            <div class="form-group col-md-6">
                                <label for="order_total" class="form-control-label"><b> Order Total : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="order_total" id="order_total" placeholder="The total amount for the order including taxes and discounts.">
                            
                            @error('order_total')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Order Total  -->

                            <!-- return/RMA  -->
                            <div class="form-group col-md-6">
                                <label for="return_rma" class="form-control-label"><b> Return/RMA (Return Merchandise Authorization)</b> : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="return_rma" id="return_rma" placeholder="If applicable, tracking returns or RMAs associated with the order.">
                            
                            @error('return_rma')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Order Total  -->

                            <!-- Notes/Comments  -->
                            <div class="form-group col-md-6">
                                <label for="comments" class="form-control-label"><b> Notes/Comments : </b><sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="comments" id="comments" placeholder="Any additional comments or notes related to the order.">
                            @error('comments')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Notes/Comments  -->


                             <!-- attachments  -->
                             <div class="form-group col-md-6">
                                <label for="attachments" class="form-control-label"><b>Attachments : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="file" class="form-control" name="attachments" id="attachments" placeholder="Ability to attach relevant documents such as invoices, purchase orders, contracts.">
                                @error('attachments')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            <!--End product image  -->

                            
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-md" value="Add Order Header">
                            </div>
                        </form>
                    </div>
                    <div id="bulk" class="tabcontent">
                    <h3>Bulk Upload</h3>
                      <form action="{{ route('order-header/upload') }}" method="post" enctype="multipart/form-data" class="row">
                          @csrf
                          <div class="form-group col-md-6">
                            <label for="file">Upload File <span style="color:red;">( .csv & .txt and .xlsx files only)<sup style="color:red;font-size:15px;">*</sup></span></label>
                            <input type="dropbox" name="file" id="file" class="form-control">
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
</div>
</div>
</div>
          <!-- content-wrapper ends -->
@include('admin.layout.footer')