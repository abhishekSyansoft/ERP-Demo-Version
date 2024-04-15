<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\OrderHeader;
use App\Models\OrderItem;
use App\Models\Products;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Storage;

class OrderHeaderController extends Controller
{
    public function OrderHeader(){
        $orderheader = OrderHeader::join('dealers', 'dealers.id', '=', 'order_headers.dealer_id')
              ->select(['dealers.dealership_name as dealername', 'order_headers.*'])->paginate(10);
        // $orderheader = OrderHeader::get();
        return view("order-header",compact("orderheader"));
    }

    public function OrderHeaderAdd(){
        $dealers = Dealer::get();
        return view("order.add_order_header", compact("dealers"));
    }

    public function DeleteOrderHeader($id){
        $orderheader = OrderHeader::findOrFail( $id );
        $orderitem = OrderItem::where('order_id', $id)->get();
        $oldAttachments = $orderheader->attachments;

        foreach($orderitem as $item){

                $quantity = $item->quantity;
                $id = $item->product_id;
                $products = Products::where('id', $id)->first();

                // print_r( $products->product_quantity.'</br>' );
                $overall_stock = $products->product_quantity;
                $current_stock = $quantity + $overall_stock;
    
                // echo '</br></br></br></br>Quantity = '.$quantity.' </br>last stock = '.$overall_stock.'</br> updated Stock = '. $current_stock;
                // echo '</br>Product_id'.$id;
    
                Products::where('id', $id)->update([
                    'product_quantity'=> $current_stock,
                ]);
                $item->delete();

        }

        // Delete the old attachments file from storage
        // Storage::disk('public')->delete($oldAttachments);
        $orderheader->delete();
        return redirect()->back()->with("delete","Order deleted successfully");
    }

    public function StoreOrderHeader(Request $request)
    {
        try {
            // Validate the incoming request data
            $validateData = $request->validate([
                "dealer" => "required",
                // "order_date" => "required",
                "order_status" => "required",
                // "total_amount" => "required",
                "representative" => "required",
                "shipping_address" => "required",
                "billing_address" => "required",
                "payment_method" => "required",
                "payment_status" => "required",
                "shipping_method" => "required",
                "shipping_carrier" => "required",
                "shipping_tracking_number" => "required",
                "expected_delivery_date" => "required",
                "order_source" => "required",
                "priority" => "required",
            ]);
                if($request->attachments){
            // $dataImage = $request->image;
                $attachments = $request->file('attachments');
                $attachmentsdata = $attachments->getContent();
                $name_gen = hexdec(uniqid());
                $attachments_ext = strtolower($attachments->getClientOriginalExtension());
                $attachments_name = $name_gen .'.'. $attachments_ext;
                $uplocation = 'attachments/order_header/';
                $last_attachments = $uplocation . $attachments_name;

                Storage::disk('public')->put($last_attachments,$attachmentsdata);
                }
            // Insert the order header into the database
            $orderHeader = OrderHeader::create([
                'order_id' => $request->order_id,
                'dealer_id' => $request->dealer,
                'order_date' => Carbon::now(),
                'order_status' => $request->order_status,
                'sales_representative' => $request->representative,
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_status,
                'sipping_method' => $request->shipping_method,
                'shipping_carrier' => $request->shipping_carrier,
                'shipping_tracking_number' => $request->shipping_tracking_number,
                'expected_delivery_date' => $request->expected_delivery_date,
                'order_notes' => $request->order_notes,
                'order_source' => $request->order_source,
                'priority' => $request->priority,
                'return_rma' => $request->return_rma,
                'comments' => $request->comments,
                'attachments' => $last_attachments,
                'created_at' => Carbon::now()
            ]);
            
    
            return response()->json([
                'success' => true, 
                'message' => 'Order created successfully',
            ], 200);        } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
        }
    }

    public function EditOrderHeader($id){
        $header = OrderHeader::find($id);
        $order_id = $header->order_id;
        $order_items = OrderItem::where('order_id', $order_id)->get();
        $dealers = Dealer::get();
        return view('order.edit_order_header', compact('header','dealers','order_items'));
    }

    public function UpdateOrderHeader(Request $request,$id)
    {
        try {
            // Validate the incoming request data
            $validateData = $request->validate([
                "dealer" => "required",
                "order_date" => "required",
                "order_status" => "required",
                "total_amount" => "required",
                "representative" => "required",
                "shipping_address" => "required",
                "billing_address" => "required",
                "payment_method" => "required",
                "payment_status" => "required",
                "shipping_method" => "required",
                "shipping_carrier" => "required",
                "shipping_tracking_number" => "required",
                "expected_delivery_date" => "required",
                "order_notes" => "required",
                "order_source" => "required",
                "item_count" => "required",
                "priority" => "required",
                "discount" => "required",
                "order_total" => "required",
                "return_rma" => "required",
                "comments" => "required",
                "attachments" => "file"
            ]);

                // $dataImage = $request->image;
                $attachments = $request->file('attachments');
                $attachmentsdata = $attachments->getContent();
                $name_gen = hexdec(uniqid());
                $attachments_ext = strtolower($attachments->getClientOriginalExtension());
                $attachments_name = $name_gen .'.'. $attachments_ext;
                $uplocation = 'attachments/order_header/';
                $last_attachments = $uplocation . $attachments_name;

                Storage::disk('public')->put($last_attachments,$attachmentsdata);

            // Insert or update the order header in the database
            $orderHeader = OrderHeader::find($id)->update(            [
                    'dealer_id' => $request->dealer,
                    'order_date' => $request->order_date,
                    'order_status' => $request->order_status,
                    'total_amount' => $request->total_amount,
                    'sales_representative' => $request->representative,
                    'shipping_address' => $request->shipping_address,
                    'billing_address' => $request->billing_address,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $request->payment_status,
                    'sipping_method' => $request->shipping_method,
                    'shipping_carrier' => $request->shipping_carrier,
                    'shipping_tracking_number' => $request->shipping_tracking_number,
                    'expected_delivery_date' => $request->expected_delivery_date,
                    'order_notes' => $request->order_notes,
                    'order_source' => $request->order_source,
                    'item_count' => $request->item_count,
                    'priority' => $request->priority,
                    'discount' => $request->discount,
                    'order_total' => $request->order_total,
                    'return_rma' => $request->return_rma,
                    'comments' => $request->comments,
                    'attachments' => $last_attachments,
                    'created_at' => Carbon::now()
                ]
            );

            // Redirect with success message
            return redirect()->route('order-header')->with('success', 'Order header ' . ($request->id ? 'updated' : 'created') . ' successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            return redirect()->back()->with('error', 'An error occurred while ' . ($request->id ? 'updating' : 'creating') . ' the order header: ' . $e->getMessage());
        }
    }

    public function UploadOrderHeader(Request $request){
        $validateData = $request->validate([
            'file'=> 'required|file|mimes:csv,txt,xlsx',
        ],[
            'file.required'=> 'Select file to upload data in bulk',
            'file.mimes'=> 'Please select a valid file format',
        ]);


        // Read the uploaded file
        $file = $request->file('file');
        $extension = $file->extension();
    
        // Begin transaction
        DB::beginTransaction();
    
        try {
                if ($extension == 'csv' || $extension == 'txt') {
                    $fileData = file($file->getRealPath());
                } elseif ($extension == 'xlsx') {
                    $fileData = Excel::toArray(new \stdClass(), $file);
                    $fileData = $fileData[0]; // Assuming the first sheet contains data
                } else {
                    // Handle unsupported file types
                    throw new \Exception("Unsupported file type: $extension");
                }
        
                // Skip the first line
                array_shift($fileData);
        
                foreach ($fileData as $line) {
                    // Process each row of the file
                    
                    // If it's an Excel file, $line is an array containing column values
                    // If it's TXT or CSV, explode the line based on the delimiter
                    $data = ($extension == 'xlsx') ? $line : (($extension == 'txt') ? explode("\t", $line) : explode(',', $line));
    
                    $dealer_name = $data[0];
                    $result = DB::table('dealers')->where('dealership_name', $dealer_name)->value('id');
        
                    if ($data[0] != null) {
                        $data[0] = $result;
                    } else {
                        $data[0] = 0;
                    }


                $orderDate = $data[1];
                $formattedDate = Carbon::createFromFormat('n/j/Y', $orderDate)->format('Y-m-d');

                $expected_delivery_date = $data[12];
                $formattedDate1 = Carbon::createFromFormat('n/j/Y', $expected_delivery_date)->format('Y-m-d');


                // echo '</br>dealer = '.$data[0];
                // echo '</br>order_date = '.$data[1];
                // echo '</br>order_status = '.$data[2];
                // // echo '</br>order_date = '.$request->order_date;
                // echo '</br>total_amount = '.$data[3];
                // echo '</br>sales_representative = '.$data[4];
                // echo '</br>shipping_address = '.$data[5];
                // echo '</br>billing_address = '.$data[6];
                // echo '</br>payment_method = '.$data[7];
                // echo '</br>payment_status = '.$data[8];
                // echo '</br>shipping_method = '.$data[9];
                // echo '</br>shiping_carrier = '.$data[10];
                // echo '</br>shipping_tracking_number = '.$data[11];
                // echo '</br>expected_delivery_date = '.$data[12];
                // echo '</br>order_notes = '.$data[13];
                // echo '</br>order_source = '.$data[14];
                // echo '</br>item_count = '.$data[15];
                // echo '</br>priority = '.$data[16];
                // echo '</br>discount/promotions = '.$data[17];
                // echo '</br>order_total = '.$data[18];
                // echo '</br>return/rma = '.$data[19];
                // echo '</br>comments = '.$data[20];
                // echo '</br>attachments = '.$data[21];
                // echo '</br></br></br></br></br></br>';
    
                OrderHeader::insert([
                    'dealer_id' => trim($data[0]),
                    'order_date' => trim($formattedDate),
                    'order_status' => trim($data[2]),
                    'total_amount' => trim($data[3]),
                    'sales_representative' => trim($data[4]),
                    'shipping_address' => trim($data[5]),
                    'billing_address' => trim($data[6]),
                    'payment_method' => trim($data[7]),
                    'payment_status' => trim($data[8]),
                    'sipping_method' => trim($data[9]),
                    'shipping_carrier' => trim($data[10]),
                    'shipping_tracking_number' => trim($data[11]),
                    'expected_delivery_date' => trim($formattedDate1),
                    'order_notes' => trim($data[13]),
                    'order_source' => trim($data[14]),
                    'item_count' => trim($data[15]),
                    'priority' => trim($data[16]),
                    'discount' => trim($data[17]),
                    'order_totoal' => trim($data[18]),
                    'return_rma' => trim($data[19]),
                    'comments' => trim($data[20]),
                    'attachments' => trim($data[21]),
                    'created_at' => Carbon::now()
                ]);
            }
    
            // Commit transaction
            DB::commit();
    
            return redirect()->route('order-header')->with('success', 'Order Headers has been successfully added in bulk.');
        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollback();
    
            return redirect()->back()->with('error', 'Error uploading data: ' . $e->getMessage());
        }


    }


}
