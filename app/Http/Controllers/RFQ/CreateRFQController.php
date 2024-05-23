<?php

namespace App\Http\Controllers\RFQ;

use App\Http\Controllers\Controller;
use App\Models\RFQ\CompList;
use Illuminate\Http\Request;
use App\Models\RFQ\CreateRFQ;
use App\Models\Procurement\PR;
use App\Models\supplier\supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class CreateRFQController extends Controller
{
    public function CRFQ(){
        $prs = CreateRFQ::get();
        $suppliers = supplier::get();
        return view('supply.RFQ.createRFQ.create_rfq',compact('prs','suppliers'));
    }


    public function SaveSupplierData(Request $request){
          // If validation passes, proceed with processing the data
          try {
            // Retrieve JSON data from the request
            $jsonData = $request->json()->all();
            
    
            // Iterate over each data item and create records in the database
            foreach ($jsonData as $data) {
                foreach($data as $processData){
                    // // Insert the validated data into the pr_supplier_lists table
                    DB::table('rfq_supplier_lists')->insert([
                        'pr_num' => $processData['PR Number'],
                        'rfq_num' => $processData['RFQ Number'],
                        'supplier' => $processData['Supplier Name'],
                        'phone' => $processData['Phone Number'],
                        'email' => $processData['Email'],
                        'person' => $processData['Contact Person'],
                        'created_at' => now(),
                    ]);
                }
            }
    
            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Data processed successfully',
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


    public function FetchSupplierData(Request $request){
        $rfq = $request->input('id');
        $suppliers = DB::table('rfq_supplier_lists')->where('rfq_num',$rfq)->get();

        return response()->json([
            'success' => true,
            'suppliers' => $suppliers
        ]);
        
    }

    public function PRVisibility(Request $request){
        $rfq = $request->input('id');
        DB::table('rfq_supplier_lists')->where('rfq_num',$rfq)->update([
            'visibility_status' => 1
        ]);


        $data = CreateRFQ::where('rfq_num',$rfq)->first();

        $pr_num = $data->pr_num;
        $dos = $data->date;


        CompList::insert([
            'pr_num' => $pr_num,
            'rfq_num' => $rfq,
            'dos' => $dos,
            'created_at' => Carbon::now()
        ]);


        CreateRFQ::where('rfq_num',$rfq)->update([
            'status' => 1
        ]);


        return response()->json([
            'success' => true,
            'rfq' => $rfq
        ]);
    }


    public function CRFQAdd(Request $request) {
        try {
            // Validate the incoming request data
            $validateData = $request->validate([
                'rfq_num' => 'required',
                'dos' => 'required'
            ]); 
    
            // Insert the validated data into the CreateRFQ table
            CreateRFQ::where('pr_num',$request->pr_num)->update([
                'rfq_num' => $request->rfq_num,
                'date' => $request->dos,
                'rfq_status' => 1,
                'send' => 2
            ]);

            return response()->json([
                'success' => true
            ]);


        } catch (ValidationException $e) {
            // Return a response with validation errors if validation fails
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            // Log the error or handle it in any other appropriate way
            return redirect()->back()->with('error', 'Failed to create RFQ: ' . $e->getMessage());
        }
    }
    
}
