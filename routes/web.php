<?php

use App\Http\Controllers\Access\LoginController;
use App\Http\Controllers\Access\RegisterController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Cart\CouponController;
use App\Http\Controllers\Cart\OrderController;
use App\Http\Controllers\Product\ShopController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'app'])->name('ecommerce');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logon', [LoginController::class, 'logon'])->name('logon');


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/registrer', [RegisterController::class, 'createUser'])->name('registrer');

//Product
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/product/{id}', [ShopController::class, 'product'])->name('product');

Route::middleware('auth')->group(function () {

    //User
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/update-address', [UserController::class, 'address'])->name('update-address');
    Route::post('/update-user', [UserController::class, 'updateUser'])->name('update-user');

    //Cart
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/add-cart', [CartController::class, 'addCart'])->name('add-cart');
    Route::post('/delete-cart', [CartController::class, 'removeCart'])->name('delete-cart');

    //Coupon
    Route::post('/create-discount', [CouponController::class, 'createDiscount'])->name('create-discount');
    Route::post('/remove-discount', [CouponController::class, 'removeDiscount'])->name('remove-discount');

    //Order
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my-orders');
    Route::post('/create-order', [OrderController::class, 'createOrder'])->name('create-order');

    //Session
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});