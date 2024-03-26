<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\mapping;
use App\Models\moduleMaster;
use Carbon\Carbon;
use Auth;

class ModuleMapping extends Controller
{
    public function ModuleMapping(){
        $details = Mapping::join('roles', 'roles.id', '=', 'mappings.role')
              ->join('module_masters', 'module_masters.id', '=','mappings.module')
              ->get(['module_masters.name as modulename','roles.name as rolename','mappings.id as mappingId']);

        return view("moduleMapping",compact("details"));
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

        return redirect()->back()->with("success","Mapping Done Successfully");
    }

    public function ModuleMappingDelete($id){
        $mapping = Mapping::findOrFail($id);
        $mapping->delete();
        return redirect()->back()->with("success","Maping Deleted Successfully");
    }

    public function Logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('Success','User Successfully Logout');
    }
}
