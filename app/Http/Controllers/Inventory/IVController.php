<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Inventory\IV;
use App\Models\Inventory\Parts;
use DB;
use Carbon\Carbon;

class IVController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function IV(){
            try {

                $iv = DB::table('i_v_s')
                // ->join('products', 'products.id', '=', 'i_v_s.product_id')
                ->select('i_v_s.*')
                ->get();

                // Retrieve all resources from the databases
                
                $products = Products::all();
                $parts = Parts::all();

                // Return the view with the list of suppliers
                return view("supply.inventory.iv.iv",compact('products','iv','parts'));
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                // For example, you can return an error view or redirect with an error message
                return view("error")->with("error", "Failed to fetch resources: ".$e->getMessage());
            }
        }



        /**
         * Add a new supplier.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function IVAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "inventory_id" => 'required',
                        "part_number" => 'required',
                        "unit_cost" => 'required',
                        "vehicle" => 'required',
                        "qty_on_hand" => 'required',
                        "total_cost" => 'required',
                    ]);
                    // Retrieve the supplier from the database
                    IV::insert([
                        "inventory_id" => $request->inventory_id,
                        "part_number" => $request->part_number,
                        "description" => $request->part_description,
                        "unit_cost" => $request->unit_cost,
                        "vehicle" => $request->vehicle,
                        "qty_on_hand" => $request->qty_on_hand,
                        "total_cost" => $request->total_cost,
                        "valuation_method" => $request->valuation_method,
                        "valuation_date" => $request->valuation_date,
                        "inventory_value" => $request->inventory_value,
                        "inventory_turnover" => $request->inventory_turnover,
                        "stock_aging" => $request->stock_aging,
                        "financial_metrics" => $request->financial_metrics,
                        "inventory_adjustments" => $request->inventory_adjustments,
                        "inventory_reserves" => $request->inventory_reserves,
                        "inventory_analysis" => $request->inventory_analysis,
                        "inventory_reports" => $request->inventory_reports,
                        "comparison_metrics" => $request->comparison_metrics,
                        "compliance" => $request->comlpiance,
                        "audit_trials" => $request->audit_trials,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to add: ".$e->getMessage());
            }
        }

        public function IVEdit($encryptedId){
            $id = decrypt($encryptedId);
            $iv = IV::findOrFail($id);
            $products = Products::all();
            return view("supply.inventory.iv.edit_update.iv_update",compact("iv",'products'));
        }



        // Update Supplier
    public function IVUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "product_id"=> "required",
                "unit_cost"=> "required",
                "total_value"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                IV::where('id',$id)->update([
                    "product_id"=> $request->product_id,
                    "unit_cost"=> $request->unit_cost,
                    "total_value"=> $request->total_value,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('inventory-valuation')->with('success', 'updated successfully!');
        } catch (ModelNotFoundException $e) {
            // Handle the case where the supplier is not found
            return redirect()->back()->with('error', ' Failed To update.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while updating.'.$e->getMessage());
        }
    }

    /**
     * Delete a supplier.
     *
     * @param string $encryptedId The encrypted ID of the supplier to delete
     * @return \Illuminate\Http\RedirectResponse Redirect back with a success message
     */
    public function IVDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $iv = IV::findOrFail($id);

            // Delete the supplier
            $iv->delete();

            // Redirect back with a success message
            return redirect()->back()->with('delete',' deleted successfully');
        } catch (DecryptException $e) {
            // Handle decryption errors (e.g., if the ID is invalid)
            return redirect()->back()->with('error', 'Invalid  Id.'.$e->getMessage());
        } catch (ModelNotFoundException $e) {
            // Handle the case where the supplier is not found
            return redirect()->back()->with('error', ' Not found.'.$e->getMessage());
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while deletion.'.$e->getMessage());
        }

    }
}
