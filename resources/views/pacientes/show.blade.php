<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Detalle del paciente</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-6">
        <a href="/pacientes" class="text-sm text-gray-500 dark:text-gray-400 hover:text-blue-600 transition">← Volver a pacientes</a>

        @if(session('success'))
            <div class="mt-4 flex items-center gap-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-300 text-sm px-4 py-3 rounded-lg">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Ficha del paciente --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mt-4 overflow-hidden">

            <div class="bg-blue-600 px-8 py-6 flex items-center gap-5">
                <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($paciente->nombre, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-white">{{ $paciente->nombre }}</h1>
                    <p class="text-blue-100 text-sm mt-1">Paciente #{{ $paciente->id }}</p>
                </div>
            </div>

            <div class="px-8 py-6 divide-y divide-gray-100 dark:divide-gray-700">
                <div class="flex items-center justify-between py-4">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Edad</span>
                    <span class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $paciente->edad }} años</span>
                </div>
                <div class="flex items-center justify-between py-4">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Teléfono</span>
                    <span class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $paciente->telefono ?? '—' }}</span>
                </div>
                <div class="flex items-center justify-between py-4">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Registro creado</span>
                    <span class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $paciente->created_at->format('d/m/Y') }}</span>
                </div>
            </div>

            <div class="px-8 py-5 bg-gray-50 dark:bg-gray-700 border-t border-gray-100 dark:border-gray-600 flex gap-3">
                <a href="/pacientes/{{ $paciente->id }}/editar"
                   class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
                    Editar paciente
                </a>
                <a href="/pacientes"
                   class="bg-white dark:bg-gray-600 hover:bg-gray-100 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-100 text-sm font-medium px-5 py-2 rounded-lg border border-gray-200 dark:border-gray-500 transition">
                    Volver
                </a>
            </div>
        </div>

        {{-- Notas clínicas --}}
        <div class="mt-6">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Notas clínicas</h2>

            {{-- Formulario nueva nota --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-4">
                <form method="POST" action="/pacientes/{{ $paciente->id }}/notas">
                    @csrf
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nueva nota</label>
                    <textarea name="contenido" rows="3"
                              class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                              placeholder="Escribe una nota clínica...">{{ old('contenido') }}</textarea>
                    @error('contenido')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <div class="mt-3">
                        <x-primary-button>Guardar nota</x-primary-button>
                    </div>
                </form>
            </div>

            {{-- Lista de notas --}}
            @forelse($paciente->notasClinicas->sortByDesc('created_at') ?? collect() as $nota)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-3">
                    <div class="flex items-start justify-between gap-4">
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">{{ $nota->contenido }}</p>
                        <button type="button"
                                onclick="abrirModalNota({{ $nota->id }})"
                                class="text-red-400 hover:text-red-600 transition flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-3">{{ $nota->created_at->format('d/m/Y H:i') }}</p>
                </div>

                {{-- Formulario hidden FUERA del div, no anidado en ningún form --}}
                <form id="form-nota-{{ $nota->id }}" method="POST" action="/notas/{{ $nota->id }}" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @empty
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-8 text-center">
                    <p class="text-sm text-gray-400 dark:text-gray-500">No hay notas clínicas para este paciente.</p>
                </div>
            @endforelse
        </div>

        {{-- Historial de citas --}}
        <div class="mt-6">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Historial de citas</h2>

            {{-- Formulario nueva cita --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-4">
                <form method="POST" action="/pacientes/{{ $paciente->id }}/citas">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha</label>
                            <input type="date" name="fecha" value="{{ old('fecha') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            @error('fecha') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hora</label>
                            <input type="time" name="hora" value="{{ old('hora') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            @error('hora') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Motivo</label>
                        <input type="text" name="motivo" value="{{ old('motivo') }}"
                            placeholder="Ej: Revisión anual"
                            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        @error('motivo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Médico <span class="text-gray-400 font-normal">(opcional)</span></label>
                        <input type="text" name="medico" value="{{ old('medico') }}"
                            placeholder="Ej: Dr. García"
                            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                    <x-primary-button>Añadir cita</x-primary-button>
                </form>
            </div>

            {{-- Lista de citas --}}
            @forelse($paciente->citas->sortByDesc('fecha') as $cita)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-3">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                {{-- Badge estado --}}
                                <form method="POST" action="/citas/{{ $cita->id }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="estado" onchange="this.form.submit()"
                                            class="text-xs font-medium px-2 py-1 rounded-full border-0 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500
                                            {{ $cita->estado === 'pendiente' ? 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300' : '' }}
                                            {{ $cita->estado === 'completada' ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' : '' }}
                                            {{ $cita->estado === 'cancelada' ? 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' : '' }}">
                                        <option value="pendiente" {{ $cita->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="completada" {{ $cita->estado === 'completada' ? 'selected' : '' }}>Completada</option>
                                        <option value="cancelada" {{ $cita->estado === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                    </select>
                                </form>
                                <span class="text-xs text-gray-400 dark:text-gray-500">
                                    {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }} · {{ substr($cita->hora, 0, 5) }}
                                </span>
                            </div>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $cita->motivo }}</p>
                            @if($cita->medico)
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $cita->medico }}</p>
                            @endif
                        </div>
                        <button type="button"
                                onclick="abrirModalCita({{ $cita->id }})"
                                class="text-red-400 hover:text-red-600 transition flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <form id="form-cita-{{ $cita->id }}" method="POST" action="/citas/{{ $cita->id }}" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @empty
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-8 text-center">
                    <p class="text-sm text-gray-400 dark:text-gray-500">No hay citas registradas para este paciente.</p>
                </div>
            @endforelse
        </div>

    </div>

    {{-- Modal eliminar nota --}}
    <div id="modal-nota"
        class="hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="cerrarModalNota()"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-md mx-4 p-8">
            <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 text-center mb-2">¿Eliminar nota?</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-8">Esta acción no se puede deshacer.</p>
            <div class="flex gap-3">
                <button onclick="cerrarModalNota()"
                        class="flex-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium px-4 py-2.5 rounded-lg transition">
                    Cancelar
                </button>
                <button onclick="confirmarEliminarNota()"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">
                    Sí, eliminar
                </button>
            </div>
        </div>
    </div>

    <script>
        let notaIdActiva = null;

        function abrirModalNota(id) {
            notaIdActiva = id;
            document.getElementById('modal-nota').classList.remove('hidden');
        }

        function cerrarModalNota() {
            notaIdActiva = null;
            document.getElementById('modal-nota').classList.add('hidden');
        }

        function confirmarEliminarNota() {
            if (notaIdActiva) {
                document.getElementById('form-nota-' + notaIdActiva).submit();
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') cerrarModalNota();
        });
    </script>

    {{-- Modal eliminar cita --}}
    <div id="modal-cita"
        class="hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="cerrarModalCita()"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-md mx-4 p-8">
            <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 text-center mb-2">¿Eliminar cita?</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-8">Esta acción no se puede deshacer.</p>
            <div class="flex gap-3">
                <button onclick="cerrarModalCita()"
                        class="flex-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium px-4 py-2.5 rounded-lg transition">
                    Cancelar
                </button>
                <button onclick="confirmarEliminarCita()"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">
                    Sí, eliminar
                </button>
            </div>
        </div>
    </div>

    <script>
        let citaIdActiva = null;

        function abrirModalCita(id) {
            citaIdActiva = id;
            document.getElementById('modal-cita').classList.remove('hidden');
        }

        function cerrarModalCita() {
            citaIdActiva = null;
            document.getElementById('modal-cita').classList.add('hidden');
        }

        function confirmarEliminarCita() {
            if (citaIdActiva) {
                document.getElementById('form-cita-' + citaIdActiva).submit();
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModalCita();
                cerrarModalNota();
            }
        });
    </script>
</x-app-layout>