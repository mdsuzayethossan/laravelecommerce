<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\customeremailverify;
use App\Models\CustomerLogin;
use App\Models\Order;
use App\Models\ProductOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;
use PDF;
use function Ramsey\Uuid\v1;
use Illuminate\Support\Facades\Hash;

class CustomerLoginController extends Controller
{
    function email_verify($verify_token) {

        $check_verify_token = customeremailverify::where('verify_token', $verify_token)->firstOrFail();
        $customer_id = CustomerLogin::findOrFail($check_verify_token->customer_id);
        // $customer_email = CustomerLogin::where('id', $customer_id->id)->first()->email;
        // $customer_password = Hash::check(CustomerLogin::where('id', $customer_id->id)->first()->password);


        $customer_id->update([
            'email_verified_at'=>Carbon::now(),
        ]);
        // if(Auth::where('customerlogin')->attempt(['email' => $customer_email, 'password' => $request->password]))
        customeremailverify::where('id', $check_verify_token->id)->delete();

        $customer_name = $customer_id->name;
        session([
            'customer_name' =>$customer_name,
        ]);
        return redirect('/customer/email/verified')->with('verified', ' Your email address has been successfully confirmed. Please sign in.');

    }
    function email_verified() {
        return view('frontend.emailverified');
    }
    function customerlogin(Request $request)
    {
        $request_email = $request->email.' is not registered for this application.';
        if(CustomerLogin::where('email', $request->email)->exists()){
            if(CustomerLogin::where('email', $request->email)->where('email_verified_at', '!=', null)->exists()){
                if (Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect('/');
                } else {
                    return redirect('/customer_register');
                }

            }
            else {
                return redirect('/customer_register')->with('notverified', 'Please verify your email');

            }

        }
        else {
            return redirect()->route('customer_register')->with('notverified','The '. $request_email. ' '.'address is not recognized');

        }



    }
    function customer_profile(){
        $orders = Order::where('user_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.customer_profile', [
            'orders' => $orders,
        ]);
    }
    function invoice_download($order_id){
        $billing_details = BillingDetails::where('order_id', $order_id);
        $orders_products = ProductOrder::where('order_id', $order_id)->get();
        $data = [
            'billing_details' => $billing_details,
            'order_id' => $order_id,
            'orders_products' => $orders_products,

        ];
        $pdf = PDF::loadView('invoice.invoice', $data);

        return $pdf->download('itsolutionstuff.pdf');
    }
    function invoice_view($order_id) {
        $billing_details = BillingDetails::where('order_id', $order_id);
        $orders_products = ProductOrder::where('order_id', $order_id)->get();

        return view('invoice.invoice', [
            'billing_details' => $billing_details,
            'order_id' => $order_id,
            'orders_products' => $orders_products,

        ]);

    }

}
