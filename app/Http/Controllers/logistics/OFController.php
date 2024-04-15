<?php

namespace App\Http\Controllers\logistics;

use App\Http\Controllers\Controller;
use App\Models\OrderHeader;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\supplier\resource;
use App\Models\logistics\OF;
use DB;
use Carbon\Carbon;

class OFController extends Controller
{
      /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function OF(){
            try {

                // Retrieve all resources from the database
                $of = DB::table('o_f_s')
                ->join('order_headers', 'order_headers.id', '=', 'o_f_s.order_id')
                ->select('o_f_s.*', 'order_headers.order_id as order_number')
                ->get();

                $orders = OrderHeader::all();
                // $resources = Resource::all();

                // Return the view with the list of suppliers
                return view("supply.logistics.of.of",compact("of",'orders'));
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
        public function OFAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "order_id"=> "required",
                        "fulfillment_date"=> "required",
                        "status"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    OF::insert([
                        "order_id"=> $request->order_id,
                        "fulfillment"=> $request->fulfillment_date,
                        "status"=> $request->status,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function OFEdit($encryptedId){
            $id = decrypt($encryptedId);
            $of = OF::findOrFail($id);
            $orders = OrderHeader::all();
            return view("supply.logistics.of.edit_update.of_update",compact("of","orders"));
        }



        // Update Supplier
    public function OFUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "order_id"=> "required",
                "fulfillment_date"=> "required",
                "status"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                OF::where('id',$id)->update([
                    "order_id"=> $request->order_id,
                    "fulfillment"=> $request->fulfillment_date,
                    "status"=> $request->status,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('order-fulfillment')->with('success', 'updated successfully!');
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
    public function OFDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $of = OF::findOrFail($id);

            // Delete the supplier
            $of->delete();

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
