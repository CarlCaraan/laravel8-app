<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// ~Add all models 
use App\Models\Category; // ~Eloquent method

use Illuminate\Support\Facades\DB; // ~Query builder method

use Auth;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    // ~Add anchor tag link or the main route link
    public function AllCat()
    {   
        // ~Fetch all data in categories table
        $categories = Category::latest()->get();
        return view('/admin.category.index', compact('categories'));
    }

    // ~Add categories method
    public function AddCat(Request $request)
    {
        // ~Validate the request...
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        // ~Custom Error messages
        [
            'category_name.required' => 'Please Input Category Name',
        ]);

        // ~Inserting data to db
        // ~Eloquent method1
        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);
        
        // ~Eloquent method2
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        // ~Query builder method
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Category Inserted Successfully');

    }
}
