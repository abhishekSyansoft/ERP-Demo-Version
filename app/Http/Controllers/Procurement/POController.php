<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\Models\OrderHeader;
// use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Procurement\PO;
use App\Models\Procurement\ItemLists;
use App\Models\Inventory\Parts;
use App\Models\supplier\supplier;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Crypt;

class POController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function PO(){
            try {
                // Retrieve all resources from the database
                $po = DB::table('p_o_s')
                ->join('suppliers', 'suppliers.id', '=', 'p_o_s.supplier_id')
                ->select('p_o_s.*', 'suppliers.supplier_name as supplier')
                ->orderBy('id', 'desc')->get();
                $suppliers = supplier::all();
                $parts = Parts::all();

                // Return the view with the list of suppliers
                return view("supply.procurement.po.po",compact("po",'suppliers','parts'));
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                // For example, you can return an error view or redirect with an error message
                return view("error")->with("error", "Failed to fetch resources: ".$e->getMessage());
            }
        }
        

        public function Fetch(Request $request){
            $id = $request->input('item_code');

            $part = Parts::where('id',$id)->first();

            return response()->json([
                'success'=>true,
                'part'=>$part
            ]);
        }

        public function FetchSupplier(Request $request){
            $id = $request->input('id');

            $suppliers = supplier::where('id',$id)->first();

            return response()->json([
                'success'=>true,
                'suppliers'=>$suppliers
            ]);
        }


        public function POAdd(Request $request){
                try {
                    // Validate the incoming request data
                    $validatedData = $request->validate([
                        "order_no" => "required",
                        "supplier_id" => "required",
                        "order_date" => "required",
                        "payment_terms" => 'required',
                        "lead_time" => 'required',
                        "delivery_address" => 'required',
                        "delivery_city" => 'required',
                        "delivery_state" => 'required',
                        "delivery_pincode" => 'required',
                        "billing_address" => 'required',
                        "billing_city" => 'required',
                        "billing_state" => 'required',
                        "billing_pincode" => 'required',
                    ], [
                        'order_no.required' => 'PO Number is required',
                        'supplier_id.required' => 'The supplier ID field is required.',
                        'order_date.required' => 'The order date field is required.',
                        'payment_terms.required' => 'The payment terms field is required.',
                        'lead_time.required' => 'The lead time field is required.',
                        'delivery_address.required' => 'The delivery address field is required.',
                        'delivery_city.required' => 'The delivery city field is required.',
                        'delivery_state.required' => 'The delivery state field is required.',
                        'delivery_pincode.required' => 'The delivery pincode field is required.',
                        'billing_address.required' => 'The billing address field is required.',
                        'billing_city.required' => 'The billing city field is required.',
                        'billing_state.required' => 'The billing state field is required.',
                        'billing_pincode.required' => 'The billing pincode field is required.',
                    ]);

                       // Calculate totals
                //  $totalDiscount = ItemLists::where('order_id', $request->order_no)->sum('discount');
                 $totalQuantity =  ItemLists::where('order_id', $request->order_no)->sum('quantity');
                 $subTotal =  ItemLists::where('order_id', $request->order_no)->sum('total_price');
                //  $totalAmount =  ItemLists::where('order_id', $request->order_no)->sum('sub_total');
                 $totalItem =  ItemLists::where('order_id', $request->order_no)->count();

                    // Retrieve the supplier from the database
                    $po =  PO::insert([
                        "po_id" => $request->order_no,
                        "supplier_id" => $request->supplier_id,
                        "order_date" => $request->order_date,
                        "delivery_date" => $request->delivery_date,
                        "payment_terms" => $request->payment_terms,
                        "lead_time" => $request->lead_time,
                        "delivery_address" => $request->delivery_address,
                        "delivery_city" => $request->delivery_city,
                        "delivery_state" => $request->delivery_state,
                        "delivery_pincode" => $request->delivery_pincode,
                        "billing_address" => $request->billing_address,
                        "billing_city" => $request->billing_address,
                        "billing_state" => $request->billing_state,
                        "billing_pincode" => $request->billing_pincode,
                        "total_unit" => $totalItem,
                        "total_qty" =>  $totalQuantity,
                        "line_amount_total" =>  $subTotal,
                        "comments" => $request->comments,
                        'created_at' => Carbon::now()
                    ]);

                    // Return a success response if successful
                    return response()->json([
                        'success' => true,
                        'response' => $request->all()
                    ]);
                }catch (ValidationException $e) {
                    // Return a response with validation errors if validation fails
                    return response()->json([
                        'success' => false,
                        'message' => 'Oops! Some fields are missing',
                        'errors' => $e->validator->errors()->messages()
                    ], 422); // Return with a status code of 422 for validation errors
                }catch (\Exception $e) {
                        // Log the error or handle it in any other appropriate way
                        return redirect()->back()->with("error","Failed to add: ".$e->getMessage());
                    }
                }



                public function ViewPO(){
                    return view("supply.procurement.po.view_po",);
                }


                public function FetchOrderItem(Request $request){
                    $id = $request->input('id');

                    $orderDetail = PO::where('id',$id)->first();
                    $order_id  = $orderDetail->po_id;
                    $suppliersID = $orderDetail->supplier_id;

                    $order_items = ItemLists::where('order_id',$order_id)->get();
                    $supplierDetails = supplier::where('id',$suppliersID)->first();

                    return response()->json([
                       'success'=>true,
                       'orderDetails' => $orderDetail,
                       'orderitems' => $order_items,
                       'order_id' =>  $order_id,
                       'supplier' => $supplierDetails
                    ]);
                }


                public function FetchOrderItemInvoice(Request $request){
                    $id = $request->input('id');

                    $orderDetail = PO::where('po_id',$id)->first();
                    $order_id  = $orderDetail->po_id;
                    $suppliersID = $orderDetail->supplier_id;

                    $order_items = ItemLists::where('order_id',$order_id)->get();
                    $supplierDetails = supplier::where('id',$suppliersID)->first();

                    return response()->json([
                       'success'=>true,
                       'orderDetails' => $orderDetail,
                       'orderitems' => $order_items,
                       'order_id' =>  $order_id,
                       'supplier' => $supplierDetails
                    ]);
                }


                public function SendInvoice(Request $request){
                    $inv_id = $request->input('id');


                    $data =  DB::table('invoices_controllers')->where('invoice_number',$inv_id)->first();

                    $id = $data->supplier_id;

                    $supplier = DB::table('suppliers')->where('id',$id)->first();
                    $supplier_id = $supplier->supplier_id;
                    $supplier_name = $supplier->supplier_name;


                    DB::table('invoices_controllers')->where('invoice_number',$inv_id)->update([
                        'send_status' => 1
                    ]);

                    
                    DB::table('invoice_validation')->insert([
                        'invoice_number' => $data->invoice_number,
                        'invoice_date' => $data->invoice_date,
                        'po_number' => $data->po_id,
                        'po_date' => $data->order_date,
                        'supplier_name' => $supplier_name,
                        'supplier_id' => $supplier_id,
                        'created_at' => Carbon::now()
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Invoice sent successfully',
                        'supplier_id' => $supplier_id,
                        'supplier_name' => $supplier_name,
                        ''

                    ]);

                }

                public function ViewInvoice(Request $request){
                    $id = $request->input('id');

                    $po_details = DB::table('p_o_s')->where('po_id',$id)->first();
                    $items = DB::table('item_lists')->where('order_id', $id)->get();
                    $invoice = DB::table('invoices_controllers')->where('po_id', $id)->first();

                    $supplier_id = $po_details->supplier_id;

                    $supplier_details = DB::table('suppliers')->where('id',$supplier_id)->first();

                    return response()->json([
                        'success' => true,
                        'po_details' => $po_details,
                        'items' => $items,
                        'invoice' => $invoice,
                        'supplier' => $supplier_details
                    ]);
                }



                public function GenerateInvoice(Request $request){
                    $po_id = $request->input('id');
                    $po_data = DB::table('p_o_s')->where('po_id',$po_id)->first();
                    DB::table('invoices_controllers')->insert([
                        "po_id" => $po_data->po_id,
                        "supplier_id" => $po_data->supplier_id,
                        "order_date" => $po_data->order_date,
                        "delivery_date" => $po_data->delivery_date,
                        "payment_terms" => $po_data->payment_terms,
                        "lead_time" => $po_data->lead_time,
                        "delivery_address" => $po_data->delivery_address,
                        "delivery_city" => $po_data->delivery_city,
                        "delivery_state" => $po_data->delivery_state,
                        "delivery_pincode" => $po_data->delivery_pincode,
                        "billing_address" => $po_data->billing_address,
                        "billing_city" => $po_data->billing_city,
                        "billing_state" => $po_data->billing_state,
                        "billing_pincode" => $po_data->billing_pincode,
                        "total_unit" => $po_data->total_unit,
                        "total_qty" =>  $po_data->total_qty,
                        "line_amount_total" =>  $po_data->line_amount_total,
                        "comments" => $po_data->comments,
                        'invoice_number' => 'INV_'.uniqid(),
                        'invoice_date' => Carbon::now(),
                        'created_at' => Carbon::now()
                    ]);

                    DB::table('p_o_s')->where('po_id',$po_id)->update([
                        'invoice_status' => 1
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Invoice Created Successfully'
                    ]);
                }




              
                public function SaveItems(Request $request)
                {
                
                    // If validation passes, proceed with processing the data
                    try {
                        // Retrieve JSON data from the request
                        $jsonData = $request->json()->all();
                        
                
                        // Iterate over each data item and create records in the database
                        foreach ($jsonData as $data) {
                            foreach($data as $processData){
                            ItemLists::create([
                                'order_id' => $processData['PO Number'],
                                'part_number' => $processData['Item Code'],
                                'vehicle' => $processData['Vehicle'],
                                'part_name' => $processData['Item Name'],
                                'unit_price' => $processData['Unitprice'],
                                'quantity' => $processData['Quantity'],
                                'total_price' => $processData['Total Price'],
                                'category' => $processData['Category'],
                                // 'pr_num' => $processData['PR Number'],
                                // 'item_type' => $processData['Type'],
                                // 'item_des' => $processData['Item Description'],
                                // 'item_feature' => $processData['Feature'],
                            ]);
                        }
                        }
                
                        // Return a success response
                        return response()->json([
                            'success' => true,
                            'message' => 'Data processed successfully',
                            'data' => $processData,
                        ]);
                    } catch (\Exception $e) {
                        // Return a response with an error message if an exception occurs
                        return response()->json([
                            'success' => false,
                            'message' => 'An error occurred while processing the data',
                            'error' => $e->getMessage(),
                        ], 500);
                    }
                }




                public function SaveItemsPR(Request $request)
                {
                
                    // If validation passes, proceed with processing the data
                    try {
                        // Retrieve JSON data from the request
                        $jsonData = $request->json()->all();
                        
                
                        // Iterate over each data item and create records in the database
                        foreach ($jsonData as $data) {
                            foreach($data as $processData){
                            ItemLists::create([
                                // 'order_id' => $processData['PO Number'],
                                // 'part_number' => $processData['Item Code'],
                                // 'vehicle' => $processData['Vehicle'],
                                // 'part_name' => $processData['Item Name'],
                                // 'unit_price' => $processData['Unitprice'],
                                'quantity' => $processData['Quantity'],
                                // 'total_price' => $processData['Total Price'],
                                // 'category' => $processData['Category'],
                                'pr_num' => $processData['PR Number'],
                                'item_type' => $processData['Type'],
                                'item_des' => $processData['Item Description'],
                                'item_feature' => $processData['Feature'],
                            ]);
                        }
                        }
                
                        // Return a success response
                        return response()->json([
                            'success' => true,
                            'message' => 'Data processed successfully',
                            'data' => $processData,
                        ]);
                    } catch (\Exception $e) {
                        // Return a response with an error message if an exception occurs
                        return response()->json([
                            'success' => false,
                            'message' => 'An error occurred while processing the data',
                            'error' => $e->getMessage(),
                        ], 500);
                    }
                }
                


        public function POEdit($encryptedId){
            $id = decrypt($encryptedId);
            $po= PO::findOrFail($id);
            $suppliers = supplier::all();
            return view("supply.procurement.po.edit_update.po_update",compact("po",'suppliers'));
        }



        // Update Supplier
    public function POUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "supplier_id"=> "required",
                "order_date"=> "required",
                "delivery_date"=> "required",
                "total_amount"=> "required",
                "status"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                PO::where('id',$id)->update([
                    "supplier_id"=> $request->supplier_id,
                    "order_date"=> $request->order_date,
                    "delivery_date"=> $request->delivery_date,
                    "total_amount"=> $request->total_amount,
                    "status"=> $request->status,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('purchase-order')->with('success', 'updated successfully!');
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
    public function PODelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $po = PO::findOrFail($id);

            // Delete the supplier
            $po->delete();

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
