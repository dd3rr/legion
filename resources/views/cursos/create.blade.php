<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nuevo Curso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Mensajes de error --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('cursos.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Nombre del curso --}}
                        <div>
                            <x-input-label for="nombre" :value="__('Nombre del Curso')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text"
                                name="nombre" value="{{ old('nombre') }}" required />
                        </div>

                        {{-- Fecha inicio --}}
                        <div>
                            <x-input-label for="fecha_inicio" :value="__('Fecha de Inicio (AAAA-MM-DD)')" />
                            <x-text-input id="fecha_inicio" class="block mt-1 w-full" type="date"
                                name="fecha_inicio" value="{{ old('fecha_inicio') }}" required />
                        </div>

                        {{-- Fecha fin --}}
                        <div>
                            <x-input-label for="fecha_fin" :value="__('Fecha de Término (AAAA-MM-DD)')" />
                            <x-text-input id="fecha_fin" class="block mt-1 w-full" type="date"
                                name="fecha_fin" value="{{ old('fecha_fin') }}" required />
                        </div>

                        {{-- Hora inicio --}}
                        <div>
                            <x-input-label for="hora_inicio" :value="__('Hora de Inicio')" />
                            <x-text-input id="hora_inicio" class="block mt-1 w-full" type="time"
                                name="hora_inicio" value="{{ old('hora_inicio') }}" required />
                        </div>

                        {{-- Hora fin --}}
                        <div>
                            <x-input-label for="hora_fin" :value="__('Hora de Fin')" />
                            <x-text-input id="hora_fin" class="block mt-1 w-full" type="time"
                                name="hora_fin" value="{{ old('hora_fin') }}" required />
                        </div>

                        {{-- Instructor (combobox) --}}
                        <div>
                            <x-input-label for="instructor" :value="__('Instructor')" />
                            <select id="instructor" name="instructor" required
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                                <option value="">-- Selecciona un instructor --</option>
                                @foreach ($docentes as $docente)
                                    <option value="{{ $docente->nombre }}"
                                        {{ old('instructor') == $docente->nombre ? 'selected' : '' }}>
                                        {{ $docente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Co-instructor (combobox) --}}
                        <div>
                            <x-input-label for="co_instructor" :value="__('Co-Instructor')" />
                            <select id="co_instructor" name="co_instructor" required
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                                <option value="">-- Selecciona un co-instructor --</option>
                                @foreach ($docentes as $docente)
                                    <option value="{{ $docente->nombre }}"
                                        {{ old('co_instructor') == $docente->nombre ? 'selected' : '' }}>
                                        {{ $docente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="flex items-center justify-between mt-6">
                        {{-- Botón regresar (según SRS ambas interfaces tienen botón de regreso) --}}
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-600 hover:underline">
                            ← Regresar
                        </a>

                        <x-primary-button>
                            {{ __('Guardar Curso') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
