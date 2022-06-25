<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    
    public function register(Request $request){

        $validated = $request->validate([
            'phone' => 'required|unique:users|numeric|max:11',
            'name' => 'required',
            'password' => 'required|max:4',
            'confirm_password' => 'required|same:password'
        ]);
        $code=rand(1111,9999);
        $hash=md5($request->phone);
        $insert=User::insertGetId([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'verification_code'=>$code,
            'password'=>Hash::make($request->password),
        ]);
        if($insert){
            $notification = [
                'messege'    => 'Update Success!',
                'alert-type' => 'success',
            ];
            return redirect('/email/verify/'.$user->id.'/'. $hash);
        }

    }


}
