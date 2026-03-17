<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detalle del paciente</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-6">
        <a href="/pacientes" class="text-sm text-gray-500 hover:text-blue-600 transition">← Volver a pacientes</a>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mt-4 overflow-hidden">

            {{-- Cabecera del paciente --}}
            <div class="bg-blue-600 px-8 py-6 flex items-center gap-5">
                <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($paciente->nombre, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-white">{{ $paciente->nombre }}</h1>
                    <p class="text-blue-100 text-sm mt-1">Paciente #{{ $paciente->id }}</p>
                </div>
            </div>

            {{-- Datos del paciente --}}
            <div class="px-8 py-6 divide-y divide-gray-100">

                <div class="flex items-center justify-between py-4">
                    <span class="text-sm text-gray-500">Edad</span>
                    <span class="text-sm font-medium text-gray-800">{{ $paciente->edad }} años</span>
                </div>

                <div class="flex items-center justify-between py-4">
                    <span class="text-sm text-gray-500">Teléfono</span>
                    <span class="text-sm font-medium text-gray-800">{{ $paciente->telefono ?? '—' }}</span>
                </div>

                <div class="flex items-center justify-between py-4">
                    <span class="text-sm text-gray-500">Notas</span>
                    <span class="text-sm font-medium text-gray-800">{{ $paciente->notas ?? '—' }}</span>
                </div>

                <div class="flex items-center justify-between py-4">
                    <span class="text-sm text-gray-500">Registro creado</span>
                    <span class="text-sm font-medium text-gray-800">{{ $paciente->created_at->format('d/m/Y') }}</span>
                </div>

            </div>

            {{-- Acciones --}}
            <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex gap-3">
                <a href="/pacientes/{{ $paciente->id }}/editar"
                   class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
                    Editar paciente
                </a>
                <a href="/pacientes"
                   class="bg-white hover:bg-gray-100 text-gray-700 text-sm font-medium px-5 py-2 rounded-lg border border-gray-200 transition">
                    Volver
                </a>
            </div>
        </div>
    </div>
</x-app-layout>