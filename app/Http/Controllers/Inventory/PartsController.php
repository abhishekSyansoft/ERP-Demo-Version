<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
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

use App\Models\Inventory\Parts;

class PartsController extends Controller
{
    public function PartsInv(){
         // Return the view with the list of suppliers
         $categories = Category::where('parent_id',0)->get();
         $sub_categories = Category::where('parent_id', '!=', 0)->get();
         $parts = Parts::get();
         return view("supply.inventory.parts.parts",compact('parts','categories','sub_categories'));
    }


    public function PartsInvAdd(Request $request){
        $validateData = $request->validate([
            "part_number" => "required",
            "serial_number" => "required",
            "part_name" => "required",
            "vehicle" => "required",
            "location" => "required",
            "shelf_number" => "required",
            "condition" => "required",
            "unit_cost" => "required",
            "qty_on_hand" => "required",
            "min_stock_level" => "required",
            "max_stock_level" => "required",
            "supplier_id" => "required",
        ]);


        if ($request->hasFile('image')) {
    
            // Upload the new image
            $image = $request->file('image');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $uplocation = 'images/parts/';
            $last_img = $uplocation . $img_name;
            $image->storeAs($uplocation, $img_name, 'public');
        }else{
            $last_img = " NA";
        }
    

        Parts::insert([
            "part_number" => $request->part_number,
            "serial_number" => $request->serial_number,
            "category" => $request->category,
            "availability" => $request->availability,
            "part_name" => $request->part_name,
            "vehicle" => $request->vehicle,
            "part_description" => $request->part_description,
            "notes" => $request->notes,
            "warranty_description" => $request->warranty_information,
            "location" => $request->location,
            "shelf_number" => $request->shelf_number,
            "condition" => $request->condition,
            "unit_cost" => $request->unit_cost,
            "qty_on_hand" => $request->qty_on_hand,
            "min_stock_level" => $request->min_stock_level,
            "max_stock_level" => $request->max_stock_level,
            "compatability" => $request->compatability,
            "image" => $last_img,
            "supplier_id" => $request->supplier_id,
            "lead_time" => $request->lead_time,
            "created_at"=>Carbon::now()
        ]);


        return redirect()->back()->with('success','Data Inserted Successfully');
    }


    public function PartsInvEdit($encryptedId){

        $id = decrypt($encryptedId);
        // Return the view with the list of suppliers
        $part = Parts::where('id',$id)->first();
        $categories = Category::where('parent_id',0)->get();
        $sub_categories = Category::where('parent_id', '!=', 0)->get();
        return view("supply.inventory.parts.edit_update.parts_update",compact('part','categories','sub_categories'));
   }

   public function PartsInvUpdate(Request $request, $encryptedId){

    $id = decrypt($encryptedId);

    $validateData = $request->validate([
        "part_number" => "required",
        "serial_number" => "required",
        "part_name" => "required",
        "vehicle" => "required",
        "location" => "required",
        "shelf_number" => "required",
        "condition" => "required",
        "unit_cost" => "required",
        "qty_on_hand" => "required",
        "min_stock_level" => "required",
        "max_stock_level" => "required",
        "supplier_id" => "required",
    ]);

    $part = Parts::where('id',$id)->first();
    $oldImage = $part->image;


     // Check if an image file is provided in the request
     if ($request->hasFile('image')) {
        // Upload the new image
         // Delete the old image file from storage
         Storage::disk('public')->delete($oldImage);
        $image = $request->file('image');
        $imagedata = $image->getContent();
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen .'.'. $img_ext;
        $uplocation = 'images/parts/';
        $last_img = $uplocation . $img_name;
        Storage::disk('public')->put($last_img, $imagedata);
    }else{
        $last_img = $oldImage;
    }

    Parts::where('id',$id)->update([
        "part_number" => $request->part_number,
        "serial_number" => $request->serial_number,
        "category" => $request->category,
        "availability" => $request->availability,
        "part_name" => $request->part_name,
        "vehicle" => $request->vehicle,
        "part_description" => $request->part_description,
        "notes" => $request->notes,
        "warranty_description" => $request->warranty_information,
        "location" => $request->location,
        "shelf_number" => $request->shelf_number,
        "condition" => $request->condition,
        "unit_cost" => $request->unit_cost,
        "qty_on_hand" => $request->qty_on_hand,
        "min_stock_level" => $request->min_stock_level,
        "max_stock_level" => $request->max_stock_level,
        "compatability" => $request->compatability,
        "image" => $last_img,
        "supplier_id" => $request->supplier_id,
        "lead_time" => $request->lead_time,
    ]);

    return redirect()->back()->with('success','Data Updated Successfully');

}


public function PartsInvDelete($encryptedId){

    $id = decrypt($encryptedId);
    // Return the view with the list of suppliers
    $part = Parts::where('id',$id);

    $part->delete();
    return redirect()->back()->with('delete','Item Deleted successfully');
}

public function PartsInvQRCode(Request $request){
    $id = $request->input('id');

    $part = Parts::where('id',$id)->first();

    // Check if the part exists
    if (!$part) {
        return response()->json(['error' => 'Part not found'], 404);
    }

    // Get the barcode data from the form input
    $barcodeData = [
        "category" => $part->category,
        "availability" => $part->availability,
        "part_number" => $part->part_number,
        "serial_number" => $part->serial_number,

        "part_name" => $part->part_name,
        "vehicle" => $part->vehicle,
        "part_description" => $part->part_description,
        "notes" => $part->notes,
        "warranty_description" => $part->warranty_information,
        "location" => $part->location,
        "shelf_number" => $part->shelf_number,
        "condition" => $part->condition,
        "unit_cost" => $part->unit_cost,
        "qty_on_hand" => $part->qty_on_hand,
        "min_stock_level" => $part->min_stock_level,
        "max_stock_level" => $part->max_stock_level,
        "compatability" => $part->compatability,
        "image" => $part->image,
        "supplier_id" => $part->supplier_id,
        "lead_time" => $part->lead_time,
    ];
        
    $table = implode("\n", $barcodeData); 
    // Generate the QR code
    $qrCode = QrCode::size(300)->generate($table);

    // Define the path to save the QR code image
    $qrCodePath = 'images/qrcodes/qrcode_' . $id .'.svg';

    // Store the QR code image in the public disk
    Storage::disk('public')->put($qrCodePath, $qrCode);

    // Update the part record with the QR code image path
    Parts::where('id', $id)->update([
        'barcode' => $qrCodePath
    ]);


                // Return the QR code path and the table HTML
                return response()->json([
                    'qr_code_path' => $qrCodePath,
                    'barcode_data_table' => $table
                ]);
            }


        public function PartsInvBARCode(Request $request){
            $id = $request->input('id');
            $part = Parts::where('id', $id)->first();
        
            // Check if the part exists
            if (!$part) {
                return response()->json(['error' => 'Part not found'], 404);
            }
        
            // Get the barcode data from the form input
            $barcodeData = [
                "category" => $part->category,
                "availability" => $part->availability,
                "part_number" => $part->part_number,
                "serial_number" => $part->serial_number,
                "part_name" => $part->part_name,
                "vehicle" => $part->vehicle,
                "part_description" => $part->part_description,
                "notes" => $part->notes,
                "warranty_description" => $part->warranty_information,
                "location" => $part->location,
                "shelf_number" => $part->shelf_number,
                "condition" => $part->condition,
                "unit_cost" => $part->unit_cost,
                "qty_on_hand" => $part->qty_on_hand,
                "min_stock_level" => $part->min_stock_level,
                "max_stock_level" => $part->max_stock_level,
                "compatability" => $part->compatability,
                "image" => $part->image,
                "supplier_id" => $part->supplier_id,
                "lead_time" => $part->lead_time,
            ];
        
            // Convert the data array to a JSON string
            $barcodeString = json_encode($barcodeData, JSON_UNESCAPED_UNICODE);
        
            // Generate the barcode image
            $generator = new BarcodeGeneratorPNG();
            $barcodeImage = $generator->getBarcode($barcodeString, $generator::TYPE_CODE_128, 2, 40);
        
            // Define the directory to save the barcode image
            $barcodeImagePath = 'images/barcodes/';
            // Define a unique filename for the barcode image
            $barcodeImageFileName = 'barcode_' . uniqid() . '.png';
        
            // Store the barcode image as a file
            Storage::disk('public')->put($barcodeImagePath . $barcodeImageFileName, $barcodeImage);
        
            // Update the database record with the path to the barcode image file
            Parts::where('id', $id)->update([
                'qrcode'=> $barcodeImagePath . $barcodeImageFileName
            ]);
        
            // Return the response with barcode table, image path, and content
            return response()->json([
                'barcode_table' => $barcodeData,
                'barcode_image_path' => asset('storage/' . $barcodeImagePath . $barcodeImageFileName),
                'content' => base64_encode($barcodeImage) // Base64 encoded image data
            ]);
        }
        
}
