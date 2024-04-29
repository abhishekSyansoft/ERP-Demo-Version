
<div class="accordion mb-5" id="edit_orders">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button p35" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <h5>Edit Order</h5>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#add_orders">
                    <div class="accordion-body">


                    <!-- <h3>Update Order Header</h3> -->
                    <form class="row" enctype="multipart/form-data">
                            @csrf

                            <!-- dealer -->
                            <div class="form-group col-md-6">
                                <label for="edit_dealer" class="form-control-label"><b>Select Dealer : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select name="edit_dealer" id="edit_dealer" class="form-control p-3">
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
                            <div class="form-group col-md-6">
                                <label for="edit_order_status" class="form-control-label"><b>Order Status : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select name="edit_order_status" id="edit_order_status" class="form-control p-3">
                                    <option value="0" >--Select option--</option>
                                    <option value="1">Pending</option>
                                    <option value="2" >Processing</option>
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
                                <label for="edit_representative" class="form-control-label"><b>Sales Representative : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="edit_representative" id="edit_representative" placeholder="Name or ID of the sales representative handling the order." value="{{$header->sales_representative}}">
                            
                            @error('hsn')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End sales representative  -->

                            <!-- Shipping_address  -->
                            <div class="form-group col-md-6">
                                <label for="edit_shipping_address" class="form-control-label"><b>Shipping Address : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="edit_shipping_address" id="edit_shipping_address" placeholder="Address where the order will be shipped." value="{{$header->shipping_address}}">
                            
                            @error('shipping_address')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End product uom  -->

                            <!-- billing_address  -->
                            <div class="form-group col-md-6">
                                <label for="preview_billing_address" class="form-control-label"><b>Billing Address : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="preview_billing_address" id="preview_billing_address" placeholder="Address for billing purposes" value="{{$header->billing_address}}">
                            
                            @error('billing_address')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End billing_address  -->

                            <!-- Payment Method -->
                            <div class="form-group col-md-6">
                                <label for="edit_payment_method" class="form-control-label"><b>Payment Method : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="edit_payment_method" id="edit_payment_method">
                                    <option value="0">--Select option--</option>
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
                                <label for="edit_payment_status" class="form-control-label"><b>Payment Status : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="edit_payment_status" id="edit_payment_status">
                                    <option value="0">--Select option--</option>
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
                                <label for="edit_shipping_method" class="form-control-label"><b>Shipping Method : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="edit_shipping_method" id="edit_shipping_method">
                                    <option  value="0">--Select option--</option>
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
                                <label for="edit_shipping_carrier" class="form-control-label"><b>Shipping Carrier : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="edit_shipping_carrier" id="edit_shipping_carrier">
                                    <option value="0">--Select option--</option>
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
                                <label for="edit_shipping_tracking_number" class="form-control-label"><b>Shipping Tracking Number :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="edit_shipping_tracking_number" id="edit_shipping_tracking_number" placeholder="Tracking number provided by the shipping carrier." value="{{$header->shipping_tracking_number}}">
                            
                            @error('shipping_tracking_number')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Shipping Tracking Number  -->

                            <!-- Expected Delivery date  -->
                            <div class="form-group col-md-6">
                                <label for="edit_expected_delivery_date" class="form-control-label"><b>Expected Delivery date : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="date" class="form-control" name="edit_expected_delivery_date" id="edit_expected_delivery_date" value="{{$header->expected_delivery_date}}">
                            
                            @error('expected_delivery_date')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Expected Delivery date  -->

                            <!-- order notes  -->
                            <div class="form-group col-md-6">
                                <label for="edit_order_notes" class="form-control-label"><b>Order notes : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="edit_order_notes" id="edit_order_notes" placeholder="Any additional comments or instructions related to the order." value="{{$header->order_notes}}">
                            
                            @error('currency')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End order notes  -->

                            <!-- Order Source  -->
                            <div class="form-group col-md-6">
                                <label for="edit_order_source" class="form-control-label"><b>Order Source : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="edit_order_source" id="edit_order_source" placeholder="Indicates order originated from (e.g., online store, in-person sales, phone order)." value="{{$header->order_source}}">
                            
                            @error('order_source')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Order Source  -->


                             <!-- Priority  -->
                            <div class="form-group col-md-6">
                                <label for="edit_priority" class="form-control-label"><b>Priority : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="edit_priority" id="edit_priority">
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


                            <!-- return/RMA  -->
                            <div class="form-group col-md-6">
                                <label for="edit_return_rma" class="form-control-label"><b> Return/RMA (Return Merchandise Authorization)</b> : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="edit_return_rma" id="edit_return_rma" placeholder="If applicable, tracking returns or RMAs associated with the order." value="{{ $header->return_rma}}">
                            
                            @error('return_rma')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Order Total  -->

                            <!-- Notes/Comments  -->
                            <div class="form-group col-md-6">
                                <label for="edit_comments" class="form-control-label"><b> Notes/Comments : </b><sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="edit_comments" id="edit_comments" placeholder="Any additional comments or notes related to the order." value="{{ $header->comments}}">
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
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed p-3 mt-2 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                      <h5>Items in Order</h5>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#add_orders">
                    <div class="accordion-body">
                    <div  class="card" style="height:400px;background-color:lightgray;">
                    <!-- <div class="table-wrapper mx-auto"> -->
                    <table id="previewOrderedItems" class="table table-hover mb-2">
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
                              <tbody id="EditorderedItemsBody">
                              <!-- Table body will be populated by AJAX response -->
                                 
                              </tbody>
                          </table>
                        <!-- </div> -->
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
                                 <!-- <td></td> -->
                                <!-- <td id="total_order_items_quantity"></td> -->
                                <!-- <td id="total_order_subtotal"></td> -->
                                <td id="update_edit_items"></td>
                                <td id="update_edit_discount"></td>
                                <td id="update_edit_total_amount"></td>
                              </tr>
                          </table>
                        </div>


                         <!-- Button trigger modal -->
                         <button type="button" class="btn btn-info m-4" data-bs-toggle="modal" data-bs-target="#addMoreItems">
                              Add More Items
                            </button>

                            <!-- Modal -->
                            <div class="modal fade col-md-10" id="addMoreItems" tabindex="-1" aria-labelledby="addMoreItemsLabel" aria-hidden="true">
                              <div class="modal-dialog custom-modal-dialog">
                                <div class="modal-content" style="background-color:white;">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="addMoreItemsLabel">Add Item to Bag</h5>
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
                                    

                                  <form id="update_order_items_form" action="{{route('update.order-items')}}" method="POST" class="row" enctype="multipart/form-data">
                                        @csrf

                                        <!-- dealer_name  -->
                                        <div class="form-group col-md-12" hidden>
                                            <input type="text"  class="form-control" name="update_product_name" id="update_product_name" placeholder="The quantity of the product or service being ordered.">
                                            <input type="text"  class="form-control" name="update_order_id" id="update_order_id" placeholder="Order Id">
                                            <input type="text"  class="form-control" name="update_total_header_discount" value="{{$totalDiscount}}" id="update_total_header_discount" placeholder="Total Discount">
                                            <input type="text"  class="form-control" name="update_total_header_amount" value="{{$total_amount}}" id="update_total_header_amount" placeholder="Total Amount to Order eader">
                                            <input type="text"  class="form-control" name="update_total_header_tax" value="{{$totalTax}}" id="update_total_header_tax" placeholder="Total tax Amount to Order eader">
                                            <input type="text"  class="form-control" name="update_total_item_count" value="{{$total_quantity}}" id="update_total_item_count" placeholder="Total quantity to Order eader">

                                            @error('dealer_name')
                                              <div class="alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>



                                        <!-- <a class="delete-link" data-order-id="123" style="color:red;"><i class="mdi mdi-delete"></i> Delete</a> -->

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
                                            <label for="update_product_id" class="form-control-label"><b>Select Product : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                            <select name="update_product_id" id="update_product_id" class="form-control p-3" style="color:black;">
                                                <option>Select Product</option>
                                                @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                @endforeach
                                            </select>
                                            <span id="update_tick_check" style="color: green;"><i class="mdi mdi-check-circle"></i></span>
                                            @error('product_id')
                                              <div class="alert-danger">{{ $message }}</div>
                                            @enderror
                                          </div>
                                        <!--End product_id  -->

                                        <!-- Quantity  -->
                                        <div class="form-group col-md-6">
                                            <label for="update_quantity" class="form-control-label"><b>Quantity : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                            <input type="text" class="form-control" name="update_quantity" id="update_quantity" value="1" placeholder="The quantity of the product or service being ordered.">
                                            @error('quantity')
                                              <div class="alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--End Quantity  -->

                                        <!-- Unit Price  -->
                                        <div class="form-group col-md-6">
                                            <label for="update_unitprice" class="form-control-label"><b>Unit Price : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                            <input type="text" class="form-control" name="update_unitprice" id="update_unitprice" placeholder="The price per unit of the product or service.">
                                            @error('unitprice')
                                              <div class="alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--End Unit Price  -->

                                        <!-- Total Price  -->
                                        <div class="form-group col-md-6">
                                            <label for="update_total_price" class="form-control-label"><b>Total Price : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                            <input type="text" class="form-control" name="update_total_price" id="update_total_price" placeholder="The total price for the quantity of the product or service.">
                                            @error('total_price')
                                              <div class="alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--End Total Price  -->

                                        <!-- SKU -->
                                        <div class="form-group col-md-6">
                                            <label for="update_sku" class="form-control-label"><b>SKU (Stock Keeping Unit) : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                            <input type="text" class="form-control" name="update_sku" id="update_sku" placeholder="Unique identifier for the product to manage inventory.">
                                            @error('sku')
                                              <div class="alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--End SKU  -->

                                        <!-- Tax Rate  -->
                                        <div class="form-group col-md-6">
                                            <label for="update_tax_rate" class="form-control-label"><b>Tax Rate(%) : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                            <input type="text" class="form-control" name="update_tax_rate" id="update_tax_rate" placeholder="Applicable tax rate for the product or service.">
                                            @error('tax_rate')
                                              <div class="alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--End Tax Rate  -->

                                        <!-- Tax Amount  -->
                                        <div class="form-group col-md-6">
                                            <label for="update_tax_amount" class="form-control-label"><b>Tax Amount : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                            <input type="text" class="form-control" name="update_tax_amount" id="update_tax_amount" placeholder="The amount of tax applied to the item.">
                                            @error('update_tax_amount')
                                              <div class="alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--End Tax Amount  -->

                                        <!-- discount  -->
                                        <div class="form-group col-md-6">
                                            <label for="update_discount" class="form-control-label"><b>Discount : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                            <input type="text" class="form-control" name="update_discount" value="0" id="update_discount" placeholder="Any discount applied to the product or service.">
                                            @error('discount')
                                              <div class="alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--End discount  -->

                                        <!-- sub total  -->
                                        <div class="form-group col-md-6">
                                            <label for="update_sub_total" class="form-control-label"><b>Sub Total : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                            <input type="text" class="form-control" name="update_sub_total" id="update_sub_total" placeholder="The subtotal for the line item (quantity * unit price).">
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
                                            <input id="add_order_items_btn"  data-bs-dismiss="modal" type="submit" class="btn btn-primary btn-md" value="Add More Items">
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
                         
                        <div class="modal fade" id="updateEditItemsModal" tabindex="-1" role="dialog" aria-labelledby="updateEditItemsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content mx-auto p-2" style="background-color:white;">
            <div class="modal-header mb-3">
                <h5 class="modal-title" id="updateItemsModalLabel">Update Items</h5>
                <a data-bs-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                </a>
            </div>
            <form id="update_edit_items_form" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                <!-- Product Name -->
                <div class="form-group col-md-6" hidden>
                    <label for="update_edit_product_name" class="form-control-label"><b>Product Name:</b></label>
                    <input type="text" class="form-control" name="update_edit_product_name" id="update_edit_product_name" placeholder="Product Name">
                </div>
                <!-- End Product Name -->

                <!-- Order ID -->
                <input type="hidden" name="update_edit_order_id" id="update_edit_order_id" value="{{ $order_id }}">

                <!-- Total Header Discount -->
                <input type="hidden" name="update_edit_order_item_id" id="update_edit_order_item_id">

                <!-- Total Header Amount -->
                <input type="hidden" name="update_edit_total_header_amount" id="update_total_header_amount" value="{{ $total_amount }}">

                <!-- Total Header Tax -->
                <input type="hidden" name="update_edit_total_header_tax" id="update_total_header_tax" value="{{ $totalTax }}">

                <!-- Total Item Count -->
                <input type="hidden" name="update_edit_total_item_count" id="update_total_item_count" value="{{ $total_quantity }}">
                
                <!-- Product ID -->
                <div class="form-group col-md-6">
                    <label for="update_edit_product_id" class="form-control-label"><b>Select Product:</b></label>
                    <select name="update_edit_product_id" id="update_edit_product_id" class="form-control p-3">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- End Product ID -->

                <!-- Quantity -->
                <div class="form-group col-md-6">
                    <label for="update_edit_quantity" class="form-control-label"><b>Quantity:</b></label>
                    <input type="text" class="form-control" name="update_edit_quantity" id="update_edit_quantity" value="0" placeholder="Quantity">
                </div>
                <!-- End Quantity -->

                <!-- Unit Price -->
                <div class="form-group col-md-6">
                    <label for="update_edit_unitprice" class="form-control-label"><b>Unit Price:</b></label>
                    <input type="text" class="form-control" name="update_edit_unitprice" id="update_edit_unitprice" placeholder="Unit Price">
                </div>
                <!-- End Unit Price -->

                <!-- Total Price -->
                <div class="form-group col-md-6">
                    <label for="update_edit_total_price" class="form-control-label"><b>Total Price:</b></label>
                    <input type="text" class="form-control" name="update_edit_total_price" id="update_edit_total_price" placeholder="Total Price">
                </div>
                <!-- End Total Price -->

                <!-- SKU -->
                <div class="form-group col-md-6">
                    <label for="update_edit_sku" class="form-control-label"><b>SKU:</b></label>
                    <input type="text" class="form-control" name="update_edit_sku" id="update_edit_sku" placeholder="SKU">
                </div>
                <!-- End SKU -->

                <!-- Tax Rate -->
                <div class="form-group col-md-6">
                    <label for="update_edit_tax_rate" class="form-control-label"><b>Tax Rate(%):</b></label>
                    <input type="text" class="form-control" name="update_edit_tax_rate" id="update_edit_tax_rate" placeholder="Tax Rate">
                </div>
                <!-- End Tax Rate -->

                <!-- Tax Amount -->
                <div class="form-group col-md-6">
                    <label for="update_edit_tax_amount" class="form-control-label"><b>Tax Amount:</b></label>
                    <input type="text" class="form-control" name="update_edit_tax_amount" id="update_edit_tax_amount" placeholder="Tax Amount">
                </div>
                <!-- End Tax Amount -->

                <!-- Discount -->
                <div class="form-group col-md-6">
                    <label for="update_edit_hit_discount" class="form-control-label"><b>Discount:</b></label>
                    <input type="text" class="form-control" name="update_edit_hit_discount" value="0" id="update_edit_hit_discount" placeholder="Discount">
                </div>
                <!-- End Discount -->

                <!-- Sub Total -->
                <div class="form-group col-md-6">
                    <label for="update_edit_sub_total" class="form-control-label"><b>Sub Total:</b></label>
                    <input type="text" class="form-control" name="update_edit_sub_total" id="update_edit_sub_total" placeholder="Sub Total">
                </div>
                <!-- End Sub Total -->

                <div class="form-group">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
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



      <!-- Update Items Modal -->
