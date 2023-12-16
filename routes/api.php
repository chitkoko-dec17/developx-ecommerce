<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CustomerController;
// use App\Http\Controllers\API\DingerPayController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [CustomerController::class, 'register']);
Route::post('login', [CustomerController::class, 'login']);
     
Route::middleware('auth:api')->group( function () {
    // Route::get('customer/{id}', [CustomerController::class, 'customer']);

    // Route::get('books/premium', [BookController::class, 'get_premium_books']);
    // Route::get('books/free', [BookController::class, 'get_free_books']);
    // Route::get('book/chapters/{id}', [BookController::class, 'get_book_chapters']);
    // Route::get('book/recommended', [BookController::class, 'get_recommended_books']);
    // Route::get('coins', [BookController::class, 'get_coins']);
    // Route::get('book/chapter/detail/{id}', [BookController::class, 'get_book_chapter_detail']);
    // Route::get('search/{name}',[BookController::class, 'search_book']);
    // Route::get('search',[BookController::class, 'search_book_empty']);
    // Route::post('customer/recent/book',[BookController::class, 'customer_recent_book']);
    // Route::get('customer/recent/books/{id}',[BookController::class, 'get_customer_recent_books']);
    // Route::get('app_home',[BookController::class, 'get_app_home']);

    // Route::post('logout/{id}', [CustomerController::class, 'logout']);
    // Route::get('customer/{id}/coin/history',[CustomerController::class, 'get_customer_coin_history']);
    // Route::get('customer/{id}/books',[BookController::class, 'get_customer_books']);
    // Route::post('customer/buy/book',[BookController::class, 'customer_buy_book']);

    // //payment
    // Route::post('payloadurl', [DingerPayController::class, 'create_payloadurl']);

    // //version
    // Route::get('version', [BookController::class, 'get_versions']);
    
});
