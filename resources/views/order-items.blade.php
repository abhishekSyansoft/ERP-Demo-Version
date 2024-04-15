@include('admin.layout.header')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Order Items
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Order Items <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
        

        <div class="row">
            <div class="col-md-12" style="margin:auto;">
                <div class="card">
                    <div class="card-body mx-auto">
                        <div class="clearfix">
                            <h4 class="card-title float-left">All Order Items</h4>
                            <a href="{{ route('order_items.add') }}" class="btn btn-primary btn-md">Create New Order Items</a>
                            <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                        </div>
                        <table class="table table-hover table-bordered mt-2">
                            <tr>
                                <th>S. No.</th>
                                <th>Product Name</th>
                                <th>Product Id</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                <th>SKU(Stock Keeping Unit)</th>
                                <th>Tax Amount</th>
                                <th>Dicount</th>
                                <!-- <th>Payment Address</th> -->
                                <th>Sub-Total</th>
                                <th>Line Item Total</th>
                                <th>Action</th>
                            </tr>
                            
                            <tr>
                            </tr>
                            
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@include('admin.layout.footer')