<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
class RoleMaster extends Controller
{
     //

     public function AllRole(){
        $roles = Role::all();
        return view("role",compact("roles"));
    }

    public function AddRole(){
        return view("roles.create");
    }

    public function StoreRole(Request $request){
        $validateData = $request->validate([
            "name"=> "required",
        ]);

        $module = Role::insert([
            "name"=> $request->name,
            "created_at"=> Carbon::now(),
        ]);
        return redirect()->back()->with('message','Role Created SuccessFully');
    }

    public function DeleteRole($id){
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('message','Role Deleted Successfully');
    }

    public function EditRole($id){
        $roles = Role::findOrFail($id);
        return view('roles.edit',compact('roles'));
    }

    public function UpdateRole(Request $request,$id){
        $validateData = $request->validate([
            'name'=> 'required',
        ]);

        $module = Role::find($id)->update([
            'name'=> $request->name,
        ]);
        return redirect()->back()->with('message','Role Updated Successfully');
    }
    
}
