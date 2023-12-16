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
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Auth\CustomerAuthController;

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
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/product_list', [HomeController::class, 'product_list']);
Route::get('/customer/login', [HomeController::class, 'login'])->name('customer.login');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/{product}', [WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth.customer');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/thankyou', [CheckoutController::class, 'thankyou'])->name('confirmation.index');

// Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');

//customer login & register route
Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.register');
Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.add');
Route::get('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');


Route::group(['prefix'=>'admin','middleware' => ['prevent-back-history','auth']], function() {
   Route::get('logout', [AuthController::class, 'logout'])->name('logout');

	// Dashboard Route
	Route::get('/','App\Http\Controllers\Dashboard@index')->name('dashboard');
	Route::get('/dashboard','App\Http\Controllers\Dashboard@index')->name('dashboard.index');

	// User Route
	Route::resource('user', UserController::class); 

	// Admin Route
	Route::post('/change-password', [AdminController::class, 'updatePassword'])->name('update-password');
	Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
	Route::post('profile/update', [AdminController::class, 'updateprofile'])->name('profile.update');

	// Customer Route
	Route::resource('customer', CustomerController::class);
	Route::post('/customer-password-update/{id}', [CustomerController::class, 'updatePassword'])->name('change-password');

	// Product Route
	Route::resource('product', ProductController::class);
	Route::resource('product-inventory', InventoryController::class);

	// Category Route
	Route::resource('category', CategoryController::class);
});

Route::get('/admin/login', [AuthController::class, 'index'])->name('login');
Route::post('/admin/post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
// Route::get('registration', [AuthController::class, 'registration'])->name('register');
// Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');