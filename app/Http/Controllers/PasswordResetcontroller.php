<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use App\Models\CustomerLogin;
use App\Models\CustomPasswordReset;
use App\Notifications\CustomerPassResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PasswordResetcontroller extends Controller
{
    public function forgotpassword()
    {
        return view('CustomAuth.custom_pass_reset');
    }
    public function forgot_send_email(Request $request)
    {
        $customer = CustomerLogin::where('email', $request->email)->firstOrFail();
        $delete_reset_info = CustomPasswordReset::where('customer_id', $customer->id)->delete();
        $reset_info = CustomPasswordReset::create([
            'customer_id' => $customer->id,
            'reset_token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);
        Notification::send($customer, new CustomerPassResetNotification($reset_info));
        return back()->with('sent_rest_email', 'We have emailed your password reset link! ');
    }
    function CustomerResetForm($reset_token) {
        return view('CustomAuth.customerresetform', compact('reset_token'));

    }
    function CustomerResetUpdate(ResetRequest $request) {
        $find_reset_token = CustomPasswordReset::where('reset_token', $request->reset_token)->firstOrFail();
        $find_customer = CustomerLogin::where('id', $find_reset_token->customer_id);
        $find_customer_email = CustomerLogin::where('id', $find_reset_token->customer_id)->first()->email;
        $find_customer->update([
            'password' => bcrypt($request->password),
        ]);
        if(Auth::guard('customerlogin')->attempt(['email' => $find_customer_email, 'password' => $request->password])) {
            CustomPasswordReset::where('reset_token', $request->reset_token)->delete();
            return redirect('/');
        }

    }
}


