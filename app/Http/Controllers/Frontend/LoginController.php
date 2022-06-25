<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPassword;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    // submit
    public function loginSubmit(Request $request)
    {
        //  return $request;
        $this->validate($request, [
            'phone'    => 'required|exists:App\Models\User,phone',
            'password' => 'required|min:4',
        ]);
        $user = User::where('phone', $request->phone)->first();
        // if ($user->is_verified == 0) {
        //     $hash = md5($request->phone);
        //     return redirect('/phone/verify/' . $user->id . '/' . $hash);
        // } else {

        if (Auth::guard('web')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            Alert::toast('Login success!', 'success');
            return redirect()->intended(route('customer.dashboard'));
        } else {
            Alert::toast('Email/password does not Match!!', 'error');
            return redirect()->back();
        }
        // }

    }
    // register
    public function register()
    {
        return view('auth.register');
    }
    // register Store
    public function registerStore(Request $request)
    {
        $validated = $request->validate([
            'phone'            => 'required|unique:users|numeric|min:10',
            'name'             => 'required',
            'password'         => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ]);
        $code   = rand(1111, 9999);
        $hash   = md5($request->phone);
        $insert = User::insertGetId([
            'name'              => $request->name,
            'phone'             => $request->phone,
            'verification_code' => $code,
            'password'          => Hash::make($request->password),
            'created_at'        => Carbon::now()->toDateTimeString(),
        ]);
        if ($insert) {
            Alert::toast('Update success!', 'success');
            return redirect('/login');
            // return redirect('/phone/verify/' . $insert . '/' . $hash);
        } else {
            Alert::toast('Update Failed!', 'error');
            return redirect()->back();
        }

    }
    //
    public function emailverify($id)
    {
        return view('auth.verify', compact('id'));
    }
    public function emailverifySubmit(Request $request)
    {
        $id    = $request->id;
        $check = User::where('id', $id)->where('verification_code', $request->code)->first();
        if ($check) {
            $update = User::where('id', $id)->update([
                'is_verified' => 1,
            ]);
            Alert::toast('verification code Matched!', 'error');

            return redirect('/login');
        } else {
            Alert::toast('verification did not code Match, try again!', 'error');
            return redirect()->back();
        }
    }
    // forget password
    public function forgetPassword()
    {
        return view('auth.forgetpassword');
    }
    // forget password
    public function forgetPasswordSubmit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'phone' => 'required',
        ]);
        $check = User::where('phone', $request->phone)->select(['id', 'phone', 'verification_code'])->first();
        // dd($check);
        if ($check) {
            $verify_id = md5($request->email);
            $code      = rand(5555, 12345);
            $update    = User::where('id', $check->id)->update([
                'verification_code' => $code,
            ]);

            // Mail::to($request->email)->send(new ForgetPassword($code, $verify_id));
            return redirect('forget-password/verify/' . $check->id . '/' . $verify_id);

        } else {
            Alert::toast('This Number Does Not exist ! try again!', 'error');
            return redirect()->back();
        }
    }

    //
    public function forgetCodeVerify($id)
    {
        return view('auth.verifyForgetPin', compact('id'));
    }

    // verify store confirm
    public function forgetCodeVerifyStore(Request $request)
    {

        $request->validate([
            'code'                  => 'required',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        ]);
        $check = User::where('id', $request->id)->where('verification_code', $request->code)->select(['verification_code', 'id'])->first();
        if ($check) {
            $update = User::where('id', $request->id)->update([
                'password' => Hash::make($request->password),
            ]);
            if ($update) {
                Alert::toast('Password Changed Success!', 'success');
                return redirect()->route('login');
            } else {
                Alert::toast('Password Changed Faild!', 'error');
                return redirect()->back();
            }

        } else {
            Alert::toast('Verification Code Is Wrong!', 'error');
            return redirect()->back();
        }

    }
}
