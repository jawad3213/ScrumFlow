<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;

// Route publique (pas besoin d'être connecté pour se logger)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Groupe de routes protégées (nécessite un token valide)
Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Create Employee Route
    Route::post('/employees', [EmployeeController::class, 'store']);

    // Juste pour tester que le token fonctionne
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});