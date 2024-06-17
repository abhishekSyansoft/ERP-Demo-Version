<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\supplier\supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Procurement\SQN;
use Illuminate\Support\Facades\DB;
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
                ->join('rfq_supplier_lists', DB::raw('BINARY s_q_n_s.qut_num'), '=', DB::raw('BINARY rfq_supplier_lists.qut_num'))
                ->join('quotations', DB::raw('BINARY quotations.qut_num'), '=', DB::raw('BINARY rfq_supplier_lists.qut_num'))
                ->select('s_q_n_s.*', 'rfq_supplier_lists.supplier as supplier','quotations.total_amount as finalAmount')
                ->orderBy('id', 'desc')->get();
            
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


        public function Help(){
            return view("supply.procurement.help");
        }

        public function CompQuot(Request $request){
            // Validate the incoming request data
            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'string'
            ]);

            // Retrieve the array of IDs
            $ids = $request->input('ids');

            // Fetch the quotations from the database
                $quotations = DB::table('quotations')
                ->join('rfq_supplier_lists', function($join) use ($ids) {
                    $join->on(DB::raw('BINARY rfq_supplier_lists.qut_num'), '=', DB::raw('BINARY quotations.qut_num'))
                        ->whereIn('rfq_supplier_lists.qut_num', $ids);
                })
                ->join('s_q_n_s', function($join) use ($ids) {
                    $join->on(DB::raw('BINARY s_q_n_s.qut_num'), '=', DB::raw('BINARY quotations.qut_num'));
                })
                ->select(['quotations.*', 'rfq_supplier_lists.supplier as supplierName', 's_q_n_s.approval as QutApproval', 's_q_n_s.negotiation as QutNego'])
                ->whereIn('quotations.qut_num', $ids)
                ->get();


            // Perform any required operations with the IDs, for example:
            // $quotations = Quotation::whereIn('id', $ids)->get();

           
                return response()->json([
                    'success' => true,
                    'message' => 'Quotations retrieved successfully',
                    'ids' => $ids,
                    'data' => $quotations
                ]);

        }



        public function AppQuotSend(Request $request){
            $qut_num = $request->input('id');
            $po_id = 'PO_'.uniqid();
            $order_date = Carbon::now()->toDateString();

            $data = DB::table('quotations')->where('qut_num', $qut_num)->first();
            $payment_terms = $data->payment_terms;
            $lead_time = $data->lead_time;
            $total_amount = $data->total_amount;

            $items = DB::table('qut_item_lists')->where('qut_num',$qut_num)->get();

           
            // Step 2: Prepare the data for insertion
            $insertData = [];
            $insertItem = [];

            foreach ($items as $item) {
                $item_code = ''.uniqid();
                $insertData[] = [
                    'order_id' => $po_id,
                    'part_name' => $item->item_name,
                    'unit_price' => $item->unitprice,
                    'quantity' => $item->quantity,
                    'total_price' => $item->total,
                    // Add more columns as needed
                ];

                $insertItem[] = [
                    'part_name' => $item->item_name,
                    'unit_price' => $item->unitprice,
                    'quantity' => $item->quantity,
                    'total_price' => $item->total,
                    // Add more columns as needed
                ];
            }

            // Step 3: Insert the data into 'item_lists' table
            DB::table('item_lists')->insert($insertData);

            $totalQuantity = DB::table('qut_item_lists')->where('qut_num', $qut_num)->sum('quantity');
            // $subTotal =  ItemLists::where('order_id', $request->order_no)->sum('total_price');
           //  $totalAmount =  ItemLists::where('order_id', $request->order_no)->sum('sub_total');
            $totalItem =  DB::table('qut_item_lists')->where('qut_num', $qut_num)->count();

            DB::table('p_o_s')->insert([
                'supplier_id' => 11,
                'po_id' => $po_id,
                'order_date' => $order_date,
                'payment_terms' => $payment_terms,
                'lead_time' => $lead_time,
                'line_amount_total' => $total_amount,
                'total_qty' => $totalQuantity,
                'total_unit' => $totalItem,
                'created_at' => Carbon::now()
            ]);

            DB::table('s_q_n_s')->where('qut_num',$qut_num)->update([
                'approval' => 1
            ]);

            return response()->json([
                'success' => true,
                'qut_num' => $qut_num,
                'message' => 'Quotation sent for approval'
            ]);
        }


        public function NegoQuotSend(Request $request){
            $qut_num = $request->input('id');


            DB::table('s_q_n_s')->where('qut_num',$qut_num)->update([
                'negotiation' => 1
            ]);

            return response()->json([
                'success' => true,
                'qut_num' => $qut_num,
                'message' => 'Quotation sent for Negotiation'
            ]);
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
