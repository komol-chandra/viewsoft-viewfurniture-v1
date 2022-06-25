<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\orderCommission;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WithdrawPayment;
use Illuminate\Http\Request;

class VendorApproveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = User::where('is_vendor', 1)->where('is_vendor_approve', 0)->isDeleted()->get();
        return view('backend.approve-vendor.index', \compact('vendors'));
    }

    public function approve($id)
    {
        $vendor = User::find($id);
        if ($vendor->is_vendor_approve == 0) {
            $vendor->is_vendor_approve = 1;
            $insert                    = $vendor->save();

            $check = Wallet::where('user_id', $vendor->id)->where('wallet_type', 'vendor_bonus')->first();
            if ($check) {
                $check->is_deleted = 0;
                $insert            = $check->save();
            }

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
        } else {
            $notification = [
                'messege'    => 'Nothing to do!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor = User::find($id);
        // $payment_requests = null;
        $payment_requests = WithdrawPayment::where('is_deleted', 0)->where('user_id', $vendor->id)->get();
        $allShop          = Shop::where('is_deleted', 0)->where('user_id', $vendor->id)->orderBy('id', 'DESC')->withCount('Product')->get();
        $product          = Product::where('user_id', $vendor->id)->count();
        $wallet           = orderCommission::where('user_id', $vendor->id)->sum('vendor_payable');
        $shop_single_id   = [$vendor->id];
        $shoplol          = $vendor->id;
        $order            = Order::where('company_id', 'like', "%{$shoplol}%")->count();
        // dd($order);
        return view('backend.approve-vendor.view', compact('order', 'vendor', 'product', 'allShop', 'payment_requests', 'wallet'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
