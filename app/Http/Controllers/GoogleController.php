<?php

namespace App\Http\Controllers;
use App\Models\CustomerLogin;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class GoogleController extends Controller
{
    function redirectToProvider() {
        return Socialite::driver('google')->redirect();

    }
    function redirectToWebsite() {
        $user = Socialite::driver('google')->user();
        if(CustomerLogin::where('email', $user->getEmail())->exists()){
            if(Auth::guard('customerlogin')->attempt(['email'=> $user->getEmail(), 'password'=>'vR+wXFYMrXh7Y_9Z'])) {
                return redirect('/');
             }

        }
        else {
            CustomerLogin::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('vR+wXFYMrXh7Y_9Z'),
                'created_at' => Carbon::now(),
            ]);
            if(Auth::guard('customerlogin')->attempt(['email'=> $user->getEmail(), 'password'=>'vR+wXFYMrXh7Y_9Z'])) {
               return redirect('/');
            }

        }

    }
}
