<?php

namespace App\Http\Controllers\QM;

use App\Http\Controllers\Controller;
use App\Models\QM\QCModel;
use App\Models\QM\NCModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;
use Carbon\Carbon;

class NCController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function NC(){
            try {

                // Retrieve all resources from the database
                $nc = DB::table('n_c_models')
                ->join('q_c_models', 'q_c_models.id', '=', 'n_c_models.qc_id')
                ->select('n_c_models.*', 'q_c_models.id as qc_id')
                ->get();

                $qc = DB::table('q_c_models')
                ->join('products','products.id','=','q_c_models.product_id')
                ->select('q_c_models.*','products.product_name as product')
                ->get();

                $quality = DB::table('q_c_models')
                ->join('products', 'products.id', '=', 'q_c_models.product_id')
                ->select('q_c_models.*', 'products.product_name as product')
                ->get();

                // Return the view with the list of suppliers
                return view("supply.quality.nc.nc",compact("qc",'nc','quality'));
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
        public function NCAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "qc_id"=> "required",
                        "non_conformance_date"=> "required",
                        "action_taken"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    NCModel::insert([
                        "qc_id"=> $request->qc_id,
                        "non_conformance_date"=> $request->non_conformance_date,
                        "action_taken"=> $request->action_taken,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function NCEdit($encryptedId){
            $id = decrypt($encryptedId);
            $nc = NCModel::findOrFail($id);

           
            $qc = DB::table('q_c_models')
            ->join('products','products.id','=','q_c_models.product_id')
            ->select('q_c_models.*','products.product_name as product')
            ->get();
            
            return view("supply.quality.nc.edit_update.nc_update",compact("qc",'nc'));
        }



        // Update Supplier
    public function NCUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "qc_id"=> "required",
                "non_conformance_date"=> "required",
                "action_taken"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                NCModel::where('id',$id)->update([
                    "qc_id"=> $request->qc_id,
                    "non_conformance_date"=> $request->non_conformance_date,
                    "action_taken"=> $request->action_taken,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('non-conformance-management')->with('success', 'updated successfully!');
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
    public function NCDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $nc = NCModel::findOrFail($id);

            // Delete the supplier
            $nc->delete();

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
