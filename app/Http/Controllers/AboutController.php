<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use App\Models\User;
use Illuminate\Support\Carbon;
use Auth;

class AboutController extends Controller
{
    public function HomeAbout()
    {
        $abouts = HomeAbout::latest()->paginate(5);
        $user = User::find(Auth::user()->id);
        return view('admin.about.index', compact('abouts', 'user'));
    }

    public function AddAbout()
    {
        $user = User::find(Auth::user()->id);
        return view('admin.about.create', compact('user'));
    }

    public function StoreAbout(Request $request)
    {
        // ~Validate the request...
        $validatedData = $request->validate(
            [
                'title' => 'required|unique:home_abouts|min:4',
                'short_desc' => 'required|unique:home_abouts|min:4',
                'long_desc' => 'required|unique:home_abouts|min:4',
            ],
            // ~Custom Error messages
            [
                'title.required' => 'Please input about title',
                'short_desc.required' => 'Please input short description',
                'long_desc.required' => 'Please input long description',
            ]
        );

        // ~Inserting data to db
        HomeAbout::insert([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'About Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('home.about')->with($notification);
    }

    public function EditAbout($id)
    {
        $abouts = HomeAbout::find($id); // ~Eloquent method
        $user = User::find(Auth::user()->id);
        return view('admin.about.edit', compact('abouts', 'user'));
    }

    public function UpdateAbout(Request $request, $id)
    {
        // ~Validate the request...
        $validatedData = $request->validate(
            [
                'title' => 'required|min:4',
                'short_desc' => 'required|min:4',
                'long_desc' => 'required|min:4',
            ],
            // ~Custom Error messages
            [
                'title.required' => 'Please input about title',
                'short_desc.required' => 'Please input short description',
                'long_desc.required' => 'Please input long description',
            ]
        );

        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'About Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('home.about')->with($notification);
    }

    public function Delete($id)
    {
        HomeAbout::find($id)->delete();
        $notification = array(
            'message' => 'About Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    //========= HOME PORTFOLIO =========//

    public function Portfolio()
    {
        $multipics = Multipic::all();
        return view('pages.portfolio', compact('multipics'));
    }
}
