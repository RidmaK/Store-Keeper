<?php

use App\Http\Controllers\CategoryAllocationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\PriceAllocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DealerController;
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
    Route::get('/product/show/{id}', [ProductController::class,'show'])->name('product.show');
    Route::post('/product/import',[ProductController::class,'import'])->name('product.importProductExcel');

    Route::resource('/category', CategoryController::class)->except('show');
    Route::get('/category/show/{id}', [CategoryController::class,'show'])->name('category.show');

    Route::resource('/dealer', DealerController::class)->except('show');
    Route::get('/dealer/show/{id}', [DealerController::class,'show'])->name('dealer.show');
    Route::post('/dealer/import',[DealerController::class,'import'])->name('dealer.importExcel');

    Route::get('/stock', [ProductController::class,'stock'])->name('stock');

    Route::resource('/store', StoreController::class)->except('show');
    Route::get('/store/show/{id}', [StoreController::class,'show']);

    Route::resource('/order', OrderController::class)->except('show');
    Route::get('/order/show/{id}', [OrderController::class,'show']);
    Route::get('get-order-data', [OrderController::class,'getOrderData'])->name('order.data');;
    Route::get('/order/get-order-details', [OrderController::class,'getOrderDetails'])->name('order.getOrderDetails');
    Route::post('/order/stage-change', [OrderController::class,'setStage'])->name('order.setStage');
    Route::post('/order/update-in-stock/{type}', [OrderController::class,'updateStockInDetails'])->name('order.updateStockInDetails');
    Route::post('/order/update-out-stock/{type}', [OrderController::class,'updateStockOutDetails'])->name('order.updateStockOutDetails');
    Route::post('/order/update-waorrenty-stock/{type}', [OrderController::class,'updateStockWarrentyDetails'])->name('order.updateStockWarrentyDetails');
    Route::get('/file-import',[OrderController::class,'importView'])->name('order.import-view');
    Route::post('/import',[OrderController::class,'import'])->name('order.import');
    Route::get('/export-orders',[OrderController::class,'exportOrders'])->name('order.export-orders');
    Route::get('/export-order/{id}',[OrderController::class,'exportOrder'])->name('order.export-order');
    Route::get('/delivery/in',[OrderController::class,'in'])->name('order.in');
    Route::get('/delivery/out',[OrderController::class,'out'])->name('order.out');
    Route::get('/delivery/return',[OrderController::class,'return'])->name('order.return');

    Route::resource('user', UserController::class)->except('show');
    Route::get('user/show/{id}', [UserController::class,'show'])->name('user.show');

    Route::resource('role', RoleController::class)->except('show');
    Route::get('role/show/{id}', [RoleController::class,'show'])->name('role.show');

    Route::resource('/selling', SellingController::class)->except('show');
    Route::get('/selling/show/{id}', [SellingController::class,'show'])->name('selling.show');

    Route::resource('/settings', SettingController::class)->except('show');
    Route::get('/settings/show/{id}', [SettingController::class,'show'])->name('settings.show');


    Route::resource('/company', CompanyController::class)->except('show');
    Route::get('/company/show/{id}', [CompanyController::class,'show'])->name('company.show');

});
