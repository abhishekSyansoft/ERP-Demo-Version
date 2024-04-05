<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\mapping;
use App\Models\moduleMaster;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ModuleMapping extends Controller
{
    public function Access404(){
        return view("unauthorized");
    }
    public function ModuleMapping(){
        $details = Mapping::join('roles', 'roles.id', '=', 'mappings.role')
              ->join('module_masters', 'module_masters.id', '=','mappings.module')
              ->select('module_masters.name as modulename', 'roles.name as rolename', 'mappings.id as mappingId')
              ->paginate(5);
        return view("moduleMapping",compact("details"));
    }

    public function Back(Request $request){
        // Attempt to redirect back to the previous page
    $redirect = redirect()->back();

    // If redirection failed, fallback to a default URL
    if ($redirect->isRedirect()) {
        return $redirect;
    } else {
        return Redirect::to('/fallback-url');
    }
    }

    public function ModuleMappingAdd(){
        $module = moduleMaster::all();
        $role = Role::all();
        return view("mapping.create",compact('module','role'));
    }
    public function ModuleMappingStore(Request $request){
        $validateData = $request->validate([ 
            "role"=> "required",
            "module"=> "required",
        ]);  

        mapping::insert([
            "role"=> $request->role,
            "module"=> $request->module,
            "Created_at"=> Carbon::now(),
        ]);

        return redirect()->route('mapping')->with("success","Mapping Done Successfully");
    }

    public function ModuleMappingDelete($id){
        $mapping = Mapping::findOrFail($id);
        $mapping->delete();
        return redirect()->route('mapping')->with("delete","Maping Deleted Successfully");
    }

    public function Logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('Success','User Successfully Logout');
    }
}
