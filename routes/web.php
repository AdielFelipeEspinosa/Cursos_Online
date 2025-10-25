<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\PublicoController;

Route::get('/', [PublicoController::class, 'index'])->name('index');


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por rol

Route::middleware(['auth', 'role:instructor'])->group(function () {
    
    // Dashboard del instructor
    Route::get('/instructor/dashboard', function () {
        return view('instructor.dashboard');
    })->name('instructor.dashboard');
    
    // CRUD de Cursos
    Route::resource('cursos', CursoController::class);
    
});

Route::get('/student', function () {
    return 'Bienvenido Estudiante';
})->middleware('role:student');