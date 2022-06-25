<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\orderCommission;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use App\Models\WithdrawPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VendorPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
        // dd($request->all());
        if ($request->from && $request->to) {

            $start_date = $request->from . " 00:00:00";
            $end_date   = $request->to . " 23:59:59";
            $alldata    = WithdrawPayment::where('is_deleted', 0)->whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'DESC')->get();
            $wallet     = orderCommission::sum('vendor_payable');
            // $data       = User::whereBetween('created_at', [$start_date, $end_date])->get();
            $from_date = $request->from;
            $to_date   = $request->to;
            // dd($alldata);

            return view('backend.report.payment-request.search', compact('alldata', 'from_date', 'to_date', 'wallet'));
        } else {
            $alldata = WithdrawPayment::where('is_deleted', 0)->orderBy('id', 'DESC')->get();
            return view('backend.report.payment-request.index', \compact('alldata'));
        }

    }
    public function view($id)
    {
        $payment_requests = WithdrawPayment::where('is_deleted', 0)->where('id', $id)->first();
        $user             = User::where('id', $payment_requests->user_id)->first();
        $vendor           = $user;
        $allShop          = Shop::where('is_deleted', 0)->where('user_id', $payment_requests->user_id)->orderBy('id', 'DESC')->withCount('Product')->get();
        $product          = Product::where('user_id', $payment_requests->user_id)->count();
        $wallet           = orderCommission::where('user_id', $payment_requests->user_id)->sum('vendor_payable');
        $shop_single_id   = [$user->id];
        $shoplol          = $user->id;
        $order            = Order::where('company_id', 'like', "%{$shoplol}%")->count();
        // dd($order);
        return view('backend.report.payment-request.view', compact('order', 'vendor', 'product', 'allShop', 'payment_requests', 'user', 'wallet'));
    }
    public function pay(Request $request, $id)
    {
        $payment_requests = WithdrawPayment::where('is_deleted', 0)->where('id', $id)->first();
        $wallet           = orderCommission::where('user_id', $payment_requests->user_id)->sum('vendor_payable');
        if ((wallet($payment_requests->user_id) - paidAmount($payment_requests->user_id)) > $request->pay_amount && $request->pay_amount <= $payment_requests->request_amount) {

            $payment_requests->paid_amount    = $request->paid_amount;
            $payment_requests->paid_date      = Carbon::now()->format('Y-m-d');
            $payment_requests->paid_by        = auth()->user()->id;
            $payment_requests->payment_method = $request->payment_method;
            $payment_requests->transection_id = $request->transection_id;
            $payment_requests->paid_status    = 1;
            $insert                           = $payment_requests->save();
            if ($insert) {
                $notification = [
                    'messege'    => 'Payment success!',
                    'alert-type' => 'success',
                ];
                return redirect()->back()->with($notification);
            } else {
                $notification = [
                    'messege'    => 'Payment Faild!',
                    'alert-type' => 'error',
                ];
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = [
                'messege'    => 'Amount Big !',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

    }

    public function reject($id)
    {
        $payment_requests              = WithdrawPayment::where('is_deleted', 0)->where('id', $id)->first();
        $payment_requests->paid_status = 2;
        $insert                        = $payment_requests->save();
        if ($insert) {
            $notification = [
                'messege'    => 'reject success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'reject Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
}
