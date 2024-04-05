<?php

namespace App\Http\Controllers;
use App\Models\SubCatgory;
use App\Models\Category;
use Carbon\Carbon;

use Illuminate\Http\Request;

class subCatController extends Controller
{
    //
    public function SubCategory(){
        $subCat = SubCatgory::join('categories', 'categories.id', '=', 'sub_catgories.category_id')
              ->select('categories.category_name as category_name','categories.id as category_id', 'sub_catgories.item_name as item_name','sub_catgories.id as item_id','sub_catgories.id as sub_cartegoryId')
              ->paginate(5);
        return view("sub-category",compact("subCat"));
    }

    public function CreateItems(){
        $category = Category::get();
        return view("items.create_item",compact('category'));
    }
    
    public function EditItem($id){
        $subCat = SubCatgory::find($id);
        return view('items.edit_item',compact('subCat'));
    }

    public function AddItems(Request $request) {
        $validateData = $request->validate([
            'item_name' => 'required',
            'category_id' => 'required'
        ]);
    
        try {
            $insertion = SubCatgory::insert([
                'item_name' => $request->item_name,
                'category_id' => $request->category_id,
                'created_at' => Carbon::now()
            ]);
    
            if ($insertion) {
                return redirect()->back()->with('success', 'Items Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to add items');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding items');
        }
    }

    public function DeleteItem($id){
        $subCat = SubCatgory::findOrFail($id);
        $subCat->delete();
        return redirect()->back()->with('success','Item Deleted Successfully');
    }

}
