<?php

namespace App\Http\Controllers\DPF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\DPF\SOP;
use App\Models\Products;
use App\Models\DPF\DF;
use DB;
use Carbon\Carbon;

class SOPController extends Controller
{
    /**
         * Display all suppliers.
         *
         * @return \Illuminate\View\View
         */
        public function SOP(){
            try {

                // Retrieve all resources from the database
                $sop = DB::table('s_o_p_s')
                ->join('d_f_s', 'd_f_s.id', '=', 's_o_p_s.forecast_id')
                ->join('products', 'products.id', '=', 's_o_p_s.forecast_id')
                ->join('m_p_s', 'm_p_s.id', '=', 's_o_p_s.production_plan_id')
                ->select('s_o_p_s.*', 'd_f_s.product_id as forecast_product_id', 'm_p_s.product_id as production_plan_product_id','products.product_name')
                ->get();
                $products = Products::all();

                $forecastings = DB::table('d_f_s')
                ->join('products', 'products.id', '=', 'd_f_s.product_id')
                ->select('d_f_s.*', 'products.product_name as product_name')
                ->get();

                $productions = DB::table('m_p_s')
                ->join('products', 'products.id', '=', 'm_p_s.product_id')
                ->select('m_p_s.*', 'products.product_name as product_name')
                ->get();

                // Return the view with the list of suppliers
                return view("supply.demand.sop.sop",compact("sop",'products',"forecastings",'productions'));
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
        public function SOPAdd(Request $request){
            try {
                // Validate the incoming request data
               
                    $validatData = $request->validate([
                        "forecasting_id"=> "required",
                        "production_plan_id"=> "required",
                        "sales_target"=> "required",
                        "production_target"=> "required",
                    ]);
                    // Retrieve the supplier from the database
                    SOP::insert([
                        "forecast_id"=> $request->forecasting_id,
                        "production_plan_id"=> $request->production_plan_id,
                        "sales_target"=> $request->sales_target,
                        "production_target"=> $request->production_target,
                        'created_at' => Carbon::now()
                    ]);

                // Redirect back with success message if successful
                return redirect()->back()->with("success","Successfully Added");
            } catch (\Exception $e) {
                // Log the error or handle it in any other appropriate way
                return redirect()->back()->with("error","Failed to create Master production shedulled: ".$e->getMessage());
            }
        }

        public function SOPEdit($encryptedId){
            $id = decrypt($encryptedId);
            $sop = SOP::findOrFail($id);
            $forecastings = DB::table('d_f_s')
            ->join('products', 'products.id', '=', 'd_f_s.product_id')
            ->select('d_f_s.*', 'products.product_name as product_name')
            ->get();

            $productions = DB::table('m_p_s')
            ->join('products', 'products.id', '=', 'm_p_s.product_id')
            ->select('m_p_s.*', 'products.product_name as product_name')
            ->get();
            return view("supply.demand.sop.edit_update.sop_update",compact("sop",'forecastings','productions'));
        }



        // Update Supplier
    public function SOPUpdate(Request $request, $encryptedId)
    {
        try {

            $validatData = $request->validate([
                "forecasting_id"=> "required",
                "production_plan_id"=> "required",
                "sales_target"=> "required",
                "production_target"=> "required",
            ]);
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
                // Retrieve the supplier from the database
                SOP::where('id',$id)->update([
                    "forecast_id"=> $request->forecasting_id,
                    "production_plan_id"=> $request->production_plan_id,
                    "sales_target"=> $request->sales_target,
                    "production_target"=> $request->production_target,
                ]);

            // Update supplier details with the data from the request
          

            // Optionally, you can also update individual fields like this:
            // $supplier->supplier_name = $request->input('supplier_name');
            // $supplier->contact_person = $request->input('contact_person');
            // ...

            // Save the changes

            // Redirect the user to the supplier details page or any other appropriate page
            return redirect()->route('sales-operations-planning')->with('success', 'updated successfully!');
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
    public function SOPDelete($encryptedId)
    {
        try {
            // Decrypt the encrypted ID to get the actual supplier ID
            $id = decrypt($encryptedId);
            
            // Find the supplier by its ID
            $sop = SOP::findOrFail($id);

            // Delete the supplier
            $sop->delete();

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
