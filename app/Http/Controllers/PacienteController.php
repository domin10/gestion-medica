<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Nota;
use Barryvdh\DomPDF\Facade\Pdf;

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->get('buscar');

        $pacientes = Paciente::when($busqueda, function($query, $busqueda) {
            return $query->where('nombre', 'like', '%' . $busqueda . '%');
        })->paginate(10);

        return view('pacientes.index', [
            'pacientes' => $pacientes,
            'busqueda'  => $busqueda
        ]);
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

    public function show($id)
    {
        $paciente = Paciente::with('notasClinicas')->findOrFail($id);
        return view('pacientes.show', ['paciente' => $paciente]);
    }

    // NOTAS
    public function storeNota(Request $request, $id)
    {
        $request->validate([
            'contenido' => 'required|min:3|max:1000',
        ]);

        Nota::create([
            'paciente_id' => $id,
            'contenido'   => $request->contenido,
        ]);

        return redirect("/pacientes/{$id}")->with('success', 'Nota añadida correctamente.');
    }

    public function destroyNota($id)
    {
        $nota = Nota::findOrFail($id);
        $paciente_id = $nota->paciente_id;
        $nota->delete();

        return redirect("/pacientes/{$paciente_id}")->with('success', 'Nota eliminada.');
    }

    // EXPORTS
    public function exportarCsv()
    {
        $pacientes = Paciente::all();

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="pacientes.csv"',
        ];

        $callback = function () use ($pacientes) {
            $file = fopen('php://output', 'w');

            // Cabecera del CSV
            fputcsv($file, ['ID', 'Nombre', 'Edad', 'Teléfono', 'Fecha de registro']);

            foreach ($pacientes as $paciente) {
                fputcsv($file, [
                    $paciente->id,
                    $paciente->nombre,
                    $paciente->edad,
                    $paciente->telefono ?? '',
                    $paciente->created_at->format('d/m/Y'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportarPdf()
    {
        $pacientes = Paciente::all();
        $pdf = Pdf::loadView('exports.pacientes-pdf', ['pacientes' => $pacientes]);
        return $pdf->download('pacientes.pdf');
    }
}
