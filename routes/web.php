<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/pacientes');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pacientes', [PacienteController::class, 'index']);
    Route::get('/pacientes/crear', [PacienteController::class, 'create']);
    Route::post('/pacientes', [PacienteController::class, 'store']);
    Route::get('/pacientes/{id}/editar', [PacienteController::class, 'edit']);
    Route::post('/pacientes/{id}', [PacienteController::class, 'update']);
    Route::post('/pacientes/{id}/eliminar', [PacienteController::class, 'destroy']);
    Route::get('/pacientes/{id}', [PacienteController::class, 'show']);
});

require __DIR__.'/auth.php';