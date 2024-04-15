<?php

namespace App\Http\Controllers\QM;

use App\Http\Controllers\Controller;
use App\Models\QM\QCModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\DPF\SOP;
use App\Models\Products;
use App\Models\DPF\DC;
use DB;
use Carbon\Carbon;

class QCController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function QC(){
            try {

                // Retrieve all resources from the database
                $qc = DB::table('q_c_models')
                ->join('products', 'products.id', '=', 'q_c_models.product_id')
                ->select('q_c_models.*', 'products.product_name as product')
                ->get();
                $products = Products::all();

                // Return the view with the list of suppliers
                return view("supply.quality.qc.qc",compact("qc",'products'));
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
        public function QCAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "product_id"=> "required",
                        "inspection_date"=> "required",
                        "result"=> "required",
                        "remarks"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    QCModel::insert([
                        "product_id"=> $request->product_id,
                        "inspection_date"=> $request->inspection_date,
                        "result"=> $request->result,
                        "remarks"=> $request->remarks,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function QCEdit($encryptedId){
            $id = decrypt($encryptedId);
            $qc = QCModel::findOrFail($id);
            $products = Products::all();
            return view("supply.quality.qc.edit_update.nc_update",compact("qc",'products'));
        }



        // Update Supplier
    public function QCUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "product_id"=> "required",
                "inspection_date"=> "required",
                "result"=> "required",
                "remarks"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                QCModel::where('id',$id)->update([
                    "product_id"=> $request->product_id,
                    "inspection_date"=> $request->inspection_date,
                    "result"=> $request->result,
                    "remarks"=> $request->remarks,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('quality-management')->with('success', 'updated successfully!');
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
    public function QCDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $qc = QCModel::findOrFail($id);

            // Delete the supplier
            $qc->delete();

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
