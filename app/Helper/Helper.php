<?php

use App\Models\orderCommission;
use App\Models\ShoppingCharge;
use App\Models\User;
use App\Models\VendorCompany;
use App\Models\Wallet;
use App\Models\WithdrawPayment;

if (!function_exists('vendorOrUserInfo')) {
    function vendorOrUserInfo()
    {
        $user = User::isUser()->isVerified()->first();
        if ($user->is_shop == '1') {
            $user = VendorCompany::where('user_id', $user->id)->first();
        } else {
            $user = $user;
        }
        return $user;
    }
}

if (!function_exists('shoppingChargeDefault')) {
    function shoppingChargeDefault()
    {

        if (auth()->user()->city == 47) {
            $model = ShoppingCharge::first();
        } else {
            $model = ShoppingCharge::find('2');

        }
        return $model->charge;
    }
}
if (!function_exists('shoppingChargeOutOfDhaka')) {
    function shoppingChargeOutOfDhaka()
    {
        $model = ShoppingCharge::find('2');
        return $model->charge;
    }
}
if (!function_exists('fullPaidOffer')) {
    function fullPaidOffer()
    {
        $model = ShoppingCharge::find('3');
        return $model->charge;
    }
}
if (!function_exists('shoppingChargeDhaka')) {
    function shoppingChargeDhaka()
    {
        $model = ShoppingCharge::first();
        return $model->charge;
    }
}

if (!function_exists('wallet')) {
    function wallet($id)
    {
        return orderCommission::where('user_id', $id)->sum('vendor_payable');
    }
}
if (!function_exists('paidAmount')) {
    function paidAmount($id)
    {
        return WithdrawPayment::where('user_id', $id)->where('is_deleted', 0)->where('paid_status', 1)->sum('paid_amount');
    }
}

if (!function_exists('davitBalance')) {
    function davitBalance($id)
    {
        return Wallet::where('user_id', $id)->where('amount_type', 'Dabit')->where('is_deleted', 0)->sum('amount');
    }
}

if (!function_exists('creditBalance')) {
    function creditBalance($id)
    {
        return Wallet::where('user_id', $id)->where('amount_type', 'Credit')->sum('amount');
    }
}
