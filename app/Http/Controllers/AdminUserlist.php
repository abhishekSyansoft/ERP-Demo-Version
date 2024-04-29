<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Role;

class AdminUserlist extends Controller
{
    public function AllUser(){
        // $users = User::all();
        $user = User::join('roles', 'roles.id', '=', 'users.admin')
        ->get(['roles.*','roles.name as role','users.name as username','users.id as userid','users.email as email','users.designation as designation']);
        return view("admin-userlist",compact('user'));
    }

    public function DeleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin-userlist')->with("delete","User deleted successfully");
    }

    public function CreateUser(){
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    public function AddUser(Request $request){
       $validateData = $request->validate([
        'name'=> 'required',
        'email'=> 'required|max:100|email',
        'password'=> 'required',
        'designation'=> 'max:100',
        'role'=> 'max:50',
        'admin'=>'max:10'
       ]);

       User::insert([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> bcrypt($request->password),
        'role'=> $request->role,
        'admin'=> $request->admin,
        'designation'=> $request->designation
       ]);

        return redirect()->back()->with('success',$request->name.' as user created successfully');
    }


    public function EditUser($id){
        $users = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit',compact('users','roles'));
    }



    public function UpdateUser(Request $request,$id){
        $validateData = $request->validate([
         'name'=> 'required',
         'email'=> 'required|max:100|email',
         'password'=> 'required',
         'designation'=> 'max:100',
         'role'=> 'max:50',
         'admin'=>'max:10'
        ]);
 
        $users = User::find($id)->update([
         'name'=> $request->name,
         'email'=> $request->email,
         'password'=> bcrypt($request->password),
         'role'=> $request->role,
         'admin'=> $request->admin,
         'designation'=> $request->designation
        ]);
 
         return redirect()->route('admin/userlist')->with('success','User updated successfully');
     }
}
