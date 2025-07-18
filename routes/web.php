<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect('/productos'); // o puedes hacer return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// 🏠 Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// 🛍️ Ruta pública para ver productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

// 🔒 Rutas protegidas para ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::get('/dashboard-ventas', [VentaController::class, 'dashboard'])->name('ventas.dashboard');
    Route::get('/usuarios', [\App\Http\Controllers\UserController::class, 'index'])->name('usuarios.index');
});

// 🛒 Rutas protegidas para CLIENTE
Route::middleware(['auth', 'cliente'])->group(function () {
    Route::get('/carrito', [VentaController::class, 'carrito'])->name('carrito');
    Route::post('/carrito/agregar', [VentaController::class, 'agregar'])->name('carrito.agregar');
    Route::delete('/carrito/eliminar/{id}', [VentaController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/carrito/confirmar', [VentaController::class, 'confirmarVenta'])->name('venta.confirmar');
    Route::get('/ventas', [VentaController::class, 'misVentas'])->name('ventas.mis');
    Route::get('/boleta/{id}', [VentaController::class, 'verBoleta'])->name('boleta.ver');
    Route::get('/checkout', [VentaController::class, 'checkoutForm'])->name('checkout.form');
    Route::post('/checkout/pagar', [VentaController::class, 'procesarPago'])->name('checkout.pagar');

});

Route::get('/ventas', [VentaController::class, 'misVentas'])->name('ventas.mis');
Route::get('/boleta/{id}', [VentaController::class, 'verBoleta'])->name('boleta.ver');

// web.php
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/ventas-todas', [VentaController::class, 'todasVentas'])->name('ventas.todas');
});




// 🧑‍💼 Rutas Breeze (si instalaste Laravel Breeze)
require __DIR__.'/auth.php';

