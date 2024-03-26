<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\moduleMaster;
use Carbon\Carbon;

class moduleController extends Controller
{
    //

    public function AllModules(){
        $modules = ModuleMaster::all();
        return view("module",compact("modules"));
    }

    public function AddModule(){
        return view("modules.create");
    }

    public function StoreModule(Request $request){
        $validateData = $request->validate([
            'name'=> 'required',
            'url'=> 'max:100',
            'mdi_icon'=> 'required',
        ]);

        $module = ModuleMaster::insert([
            'name'=> $request->name,
            'url'=> $request->url,
            'mdi_icon'=> $request->mdi_icon,
            "created_at"=> Carbon::now(),
        ]);
        return redirect()->back()->with('message','Module Created SuccessFully');
    }

    public function DeleteModule($id){
        $module = ModuleMaster::findOrFail($id);
        $module->delete();
        return redirect()->back()->with('message','Module Deleted Successfully');
    }

    public function EditModule($id){
        $module = ModuleMaster::findOrFail($id);
        return view('modules.edit',compact('module'));
    }

    public function UpdateModule(Request $request,$id){
        $validateData = $request->validate([
            'name'=> 'required',
            'url'=> 'required',
            'mdi_icon'=> 'required',
        ]);

        $module = ModuleMaster::find($id)->update([
            'name'=> $request->name,
            'url'=> $request->url,
            'mdi_icon'=> $request->mdi_icon,
        ]);
        return redirect()->back()->with('message','Module Updated Successfully');
    }
    

}