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

    // Route::post('logout/{id}', [CustomerController::class, 'logout']);
    
});
