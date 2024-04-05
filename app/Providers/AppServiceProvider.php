<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\moduleMaster;
use Auth;
use DB;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        view()->composer('admin.layout.header', function($view) {
            $view->with('modules',$modules = DB::table('mappings')
            ->leftjoin('module_masters', 'mappings.module', '=', 'module_masters.id')
            ->leftjoin('users', 'mappings.role', '=', 'users.admin')
            ->leftjoin('roles', 'roles.id', '=', 'users.admin')
            ->leftjoin('parent_modules', 'parent_modules.id', '=', 'module_masters.parent_id')
            ->where('users.id', Auth::user()->id)
            ->orderBy('module_masters.order')
            ->get(['module_masters.name','module_masters.url','module_masters.mdi_icon','module_masters.order','parent_modules.parent_module as parent','parent_modules.id as parent_id'])
        );
         });

         view()->composer('admin.layout.header', function($view) {
            $view->with('parents',$parents = DB::table('parent_modules')
            ->get()
        );
         });
    }

}
