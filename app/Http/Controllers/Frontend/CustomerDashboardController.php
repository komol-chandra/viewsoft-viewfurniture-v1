<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomChoiseRequested;
use App\Models\Order;
use App\Models\User;
use App\Models\Wallet;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Devfaysal\BangladeshGeocode\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function vendorRequestedOrder()
    {
        // $shop           = Shop::where('user_id', auth()->user()->id)->first();
        // $shop_single_id = [$shop->id];
        // $shoplol        = $shop->id;
        // $item           = $shoplol;
        $id     = auth()->user()->id;
        $orders = Order::where('company_id', 'like', "%{$id}%")->get();
        return view('frontend.customerDashboard.order-request.request-for-order', compact('orders'));
    }

    public function invoicevendorOrder($id)
    {
        $data = Order::where('id', $id)->first();
        // $products = json_decode($data->products);
        return view('frontend.customerDashboard.order-request.invoice', compact('data'));
    }
    //customer all order
    public function customerOrder()
    {
        $orders = Order::where('customer_id', Auth::user()->id)->get();
        return view('frontend.customerDashboard.order', compact('orders'));
    }
    //customer product view
    public function customerOrderView($id)
    {
        $data = Order::with('WalletUsingOrder')->where('customer_id', Auth::user()->id)->where('id', $id)->first();
        // dd(\json_decode($data->p));
        return view('frontend.customerDashboard.order-view', compact('data'));
    }

    /**
     * customChooseProduct
     * this method used for custom product list
     * @return void
     */
    public function customChooseProduct()
    {
        $products = CustomChoiseRequested::with('Product', 'Customer', 'Color', 'Material', 'Vendor', 'FinishedColor')->where('is_deleted', '0')->where('user_id', auth()->user()->id)->get();
        return view('frontend.customerDashboard.custom-choose-products', compact('products'));
    }

    /**
     * customChooseProductView
     * this method used for view custom product view
     * @param  mixed $id
     * @return void
     */
    public function customChooseProductView($id)
    {
        $data = CustomChoiseRequested::where('is_deleted', 0)->with('Product', 'Customer', 'Color', 'Material', 'Vendor', 'FinishedColor')->where('id', $id)->first();

        return view('frontend.customerDashboard.custom-choose-product-view', \compact('data'));
    }

    // customer-dashboard
    public function dashboard()
    {
        if (Auth::user()->is_shop == 0) {
            $totalOrderCount           = Order::isCustomer()->isDeleted()->count();
            $totalDeliveredOrderCount  = Order::isCustomer()->isDeleted()->isDelivered()->count();
            $totalProcessingOrderCount = Order::isCustomer()->isDeleted()->isProcessing()->count();

            return view('frontend.customerDashboard.dashboard', compact('totalOrderCount', 'totalDeliveredOrderCount', 'totalProcessingOrderCount'));
        } else {
            return redirect('/vendor/dashboard');
        }

    }
    // customer logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
    // profile
    public function profile()
    {
        $divisions = Division::all();
        return view('frontend.customerDashboard.profile', \compact('divisions'));
    }
    // profile update
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'         => 'required',
            'phone'        => 'required',
            'email'        => 'required|email|unique:users,email,' . Auth::user()->id,
            'main_address' => 'required',
            'division'     => 'required',
            'city'         => 'required',
            'zip_code'     => 'required',
            'age'          => 'required',
            'gender'       => 'required',
        ]);
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $ImageName = 'th' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/user/' . $ImageName);
        } else {
            $ImageName = auth()->user()->image;
        }

        if ($request->hasFile('cover')) {
            $image2     = $request->file('cover');
            $ImageName2 = 'th' . '_' . time() . '.' . $image2->getClientOriginalExtension();
            Image::make($image2)->save('uploads/user/' . $ImageName2);
        } else {
            $ImageName2 = auth()->user()->cover;
        }
        $model                         = User::find(auth()->user()->id);
        $model->name                   = $request->name;
        $model->phone                  = $request->phone;
        $model->email                  = $request->email;
        $model->main_address           = $request->main_address;
        $model->division               = $request->division;
        $model->city                   = $request->city;
        $model->zip_code               = $request->zip_code;
        $model->age                    = $request->age;
        $model->gender                 = $request->gender;
        $model->google_map             = $request->google_map;
        $model->sale_area              = $request->sale_area;
        $model->delivery_possible_area = $request->delivery_possible_area;
        $model->description            = $request->description;
        $model->image                  = $ImageName;
        $model->cover                  = $ImageName2;
        $update                        = $model->save();

        $check = Wallet::where('user_id', Auth::user()->id)->where('wallet_type', 'signup_bonus')->first();
        if (!$check) {
            $insertwalletdata = Wallet::insert([
                'user_id'     => Auth::user()->id,
                'wallet_type' => 'signup_bonus',
                'amount'      => 2500,
                'amount_type' => 'Dabit',
                'details'     => 'Dabit-amount-sign-up Bonus',
                'created_at'  => Carbon::now()->toDateTimeString(),
            ]);
        }
        if ($update) {
            Alert::toast('Your profile updated ', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Update Faild!', 'error');
            return redirect()->back();
        }
    }
    //
    public function passwordChange()
    {
        return view('frontend.customerDashboard.passwordChange');
    }
    // password
    public function passwordChangeStore(Request $request)
    {
        $request->validate([
            'current_password'      => ['required', new MatchOldPassword],
            'password'              => ['required'],
            'password_confirmation' => ['same:password'],
        ]);
        $update = User::find(auth()->user()->id)->update(['password' => Hash::make($request->password)]);
        if ($update) {
            Alert::toast('Your password updated ', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Update Faild!', 'error');
            return redirect()->back();
        }

    }
}
