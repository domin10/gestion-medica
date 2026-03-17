<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();
        return view('pacientes.index', ['pacientes' => $pacientes]);
    }

    public function create()
    {
        return view('pacientes.crear');
    }

    public function store(Request $request)
    {
        Paciente::create([
            'nombre'   => $request->nombre,
            'edad'     => $request->edad,
            'telefono' => $request->telefono,
        ]);

        return redirect('/pacientes');
    }

    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.editar', ['paciente' => $paciente]);
    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->update([
            'nombre'   => $request->nombre,
            'edad'     => $request->edad,
            'telefono' => $request->telefono,
        ]);
        return redirect('/pacientes');
    }

    public function destroy($id)
    {
        Paciente::findOrFail($id)->delete();
        return redirect('/pacientes');
    }
}
