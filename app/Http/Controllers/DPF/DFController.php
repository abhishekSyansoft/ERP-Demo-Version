<?php

namespace App\Http\Controllers\DPF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\supplier\resource;
use App\Models\Products;
use App\Models\DPF\DF;
use DB;
use Carbon\Carbon;

class DFController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function DF(){
            try {

                // Retrieve all resources from the database
                $df = DB::table('d_f_s')
                ->join('parts', 'parts.part_number', '=', 'd_f_s.product_id')
                ->select('d_f_s.*', 'parts.part_name as product')
                ->get();
                $products = DB::table('parts')->get();

                // Return the view with the list of suppliers
                return view("supply.demand.df.df",compact("df",'products'));
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
        public function DFAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "product_id"=> "required",
                        "forecast_quantity"=> "required",
                        "forecast_date"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    DF::insert([
                        "product_id"=> $request->product_id,
                        "forecast_quantity"=> $request->forecast_quantity,
                        "forecast_date"=> $request->forecast_date,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function DFEdit($encryptedId){
            $id = decrypt($encryptedId);
            $df = DF::findOrFail($id);
            $products = Products::all();
            return view("supply.demand.df.edit_update.df_update",compact("df",'products'));
        }

        public function DFView($encryptedId){
            $id = decrypt($encryptedId);
            $df = DF::findOrFail($id);
            $products = Products::all();
            return view("supply.demand.df.edit_update.df_view",compact("df",'products'));
        }



        // Update Supplier
    public function DFUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "product_id"=> "required",
                "forecast_quantity"=> "required",
                "forecast_date"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                DF::where('id',$id)->update([
                    "product_id"=> $request->product_id,
                    "forecast_quantity"=> $request->forecast_quantity,
                    "forecast_date"=> $request->forecast_date,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('demand-forecasting')->with('success', 'updated successfully!');
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
    public function DFDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $df = DF::findOrFail($id);

            // Delete the supplier
            $df->delete();

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
