<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationbarController extends Controller
{
    function logos() {
        return view('admin.navigationbar.logos');

    }
    function menus() {
        return view('admin.navigationbar.menus');

    }
    function submenus() {
        return view('admin.navigationbar.submenus');

    }
}
