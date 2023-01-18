<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    function subcategory()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $trashed = subcategory::onlyTrashed()->get();
        return view('admin.subcategory.index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'subtrashed' => $trashed,
        ]);
    }
    function insert(SubcategoryRequest $request)
    {
        if (subcategory::withTrashed()->where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()) {
            return back()->with('subnameexist', 'Subcategory Nam akbar ace');
        } else {
            Subcategory::insert([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
            return back()->with('insert', 'Sub Category Added Successfully');
        }
    }
    function edit($subcategory_id)
    {
        $subcategories = subcategory::find($subcategory_id);
        $categories = Category::all();
        return view('admin.subcategory.edit', [
            'subcategories' => $subcategories,
            'category' => $categories,
        ]);
    }
    function delete($subcategory_id)
    {
        Subcategory::find($subcategory_id)->delete();
        return back()->with('delete', 'Sub Category Deleted Successfully');
    }
    function update(SubcategoryRequest $request)
    {
        if (subcategory::where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()) {
            return back()->with('existsubcategory', 'Sub Category akbar ace');
        } else {
            Subcategory::where('id', $request->subcategory_id)->update([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'updated_at' => Carbon::now(),

            ]);
            return back()->with('update', 'Subcategory Update Successfully');
        }
    }
    function restore($subcategory_id)
    {
        Subcategory::withTrashed()->find($subcategory_id)->restore();
        return back();
    }
    function sub_per_delete($subcategory_id)
    {
        subcategory::onlyTrashed()->find($subcategory_id)->forceDelete();
        return back();
    }
}
