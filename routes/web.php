<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::group(['middleware' => 'auth'], function () {

    Route::group([
        'prefix' => LaravelLocalization::setLocale(),    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        // items
        Route::group(['prefix' => 'items'], function () {
            Route::get('/', [ItemController::class, 'index'])->name('items.index');
            Route::get('/create', [ItemController::class, 'create'])->name('items.create');
            Route::post('/store', [ItemController::class, 'store'])->name('items.store');
            Route::get('/edit/{id}', [ItemController::class, 'edit'])->name('items.edit');
            Route::PUT('/update/{id}', [ItemController::class, 'update'])->name('items.update');
            Route::delete('/delete/{id}', [ItemController::class, 'delete'])->name('items.delete');
            Route::get('/restore/{id}', [ItemController::class, 'restore'])->name('items.restore');
            Route::delete('/deleteForce/{id}', [ItemController::class, 'deleteForce'])->name('items.deleteForce');
            Route::get('/deletedItems', [ItemController::class, 'deletedItems'])->name('items.deletedItems');
            Route::get('/deletedFilter', [ItemController::class, 'deletedFilter'])->name('items.deletedFilter');
        });


        // customers
        Route::group(['prefix' => 'customers'], function () {
            Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
            Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
            Route::post('/store', [CustomerController::class, 'store'])->name('customers.store');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
            Route::PUT('/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
            Route::delete('/delete/{id}', [CustomerController::class, 'delete'])->name('customers.delete');
            Route::get('/restore/{id}', [CustomerController::class, 'restore'])->name('customers.restore');
            Route::delete('/deleteForce/{id}', [CustomerController::class, 'deleteForce'])->name('customers.deleteForce');
            Route::get('/deletedCustomers', [CustomerController::class, 'deletedCustomers'])->name('customers.deletedCustomers');
            Route::get('/deletedFilter', [CustomerController::class, 'deletedFilter'])->name('customers.deletedFilter');
        });


        // sales
        Route::group(['prefix' => 'sales'], function () {
            Route::get('/', [SaleController::class, 'index'])->name('sales.index');
            Route::get('/create', [SaleController::class, 'create'])->name('sales.create');
            Route::POST('/store', [SaleController::class, 'store'])->name('sales.store');
            Route::PUT('/update', [SaleController::class, 'update'])->name('sales.update');
            Route::get('/viewSale/{sale_id}/{customer_id}', [SaleController::class, 'viewSale'])->name('sales.viewSale');

            // pdf view sale
            Route::get('/pdf/{sale_id}/{customer_id}', [SaleController::class, 'generatePdfviewSale'])->name('viewSalePDF');
        });
    });
});
Auth::routes();
