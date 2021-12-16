<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider()
    {
        return view('admin.slider.create');
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
}
