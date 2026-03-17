<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pacientes', [PacienteController::class, 'index']);
Route::get('/pacientes/crear', [PacienteController::class, 'create']);
Route::post('/pacientes', [PacienteController::class, 'store']);
Route::get('/pacientes/{id}/editar', [PacienteController::class, 'edit']);
Route::post('/pacientes/{id}', [PacienteController::class, 'update']);
Route::post('/pacientes/{id}/eliminar', [PacienteController::class, 'destroy']);
