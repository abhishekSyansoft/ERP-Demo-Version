
<div class="accordion" id="add_orders">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Create Order
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                    <form id="headerOrderForm" action="{{route('store.order-header')}}" method="POST" class="row">
                    @csrf

                    <input type="hidden" name="order_id_header" id="order_id_header" value="{{$order_id}}">

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
                        <!-- <div class="form-group col-md-6">
                            <label for="total_amount" class="form-control-label"><b>Total Amount : <sup style="color:red;font-size:15px;">*</sup></b></label>
                            <input type="text" class="form-control" name="total_amount" id="total_amount" placeholder="The total cost of the entire order">

                        @error('total_amount')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div> -->
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
                        <!-- <div class="form-group col-md-6">
                            <label for="item_count" class="form-control-label"><b>Item Count : <sup style="color:red;font-size:15px;">*</sup></b></label>
                            <input type="text" class="form-control" name="item_count" id="item_count" placeholder="No of item ordered">

                        @error('item_count')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div> -->
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
                        <!-- <div class="form-group col-md-6">
                            <label for="total_discount" class="form-control-label"><b> Discount/Promotions : <sup style="color:red;font-size:15px;">*</sup></b></label>
                            <input type="text" class="form-control" name="total_discount" id="total_discount" placeholder="Any discounts or promotions applied to the order.">

                        @error('discount')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div> -->
                        <!--End Discount/Promotions  -->

                        <!-- Order Total  -->
                        <!-- <div class="form-group col-md-6">
                            <label for="order_total" class="form-control-label"><b> Order Total : <sup style="color:red;font-size:15px;">*</sup></b></label>
                            <input type="text" class="form-control" name="order_total" id="order_total" placeholder="The total amount for the order including taxes and discounts.">

                        @error('order_total')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div> -->
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
                            <label for="attachments" class="form-control-label"><b>Attachments :</b></label>
                            <input type="file" class="form-control" name="attachments" id="attachments" placeholder="Ability to attach relevant documents such as invoices, purchase orders, contracts.">
                            @error('attachments')
                            <div class="alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--End product image  -->
                    </form>

                </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        Add Items
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card" style="height:400px;background-color:lightgray;">
                            <table class="table table-hovered table-bordered" id="dataTableTestTable">
                                <thead>
                                    <!-- <th>S no.</th> -->
                                    <th>product_name</th>
                                    <th hidden>order_id</th>
                                    <th hidden>product_id</th>
                                    <th hidden>sku</th>
                                    <th>unit_price</th>
                                    <th>quantity</th>
                                    <th>total_price</th>
                                    <th>tax_rate</th>
                                    <th>tax_amount</th>
                                    <th>discount</th>
                                    <th>sub_total</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="orderItemTest" class="p-2">

                                </tbody>
                            </table>
                        </div>
                        <a class="btn btn-primary mt-2" id="open_modal_test" data-bs-toggle="modal" data-bs-target="#addItemModalTest">Add Item</a>
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        Submit Form
                    </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <a class="btn btn-primary mt-2" id="send_modal_data">Complete Your Order</a>
                    </div>
                    </div>
                </div>
                </div>



        <!-- Modal -->
        <div class="modal fade" id="addItemModalTest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addItemModalTestLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:white;">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalTestLabel">Add Item Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form method="POST" class="row" id="addItemModalTestForm">
            @csrf

                <!-- dealer_name  -->
                <div class="form-group col-md-12" hidden>
                    <input type="text"  class="form-control" name="product_name" id="product_name" placeholder="The quantity of the product or service being ordered.">
                    <input type="text"  class="form-control" name="order_id"  id="order_id" value="{{$order_id}}" placeholder="Order Id">
                    @error('dealer_name')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--End dealer_name  -->

                <!-- dealer_id -->
                <!-- <div class="form-group col-md-6">
                    <label for="dealer_id" class="form-control-label"><b>Select Dealer : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <select name="dealer_id" id="dealer_id" class="form-control p-3" style="color:black;">
                        <option>Select Dealer</option>
                      
                    </select> -->
                    <!-- <span id="tick_check" style="color: green;"><i class="mdi mdi-check-circle"></i></span> -->
                    <!-- @error('dealer_id')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div> -->
                <!--End product_id  -->

                <!-- product_id -->
                <div class="form-group col-md-6">
                    <label for="product_id" class="form-control-label"><b>Select Product : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <select name="product_id" id="product_id" class="form-control p-3" style="color:black;">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                        @endforeach
                    </select>
                    <span id="tick_check" style="color: green;"><i class="mdi mdi-check-circle"></i></span>
                    @error('product_id')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--End product_id  -->

                <!-- Quantity  -->
                <div class="form-group col-md-6">
                    <label for="quantity" class="form-control-label"><b>Quantity : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <input type="text" class="form-control" name="quantity" id="quantity" value="1" placeholder="The quantity of the product or service being ordered.">
                    @error('quantity')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--End Quantity  -->

                <!-- Unit Price  -->
                <div class="form-group col-md-6">
                    <label for="unitprice" class="form-control-label"><b>Unit Price : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <input type="text" class="form-control" name="unitprice" id="unitprice" placeholder="The price per unit of the product or service.">
                    @error('unitprice')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--End Unit Price  -->

                <!-- Total Price  -->
                <div class="form-group col-md-6">
                    <label for="total_price" class="form-control-label"><b>Total Price : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <input type="text" class="form-control" name="total_price" id="total_price" placeholder="The total price for the quantity of the product or service.">
                    @error('total_price')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--End Total Price  -->

                <!-- SKU -->
                <div class="form-group col-md-6">
                    <label for="sku" class="form-control-label"><b>SKU (Stock Keeping Unit) : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <input type="text" class="form-control" name="sku" id="sku" placeholder="Unique identifier for the product to manage inventory.">
                    @error('sku')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--End SKU  -->

                <!-- Tax Rate  -->
                <div class="form-group col-md-6">
                    <label for="tax_rate" class="form-control-label"><b>Tax Rate(%) : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <input type="text" class="form-control" name="tax_rate" id="tax_rate" placeholder="Applicable tax rate for the product or service.">
                    @error('tax_rate')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--End Tax Rate  -->

                <!-- Tax Amount  -->
                <div class="form-group col-md-6">
                    <label for="tax_amount" class="form-control-label"><b>Tax Amount : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <input type="text" class="form-control" name="tax_amount" id="tax_amount" placeholder="The amount of tax applied to the item.">
                    @error('tax_amount')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--End Tax Amount  -->

                <!-- discount  -->
                <div class="form-group col-md-6">
                    <label for="discount" class="form-control-label"><b>Discount : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <input type="text" class="form-control" name="discount" value="0" id="discount" placeholder="Any discount applied to the product or service.">
                    @error('discount')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--End discount  -->

                <!-- sub total  -->
                <div class="form-group col-md-6">
                    <label for="sub_total" class="form-control-label"><b>Sub Total : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <input type="text" class="form-control" name="sub_total" id="sub_total" placeholder="The subtotal for the line item (quantity * unit price).">
                    @error('sub_total')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--End sub total  -->


                <!-- Line Item total  -->
                <!-- <div class="form-group col-md-6">
                    <label for="line_item_total" class="form-control-label"><b>Line Item Total : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <input type="text" class="form-control" name="line_item_total" id="line_item_total" placeholder="The total cost for the line item including any discounts or taxes.">
                    @error('line_item_total')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div> -->
                <!--End Line Item total  -->

                <!-- order_status  -->
                <!-- <div class="form-group col-md-6">
                    <label for="image" class="form-control-label"><b>Order Status : <sup style="color:red;font-size:15px;">*</sup></b></label>
                    <input type="file" class="form-control" name="image" id="image" placeholder="Select image to upload">
                    @error('image')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div> -->
                <!--End product image  -->

                <div class="form-group">
                    <input id="add_order_items_btn"  data-bs-dismiss="modal" type="submit" class="btn btn-primary btn-md" value="Add Multiple Items">
                </div>
            </form>
               
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div> -->
            </div>
        </div>
        </div>