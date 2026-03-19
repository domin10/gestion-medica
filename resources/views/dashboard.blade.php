<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-6">

        {{-- Tarjetas de estadísticas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <p class="text-sm text-gray-500 mb-1">Total pacientes</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalPacientes }}</p>
                <p class="text-xs text-blue-600 mt-2">Registrados en el sistema</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <p class="text-sm text-gray-500 mb-1">Edad media</p>
                <p class="text-3xl font-bold text-gray-800">{{ $edadMedia }}<span class="text-lg font-normal text-gray-400"> años</span></p>
                <p class="text-xs text-blue-600 mt-2">Media de todos los pacientes</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <p class="text-sm text-gray-500 mb-1">Paciente mayor</p>
                <p class="text-2xl font-bold text-gray-800">{{ $pacienteMayor?->edad ?? '—' }}<span class="text-lg font-normal text-gray-400"> años</span></p>
                <p class="text-xs text-gray-500 mt-2 truncate">{{ $pacienteMayor?->nombre ?? '—' }}</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <p class="text-sm text-gray-500 mb-1">Paciente menor</p>
                <p class="text-2xl font-bold text-gray-800">{{ $pacienteMenor?->edad ?? '—' }}<span class="text-lg font-normal text-gray-400"> años</span></p>
                <p class="text-xs text-gray-500 mt-2 truncate">{{ $pacienteMenor?->nombre ?? '—' }}</p>
            </div>

        </div>

        {{-- Últimos pacientes registrados --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-800">Últimos pacientes registrados</h3>
                <a href="/pacientes" class="text-xs text-blue-600 hover:text-blue-800 transition">Ver todos →</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($ultimosPacientes as $paciente)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-sm font-semibold">
                            {{ strtoupper(substr($paciente->nombre, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $paciente->nombre }}</p>
                            <p class="text-xs text-gray-500">{{ $paciente->edad }} años · {{ $paciente->telefono ?? 'Sin teléfono' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-400">{{ $paciente->created_at->diffForHumans() }}</span>
                        <a href="/pacientes/{{ $paciente->id }}"
                           class="text-xs text-blue-600 hover:text-blue-800 font-medium transition">Ver →</a>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center text-sm text-gray-400">
                    No hay pacientes registrados aún.
                </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>