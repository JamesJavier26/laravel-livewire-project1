<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Volt;
use App\Livewire\ManageBooks;
use App\Http\Controllers\BookController;
use App\Enums\UserRole;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Role-based dashboard redirection
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === UserRole::USER) {
        return view('dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated user settings (Volt)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('/borrow-books', [BookController::class, 'showAvailableBooks'])->name('borrow.books');
    Route::post('/borrow-books/{book}', [BookController::class, 'borrow'])->name('borrow.book');

    // ✅ Updated: Use Livewire component directly
    Route::get('/manage-books', ManageBooks::class)->name('manage-books');
    
    // Keep using BookController for resource routes like create/edit
    Route::resource('books', BookController::class);
});

require __DIR__ . '/auth.php';
