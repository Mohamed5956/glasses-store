<?php

use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderitemController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('home',HomepageController::class);
Route::get('placeorder/{product}',[HomepageController::class,'create'])->name('placeorder');
Route::middleware('auth')->group(function () {
    Route::resource('subcategories',  SubCategoryController::class); //
    Route::resource('categories', CategoryController::class); //
    Route::resource('products', ProductController::class);
});
Route::resource('order', OrderController::class);
Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
