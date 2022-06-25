<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\SendOrderInvoice;
use App\Models\CuponUserCustomer;
use App\Models\CustomChoiseRequested;
use App\Models\Order;
use App\Models\ShoppingCharge;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Devfaysal\BangladeshGeocode\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CustomCheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout($id)
    {
        $data      = CustomChoiseRequested::where('is_deleted', 0)->where('id', $id)->select(['custom_product_price'])->first();
        $user      = User::isUser()->first();
        $divisions = Division::all();
        return view('frontend.checkout.custom-choose.checkout', \compact('data', 'user', 'divisions', 'id'));
    }

    public function getCheckoutCartItem($id)
    {
        $cartData       = CustomChoiseRequested::where('is_deleted', 0)->with('Product', 'Customer', 'Color', 'Material', 'Vendor', 'FinishedColor')->where('id', $id)->first();
        $shoppingCharge = ShoppingCharge::get();
        return view('frontend.checkout.custom-choose.checkoutAjax', compact('cartData', 'shoppingCharge'));
    }

    public function save(Request $request)
    {
        // dd($request->all());
        $cartData = CustomChoiseRequested::find($request->product_request);
        if ($cartData->is_approve == 1 && $cartData->is_deleted == 0 && $cartData->order_status == 0) {
            $validated = $request->validate([
                'shipping_name'     => 'required',
                'shipping_phone'    => 'required',
                'shipping_email'    => 'required',
                'shipping_zip'      => 'required',
                'shipping_division' => 'required',
                'shipping_city'     => 'required',
                'shipping_address'  => 'required',
                'customer_id'       => 'required',
                'total_item'        => 'required',
                'total_qty'         => 'required',
                'delivery_charge'   => 'required',
                'total_amount'      => 'required',

                'transaction_id'    => 'required',
                'payment_mobile'    => 'required',
                'advance_pay'       => 'required',
            ]);
            try {
                DB::beginTransaction();
                // code start
                $orderId = Auth::user()->id . rand(5555, 99999);
                if ($request->shipping_city == 47) {
                    $subtotal        = round($cartData->custom_product_price);
                    $delivery_charge = round($subtotal * (shoppingChargeDhaka() / 100));
                    $total_amount    = round($subtotal + $delivery_charge);
                } else {
                    $subtotal        = round($cartData->custom_product_price);
                    $delivery_charge = round($subtotal * (shoppingChargeOutOfDhaka() / 100));
                    $total_amount    = round($subtotal + $delivery_charge);
                }
                // cart data
                $company_data = [0 => "{$cartData->Product->user_id}"];
                $products     = [
                    'id'                => $cartData->Product->id,
                    'product_name'      => $cartData->Product->product_name,
                    'image'             => $cartData->Product->image,
                    'sku'               => $cartData->Product->sku,
                    'shop_id'           => $cartData->Product->shop_id,
                    'vendor_id'         => $cartData->Product->user_id,
                    'attributes_data'   => null,
                    'custom_request_id' => $cartData->id,
                    'qty'               => 1,
                    'price'             => round($cartData->custom_product_price),
                    'subtotal'          => round($cartData->custom_product_price),
                    'created_at'        => Carbon::now()->toDateTimeString(),
                ];
                // wallet data insert
                if ($request->has('wallet')) {
                    $walletModel = Wallet::insertGetId([
                        'user_id'     => Auth::user()->id,
                        'order_id'    => $orderId,
                        'wallet_type' => 'checkout',
                        'amount'      => 500,
                        'amount_type' => 'Credit',
                        'details'     => 'used in checkout',
                        // 'date'        => date('Y-m-d'),
                        'created_at'  => Carbon::now()->toDateTimeString()]);

                    $wallet_id     = $walletModel;
                    $wallet_amount = 500;
                    $total_amount  = round($total_amount - $wallet_amount);
                } else {
                    $wallet_id     = null;
                    $wallet_amount = 0;
                    $total_amount  = round($total_amount - $wallet_amount);

                }
                if ($request->cupon_amount_hidden && $request->cupon_type_hidden && $request->cupon_id_hidden) {
                    $customerCuponModel = CuponUserCustomer::insertGetId([
                        'user_id'               => Auth::user()->id,
                        'cupon_id'              => $request->cupon_id_hidden,
                        'order_id'              => $orderId,
                        'cupon_discount_amount' => $request->cupon_discounted_amount_hidden,
                        'date'                  => Carbon::now()->toDateString(),
                        'created_at'            => Carbon::now()->toDateTimeString(),
                    ]);
                    $total_amount = round($total_amount - $request->cupon_discounted_amount_hidden);

                }

                //full paid offer save
                if ($request->full_paid_offer == "on" || $request->has('full_paid_offer')) {
                    $full_paid_offer        = fullPaidOffer();
                    $full_paid_offer_amount = round($total_amount * (fullPaidOffer() / 100));
                    $total_amount           = $total_amount - $full_paid_offer_amount;
                    if ($total_amount != $request->advance_pay) {
                        Alert::toast('Please enter  ' . $total_amount . ' taka', 'error');
                        return redirect()->back();
                    }
                } else {
                    $full_paid_offer        = 0;
                    $full_paid_offer_amount = 0;
                }

                $insert = Order::insertGetId([
                    'shipping_name'           => $request->shipping_name,
                    'shipping_phone'          => $request->shipping_phone,
                    'shipping_email'          => $request->shipping_email,
                    'shipping_zip'            => $request->shipping_zip,
                    'shipping_division'       => $request->shipping_division,
                    'shipping_city'           => $request->shipping_city,
                    'shipping_address'        => $request->shipping_address,
                    'customer_id'             => $request->customer_id,
                    'total_item'              => 1,
                    'total_qty'               => 1,
                    'cart_total'              => $cartData->custom_product_price,
                    'delivery_charge'         => $delivery_charge,
                    'cupon_id'                => $request->cupon_id_hidden,
                    'cupon_discounted_amount' => $request->cupon_discounted_amount_hidden,
                    'wallet_id'               => $wallet_id,
                    'wallet_amount'           => $wallet_amount,
                    'full_paid_offer'         => $full_paid_offer,
                    'full_paid_offer_amount'  => $full_paid_offer_amount,

                    'total_amount'            => $total_amount,
                    'order_id'                => $orderId,
                    'payment_mobile'          => $request->payment_mobile,
                    'advance_pay'             => $request->advance_pay,
                    'transaction_id'          => $request->transaction_id,
                    'products'                => json_encode($products),
                    'company_id'              => json_encode($company_data),
                    'created_at'              => Carbon::now()->toDateTimeString(),
                    'invoice_id'              => rand(111, 99999),
                    'order_type'              => 'custom_checkout',
                ]);

                $update = CustomChoiseRequested::where('id', $request->product_request)->update([
                    'order_status' => 1,
                ]);
                dispatch(new SendOrderInvoice($request->shipping_email, $orderId));
                //code end
                DB::commit();
                Alert::toast('Your Order Placed Successfully', 'success');
                return redirect('/checkout/payment/' . $orderId);

            } catch (\Exception $exp) {
                DB::rollBack();
                Alert::toast('Somethings want wrong', 'error');
                return \redirect()->back();
            }
        } else {
            Alert::toast('Your try to access invalided info', 'error');
            return \redirect('/shop');
        }
    }

}
