<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pacientes', [PacienteController::class, 'index']);
Route::get('/pacientes/crear', [PacienteController::class, 'create']);
Route::post('/pacientes', [PacienteController::class, 'store']);
