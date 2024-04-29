<?php

namespace App\Http\Controllers\PPS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\supplier\resource;
use App\Models\PPS\MPS;
use App\Models\Products;
use App\Models\OrderHeader;
use App\Models\OrderItem;
use DB;
use Carbon\Carbon;

class MPSController extends Controller
{
   /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function MPS(){
            try {

                // Retrieve all resources from the database
                $mps = DB::table('m_p_s')
                ->join('order_headers', 'order_headers.id', '=', 'm_p_s.product_id')
                ->select('m_p_s.*')
                ->get();
                $products = Products::all();
                $orders = OrderHeader::all();

                // Return the view with the list of suppliers
                return view("pps.mps.mps",compact("mps",'products','orders'));
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                // For example, you can return an error view or redirect with an error message
                return view("error")->with("error", "Failed to fetch resources: ".$e->getMessage());
            }
        }



        public function MPSFetchView(Request $request){
            $id = $request->input('id');
            $mpsdetails = MPS::where('id',$id)->first();

            $header_id = $mpsdetails->product_id;

            $plannedHeader = OrderHeader::where('id',$header_id)->first();

            $order_id  = $plannedHeader->order_id;

            $order_items = OrderItem::where('order_id',$order_id)->get();

            $totalTaxAmount = $order_items->sum('tax_amount');

            return response()->json([
                'success'=>true,
                'message'=>'Fetched Successfully',
                'mpsdetails'=>$mpsdetails,
                'plannedHeader'=> $plannedHeader,
                'order_items' =>  $order_items,
                'totalTaxAmount' => $totalTaxAmount
            ]);

        }



        /**
         * Add a new supplier.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function MPSAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "product_id"=> "required",
                        "conveyour_line"=>"required",
                        "planned_quantity"=> "required",
                        "planned_start_date"=> "required",
                        "planned_end_date"=> "required",
                        "status"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    MPS::insert([
                        "product_id"=> $request->product_id,
                        "conveyour_line"=> $request->conveyour_line,
                        "planned_quantity"=> $request->planned_quantity,
                        "planned_start_date"=> $request->planned_start_date,
                        "planned_end_date"=> $request->planned_end_date,
                        "status"=> $request->status,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Master production shedulled successfully");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function MPSEdit($encryptedId){
            $id = decrypt($encryptedId);
            $mps = MPS::findOrFail($id);
            $products = Products::all();
            return view("pps.mps.edit_update.mps_update",compact("mps",'products'));
        }

        public function MPSView($encryptedId){
            $id = decrypt($encryptedId);
            $mps = MPS::findOrFail($id);
            $products = Products::all();
            return view("pps.mps.edit_update.mps_view",compact("mps",'products'));
        }



        // Update Supplier
    public function MPSUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "product_id"=> "required",
                "planned_quantity"=> "required",
                "planned_start_date"=> "required",
                "planned_end_date"=> "required",
                "status"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                MPS::where('id',$id)->update([
                    "product_id"=> $request->product_id,
                    "planned_quantity"=> $request->planned_quantity,
                    "planned_start_date"=> $request->planned_start_date,
                    "planned_end_date"=> $request->planned_end_date,
                    "status"=> $request->status,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('master-production-shedule')->with('success', 'updated successfully!');
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
    public function MPSDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $mps = MPS::findOrFail($id);

            // Delete the supplier
            $mps->delete();

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
