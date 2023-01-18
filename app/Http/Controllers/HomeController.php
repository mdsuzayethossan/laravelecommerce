<?php

namespace App\Http\Controllers;

use app\models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id();
        $all_users = user::where('id', '!=', $user_id)->orderBy('id', 'desc')->paginate(3);
        $total_user = user::count();
        $logged_user = Auth::user()->name;
        return view('home', compact('total_user', 'logged_user', 'all_users'));
    }
    public function role(Request $request)
    {
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('add_role', 'Rule Added Successfully');
    }
    public function admin()
    {
        return view('layouts.admin');
    }
    // public function customerRegister()
    // {
    //     return view('auth.register');
    // }
}
