<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index()
    {
        $categories = Category::all();
        $products = Product::take(8)->get();
        $all_product = Product::all();
        $categoryForbanner = Category::take(3)->get();
        $latest_product = Product::latest()->take(5)->get();
        return view('frontend.index', [
            'categories' => $categories,
            'products' => $products,
            'categoryForbanner' => $categoryForbanner,
            'all_product' => $all_product,
            'latest_product' => $latest_product,
        ]);
    }
}
