<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\ERP\GateEntryModel;
use App\Models\Inventory\Parts;
use Illuminate\Http\Request;
use App\Models\supplier\supplier;
use App\Models\Procurement\PO;
use App\Models\Procurement\ItemLists;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory\Allocation;
use Milon\Barcode\DNS1D;
use Picqer\Barcode\BarcodeGeneratorHTML;
// use Endroid\QrCode\QrCode;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Storage;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;
use Intervention\Image\ImageManagerStatic as Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Category;
use Illuminate\Validation\ValidationException;


class GateEntry extends Controller
{
    public function GateEntry(){
        $details = DB::table('gate_entry_models')
        ->join('suppliers', 'suppliers.supplier_id' ,'=', 'gate_entry_models.supplier')
        ->select(['gate_entry_models.*','suppliers.supplier_name'])
        ->get();
        $pos = PO::get();
        $suppliers = supplier::get();
        return view('ERP.Inventory.GateEntry.gateEntry',compact('pos','suppliers','details'));
    }

    
    public function RetAndRej(){
        $details = DB::table('gate_entry_models')
        ->join('suppliers', 'suppliers.supplier_id' ,'=', 'gate_entry_models.supplier')
        ->select(['gate_entry_models.*','suppliers.supplier_name'])
        ->get();
        $pos = PO::get();
        $suppliers = supplier::get();
        return view('ERP.Inventory.Ret&Rej.ret&rej',compact('pos','suppliers','details'));
    }

    public function INVControlPage(){
        $details = GateEntryModel::get();
        $pos = PO::get();
        $suppliers = supplier::get();
        return view('ERP.Inventory.INVControl.invControl',compact('pos','suppliers','details'));
    }


    public function SalesOrders(){
        $orders = DB::table('sales_orders')->get();
        $parts = Parts::get();
        return view('ERP.Inventory.salesOrders.salesOrders',compact('orders','parts'));
    }


    public function GetSalesItemDetails(Request $request){
        $po_id = $request->input('id');

        $order_items = ItemLists::where('order_id',$po_id)->get();

        return response()->json([
            'success' => true,
            'orderitems' => $order_items
        ]);
    }


    public function AuditReportFetch(Request $request){
        $inventory_id = $request->input('id');

        $data = DB::table('allocations')->where('inventory_id',$inventory_id)->first();

        $audit_date = $data->audit_date;
        $auditor = $data->auditor;
        $audit_file = $data->audit_file;

        return response()->json([
            'success' => true,
            'date' => $audit_date,
            'name' => $auditor,
            'file' => $audit_file
        ]);

    }


    public function AuditStore(Request $request){
        $validateData = $request->validate([
            'audit_date' => 'required|date',
            'auditor' => 'required',
            'status' => 'required',
            'files' => 'required'
        ]);

        $part = Allocation::where('inventory_id',$request->inventory_id)->first();
        $oldImage = $part->audit_file;
    
    
        if ($request->hasFile('files')) {
    
            // Upload the new image
            $image = $request->file('files');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $uplocation = 'images/parts/';
            $last_img = $uplocation . $img_name;
            $image->storeAs($uplocation, $img_name, 'public');
        }else{
            $last_img = "";
        }
        DB::table('allocations')->where('inventory_id',$request->inventory_id)->update([
            'audit_date' => $request->audit_date,
            'auditor' => $request->auditor,
            'audit_status' => $request->status,
            'audit_file' => $last_img

        ]);

        return redirect()->back()->with('message','Audit Report Submitted');
    }


    public function AuditCompliance(){
        $allocations = Allocation::get();
        $details = GateEntryModel::get();
        $parts = Parts::get();
        $pos = PO::get();
        $suppliers = supplier::get();
        return view('ERP.Inventory.Audit&Compliance.audit&compliance',compact('pos','suppliers','details','allocations','parts'));
    }



    public function SalesStore(Request $request){
        try{
        $validateData = $request->validate([
            'order_no' => 'required',
            'order_date' => 'required',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
        ]);


        $totalQuantity =  ItemLists::where('order_id', $request->order_no)->sum('quantity');
        $subTotal =  ItemLists::where('order_id', $request->order_no)->sum('total_price');
       //  $totalAmount =  ItemLists::where('order_id', $request->order_no)->sum('sub_total');
        $totalItem =  ItemLists::where('order_id', $request->order_no)->count();


        $tax_rate = 18;
        
        $tax_amount = $subTotal * 18/100;


        
        DB::table('sales_orders')->insert([
            'order_id' => $request->order_no,
            'order_date' => $request->order_date,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'order_status' => 'Completed',
            'created_at' => Carbon::now(),
            'total_qty' => $totalQuantity,
            'total_item' => $totalItem,
            'total_amt' => $subTotal,
            'tax_rate' => $tax_rate,
            'tax_amt' => $tax_amount,
        ]);

         // Return a success response if successful
         return response()->json([
            'success' => true,
            'message' => 'Sales Order Created Successfully'
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

    
    public function ForecastIninv(Request $request){
        $allocations = Allocation::get();
        $details = GateEntryModel::get();
        $pos = PO::get();
        $suppliers = supplier::get();
        return view('ERP.Inventory.ForecastDemandInv.demandInv',compact('pos','suppliers','details','allocations'));
    }




    public function Details(Request $request){
        $order_id = $request->input('id');

        $po = PO::where('po_id', $order_id)->first();
        $item = ItemLists::where('order_id', $order_id)->get();

        $order_date = $po->order_date;

        return response()->json([
            'success' => true,
            'order_date' =>  $order_date,
            'items' => $item
        ],200);
    }


    public function DetailsGRN(Request $request){
        $dnn = $request->input('id');

        $dnnDetails = GateEntryModel::where('dnn', $dnn)->first();
        $supplierID = $dnnDetails->supplier;
        $supplierDetails = supplier::where('supplier_id', $supplierID)->first();
        // $pos = PO::get();
        // $inspector_name = $dnnDetails->inspector_name;
        // $inspector_id = $dnnDetails->inspector_;

        return response()->json([
            'success' => true,
            'dnnDetails' => $dnnDetails,
            'supplierDetails' => $supplierDetails
        ]);

    }


    public function DetailsDNN(Request $request){
        $dnn = $request->input('id');

        $data = GateEntryModel::where('dnn',$dnn)->first();

        $po_number = $data->po_number;
        $order = DB::table('p_o_s')->where('po_id',$po_number)->first();

        $qty_orderes = $order->total_qty;


            return response()->json([
                'success' => true,
                'po_number' => $po_number,
                'qty_ordered' => $qty_orderes,
            ]);
    }


    public function InspQltCont(){
        $details = GateEntryModel::get();
        $pos = PO::get();
        $suppliers = supplier::get();
        return view('ERP.Inventory.inspQltCon.inspQltCon',compact('pos','suppliers','details'));
    }


    public function InspectionStore(Request $request){
        try {
            $validateData = $request->validate([
                'ordered_qty' => 'required',
                'packaging_condition' => 'required',
                'labeling' => 'required',
                'quantity_delivered' => 'required',
                'passed_qty' => 'required',
                'failed_qty' => 'required',
                'inspector_name' => 'required',
                'inspector_id' => 'required',
            ]);

            $grn_number = 'GRN_'.uniqid();


            $data = GateEntryModel::where('dnn',$request->dnn)->first();
            $item_code = $data->item_id;

            $itemDetails = Allocation::where('item_code',$item_code)->first();
            $old_Stock = $itemDetails->current_stock_level;

            $new_stock_level = $old_Stock + $request->passed_qty;

            Allocation::where('item_code',$item_code)->update([
                'current_stock_level' => $new_stock_level
            ]);

            
            if ($request->hasFile('photo_evidence')) {
                // Upload the new image
                $image = $request->file('photo_evidence');
                $name_gen = hexdec(uniqid());
                $img_ext = strtolower($image->getClientOriginalExtension());
                $img_name = $name_gen . '.' . $img_ext;
                $uplocation = 'images/inspection/';
                $last_img = $uplocation . $img_name;
                $image->storeAs($uplocation, $img_name, 'public');
            }else{
                $last_img = "";
            }
    
            GateEntryModel::where('dnn',$request->dnn)->update([
                'ordered_qty' => $request->ordered_qty,
                'packaging_condition' => $request->packaging_condition,
                'quantity_delivered' => $request->quantity_delivered,
                'labeling' => $request->labeling,
                'passed_qty' => $request->passed_qty,
                'failed_qty' => $request->failed_qty,
                'inspector_name' => $request->inspector_name,
                'inspector_id_signature' => $request->inspector_id,
                'photo_evidence' => $last_img,
                'visual_inspection_notes' => $request->visual_inspection_notes,
                'inspection_status' => 1,
                'grn_number' => $grn_number,
            ]);
    
            return redirect()->back()->with('success', 'Inspection completed successfully');
        }  catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function BarcodePage(Request $request){
        $details = DB::table('gate_entry_models')
        ->join('suppliers', 'suppliers.supplier_id' ,'=', 'gate_entry_models.supplier')
        ->join('allocations', 'allocations.item_code' ,'=', 'gate_entry_models.item_id')
        ->select(['gate_entry_models.*','suppliers.supplier_name','allocations.inventory_id as inventory_id','allocations.current_stock_level as total_stock','allocations.category as category','suppliers.supplier_name as supplierName','allocations.demand_variability as shelf_number'])
        ->get();
        $pos = PO::get();
        $suppliers = supplier::get();
        return view('ERP.Inventory.barcode&RFID.barcode',compact('pos','suppliers','details'));
    }



    public function GenerateQR(Request $request){
        $dnn = $request->input('id');

        $data = DB::table('gate_entry_models')->where('dnn',$dnn)->first();

        $item_id = $data->item_id;
        $supplier_ID = $data->supplier;

        $item = Parts::where('part_number',$item_id)->first();
        $item_name = $item->part_name;

        $supplierData = DB::table('suppliers')->where('supplier_id',$supplier_ID)->first();
        // $supplier_name
        $allocation_data = DB::table('allocations')->where('item_code',$item_id)->first();
        // Get the barcode data from the form input
        $barcodeData = [
            'inventory_id' => 'Inventory Section : '.$allocation_data->inventory_id,
            'item_code' => 'Item Code : '.$allocation_data->item_code,
            'item_des' => 'Item Name : '.$item_name,
          
            'category' => 'Category : Vehicle',
            'sub_category' => 'Sub Category : '.$allocation_data->category,
            'supplier_id' => 'Supplier ID : '.$data->supplier,
            'supplier_name' => 'Supplier Name : '.$supplierData->supplier_name,
            'Bin_shelf_number' => 'Bin/Shelf Number : '.$allocation_data->demand_variability,
            'current_stock_level' => 'Current Stock : '.$allocation_data->current_stock_level,
            'qty_received' => 'Quanity Received : '.$data->passed_qty,
            'last_replenishment_date' => 'Last Item Updated on : '.$allocation_data->updated_at,
            'test_status' => 'Status : Tested',
            'availability' => 'Availability : '.$allocation_data->availability 
        ];
            
        $table = implode("\n", $barcodeData); 
        // Generate the QR code
        $qrCode = QrCode::size(300)->generate($table);

        // Define the path to save the QR code image
        $qrCodePath = 'images/Inventory/qrcode_' . uniqid() .'.svg';

        // Store the QR code image in the public disk
        Storage::disk('public')->put($qrCodePath, $qrCode);

        // Update the part record with the QR code image path
        DB::table('gate_entry_models')->where('dnn', $dnn)->update([
            'qr_code' => $qrCodePath
        ]);


        // Return the QR code path and the table HTML
        return response()->json([
            'success' => true,
            'message' => 'QR Code Generated Successfully',
            'qr_code_path' => $qrCodePath,
            'barcode_data_table' => $table
        ]);
    }


    public function GenerateBarcodeINVData(Request $request){
        try {
            $dnn = $request->input('id');
    
            // Fetch gate entry data
            $data = DB::table('gate_entry_models')->where('dnn', $dnn)->first();
            if (!$data) {
                return response()->json(['error' => 'Gate entry not found'], 404);
            }
    
            $item_id = $data->item_id;
            $supplier_ID = $data->supplier;
    
            // Fetch supplier data
            $supplierData = DB::table('suppliers')->where('supplier_id', $supplier_ID)->first();
            if (!$supplierData) {
                return response()->json(['error' => 'Supplier not found'], 404);
            }
    
            // Fetch allocation data
            $allocation_data = DB::table('allocations')->where('item_code', $item_id)->first();
            if (!$allocation_data) {
                return response()->json(['error' => 'Allocation data not found'], 404);
            }
    
            // Prepare barcode data
            $barcodeData = [
                'inventory_id' => 'Inventory Section : ' . $allocation_data->inventory_id,
                'item_code' => 'Item Code : ' . $allocation_data->item_code,
                'item_des' => 'Item Name : ' . $allocation_data->description,
                'category' => 'Category : Vehicle',
                'sub_category' => 'Sub Category : ' . $allocation_data->category,
                'supplier_id' => 'Supplier ID : ' . $data->supplier,
                'supplier_name' => 'Supplier Name : ' . $supplierData->supplier_name,
                'current_stock_level' => 'Current Stock : ' . $allocation_data->current_stock_level,
                'qty_received' => 'Quantity Received : ' . $data->passed_qty,
                'last_replenishment_date' => 'Last Item Updated on : ' . $allocation_data->updated_at,
                'test_status' => 'Status : Tested',
                'availability' => 'Availability : ' . $allocation_data->availability
            ];
    
            // Convert the data array to a JSON string
            $barcodeString = json_encode($barcodeData, JSON_UNESCAPED_UNICODE);
    
            // Generate the barcode image
            $generator = new BarcodeGeneratorPNG();
            $barcodeImage = $generator->getBarcode($barcodeString, $generator::TYPE_CODE_128, 2, 40);
    
            // Define the directory to save the barcode image
            $barcodeImagePath = 'images/Inventory/barcodes/';
            // Define a unique filename for the barcode image
            $barcodeImageFileName = 'barcode_' . uniqid() . '.png';
    
            // Store the barcode image as a file
            Storage::disk('public')->put($barcodeImagePath . $barcodeImageFileName, $barcodeImage);
    
            // Update the database record with the path to the barcode image file
            DB::table('gate_entry_models')->where('dnn', $dnn)->update([
                'barcode' => $barcodeImagePath . $barcodeImageFileName
            ]);
    
            // Return the response with barcode table, image path, and content
            return response()->json([
                'success' => true,
                'message' => 'Barcode Generated Successfully',
                'barcode_table' => $barcodeData,
                'barcode_image_path' => asset('storage/' . $barcodeImagePath . $barcodeImageFileName),
                'content' => base64_encode($barcodeImage) // Base64 encoded image data
            ]);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }



    public function InitialInspection(){
        // $details = GateEntryModel::get();
        $details = DB::table('gate_entry_models')
        ->join('suppliers', 'suppliers.supplier_id' ,'=', 'gate_entry_models.supplier')
        ->select(['gate_entry_models.*','suppliers.supplier_name'])
        ->get();
        $pos = PO::get();
        $suppliers = supplier::get();
        return view('ERP.Inventory.inspectionInitial.inspection',compact('pos','suppliers','details'));
    }

    public function DetailsStore(Request $request)
    {
        try {
            $validateData = $request->validate([
                'dnn' => 'required',
                'delivery_date' => 'required',
                'delivery_time' => 'required',
                'vehicle_number' => 'required',
                'driver_name' => 'required',
                'driver_contact' => 'required',
                'po_number' => 'required',
                'supplier' => 'required',
                'order_date' => 'required',
                'invoice_number' => 'required',
                'invoice_date' => 'required',
            ]);
    
            GateEntryModel::insert([
                'dnn' => $request->dnn,
                'delivery_date' => $request->delivery_date,
                'delivery_time' => $request->delivery_time,
                'driver_name' => $request->driver_name,
                'driver_contact' => $request->driver_contact,
                'vehicle_number' => $request->vehicle_number,
                'supplier' => $request->supplier,
                'order_date' => $request->order_date,
                'item_id' => $request->item_id,
                'item_name' => $request->item_name,
                'po_number' => $request->po_number,
                'invoice_number' => $request->invoice_number,
                'invoice_date' => $request->invoice_date,
                'created_at' => Carbon::now()
            ]);
    
            return redirect()->back()->with('success', 'Done from my side');
        }  catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }
    
}
