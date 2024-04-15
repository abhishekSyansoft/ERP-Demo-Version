<?php

namespace App\Http\Controllers\QM;

use App\Http\Controllers\Controller;
use App\Models\QM\SQModel;
use App\Models\User;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\DPF\SOP;
use App\Models\Products;
use App\Models\DPF\DC;
use DB;
use Carbon\Carbon;

class SQController extends Controller
{
    /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function SQ(){
            try {

                // Retrieve all resources from the database
                $sq = DB::table('s_q_models')
                ->join('suppliers', 'suppliers.id', '=', 's_q_models.supplier_id')
                ->select('s_q_models.*', 'suppliers.supplier_name as supplier')
                ->get();
                $suppliers = supplier::all();

                // Return the view with the list of suppliers
                return view("supply.quality.sq.sq",compact("sq",'suppliers'));
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
        public function SQAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "supplier_id"=> "required",
                        "quality_rating"=> "required",
                        "audit_date"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    SQModel::insert([
                        "supplier_id"=> $request->supplier_id,
                        "quality_rating"=> $request->quality_rating,
                        "audit_date"=> $request->audit_date,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to add ".$e->getMessage());
            }
        }

        public function SQEdit($encryptedId){
            $id = decrypt($encryptedId);
            $sq = SQModel::findOrFail($id);
            $suppliers = supplier::all();
            return view("supply.quality.sq.edit_update.sq_update",compact("sq",'suppliers'));
        }



        // Update Supplier
    public function SQUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "supplier_id"=> "required",
                "quality_rating"=> "required",
                "audit_date"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                SQModel::where('id',$id)->update([
                    "supplier_id"=> $request->supplier_id,
                    "quality_rating"=> $request->quality_rating,
                    "audit_date"=> $request->audit_date,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('supplier-quality-management')->with('success', 'updated successfully!');
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
    public function SQDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $sq = SQModel::findOrFail($id);

            // Delete the supplier
            $sq->delete();

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
