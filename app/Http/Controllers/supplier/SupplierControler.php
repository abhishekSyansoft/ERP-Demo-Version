<?php

namespace App\Http\Controllers\supplier;

use App\Http\Controllers\Controller;
use App\Models\supplier\supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;

// use Exception;

class SupplierControler extends Controller
{
        /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function Supplier(){
            try {
                // Retrieve all suppliers from the database
                $supplier = Supplier::all();
                // Return the view with the list of suppliers
                return view("supply.master.suppliermanagement.supplie_management",compact("supplier"));
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                // For example, you can return an error view or redirect with an error message
                return view("error")->with("error", "Failed to fetch suppliers: ".$e->getMessage());
            }
        }



        /**
         * Add a new supplier.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function SupplierAdd(Request $request){
            try {
                // Validate the incoming request data
                $validatData = $request->validate([
                    "supplier_name"=> "required",
                    "contact_person"=> "required",
                    "email"=> "required",
                    "phone_number"=> "required",
                    "address"=> "required",
                    "city"=> "required",
                    "state"=> "required",
                    "country"=> "required",
                    "postal_code"=> "required",
                    "account_number"=> "required",
                    "tax_id"=> "required",
                    "lead_time"=> "required",
                    "payment_terms"=> "required",
                ]);

                // Insert the new supplier data into the database
                Supplier::insert([
                    "supplier_name"=> $request->supplier_name,
                    "contact_person"=> $request->contact_person,
                    "email"=> $request->email,
                    "phone_number"=> $request->phone_number,
                    "address"=> $request->address,
                    "city"=> $request->city,
                    "state"=> $request->state,
                    "country"=> $request->country,
                    "postal_code"=> $request->postal_code,
                    "account_number"=> $request->account_number,
                    "tax_id"=> $request->tax_id,
                    "lead_time"=> $request->lead_time,
                    "payment_terms"=> $request->payment_terms,
                    "notes"=> $request->notes
                ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success",$request->supplier_name." added successfully in supplier lists");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to add supplier: ".$e->getMessage());
            }
        }

        public function SupplierEdit($encryptedId){
            $id = decrypt($encryptedId);
            $supplier = Supplier::findOrFail($id);
            return view("supply.master.suppliermanagement.edit_update.update_supplier",compact("supplier"));
        }



        // Update Supplier
    public function SupplierUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "supplier_name"=> "required",
                "contact_person"=> "required",
                "email"=> "required",
                "phone_number"=> "required",
                "address"=> "required",
                "city"=> "required",
                "state"=> "required",
                "country"=> "required",
                "postal_code"=> "required",
                "account_number"=> "required",
                "tax_id"=> "required",
                "lead_time"=> "required",
                "payment_terms"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Retrieve the supplier from the database
            Supplier::where('id',$id)->update([
            "supplier_name"=> $request->supplier_name,
            "contact_person"=> $request->contact_person,
            "email"=> $request->email,
            "phone_number"=> $request->phone_number,
            "address"=> $request->address,
            "city"=> $request->city,
            "state"=> $request->state,
            "country"=> $request->country,
            "postal_code"=> $request->postal_code,
            "account_number"=> $request->account_number,
            "tax_id"=> $request->tax_id,
            "lead_time"=> $request->lead_time,
            "payment_terms"=> $request->payment_terms,
            "notes"=> $request->notes
        ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('supplier-management')->with('success', 'Supplier updated successfully!');
        } catch (ModelNotFoundException $e) {
            // Handle the case where the supplier is not found
            return redirect()->back()->with('error', 'Supplier not found.');
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
    public function SupplierDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $supplier = Supplier::findOrFail($id);

            // Delete the supplier
            $supplier->delete();

            // Redirect back with a success message
            return redirect()->back()->with('delete', 'Supplier details deleted successfully');
        } catch (DecryptException $e) {
            // Handle decryption errors (e.g., if the ID is invalid)
            return redirect()->back()->with('error', 'Invalid supplier ID.'.$e->getMessage());
        } catch (ModelNotFoundException $e) {
            // Handle the case where the supplier is not found
            return redirect()->back()->with('error', 'Supplier not found.'.$e->getMessage());
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while deleting the supplier.'.$e->getMessage());
        }

    }
}
