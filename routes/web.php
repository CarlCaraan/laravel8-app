<?php

use Illuminate\Support\Facades\Route;

// ~Add all class
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;

// ~Add all model
use App\Models\User; // ~Eloquent method

// ~Add db 
use Illuminate\Support\Facades\DB; // ~Query builder method

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ~Verify email addres route
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    // $sliders = DB::table('sliders')->get();
    return view('home', compact('brands'));
});

Route::get('/home', function () {
    return view('home');
});

// ~Add all controller
Route::get('/contact', [ContactController::class, 'index']);

// ~Category Routes
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category'); // ~Add Category or inserting data
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']); // ~Edit Category route after clicking the edit button
Route::post('/category/update/{id}', [CategoryController::class, 'Update']); // ~Update Category
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']); // ~SoftDelete Category
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']); // ~Restore Category
Route::get('/delete/category/{id}', [CategoryController::class, 'Delete']); // ~Delete Category

// ~Brand Routes
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand'); 
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand'); // ~Add brand or inserting data
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']); // ~Edit brand route after clicking the edit button
Route::post('/brand/update/{id}', [BrandController::class, 'Update']); // ~Update Brand
Route::get('/delete/brand/{id}', [BrandController::class, 'Delete']); // ~Delete Brand

// ~Brand Routes
Route::get('/multi/image', [BrandController::class, 'AllMulti'])->name('multi.image'); 
Route::post('/multi/add', [BrandController::class, 'AddImage'])->name('store.image'); // ~Add multi image or inserting data

// ~Home Slider Routes
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider'); 
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider'); //~ Add home slider
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider'); //~ Add home slider
Route::get('/slider/edit/{id}', [HomeController::class, 'EditSlider']); // ~Edit Slider route after clicking the edit button
Route::post('/slider/update/{id}', [HomeController::class, 'UpdateSlider']); // ~Update Slider 
Route::get('/delete/slider/{id}', [HomeController::class, 'Delete']); // ~Delete Slider

// ~Home About Routes
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about'); 
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about'); //~ Add about
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about'); //~ Store about
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']); //~ Edit about
Route::post('/about/update/{id}', [AboutController::class, 'UpdateAbout']); // ~Update About 
Route::get('/delete/about/{id}', [AboutController::class, 'Delete']); // ~Delete Slider

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // ~fetch users table data
    // $users = User::all(); //~Eloquent method
    // $users = DB::table('users')->get(); // ~Query builder method
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout'); 
