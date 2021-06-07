<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\ProductController;
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

Route::resource('invoice', invoiceController::class);
Route::get('create_product', 'App\Http\Controllers\ProductController@create');
Route::post('product/store', 'App\Http\Controllers\ProductController@store')->name('product.store');


Route::get('/', function () {
    return view('admin.invoice');
});
