<?php

namespace App\Http\Controllers\BOM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BOM\MainAssembly;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\OrderHeader;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;


class MainAssemblyController extends Controller
{
    public function BikeParts(){
            $categories = MainAssembly::where('parent_id', 0)->get();
         
            return view('supply.BOM.main_assembly.main_assembly',compact('categories'));
    }


    private static function generate12DigitNumber()
    {
        return str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
    }

    public function UploadBOM(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|max:2048', // Adjust the allowed file types and maximum size
        ]);
    
        // Read the uploaded file
        $file = $request->file('file');
        $extension = $file->extension();
    
        // Begin transaction
        DB::beginTransaction();
    
        try {
            $successRows = []; // Array to store successfully processed rows
            $failedRows = []; // Array to store rows with errors
            $uniqueProductIds = []; // Array to store unique product IDs
    
            if ($extension == 'txt' || $extension == 'csv') {
                $fileData = file($file->getRealPath());
            } elseif ($extension == 'xlsx') {
                $spreadsheet = IOFactory::load($file->getRealPath());
                $fileData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            } else {
                // Handle other file types if needed
                throw new \Exception("Unsupported file type: $extension");
            }
    
            // Remove the first two rows (headers and descriptions)
            array_shift($fileData); // Remove the first row
            array_shift($fileData); // Remove the second row
    
            foreach ($fileData as $rowIndex => $row) {
                // If it's an Excel file, $row is an array containing column values
                // If it's TXT, explode the line based on the delimiter
                $data = ($extension == 'txt') ? explode("\t", $row) : $row;
                $data = ($extension == 'csv') ? str_getcsv($row) : $row;
    
                // Check if the data is insufficient
                if (count($data) < 25 || empty($data)){ // Adjust this number based on the number of fields you have
                    $failedRows[] = array_merge(['Row' => $rowIndex + 1], $data); // Add row index to error
                    continue; // Skip this iteration
                }

                    $data['P'] = $data['O'] *  $data['K'];
                    $data['H'] = 'VPTN_'.self::generate12DigitNumber();
                    $data['I'] = self::generate12DigitNumber();
    
                // Convert numeric dates to proper date format if necessary
                $processData = [
                    'Product Name' => $data['A'],
                    'Product ID' => $data['B'],
                    'Year Model' => $this->convertExcelDate($data['C']),
                    'Mileage (km/hr.)' => $data['D'],
                    'Selling Price (Rs.)' => $data['E'],
                    'Color of the Bike' => $data['F'],
                    'Part Description' => $data['G'],
                    'Part Number' => $data['H'],
                    'Serial Number' => $data['I'],
                    'Category' => $data['J'],
                    'Quantity' => $data['K'],
                    'Unit Of Measure' => $data['L'],
                    'Parent Item' => $data['M'],
                    'Child Item' => $data['N'],
                    'Unit Cost(Rs.)' => $data['O'],
                    'Total Cost(Rs.)' => $data['P'],
                    'Dependencies' => $data['Q'],
                    'Constraints' => $data['R'],
                    'Hazardous Material' => $data['S'],
                    'Life Cycle Stage' => $data['T'],
                    'Disposable Information' => $data['U'],
                    'End of LifeCycle' => $data['V'],
                    'Supplier' => $data['W'],
                    'Part number with the supplier' => $data['X'],
                    'Lead Time(Days)' => $data['Y'],
                ];
     
    
                try {

                     
                    // Insert into the database table 'products' (adjust the table name accordingly)
                   DB::table('bom_lists')->insert([
                        'product_name' => $processData['Product Name'],
                        'product_id' => $processData['Product ID'],
                        'year_of_model' => $processData['Year Model'],
                        'mileage_of_bike' => $processData['Mileage (km/hr.)'],
                        'selling_price' => $processData['Selling Price (Rs.)'],
                        'color' => $processData['Color of the Bike'],
                        'part' => $processData['Part Description'],
                        'item_number' => $processData['Part Number'],
                        'serial_number' => $processData['Serial Number'],
                        'category' => $processData['Category'],
                        'quantity' => $processData['Quantity'],
                        'unit_of_measure' => $processData['Unit Of Measure'],
                        'parent_item' => $processData['Parent Item'],
                        'child_item' => $processData['Child Item'],
                        'unit_cost_rs' => $processData['Unit Cost(Rs.)'],
                        'total_cost_rs' => $processData['Total Cost(Rs.)'],
                        'dependencies' => $processData['Dependencies'],
                        'constraints' => $processData['Constraints'],
                        'hazardous_material' => $processData['Hazardous Material'],
                        'life_cycle_stage' => $processData['Life Cycle Stage'],
                        'disposable_info' => $processData['Disposable Information'], // hidden in table
                        'eol_info' => $processData['End of LifeCycle'], // hidden in table
                        'supplier_name' => $processData['Supplier'],
                        'supplier_part_number' => $processData['Part number with the supplier'],
                        'lead_time_days' => $processData['Lead Time(Days)'],
                        'created_at' => Carbon::now(),
                    ]);


                    $partsExists = DB::table('parts')->where('part_number', $processData['Part Number'])->exists();
                        if(!$partsExists){
                            DB::table('parts')->insert([
                            'vehicle' => $processData['Product Name'],         
                            'part_name' =>  $processData['Part Description'],                                // Part: Engine
                            'part_number' => $processData['Part Number'],                  // Item Number: KJSHKJS837S
                            'serial_number' => $processData['Serial Number'],                  // Item Number: KJSHKJS837S
                            'category' => $processData['Category'],  
                            'unit_cost' => $processData['Unit Cost(Rs.)'],     
                            'created_at' => Carbon::now()
                            ]);
                        }

                   // Check if the vehicle already exists
                    $vehicleExists = DB::table('vehicles')->where('vin', $processData['Product ID'])->exists();
                    if (!$vehicleExists) {
                        DB::table('vehicles')->insert([
                            'model' => $processData['Product Name'],
                            'vin' => $processData['Product ID'],
                            'year' => $processData['Year Model'],
                            'mileage' => $processData['Mileage (km/hr.)'],
                            'price' => $processData['Selling Price (Rs.)'],
                            'color' => $processData['Color of the Bike'],
                        ]);
                    }

                    // Store unique product ID
                    $uniqueProductIds[] = $processData['Product ID'];

                    $successRows[] = array_merge(['Row' => $rowIndex + 1], $data); // Add row index to success
                } catch (\Exception $e) {
                    $failedRows[] = array_merge(['Row' => $rowIndex + 1], $data); // Add row index to error
                    Log::error('Error inserting row: ' . $e->getMessage());
                }
            }
    
           
            // Generate result file with success and error rows
            $resultFilePath = $this->generateResultFile($successRows, $failedRows);
            // Store the result file path in the database
            DB::table('error_files')->insert([
                'file_path' => $resultFilePath,
                'product_ids' => implode(',', array_unique($uniqueProductIds)), // Convert array to comma-separated string
                'created_at' => Carbon::now(),
            ]);
    
            // Commit transaction
            DB::commit();
    
            return redirect()->back()->with('success', 'Data has been successfully uploaded.');
        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollback();
            
            // Log the error
            Log::error('Error uploading BOM data: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Error uploading data: ' . $e->getMessage());
        }
    }
    
    private function convertExcelDate($excelDate)
    {
        // Check if the value is numeric (which indicates it's an Excel date)
        if (is_numeric($excelDate)) {
            // Convert the Excel date to a Carbon date object
            $carbonDate = Carbon::createFromDate(1900, 1, 1)->addDays($excelDate - 2); // Excel dates start from 1/1/1900 and there's an offset of 2 days
            return $carbonDate->format('Y-m-d'); // Return the date as a string in 'yyyy-mm-dd' format
        } else {
            // Check if the value is a valid date string
            $carbonDate = Carbon::parse($excelDate);
            return $carbonDate->format('Y-m-d'); // Return the date as a string in 'yyyy-mm-dd' format
        }
    }
    
    private function generateResultFile($successRows, $failedRows)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
       // Set the new headers and subheaders
    $headers = [
        'Row No.', 'Product Name', 'Product ID', 'Year Model', 'Mileage (km/hr.)', 'Selling Price (Rs.)', 'Color of the Bike',
        'Part Description', 'Part Number', 'Serial Number', 'Category', 'Quantity', 'Unit Of Measure',
        'Parent Item', 'Child Item', 'Unit Cost(Rs.)', 'Total Cost(Rs.)', 'Dependencies', 'Constraints', 'Hazardous Material',
        'Life Cycle Stage', 'Disposable Information', 'End of LifeCycle', 'Supplier', 'Part number with the supplier',
        'Lead Time(Days)', 'Status', 'Response'
    ];

    $subheaders = [
        '', '', 'Ex.: VIN_12digit number', '{YYYY format}', 'in number or decimal', 'Ex.: 300000 in number', 'Select from the colours option',
        'Select from the parts for the vehicle', 'Ex.: VPTN_12digit number', '{12 numeric digit}', 'Options : {Main Assembly(Chessis), Sub Assembly, Components and Tools}',
        'in number', 'Ex. : Pcs., Ltr. Etc.', 'Name of the product', 'If any sub-item for this part', 'in number simply Ex. : 150000', 'in number simply Ex. : 150000',
        'If Part is dependent on other parts', 'if any limitation or restriction', 'Options : {Yes Or No}', 'Options : {Design, Production, Obsolete}',
        'If any disposable info. For the item', 'If any end of life cycle info. For the item', 'Name of the supplier', '', 'Ex.: 10 in number'
    ];

    $sheet->fromArray($headers, null, 'A1');
    $sheet->fromArray($subheaders, null, 'A2');

    // Combine success and failed rows with status flags
    $allRows = [];
    foreach ($successRows as $row) {
        if (isset($row['Unit Cost(Rs.)'])) {
            $row['Unit Cost(Rs.)'] = '₹' . number_format($row['Unit Cost(Rs.)'], 2);
        }
        if (isset($row['Total Cost(Rs.)'])) {
            $row['Total Cost(Rs.)'] = '₹' . number_format($row['Total Cost(Rs.)'], 2);
        }
        $allRows[$row['Row']] = array_merge($row, ['Status' => 'Success', 'Failure Reason' => '']); // Success rows have an empty failure reason
    }
    foreach ($failedRows as $row) {
        $failureReason = isset($row['failure_reason']) ? $row['failure_reason'] : 'Missing Necessary Columns'; // Provide a failure reason if available
        if (isset($row['Unit Cost(Rs.)'])) {
            $row['Unit Cost(Rs.)'] = '₹' . number_format($row['Unit Cost(Rs.)'], 2);
        }
        if (isset($row['Total Cost(Rs.)'])) {
            $row['Total Cost(Rs.)'] = '₹' . number_format($row['Total Cost(Rs.)'], 2);
        }
        $allRows[$row['Row']] = array_merge($row, ['Status' => 'Failed', 'Failure Reason' => $failureReason]);
    }
    // Sort all rows by the original row number
    ksort($allRows);

    $rowNum = 3; // Start adding data from row 3

    // Add all rows in the original order
    foreach ($allRows as $row) {
        $sheet->fromArray($row, null, "A$rowNum");

        // Determine row style based on status
        if ($row['Status'] == 'Success') {
            $sheet->getStyle("A$rowNum:Y$rowNum")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('00FF00'); // Green for successful rows
        } else {
            $sheet->getStyle("A$rowNum:Y$rowNum")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB(Color::COLOR_RED); // Red for failed rows
        }

        // Color formatting for missing data
        foreach ($row as $colIndex => $value) {
            $colIndex = intval($colIndex); // Ensure $colIndex is an integer
            if ($colIndex === 0) {
                continue; // Skip the 'Row' column (index 0)
            }

            $columnLetter = Coordinate::stringFromColumnIndex($colIndex + 1); // Convert index to column letter
            $cell = $sheet->getCell($columnLetter . $rowNum);

            if ($value === null || $value === '') {
                if ($row['Status'] == 'Success') {
                    // Highlight missing columns in sky blue
                    $cell->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('87CEEB');
                } else {
                    // Highlight missing columns in red
                    $cell->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB(Color::COLOR_RED);
                }
            }
        }

        $rowNum++;
    }

    
        // Save the spreadsheet
        $writer = new Xlsx($spreadsheet);
        $filePath = 'images/error_files/BOM_data'.time().'.xlsx';
        $writer->save($filePath);
    
        return $filePath;
    }

    public function SaveBOMData(Request $request){
       try{

        $data = $request->all();


        foreach($data as $item){
            foreach($item as $processData){
               $check = DB::table('bom_lists')->insert([
                    'product_name' => $processData['Product Name'],
                    'product_id' => $processData['Product Code'],
                    'year_of_model' => $processData['Year Of Model'],
                    'mileage_of_bike' => $processData['Mileage Of the Bike'],
                    'selling_price' => $processData['Decided Selling Price'],
                    'status_of_bike' => $processData['Status Of the Bike'],
                    'color' => $processData['Color'],
                    'part' => $processData['Part'],
                    'item_number' => $processData['Item Number'],
                    'serial_number' => $processData['Serial Number'],
                    'category' => $processData['Category'],
                    'quantity' => $processData['Quantity'],
                    'unit_of_measure' => $processData['Unit of Measure'],
                    'parent_item' => $processData['Parent Item'],
                    'child_item' => $processData['Child Item'],
                    'unit_cost_rs' => $processData['Unit Cost (Rs.)'],
                    'total_cost_rs' => $processData['Total Cost (Rs.)'],
                    'dependencies' => $processData['Dependencies'],
                    'constraints' => $processData['Constraints'],
                    'hazardous_material' => $processData['Hazardous Material'],
                    'disposable_info' => $processData['Disposable Information'], // hidden in table
                    'life_cycle_stage' => $processData['Life Cycle Stage'],
                    'eol_info' => $processData['EOL Info'], // hidden in table
                    'supplier_name' => $processData['Supplier Name'],
                    'supplier_part_number' => $processData['Supplier Part Number'],
                    'lead_time_days' => $processData['Lead Time (Days)'],
                    'created_at' => Carbon::now()
                ]);
            }
        }

        $check1 = DB::table('vehicles')->insert([
            'model' => $processData['Product Name'],                // Part: Engine
            'vin' => $processData['Product Code'],                // Item Number: KJSHKJS837S
            'year' => $processData['Year Of Model'],
            'mileage' => $processData['Mileage Of the Bike'],
            'price' => $processData['Decided Selling Price'],
            'status' => $processData['Status Of the Bike'],
            'color' => $processData['Color'],
            'created_at' => Carbon::now()
        ]);

        foreach($data as $item){
            foreach($item as $processData){
               $check2 = DB::table('parts')->insert([
                'vehicle' => $processData['Product Name'],         
                'part_name' => $processData['Part'],                                // Part: Engine
                'part_number' => $processData['Item Number'],                  // Item Number: KJSHKJS837S
                'serial_number' => $processData['Serial Number'],                  // Item Number: KJSHKJS837S
                'category' => $processData['Category'],  
                'unit_cost' => $processData['Unit Cost (Rs.)'],     
                'created_at' => Carbon::now()
                ]);
            }
        }

        if($check == 1 && $check1 == 1 && $check2 == 1){
            return response()->json([
                'success' => true,
                'message' => 'BOM Created Successfully for '.$processData['Product Name'],
            ],200);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Failed to create a BOM',
            ],400);
        }
       }catch(\Exception $e){
        
       }
    }


    public function ShowBOMLists(Request $request){
        $id = $request->input('id');


        $data = DB::table('bom_lists')->where('product_id',$id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Data Fetched',
            'data' => $data
        ]);
    }


    public function CreateNewBom(){
        $categories = Category::where('parent_id',0)->get();
        $sub_categories = Category::where('parent_id', '!=', 0)->get();
        $boms = DB::table('bom_lists')
        ->join('error_files', function ($join) {
            $join->on('bom_lists.product_id', '=', 'error_files.product_ids')
                 ->orWhereRaw('FIND_IN_SET(bom_lists.product_id, error_files.product_ids)');
        })
        ->select(['bom_lists.product_id', 'error_files.file_path'])
        ->distinct()
        ->get();
        return view('supply.BOM.createbom',compact('categories','sub_categories','boms'));
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