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
        $request->validate([
            'nombre'    => 'required|min:3|max:100',
            'edad'      => 'required|integer|min:0|max:120',
            'telefono'  => 'nullable|min:9:max:15',
        ]);

        Paciente::create([
            'nombre'   => $request->nombre,
            'edad'     => $request->edad,
            'telefono' => $request->telefono,
        ]);

        return redirect('/pacientes')->with('success', 'Paciente creado correctamente.');
    }

    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.editar', ['paciente' => $paciente]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'nombre'   => 'required|min:3|max:100',
            'edad'     => 'required|integer|min:0|max:120',
            'telefono' => 'nullable|min:9|max:15',
        ]);

        $paciente = Paciente::findOrFail($id);
        $paciente->update([
            'nombre'   => $request->nombre,
            'edad'     => $request->edad,
            'telefono' => $request->telefono,
        ]);
        
        return redirect('/pacientes')->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy($id)
    {
        Paciente::findOrFail($id)->delete();
        return redirect('/pacientes')->with('success', 'Paciente eliminado.');
    }
}
