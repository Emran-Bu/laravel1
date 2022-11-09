<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class brandController extends Controller
{
    // allBrand show
    public function allBrand()
    {
        // brandIndex
        $brand = Brand::paginate(2);
        return view('admin.brand.brandIndex', compact('brand'));
    }

    public function addBrand(Request $request)
    {
        // validation 1

        // $request->validate([
        //     'brand_name' => 'required',
        // ],

        // [
        //     'brand_name.required' => 'This field must be fill-up'
        // ]);

        // validation 2

        $array = [
                'brand_name' => 'required|unique:brands|max:100',
                'brand_img' => 'required|mimes:jpg,jpeg,gif,png'
            ];

        $rule = [
                'brand_name.max' => 'you can only use 100 characters',
                'brand_img.required' => 'you can upload only: jpg, jpeg, gif, png'
            ];

        $request->validate($array, $rule);

        // validation 3

        // $validate = [
        //     'brand_name' => 'required'
        // ];

        // $message = [
        //     'brand_name.required' => 'This field must be fill-up'
        // ];

        // $validator = validator::make($request->all(), $validate, $message);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // return redirect()->back();

        // eloquent orm 1st rule

        // code for image upload

        //
        // $ox = $brand_img->getClientMimeType();

        $brand_img = $request->file('brand_img');
        echo $img_or_name = str_replace(' ',$brand_img->getClientOriginalName());
        $img_ext = strtolower($brand_img->getClientOriginalExtension());
        $nameGen = hexdec(uniqid());
        $image_name = $nameGen . '.' . $img_ext;
        // echo $request->name;
        // return redirect()->back();

        die();

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_img = $request->brand_img;

        $brand->save();

        return redirect()->back()->with('success', 'Brand added successfully');

        //  eloquent orm = object relational mapper 2nd rule

        // Brand::insert([
        //     "brand_name" => $request->brand_name,
        //     "brand_img" => $request->bran,
        //     "created_at" => Carbon::now(),
        //     "updated_at" => Carbon::now()
        // ]);

        //  query builder 1st rule

        // DB::table('brands')->insert([
        //     'brand_name' => $request->brand_name,
        //     'brand_img' => $request->bran,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        //  query builder 2nd rule

        // $data = array();

        // $data['brand_name'] = $request->brand_name;
        // $data['brand_img'] = $request->brand_img;
        // $data['created_at'] = Carbon::now();
        // $data['updated_at'] = Carbon::now();

        // DB::insert($data);


    }
}
