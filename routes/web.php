<?php

use App\Http\Controllers\adminController as admin;
use App\Http\Controllers\categoryController as category;
use App\Http\Controllers\adminDashboardController as dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('admin/dashboard',  [dashboard::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/admin/inventory', [admin::class, 'index']);
    Route::get('/admin/categories', [category::class, 'index']);
    Route::post('/admin/categories', [category::class, 'create'])->name('add.category');
    Route::any('/admin/categories/change-status/{id}/{status}', [category::class, 'changeStatus']);
    

});

require __DIR__.'/auth.php';
