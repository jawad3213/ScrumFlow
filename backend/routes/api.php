<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\TaskController;

// Route publique (pas besoin d'être connecté pour se logger)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Groupe de routes protégées (nécessite un token valide)
Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Employee Routes
    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

    // Juste pour tester que le token fonctionne
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});


Route::middleware('auth:sanctum')->group(function () {
    // Projets
    Route::post('/projects', [ProjectController::class, 'store']);
    
    // Sprints
    Route::post('/sprints', [SprintController::class, 'store']);
    Route::get('/sprints/{id}', [SprintController::class, 'show']); // Pour afficher le tableau
    
    // Tâches (et Sous-tâches)
    Route::post('/tasks', [TaskController::class, 'store']);
});