<?php

namespace App\Http\Controllers\RFQ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompListController extends Controller
{
    public function CSRF(){
        return view('supply.RFQ.completeList.comp_list');
    }
}
