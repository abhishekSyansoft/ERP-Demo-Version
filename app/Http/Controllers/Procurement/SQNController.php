<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\supplier\supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Procurement\SQN;
use DB;
use Carbon\Carbon;

class SQNController extends Controller
{
    /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function SQN(){
            try {

                // Retrieve all resources from the database
                $sqn = DB::table('s_q_n_s')
                ->join('suppliers', 'suppliers.id', '=', 's_q_n_s.supplier_id')
                ->join('products', 'products.id', '=', 's_q_n_s.item_id')
                ->select('s_q_n_s.*', 'suppliers.supplier_name as supplier','products.product_name as product')
                ->get();
                $products = Products::all();
                $suppliers = supplier::all();

                // Return the view with the list of suppliers
                return view("supply.procurement.sqn.sqn",compact("sqn",'products','suppliers'));
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
        public function SQNAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "supplier_id"=> "required",
                        "item_id"=> "required",
                        "price"=> "required",
                        "valid_until"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    SQN::insert([
                        "supplier_id"=> $request->supplier_id,
                        "item_id"=> $request->item_id,
                        "price"=> $request->price,
                        "valid_until"=> $request->valid_until,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Added successfully");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to add: ".$e->getMessage());
            }
        }

        public function SQNEdit($encryptedId){
            $id = decrypt($encryptedId);
            $sqn = SQN::findOrFail($id);
            $products = Products::all();
            $suppliers = supplier::all();
            return view("supply.procurement.sqn.edit_update.sqn_update",compact("sqn",'products','suppliers'));
        }



        // Update Supplier
    public function SQNUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "supplier_id"=> "required",
                "item_id"=> "required",
                "price"=> "required",
                "valid_until"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                SQN::where('id',$id)->update([
                    "supplier_id"=> $request->supplier_id,
                    "item_id"=> $request->item_id,
                    "price"=> $request->price,
                    "valid_until"=> $request->valid_until,
                    'created_at' => Carbon::now()
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('supplier-quotation')->with('success', 'updated successfully!');
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
    public function SQNDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $sqn = SQN::findOrFail($id);

            // Delete the supplier
            $sqn->delete();

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
