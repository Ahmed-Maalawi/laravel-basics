<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    //

    public function allCat()
    {

        return view('admin.category.index');
    }

    public function addCate(Request $request) {

        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please Enter Category Name !!',
            'category_name.max' => 'Category Name Must Be Less Than 255chars !!',
            'category_name.unique' => 'Category Name Must Be unique !!',
        ]);

        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'deleted_at' => Carbon::now(),
        // ]);

        $category = new Category;

        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;

        $category->save();
           

        return redirect()->back()->with('success','Category Added Successfull');
    }

}
