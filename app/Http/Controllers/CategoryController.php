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
    // ~Add middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ~Add anchor tag link or the main route link
    public function AllCat()
    {   
        // ~One to one relationship using query builder
        // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(5);

        // ~Fetch all data in categories table
        $categories = Category::latest()->paginate(5); // ~Eloquent method

        // ~Fetch trashed categories
        $trashedCat = Category::onlyTrashed()->latest()->paginate(3);
        // $categories = DB::table('categories')->latest()->get(); // ~Query builder method

        return view('admin.category.index', compact('categories', 'trashedCat'));
    }

    // ~ Store category
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
        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        
        // ~Eloquent method2
        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // ~Query builder method
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Category Inserted Successfully');

    }

    // ~Return view of edit category button
    public function Edit($id)
    {
        $categories = Category::find($id); // ~Eloquent method
        // $categories = DB::table('categories')->where('id', $id)->first(); // ~Query builder method
        return view('admin.category.edit', compact('categories'));
    }

    // ~Update category
    public function Update(Request $request, $id)
    {   
        // ~Eloquent method
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        // ~Query builder method
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->where('id', $id)->update($data);

        return redirect()->route('all.category')->with('success', 'Category Updated Successfully');
    }

    // ~SoftDelete
    public function SoftDelete($id)
    {
        $softdelete = Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category Trashed Successfully');
    }

    // ~Restore Category
    public function Restore($id)
    {
        $restore = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Category Restore Successfully');
    }

    // ~Delete Category
    public function Delete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
