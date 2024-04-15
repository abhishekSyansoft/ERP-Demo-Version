<?php

namespace App\Http\Controllers\SCAR;


use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\QM\QCModel;
use App\Models\SCAR\PerformanceModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;
use Carbon\Carbon;

class PerformanceController extends Controller
{
   /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function  Performance(){
            try {

                // Retrieve all resources from the database
                $performance = PerformanceModel::all();

                // Return the view with the list of suppliers
                return view("supply.analytics.performance.ps",compact("performance"));
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
        public function PerformanceAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "metric_name"=> "required",
                        "value"=> "required",
                        "date"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    PerformanceModel::insert([
                        "metric_name"=> $request->metric_name,
                        "value"=> $request->value,
                        "date"=> $request->date,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function  PerformanceEdit($encryptedId){
            $id = decrypt($encryptedId);
            $performance = PerformanceModel::findOrFail($id);
            return view("supply.analytics.performance.edit_update.ps_update",compact("performance"));
        }

        public function  getData($encryptedId){
            $id = decrypt($encryptedId);
            $quality = QCModel::where('id',$id)->first();
            $products = Products::all();
            return view("supply.quality.nc.edit_update.nc_view",compact("quality","products"));
        }



        // Update Supplier
    public function PerformanceUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                        "metric_name"=> "required",
                        "value"=> "required",
                        "date"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                PerformanceModel::where('id',$id)->update([
                    "metric_name"=> $request->metric_name,
                        "value"=> $request->value,
                        "date"=> $request->date,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('performance')->with('success', 'updated successfully!');
        } catch (ModelNotFoundException $e) {
            // Handle the case where the supplier is not found
            return redirect()->back()->with('error', ' Failed To update.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while updating.'.$e->getMessage());
        }
    }

    // public function getData(Request $request)
    // {
    //     $id = 4;
    //     // Fetch data from the database table
    //     $data = QCModel::where('id',$id)->get(); // Replace YourModel with your actual model name

    //     // Return the data as JSON
    //     return response()->json($data);
    // }

    /**
     * Delete a supplier.
     *
     * @param string $encryptedId The encrypted ID of the supplier to delete
     * @return \Illuminate\Http\RedirectResponse Redirect back with a success message
     */
    public function  PerformanceDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $performance = PerformanceModel::findOrFail($id);

            // Delete the supplier
            $performance->delete();

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
