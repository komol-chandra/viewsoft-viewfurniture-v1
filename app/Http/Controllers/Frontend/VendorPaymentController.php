<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\orderCommission;
use App\Models\User;
use App\Models\WithdrawPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class VendorPaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function paymentHistory()
    {
        $id               = auth()->user()->id;
        $orders           = Order::where('company_id', 'like', "%{$id}%")->isDeleted()->count();
        $pendingOrders    = Order::where('company_id', 'like', "%{$id}%")->isDeleted()->isPending()->count();
        $processingOrders = Order::where('company_id', 'like', "%{$id}%")->isDeleted()->isProcessing()->count();
        $deliveredOrders  = Order::where('company_id', 'like', "%{$id}%")->isDeleted()->isDelivered()->count();
        $alldata          = WithdrawPayment::where('user_id', auth()->user()->id)->where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        $wallet           = orderCommission::where('user_id', auth()->user()->id)->sum('vendor_payable');
        $paid_amount      = WithdrawPayment::where('user_id', auth()->user()->id)->where('is_deleted', 0)->sum('paid_amount');
        return view('frontend.vendor.payment.history', compact('alldata', 'wallet', 'paid_amount', 'orders', 'pendingOrders', 'deliveredOrders', 'processingOrders'));
    }
    public function paymentRequest(Request $request)
    {
        $wallet = orderCommission::where('user_id', auth()->user()->id)->sum('vendor_payable');
        if ($request->request_amount > (paidAmount(auth()->user()->id))) {
            $notification = [
                'messege'    => 'Amount Bigger Than Wallet!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        } else {
            $vendor                = User::find(auth()->user()->id);
            $model                 = new WithdrawPayment();
            $model->user_id        = auth()->user()->id;
            $model->company_id     = $vendor->id;
            $model->request_amount = $request->request_amount;
            $model->request_date   = Carbon::now()->format('Y-m-d');
            $model->paid_status    = 0;
            $model->request_amount = $request->request_amount;
            $insert                = $model->save();
            if ($insert) {
                Alert::toast('Payment Request Send Successfully', 'success');
                return redirect()->back();
            } else {
                Alert::toast('Payment Request Send Faild!', 'error');
                return redirect()->back();
            }
        }

    }
}
