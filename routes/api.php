<?php
use App\Http\Controllers\Api\LibroController;
use App\Http\Controllers\Api\ReservaController;
use App\Http\Controllers\Api\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::apiResource('libros', LibroController::class);


    Route::get('reservas', [ReservaController::class, 'index']);
    Route::get('reservas/usuario/{nombre}', [ReservaController::class, 'searchByUsuario']);
    Route::post('reservas', [ReservaController::class, 'store']);
    Route::put('reservas/{id}', [ReservaController::class, 'update']);
    Route::delete('reservas/{id}', [ReservaController::class, 'destroy']);


    Route::apiResource('usuarios', UsuarioController::class);


