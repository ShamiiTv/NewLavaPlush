<?php

use App\Http\Controllers\EgresoExternoController;
use App\Http\Controllers\IngresoExternoController;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\IngresoRopaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteInventarioController;
use App\Http\Controllers\EgresoRopaController;

// Página de inicio
Route::get('/', function () {
    return view('inicio');
})->name('inicio')->middleware('auth');

// Rutas de autenticación
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/perfil', [PerfilController::class, 'perfil'])->name('perfil');

// Registro de usuarios
Route::get('/registro', [RegisterController::class, 'showRegistrationForm'])->name('registro');
Route::post('/registro', [RegisterController::class, 'register'])->name('registro');

// Recuperación de contraseñas
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', function ($token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Otras rutas
Route::get('/todos', function () {
    return view('todos.index');
})->middleware('auth');

Route::post('/todos', [TodosController::class, 'store'])->name('todos')->middleware('auth');

// Rutas de ingreso y egreso de ropa
Route::get('/ingresoInterno',[IngresoRopaController::class, 'showForm'])->name('ingresoInterno')->middleware('auth');

Route::get('/egresoInterno', function () {
    return view('egresoInterno');
})->name('egresoInterno')->middleware('auth');


Route::get('/perfil', function () {
    return view('perfil');
})->name('perfil')->middleware('auth');

Route::get('/ingresoExterno',[IngresoExternoController::class, 'showForm'])->name('ingresoExterno')->middleware('auth');

Route::get('/egresoExterno', [EgresoExternoController::class, 'showForm'])->name('egresoExterno');
Route::post('/egresoExterno', [EgresoExternoController::class, 'store']);


Route::get('/generacionInformes', function () {
    return view('generacionInformes');
})->name('generacionInformes')->middleware('auth');

Route::post('/ingresoInterno', [IngresoRopaController::class, 'store'])->middleware('auth');
Route::post('/ingresoExterno', [IngresoExternoController::class, 'store'])->middleware('auth');
Route::get('/get-tipo-ropa-detalles', [IngresoRopaController::class, 'getTipoRopaDetalles'])->middleware('auth');

Route::get('/reporteInventario', [ReporteInventarioController::class, 'generarReporte'])->name('reporteInventario')->middleware('auth');
Route::get('/ruta-a-obtener-datos', [ReporteInventarioController::class, 'obtenerDatosPrenda']);


Route::get('/egresoInterno', [EgresoRopaController::class, 'showForm2'])->name('egresoInterno');
Route::post('/egresoInterno', [EgresoRopaController::class, 'store2']);
