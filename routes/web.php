<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'can:is_admin'])->group(function () {
    Route::get('/admin/laporan/cetak', [DashboardController::class, 'printReport'])->name('admin.report.print');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::post('/admin/fields', [DashboardController::class, 'storeField'])->name('admin.fields.store');
    Route::patch('/admin/bookings/{booking}/status', [DashboardController::class, 'updateBookingStatus'])->name('admin.bookings.status');
    Route::post('/admin/bookings/manual', [DashboardController::class, 'storeAdminBooking'])->name('admin.bookings.manual');
});

Route::middleware(['auth', 'can:is_user'])->group(function () {
    Route::get('/user/bookings/{booking}/cetak', [DashboardController::class, 'printReceipt'])->name('user.bookings.receipt');
    Route::get('/user/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');
    Route::post('/user/bookings', [DashboardController::class, 'storeBooking'])->name('user.bookings.store');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::delete('/admin/fields/{field}', [DashboardController::class, 'destroyField'])->name('admin.fields.destroy');

require __DIR__.'/auth.php';
