<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecommendedItem;
use App\Http\Controllers\RecommendedList;
use App\Http\Controllers\InvoiceController;
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

Route::resource('invoice', InvoiceController::class);
Route::get('create_product', 'App\Http\Controllers\ProductController@create')->name('product.create');
Route::post('product/store', 'App\Http\Controllers\ProductController@store')->name('product.store');
Route::get('recommended/lists', 'App\Http\Controllers\RecommendedList@index')->name('recommended.lists');
Route::post('recommended/items', 'App\Http\Controllers\RecommendedItem@index')->name('recommended.items');

Route::get('/', function () {
    return view('admin.invoice');
});
