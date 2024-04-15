<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\OrderHeader;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Procurement\PO;
use DB;
use Carbon\Carbon;

class POController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function PO(){
            try {
                // Retrieve all resources from the database
                $po = DB::table('p_o_s')
                ->join('suppliers', 'suppliers.id', '=', 'p_o_s.supplier_id')
                ->select('p_o_s.*', 'suppliers.supplier_name as supplier')
                ->get();
                $suppliers = supplier::all();

                // Return the view with the list of suppliers
                return view("supply.procurement.po.po",compact("po",'suppliers'));
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
        public function POAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "supplier_id"=> "required",
                        "order_date"=> "required",
                        "delivery_date"=> "required",
                        "total_amount"=> "required",
                        "status"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    PO::insert([
                        "supplier_id"=> $request->supplier_id,
                        "order_date"=> $request->order_date,
                        "delivery_date"=> $request->delivery_date,
                        "total_amount"=> $request->total_amount,
                        "status"=> $request->status,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Added successfully");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to add: ".$e->getMessage());
            }
        }

        public function POEdit($encryptedId){
            $id = decrypt($encryptedId);
            $po= PO::findOrFail($id);
            $suppliers = supplier::all();
            return view("supply.procurement.po.edit_update.po_update",compact("po",'suppliers'));
        }



        // Update Supplier
    public function POUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "supplier_id"=> "required",
                "order_date"=> "required",
                "delivery_date"=> "required",
                "total_amount"=> "required",
                "status"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                PO::where('id',$id)->update([
                    "supplier_id"=> $request->supplier_id,
                    "order_date"=> $request->order_date,
                    "delivery_date"=> $request->delivery_date,
                    "total_amount"=> $request->total_amount,
                    "status"=> $request->status,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('purchase-order')->with('success', 'updated successfully!');
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
    public function PODelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $po = PO::findOrFail($id);

            // Delete the supplier
            $po->delete();

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
