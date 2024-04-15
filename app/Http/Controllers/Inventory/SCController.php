<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Inventory\SC;
use App\Models\Inventory\WM;
use DB;
use Carbon\Carbon;


class SCController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function SC(){
            try {

                // Retrieve all resources from the databases
                $sc = DB::table('s_c_s')
                ->join('products', 'products.id', '=', 's_c_s.product_id')
                ->join('w_m_s', 'w_m_s.id', '=', 's_c_s.location_id')
                ->select('s_c_s.*', 'products.product_name as product', 'w_m_s.warehouse_name as warehouse_name','w_m_s.location as location')
                ->get();
                $products = Products::all();
                $warehouses = WM::all();

                // Return the view with the list of suppliers
                return view("supply.inventory.sc.sc",compact("sc",'products','warehouses'));
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
        public function SCAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "product_id"=> "required",
                        "quantity_available"=> "required",
                        "warehouse_id"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    SC::insert([
                        "product_id"=> $request->product_id,
                        "quantity_available"=> $request->quantity_available,
                        "location_id"=> $request->warehouse_id,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function SCEdit($encryptedId){
            $id = decrypt($encryptedId);
            $sc = SC::findOrFail($id);
            $products = Products::all();
            $warehouses = WM::all();
            return view("supply.inventory.sc.edit_updtae.sc_update",compact("sc",'products','warehouses'));
        }



        // Update Supplier
    public function SCUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "product_id"=> "required",
                "quantity_available"=> "required",
                "warehouse_id"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                SC::where('id',$id)->update([
                    "product_id"=> $request->product_id,
                    "quantity_available"=> $request->quantity_available,
                    "location_id"=> $request->warehouse_id,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('stock-control')->with('success', 'updated successfully!');
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
    public function SCDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $sc = SC::findOrFail($id);

            // Delete the supplier
            $sc->delete();

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
