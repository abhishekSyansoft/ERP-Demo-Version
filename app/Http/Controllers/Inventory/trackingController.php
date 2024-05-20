<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\Parts;
use App\Models\Inventory\tracking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class trackingController extends Controller
{
    public function TAC(){
        $parts = Parts::get();
        $trackings = tracking::get();
        return view("supply.inventory.tac.tac",compact('parts','trackings'));
    }

    public function FetchDetails(Request $request){
        $id = $request->input('id');

        $part = Parts::where('part_number',$id)->first();

        return response()->json([
            'success'=>true,
            'message'=>'fetched successfully',
            'part'=>$part
        ]);
    }


    public function TACAdd(Request $request){
        try {
            $validateData = $request->validate([
                "inventory_id" => "required",
                "part_number" => "required",
                "vehicle" => "required",
                "location" => "required",
                "qty_on_hand" => "required",
                "min_stock_level" => "required",
                "max_stock_level" => "required",
                "reorder_point" => "required",
                "unit_cost" => "required",
                "total_cost" => "required",
                "supplier_id" => "required",
                "received_date" => "required",
                "serial_number" => "required",
                "condition" => "required",
            ]);
    
            DB::beginTransaction();
    
            tracking::insert([
                "inventory_id" => $request->inventory_id,
                "item_code" => $request->part_number,
                "description" => $request->description,
                "category" => $request->vehicle,
                "location" => $request->location,
                "qty_on_hand" => $request->qty_on_hand,
                "min_stock_level" => $request->min_stock_level,
                "max_stock_level" => $request->max_stock_level,
                "reorder_point" => $request->reorder_point,
                "unit_cost" => $request->unit_cost,
                "total_cost" => $request->total_cost,
                "supplier" => $request->supplier_id,
                "received_date" => $request->received_date,
                "updated_date" => $request->updated_date,
                "serial_number" => $request->serial_number,
                "qrcode" => $request->qrcode,
                "barcode" => $request->barcode,
                "condition" => $request->condition,
                "expiry_date" => $request->expiry_date,
                "quality_control_detail" => $request->quality_control_detail,
                "availability" => $request->availability,
                "created_at"=>Carbon::now()
            ]);
    
            DB::commit();
    
            return redirect()->back()->with('success','Data Inserted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function TACDelete($encryptedId){
        try {
            $id = decrypt($encryptedId);
    
            $tracking = tracking::findOrFail($id);
    
            $tracking->delete();
    
            return redirect()->back()->with('delete','Data Deleted Successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data not found.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
