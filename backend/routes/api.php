<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ImpostoController;
use App\Http\Controllers\AuthController;

Route::middleware(\App\Http\Middleware\CheckFrontendToken::class)->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/impostos', [ImpostoController::class, 'index']);
    Route::post('/impostos', [ImpostoController::class, 'store']);
    Route::put('/impostos/{id}', [ImpostoController::class, 'update']);
    Route::delete('/impostos/{id}', [ImpostoController::class, 'destroy']);

    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::post('/usuarios', [UsuarioController::class, 'store']);
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
});
