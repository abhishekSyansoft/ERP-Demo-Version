<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParentController extends Controller
{
        public function ParentModules(){

            $details3 = DB::table('parent_mapping')
            ->join('roles', 'roles.id', '=', 'parent_mapping.roleID')
            ->join('parent_modules', 'parent_modules.id', '=', 'parent_mapping.parentID')
            ->select('parent_modules.parent_module as parent_module', 'roles.name as rolename', 'parent_mapping.id as id', 'parent_mapping.order_no as order_no', 'parent_mapping.status as status')
            ->paginate(5);
            $details = DB::table('parent_modules')->get();
            $roles = DB::table('roles')->get();
            return view('parent_module_mapping',compact('details','roles','details3'));
        }

        public function storeData(Request $request){
            $validatedData = $request->validate([
                'moduleSelect' => 'required',
                'roleSelect' => 'required', 
                'order_number' => 'required',
                'status' => 'required'
            ]);
        
            DB::table('parent_mapping')->insert([
                'parentID' => $request->moduleSelect,
                'roleID' => $request->roleSelect,
                'order_no' => $request->order_number,
                'status' => $request->status,
                'created_at' => Carbon::now()
            ]);
        
            return redirect()->back()->with('success', 'Mapping done successfully');
        }

        public function UpdateParent(Request $request,$encryptedID){

            $id = decrypt($encryptedID);
            $validatedData = $request->validate([
                'moduleSelect' => 'required',
                'roleSelect' => 'required', 
                'order_number' => 'required',
                'status' => 'required'
            ]);
        
            DB::table('parent_mapping')->where('id',$id)->update([
                'parentID' => $request->moduleSelect,
                'roleID' => $request->roleSelect,
                'order_no' => $request->order_number,
                'status' => $request->status,
                'updated_at'=> Carbon::now()
            ]);
        
            return redirect()->route('parent_map')->with('success', 'Mapping Updated successfully');
        }

        public function DeleteParent($encryptedID){
            $id = decrypt($encryptedID);

           
                // Find the record by ID and delete it
                $deleted = DB::table('parent_mapping')->where('id', $id)->delete();

                if ($deleted) {
                    return redirect()->back()->with('success', 'Parent mapping deleted successfully');
                } else {
                    return redirect()->back()->with('error', 'Failed to delete parent mapping');
                }
            }

                public function EditParent($encryptedID){

                    $id = decrypt($encryptedID);
                    $parent_details = DB::table('parent_mapping')->where('id', $id)->first();
                    $parent_modules = DB::table('parent_modules')->get();
                    $roles = DB::table('roles')->get();

                    return view('edit_parent_map',compact('parent_details','roles','parent_modules'));  
                }

}
