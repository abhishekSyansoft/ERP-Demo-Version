<?php

namespace App\Http\Controllers\PPS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\supplier\resource;
use App\Models\PPS\CP;
use DB;
use Carbon\Carbon;

class CPController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function CPM(){
            try {

                // Retrieve all resources from the database
                $cps = DB::table('c_p_s')
                ->join('resources', 'resources.id', '=', 'c_p_s.resource_id')
                ->select('c_p_s.*', 'resources.resource_name as resource')
                ->get();
                $resources = Resource::all();

                // Return the view with the list of suppliers
                return view("pps.cp.cp",compact("cps",'resources'));
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
        public function CPMAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "resource_id"=> "required",
                        "date"=> "required",
                        "shift"=> "required",
                        "capacity_available"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    CP::insert([
                        "resource_id"=> $request->resource_id,
                        "date"=> $request->date,
                        "shift"=> $request->shift,
                        "capacity_available"=> $request->capacity_available,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function CPMEdit($encryptedId){
            $id = decrypt($encryptedId);
            $cp = CP::findOrFail($id);
            $resources = Resource::all();
            return view("pps.cp.edit_update.cp_update",compact("cp",'resources'));
        }



        // Update Supplier
    public function CPMUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "resource_id"=> "required",
                "date"=> "required",
                "shift"=> "required",
                "capacity_available"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                CP::where('id',$id)->update([
                    "resource_id"=> $request->resource_id,
                    "date"=> $request->date,
                    "shift"=> $request->shift,
                    "capacity_available"=> $request->capacity_available,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('capacity-planning')->with('success', 'updated successfully!');
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
    public function CPMDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $cp = CP::findOrFail($id);

            // Delete the supplier
            $cp->delete();

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
