<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::view('/profile', 'profile')->name('profile');

Route::post('/update_profile', [ProfileController::class, 'updateProfile'])->name('update.profile');
Route::post('/change_password', [ProfileController::class, 'changePassword'])->name('password.change');