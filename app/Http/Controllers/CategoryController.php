<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoyRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function category()
    {
        $categories = category::all();
        $trshed_categories = category::onlyTrashed()->get();
        return view(
            'admin.category.index',
            [
                'catemaks' => $categories,
                'trashed_categories' => $trshed_categories,

            ]
        );
    }
    function restore($category_id)
    {
        Category::withTrashed()->find($category_id)->restore();
        return back()->with('cate_success', 'Category restore sucessfully');
    }
    function insert(CategoyRequest $request)
    {
        Category::insert([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Category Added Successfully');
    }
    function delete($category_id)
    {
        category::find($category_id)->delete();
        return back()->with('delete', 'Category deleted successfully');
    }
    function force_delete($trashed_category_id) {
        category::onlyTrashed()->find($trashed_category_id)->forceDelete();
        return back()->with('category_force_delete', 'Category item permanent deleted successfully');

    }
    function edit($category_id)
    {
        $edit_category = category::find($category_id);
        return view('admin.category.edit', compact('edit_category'));
    }
    function update(CategoyRequest $request)
    {
        if ($request->category_image == '') {
            Category::where('id', $request->category_id)->update([
                'category_name' => $request->category_name,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            $old_image = Category::find($request->category_id)->category_image;
            $path = public_path() . "/uploads/category/" . $old_image;
            if (is_file($path)) {
                unlink($path);
                $new_category_image = $request->category_image;
                $extension = $new_category_image->getClientoriginalExtension();
                $new_category_name =  $request->category_id . '.' . $extension;
                image::make($new_category_image)->resize(600, 328)->save(base_path('public/uploads/category/' . $new_category_name));
                Category::where('id', $request->category_id)->update([
                    'category_image' => $new_category_name,
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                $new_category_image = $request->category_image;
                $extension = $new_category_image->getClientoriginalExtension();
                $new_category_name =  $request->category_id . '.' . $extension;
                image::make($new_category_image)->resize(600, 328)->save(base_path('public/uploads/category/' . $new_category_name));
                Category::where('id', $request->category_id)->update([
                    'category_name' => $request->category_name,
                    'category_image' => $new_category_name,
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        return back()->with('update', 'Category Updated successfully');
    }
}
