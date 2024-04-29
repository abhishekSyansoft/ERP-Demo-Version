@include('admin.layout.header')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span>Order
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Order<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>

            <div class="col-md-12 mb-4">
              <button class="btn btn-primary" data-bs-toggle="dialog" id="order_accordian_toggle">Toggle Forms</button>
              <button class="btn btn-primary" id="add_order_page">Add Order &nbsp;&nbsp;&nbsp;<i class="mdi mdi-newspaper"></i></button>
              <button class="btn btn-primary m-1" id="past_generated_order" data-bs-toggle="modal" data-bs-target="#editBackdrop" style="float:right;">Edit Order &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button>
              <button class="btn btn-primary m-1" id="view_preview" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:right;">View Preview &nbsp;&nbsp;&nbsp;<i class="mdi mdi-eye"></i></button>
              <button class="btn btn-primary m-1" id="view_errors" style="float:right;" data-bs-toggle="modal" data-bs-target="#errorsModal" >View Errors &nbsp;&nbsp;&nbsp;<i class="mdi mdi-alert-circle"></i></button>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="errorsModal" tabindex="-1" aria-labelledby="errorsModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content" style="background-color:white;">
                  <div class="modal-header">
                    <h5 class="modal-title" id="errorsModalLabel">Messages</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <!-- Error messages will be displayed here -->
                    <ul id="errorList"></ul>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>





            <!-- Modal -->
                          <div class="modal fade" id="editBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-lg">
                              <div class="modal-content card">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="editBackdropLabel">Edit Order Details</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body mx-auto">
                                  <form method="GET" action="{{route('edit_order')}}" id="edit_order_form">
                                    @csrf
                                    <div class="table-wrapper" style="overflow:block;">
                                    <table class="table ">
                                      <!-- Table headers remain the same -->
                                      <tr>
                                                          <th></th>
                                                          <th>S. No.</th>
                                                          <th>Order Id</th>
                                                          <th>Dealer</th>
                                                          <th>Order Date</th>
                                                          <th>Order Status</th>
                                                          <th>Total Amount(Rs.)</th>
                                                          <th>Sales Representative</th>
                                                          <th>Shipping Address</th>
                                                          <th>Biling Address</th>
                                                          <th>Payment Method</th>
                                                          <!-- <th>Payment Address</th> -->
                                                          <th>Payment Status</th>
                                                          <th>Shipping Method</th>
                                                          <th>Shipping Carrier</th>
                                                          <th>Shipping Tracking Number</th>
                                                          <th>Expected Delivery Date</th>
                                                          <th>Order Notes</th>
                                                          <th>Order Source</th>
                                                          <th>Item Count</th>
                                                          <th>Priority</th>
                                                          <th>Discount/Promotions(Rs.)</th>
                                                          <th>Total Order</th>
                                                          <th>Return/RMA</th>
                                                          <th>Notes/Comments</th>
                                                          <th>Attachment's</th>
                                                          <!-- <th>Action</th> -->
                                                      </tr>
                                      <!-- Table rows and columns remain the same, except for the radio button column -->
                                      @php($i=1)
                                                      @foreach($orderheader as $header)
                                                      <tr>
                                                          <td><input type="radio" value="{{$header->order_id}}" name="edit_order_id"></td>
                                                          <td>{{$i++}}</td>
                                                          <td>{{$header->order_id}}</td>
                                                          <td>{{$header->dealername}}</td>
                                                          <td>{{$header->order_date}}</td>
                                                          <td>
                                                              {{ 
                                                                  $header->order_status == 1 ? 'Pending' :
                                                                  ($header->order_status == 2 ? 'Processing' :
                                                                  ($header->order_status == 3 ? 'Shipped' :
                                                                  ($header->order_status == 4 ? 'Completed' :
                                                                  ($header->order_status == 5 ? 'Cancelled' : '')
                                                                  )))
                                                              }}
                                                          </td>
                                                          <td>{{number_format($header->total_amount)}}</td>
                                                          <td>{{$header->sales_representative}}</td>
                                                          <td>{{$header->shipping_address}}</td>
                                                          <td>{{$header->billing_address}}</td>
                                                          <td>{{ 
                                                                  $header->payment_method == 1 ? 'Credit Card' :
                                                                  ($header->payment_method == 2 ? 'Debit Card' :
                                                                  ($header->payment_method == 3 ? 'Bank Transfer' :
                                                                  ($header->payment_method == 4 ? 'Cash' :
                                                                  ($header->payment_method == 5 ? 'Cash On Delivery' : '')
                                                                  )))
                                                              }}
                                                          </td>
                                                          <!-- <td>{{$header->payment_address}}</td> -->
                                                          <td>
                                                              {{ 
                                                                  $header->payment_status == 1 ? 'Paid' :
                                                                  ($header->payment_status == 2 ? 'Pending' :
                                                                  ($header->payment_status == 3 ? 'Overdue' : '')
                                                                  )
                                                              }}
                                                          </td>
                                                          <td>
                                                              {{ 
                                                                  $header->sipping_method == 1 ? 'Standard' :
                                                                  ($header->sipping_method == 2 ? 'Expected' :''
                                                                  )
                                                              }}
                                                          </td>
                                                          <td>
                                                              {{ 
                                                                  $header->shipping_carrier == 1 ? 'Blue Dart' :
                                                                  ($header->shipping_carrier == 2 ? 'E-Kart' :
                                                                  ($header->shipping_carrier == 5 ? 'Others' : '')
                                                                  )
                                                              }}
                                                          </td>
                                                          <td>{{$header->shipping_tracking_number}}</td>
                                                          <td>{{$header->expected_delivery_date}}</td>
                                                          <td>{{$header->order_notes}}</td>
                                                          <td>{{$header->order_source}}</td>
                                                          <td>{{number_format($header->item_count)}}</td>
                                                          <td>{{$header->priority}}</td>
                                                          <td>{{number_format($header->discount)}}</td>
                                                          <td>{{number_format($header->order_totoal)}}</td>
                                                          <td>{{$header->return_rma}}</td>
                                                          <td>{{$header->comments}}</td>
                                                          <td><a href="{{asset('Storage/'.$header->attachments)}}" style="font-size:20px;"><i class="mdi mdi-eye"></i></a></td>
                                                          
                                                      </tr>
                                                      @endforeach
                                                  </table>
                                                  {{$orderheader->links()}}
                                    <!-- Pagination links and form controls remain the same -->
                                    <div class="form-group mt-2">
                                      <button type="submit" name="submit" data-bs-toggle="modal" data-bs-target="#editBackdrop" class="btn btn-success">Submit &nbsp;&nbsp;&nbsp;<i class="mdi mdi-pen"></i></button>
                                      <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                    </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>



















                <!-- Modal -->
                <div class="modal fade previewModalForm" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg">
                    <div class="modal-content card">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Preview Generated Orders</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body mx-auto" clas="card">

                  
                      <form method="GET" action="{{route('preview_items')}}" id="preview_order_form">
                      <div class="table-wrapper">
                      <table class="table mt-2">
                            <tr>
                                <th></th>
                                <th>S. No.</th>
                                <th>Order Id</th>
                                <th>Dealer</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Total Amount(Rs.)</th>
                                <th>Sales Representative</th>
                                <th>Shipping Address</th>
                                <th>Biling Address</th>
                                <th>Payment Method</th>
                                <!-- <th>Payment Address</th> -->
                                <th>Payment Status</th>
                                <th>Shipping Method</th>
                                <th>Shipping Carrier</th>
                                <th>Shipping Tracking Number</th>
                                <th>Expected Delivery Date</th>
                                <th>Order Notes</th>
                                <th>Order Source</th>
                                <th>Item Count</th>
                                <th>Priority</th>
                                <th>Discount/Promotions(Rs.)</th>
                                <th>Total Order</th>
                                <th>Return/RMA</th>
                                <th>Notes/Comments</th>
                                <th>Attachment's</th>
                                <!-- <th>Action</th> -->
                            </tr>
                            @php($i=1)
                            @foreach($orderheader as $header)
                            <tr>
                                <td><input type="radio" value="{{$header->order_id}}" name="preview_order_id"></td>
                                <td>{{$i++}}</td>
                                <td>{{$header->order_id}}</td>
                                <td>{{$header->dealername}}</td>
                                <td>{{$header->order_date}}</td>
                                <td>
                                    {{ 
                                        $header->order_status == 1 ? 'Pending' :
                                        ($header->order_status == 2 ? 'Processing' :
                                        ($header->order_status == 3 ? 'Shipped' :
                                        ($header->order_status == 4 ? 'Completed' :
                                        ($header->order_status == 5 ? 'Cancelled' : '')
                                        )))
                                    }}
                                </td>
                                <td>{{number_format($header->total_amount)}}</td>
                                <td>{{$header->sales_representative}}</td>
                                <td>{{$header->shipping_address}}</td>
                                <td>{{$header->billing_address}}</td>
                                <td>{{ 
                                        $header->payment_method == 1 ? 'Credit Card' :
                                        ($header->payment_method == 2 ? 'Debit Card' :
                                        ($header->payment_method == 3 ? 'Bank Transfer' :
                                        ($header->payment_method == 4 ? 'Cash' :
                                        ($header->payment_method == 5 ? 'Cash On Delivery' : '')
                                        )))
                                    }}
                                </td>
                                <!-- <td>{{$header->payment_address}}</td> -->
                                <td>
                                    {{ 
                                        $header->payment_status == 1 ? 'Paid' :
                                        ($header->payment_status == 2 ? 'Pending' :
                                        ($header->payment_status == 3 ? 'Overdue' : '')
                                        )
                                    }}
                                </td>
                                <td>
                                    {{ 
                                        $header->sipping_method == 1 ? 'Standard' :
                                        ($header->sipping_method == 2 ? 'Expected' :''
                                        )
                                    }}
                                </td>
                                <td>
                                    {{ 
                                        $header->shipping_carrier == 1 ? 'Blue Dart' :
                                        ($header->shipping_carrier == 2 ? 'E-Kart' :
                                        ($header->shipping_carrier == 5 ? 'Others' : '')
                                        )
                                    }}
                                </td>
                                <td>{{$header->shipping_tracking_number}}</td>
                                <td>{{$header->expected_delivery_date}}</td>
                                <td>{{$header->order_notes}}</td>
                                <td>{{$header->order_source}}</td>
                                <td>{{number_format($header->item_count)}}</td>
                                <td>{{$header->priority}}</td>
                                <td>{{number_format($header->discount)}}</td>
                                <td>{{number_format($header->order_totoal)}}</td>
                                <td>{{$header->return_rma}}</td>
                                <td>{{$header->comments}}</td>
                                <td><a href="{{asset('Storage/'.$header->attachments)}}" style="font-size:20px;"><i class="mdi mdi-eye"></i></a></td>
                                
                            </tr>
                            @endforeach
                        </table>
                        {{$orderheader->links()}}
                        <div class="form-group mt-2">
                          <button type="submit" data-bs-dismiss="modal" class="btn btn-success">Preview &nbsp;&nbsp;&nbsp;<i class="mdi mdi-eye"></i></button>
                          <!-- <button type="button" class="btn btn-secondary">Close</button> -->
                        </div>
                        </form>
                      </div>
                      </div>
                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                      </div>
                    </div>
                  </div>
                </div>


                @include('order.add_order')
                @include('order.preview_order')
                @include('order.edit_order')


            
    </div>
          <!-- content-wrapper ends -->
@include('admin.layout.footer')