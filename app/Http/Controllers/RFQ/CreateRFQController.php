<?php

namespace App\Http\Controllers\RFQ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RFQ\CreateRFQ;

class CreateRFQController extends Controller
{
    public function CRFQ(){
        return view('supply.RFQ.createRFQ.create_rfq');
    }
}
