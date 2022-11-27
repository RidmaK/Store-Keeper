<?php

use App\Http\Controllers\CategoryAllocationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PriceAllocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SellingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
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
    Route::get('/stock', [ProductController::class,'stock'])->name('stock');

    Route::resource('/user', UserController::class)->except('show');
    Route::get('/user/show/{id}', [UserController::class,'show'])->name('user.show');

    Route::resource('/user-group', RoleController::class)->except('show');
    Route::get('/user-group/show/{id}', [RoleController::class,'show'])->name('user-group.show');

    Route::resource('/selling', SellingController::class)->except('show');
    Route::get('/selling/show/{id}', [SellingController::class,'show'])->name('selling.show');

    Route::resource('/settings', SettingController::class)->except('show');
    Route::get('/settings/show/{id}', [SettingController::class,'show'])->name('settings.show');

    Route::resource('/category', CategoryController::class)->except('show');
    Route::get('/category/show/{id}', [CategoryController::class,'show'])->name('category.show');
    Route::get('/category/get_buying_rate', [CategoryController::class,'getBuyingRate'])->name('category.getBuyingRate');
    Route::get('/category/get_selling_rate', [CategoryController::class,'getSellingRate'])->name('category.getSellingRate');

    Route::resource('/company', CompanyController::class)->except('show');
    Route::get('/company/show/{id}', [CompanyController::class,'show'])->name('company.show');

});
