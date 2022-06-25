<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ApproveShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // all approve product
    public function index()
    {
        $shops = Shop::isActive()->isDeleted()->get();
        return view('backend.approve-shop.index', compact('shops'));
    }

    public function approveWithCommission(Request $request)
    {
        $validated = $request->validate([
            'percent' => 'required',
        ]);
        $shop                     = Shop::find($request->id);
        $shop->commission_percent = $request->percent;
        $shop->is_approve         = 1;
        $insert                   = $shop->save();
        if ($insert) {
            $notification = [
                'messege'    => 'Approve success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Approve Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function edit($id)
    {
        $shop = Shop::find($id);
        // dd($shop);
        return \view('backend.approve-shop.edit', \compact('shop'));
    }

    public function update(Request $request)
    {

        $validated = $request->validate([
            'commission_percent' => 'required',
            'address'            => 'required',
            'shop_name'          => 'required',
        ]);
        $shop                     = Shop::find($request->id);
        $shop->commission_percent = $request->commission_percent;
        $shop->address            = $request->address;
        $shop->shop_name          = $request->shop_name;
        $insert                   = $shop->save();
        if ($insert) {
            $notification = [
                'messege'    => 'Update success!',
                'alert-type' => 'success',
            ];
            return redirect('/admin/approve/allshop')->with($notification);
        } else {
            $notification = [
                'messege'    => 'Update Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function approve($id)
    {
        $shop                                      = Shop::find($id);
        $shop->is_approve == 0 ? $shop->is_approve = 1 : $shop->is_approve = 0;
        $insert                                    = $shop->save();
        if ($insert) {
            $notification = [
                'messege'    => 'Status Change success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Status Change Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
}
