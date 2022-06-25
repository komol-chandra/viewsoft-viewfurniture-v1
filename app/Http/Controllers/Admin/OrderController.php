<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\orderCommission;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allneworder()
    {

        $alldata = Order::where('order_status', 0)->orderBy('id', 'DESC')->get();

        return view('backend.order.neworder', compact('alldata'));
    }
    public function invoiceOrder($id)
    {

        $data = Order::where('id', $id)->first();
        // dd($data);
        $user = User::find($data->customer_id);
        return view('backend.order.invoice', compact('data', 'user'));
    }
    //
    public function updateOrder($id)
    {
        $data = Order::where('id', $id)->first();
        return view('backend.order.orderupdate', compact('data'));
    }
    // update order controller
    public function updateOrderSubmit(Request $request)
    {

        $product_data = [];
        $company_data = [];
        $total_price  = 0;
        $total_item   = 0;
        $total_qty    = 0;
        foreach ($request->id as $key => $item) {
            $products[] = [
                'id'           => $request->id[$key],
                'product_name' => $request->product_name[$key] ?? '',
                'image'        => $request->image[$key] ?? '',
                'sku'          => $request->sku[$key] ?? '',
                'shop_id'      => $request->shop_id[$key] ?? '',
                'qty'          => $request->qty[$key] ?? '',
                'price'        => $request->price[$key] ?? '',
                'subtotal'     => $request->subtotal[$key] ?? '',
            ];
            $company_id = $request->shop_id[$key];
            array_push($company_data, $company_id);
            $total_item++;
            $total_qty   = $total_qty + $request->qty[$key];
            $total_price = $total_price + $request->subtotal[$key];
        }

        $update = Order::where('id', $request->row_id)->update([
            'products'     => json_encode($products),
            'total_item'   => $total_item,
            'total_qty'    => $total_qty,
            'cart_total'   => $total_price,
            'company_id'   => $company_data,
            'total_amount' => $total_price + $request->delivery_charge,
        ]);
        if ($update) {
            $notification = [
                'messege'    => 'Insert success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'insert Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

    }

    //
    public function Processingstatus($id)
    {
        $update = Order::where('id', $id)->update([
            'order_status' => 1,
        ]);
        if ($update) {
            $notification = [
                'messege'    => ' success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => ' Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    //
    public function deleverorder($id)
    {

        $update = Order::where('id', $id)->update([
            'order_status' => 3,
        ]);
        $productsellqtyupdate = Order::where('id', $id)->first();

        foreach (json_decode($productsellqtyupdate->products) as $key => $nproduct) {

            $product_check = Product::where('id', $nproduct->id)->select(['user_id', 'shop_id'])->first();

            $shop_commission = Shop::where('id', $product_check->shop_id)->select(['commission_percent', 'company_id'])->first();

            $product_commision = $nproduct->price * ($shop_commission->commission_percent / 100);

            $website_payable = $nproduct->qty * $product_commision;

            $vendor_payable = ($nproduct->qty * $nproduct->price) - $website_payable;

            $insert = orderCommission::insert([
                'order_id'        => $productsellqtyupdate->order_id,
                'user_id'         => $product_check->user_id,
                'company_id'      => $shop_commission->company_id,
                'shop_id'         => $product_check->shop_id,
                'product_id'      => $nproduct->id,
                'product_qty'     => $nproduct->qty,
                'product_price'   => $nproduct->price,
                'total_price'     => $nproduct->qty * $nproduct->price,
                'shop_commission' => $shop_commission->commission_percent,
                'website_payable' => $website_payable,
                'vendor_payable'  => $vendor_payable,
                'created_at'      => Carbon::now()->toDateTimeString(),
            ]);

            $sell_qty = Product::where('id', $nproduct->id)->update([
                'sell_qty' => Product::where('id', $nproduct->id)->first()->sell_qty + $nproduct->qty,
            ]);

        }

        if ($update) {
            $notification = [
                'messege'    => ' success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => ' Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

    }
    //
    public function rehjectorder($id)
    {
        $update = Order::where('id', $id)->update([
            'order_status' => 2,
        ]);
        if ($update) {
            $notification = [
                'messege'    => ' success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => ' Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function returnorder($id)
    {
        $update = Order::where('id', $id)->update([
            'order_status' => 4,
        ]);
        if ($update) {
            $notification = [
                'messege'    => ' success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => ' Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function processingorder()
    {
        $alldata = Order::where('order_status', 1)->orderBy('id', 'DESC')->get();
        return view('backend.order.processingorder', compact('alldata'));
    }

    public function allrejectorder()
    {
        $alldata = Order::where('order_status', 2)->orderBy('id', 'DESC')->get();
        return view('backend.order.rejectorder', compact('alldata'));
    }
    public function alldeleverorder()
    {
        $alldata = Order::where('order_status', 3)->orderBy('id', 'DESC')->get();
        return view('backend.order.delivery', compact('alldata'));
    }

    public function sectionWishOrder(Request $request)
    {
        if ($request->order_type == 'all') {
            $alldata = Order::latest()->get();
        } else if ($request->order_type == '0' || $request->order_type == '1' || $request->order_type == '2' || $request->order_type == '3' || $request->order_type == '4' || $request->order_type == '5') {
            $alldata = Order::where('order_status', $request->order_type)->latest()->get();
        } else {
            $alldata = Order::latest()->get();
        }
        return view('backend.order.all-order.index', compact('alldata'));
    }
}
