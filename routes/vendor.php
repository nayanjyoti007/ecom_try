<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\VendorController;



Route::middleware(['auth', 'authRole:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('dashboard', [VendorController::class, 'VendorDashboard'])->name('dashboard');
});
