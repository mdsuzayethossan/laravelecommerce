<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\color;
use App\Models\size;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\ColorRequest;
use App\Http\Requests\SizeRequest;
use App\Models\inventory;
use Intervention\Image\Facades\Image;
use App\Models\ProductThumbnails;

class ProductController extends Controller
{
    function index()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $products = Product::all();

        return view('admin.product.index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
        ]);
    }
    function getsubcategory(Request $request)
    {
        $subcategories = Subcategory::where('category_id', $request->category_id)->select('id', 'subcategory_name')->get();
        $str_to_send = '<option>-- Select Subcategory --</option>';
        foreach ($subcategories as $subcategory) {
            $str_to_send .= '<option value="' . $subcategory->id . '">' . $subcategory->subcategory_name . '</option>';
        }
        echo $str_to_send;
    }
    function product_insert(Request $request)
    {
        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'discount' => $request->discount,
            'discount_price' => $request->product_price - ($request->product_price * $request->discount) / 100,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $product_image = $request->product_image;
        $extension = $product_image->getClientOriginalExtension();
        $new_product_name = $product_id . '.' . $extension;

        image::make($product_image)->resize(800, 800)->save(public_path('/uploads/products/preview/') . $new_product_name);
        Product::find($product_id)->update([
            'product_image' => $new_product_name,
        ]);
        $start = 1;
        foreach ($request->file('product_thumbnail') as $single_thumbnail) {
            $extension = $single_thumbnail->getClientOriginalExtension();
            $new_product_thumbnail_name = $product_id . '-' . $start . '.' . $extension;
            image::make($single_thumbnail)->resize(800, 800)->save(public_path('/uploads/products/thumbnails/') . $new_product_thumbnail_name);

            $start++;
            ProductThumbnails::insert([
                'product_id' => $product_id,
                'product_thumbnail_name' => $new_product_thumbnail_name,
                'created_at' => Carbon::now(),

            ]);
        }
        return back()->with('success', 'Product Added Successfully');
    }
    function product_edit($product_id)
    {
        return view('admin.product.edit');
    }
    function inventory($invenotry_id)
    {
        $pro_inventories = inventory::all();
        $colors = color::all();
        $sizes = size::all();
        $product_info = Product::find($invenotry_id);
        return view('admin.product.inventory.inventory', [
            'colors' => $colors,
            'sizes' => $sizes,
            'product_info' => $product_info,
            'pro_inventories' => $pro_inventories,
        ]);
    }
    function inventory_insert(Request $request)
    {

        if (inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()) {
            inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('product_quantity', $request->product_quantity);
            return back();
        } else {

            inventory::insert([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'product_quantity' => $request->product_quantity,
                'created_at' => Carbon::now(),

            ]);
            return back()->with('inventory', 'Inventory Added Successfully');
        }
    }
    function color_size()
    {
        $colors = color::all();
        $sizes = size::all();
        return view('admin.color_size.index', [
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }
    function color_size_insert(ColorRequest $request)
    {
        color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),

        ]);
        return back()->with('insert_color', 'Color Added Successfully');
    }
    function size_insert(SizeRequest $request)
    {
        size::insert([
            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),

        ]);
        return back()->with('insert_size', 'Size Added Successfully');
    }
    // Product Details

    function product_details($sing_product_id)
    {
        $sing_product_info = Product::find($sing_product_id);
        $available_products = inventory::where('product_id', $sing_product_id)->sum('product_quantity');

        $related_products = Product::where('category_id', $sing_product_info->category_id)->where('id', '!=', $sing_product_id)->get();

        $available_colors = inventory::where('product_id', $sing_product_id)->groupBy('color_id')->selectRaw('count(*) as total, color_id')->get();
        return view('frontend.product_details', [
            'sing_product_info' =>  $sing_product_info,
            'available_colors' =>  $available_colors,
            'related_products' =>  $related_products,
            'available_product' =>  $available_products,


        ]);
    }

    //getSize method post
    function getsize(Request $request)
    {
        // $color_id = session(["typeg"=>$request->color_id]);

        $sizes = inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get('size_id');

        $size_name_to_send = '';
        foreach ($sizes as $size) {
            $size_name = size::find($size->size_id)->size_name;
            $size_name_to_send .= '<li><a name="' . $size->size_id . '" class="gray size_id" >' . $size_name . '</a></li>';
        }
        echo $size_name_to_send;

    }

    function getsize_id(Request $request) {
        if(inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', 1)->exists()){
          echo  '<input type="hidden" name="size_id" id="size_id" value="1">';
        } else {
            echo '<input type="hidden" name="size_id" id="size_id" value="">';
        }


    }
      /*
    |--------------------------------------------------------------------------
    | Find inventory according colorId SizeId
    |--------------------------------------------------------------------------
    */
    function SendsizeId(Request $request) {
        $availableProducts = inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->product_quantity;
        $stockOut = 'Stock Out';
        if($availableProducts >= 1) {
            echo '<span>Status: </span>'.'<p class="stock-status">'.$availableProducts.' in stock </P>';
        }
        else {
            echo '<span>Status: </span>'.'<p class="stock-status">'.$stockOut.'</P>';

        }



    }
      /*
    |--------------------------------------------------------------------------
    | Product Review
    |--------------------------------------------------------------------------
    */
    function review_put() {

    }




}
