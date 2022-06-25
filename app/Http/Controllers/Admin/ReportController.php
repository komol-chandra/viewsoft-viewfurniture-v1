<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function orderReport()
    {
        return view('backend.orderreport.index');
    }
    public function Report(Request $request)
    {
        $from = $request->from;
        $to   = $request->to;
        $data = Order::whereBetween('created_at', [$from, $to])->with('Customer')->get();

        return view('backend.orderreport.index', compact('data'));
    }

    public function productReport()
    {
        $alldata = Product::where('is_deleted', 0)
            ->select(['product_name', 'id'])
            ->orderBy('id', 'DESC')->get();
        return view('backend.productreport.index', compact('alldata'));
    }
    public function productWiseReport(Request $request)
    {
        $alldata = Product::where('is_deleted', 0)
            ->select(['product_name', 'id'])
            ->orderBy('id', 'DESC')->get();

        if ($request->product == 'all') {

            $data = Product::select(['id', 'product_name', 'product_sku', 'product_qty', 'sell_qty'])->orderBy('sell_qty', 'DESC')->get();

            return view('backend.productreport.index', compact('alldata', 'data'));
        }
        if ($request->product != 'all') {
            $data = Product::where('id', $request->product)->select(['id', 'product_name', 'product_qty', 'product_sku', 'sell_qty'])->get();
            return view('backend.productreport.index', compact('alldata', 'data'));
        }
    }

    public function sectionProductReport(Request $request)
    {
        if ($request->product == 'all') {
            $alldata = Product::orderBy('sell_qty', 'DESC')->get();
            return view('backend.productreport.section_product_wish_index', compact('alldata'));

        } else if ($request->product == 'feature_product') {
            $alldata = Product::where('feature_product', 1)->orderBy('sell_qty', 'DESC')->get();
            return view('backend.productreport.section_product_wish_index', compact('alldata'));
        } else if ($request->product == 'trending_product') {
            $alldata = Product::where('trending_product', 1)->orderBy('sell_qty', 'DESC')->get();
            return view('backend.productreport.section_product_wish_index', compact('alldata'));
        } else if ($request->product == 'top_collection_product') {
            $alldata = Product::where('top_collection_product', 1)->orderBy('sell_qty', 'DESC')->get();
            return view('backend.productreport.section_product_wish_index', compact('alldata'));
        } else {
            $alldata = Product::orderBy('sell_qty', 'DESC')->get();
            return view('backend.productreport.section_product_wish_index', compact('alldata'));

        }
    }
}
