<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ContactMessageController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin Authentication Routes
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Panel Routes (protected by admin middleware)
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Projects CRUD
    Route::resource('projects', ProjectController::class);
    
    // Contact Messages
    Route::resource('contact-messages', ContactMessageController::class)->except(['create', 'store', 'edit']);
    Route::post('/contact-messages/{contactMessage}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-as-read');
    Route::post('/contact-messages/{contactMessage}/mark-as-unread', [ContactMessageController::class, 'markAsUnread'])->name('contact-messages.mark-as-unread');
});
