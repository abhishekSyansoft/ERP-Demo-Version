@include('admin.layout.header')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> All Orders
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span> All Orders <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>     

        <!-- <div class="card mb-2 mt-2">
            <form method="GET" class="row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="product" id="product" value="{{ isset($_GET['product']) ? $_GET['product'] : '' }}">
                </div>
                <div class="col-md-6 form-group">
                  <input class="btn btn-success btn-md" type="submit" value="Submit">
                </div>
            </form>
        </div> -->
       
            <div class="row mx-auto m-1 p-1">
              <div class="col-md-12 m-0 p-0">
                <div class="card mx-auto p-0">
                  <div class="card-body p-0" style="border-radius:10px;">
                    <div class="clearfix p-2 m-0" style="background-image: linear-gradient(to right, #0081b6, #74b6d1);   border-top-left-radius: 10px;border-top-right-radius: 10px;">
                      <div class="row">
                        <div class="col-md-6 m-0">
                        <h4 class="card-title float-left m-0 p-0" style="color:white;">All Orders Lists</h4>
                        </div>
                         <!-- Button to open the modal -->
                        <div class="col-md-6">
                        <b style="color:white;font-size:20px;"><a href="{{route('order_items.add')}}" class="btn btn-primary mdi mdi-plus-circle" style="color:white;float:right;">New</a></b>
                       
                        </div>
                        <!-- <hr>   -->
                      </div>   
                    </div>  

                        <div class="table-wrapper">
                        <table class="table">
                            <tr>
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
                                <th>Action</th>
                            </tr>
                            @php($i=1)
                            @foreach($orderheader as $header)
                            @for($a=0;$a<3;$a++)
                            <tr>
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
                                <td><a href="{{'Storage/'.$header->attachments}}" style="font-size:20px;"><i class="mdi mdi-eye"></i></a></td>
                                <td>
                                    <a href="{{url('order-header/edit/'.$header->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="{{url('order-header/delete/'.$header->id)}}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endfor
                            @endforeach
                        </table>
                        {{$orderheader->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- content-wrapper ends -->
@include('admin.layout.footer')