<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\OrderItem;
use App\Models\OrderHeader;
use App\Models\Dealer;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Validator;


class OrderItemController extends Controller
{
    public function OrderItem(){
        return view("order-items");
    }

    public function flushOrderId(Request $request)
    {
        $request->session()->forget('order_id');
        return response()->json(['success' => true, 'message' => 'Order ID flushed successfully']);
    }
    

    public function EditItems(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'order_id' => 'required', // Validate that the order ID exists in the orders table
        ]);

        // Fetch items based on the requested order ID
        $orderID = $request->input('order_id');
        $previewItems = OrderItem::where('order_id', $orderID)->get();
        $previewHeaders = OrderHeader::where('order_id', $orderID)->get();
        $data = [
            'previewitems' => $previewItems,
            'previewheaders' => $previewHeaders,
        ];

        // Return the combined data as JSON response
        return response()->json($data);
    }

    public function previewItems(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'order_id' => 'required', // Validate that the order ID exists in the orders table
        ]);

        // Fetch items based on the requested order ID
        $orderID = $request->input('order_id');
        $previewItems = OrderItem::where('order_id', $orderID)->get();
        $previewHeaders = OrderHeader::where('order_id', $orderID)->get();
        $data = [
            'previewitems' => $previewItems,
            'previewheaders' => $previewHeaders,
        ];

        // Return the combined data as JSON response
        return response()->json($data);
    }

    public function AddOrderItem(){
        $orderheader = OrderHeader::join('dealers', 'dealers.id', '=', 'order_headers.dealer_id')
        ->select(['dealers.dealership_name as dealername', 'order_headers.*'])->paginate(10);
        $products = Products::get();
        $order_id = uniqid();
        $order_items = OrderItem::get();
        $dealers = Dealer::get();
        // OrderHeader::insert([
        //     'order_id'=> $order_id,
        // ]);


        return view("order_items.add_order_items",compact("products",'order_id','order_items','dealers','orderheader'));
    }

    public function fetchDealerDetails(Request $request){
        $dealer_id = $request->input('dealer_id');
    
        // Query the database to fetch details for the given dealer ID
        $dealerDetails = Products::findOrFail($dealer_id);
    
        // Return the details as JSON response
        return response()->json($dealerDetails);
    }


    public function fetchItemsDetails(Request $request){
       // Retrieve order items where order_id is 1
       $orderItems = OrderItem::where('order_id', $request->order_id)->get();
       $orderHeader = OrderHeader::where('order_id', $request->order_id)->get();
       return response()->json([
        'success' => true,
        'message' => 'Items Fetched Successfully',
        'orderItems' => $orderItems,
        'orderHeader' => $orderHeader,
    ], 200);

    }


    public function fetchOrderHeaderDetails()
    {
        $orderHeader = OrderHeader::where('id', 8)->first(); // Filter records by order ID = 1
        if ($orderHeader) {
            return response()->json([
'success'=> true,
'order_header'=> $orderHeader
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Order header not found for order ID 1',
            ], 404);
        }
    }



    public function StoreOrderItem(Request $request)
    {
        try {
            $validateData = $request->validate([
                'order_id' => 'required',
                'product_name' => 'required',
                'product_id' => 'required',
                'quantity' => 'required',
                'unitprice' => 'required',
                'total_price' => 'required',
                'sku' => 'required',
                'tax_rate' => 'required',
                'tax_amount' => 'required',
                'discount' => 'required',
                'sub_total' => 'required',
                // 'line_item_total' => 'required',
            ],[
                'quantity.required'=>'Please enter quantity'
            ]
        );
    
            $orderExists = OrderHeader::where('order_id', $request->order_id)->exists();

            if ($orderExists) {
                // Order exists, insert order item data
                OrderItem::insert([
                    'order_id' => $request->order_id,
                    'product_name' => $request->product_name,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'unit_price' => $request->unitprice,
                    'total_price' => $request->total_price,
                    'sku' => $request->sku,
                    'tax_rate' => $request->tax_rate,
                    'tax_amount' => $request->tax_amount,
                    'discount' => $request->discount,
                    'sub_total' => $request->sub_total,
                    'created_at' => Carbon::now()
                ]);
            } 

                // Calculate totals
                $totalDiscount = OrderItem::where('order_id', $request->order_id)->sum('discount');
                $totalTax =  OrderItem::where('order_id', $request->order_id)->sum('tax_amount');
                $subTotal =  OrderItem::where('order_id', $request->order_id)->sum('total_price');
                $totalAmount =  OrderItem::where('order_id', $request->order_id)->sum('sub_total');
                $totalQuantity =  OrderItem::where('order_id', $request->order_id)->count();

                // Update OrderHeader
                OrderHeader::where('order_id', $request->order_id)->update([
                    'discount' => $totalDiscount,
                    'order_totoal'=>$subTotal,
                    'total_amount' => $totalAmount,
                    'item_count' => $totalQuantity,
                    'order_date' => Carbon::now(),
                    'created_at'=> Carbon::now()
                ]);

               $product =  Products::where('id', $request->product_id)->first();
               $product_quantity = $product->product_quantity;

            //    echo 'product_quantity'.$product_quantity;

               $current_stock = $product_quantity - $request->quantity;
            //    echo 'Current Stock'.$current_stock;

               Products::where('id', $request->product_id)->update([
                'product_quantity'=> $current_stock,
               ]);

               $orderItem = OrderItem::where('order_id', $request->order_id)->get();
               $orderHeader = Orderheader::where('order_id', $request->order_id)->get();

               return response()->json([
                'success'=>true,
                'message' => 'Order item added successfully',
                'orderItems' => $orderItem,
                'order_header'=>$orderHeader
            ], 200);
            } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            return redirect()->back()->with('error', 'An error occurred while adding the order item: ' . $e->getMessage());
        }
    }


    public function EditOrderItems($id){

        $items = OrderItem::where('id',$id)->first();

        return response()->json(['item' => $items]);
    }





    public function UpdateItems(Request $request)
    {
        try {
            $validateData = $request->validate([
                'update_order_id' => 'required',
                'update_product_name' => 'required',
                'update_product_id' => 'required',
                'update_quantity' => 'required',
                'update_unitprice' => 'required',
                'update_total_price' => 'required',
                'update_sku' => 'required',
                'update_tax_rate' => 'required',
                'update_tax_amount' => 'required',
                'update_discount' => 'required',
                'update_sub_total' => 'required',
                // 'line_item_total' => 'required',
            ]);
    
                // Order exists, insert order item data
                OrderItem::insert([
                    'order_id' => $request->update_order_id,
                    'product_name' => $request->update_product_name,
                    'product_id' => $request->update_product_id,
                    'quantity' => $request->update_quantity,
                    'unit_price' => $request->update_unitprice,
                    'total_price' => $request->update_total_price,
                    'sku' => $request->update_sku,
                    'tax_rate' => $request->update_tax_rate,
                    'tax_amount' => $request->update_tax_amount,
                    'discount' => $request->update_discount,
                    'sub_total' => $request->update_sub_total,
                    'created_at' => Carbon::now()
                ]);

                // Calculate totals
                $totalDiscount = OrderItem::where('order_id', $request->update_order_id)->sum('discount');
                $totalTax =  OrderItem::where('order_id', $request->update_order_id)->sum('tax_amount');
                $subTotal =  OrderItem::where('order_id', $request->update_order_id)->sum('total_price');
                $totalAmount =  OrderItem::where('order_id', $request->update_order_id)->sum('sub_total');
                $totalQuantity =  OrderItem::where('order_id', $request->update_order_id)->count();

                // Update OrderHeader
                OrderHeader::where('order_id', $request->update_order_id)->update([
                    'discount' => $totalDiscount,
                    'total_amount' => $totalAmount,
                    'order_totoal'=>$subTotal,
                    'item_count' => $totalQuantity,
                    'order_date' => Carbon::now(),
                    'created_at'=> Carbon::now()
                ]);

               $product =  Products::where('id', $request->update_product_id)->first();
               $product_quantity = $product->product_quantity;

            //    echo 'product_quantity'.$product_quantity;

               $current_stock = $product_quantity - $request->quantity;
            //    echo 'Current Stock'.$current_stock;

               Products::where('id', $request->update_product_id)->update([
                'product_quantity'=> $current_stock,
               ]);

               $orderItem = OrderItem::where('order_id', $request->update_order_id)->get();
               $orderHeader = Orderheader::where('order_id', $request->update_order_id)->get();


               return response()->json([
                'success'=>true,
                'message' => 'Order item added successfully',
                'orderItems' => $orderItem,
                'order_header'=>$orderHeader
            ], 200);
            } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            return redirect()->back()->with('error', 'An error occurred while adding the order item: ' . $e->getMessage());
        }
    }


public function UpdateEditOrderItems(Request $request,$id){
    $validateData = $request->validate([
        'update_edit_order_id' => 'required',
        'update_edit_product_name' => 'required',
        'update_edit_product_id' => 'required',
        'update_edit_quantity' => 'required',
        'update_edit_unitprice' => 'required',
        'update_edit_total_price' => 'required',
        'update_edit_sku' => 'required',
        'update_edit_tax_rate' => 'required',
        'update_edit_tax_amount' => 'required',
        'update_edit_hit_discount' => 'required',
        'update_edit_sub_total' => 'required',
        // 'line_item_total' => 'required',
    ],[
        'update_edit_order_id.required' => 'Invalid Order',
        'update_edit_product_name.required' => 'Please select a valid product. Product field seems to be missing',
        'update_edit_product_id.required' => 'Please select a valid product. Product field seems to be missing',
        'update_edit_quantity.required' => 'Please select a valid quantity for product. Product quantity not less then 1 or missing',
        'update_edit_unitprice.required' => 'Why unit price missing dont clear the unitprice field',
        'update_edit_total_price.required' => 'Field is auto generated dont try to clear this section',
        'update_edit_sku.required' => 'Sku will be fetched no need to clear this section',
        'update_edit_tax_rate.required' => 'Tax rate will also be auto fetched',
        'update_edit_tax_amount.required' => 'Tax calculation will be autogenerated according to the tax rate mention in the product list',
        'update_edit_hit_discount.required' => 'Please enter discount else set it to 0',
        'update_edit_sub_total.required' => 'Sub total will be auto genearate by system',
    ]
);


    $orderItem = OrderItem::where('id',$id)->update([

        'product_name' => $request->update_edit_product_name,
        'product_id' => $request->update_edit_product_id,
        'quantity' => $request->update_edit_quantity,
        'unit_price' => $request->update_edit_unitprice,
        'total_price' => $request->update_edit_total_price,
        'sku' => $request->update_edit_sku,
        'tax_rate' => $request->update_edit_tax_rate,
        'tax_amount' => $request->update_edit_tax_amount,
        'discount' => $request->update_edit_hit_discount,
        'sub_total' => $request->update_edit_sub_total,

    ]);

     // Calculate totals
     $totalDiscount = OrderItem::where('order_id', $request->update_edit_order_id)->sum('discount');
     $totalTax =  OrderItem::where('order_id', $request->update_edit_order_id)->sum('tax_amount');
     $subTotal =  OrderItem::where('order_id', $request->update_edit_order_id)->sum('total_price');
     $totalAmount =  OrderItem::where('order_id', $request->update_edit_order_id)->sum('sub_total');
     $totalQuantity =  OrderItem::where('order_id', $request->update_edit_order_id)->count();

     // Update OrderHeader
     OrderHeader::where('order_id', $request->update_edit_order_id)->update([
         'discount' => $totalDiscount,
         'total_amount' => $totalAmount,
         'order_totoal'=>$subTotal,
         'item_count' => $totalQuantity,
        //  'order_date' => Carbon::now(),
        //  'created_at'=> Carbon::now()
     ]);

     $data1 =  OrderHeader::where('order_id',$request->update_edit_order_id)->get();
     $data = OrderItem::where('order_id',$request->update_edit_order_id)->get();



    return response()->json([
        'success'=>true,
        'message'=>'Order Item Updated successfully',
        'data' => $data,
        'data1'=> $data1
    ]);
} 


    public function DeteletOrderItems($id){
        $orderItems = OrderItem::findOrFail($id);
        $Item_name = $orderItems->product_name;
        $order_id = $orderItems->order_id;
        $product_id = $orderItems->product_id;
        $product_quantity = $orderItems->quantity;
        $orderItems->delete();

        $product =  Products::where('id', $product_id)->first();
        $overall_quantity = $product->product_quantity;

        // echo 'product_quantity'.$product_quantity;

        $current_stock = $overall_quantity + $product_quantity;
        // echo 'Current Stock'.$current_stock;

        Products::where('id', $product_id)->update([
         'product_quantity'=> $current_stock,
        ]);


           // Calculate totals
           $totalDiscount = OrderItem::where('order_id', $order_id)->sum('discount');
           $totalTax =  OrderItem::where('order_id', $order_id)->sum('tax_amount');
           $subTotal =  OrderItem::where('order_id', $order_id)->sum('total_price');
           $totalAmount =  OrderItem::where('order_id', $order_id)->sum('sub_total');
           $totalQuantity =  OrderItem::where('order_id', $order_id)->count();

        // Update OrderHeader
        OrderHeader::where('order_id', $order_id)->update([
            'sales_representative'=> Auth::user()->name,
            'discount' => $totalDiscount,
            'total_amount' => $totalAmount,
            'item_count' => $totalQuantity,
            'order_status'=> 1,
            'order_totoal'=>$subTotal,
            'payment_status'=> 2,
            'order_date' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        $orderItem = OrderItem::where('order_id', $order_id)->get();
        $orderHeader = OrderHeader::where('order_id', $order_id)->get();


        // echo $totalDiscount.'</br>';
        // echo $subTotal.'</br>';
        // echo $totalAmount.'</br>';
        
        return response()->json([
            'success'=>true,
            'message' => $Item_name.'Order deleted successfully',
            'orderItems' => $orderItem,
            'order_header'=>$orderHeader,
            'discount'=> $totalDiscount,
            'totalAmount'=> $totalAmount,
            'totalQuantity'=> $totalQuantity

        ], 200);
    }
    
}
