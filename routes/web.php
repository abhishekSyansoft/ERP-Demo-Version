<?php

use App\Http\Controllers\UserList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\moduleController;
use App\Http\Controllers\RoleMaster;
use App\Http\Controllers\AdminUserlist;
use App\Http\Controllers\ModuleMapping;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\subCatController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\OrderHeaderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\supplier\SupplierControler;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\RFQ\CreateRFQController;
use App\Http\Controllers\RFQ\SendRFQController;
use App\Http\Controllers\RFQ\CompListController;
use App\Http\Controllers\PPS\MPSController;
use App\Http\Controllers\PPS\MRPController;
use App\Http\Controllers\PPS\CPController;
use App\Http\Controllers\Procurement\PRController;
use App\Http\Controllers\Procurement\CMController;
use App\Http\Controllers\Procurement\GRNController;
use App\Http\Controllers\Procurement\POController;
use App\Http\Controllers\Procurement\SQNController;
use App\Http\Controllers\Procurement\InvoicesCont;
use App\Http\Controllers\Inventory\PartsController;
use App\Http\Controllers\Inventory\VehiclesController;
use App\Http\Controllers\Inventory\trackingController;
use App\Http\Controllers\Inventory\SRAController;
use App\Http\Controllers\Inventory\IOController;
use App\Http\Controllers\Inventory\IVController;
use App\Http\Controllers\Inventory\SCController;
use App\Http\Controllers\Inventory\WMController;
use App\Http\Controllers\logistics\DNController;
use App\Http\Controllers\logistics\IOLController;
use App\Http\Controllers\logistics\OFController;
use App\Http\Controllers\logistics\TMController;
use App\Http\Controllers\BOM\MainAssemblyController;
use App\Http\Controllers\DPF\DCController;
use App\Http\Controllers\DPF\DFController;
use App\Http\Controllers\DPF\SOPController;
use App\Http\Controllers\QM\NCController;
use App\Http\Controllers\QM\QCController;
use App\Http\Controllers\QM\SQController;
use App\Http\Controllers\SCAR\AnalyticsController;
use App\Http\Controllers\SCAR\PerformanceController;
use App\Http\Controllers\SCAR\PreddictiveController;
// use App\Models\Role;
// use App\Models\Users;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

route::middleware(['role:3,6,2'])->group(function () {

//Start Modules HTTP requests 
route::get('modules',[moduleController::class , 'AllModules'])->name('modules');
route::get('modules/Add',[moduleController::class ,'AddModule'])->name('add.module');
route::post('modules/Add',[moduleController::class ,'StoreModule'])->name('store.module');
route::get('modules/delete/{id}',[moduleController::class ,'DeleteModule']);
route::get('modules/edit/{encryptedID}',[moduleController::class ,'EditModule']);
route::post('modules/update/{encryptedID}',[moduleController::class ,'UpdateModule']);

//End Modules HTTP requests 

//Start Modules HTTP requests 
route::get('bike_parts',[MainAssemblyController::class , 'BikeParts'])->name('bike_parts');
route::POST('bike_parts/add_cat',[MainAssemblyController::class ,'AddPartCat'])->name('add.cat');
route::get('invoice_validation',[MainAssemblyController::class ,'Validation'])->name('invoice_validation');
route::get('payment_initiation',[MainAssemblyController::class ,'Initiate'])->name('payment_initiation');
route::get('payment_tracking',[MainAssemblyController::class ,'TrackingPayment'])->name('payment_tracking');
route::get('supplier_profile',[MainAssemblyController::class ,'SupplierProfile'])->name('supplier_profile');

// route::get('modules/edit/{id}',[moduleController::class ,'EditModule']);
// route::post('modules/update/{id}',[moduleController::class ,'UpdateModule']);

//End Modules HTTP requests 



//Start Parent Modules HTTP requests 
route::get('parent_map',[ParentController::class , 'ParentModules'])->name('parent_map');
route::post('store/data',[ParentController::class ,'StoreData'])->name('store.data');
// route::post('modules/Add',[moduleController::class ,'StoreModule'])->name('store.module');
route::get('delete/parent/{encryptedID}',[ParentController::class ,'DeleteParent']);
route::get('edit/parent/{encryptedID}',[ParentController::class ,'EditParent']);
route::post('update/parent/{encryptedID}',[ParentController::class ,'UpdateParent']);

//End Parent Modules HTTP requests 



//Start Roles HTTP requests 
route::get('roles',[RoleMaster::class , 'AllRole'])->name('roles');
route::get('roles/Add',[RoleMaster::class ,'AddRole'])->name('add.role');
route::post('roles/Add',[RoleMaster::class ,'StoreRole'])->name('store.role');
route::get('roles/delete/{id}',[RoleMaster::class ,'DeleteRole']);
route::get('roles/edit/{id}',[RoleMaster::class ,'EditRole']);
route::post('roles/update/{id}',[RoleMaster::class ,'UpdateRole']);
//End Roles HTTP requests 

//Start Users HTTP requests 
route::get('users',[UserList::class , 'AllUser'])->name('users');
//End Users HTTP requests 

//Start Admin Userlist HTTP requests 
route::get('admin/userlist',[AdminUserlist::class , 'AllUser'])->name('admin/userlist');
route::get('user/create',[AdminUserlist::class , 'CreateUser'])->name('user.create');
route::post('user/Add',[AdminUserlist::class , 'AddUser'])->name('user.add');
route::get('user/delete/{id}',[AdminUserlist::class , 'DeleteUser']);
route::get('user/edit/{id}',[AdminUserlist::class , 'EditUser']);
route::post('user/update/{id}',[AdminUserlist::class , 'UpdateUser']);
//End Admin Userlist HTTP requests 

//Start Modules Mapping HTTP requests 
route::get('mapping',[ModuleMapping::class , 'ModuleMapping'])->name('mapping');
route::get('module/mapping/add',[ModuleMapping::class , 'ModuleMappingAdd'])->name('add.mapping');
route::post('module/mapping/store',[ModuleMapping::class , 'ModuleMappingStore'])->name('store.mapping');
route::get('module/delete/{id}',[ModuleMapping::class , 'ModuleMappingDelete']);
route::get('unauthorized',[ModuleMapping::class ,'Access404']);
route::post('back',[ModuleMapping::class ,'Back'])->name('back');
//End Modules Mapping HTTP requests 


//Start Category HTTP requests 
route::get('category',[categoryController::class , 'Category'])->name('category');
route::post('category/add',[categoryController::class , 'AddCategory'])->name('add.category_item');
Route::post('/upload-category', [categoryController::class,'upload'])->name('upload-category');
route::post('sub-Category/add',[categoryController::class , 'AddSubCategory'])->name('add.sub-category_item');
route::get('categoryitem/add',[categoryController::class , 'createView'])->name('add.category');
route::get('category/edit/{id}',[categoryController::class , 'Edit']);
route::post('update/category/{id}',[categoryController::class , 'UpdateCategory']);
route::post('update/sub-category/{id}',[categoryController::class , 'UpdateSubCategory']);
route::get('Module/Delete/{id}',[ModuleMapping::class , 'ModuleMappingDelete']);
// route::get('unauthorized',[ModuleMapping::class ,'Access404']);
//End Category HTTP requests 

//Start Sub-Category HTTP requests 
route::get('products',[subCatController::class , 'SubCategory'])->name('products');
// route::get('products/filter',[subCatController::class , 'Search'])->name('products.filter');
route::get('create/items',[subCatController::class , 'CreateItems'])->name('items.create');
// route::get('Module/Mapping/Add',[ModuleMapping::class , 'ModuleMappingAdd'])->name('add.mapping');
route::post('items/add',[subCatController::class , 'AddItems'])->name('add.items');
route::get('items/delete/{id}',[subCatController::class , 'DeleteItem']);
route::get('items/edit/{id}',[subCatController::class , 'EditItem']);

// route::get('unauthorized',[ModuleMapping::class ,'Access404']);
//End Sub-Category HTTP requests 


//Start Products HTTP requests 
route::get('products',[ProductsController::class , 'SubCategory'])->name('products');
route::get('create/products',[ProductsController::class , 'CreateItems'])->name('products.create');
// route::get('Module/Mapping/Add',[ModuleMapping::class , 'ModuleMappingAdd'])->name('add.mapping');
route::post('products/add',[ProductsController::class , 'AddItems'])->name('add.products');
route::get('products/delete/{id}',[ProductsController::class , 'DeleteItem']);
route::get('products/edit/{id}',[ProductsController::class , 'EditItem']);
route::post('update/products/{id}',[ProductsController::class , 'UpdateProduct'])->name('update.products');
Route::post('/upload', [ProductsController::class,'upload'])->name('upload');
route::get('unauthorized',[ModuleMapping::class ,'Access404']);
//End Products HTTP requests 




// Dealer management http requests 
route::get('dealers',[DealerController::class , 'Dealer'])->name('dealers');
route::get('dealers/add',[DealerController::class , 'AddDealer'])->name('dealers.create');
route::post('dealers/store',[DealerController::class , 'StoreDealer']);
route::get('dealers/delete/{encryptedId}',[DealerController::class , 'DeleteDealer']);
route::get('dealers/edit/{encryptedId}',[DealerController::class , 'EditDealer']);
route::post('dealers/update/{encryptedId}',[DealerController::class , 'UpdateDealer']);
//End Dealer management http requests 



// Order management http requests 

// Order Header http requests 
route::get('order-header',[OrderHeaderController::class , 'OrderHeader'])->name('order-header');
route::get('order-header/add',[OrderHeaderController::class , 'OrderHeaderAdd'])->name('order_header.add');
route::get('order-header/delete/{id}',[OrderHeaderController::class , 'DeleteOrderHeader']);
route::get('order-header/edit/{id}',[OrderHeaderController::class , 'EditOrderHeader']);
route::post('store/order-header',[OrderHeaderController::class , 'StoreOrderHeader'])->name('store.order-header');
route::post('order-header/update/{id}',[OrderHeaderController::class , 'UpdateOrderHeader']);
route::post('order-header/upload',[OrderHeaderController::class , 'UploadOrderHeader'])->name('order-header/upload');
// route::get('dealers/add',[DealerController::class , 'AddDealer'])->name('dealers.create');
// route::post('dealers/store',[DealerController::class , 'StoreDealer']);
// route::get('dealers/delete/{id}',[DealerController::class , 'DeleteDealer']);
// route::get('dealers/edit/{id}',[DealerController::class , 'EditDealer']);
// route::post('dealers/update/{id}',[DealerController::class , 'UpdateDealer']);
// Order Header http requests 

// Order Header http requests 
route::get('order-items',[OrderItemController::class , 'OrderItem'])->name('order-items');
route::get('order-items/add',[OrderItemController::class , 'AddOrderItem'])->name('order_items.add');
route::get('/add_order_items/fetch-dealer-details', [OrderItemController::class, 'fetchDealerDetails'])->name('/add_order_items/fetch-dealer-details');// route::get('dealers/add',[DealerController::class , 'AddDealer'])->name('dealers.create');
route::post('order-items/store',[OrderItemController::class , 'StoreOrderItem'])->name('store.order-items');
route::get('order-item/delete/{id}',[OrderItemController::class , 'DeteletOrderItems']);
route::get('order-item/edit/{id}',[OrderItemController::class , 'EditOrderItems']);
route::post('update/order-items/{id}',[OrderItemController::class , 'UpdateEditOrderItems']);
route::get('/add_order_items/fetch-items-details',[OrderItemController::class , 'fetchItemsDetails'])->name('/add_order_items/fetch-items-details');
Route::post('/flush-order-id',[OrderItemController::class, 'flushOrderId'])->name('flush.order.id');
route::get('/fetch.order-header-details',[OrderItemController::class , 'fetchItemsDetails'])->name('fetch.order-header-details');
route::GET('/preview-items', [OrderItemController::class, 'previewItems'])->name('preview_items');
route::GET('/edit-order', [OrderItemController::class, 'EditItems'])->name('edit_order');
route::POST('/update-order', [OrderItemController::class, 'UpdateItems'])->name('update.order-items');

// Order Header http requests 

//End Order management http requests 

// --------------------------------------------------------------------------------------------------------------------------------------------

// Supply Chain Management 

// --------------------------------------------------------------------------------------------------------------------------------------------


// Master Management
// -------------------------------------------------------------------------------------------------------------------------------------------


// Supplier Vandor Management 
route::get('supplier-management',[SupplierControler::class ,'Supplier'])->name('supplier-management');
route::post('/supplier-add',[SupplierControler::class ,'SupplierAdd'])->name('supplier.add');
route::get('edit-supplier/{encryptedId}',[SupplierControler::class ,'SupplierEdit']);
route::post('update_vendor/{encryptedId}',[SupplierControler::class ,'SupplierUpdate']);
route::get('delete-supplier/{encryptedId}',[SupplierControler::class ,'SupplierDelete']);
// End Supplier vendor Management


//  Raw Material Management 
route::get('raw-material',[RawMaterialController::class ,'RawMaterial'])->name('raw-material');
route::post('/materials.store',[RawMaterialController::class ,'RawMaterialAdd'])->name('materials.store');
route::get('edit-material/{encryptedId}',[RawMaterialController::class ,'RawMaterialEdit']);
route::post('raw-material/update/{encryptedId}',[RawMaterialController::class ,'RawMaterialUpdate']);
route::get('delete-material/{encryptedId}',[RawMaterialController::class ,'RawMaterialDelete']);
// End Raw Material Management


//  Resource Management 
route::get('resource',[ResourceController::class ,'Resource'])->name('resource');
route::post('/resource.store',[ResourceController::class ,'ResourceAdd'])->name('resource.store');
route::get('edit-resource/{encryptedId}',[ResourceController::class ,'ResourceEdit']);
route::post('resource/update/{encryptedId}',[ResourceController::class ,'ResourceUpdate']);
route::get('delete-resource/{encryptedId}',[ResourceController::class ,'ResourceDelete']);
// End Resource Management

// -------------------------------------------------------------------------------------------------------------------------------------------
// End Master Management



// Production Planning Sheduling Management
// -------------------------------------------------------------------------------------------------------------------------------------------

// master-production-shedule Management 
route::get('master-production-shedule',[MPSController::class ,'MPS'])->name('master-production-shedule');
route::post('mps/store',[MPSController::class ,'MPSAdd'])->name('mps.store');
route::get('edit-mps/{encryptedId}',[MPSController::class ,'MPSEdit']);
route::post('mps/update/{encryptedId}',[MPSController::class ,'MPSUpdate']);
route::get('delete-mps/{encryptedId}',[MPSController::class ,'MPSDelete']);
route::get('view-mps/{encryptedId}',[MPSController::class ,'MPSView']);
route::get('/fetch-mps-details',[MPSController::class ,'MPSFetchView']);
// End master-production-shedule Management


// Material Requirment Planning Management 
route::get('material-requirement-management',[MRPController::class ,'MRP'])->name('material-requirement-management');
route::post('mrp/store',[MRPController::class ,'MRPAdd'])->name('mrp.store');
route::get('edit-mrp/{encryptedId}',[MRPController::class ,'MRPEdit']);
route::post('mrp/update/{encryptedId}',[MRPController::class ,'MRPUpdate']);
route::get('delete-mrp/{encryptedId}',[MRPController::class ,'MRPDelete']);
// End Material Requirment Planning Management

// Capacity Planning Management 
route::get('capacity-planning',[CPController::class ,'CPM'])->name('capacity-planning');
route::post('capacity-planning/store',[CPController::class ,'CPMAdd'])->name('capacity-planning.store');
route::get('edit-capacity-planning/{encryptedId}',[CPController::class ,'CPMEdit']);
route::post('capacity-planning/update/{encryptedId}',[CPController::class ,'CPMUpdate']);
route::get('delete-capacity-planning/{encryptedId}',[CPController::class ,'CPMDelete']);
// End Capacity Planning Management

// -------------------------------------------------------------------------------------------------------------------------------------------
// End Production Planning Sheduling Management





// Procurement Management
// -------------------------------------------------------------------------------------------------------------------------------------------


// Purchase Requisition Management 
route::get('purchase-requisition',[PRController::class ,'PR'])->name('purchase-requisition');
route::post('pr/store',[PRController::class ,'PRAdd'])->name('pr.store');
route::get('edit-pr/{encryptedId}',[PRController::class ,'PREdit']);
route::post('pr/update/{encryptedId}',[PRController::class ,'PRUpdate']);
route::get('delete-pr/{encryptedId}',[PRController::class ,'PRDelete']);
route::POST('fetch-supplier-details',[PRController::class ,'Supplier']);
route::POST('fetch-requisitioner-details',[PRController::class ,'Requisitioner']);
route::POST('view_pr_item_lists',[PRController::class ,'ItemListiewPR']);
route::POST('view_pr',[PRController::class ,'PRView']);

// End Purchase Requisition Management


// Supplier Quotation Negotiation Management 
route::get('supplier-quotation',[SQNController::class ,'SQN'])->name('supplier-quotation');
route::post('sqn/store',[SQNController::class ,'SQNAdd'])->name('sqn.store');
route::get('edit-sqn/{encryptedId}',[SQNController::class ,'SQNEdit']);
route::post('sqn/update/{encryptedId}',[SQNController::class ,'SQNUpdate']);
route::get('delete-sqn/{encryptedId}',[SQNController::class ,'SQNDelete']);
// End Supplier Quotation Negotiation Management

// Goods Receieving Notes Management 
route::get('goods-recieving',[GRNController::class ,'GRN'])->name('goods-recieving');
route::post('grn/store',[GRNController::class ,'GRNAdd'])->name('grn.store');
route::get('edit-grn/{encryptedId}',[GRNController::class ,'GRNEdit']);
route::post('grn/update/{encryptedId}',[GRNController::class ,'GRNUpdate']);
route::get('delete-grn/{encryptedId}',[GRNController::class ,'GRNDelete']);
// Goods Receieving Notes Management

// Contract Management 
route::get('contract-management',[CMController::class ,'CM'])->name('contract-management');
route::post('cm/store',[CMController::class ,'CMAdd'])->name('cm.store');
route::get('edit-cm/{encryptedId}',[CMController::class ,'CMEdit']);
route::post('cm/update/{encryptedId}',[CMController::class ,'CMUpdate']);
route::get('delete-cm/{encryptedId}',[CMController::class ,'CMDelete']);
//End Contract Management

// Purchase Orders Management 
route::get('purchase-order',[POController::class ,'PO'])->name('purchase-order');
route::post('po/store',[POController::class ,'POAdd'])->name('po.store');
route::get('edit-po/{encryptedId}',[POController::class ,'POEdit']);
route::post('po/update/{encryptedId}',[POController::class ,'POUpdate']);
route::get('delete-po/{encryptedId}',[POController::class ,'PODelete']);
route::post('fetch_item_lists_po',[POController::class ,'Fetch']);
route::post('fetch_supplier_for_po',[POController::class ,'FetchSupplier']);
route::post('save_item_lists',[POController::class ,'SaveItems']);
route::get('/view_po',[POController::class ,'ViewPO']);
//End Purchase Orders Management


// -------------------------------------------------------------------------------------------------------------------------------------------
// End Procurement Management


// RFQ Management
// -------------------------------------------------------------------------------------------------------------------------------------------


// Create RFQ Management 
route::get('create_rfq',[CreateRFQController::class ,'CRFQ'])->name('create_rfq');
route::post('crfq/store',[CreateRFQController::class ,'CRFQAdd'])->name('crfq.store');
route::get('edit-crfq/{encryptedId}',[CreateRFQController::class ,'CRFQEdit']);
route::post('crfq/update/{encryptedId}',[CreateRFQController::class ,'CRFQUpdate']);
route::get('delete-crfq/{encryptedId}',[CreateRFQController::class ,'CRFQDelete']);
// End Create RFQ Management


// Send RFQ Management 
route::get('send_rfq',[SendRFQController::class ,'SRFQ'])->name('send_rfq');
route::post('sqrf/store',[SendRFQController::class ,'SRFQAdd'])->name('sqrf.store');
route::get('edit-sqrf/{encryptedId}',[SendRFQController::class ,'SRFQEdit']);
route::post('sqrf/update/{encryptedId}',[SendRFQController::class ,'SRFQUpdate']);
route::get('delete-sqrf/{encryptedId}',[SendRFQController::class ,'SRFQDelete']);
// End Send RFQ Management

// Completed Lists Management 
route::get('completed',[CompListController::class ,'CSRF'])->name('completed');
// route::post('grn/store',[CompListController::class ,'GRNAdd'])->name('grn.store');
// route::get('edit-grn/{encryptedId}',[CompListController::class ,'GRNEdit']);
// route::post('grn/update/{encryptedId}',[CompListController::class ,'GRNUpdate']);
// route::get('delete-grn/{encryptedId}',[CompListController::class ,'GRNDelete']);
// Completed Lists Management

// -------------------------------------------------------------------------------------------------------------------------------------------
// End RFQ Management





// Inventory Management
// -------------------------------------------------------------------------------------------------------------------------------------------


// parts Inventory Management 
route::get('parts-inventory-management',[PartsController::class ,'PartsInv'])->name('parts-inventory-management');
route::post('partsinv/store',[PartsController::class ,'PartsInvAdd'])->name('partsinv.store');
route::get('edit-partsinv/{encryptedId}',[PartsController::class ,'PartsInvEdit']);
route::post('partsinv/update/{encryptedId}',[PartsController::class ,'PartsInvUpdate']);
route::get('delete-partsinv/{encryptedId}',[PartsController::class ,'PartsInvDelete']);
route::POST('/generate_qrcode',[PartsController::class ,'PartsInvQRCode']);
route::POST('/generate_barcode',[PartsController::class ,'PartsInvBARCode']);
// End parts Inventory Management


// Vehicles Inventory Management 
route::get('vehicles-inventory-management',[VehiclesController::class ,'VInv'])->name('vehicles-inventory-management');
route::post('vinv/store',[VehiclesController::class ,'VInvAdd'])->name('vinv.store');
route::get('edit-vinv/{encryptedId}',[VehiclesController::class ,'VInvEdit']);
route::post('vinv/update/{encryptedId}',[VehiclesController::class ,'VInvUpdate']);
route::get('delete-vinv/{encryptedId}',[VehiclesController::class ,'VInvDelete']);
route::POST('/generate_qrcode_vehicle',[VehiclesController::class ,'VInvQRCode']);
route::POST('/generate_barcode_vehicle',[VehiclesController::class ,'VInvBARCode']);
// End Vehicles Management


// Stock control Management 
route::get('stock-control',[SCController::class ,'SC'])->name('stock-control');
route::post('sc/store',[SCController::class ,'SCAdd'])->name('sc.store');
route::get('edit-sc/{encryptedId}',[SCController::class ,'SCEdit']);
route::post('sc/update/{encryptedId}',[SCController::class ,'SCUpdate']);
route::get('delete-sc/{encryptedId}',[SCController::class ,'SCDelete']);
// End Stock control Management


// Warehouse Management 
route::get('warehouse-management',[WMController::class ,'WM'])->name('warehouse-management');
route::post('wm/store',[WMController::class ,'WMAdd'])->name('wm.store');
route::get('edit-wm/{encryptedId}',[WMController::class ,'WMEdit']);
route::post('wm/update/{encryptedId}',[WMController::class ,'WMUpdate']);
route::get('delete-wm/{encryptedId}',[WMController::class ,'WMDelete']);
route::POST('/generate_qrcode_warehouse',[WMController::class ,'WMQRCode']);
route::POST('/generate_barcode_warehouse',[WMController::class ,'WMBARCode']);
// End Warehouse Management

// Tarcking and Control Management 
route::get('tracking_and_control',[trackingController::class ,'TAC'])->name('tracking_and_control');
route::post('tac/store',[trackingController::class ,'TACAdd'])->name('tac.store');
route::get('edit-tac/{encryptedId}',[trackingController::class ,'TACEdit']);
route::post('tac/update/{encryptedId}',[trackingController::class ,'TACUpdate']);
route::get('delete-tac/{encryptedId}',[trackingController::class ,'TACDelete']);
route::POST('/generate_qrcode_tac',[trackingController::class ,'TACQRCode']);
route::POST('/generate_barcode_tac',[trackingController::class ,'TACBARCode']);
route::POST('/fetch-part-details',[trackingController::class ,'FetchDetails']);

// End Tarcking and Control Management

// Stock Replensihment and allocatiom Management 
route::get('stock_replenishment_&_allocation',[SRAController::class ,'SRA'])->name('stock_replenishment_&_allocation');
route::post('sra/store',[SRAController::class ,'SRAAdd'])->name('sra.store');
route::get('edit-sra/{encryptedId}',[SRAController::class ,'SRAEdit']);
route::post('sra/update/{encryptedId}',[SRAController::class ,'SRAUpdate']);
route::get('delete-sra/{encryptedId}',[SRAController::class ,'SRADelete']);
// route::POST('/generate_qrcode_tac',[trackingController::class ,'SRAQRCode']);
// route::POST('/generate_barcode_tac',[trackingController::class ,'SRABARCode']);
// route::POST('/fetch-part-details',[trackingController::class ,'FetchDetails']);

// End Stock Replensihment and allocatiom Management

// Inventory Optimizaton Management 
route::get('inventry-optimization',[IOController::class ,'IO'])->name('inventry-optimization');
route::post('io/store',[IOController::class ,'IOAdd'])->name('io.store');
route::get('edit-io/{encryptedId}',[IOController::class ,'IOEdit']);
route::post('io/update/{encryptedId}',[IOController::class ,'IOUpdate']);
route::get('delete-io/{encryptedId}',[IOController::class ,'IODelete']);
//  Inventory Optimizaton Management

// Contract Management 
route::get('inventory-valuation',[IVController::class ,'IV'])->name('inventory-valuation');
route::post('iv/store',[IVController::class ,'IVAdd'])->name('iv.store');
route::get('edit-iv/{encryptedId}',[IVController::class ,'IVEdit']);
route::post('iv/update/{encryptedId}',[IVController::class ,'IVUpdate']);
route::get('delete-iv/{encryptedId}',[IVController::class ,'IVDelete']);
//End Contract Management

// -------------------------------------------------------------------------------------------------------------------------------------------
// End Inventory Management





// Logistic and distribution Management
// -------------------------------------------------------------------------------------------------------------------------------------------

// Transportation Management 
route::get('transportation-management',[TMController::class ,'TM'])->name('transportation-management');
route::post('tm/store',[TMController::class ,'TMAdd'])->name('tm.store');
route::get('edit-tm/{encryptedId}',[TMController::class ,'TMEdit']);
route::post('tm/update/{encryptedId}',[TMController::class ,'TMUpdate']);
route::get('delete-tm/{encryptedId}',[TMController::class ,'TMDelete']);
// End Transportation Management

//Order Fulfillment Management 
route::get('order-fulfillment',[OFController::class ,'OF'])->name('order-fulfillment');
route::post('of/store',[OFController::class ,'OFAdd'])->name('of.store');
route::get('edit-of/{encryptedId}',[OFController::class ,'OFEdit']);
route::post('of/update/{encryptedId}',[OFController::class ,'OFUpdate']);
route::get('delete-of/{encryptedId}',[OFController::class ,'OFDelete']);
// End Order Fulfillment Management

// Distribution Network Management 
route::get('distribution-network',[DNController::class ,'DN'])->name('distribution-network');
route::post('dn/store',[DNController::class ,'DNAdd'])->name('dn.store');
route::get('edit-dn/{encryptedId}',[DNController::class ,'DNEdit']);
route::post('dn/update/{encryptedId}',[DNController::class ,'DNUpdate']);
route::get('delete-dn/{encryptedId}',[DNController::class ,'DNDelete']);
//   Distribution Network Management

// Inbound/outbound Logistics Management 
route::get('inbound-outbound-logistic',[IOLController::class ,'IOL'])->name('inbound-outbound-logistic');
route::post('iol/store',[IOLController::class ,'IOLAdd'])->name('iol.store');
route::get('edit-iol/{encryptedId}',[IOLController::class ,'IOLEdit']);
route::post('iol/update/{encryptedId}',[IOLController::class ,'IOLUpdate']);
route::get('delete-iol/{encryptedId}',[IOLController::class ,'IOLDelete']);
//End Inbound/outbound Logistics Management

// -------------------------------------------------------------------------------------------------------------------------------------------
// End Logistic and distribution Management




// Demand Planning and Forecasting Management
// -------------------------------------------------------------------------------------------------------------------------------------------

// Demand Forecasting
route::get('demand-forecasting',[DFController::class ,'DF'])->name('demand-forecasting');
route::post('df/store',[DFController::class ,'DFAdd'])->name('df.store');
route::get('edit-df/{encryptedId}',[DFController::class ,'DFEdit']);
route::post('df/update/{encryptedId}',[DFController::class ,'DFUpdate']);
route::get('delete-df/{encryptedId}',[DFController::class ,'DFDelete']);
route::get('view/{encryptedId}',[DFController::class ,'DFView']);
// End Demand Forecasting

//Sales and operations planning 
route::get('sales-operations-planning',[SOPController::class ,'SOP'])->name('sales-operations-planning');
route::post('sop/store',[SOPController::class ,'SOPAdd'])->name('sop.store');
route::get('edit-sop/{encryptedId}',[SOPController::class ,'SOPEdit']);
route::post('sop/update/{encryptedId}',[SOPController::class ,'SOPUpdate']);
route::get('delete-sop/{encryptedId}',[SOPController::class ,'SOPDelete']);
route::post('/get-dfs-details', [SOPController::class , 'getDetails'])->name('get-dfs-details');
// End Sales and operations planning 

// Demand Collabration
route::get('demand-collabration',[DCController::class ,'DC'])->name('demand-collabration');
route::post('dc/store',[DCController::class ,'DCAdd'])->name('dc.store');
route::get('edit-dc/{encryptedId}',[DCController::class ,'DCEdit']);
route::post('dc/update/{encryptedId}',[DCController::class ,'DCUpdate']);
route::get('delete-dc/{encryptedId}',[DCController::class ,'DCDelete']);
// End Demand Collabration

// -------------------------------------------------------------------------------------------------------------------------------------------
// End  Demand Planning and Forecasting Management




// Quality Control Management
// -------------------------------------------------------------------------------------------------------------------------------------------

// quality-management
route::get('quality-management',[QCController::class ,'QC'])->name('quality-management');
route::post('qc/store',[QCController::class ,'QCAdd'])->name('qc.store');
route::get('edit-qc/{encryptedId}',[QCController::class ,'QCEdit']);
route::post('qc/update/{encryptedId}',[QCController::class ,'QCUpdate']);
route::get('delete-qc/{encryptedId}',[QCController::class ,'QCDelete']);
// End quality-management

//non-conformance-management
route::get('non-conformance-management',[NCController::class ,'NC'])->name('non-conformance-management');
route::post('nc/store',[NCController::class ,'NCAdd'])->name('nc.store');
route::get('edit-nc/{encryptedId}',[NCController::class ,'NCEdit']);
route::post('nc/update/{encryptedId}',[NCController::class ,'NCUpdate']);
route::get('delete-nc/{encryptedId}',[NCController::class ,'NCDelete']);
// route::post('/get-dfs-details', [SOPController::class , 'getDetails'])->name('get-dfs-details');
// End non-conformance-management

// supplier-quality-management
route::get('supplier-quality-management',[SQController::class ,'SQ'])->name('supplier-quality-management');
route::post('sq/store',[SQController::class ,'SQAdd'])->name('sq.store');
route::get('edit-sq/{encryptedId}',[SQController::class ,'SQEdit']);
route::post('sq/update/{encryptedId}',[SQController::class ,'SQUpdate']);
route::get('delete-sq/{encryptedId}',[SQController::class ,'SQDelete']);
// End supplier-quality-management
// -------------------------------------------------------------------------------------------------------------------------------------------
// End Quality Control Management




// Supply Chain Analytics and Reporting Management
// -------------------------------------------------------------------------------------------------------------------------------------------

// Data Analytics
route::get('data-analytics',[AnalyticsController::class ,'Analytics'])->name('data-analytics');
route::post('analytics/store',[AnalyticsController::class ,'AnalyticsAdd'])->name('analytics.store');
route::get('edit-analytics/{encryptedId}',[AnalyticsController::class ,'AnalyticsEdit']);
route::post('analytics/update/{encryptedId}',[AnalyticsController::class ,'AnalyticsUpdate']);
route::get('delete-analytics/{encryptedId}',[AnalyticsController::class ,'AnalyticsDelete']);
// End Data Analytics

//Performance Analytics-management
route::get('performance',[PerformanceController::class ,'Performance'])->name('performance');
route::post('performance/store',[PerformanceController::class ,'PerformanceAdd'])->name('performance.store');
route::get('edit-performance/{encryptedId}',[PerformanceController::class ,'PerformanceEdit']);
route::post('performance/update/{encryptedId}',[PerformanceController::class ,'PerformanceUpdate']);
route::get('delete-performance/{encryptedId}',[PerformanceController::class ,'PerformanceDelete']);
Route::get('view-quality-control-details/{encryptedId}',[PerformanceController::class, 'getData']);
// End Performance Analytics-management

// Predictive Analytics
route::get('prediction-analytics',[PreddictiveController::class ,'Predictive'])->name('prediction-analytics');
route::post('predictive/store',[PreddictiveController::class ,'PredictiveAdd'])->name('predictive.store');
route::get('edit-predictive/{encryptedId}',[PreddictiveController::class ,'PredictiveEdit']);
route::post('predictive/update/{encryptedId}',[PreddictiveController::class ,'PredictiveUpdate']);
route::get('delete-predictive/{encryptedId}',[PreddictiveController::class ,'PredictiveDelete']);

// End Predictive Analytics
// -------------------------------------------------------------------------------------------------------------------------------------------
// End Supply Chain Analytics and Reporting Management

// --------------------------------------------------------------------------------------------------------------------------------------------

// End Supply Chain Management 

});


Route::middleware(['role:2,3'])->group(function () {

// Supplier Quotation Negotiation Management 
route::get('supplier-quotation',[SQNController::class ,'SQN'])->name('supplier-quotation');
route::post('sqn/store',[SQNController::class ,'SQNAdd'])->name('sqn.store');
route::get('edit-sqn/{encryptedId}',[SQNController::class ,'SQNEdit']);
route::post('sqn/update/{encryptedId}',[SQNController::class ,'SQNUpdate']);
route::get('delete-sqn/{encryptedId}',[SQNController::class ,'SQNDelete']);
// End Supplier Quotation Negotiation Management


// Purchase Orders Management 
route::get('purchase-order',[POController::class ,'PO'])->name('purchase-order');
route::post('po/add',[POController::class ,'POAdd'])->name('po.add');
route::get('edit-po/{encryptedId}',[POController::class ,'POEdit']);
route::post('po/update/{encryptedId}',[POController::class ,'POUpdate']);
route::get('delete-po/{encryptedId}',[POController::class ,'PODelete']);
route::post('/fetch_order_item_lists',[POController::class ,'FetchOrderItem']);
route::post('/fetch_order_item_data',[POController::class ,'FetchOrderItem']);

//End Purchase Orders Management


// Invoices Management 
route::get('invoices',[InvoicesCont::class ,'Invoices'])->name('invoices');
route::post('invoices/store',[InvoicesCont::class ,'InvoicesAdd'])->name('invoices.store');
route::get('edit-invoice/{encryptedId}',[InvoicesCont::class ,'InvoicesEdit']);
route::post('invoices/update/{encryptedId}',[InvoicesCont::class ,'InvoicesUpdate']);
route::get('delete-invoice/{encryptedId}',[InvoicesCont::class ,'InvoicesDelete']);
//End Invoices Management
});

Route::middleware(['role:6,3'])->group(function () {
// Invoices Management 
route::get('order',[OrderController::class ,'Order'])->name('order');
route::post('order/store',[OrderController::class ,'OrderAdd'])->name('order.store');
route::get('edit-order/{encryptedId}',[OrderController::class ,'OrderEdit']);
route::post('order/update/{encryptedId}',[OrderController::class ,'OrderUpdate']);
route::get('delete-order/{encryptedId}',[OrderController::class ,'OrderDelete']);
route::post('/save_these_data',[OrderController::class ,'SaveTheseData']);
//End Invoices Management
});

// --------------------------------------------------------------------------------------------------------------------------------------------
// Logout 
route::get('logout',[ModuleMapping::class,'Logout'])->name('logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});