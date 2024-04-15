@include('admin.layout.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Update Order Header
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Update Order Header<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card" style="margin:auto;">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Order Header</h4>

                    <div class="tab">
                    <!-- <button class="tablinks btn btn-lg btn-success" onclick="openCity(event, 'order_header')">Order Header</button> -->
                    <!-- <button class="tablinks btn btn-lg btn-success" onclick="openCity(event, 'bulk')">Bulk Upload</button> -->
                    </div>
                    <hr>
                      <div>
                        <div>
                        <div>



                    <div id="order_header">
                        <!-- <h3>Update Order Header</h3> -->
                        <form action="{{url('order-header/update/'.$header->id)}}" method="POST" class="row" enctype="multipart/form-data">
                            @csrf

                            <!-- dealer -->
                            <div class="form-group col-md-6">
                                <label for="dealer" class="form-control-label"><b>Select Dealer : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select name="dealer" id="dealer" class="form-control p-3">
                                  @foreach($dealers as $dealer)
                                    <option value="{{$dealer->id}}" {{ $header->dealer_id == $dealer->id ? 'selected' : '' }}>{{$dealer->dealership_name}}</option>
                                  @endforeach
                                </select>
                                @error('dealer')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            <!--End dealer  -->

                            <!-- order_date  -->
                            <div class="form-group col-md-6">
                                <label for="order_date" class="form-control-label"><b>Order Date : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="date" class="form-control" name="order_date" id="order_date" value="{{$header->order_date}}">
                                @error('order_date')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            <!--End order_date  -->

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
                                    <option value="0" {{ $header->order_status == '0' ? 'selected' : '' }}>--Select option--</option>
                                    <option value="1" {{ $header->order_status == '1' ? 'selected' : '' }}>Pending</option>
                                    <option value="2" {{ $header->order_status == '2' ? 'selected' : '' }}>Processing</option>
                                    <option value="3" {{ $header->order_status == '3' ? 'selected' : '' }}>Shipped</option>
                                    <option value="4" {{ $header->order_status == '4' ? 'selected' : '' }}>Completed</option>
                                    <option value="5" {{ $header->order_status == '5' ? 'selected' : '' }}>Cancelled</option>
                                </select>                            
                            @error('order_status')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End order_status  -->

                            <!-- total_amount -->
                            <div class="form-group col-md-6">
                                <label for="total_amount" class="form-control-label"><b>Total Amount : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="total_amount" id="total_amount" placeholder="The total cost of the entire order" value="{{$header->total_amount}}">
                            
                            @error('total_amount')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End total_amount  -->

                            <!-- sales representative  -->
                            <div class="form-group col-md-6">
                                <label for="representative" class="form-control-label"><b>Sales Representative : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="representative" id="representative" placeholder="Name or ID of the sales representative handling the order." value="{{$header->sales_representative}}">
                            
                            @error('hsn')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End sales representative  -->

                            <!-- Shipping_address  -->
                            <div class="form-group col-md-6">
                                <label for="shipping_address" class="form-control-label"><b>Shipping Address : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="shipping_address" id="shipping_address" placeholder="Address where the order will be shipped." value="{{$header->shipping_address}}">
                            
                            @error('shipping_address')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product uom  -->

                            <!-- billing_address  -->
                            <div class="form-group col-md-6">
                                <label for="billing_address" class="form-control-label"><b>Billing Address : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="billing_address" id="billing_address" placeholder="Address for billing purposes" value="{{$header->billing_address}}">
                            
                            @error('billing_address')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End billing_address  -->

                            <!-- Payment Method -->
                            <div class="form-group col-md-6">
                                <label for="payment_method" class="form-control-label"><b>Payment Method : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="payment_method" id="payment_method">
                                    <option value="0" {{ $header->payment_method == '0' ? 'selected' : '' }}>--Select option--</option>
                                    <option value="1" {{ $header->payment_method == '1' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="2" {{ $header->payment_method == '2' ? 'selected' : '' }}>Debit Card</option>
                                    <option value="3" {{ $header->payment_method == '3' ? 'selected' : '' }}>Bank Transfer</option>
                                    <option value="4" {{ $header->payment_method == '4' ? 'selected' : '' }}>Cash</option>
                                    <option value="5" {{ $header->payment_method == '5' ? 'selected' : '' }}>Cash On Delivery</option>
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
                                    <option value="0"  {{ $header->payment_status == '0' ? 'selected' : '' }}>--Select option--</option>
                                    <option value="1"  {{ $header->payment_status == '1' ? 'selected' : '' }}>Paid</option>
                                    <option value="2"  {{ $header->payment_status == '2' ? 'selected' : '' }}>Pending</option>
                                    <option value="3"  {{ $header->payment_status == '3' ? 'selected' : '' }}>Overdue</option>
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
                                    <option  value="0" {{ $header->sipping_method == '0' ? 'selected' : '' }}>--Select option--</option>
                                    <option value="1" {{ $header->sipping_method == '1' ? 'selected' : '' }}>Standard</option>
                                    <option value="2" {{ $header->sipping_method == '2' ? 'selected' : '' }}>Expected</option>
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
                                    <option value="0" {{ $header->shipping_carrier == '0' ? 'selected' : '' }}>--Select option--</option>
                                    <option value="1" {{ $header->shipping_carrier == '1' ? 'selected' : '' }}>Blue Dart</option>
                                    <option value="2" {{ $header->shipping_carrier == '2' ? 'selected' : '' }}>E-kart</option>
                                    <option value="3" {{ $header->shipping_carrier == '3' ? 'selected' : '' }}>Others</option>
                                </select>                            
                            @error('shipping_carrier')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Shipping carrier  -->

                            <!-- Shipping Tracking Number  -->
                            <div class="form-group col-md-6">
                                <label for="shipping_tracking_number" class="form-control-label"><b>Shipping Tracking Number :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="shipping_tracking_number" id="shipping_tracking_number" placeholder="Tracking number provided by the shipping carrier." value="{{$header->shipping_tracking_number}}">
                            
                            @error('shipping_tracking_number')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Shipping Tracking Number  -->

                            <!-- Expected Delivery date  -->
                            <div class="form-group col-md-6">
                                <label for="expected_delivery_date" class="form-control-label"><b>Expected Delivery date : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="date" class="form-control" name="expected_delivery_date" id="expected_delivery_date" value="{{$header->expected_delivery_date}}">
                            
                            @error('expected_delivery_date')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Expected Delivery date  -->

                            <!-- order notes  -->
                            <div class="form-group col-md-6">
                                <label for="order_notes" class="form-control-label"><b>Order notes : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="order_notes" id="order_notes" placeholder="Any additional comments or instructions related to the order." value="{{$header->order_notes}}">
                            
                            @error('currency')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End order notes  -->

                            <!-- Order Source  -->
                            <div class="form-group col-md-6">
                                <label for="order_source" class="form-control-label"><b>Order Source : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="order_source" id="order_source" placeholder="Indicates order originated from (e.g., online store, in-person sales, phone order)." value="{{$header->order_source}}">
                            
                            @error('order_source')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Order Source  -->

                             <!-- Items Count  -->
                             <div class="form-group col-md-6">
                                <label for="item_count" class="form-control-label"><b>Item Count : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="item_count" id="item_count" placeholder="No of item ordered" value="{{$header->item_count}}">
                            
                            @error('item_count')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Item Count  -->

                             <!-- Priority  -->
                            <div class="form-group col-md-6">
                                <label for="priority" class="form-control-label"><b>Priority : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="priority" id="priority">
                                    <option vlaue="0"  {{ $header->priority == '0' ? 'selected' : '' }}>--Select option--</option>
                                    <option value="1" {{ $header->priority == '1' ? 'selected' : '' }}>High</option>
                                    <option value="2" {{ $header->priority == '2' ? 'selected' : '' }}>Medium</option>
                                    <option value="3" {{ $header->priority == '3' ? 'selected' : '' }}>Low</option>
                                </select>                            
                            @error('priority')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Priority  -->

                            <!-- Discount/Promotions  -->
                            <div class="form-group col-md-6">
                                <label for="discount" class="form-control-label"><b> Discount/Promotions : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="discount" id="discount" placeholder="Any discounts or promotions applied to the order." value="{{ $header->discount}}">
                            
                            @error('discount')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Discount/Promotions  -->

                            <!-- Order Total  -->
                            <div class="form-group col-md-6">
                                <label for="order_total" class="form-control-label"><b> Order Total : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="order_total" id="order_total" placeholder="The total amount for the order including taxes and discounts." value="{{ $header->order_totoal}}">
                            
                            @error('order_total')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Order Total  -->

                            <!-- return/RMA  -->
                            <div class="form-group col-md-6">
                                <label for="return_rma" class="form-control-label"><b> Return/RMA (Return Merchandise Authorization)</b> : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="return_rma" id="return_rma" placeholder="If applicable, tracking returns or RMAs associated with the order." value="{{ $header->return_rma}}">
                            
                            @error('return_rma')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Order Total  -->

                            <!-- Notes/Comments  -->
                            <div class="form-group col-md-6">
                                <label for="comments" class="form-control-label"><b> Notes/Comments : </b><sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="comments" id="comments" placeholder="Any additional comments or notes related to the order." value="{{ $header->comments}}">
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
                                <input type="submit" class="btn btn-primary btn-md" value="Update Order Header">
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