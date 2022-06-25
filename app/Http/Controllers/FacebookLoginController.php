<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Auth;

class FacebookLoginController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            if($user->email=='NULL'){
                return redirect('/');
            }else{

            $isUser = User::where('social_id', $user->id)->first();
            if($isUser){
                Auth::login($isUser);
                return redirect('/dashboard');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id'=> $user->id,
                    'social_type'=> 'facebook',
                    'is_verified'=>1,
                    'password' => encrypt('admin@123')
                ]);
    
                Auth::login($createUser);
                return redirect('/dashboard');
            }
        }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
