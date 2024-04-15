
            <div class="accordion mb-5" id="preview_orders">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button p-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <h5>preview Order</h5>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#add_orders">
                    <div class="accordion-body">


                    <!-- <h3>Update Order Header</h3> -->
                    <form class="row" enctype="multipart/form-data">
                            @csrf

                            <!-- dealer -->
                            <div class="form-group col-md-6">
                                <label for="preview_dealer" class="form-control-label"><b>Select Dealer : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select name="preview_dealer" id="preview_dealer" class="form-control p-3">
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
                                <label for="preview_order_status" class="form-control-label"><b>Order Status : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select name="preview_order_status" id="preview_order_status" class="form-control p-3">
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
                                <label for="preview_representative" class="form-control-label"><b>Sales Representative : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="preview_representative" id="preview_representative" placeholder="Name or ID of the sales representative handling the order." value="{{$header->sales_representative}}">
                            
                            @error('hsn')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End sales representative  -->

                            <!-- Shipping_address  -->
                            <div class="form-group col-md-6">
                                <label for="preview_shipping_address" class="form-control-label"><b>Shipping Address : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="shipping_address" id="shipping_address" placeholder="Address where the order will be shipped." value="{{$header->shipping_address}}">
                            
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
                                <label for="preview_payment_method" class="form-control-label"><b>Payment Method : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="preview_payment_method" id="preview_payment_method">
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
                                <label for="preview_payment_status" class="form-control-label"><b>Payment Status : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="preview_payment_status" id="preview_payment_status">
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
                                <label for="preview_shipping_method" class="form-control-label"><b>Shipping Method : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="preview_shipping_method" id="preview_shipping_method">
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
                                <label for="preview_shipping_carrier" class="form-control-label"><b>Shipping Carrier : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="preview_shipping_carrier" id="preview_shipping_carrier">
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
                                <label for="preview_shipping_tracking_number" class="form-control-label"><b>Shipping Tracking Number :<sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="preview_shipping_tracking_number" id="preview_shipping_tracking_number" placeholder="Tracking number provided by the shipping carrier." value="{{$header->shipping_tracking_number}}">
                            
                            @error('shipping_tracking_number')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Shipping Tracking Number  -->

                            <!-- Expected Delivery date  -->
                            <div class="form-group col-md-6">
                                <label for="preview_expected_delivery_date" class="form-control-label"><b>Expected Delivery date : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="date" class="form-control" name="preview_expected_delivery_date" id="preview_expected_delivery_date" value="{{$header->expected_delivery_date}}">
                            
                            @error('expected_delivery_date')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Expected Delivery date  -->

                            <!-- order notes  -->
                            <div class="form-group col-md-6">
                                <label for="preview_order_notes" class="form-control-label"><b>Order notes : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="preview_order_notes" id="preview_order_notes" placeholder="Any additional comments or instructions related to the order." value="{{$header->order_notes}}">
                            
                            @error('currency')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End order notes  -->

                            <!-- Order Source  -->
                            <div class="form-group col-md-6">
                                <label for="preview_order_source" class="form-control-label"><b>Order Source : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="preview_order_source" id="preview_order_source" placeholder="Indicates order originated from (e.g., online store, in-person sales, phone order)." value="{{$header->order_source}}">
                            
                            @error('order_source')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Order Source  -->


                             <!-- Priority  -->
                            <div class="form-group col-md-6">
                                <label for="preview_priority" class="form-control-label"><b>Priority : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <select class="form-control p-3" name="preview_priority" id="preview_priority">
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
                                <label for="preview_return_rma" class="form-control-label"><b> Return/RMA (Return Merchandise Authorization)</b> : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="preview_return_rma" id="preview_return_rma" placeholder="If applicable, tracking returns or RMAs associated with the order." value="{{ $header->return_rma}}">
                            
                            @error('return_rma')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Order Total  -->

                            <!-- Notes/Comments  -->
                            <div class="form-group col-md-6">
                                <label for="preview_comments" class="form-control-label"><b> Notes/Comments : </b><sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="text" class="form-control" name="preview_comments" id="preview_comments" placeholder="Any additional comments or notes related to the order." value="{{ $header->comments}}">
                            @error('comments')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <!--End Notes/Comments  -->


                             <!-- attachments  -->
                             <!-- <div class="form-group col-md-6">
                                <label for="attachments" class="form-control-label"><b>Attachments : <sup style="color:red;font-size:15px;">*</sup></b></label>
                                <input type="file" class="form-control" name="attachments" id="attachments" placeholder="Ability to attach relevant documents such as invoices, purchase orders, contracts.">
                                @error('attachments')
                                  <div class="alert-danger">{{ $message }}</div>
                                @enderror
                              </div> -->
                            <!--End product image  -->

<!--                             
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-md" value="Update Order Header">
                            </div> -->
                        </form>

                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed p-5 mt-2 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                      <h5>Items in Order</h5>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#add_orders">
                    <div class="accordion-body">
                    <div style="border:1px solid black;height:400px;width:100%;background-color:#f2edf3;" class="mb-2 card">
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
                                  <!-- <th>Action</th> -->
                              </tr>
                              <tbody id="PrevieworderedItemsBody">
                              <!-- Table body will be populated by AJAX response -->
                                 
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
                                 <!-- <td></td> -->
                                <!-- <td id="total_order_items_quantity"></td> -->
                                <!-- <td id="total_order_subtotal"></td> -->
                                <td id="preview_items"></td>
                                <td id="preview_discount"></td>
                                <td id="preview_total_amount"></td>
                              </tr>
                          </table>
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