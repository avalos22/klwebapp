<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\BusinessDirectoryController;
use App\Http\Controllers\FTLController;

// Ruta para la página de inicio


// Grupo de rutas protegidas por autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Ruta para el dashboard
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Ruta para reports
    Route::get('/reports', function () {
        return "reports";//view('dashboard');
    })->name('reports');

    // Ruta para catalogo
    Route::get('/catalog', function () {
        return view('catalog.index');
    })->name('catalog');
    
    // Ruta para directory
    Route::get('/directory', function () {
        return view('dashboard');
    })->name('directory');

    // Ruta de los servicios
    Route::resource('ftl', FTLController::class);

    // Grupo de rutas para Administración
    // Route::get('/users', function () {return view('users.index');})->name('users');
    // Grupo de rutas para Administración de Usuarios
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    // Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('business-directory', BusinessDirectoryController::class);
    Route::resource('users', UserController::class);
    // Route::get('business-directory', [BusinessDirectoryController::class, 'index'])->name('business-directory.index');


});
