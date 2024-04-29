<?php

namespace App\Http\Controllers\RFQ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendRFQController extends Controller
{
    public function SRFQ(){
        return view('supply.RFQ.sendRFQ.send_rfq');
    }
}
