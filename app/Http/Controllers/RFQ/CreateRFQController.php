<?php

namespace App\Http\Controllers\RFQ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RFQ\CreateRFQ;
use App\Models\Procurement\PR;
use App\Models\supplier\supplier;

class CreateRFQController extends Controller
{
    public function CRFQ(){
        $prs = PR::get();
        $suppliers = supplier::get();
        return view('supply.RFQ.createRFQ.create_rfq',compact('prs','suppliers'));
    }
}
