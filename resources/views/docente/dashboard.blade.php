<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel del Docente
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Bienvenida --}}
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-bold text-gray-800">
                    Bienvenido, {{ $docente->nombre }} {{ $docente->apellido_paterno }}
                </h3>
                <p class="text-gray-500 text-sm mt-1">
                    {{ $docente->grado_academico ?? 'Sin grado registrado' }} ·
                    {{ $docente->departamento ?? 'Sin departamento' }}
                </p>
            </div>

            {{-- Menú de opciones --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <a href="#datos-academicos"
                   onclick="mostrarSeccion('datos-academicos')"
                   class="bg-blue-500 text-white p-6 rounded-lg text-center font-bold hover:bg-blue-600 transition cursor-pointer">
                    📝 Datos Académicos
                </a>

                <a href="{{ route('docente.calificaciones') }}"
                   class="bg-indigo-500 text-white p-6 rounded-lg text-center font-bold hover:bg-indigo-600 transition">
                    📊 Mis Calificaciones
                </a>

                <a href="{{ route('docente.ficha-tecnica') }}"
                   class="bg-green-500 text-white p-6 rounded-lg text-center font-bold hover:bg-green-600 transition">
                    📄 Ficha Técnica
                </a>

            </div>

            {{-- Sección: Datos Académicos --}}
            <div id="datos-academicos" class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Datos Académicos</h3>

                <form action="{{ route('docente.datos-academicos') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <x-input-label for="grado_academico" :value="__('Grado de Estudios')" />
                            <select name="grado_academico" id="grado_academico" required
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Selecciona --</option>
                                @foreach(['Licenciatura','Ingeniería','Maestría','Doctorado','Técnico Superior','Bachillerato'] as $grado)
                                    <option value="{{ $grado }}"
                                        {{ old('grado_academico', $docente->grado_academico) == $grado ? 'selected' : '' }}>
                                        {{ $grado }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="carrera" :value="__('Carrera')" />
                            <x-text-input id="carrera" class="block mt-1 w-full" type="text"
                                name="carrera" value="{{ old('carrera', $docente->carrera) }}" required />
                        </div>

                        <div>
                            <x-input-label for="departamento" :value="__('Departamento')" />
                            <x-text-input id="departamento" class="block mt-1 w-full" type="text"
                                name="departamento" value="{{ old('departamento', $docente->departamento) }}" required />
                        </div>

                        <div>
                            <x-input-label for="rol" :value="__('Rol')" />
                            <select name="rol" id="rol" required
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Selecciona --</option>
                                @foreach(['Docente','Coordinador','Jefe de Área','Subdirector','Director'] as $r)
                                    <option value="{{ $r }}"
                                        {{ old('rol', $docente->rol) == $r ? 'selected' : '' }}>
                                        {{ $r }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="especialidad" :value="__('Especialidad (opcional)')" />
                            <x-text-input id="especialidad" class="block mt-1 w-full" type="text"
                                name="especialidad" value="{{ old('especialidad', $docente->especialidad) }}" />
                        </div>

                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>Guardar Datos Académicos</x-primary-button>
                    </div>

                </form>
            </div>

            {{-- Sección: Cursos inscritos --}}
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Mis Cursos</h3>

                @forelse($cursos as $curso)
                    <div class="border border-gray-200 rounded-lg p-4 mb-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-bold text-indigo-700">{{ $curso->nombre }}</h4>
                                <p class="text-sm text-gray-500">
                                    Clave: {{ $curso->clave }} ·
                                    {{ $curso->fecha_inicio }} al {{ $curso->fecha_fin }} ·
                                    {{ $curso->unidades->count() }} unidades
                                </p>
                            </div>
                            <a href="{{ route('docente.boleta', $curso->id) }}"
                               class="text-sm text-indigo-600 hover:underline">
                                Ver boleta
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 italic text-sm">No estás inscrito en ningún curso aún.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>