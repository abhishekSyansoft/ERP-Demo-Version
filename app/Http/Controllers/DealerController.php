<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dealer;  //Dealer Model for connection table directly from the database 
use Carbon\Carbon;      // carbon class use to get the date

class DealerController extends Controller
{
// ---------------------------------------------------------------------------------------------------------------------------------------
    // get request from navbar when we click on dealer from navbar it will rediret to the dealers details page
    public function Dealer(){
        $dealers = Dealer::get();
        return view("dealers",compact("dealers"));
    }
    //End get request from navbar when we click on dealer from navbar it will rediret to the dealers details page
// ----------------------------------------------------------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------------------------------------------------------
    // get http request to rediret url to the add dealer page 
    public function AddDealer(){
        return view("dealer.add_dealer");
    }
    //End get http request to rediret url to the add dealer page 
// -----------------------------------------------------------------------------------------------------------------------------------------

// -----------------------------------------------------------------------------------------------------------------------------------------
// Add delaer data post http request
    public function StoreDealer(Request $request){
        // validation of all data comes from post method from the forms
        $validateData = $request->validate([
            "dealer_name"=> "required",
            "contact_person"=> "required",
            "contact_number"=> "required",
            "contact_email"=> "required",
            "dealership_located_city"=> "required",
            "dealership_located_state"=> "required",
            "dealership_located_country"=> "required",
            "dealership_taxid"=> "required",
            "dealership_licence_number"=> "required",
            "dealership_registration_date"=> "required",
            "dealership_licence_renewal_date"=> "required",
            "dealership_status"=> "required",
        ],[
            "dealer_name.required",
            "contact_person.required",
            "contact_number.required",
            "contact_email.required",
            "dealership_located_city.required",
            "dealership_located_state.required",
            "dealership_located_country.required",
            "dealership_taxid.required",
            "dealership_licence_number.required",
            "dealership_registration_date.required",
            "dealership_licence_renewal_date.required",
            "dealership_status.required",
        ]);
        //End  validation of all data comes from post method from the forms

        // data insertion process through model concat ia $request.fieldname

        Dealer::insert([
            'dealership_name'=> $request->dealer_name,
            'dealership_contact_person'=> $request->contact_person,
            'dealership_contact_number'=> $request->contact_number,
            'dealership_contact_email'=> $request->contact_email,
            'dealership_contact_address'=> $request->contact_address,
            'dealership_located_city'=> $request->dealership_located_city,
            'dealership_located_state'=> $request->dealership_located_state,
            'dealership_located_country'=> $request->dealership_located_country,
            'dealership_located_pincode'=> $request->dealership_located_pincode,
            'dealership_type'=> $request->dealership_type,
            'dealership_business_type'=> $request->dealership_business_type,
            'dealership_associated_brand'=> $request->dealership_associated_brands,
            'dealership_sales_territory'=> $request->dealership_sales_territory,
            'dealership_taxid'=> $request->dealership_taxid,
            'dealership_licence_number'=> $request->dealership_licence_number,
            'dealership_registration_date'=> $request->dealership_registration_date,
            'dealership_licence_renewal_date'=> $request->dealership_licence_renewal_date,
            'dealership_status'=> $request->dealership_status,
            'dealership_notes'=> $request->dealership_notes,
            'created_at' => Carbon::now()
        ]);
        //End data insertion process through model concat ia $request.fieldname
        return redirect()->route('dealers')->with('success',$request->dealer_name.' Dealer added successfully'); //Redirect back url after successfull transaction
    }
    //End Add delaer data post http request
// -----------------------------------------------------------------------------------------------------------------------------------

// -----------------------------------------------------------------------------------------------------------------------------------
    //delete delaer data get http request through id from the database
    public function DeleteDealer($encryptedId){
        $id = decrypt($encryptedId);
        $dealer = Dealer::findOrFail($id);
        $name = $dealer->name;
        $dealer->delete();
        return redirect()->route('dealers')->with('delete',$name.' Dealer deleted successfully');
    }
    //delete delaer data get http request through id from the database
// -----------------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------------
    // get http request from dealer details page via edit button which get an id usefull for select data from data base where id == get ID
    public function EditDealer($encryptedId){
        $id = decrypt($encryptedId);
        $dealer = Dealer::findOrFail($id);
        return view('dealer.update_dealer', compact('dealer'));
    }
    // get http request from dealer details page via edit button which get an id usefull for select data from data base where id == get ID
// ------------------------------------------------------------------------------------------------------------------------------------

// ------------------------------------------------------------------------------------------------------------------------------------
// Update http request by post methods consisting of reqested elements and and id for select particular row
    public function UpdateDealer(Request $request,$encryptedId){
        $id = decrypt($encryptedId);
        $validateData = $request->validate([
            "dealer_name"=> "required",
            "contact_person"=> "required",
            "contact_number"=> "required",
            "contact_email"=> "required",
            "dealership_located_city"=> "required",
            "dealership_located_state"=> "required",
            "dealership_located_country"=> "required",
            "dealership_taxid"=> "required",
            "dealership_licence_number"=> "required",
            "dealership_registration_date"=> "required",
            "dealership_licence_renewal_date"=> "required",
            "dealership_status"=> "required",
        ],[
            "dealer_name.required",
            "contact_person.required",
            "contact_number.required",
            "contact_email.required",
            "dealership_located_city.required",
            "dealership_located_state.required",
            "dealership_located_country.required",
            "dealership_located_pincode.required",
            "dealership_taxid.required",
            "dealership_licence_number.required",
            "dealership_registration_date.required",
            "dealership_licence_renewal_date.required",
            "dealership_status.required",
        ]);

        Dealer::find($id)->update([
            'dealership_name'=> trim($request->dealer_name),
            'dealership_contact_person'=> trim($request->contact_person),
            'dealership_contact_number'=> trim($request->contact_number),
            'dealership_contact_email'=> trim($request->contact_email),
            'dealership_contact_address'=> trim($request->contact_address),
            'dealership_located_city'=> trim($request->dealership_located_city),
            'dealership_located_state'=> trim($request->dealership_located_state),
            'dealership_located_country'=> trim($request->dealership_located_country),
            'dealership_located_pincode'=> trim($request->dealership_located_pincode),
            'dealership_type'=> trim($request->dealership_type),
            'dealership_business_type'=> trim($request->dealership_business_type),
            'dealership_associated_brand'=> trim($request->dealership_associated_brands),
            'dealership_sales_territory'=> trim($request->dealership_sales_territory),
            'dealership_taxid'=> trim($request->dealership_taxid),
            'dealership_licence_number'=> trim($request->dealership_licence_number),
            'dealership_registration_date'=> trim($request->dealership_registration_date),
            'dealership_licence_renewal_date'=> trim($request->dealership_licence_renewal_date),
            'dealership_status'=> trim($request->dealership_status),
            'dealership_notes'=> trim($request->dealership_notes),
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('dealers')->with('success',$request->dealer_name.' updated successfully');
        // $dealer = Dealer::findOrFail($id);
    }
    // Update http request by post methods consisting of reqested elements and and id for select particular row
// ----------------------------------------------------------------------------------------------------------------------------------------------

}
