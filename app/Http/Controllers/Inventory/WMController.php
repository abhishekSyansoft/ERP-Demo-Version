<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Inventory\SC;
use App\Models\Inventory\WM;
use Storage;
use DB;
use Carbon\Carbon;
use Milon\Barcode\DNS1D;
use Picqer\Barcode\BarcodeGeneratorHTML;
// use Endroid\QrCode\QrCode;
use Picqer\Barcode\BarcodeGeneratorPNG;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;
use Intervention\Image\ImageManagerStatic as Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Inventory\Parts;
use App\Models\Inventory\Vehicles;

class WMController extends Controller
{
     /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function WM(){
            try {

                // Retrieve all resources from the databases
                
                $warehouses = WM::all();

                // Return the view with the list of suppliers
                return view("supply.inventory.wm.wm",compact('warehouses'));
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                // For example, you can return an error view or redirect with an error message
                return view("error")->with("error", "Failed to fetch resources: ".$e->getMessage());
            }
        }



        /**
         * Add a new supplier.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function WMAdd(Request $request){
            try {

                    // Validate the incoming request data
                    $validatData = $request->validate([
                        "warehouse_id"=>'required',
                        "warehouse_name"=>'required',
                        "warehouse_manager"=>'required',
                        "capacity"=>'required',
                        "inventory_audits"=>'required',
                        "integration_with_ims"=>'required',
                    ]);


                    

                    if ($request->hasFile('documents_and_records')) {
                        // Upload the new image
                        $image = $request->file('documents_and_records');
                        $name_gen = hexdec(uniqid());
                        $img_ext = strtolower($image->getClientOriginalExtension());
                        $img_name = $name_gen . '.' . $img_ext;
                        $uplocation = 'images/warehouse/documents/';
                        $last_img = $uplocation . $img_name;
                        $image->storeAs($uplocation, $img_name, 'public');
                    }else{
                        $last_img = "";
                    }

                    if ($request->hasFile('layout')) {
                        // Upload the new image
                        $image = $request->file('layout');
                        $name_gen = hexdec(uniqid());
                        $img_ext = strtolower($image->getClientOriginalExtension());
                        $img_name = $name_gen . '.' . $img_ext;
                        $uplocation = 'images/warehouse/layout/';
                        $doc_img = $uplocation . $img_name;
                        $image->storeAs($uplocation, $img_name, 'public');
                    }else{
                        $doc_img = "";
                    }


                    // Retrieve the supplier from the database
                    WM::insert([
                        "warehouse_id"=> $request->warehouse_id,
                        "warehouse_name"=> $request->warehouse_name,
                        "warehouse_manager"=> $request->warehouse_manager,
                        "address"=> $request->address,
                        "city"=> $request->city,
                        "state"=> $request->state,
                        "pincode"=> $request->pincode,
                        "capacity"=> $request->capacity,
                        "layout"=> $doc_img,
                        "storage_zone"=> $request->storage_zone,
                        "shelf_number"=> $request->shelf_number,
                        "inventory_allocation"=> $request->inventory_allocation,
                        "inventory_movement"=> $request->inventory_movement,
                        "inventory_levels"=> $request->inventory_levels,
                        "picking_and_packing"=> $request->picking_and_packing,
                        "loading_and_unloading"=> $request->loading_and_unloading,
                        "safety_and_security"=> $request->safety_and_security,
                        "maintenance_and_sheduling"=> $request->maintenance_and_sheduling,
                        "temprature_and_climate_control"=> $request->temprature_and_climate_control,
                        "emergency_procedures"=> $request->emergency_procedures,
                        "inventory_audits"=> $request->inventory_audits,
                        "documents_and_records"=> $last_img,
                        "integration_with_ims"=> $request->integration_with_ims,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function WMEdit($encryptedId){
            $id = decrypt($encryptedId);
            $wm = WM::findOrFail($id);
            return view("supply.inventory.wm.edit_update.wm_update",compact("wm"));
        }



        // Update Supplier
    public function WMUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "warehouse_name"=> "required",
                "location"=> "required",
                "capacity"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);

            $warehouse = WM::findOrFail('id',$id);
            $oldDoc = $warehouse->documents_and_records;
            $oldlayout = $warehouse->layout;

            
            if ($request->hasFile('documents_and_records')) {
                Storage::disk('public')->delete($oldDoc);
                // Upload the new image
                $image = $request->file('documents_and_records');
                $name_gen = hexdec(uniqid());
                $img_ext = strtolower($image->getClientOriginalExtension());
                $img_name = $name_gen . '.' . $img_ext;
                $uplocation = 'images/warehouse/documents/';
                $last_img = $uplocation . $img_name;
                $image->storeAs($uplocation, $img_name, 'public');
            }else{
                $last_img = $oldDoc;
            }

            if ($request->hasFile('layout')) {
                Storage::disk('public')->delete($oldlayout);
                // Upload the new image
                $image = $request->file('layout');
                $name_gen = hexdec(uniqid());
                $img_ext = strtolower($image->getClientOriginalExtension());
                $img_name = $name_gen . '.' . $img_ext;
                $uplocation = 'images/warehouse/layout/';
                $doc_img = $uplocation . $img_name;
                $image->storeAs($uplocation, $img_name, 'public');
            }else{
                $doc_img = $oldlayout;
            }
            
                // Retrieve the supplier from the database
                WM::where('id',$id)->update([
                    "warehouse_id"=> $request->warehouse_id,
                    "warehouse_name"=> $request->warehouse_name,
                    "warehouse_manager"=> $request->warehouse_manager,
                    "address"=> $request->address,
                    "city"=> $request->city,
                    "state"=> $request->state,
                    "pincode"=> $request->pincode,
                    "capacity"=> $request->capacity,
                    "layout"=> $doc_img,
                    "storage_zone"=> $request->storage_zone,
                    "shelf_number"=> $request->shelf_number,
                    "inventory_allocation"=> $request->inventory_allocation,
                    "inventory_movement"=> $request->inventory_movement,
                    "inventory_levels"=> $request->inventory_levels,
                    "picking_and_packing"=> $request->picking_and_packing,
                    "loading_and_unloading"=> $request->loading_and_unloading,
                    "safety_and_security"=> $request->safety_and_security,
                    "maintenance_and_sheduling"=> $request->maintenance_and_sheduling,
                    "temprature_and_climate_control"=> $request->temprature_and_climate_control,
                    "emergency_procedures"=> $request->emergency_procedures,
                    "inventory_audits"=> $request->inventory_audits,
                    "documents_and_records"=> $last_img,
                    "integration_with_ims"=> $request->integration_with_ims,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('warehouse-management')->with('success', 'updated successfully!');
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
    public function WMDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            $warehouse = WM::findOrFail($id);
            $oldDoc = $warehouse->documents_and_records;
            $oldlayout = $warehouse->layout;

            Storage::disk('public')->delete([$oldDoc,$oldlayout]);


            // Delete the supplier
            $warehouse->delete();

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




    public function WMQRCode(Request $request){
        $id = $request->input('id');

        $warehouse = WM::where('id',$id)->first();

        // Check if the part exists
        if (!$warehouse) {
            return response()->json(['error' => 'Part not found',
        'id'=>$id
        ], 404);
        }

        // Get the barcode data from the form input
        $barcodeData = [
            "warehouse_id"=> $warehouse->warehouse_id,
            "warehouse_name"=> $warehouse->warehouse_name,
            "warehouse_manager"=> $warehouse->warehouse_manager,
            "address"=> $warehouse->address,
            "city"=> $warehouse->city,
            "state"=> $warehouse->state,
            "pincode"=> $warehouse->pincode,
            "capacity"=> $warehouse->capacity,
            "storage_zone"=> $warehouse->storage_zone,
            "shelf_number"=> $warehouse->shelf_number,
            "inventory_allocation"=> $warehouse->inventory_allocation,
            "inventory_movement"=> $warehouse->inventory_movement,
            "inventory_levels"=> $warehouse->inventory_levels,
            "picking_and_packing"=> $warehouse->picking_and_packing,
            "loading_and_unloading"=> $warehouse->loading_and_unloading,
            "safety_and_security"=> $warehouse->safety_and_security,
            "maintenance_and_sheduling"=> $warehouse->maintenance_and_sheduling,
            "temprature_and_climate_control"=> $warehouse->temprature_and_climate_control,
            "emergency_procedures"=> $warehouse->emergency_procedures,
            "inventory_audits"=> $warehouse->inventory_audits,
            "integration_with_ims"=> $warehouse->integration_with_ims,
            "documents_and_records"=> 'http://127.0.0.1:8000/Storage/'.$warehouse->documents_and_records,
            "layout"=> 'http://127.0.0.1:8000/Storage/'.$warehouse->layout,
            ];
            
        $table = implode("\n", $barcodeData); 
        // Generate the QR code
        $qrCode = QrCode::size(300)->generate($table);

        // Define the path to save the QR code image
        $qrCodePath = 'images/warehouse/qrcodes/qrcode_' .  uniqid()  .'.svg';

        // Store the QR code image in the public disk
        Storage::disk('public')->put($qrCodePath, $qrCode);

        // Update the part record with the QR code image path
        WM::where('id', $id)->update([
            'qrcode' => $qrCodePath
        ]);


                // Return the QR code path and the table HTML
                return response()->json([
                    'qr_code_path' => $qrCodePath,
                    'barcode_data_table' => $table
                ]);
            }


            public function WMBARCode(Request $request){
                $id = $request->input('id');

                $warehouse = WM::where('id',$id)->first();

                // Check if the part exists
                if (!$warehouse) {
                    return response()->json(['error' => 'Part not found',
                'id'=>$id
                ], 404);
                }
                // Get the barcode data from the form input
                $barcodeData = [
                    "warehouse_id"=> $warehouse->warehouse_id,
                    "warehouse_name"=> $warehouse->warehouse_name,
                    "warehouse_manager"=> $warehouse->warehouse_manager,
                    "address"=> $warehouse->address,
                    "city"=> $warehouse->city,
                    "state"=> $warehouse->state,
                    "pincode"=> $warehouse->pincode,
                    "capacity"=> $warehouse->capacity,
                    "storage_zone"=> $warehouse->storage_zone,
                    "shelf_number"=> $warehouse->shelf_number,
                    "inventory_allocation"=> $warehouse->inventory_allocation,
                    "inventory_movement"=> $warehouse->inventory_movement,
                    "inventory_levels"=> $warehouse->inventory_levels,
                    "picking_and_packing"=> $warehouse->picking_and_packing,
                    "loading_and_unloading"=> $warehouse->loading_and_unloading,
                    "safety_and_security"=> $warehouse->safety_and_security,
                    "maintenance_and_sheduling"=> $warehouse->maintenance_and_sheduling,
                    "temprature_and_climate_control"=> $warehouse->temprature_and_climate_control,
                    "emergency_procedures"=> $warehouse->emergency_procedures,
                    "inventory_audits"=> $warehouse->inventory_audits,
                    "integration_with_ims"=> $warehouse->integration_with_ims,
                    "documents_and_records"=> 'http://127.0.0.1:8000/Storage/'.$warehouse->documents_and_records,
                    "layout"=> 'http://127.0.0.1:8000/Storage/'.$warehouse->layout,
                ];
            
                // Convert the data array to a JSON string
                $barcodeString = json_encode($barcodeData, JSON_UNESCAPED_UNICODE);
            
                // Generate the barcode image
                $generator = new BarcodeGeneratorPNG();
                $barcodeImage = $generator->getBarcode($barcodeString, $generator::TYPE_CODE_128, 2, 40);
            
                // Define the directory to save the barcode image
                $barcodeImagePath = 'images/warehouse/barcode/';
                // Define a unique filename for the barcode image
                $barcodeImageFileName = 'barcode_' . uniqid() . '.png';
            
                // Store the barcode image as a file
                Storage::disk('public')->put($barcodeImagePath . $barcodeImageFileName, $barcodeImage);
            
                // Update the database record with the path to the barcode image file
                WM::where('id', $id)->update([
                    'barcode'=> $barcodeImagePath . $barcodeImageFileName
                ]);
            
                // Return the response with barcode table, image path, and content
                return response()->json([
                    'barcode_table' => $barcodeData,
                    'barcode_image_path' => asset('storage/' . $barcodeImagePath . $barcodeImageFileName),
                    'content' => base64_encode($barcodeImage) // Base64 encoded image data
                ]);
            }







}
