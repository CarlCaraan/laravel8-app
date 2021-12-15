<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Brand; // ~Eloquent method
use App\Models\Multipic; // ~Eloquent method

use Image;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request)
    {
        // ~Validate the request...
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
        // ~Custom Error messages
        [
            'brand_name.required' => 'Please input brand name',
            'brand_image.min' => 'Brand longer than 4 characters',
        ]);

        // ~Uploading image
        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,300)->save('image/brand/'.$name_gen);
        $last_img = 'image/brand/'.$name_gen;
        
        // ~Inserting image to db
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        
        // ~uploading image without using image intervention
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen. '.' . $img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location,$img_name);

        return redirect()->back()->with('success', 'Brand Inserted Successfully');
    }

    public function Edit($id)
    {
        $brands = Brand::find($id); // ~Eloquent method
        return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request, $id)
    {
        // ~Validate the request...
        $validatedData = $request->validate(
            [
                'brand_name' => 'required|min:4',
            ],
            // ~Custom Error messages
            [
                'brand_name.required' => 'Please input brand name',
                'brand_image.min' => 'Brand longer than 4 characters',
            ]
        );

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location . $img_name;
            $brand_image->move($up_location, $img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Brand Updated Successfully');
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Brand Updated Successfully');
        }
    }

    public function Delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return redirect()->back()->with('success', 'Brand Deleted Successfully');
    }

    //========= ~START MULTI IMAGE =========

    // ~Multi image method
    public function AllMulti()
    {
        $images = Multipic::latest()->paginate(3);
        return view('admin.multipic.index', compact('images'));
    }

    public function AddImage(Request $request)
    {
        // ~Uploading image
        $images = $request->file('image');

        foreach ($images as $image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('image/multi/'.$name_gen);
            $last_img = 'image/multi/'.$name_gen;
            
            // ~Inserting image to db
            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }
        return redirect()->back()->with('success', 'Brand Inserted Successfully');
    }
}
