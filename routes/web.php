<?php

use App\Http\Controllers\UserList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\moduleController;
use App\Http\Controllers\RoleMaster;
use App\Http\Controllers\AdminUserlist;
use App\Http\Controllers\ModuleMapping;
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
route::get('Modules/Add',[moduleController::class ,'AddModule'])->name('add.module');
route::post('Modules/Add',[moduleController::class ,'StoreModule'])->name('store.module');
route::get('modules/delete/{id}',[moduleController::class ,'DeleteModule']);
route::get('modules/edit/{id}',[moduleController::class ,'EditModule']);
route::post('modules/update/{id}',[moduleController::class ,'UpdateModule']);
//End Modules HTTP requests 

//Start Roles HTTP requests 
route::get('roles',[RoleMaster::class , 'AllRole'])->name('roles');
route::get('Roles/Add',[RoleMaster::class ,'AddRole'])->name('add.role');
route::post('Roles/Add',[RoleMaster::class ,'StoreRole'])->name('store.role');
route::get('roles/delete/{id}',[RoleMaster::class ,'DeleteRole']);
route::get('roles/edit/{id}',[RoleMaster::class ,'EditRole']);
route::post('roles/update/{id}',[RoleMaster::class ,'UpdateRole']);
//End Roles HTTP requests 

//Start Users HTTP requests 
route::get('Users',[UserList::class , 'AllUser'])->name('users');
//End Users HTTP requests 

//Start Admin Userlist HTTP requests 
route::get('Admin/Userlist',[AdminUserlist::class , 'AllUser'])->name('admin.userlist');
route::get('User/Create',[AdminUserlist::class , 'CreateUser'])->name('user.create');
route::post('User/Add',[AdminUserlist::class , 'AddUser'])->name('user.add');
route::get('User/Delete/{id}',[AdminUserlist::class , 'DeleteUser']);
route::get('User/Edit/{id}',[AdminUserlist::class , 'EditUser']);
route::post('User/Update/{id}',[AdminUserlist::class , 'UpdateUser']);
//End Admin Userlist HTTP requests 

//Start Modules Mapping HTTP requests 
route::get('Module/Mapping',[ModuleMapping::class , 'ModuleMapping'])->name('mapping');
route::get('Module/Mapping/Add',[ModuleMapping::class , 'ModuleMappingAdd'])->name('add.mapping');
route::post('Module/Mapping/Store',[ModuleMapping::class , 'ModuleMappingStore'])->name('store.mapping');
route::get('Module/Delete/{id}',[ModuleMapping::class , 'ModuleMappingDelete']);

//End Modules Mapping HTTP requests 

// Logout 
route::get('logout',[ModuleMapping::class ,'Logout'])->name('logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});