<?php

namespace App\Http\Controllers\DPF;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\DPF\SOP;
use App\Models\Products;
use App\Models\DPF\DC;
use DB;
use Carbon\Carbon;

class DCController extends Controller
{
    /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function DC(){
            try {

                // Retrieve all resources from the database
                $dc = DB::table('d_c_s')
                ->join('products', 'products.id', '=', 'd_c_s.product_id')
                ->join('users', 'users.id', '=', 'd_c_s.collaborator_id')
                ->select('d_c_s.*', 'products.product_name as product', 'users.name as username')
                ->get();
                $users = User::all();
                $products = Products::all();

                // Return the view with the list of suppliers
                return view("supply.demand.dc.dc",compact("dc",'products',"users"));
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
        public function DCAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "product_id"=> "required",
                        "collabration_id"=> "required",
                        "forecast_quantity"=> "required",
                        "collaboration_date"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    DC::insert([
                        "product_id"=> $request->product_id,
                        "collaborator_id"=> $request->collabration_id,
                        "forecast_quantity"=> $request->forecast_quantity,
                        "collaboration_date"=> $request->collaboration_date,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function DCEdit($encryptedId){
            $id = decrypt($encryptedId);
            $dc = DC::findOrFail($id);
            $users = User::all();
            $products = Products::all();
            return view("supply.demand.dc.edit_update.dc_update",compact("dc",'products','users'));
        }



        // Update Supplier
    public function DCUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "product_id"=> "required",
                "collabration_id"=> "required",
                "forecast_quantity"=> "required",
                "collaboration_date"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                DC::where('id',$id)->update([
                    "product_id"=> $request->product_id,
                        "collaborator_id"=> $request->collabration_id,
                        "forecast_quantity"=> $request->forecast_quantity,
                        "collaboration_date"=> $request->collaboration_date,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('demand-collabration')->with('success', 'updated successfully!');
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
    public function DCDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $dc = DC::findOrFail($id);

            // Delete the supplier
            $dc->delete();

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
