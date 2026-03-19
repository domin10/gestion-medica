<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Pacientes</h2>
        {{-- <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Pacientes</h2> --}}
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
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Lista de pacientes</h1>
            <a href="/pacientes/crear"
               class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                + Nuevo paciente
            </a>
        </div>

        <form method="GET" action="/pacientes" class="mb-6">
            <div class="relative max-w-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text"
                    name="buscar"
                    value="{{ $busqueda ?? '' }}"
                    placeholder="Buscar paciente..."
                    class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                @if($busqueda)
                    <a href="/pacientes"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                @endif
            </div>
        </form>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                    <tr>
                        <th class="text-left px-6 py-3 text-gray-500 dark:text-gray-400 font-medium">Nombre</th>
                        <th class="text-left px-6 py-3 text-gray-500 dark:text-gray-400 font-medium">Edad</th>
                        <th class="text-left px-6 py-3 text-gray-500 dark:text-gray-400 font-medium">Teléfono</th>
                        <th class="text-left px-6 py-3 text-gray-500 dark:text-gray-400 font-medium">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($pacientes as $paciente)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4 text-gray-800 dark:text-gray-100 font-medium">
                            <a href="/pacientes/{{ $paciente->id }}" class="hover:text-blue-600 transition">
                                {{ $paciente->nombre }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $paciente->edad }} años</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $paciente->telefono ?? '—' }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            <div class="flex items-center gap-2">
                                <a href="/pacientes/{{ $paciente->id }}"
                                class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-600 hover:text-blue-600 bg-gray-100 hover:bg-blue-50 border border-gray-200 hover:border-blue-200 px-3 py-1.5 rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Ver
                                </a>
                                <a href="/pacientes/{{ $paciente->id }}/editar"
                                class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-600 hover:text-blue-600 bg-gray-100 hover:bg-blue-50 border border-gray-200 hover:border-blue-200 px-3 py-1.5 rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Editar
                                </a>
                                <button type="button"
                                        onclick="abrirModal({{ $paciente->id }}, '{{ $paciente->nombre }}')"
                                        class="inline-flex items-center gap-1.5 text-xs font-medium text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 px-3 py-1.5 rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Eliminar
                                </button>
                                <form id="form-eliminar-{{ $paciente->id }}"
                                    method="POST"
                                    action="/pacientes/{{ $paciente->id }}/eliminar"
                                    class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($pacientes->hasPages())
            <div class="mt-4">
                {{ $pacientes->appends(['buscar' => $busqueda])->links() }}
            </div>
        @endif
    </div>

    {{-- Modal de confirmación --}}
    <div id="modal"
         class="hidden fixed inset-0 z-50 flex items-center justify-center">

        {{-- Fondo oscuro --}}
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="cerrarModal()"></div>

        {{-- Contenido del modal --}}
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-8">

            {{-- Icono --}}
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>

            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">¿Eliminar paciente?</h3>
            <p class="text-sm text-gray-500 text-center mb-8">
                Vas a eliminar a <span id="modal-nombre" class="font-medium text-gray-800"></span>.
                Esta acción no se puede deshacer.
            </p>

            <div class="flex gap-3">
                <button onclick="cerrarModal()"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2.5 rounded-lg transition">
                    Cancelar
                </button>
                <button onclick="confirmarEliminar()"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">
                    Sí, eliminar
                </button>
            </div>
        </div>
    </div>

    <script>
        let formIdActivo = null;

        function abrirModal(id, nombre) {
            formIdActivo = id;
            document.getElementById('modal-nombre').textContent = nombre;
            document.getElementById('modal').classList.remove('hidden');
        }

        function cerrarModal() {
            formIdActivo = null;
            document.getElementById('modal').classList.add('hidden');
        }

        function confirmarEliminar() {
            if (formIdActivo) {
                document.getElementById('form-eliminar-' + formIdActivo).submit();
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') cerrarModal();
        });
    </script>

</x-app-layout>