<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/// routes/web.php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;

Route::get('/', function () {
    return view('welcome');
})->name("home");


Route::get('/productos', [ProductoController::class, 'index']);
Route::post('/add-to-cart/{id}', [ProductoController::class, 'addToCart']);
Route::delete('/remove-from-cart/{id}', [ProductoController::class, 'removeFromCart']);

Route::get('/carrito', [CarritoController::class, 'index']);
Route::put('/update-cart/{id}', [CarritoController::class, 'update']);
Route::delete('/clear-cart', [CarritoController::class, 'clearCart']);
Route::delete('/remove-item/{id}', [CarritoController::class, 'removeItem']);
Route::post('/add-discount', [CarritoController::class, 'addDiscount']);
Route::delete('/remove-discount', [CarritoController::class, 'removeDiscount']);
Route::get('/checkout', [CarritoController::class, 'checkout']);
// routes/web.php

use App\Http\Controllers\PedidoController;

Route::post('/realizar-pedido', [PedidoController::class, 'store'])->name('pedido.store');


// En routes/web.php
Route::post('/procesar-pedido', [CarritoController::class, 'procesarPedido']);


Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');

