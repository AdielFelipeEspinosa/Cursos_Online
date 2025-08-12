<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por rol

Route::get('/instructor', function () {
    return 'Bienvenido Instructor';
})->middleware('role:instructor');

Route::get('/student', function () {
    return 'Bienvenido Estudiante';
})->middleware('role:student');