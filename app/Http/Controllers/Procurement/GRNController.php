<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\OrderHeader;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Procurement\GRN;
use DB;
use Carbon\Carbon;

class GRNController extends Controller
{
    /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function GRN(){
            try {

                // Retrieve all resources from the database
                $grn = DB::table('g_r_n_s')
                ->join('order_headers', 'order_headers.id', '=', 'g_r_n_s.po_id')
                ->select('g_r_n_s.*', 'order_headers.order_id as order_number')
                ->get();
                $orders = OrderHeader::all();

                // Return the view with the list of suppliers
                return view("supply.procurement.gcn.gcn",compact("grn",'orders'));
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
        public function GRNAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "order_id"=> "required",
                        "received_date"=> "required",
                        "received_quantity"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    GRN::insert([
                        "po_id"=> $request->order_id,
                        "received_date"=> $request->received_date,
                        "received_quantity"=> $request->received_quantity,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Added successfully");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to add: ".$e->getMessage());
            }
        }

        public function GRNEdit($encryptedId){
            $id = decrypt($encryptedId);
            $grn= GRN::findOrFail($id);
            $orders = OrderHeader::all();
            return view("supply.procurement.gcn.edit_update.gcn_update",compact("grn",'orders'));
        }



        // Update Supplier
    public function GRNUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "order_id"=> "required",
                "received_date"=> "required",
                "received_quantity"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                GRN::where('id',$id)->update([
                    "po_id"=> $request->order_id,
                    "received_date"=> $request->received_date,
                    "received_quantity"=> $request->received_quantity,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('goods-recieving')->with('success', 'updated successfully!');
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
    public function GRNDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $grn = GRN::findOrFail($id);

            // Delete the supplier
            $grn->delete();

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
