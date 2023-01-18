<?php

namespace App\Http\Controllers;

use App\Models\wishlisht;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class WishlistController extends Controller
{
    function wishlist() {
        return view('frontend.wishlist');
    }
    function wishlist_product_id(Request $request) {
        $hello = $request->product_id;
        wishlisht::insert([
            'user_id' =>  $hello,
            'product_id' => $hello,
            'color_id'=> $hello,
            'size_id' => $hello,
            'quantity' => $hello,
            'created_at' => Carbon::now(),


        ]);

    }
}
