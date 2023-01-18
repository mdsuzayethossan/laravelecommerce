<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\InvoiceMail;
use App\Models\BillingDetails;
use App\Models\cart;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\city;
use App\Models\inventory;
use App\Models\Order;
use App\Models\ProductOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    function checkout() {
        $carts = cart::where('user_id', Auth::guard('customerlogin')->id())->get();
        $countries = Country::all();
        return view('frontend.checkout', [
            'countries' => $countries,
            'carts' => $carts,
        ]);
    }
    function getcity(Request $request) {
        $cities = City::where('country_id', $request->country_id)->get();

        $str = '<option>Select a country</option>';
        foreach($cities as $city){
            $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';

        }
        echo $str;


    }

    function order_insert(CheckoutRequest $request) {
        if(cart::where('user_id', Auth::guard('customerlogin')->id())->count() == 0){
            return back()->with('notavailable_cart', 'Not available product in your cart. Please add to cart');


        }
        else {
            if($request->payment_method == 1) {
                $order_id = Order::insertGetId([
                    'user_id' => Auth::guard('customerlogin')->id(),
                    'subtotal' => $request->subtotal,
                    'discount' => $request->discount,
                    'delivery_charge' => $request->delivery_charge,
                    'total' => ($request->grand_total + $request->delivery_charge),
                    'payment_method' => $request->payment_method,
                    'created_at' => Carbon::now(),
                ]);
                BillingDetails::insert([
                    'order_id' => $order_id,
                     'user_id' => Auth::guard('customerlogin')->id(),
                     'name' => $request->name,
                     'email' => $request->email,
                     'company' => $request->company,
                     'country_id' => $request->country,
                     'city_id' => $request->city,
                     'address' => $request->address,
                     'postcode' => $request->postcode,
                     'phone' => $request->phone,
                     'notes' => $request->notes,
                     'created_at' => Carbon::now(),

                ]);
                $carts = cart::where('user_id', Auth::guard('customerlogin')->id())->get();
                foreach($carts as $cart) {
                 ProductOrder::insert([
                     'order_id' => $order_id,
                     'product_id' => $cart->product_id,
                     'product_price' => $cart->rel_to_product->discount_price,
                     'color_id' => $cart->color_id,
                     'size_id' => $cart->size_id,
                     'quantity' => $cart->quantity,
                     'created_at' => Carbon::now(),

                 ]);

                }
                Mail::to($request->email)->send(new InvoiceMail($order_id));
                   foreach($carts as $cart) {
                       inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('product_quantity', $cart->quantity);
                       cart::find($cart->id)->delete();
                   }
                   return redirect()->route('order_success')->with('order_success', 'your slks');

               }
               else if($request->payment_method == 2) {
                   $order_all_information = $request->all();
                   return view('exampleEasycheckout', [
                       'order_all_information' => $order_all_information,
                   ]) ;

               }

               return back();
        }



    }
    function order_success() {
        return view('order.order_sucess');
    }
}
