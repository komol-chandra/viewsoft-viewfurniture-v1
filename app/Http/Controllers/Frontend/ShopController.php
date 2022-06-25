<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ShopController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $allShop = Shop::withCount('Product')->isActive()->isUser()->orderBy('id', 'DESC')->get();
        // dd($allShop);
        $allShopcategory = ShopCategory::isActive()->get();

        $countShops           = Shop::isUser()->count();
        $countUnapprovedShops = Shop::isUser()->isActive()->where('is_approve', 0)->count();
        $countActiveShops     = Shop::isUser()->isActive()->where('is_approve', 1)->count();

        return view('frontend.vendor.shop.index', compact('allShop', 'allShopcategory', 'countShops', 'countUnapprovedShops', 'countActiveShops'));

    }

    public function shopProduct($id)
    {
        $allProduct = Product::with('Category')->isUser()->isDeleted()->where('shop_id', $id)->select(['id', 'product_name', 'product_sku', 'image', 'product_price', 'category_id', 'shop_id'])->orderBy('id', 'DESC')->get();
        $shop       = Shop::find($id);
        $shopName   = $shop->shop_name;
        // dd($allProduct);
        return view('frontend.vendor.shop.shop-products', compact('allProduct', 'shopName'));
    }
    //
    public function store(Request $request)
    {

        $insert = Shop::insert([
            'shop_name'       => $request->name,
            'user_id'         => Auth::user()->id,
            'shopcategory_id' => $request->shop_category,
            'address'         => $request->shop_address,
            'created_at'      => Carbon::now(),
        ]);
        if ($insert) {
            Alert::toast('Insert Success', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Insert Faild!', 'error');
            return redirect()->back();
        }
    }
    // edit
    public function edit($id)
    {

        $data = Shop::where('id', $id)->select(['id', 'shop_name', 'address', 'shopcategory_id'])->first();
        return response()->json($data);
    }
    // update
    public function update(Request $request)
    {

        $insert = Shop::where('id', $request->id)->update([
            'shop_name'       => $request->name,
            'shopcategory_id' => $request->shop_category,
            'address'         => $request->shop_address,
            'updated_at'      => Carbon::now(),
        ]);
        if ($insert) {
            Alert::toast('Update Success!', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Update Faild!', 'error');
            return redirect()->back();
        }
    }
    //
    public function delete($id)
    {
        $delete = Shop::where('id', $id)->update([
            'is_deleted' => 1,
        ]);
        if ($delete) {
            Alert::toast('Delete Success!', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Delete Faild!', 'error');
            return redirect()->back();
        }

    }
}
