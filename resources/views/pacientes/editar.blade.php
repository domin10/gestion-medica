<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Editar paciente</h2>
    </x-slot>

    <div class="py-8 max-w-lg mx-auto px-6">
        <a href="/pacientes" class="text-sm text-gray-500 hover:text-blue-600 transition">← Volver a pacientes</a>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 mt-4">
            <form method="POST" action="/pacientes/{{ $paciente->id }}">
                @csrf

                <div class="mb-5">
                    <x-input-label for="nombre" value="Nombre completo" />
                    <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full"
                                  :value="old('nombre', $paciente->nombre)" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-1" />
                </div>

                <div class="mb-5">
                    <x-input-label for="edad" value="Edad" />
                    <x-text-input id="edad" name="edad" type="number" class="mt-1 block w-full"
                                  :value="old('edad', $paciente->edad)" />
                    <x-input-error :messages="$errors->get('edad')" class="mt-1" />
                </div>

                <div class="mb-8">
                    <x-input-label for="telefono" value="Teléfono" />
                    <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full"
                                  :value="old('telefono', $paciente->telefono)" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-1" />
                </div>

                <div class="flex gap-3">
                    <x-primary-button>Guardar cambios</x-primary-button>
                    <a href="/pacientes"
                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-6 py-2.5 rounded-lg transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>