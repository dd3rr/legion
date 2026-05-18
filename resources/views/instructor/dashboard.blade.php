<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel del Instructor
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
                    Bienvenido, {{ $instructor->nombre }} {{ $instructor->apellido_paterno }}
                </h3>
                <p class="text-gray-500 text-sm mt-1">
                    {{ $instructor->grado_academico }} ·
                    {{ $instructor->especialidad ?? 'Sin especialidad registrada' }}
                </p>
            </div>

            {{-- Cursos asignados --}}
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Cursos que Imparto</h3>

                @forelse($cursos as $curso)
                    <div class="border border-gray-200 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between flex-wrap gap-3">
                            <div>
                                <h4 class="font-bold text-indigo-700">{{ $curso->nombre }}</h4>
                                <p class="text-sm text-gray-500 mt-1">
                                    Clave: {{ $curso->clave }} ·
                                    {{ $curso->fecha_inicio }} al {{ $curso->fecha_fin }} ·
                                    {{ $curso->hora_inicio }} - {{ $curso->hora_fin }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    👥 {{ $curso->docentes->count() }} participante(s) inscritos ·
                                    📚 {{ $curso->unidades->count() }} unidad(es)
                                </p>
                            </div>
                            <a href="{{ route('instructor.calificaciones', $curso->id) }}"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition">
                                📝 Registrar Calificaciones
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 italic text-sm">
                        No tienes cursos asignados aún. Contacta a jefatura.
                    </p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>