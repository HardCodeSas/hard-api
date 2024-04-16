<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/ping', function (Request $request) {
  return response()->json(['message' => 'PING EXITOSO']);
});

// CRUD Rutas
Route::get('/usuarios', [UserController::class, 'index']); // Para obtener todos los usuarios
Route::post('/usuarios', [UserController::class, 'store']); // Para crear un nuevo usuario
Route::get('/usuarios/{id}', [UserController::class, 'show']); // Para obtener un usuario específico
Route::put('/usuarios/{id}', [UserController::class, 'update']); // Para actualizar un usuario
Route::delete('/usuarios/{id}', [UserController::class, 'destroy']); // Para eliminar un usuario
