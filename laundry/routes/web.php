<?php

use App\Http\Controllers\AuthController;
use App\Http\Livewire\AdminAppointments;
use App\Http\Livewire\StudentAppointments;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('jwt')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('/student-appointments', StudentAppointments::class)->name('student.appointments');
    Route::get('/admin-appointments', AdminAppointments::class)->name('admin.appointments');
});
