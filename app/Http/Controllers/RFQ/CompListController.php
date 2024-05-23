<?php

namespace App\Http\Controllers\RFQ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RFQ\CompList;
use App\Models\Procurement\ItemLists;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Auth;

class CompListController extends Controller
{
    public function CSRF(){
        $rfq = DB::table('rfq_supplier_lists')
        ->where('rfq_supplier_lists.user_id' , '=' , Auth::user()->id)
        ->get(['rfq_supplier_lists.*']);

        // $rfq = DB::table('comp_lists')
        // ->join('quotations', 'comp_lists.rfq_num', '=', 'quotations.rfq_num')
        // ->where('quotations.user_id', '=', Auth::user()->id)
        // ->get(['quotations.qut_num as quotation_number', 'quotations.status as qut_status', 'comp_lists.rfq_num as rfq_number', 'comp_lists.pr_num as pr_number']);

        return view('supply.RFQ.completeList.comp_list',compact('rfq'));
    }

    public function ItemNames(Request $request){
        $pr_num = $request->input('id');

        $items = ItemLists::where('pr_num',$pr_num)->get();

        return response()->json([
            'success' => true,
            'items' => $items
        ]);
    }

    public function ItemAllDetails(Request $request){
            $id = $request->input('id');

            $details = ItemLists::where('id',$id)->first();

            return response()->json([
                'success' => true,
                'details' => $details
            ]);
    }

    public function SaveQUTItem(Request $request){
        // If validation passes, proceed with processing the data
       
            // Retrieve JSON data from the request
            $jsonData = $request->json()->all();
            

            // Iterate over each data item and create records in the database
            foreach ($jsonData as $data) {
                foreach($data as $processData){
                    // // Insert the validated data into the pr_supplier_lists table
                    DB::table('qut_item_lists')->insert([
                        'pr_num' => $processData['PR Number'],
                        'rfq_num' => $processData['RFQ Number'],
                        'qut_num' => $processData['QUT Number'],
                        'item_name' => $processData['Item Name'],
                        'quantity' => $processData['Quantity'],
                        'features' => $processData['Feature'],
                        'unitprice' => $processData['Unitprice'],
                        'total' => $processData['Amount'],
                        'created_at' => Carbon::now(),
                    ]);
                }
            }

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Data processed successfully',
                'data' => $jsonData,
            ]);
        
    }



    public function SendQuot(Request $request) {
        try {
            // Retrieve the quotation number from the request
            $qut_num = $request->input('id');
    
            // Update the send_status in the rfq_supplier_lists table
            DB::table('rfq_supplier_lists')
                ->where('qut_num', $qut_num)
                ->update([
                    'send_status' => 1
                ]);
    
            // Retrieve details from rfq_supplier_lists table for the given qut_num
            $details = DB::table('rfq_supplier_lists')
                ->where('qut_num', $qut_num)
                ->first();
    
            // Check if details were found
            if (!$details) {
                return response()->json([
                    'success' => false,
                    'message' => 'Details not found'
                ], 404);
            }
    
            // Extract pr_num and rfq_num from the details
            $pr_num = $details->pr_num;
            $rfq_num = $details->rfq_num;
    
            // Insert a new record into the s_q_n_s table
            DB::table('s_q_n_s')->insert([
                'qut_num' => $qut_num,
                'pr_num' => $pr_num,
                'rfq_num' => $rfq_num,
                'created_at' => Carbon::now()
            ]);
    
            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Quotation sent successfully'
            ]);
        } catch (\Exception $e) {
            // Handle exceptions and return a 500 response
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    


public function QuotAdd(Request $request){
    try {
        // Validate the incoming request data
        $validateData = $request->validate([
            'qut_num' =>  'required',
            'payment_terms' =>  'required',
            'lead_time' =>  'required',
            'qut_date' =>  'required',
        ]); 

         // Calculate the total amount
         $total_amount = DB::table('qut_item_lists')->where('qut_num', $request->qut_num)->sum('total');    

        // Insert the validated data into the CreateRFQ table
        DB::table('quotations')->insert([
            'rfq_num' => $request->rfq_num,
            'pr_num' => $request->pr_num,
            'qut_num' => $request->qut_num,
            'payment_terms' => $request->payment_terms,
            'lead_time' => $request->lead_time,
            'qut_date' => $request->qut_date,
            'total_amount' => $total_amount,
            'status' => 1,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);


        DB::table('rfq_supplier_lists')
            ->where('rfq_num', $request->rfq_num)
            ->where('user_id', Auth::user()->id)
            ->update([
                'qut_num' => $request->qut_num,
                'qut_status' => 1,
            ]);

        return response()->json([
            'success' => true,
            'data' => $request->all()
        ]);

    }catch (ValidationException $e) {
        // Return a response with validation errors if validation fails
        return response()->json([
            'success' => false,
            'message' => 'Oops! Some fields are missing',
            'errors' => $e->validator->errors()->messages()
        ], 422); // Return with a status code of 422 for validation errors
} catch (\Exception $e) {
        // Log the error or handle it in any other appropriate way
        return redirect()->back()->with('error', 'Failed to create RFQ: ' . $e->getMessage());
    }
}



public function QUTDetails(Request $request){
    $qut_num = $request->input('id');

    $quotation_details = DB::table('quotations')->where('qut_num',$qut_num)->first();
    // $pr_num = $quotation_details->pr_num;

    $Items = DB::table('qut_item_lists')->where('qut_num',$qut_num)->get();

    $supplier = DB::table('rfq_supplier_lists')->where('qut_num',$qut_num)->get();

    

    return response()->json([
        'success' => true,
        'qut_details' => $quotation_details,
        'items' => $Items,
        'suppliers' => $supplier
    ],200);
}

}
