<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TuLook_Control;
use App\Http\Controllers\Carrito_Control;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TuLookUserController;

// ---------------- PÁGINA PRINCIPAL Y PRODUCTOS ----------------
Route::controller(TuLook_Control::class)->group(function () {
    Route::get('/', function () {
        return redirect()->route('TuLook');
    });

    Route::get('/TuLook', 'index')->name('TuLook');
    Route::get('/TuLook/{id}', 'show')->name('TuLook.detalle');
});

Route::get('/', function () {
    return redirect()->route('ubicaciones.index'); // o una vista de bienvenida
});

Route::get('/TuLook', [TuLook_Control::class, 'index'])->name('TuLook');

Route::get('/TuLook/{id}', [TuLook_Control::class, 'show'])->name('TuLook.detalle');

// Perfil de usuario
Route::get('/tulook/usuario', [TuLookUserController::class, 'index'])->name('tulook.usuario');

// ---------------- CARRITO ----------------
Route::prefix('carrito')->name('carrito.')->controller(Carrito_Control::class)->group(function () {
    Route::post('/agregar', 'agregarAlCarrito')->name('agregar');
    Route::get('/', 'verCarrito')->name('ver');
    Route::delete('/eliminar/{key}', 'eliminarDelCarrito')->name('eliminar');
});

// ---------------- COMPRAS ----------------
Route::name('compra.')->controller(CompraController::class)->group(function () {
    Route::get('/carrito/pago', 'mostrarFormularioPago')->name('pago');
    Route::post('/procesar', 'procesarCompra')->name('procesar');
    Route::get('/confirmacion/{codigo}', 'confirmacionCompra')->name('confirmacion');
    Route::get('/seguimiento/{codigo}', 'seguimientoPedido')->name('seguimiento');
});

// ---------------- AUTENTICACIÓN ----------------
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginRegister')->name('login');
    Route::post('/login', 'login')->name('login.post');
    
    Route::get('/register', 'showLoginRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');

    Route::post('/logout', 'logout')->name('logout');
});

// ---------------- DASHBOARD ----------------
Route::get('/dashboard-welcome', function () {
    return view('welcome-dashboard');
})->middleware('auth')->name('dashboard.welcome');