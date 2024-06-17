<?php

namespace App\Http\Controllers\BOM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BOM\MainAssembly;
use Carbon\Carbon;
use App\Models\OrderHeader;
use DB;

class MainAssemblyController extends Controller
{
    public function BikeParts(){
            $categories = MainAssembly::where('parent_id', 0)->get();
            return view('supply.BOM.main_assembly.main_assembly',compact('categories'));
    }

    
    public function Validation(){
        try {

            // Retrieve all resources from the database
            $grn = DB::table('invoice_validation')->get();
            // $orders = OrderHeader::all();

            // Return the view with the list of suppliers
            return view("supply.payment.validation.invoice_validation",compact("grn"));
        } catch (\Exception $e) {
            // Log the error or handle it in any other appropriate way
            // For example, you can return an error view or redirect with an error message
            return view("error")->with("error", "Failed to fetch resources: ".$e->getMessage());
        }
        
    }


    public function RejectInvoiceValidation(Request $request){
        $inv_num = $request->input('id');

        DB::table('invoice_validation')->update([
            'rejected' => 1
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Invoice Validation failed and not approed by the approvar'
        ]);
    }

    public function ApproveInvoiceValidation(Request $request){
        $inv_num = $request->input('id');


        $data =  DB::table('invoice_validation')->where('invoice_number', $inv_num)->first();

        DB::table('invoice_validation')->where('invoice_number', $inv_num)->update([
            'approved' => 1
        ]);

        DB::table('payment')->insert([
            'invoice_number' => $data->invoice_number,
            'invoice_date' => $data->invoice_date,
            'po_number' => $data->po_number,
            'po_date' => $data->po_date,
            'supplier_name' => $data->supplier_name,
            'supplier_id' => $data->supplier_id,
            'created_at' => Carbon::now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Invoice Validation Success and approed by the approvar'
        ]);
    }
    

    
    public function SupplierProfile(){
        try {

            // Retrieve all resources from the database
            $suppliers = DB::table('suppliers')->get();
            $orders = OrderHeader::all();

            // Return the view with the list of suppliers
            return view("supply.payment.supplier.supplier",compact("suppliers"));
        } catch (\Exception $e) {
            // Log the error or handle it in any other appropriate way
            // For example, you can return an error view or redirect with an error message
            return view("error")->with("error", "Failed to fetch resources: ".$e->getMessage());
        }
    }
    

    
    public function Initiate(){
        try {

            // Retrieve all resources from the database
            $grn = DB::table('payment')->get();
           

            // Return the view with the list of suppliers
            return view("supply.payment.initiation.initiate_payment",compact("grn"));
        } catch (\Exception $e) {
            // Log the error or handle it in any other appropriate way
            // For example, you can return an error view or redirect with an error message
            return view("error")->with("error", "Failed to fetch resources: ".$e->getMessage());
        }
    }

    public function TrackingPayment(){
        try {

            // Retrieve all resources from the database
            $grn = DB::table('g_r_n_s')
            ->join('order_headers', 'order_headers.id', '=', 'g_r_n_s.po_id')
            ->select('g_r_n_s.*', 'order_headers.order_id as order_number')
            ->get();
            $orders = OrderHeader::all();

            // Return the view with the list of suppliers
            return view("supply.payment.tracking.track",compact("grn",'orders'));
        } catch (\Exception $e) {
            // Log the error or handle it in any other appropriate way
            // For example, you can return an error view or redirect with an error message
            return view("error")->with("error", "Failed to fetch resources: ".$e->getMessage());
        }
    }
    

    public function AddPartCat(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
        ]);

        MainAssembly::insert([
            'parent_id' => 0,
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success','Added Successfully');

    }
}