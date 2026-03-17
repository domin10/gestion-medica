@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <a href="/pacientes" class="text-sm text-gray-500 hover:text-blue-600 transition">← Volver a pacientes</a>
        <h1 class="text-2xl font-semibold text-gray-800 mt-2">Editar paciente</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 max-w-lg">
        <form method="POST" action="/pacientes/{{ $paciente->id }}">
            @csrf

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                <input type="text" name="nombre" value="{{ $paciente->nombre }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Edad</label>
                <input type="number" name="edad" value="{{ $paciente->edad }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input type="text" name="telefono" value="{{ $paciente->telefono }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition">
                    Guardar cambios
                </button>
                <a href="/pacientes"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-6 py-2.5 rounded-lg transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection