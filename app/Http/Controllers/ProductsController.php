<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCatgory;
use App\Models\Products;
use Carbon\Carbon;
use Storage;
use Intervention\Image\Facades\Image;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
      //
      public function SubCategory(){
        $products = Products::join('categories', 'categories.id', '=', 'products.category_id')
              ->select('categories.category_name as category_name','categories.id as category_id', 'products.product_name as products_name','products.id as product_id','products.id as sub_cartegoryId','products.*')
              ->paginate(5);
        $productCount = DB::table('products')->count();
        return view("sub-category",compact("products","productCount"));
    }

    public function CreateItems(){
        $category = Category::get();
        return view("items.create_item",compact('category'));
    }
    
    public function EditItem($id){
        $product = Products::findOrFail($id);
        $category = Category::get();
        return view('items.edit_item',compact('product','category'));
    }

    public function AddItems(Request $request) {
        $validateData = $request->validate([
            'category' => 'required',
            'product' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
            'description'=> 'required',
            'sku'=> 'required',
            'hsn'=> 'required',
            'uom'=> 'required',
            'weight'=> 'required',
            'volume'=> 'required',
            'taxrate'=> 'required',
            'price'=> 'required',
            'currency'=> 'required',
            'quantity'=> 'required',
        ],[
            'category.required'=> 'Please select category',
            'image.required'=> 'Please upload image',
            'product.required'=> 'Please enter product name',
            'description.required'=> 'Please enter product description',
            'sku.required'=> 'Please enter product SKU',
            'hsn.required'=> 'Please enter product HSN',
            'uom.required'=> 'Please enter product UOM',
            'weight.required'=> 'Please enter product weight',
            'volume.required'=> 'Please enter product volume',
            'taxrate.required'=> 'Please enter product taxrate',
            'price.required'=> 'Please enter product price',
            'currency.required'=> 'Please enter product currency',
            'quantity.required'=> 'Please enter product quantity',
        ]);

        // $dataImage = $request->image;
        $image = $request->file('image');
        $imagedata = $image->getContent();
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen .'.'. $img_ext;
        $uplocation = 'images/products/';
        $last_img = $uplocation . $img_name;

        // Storage::disk('public')->put($uplocation, $img_name);
        // $image->move($uplocation, $last_img);
        // echo $last_img;
        Storage::disk('public')->put($last_img,$imagedata);
    
        try {
                Products::insert([
                'category_id' => $request->category,
                'product_name' => $request->product,
                'product_image' => $last_img,
                'product_description'=> $request->description,
                'product_sku'=> $request->sku,
                'product_hsn'=> $request->hsn,
                'product_uom'=> $request->uom,
                'product_weight'=> $request->weight,
                'product_volume'=> $request->volume,
                'product_taxrate'=> $request->taxrate,
                'product_price'=> $request->price,
                'product_currency'=> $request->currency,
                'product_quantity'=> $request->quantity,
                'created_at' => Carbon::now()
            ]);

            
                return redirect()->back()->with('success', 'Items Added Successfully');
           
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding items');
        }
    }

    public function DeleteItem($id){
        $subCat = Products::findOrFail($id);
        $name = $subCat->product_name;
        // $img = $subCat->product_image;
        $oldImagePath = $subCat->product_image;
        // Delete the old image file from storage
        Storage::disk('public')->delete($oldImagePath);
        $subCat->delete();
        return redirect()->route('products')->with('delete',$name.' Deleted Successfully');
    }
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,txt|max:2048', // Adjust the allowed file types and maximum size
        ]);
    
        // Read the uploaded file
        $file = $request->file('file');
        $extension = $file->extension();
    
        // Begin transaction
        DB::beginTransaction();
    
        try {
            if ($extension == 'csv' || $extension == 'txt') {
                $fileData = file($file->getRealPath());
            } elseif ($extension == 'xlsx') {
                $fileData = Excel::toArray(new \stdClass(), $file);
                $fileData = $fileData[0]; // Assuming the first sheet contains data
            } else {
                // Handle unsupported file types
                throw new \Exception("Unsupported file type: $extension");
            }
    
            // Skip the first line
            array_shift($fileData);
    
            foreach ($fileData as $line) {
                // Process each row of the file
                
                // If it's an Excel file, $line is an array containing column values
                // If it's TXT or CSV, explode the line based on the delimiter
                $data = ($extension == 'xlsx') ? $line : (($extension == 'txt') ? explode("\t", $line) : explode(',', $line));
    
                // Process each data field
                // $category_id = $data[0];
                $product_name = $data[1];
                $product_image = $data[2];
                $product_description = $data[3];
                $product_sku = $data[4];
                $product_hsn = $data[5];
                $product_uom = $data[6];
                $product_weight = $data[7];
                $product_volume = $data[8];
                $product_taxrate = $data[9];
                $product_price = $data[10];
                $product_currency = $data[11];
                $product_quantity = $data[12];

                
                    $imageContents = file_get_contents($product_image);
                        
                    $fileextension = pathinfo($product_image, PATHINFO_EXTENSION);
                    $imagePath = 'images/products/' . uniqid() . '.' . $fileextension;
                    
                    // Save the image to storage
                    Storage::disk('public')->put($imagePath, $imageContents);

                    $category_name = trim($data[0]);
    
                    $category_id = DB::table('categories')->where('category_name', $category_name)->value('id');
        
                    if ($data[0] != null) {
                        $data[0] = $category_id;
                    } else {
                        $data[0] = 0;
                    }

                    $category_name = $data[0];
    
                // Save the data to the database
                Products::create([
                    'category_id' => $category_name,
                    'product_name' => trim($product_name),
                    'product_image' => trim($imagePath),
                    'product_description' => trim($product_description),
                    'product_sku' => trim($product_sku),
                    'product_hsn' => trim($product_hsn),
                    'product_uom' => trim($product_uom),
                    'product_weight' => trim($product_weight),
                    'product_volume' => trim($product_volume),
                    'product_taxrate' => trim($product_taxrate),
                    'product_price' => trim($product_price),
                    'product_currency' => trim($product_currency),
                    'product_quantity' => trim($product_quantity),
                    'created_at' => Carbon::now('Asia/Kolkata')
                ]);
            }
    
            // Commit transaction
            DB::commit();
    
            return redirect()->route('products')->with('success', 'Products has been successfully uploaded.');
        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollback();
    
            return redirect()->back()->with('error', 'Error uploading Products File'. $e->getMessage());
        }
    }
    public function UpdateProduct(Request $request, $id)
{
    $validateData = $request->validate([
        'category' => 'required',
        'product' => 'required',
        'image' => 'mimes:jpg,jpeg,png',
        'description' => 'required',
        'sku' => 'required',
        'hsn' => 'required',
        'uom' => 'required',
        'weight' => 'required',
        'volume' => 'required',
        'taxrate' => 'required',
        'price' => 'required',
        'currency' => 'required',
        'quantity' => 'required',
    ], [
        // Validation messages
        'category.required'=> 'Please select category',
        'image.required'=> 'Please upload image',
        'product.required'=> 'Please enter product name',
        'description.required'=> 'Please enter product description',
        'sku.required'=> 'Please enter product SKU',
        'hsn.required'=> 'Please enter product HSN',
        'uom.required'=> 'Please enter product UOM',
        'weight.required'=> 'Please enter product weight',
        'volume.required'=> 'Please enter product volume',
        'taxrate.required'=> 'Please enter product taxrate',
        'price.required'=> 'Please enter product price',
        'currency.required'=> 'Please enter product currency',
        'quantity.required'=> 'Please enter product quantity',

    ]);

    // Find the product by ID
    $product = Products::findOrFail($id);

    // Delete the old image if a new image is uploaded
    if ($request->hasFile('image')) {
        // Get the old image path
        $oldImagePath = $product->product_image;

        // Delete the old image file from storage
        Storage::disk('public')->delete($oldImagePath);

        // Upload the new image
        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $uplocation = 'images/products/';
        $last_img = $uplocation . $img_name;
        $image->storeAs($uplocation, $img_name, 'public');

        // Update the product with the new image path
        $product->update([
            'category_id' => $request->category,
            'product_name' => $request->product,
            'product_image' => $last_img,
            'product_description' => $request->description,
            'product_sku' => $request->sku,
            'product_hsn' => $request->hsn,
            'product_uom' => $request->uom,
            'product_weight' => $request->weight,
            'product_volume' => $request->volume,
            'product_taxrate' => $request->taxrate,
            'product_price' => $request->price,
            'product_currency' => $request->currency,
            'product_quantity' => $request->quantity,
        ]);
    } else {
        // If no new image is uploaded, update the record without changing the image
        $product->update([
            'category_id' => $request->category,
            'product_name' => $request->product,
            'product_description' => $request->description,
            'product_sku' => $request->sku,
            'product_hsn' => $request->hsn,
            'product_uom' => $request->uom,
            'product_weight' => $request->weight,
            'product_volume' => $request->volume,
            'product_taxrate' => $request->taxrate,
            'product_price' => $request->price,
            'product_currency' => $request->currency,
            'product_quantity' => $request->quantity,
        ]);
    }

    return redirect()->route('products')->with('success', 'Product updated successfully');
}


}

