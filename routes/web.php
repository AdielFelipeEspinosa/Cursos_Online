<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\LeccionController;
use App\Http\Controllers\MaterialLeccionController;
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

    // CRUD de Lecciones (anidado en cursos)
    Route::prefix('cursos/{curso}')->name('lecciones.')->group(function () {
        Route::get('/lecciones', [LeccionController::class, 'index'])->name('index');
        Route::get('/lecciones/create', [LeccionController::class, 'create'])->name('create');
        Route::post('/lecciones', [LeccionController::class, 'store'])->name('store');
        Route::get('/lecciones/{leccion}', [LeccionController::class, 'show'])->name('show');
        Route::get('/lecciones/{leccion}/edit', [LeccionController::class, 'edit'])->name('edit');
        Route::put('/lecciones/{leccion}', [LeccionController::class, 'update'])->name('update');
        Route::delete('/lecciones/{leccion}', [LeccionController::class, 'destroy'])->name('destroy');
    });

    // CRUD de Materiales (anidado en cursos y lecciones)
    Route::prefix('cursos/{curso}/lecciones/{leccion}')->name('materiales.')->group(function () {
        Route::get('/materiales', [MaterialLeccionController::class, 'index'])->name('index');
        Route::get('/materiales/create', [MaterialLeccionController::class, 'create'])->name('create');
        Route::post('/materiales', [MaterialLeccionController::class, 'store'])->name('store');
        Route::get('/materiales/{material}/edit', [MaterialLeccionController::class, 'edit'])->name('edit');
        Route::put('/materiales/{material}', [MaterialLeccionController::class, 'update'])->name('update');
        Route::get('/materiales/{material}/download', [MaterialLeccionController::class, 'download'])->name('download');
        Route::delete('/materiales/{material}', [MaterialLeccionController::class, 'destroy'])->name('destroy');
    });
});

Route::get('/student', function () {
    return 'Bienvenido Estudiante';
})->middleware('role:student');
