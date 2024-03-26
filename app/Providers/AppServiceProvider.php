<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\moduleMaster;
use Auth;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('admin.layout.navbar', function($view) {
            $view->with('modules',$modules = DB::table('mappings')
            ->leftjoin('module_masters', 'mappings.module', '=', 'module_masters.id')
            ->leftjoin('users', 'mappings.role', '=', 'users.admin')
            ->leftjoin('roles', 'roles.id', '=', 'users.admin')
            ->where('users.id', Auth::user()->id)
            ->get(['module_masters.name','module_masters.url','module_masters.mdi_icon']));
         });
    }

}
