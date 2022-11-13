<?php

use App\Http\Controllers\CategoryAllocationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PriceAllocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('/customer', CustomerController::class)->except('show');
    Route::get('/customer/show/{id}', [CustomerController::class,'show']);
    Route::get('/customer/check_availability', [CustomerController::class,'checkAvailability'])->name('customer.checkAvailability');


    Route::resource('/product', ProductController::class)->except('show');
    Route::get('/product/show/{id}', [ProductController::class,'show']);

});
