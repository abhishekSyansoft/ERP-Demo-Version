@include('admin.layout.header')
<div class="" style="border:1px solid black;padding:5px;">
                      <div class="content-wrapper p-2">
                            <div class="row">
                              <div class="col-6">
                                <h4 class="m-0">SyanSoft Pvt. Ltd.</h4>
                                <h6 class="m-0">Solution for innovators</h6>
                              </div>
                              <div class="col-6">
                                <h2 style="float:right;">Purchase Order</h2>
                                
                                <h5 style="float:right">
                                PO No. : <span id="order_id"></span><br>
                                Order Date. : <span id="order_date"></span>
                              </h5>
                               
                              </div>
                              </div>
                            <!-- </div> -->
                            <br>
                       
                            <div class="row">
                            <div class="col-6">
                                  <h4>Vendor Detail's :</h4>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Name :</b><span id="vendor_name"> Abhishek Kumar</span></p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Company Name :</b> SyanSoft Pvt. Ltd.</p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Address :</b><span id="vendor_street_address">Unit No. 306, Tower B4, Spaze ITech Park, Sohna Road, Sector 49, Gurugram, Haryana 122018</span></p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Phone :</b><span id="vendor_phone"> +91-6202074551</span> </p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Email :</b><span id="vendor_email"> abc@gmail.com</span></p></i>
                              </div>
                            </div>
                            <br>
                         

                            <!-- <div class="row">
                              <div class="col-6">
                                <p class="m-0" style="font-weight:200;">The folowing number must appear on all related <br> correspondence,shipping papers and invoices </p>
                                <br><h5>Order Number : <span id="order_id">PO_663b364a4778a</span></h5>
                              </div>
                            </div>
                            <br> -->


                            <div class="row">
                              <div class="col-6">
                               <h4>Bill TO : </h4>
                               <i><h5 class="m-0" id="billing_street_address"> Unit No. 306, Tower B4, Spaze ITech Park,<br> Sohna Road, Sector 49</h5>
                                <h6 class="m-0" id="billing_address"> Gurugram, Haryana 122018</h6></i><br>
                                <i class="mdi mdi-phone"></i> <b>Phone Number :</b><span id="bill_phone"> +91-6202074551 </span><br>
                                <i class="mdi mdi-email"></i> <b>Email :</b> <span id="bill_email"> +91-6202074551 </span>
                              </div>

                              <div class="col-6">
                                  <h4>SHIP TO :</h4> <span style="font-weight: 100 !important;"><i>Please Include as much information as possible. Maps are veryfull.</i></span><br><br>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Name :</b> Abhishek Kumar</p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Company Name :</b> SyanSoft Pvt. Ltd.</p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Address :</b>  <span id="shipping_street_address">Unit No. 306, Tower B4, Spaze ITech Park, Sohna Road, Sector 49, Gurugram, Haryana 122018</span></p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Phone :</b><span id="shipping_phone"> +91-6202074551</span> </p></i>
                                  <i class="m-0 p-0"><p class="m-0 p-0"><b>Email :</b><span id="shipping_email"> abc@gmail.com</span></p></i>
                              </div>
                            </div>
                            <br>

                            <div class="row">
                              <div class="col-12 table-wrapper" style="margin:0px !important;height:auto;">
                              <table class="table table-bordered border-primary">
                                  <!-- <thead> -->
                                    <tr>
                                      <!-- <th>P.O. DATE</th> -->
                                      <th>REQUISITIONER</th>
                                      <th>SHIPPED VIA</th>
                                      <th>SHIPPEMENT DATE</th>
                                      <th>TERMS</th>
                                    </tr>
                                  <!-- </thead>
                                  <tbody> -->
                                   <tr>
                                      <!-- <td id="order_date">2024-05-08</td> -->
                                      <td>SyanSoft Pvt. Ltd</td>
                                      <td id="delivery_method">Will Call</td>
                                      <td id="expected_delivery_date">2024-05-08</td>
                                      <td id="lead_time">Net 30days</td>
                                   </tr>
                                  <!-- </tbody> -->
                              </table>
                              </div>
                            </div>
                       


                            <div class="row mt-4">
                              <div class="col-12" style="margin:0px !important;height:auto;">
                              <table class="table table-bordered border-primary" id="table_items_po">
                                  <!-- <thead> -->
                                    <tr>
                                      <th>Item Code</th>
                                      <th>Item Name</th>
                                      <!-- <th>Category</th> -->
                                      <th>Vehicle</th>
                                      <th>Unitprice</th>
                                      <th>Quantity</th>
                                      <!-- <th>Total Price</th> -->
                                    </tr>
                                    <!-- <tbody id="table_items_po_tbl_bdy">

                                    </tbody> -->
                                    <tr>
                                      <td style="min-height:200px;" class="item_code"></td>
                                      <td style="min-height:200px;" class="item_name"></td>
                                      <!-- <td style="min-height:200px;" class="item_category"></td> -->
                                      <td style="min-height:200px;" class="item_vehicle"></td>
                                      <td style="min-height:200px;" class="item_unit_price"></td>
                                      <td style="min-height:200px;" class="item_quantity"></td>
                                      <!-- <td style="min-height:200px;" class="item_total"></td> -->
                                    </tr>
                                  <!-- </thead>
                                  <tbody> -->
                                   <tr>
                                      
                                   </tr>
                                  <!-- </tbody> -->
                              </table>
                              </div>
                            </div>

                            <div class="row mt-4">
                              <div class="col-6">
                                <h6><b>Terms And Conditions: </b></h6>
                                <ul>
                                  <li><b>Delivery Schedule:</b> Supplier must adhere to agreed delivery dates. Non-conforming items may be rejected.</li>
                                </ul>
                              </div>
                              <div class="col-6">
                                <table class="table table-bordered border-primary">
                                <tr>
                                  <th class="p-1">Total Price</th>
                                  <td id="line_item_total"></td>
                                </tr>
                                <tr>
                                  <th class="p-1">SGST</th>
                                  <td id="sgst"></td>
                                </tr>
                                <tr>
                                  <th class="p-1">CGST</th>
                                  <td id="cgst"></td>
                                </tr>
                                <tr>
                                  <th class="p-1">Shipping & Handling</th>
                                  <td id="handling"></td>
                                </tr>
                                <tr>
                                  <th class="p-1">Other</th>
                                  <td id="other"></td>
                                </tr>
                                <tr>
                                  <th class="p-1">Final Amount</th>
                                  <td id="final"></td>
                                </tr>
                                 
                                </table>
                              </div>
                            </div>


                            <div class="row">
                              <div class="col-6">
                                <img class="mb-1" src="{{asset('Storage/images/qrcodes/qrcode_1.svg')}}" alt="qrcode" style="max-height:100px;max-width:100px;">
                              </div>
                              <div class="col-6">
                                <h6 style="float:right;">Signature : <i class="bi bi-patch-check-fill" style="color:green;">Digitally Verefied</i></h6>
                              </div>
                            </div>
                       
                       


                      </div>
@include('admin.layout.footer')