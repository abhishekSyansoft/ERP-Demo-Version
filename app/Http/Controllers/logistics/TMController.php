<?php

namespace App\Http\Controllers\logistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\supplier\resource;
use App\Models\logistics\TM;
use DB;
use Carbon\Carbon;

class TMController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function TM(){
            try {

                // Retrieve all resources from the database
                // $cps = DB::table('t_m_s')
                // ->join('resources', 'resources.id', '=', 'c_p_s.resource_id')
                // ->select('c_p_s.*', 'resources.resource_name as resource')
                // ->get();

                $tm = TM::all();
                // $resources = Resource::all();

                // Return the view with the list of suppliers
                return view("supply.logistics.tm.tm",compact("tm"));
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
        public function TMAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "tranport_mode"=> "required",
                        "departure_location"=> "required",
                        "arrival_location"=> "required",
                        "departure_date"=> "required",
                        "arrival_date"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    TM::insert([
                        "transport_mode"=> $request->tranport_mode,
                        "departure_location"=> $request->departure_location,
                        "arrival_location"=> $request->arrival_location,
                        "departure_date"=> $request->departure_date,
                        "arrival_date"=> $request->arrival_date,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function TMEdit($encryptedId){
            $id = decrypt($encryptedId);
            $tm = TM::findOrFail($id);
            // $resources = Resource::all();
            return view("supply.logistics.tm.edit_update.tm_update",compact("tm"));
        }



        // Update Supplier
    public function TMUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "tranport_mode"=> "required",
                "departure_location"=> "required",
                "arrival_location"=> "required",
                "departure_date"=> "required",
                "arrival_date"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                TM::where('id',$id)->update([
                    "transport_mode"=> $request->tranport_mode,
                    "departure_location"=> $request->departure_location,
                    "arrival_location"=> $request->arrival_location,
                    "departure_date"=> $request->departure_date,
                    "arrival_date"=> $request->arrival_date,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('transportation-management')->with('success', 'updated successfully!');
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
    public function TMDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $tm = TM::findOrFail($id);

            // Delete the supplier
            $tm->delete();

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
