<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class categoryController extends Controller
{
    public function Category(){
        $category = DB::table('categories as head')
        ->select('head.id', DB::raw('CASE WHEN head.parent_id != 0 THEN (SELECT category_name FROM categories WHERE id = head.parent_id) ELSE head.parent_id END AS parent'), 'head.category_name')
        ->paginate(10);
        return view("category",compact("category"));
    }

    

    public function createView(){
        $category = Category::all()->where('parent_id',"=",0);
        return view("category.create_category",compact("category"));
    }

    public function AddCategory(Request $request){
        $validateData = $request->validate([
            "category1"=> "required",
        ]);
    
        Category::insert([
            "category_name"=> $request->category1,
            "parent_id" => 0,
            "created_at" => Carbon::now(),
        ]);
    
        return redirect()
        ->route('category')
        ->with("success",$request->category1." Category Added successfully");
       }

       public function AddSubCategory(Request $request){
        $validateData = $request->validate([
            "subcategory"=> "required",
            "category"=> "required",
        ]);
    
        Category::insert([
            "category_name"=> $request->subcategory,
            "parent_id" => $request->category,
            "created_at" => Carbon::now(),
        ]);
    
        return redirect()
        ->route('category')
        ->with("success",$request->subcategory."Category Added successfully");
       }


       public function upload(Request $request) {
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
            if ($extension == 'txt' || $extension == 'csv') {
                $fileData = file($file->getRealPath());
            } elseif ($extension == 'xlsx') {
                $fileData = Excel::toArray(new \stdClass(), $file);
                $fileData = $fileData[0]; // Assuming the first sheet contains data
            } else {
                // Handle other file types if needed
                throw new \Exception("Unsupported file type: $extension");
            }
    
            $skipFirstLine = true;
            foreach ($fileData as $line) {
                if ($skipFirstLine) {
                    $skipFirstLine = false; // Skip the first line
                    continue;
                }
    
                // If it's an Excel file, $line is an array containing column values
                // If it's TXT, explode the line based on the delimiter
                $data = ($extension == 'txt') ? explode("\t", $line) : $line;
                $data = ($extension == 'csv') ? explode(',', $line) : $line;
    
                $category_name = $data[0];
    
                $result = DB::table('categories')->where('category_name', $category_name)->value('id');
    
                if ($data[0] != null) {
                    $data[0] = $result;
                } else {
                    $data[0] = 0;
                }
    
                Category::insert([
                    'parent_id' => trim($data[0]),
                    'category_name' => trim($data[1]), // Adjust column names as per your database schema
                    // Add more columns as needed
                    'created_at' => Carbon::now(),
                ]);
            }
    
            // Commit transaction
            DB::commit();
    
            return redirect()->route('category')->with('success', 'Data has been successfully uploaded.');
        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollback();
    
            return redirect()->back()->with('error', 'Error uploading data: ' . $e->getMessage());
        }
    }




    // category Edit function 

    public function Edit($id){
        $category = Category::find($id);
        $categoryall = Category::get();
        return view('category.edit_category', compact('category','categoryall'));
    }

    //End category Edit function 

     // update category function 

     public function UpdateCategory(Request $request,$id){
        $validateData = $request->validate([
            "category1"=> "required",
        ]);

         $category = Category::find($id)->update([
            "category_name"=> $request->category1,
            "parent_id"=> 0,
        ]);
        return redirect()->route('category')->with("success",$request->category1."Category updated successfully");
    }
    //End update category function 

    // update category function 
    public function UpdateSubCategory(Request $request,$id){
        $validateData = $request->validate([
            "subcategory"=> "required",
            "category"=> "required",
        ]);

        $category = Category::find($id)->update([
            "category_name"=> $request->subcategory,
            "parent_id"=> $request->category,
        ]);
        return redirect()->route('category')->with("success",$request->subcategory."Category updated successfully");
    }
    //End update category function 
    
}
