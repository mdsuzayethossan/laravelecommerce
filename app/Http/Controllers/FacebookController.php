<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    function redirectToProvider() {
        return Socialite::driver('facebook')->redirect();

    }
}
