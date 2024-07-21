<?php

use App\Http\Controllers\adminController as admin;
use App\Http\Controllers\categoryController as category;
use App\Http\Controllers\adminDashboardController as dashboard;
use App\Http\Controllers\userProfileController as userProfile;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('admin/dashboard',  [dashboard::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin/all-activity', [dashboard::class, 'allActivity']);
    Route::get('/admin/inventory', [admin::class, 'index']);
    Route::get('/admin/categories', [category::class, 'index']);
    Route::post('/admin/categories', [category::class, 'create'])->name('add.category');
    Route::any('/admin/categories/change-status/{id}/{status}', [category::class, 'changeStatus']);
    Route::any('/admin/categories/delete-category/{id}', [category::class, 'deleteCategory']);

    Route::get('/admin/my-profile', [userProfile::class, 'index']);
    Route::post('/admin/my-profile', [userProfile::class, 'updateProfile'])->name('update.profile');

    Route::get('/admin/add-user', [userProfile::class, 'addNewUserRender']);
    Route::post('/admin/add-user', [userProfile::class, 'addNewUser'])->name('add.newUser');

    Route::post('/admin/submit-subcategories', [category::class, 'submitSubCategories'])->name('submit.sub-categories');
});

require __DIR__.'/auth.php';
