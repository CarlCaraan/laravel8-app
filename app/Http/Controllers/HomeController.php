<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $sliders = Slider::latest()->paginate(5);
        $user = User::find(Auth::user()->id);
        return view('admin.slider.index', compact('sliders', 'user'));
    }

    public function AddSlider()
    {
        $user = User::find(Auth::user()->id);
        return view('admin.slider.create', compact('user'));
    }

    public function StoreSlider(Request $request)
    {
        // ~Validate the request...
        $validatedData = $request->validate([
            'title' => 'required|unique:sliders|min:4',
            'description' => 'required|unique:sliders|min:4',
            'image' => 'required|mimes:jpg,jpeg,png',
        ],
        // ~Custom Error messages
        [
            'title.required' => 'Please input slider title',
            'description.required' => 'Please input slider description',
            'image.min' => 'Slider longer than 4 characters',
        ]);

        // ~Uploading image
        $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);
        $last_img = 'image/slider/'.$name_gen;
        
        // ~Inserting image to db
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        
        return redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');
    }

    public function EditSlider($id)
    {
        $sliders = Slider::find($id); // ~Eloquent method
        $user = User::find(Auth::user()->id);
        return view('admin.slider.edit', compact('sliders', 'user'));
    }

    public function UpdateSlider(Request $request, $id)
    {
        // ~Validate the request...
        $validatedData = $request->validate(
            [
                'title' => 'required|min:4',
                'description' => 'required',
            ],
            // ~Custom Error messages
            [
                'title.required' => 'Please input Slider Name',
                'description.required' => 'Please input Slider Description',
                'image.min' => 'Slider longer than 4 characters',
            ]
        );

        $old_image = $request->old_image;
        $image = $request->file('image');

        if($image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/slider/';
            $last_img = $up_location . $img_name;
            $image->move($up_location, $img_name);

            unlink($old_image);
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Slider Updated Successfully');
        }else{
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('home.slider')->with('success', 'Slider Updated Successfully');
        }
    }
    
    public function Delete($id)
    {
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return redirect()->back()->with('success', 'Slider Deleted Successfully');
    }
}
