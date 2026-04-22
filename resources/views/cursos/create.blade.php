<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nuevo Curso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('cursos.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="clave" :value="__('Clave del Curso')" />
                            <x-text-input id="clave" class="block mt-1 w-full" type="text" name="clave" required />
                        </div>

                        <div>
                            <x-input-label for="nombre" :value="__('Nombre del Curso')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" required />
                        </div>

                        <div>
                            <x-input-label for="fecha_inicio" :value="__('Fecha Inicio')" />
                            <x-text-input id="fecha_inicio" class="block mt-1 w-full" type="date" name="fecha_inicio" required />
                        </div>

                        <div>
                            <x-input-label for="fecha_fin" :value="__('Fecha Fin')" />
                            <x-text-input id="fecha_fin" class="block mt-1 w-full" type="date" name="fecha_fin" required />
                        </div>

                        <div>
                            <x-input-label for="hora_inicio" :value="__('Hora Inicio')" />
                            <x-text-input id="hora_inicio" class="block mt-1 w-full" type="time" name="hora_inicio" required />
                        </div>

                        <div>
                            <x-input-label for="hora_fin" :value="__('Hora Fin')" />
                            <x-text-input id="hora_fin" class="block mt-1 w-full" type="time" name="hora_fin" required />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Guardar Curso') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>