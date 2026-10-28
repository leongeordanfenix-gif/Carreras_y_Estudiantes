<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\EstudianteController;

// Rutas completas del CRUD de Carreras
Route::apiResource('carreras', CarreraController::class);

// Endpoint de relación específico (Eager Loading)
Route::get('carreras/{id}/estudiantes', [CarreraController::class, 'carreraEstudiantes']);

// Rutas completas del CRUD de Estudiantes
Route::apiResource('estudiantes', EstudianteController::class);
