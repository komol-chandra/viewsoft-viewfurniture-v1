<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryWishSellReportController extends Controller
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
            $data       = Category::isDeleted()->isActive()->orderBy('id', 'DESC')->withCount('activeProduct', 'subCategory', 'reSubCategory')->get();

            $from_date = $request->from;
            $to_date   = $request->to;
            return view('backend.report.category-wish-sell.datalist', compact('data', 'from_date', 'to_date'));
        } else {
            $data = null;
            return view('backend.report.category-wish-sell.index');
        }
    }
    public function view($id)
    {
        $category = Category::where('id', $id)->select('name')->first();
        $data     = Product::where('category_id', $id)->get();
        return view('backend.report.category-wish-sell.view-product', \compact('data', 'category'));
    }
}
