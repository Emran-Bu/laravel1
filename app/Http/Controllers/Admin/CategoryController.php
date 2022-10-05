<?php

namespace App\Http\Controllers\Admin;

date_default_timezone_set("Asia/Dhaka");

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    //
    public function getData()
    {
        // eloquent orm
        // $category = Category::all();
        // $category = Category::latest()->get();
        // $category = Category::orderBy('id', 'desc')->get();
        $category = Category::orderBy('id', 'desc')->paginate(5);
        // query builder
        // $category = DB::table('categories')->orderBy('id', 'desc')->get();
        // $category = DB::table('categories')->orderBy('id', 'desc')->paginate(2);
        if ($category) {
            return view('admin.category', compact('category'));
        } else {
            return view('admin.category');
        }
    }

    public function addCat(Request $request)
    {
        $validator = $request->validate([
            'cat_name' => ['required'],
        ],

        [
        'cat_name.required' => 'please fill the form',
        'cat_name.min' => 'at-least 5 character',
        ]);

        // eloquent orm 1st rule

        // category::insert([
        //     'user_id' => Auth::user()->id,
        //     'cat_name' => $request->cat_name,
        //     'created_at' => Carbon::now(),
        // ]);

        // eloquent orm 1st rule

        $category = new Category();
        $category->user_id = Auth::user()->id;
        $category->cat_name = $request->cat_name;
        $category->save();

        // query builder 1st rule

        // DB::table('categories')->insert([
        //     'user_id' => Auth::user()->id,
        //     'cat_name' => $request->cat_name,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);

        // query builder 2nd rule

        // $data = Array();

        // $data['user_id'] = Auth::user()->id;
        // $data['cat_name'] = $request->cat_name;
        // $data['created_at'] = Carbon::now();
        // $data['updated_at'] = Carbon::now();

        // DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Category Added Successfully');
    }
}
