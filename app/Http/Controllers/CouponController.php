<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function coupon() {
        $coupons = coupon::all();
        return view('admin.coupon.coupon', [
            'coupons' => $coupons,
        ]);
    }
    function coupon_insert(Request $request) {
        Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'validity' => $request->validity,
            'discount' => $request->discount,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('coupon_added', 'Coupon Added Successfully');

    }
}
