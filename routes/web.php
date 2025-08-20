<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TuLook_Control;
use App\Http\Controllers\Carrito_Control;

Route::get('/TuLook', [TuLook_Control::class, 'index'])->name('TuLook');

Route::get('/TuLook/{id}', [TuLook_Control::class, 'show'])->name('TuLook.detalle');

// Rutas del carrito
Route::post('/carrito/agregar', [Carrito_Control::class, 'agregarAlCarrito'])->name('carrito.agregar');
Route::get('/carrito', [Carrito_Control::class, 'verCarrito'])->name('carrito.ver');
Route::delete('/carrito/eliminar/{key}', [Carrito_Control::class, 'eliminarDelCarrito'])->name('carrito.eliminar');
