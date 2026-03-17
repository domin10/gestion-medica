<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Pacientes</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-6">
        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3 rounded-lg">
                <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Lista de pacientes</h1>
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
    </div>
    
</x-app-layout>