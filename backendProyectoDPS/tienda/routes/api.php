<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\autenticarClienteController;
use App\Http\Controllers\categoriasController;
use App\Http\Controllers\productosController;
use App\Http\Controllers\usuariosController;
use App\Http\Controllers\ventasController;
use App\Http\Controllers\wompiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('usuarios/store', [usuariosController::class, 'storeFront']);
Route::patch('usuarios/{id}/update', [usuariosController::class, 'updateFront']);
Route::get('usuarios/{id}/show', [usuariosController::class, 'showFront']);

Route::get('productos/get', [productosController::class, 'showFront']);
Route::get('categorias/get', [categoriasController::class, 'showFront']);
Route::get('productos/descuento', [productosController::class, 'showOfertas']);


Route::get('productos/{id}/show', [productosController::class, 'showProductoFront']);

Route::post('ventas/registrar', [ventasController::class, 'ingresarVenta']);

Route::post('tienda/login', [autenticarClienteController::class, 'login']);