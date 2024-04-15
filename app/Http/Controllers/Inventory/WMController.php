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

class WMController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function WM(){
            try {

                // Retrieve all resources from the databases
                
                $warehouses = WM::all();

                // Return the view with the list of suppliers
                return view("supply.inventory.wm.wm",compact('warehouses'));
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
        public function WMAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "warehouse_name"=> "required",
                        "location"=> "required",
                        "capacity"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    WM::insert([
                        "warehouse_name"=> $request->warehouse_name,
                        "location"=> $request->location,
                        "capacity"=> $request->capacity,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function WMEdit($encryptedId){
            $id = decrypt($encryptedId);
            $wm = WM::findOrFail($id);
            return view("supply.inventory.wm.edit_update.wm_update",compact("wm"));
        }



        // Update Supplier
    public function WMUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "warehouse_name"=> "required",
                "location"=> "required",
                "capacity"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                WM::where('id',$id)->update([
                    "warehouse_name"=> $request->warehouse_name,
                    "location"=> $request->location,
                    "capacity"=> $request->capacity,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('warehouse-management')->with('success', 'updated successfully!');
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
    public function WMDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $wm = WM::findOrFail($id);

            // Delete the supplier
            $wm->delete();

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
