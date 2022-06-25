<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\SendOrderInvoice;
use App\Models\CuponUserCustomer;
use App\Models\Cuppon;
use App\Models\Order;
use App\Models\ShoppingCharge;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Devfaysal\BangladeshGeocode\Models\Division;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout()
    {
        $user      = User::isUser()->first();
        $divisions = Division::all();
        return view("frontend.checkout.checkout", compact('user', 'divisions'));
    }

    public function getCheckoutCartItem()
    {
        $cartData       = Cart::content();
        $shoppingCharge = ShoppingCharge::get();
        return view('frontend.checkout.checkoutAjax', compact('cartData', 'shoppingCharge'));
    }

    public function save(Request $request)
    {
        // dd($request->all());
        if (Cart::content()->count() > 0) {
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
                $orderId = Auth::user()->id . rand(5555, 99999);
                // shopping charge save
                if ($request->shipping_city == 47) {
                    $subtotal        = round(str_replace(',', '', Cart::subtotal()));
                    $delivery_charge = round($subtotal * (shoppingChargeDhaka() / 100));
                    $total_amount    = round($subtotal + $delivery_charge);
                } else {
                    $subtotal        = round(str_replace(',', '', Cart::subtotal()));
                    $delivery_charge = round($subtotal * (shoppingChargeOutOfDhaka() / 100));
                    $total_amount    = round($subtotal + $delivery_charge);
                }

                // cart product save
                $cartData     = Cart::content();
                $company_data = [];
                foreach ($cartData as $item) {
                    $products[] = [
                        'id'              => $item->id,
                        'product_name'    => $item->name,
                        'image'           => $item->options[0],
                        'sku'             => $item->options[1],
                        'shop_id'         => $item->options[2],
                        'vendor_id'       => $item->options[5],
                        'attributes_data' => $item->options[4],
                        'qty'             => $item->qty,
                        'price'           => $item->price,
                        'subtotal'        => $item->subtotal,
                        'created_at'      => Carbon::now()->toDateTimeString(),
                    ];
                    array_push($company_data, $item->options[5]);
                }
                // wallet data save
                if ($request->has('wallet')) {
                    $walletModel = Wallet::insertGetId([
                        'user_id'     => Auth::user()->id,
                        'order_id'    => $orderId,
                        'wallet_type' => 'checkout',
                        'amount'      => 500,
                        'amount_type' => 'Credit',
                        'details'     => 'used in checkout',
                        'created_at'  => Carbon::now()->toDateTimeString()]);

                    $wallet_id     = $walletModel;
                    $wallet_amount = 500;
                    $total_amount  = $total_amount - $wallet_amount;
                } else {
                    $wallet_id     = null;
                    $wallet_amount = 0;
                    $total_amount  = $total_amount - $wallet_amount;

                }
                // coupon code save
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
                        Alert::toast('Please enter full amount', 'error');
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
                    'total_item'              => $request->total_item,
                    'total_qty'               => $request->total_qty,
                    'cart_total'              => str_replace(',', '', Cart::subtotal()),
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
                ]);
                // $update = Order::where('id', $insert)->update([
                //     'invoice_id' => $insert . rand(111, 99999),
                // ]);

                // dd($products);
                // $update = Order::where('id', $insert)->update([
                //     'products'   => json_encode($products),
                //     'company_id' => json_encode($company_data),
                // ]);

                Cart::destroy();

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
            Alert::toast('Your Cart is empty', 'error');
            return \redirect('/shop');
        }
    }

    public function paymentMethods($order_id)
    {
        $data    = Order::where('order_id', $order_id)->first();
        $product = json_decode($data->products);
        // dd($data);
        return view("frontend.checkout.paymentMethod", compact('data', 'product'));
    }
    public function pay(Request $request)
    {
        if ($request->status == '1') {
            $update = Order::where('order_id', $request->order_id)->update([
                'status' => 1,
            ]);
            if ($update) {
                Alert::toast('Your Order  Has Successfully Completed', 'success');

                return \redirect('/dashboard/orders');
            }
        } elseif ($request->status == '2') {
            $request->validate([
                'payment_method' => 'required',
                'trx_number'     => 'required',
            ]);
            $update = Order::where('order_id', $request->order_id)->update([
                'status'         => 2,
                'payment_method' => $request->payment_method,
                'trx_number'     => $request->trx_number,
            ]);
            if ($update) {
                Alert::toast('Your Order  Has Successfully Completed', 'success');
                return \redirect('/dashboard/orders');
            }
        }
    }

    public function cuponCheck($cuppon)
    {
        $data = Cuppon::where('cuppon_code', $cuppon)->first();
        if ($data == null) {
            return response()->json([
                'error' => 'Cupon' . ' ' . $cuppon . ' ' . 'is invalid',
            ]);
        } else {
            $now       = Carbon::now()->toDateString();
            $cuponUser = CuponUserCustomer::where('user_id', Auth::user()->id)->where('cupon_id', $data->id)->first();
            if ($now <= $data->date && $cuponUser == null) {
                return response()->json([
                    'data'    => $data,
                    'success' => $cuppon . ' ' . 'used successfully',
                ]);
            } elseif ($now >= $data->date && $cuponUser == null) {
                return response()->json([
                    'error' => 'Cupon' . ' ' . $cuppon . ' ' . 'is expired',
                ]);
            } else {
                return response()->json([
                    'error' => 'Cupon' . ' ' . $cuppon . ' ' . 'already used',
                ]);
            }

        }

    }
}
