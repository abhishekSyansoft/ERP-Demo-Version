<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class EauctionController extends Controller
{
    public function EAuction(){
        $auction_lists = DB::table('auction_details')->get();
        $suppliers = DB::table('suppliers')->get();
        return view('ERP.Auction.Initiate.initiate_auction',compact('suppliers','auction_lists'));
    }

    public function FetchAuctionDetails(Request $request){
        $id = $request->input('id');


        $auction_supplier = DB::table('auction_suppliers')->where('auction_number',$id)->get();
        $auction_item = DB::table('auction_items')->where('auction_number',$id)->get();
        $auction_details = DB::table('auction_details')->where('auction_number',$id)->first();

        return response()->json([
            'success' => true,
            'auction_number' => $id,
            'auction_details' => $auction_details,
            'auction_item' => $auction_item,
            'auction_supplier' => $auction_supplier
        ]);
    }


    public function ScrapItems(){
        $scrapItems = DB::table('scrap')->orderBy('id','desc')->get();
        $parts = DB::table('parts')->get();
        // return view('ERP.Auction.Initiate.initiate_auction',compact('scrapItems'));
        return view('ERP.Auction.Initiate.scrap',compact('parts','scrapItems'));
    }


public function SaveAuctionItemRecord(Request $request){
    {
                
        // If validation passes, proceed with processing the data
        try {
            // Retrieve JSON data from the request
            $jsonData = $request->json()->all();
            
    
            // Iterate over each data item and create records in the database
            foreach($jsonData as $data) {
                foreach($data as $processData){
                    DB::table('auction_items')->insert([
                        'auction_number' => $processData['E-Auction Number'],
                        'item_desc' => $processData['E-Auction Item Description'],
                        'features' => $processData['Features'],
                        'quantity' => $processData['Quantity'],
                        'created_at' => Carbon::now()
                    ]);
                }
            }
    
            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Item Listed for auction',
                'data' => $jsonData,
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
}

 public function SaveAuctionSuppliersRecord(Request $request){
    {
                
        // If validation passes, proceed with processing the data
        try {
            // Retrieve JSON data from the request
            $jsonData = $request->json()->all();
            
    
            // Iterate over each data item and create records in the database
            foreach($jsonData as $data) {
                foreach($data as $processData){
                    DB::table('auction_suppliers')->insert([
                        'auction_number' => $processData['Auction Number'],
                        'supplier_name' => $processData['Supplier Name'],
                        'phone' => $processData['Phone Number'],
                        'email' => $processData['Email'],
                        'contact_person' => $processData['Contact Person'],
                        'aution_status' => 1,
                        'created_at' => Carbon::now()
                    ]);
                }
            }
    
            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Suppleirs seleted and auction detailes send to the suppliers',
                'data' => $jsonData,
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
}




    public function InitiateAuctionDetails(Request $request){
        $validateData = $request->validate([
            'auction_id' => 'required',
            'type' => 'required',
            'bid' => 'required',
            // 'start_price' => 'required',
            'doc' => 'required',
            'dos' => 'required'
        ]);

        if ($request->hasFile('image')) {
    
            // Upload the new image
            $image = $request->file('image');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $uplocation = 'images/auction/';
            $last_img = $uplocation . $img_name;
            $image->storeAs($uplocation, $img_name, 'public');
        }else{
            $last_img = "";
        }
    
        try {
            DB::table('auction_details')->insert([
                'auction_number' => $request->auction_id,
                'auction_type' => $request->type,
                'bidding_type' => $request->bid,
                'start_price' => $request->start_price,
                'notes' => $request->notes,
                'created_date' => $request->doc,
                'last_date_of_subbmission' => $request->dos,
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
    
            return redirect()->back()->with('message', 'Auction Created Successfully');
    
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Failed to create auction: ' . $e->getMessage());
    
            // Return an error message to the user
            return redirect()->back()->withErrors(['error' => 'Failed to create auction. Please try again later.']);
        }
    }
}
