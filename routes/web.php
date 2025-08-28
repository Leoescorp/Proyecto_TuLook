<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TuLook_Control;
use App\Http\Controllers\Carrito_Control;
use App\Http\Controllers\CompraController;

Route::get('/', function () {
    return redirect()->route('ubicaciones.index'); // o una vista de bienvenida
});

Route::get('/TuLook', [TuLook_Control::class, 'index'])->name('TuLook');

Route::get('/TuLook/{id}', [TuLook_Control::class, 'show'])->name('TuLook.detalle');

// Rutas del carrito
Route::post('/carrito/agregar', [Carrito_Control::class, 'agregarAlCarrito'])->name('carrito.agregar');
Route::get('/carrito', [Carrito_Control::class, 'verCarrito'])->name('carrito.ver');
Route::delete('/carrito/eliminar/{key}', [Carrito_Control::class, 'eliminarDelCarrito'])->name('carrito.eliminar');

// Rutas del carrito
Route::get('/carrito', [Carrito_Control::class, 'verCarrito'])->name('carrito.ver');
Route::post('/carrito/agregar', [Carrito_Control::class, 'agregarAlCarrito'])->name('carrito.agregar');
Route::delete('/carrito/eliminar/{key}', [Carrito_Control::class, 'eliminarDelCarrito'])->name('carrito.eliminar');

// Rutas del proceso de compra
Route::get('/carrito/pago', [CompraController::class, 'mostrarFormularioPago'])->name('carrito.pago');
Route::post('/compra/procesar', [CompraController::class, 'procesarCompra'])->name('compra.procesar');
Route::get('/compra/confirmacion/{codigo}', [CompraController::class, 'confirmacionCompra'])->name('compra.confirmacion');
Route::get('/seguimiento/{codigo}', [CompraController::class, 'seguimientoPedido'])->name('seguimiento.pedido');


// Ruta de prueba para actividad de control de versiones
Route::get('/prueba', function () {
    return '¡Prueba exitosa! Actividad de Git completada - Proyecto TuLook';
});