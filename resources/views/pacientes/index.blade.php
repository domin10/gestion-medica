@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Pacientes</h1>
        <a href="/pacientes/crear"
           class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Nuevo paciente
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Nombre</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Edad</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Teléfono</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($pacientes as $paciente)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-800 font-medium">{{ $paciente->nombre }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $paciente->edad }} años</td>
                    <td class="px-6 py-4 text-gray-600">{{ $paciente->telefono ?? '—' }}</td>
                    <td class="px-6 py-4 flex gap-3">
                        <a href="/pacientes/{{ $paciente->id }}/editar"
                           class="text-blue-600 hover:text-blue-800 font-medium transition">Editar</a>
                        <form method="POST" action="/pacientes/{{ $paciente->id }}/eliminar"
                              onsubmit="return confirm('¿Eliminar este paciente?')">
                            @csrf
                            <button type="submit"
                                    class="text-red-500 hover:text-red-700 font-medium transition">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection