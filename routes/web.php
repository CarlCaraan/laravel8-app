<?php

use Illuminate\Support\Facades\Route;

// ~Add all class
use App\Http\Controllers\ContactController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

// ~Add all controller
Route::get('/contact', [ContactController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // ~fetch users table data
    $users = User::all();
    // $users = DB::table('users')->get(); // ~Query builder method

    return view('dashboard', compact('users'));
})->name('dashboard');
