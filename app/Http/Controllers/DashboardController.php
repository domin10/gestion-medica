<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Paciente;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPacientes    = Paciente::count();
        $edadMedia         = round(Paciente::avg('edad'), 1);
        $pacienteMayor     = Paciente::orderBy('edad', 'desc')->first();
        $pacienteMenor     = Paciente::orderBy('edad', 'asc')->first();
        $ultimosPacientes  = Paciente::orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalPacientes',
            'edadMedia',
            'pacienteMayor',
            'pacienteMenor',
            'ultimosPacientes'
        ));
    }
}