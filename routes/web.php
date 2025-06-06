<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\OrderReportController;
use App\Http\Controllers\SalesReportController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/items', [ItemController::class, 'index'])->name('items.index');

Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

Route::post('/items', [ItemController::class, 'store'])->name('items.store');

Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');

Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');


Route::get('/order', [OrdersController::class, 'index'])->name('order.index');
Route::post('/order/{order}/update-status', [OrdersController::class, 'updateStatus'])->name('orders.update-status');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/report/inventoryreport', [ReportController::class, 'index'])->name('report.inventoryreport.index');
Route::get('/report/inventoryreport/generateReport', [ReportController::class, 'generateReport'])->name('report.inventoryreport.generateReport');
Route::get('/report/ordersreport', [OrderReportController::class, 'index'])->name('report.orderreport.index');
Route::get('/report/orderreport/generateReport', [OrderReportController::class, 'generateReport'])->name('report.orderreport.generateReport');
Route::get('/report/salesreport', [SalesReportController::class, 'index'])->name('report.salesreport.index');
Route::get('/report/salesreport/generateReport', [SalesReportController::class, 'generateReport'])->name('report.salesreport.generateReport');