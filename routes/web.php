<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/foods/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'cart'])->name('food.cart');