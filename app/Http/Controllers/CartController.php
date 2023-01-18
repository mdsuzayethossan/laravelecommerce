<?php
namespace App\Http\Controllers;
use App\Models\cart;
use App\Models\Coupon;
use App\Models\inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    function cart_insert(CartRequest $request) {
        $available_products = inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->product_quantity;


    if($available_products >= 1) {
        if(cart::where('user_id', Auth::guard('customerlogin')->id())->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()){
            cart::where('user_id', Auth::guard('customerlogin')->id())->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->qtybutton);

            return back()->with('cart_added', 'Cart Added Successfully');

        } else {
            cart::insert([
                'user_id' => Auth::guard('customerlogin')->id(),
                'product_id' => $request->product_id,
                'color_id'=> $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->qtybutton,
                'created_at' => Carbon::now(),
            ]);
            return back()->with('cart_added', 'Cart Added Successfully');

        }

    }
    else {
        return back()->with('productNotAvailable', 'Sorry! We do not have your desired product in stock now.');
    }

    }
    function cart(Request $request) {
        $usecoupon = $request->coupon_code;
        $coupon_message = null;


        if($usecoupon == '') {
            $discount = 0;
        }
        else {

            if(Coupon::where('coupon_name', $usecoupon)->exists()) {
                if(Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name', $usecoupon)->first()->validity){
                    $coupon_message = 'Coupon Code Expired';
                    $discount = 0;
                }
                else {
                    $discount = Coupon::where('coupon_name', $usecoupon)->first()->discount;

                }
            }
            else {
                $coupon_message = "Invalid Coupon Code";
                $discount = 0;
            }

        }
        $auth_carts = cart::where('user_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.cart', [
            'auth_carts' => $auth_carts,
            'discount' => $discount,
            'coupon_message' => $coupon_message,
        ]);

    }
    function cart_delete($card_id) {
        cart::find($card_id)->delete();
        return back()->with('cart_delete', 'Cart deleted successfully');

    }
    function cart_update(Request $request) {
        foreach($request->qtybutton as $cart_id=>$quantity)


        cart::find($cart_id)->update([
            'quantity'=>$quantity,
        ]);
        return back()->with('cart_updated', 'Cart updated successfully');


    }
    function clear_cart() {
        cart::where('user_id', Auth::guard('customerlogin')->id())->delete();
        return back()->with('clear_cart', 'Cart clear successfully');
    }
}
