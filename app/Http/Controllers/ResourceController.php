<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\supplier\resource;
use DB;

class ResourceController extends Controller
{
    /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function Resource(){
            try {

                // Retrieve all resources from the database
                $resources = resource::all();

                // Return the view with the list of suppliers
                return view("supply.master.resource.resource",compact("resources"));
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
        public function ResourceAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "resource_name"=> "required",
                        "resource_description"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    resource::insert([
                        "resource_name"=> $request->resource_name,
                        "resource_description"=> $request->resource_description,
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success",$request->resource_name." added successfully in resource lists");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to add recource: ".$e->getMessage());
            }
        }

        public function ResourceEdit($encryptedId){
            $id = decrypt($encryptedId);
            $resources = resource::findOrFail($id);
            return view("supply.master.resource.edit_update.update_resource",compact("resources"));
        }



        // Update Supplier
    public function ResourceUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "resource_name"=> "required",
                "resource_description"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                resource::where('id',$id)->update([
                    "resource_name"=> $request->resource_name,
                    "resource_description"=> $request->resource_description,
            ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('resource')->with('success', $request->resource_name.' resource updated successfully!');
        } catch (ModelNotFoundException $e) {
            // Handle the case where the supplier is not found
            return redirect()->back()->with('error', $request->resource_name.' Supplier not found.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while updating the supplier.'.$e->getMessage());
        }
    }

    /**
     * Delete a supplier.
     *
     * @param string $encryptedId The encrypted ID of the supplier to delete
     * @return \Illuminate\Http\RedirectResponse Redirect back with a success message
     */
    public function ResourceDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $resources = resource::findOrFail($id);
            $name = $resources->resource_name;

            // Delete the supplier
            $resources->delete();

            // Redirect back with a success message
            return redirect()->back()->with('delete', $name.' deleted successfully');
        } catch (DecryptException $e) {
            // Handle decryption errors (e.g., if the ID is invalid)
            return redirect()->back()->with('error', 'Invalid resource Id.'.$e->getMessage());
        } catch (ModelNotFoundException $e) {
            // Handle the case where the supplier is not found
            return redirect()->back()->with('error', 'Resource not found.'.$e->getMessage());
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while deleting the supplier.'.$e->getMessage());
        }

    }
}
