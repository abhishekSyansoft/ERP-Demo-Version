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

class InvoicesCont extends Controller
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
            try {
                // Validate the incoming request data
                $validateData = $request->validate([
                    'invoice_number'=> 'required',
                    'invoice_date'=> 'required',
                    'invoice_total'=> 'required', 
                    'attachments'=>'required|mimes:pdf'  
                ]);
        
                // Check if attachments are included in the request
                if($request->hasFile('attachments')){
                    // Retrieve the attachments from the request
                    $attachments = $request->file('attachments');
                    
                    // Read the content of the attachments
                    $attachmentsdata = $attachments->getContent();
                    
                    // Generate a unique name for the attachments
                    $name_gen = hexdec(uniqid());
                    
                    // Get the extension of the attachments
                    $attachments_ext = strtolower($attachments->getClientOriginalExtension());
                    
                    // Combine the generated name with the extension to create the file name
                    $attachments_name = $name_gen .'.'. $attachments_ext;
                    
                    // Specify the location where the attachments will be stored
                    $uplocation = 'attachments/invoices/';
                    
                    // Combine the upload location with the file name to get the final path
                    $last_attachments = $uplocation . $attachments_name;
        
                    // Store the attachments in the specified location
                    Storage::disk('public')->put($last_attachments,$attachmentsdata);
                } else {
                    // No attachments were included in the request
                    $last_attachments = 'none';
                }
        
                // Insert the invoice details into the database
                InvoicesController::insert([
                    'invoice_number'=>$request->invoice_number,
                    'invoice_date'=>$request->invoice_date,
                    'invoice_total'=>$request->invoice_total,
                    'attachment'=>$last_attachments,
                    'created_at'=>Carbon::now()
                ]);
        
                // Redirect back with success message
                return redirect()->back()->with('success','Invoice details uploaded successfully');
            } catch (\Exception $e) {
                // Handle any exceptions that may occur
                // Log the error or return an error response as needed
                return redirect()->back()->with('error','An error occurred while processing the request'.$e->getMessage());
            }
        }


        public function InvoicesDelete($encryptedId){
            try {
                // Decrypt the encrypted ID
                $id = decrypt($encryptedId);
                
                // Find the invoice with the decrypted ID
                $invoices = InvoicesController::findOrFail($id);
                
                // Get the path of the attachment
                $oldImagePath = $invoices->attachment;
                
                // Delete the old attachment file from storage
                Storage::disk('public')->delete($oldImagePath);
                
                // Delete the invoice
                $invoices->delete();
        
                // Redirect back with success message
                return redirect()->back()->with('delete','Invoice details deleted successfully');
            } catch (\Exception $e) {
                // Handle any exceptions that may occur
                // Log the error or return an error response as needed
                return redirect()->back()->with('error','An error occurred while deleting the invoice');
            }
        }        


        public function InvoicesEdit($encryptedId){
            try {
                // Decrypt the encrypted ID
                $id = decrypt($encryptedId);
                
                // Find the invoice with the decrypted ID
                $invoices = InvoicesController::findOrFail($id)->first();
                
                return view("supply.procurement.invoice.edit_update.update_invoices",compact('invoices'));
                // Redirect back with success message
                // return redirect()->back()->with('delete','Invoice details deleted successfully');
            } catch (\Exception $e) {
                // Handle any exceptions that may occur
                // Log the error or return an error response as needed
                return redirect()->back()->with('error','An error occurred'.$e->getMessage());
            }
        }        


        
        public function InvoicesUpdate(Request $request, $encryptedId){
            try {
                // Decrypt the encrypted ID
                $id = decrypt($encryptedId);
                
                // Find the invoice with the decrypted ID
                $invoice = InvoicesController::findOrFail($id);
        
                // Validate the incoming request data
                $validateData = $request->validate([
                    'invoice_number'=> 'required',
                    'invoice_date'=> 'required',
                    'invoice_total'=> 'required', 
                    'attachments'=>'file' 
                ]);
        
                // Check if a new file is uploaded
                if ($request->hasFile('attachments')) {
                    // Get the old attachment path
                    $oldAttachmentPath = $invoice->attachment;
        
                    // Delete the old attachment file from storage
                    Storage::disk('public')->delete($oldAttachmentPath);
        
                    // Retrieve the uploaded file from the request
                    $attachment = $request->file('attachments');
                    
                    // Read the content of the attachment
                    $attachmentData = $attachment->getContent();
                    
                    // Generate a unique name for the attachment
                    $nameGen = hexdec(uniqid());
                    
                    // Get the extension of the attachment
                    $attachmentExt = strtolower($attachment->getClientOriginalExtension());
                    
                    // Combine the generated name with the extension to create the file name
                    $attachmentName = $nameGen .'.'. $attachmentExt;
                    
                    // Specify the location where the attachment will be stored
                    $uploadLocation = 'attachments/invoices/';
                    
                    // Combine the upload location with the file name to get the final path
                    $newAttachmentPath = $uploadLocation . $attachmentName;
        
                    // Store the attachment in the specified location
                    Storage::disk('public')->put($newAttachmentPath, $attachmentData);
                } else {
                    // If no new file is uploaded, use the existing attachment path
                    $newAttachmentPath = $invoice->attachment;
                }
        
                // Update the invoice details in the database
                $invoice->update([
                    'invoice_number'=>$request->invoice_number,
                    'invoice_date'=>$request->invoice_date,
                    'invoice_total'=>$request->invoice_total,
                    'attachment'=>$newAttachmentPath,
                    'updated_at'=>now()
                ]);
        
                // Redirect back with success message
                return redirect()->route('invoices')->with('success','Invoice details updated successfully');
            } catch (\Exception $e) {
                // Handle any exceptions that may occur
                // Log the error or return an error response as needed
                return redirect()->back()->with('error','Failed to update invoice details: '.$e->getMessage());
            }
        }
        
        
}
