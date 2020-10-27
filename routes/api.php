<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

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
Route::post('/login',  [AuthController::class, 'login'])->name('login');

Route::get('/categories',  [CategoryController::class, 'index']);
Route::get('/products',  [ProductController::class, 'index']);
Route::get('/products/categories',  [ProductController::class, 'category']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');;

    Route::resource('categories', CategoryController::class)->except([
        'index'
    ]);
    Route::resource('products', ProductController::class)->except([
        'index'
    ]);

});
