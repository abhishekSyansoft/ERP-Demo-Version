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
use App\Models\Inventory\Parts;
use App\Models\Inventory\Vehicles;

class VehiclesController extends Controller
{
    public function VInv(){
        // Return the view with the list of suppliers
        $vehicles = Vehicles::get();
        return view("supply.inventory.vehicles.vehicles",compact('vehicles'));
   }

   public function VInvAdd(Request $request){
    $validateData = $request->validate([
        'vin'=>'required',
        'model'=>'required',
        'year'=>'required',
        'color'=>'required',
        'mileage'=>'required',
        'price'=>'required',
        'status'=>'required',
        'min_stock_level'=>'required',
        'max_stock_level'=>'required'
    ]);


    if ($request->hasFile('image')) {
        // Upload the new image
        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $uplocation = 'images/vehicles/images/';
        $last_img = $uplocation . $img_name;
        $image->storeAs($uplocation, $img_name, 'public');
    }else{
        $last_img = "";
    }

    if ($request->hasFile('document')) {
        // Upload the new image
        $image = $request->file('document');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $uplocation = 'images/vehicles/documents/';
        $doc_img = $uplocation . $img_name;
        $image->storeAs($uplocation, $img_name, 'public');
    }else{
        $doc_img = "";
    }


    Vehicles::insert([
        'vin' => $request->vin,
        'model' => $request->model,
        'year' => $request->year,
        'color' => $request->color,
        'trim' => $request->trim,
        'mileage' => $request->mileage,
        'condition' => $request->condition,
        'price' => $request->price,
        'location' => $request->location,
        'status' => $request->status,
        'salesperson' => $request->salesperson,
        'image' => $last_img,
        'barcode' => $request->barcode,
        'qrcode' => $request->qrcode,
        'history' => $request->history,
        'features' => $request->features,
        'vehicles_identification_documents' => $doc_img,
        'availability' => $request->availability,
        'warranty_information' => $request->warranty_information,
        'financial_information' => $request->financial_information,
        'trade_in_information' => $request->trade_in_information,
        'min_stock_level' => $request->min_stock_level,
        'max_stock_level' => $request->max_stock_level,
        "created_at"=>Carbon::now()
    ]);


    return redirect()->back()->with('success','Data Inserted Successfully');
}


public function VInvEdit($encryptedId){

    $id = decrypt($encryptedId);
    // Return the view with the list of suppliers
    $vehicle = Vehicles::where('id',$id)->first();
    return view("supply.inventory.vehicles.edit_update.vehicles_update",compact('vehicle'));
}



public function VInvUpdate(Request $request, $encryptedId){

    $id = decrypt($encryptedId);

    $validateData = $request->validate([
        'vin'=>'required',
        'model'=>'required',
        'year'=>'required',
        'color'=>'required',
        'mileage'=>'required',
        'price'=>'required',
        'status'=>'required',
        'min_stock_level'=>'required',
        'max_stock_level'=>'required'
    ]);


    $part = Vehicles::where('id',$id)->first();
    $oldImage = $part->image;
    $oldFile = $part->vehicles_identification_documents;


    if ($request->hasFile('image')) {
        Storage::disk('public')->delete($oldImage);
        // Upload the new image
        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $uplocation = 'images/vehicles/images/';
        $last_img = $uplocation . $img_name;
        $image->storeAs($uplocation, $img_name, 'public');
    }else{
        $last_img = $oldImage;
    }

    if ($request->hasFile('document')) {
        Storage::disk('public')->delete($oldFile);
        // Upload the new image
        $image = $request->file('document');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $uplocation = 'images/vehicles/documents/';
        $doc_img = $uplocation . $img_name;
        $image->storeAs($uplocation, $img_name, 'public');
    }else{
        $doc_img = $oldFile;
    }

    Vehicles::where('id',$id)->update([
        'vin' => $request->vin,
        'model' => $request->model,
        'year' => $request->year,
        'color' => $request->color,
        'trim' => $request->trim,
        'mileage' => $request->mileage,
        'condition' => $request->condition,
        'price' => $request->price,
        'location' => $request->location,
        'status' => $request->status,
        'salesperson' => $request->salesperson,
        'image' => $last_img,
        'features' => $request->features,
        'vehicles_identification_documents' => $doc_img,
        'availability' => $request->availability,
        'warranty_information' => $request->warranty_information,
        'min_stock_level' => $request->min_stock_level,
        'max_stock_level' => $request->max_stock_level,
    ]);


    return redirect()->route('vehicles-inventory-management')->with('success','Data Updated Successfully');

}


    public function VInvDelete($encryptedId){

        $id = decrypt($encryptedId);
        // Return the view with the list of suppliers
        $Vehicle = Vehicles::findOrFail($id);

        $Vehicle->delete();
        return redirect()->back()->with('delete','Item Deleted successfully');
    }



    public function VInvQRCode(Request $request){
        $id = $request->input('id');

        $vehicle = Vehicles::where('id',$id)->first();

        // Check if the part exists
        if (!$vehicle) {
            return response()->json(['error' => 'Part not found',
        'id'=>$id
        ], 404);
        }

        // Get the barcode data from the form input
        $barcodeData = [
            'vin' => $vehicle->vin,
            'model' => $vehicle->model,
            'year' => $vehicle->year,
            'color' => $vehicle->color,
            'trim' => $vehicle->trim,
            'mileage' => $vehicle->mileage,
            'condition' => $vehicle->condition,
            'price' => $vehicle->price,
            'location' => $vehicle->location,
            'status' => $vehicle->status,
            'salesperson' => $vehicle->salesperson,
            'image' =>  'http://127.0.0.1:8000/'.$vehicle->image,
            'barcode' => 'http://127.0.0.1:8000/'.$vehicle->barcode,
            'qrcode' =>  'http://127.0.0.1:8000/'.$vehicle->qrcode,
            'history' => $vehicle->history,
            'features' => $vehicle->features,
            'vehicles_identification_documents' =>  'http://127.0.0.1:8000/'.$vehicle->vehicles_identification_documents,
            'availability' => $vehicle->availability,
            'warranty_information' => $vehicle->warranty_information,
            'financial_information' => $vehicle->financial_information,
            'trade_in_information' => $vehicle->trade_in_information,
            'min_stock_level' => $vehicle->min_stock_level,
            'max_stock_level' => $vehicle->max_stock_level,
            "created_at"=>Carbon::now()
        ];
            
        $table = implode("\n", $barcodeData); 
        // Generate the QR code
        $qrCode = QrCode::size(300)->generate($table);

        // Define the path to save the QR code image
        $qrCodePath = 'images/vehicles/qrcodes/qrcode_' .  uniqid()  .'.svg';

        // Store the QR code image in the public disk
        Storage::disk('public')->put($qrCodePath, $qrCode);

        // Update the part record with the QR code image path
        Vehicles::where('id', $id)->update([
            'qrcode' => $qrCodePath
        ]);


                // Return the QR code path and the table HTML
                return response()->json([
                    'qr_code_path' => $qrCodePath,
                    'barcode_data_table' => $table
                ]);
            }


            public function VInvBARCode(Request $request){
                $id = $request->input('id');

                $vehicle = Vehicles::where('id',$id)->first();

                // Check if the part exists
                if (!$vehicle) {
                    return response()->json(['error' => 'Part not found',
                'id'=>$id
                ], 404);
                }
                // Get the barcode data from the form input
                $barcodeData = [
                    'vin' => $vehicle->vin,
                    'model' => $vehicle->model,
                    'year' => $vehicle->year,
                    'color' => $vehicle->color,
                    'trim' => $vehicle->trim,
                    'mileage' => $vehicle->mileage,
                    'condition' => $vehicle->condition,
                    'price' => $vehicle->price,
                    'location' => $vehicle->location,
                    'status' => $vehicle->status,
                    'salesperson' => $vehicle->salesperson,
                    'image' =>  'http://127.0.0.1:8000/'.$vehicle->image,
                    'barcode' => 'http://127.0.0.1:8000/'.$vehicle->barcode,
                    'qrcode' =>  'http://127.0.0.1:8000/'.$vehicle->qrcode,
                    'history' => $vehicle->history,
                    'features' => $vehicle->features,
                    'vehicles_identification_documents' =>  'http://127.0.0.1:8000/'.$vehicle->vehicles_identification_documents,
                    'availability' => $vehicle->availability,
                    'warranty_information' => $vehicle->warranty_information,
                    'financial_information' => $vehicle->financial_information,
                    'trade_in_information' => $vehicle->trade_in_information,
                    'min_stock_level' => $vehicle->min_stock_level,
                    'max_stock_level' => $vehicle->max_stock_level,
                    "created_at"=>Carbon::now()
                ];
            
                // Convert the data array to a JSON string
                $barcodeString = json_encode($barcodeData, JSON_UNESCAPED_UNICODE);
            
                // Generate the barcode image
                $generator = new BarcodeGeneratorPNG();
                $barcodeImage = $generator->getBarcode($barcodeString, $generator::TYPE_CODE_128, 2, 40);
            
                // Define the directory to save the barcode image
                $barcodeImagePath = 'images/vehicles/barcode';
                // Define a unique filename for the barcode image
                $barcodeImageFileName = 'barcode_' . uniqid() . '.png';
            
                // Store the barcode image as a file
                Storage::disk('public')->put($barcodeImagePath . $barcodeImageFileName, $barcodeImage);
            
                // Update the database record with the path to the barcode image file
                Vehicles::where('id', $id)->update([
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
