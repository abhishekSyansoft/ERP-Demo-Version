<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Parts;
use App\Models\OrderHeader;
use App\Models\Procurement\ItemLists;
use App\Models\RFQ\CreateRFQ;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Procurement\PR;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PRController extends Controller
{
    /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function PR(){
            try {

                // Retrieve all resources from the database
                $pr = DB::table('p_r_s')->orderBy('id', 'desc')->get();
                $parts = Parts::get();
                $users = User::all();
                $orders = OrderHeader::get();
                $suppliers = supplier::all();

                // Return the view with the list of suppliers
                return view("supply.procurement.pr.pr",compact("pr",'users','suppliers','orders','parts'));
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                // For example, you can return an error view or redirect with an error message
                return view("error")->with("error", "Failed to fetch resources: ".$e->getMessage());
            }
        }

        public function Supplier(Request $request){
            $supplier_name = $request->input('id');



            $supplier = supplier::where('supplier_name',$supplier_name)->first();

            return response()->json([
                'success' => true,
                'supplier' =>  $supplier
            ]);
        }

        public function Requisitioner(Request $request){
            $name = $request->input('id');

            $requisitioner = User::where('name',$name)->first();

            return response()->json([
                'success' => true,
                'requisitioner' =>  $requisitioner
            ]);
        }
        



        /**
         * Add a new supplier.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function PRAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        'pr_num' => 'required',
                        'req_name' => 'required',
                        'req_phone' => 'required',
                        'req_email' => 'required',
                        'req_desig' => 'required',
                        'department' => 'required',
                        'requisition_date' => 'required',
                       
                        'del_addr' => 'required',
                        'del_city' => 'required',
                        'del_state' => 'required',
                        
                    ]);

                    if ($request->hasFile('attachments')) {
    
                        // Upload the new image
                        $image = $request->file('attachments');
                        $name_gen = hexdec(uniqid());
                        $img_ext = strtolower($image->getClientOriginalExtension());
                        $img_name = $name_gen . '.' . $img_ext;
                        $uplocation = 'images/PR/attachments/';
                        $last_img = $uplocation . $img_name;
                        $image->storeAs($uplocation, $img_name, 'public');
                    }else{
                        $last_img = "";
                    }
                
                    // Retrieve the supplier from the database
                    PR::insert([
                            'pr_num' => $request->pr_num,
                            'req_name' => $request->req_name,
                            'req_phone' => $request->req_phone,
                            'req_email' => $request->req_email,
                            'req_desig' => $request->req_desig,
                            'department' => $request->department,
                            'requisition_date' => $request->requisition_date,
                            'priority' => $request->priority,
                            'del_addr' => $request->del_addr,
                            'del_city' => $request->del_city,
                            'del_state' => $request->del_state,
                            'del_date' => $request->del_date,
                            'supplier' => $request->supplier,
                            'supplier_phone' => $request->supplier_phone,
                            'supplier_email' => $request->supplier_email,
                            'supplier_person' => $request->supplier_person,
                            'attachments' =>  $last_img,
                            'notes' => $request->notes,
                            'created_at' => Carbon::now()
                    ]);

                    CreateRFQ::insert([
                        'pr_num' => $request->pr_num,
                        'created_at' => Carbon::now()
                ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Purchase requisition added successfully");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Purchase requisition: ".$e->getMessage());
            }
        }

        public function PREdit($encryptedId){
            $id = decrypt($encryptedId);
            $pr = PR::findOrFail($id);
            $parts = Parts::get();
            $users = User::all();
            $orders = OrderHeader::get();
            $suppliers = supplier::all();
            return view("supply.procurement.pr.edit_update.pr_update",compact("pr",'users','suppliers','orders','parts'));
        }

        public function ItemListiewPR(Request $request){
                $id = $request->input('id');

                $pr = PR::findOrFail($id);
                $pr_num = $pr->pr_num;

                $ItemLists = ItemLists::where('pr_num',$pr_num)->get();

                return response()->json([
                    'success'=>true,
                    'prItems'=>$ItemLists
                ]);
        }

        public function PRView(Request $request){
            $id = $request->input('id');

            $pr = PR::where('pr_num',$id)->first();
            $pr_num = $pr->pr_num;
            $rfq = CreateRFQ::where('pr_num',$pr_num)->first();

            $ItemLists = ItemLists::where('pr_num',$pr_num)->get();

            return response()->json([
                'success' => true,
                'prDetails' => $pr,
                'prItems' => $ItemLists,
                'rfq' => $rfq
            ]);

        }



        // Update Supplier
    public function PRUpdate(Request $request, $encryptedId)
    {
        try {
            $id = decrypt($encryptedId);

            $pr = PR::findOrFail($id);
            $image = $pr->attachments;

           // Validate the incoming request data
               
           $validatData = $request->validate([
            'pr_num' => 'required',
            'req_name' => 'required',
            'req_phone' => 'required',
            'req_email' => 'required',
            'req_desig' => 'required',
            'department' => 'required',
            'requisition_date' => 'required',
           
            'del_addr' => 'required',
            'del_city' => 'required',
            'del_state' => 'required',
            
        ]);

        if ($request->hasFile('attachments')) {

            // Upload the new image
            $image = $request->file('attachments');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $uplocation = 'images/PR/attachments/';
            $last_img = $uplocation . $img_name;
            $image->storeAs($uplocation, $img_name, 'public');
        }else{
            $last_img = $image;
        }
            
                // Retrieve the supplier from the database
                PR::where('id',$id)->update([
                    'pr_num' => $request->pr_num,
                    'req_name' => $request->req_name,
                    'req_phone' => $request->req_phone,
                    'req_email' => $request->req_email,
                    'req_desig' => $request->req_desig,
                    'department' => $request->department,
                    'requisition_date' => $request->requisition_date,
                    'priority' => $request->priority,
                    'del_addr' => $request->del_addr,
                    'del_city' => $request->del_city,
                    'del_state' => $request->del_state,
                    'del_date' => $request->del_date,
                    'supplier' => $request->supplier,
                    'supplier_phone' => $request->supplier_phone,
                    'supplier_email' => $request->supplier_email,
                    'supplier_person' => $request->supplier_person,
                    'attachments' =>  $last_img,
                    'notes' => $request->notes,
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
