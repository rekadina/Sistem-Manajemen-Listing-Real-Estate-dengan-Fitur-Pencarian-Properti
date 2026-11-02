<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Properties
    Route::resource('properties', AdminPropertyController::class);
    
    // Categories
    Route::resource('categories', AdminCategoryController::class);
    
    // Inquiries
    Route::resource('inquiries', InquiryController::class)->except(['create', 'store', 'edit']);
    Route::post('/inquiries/{inquiry}/status', [InquiryController::class, 'updateStatus'])->name('inquiries.update-status');
    Route::post('/inquiries/{inquiry}/notes', [InquiryController::class, 'addNotes'])->name('inquiries.add-notes');
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/upload-logo', [SettingController::class, 'uploadLogo'])->name('settings.upload-logo');
    Route::post('/settings/upload-favicon', [SettingController::class, 'uploadFavicon'])->name('settings.upload-favicon');
});