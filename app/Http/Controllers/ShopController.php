<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\color;
use App\Models\Product;
use App\Models\size;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    function shop(Request $request) {

       $product_search_data_cought = $request->all();
       $all_products = Product::where(function ($product_search_information) use ($product_search_data_cought) {
           if(!empty($product_search_data_cought['search_value']) && $product_search_data_cought['search_value'] != '') {
            $product_search_information->where(function ($product_search_information) use ($product_search_data_cought){
                   $product_search_information->where('product_name', 'like', '%'.$product_search_data_cought['search_value'].'%');
                   $product_search_information->orWhere('description', 'like', '%'.$product_search_data_cought['search_value'].'%');
               });
           }
           if(!empty($product_search_data_cought['category_id']) && $product_search_data_cought['category_id'] != '') {
            $product_search_information->where(function ($product_search_information) use ($product_search_data_cought){
                   $product_search_information->where('category_id', 'like', '%'.$product_search_data_cought['category_id'].'%');

               });
           }
           if(!empty($product_search_data_cought['color_id']) && $product_search_data_cought['color_id'] != '' || !empty($product_search_data_cought['size_id']) && $product_search_data_cought['size_id'] != '') {
            $product_search_information->whereHas('inventories', function ($product_search_information) use ($product_search_data_cought){
                if(!empty($product_search_data_cought['color_id']) && $product_search_data_cought['color_id'] != '') {
                    $product_search_information->whereHas('color', function ($product_search_information) use ($product_search_data_cought) {
                        $product_search_information->where('colors.id', $product_search_data_cought['color_id']);

                    });

                }
                if(!empty($product_search_data_cought['size_id']) && $product_search_data_cought['size_id'] != '') {
                    $product_search_information->whereHas('size', function ($product_search_information) use ($product_search_data_cought) {
                        $product_search_information->where('sizes.id', $product_search_data_cought['size_id']);

                    });

                }

               });

           }

       })->get();
        $all_colors = color::where('id', '!=', 1)->get();
        $all_sizes = size::where('id', '!=', 1)->get();
        $all_categories = Category::all();
        return view('frontend.shop', [
            'all_colors' => $all_colors,
            'all_sizes' => $all_sizes,
            'all_products' => $all_products,
            'all_categories' => $all_categories,
        ]);

    }
}
