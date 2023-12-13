<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

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


//frontend routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/detail/{product}', [HomeController::class, 'detail'])->name('detail');
Route::get('/cart', [HomeController::class, 'cart']);
Route::get('/wishlist', [HomeController::class, 'wishlist']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/product_list', [HomeController::class, 'product_list']);
Route::get('/customer/login', [HomeController::class, 'login']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index'); //->middleware('auth')
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');

Route::group(['middleware' => ['prevent-back-history','auth']], function() {
   Route::get('logout', [AuthController::class, 'logout'])->name('logout');

	// Dashboard Route
	Route::get('/dashboard','App\Http\Controllers\Dashboard@index')->name('dashboard');

	// User Route
	Route::resource('user', UserController::class); 

	// Admin Route
	Route::post('/change-password', [AdminController::class, 'updatePassword'])->name('update-password');
	Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
	Route::post('profile/update', [AdminController::class, 'updateprofile'])->name('profile.update');

	// Customer Route
	Route::resource('customer', CustomerController::class);
	Route::post('/customer-password-update/{id}', [CustomerController::class, 'updatePassword'])->name('change-password');

	// Product Route
	Route::resource('product', ProductController::class);

	// Category Route
	Route::resource('category', CategoryController::class);
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
// Route::get('registration', [AuthController::class, 'registration'])->name('register');
// Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');