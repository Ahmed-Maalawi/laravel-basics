<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function allBrands() {

        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index', compact('brands'));
    }

    public function storeBrand(Request $request) {

        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => 'please input brand name',
                'brand_name.min' => 'brand name must be longer than char ',
            ]
        );

        $brand_image = $request->file('brand_image');

        $createName = hexdec(uniqid()); //generate unique name for image
        $image_ext = strtolower($brand_image->getClientOriginalExtension()); // get image extension
        $new_img_name = $createName.'.'.$image_ext; //create new name with extension for the image


        $up_location = 'images/brand/';
        $last_img = $up_location.$new_img_name;

        $brand_image->move($up_location, $new_img_name);

        $brand = Brand::create([
            'brand_name' => $request['brand_name'],
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'brand insert successfully');
    }

    public function edit($id) {
        $brands = Brand::find($id);

        return view('admin.brand.edit', compact('brands'));
    }

    public function update(Request $request, $id) {

        $validateData = $request->validate([

                'brand_name' => 'required|min:4',
            ],
            [
                'brand_name.required' => 'please input brand name',
                'brand_name.min' => 'brand name must be longer than char ',
            ]);

        $old_img = $request['old_image'];

        $brand_image = $request->file('brand_image');

        if ($brand_image) {

            $createName = hexdec(uniqid()); //generate unique name for image
            $image_ext = strtolower($brand_image->getClientOriginalExtension()); // get image extension
            $new_img_name = $createName.'.'.$image_ext; //create new name with extension for the image


            $up_location = 'images/brand/';
            $last_img = $up_location.$new_img_name;

            $brand_image->move($up_location, $new_img_name);

            unlink($old_img);
            $brand = Brand::find($id)->update([
                'brand_name' => $request['brand_name'],
                'brand_image' => $last_img,
                'updated_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'brand updated successfully');

        } else {

            $brand = Brand::find($id)->update([
                'brand_name' => $request['brand_name'],
                'updated_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'brand updated successfully');
        }
    }

    public function Delete($id) {
         
        $brand = Brand::find($id);

        $brandImg = $brand->brand_image;
        unlink($brandImg);

        $brand->delete();
        
        return redirect()->back()->with('success', 'brand deleted successfully');
    }
}
