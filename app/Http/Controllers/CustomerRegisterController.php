<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Requests\CustomerAuthRequest;
use App\Models\customeremailverify;
use App\Models\CustomerLogin;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CutomerEmailVerifyNotification;
use Notification;


class CustomerRegisterController extends Controller
{
    function customer_register() {
        return view('CustomAuth.auth_register');
    }
    function customerregister(CustomerAuthRequest $request)
    {
        CustomerLogin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);
        $customer= CustomerLogin::where('email', $request->email)->firstOrFail();
        $customer_remove_info = customeremailverify::where('cutomer_id', $customer->id);
       $customer_email_verify = customeremailverify::create([
            'customer_id'=>$customer->id,
            'verify_token'=> uniqid(),
            'created_at'=>Carbon::now(),
        ]);
        Notification::send($customer, new CutomerEmailVerifyNotification($customer_email_verify));
        return back()->with('registersuccess', 'We just need to verify your email address before you can sign in.');

        // Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password]);
        //     return redirect('/');


    }
    function customer_update(CustomerAuthRequest $request) {
        CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('customer_update', 'Updated successfully');

    }
    public function customer_singout() {
        Auth::guard('customerlogin')->logout();
        return redirect('/customer_register');
      }
}
