<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\supplier\Supplier;
use Illuminate\Http\Request;

class supplierController extends Controller
{
    public function Supplier(){
        $supplier = Supplier::all();
        return view("supply.master.suppliermanagement.supplie_management",compact("supplier"));
    }
}
