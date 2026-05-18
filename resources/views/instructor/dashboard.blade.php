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
                                <div class="flex items-center gap-4 text-sm text-gray-500 mt-1">

    <div class="flex items-center gap-1">
        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m10 0H7m5-10a4 4 0 100-8 4 4 0 000 8z"/>
        </svg>

        <span>{{ $curso->docentes->count() }} participante(s)</span>
    </div>

    <div class="flex items-center gap-1">
        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6.253v13m0-13C10.832 5.483 9.246 5 7.5 5S4.168 5.483 3 6.253v13
                C4.168 18.483 5.754 18 7.5 18s3.332.483 4.5 1.253m0-13
                C13.168 5.483 14.754 5 16.5 5s3.332.483 4.5 1.253v13
                C19.832 18.483 18.246 18 16.5 18s-3.332.483-4.5 1.253"/>
        </svg>

        <span>{{ $curso->unidades->count() }} unidad(es)</span>
    </div>

</div>
                            </div>
                           <a href="{{ route('instructor.calificaciones', $curso->id) }}"
    class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition flex items-center gap-2">

    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414
            a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
    </svg>

    Registrar Calificaciones
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