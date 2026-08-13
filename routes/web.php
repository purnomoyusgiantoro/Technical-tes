<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\technical_test_orders_controller;

Route::get('/', function () {
    return view('import');
});

Route::get('/technical_test_orders/upload', [technical_test_orders_controller::class, 'showform'])->name('technical_test_orders.upload');
Route::post('/technical_test_orders/import', [technical_test_orders_controller::class, 'import'])->name('technical_test_orders.import');
Route::get('/technical_test_orders', [technical_test_orders_controller::class, 'index'])->name('technical_test_orders.index');