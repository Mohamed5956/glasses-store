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
use App\Http\Controllers\Auth\LogoutController;


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

// Route::resource('home', HomepageController::class);
Route::get('/subcategory/{subcategory}',[HomepageController::class,'subcategory'])->name('subcategory.show');
Route::get('/', [HomepageController::class,'index'])->name('home.index');
Route::resource('home',HomepageController::class);
Route::post('filter',[HomepageController::class,'filter'])->name('home.filter');
Route::get('productList',[HomepageController::class,'productList'])->name('productList');
Route::get('sales',[HomepageController::class,'sales'])->name('home.sales');
Route::get('placeorder/{product}',[HomepageController::class,'create'])->name('placeorder');
Route::middleware('auth')->group(function () {
    Route::get('/cart/count', [CartController::class, 'cartCount'])->name('cart.count');
    Route::resource('subcategories', SubCategoryController::class); //
    Route::resource('categories', CategoryController::class); //
    Route::resource('products', ProductController::class);
    Route::resource('cart', CartController::class);
    //    Route::get('/cart/count', [CartController::class, 'cartCount'])->name('cart.count');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    // Route::get('/cart/create', [CartController::class, 'create'])->name('cart.create');
    Route::get('/carts/confirm_order', [CartController::class, 'proceedOrder'])->name('cart.confirm_order');
    Route::post('/cart/save', [CartController::class, 'save'])->name('cart.save');


    // Route::get('/carts/count', [CartController::class, 'cartCount'])->name('cart.count');
});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::resource('order', OrderController::class);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
