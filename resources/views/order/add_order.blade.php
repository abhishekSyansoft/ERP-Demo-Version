
              <div class="accordion mb-5" id="add_orders">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button p-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <h5>Create New Order</h5>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#add_orders">
                    <div class="accordion-body">


                    <!-- <h3>Add Order Header</h3> -->
                        <form id="order_header_form" action="{{route('store.order-header')}}" method="POST" class="row" enctype="multipart/form-data">
                            @csrf

                            <input type="text" hidden class="form-control" name="order_id" value="{{ $order_id }}" id="order_id" placeholder="Order Id">


                            <!-- dealer -->
                            <div class="form-group col-md-12">
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
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed p-5 mt-2 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                      <h5>Add Items in Order</h5>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#add_orders">
                    <div class="accordion-body">
                    <div style="border:1px solid black;height:400px;width:100%;background-color:#f2edf3;" class="mb-2 card">
                    <table id="orderedItems" class="table table-hover mb-2">
                              <tr>
                                  <th>S. No.</th>
                                  <th>Product Name</th>
                                  <!-- <th>Product Id</th> -->
                                  <th>Quantity</th>
                                  <th>Unit Price(Rs.)</th>
                                  <th>Total Price(Rs.)</th>
                                  <!-- <th>SKU(Stock Keeping Unit)</th> -->
                                  <th>Tax Amount(Rs.)</th>
                                  <th>Discount(Rs.)</th>
                                  <!-- <th>Payment Address</th> -->
                                  <th>Sub-Total(Rs.)</th>
                                  <!-- <th>Line Item Total</th> -->
                                  <th>Action</th>
                              </tr>
                              <tbody id="orderedItemsBody">
                              <!-- Table body will be populated by AJAX response -->
                                  @php($i=1)
                                  @foreach($order_items as $items)
                                  @if($items->order_id == 1)
                                    <tr>
                                      
                                      <!-- <td></td> -->
                                      
                                    </tr>
                                  @endif
                                  @endforeach
                              </tbody>
                          </table>
                        </div>
                        <div style="width:100%;" class="card">
                          <table class="table">
                              <tr>
                                <th>Total Items</th>
                                <!-- <th>Items(quantity)</th> -->
                                <!-- <th>Sub Total</th> -->
                                <!-- <th>Total Tax</th> -->
                                <th>Total Discount</th>
                                <th>Total Order Amount</th>
                              </tr>
                              <tr>
                                <td id="total_order_items"></td>
                                <!-- <td></td> -->
                                <!-- <td id="total_order_items_quantity"></td> -->
                                <!-- <td id="total_order_subtotal"></td> -->
                                <td id="total_order_discount"></td>
                                <td id="total_order_amount"></td>
                              </tr>
                          </table>
                        </div>
                          
                        </div>
                          <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info m-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Add Items
                            </button>

                            <!-- Modal -->
                            <div class="modal fade col-md-10" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog custom-modal-dialog">
                                <div class="modal-content" style="background-color:white;">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Item to Bag</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                  @php($totalDiscount=0)
                                  @php($totalTax=0)
                                  @php($sub_total=0)
                                  @php($total_amount=0)
                                  @php($total_quantity=0)
                                    @foreach ($order_items as $item)
                                        @if ($item->order_id == 1)
                                          @php($totalDiscount += $item->discount)
                                          @php($totalTax += $item->tax_amount)
                                          @php($sub_total += $item->total_price)
                                          @php($total_amount += $item->sub_total)
                                          @php($total_quantity += $item->quantity)
                                        @endif
                                    @endforeach
                                    

                                  <form id="order_items_form" action="{{route('store.order-items')}}" method="POST" class="row" enctype="multipart/form-data">
                                        @csrf

                                        <!-- dealer_name  -->
                                        <div class="form-group col-md-12" hidden>
                                            <input type="text"  class="form-control" name="product_name" id="product_name" placeholder="The quantity of the product or service being ordered.">
                                            <input type="text"  class="form-control" name="order_id" value="{{ $order_id }}" id="order_id" placeholder="Order Id">
                                            <input type="text"  class="form-control" name="total_header_discount" value="{{$totalDiscount}}" id="total_header_discount" placeholder="Total Discount">
                                            <input type="text"  class="form-control" name="total_header_amount" value="{{$total_amount}}" id="total_header_amount" placeholder="Total Amount to Order eader">
                                            <input type="text"  class="form-control" name="total_header_tax" value="{{$totalTax}}" id="total_header_tax" placeholder="Total tax Amount to Order eader">
                                            <input type="text"  class="form-control" name="total_item_count" value="{{$total_quantity}}" id="total_item_count" placeholder="Total quantity to Order eader">

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
                                                @foreach($dealers as $dealer)
                                                <option value="{{$dealer->id}}">{{$dealer->dealership_name}}</option>
                                                @endforeach
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
                                                <option>Select Product</option>
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
                                            <input id="add_order_items_btn"  data-bs-dismiss="modal" type="submit" class="btn btn-primary btn-md" value="Add Order Header">
                                        </div>
                                    </form>
                                  </div>
                                  <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div> -->
                                </div>
                              </div>
                            </div>

                        <!-- @php($totalDiscount=0)
                        @php($totalTax=0)
                        @php($sub_total=0)
                        @php($total_amount=0)
                        @php($total_quantity=0)
                          @foreach ($order_items as $item)
                              @if ($item->order_id == 1)
                                @php($totalDiscount += $item->discount)
                                @php($totalTax += $item->tax_amount)
                                @php($sub_total += $item->total_price)
                                @php($total_amount += $item->sub_total)
                                @php($total_quantity += $item->quantity)
                              @endif
                          @endforeach -->
                          <!-- <table class="table">
                            <tr>
                              <th>Total Items</th> -->
                              <!-- <th>Items(quantity)</th> -->
                              <!-- <th>Sub Total</th> -->
                              <!-- <th>Total Tax</th> -->
                              <!-- <th>Total Discount</th>
                              <th>Total Order Amount</th>
                            </tr>
                            <tr>
                              <td id="total_order_items"></td> -->
                              <!-- <td></td> -->
                              <!-- <td id="total_order_items_quantity"></td> -->
                              <!-- <td id="total_order_subtotal"></td> -->
                              <!-- <td id="total_order_discount"></td>
                              <td id="total_order_amount"></td>
                            </tr>
                        </table>  -->

                    <!-- </div> -->
                  </div>
                </div>
                <div class="accordion-item mt-2">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed p-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      <h5>Accordion Item</h5>
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#add_orders">
                    <div class="accordion-body">
                      <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                  </div>
                </div>
             
            <!-- <div class="items mt-4 mb-4">
              <div class="card">
                <div class="card-header btn-success"><h5>Order Items:</h5></div>
                <div class="card-body">
                    -->
                <!-- </div> -->
              <!-- </div>
            </div> 
                  </div>
                </div>
              </div> -->
            <!-- </div> -->
          <!-- </div>
        </div> -->
      </div>