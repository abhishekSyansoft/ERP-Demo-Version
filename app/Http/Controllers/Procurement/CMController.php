<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\OrderHeader;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Procurement\CM;
use DB;
use Carbon\Carbon;

class CMController extends Controller
{
    /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function CM(){
            try {
                // Retrieve all resources from the database
                $cm = DB::table('c_m_s')
                ->join('suppliers', 'suppliers.id', '=', 'c_m_s.supplier_id')
                ->select('c_m_s.*', 'suppliers.supplier_name as supplier')
                ->get();
                $suppliers = supplier::all();

                // Return the view with the list of suppliers
                return view("supply.procurement.cm.cm",compact("cm",'suppliers'));
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
        public function CMAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "supplier_id"=> "required",
                        "start_date"=> "required",
                        "end_date"=> "required",
                        "terms_and_conditions"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    CM::insert([
                        "supplier_id"=> $request->supplier_id,
                        "start_date"=> $request->start_date,
                        "end_date"=> $request->end_date,
                        "terms_and_conditions"=> $request->terms_and_conditions,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Added successfully");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to add: ".$e->getMessage());
            }
        }

        public function CMEdit($encryptedId){
            $id = decrypt($encryptedId);
            $cm= CM::findOrFail($id);
            $suppliers = supplier::all();
            return view("supply.procurement.cm.edit_update.cm_update",compact("cm",'suppliers'));
        }



        // Update Supplier
    public function CMUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "supplier_id"=> "required",
                "start_date"=> "required",
                "end_date"=> "required",
                "terms_and_conditions"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                CM::where('id',$id)->update([
                    "supplier_id"=> $request->supplier_id,
                    "start_date"=> $request->start_date,
                    "end_date"=> $request->end_date,
                    "terms_and_conditions"=> $request->terms_and_conditions,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('contract-management')->with('success', 'updated successfully!');
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
    public function CMDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $cm = CM::findOrFail($id);

            // Delete the supplier
            $cm->delete();

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
