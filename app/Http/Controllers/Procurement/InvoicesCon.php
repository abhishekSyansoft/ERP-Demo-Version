<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\Procurement\InvoicesController;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Procurement\PR;
use App\Models\User;
use Storage;
use DB;
use Carbon\Carbon;

class InvoicesCon extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function Invoices(){
            try {

                // Retrieve all resources from the database
                $invoices = InvoicesController::all();

                // Return the view with the list of suppliers
                return view("supply.procurement.invoice.invoices",compact('invoices'));
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                // For example, you can return an error view or redirect with an error message
                return view("error")->with("error", "Failed to fetch resources: ".$e->getMessage());
            }
        }



        public function InvoicesAdd(Request $request){
            // try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "invoice_number"=> "required",
                        "invoice_date"=> "required",
                        "invoice_total"=> "required",
                        "file"=> "required",
                    ]);

                   
                        // $dataImage = $request->image;
                            $attachments = $request->file('file');
                            $attachmentsdata = $attachments->getContent();
                            $name_gen = hexdec(uniqid());
                            $attachments_ext = strtolower($attachments->getClientOriginalExtension());
                            $attachments_name = $name_gen .'.'. $attachments_ext;
                            $uplocation = 'attachments/invoices/';
                            $last_attachments = $uplocation . $attachments_name;
            
                            Storage::disk('public')->put($last_attachments,$attachmentsdata);

                            
                          
                //     // Retrieve the supplier from the database
                //     PR::insert([
                //         "invoice_number"=> $request->invoice_number,
                //         "invoice_date"=> $request->invoice_date,
                //         "invoice_total"=> $request->invoice_total,
                //         "file"=> $last_attachments,
                //         'created_at' => Carbon::now()
                //     ]);

                // // Redirect back with success message if successful
                // return redirect()->back()->with("success","Purchase requisition added successfully");
            // } 
                // Log the error or handle it in any other appropriate way
            //     return redirect()->back()->with("error","Failed to create Purchase requisition: ".$e->getMessage());
            // }
        }

        public function PREdit($encryptedId){
            $id = decrypt($encryptedId);
            $pr = PR::findOrFail($id);
            $users = User::all();
            return view("supply.procurement.pr.edit_update.pr_update",compact("pr",'users'));
        }



        // Update Supplier
    public function PRUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "user_id"=> "required",
                "requisition_date"=> "required",
                "status"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                PR::where('id',$id)->update([
                    "user_id"=> $request->user_id,
                    "requisition_date"=> $request->requisition_date,
                    "status"=> $request->status,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('purchase-requisition')->with('success', 'updated successfully!');
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
    public function PRDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $pr = PR::findOrFail($id);

            // Delete the supplier
            $pr->delete();

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
