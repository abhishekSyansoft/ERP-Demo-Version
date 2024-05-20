@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>Vehicle Inventory 
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Vehicle Inventory Management<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
        </nav>
    </div>
    <div>
    <div>
<div>
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Update Vehicle Details:</h4>
            <hr>

            <div id="dealer" class="tabcontent">
                <!-- <h3>Update Dealer</h3> -->
                <!-- form starting  -->
           <!-- Supplier Form -->
           @php($encryptedId = encrypt($vehicle->id))
           <form method="POST" action="{{ url('vinv/update/'.$encryptedId)}}" class="row" enctype="multipart/form-data">
           @csrf
                
            <div class="col-12">
                <hr>
                <h4>Vehicle's Detail's :</h4>
                <hr>
            </div>


            <div class="mb-3 col-md-6 col-lg-3">
                <label for="vin" class="form-label">{{ __('Vehile Identification Number') }}<sup class="text-danger">*</sup></label>
                <input type="text" id="vin" class="form-control" name="vin" value="{{$vehicle->vin}}" placeholder="Vehicle Identification Number" required>
            </div>
            
                <div class="mb-3 col-md-6 col-lg-3">
                    <label for="model" class="form-label">{{ __('Model') }}<sup class="text-danger">*</sup></label>
                    <input id="model" type="text" class="form-control" value="{{$vehicle->model}}" name="model" placeholder="The specific model or series of the vehicle." required>
                </div>

                <div class="mb-3 col-md-6 col-lg-3">
                    <label for="year" class="form-label">{{ __('Year') }}<sup class="text-danger">*</sup></label>
                    <input type="date" id="year" class="form-control" value="{{$vehicle->year}}" name="year" placeholder="The manufacturing year of the vehicle." required autofocus>     
                </div>

                <div class="mb-3 col-md-6 col-lg-3">
                    <label for="color" class="form-label">{{ __('Color') }}<sup class="text-danger">*</sup></label>
                    <input type="text" id="color" class="form-control" value="{{$vehicle->color}}" name="color" placeholder="The manufacturing year of the vehicle." required autofocus>     
                </div>

                <!-- <div class="mb-3 col-md-6 col-lg-3">
                    <label for="trim" class="form-label">{{ __('Trim') }}<sup class="text-danger">*</sup></label>
                    <input type="text" id="trim" class="form-control" name="trim" placeholder="The trim level or package" required autofocus>     
                </div> -->

                <div class="mb-3 col-md-6 col-lg-3">
                    <label for="mileage" class="form-label">{{ __('Mileage') }}<sup class="text-danger">*</sup></label>
                    <input type="text" id="mileage" class="form-control" value="{{$vehicle->mileage}}" name="mileage" placeholder="The mileage or odometer reading of the vehicle." required autofocus>     
                </div>


                <div class="mb-3 col-md-6 col-lg-3">
                    <label for="price" class="form-label">{{ __('Price') }}<sup class="text-danger">*</sup></label>
                    <input type="text" id="price" class="form-control" value="{{$vehicle->price}}" name="price" placeholder="The selling price of the vehicle." required autofocus>     
                </div>

                <div class="mb-3 col-md-6 col-lg-3">
                    <label for="location" class="form-label">{{ __('Location') }}<sup class="text-danger">*</sup></label>
                    <input id="location" type="text" class="form-control" value="{{$vehicle->location}}" name="location" placeholder="The physical location within the warehouse or storage facility where the part is stored." required>
                </div>

                <div class="mb-3 col-md-6 col-lg-3">
                    <label for="status" class="form-label">{{ __('Status') }}<sup class="text-danger">*</sup></label>
                    <select id="status" class="form-control p-3" name="status" required autofocus>
                        <option value="">--The current status of the vehicle (e.g., available for sale or on hold)..--</option> 
                        <option value="sale"{{$vehicle->status == 'sale' ? 'Selected':''}}>Available for sale</option>
                        <option value="hold"{{$vehicle->status == 'hold' ? 'Selected':''}}>On Hold</option>
                    </select>
                </div>

                <!-- <div class="mb-3 col-md-6 col-lg-4">
                    <label for="availability" class="form-label">{{ __('Availability') }}<sup class="text-danger">*</sup></label>
                    <select id="availability" class="form-control p-3" name="availability" required autofocus>
                        <option value="">--:Information about the availability of the vehicle for test drives, inspections, and purchase.--</option> 
                        <option value="TestDrive">TestDrive</option>
                        <option value="Sales">Sales</option>
                        <option value="Purchase">Purchase</option>
                    </select>
                </div> -->

                <!-- <div class="mb-3 col-md-6 col-lg-4">
                    <label for="condition" class="form-label">{{ __('Condition') }}<sup class="text-danger">*</sup></label>
                    <select id="condition" class="form-control p-3" name="condition" required autofocus>
                        <option value="">--Select The condition or status of the part (e.g., new, used, refurbished).--</option> 
                        <option value="New">New</option>
                        <option value="Used">Used</option>
                        <option value="Refurbished">Refurbished</option>
                        
                    </select>
                </div> -->

                <!-- <div class="mb-3 col-md-6 col-lg-4">
                    <label for="history" class="form-label">{{ __('Vehicle History') }}</label>
                    <textarea id="history" rows="4" cols="50" type="text" class="form-control" name="history" placeholder="Information about the vehicle's history, including previous owners, service records, and accident history."></textarea>
                </div> -->

                <div class="mb-3 col-md-6">
                    <label for="features" class="form-label">{{ __('Features') }}</label>
                    <textarea id="features" rows="4" cols="50" class="form-control" name="features" placeholder="A list of features and options included with the vehicle (e.g., navigation system, leather seats, sunroof).">{{$vehicle->features}}</textarea>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="warranty_information" class="form-label">{{ __('Warranty Information') }}</label>
                    <textarea id="warranty_information" rows="4" cols="50" class="form-control" name="warranty_information" placeholder=" Warranty details for the part, including warranty period and terms.">{{$vehicle->warranty_information}}</textarea>
                </div>
                
                <!-- <div class="mb-3 col-md-6">
                    <label for="financial_information" class="form-label">{{ __('Financial Information') }}</label>
                    <textarea id="financial_information" rows="4" cols="50" class="form-control" name="financial_information" placeholder="Financing options, loan details, and payment plans associated with the vehicle."></textarea>
                </div> -->

                <!-- <div class="mb-3 col-md-6">
                    <label for="trade_in_information" class="form-label">{{ __('TradeIN Information') }}</label>
                    <textarea id="trade_in_information" rows="4" cols="50" class="form-control" name="trade_in_information" placeholder="Information about trade-in vehicles accepted for the purchase of the vehicle."></textarea>
                </div> -->


                <div class="mb-3 col-md-6">
                    <label for="image" class="form-label">{{ __('Vehicle Image') }}</label>
                    <input id="image" type="file" class="form-control" name="image">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="document" class="form-label">{{ __('Vehicle Identification Document') }}</label>
                    <input id="document" type="file" class="form-control" name="document">
                </div>

                <div class="mb-3 col-md-6 col-lg-3">
                    <label for="min_stock_level" class="form-label">{{ __('Minimum Stock Level') }}<sup class="text-danger">*</sup></label>
                    <input id="min_stock_level" value="{{$vehicle->min_stock_level}}" type="text" class="form-control" name="min_stock_level" placeholder="The minimum stock level for the part to ensure availability." required>
                </div>

                <div class="mb-3 col-md-6 col-lg-3">
                    <label for="max_stock_level" class="form-label">{{ __('Maximum Stock Level') }}<sup class="text-danger">*</sup></label>
                    <input id="max_stock_level" value="{{$vehicle->max_stock_level}}" type="text" class="form-control" name="max_stock_level" placeholder="The maximum stock level for the part to ensure availability." required>
                </div>

                <div class="mb-3 col-md-3 col-lg-3">
                    <img src="{{asset('Storage/'.$vehicle->image)}}" style="max-width:200px;object-fit:contain;mix-blend-mode:darken;" alt="">
                    <p class="text-success"><i>Old Image</i></p>
                </div>

                <div class="mb-3 col-md-6 col-lg-3" style="margin:auto;">
                    <a href="{{asset('Storage/'.$vehicle->vehicles_identification_documents)}}" class="mdi mdi-file" style="font-size:170px;margin:auto;"></a>
                    <p class="text-success" ><i>Old Document</i></p>
                </div>
                
                <!-- <div class="col-12"><hr></div> -->
                <div class="col-12"><hr></div>
                
                <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
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

