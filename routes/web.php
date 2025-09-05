<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/foods/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'foodDetails'])->name('food.details');

Route::post('/foods/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'cart'])->name('food.cart');

Route::get('/foods/cart', [App\Http\Controllers\Foods\FoodsController::class, 'displayCartItems'])->name('food.displayCart');

Route::get('/foods/delete-cart/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'deleteCartItems'])->name('food.delete.cart');

Route::post('/foods/prepare-checkout', [App\Http\Controllers\Foods\FoodsController::class, 'prepareCheckout'])->name('prepare.checkout');



Route::get('/foods/checkout', [App\Http\Controllers\Foods\FoodsController::class, 'checkout'])->name('foods.checkout');


Route::post('/foods/checkout', [App\Http\Controllers\Foods\FoodsController::class, 'storeCheckout'])->name('prepare.checkout.store');

//pay with paypal;
Route::get('/foods/pay', [App\Http\Controllers\Foods\FoodsController::class, 'payWithPaypal'])->name('foods.pay');

Route::get('/foods/success', [App\Http\Controllers\Foods\FoodsController::class, 'success'])->name('foods.success');
