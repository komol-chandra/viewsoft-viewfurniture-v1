<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\VendorCompany;
use App\Models\Wallet;
use Carbon\Carbon;
use Devfaysal\BangladeshGeocode\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // vendor order list
    public function orderList()
    {

        $shop           = VendorCompany::where('user_id', auth()->user()->id)->first();
        $shop_single_id = [$shop->id];
        $shoplol        = $shop->id;
        $item           = $shoplol;
        $allorders      = Order::where('company_id', 'like', "%{$item}%")->get();
        return view('frontend.vendor.dashboard.order', compact('allorders'));

    }

    public function bankInfo()
    {
        return view('frontend.vendor.bank-info.create');
    }

    public function updateBankInfo(Request $request)
    {
        $request->validate([
            'bank_name'           => 'required',
            'bank_account_number' => 'required',
            'name_of_bank'        => 'required',
            'bank_address'        => 'required',
            'routing_number'      => 'nullable',
            'i_ban'               => 'nullable',
            'swift_code'          => 'nullable',
            'mobile_bank_name'    => 'required',
            'mobile_bank_number'  => 'required',
            'trade_licence'       => 'required',
            'mobile_bank_number'  => 'required',
        ]);

        $model                      = User::find(auth()->user()->id);
        $model->bank_name           = $request->bank_name;
        $model->bank_account_number = $request->bank_account_number;
        $model->name_of_bank        = $request->name_of_bank;
        $model->bank_address        = $request->bank_address;
        $model->routing_number      = $request->routing_number;
        $model->i_ban               = $request->i_ban;
        $model->swift_code          = $request->swift_code;
        $model->mobile_bank_name    = $request->mobile_bank_name;
        $model->mobile_bank_number  = $request->mobile_bank_number;
        $model->trade_licence       = $request->trade_licence;
        $update                     = $model->save();
        if ($update) {
            Alert::toast('Updated Success', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Update Faild!', 'error');
            return redirect()->back();
        }
    }
    //
    public function create()
    {
        if (auth()->user()->is_vendor == 1) {
            return view('errors.404');
        } else {
            $divisions = Division::all();
            // dd($divisions);
            return view('frontend.vendor.vendor_create.create', compact('divisions'));
        }
    }
    //
    public function store(Request $request)
    {

        $request->validate([
            'name'         => 'required',
            'phone'        => 'required',
            'email'        => 'required',
            'main_address' => 'required',
            'division'     => 'required',
            'city'         => 'required',
            'zip_code'     => 'required',
        ]);
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $ImageName = 'th' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/user/' . $ImageName);
        } else {
            $ImageName = null;
        }
        $model                         = User::find(auth()->user()->id);
        $model->name                   = $request->name;
        $model->phone                  = $request->phone;
        $model->email                  = $request->email;
        $model->main_address           = $request->main_address;
        $model->division               = $request->division;
        $model->city                   = $request->city;
        $model->is_vendor              = 1;
        $model->zip_code               = $request->zip_code;
        $model->company_google_map     = $request->company_google_map;
        $model->sale_area              = $request->sale_area;
        $model->delivery_possible_area = $request->delivery_possible_area;
        $model->bank_name              = $request->bank_name;
        $model->bank_account_number    = $request->bank_account_number;
        $model->name_of_bank           = $request->name_of_bank;
        $model->bank_address           = $request->bank_address;
        $model->routing_number         = $request->routing_number;
        $model->i_ban                  = $request->i_ban;
        $model->swift_code             = $request->swift_code;
        $model->mobile_bank_name       = $request->mobile_bank_name;
        $model->mobile_bank_number     = $request->mobile_bank_number;
        $model->trade_licence          = $request->trade_licence;
        $model->image                  = $ImageName;
        $update                        = $model->save();

        $check = Wallet::where('user_id', Auth::user()->id)->where('wallet_type', 'vendor_bonus')->first();
        // dd($check);
        if (!$check) {
            $insertwalletdata = Wallet::insert([
                'user_id'     => Auth::user()->id,
                'wallet_type' => 'vendor_bonus',
                'amount'      => 10000,
                'amount_type' => 'Dabit',
                'details'     => 'Dabit-amount-sign-up Bonus',
                'is_deleted'  => '1',
                'created_at'  => Carbon::now()->toDateTimeString(),
            ]);
        }
        if ($update) {
            Alert::toast('Updated Success', 'success');
            return redirect()->route('customer.dashboard');
        } else {
            Alert::toast('Update Faild!', 'error');
            return redirect()->back();
        }
    }

    // vendor dashboard
    public function vendorDashboard()
    {

        $shop              = VendorCompany::where('user_id', auth()->user()->id)->first();
        $shop_single_id    = [$shop->id];
        $shoplol           = $shop->id;
        $item              = $shoplol;
        $totalpendingOrder = Order::where('is_deleted', 0)->where('order_status', 0)->where('company_id', 'like', "%{$item}%")->count();
        $allpendingOrder   = Order::where('is_deleted', 0)->where('order_status', 0)->where('company_id', 'like', "%{$item}%")->limit(5)->get();

        $countproduct       = Product::where('user_id', Auth::user()->id)->where('is_deleted', 0)->count();
        $totalsellproduct   = Product::where('user_id', Auth::user()->id)->where('is_deleted', 0)->sum('sell_qty');
        $OrderBysellproduct = Product::where('user_id', Auth::user()->id)->where('is_deleted', 0)->orderBy('sell_qty', 'DESC')->limit(5)->get();

        return view('frontend.vendor.dashboard.vendor_dashboard', compact('allpendingOrder', 'OrderBysellproduct', 'countproduct', 'totalsellproduct', 'totalpendingOrder'));

    }
    //
    public function edit()
    {
        $id            = Auth::user()->id;
        $divisions     = Division::all();
        $vendorcompany = VendorCompany::where('user_id', $id)->first();
        // dd($vendorcompany);
        if ($vendorcompany) {

            return view('frontend.vendor.vendor_create.vendorupdate', compact('vendorcompany', 'divisions'));
        } else {
            return redirect('/');
        }
    }

    //
    public function invoicevendorOrder($id)
    {
        $alldata = Order::where('id', $id)->first();
        return view('frontend.vendor.dashboard.invoice', compact('alldata'));
    }
    // vendor update
    public function editUpdate(Request $request)
    {
        // dd($request->all());
        $insert = VendorCompany::where('id', $request->id)->update([
            'name'                   => $request->name,
            'email'                  => $request->email,
            'phone'                  => $request->phone,
            'company_name'           => $request->company_name,
            'company_address'        => $request->company_address,
            'company_google_map'     => $request->company_google_map,
            'country'                => $request->country,
            'division'               => $request->division,
            'city'                   => $request->city,
            'zip_code'               => $request->zip_code,
            'sale_area'              => $request->sale_area,
            'delevery_possible_area' => $request->delevery_possible_area,
            'bank_name'              => $request->bank_name,
            'bank_account_number'    => $request->bank_account_number,
            'name_of_bank'           => $request->name_of_bank,
            'bank_address'           => $request->bank_address,
            'routing_number'         => $request->routing_number,
            'i_ban'                  => $request->i_ban,
            'swift_code'             => $request->swift_code,
            'updated_at'             => Carbon::now()->toDateTimeString(),
        ]);
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $ImageName = 'Cate' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/vendorcompany/' . $ImageName);
            VendorCompany::where('id', $request->id)->update([
                'image' => $ImageName,
            ]);
        }

        if ($insert) {
            Alert::toast('Updated Success', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Update Faild!', 'error');
            return redirect()->back();
        }
    }

    // vndor ad to cart order
    public function myorder()
    {
        $orders = Order::where('customer_id', Auth::user()->id)->get();
        return view('frontend.vendor.myorder.order', compact('orders'));
    }
}
