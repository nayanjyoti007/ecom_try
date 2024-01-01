<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\VendorController;

Route::get('vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login');


Route::middleware(['auth', 'authRole:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('dashboard', [VendorController::class, 'VendorDashboard'])->name('dashboard');
    Route::get('logout', [VendorController::class, 'VendorLogout'])->name('logout');


    Route::get('profile', [VendorController::class, 'VendorProfile'])->name('profile');
    Route::post('profile/store', [VendorController::class, 'VendorProfileStore'])->name('profile.store');

    Route::get('change-password', [VendorController::class, 'VendorChangePassword'])->name('change.password');
    Route::post('update-password', [VendorController::class, 'VendorUpdatePassword'])->name('update.password');

});
