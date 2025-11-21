<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CookiePreferenceController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\LeccionController;
use App\Http\Controllers\MaterialLeccionController;
use App\Http\Controllers\PublicoController;
use App\Http\Controllers\SecurityDemoController;

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

// Rutas públicas para gestión de cookies (accesibles sin autenticación)
Route::prefix('preferences')->group(function () {
    // Vista del panel de preferencias
    Route::get('/', [CookiePreferenceController::class, 'showPreferences'])->name('preferences.index');

    // API para gestionar cookies
    Route::post('/theme', [CookiePreferenceController::class, 'setTheme'])->name('preferences.theme');
    Route::get('/theme', [CookiePreferenceController::class, 'getTheme']);
    Route::post('/visit', [CookiePreferenceController::class, 'registerVisit'])->name('preferences.visit');
    Route::post('/clear', [CookiePreferenceController::class, 'clearPreferences'])->name('preferences.clear');

    // Demostración educativa
    Route::get('/demo', [CookiePreferenceController::class, 'cookieDemo'])->name('preferences.demo');


});

// Rutas de seguridad (demo educativa)
Route::prefix('security')->group(function () {
    Route::get('/xss-demo', [SecurityDemoController::class, 'xssDemo'])->name('security.xss-demo');
    Route::post('/xss-test', [SecurityDemoController::class, 'testXss'])->name('security.xss-test');
});

Route::get('/student', function () {
    return 'Bienvenido Estudiante';
})->middleware('role:student');
