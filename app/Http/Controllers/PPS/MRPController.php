<?php

namespace App\Http\Controllers\PPS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\supplier\resource;
use App\Models\PPS\MRP;
use App\Models\RawMaterial;;
use App\Models\Products;
use App\Models\Inventory\Vehicles;
use DB;
use Carbon\Carbon;
class MRPController extends Controller
{
   /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function MRP(){
            try {

                // Retrieve all resources from the database
                $mrp = MRP::all();
                $mrp = DB::table('m_rps')
                ->join('raw_materials', 'raw_materials.id', '=', 'm_rps.material_id')
                ->select('m_rps.*', 'raw_materials.material_name as material')
                ->get();
                $materials = RawMaterial::all();
                $vehicles  = Vehicles::all();

                // Return the view with the list of suppliers
                return view("pps.mrp.mrp",compact("mrp",'materials','vehicles'));
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                // For example, you can return an error view or redirect with an error message
                return view("error")->with("error", "Failed to fetch resources: ".$e->getMessage());
            }
        }



        public function MRPListItems(Request $request){
            $product_id = $request->input('id');

            $items = DB::table('bom_lists')
            ->join('allocations', DB::raw('CONVERT(bom_lists.product_name USING utf8mb4) COLLATE utf8mb4_unicode_ci'), '=', DB::raw('CONVERT(allocations.category USING utf8mb4) COLLATE utf8mb4_unicode_ci'))
            ->where('bom_lists.product_id', $product_id)
            ->select(['bom_lists.*', 'allocations.current_stock_level as current_stock'])
            ->get();
            
            return response()->json([
                'success' => true,
                'message' => 'Data Fetched successfully',
                'product_id' => $product_id,
                'items' => $items
            ]);
        }



        /**
         * Add a new supplier.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function MRPAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "material_id"=> "required",
                        "quantity_required"=> "required",
                        "due_date"=> "required",
                        "order_type"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    MRP::insert([
                        "material_id"=> $request->material_id,
                        "quantity_required"=> $request->quantity_required,
                        "due_date"=> $request->due_date,
                        "order_type"=> $request->order_type,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Added Material requirment successfully");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create: ".$e->getMessage());
            }
        }

        public function MRPEdit($encryptedId){
            $id = decrypt($encryptedId);
            $mrp = MRP::findOrFail($id);
            $materials = RawMaterial::all();
            return view("pps.mrp.edit_update.update_mrp",compact("mrp",'materials'));
        }



        // Update Supplier
    public function MRPUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "material_id"=> "required",
                "quantity_required"=> "required",
                "due_date"=> "required",
                "order_type"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
            MRP::where('id',$id)->update([
                "material_id"=> $request->material_id,
                "quantity_required"=> $request->quantity_required,
                "due_date"=> $request->due_date,
                "order_type"=> $request->order_type,
                'created_at' => Carbon::now()
            ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('material-requirement-management')->with('success', 'updated successfully!');
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
    public function MRPdelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $mrp = MRP::findOrFail($id);

            // Delete the supplier
            $mrp->delete();

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
}
