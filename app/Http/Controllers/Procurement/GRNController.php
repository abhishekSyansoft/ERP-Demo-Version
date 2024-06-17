<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\OrderHeader;
use Illuminate\Http\Request;
use App\Models\supplier\supplier;
use App\Models\Procurement\PO;
use App\Models\Procurement\ItemLists;
use App\Models\ERP\GateEntryModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Procurement\GRN;
use DB;
use Carbon\Carbon;

class GRNController extends Controller
{
    /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function GRN(){
            try {

                $details = GateEntryModel::orderBy('id', 'desc')->get();
                $pos = PO::get();
                $suppliers = supplier::get();

                // Return the view with the list of suppliers
                return view("supply.procurement.gcn.gcn",compact("details",'pos','suppliers'));
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
        public function GRNAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "reciept_number"=>"required",
                        "received_date"=>"required",
                        "received_by"=>"required",
                        "received_quantity"=>"required",
                        "expected_quantity"=>"required",
                        "unit_cost"=>"required",
                        "total_cost"=>"required",
                        
                        "receiving_location"=>"required",
                        
                        "serial_number"=>"required",
                        
                      
                        "supplier_id"=>"required",
                        "shipping_carrier"=>"required",
                        
                        "order_id"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    GRN::insert([
                        "reciept_number"=>$request->reciept_number,
                        "received_date"=>$request->received_date,
                        "received_by"=>$request->received_by,
                        "received_quantity"=>$request->received_quantity,
                        "expected_quantity"=>$request->expected_quantity,
                        "unit_cost"=>$request->unit_cost,
                        "total_cost"=>$request->total_cost,
                        "remarks"=>$request->remarks,
                        "receiving_location"=>$request->receiving_location,
                        "quality_control_information"=>$request->quality_control_information,
                        "serial_number"=>$request->serial_number,
                        "tracking_number"=>$request->tracking_number,
                        "delivery_method"=>$request->delivery_method,
                        "supplier_id"=>$request->supplier_id,
                        "shipping_carrier"=>$request->shipping_carrier,
                        "condition"=>$request->condition,
                        "inspection_result"=>$request->inspection_result,
                        "po_id"=> $request->order_id,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Added successfully");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to add: ".$e->getMessage());
            }
        }

        public function GRNEdit($encryptedId){
            $id = decrypt($encryptedId);
            $grn= GRN::findOrFail($id);
            $orders = OrderHeader::all();
            return view("supply.procurement.gcn.edit_update.gcn_update",compact("grn",'orders'));
        }



        // Update Supplier
    public function GRNUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "reciept_number"=>"required",
                "received_date"=>"required",
                "received_by"=>"required",
                "received_quantity"=>"required",
                "expected_quantity"=>"required",
                "unit_cost"=>"required",
                "total_cost"=>"required",
                "receiving_location"=>"required",
                "serial_number"=>"required",
                "supplier_id"=>"required",
                "shipping_carrier"=>"required",
                "order_id"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                GRN::where('id',$id)->update([
                    "reciept_number"=>$request->reciept_number,
                    "received_date"=>$request->received_date,
                    "received_by"=>$request->received_by,
                    "received_quantity"=>$request->received_quantity,
                    "expected_quantity"=>$request->expected_quantity,
                    "unit_cost"=>$request->unit_cost,
                    "total_cost"=>$request->total_cost,
                    "remarks"=>$request->remarks,
                    "receiving_location"=>$request->receiving_location,
                    "quality_control_information"=>$request->quality_control_information,
                    "serial_number"=>$request->serial_number,
                    "tracking_number"=>$request->tracking_number,
                    "delivery_method"=>$request->delivery_method,
                    "supplier_id"=>$request->supplier_id,
                    "shipping_carrier"=>$request->shipping_carrier,
                    "condition"=>$request->condition,
                    "inspection_result"=>$request->inspection_result,
                    "po_id"=> $request->order_id,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('goods-recieving')->with('success', 'updated successfully!');
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
    public function GRNDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $grn = GRN::findOrFail($id);

            // Delete the supplier
            $grn->delete();

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
