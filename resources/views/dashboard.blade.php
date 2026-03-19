<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-6">

        {{-- Tarjetas de estadísticas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total pacientes</p>
                <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalPacientes }}</p>
                <p class="text-xs text-blue-600 dark:text-blue-400 mt-2">Registrados en el sistema</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Edad media</p>
                <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $edadMedia }}<span class="text-lg font-normal text-gray-400"> años</span></p>
                <p class="text-xs text-blue-600 dark:text-blue-400 mt-2">Media de todos los pacientes</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Paciente mayor</p>
                <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $pacienteMayor?->edad ?? '—' }}<span class="text-lg font-normal text-gray-400"> años</span></p>
                <p class="text-xs text-blue-600 dark:text-blue-400 mt-2">{{ $pacienteMayor?->nombre ?? '—' }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Paciente menor</p>
                <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $pacienteMenor?->edad ?? '—' }}<span class="text-lg font-normal text-gray-400"> años</span></p>
                <p class="text-xs text-blue-600 dark:text-blue-400 mt-2">{{ $pacienteMenor?->nombre ?? '—' }}</p>
            </div>

        </div>

        {{-- Últimos pacientes registrados --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-100">Últimos pacientes registrados</h3>
                <a href="/pacientes" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 transition">Ver todos →</a>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($ultimosPacientes as $paciente)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 text-sm font-semibold">
                            {{ strtoupper(substr($paciente->nombre, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $paciente->nombre }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $paciente->edad }} años · {{ $paciente->telefono ?? 'Sin teléfono' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-400 dark:text-gray-500">{{ $paciente->created_at->diffForHumans() }}</span>
                        <a href="/pacientes/{{ $paciente->id }}" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 font-medium transition">Ver →</a>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center text-sm text-gray-400 dark:text-gray-500">
                    No hay pacientes registrados aún.
                </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>