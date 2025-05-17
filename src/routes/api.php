<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\HomeController;

// Rotas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/password/forgot', [AuthController::class, 'forgotPassword']);
Route::post('/password/reset', [AuthController::class, 'resetPassword']);
Route::get('/teste', function () {
    return response()->json(['mensagem' => 'rota funcionando']);
});
Route::get('/cep/{cep}', [CepController::class, 'buscar']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [UserController::class, 'index']);
    // Rotas admin protegidas
    Route::middleware('can:isAdmin')->group(function () {
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
        Route::get('/dashboard', [UserController::class, 'dashboard']);
    });
});
