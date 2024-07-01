<?php

use Illuminate\Support\Facades\Route;

// Ruta para la página de inicio
Route::get('/', function () {
    return view('auth.login');
    // return view('welcome');
});

// Grupo de rutas protegidas por autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Ruta para el dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Ruta para reports
    Route::get('/reports', function () {
        return "reports";//view('dashboard');
    })->name('reports');
    
    // Ruta para coordinators
    Route::get('/coordinators', function () {
        return view('dashboard');
    })->name('coordinators');
    
    // Ruta para directory
    Route::get('/directory', function () {
        return view('dashboard');
    })->name('directory');

    // Ruta para users
    Route::get('/users', function () {
        return view('users');
    })->name('users');
});
