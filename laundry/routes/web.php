<?php

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

//
//Route::middleware(['auth'])->group(function () {
//    Route::get('/student-appointments', StudentAppointments::class)->name('student.appointments');
//    Route::get('/admin-appointments', AdminAppointments::class)->name('admin.appointments');
//});
