<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\ParentModules;
use App\Models\User;
use DB;
use App\Models\moduleMaster;
use Carbon\Carbon;

class moduleController extends Controller
{
    // ----------------------------------------------------------------------------------------------
    // main module page whict consist of all modules data
    public function AllModules(){
        $modules = DB::table('module_masters')
        ->join('parent_modules', 'module_masters.parent_id', '=', 'parent_modules.id')
        ->select('module_masters.*', 'parent_modules.parent_module as head_module')
        ->paginate(5);
        return view("module",compact("modules"));
    }
    //End main module page whict consist of all modules data
    // -----------------------------------------------------------------------------------------------

    // redirect function to create a module page where end user can create a module
    // -----------------------------------------------------------------------------------------------
    public function AddModule(){
        $parents = ParentModules::get();
        $module = moduleMaster::get();
        return view("modules.create",compact('parents','module'));
    }
    //End redirect function to create a module page where end user can create a module
    // -----------------------------------------------------------------------------------------------
    
    
    // Post method when a user create a module data stored at backend
    // -----------------------------------------------------------------------------------------------
    public function StoreModule(Request $request){
        $validateData = $request->validate([
            'name'=> 'required',
            'parent_module'=> 'required',
            'url'=> 'max:100',
            'mdi_icon'=> 'required',
            'order'=> 'required',
        ]);

        if($request->module_name){
            $module_name = $request->module_name;
        }else{
            $module_name = 0; 
        }

        $modname =

        $module = ModuleMaster::insert([
            'name'=> $request->name,
            'parent_id'=> $request->parent_module,
            'url'=> $request->url,
            'mdi_icon'=> $request->mdi_icon,
            'module_name'=> $request->module_name,
            'order'=> $request->order,
            "created_at"=> Carbon::now(),
        ]);
        return redirect()->route('modules')->with('message',$request->name.' Module added successfully');
    }
    //End Post method when a user create a module data stored at backend
    // -------------------------------------------------------------------------------------------


    // Delete Modules request function 
    // -------------------------------------------------------------------------------------------
    public function DeleteModule($id){
        $module = ModuleMaster::findOrFail($id);
        $name = $module->name;
        $module->delete();
        return redirect()->route('modules')->with('delete',$name.' Module Deleted Successfully');
    }
    // End Delete Modules request function 
    // -------------------------------------------------------------------------------------------


    // http request to edit last module 
    // -------------------------------------------------------------------------------------------
    public function EditModule($encryptedID){
        $id = decrypt($encryptedID);
        $parents = ParentModules::get();
        $module = ModuleMaster::findOrFail($id);
        $modules = moduleMaster::get();
        return view('modules.edit',compact('module','parents','modules'));
    }
    //End http request to edit last module 
    // -------------------------------------------------------------------------------------------


    // Update Module Http request (we request all fields vis post medthod an dfind the row using id we are getting fron the url)
    // -------------------------------------------------------------------------------------------
    public function UpdateModule(Request $request,$encryptedID){
        $id = decrypt($encryptedID);
        $validateData = $request->validate([
            'name'=> 'required',
            'parent_module'=> 'required',
            'url'=> 'required',
            'mdi_icon'=> 'required',
            'order'=> 'required',
        ]);

        if($request->module_name !== ''){
            $module_name = $request->module_name;
        }else{
            $module_name = 0; 
        }


        $module = ModuleMaster::find($id)->update([
            'name'=> $request->name,
            'parent_id'=> $request->parent_module,
            'module_name'=> $module_name,
            'url'=> $request->url,
            'mdi_icon'=> $request->mdi_icon,
            'order'=> $request->order,
        ]);
        return redirect()->route('modules')->with('message',$request->name.'Module Updated Successfully');
    }
    // End Module update http request
    // ----------------------------------------------------------------------------------------
}