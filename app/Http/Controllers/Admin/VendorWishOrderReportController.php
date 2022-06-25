<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\VendorCompany;
use Illuminate\Http\Request;

class VendorWishOrderReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function main(Request $request)
    {
        $vendors = User::isActive()->isDeleted()->isVendor()->select(['id', 'name'])->get();
        if ($request->vendor && $request->from && $request->to) {
            $start_date  = $request->from . " 00:00:00";
            $end_date    = $request->to . " 23:59:59";
            $data        = Order::whereJsonContains('company_id', [$request->vendor])->whereBetween('created_at', [$start_date, $end_date])->with('Customer')->get();
            $vendor      = VendorCompany::find($request->vendor);
            $vendor_name = $vendor->name;
            $from_date   = $request->from;
            $to_date     = $request->to;
            return view('backend.report.vendor-wish-order.vendor-wish-order', compact('vendors', 'data', 'vendor_name', 'from_date', 'to_date'));
        } else {
            $data = null;
            return view('backend.report.vendor-wish-order.index', \compact('vendors'));
        }
    }
}
