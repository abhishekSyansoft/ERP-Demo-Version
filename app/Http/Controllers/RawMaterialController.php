<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use App\Models\RawMaterial;
use App\Models\supplier\supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use DB;


class RawMaterialController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function RawMaterial(){
            try {
                // Retrieve all suppliers from the database
                $rawmaterial = DB::table('raw_materials')
                ->join('suppliers', 'suppliers.id', '=', 'raw_materials.supplier_id')
                ->select('raw_materials.*', 'suppliers.supplier_name')
                ->get();

                $categories = Category::get();
                $products = Products::get();
                
                $supplier = Supplier::all();
                // Return the view with the list of suppliers
                return view("supply.master.raw_material.raw_material",compact("rawmaterial","supplier",'categories','products'));
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                // For example, you can return an error view or redirect with an error message
                return view("error")->with("error", "Failed to fetch suppliers: ".$e->getMessage());
            }
        }



        /**
         * Add a new supplier.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function RawMaterialAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "material_name"=> "required",
                        "material_description"=> "required",
                        "item"=> "required",
                        "size"=> "required",
                        "unit_of_measure"=> "required",
                        "storage_condition"=> "required",
                        "shelf_life"=> "required",
                        "supplier_id"=> "required",
                        "remarks"=> "required",
                        "cost_per_unit"=> "required",
                        "safety_stock_quantity"=> "required",
                        "safety_stock_amount"=> "required",
                        "this_month_stock_quantity"=> "required",
                        "this_month_stock_amount"=> "required",
                        "entering_warehouse_this_month_stock_quantity"=> "required",
                        "entering_warehouse_this_month_stock_amount"=> "required",
                        "out_of_warehouse_this_month_stock_quantity"=> "required",
                        "out_of_warehouse_this_month_stock_amount"=> "required",
                        "last_month_stock_quantity"=> "required",
                        "last_month_stock_amount"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    RawMaterial::insert([
                        "material_id" => 'MAT_'.uniqid(),
                        "material_name"=> $request->material_name,
                        "item"=> $request->item,
                        "material_description"=> $request->material_description,
                        "cost_per_unit"=> $request->cost_per_unit,
                        "storage_condition"=> $request->storage_condition,
                        "shelf_life"=> $request->shelf_life,
                        "remarks"=>$request->remarks,
                        "size"=> $request->size,
                        "unit"=> $request->unit_of_measure,
                        "supplier_id"=>$request->supplier_id,
                        "safety_stock_quantity"=> $request->safety_stock_quantity,
                        "safety_stock_amount"=> $request->safety_stock_amount,
                        "current_month_stock_quantity"=> $request->this_month_stock_quantity,
                        "current_month_stock_amount"=> $request->this_month_stock_amount,
                        "current_month_stock_quantity_entering_warehouse"=> $request->entering_warehouse_this_month_stock_quantity,
                        "current_month_stock_amount_entering_warehouse"=> $request->entering_warehouse_this_month_stock_amount,
                        "current_month_stock_quantity_out_warehouse"=> $request->out_of_warehouse_this_month_stock_quantity,
                        "current_month_stock_amount_out_warehouse"=> $request->out_of_warehouse_this_month_stock_amount,
                        "last_month_stock_quantity"=> $request->last_month_stock_quantity,
                        "last_month_stock_amount"=> $request->last_month_stock_amount,
                        "created_at"=>Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success",$request->material_name." added successfully in raw Material lists");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to add raw material: ".$e->getMessage());
            }
        }

        public function RawMaterialEdit($encryptedId){
            $id = decrypt($encryptedId);
            $rawmaterial = RawMaterial::findOrFail($id);
            $suppliers = supplier::all();
            return view("supply.master.raw_material.edit_update.raw_material_update",compact("rawmaterial","suppliers"));
        }



        // Update Supplier
    public function RawMaterialUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "material_name"=> "required",
                "item"=> "required",
                "material_description"=> "required",
                "size"=> "required",
                "unit_of_measure"=> "required",
                "storage_condition"=> "required",
                "shelf_life"=> "required",
                "supplier_id"=> "required",
                "remarks"=> "required",
                "cost_per_unit"=> "required",
                "safety_stock_quantity"=> "required",
                "safety_stock_amount"=> "required",
                "this_month_stock_quantity"=> "required",
                "this_month_stock_amount"=> "required",
                "entering_warehouse_this_month_stock_quantity"=> "required",
                "entering_warehouse_this_month_stock_amount"=> "required",
                "out_of_warehouse_this_month_stock_quantity"=> "required",
                "out_of_warehouse_this_month_stock_amount"=> "required",
                "last_month_stock_quantity"=> "required",
                "last_month_stock_amount"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                RawMaterial::where('id',$id)->update([
                    "material_name"=> $request->material_name,
                    "item"=> $request->item,
                    "material_description"=> $request->material_description,
                    "cost_per_unit"=> $request->cost_per_unit,
                    "storage_condition"=> $request->storage_condition,
                    "shelf_life"=> $request->shelf_life,
                    "size"=> $request->size,
                    "unit"=> $request->unit_of_measure,
                    "supplier_id"=>$request->supplier_id,
                    "remarks"=>$request->remarks,
                    "safety_stock_quantity"=> $request->safety_stock_quantity,
                    "safety_stock_amount"=> $request->safety_stock_amount,
                    "current_month_stock_quantity"=> $request->this_month_stock_quantity,
                    "current_month_stock_amount"=> $request->this_month_stock_amount,
                    "current_month_stock_quantity_entering_warehouse"=> $request->entering_warehouse_this_month_stock_quantity,
                    "current_month_stock_amount_entering_warehouse"=> $request->entering_warehouse_this_month_stock_amount,
                    "current_month_stock_quantity_out_warehouse"=> $request->out_of_warehouse_this_month_stock_quantity,
                    "current_month_stock_amount_out_warehouse"=> $request->out_of_warehouse_this_month_stock_amount,
                    "last_month_stock_quantity"=> $request->last_month_stock_quantity,
                    "last_month_stock_amount"=> $request->last_month_stock_amount,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('raw-material')->with('success', 'raw material updated successfully!');
        } catch (ModelNotFoundException $e) {
            // Handle the case where the supplier is not found
            return redirect()->back()->with('error', 'Supplier not found.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while updating the supplier.'.$e->getMessage());
        }
    }

    /**
     * Delete a supplier.
     *
     * @param string $encryptedId The encrypted ID of the supplier to delete
     * @return \Illuminate\Http\RedirectResponse Redirect back with a success message
     */
    public function RawMaterialDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $rawmaterial = RawMaterial::findOrFail($id);
            $name = $rawmaterial->material_name;

            // Delete the supplier
            $rawmaterial->delete();

            // Redirect back with a success message
            return redirect()->back()->with('delete', $name.' deleted successfully');
        } catch (DecryptException $e) {
            // Handle decryption errors (e.g., if the ID is invalid)
            return redirect()->back()->with('error', 'Invalid supplier ID.'.$e->getMessage());
        } catch (ModelNotFoundException $e) {
            // Handle the case where the supplier is not found
            return redirect()->back()->with('error', 'Supplier not found.'.$e->getMessage());
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while deleting the supplier.'.$e->getMessage());
        }

    }
}
