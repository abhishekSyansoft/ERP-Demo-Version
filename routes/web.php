<?php

use App\Http\Controllers\UserList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\moduleController;
use App\Http\Controllers\RoleMaster;
use App\Http\Controllers\AdminUserlist;
use App\Http\Controllers\ModuleMapping;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\subCatController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DealerController;
use App\Models\Role;
use App\Models\Users;
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


//Start Modules HTTP requests 
route::get('modules',[moduleController::class , 'AllModules'])->name('modules');
route::get('modules/Add',[moduleController::class ,'AddModule'])->name('add.module');
route::post('modules/Add',[moduleController::class ,'StoreModule'])->name('store.module');
route::get('modules/delete/{id}',[moduleController::class ,'DeleteModule']);
route::get('modules/edit/{id}',[moduleController::class ,'EditModule']);
route::post('modules/update/{id}',[moduleController::class ,'UpdateModule']);

//End Modules HTTP requests 

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
Route::post('/upload', [categoryController::class,'upload'])->name('upload');
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
// route::get('unauthorized',[ModuleMapping::class ,'Access404']);
//End Products HTTP requests 




// Dealer management http requests 
route::get('dealers',[DealerController::class , 'Dealer'])->name('dealers');
route::get('dealers/add',[DealerController::class , 'AddDealer'])->name('dealers.create');
route::post('dealers/store',[DealerController::class , 'StoreDealer']);
route::get('dealers/delete/{id}',[DealerController::class , 'DeleteDealer']);
route::get('dealers/edit/{id}',[DealerController::class , 'EditDealer']);
route::post('dealers/update/{id}',[DealerController::class , 'UpdateDealer']);
//End Dealer management http requests 

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