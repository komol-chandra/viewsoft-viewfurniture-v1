<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class BestSellProductReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function main(Request $request)
    {
        if ($request->from && $request->to) {
            $start_date = $request->from . " 00:00:00";
            $end_date   = $request->to . " 23:59:59";
            $data       = Product::isDeleted()->isActive()->isApprove()->orderBy('sell_qty', 'DESC')->get();
            $from_date  = $request->from;
            $to_date    = $request->to;
            return view('backend.report.best-sell.datalist', compact('data', 'from_date', 'to_date'));
        } else {
            $data = null;
            return view('backend.report.best-sell.index');
        }
    }
}
