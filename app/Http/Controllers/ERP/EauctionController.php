<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EauctionController extends Controller
{
    public function EAuction(){
        $suppliers = DB::table('suppliers')->get();
        return view('ERP.Auction.Initiate.initiate_auction',compact('suppliers'));
    }


    public function ScrapItems(){
        $scrapItems = DB::table('scrap')->orderBy('id','desc')->get();
        $parts = DB::table('parts')->get();
        // return view('ERP.Auction.Initiate.initiate_auction',compact('scrapItems'));
        return view('ERP.Auction.Initiate.scrap',compact('parts','scrapItems'));
    }
}
