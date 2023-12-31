<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;


Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


Route::middleware(['auth', 'authRole:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'AdminDashboard'])->name('dashboard');
    Route::get('logout', [AdminController::class, 'AdminLogout'])->name('logout');


    Route::get('profile', [AdminController::class, 'AdminProfile'])->name('profile');
    Route::post('profile/store', [AdminController::class, 'AdminProfileStore'])->name('profile.store');

});

