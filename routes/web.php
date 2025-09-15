<?php

use App\Http\Controllers\Foods\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckForAuth;
use App\Http\Controllers\Admins\AdminsController;




// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');

Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');


Route::group(["prefix" => "foods"], function () {

    Route::get('/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'foodDetails'])->name('food.details');

    Route::post('/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'cart'])->name('food.cart');

    Route::get('/cart', [App\Http\Controllers\Foods\FoodsController::class, 'displayCartItems'])->name('food.displayCart');

    Route::get('/delete-cart/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'deleteCartItems'])->name('food.delete.cart');

    Route::post('/prepare-checkout', [App\Http\Controllers\Foods\FoodsController::class, 'prepareCheckout'])->name('prepare.checkout');

    Route::get('/checkout', [App\Http\Controllers\Foods\FoodsController::class, 'checkout'])->name('foods.checkout');

    Route::post('/checkout', [App\Http\Controllers\Foods\FoodsController::class, 'storeCheckout'])->name('prepare.checkout.store');

    Route::get('/pay', [App\Http\Controllers\Foods\FoodsController::class, 'payWithPaypal'])->name('foods.pay');

    Route::get('/success-process', [App\Http\Controllers\Foods\FoodsController::class, 'success'])->name('foods.success');


    Route::get('/success', [App\Http\Controllers\Foods\FoodsController::class, 'displaySuccess'])->name('foods.displaySuccess');


    Route::post('/booking', [App\Http\Controllers\Foods\FoodsController::class, 'bookingTables'])->name('food.booking.table');


    Route::get('/menu', [App\Http\Controllers\Foods\FoodsController::class, 'menu'])->name('foods.menu');
});

Route::group(
    ["prefix" => "users"],
    function () {
        Route::get('/all-bookings', [App\Http\Controllers\Users\UsersController::class, 'getBookings'])->name('users.bookings');

        Route::get('/orders', [App\Http\Controllers\Users\UsersController::class, 'getOrders'])->name('users.orders');

        //review

        Route::get('/write-review', [App\Http\Controllers\Users\UsersController::class, 'writeReview'])->name('users.write.review');

        Route::post('/submit-review', [App\Http\Controllers\Users\UsersController::class, 'submitReview'])->name('users.submit.review');
    }
);





// Admin login page
Route::get('/admins/login', [AdminsController::class, 'viewLogin'])
    ->middleware('check.admin.auth')
    ->name('admins.login');

//admin login POST
Route::post('/admins/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');
//admin logout
Route::post('/admins/logout', [App\Http\Controllers\Admins\AdminsController::class, 'adminLogout'])
    ->middleware('admin.auth')
    ->name('admins.logout');

//protected admin routes
Route::prefix('admins')->middleware('admin.auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admins\AdminsController::class, 'dashboard'])->name('admins.dashboard');

    //admin
    Route::get('/admins-list', [App\Http\Controllers\Admins\AdminsController::class, 'adminList'])->name('admins.list');
    Route::get('/create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'createAdmin'])->name('admins.create');
    Route::post('/store-admins', [App\Http\Controllers\Admins\AdminsController::class, 'storeAdmin'])->name('admins.store');

    //orders
    Route::get('/all-orders', [App\Http\Controllers\Admins\AdminsController::class, 'viewOrders'])->name('admins.orders');
    Route::get('/edit-order/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editOrder'])->name('edit.order');
    Route::post('/edit-order/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateOrder'])->name('update.order');
    Route::get('/delete-order/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteOrder'])->name('delete.order');


    //bookings
    Route::get('/all-bookings', [App\Http\Controllers\Admins\AdminsController::class, 'viewBookings'])->name('admins.bookings');
    Route::get('/edit-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editBooking'])->name('edit.booking');
    Route::post('/edit-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateBooking'])->name('update.booking');
    Route::get('/delete-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteBooking'])->name('delete.booking');


    //foods

    Route::get('/all-foods', [App\Http\Controllers\Admins\AdminsController::class, 'viewFoods'])->name('admins.foods');

    Route::get('/create-food', [App\Http\Controllers\Admins\AdminsController::class, 'createFood'])->name('create.food');

    Route::post('/store-food', [App\Http\Controllers\Admins\AdminsController::class, 'storeFood'])->name('store.food');

    Route::get('/delete-food/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteFood'])->name('delete.food');
});
