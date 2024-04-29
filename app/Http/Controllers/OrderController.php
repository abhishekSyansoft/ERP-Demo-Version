<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderHeader;
use App\Models\Products;
use App\Models\Dealer;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function Order(){
        $dealers = Dealer::get();
        $products = Products::get();
        $order_id = uniqid().hexdec(uniqid());
        return view('order_test',compact('products','dealers','order_id'));
    }

    public function SaveTheseData(Request $request){


       $validateData = $request->json()->all();

        foreach ($validateData as $index => $data) {
            foreach($data as $processData){
                $orderId = $processData['order_id'];
                $sku = $processData['sku'];
                $productId = $processData['product_id'];
                $productName = $processData['product_name'];
                $unitprice = $processData['unit_price'];
                $quantity = $processData['quantity'];
                $total_price = $processData['total_price'];
                $tax_rate = $processData['tax_rate'];
                $tax_amount = $processData['tax_amount'];
                $discount = $processData['discount'];
                $sub_total = $processData['sub_total'];
                // Access other fields similarly
                OrderItem::create($processData);
            }
        }
        // Optionally, you can return a response
        return response()->json($validateData);
           
    }
}
