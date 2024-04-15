<?php

namespace App\Http\Controllers\logistics;

use App\Http\Controllers\Controller;
use App\Models\OrderHeader;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\supplier\resource;
use App\Models\logistics\IOL;
use App\Models\logistics\TM;
use DB;
use Carbon\Carbon;

class IOLController extends Controller
{
      /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function IOL(){
            try {

                // Retrieve all resources from the database
                $iol = DB::table('i_o_l_s')
                ->join('t_m_s', 't_m_s.id', '=', 'i_o_l_s.transport_id')
                ->join('order_headers', 'order_headers.id', '=', 'i_o_l_s.order_id')
                ->select('i_o_l_s.*', 'order_headers.order_id as order_number', 't_m_s.transport_mode as transport_mode')
                ->get();

                $orders = OrderHeader::all();
                $transports = TM::all();
                // $resources = Resource::all();

                // Return the view with the list of suppliers
                return view("supply.logistics.iol.iol",compact("iol",'orders','transports'));
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
        public function IOLAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "transport_id"=> "required",
                        "order_id"=> "required",
                        "received_date"=> "required",
                        "dispatched_date"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    IOL::insert([
                        "transport_id"=> $request->transport_id,
                        "order_id"=> $request->order_id,
                        "received_date"=> $request->received_date,
                        "dispatched_date"=> $request->dispatched_date,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function IOLEdit($encryptedId){
            $id = decrypt($encryptedId);
            $iol = IOL::findOrFail($id);
            $orders = OrderHeader::all();
            $transports = TM::all();
            return view("supply.logistics.iol.edit_update.iol_update",compact("iol","orders","transports"));
        }



        // Update Supplier
    public function IOLUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "transport_id"=> "required",
                "order_id"=> "required",
                "received_date"=> "required",
                "dispatched_date"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                IOL::where('id',$id)->update([
                    "transport_id"=> $request->transport_id,
                    "order_id"=> $request->order_id,
                    "received_date"=> $request->received_date,
                    "dispatched_date"=> $request->dispatched_date,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('inbound-outbound-logistic')->with('success', 'updated successfully!');
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
