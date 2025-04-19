<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\AdminAppointments;
use App\Http\Livewire\StudentAppointments;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/home', 'home')->name('home');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/', 'login')->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::patch('/profile/activate/{user}', [ProfileController::class, 'activateUser'])->name('profile.activate');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});




