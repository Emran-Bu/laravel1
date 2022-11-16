<?php

namespace App\Http\Controllers;

date_default_timezone_set("Asia/Dhaka");

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
        // $brand = Brand::all();
        // $brand = Brand::latest()->get();
        // $brand = Brand::latest()->get();
        // $brand = Brand::orderBy('id','desc')->get();
        // $brand = Brand::orderBy('id','desc')->paginate(3);
        // $brand = DB::table('Brand')->orderBy('id','desc')->paginate(3);
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
        // $ox = $brand_img->getClientMimeType();
        // $nameGen = hexdec(uniqid());

        $brand_img = $request->file('brand_img');
        $img_ext = $brand_img->getClientOriginalExtension();
        $img_or_name = $brand_img->getClientOriginalName();
        $divide_name = current(explode('.',$img_or_name));
        $nameGen = preg_replace('/[^A-Za-z0-9\-]/', '_' ,$divide_name);
        $date_img_name = date('d_m_y_h_i_sa_');
        $up_location = "images/brand/";
        $image_name = $date_img_name . $nameGen . '.' . $img_ext;
        $final_db_upload = $up_location . $date_img_name . $nameGen . '.' . $img_ext;
        $brand_img->move($up_location, $image_name);

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_img = $final_db_upload;

        $brand->save();

        return redirect()->back()->with('success', 'Brand added successfully');

        //  eloquent orm = object relational mapper 2nd rule

        // Brand::insert([
        //     "brand_name" => $request->brand_name,
        //     "brand_img" => $final_db_upload,
        //     "created_at" => Carbon::now(),
        //     "updated_at" => Carbon::now()
        // ]);

        //  query builder 1st rule

        // DB::table('brands')->insert([
        //     'brand_name' => $request->brand_name,
        //     'brand_img' => $final_db_upload,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        //  query builder 2nd rule

        // $data = array();

        // $data['brand_name'] = $request->brand_name;
        // $data['brand_img'] = $final_db_upload;
        // $data['created_at'] = Carbon::now();
        // $data['updated_at'] = Carbon::now();

        // DB::insert($data);


    }

    public function editBrand($id)
    {
        $brand = Brand::find($id);
        // return view('admin.brand.brandEdit', compact('brand'));
        // $brand = DB::table('brands')->where('id', $id)->first();
        if ($brand) {
            return view('admin.brand.brandEdit', ['brand'=>$brand]);
        } else{
            return redirect()->back();
        }

    }

    public function updateBrand(Request $request, $id)
    {
        $request->validate([
            "brand_name" => "required"
        ],
        [
            "brand_name.required" => "Please Fill the field"
        ]);

        $brand_img = $request->file('brand_img');
        if ($brand_img) {

            $old_image = $request->old_image;
            if ($old_image) {
                unlink($old_image);
            }

            $img_ext = $brand_img->getClientOriginalExtension();
            $img_or_name = $brand_img->getClientOriginalName();
            $divide_name = current(explode('.',$img_or_name));
            $nameGen = preg_replace('/[^A-Za-z0-9\-]/', '_' ,$divide_name);
            $date_img_name = date('d_m_y_h_i_sa_');
            $up_location = "images/brand/";
            $image_name = $date_img_name . $nameGen . '.' . $img_ext;
            $final_db_upload = $up_location . $date_img_name . $nameGen . '.' . $img_ext;
            $brand_img->move($up_location, $image_name);

            $brand = Brand::find($id);
            $brand->brand_name = $request->brand_name;
            $brand->brand_img = $final_db_upload;
            $brand->update();
            return redirect()->route('allBrand')->with('success', 'Brand Updated Successfully...');
        } else {
            $brand = Brand::find($id);
            $brand->brand_name = $request->brand_name;
            $brand->update();
            return redirect()->route('allBrand')->with('success', 'Brand Updated Successfully...');
        }

    }

    public function softDelete($id)
    {
        
    }
}
