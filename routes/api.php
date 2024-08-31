<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\AnimeController;


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
// Route::middleware(['auth:sanctum', EnsureFrontendRequestsAreStateful::class])->group(function () {
    Route::get('/usuarios', [UserController::class, 'index']);
    Route::post('/usuarios', [UserController::class, 'store']);
    Route::get('/usuarios/{id}', [UserController::class, 'show']);
    Route::put('/usuarios/{id}', [UserController::class, 'update']);
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);
// });

Route::middleware(['web'])->group(function () {
    Route::post('/login', [UserController::class, 'login']);
});

// Animes
// --Categorias
Route::post('/crearCategoria', [AnimeController::class, 'createCategory']);
Route::get('/verCategoria', [AnimeController::class, 'getCategory']);
Route::put('/actualizarCategoria/{CATIDXXX}', [AnimeController::class, 'updateCategory']);
// --Cabecera animes
Route::post('/crearAnime', [AnimeController::class, 'createAnime']);
Route::get('/verAnime', [AnimeController::class, 'getAnime']);
Route::put('/actualizarAnime/{ANIIDXXX}', [AnimeController::class, 'updateAnime']);
// --Crear temporadas
Route::post('/crearTemp', [AnimeController::class, 'createTemp']);
Route::get('/verTemp', [AnimeController::class, 'getTemp']);
Route::put('/actualizarTemp/{TEMPIDXX}', [AnimeController::class, 'updateTemp']);
