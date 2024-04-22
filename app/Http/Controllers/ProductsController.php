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
use Illuminate\Support\HtmlString;

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
    
            $failCount = 0; // Counter for failed rows due to insufficient data
            $failedRows = []; // Array to store details about failed rows
    
            foreach ($fileData as $index => $line) {
                // Process each row of the file
    
                // If it's an Excel file, $line is an array containing column values
                // If it's TXT or CSV, explode the line based on the delimiter
                $data = ($extension == 'xlsx') ? $line : (($extension == 'txt') ? explode("\t", $line) : explode(',', $line));
    
                    // Check if any data field is empty
                    $isEmpty = false;
                    foreach ($data as $field) {
                        if (empty(trim($field))) {
                            $isEmpty = true;
                            break;
                        }
                    }

                    if ($isEmpty || count($data) < 13) { // Adjust according to the number of fields expected
                        $failCount++; // Increment fail count
                        $failedRows[] = $index + 2; // Store the row number (index + 2 because 0-indexed and skip header)
                        continue; // Skip this iteration
                    }
    
                // Process each data field
                $category_name = trim($data[0]);
                $product_name = trim($data[1]);
                $product_image = trim($data[2]);
                $product_description = trim($data[3]);
                $product_sku = trim($data[4]);
                $product_hsn = trim($data[5]);
                $product_uom = trim($data[6]);
                $product_weight = trim($data[7]);
                $product_volume = trim($data[8]);
                $product_taxrate = trim($data[9]);
                $product_price = trim($data[10]);
                $product_currency = trim($data[11]);
                $product_quantity = trim($data[12]);
    
                // Save the image to storage
                $imageContents = file_get_contents($product_image);
                $fileextension = pathinfo($product_image, PATHINFO_EXTENSION);
                $imagePath = 'images/products/' . uniqid() . '.' . $fileextension;
                Storage::disk('public')->put($imagePath, $imageContents);
    
                // Fetch category ID
                $category_id = DB::table('categories')->where('category_name', $category_name)->value('id');
    
                // Assign default category ID if not found
                $category_id = $category_id ? $category_id : 0;
    
                // Save the data to the database
                Products::create([
                    'category_id' => $category_id,
                    'product_name' => $product_name,
                    'product_image' => $imagePath,
                    'product_description' => $product_description,
                    'product_sku' => $product_sku,
                    'product_hsn' => $product_hsn,
                    'product_uom' => $product_uom,
                    'product_weight' => $product_weight,
                    'product_volume' => $product_volume,
                    'product_taxrate' => $product_taxrate,
                    'product_price' => $product_price,
                    'product_currency' => $product_currency,
                    'product_quantity' => $product_quantity,
                    'created_at' => Carbon::now('Asia/Kolkata')
                ]);
            }

            $totalRows = count($fileData);
            $successfulRows = $totalRows - $failCount;
            
    
            // Commit transaction
            DB::commit();
    
            if ($failCount > 0) {
                $message = "<br><br>Products have been successfully uploaded.<br><br>$failCount row(s) failed due to some mistake in data check carefully.<br><br>Failed row number: " . implode(', ', $failedRows) . " row(s).<br><br>Successfully inserted rows: $successfulRows";
                return redirect()->route('products')->with('success', new HtmlString($message));
            } else {
                return redirect()->route('products')->with('success', 'Products have been successfully uploaded.');
            }
        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollback();
    
            return redirect()->back()->with('error', 'Error uploading Products File: ' . $e->getMessage());
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

