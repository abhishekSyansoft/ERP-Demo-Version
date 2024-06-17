<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\Parts;
use App\Models\Inventory\Allocation;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class SRAController extends Controller
{
   public function SRA(){
    $allocations = DB::table('allocations')
    ->join('parts','parts.part_number','allocations.item_code')
    ->select(['allocations.*','parts.part_name as item_name'])
    ->get();
    $parts = Parts::get();
    return view("supply.inventory.sra.sra",compact('parts','allocations'));
   }


   public function ScrapItemData(Request $request){
    $validateData = $request->validate([
        'scraptype' => 'required',
        'inventory_id' => 'required',
        'part_number' => 'required',
        'vehicle' => 'required',
        'location' => 'required',w
        'scrap_quantity' => 'required',
    ]);

    DB::table('scrap')->insert([
        'inventory_id' => $request->inventory_id,
        'scraptype' => $request->scraptype,
        'part_number' => $request->part_number,
        'vehicle' => $request->vehicle,
        'location' => $request->location,
        'scrap_quantity' => $request->scrap_quantity,
        'grn' => $request->grn,
        'dnn' => $request->dnn
    ]);

    return redirect()->back()->with('message','Scrap item listed successfully');


   }

   public function SRAAdd(Request $request){
       try {
           $validateData = $request->validate([
               "inventory_id" => 'required',
               "part_number" => 'required',
               "part_description" => 'required',
               "vehicle" => 'required',
               "current_stock_level" => 'required',
               "min_stock_level" => 'required',
               "max_stock_level" => 'required',
               "reorder_point" => 'required',
               "lead_time" => 'required',
               "last_replenishment_date" => 'required',
               "demand_forecast" => 'required',
               "sales_channels" => 'required',
               "allocation_qty" => 'required',
               "allocation_date" => 'required',
               "location" => 'required',
               "demand_variability" => 'required',
               "safety_stock" => 'required',
               "order_qty" => 'required',
               "availability" => 'required'
           ]);
   
           Allocation::insert([
               "inventory_id" => $request->inventory_id,
               "item_code" => $request->part_number,
               "description" => $request->part_description,
               "supplier" => $request->supplier_id,
               "category" => $request->vehicle,
               "current_stock_level" => $request->current_stock_level,
               "min_stock_level" => $request->min_stock_level,
               "max_stock_level" => $request->max_stock_level,
               "reorder_point" => $request->reorder_point,
               "lead_time" => $request->lead_time,
               "last_replenishment_date" => $request->last_replenishment_date,
               "demand_forecast" =>  $request->demand_forecast,
               "sales_channels" => $request->sales_channels,
               "allocation_qty" => $request->allocation_qty,
               "alloation_date" => $request->allocation_date,
               "location" => $request->location,
               "demand_variability" => $request->demand_variability,
               "safety_stock" => $request->safety_stock,
               "order_qty" => $request->order_qty,
               "availability" => $request->availability,
               "Created_at" => Carbon::now()
           ]);
   
           return redirect()->back()->with('success','Data Inserted Successfully');
       } catch (QueryException $e) {
           return redirect()->back()->with('error', $e->getMessage());
       } catch (\Exception $e) {
           return redirect()->back()->with('error', $e->getMessage());
       }
   }

   public function SRAEdit($encryptedId){

        $id = decrypt($encryptedId);
        // Return the view with the list of suppliers
        $allocation = Allocation::findOrFail($id)->first();
        $parts = Parts::get();
        return view("supply.inventory.sra.edit_update.sra_update",compact('parts','allocation'));
    }

    public function SRAUpdate(Request $request,$encryptedId){

        $id = decrypt($encryptedId);

        $validateData = $request->validate([
            "inventory_id" => 'required',
            "part_number" => 'required',
            "part_description" => 'required',
            "vehicle" => 'required',
            "current_stock_level" => 'required',
            "min_stock_level" => 'required',
            "max_stock_level" => 'required',
            "reorder_point" => 'required',
            "lead_time" => 'required',
            "last_replenishment_date" => 'required',
            "demand_forecast" => 'required',
            "sales_channels" => 'required',
            "allocation_qty" => 'required',
            "allocation_date" => 'required',
            "location" => 'required',
            "demand_variability" => 'required',
            "safety_stock" => 'required',
            "order_qty" => 'required',
            "availability" => 'required'
        ]);

        // Return the view with the list of suppliers
        Allocation::where('id',$id)->update([
            "inventory_id" => $request->inventory_id,
            "item_code" => $request->part_number,
            "description" => $request->part_description,
            "category" => $request->vehicle,
            "current_stock_level" => $request->current_stock_level,
            "min_stock_level" => $request->min_stock_level,
            "max_stock_level" => $request->max_stock_level,
            "reorder_point" => $request->reorder_point,
            "supplier" => $request->supplier_id,
            "lead_time" => $request->lead_time,
            "last_replenishment_date" => $request->last_replenishment_date,
            "demand_forecast" =>  $request->demand_forecast,
            "sales_channels" => $request->sales_channels,
            "allocation_qty" => $request->allocation_qty,
            "alloation_date" => $request->allocation_date,
            "location" => $request->location,
            "demand_variability" => $request->demand_variability,
            "safety_stock" => $request->safety_stock,
            "order_qty" => $request->order_qty,
            "availability" => $request->availability,
        ]);
        
        return redirect()->route('stock_replenishment_&_allocation')->with('success','Updated Successfully');
    }


   public function SRADelete($encryptedId){

        $id = decrypt($encryptedId);
        // Return the view with the list of suppliers
        $Allocation = Allocation::where('id',$id);

        $Allocation->delete();
        return redirect()->back()->with('delete','Deleted successfully');
    }

   }
