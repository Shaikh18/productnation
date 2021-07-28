<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// products route
// Route::apiResource('product', 'App\Http\Controllers\ProductController');
Route::get('product', [App\Http\Controllers\ProductController::class, 'index'])->name('product_index');
Route::post('product', [App\Http\Controllers\ProductController::class, 'store'])->name('product_store');
Route::post('product_update', [App\Http\Controllers\ProductController::class, 'update'])->name('product_update');
Route::get('product_find', [App\Http\Controllers\ProductController::class, 'show'])->name('product_find');
Route::get('product_del', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product_del');
