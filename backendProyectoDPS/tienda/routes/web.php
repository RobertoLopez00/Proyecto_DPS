<?php

use App\Http\Controllers\carritoController;
use App\Http\Controllers\categoriasController;
use App\Http\Controllers\compraEstadosController;
use App\Http\Controllers\pagoMetodosController;
use App\Http\Controllers\productoImagenesController;
use App\Http\Controllers\productosController;
use App\Http\Controllers\rolesController;
use App\Http\Controllers\subcategoriasController;
use App\Http\Controllers\tallasController;
use App\Http\Controllers\tiendaController;
use App\Http\Controllers\usuariosController;
use App\Http\Controllers\ventasController;
use App\Http\Controllers\wompiController;
use App\Models\venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::view('/', 'Inicio')->middleware('auth');

Route::resource('usuarios', usuariosController::class)->middleware('auth')->middleware('rol');
Route::resource('categorias', categoriasController::class)->middleware('auth')->middleware('rol');
Route::resource('productos', productosController::class)->middleware('auth')->middleware('rol');
Route::resource('roles', rolesController::class)->middleware('auth')->middleware('rol');
Route::resource('ventas', ventasController::class)->middleware('auth')->middleware('rol');
Route::resource('compra-estados', compraEstadosController::class)->middleware('auth')->middleware('rol');
Route::get('ventas/{id}/detalles', [ventasController::class, 'detalles'])->name('ventas.detalles')->middleware('auth')->middleware('rol');




